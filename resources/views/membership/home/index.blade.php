@extends('membership.layout.app')
@push('title') Home @endpush
@section('content')
    @if(!auth()->user()->membership))
        <!-- Start title -->
        <div class="">
            <div class="alert alert-info text-center" role="alert">
                <b id=""> MEMBERSHIP PACKAGES </b>
            </div>
        </div>
        <!-- End title -->
    <div class="container">
        @foreach($packages as $package)
            <div class="alert alert-dark shadow-dark" role="alert">
                <h4 class="alert-heading name">{{ $package->name }}</h4>
               <div class="row text-center">
                   <div class="col-6 bg-warning "><b class="three_month_price">{{ $package->three_month_price }} ৳</b>/ <br> 3 Month</div>
                   <input type="hidden" class="six_month_price" value="{{ $package->six_month_price }} ৳">
                   <div class="col-6 bg-danger "><b class="twelve_month_price">{{ $package->twelve_month_price }} ৳</b>/ <br>12 Month</div>
               </div>
                <hr>
                <div class="row package-detail">
                    <div class="col-8">
                        <li>Mobile number</li>
                        <li>Description</li>
                        <li>Images</li>
                        <li>Rank</li>
                    </div>
                    <div class="col-4">
                        @if($package->mobile_availability == 1)
                            <span class="badge badge-success shadow-success m-1">Yes</span>
                        @else
                            <span class="badge badge-danger shadow-danger m-1">No</span>
                        @endif
                            <br>
                        @if($package->description_availability == 1)
                            <span class="badge badge-success shadow-success m-1">Yes</span>
                        @else
                            <span class="badge badge-danger shadow-danger m-1">No</span>
                        @endif
                            <br>
                        <span class="badge badge-success shadow-success m-1">{{ $package->image_count }}</span>
                            <br>
                        <span class="badge badge-success shadow-success m-1">{{ $package->position }}</span>
                    </div>
                </div>
                <hr>
                <p class="mb-0 text-center">
                    <button type="button" value="{{ $package->id }}" class="mb-2 btn btn-sm btn-success select-package-btn">SELECT</button>
                </p>
            </div>
        @endforeach
    </div>
    @else
        <!-- Start title -->
        <div class="">
            <div class="alert alert-info text-center" role="alert">
                <b id=""> My PACKAGE </b>
            </div>
        </div>
        <!-- End title -->
        <div class="alert" role="">
            <h4 class="alert-heading">{{ auth()->user()->membership->membershipPackage->name }}</h4>
            <div class="row package-detail">
                <div class="col-8">
                    <li>Mobile number</li>
                    <li>Description</li>
                    <li>Images</li>
                    <li>Rank</li>
                </div>
                <div class="col-4">
                    @if(auth()->user()->membership->membershipPackage->mobile_availability == 1)
                        <span class="badge badge-success shadow-success m-1">Yes</span>
                    @else
                        <span class="badge badge-danger shadow-danger m-1">No</span>
                    @endif
                    <br>
                    @if(auth()->user()->membership->membershipPackage->description_availability == 1)
                        <span class="badge badge-success shadow-success m-1">Yes</span>
                    @else
                        <span class="badge badge-danger shadow-danger m-1">No</span>
                    @endif
                    <br>
                    <span class="badge badge-success shadow-success m-1">{{ auth()->user()->membership->membershipPackage->image_count }}</span>
                    <br>
                    <span class="badge badge-success shadow-success m-1">{{ auth()->user()->membership->membershipPackage->position }}</span>
                </div>
            </div>
            <hr>
            <h4 class="alert-heading">{{ 'Duration' }}</h4>
            <div class="row package-detail">
                <div class="col-7 bg-warning">
                    <li>Duration</li>
                    <li>Start/Renew</li>
                    <li>Ending Date</li>
                </div>
                <div class="col-5">
                    <span class="badge badge-success shadow-success m-1">{{ auth()->user()->membership->duration }} months</span>
                    <br>
                    <span class="badge badge-success shadow-success m-1">{{ auth()->user()->membership->created_at->format('d/m/Y') }}</span>
                    <br>
                    <span class="badge badge-success shadow-success m-1">{{  date('d/m/Y', strtotime(auth()->user()->membership->ending_at)) }}</span>
                </div>
            </div>
            <hr>
            <h4 class="alert-heading">{{ 'Update' }}</h4>
            <div class="row package-detail">
                <div class="col-7 bg-warning">
                    <li>Duration</li>
                    <li>Start/Renew</li>
                    <li>Ending Date</li>
                </div>
                <div class="col-5">
                    <span class="badge badge-success shadow-success m-1">{{ auth()->user()->membership->duration }} months</span>
                    <br>
                    <span class="badge badge-success shadow-success m-1">{{ auth()->user()->membership->created_at->format('d/m/Y') }}</span>
                    <br>
                    <span class="badge badge-success shadow-success m-1">{{  date('d/m/Y', strtotime(auth()->user()->membership->ending_at)) }}</span>
                </div>
            </div>
            <hr>
            <h4 class="alert-heading">{{ 'Change Package' }}</h4>
            <div class="row package-detail">
                <div class="col-7 bg-warning">
                    <li>Duration</li>
                    <li>Start/Renew</li>
                    <li>Ending Date</li>
                </div>
                <div class="col-5">
                    <span class="badge badge-success shadow-success m-1">{{ auth()->user()->membership->duration }} months</span>
                    <br>
                    <span class="badge badge-success shadow-success m-1">{{ auth()->user()->membership->created_at->format('d/m/Y') }}</span>
                    <br>
                    <span class="badge badge-success shadow-success m-1">{{  date('d/m/Y', strtotime(auth()->user()->membership->ending_at)) }}</span>
                </div>
            </div>
        </div>
            <hr>
        <!-- Start admin notice box -->
        @foreach($adminNotice as $adminNotice)
            <section class="jumbotron text-center mt-3 bg-white shadow-sm">
                <div class="container">
                    <p class="lead">{{ $adminNotice->title }}</p>
                    <p class="text-secondary text-mute small"> {{ $adminNotice->detail }} </p>
                </div>
            </section>
        @endforeach
        <!-- End admin notice box -->
        <!-- Start controller notice box -->
        @foreach(auth()->user()->upazila->controllers as $controller)
            @foreach($controller->controllerNotice as $controllerNotice)
                <section class="jumbotron text-center mt-3 bg-white shadow-sm">
                    <div class="container">
                        <div class="container">
                            <p class="lead">{{ $controllerNotice->title }}</p>
                            <p class="text-secondary text-mute small">{{ $controllerNotice->detail }}</p>
                        </div>
                    </div>
                </section>
            @endforeach
        @endforeach
            <!-- Start top ads. by controller this upazila -->
            <div class="swiper-container offer-slide swiper-container-horizontal swiper-container-android">
                <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                    @foreach(auth()->user()->upazila->controllers as $controller)
                        @foreach($controller->controllerAds as $controllerAds)
                            <div class="swiper-slide swiper-slide-active">
                                <div class="card shadow border-0 bg-template">
                                    <div class="card-body">
                                        <a  @if($controllerAds->url) href="{{ $controllerAds->url }}" target="_blank" @endif >
                                            <img src="{{ asset('uploads/images/ads/controller/'.$controllerAds->image) }}" height="100%" width="100%" style="border-radius: 5px;">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
            <!-- End top ads.  by controller this upazila -->
            <hr>
            <!-- Start middle ads. by admin for all-->
            <div class="swiper-container offer-slide swiper-container-horizontal swiper-container-android">
                <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                    @foreach($adminAds as $adminAds)
                        <div class="swiper-slide swiper-slide-active">
                            <div class="card shadow border-0 bg-template">
                                <div class="card-body">
                                    <a  @if($adminAds->url) href="{{ $adminAds->url }}" target="_blank" @endif >
                                        <img src="{{ asset('uploads/images/ads/admin/'.$adminAds->image) }}" height="100%" width="100%" style="border-radius: 5px;">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
            <!-- End middle ads. by admin for all-->
    @endif

    <script>
        $(document).ready(function (){
           $('.select-package-btn').click(function (){
                $('.package_name_modal').html($(this).parent().parent().find('.name').text())
                $('.package-detail-modal').html($(this).parent().parent().find('.package-detail').html())
                $('.three_month_modal').html($(this).parent().parent().find('.three_month_price').html())
                $('.six_month_modal').html($(this).parent().parent().find('.six_month_price').val())
                $('.twelve_month_modal').html($(this).parent().parent().find('.twelve_month_price').html())
                $('#hidden_package_id_modal').val($(this).val())
           });
        });
    </script>
@endsection
