@extends('layouts.admin')

@section('title', 'Product Comments')

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif


    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Product Comments</h5>
            @if (auth()->user()->can('product_comments.create'))
                <a href="{{ route('admin.product_comments.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add product comments
                </a>
            @endif

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="70">#</th>
                            <th>message</th>
                            <th>user_id</th>
                            <th>product_id</th>
                            <th>status</th>
                            <th>rate</th>
                            <th width="200" class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($productComments as $productComment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $productComment->message }}</td>
                                <td>{{ $productComment->user->user_name }}</td>
                                <td>{{ $productComment->product->name }}</td>
                                <td>
                                    @if ($productComment->status)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td>{{ $productComment->rate }}</td>
                                <td class="text-center">
                                    @if (auth()->user()->can('product_comments.edit'))
                                        <a href="{{ route('admin.product_comments.edit', $productComment->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    @endif

                                    @if (auth()->user()->can('product_comments.delete'))
                                        <form action="{{ route('admin.product_comments.destroy', $productComment->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this product comment?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No product comments found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


            <tfoot>
                <tr>
                    <td colspan="7">
                        {{ $productComments->links() }}
                    </td>
                </tr>
                </table>
        </div>
    </div>
    </div>
@endsection
