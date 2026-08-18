<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = \App\Models\Tag::paginate(10);
        return view('admin.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tags,slug',
            'status' => 'required|boolean',
        ]);

        \App\Models\Tag::create($request->all());
        if ($request->has('back')) {
            return redirect()->route('admin.tag.create')->with('success', 'Tag created successfully. You can create another tag.');
        }
        return redirect()->route('admin.tag.index')->with('success', 'Tag created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = \App\Models\Tag::find($id);
        return view('admin.tag.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = \App\Models\Tag::find($id);
        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tags,slug,' . $id,
            'status' => 'required|boolean',
        ]);

        $tag = \App\Models\Tag::find($id);
        $tag->update($request->all());
        return redirect()->route('admin.tag.index')->with('success', 'Tag updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = \App\Models\Tag::find($id);
        $tag->delete();
        return redirect()->route('admin.tag.index')->with('success', 'Tag deleted successfully.');
    }
}