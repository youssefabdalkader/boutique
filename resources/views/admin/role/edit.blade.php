@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')

    <div class="card shadow">
        <div class="card-header">
            <h4 class="mb-0">Edit Role</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.role.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label>Name</label>

                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror required"
                        value="{{ old('name', $role->name) }}">

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Permissions</label>

                    @foreach ($permissions->sortBy('name')->chunk(4) as $chunk)
                        <div class="row mb-2">
                            @foreach ($chunk as $permission)
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            id="permission{{ $permission->id }}" value="{{ $permission->name }}"
                                            @checked(in_array($permission->name, old('permissions', $role->permissions->pluck('name')->toArray())))>

                                        <label class="form-check-label" for="permission{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                    @error('permissions')
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror



                    <button class="btn btn-warning">
                        <i class="fas fa-save"></i>
                        Update
                    </button>

                    <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>

            </form>
        </div>
    </div>

@endsection
