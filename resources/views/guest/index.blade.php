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
        <div class="row mx-0">
            <div class="container text-center mb-5">
                <h3 class="btn btn-default btn-lg btn-rounded shadow my-2"><b>{{ __('লোকাল সার্ভিস অন ডিমান্ড') }}</b></h3>
            </div>
            <div class="container">
                <div class="card shadow border-0 mb-3">
                    {{--# ১ --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset( get_static_option('logo')  ?? 'uploads/images/defaults/logo.png') }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">জব পোস্ট ও অর্ডার</h5>
                                <p class="text-mute small">প্রয়োজন অনুযায়ী কাজের পোষ্ট দিন এবং বিড সমূহ থেকে বেস্ট ওয়ার্কার নির্বাচন করে কাজের জন্য অর্ডার করুন।</p>
                            </div>
                        </div>
                    </div>
                    {{--# ২ --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset( get_static_option('logo')  ?? 'uploads/images/defaults/logo.png') }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">গিগ অর্ডার</h5>
                                <p class="text-mute small">প্রয়োজন অনুযায়ী ওয়ার্কারদের গিগ নির্বাচন করে কাজের জন্য অর্ডার করুন।</p>
                            </div>
                        </div>
                    </div>
                    {{--# ৩ --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset( get_static_option('logo')  ?? 'uploads/images/defaults/logo.png') }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">মোবাইল ফোনে অর্ডার</h5>
                                <p class="text-mute small">সার্ভিস প্রোভাইডারদের সরাসরি কল করে সার্ভিস অর্ডার করুন।</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container text-center mb-5">
                <h3 class="btn btn-default btn-lg btn-rounded shadow my-2 bg-success"><b>{{ __('ভিডিও টিউটোরিয়াল') }}</b></h3>
            </div>
        </div>
        <!-- login buttons -->
        <hr>
    </div>
@endsection
