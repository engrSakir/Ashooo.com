@extends('customer.layout.app')
@push('title') Profile @endpush
@push('head')

@endpush
@section('content')
    <div class="container">
        <div class="card bg-template shadow mt-4 h-190">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        <figure class="avatar avatar-60 border-0"><img src="{{ asset(auth()->user()->image ?? 'uploads/images/defaults/user.png') }}" alt=""></figure>
                    </div>
                    <div class="col pl-0 align-self-center">
                        <h5 class="mb-1">{{ auth()->user()->full_name }}</h5>
                        <p class="font-weight-normal">
                            <span class="badge shadow bg-white small">
                             @php
                                 $percent = 100 - ((auth()->user()->rating->max_rate - auth()->user()->rating->rate)/auth()->user()->rating->max_rate)*100;
                                 if ($percent>80)
                                     $star = 5;
                                 else if ($percent>60)
                                     $star = 4;
                                 else if ($percent>40)
                                     $star = 3;
                                 else if ($percent>20)
                                     $star = 2;
                                 else if ($percent>1)
                                     $star = 1;
                                 else
                                     $star = 0;
                             @endphp

                                    @for ($starCounter = 1; $starCounter <= $star; $starCounter++)
                                        <i class="material-icons disabled btn-outline-warning">star</i>
                                    @endfor
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container top-100">
        <div class="card mb-4 shadow">
            <div class="card-body border-bottom">
                <div class="row">
                    <div class="col text-center">
                        <h3 class="mb-0 font-weight-normal">
                            {{ auth()->user()->referral->own }}
                        </h3>
                        <p class="text-mute">Referral</p>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-none">
                <div class="row">
                    <div class="col-6 text-center">
                        <div class="card{{-- shadow border-0 bg-template --}}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col align-self-center">
                                        <h5 class="mb-2 font-weight-normal">{{ auth()->user()->balance->referral_income }}</h5>
                                        <p class="text-mute">Referral Income</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 text-center">
                        <div class="card{{-- shadow border-0 bg-template --}}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col align-self-center">
                                        <h5 class="mb-2 font-weight-normal">{{ auth()->user()->balance->withdrawn }}</h5>
                                        <p class="text-mute">Withdrawn Amount</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="swiper-container icon-slide mb-4 swiper-container-horizontal">
                <div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
                    <a href="#" class="swiper-slide text-center swiper-slide-active" data-toggle="modal" data-target="#sendmoney">
                        <div class="avatar avatar-60 no-shadow border-0">
                            <div class="overlay bg-template"></div>
                            <i class="material-icons text-template">send</i>
                        </div>
                        <p class="small mt-2">Withdraw Request</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h6 class="subtitle text-center"> Useful Function </h6>
        <div class="list-group list-group-flush">
            @foreach(get_all_static_pages() as $page)
                <a href="javaScript:void();" class="list-group-item" data-toggle="modal" data-target="#{{ $page->slug }}">
                    <h6 class="text-dark mb-0 font-weight-normal">@if(current_language() == 'bn') {{ $page->bn_name }} @else {{ $page->en_name }} @endif <i class="material-icons float-right">chevron_right</i></h6>
                </a>
            @endforeach
            <a href="javaScript:void();" onclick="logout()" class="list-group-item bg-dark text-white">
                <h6 class="text-white mb-0 font-weight-normal">Logout <i class="material-icons float-right">chevron_right</i></h6>
            </a>
        </div>
    </div>
<script>
    $(document).ready(function() {

    });

</script>
@endsection

