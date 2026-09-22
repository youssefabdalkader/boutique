@extends('layouts.admin')

@section('title', 'Shipping Companies')

@section('content')

    {{-- Success --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>

        </div>
    @endif


    {{-- Error --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">

            {{ session('error') }}

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>

        </div>
    @endif


    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Shipping Companies
            </h5>

            @if (auth()->user()->can('shipping_company.create'))
                <a href="{{ route('admin.shipping-company.create') }}" class="btn btn-primary btn-sm">

                    <i class="fas fa-plus"></i>

                    Add Shipping Company

                </a>
            @endif

        </div>


        <div class="card-body">


            {{-- Filters --}}
            <form method="GET" action="{{ route('admin.shipping-company.index') }}" class="mb-4">

                <div class="row">

                    {{-- Search --}}
                    <div class="col-md-4 mb-3">

                        <label>Search</label>

                        <input type="text" name="search" class="form-control" placeholder="Name, Code or Description"
                            value="{{ request('search') }}">

                    </div>


                    {{-- Status --}}
                    <div class="col-md-2 mb-3">

                        <label>Status</label>

                        <select name="status" class="form-control">

                            <option value="">
                                All
                            </option>

                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>


                    {{-- Fast --}}
                    <div class="col-md-2 mb-3">

                        <label>Fast</label>

                        <select name="fast" class="form-control">

                            <option value="">
                                All
                            </option>

                            <option value="1" {{ request('fast') === '1' ? 'selected' : '' }}>
                                Yes
                            </option>

                            <option value="0" {{ request('fast') === '0' ? 'selected' : '' }}>
                                No
                            </option>

                        </select>

                    </div>


                    {{-- Limit --}}
                    <div class="col-md-2 mb-3">

                        <label>Per Page</label>

                        <select name="limit" class="form-control">

                            @foreach ([10, 25, 50, 100] as $limit)
                                <option value="{{ $limit }}" {{ request('limit', 10) == $limit ? 'selected' : '' }}>
                                    {{ $limit }}
                                </option>
                            @endforeach

                        </select>

                    </div>


                    {{-- Buttons --}}
                    <div class="col-md-2 mb-3 d-flex align-items-end">

                        <button class="btn btn-primary mr-2">

                            <i class="fas fa-search"></i>

                            Search

                        </button>

                        <a href="{{ route('admin.shipping-company.index') }}" class="btn btn-secondary">

                            <i class="fas fa-sync"></i>

                        </a>

                    </div>

                </div>

            </form>


            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th width="60">
                                #
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                Code
                            </th>

                            <th>
                                Description
                            </th>

                            <th>
                                Cost
                            </th>

                            <th>
                                Countries
                            </th>

                            <th>
                                Fast
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="230" class="text-center">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($shippingCompanies as $shippingCompany)

                            <tr>

                                <td>
                                    {{ $shippingCompanies->firstItem() + $loop->index }}
                                </td>


                                <td>
                                    {{ $shippingCompany->name }}
                                </td>


                                <td>
                                    {{ $shippingCompany->code }}
                                </td>


                                <td>
                                    {{ $shippingCompany->description }}
                                </td>


                                <td>
                                    {{ $shippingCompany->cost }}
                                </td>


                                <td>

                                    @forelse ($shippingCompany->countries as $country)
                                        <span class="badge badge-info mb-1">
                                            {{ $country->name }}
                                        </span>

                                    @empty

                                        <span class="text-muted">
                                            No countries
                                        </span>
                                    @endforelse

                                </td>


                                <td>

                                    @if ($shippingCompany->fast)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif

                                </td>


                                <td>

                                    @if ($shippingCompany->status)
                                        <span class="badge badge-success">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            Inactive
                                        </span>
                                    @endif

                                </td>


                                <td class="text-center">

                                    @if (auth()->user()->can('shipping_company.edit'))
                                        <a href="{{ route('admin.shipping-company.edit', $shippingCompany->id) }}"
                                            class="btn btn-warning btn-sm">

                                            <i class="fas fa-edit"></i>

                                            Edit

                                        </a>
                                    @endif


                                    <a href="{{ route('admin.shipping-company.show', $shippingCompany->id) }}"
                                        class="btn btn-info btn-sm">

                                        <i class="fas fa-eye"></i>

                                        Show

                                    </a>


                                    @if (auth()->user()->can('shipping_company.delete'))
                                        <form action="{{ route('admin.shipping-company.destroy', $shippingCompany->id) }}"
                                            method="POST" class="d-inline">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this shipping company?')">

                                                <i class="fas fa-trash"></i>

                                                Delete

                                            </button>

                                        </form>
                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="text-center text-muted">

                                    No shipping companies found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <div class="mt-3">

                {{ $shippingCompanies->links() }}

            </div>

        </div>

    </div>

@endsection
