@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <!-- ضع كل محتوى الصفحة هنا -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">

            @foreach ($products as $product)
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">



                        <a href="{{ route('product.show', $product->id) }}">
                            class="cat-img position-relative overflow-hidden mb-3">

                            @if ($product->cover)
                                <img class="img-fluid" src="{{ asset('storage/' . $product->cover) }}"
                                    alt="{{ $product->name }}">
                            @else
                                <img class="img-fluid" src="{{ asset('frontend/img/cat-1.jpg') }}"
                                    alt="{{ $product->name }}">
                            @endif

                        </a>

                        <h5 class="font-weight-semi-bold m-0">
                            {{ $product->name }}
                        </h5>

                        <button type="button" class="btn btn-primary mt-2">
                            <a href="{{ route('order.create', $product->id) }}" class="btn btn-primary">
                                <i class="fas fa-shopping-cart"></i>
                                Order Now
                            </a>
                        </button>


                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <!-- Categories End -->












    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('frontend/img/vendor-1.jpg') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('frontend/img/vendor-2.jpg') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('frontend/img/vendor-3.jpg') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('frontend/img/vendor-4.jpg') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('frontend/img/vendor-5.jpg') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('frontend/img/vendor-6.jpg') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('frontend/img/vendor-7.jpg') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('frontend/img/vendor-8.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->




    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


@endsection
