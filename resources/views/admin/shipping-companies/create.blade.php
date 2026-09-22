@extends('layouts.admin')

@section('title', 'Create Shipping Company')

@section('content')

    <div class="card shadow">

        <div class="card-header">
            <h4 class="mb-0">Create Shipping Company</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.shipping-company.store') }}" method="POST">

                @csrf

                {{-- Name --}}
                <div class="form-group mb-3">

                    <label>Name</label>

                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" required>

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Code --}}
                <div class="form-group mb-3">

                    <label>Code</label>

                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                        value="{{ old('code') }}" required>

                    @error('code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Description --}}
                <div class="form-group mb-3">

                    <label>Description</label>

                    <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Cost --}}
                <div class="form-group mb-3">

                    <label>Cost</label>

                    <input type="number" name="cost" min="0"
                        class="form-control @error('cost') is-invalid @enderror" value="{{ old('cost', 0) }}" required>

                    @error('cost')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Countries --}}
                <div class="form-group mb-3">

                    <label>
                        Countries
                        <span class="text-danger">*</span>
                    </label>

                    <select name="countries[]" class="form-control @error('countries') is-invalid @enderror" multiple
                        required>

                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" @selected(in_array($country->id, old('countries', [])))>
                                {{ $country->name }}
                            </option>
                        @endforeach

                    </select>

                    <small class="text-muted">
                        Hold Ctrl to select multiple countries.
                    </small>

                    @error('countries')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    @error('countries.*')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Fast --}}
                <div class="form-group mb-3">

                    <label>Fast Shipping</label>

                    <select name="fast" class="form-control @error('fast') is-invalid @enderror">

                        <option value="1" {{ old('fast', 0) == 1 ? 'selected' : '' }}>
                            Yes
                        </option>

                        <option value="0" {{ old('fast', 0) == 0 ? 'selected' : '' }}>
                            No
                        </option>

                    </select>

                    @error('fast')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Status --}}
                <div class="form-group mb-4">

                    <label>Status</label>

                    <select name="status" class="form-control @error('status') is-invalid @enderror">

                        <option value="1" {{ old('status', 0) == 1 ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0" {{ old('status', 0) == 0 ? 'selected' : '' }}>
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
                <button class="btn btn-success">

                    <i class="fas fa-save"></i>

                    Save

                </button>


                <a href="{{ route('admin.shipping-company.index') }}" class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>

                    Cancel

                </a>

            </form>

        </div>

    </div>

@endsection
