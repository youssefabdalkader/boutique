<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = \Spatie\Permission\Models\Permission::when(request('search'), function ($query) {
            $query->where('name', 'like', '%' . request('search') . '%');
        })->paginate(10);
        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        $actions = ['view', 'create', 'edit', 'delete'];

        foreach ($actions as $action) {
            \Spatie\Permission\Models\Permission::create([
                'name' => "{$request->name}.{$action}",
            ]);
        }

        if ($request->has('back')) {
            return redirect()
                ->route('admin.permission.create')
                ->with('success', 'Permission created successfully. You can create another permission.');
        }

        return redirect()
            ->route('admin.permission.index')
            ->with('success', 'Permission created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = \Spatie\Permission\Models\Permission::find($id);
        return view('admin.permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = \Spatie\Permission\Models\Permission::find($id);
        return view('admin.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
        ]);

        $permission = \Spatie\Permission\Models\Permission::find($id);
        $permission->update($request->only('name'));

        return redirect()->route('admin.permission.index')->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = \Spatie\Permission\Models\Permission::find($id);
        $permission->delete();

        return redirect()->route('admin.permission.index')->with('success', 'Permission deleted successfully.');
    }
}
