@extends('worker.layout.app')
@push('title') Home @endpush
@push('head')

@endpush
@section('content')
    <div class="wrapper homepage">
        <!-- header -->
        <div class="header">
            <div class="row no-gutters">
                <div class="col-auto">
                    <button class="btn  btn-link text-dark menu-btn"><i class="material-icons">menu</i><span class="new-notification"></span></button>
                </div>
                <div class="col text-center"><img src="{{ asset('uploads/images/'.$setting->logo_header) }}" alt="" class="header-logo"></div>
                <div class="col-auto">
                    <a href="#" class="btn  btn-link text-dark position-relative"><i class="material-icons">notifications_none</i><span class="counts">9+</span></a>
                </div>
            </div>
        </div>
        <!-- header ends -->
        <!-- Start title -->
        <div class="alert alert-success text-center" role="alert">
            <hr>
            <b>Job Offer</b>
        </div>
        <!-- End title -->
        @php $isAdsAndNoticeShow = ""; $isCategoryShow = ""; $loopCount = 0; @endphp
        <!-- Start Active job -->
        <div class="container" id="active-job">
            @foreach(auth()->user()->upazila->customers as $customer)
            @foreach($customer->job->where('status', 'active') as $job)
                <!-- Check already bid or not -->
                @if(!auth()->user()->bid()->where('job_id', $job->id)->exists())
                    @php $loopCount++; @endphp
                    <div class="card shadow border-0 mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="font-weight-normal mb-1"><b>{{ Illuminate\Support\Str::limit($job->title, 27) }}</b></h5>
                                    <p class="text text-warning mb-2">{{ Illuminate\Support\Str::limit($job->description, 70) }}</p>
                                    <div class="row text-center">
                                        <div class="col-4 text-center color-border">
                                            <p class="text text-success mb-2">{{ 'Created' }}</p>
                                            <p class="text-mute small text-secondary mb-2">{{ date('h:i a m/d/Y', strtotime($job->created_at)) }}</p>
                                        </div>
                                        <div class="col-4 text-center color-border">
                                            <p class="text text-success mb-2">{{ 'Budget' }}</p>
                                            <p class="text-mute small text-secondary mb-2">{{ $job->budget }}</p>
                                        </div>
                                        <div class="col-4 text-center color-border">
                                            <p class="text text-success mb-2">{{ 'Bid sent' }}</p>
                                            <p class="text-mute small text-secondary mb-2">{{ '10' }}</p>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="button" class="mb-2 btn btn-lg btn-success view-btn" onclick="window.location.href='{{ route('worker.showJob',\Illuminate\Support\Facades\Crypt::encryptString($job->id) ) }}'">
                                                <b>Bid Now</b>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Job equal or => 5 notice and top ads. show as up -->
                @if( $loopCount == 5)
                        @php $isAdsAndNoticeShow = "yes" @endphp
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
                        @foreach(auth()->user()->upazila->user->where('role', 'controller') as $controller)
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
                        <!-- End controller notice box -->
                        <!-- Start top ads. by controller this upazila -->
                        <div class="swiper-container offer-slide swiper-container-horizontal swiper-container-android">
                            <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                                @foreach(auth()->user()->upazila->user->where('role', 'controller') as $controller)
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
                        <br>
                @endif
                <!-- Job equal or => 10 category and bottom ads. show as up -->
                @if( $loopCount == 10)
                    @php $isCategoryShow = "yes" @endphp
                    <!-- Start title -->
                    <div class="alert alert-primary text-center" role="alert">
                            <b>Find your service by category</b>
                        </div>
                    <!-- End title -->
                    <!-- Start worker service category -->
                    <div class="container">
                            <div class="row text-center mt-4">
                                @foreach($categories as $category)
                                    <div class="col-6 col-md-3">
                                        <div class="card shadow border-0 mb-3">
                                            <div class="card-body">
                                                <div class="avatar avatar-60 no-shadow border-0">
                                                    <div class="overlay bg-template"></div>
                                                    <img src="{{ asset('uploads/images/worker/service-category/'.$category->icon) }}" height="50px" width="50px" style="border-radius: 15px;">
                                                </div>
                                                <a href="{{ route('worker.showServices',\Illuminate\Support\Facades\Crypt::encryptString($category->id)) }}"> <p class="mt-3 mb-0 font-weight-bold">{{ $category->name }}</p></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    <!-- End worker service category -->
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
                    <hr>
                    <!-- Start bottom ads. by controller this upazila  -->
                    <div class="swiper-container offer-slide swiper-container-horizontal swiper-container-android">
                            <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                                @foreach(auth()->user()->upazila->user->where('role', 'controller') as $controller)
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
                    <br>
                    <!-- End bottom ads.  by controller this upazila -->
                @endif
            @endforeach
            @endforeach
        </div>
        <!-- End Active job -->
        <!--If job offer smaller than 5 show notice and top ads. as last -->
        @if($isAdsAndNoticeShow!='yes')
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
                @foreach(auth()->user()->upazila->user->where('role', 'controller') as $controller)
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
            <!-- End controller notice box -->

                <!-- Start top ads. by controller this upazila -->
                <div class="swiper-container offer-slide swiper-container-horizontal swiper-container-android">
                    <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                        @foreach(auth()->user()->upazila->user->where('role', 'controller') as $controller)
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
        @endif
        <hr>
        <!--If job offer smaller than 10 show category & bottom ads. as last -->
        @if($isCategoryShow!='yes')
            <!-- Start title -->
                <div class="alert alert-primary text-center" role="alert">
                    <b>Find your service by category</b>
                </div>
                <!-- End title -->
                <!-- Start worker service category -->
                <div class="container">
                    <div class="row text-center mt-4">
                        @foreach($categories as $category)
                            <div class="col-6 col-md-3">
                                <div class="card shadow border-0 mb-3">
                                    <div class="card-body">
                                        <div class="avatar avatar-60 no-shadow border-0">
                                            <div class="overlay bg-template"></div>
                                            <img src="{{ asset('uploads/images/worker/service-category/'.$category->icon) }}" height="50px" width="50px" style="border-radius: 15px;">
                                        </div>
                                        <a href="{{ route('worker.showServices',\Illuminate\Support\Facades\Crypt::encryptString($category->id)) }}"> <p class="mt-3 mb-0 font-weight-bold">{{ $category->name }}</p></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- End worker service category -->

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
                <hr>
                <!-- Start bottom ads. by controller this upazila  -->
                <div class="swiper-container offer-slide swiper-container-horizontal swiper-container-android">
                    <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                        @foreach(auth()->user()->upazila->user->where('role', 'controller') as $controller)
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
                <!-- End bottom ads.  by controller this upazila -->
        @endif

        <!-- footer-->
        <div class="footer">
            <div class="no-gutters">
                <div class="col-auto mx-auto">
                    <div class="row no-gutters justify-content-center">
                        <div class="col-auto">
                            <a href="{{ route('worker.home.index') }}" class="btn btn-link-default active">
                                <i class="material-icons">home</i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-link-default">
                                <i class="material-icons">insert_chart_outline</i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-link-default">
                                <i class="material-icons">account_balance_wallet</i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-link-default">
                                <i class="material-icons">widgets</i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-link-default">
                                <i class="material-icons">account_circle</i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer ends-->
    </div>

    <script>
        $(document).ready(function() {
            //Submit new Job
            $('#job-submit-button').click(function(){
                var formData = new FormData();
                formData.append('title', $('#title').val())
                formData.append('description', $('#description').val())
                formData.append('address', $('#address').val())
                formData.append('service', $('#service').val())
                formData.append('day', $('#day').val())
                formData.append('budget', $('#budget').val())

                $.ajax({
                    method: 'POST',
                    url: '/customer/job',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#title').val('');
                        $('#description').val('');
                        $('#address').val('');
                        //$('#service').val('');
                        $('#day').val('');
                        $('#budget').val('');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Successfully add new job.',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    error: function (xhr) {
                        var errorMessage = '<div class="card bg-danger">\n' +
                            '                        <div class="card-body text-center p-5">\n' +
                            '                            <span class="text-white">';
                        $.each(xhr.responseJSON.errors, function(key,value) {
                            errorMessage +=(''+value+'<br>');
                        });
                        errorMessage +='</span>\n' +
                            '                        </div>\n' +
                            '                    </div>';
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            footer: errorMessage
                        })
                    },
                })
            });
        });
    </script>
@endsection
