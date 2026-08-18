@extends('layouts.admin')

@section('title', 'Dashboard')

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
                <input type="text" name="search" class="form-control" placeholder="Search by name or slug..."
                    value="{{ request('search') }}">
            </div>



            <div class="col-md-2">
                <button class="btn btn-primary">
                    <i class="fas fa-search"></i> Filter
                </button>

                <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">
                    Reset
                </a>
            </div>

        </div>
    </form>
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Roles</h5>
            {{--  // @if (auth()->user()->can('role.create'))  --}}
            @can('role.create')
                <a href="{{ route('admin.role.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add Role
                </a>
            @endcan

            {{--  //  @endif  --}}

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Guard Name</th>
                            <th>Permissions</th>
                            <th width="200" class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->guard_name }}</td>
                                <td>
                                    @php
                                        $actions = [
                                            'create' => ['color' => 'bg-success', 'text' => 'text-white'],
                                            'delete' => ['color' => 'bg-danger', 'text' => 'text-white'],
                                            'edit' => ['color' => 'bg-warning', 'text' => 'text-dark'],
                                            'view' => ['color' => 'bg-info', 'text' => 'text-white'],
                                        ];
                                    @endphp

                                    @if ($role->permissions->isNotEmpty())
                                        @foreach ($role->permissions->groupBy(fn($permission) => explode('.', $permission->name)[0]) as $module => $permissions)
                                            @php
                                                $permissions = $permissions->keyBy(
                                                    fn($permission) => explode('.', $permission->name)[1],
                                                );
                                            @endphp

                                            <div class="row mb-2">
                                                @foreach ($actions as $action => $style)
                                                    <div class="col-md-3">
                                                        @if (isset($permissions[$action]))
                                                            <span
                                                                class="badge {{ $style['color'] }} {{ $style['text'] }} w-100 py-2 fw-bold">
                                                                {{ $permissions[$action]->name }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="text-muted">No permissions</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if (auth()->user()->can('role.edit'))
                                        <a href="{{ route('admin.role.edit', $role->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.role.show', $role->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Show
                                    </a>
                                    @can('role.delete')
                                        <form action="{{ route('admin.role.destroy', $role->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this role?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endcan



                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    No roles found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                {{ $roles->links() }}
                            </td>
                        </tr>

                </table>
            </div>
        </div>
    </div>
@endsection
