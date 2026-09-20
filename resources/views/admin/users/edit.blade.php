@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')

    <div class="card shadow">

        <div class="card-header">
            <h4 class="mb-0">Edit User</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">

                @csrf

                @method('PUT')


                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group mb-3">

                            <label>First Name</label>

                            <input type="text" name="first_name"
                                class="form-control @error('first_name') is-invalid @enderror"
                                value="{{ old('first_name', $user->first_name) }}">

                            @error('first_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="form-group mb-3">

                            <label>Last Name</label>

                            <input type="text" name="last_name"
                                class="form-control @error('last_name') is-invalid @enderror"
                                value="{{ old('last_name', $user->last_name) }}">

                            @error('last_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                </div>


                <div class="form-group mb-3">

                    <label>User Name</label>

                    <input type="text" name="user_name" class="form-control @error('user_name') is-invalid @enderror"
                        value="{{ old('user_name', $user->user_name) }}">

                    @error('user_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="form-group mb-3">

                    <label>Email</label>

                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}">

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="form-group mb-3">

                    <label>Phone</label>

                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $user->phone) }}">

                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group mb-3">

                            <label>New Password</label>

                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror">

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="form-group mb-3">

                            <label>Confirm New Password</label>

                            <input type="password" name="password_confirmation" class="form-control">

                        </div>

                    </div>

                </div>


                <div class="form-group mb-3">

                    <label>Role</label>

                    <select name="role" class="form-control @error('role') is-invalid @enderror">

                        <option value="">Select Role</option>

                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" @selected(old('role', $user->roles->first()?->name) == $role->name)>

                                {{ ucfirst($role->name) }}

                            </option>
                        @endforeach

                    </select>

                    @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="form-group mb-3">

                    <label>Status</label>

                    <select name="status" class="form-control @error('status') is-invalid @enderror">

                        <option value="1" @selected(old('status', $user->status) == 1)>
                            Active
                        </option>

                        <option value="0" @selected(old('status', $user->status) == 0)>
                            Inactive
                        </option>

                    </select>

                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="form-group mb-4">

                    <label for="image">Image</label>

                    <input type="file" name="image" id="image"
                        class="form-control @error('image') is-invalid @enderror">

                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror


                    @if ($user->image)
                        <div class="mt-3">

                            <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->user_name }}"
                                class="img-thumbnail" width="150">


                            <div class="form-check mt-2">

                                <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image"
                                    value="1">

                                <label class="form-check-label" for="remove_image">

                                    Remove current image

                                </label>

                            </div>

                        </div>
                    @endif

                </div>


                <button class="btn btn-warning">

                    <i class="fas fa-save"></i>
                    Update

                </button>


                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

@endsection
