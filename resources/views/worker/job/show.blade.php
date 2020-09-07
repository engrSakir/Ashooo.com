@extends('worker.layout.app')
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
    <!--Start active job detail view -->
    @if($job->status == 'active' && $job->bid->where('worker_id', auth()->user()->id)->first()->is_cancelled == 0)
        <!-- Start title -->
        <div class="">
                <div class="alert alert-info text-center" role="alert">
                    <b id=""> BID JOB</b>
                </div>
            </div>
        <!-- End title -->
            <!--Start owner info & price-->
            <div class="container">
                <div class="card bg-info shadow mt-4 h-190">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <figure class="avatar avatar-60"><img src="{{ asset('uploads/images/users/'.$job->customer->image) }}" alt=""></figure>
                                </div>
                                <div class="col pl-0 align-self-center">
                                    <h5 class="mb-1">{{ $job->customer->full_name }}</h5>
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
                                    <button disabled class="btn btn-info btn-rounded-54 shadow" data-toggle="modal" data-target="#addmoney"> <b>{{ $job->budget }}</b> </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-none">
                            <div class="row">
                                <div class="col">
                                    <p><b>{{ $job->title }}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!--End owner info & price-->
            <!--Start work detail , address, day-->
            <div class="container">
                <h4 class="mb-3"><b>Work detail:</b></h4>
                <p>{{ $job->description }}</p>
                <h4 class="mb-3"><b>Address:</b></h4>
                <p>{{ $job->address }}</p>
                <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                    <button disabled type="button" class="btn btn-outline-success active col"><small>Time  </small>{{ $job->day }}<small> Days</small></button>
                    <button disabled type="button" class="btn btn-success col">{{  date('h:i a m/d/Y', strtotime($job->created_at)) }}</button>
                </div>
            </div>
            <!--End work detail , address, day-->
                <hr>
            <!-- Start bid title -->
            <div class="">
                <div class="alert alert-info text-center" role="alert">
                    <b id=""> MY BIDS</b>
                </div>
            </div>
            <!-- End title -->
            <!--Start worker info & price-->
            <div class="container">
                <div class="card bg-warning shadow mt-4 h-190">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset('uploads/images/users/'.$job->bid->where('worker_id', auth()->user()->id)->first()->worker->image) }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">{{ $job->bid->where('worker_id', auth()->user()->id)->first()->worker->full_name }}</h5>
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
                                <button disabled class="btn btn-warning btn-rounded-54 shadow" data-toggle="modal" data-target="#addmoney"> <b>{{ $job->bid->where('worker_id', auth()->user()->id)->first()->budget }}</b> </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-none">
                        <div class="row">
                            <div class="col">
                                <p><b>{{ $job->bid->where('worker_id', auth()->user()->id)->first()->description }}</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-none">
                        <div class="row">
                            <div class="col text-center">
                                <button type="button" onclick="window.location.href='{{ route('worker.bid.edit', \Illuminate\Support\Facades\Crypt::encryptString($job->bid->where('worker_id', auth()->user()->id)->first()->id)) }}'" class="mb-2 btn btn-outline-danger btn-rounded">Cancel this bid</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--End worker info & price-->
            <!-- Start bid title -->
            <div class="">
                <div class="alert alert-info text-center" role="alert">
                    <b id=""> All BIDS</b>
                </div>
            </div>
            <!-- End title -->
        @foreach($job->bid as $bid)
            @if($bid->worker_id != auth()->user()->id)
                <!--Start worker info & price-->
                <div class="container">
                    <div class="card bg-info shadow mt-4 h-190">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <figure class="avatar avatar-60"><img src="{{ asset('uploads/images/users/'.$bid->worker->image) }}" alt=""></figure>
                                </div>
                                <div class="col pl-0 align-self-center">
                                    <h5 class="mb-1">{{ $bid->worker->full_name }}</h5>
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
                                    <button disabled class="btn btn-info btn-rounded-54 shadow" data-toggle="modal" data-target="#addmoney"> <b>{{ $bid->budget }}</b> </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-none">
                            <div class="row">
                                <div class="col">
                                    <p><b>{{ $bid->description }}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End worker info & price-->
            @endif
        @endforeach
    @elseif($job->status == 'cancelled' || $job->bid->where('worker_id', auth()->user()->id)->first()->is_cancelled == 1)
            <!-- Start title -->
            <div class="">
                <div class="alert alert-danger text-center" role="alert">
                    <b id=""> CANCELLED JOB</b>
                </div>
            </div>
            <!-- End title -->
                <!--Start owner info & price-->
                <div class="container">
                    <div class="card bg-danger shadow mt-4 h-190">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <figure class="avatar avatar-60"><img src="{{ asset('uploads/images/users/'.$job->customer->image) }}" alt=""></figure>
                                </div>
                                <div class="col pl-0 align-self-center">
                                    <h5 class="mb-1">{{ $job->customer->full_name }}</h5>
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
                                    <button disabled class="btn btn-danger btn-rounded-54 shadow" data-toggle="modal" data-target="#addmoney"> <b>{{ $job->budget }}</b> </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-none">
                            <div class="row">
                                <div class="col">
                                    <p><b>{{ $job->title }}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End owner info & price-->
                <!--Start work detail , address, day-->
                <div class="container">
                    <h4 class="mb-3"><b>Work detail:</b></h4>
                    <p>{{ $job->description }}</p>
                    <h4 class="mb-3"><b>Address:</b></h4>
                    <p>{{ $job->address }}</p>
                    <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                        <button disabled type="button" class="btn btn-outline-danger active"><b>Cancelled Date</b> <br> <small> {{ date('h:i:s a m/d/y', strtotime($job->bid->where('worker_id', auth()->user()->id)->first()->updated_at)) }}</small></button>
                    </div>
                </div>
                <!--End work detail , address, day-->
                <hr>
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
@endsection
