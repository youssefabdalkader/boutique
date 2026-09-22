@extends('layouts.admin')

@section('title', 'Shipping Company Details')

@section('content')

    <div class="card shadow">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                Shipping Company Details
            </h4>

            <div>

                <a href="{{ route('admin.shipping-company.edit', $shippingCompany->id) }}" class="btn btn-warning btn-sm">

                    <i class="fas fa-edit"></i>

                    Edit

                </a>


                <a href="{{ route('admin.shipping-company.index') }}" class="btn btn-secondary btn-sm">

                    <i class="fas fa-arrow-left"></i>

                    Back

                </a>

            </div>

        </div>


        <div class="card-body">

            <table class="table table-bordered">

                <tbody>

                    {{-- ID --}}
                    <tr>

                        <th width="200">
                            ID
                        </th>

                        <td>
                            {{ $shippingCompany->id }}
                        </td>

                    </tr>


                    {{-- Name --}}
                    <tr>

                        <th>
                            Name
                        </th>

                        <td>
                            {{ $shippingCompany->name }}
                        </td>

                    </tr>


                    {{-- Code --}}
                    <tr>

                        <th>
                            Code
                        </th>

                        <td>
                            {{ $shippingCompany->code }}
                        </td>

                    </tr>


                    {{-- Description --}}
                    <tr>

                        <th>
                            Description
                        </th>

                        <td>
                            {{ $shippingCompany->description }}
                        </td>

                    </tr>


                    {{-- Cost --}}
                    <tr>

                        <th>
                            Cost
                        </th>

                        <td>
                            {{ $shippingCompany->cost }}
                        </td>

                    </tr>


                    {{-- Countries --}}
                    <tr>

                        <th>
                            Countries
                        </th>

                        <td>

                            @if ($shippingCompany->countries->isNotEmpty())

                                @foreach ($shippingCompany->countries as $country)
                                    <span class="badge badge-info mr-1">
                                        {{ $country->name }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-muted">
                                    No countries associated.
                                </span>

                            @endif

                        </td>

                    </tr>


                    {{-- Fast --}}
                    <tr>

                        <th>
                            Fast Shipping
                        </th>

                        <td>

                            @if ($shippingCompany->fast)
                                <span class="badge badge-success">

                                    <i class="fas fa-check"></i>

                                    Yes

                                </span>
                            @else
                                <span class="badge badge-danger">

                                    <i class="fas fa-times"></i>

                                    No

                                </span>
                            @endif

                        </td>

                    </tr>


                    {{-- Status --}}
                    <tr>

                        <th>
                            Status
                        </th>

                        <td>

                            @if ($shippingCompany->status)
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


                    {{-- Created --}}
                    <tr>

                        <th>
                            Created At
                        </th>

                        <td>
                            {{ $shippingCompany->created_at->format('d M Y h:i A') }}
                        </td>

                    </tr>


                    {{-- Updated --}}
                    <tr>

                        <th>
                            Updated At
                        </th>

                        <td>
                            {{ $shippingCompany->updated_at->format('d M Y h:i A') }}
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

@endsection
