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

                <a href="{{ route('admin.permission.index') }}" class="btn btn-secondary">
                    Reset
                </a>
            </div>

        </div>
    </form>
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Permissions</h5>
            {{--  // @if (auth()->user()->can('permission.create'))  --}}
            <a href="{{ route('admin.permission.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Add Permission
            </a>
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
                            <th width="200" class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($permissions as $permission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->guard_name }}</td>

                                <td class="text-center">
                                    @if (auth()->user()->can('permission.edit'))
                                        <a href="{{ route('admin.permission.edit', $permission->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.permission.show', $permission->id) }}"
                                        class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Show
                                    </a>
                                    @if (auth()->user()->can('permission.delete'))
                                        <form action="{{ route('admin.permission.destroy', $permission->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this permission?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    No permissions found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                {{ $permissions->links() }}
                            </td>
                        </tr>

                </table>
            </div>
        </div>
    </div>
@endsection
