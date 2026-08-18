<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $roles = \Spatie\Permission\Models\Role::with('permissions')->when(request('search'), function ($query) {
            $query->where('name', 'like', '%' . request('search') . '%');
        })->paginate(10);
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = \Spatie\Permission\Models\Role::with('permissions')->all();

        $permissions = \Spatie\Permission\Models\Permission::all();

        return view('admin.role.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        $role->syncPermissions($request->permissions ?? []);

        if ($request->has('back')) {
            return redirect()
                ->route('admin.role.create')
                ->with('success', 'Role created successfully. You can create another role.');
        }

        return redirect()
            ->route('admin.role.index')
            ->with('success', 'Role created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = \Spatie\Permission\Models\Role::find($id);
        return view('admin.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permissions = \Spatie\Permission\Models\Permission::all();
        $role = \Spatie\Permission\Models\Role::with('permissions')->find($id);
        return view('admin.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'permissions' => 'nullable|array',
        ]);

        $role = \Spatie\Permission\Models\Role::find($id);
        $role->update($request->only('name'));
        $role->syncPermissions($request->permissions ?? []);
        return redirect()->route('admin.role.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = \Spatie\Permission\Models\Role::find($id);
        $role->delete();
        return redirect()->route('admin.role.index')->with('success', 'Role deleted successfully.');
    }
}
