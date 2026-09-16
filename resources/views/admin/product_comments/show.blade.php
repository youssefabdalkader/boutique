@extends('layouts.admin')

@section('title', 'Product Comment Details')

@section('content')

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Product Comment Details</h4>

            <div>
                <a href="{{ route('admin.product_comment.edit', $productComment->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>

                <a href="{{ route('admin.product_comment.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <tbody>

                    <tr>
                        <th width="200">ID</th>
                        <td>{{ $productComment->id }}</td>
                    </tr>

                    <tr>
                        <th>Message</th>
                        <td>{{ $productComment->message }}</td>
                    </tr>

                    <tr>
                        <th>User</th>
                        <td>{{ $productComment->user->name }}</td>
                    </tr>

                    <tr>
                        <th>Product</th>
                        <td>{{ $productComment->product->name }}</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            @if ($productComment->status)
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
                        <th>Rate</th>
                        <td>{{ $productComment->rate }}</td>
                    </tr>

                    <tr>
                        <th>Created At</th>
                        <td>{{ $productComment->created_at->format('d M Y h:i A') }}</td>
                    </tr>

                    <tr>
                        <th>Updated At</th>
                        <td>{{ $productComment->updated_at->format('d M Y h:i A') }}</td>
                    </tr>

                </tbody>
            </table>

        </div>
    </div>

@endsection
