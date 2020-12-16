@extends('customer.layout.app')
@push('title') {{ __('system.job') }} @endpush
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
                    <b id=""> {{ __('system.gig_order') }}</b>
                </div>
            </div>
            <!-- End title -->
            <!--Start owner info & price-->
            <div class="container">
                <div class="card bg-info shadow mt-4 h-190">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset($customerBid->workerGig->worker->image ?? 'uploads/images/defaults/user.png') }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">{{ $customerBid->workerGig->worker->full_name }}</h5>
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
                                <h3 class="mb-0 font-weight-normal">{{ __('system.price') }} ৳ </h3>
                            </div>
                            <div class="col-auto">
                                <button disabled class="btn btn-info btn-rounded-54 shadow"> <b>{{ $customerBid->budget }}</b> </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-none">
                        <div class="row">
                            <p class="container">{{ __('system.change_your_price') }}d</p>
                            <br>
                        </div>
                        <div class="row">
                            <div class="col">
                                <br>
                                <p><b>{{ __('system.new_price') }}</b></p>
                            </div>
                            <div class="col text-center">
                                <input type="hidden" id="bid-id" value="{{ $customerBid->id }}">
                                <input type="number" id="budget" placeholder="250" class="form-control form-control-lg text-center">
                                <br>
                                <button type="button" id="update-budget" class="mb-2 btn btn-lg btn-info" style="width: 100%">{{ __('system.submit') }}</button>
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
                <pre>{{ $customerBid->description }}</pre>
                <h4 class="mb-3"><b>Address:</b></h4>
                <p>{{ $customerBid->address }}</p>
                <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                    <button disabled type="button" class="btn btn-outline-success active"><small>{{ __('system.time') }} </small>{{ $customerBid->workerGig->day }}<small> {{ __('system.day') }}</small></button>
                    <button id="job-cancel" type="button" class="btn btn-danger">{{ __('system.cancel') }}</button>
                </div>
            </div>
            <!--End work detail , address, day-->
            <hr>
            <!-- End Bids -->
    @elseif($customerBid->status == 'running')
        <!-- Start title -->
            <div class="">
                <div class="alert alert-success text-center" role="alert">
                    <b id=""> {{ __('Running') }}</b>
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
                                                <img src="{{ asset($customerBid->workerGig->worker->image ?? 'uploads/images/defaults/user.png') }}" alt="">
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
                                                <a href="tel:{{ $customerBid->workerGig->worker->phone }}">
                                                    <span class="input-group-text bg-success text-white dz-clickable" onclick="" id="phone">{{ __('system.call') }}</span>
                                                </a>
                                            </div>
                                        </div>
                                        <br>
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
                                                    {{ __('system.change_your_price') }}
                                                    <hr>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <b> {{ __('system.new_price') }} ৳</b>
                                                    </div>
                                                    <div class="col text-center">
                                                        <input type="hidden" id="bid-id" value="{{ $customerBid->id }}">
                                                        <input type="number" id="budget" placeholder="250" class="form-control form-control-lg text-center">
                                                        <br>
                                                        <button type="button" id="update-budget" class="mb-2 btn btn-lg btn-info" style="width: 100%">{{ __('system.submit') }}</button>
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
                                <pre>{{ $customerBid->description }}</pre>
                                <br>
                                <b>{{ 'Address:' }}</b>
                                <p>{{ $customerBid->address }}</p>
                                <br>
                                <b>{{ 'Image:' }}</b>
                                <div class="custom-file">
                                    <input type="file" accept="image/*" class="custom-file-input" @if($customerBid->image) disabled readonly @endif id="image" required="">
                                    <label class="custom-file-label" for="image">@if($customerBid->image) {{ __('Already uploaded') }} @else {{ __('Chose file') }} @endif</label>
                                </div>
                                <hr>
                                <div class="row text-center">
                                    <div class="col-6">
                                        <h4><b>{{ $customerBid->workerGig->day }} <br> <small> {{ __('Day') }}</small></b></h4>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-success mb-2" id="completed-btn"><b>{{ __('Rate and Complete') }}</b></button>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <button type="button" class="mb-2 w-100 btn btn-lg btn-danger">{{ __('Complain') }}</button>
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
                    <b id=""> {{ __('Completed') }}</b>
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
                                                <img src="{{ asset($customerBid->workerGig->worker->image ?? 'uploads/images/defaults/user.png') }}" alt="">
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
                                <pre>{{ $customerBid->description }}</pre>
                                <br>
                                <b>{{ 'Address:' }}</b>
                                <p>{{ $customerBid->address }}</p>
                                <br>
                                <hr>
                                <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                                    <button disabled type="button" class="btn btn-outline-success active">
                                        <b>{{ __('Delivery date') }}</b> <br>
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
                    <b id="">{{ __('Cancelled') }}</b>
                </div>
            </div>
            <!-- End title -->
            <!--Start owner info & price-->
            <div class="container">
                <div class="card bg-danger shadow mt-4 h-190">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset($customerBid->customer->image ?? 'uploads/images/defaults/user.png') }}" alt=""></figure>
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
                                <h3 class="mb-0 font-weight-normal">{{ __('Price') }} ৳ </h3>
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
                <h4 class="mb-3"><b>{{ __('Details') }}:</b></h4>
                <pre>{{ $customerBid->description }}</pre>
                <h4 class="mb-3"><b>{{ __('Address') }}:</b></h4>
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
