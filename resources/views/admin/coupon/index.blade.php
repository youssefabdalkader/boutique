@extends('layouts.admin')

@section('title', 'Coupons')

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


    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Coupons</h5>
            @if (auth()->user()->can('coupon.create'))
                <a href="{{ route('admin.coupon.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add Coupon
                </a>
            @endif

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="70">#</th>
                            <th>code</th>
                            <th>description</th>
                            <th>use times</th>
                            <th>value</th>
                            <th>greater than</th>
                            <th>starts_at</th>
                            <th>expires_at</th>
                            <th>status</th>

                            <th width="200" class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($coupons as $coupon)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->description }}</td>
                                <td>{{ $coupon->used_times }} / {{ $coupon->use_times }}</td>
                                <td>{{ $coupon->value }} {{ $coupon->type == 'fixed' ? '$' : '%' }}</td>
                                <td>{{ $coupon->greater_than }}</td>
                                <td>{{ $coupon->starts_at }}</td>
                                <td>{{ $coupon->expires_at }}</td>
                                <td>
                                    @if ($coupon->status)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>


                                <td class="text-center">
                                    @if (auth()->user()->can('coupon.edit'))
                                        <a href="{{ route('admin.coupon.edit', $coupon->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.coupon.show', $coupon->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Show
                                    </a>
                                    @if (auth()->user()->can('coupon.delete'))
                                        <form action="{{ route('admin.coupon.destroy', $coupon->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this coupon?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">
                                    No coupons found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">
                                {{ $coupons->links() }}
                            </td>
                        </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
