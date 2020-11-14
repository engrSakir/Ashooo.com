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
    @if($gig->status == 'active')
        <!-- Start title -->
        <div class="">
                <div class="alert alert-info text-center" role="alert">
                    <b id=""> {{ __('system.bid_job') }}</b>
                </div>
        </div>
        <!-- End title -->
        <!--Start owner info & price-->
        <div class="container">
            <div class="card bg-info shadow mt-4 h-190">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset('uploads/images/users/'.$gig->customer->image) }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">{{ $gig->customer->full_name }}</h5>
                                <p class="text-mute small">{{ $gig->customer->phone }}</p>
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
                                <button disabled class="btn btn-info btn-rounded-54 shadow" data-toggle="modal" data-target="#addmoney"> <b>{{ $gig->budget }}</b> </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-none">
                        <div class="row">
                            <div class="col">
                                <p><b>{{ $gig->title }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--End owner info & price-->
        <!--Start work detail , address, day-->
        <div class="container">
            <h4 class="mb-3"><b>{{ __('system.details') }}:</b></h4>
            <pre>{{ $gig->description }}</pre>
            <h4 class="mb-3"><b>{{ __('system.address') }}:</b></h4>
            <p>{{ $gig->address }}</p>
            <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                <input type="hidden" id="gig-id" value="{{ $gig->id }}">
                <button disabled type="button" class="btn btn-outline-success active"><small>{{ __('system.time') }} </small>{{ $gig->day }}<small> {{ __('system.day') }}</small></button>
                <button id="job-cancel" type="button" class="btn btn-danger">{{ __('system.cancel') }}</button>
            </div>
        </div>
        <!--End work detail , address, day-->
            <hr>
        <!-- Start bid title -->
        <div class="">
                <div class="alert alert-info text-center" role="alert">
                    <b id=""> {{ __('system.all_bid') }}</b>
                </div>
            </div>
        <!-- End title -->
       <!-- Start active Bids -->
            <div class="container">
                <div class="row">
                    <div class="col-12 px-0">
                        <div class="list-group list-group-flush ">
                            @foreach($gig->workerBids->where('is_cancelled', 0) as $bid)
                                <div class="list-group-item border-top text-dark">
                                    <div class="row">
                                        <div class="col-auto align-self-center text-center">
                                            <div class="row">
                                                &nbsp;
                                                <i class="material-icons text-template-primary">
                                                    <figure class="avatar avatar-60 border-0">
                                                        <img src="{{ asset('uploads/images/users/'.$bid->worker->image) }}" alt="">
                                                    </figure>
                                                </i>
                                            </div>
                                            <div class="row">
                                                &nbsp;
                                                <span class="badge mb-1">{{ $bid->budget }} ৳</span>
                                            </div>
                                            <div class="row">
                                                &nbsp;
                                                <button type="button" class="mb-2 btn btn-sm btn-success order-now">{{ __('system.order') }}</button>
                                                <input type="hidden" class="worker-bid-id" value="{{ $bid->id }}">
                                            </div>
                                        </div>
                                        <div class="col pl-0">
                                            <div class="row mb-1">
                                                <div class="col">
                                                    <p class="mb-0">{{ $bid->worker->full_name }}</p>
                                                </div>
                                                <div class="col-auto pl-0">
                                                    <p class="small text-mute text-trucated mt-1">
                                                        @php
                                                            $percent = 100 - (($bid->worker->rating->max_rate - $bid->worker->rating->rate)/$bid->worker->rating->max_rate)*100;
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
                                            <p class="small text-mute">{{ \Illuminate\Support\Str::limit($bid->description, 25) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        <!-- End Active Bids -->
        <!-- Start running Bids -->
    @elseif($gig->status == 'running')
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
                            @foreach($gig->workerBids->where('is_selected', '1') as $bid)
                                <div class="list-group-item border-top text-dark">
                                    <!-- worker profile -->
                                    <div class="row">
                                        <div class="col-auto align-self-center text-center">
                                            <i class="material-icons text-template-primary">
                                                <figure class="avatar avatar-60 border-0">
                                                    <img src="{{ asset('uploads/images/users/'.$bid->worker->image) }}" alt="">
                                                </figure>
                                            </i>
                                        </div>
                                        <div class="col pl-0">
                                            <div class="row mb-1">
                                                <div class="col">
                                                    <p class="mb-0">{{ $bid->worker->full_name }}</p>
                                                </div>
                                                <div class="col-auto pl-0">
                                                    <p class="small text-mute text-trucated mt-1">
                                                        @php
                                                            $percent = 100 - (($bid->worker->rating->max_rate - $bid->worker->rating->rate)/$bid->worker->rating->max_rate)*100;
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
                                                <input type="text" class="form-control" id="phone" placeholder="phone" readonly value="{{ $bid->worker->phone }}">
                                                <div class="input-group-prepend">
                                                    <a href="tel:{{ $bid->worker->phone }}">
                                                        <span class="input-group-text bg-success text-white dz-clickable" onclick="" id="phone">Call</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="budget" placeholder="budget" readonly value="{{ __('system.order_price') }}">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-info text-white" id="budget">
                                                        {{ $bid->budget }} ৳
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
                                                        <div class="col text-right">
                                                            <div class="form-group mb-2 ">
                                                                <input type="number" class="form-control text-center" id="price" placeholder="550">
                                                            </div>
                                                            <input type="hidden" id="bid-id" value="{{ $bid->id }}">
                                                            <button type="button" class="btn btn-success mb-2" id="new-price"><b>{{ __('system.submit') }}</b></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- work detail -->
                                    <pre><b>{{ $bid->description }}</b></pre>
                                    <hr>
                                    <b>{{ __('system.details') }}</b>
                                    <pre>{{ $bid->customerGig->description }}</pre>
                                    <br>
                                    <b>{{ __('system.address') }}</b>
                                    <p>{{ $bid->customerGig->address }}</p>
                                    <br>
                                    <b>{{ __('system.image') }}</b>
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" class="custom-file-input" @if($bid->customerGig->image) disabled readonly @endif id="image" required="">
                                        <label class="custom-file-label" for="image">@if($bid->customerGig->image) {{ __('system.already_uploaded') }} @else {{ __('system.chose_file') }}.. @endif</label>
                                    </div>
                                    <hr>
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <h4><b>{{ $bid->customerGig->day }} <br> <small> {{ __('system.day') }}</small></b></h4>
                                        </div>
                                        <div class="col-6">
                                            <button type="button" class="btn btn-success mb-2" id="completed-btn"><b>{{ __('system.rating_and_completed') }}</b></button>
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <button type="button" class="mb-2 w-100 btn btn-lg btn-danger">{{ __('system.complain') }}</button>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Active Bids -->
        <!-- End running Bids -->
    @elseif($gig->status == 'completed')
        <!-- Start title -->
            <div class="">
                <div class="alert alert-success text-center" role="alert">
                    <b id=""> {{ __('system.completed') }}</b>
                </div>
            </div>
            <!-- End title -->
            <!-- Start active Bids -->
            <div class="container">
                <div class="row">
                    <div class="col-12 px-0">
                        <div class="list-group list-group-flush ">
                            @foreach($gig->workerBids->where('is_selected', '1') as $bid)
                                <div class="list-group-item border-top text-dark">
                                    <!-- worker profile -->
                                    <div class="row">
                                        <div class="col-auto align-self-center text-center">
                                            <i class="material-icons text-template-primary">
                                                <figure class="avatar avatar-60 border-0">
                                                    <img src="{{ asset('uploads/images/users/'.$bid->worker->image) }}" alt="">
                                                </figure>
                                            </i>
                                        </div>
                                        <div class="col pl-0">
                                            <div class="row mb-1">
                                                <div class="col">
                                                    <p class="mb-0">{{ $bid->worker->full_name }}</p>
                                                </div>
                                                <div class="col-auto pl-0">
                                                    <p class="small text-mute text-trucated mt-1">
                                                        @php
                                                        $percent = 100 - (($bid->worker->rating->max_rate - $bid->worker->rating->rate)/$bid->worker->rating->max_rate)*100;
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
                                                <input type="text" class="form-control" id="budget" placeholder="budget" readonly value="{{ __('system.order_price') }}">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-info text-white" id="budget">
                                                        {{ $bid->budget }} ৳
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- new budget -->
                                    <!-- work detail -->
                                    <pre><b>{{ $bid->description }}</b></pre>
                                    <hr>
                                    <b>{{ __('system.details') }}</b>
                                    <pre>{{ $bid->customerGig->description }}</pre>
                                    <br>
                                    <b>{{ __('system.address') }}</b>
                                    <p>{{ $bid->customerGig->address }}</p>
                                    <br>
                                    <hr>
                                    <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                                        <button disabled type="button" class="btn btn-outline-success active"><b> {{ __('system.delivery_date') }}</b> <br> <small> {{ date('h:i:s a m/d/Y', strtotime($gig->updated_at)) }}</small></button>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Active Bids -->
    @elseif($gig->status == 'cancelled')
            <!-- Start title -->
            <div class="">
                <div class="alert alert-danger text-center" role="alert">
                    <b id=""> {{ __('system.cancelled_order') }}</b>
                </div>
            </div>
            <!-- End title -->
            <!--Start Canceller info & price-->
            <div class="container">
                <div class="card bg-danger shadow mt-4 h-190">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset('uploads/images/users/'.$gig->cancelInfo->canceller->image) }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">{{ $gig->cancelInfo->canceller->full_name }}</h5>
                                <div class="col-auto pl-0">
                                    <p class="small text-mute text-trucated mt-1">
                                        @php
                                            $percent = 100 - (($gig->cancelInfo->canceller->rating->max_rate - $gig->cancelInfo->canceller->rating->rate)/$gig->cancelInfo->canceller->rating->max_rate)*100;
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
                                <button disabled class="btn btn-danger btn-rounded-54 shadow" data-toggle="modal" data-target="#addmoney"> <b>{{ $gig->budget }}</b> </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-none">
                        <div class="row">
                            <div class="col">
                                <p><b>{{ $gig->title }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Canceller info & price-->
            <hr>
            <!--Start work detail , address, day-->
            <div class="container">
                <h4 class="mb-3"><b>{{ __('system.details') }}:</b></h4>
                <pre>{{ $gig->description }}</pre>
                <h4 class="mb-3"><b>{{ __('system.address') }}:</b></h4>
                <p>{{ $gig->address }}</p>
                <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                    <button disabled type="button" class="btn btn-outline-danger active"><b>{{ __('system.cancelled_date') }}</b> <br> <small> {{ date('h:i:s a m/d/Y', strtotime($gig->updated_at)) }}</small></button>
                </div>
            </div>
    @endif
<!-- page level script -->
<script>
    $(document).ready(function(){
        //Submit
        $(".order-now").click(function (){
            Swal.fire({
                title: 'Are you sure?',
                text: "This worker selected for this job.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Order now!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData();
                    formData.append('bid', $(this).parent().find('.worker-bid-id').val())
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('customer.selectWorkerForCustomerGig') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Successfully order completed',
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
                title: 'Cancel this gig ?',
                text: "",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData();
                    formData.append('gig', $('#gig-id').val())
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('customer.cancelCustomerGig') }}",
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

        //new-price
        $("#new-price").click(function (){
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
                    formData.append('price', $('#price').val())
                    formData.append('bid', $('#bid-id').val())
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('customer.changePriceForMoreWork') }}",
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
                url: "{{ route('customer.imageUploadToCustomerGig') }}",
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
                url: "{{ route('customer.completedCustomerGigJobAndRating') }}",
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
