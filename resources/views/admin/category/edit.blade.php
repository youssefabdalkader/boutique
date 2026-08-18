@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')

    <div class="card shadow">
        <div class="card-header">
            <h4 class="mb-0">Edit Category</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label>Name</label>

                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror required"
                        value="{{ old('name', $category->name) }}">

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label>Slug</label>

                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                        value="{{ old('slug', $category->slug) }}">

                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="cover">Cover</label>

                    <input type="file" name="cover" id="cover"
                        class="form-control @error('cover') is-invalid @enderror">

                    @error('cover')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    @if ($category->cover)
                        <div class="mt-3">
                            <img src="{{ asset('storage/' . $category->cover) }}" alt="{{ $category->name }}"
                                class="img-thumbnail" width="200">

                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="remove_cover" id="remove_cover"
                                    value="1">

                                <label class="form-check-label" for="remove_cover">
                                    Remove current cover
                                </label>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <label>Status</label>

                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>

                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button class="btn btn-warning">
                    <i class="fas fa-save"></i>
                    Update
                </button>

                <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>
        </div>
    </div>

@endsection
