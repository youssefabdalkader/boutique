@extends('layouts.admin')

@section('title', 'User Addresses')

@section('content')

    <div class="container-fluid">

        {{-- Alerts --}}
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif


        <div class="card shadow">

            <div class="card-header">

                <div class="d-flex justify-content-between align-items-center">

                    <h3 class="card-title">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        User Addresses
                    </h3>

                    @can('user_address.create')
                        <a href="{{ route('admin.user-address.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i>
                            Add Address
                        </a>
                    @endcan

                </div>

            </div>

            <div class="card-body">

                {{-- Filters --}}
                <form method="GET" action="{{ route('admin.user-address.index') }}" class="mb-4">

                    <div class="row">

                        {{-- Search --}}
                        <div class="col-md-3">

                            <div class="form-group">

                                <label>Search</label>

                                <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                    placeholder="Search...">

                            </div>

                        </div>

                        {{-- Country --}}
                        <div class="col-md-2">

                            <div class="form-group">

                                <label>Country</label>

                                <select name="country_id" class="form-control" id="filter_country">
                                    <option value="">All Countries</option>

                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"
                                            {{ request('country_id') == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                        </div>

                        {{-- Governorate --}}
                        <div class="col-md-2">

                            <div class="form-group">

                                <label>Governorate</label>

                                <select name="governorate_id" class="form-control" id="filter_governorate">
                                    <option value="">All Governorates</option>

                                    @foreach ($governorates as $governorate)
                                        <option value="{{ $governorate->id }}"
                                            {{ request('governorate_id') == $governorate->id ? 'selected' : '' }}>
                                            {{ $governorate->name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                        </div>

                        {{-- City --}}
                        <div class="col-md-2">

                            <div class="form-group">

                                <label>City</label>

                                <select name="city_id" class="form-control" id="filter_city">
                                    <option value="">All Cities</option>

                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                        </div>

                        {{-- Default --}}
                        <div class="col-md-1">

                            <div class="form-group">

                                <label>Default</label>

                                <select name="default_address" class="form-control">
                                    <option value="">All</option>

                                    <option value="1" {{ request('default_address') === '1' ? 'selected' : '' }}>
                                        Yes
                                    </option>

                                    <option value="0" {{ request('default_address') === '0' ? 'selected' : '' }}>
                                        No
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>


                    <div class="row align-items-end">

                        {{-- Sort By --}}
                        <div class="col-md-3">

                            <div class="form-group">

                                <label>Sort By</label>

                                <select name="sort_by" class="form-control">
                                    <option value="id" {{ request('sort_by', 'id') == 'id' ? 'selected' : '' }}>
                                        ID
                                    </option>

                                    <option value="address_title"
                                        {{ request('sort_by') == 'address_title' ? 'selected' : '' }}>
                                        Address Title
                                    </option>

                                    <option value="zip_code" {{ request('sort_by') == 'zip_code' ? 'selected' : '' }}>
                                        Zip Code
                                    </option>

                                    <option value="default_address"
                                        {{ request('sort_by') == 'default_address' ? 'selected' : '' }}>
                                        Default
                                    </option>

                                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>
                                        Created At
                                    </option>

                                </select>

                            </div>

                        </div>

                        {{-- Direction --}}
                        <div class="col-md-2">

                            <div class="form-group">

                                <label>Direction</label>

                                <select name="direction" class="form-control">
                                    <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>
                                        Ascending
                                    </option>

                                    <option value="desc" {{ request('direction', 'desc') == 'desc' ? 'selected' : '' }}>
                                        Descending
                                    </option>

                                </select>

                            </div>

                        </div>

                        {{-- Limit --}}
                        <div class="col-md-2">

                            <div class="form-group">

                                <label>Per Page</label>

                                <select name="limit" class="form-control">
                                    @foreach ([10, 25, 50, 100] as $limit)
                                        <option value="{{ $limit }}"
                                            {{ request('limit', 10) == $limit ? 'selected' : '' }}>
                                            {{ $limit }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                        </div>

                        {{-- Buttons --}}
                        <div class="col-md-5">

                            <div class="form-group">

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                    Search
                                </button>

                                <a href="{{ route('admin.user-address.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-redo"></i>
                                    Reset
                                </a>

                            </div>

                        </div>

                    </div>

                </form>


                {{-- Table --}}
                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>User</th>

                                <th>Title</th>

                                <th>Country</th>

                                <th>Governorate</th>

                                <th>City</th>

                                <th>Default</th>

                                <th>Created At</th>

                                <th width="180">Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($addresses as $address)
                                <tr>

                                    <td>
                                        {{ $address->id }}
                                    </td>

                                    <td>

                                        @if ($address->user)
                                            {{ $address->user->first_name }}
                                            {{ $address->user->last_name }}

                                            <br>

                                            <small class="text-muted">
                                                {{ $address->user->user_name }}
                                            </small>
                                        @else
                                            -
                                        @endif

                                    </td>

                                    <td>
                                        {{ $address->address_title }}
                                    </td>

                                    <td>
                                        {{ $address->country?->name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $address->governorate?->name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $address->city?->name ?? '-' }}
                                    </td>

                                    <td>

                                        @if ($address->default_address)
                                            <span class="badge badge-success">
                                                Default
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">
                                                No
                                            </span>
                                        @endif

                                    </td>

                                    <td>
                                        {{ $address->created_at?->format('Y-m-d H:i') }}
                                    </td>

                                    <td>

                                        <a href="{{ route('admin.user-address.show', $address->id) }}"
                                            class="btn btn-info btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @can('user_address.edit')
                                            <a href="{{ route('admin.user-address.edit', $address->id) }}"
                                                class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan


                                        @can('user_address.delete')
                                            <form action="{{ route('admin.user-address.destroy', $address->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this address?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </form>
                                        @endcan

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="9" class="text-center">
                                        No addresses found.
                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                <div class="d-flex justify-content-center">

                    {{ $addresses->links() }}

                </div>

            </div>

        </div>

    </div>

@endsection
