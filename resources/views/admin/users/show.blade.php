@extends('layouts.admin')

@section('title', 'User Details')

@section('content')

    <div class="card shadow">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                User Details
            </h4>


            <div>

                <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning btn-sm">

                    <i class="fas fa-edit"></i>
                    Edit

                </a>


                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary btn-sm">

                    <i class="fas fa-arrow-left"></i>
                    Back

                </a>

            </div>

        </div>


        <div class="card-body">

            <table class="table table-bordered">

                <tbody>

                    <tr>

                        <th width="200">
                            ID
                        </th>

                        <td>
                            {{ $user->id }}
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Name
                        </th>

                        <td>
                            {{ $user->first_name }}
                            {{ $user->last_name }}
                        </td>

                    </tr>


                    <tr>

                        <th>
                            User Name
                        </th>

                        <td>
                            {{ $user->user_name }}
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Email
                        </th>

                        <td>
                            {{ $user->email }}
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Phone
                        </th>

                        <td>
                            {{ $user->phone }}
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Role
                        </th>

                        <td>

                            @forelse ($user->roles as $role)
                                <span class="badge badge-info">

                                    {{ ucfirst($role->name) }}

                                </span>

                            @empty

                                <span class="text-muted">
                                    No role assigned.
                                </span>
                            @endforelse

                        </td>

                    </tr>


                    <tr>

                        <th>
                            Status
                        </th>

                        <td>

                            @if ($user->status)
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

                        <th>
                            Created At
                        </th>

                        <td>
                            {{ $user->created_at->format('d M Y h:i A') }}
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Updated At
                        </th>

                        <td>
                            {{ $user->updated_at->format('d M Y h:i A') }}
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Image
                        </th>

                        <td>

                            @if ($user->image)
                                <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->user_name }}"
                                    class="img-thumbnail" width="200">
                            @else
                                <p>
                                    No image available.
                                </p>
                            @endif

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

@endsection
