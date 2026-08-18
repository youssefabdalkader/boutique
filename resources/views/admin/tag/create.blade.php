@extends('layouts.admin')

@section('title', 'Create Tag')

@section('content')

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Create Tag</h4>

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

            <form action="{{ route('admin.tag.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Slug <span class="text-danger">*</span></label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" required>
                    </div>





                    <div class="col-md-6 mb-4">
                        <label>Status</label>

                        <select name="status" class="form-control">
                            <option value="1" @selected(old('status', 1) == 1)>
                                Active
                            </option>

                            <option value="0" @selected(old('status') == 0)>
                                Inactive
                            </option>
                        </select>
                    </div>

                </div>

                <button type="submit" value="save" class="btn btn-primary">
                    <i class="fas fa-backspace"></i> Create Tag
                </button>
                <button type="submit" value="back" name="back" class="btn btn-primary">
                    <i class="fas fa-save"></i> BackCreate Another Tag
                </button>

            </form>

        </div>
    </div>

@endsection
