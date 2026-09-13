@extends('layouts.admin')

@section('title', 'Create coupon')

@section('content')

    <div class="card shadow">
        <div class="card-header">
            <h4 class="mb-0">Create coupon</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.coupon.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label>Code</label>
                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror required"
                        value="{{ old('code') }}">

                    @error('code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label>type</label>
                    <select name="type" class="form-control @error('type')
is-invalid
@enderror required">
                        <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                        <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="description">Description</label>

                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="form-group mb-4">
                    <label>value</label>

                    <input type="number" name="value" value="{{ old('value') }}"
                        class="form-control @error('value') is-invalid @enderror" required>

                    @error('value')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label>Greater Than</label>

                    <input type="number" name="greater_than" value="{{ old('greater_than') }}"
                        class="form-control @error('greater_than') is-invalid @enderror" required>

                    @error('greater_than')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label>Use Times</label>

                    <input type="number" name="use_times" value="{{ old('use_times') }}"
                        class="form-control @error('use_times') is-invalid @enderror" required>

                    @error('use_times')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label>starts_at</label>

                    <input type="date" name="starts_at" value="{{ old('starts_at') }}"
                        class="form-control @error('starts_at') is-invalid @enderror" required>

                    @error('starts_at')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label>expires_at</label>

                    <input type="date" name="expires_at" value="{{ old('expires_at') }}"
                        class="form-control @error('expires_at') is-invalid @enderror" required>

                    @error('expires_at')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label>Status</label>

                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>

                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button class="btn btn-success">
                    <i class="fas fa-save"></i>
                    Save
                </button>

                <a href="{{ route('admin.coupon.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>
        </div>
    </div>

@endsection
