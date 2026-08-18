@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Product</h4>

            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary btn-sm">
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

            <form action="{{ route('admin.product.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Name</label>

                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Slug</label>

                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $product->slug) }}"
                            required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Description</label>

                        <textarea name="description" rows="4" class="form-control">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Price</label>

                        <input type="number" step="0.01" name="price" class="form-control"
                            value="{{ old('price', $product->price) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Quantity</label>

                        <input type="number" name="quantity" class="form-control"
                            value="{{ old('quantity', $product->quantity) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Category</label>

                        <select name="category_id" class="form-control" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label>Status</label>

                        <select name="status" class="form-control">
                            <option value="1" @selected(old('status', $product->status) == 1)>
                                Active
                            </option>

                            <option value="0" @selected(old('status', $product->status) == 0)>
                                Inactive
                            </option>
                        </select>
                    </div>

                </div>

                <button class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Product
                </button>

            </form>

        </div>
    </div>

@endsection
