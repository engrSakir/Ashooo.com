@extends('customer.layout.app')
@push('title') Job @endpush
@push('head')
    <style>
        .color-border{
            border-style: solid;
            border-width: thin;
            border-color: #9bd498;
            border-radius: 5px;
            margin-left: 10px;
            padding: 10px;
        }
        .view-btn{
            margin-left: -10px;
            height: 100%;
        }
    </style>
@endpush
@section('content')

    <!-- Start job selection area-->
    <div class="container">
        <div class="card bg-template shadow mt-4 h-500">
            <div class="card-body">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <button id="active-job-btn" type="button" class="mb-2 btn btn-success">Active Job
                                        ({{ count(auth()->user()->customerGigs->where('status', 'active')) + count(auth()->user()->customerBids->where('status', 'active')) }})
                                    </button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <button id="completed-job-btn" type="button" class="mb-2 btn btn-success">Completed
                                        ({{ count(auth()->user()->customerGigs->where('status', 'completed')) + count(auth()->user()->customerBids->where('status', 'completed')) }})
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <button id="running-job-btn" type="button" class="mb-2 btn btn-success">Running &nbsp;
                                        ({{ count(auth()->user()->customerGigs->where('status', 'running')) + count(auth()->user()->customerBids->where('status', 'running')) }})
                                        &nbsp;</button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <button id="cancelled-job-btn" type="button" class="mb-2 btn btn-success">Cancelled
                                        ({{ count(auth()->user()->customerGigs->where('status', 'cancelled')) + count(auth()->user()->customerBids->where('status', 'cancelled')) }})
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End job selection area-->
    <hr>
    <!-- Start title -->
    <div class="alert alert-primary text-center active-job" role="alert">
        <b id="bid-job">BID JOB</b>
    </div>
    <!-- End title -->

    <!-- Start Active GIG job -->
    <div class="container active-job">
        @foreach(auth()->user()->customerGigs->where('status', 'active') as $gig)
            <div class="card shadow border-0 mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="font-weight-normal mb-1"><b>{{ Illuminate\Support\Str::limit($gig->title, 27) }}</b></h5>
                            <div class="row text-center">
                                <div class="col-5 text-center color-border">
                                    <p class="text text-success mb-2">{{ 'Created' }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ date('h:i a m/d/y', strtotime($gig->created_at)) }}</p>
                                </div>
                                <div class="col-3 text-center color-border">
                                    <p class="text text-success mb-2">{{ $gig->workerBids->where('is_cancelled', '0')->count() }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ 'Proposals' }}</p>
                                </div>
                                <div class="col-3 text-center">
                                    <button type="button" class="mb-2 btn btn-lg btn-success view-btn"
                                            onclick="window.location.href='{{ route('customer.showCustomerGig', \Illuminate\Support\Facades\Crypt::encryptString($gig->id)) }}'">
                                        <i class="material-icons">visibility</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- End Active GIG job -->

    <!-- Start Completed job -->
    <div class="container completed-job" id="">
        @foreach(auth()->user()->customerGigs->where('status', 'completed') as $gig)
            <div class="card shadow border-0 mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="font-weight-normal mb-1"><b>{{ Illuminate\Support\Str::limit($gig->title, 27) }}</b></h5>
                            <div class="row text-center">
                                <div class="col-5 text-center color-border">
                                    <p class="text text-success mb-2">{{ 'Created' }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ date('h:i a m/d/y', strtotime($gig->created_at)) }}</p>
                                </div>
                                <div class="col-3 text-center color-border">
                                    <p class="text text-success mb-2">{{ $gig->workerBids->count() }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ 'Proposals' }}</p>
                                </div>
                                <div class="col-3 text-center">
                                    <button type="button" class="mb-2 btn btn-lg btn-success view-btn"
                                            onclick="window.location.href='{{ route('customer.showCustomerGig', \Illuminate\Support\Facades\Crypt::encryptString($gig->id)) }}'">
                                        <i class="material-icons">visibility</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- End Completed job -->

    <!-- Start Running job -->
    <div class="container running-job" id="">
        @foreach(auth()->user()->customerGigs->where('status', 'running') as $job)
            <div class="card shadow border-0 mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="font-weight-normal mb-1"><b>{{ Illuminate\Support\Str::limit($job->title, 27) }}</b></h5>
                            <div class="row text-center">
                                <div class="col-5 text-center color-border">
                                    <p class="text text-success mb-2">{{ 'Created' }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ date('h:i a m/d/y', strtotime($job->created_at)) }}</p>
                                </div>
                                <div class="col-3 text-center color-border">
                                    <p class="text text-success mb-2">{{ $job->budget }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ 'Taka' }}</p>
                                </div>
                                <div class="col-3 text-center">
                                    <button type="button" class="mb-2 btn btn-lg btn-success view-btn"
                                            onclick="window.location.href='{{ route('customer.showCustomerGig', \Illuminate\Support\Facades\Crypt::encryptString($job->id)) }}'">
                                        <i class="material-icons">visibility</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- End Running job -->

    <!-- Start Cancelled job -->
    <div class="container cancelled-job" id="">
        @foreach(auth()->user()->customerGigs->where('status', 'cancelled') as $job)
            <div class="card shadow border-0 mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="font-weight-normal mb-1"><b>{{ Illuminate\Support\Str::limit($job->title, 27) }}</b></h5>
                            <div class="row text-center">
                                <div class="col-5 text-center color-border">
                                    <p class="text text-success mb-2">{{ 'Created' }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ date('h:i a m/d/y', strtotime($job->created_at)) }}</p>
                                </div>
                                <div class="col-3 text-center color-border">
                                    <p class="text text-success mb-2">{{ $job->budget }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ 'Taka' }}</p>
                                </div>
                                <div class="col-3 text-center">
                                    <button type="button" class="mb-2 btn btn-lg btn-success view-btn"
                                            onclick="window.location.href='{{ route('customer.showCustomerGig', \Illuminate\Support\Facades\Crypt::encryptString($job->id)) }}'">
                                        <i class="material-icons">visibility</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- End Cancelled job -->
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
    <!-- Start title -->
    <div class="alert alert-primary text-center active-job" role="alert">
        <b id="gig-job"> GIG JOB</b>
    </div>
    <!-- End title -->

    <!-- Start Active job -->
    <div class="container active-job">
        @foreach(auth()->user()->customerBids->where('status', 'active') as $bid)
            <div class="card shadow border-0 mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="font-weight-normal mb-1"><b>{{ Illuminate\Support\Str::limit($bid->workerGig->title, 27) }}</b></h5>
                            <div class="row text-center">
                                <div class="col-5 text-center color-border">
                                    <p class="text text-success mb-2">{{ 'Created' }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ date('h:i a m/d/y', strtotime($bid->created_at)) }}</p>
                                </div>
                                <div class="col-3 text-center color-border">
                                    <p class="text text-success mb-2">{{ $bid->budget }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ 'Taka' }}</p>
                                </div>
                                <div class="col-3 text-center">
                                    <button type="button" class="mb-2 btn btn-lg btn-success view-btn" onclick="window.location.href='{{ route('customer.showCustomerBid', \Illuminate\Support\Facades\Crypt::encryptString($bid->id)) }}'">
                                        <i class="material-icons">visibility</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- End Active job -->
    <!-- Start Running job -->
    <div class="container running-job">
        @foreach(auth()->user()->customerBids->where('status', 'running') as $bid)
            <div class="card shadow border-0 mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="font-weight-normal mb-1"><b>{{ Illuminate\Support\Str::limit($bid->workerGig->title, 27) }}</b></h5>
                            <div class="row text-center">
                                <div class="col-5 text-center color-border">
                                    <p class="text text-success mb-2">{{ 'Created' }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ date('h:i a m/d/y', strtotime($bid->created_at)) }}</p>
                                </div>
                                <div class="col-3 text-center color-border">
                                    <p class="text text-success mb-2">{{ $bid->budget }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ 'Taka' }}</p>
                                </div>
                                <div class="col-3 text-center">
                                    <button type="button" class="mb-2 btn btn-lg btn-success view-btn" onclick="window.location.href='{{ route('customer.showCustomerBid', \Illuminate\Support\Facades\Crypt::encryptString($bid->id)) }}'">
                                        <i class="material-icons">visibility</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- End Running job -->

    <!-- Start Completed job -->
    <div class="container completed-job">
        @foreach(auth()->user()->customerBids->where('status', 'completed') as $bid)
            <div class="card shadow border-0 mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="font-weight-normal mb-1"><b>{{ Illuminate\Support\Str::limit($bid->workerGig->title, 27) }}</b></h5>
                            <div class="row text-center">
                                <div class="col-5 text-center color-border">
                                    <p class="text text-success mb-2">{{ 'Created' }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ date('h:i a m/d/y', strtotime($bid->created_at)) }}</p>
                                </div>
                                <div class="col-3 text-center color-border">
                                    <p class="text text-success mb-2">{{ $bid->budget }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ 'Taka' }}</p>
                                </div>
                                <div class="col-3 text-center">
                                    <button type="button" class="mb-2 btn btn-lg btn-success view-btn" onclick="window.location.href='{{ route('customer.showCustomerBid', \Illuminate\Support\Facades\Crypt::encryptString($bid->id)) }}'">
                                        <i class="material-icons">visibility</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- End Completed job -->

    <!-- Start Cancelled job -->
    <div class="container cancelled-job">
        @foreach(auth()->user()->customerBids->where('status', 'cancelled') as $bid)
            <div class="card shadow border-0 mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="font-weight-normal mb-1"><b>{{ Illuminate\Support\Str::limit($bid->workerGig->title, 27) }}</b></h5>
                            <div class="row text-center">
                                <div class="col-5 text-center color-border">
                                    <p class="text text-success mb-2">{{ 'Created' }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ date('h:i a m/d/y', strtotime($bid->created_at)) }}</p>
                                </div>
                                <div class="col-3 text-center color-border">
                                    <p class="text text-success mb-2">{{ $bid->budget }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ 'Taka' }}</p>
                                </div>
                                <div class="col-3 text-center">
                                    <button type="button" class="mb-2 btn btn-lg btn-success view-btn" onclick="window.location.href='{{ route('customer.showCustomerBid', \Illuminate\Support\Facades\Crypt::encryptString($bid->id)) }}'">
                                        <i class="material-icons">visibility</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- End Cancelled job -->

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

<script>
    $(document).ready(function() {
        //Show only active
        $('#bid-job').html('BID JOB');
        $('#gig-job').html('GIG JOB');
        $('.active-job').show();
        $('.completed-job').hide();
        $('.running-job').hide();
        $('.cancelled-job').hide();

        //Active job show
        $('#active-job-btn').click(function (){
            $('#bid-job').html('ACTIVE | BID JOB');
            $('#gig-job').html('ACTIVE | GIG JOB');
            $('.active-job').show();
            $('.completed-job').hide();
            $('.running-job').hide();
            $('.cancelled-job').hide();
        })

        //Complete job show
        $('#completed-job-btn').click(function (){
            $('#bid-job').html('COMPLETED | BID JOB');
            $('#gig-job').html('COMPLETED | GIG JOB');
            $('.active-job').hide();
            $('.completed-job').show();
            $('.running-job').hide();
            $('.cancelled-job').hide();
        })

        //Running job show
        $('#running-job-btn').click(function (){
            $('#bid-job').html('RUNNING | BID JOB');
            $('#gig-job').html('RUNNING | GIG JOB');
            $('.active-job').hide();
            $('.completed-job').hide();
            $('.running-job').show();
            $('.cancelled-job').hide();
        })

        //Cancelled job show
        $('#cancelled-job-btn').click(function (){
            $('#bid-job').html('CANCELLED | BID JOB');
            $('#gig-job').html('CANCELLED | GIG JOB');
            $('.active-job').hide();
            $('.completed-job').hide();
            $('.running-job').hide();
            $('.cancelled-job').show();
        })

    });

</script>
@endsection
