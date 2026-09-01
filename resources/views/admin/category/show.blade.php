@extends('layouts.admin')

@section('title', 'Category Details')

@section('content')

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Category Details</h4>

            <div>
                <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>

                <a href="{{ route('admin.category.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <tbody>

                    <tr>
                        <th width="200">ID</th>
                        <td>{{ $category->id }}</td>
                    </tr>

                    <tr>
                        <th>Name</th>
                        <td>{{ $category->name }}</td>
                    </tr>

                    <tr>
                        <th>Slug</th>
                        <td>{{ $category->slug }}</td>
                    </tr>
                    <tr>
                        <th>Tags</th>
                        <td>
                            @if ($category->tags->isNotEmpty())
                                <ul class="mb-0">
                                    @foreach ($category->tags as $tag)
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
                            @if ($category->status)
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
                        <td>{{ $category->created_at->format('d M Y h:i A') }}</td>
                    </tr>

                    <tr>
                        <th>Updated At</th>
                        <td>{{ $category->updated_at->format('d M Y h:i A') }}</td>
                    </tr>
                    <tr>
                        <th>Cover</th>
                        <td>
                            @if ($category->cover)
                                <img src="{{ asset('storage/' . $category->cover) }}" alt="{{ $category->name }}"
                                    class="img-thumbnail" width="200">
                            @else
                                <p>No cover image available.</p>
                            @endif
                        </td>
                    </tr>

                </tbody>
            </table>

        </div>
    </div>

@endsection
