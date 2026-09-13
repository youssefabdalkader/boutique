@extends('layouts.admin')

@section('title', 'Edit coupon')

@section('content')

    ```
    <div class="card shadow">
        <div class="card-header">
            <h4 class="mb-0">Edit coupon</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.coupon.update', $coupon->id) }}" method="POST">

                @csrf
                @method('PUT')

                {{-- Code --}}
                <div class="form-group mb-3">
                    <label>Code</label>

                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                        value="{{ old('code', $coupon->code) }}" required>

                    @error('code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- Type --}}
                <div class="form-group mb-3">
                    <label>Type</label>

                    <select name="type" class="form-control @error('type') is-invalid @enderror" required>

                        <option value="percentage" @selected(old('type', $coupon->type) == 'percentage')>
                            Percentage
                        </option>

                        <option value="fixed" @selected(old('type', $coupon->type) == 'fixed')>
                            Fixed
                        </option>

                    </select>

                    @error('type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- Description --}}
                <div class="form-group mb-3">
                    <label for="description">Description</label>

                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                        rows="4">{{ old('description', $coupon->description) }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- Value --}}
                <div class="form-group mb-4">
                    <label>Value</label>

                    <input type="number" name="value" value="{{ old('value', $coupon->value) }}"
                        class="form-control @error('value') is-invalid @enderror" required>

                    @error('value')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- Greater Than --}}
                <div class="form-group mb-4">
                    <label>Greater Than</label>

                    <input type="number" name="greater_than" value="{{ old('greater_than', $coupon->greater_than) }}"
                        class="form-control @error('greater_than') is-invalid @enderror" required>

                    @error('greater_than')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- Use Times --}}
                <div class="form-group mb-4">
                    <label>Use Times</label>

                    <input type="number" name="use_times" value="{{ old('use_times', $coupon->use_times) }}"
                        class="form-control @error('use_times') is-invalid @enderror" required>

                    @error('use_times')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- Starts At --}}
                <div class="form-group mb-4">
                    <label>Starts At</label>

                    <input type="date" name="starts_at"
                        value="{{ old('starts_at', $coupon->starts_at ? \Carbon\Carbon::parse($coupon->starts_at)->format('Y-m-d') : '') }}"
                        class="form-control @error('starts_at') is-invalid @enderror" required>

                    @error('starts_at')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- Expires At --}}
                <div class="form-group mb-4">
                    <label>Expires At</label>

                    <input type="date" name="expires_at"
                        value="{{ old('expires_at', $coupon->expires_at ? \Carbon\Carbon::parse($coupon->expires_at)->format('Y-m-d') : '') }}"
                        class="form-control @error('expires_at') is-invalid @enderror" required>

                    @error('expires_at')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- Status --}}
                <div class="form-group mb-4">
                    <label>Status</label>

                    <select name="status" class="form-control @error('status') is-invalid @enderror">

                        <option value="1" @selected(old('status', $coupon->status) == 1)>
                            Active
                        </option>

                        <option value="0" @selected(old('status', $coupon->status) == 0)>
                            Inactive
                        </option>

                    </select>

                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- Buttons --}}
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i>
                    Update
                </button>

                <a href="{{ route('admin.coupon.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>
    ```

@endsection
