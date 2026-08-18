@extends('layouts.admin')

@section('title', 'Create Permission')

@section('content')

    <div class="card shadow">
        <div class="card-header">
            <h4 class="mb-0">Create Permission</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.permission.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror required"
                        value="{{ old('name') }}">

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>




                <button class="btn btn-success">
                    <i class="fas fa-save"></i>
                    Save
                </button>

                <a href="{{ route('admin.permission.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>
        </div>
    </div>

@endsection
