@extends('customer.layout.app')
@push('title') Job @endpush
@push('head')
    <style>
        .color-border{
            border-style: solid;
            border-width: thin;
            border-color: #9bd498;
            border-radius: 5px;
            margin-left: 5px;
            padding: 10px;
        }
        .view-btn{
            margin-left: -10px;
            height: 100%;
        }
    </style>
@endpush
@section('content')

        <!--Start active job detail view -->
        <!-- Start title -->
            <div class="">
                <div class="alert alert-info text-center" role="alert">
                    <b id=""> GIGS </b>
                </div>
            </div>
            <!-- End title -->
            <!--Start worker info & price-->
            <div class="container worker-profile">
                <div class="card bg-info shadow mt-4 h-190">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img class="worker-profile-image" src="{{ asset('uploads/images/users/'.$gig->worker->image) }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">{{ $gig->worker->full_name }}</h5>
                                <div class="col-auto pl-0">
                                    <p class="small text-mute text-trucated mt-1">
                                        @php
                                            $percent = 100 - (($gig->worker->rating->max_rate - $gig->worker->rating->rate)/$gig->worker->rating->max_rate)*100;
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
                                            <i class="material-icons btn-outline-warning">star</i>
                                        @endfor
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container top-100">
                <div class="card mb-4 shadow">
                    <div class="card-body border-bottom">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-0 font-weight-normal">Price ৳ </h3>
                            </div>
                            <div class="col-auto">
                                <button disabled class="btn btn-info btn-rounded-54 shadow" data-toggle="modal" data-target="#addmoney"> <b>{{ $gig->budget }}</b> </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-none">
                        <div class="row">
                            <div class="col">
                                <p class="gig-title"><b>{{ $gig->title }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End gig info & price-->
            <!--Start work detail , address, day-->
            <div class="container">
                <h4 class="mb-3">
                    <b>Work details:</b>
                </h4>
                <p>{{ $gig->description }}</p>
                <h4 class="mb-3">
                    <b>Tag:</b>
                </h4>
                <p>{{ $gig->tags }}</p>

                <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                    <button disabled type="button" class="btn btn-outline-success active"><small>Time </small>{{ $gig->day }}<small> Days</small></button>
                    <button id="" onclick="window.location.href='{{ route('customer.showGigOrderForm', \Illuminate\Support\Facades\Crypt::encryptString($gig->id)) }}'" type="button" class="btn btn-success">Order Now</button>
                </div>
            </div>
            <!--End work detail , address, day-->
            <hr>

@endsection
