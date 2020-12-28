@extends('worker.layout.app')
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
                                    @php
                                        $activeGig = 0;
                                        $completeGig = 0;
                                        $runningGig = 0;
                                        $cancelledGig = 0;
                                        foreach (auth()->user()->workerGigs as $gigs){
                                            foreach ($gigs->customerBids as $customerBid){
                                            if ($customerBid->status == 'active'){
                                                $activeGig++;
                                            }else if($customerBid->status == 'completed'){
                                                $completeGig++;
                                            }else if($customerBid->status == 'running'){
                                                $runningGig++;
                                            }else if($customerBid->status == 'cancelled'){
                                               $cancelledGig++;
                                            }
                                        }
                                        }

                                        $activeBid = 0;
                                        $completeBid = 0;
                                        $runningBid = 0;
                                        $cancelledBid = 0;
                                        foreach (auth()->user()->workerBids as $bids){
                                            if ($bids->customerGig->status == 'cancelled' || $bids->is_cancelled == 1){
                                                $cancelledBid++;
                                            }else if ($bids->customerGig->status == 'active'){
                                                $activeBid++;
                                            }else if($bids->customerGig->status == 'completed'){
                                                $completeBid++;
                                            }else if($bids->customerGig->status == 'running'){
                                                $runningBid++;
                                            }
                                        }
                                    @endphp
                                    <button id="active-job-btn" type="button" class="mb-2 btn btn-success">Active Job ({{ $activeGig + $activeBid }})</button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <button id="completed-job-btn" type="button" class="mb-2 btn btn-success">Completed ({{ $completeGig + $completeBid }})</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <button id="running-job-btn" type="button" class="mb-2 btn btn-success">Running Job ({{ $runningGig + $runningBid }})  &nbsp;</button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <button id="cancelled-job-btn" type="button" class="mb-2 btn btn-success">Cancelled ({{ $cancelledGig + $cancelledBid }})</button>
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
        <b id="">ACTIVE BID JOB</b>
    </div>
    <!-- End title -->
    <!-- Start WorkerBids -->
    @foreach(auth()->user()->workerBids as $workerBid)
        @if($workerBid->customerGig->status == 'cancelled' || $workerBid->is_cancelled == 1)
            <!-- Start Active job -->
                <div class="container cancelled-job" id="">
                    <div class="card shadow border-0 mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="font-weight-normal mb-1"><b>{{ Illuminate\Support\Str::limit($workerBid->customerGig->title, 27)  }}</b></h5>
                                    <div class="row text-center">
                                        <div class="col-5 text-center color-border">
                                            <p class="text text-success mb-2">{{ 'Created' }}</p>
                                            <p class="text-mute small text-secondary mb-2">{{ date('h:i a m/d/y', strtotime($workerBid->customerGig->created_at)) }}</p>
                                        </div>
                                        <div class="col-3 text-center color-border">
                                            <p class="text text-success mb-2">{{ $workerBid->budget }}</p>
                                            <p class="text-mute small text-secondary mb-2">{{ 'Taka' }}</p>
                                        </div>
                                        <div class="col-3 text-center">
                                            <button type="button" class="mb-2 btn btn-lg btn-success view-btn" onclick="window.location.href='{{ route('worker.showWorkerBid', \Illuminate\Support\Facades\Crypt::encryptString($workerBid->customerGig->id)) }}'">
                                                <i class="material-icons">visibility</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Active job -->
        @elseif($workerBid->customerGig->status == 'active')
            <!-- Start Active job -->
                <div class="container active-job" id="">
                    <div class="card shadow border-0 mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="font-weight-normal mb-1"><b>{{ Illuminate\Support\Str::limit($workerBid->customerGig->title, 27)  }}</b></h5>
                                    <div class="row text-center">
                                        <div class="col-5 text-center color-border">
                                            <p class="text text-success mb-2">{{ 'Created' }}</p>
                                            <p class="text-mute small text-secondary mb-2">{{ date('h:i a m/d/y', strtotime($workerBid->customerGig->created_at)) }}</p>
                                        </div>
                                        <div class="col-3 text-center color-border">
                                            <p class="text text-success mb-2">{{ $workerBid->budget }}</p>
                                            <p class="text-mute small text-secondary mb-2">{{ 'Taka' }}</p>
                                        </div>
                                        <div class="col-3 text-center">
                                            <button type="button" class="mb-2 btn btn-lg btn-success view-btn" onclick="window.location.href='{{ route('worker.showWorkerBid', \Illuminate\Support\Facades\Crypt::encryptString($workerBid->customerGig->id)) }}'">
                                                <i class="material-icons">visibility</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Active job -->
        @elseif($workerBid->customerGig->status == 'running')
            <!-- Start Active job -->
                <div class="container running-job" id="">
                    <div class="card shadow border-0 mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="font-weight-normal mb-1"><b>{{ Illuminate\Support\Str::limit($workerBid->customerGig->title, 27)  }}</b></h5>
                                    <div class="row text-center">
                                        <div class="col-5 text-center color-border">
                                            <p class="text text-success mb-2">{{ 'Created' }}</p>
                                            <p class="text-mute small text-secondary mb-2">{{ date('h:i a m/d/y', strtotime($workerBid->customerGig->created_at)) }}</p>
                                        </div>
                                        <div class="col-3 text-center color-border">
                                            <p class="text text-success mb-2">{{ $workerBid->budget }}</p>
                                            <p class="text-mute small text-secondary mb-2">{{ 'Taka' }}</p>
                                        </div>
                                        <div class="col-3 text-center">
                                            <button type="button" class="mb-2 btn btn-lg btn-success view-btn" onclick="window.location.href='{{ route('worker.showWorkerBid', \Illuminate\Support\Facades\Crypt::encryptString($workerBid->customerGig->id)) }}'">
                                                <i class="material-icons">visibility</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Active job -->
        @elseif($workerBid->customerGig->status == 'completed')
            <!-- Start Active job -->
                <div class="container completed-job" id="">
                    <div class="card shadow border-0 mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="font-weight-normal mb-1"><b>{{ Illuminate\Support\Str::limit($workerBid->customerGig->title, 27)  }}</b></h5>
                                    <div class="row text-center">
                                        <div class="col-5 text-center color-border">
                                            <p class="text text-success mb-2">{{ 'Created' }}</p>
                                            <p class="text-mute small text-secondary mb-2">{{ date('h:i a m/d/y', strtotime($workerBid->customerGig->created_at)) }}</p>
                                        </div>
                                        <div class="col-3 text-center color-border">
                                            <p class="text text-success mb-2">{{ $workerBid->budget }}</p>
                                            <p class="text-mute small text-secondary mb-2">{{ 'Taka' }}</p>
                                        </div>
                                        <div class="col-3 text-center">
                                            <button type="button" class="mb-2 btn btn-lg btn-success view-btn" onclick="window.location.href='{{ route('worker.showWorkerBid', \Illuminate\Support\Facades\Crypt::encryptString($workerBid->customerGig->id)) }}'">
                                                <i class="material-icons">visibility</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Active job -->

        @endif
    @endforeach
    <!-- End WorkerBids -->
    <!-- Start top ads. by controller this upazila -->
    <div class="swiper-container offer-slide swiper-container-horizontal swiper-container-android">
        <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
            @foreach(auth()->user()->upazila->controllers as $controller)
                @foreach($controller->controllerAds as $controllerAds)
                    <div class="swiper-slide swiper-slide-active">
                        <div class="card{{-- shadow border-0 bg-template --}}">
                            <div class="card-body">
                                <a  @if($controllerAds->url) href="{{ $controllerAds->url }}" target="_blank" @endif >
                                    <img src="{{ asset($controllerAds->image) }}" height="100%" width="100%" style="border-radius: 5px;">
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
        <b id="">ACTIVE GIG JOB</b>
    </div>
    <!-- End title -->
    <!-- Start Active job -->
    <div class="container active-job" id="active-job">
        @foreach(auth()->user()->workerGigs as $workerGigs)
            @foreach($workerGigs->customerBids->where('status', 'active') as $customerBids)
                <div class="card shadow border-0 mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="font-weight-normal mb-1"><b>{{ $workerGigs->title }}</b></h5>
                                <div class="row text-center">
                                    <div class="col-5 text-center color-border">
                                        <p class="text text-success mb-2">{{ 'Created' }}</p>
                                        <p class="text-mute small text-secondary mb-2">{{ date('h:i a m/d/y', strtotime($customerBids->created_at)) }}</p>
                                    </div>
                                    <div class="col-3 text-center color-border">
                                        <p class="text text-success mb-2">{{ $workerGigs->customerBids->where('status', 'active')->count() }}</p>
                                        <p class="text-mute small text-secondary mb-2">{{ 'Proposals' }}</p>
                                    </div>
                                    <div class="col-3 text-center">
                                        <button type="button" class="mb-2 btn btn-lg btn-success view-btn" onclick="window.location.href='{{ route('worker.showCustomerBid', \Illuminate\Support\Facades\Crypt::encryptString($customerBids->id)) }}'">
                                            <i class="material-icons">visibility</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
    <!-- End Active job -->
    <!-- Start Complete job -->
    <div class="container completed-job" id="completed-job">
        @foreach(auth()->user()->workerGigs as $workerGigs)
            @foreach($workerGigs->customerBids->where('status', 'completed') as $customerBids)
                <div class="card shadow border-0 mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="font-weight-normal mb-1"><b>{{ $workerGigs->title }}</b></h5>
                                <div class="row text-center">
                                    <div class="col-5 text-center color-border">
                                        <p class="text text-success mb-2">{{ 'Created' }}</p>
                                        <p class="text-mute small text-secondary mb-2">{{ date('h:i a m/d/y', strtotime($customerBids->created_at)) }}</p>
                                    </div>
                                    <div class="col-3 text-center color-border">
                                        <p class="text text-success mb-2">{{ $customerBids->budget }}</p>
                                        <p class="text-mute small text-secondary mb-2">{{ 'Taka' }}</p>
                                    </div>
                                    <div class="col-3 text-center">
                                        <button type="button" class="mb-2 btn btn-lg btn-success view-btn" onclick="window.location.href='{{ route('worker.showCustomerBid', \Illuminate\Support\Facades\Crypt::encryptString($customerBids->id)) }}'">
                                            <i class="material-icons">visibility</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
    <!-- End Completed job -->

    <!-- Start Running job -->
    <div class="container running-job" id="running-job">
        @foreach(auth()->user()->workerGigs as $workerGigs)
            @foreach($workerGigs->customerBids->where('status', 'running') as $customerBids)
                <div class="card shadow border-0 mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="font-weight-normal mb-1"><b>{{ $workerGigs->title }}</b></h5>
                                <div class="row text-center">
                                    <div class="col-5 text-center color-border">
                                        <p class="text text-success mb-2">{{ 'Created' }}</p>
                                        <p class="text-mute small text-secondary mb-2">{{ date('h:i a m/d/y', strtotime($customerBids->created_at)) }}</p>
                                    </div>
                                    <div class="col-3 text-center color-border">
                                        <p class="text text-success mb-2">{{ $customerBids->budget }}</p>
                                        <p class="text-mute small text-secondary mb-2">{{ 'Taka' }}</p>
                                    </div>
                                    <div class="col-3 text-center">
                                        <button type="button" class="mb-2 btn btn-lg btn-success view-btn" onclick="window.location.href='{{ route('worker.showCustomerBid', \Illuminate\Support\Facades\Crypt::encryptString($customerBids->id)) }}'">
                                            <i class="material-icons">visibility</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
    <!-- End Running job -->

    <!-- Start Cancelled job -->
    <div class="container cancelled-job" id="cancelled-job">
        @foreach(auth()->user()->workerGigs as $workerGigs)
            @foreach($workerGigs->customerBids->where('status', 'cancelled') as $customerBids)
                <div class="card shadow border-0 mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="font-weight-normal mb-1"><b>{{ $workerGigs->title }}</b></h5>
                                <div class="row text-center">
                                    <div class="col-5 text-center color-border">
                                        <p class="text text-success mb-2">{{ 'Created' }}</p>
                                        <p class="text-mute small text-secondary mb-2">{{ date('h:i a m/d/y', strtotime($customerBids->created_at)) }}</p>
                                    </div>
                                    <div class="col-3 text-center color-border">
                                        <p class="text text-success mb-2">{{ $customerBids->budget }}</p>
                                        <p class="text-mute small text-secondary mb-2">{{ 'Taka' }}</p>
                                    </div>
                                    <div class="col-3 text-center">
                                        <button type="button" class="mb-2 btn btn-lg btn-success view-btn" onclick="window.location.href='{{ route('worker.showCustomerBid', \Illuminate\Support\Facades\Crypt::encryptString($customerBids->id)) }}'">
                                            <i class="material-icons">visibility</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
    <!-- End Cancelled job -->
    <!-- Start middle ads. by admin for all-->
    <div class="swiper-container offer-slide swiper-container-horizontal swiper-container-android">
        <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
            @foreach($adminAds as $adminAds)
                <div class="swiper-slide swiper-slide-active">
                    <div class="card{{-- shadow border-0 bg-template --}}">
                        <div class="card-body">
                            <a  @if($adminAds->url) href="{{ $adminAds->url }}" target="_blank" @endif >
                                <img src="{{ asset($adminAds->image) }}" height="100%" width="100%" style="border-radius: 5px;">
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
        $('.active-job').show();
        $('.completed-job').hide();
        $('.running-job').hide();
        $('.cancelled-job').hide();

        //Active job show
        $('#active-job-btn').click(function (){
            $('.active-job').show();
            $('.completed-job').hide();
            $('.running-job').hide();
            $('.cancelled-job').hide();
        })

        //Complete job show
        $('#completed-job-btn').click(function (){
            $('.active-job').hide();
            $('.completed-job').show();
            $('.running-job').hide();
            $('.cancelled-job').hide();
        })

        //Running job show
        $('#running-job-btn').click(function (){
            $('.active-job').hide();
            $('.completed-job').hide();
            $('.running-job').show();
            $('.cancelled-job').hide();
        })

        //Cancelled job show
        $('#cancelled-job-btn').click(function (){
            $('.active-job').hide();
            $('.completed-job').hide();
            $('.running-job').hide();
            $('.cancelled-job').show();
        })

    });

</script>
@endsection
