@extends('layouts.admin')

@section('title', 'User Address Details')

@section('content')

    <div class="container-fluid">

        <div class="card shadow">

            <div class="card-header">

                <h3 class="card-title">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    User Address Details
                </h3>

            </div>

            <div class="card-body">

                <div class="row">

                    {{-- User --}}
                    <div class="col-md-6">

                        <div class="form-group mb-3">

                            <label>User</label>

                            <div class="form-control">
                                {{ $user_address->user?->first_name }}
                                {{ $user_address->user?->last_name }}
                                -
                                {{ $user_address->user?->user_name }}
                            </div>

                        </div>

                    </div>


                    {{-- Address Title --}}
                    <div class="col-md-6">

                        <div class="form-group mb-3">

                            <label>Address Title</label>

                            <div class="form-control">
                                {{ $user_address->address_title }}
                            </div>

                        </div>

                    </div>


                    {{-- Country --}}
                    <div class="col-md-4">

                        <div class="form-group mb-3">

                            <label>Country</label>

                            <div class="form-control">
                                {{ $user_address->country?->name ?? '-' }}
                            </div>

                        </div>

                    </div>


                    {{-- Governorate --}}
                    <div class="col-md-4">

                        <div class="form-group mb-3">

                            <label>Governorate</label>

                            <div class="form-control">
                                {{ $user_address->governorate?->name ?? '-' }}
                            </div>

                        </div>

                    </div>


                    {{-- City --}}
                    <div class="col-md-4">

                        <div class="form-group mb-3">

                            <label>City</label>

                            <div class="form-control">
                                {{ $user_address->city?->name ?? '-' }}
                            </div>

                        </div>

                    </div>


                    {{-- Address --}}
                    <div class="col-md-6">

                        <div class="form-group mb-3">

                            <label>Address</label>

                            <div class="form-control">
                                {{ $user_address->address ?? '-' }}
                            </div>

                        </div>

                    </div>


                    {{-- Address 2 --}}
                    <div class="col-md-6">

                        <div class="form-group mb-3">

                            <label>Address 2</label>

                            <div class="form-control">
                                {{ $user_address->address2 ?? '-' }}
                            </div>

                        </div>

                    </div>


                    {{-- Zip Code --}}
                    <div class="col-md-6">

                        <div class="form-group mb-3">

                            <label>Zip Code</label>

                            <div class="form-control">
                                {{ $user_address->zip_code ?? '-' }}
                            </div>

                        </div>

                    </div>


                    {{-- PO Box --}}
                    <div class="col-md-6">

                        <div class="form-group mb-3">

                            <label>PO Box</label>

                            <div class="form-control">
                                {{ $user_address->po_box ?? '-' }}
                            </div>

                        </div>

                    </div>


                    {{-- Default --}}
                    <div class="col-md-12">

                        <div class="form-group mb-4">

                            <label>Default Address</label>

                            <div>

                                @if ($user_address->default_address)
                                    <span class="badge badge-success">
                                        Default Address
                                    </span>
                                @else
                                    <span class="badge badge-secondary">
                                        No
                                    </span>
                                @endif

                            </div>

                        </div>

                    </div>

                </div>


                <div class="d-flex justify-content-between">

                    <a href="{{ route('admin.user-address.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Back
                    </a>

                    @can('user_address.edit')
                        <a href="{{ route('admin.user-address.edit', $user_address->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                    @endcan

                </div>

            </div>

        </div>

    </div>

@endsection
