@extends('layouts.admin')

@section('title', 'Edit Tag')

@section('content')

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Tag</h4>

            <a href="{{ route('admin.tag.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.tag.update', $tag->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Name</label>

                        <input type="text" name="name" class="form-control" value="{{ old('name', $tag->name) }}"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Slug</label>

                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $tag->slug) }}"
                            required>
                    </div>


                    <div class="col-md-6 mb-4">
                        <label>Status</label>

                        <select name="status" class="form-control">
                            <option value="1" @selected(old('status', $tag->status) == 1)>
                                Active
                            </option>

                            <option value="0" @selected(old('status', $tag->status) == 0)>
                                Inactive
                            </option>
                        </select>
                    </div>

                </div>

                <button class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Tag
                </button>

            </form>

        </div>
    </div>

@endsection
