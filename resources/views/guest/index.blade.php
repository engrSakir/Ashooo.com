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
                <p>{{ __('সার্ভিস নিতে অথবা সার্ভিস দিতে সাইন ইন করুন। আপনার কোনো অ্যাকাউন্ট নেই? এখনই সাইন আপ করুন।') }}</p>
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
            <div class="container">
                <div class="text-center">
                    <h3 class="btn btn-default btn-lg btn-rounded shadow my-2"><b>{{ __('লোকাল সার্ভিস অন ডিমান্ড') }}</b></h3>
                </div>
                <div class="card shadow border-0 mb-3">
                    {{--# ১ --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset('assets/mobile/img/icon-pest.png') }}" alt=""></figure>
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
                                <figure class="avatar avatar-60"><img src="{{ asset('assets/mobile/img/icon-box.png') }}" alt=""></figure>
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
                                <figure class="avatar avatar-60"><img src="{{ asset('assets/mobile/img/icon-call.png') }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">মোবাইল ফোনে অর্ডার</h5>
                                <p class="text-mute small">সার্ভিস প্রোভাইডারদের সরাসরি কল করে সার্ভিস অর্ডার করুন।</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="text-center">
                    <h3 class="btn btn-default btn-lg btn-rounded shadow my-2 bg-success"><b>{{ __('ভিডিও টিউটোরিয়াল') }}</b></h3>
                </div>
                <div class="card shadow border-0 mb-3">
                    {{--# ১ --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset('assets/mobile/img/icon-youtube.png') }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">কি কি ধরনের সার্ভিস পাওয়া যাবে</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset('assets/mobile/img/icon-youtube.png') }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">কিভাবে কাস্টমার সার্ভিস গ্রহণ করবে</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset('assets/mobile/img/icon-youtube.png') }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">কিভাবে ওয়ার্কার সার্ভিস প্রদান করবে </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset('assets/mobile/img/icon-youtube.png') }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">কিভাবে মেম্বারশীপ সার্ভিস প্রোভাইডার সার্ভিস প্রদান করবে</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="text-center">
                    <h3 class="btn btn-default btn-lg btn-rounded bg-success shadow my-2"><b>{{ __('কেন "ashooo" সার্ভিস মার্কেটপ্লেস ব্যবহার করবেন? ') }}</b></h3>
                </div>
                <div class="card shadow border-0 mb-3">
                    {{--# ১ --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset('assets/mobile/img/icon-ok.png') }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">লোকাল সার্ভিস</h5>
                                <p class="text-mute small">উপজেলা/মেট্রোপলিটন থানা ভিত্তিক লোকাল এরিয়াতে লোকাল ওয়ার্কার দ্বারা সার্ভিস প্রদান।</p>
                            </div>
                        </div>
                    </div>
                    {{--# ২ --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset('assets/mobile/img/icon-ok.png') }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">নমনীয় বাজেট প্রাইস</h5>
                                <p class="text-mute small">প্রয়োজন অনুযায়ী কাজের/অর্ডারের মূল্য পরিবর্তনযোগ্য।</p>
                            </div>
                        </div>
                    </div>
                    {{--# ৩ --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset('assets/mobile/img/icon-ok.png') }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">ক্যাশ অন ডেলিভারি</h5>
                                <p class="text-mute small">কাজ/অর্ডার কমপ্লিট করার পর সরাসরি নগদ টাকা পেমেন্ট করার সুবিধা।</p>
                            </div>
                        </div>
                    </div>
                    {{--# ৪ --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset('assets/mobile/img/icon-ok.png') }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">নিরাপত্তা ও বিশ্বাসযোগ্যতা</h5>
                                <p class="text-mute small">কাস্টমারের নিরাপত্তার স্বার্থে ওয়ার্কার ও মেম্বারশীপ সার্ভিস প্রোভাইডারদের এন.আই.ডি সহ প্রয়োজনীয় ডকুমেন্ট সংরক্ষণ। কাজের পারফরমেন্স অনুযায়ী ওয়ার্কারদের রেটিং প্রদান।</p>
                            </div>
                        </div>
                    </div>
                    {{--# ৫ --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset('assets/mobile/img/icon-ok.png') }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">সাপোর্ট</h5>
                                <p class="text-mute small">২৪/৭ ডেডিকেটেড লোকাল এরিয়া ভিত্তিক সাপোর্ট টিম। গুরুত্বসহকারে অভিযোগ বা সমস্যার সমাধান।</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="text-center">
                    <h3 class="btn btn-default col-12 btn-lg btn-rounded shadow my-2"><b>{{ __('Upcoming Services') }}</b></h3>
                </div>
                <div class="text-center">
                    <h3 class="btn btn-default col-12 btn-lg btn-rounded shadow my-2 bg-success"><b>{{ __('এসক্রো সার্ভিস') }}</b></h3>
                </div>
                <div class="text-center">
                    <h3 class="btn btn-default col-12 btn-lg btn-rounded shadow my-2 bg-success"><b>{{ __('ড্রপশিপিং সার্ভিস') }}</b></h3>
                </div>
            </div>
        </div>
        <hr>
    </div>
@endsection
