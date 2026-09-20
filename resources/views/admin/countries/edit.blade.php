@extends('layouts.admin')

@section('title', 'Edit Country')

@section('content')

    <div class="card shadow">

        <div class="card-header">
            <h4 class="mb-0">Edit Country</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.country.update', $country->id) }}" method="POST">

                @csrf

                @method('PUT')

                <div class="form-group mb-3">

                    <label>Name</label>

                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $country->name) }}">

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="form-group mb-4">

                    <label>Status</label>

                    <select name="status" class="form-control @error('status') is-invalid @enderror">

                        <option value="1" @selected(old('status', $country->status) == 1)>
                            Active
                        </option>

                        <option value="0" @selected(old('status', $country->status) == 0)>
                            Inactive
                        </option>

                    </select>

                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <button class="btn btn-warning">

                    <i class="fas fa-save"></i>
                    Update

                </button>


                <a href="{{ route('admin.country.index') }}" class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

@endsection
