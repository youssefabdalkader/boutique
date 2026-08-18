@extends('layouts.admin-auth')

@section('title', 'login')

@section('content')

    <body class="bg-gradient-primary">

        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image">

                                </div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        </div>
                                        <form method="POST" action="{{ route('login') }}" class="user">
                                            @csrf
                                            <input type="hidden" name="login_type" value="admin">

                                            <div class="form-group">
                                                <input name="user_name" type="text"
                                                    class="form-control form-control-user" placeholder="Enter Username...">
                                            </div>
                                            @error('user_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="form-group">
                                                <input name="password" type="password"
                                                    class="form-control form-control-user" id="exampleInputPassword"
                                                    placeholder="Password">
                                            </div>
                                            <div class="block mt-4">
                                                <a href="{{ route('login') }}"
                                                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    {{ __('Login as Customer') }}
                                                </a>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Remember
                                                        Me</label>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Login
                                            </button>
                                            <hr>

                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    @endsection
