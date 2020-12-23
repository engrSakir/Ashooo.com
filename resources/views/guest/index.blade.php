@extends('guest.layout')

@section('content')
    <div class="wrapper">
        <!-- Swiper intro -->
        <div class="swiper-container introduction pt-5">
            <div class="swiper-wrapper">
                <div class="swiper-slide overflow-hidden text-center">
                    <div class="row no-gutters">
                        <div class="col align-self-center px-3">
                            <img src="{{ asset( get_static_option('logo')  ?? 'uploads/images/defaults/logo.png') }}" alt="" class="mx-100 my-5">
                            <div class="row">
                                <div class="container mb-5">
                                    <h4>{{ __('Welcome to digital world') }}</h4>
                                    <p>{{ __('Best service marketplace in bangladesh.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Swiper intro ends -->

        <!-- login buttons -->
        <div class="row mx-0 bottom-button-container">
            <div class="col">
                <a href="{{ route('login') }}" class="btn btn-default btn-lg btn-rounded shadow btn-block">{{ __('Login') }}</a>
            </div>
            <div class="col">
                <a href="{{ route('register') }}" class="btn btn-white bg-white btn-lg btn-rounded shadow btn-block">{{ __('Register') }}</a>
            </div>
        </div>
        <!-- login buttons -->
    </div>
@endsection
