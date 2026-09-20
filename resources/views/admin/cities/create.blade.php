@extends('layouts.admin')

@section('title', 'Create City')

@section('content')

    <div class="card shadow">

        <div class="card-header">
            <h4 class="mb-0">Create City</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.city.store') }}" method="POST">

                @csrf


                <div class="form-group mb-3">

                    <label>Name</label>

                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}">

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="form-group mb-3">

                    <label>Governorate</label>

                    <select name="governorate_id" class="form-control @error('governorate_id') is-invalid @enderror">

                        <option value="">
                            Select Governorate
                        </option>

                        @foreach ($governorates as $governorate)
                            <option value="{{ $governorate->id }}" @selected(old('governorate_id') == $governorate->id)>

                                {{ $governorate->name }}

                            </option>
                        @endforeach

                    </select>

                    @error('governorate_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="form-group mb-4">

                    <label>Status</label>

                    <select name="status" class="form-control @error('status') is-invalid @enderror">

                        <option value="1" @selected(old('status', 1) == 1)>
                            Active
                        </option>

                        <option value="0" @selected(old('status') == 0)>
                            Inactive
                        </option>

                    </select>

                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <button class="btn btn-success">

                    <i class="fas fa-save"></i>
                    Save

                </button>


                <a href="{{ route('admin.city.index') }}" class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

@endsection
