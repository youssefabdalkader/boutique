@extends('layouts.admin')

@section('title', 'Tag Details')

@section('content')

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Tag Details</h4>

            <div>
                <a href="{{ route('admin.tag.edit', $tag->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>

                <a href="{{ route('admin.tag.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <tbody>

                    <tr>
                        <th width="200">ID</th>
                        <td>{{ $tag->id }}</td>
                    </tr>

                    <tr>
                        <th>Name</th>
                        <td>{{ $tag->name }}</td>
                    </tr>

                    <tr>
                        <th>Slug</th>
                        <td>{{ $tag->slug }}</td>
                    </tr>


                    <tr>
                        <th>Status</th>
                        <td>
                            @if ($tag->status)
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
                        <td>{{ $tag->created_at->format('d M Y h:i A') }}</td>
                    </tr>

                    <tr>
                        <th>Updated At</th>
                        <td>{{ $tag->updated_at->format('d M Y h:i A') }}</td>
                    </tr>

                </tbody>
            </table>

        </div>
    </div>

@endsection
