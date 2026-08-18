<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!(auth()->user()->hasRole('admin') && auth()->user()->can('category.view'))) {
            return abort(403, 'Unauthorized action.');
        }

        // name=adidas&status=1&sort_by=slug&direction=desc&limit=10
        $categories = Category::withCount('products')
            ->when(request('search'), function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . request('search') . '%')
                        ->orWhere('slug', 'like', '%' . request('search') . '%');
                });
            })
            ->when(request()->filled('status'), function ($query) {
                $query->where('status', request('status'));
            })

            ->when(request('sort_by'), function ($query) {
                $direction = request('direction', 'asc');
                $query->orderBy(request('sort_by'), $direction);
            })
            ->paginate(request('limit', 10));
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!(auth()->user()->hasRole('admin') && auth()->user()->can('category.create'))) {
            return abort(403, 'Unauthorized action.');
        }
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
            $category->cover = $coverPath;
        }

        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $id,
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;

        // حذف الصورة الحالية إذا اختار المستخدم ذلك
        if ($request->hasFile('cover')) {

            // حذف الصورة القديمة
            if ($category->cover && Storage::disk('public')->exists($category->cover)) {
                Storage::disk('public')->delete($category->cover);
            }

            $category->cover = $request->file('cover')->store('covers', 'public');
        }

        if ($request->boolean('remove_cover')) {
            if ($category->cover && Storage::disk('public')->exists($category->cover)) {
                Storage::disk('public')->delete($category->cover);
            }

            $category->cover = null;
        }

        // رفع صورة جديدة

        $category->save();

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.category.index')->with('error', 'Cannot delete category with associated products.');
        }
        if ($category->cover && Storage::disk('public')->exists($category->cover)) {
            Storage::disk('public')->delete($category->cover);
        }
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully.');
    }
}
