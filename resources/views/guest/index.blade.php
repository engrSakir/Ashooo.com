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
                                    <h3 class="text-success"><b>{{ __('Service on Demand') }}</b></h3>
                                    <p>{{ __('Top & Best Service Marketplace in Bangladesh') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Swiper intro ends -->

        <!-- login buttons -->
        <div class="row mx-0">
            <div class="col-12 container text-center small">
                <p>{{ __('সার্ভিস নিতে অথবা সার্ভিস দিতে সাইন-ইন করুন। আপনার কোনো অ্যাকাউন্ট নেই? এখনই সাইন আপ করুন।') }}</p>
                <br>
            </div>
            <div class="col">
                <a href="{{ route('login') }}" class="btn btn-default btn-lg btn-rounded bg-success shadow btn-block">{{ __('Sign in') }}</a>
            </div>
            <div class="col">
                <a href="{{ route('register') }}" class="btn btn-white bg-white btn-lg btn-rounded shadow btn-outline-success btn-block text-success">{{ __('Sign up') }}</a>
            </div>
        </div>
        <!-- login buttons -->
        <hr class="bg-success">
        <div class="row mx-0 container">
            <div class="container text-center mb-5">
                <h3 class="btn btn-default btn-lg btn-rounded shadow my-2"><b>{{ __('লোকাল সার্ভিস অন ডিমান্ড') }}</b></h3>
            </div>
            
        </div>
        <!-- login buttons -->
        <hr>
    </div>
@endsection
