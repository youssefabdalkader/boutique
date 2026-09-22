<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('roles');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('user_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->role($request->role);
        }

        // Sorting
        $allowedSorts = [
            'id',
            'first_name',
            'last_name',
            'user_name',
            'email',
            'phone',
            'status',
            'created_at',
        ];

        $sortBy = in_array($request->sort_by, $allowedSorts)
            ? $request->sort_by
            : 'id';

        $direction = $request->direction === 'asc'
            ? 'asc'
            : 'desc';

        $query->orderBy($sortBy, $direction);

        // Pagination
        $limit = in_array((int) $request->limit, [10, 25, 50, 100])
            ? (int) $request->limit
            : 10;

        $users = $query->paginate($limit)->withQueryString();

        $roles = Role::orderBy('name')->get();

        return view('admin.users.index', compact(
            'users',
            'roles'
        ));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',

            'user_name' => 'required|string|max:255|unique:users,user_name',

            'email' => 'required|email|max:255|unique:users,email',

            'phone' => 'required|string|max:255|unique:users,phone',

            'password' => 'required|string|min:8|confirmed',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' => 'required|boolean',

            'role' => 'required|exists:roles,name',
        ]);


        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        // Remove role before creating user
        $role = $validated['role'];
        unset($validated['role']);

        // Create user
        $user = User::create($validated);
        // Upload image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'public');
            $user->image = $imagePath;
        }
        $user->save();

        // Assign role
        $user->assignRole($role);

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $user->load('roles');

        $roles = Role::orderBy('name')->get();

        return view('admin.users.edit', compact(
            'user',
            'roles'
        ));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',

            'last_name' => 'required|string|max:255',

            'user_name' => 'required|string|max:255|unique:users,user_name,' . $user->id,

            'email' => 'required|email|max:255|unique:users,email,' . $user->id,

            'phone' => 'required|string|max:255|unique:users,phone,' . $user->id,

            'password' => 'nullable|string|min:8|confirmed',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' => 'required|boolean',

            'role' => 'required|exists:roles,name',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            $validated['image'] = $request->file('image')
                ->store('users', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Remove Image
        |--------------------------------------------------------------------------
        */

        if ($request->boolean('remove_image')) {

            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            $validated['image'] = null;
        }

        /*
        |--------------------------------------------------------------------------
        | Password
        |--------------------------------------------------------------------------
        */

        if (!empty($validated['password'])) {

            $validated['password'] = Hash::make(
                $validated['password']
            );
        } else {

            unset($validated['password']);
        }

        /*
        |--------------------------------------------------------------------------
        | Role
        |--------------------------------------------------------------------------
        */

        $role = $validated['role'];

        unset($validated['role']);

        /*
        |--------------------------------------------------------------------------
        | Update User
        |--------------------------------------------------------------------------
        */

        $user->update($validated);

        /*
        |--------------------------------------------------------------------------
        | Update Role
        |--------------------------------------------------------------------------
        */

        $user->syncRoles([$role]);

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Delete image
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        // Delete user
        $user->delete();

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'User deleted successfully.');
    }
}