@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')

    <div class="card shadow">
        <div class="card-header">
            <h4 class="mb-0">Create Category</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
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

                <div class="form-group mb-3">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror required"
                        value="{{ old('slug') }}">

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
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tags <span class="text-danger">*</span></label>

                    <select name="tags[]" id="tags" class="form-control" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" @selected(in_array($tag->id, old('tags', [])))>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
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

                <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>
        </div>
    </div>

@endsection
