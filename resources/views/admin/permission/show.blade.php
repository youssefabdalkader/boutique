@extends('layouts.admin')

@section('title', 'Permission Details')

@section('content')

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Permission Details</h4>

            <div>
                <a href="{{ route('admin.permission.edit', $permission->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>

                <a href="{{ route('admin.permission.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <tbody>

                    <tr>
                        <th width="200">ID</th>
                        <td>{{ $permission->id }}</td>
                    </tr>

                    <tr>
                        <th>Name</th>
                        <td>{{ $permission->name }}</td>
                    </tr>

                    <tr>
                        <th>Slug</th>
                        <td>{{ $permission->guard_name }}</td>
                    </tr>




                    </tr>

                </tbody>
            </table>

        </div>
    </div>

@endsection
