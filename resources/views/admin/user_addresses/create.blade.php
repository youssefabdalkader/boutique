@extends('layouts.admin')

@section('title', 'Create User Address')

@section('content')

    <div class="container-fluid">

        <div class="card shadow">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    Create User Address
                </h3>
            </div>

            <div class="card-body">

                <form action="{{ route('admin.user-address.store') }}" method="POST">

                    @csrf

                    <div class="row">

                        {{-- User --}}
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="user_id">
                                    User <span class="text-danger">*</span>
                                </label>

                                <select name="user_id" id="user_id"
                                    class="form-control @error('user_id') is-invalid @enderror">
                                    <option value="">Select User</option>

                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->first_name }}
                                            {{ $user->last_name }}
                                            - {{ $user->user_name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Address Title --}}
                        <div class="col-md-6">
                            <div class="form-group mb-3">

                                <label for="address_title">
                                    Address Title
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text" name="address_title" id="address_title"
                                    class="form-control @error('address_title') is-invalid @enderror"
                                    value="{{ old('address_title', 'main') }}" placeholder="Example: Home">

                                @error('address_title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>

                        {{-- Country --}}
                        <div class="col-md-4">
                            <div class="form-group mb-3">

                                <label for="country_id">
                                    Country
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="country_id" id="country_id"
                                    class="form-control @error('country_id') is-invalid @enderror">
                                    <option value="">
                                        Select Country
                                    </option>

                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"
                                            {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('country_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>

                        {{-- Governorate --}}
                        <div class="col-md-4">
                            <div class="form-group mb-3">

                                <label for="governorate_id">
                                    Governorate
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="governorate_id" id="governorate_id"
                                    class="form-control @error('governorate_id') is-invalid @enderror" disabled>
                                    <option value="">
                                        Select Governorate
                                    </option>
                                </select>

                                @error('governorate_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>

                        {{-- City --}}
                        <div class="col-md-4">
                            <div class="form-group mb-3">

                                <label for="city_id">
                                    City
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="city_id" id="city_id"
                                    class="form-control @error('city_id') is-invalid @enderror" disabled>
                                    <option value="">
                                        Select City
                                    </option>
                                </select>

                                @error('city_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="col-md-6">
                            <div class="form-group mb-3">

                                <label for="address">
                                    Address
                                </label>

                                <input type="text" name="address" id="address"
                                    class="form-control @error('address') is-invalid @enderror"
                                    value="{{ old('address') }}" placeholder="Address">

                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>

                        {{-- Address 2 --}}
                        <div class="col-md-6">
                            <div class="form-group mb-3">

                                <label for="address2">
                                    Address 2
                                </label>

                                <input type="text" name="address2" id="address2"
                                    class="form-control @error('address2') is-invalid @enderror"
                                    value="{{ old('address2') }}" placeholder="Address 2">

                                @error('address2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>

                        {{-- Zip Code --}}
                        <div class="col-md-6">
                            <div class="form-group mb-3">

                                <label for="zip_code">
                                    Zip Code
                                </label>

                                <input type="text" name="zip_code" id="zip_code"
                                    class="form-control @error('zip_code') is-invalid @enderror"
                                    value="{{ old('zip_code') }}">

                                @error('zip_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>

                        {{-- PO Box --}}
                        <div class="col-md-6">
                            <div class="form-group mb-3">

                                <label for="po_box">
                                    PO Box
                                </label>

                                <input type="text" name="po_box" id="po_box"
                                    class="form-control @error('po_box') is-invalid @enderror" value="{{ old('po_box') }}">

                                @error('po_box')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>

                        {{-- Default Address --}}
                        <div class="col-md-12">
                            <div class="form-group mb-4">

                                <div class="custom-control custom-checkbox">

                                    <input type="checkbox" name="default_address" value="1" id="default_address"
                                        class="custom-control-input" {{ old('default_address') ? 'checked' : '' }}>

                                    <label class="custom-control-label" for="default_address">
                                        Default Address
                                    </label>

                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="d-flex justify-content-between">

                        <a href="{{ route('admin.user-address.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            Back
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Save
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection


@push('scripts')
    <script>
        $(document).ready(function() {

            const countrySelect = $('#country_id');
            const governorateSelect = $('#governorate_id');
            const citySelect = $('#city_id');

            /*
             * Country changed
             */
            countrySelect.on('change', function() {

                let countryId = $(this).val();

                // Reset governorate
                governorateSelect
                    .html('<option value="">Select Governorate</option>')
                    .prop('disabled', true);

                // Reset city
                citySelect
                    .html('<option value="">Select City</option>')
                    .prop('disabled', true);

                if (!countryId) {
                    return;
                }

                $.ajax({
                    url: "{{ url('admin/user-address/governorates') }}/" + countryId,
                    type: "GET",

                    success: function(governorates) {

                        governorates.forEach(function(governorate) {

                            governorateSelect.append(
                                `<option value="${governorate.id}">
                                ${governorate.name}
                            </option>`
                            );

                        });

                        governorateSelect.prop('disabled', false);
                    },

                    error: function() {

                        alert('Unable to load governorates.');

                    }
                });

            });


            /*
             * Governorate changed
             */
            governorateSelect.on('change', function() {

                let governorateId = $(this).val();

                citySelect
                    .html('<option value="">Select City</option>')
                    .prop('disabled', true);

                if (!governorateId) {
                    return;
                }

                $.ajax({
                    url: "{{ url('admin/user-address/cities') }}/" + governorateId,
                    type: "GET",

                    success: function(cities) {

                        cities.forEach(function(city) {

                            citySelect.append(
                                `<option value="${city.id}">
                                ${city.name}
                            </option>`
                            );

                        });

                        citySelect.prop('disabled', false);
                    },

                    error: function() {

                        alert('Unable to load cities.');

                    }
                });

            });

        });
    </script>
@endpush
