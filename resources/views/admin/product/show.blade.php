@extends('layouts.admin')

@section('title', 'Product Details')

@section('content')

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Product Details</h4>

            <div>
                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>

                <a href="{{ route('admin.product.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <tbody>

                    <tr>
                        <th width="200">ID</th>
                        <td>{{ $product->id }}</td>
                    </tr>

                    <tr>
                        <th>Name</th>
                        <td>{{ $product->name }}</td>
                    </tr>

                    <tr>
                        <th>Slug</th>
                        <td>{{ $product->slug }}</td>
                    </tr>

                    <tr>
                        <th>Description</th>
                        <td>
                            {{ $product->description ?: 'No description' }}
                        </td>
                    </tr>


                    <tr>
                        <th>Quantity</th>
                        <td>{{ $product->quantity }}</td>
                    <tr>
                        <th>Category</th>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Tags</th>
                        <td>
                            @if ($product->tags->isNotEmpty())
                                <ul class="mb-0">
                                    @foreach ($product->tags as $tag)
                                        <li>{{ $tag->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">No tags associated.</span>
                            @endif
                        </td>

                    <tr>
                        <th>Status</th>
                        <td>
                            @if ($product->status)
                                <span class="badge badge-success">
                                    <i class="fas fa-check"></i>
                                    Active
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    <i class="fas fa-times"></i>
                                    Inactive
                                </span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Created At</th>
                        <td>{{ $product->created_at->format('d M Y h:i A') }}</td>
                    </tr>

                    <tr>
                        <th>Updated At</th>
                        <td>{{ $product->updated_at->format('d M Y h:i A') }}</td>
                    </tr>

                </tbody>
            </table>

        </div>
    </div>

@endsection
