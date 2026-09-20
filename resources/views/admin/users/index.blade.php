@extends('layouts.admin')

@section('title', 'Users')

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">

            {{ session('success') }}

            <button type="button" class="close" data-dismiss="alert">

                <span>&times;</span>

            </button>

        </div>
    @endif


    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            {{ session('error') }}

            <button type="button" class="close" data-dismiss="alert">

                <span>&times;</span>

            </button>

        </div>
    @endif


    <form method="GET" class="mb-4">

        <div class="row">

            <div class="col-md-3">

                <input type="text" name="search" class="form-control" placeholder="Search users..."
                    value="{{ request('search') }}">

            </div>


            <div class="col-md-2">

                <select name="status" class="form-control">

                    <option value="">
                        All Status
                    </option>

                    <option value="1" @selected(request('status') === '1')>

                        Active

                    </option>

                    <option value="0" @selected(request('status') === '0')>

                        Inactive

                    </option>

                </select>

            </div>


            <div class="col-md-2">

                <select name="role" class="form-control">

                    <option value="">
                        All Roles
                    </option>

                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" @selected(request('role') == $role->name)>

                            {{ ucfirst($role->name) }}

                        </option>
                    @endforeach

                </select>

            </div>


            <div class="col-md-2">

                <select name="sort_by" class="form-control">

                    <option value="id" @selected(request('sort_by') == 'id')>

                        ID

                    </option>

                    <option value="first_name" @selected(request('sort_by') == 'first_name')>

                        First Name

                    </option>

                    <option value="last_name" @selected(request('sort_by') == 'last_name')>

                        Last Name

                    </option>

                    <option value="user_name" @selected(request('sort_by') == 'user_name')>

                        User Name

                    </option>

                    <option value="email" @selected(request('sort_by') == 'email')>

                        Email

                    </option>

                    <option value="status" @selected(request('sort_by') == 'status')>

                        Status

                    </option>

                    <option value="created_at" @selected(request('sort_by') == 'created_at')>

                        Created At

                    </option>

                </select>

            </div>


            <div class="col-md-2">

                <select name="direction" class="form-control">

                    <option value="asc" @selected(request('direction') == 'asc')>

                        Ascending

                    </option>

                    <option value="desc" @selected(request('direction', 'desc') == 'desc')>

                        Descending

                    </option>

                </select>

            </div>


            <div class="col-md-1">

                <select name="limit" class="form-control">

                    <option value="10" @selected(request('limit', 10) == 10)>

                        10

                    </option>

                    <option value="25" @selected(request('limit') == 25)>

                        25

                    </option>

                    <option value="50" @selected(request('limit') == 50)>

                        50

                    </option>

                    <option value="100" @selected(request('limit') == 100)>

                        100

                    </option>

                </select>

            </div>

        </div>


        <div class="mt-3">

            <button class="btn btn-primary">

                <i class="fas fa-search"></i>
                Filter

            </button>


            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">

                Reset

            </a>

        </div>

    </form>


    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Users
            </h5>


            @if (auth()->user()->can('user.create'))
                <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm">

                    <i class="fas fa-plus"></i>
                    Add User

                </a>
            @endif

        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th width="70">
                                #
                            </th>

                            <th>
                                Image
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                User Name
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Phone
                            </th>

                            <th>
                                Role
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="220" class="text-center">

                                Actions

                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($users as $user)

                            <tr>

                                <td>
                                    {{ $users->firstItem() + $loop->index }}
                                </td>


                                <td>

                                    @if ($user->image)
                                        <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->user_name }}"
                                            class="img-thumbnail" width="60">
                                    @else
                                        <span class="text-muted">
                                            No image
                                        </span>
                                    @endif

                                </td>


                                <td>
                                    {{ $user->first_name }}
                                    {{ $user->last_name }}
                                </td>


                                <td>
                                    {{ $user->user_name }}
                                </td>


                                <td>
                                    {{ $user->email }}
                                </td>


                                <td>
                                    {{ $user->phone }}
                                </td>


                                <td>

                                    @foreach ($user->roles as $role)
                                        <span class="badge badge-info">

                                            {{ ucfirst($role->name) }}

                                        </span>
                                    @endforeach

                                </td>


                                <td>

                                    @if ($user->status)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif

                                </td>


                                <td class="text-center">

                                    @if (auth()->user()->can('user.edit'))
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning btn-sm">

                                            <i class="fas fa-edit"></i>
                                            Edit

                                        </a>
                                    @endif


                                    <a href="{{ route('admin.user.show', $user->id) }}" class="btn btn-info btn-sm">

                                        <i class="fas fa-eye"></i>
                                        Show

                                    </a>


                                    @if (auth()->user()->can('user.delete'))
                                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                                            class="d-inline">

                                            @csrf

                                            @method('DELETE')


                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this user?')">

                                                <i class="fas fa-trash"></i>
                                                Delete

                                            </button>

                                        </form>
                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="text-center text-muted">

                                    No users found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>


                    <tfoot>

                        <tr>

                            <td colspan="9">

                                {{ $users->links() }}

                            </td>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>

    </div>

@endsection
