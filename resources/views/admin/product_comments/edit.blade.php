@extends('layouts.admin')

@section('title', 'Edit Product Comment')

@section('content')

    <div class="card shadow">
        <div class="card-header">
            <h4 class="mb-0">Edit Product Comment</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.product_comments.update', $productComment->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label>Message</label>

                    <input type="text" name="message" class="form-control @error('message') is-invalid @enderror required"
                        value="{{ old('message', $productComment->message) }}">

                    @error('message')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label>User</label>
                    <select name="user_id" class="form-control @error('user_id') is-invalid @enderror required">
                        <option value="">Select User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @selected(old('user_id', $productComment->user_id) == $user->id)>
                                {{ $user->user_name }}
                            </option>
                        @endforeach
                    </select>

                    @error('user_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>



                <div class="form-group mb-3">
                    <label>Product</label>
                    <select name="product_id" class="form-control @error('product_id') is-invalid @enderror required">
                        <option value="">Select Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" @selected(old('product_id', $productComment->product_id) == $product->id)>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('product_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label>Rate</label>
                    <input type="number" name="rate" class="form-control @error('rate') is-invalid @enderror required"
                        value="{{ old('rate', $productComment->rate) }}" min="1" max="5">

                    @error('rate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>



                <label>Status</label>

                <select name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="1" {{ old('status', $productComment->status) == 1 ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="0" {{ old('status', $productComment->status) == 0 ? 'selected' : '' }}>
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

        <a href="{{ route('admin.product_comments.index') }}" class="btn btn-secondary">
            Cancel
        </a>

        </form>
    </div>
    </div>

@endsection
