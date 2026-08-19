@extends('layouts.app')

@section('title', 'Order')

@section('content')

    <div class="container-fluid pt-5 pb-5">

        <div class="row px-xl-5">

            <div class="col-lg-6 mb-4">

                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white">
                        <h5 class="mb-0">Product Details</h5>
                    </div>

                    <div class="card-body">

                        {{-- Product Image --}}
                        <div class="text-center mb-4">

                            @if ($product->cover)
                                <img src="{{ asset('storage/' . $product->cover) }}" alt="{{ $product->name }}"
                                    class="img-fluid" style="max-height: 350px;">
                            @else
                                <img src="{{ asset('frontend/img/product-1.jpg') }}" alt="{{ $product->name }}"
                                    class="img-fluid" style="max-height: 350px;">
                            @endif

                        </div>

                        {{-- Product Name --}}
                        <h3 class="font-weight-semi-bold">
                            {{ $product->name }}
                        </h3>

                        {{-- Description --}}
                        <p class="text-muted">
                            {{ $product->description }}
                        </p>

                        {{-- Price --}}
                        <h4 class="text-primary">
                            ${{ number_format($product->price, 2) }}
                        </h4>

                    </div>

                </div>

            </div>




        </div>

    </div>

@endsection
