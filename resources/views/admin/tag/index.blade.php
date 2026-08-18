@extends('layouts.admin')

@section('title', 'Dashboard')

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
            <h5 class="mb-0">Products</h5>
            @can('tag.create')
                <a href="{{ route('admin.tag.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add Tag
                </a>
            @endcan

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="70">#</th>
                            <th>name</th>
                            <th>slug</th>
                            <th>status</th>
                            <th width="200" class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($tags as $tag)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $tag->name }}</td>
                                <td>{{ $tag->slug }}</td>

                                <td>
                                    @if ($tag->status)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @can('tag.edit')
                                        <a href="{{ route('admin.tag.edit', $tag->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    @endcan

                                    <a href="{{ route('admin.tag.show', $tag->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Show
                                    </a>

                                    @can('tag.delete')
                                        <form action="{{ route('admin.tag.destroy', $tag->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this tag?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    No tags found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8" class="text-right">
                                {{ $tags->links() }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
