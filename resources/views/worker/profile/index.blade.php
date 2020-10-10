@extends('worker.layout.app')
@push('title') More @endpush
@push('head')

@endpush
@section('content')
    <div class="container">
        <div class="card bg-template shadow mt-4 h-190">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        <figure class="avatar avatar-60"><img src="{{ asset('uploads/images/users/'.auth()->user()->image) }}" alt=""></figure>
                    </div>
                    <div class="col pl-0 align-self-center">
                        <h5 class="mb-1">{{ auth()->user()->full_name }}</h5>
                        <p class="font-weight-normal">
                            <span class="badge badge-success small">
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
                        <div class="card shadow border-0 bg-template">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col align-self-center">
                                        <h5 class="mb-2 font-weight-normal">{{ auth()->user()->balance->job_income }}</h5>
                                        <p class="text-mute">Job Income</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 text-center">
                        <div class="card shadow border-0 bg-template">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col align-self-center">
                                        <h5 class="mb-2 font-weight-normal">{{ auth()->user()->balance->due }}</h5>
                                        <p class="text-mute">Due Amount</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-none">
                <div class="row">
                    <div class="col-6 text-center">
                        <div class="card shadow border-0 bg-template">
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
                        <div class="card shadow border-0 bg-template">
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
                    <a href="#" class="swiper-slide text-center swiper-slide-prev" data-toggle="modal" data-target="#paymodal">
                        <div class="avatar avatar-60 no-shadow border-0">
                            <div class="overlay bg-template"></div>
                            <i class="material-icons text-template">local_atm</i>
                        </div>
                        <p class="small mt-2">Due Pay</p>
                    </a>
                    <a href="#" class="swiper-slide text-center swiper-slide-active" data-toggle="modal" data-target="#sendmoney">
                        <div class="avatar avatar-60 no-shadow border-0">
                            <div class="overlay bg-template"></div>
                            <i class="material-icons text-template">send</i>
                        </div>
                        <p class="small mt-2">Withdraw</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h6 class="subtitle text-center"> Useful Function </h6>
            <div class="list-group list-group-flush">
                <a href="javaScript:void();" class="list-group-item">
                    <h6 class="text-dark mb-0 font-weight-normal">Favorite <i class="material-icons float-right">chevron_right</i></h6>
                </a>
                <a href="javaScript:void();" class="list-group-item">
                    <h6 class="text-dark mb-0 font-weight-normal offer-modal-btn">Offers <i class="material-icons float-right">chevron_right</i></h6>
                </a>
                <a href="javaScript:void();" class="list-group-item">
                    <h6 class="text-dark mb-0 font-weight-normal referral-income-system-btn">Referral income system <i class="material-icons float-right">chevron_right</i></h6>
                </a>
                <a href="javaScript:void();" class="list-group-item">
                    <h6 class="text-dark mb-0 font-weight-normal video-training-btn">Video training <i class="material-icons float-right">chevron_right</i></h6>
                </a>
                <a href="javaScript:void();" class="list-group-item">
                    <h6 class="text-dark mb-0 font-weight-normal help-line-btn">Help line <i class="material-icons float-right">chevron_right</i></h6>
                </a>
                <a href="javaScript:void();" class="list-group-item">
                    <h6 class="text-dark mb-0 font-weight-normal about-btn">About <i class="material-icons float-right">chevron_right</i></h6>
                </a>
                <a href="javaScript:void();" class="list-group-item">
                    <h6 class="text-dark mb-0 font-weight-normal faq-btn">FAQ <i class="material-icons float-right">chevron_right</i></h6>
                </a>
                <a href="javaScript:void();" class="list-group-item">
                    <h6 class="text-dark mb-0 font-weight-normal terms-and-condition-btn">Terms and condition <i class="material-icons float-right">chevron_right</i></h6>
                </a>
                <a href="javaScript:void();" class="list-group-item">
                    <h6 class="text-dark mb-0 font-weight-normal privacy-policy-btn">Privacy policy <i class="material-icons float-right">chevron_right</i></h6>
                </a>
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

