@extends('layouts.admin')

@section('title', 'Governorates')

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


    <form method="GET" class="mb-4">

        <div class="row">

            <div class="col-md-3">

                <input type="text" name="search" class="form-control" placeholder="Search by name..."
                    value="{{ request('search') }}">

            </div>





            <div class="col-md-2">

                <select name="status" class="form-control">

                    <option value="">
                        All Status
                    </option>

                    <option value="1" @selected(request('status') === '1')>
                        Active
                    </option>

                    <option value="0" @selected(request('status') === '0')>
                        Inactive
                    </option>

                </select>

            </div>


            <div class="col-md-2">

                <select name="sort_by" class="form-control">

                    <option value="id" @selected(request('sort_by') == 'id')>
                        ID
                    </option>

                    <option value="name" @selected(request('sort_by') == 'name')>
                        Name
                    </option>

                    <option value="status" @selected(request('sort_by') == 'status')>
                        Status
                    </option>

                    <option value="created_at" @selected(request('sort_by') == 'created_at')>
                        Created At
                    </option>

                </select>

            </div>


            <div class="col-md-2">

                <select name="direction" class="form-control">

                    <option value="asc" @selected(request('direction') == 'asc')>
                        Ascending
                    </option>

                    <option value="desc" @selected(request('direction', 'desc') == 'desc')>
                        Descending
                    </option>

                </select>

            </div>


            <div class="col-md-1">

                <select name="limit" class="form-control">

                    <option value="10" @selected(request('limit', 10) == 10)>
                        10
                    </option>

                    <option value="25" @selected(request('limit') == 25)>
                        25
                    </option>

                    <option value="50" @selected(request('limit') == 50)>
                        50
                    </option>

                    <option value="100" @selected(request('limit') == 100)>
                        100
                    </option>

                </select>

            </div>

        </div>


        <div class="mt-3">

            <button class="btn btn-primary">

                <i class="fas fa-search"></i>
                Filter

            </button>


            <a href="{{ route('admin.governorate.index') }}" class="btn btn-secondary">

                Reset

            </a>

        </div>

    </form>


    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Governorates
            </h5>

            @if (auth()->user()->can('governorate.create'))
                <a href="{{ route('admin.governorate.create') }}" class="btn btn-primary btn-sm">

                    <i class="fas fa-plus"></i>
                    Add Governorate

                </a>
            @endif

        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th width="70">#</th>

                            <th>Name</th>

                            <th>Country</th>

                            <th>Status</th>

                            <th>Cities Count</th>

                            <th>Created At</th>

                            <th width="220" class="text-center">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($governorates as $governorate)
                            <tr>

                                <td>
                                    {{ $governorates->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    {{ $governorate->name }}
                                </td>

                                <td>
                                    {{ $governorate->country->name ?? 'N/A' }}
                                </td>

                                <td>

                                    @if ($governorate->status)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif

                                </td>

                                <td>
                                    {{ $governorate->cities_count }}
                                </td>

                                <td>
                                    {{ $governorate->created_at->format('d M Y h:i A') }}
                                </td>

                                <td class="text-center">

                                    @if (auth()->user()->can('governorate.edit'))
                                        <a href="{{ route('admin.governorate.edit', $governorate->id) }}"
                                            class="btn btn-warning btn-sm">

                                            <i class="fas fa-edit"></i>
                                            Edit

                                        </a>
                                    @endif


                                    <a href="{{ route('admin.governorate.show', $governorate->id) }}"
                                        class="btn btn-info btn-sm">

                                        <i class="fas fa-eye"></i>
                                        Show

                                    </a>


                                    @if (auth()->user()->can('governorate.delete'))
                                        <form action="{{ route('admin.governorate.destroy', $governorate->id) }}"
                                            method="POST" class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this governorate?')">

                                                <i class="fas fa-trash"></i>
                                                Delete

                                            </button>

                                        </form>
                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center text-muted">

                                    No governorates found.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>


                    <tfoot>

                        <tr>

                            <td colspan="7">
                                {{ $governorates->links() }}
                            </td>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>

    </div>

@endsection
