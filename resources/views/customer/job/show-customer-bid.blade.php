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
    @if($customerBid->status == 'active')
        <!-- Start title -->
            <div class="">
                <div class="alert alert-info text-center" role="alert">
                    <b id=""> GIG JOB</b>
                </div>
            </div>
            <!-- End title -->
            <!--Start owner info & price-->
            <div class="container">
                <div class="card bg-info shadow mt-4 h-190">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset('uploads/images/users/'.$customerBid->customer->image) }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">{{ $customerBid->customer->full_name }}</h5>
                                <div class="col-auto pl-0">

                                    <p class="small text-mute text-trucated mt-1">
                                        @php
                                            $percent = 100 - (($customerBid->customer->rating->max_rate - $customerBid->customer->rating->rate)/$customerBid->customer->rating->max_rate)*100;
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
                                <button disabled class="btn btn-info btn-rounded-54 shadow"> <b>{{ $customerBid->budget }}</b> </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-none">
                        <div class="row">
                            <p class="container">Change your price for more work or if you need</p>
                            <br>
                        </div>
                        <div class="row">
                            <div class="col">
                                <br>
                                <p><b>New price</b></p>
                            </div>
                            <div class="col text-center">
                                <input type="hidden" id="bid-id" value="{{ $customerBid->id }}">
                                <input type="number" id="budget" placeholder="250" class="form-control form-control-lg text-center">
                                <br>
                                <button type="button" id="update-budget" class="mb-2 btn btn-lg btn-info" style="width: 100%">Submit</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--End owner info & price-->

            <!--Start work detail , address, day-->
            <div class="container">
                <h5 class="mb-3"><b> {{ $customerBid->workerGig->title }} </b></h5>
                <br>
                <h4 class="mb-3"><b>Work details:</b></h4>
                <p>{{ $customerBid->description }}</p>
                <h4 class="mb-3"><b>Address:</b></h4>
                <p>{{ $customerBid->address }}</p>
                <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                    <button disabled type="button" class="btn btn-outline-success active"><small>Time </small>{{ $customerBid->workerGig->day }}<small> Days</small></button>
                    <button id="job-cancel" type="button" class="btn btn-danger">Cancel</button>
                </div>
            </div>
            <!--End work detail , address, day-->
            <hr>
            <!-- End Bids -->
    @elseif($customerBid->status == 'running')
        <!-- Start title -->
            <div class="">
                <div class="alert alert-success text-center" role="alert">
                    <b id=""> RUNNING JOB</b>
                </div>
            </div>
            <!-- End title -->
            <!-- Start active Bids -->
            <div class="container">
                <div class="row">
                    <div class="col-12 px-0">
                        <div class="list-group list-group-flush ">
                            <div class="list-group-item border-top text-dark">
                                <!-- worker profile -->
                                <div class="row">
                                    <div class="col-auto align-self-center text-center">
                                        <i class="material-icons text-template-primary">
                                            <figure class="avatar avatar-60 border-0">
                                                <img src="{{ asset('uploads/images/users/'.$customerBid->workerGig->worker->image) }}" alt="">
                                            </figure>
                                        </i>
                                    </div>
                                    <div class="col pl-0">
                                        <div class="row mb-1">
                                            <div class="col">
                                                <p class="mb-0">{{ $customerBid->workerGig->worker->full_name }}</p>
                                            </div>
                                            <div class="col-auto pl-0">
                                                <p class="small text-mute text-trucated mt-1">
                                                    @php
                                                        $percent = 100 - (($customerBid->workerGig->worker->rating->max_rate - $customerBid->workerGig->worker->rating->rate)/$customerBid->workerGig->worker->rating->max_rate)*100;
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
                                                        <i class="material-icons btn-outline-warning small">star</i>
                                                    @endfor
                                                </p>
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <input type="text" class="form-control" id="phone" placeholder="phone" readonly value="{{ $customerBid->workerGig->worker->phone }}">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-success text-white dz-clickable" onclick="" id="phone">Call</span>
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="budget" readonly value="Order price">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text bg-info text-white">
                                                        {{ $customerBid->budget }} ৳
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <!-- new budget -->
                                <div class="">
                                    <div class="alert alert-danger text-center" role="alert">
                                        <div class="row">
                                            <div class="container">
                                                <div class="row container">
                                                    New budget for more work
                                                    <hr>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <b> {{ 'New budget' }} ৳</b>
                                                    </div>
                                                    <div class="col text-center">
                                                        <input type="hidden" id="bid-id" value="{{ $customerBid->id }}">
                                                        <input type="number" id="budget" placeholder="250" class="form-control form-control-lg text-center">
                                                        <br>
                                                        <button type="button" id="update-budget" class="mb-2 btn btn-lg btn-info" style="width: 100%">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- work detail -->
                                <b>{{ $customerBid->workerGig->description }}</b>
                                <hr>
                                <b>{{ 'Details:' }}</b>
                                <p>{{ $customerBid->description }}</p>
                                <br>
                                <b>{{ 'Address:' }}</b>
                                <p>{{ $customerBid->address }}</p>
                                <br>
                                <b>{{ 'Image:' }}</b>
                                <div class="custom-file">
                                    <input type="file" accept="image/*" class="custom-file-input" @if($customerBid->image) disabled readonly @endif id="image" required="">
                                    <label class="custom-file-label" for="image">@if($customerBid->image) Image uploaded @else Choose file... @endif</label>
                                </div>
                                <hr>
                                <div class="row text-center">
                                    <div class="col-6">
                                        <h4><b>{{ $customerBid->workerGig->day }} <br> <small> Days</small></b></h4>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-success mb-2" id="completed-btn"><b>Rating & Complete</b></button>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <button type="button" class="mb-2 w-100 btn btn-lg btn-danger">Complain</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Active Bids -->
            <!-- End running Bids -->

    @elseif($customerBid->status == 'completed')
        <!-- Start title -->
            <div class="">
                <div class="alert alert-success text-center" role="alert">
                    <b id=""> COMPLETED JOB</b>
                </div>
            </div>
            <!-- End title -->
            <!-- Start Completed Bids -->
            <div class="container">
                <div class="row">
                    <div class="col-12 px-0">
                        <div class="list-group list-group-flush ">
                            <div class="list-group-item border-top text-dark">
                                <!-- worker profile -->
                                <div class="row">
                                    <div class="col-auto align-self-center text-center">
                                        <i class="material-icons text-template-primary">
                                            <figure class="avatar avatar-60 border-0">
                                                <img src="{{ asset('uploads/images/users/'.$customerBid->workerGig->worker->image) }}" alt="">
                                            </figure>
                                        </i>
                                    </div>
                                    <div class="col pl-0">
                                        <div class="row mb-1">
                                            <div class="col">
                                                <p class="mb-0">{{ $customerBid->workerGig->worker->full_name }}</p>
                                            </div>
                                            <div class="col-auto pl-0">
                                                <p class="small text-mute text-trucated mt-1">
                                                    @php
                                                        $percent = 100 - (($customerBid->workerGig->worker->rating->max_rate - $customerBid->workerGig->worker->rating->rate)/$customerBid->workerGig->worker->rating->max_rate)*100;
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
                                                        <i class="material-icons btn-outline-warning small">star</i>
                                                    @endfor
                                                </p>
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="budget" readonly value="Order price">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text bg-info text-white">
                                                        {{ $customerBid->budget }} ৳
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <!-- work detail -->
                                <b>{{ $customerBid->workerGig->description }}</b>
                                <hr>
                                <b>{{ 'Details:' }}</b>
                                <p>{{ $customerBid->description }}</p>
                                <br>
                                <b>{{ 'Address:' }}</b>
                                <p>{{ $customerBid->address }}</p>
                                <br>
                                <hr>
                                <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                                    <button disabled type="button" class="btn btn-outline-success active">
                                        <b>Delivery Date</b> <br>
                                        <small>
                                            {{ date('h:i:s a m/d/Y', strtotime($customerBid->updated_at)) }}
                                        </small>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Completed Bids -->
            <!-- End Completed Bids -->
    @elseif($customerBid->status == 'cancelled')
        <!-- Start title -->
            <div class="">
                <div class="alert alert-danger text-center" role="alert">
                    <b id=""> CANCELLED ORDER</b>
                </div>
            </div>
            <!-- End title -->
            <!--Start owner info & price-->
            <div class="container">
                <div class="card bg-danger shadow mt-4 h-190">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset('uploads/images/users/'.$customerBid->customer->image) }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">{{ $customerBid->customer->full_name }}</h5>
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
                                <button disabled class="btn btn-danger btn-rounded-54 shadow" data-toggle="modal" data-target="#addmoney"> <b>{{ $customerBid->budget }}</b> </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-none">
                        <div class="row">
                            <div class="col">
                                <p><b>{{ $customerBid->workerGig->title }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End owner info & price-->
            <!--Start work detail , address, day-->
            <div class="container">
                <h4 class="mb-3"><b>Work detail:</b></h4>
                <p>{{ $customerBid->description }}</p>
                <h4 class="mb-3"><b>Address:</b></h4>
                <p>{{ $customerBid->address }}</p>
                <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                    <button disabled type="button" class="btn btn-outline-danger active">
                        <b>Cancelled Date</b> <br>
                        <small>
                            {{ date('h:i:s a m/d/Y', strtotime($customerBid->updated_at)) }}
                        </small>
                    </button>
                </div>
            </div>
            <!--End work detail , address, day-->
            <hr>
            <hr>

    @endif
    <!-- footer-->
    <!-- Modal -->
    <div class="modal fade" id="complete-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center pt-0">
                    <style>

                        .customRating * {
                            box-sizing: border-box;
                        }

                        .customRating .container {
                            background-image: url("https://www.toptal.com/designers/subtlepatterns/patterns/concrete-texture.png");
                            display: flex;
                            flex-wrap: wrap;
                            height: 100vh;
                            align-items: center;
                            justify-content: center;
                            padding: 0 20px;
                        }

                        .customRating .rating {
                            display: flex;
                            width: 100%;
                            justify-content: center;
                            overflow: hidden;
                            flex-direction: row-reverse;
                            height: 150px;
                            position: relative;
                        }

                        .customRating .rating-0 {
                            filter: grayscale(100%);
                        }

                        .customRating .rating > input {
                            display: none;
                        }

                        .customRating .rating > label {
                            cursor: pointer;
                            width: 40px;
                            height: 40px;
                            margin-top: auto;
                            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23e3e3e3' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
                            background-repeat: no-repeat;
                            background-position: center;
                            background-size: 76%;
                            transition: 0.3s;
                        }

                        .customRating .rating > input:checked ~ label,
                        .customRating .rating > input:checked ~ label ~ label {
                            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23fcd93a' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
                        }

                        .customRating .rating > input:not(:checked) ~ label:hover,
                        .customRating .rating > input:not(:checked) ~ label:hover ~ label {
                            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23d8b11e' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
                        }

                        .customRating .emoji-wrapper {
                            width: 100%;
                            text-align: center;
                            height: 100px;
                            overflow: hidden;
                            position: absolute;
                            top: 0;
                            left: 0;
                        }

                        .customRating .emoji-wrapper:before,
                        .customRating .emoji-wrapper:after {
                            content: "";
                            height: 15px;
                            width: 100%;
                            position: absolute;
                            left: 0;
                            z-index: 1;
                        }

                        .customRating .emoji-wrapper:before {
                            top: 0;
                            background: linear-gradient(
                                to bottom,
                                rgba(255, 255, 255, 1) 0%,
                                rgba(255, 255, 255, 1) 35%,
                                rgba(255, 255, 255, 0) 100%
                            );
                        }

                        .customRating .emoji-wrapper:after {
                            bottom: 0;
                            background: linear-gradient(
                                to top,
                                rgba(255, 255, 255, 1) 0%,
                                rgba(255, 255, 255, 1) 35%,
                                rgba(255, 255, 255, 0) 100%
                            );
                        }

                        .customRating .emoji {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            transition: 0.3s;
                        }

                        .customRating .emoji > svg {
                            margin: 15px 0;
                            width: 70px;
                            height: 70px;
                            flex-shrink: 0;
                        }

                        #rating-1:checked ~ .emoji-wrapper > .emoji {
                            transform: translateY(-100px);
                        }
                        #rating-2:checked ~ .emoji-wrapper > .emoji {
                            transform: translateY(-200px);
                        }
                        #rating-3:checked ~ .emoji-wrapper > .emoji {
                            transform: translateY(-300px);
                        }
                        #rating-4:checked ~ .emoji-wrapper > .emoji {
                            transform: translateY(-400px);
                        }
                        #rating-5:checked ~ .emoji-wrapper > .emoji {
                            transform: translateY(-500px);
                        }

                        .customRating .feedback {
                            max-width: 360px;
                            background-color: #fff;
                            width: 100%;
                            padding: 30px;
                            border-radius: 8px;
                            display: flex;
                            flex-direction: column;
                            flex-wrap: wrap;
                            align-items: center;
                            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
                        }


                    </style>

                    <div class="customRating container">
                        <div class="feedback">
                            <div class="rating">
                                <input type="radio" name="rating" class="rating-btn" value="5" id="rating-5">
                                <label for="rating-5"></label>
                                <input type="radio" name="rating" class="rating-btn" value="4" id="rating-4">
                                <label for="rating-4"></label>
                                <input type="radio" name="rating" class="rating-btn" value="3" id="rating-3">
                                <label for="rating-3"></label>
                                <input type="radio" name="rating" class="rating-btn" value="2" id="rating-2">
                                <label for="rating-2"></label>
                                <input type="radio" name="rating" class="rating-btn" value="1" id="rating-1">
                                <label for="rating-1"></label>
                                <div class="emoji-wrapper">
                                    <div class="emoji">
                                        <svg class="rating-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                            <path d="M512 256c0 141.44-114.64 256-256 256-80.48 0-152.32-37.12-199.28-95.28 43.92 35.52 99.84 56.72 160.72 56.72 141.36 0 256-114.56 256-256 0-60.88-21.2-116.8-56.72-160.72C474.8 103.68 512 175.52 512 256z" fill="#f4c534"/>
                                            <ellipse transform="scale(-1) rotate(31.21 715.433 -595.455)" cx="166.318" cy="199.829" rx="56.146" ry="56.13" fill="#fff"/>
                                            <ellipse transform="rotate(-148.804 180.87 175.82)" cx="180.871" cy="175.822" rx="28.048" ry="28.08" fill="#3e4347"/>
                                            <ellipse transform="rotate(-113.778 194.434 165.995)" cx="194.433" cy="165.993" rx="8.016" ry="5.296" fill="#5a5f63"/>
                                            <ellipse transform="scale(-1) rotate(31.21 715.397 -1237.664)" cx="345.695" cy="199.819" rx="56.146" ry="56.13" fill="#fff"/>
                                            <ellipse transform="rotate(-148.804 360.25 175.837)" cx="360.252" cy="175.84" rx="28.048" ry="28.08" fill="#3e4347"/>
                                            <ellipse transform="scale(-1) rotate(66.227 254.508 -573.138)" cx="373.794" cy="165.987" rx="8.016" ry="5.296" fill="#5a5f63"/>
                                            <path d="M370.56 344.4c0 7.696-6.224 13.92-13.92 13.92H155.36c-7.616 0-13.92-6.224-13.92-13.92s6.304-13.92 13.92-13.92h201.296c7.696.016 13.904 6.224 13.904 13.92z" fill="#3e4347"/>
                                        </svg>
                                        <svg class="rating-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                            <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                            <path d="M328.4 428a92.8 92.8 0 0 0-145-.1 6.8 6.8 0 0 1-12-5.8 86.6 86.6 0 0 1 84.5-69 86.6 86.6 0 0 1 84.7 69.8c1.3 6.9-7.7 10.6-12.2 5.1z" fill="#3e4347"/>
                                            <path d="M269.2 222.3c5.3 62.8 52 113.9 104.8 113.9 52.3 0 90.8-51.1 85.6-113.9-2-25-10.8-47.9-23.7-66.7-4.1-6.1-12.2-8-18.5-4.2a111.8 111.8 0 0 1-60.1 16.2c-22.8 0-42.1-5.6-57.8-14.8-6.8-4-15.4-1.5-18.9 5.4-9 18.2-13.2 40.3-11.4 64.1z" fill="#f4c534"/>
                                            <path d="M357 189.5c25.8 0 47-7.1 63.7-18.7 10 14.6 17 32.1 18.7 51.6 4 49.6-26.1 89.7-67.5 89.7-41.6 0-78.4-40.1-82.5-89.7A95 95 0 0 1 298 174c16 9.7 35.6 15.5 59 15.5z" fill="#fff"/>
                                            <path d="M396.2 246.1a38.5 38.5 0 0 1-38.7 38.6 38.5 38.5 0 0 1-38.6-38.6 38.6 38.6 0 1 1 77.3 0z" fill="#3e4347"/>
                                            <path d="M380.4 241.1c-3.2 3.2-9.9 1.7-14.9-3.2-4.8-4.8-6.2-11.5-3-14.7 3.3-3.4 10-2 14.9 2.9 4.9 5 6.4 11.7 3 15z" fill="#fff"/>
                                            <path d="M242.8 222.3c-5.3 62.8-52 113.9-104.8 113.9-52.3 0-90.8-51.1-85.6-113.9 2-25 10.8-47.9 23.7-66.7 4.1-6.1 12.2-8 18.5-4.2 16.2 10.1 36.2 16.2 60.1 16.2 22.8 0 42.1-5.6 57.8-14.8 6.8-4 15.4-1.5 18.9 5.4 9 18.2 13.2 40.3 11.4 64.1z" fill="#f4c534"/>
                                            <path d="M155 189.5c-25.8 0-47-7.1-63.7-18.7-10 14.6-17 32.1-18.7 51.6-4 49.6 26.1 89.7 67.5 89.7 41.6 0 78.4-40.1 82.5-89.7A95 95 0 0 0 214 174c-16 9.7-35.6 15.5-59 15.5z" fill="#fff"/>
                                            <path d="M115.8 246.1a38.5 38.5 0 0 0 38.7 38.6 38.5 38.5 0 0 0 38.6-38.6 38.6 38.6 0 1 0-77.3 0z" fill="#3e4347"/>
                                            <path d="M131.6 241.1c3.2 3.2 9.9 1.7 14.9-3.2 4.8-4.8 6.2-11.5 3-14.7-3.3-3.4-10-2-14.9 2.9-4.9 5-6.4 11.7-3 15z" fill="#fff"/>
                                        </svg>
                                        <svg class="rating-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                            <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                            <path d="M336.6 403.2c-6.5 8-16 10-25.5 5.2a117.6 117.6 0 0 0-110.2 0c-9.4 4.9-19 3.3-25.6-4.6-6.5-7.7-4.7-21.1 8.4-28 45.1-24 99.5-24 144.6 0 13 7 14.8 19.7 8.3 27.4z" fill="#3e4347"/>
                                            <path d="M276.6 244.3a79.3 79.3 0 1 1 158.8 0 79.5 79.5 0 1 1-158.8 0z" fill="#fff"/>
                                            <circle cx="340" cy="260.4" r="36.2" fill="#3e4347"/>
                                            <g fill="#fff">
                                                <ellipse transform="rotate(-135 326.4 246.6)" cx="326.4" cy="246.6" rx="6.5" ry="10"/>
                                                <path d="M231.9 244.3a79.3 79.3 0 1 0-158.8 0 79.5 79.5 0 1 0 158.8 0z"/>
                                            </g>
                                            <circle cx="168.5" cy="260.4" r="36.2" fill="#3e4347"/>
                                            <ellipse transform="rotate(-135 182.1 246.7)" cx="182.1" cy="246.7" rx="10" ry="6.5" fill="#fff"/>
                                        </svg>
                                        <svg class="rating-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                            <path d="M407.7 352.8a163.9 163.9 0 0 1-303.5 0c-2.3-5.5 1.5-12 7.5-13.2a780.8 780.8 0 0 1 288.4 0c6 1.2 9.9 7.7 7.6 13.2z" fill="#3e4347"/>
                                            <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                            <g fill="#fff">
                                                <path d="M115.3 339c18.2 29.6 75.1 32.8 143.1 32.8 67.1 0 124.2-3.2 143.2-31.6l-1.5-.6a780.6 780.6 0 0 0-284.8-.6z"/>
                                                <ellipse cx="356.4" cy="205.3" rx="81.1" ry="81"/>
                                            </g>
                                            <ellipse cx="356.4" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347"/>
                                            <g fill="#fff">
                                                <ellipse transform="scale(-1) rotate(45 454 -906)" cx="375.3" cy="188.1" rx="12" ry="8.1"/>
                                                <ellipse cx="155.6" cy="205.3" rx="81.1" ry="81"/>
                                            </g>
                                            <ellipse cx="155.6" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347"/>
                                            <ellipse transform="scale(-1) rotate(45 454 -421.3)" cx="174.5" cy="188" rx="12" ry="8.1" fill="#fff"/>
                                        </svg>
                                        <svg class="rating-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                            <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                            <path d="M232.3 201.3c0 49.2-74.3 94.2-74.3 94.2s-74.4-45-74.4-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b"/>
                                            <path d="M96.1 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2C80.2 229.8 95.6 175.2 96 173.3z" fill="#d03f3f"/>
                                            <path d="M215.2 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff"/>
                                            <path d="M428.4 201.3c0 49.2-74.4 94.2-74.4 94.2s-74.3-45-74.3-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b"/>
                                            <path d="M292.2 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2-77.8-65.7-62.4-120.3-61.9-122.2z" fill="#d03f3f"/>
                                            <path d="M411.3 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff"/>
                                            <path d="M381.7 374.1c-30.2 35.9-75.3 64.4-125.7 64.4s-95.4-28.5-125.8-64.2a17.6 17.6 0 0 1 16.5-28.7 627.7 627.7 0 0 0 218.7-.1c16.2-2.7 27 16.1 16.3 28.6z" fill="#3e4347"/>
                                            <path d="M256 438.5c25.7 0 50-7.5 71.7-19.5-9-33.7-40.7-43.3-62.6-31.7-29.7 15.8-62.8-4.7-75.6 34.3 20.3 10.4 42.8 17 66.5 17z" fill="#e24b4b"/>
                                        </svg>
                                        <svg class="rating-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <g fill="#ffd93b">
                                                <circle cx="256" cy="256" r="256"/>
                                                <path d="M512 256A256 256 0 0 1 56.8 416.7a256 256 0 0 0 360-360c58 47 95.2 118.8 95.2 199.3z"/>
                                            </g>
                                            <path d="M512 99.4v165.1c0 11-8.9 19.9-19.7 19.9h-187c-13 0-23.5-10.5-23.5-23.5v-21.3c0-12.9-8.9-24.8-21.6-26.7-16.2-2.5-30 10-30 25.5V261c0 13-10.5 23.5-23.5 23.5h-187A19.7 19.7 0 0 1 0 264.7V99.4c0-10.9 8.8-19.7 19.7-19.7h472.6c10.8 0 19.7 8.7 19.7 19.7z" fill="#e9eff4"/>
                                            <path d="M204.6 138v88.2a23 23 0 0 1-23 23H58.2a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#45cbea"/>
                                            <path d="M476.9 138v88.2a23 23 0 0 1-23 23H330.3a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#e84d88"/>
                                            <g fill="#38c0dc">
                                                <path d="M95.2 114.9l-60 60v15.2l75.2-75.2zM123.3 114.9L35.1 203v23.2c0 1.8.3 3.7.7 5.4l116.8-116.7h-29.3z"/>
                                            </g>
                                            <g fill="#d23f77">
                                                <path d="M373.3 114.9l-66 66V196l81.3-81.2zM401.5 114.9l-94.1 94v17.3c0 3.5.8 6.8 2.2 9.8l121.1-121.1h-29.2z"/>
                                            </g>
                                            <path d="M329.5 395.2c0 44.7-33 81-73.4 81-40.7 0-73.5-36.3-73.5-81s32.8-81 73.5-81c40.5 0 73.4 36.3 73.4 81z" fill="#3e4347"/>
                                            <path d="M256 476.2a70 70 0 0 0 53.3-25.5 34.6 34.6 0 0 0-58-25 34.4 34.4 0 0 0-47.8 26 69.9 69.9 0 0 0 52.6 24.5z" fill="#e24b4b"/>
                                            <path d="M290.3 434.8c-1 3.4-5.8 5.2-11 3.9s-8.4-5.1-7.4-8.7c.8-3.3 5.7-5 10.7-3.8 5.1 1.4 8.5 5.3 7.7 8.6z" fill="#fff" opacity=".2"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" id="completed-submit" class="btn btn-default btn-lg btn-rounded shadow btn-block">SUBMIT</button>
                </div>
            </div>
        </div>
    </div>


    <!-- page level script -->
    <script>
        $(document).ready(function(){
            //Update Budget with confirm alert
            $("#update-budget").click(function (){
                Swal.fire({
                    title: 'Price update ?',
                    text: "",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update now!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var formData = new FormData();
                        formData.append('bid', $('#bid-id').val())
                        formData.append('budget', $('#budget').val())
                        $.ajax({
                            method: 'POST',
                            url: "{{ route('customer.updateCustomerBidBudget') }}",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: data.type,
                                    title: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                setTimeout(function() {
                                    location.reload()
                                }, 1000); //1 second
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
                    }
                })
            });

            //Job Cancel with confirm alert
            $("#job-cancel").click(function (){
                Swal.fire({
                    title: 'Cancel this bid ?',
                    text: "",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var formData = new FormData();
                        formData.append('bid', $('#bid-id').val())
                        $.ajax({
                            method: 'POST',
                            url: "{{ route('customer.cancelCustomerBid') }}",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: data.type,
                                    title: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                setTimeout(function() {
                                    location.reload()
                                }, 1000); //1 second
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
                    }
                })
            });

            //Job image upload
            $('#image').change(function(){
                var formData = new FormData();
                formData.append('bid', $('#bid-id').val())
                formData.append('image', $('#image')[0].files[0])
                $.ajax({
                    method: 'POST',
                    url: "{{ route('customer.imageUploadToCustomerBid') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: data.type,
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function() {
                            //your code to be executed after 1 second
                            location.reload();
                        }, 1000); //1 second
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

            //Complete and rating
            $('#completed-btn').click(function (){
                $('#complete-modal').modal('show');
            });

            //Rating and completed submit
            $('#completed-submit').click(function (){

                var formData = new FormData();
                formData.append('rate', $('.rating-btn:checked').val())
                formData.append('bid', $('#bid-id').val())
                $.ajax({
                    method: 'POST',
                    url: "{{ route('customer.completedCustomerBidJobAndRating') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function () {
                            location.reload()
                        }, 1000); //1 second
                    }
                });
            });
        });
    </script>
@endsection
