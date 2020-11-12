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

    <!--Start active job detail view -->
    @if($customerGig->status == 'active' && $customerGig->workerBids->where('worker_id', auth()->user()->id)->first()->is_cancelled == 0)
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
                                    <figure class="avatar avatar-60"><img src="{{ asset('uploads/images/users/'.$customerGig->customer->image) }}" alt=""></figure>
                                </div>
                                <div class="col pl-0 align-self-center">
                                    <h5 class="mb-1">{{ $customerGig->customer->full_name }}</h5>
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
                                    <button disabled class="btn btn-info btn-rounded-54 shadow" data-toggle="modal" data-target="#addmoney"> <b>{{ $customerGig->budget }}</b> </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-none">
                            <div class="row">
                                <div class="col">
                                    <p><b>{{ $customerGig->title }}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!--End owner info & price-->
            <!--Start work detail , address, day-->
            <div class="container">
                <h4 class="mb-3"><b>Work details:</b></h4>
                <pre>{{ $customerGig->description }}</pre>
                <h4 class="mb-3"><b>Address:</b></h4>
                <p>{{ $customerGig->address }}</p>
                <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                    <button disabled type="button" class="btn btn-outline-success active col"><small>Time  </small>{{ $customerGig->day }}<small> Days</small></button>
                    <button disabled type="button" class="btn btn-success col">{{  date('h:i a m/d/Y', strtotime($customerGig->created_at)) }}</button>
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
                                <figure class="avatar avatar-60"><img src="{{ asset('uploads/images/users/'.$customerGig->workerBids->where('worker_id', auth()->user()->id)->first()->worker->image) }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">{{ $customerGig->workerBids->where('worker_id', auth()->user()->id)->first()->worker->full_name }}</h5>
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
                                <button disabled class="btn btn-warning btn-rounded-54 shadow" data-toggle="modal" data-target="#addmoney"> <b>{{ $customerGig->workerBids->where('worker_id', auth()->user()->id)->first()->budget }}</b> </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-none">
                        <div class="row">
                            <div class="col">
                                <pre><b>{{ $customerGig->workerBids->where('worker_id', auth()->user()->id)->first()->description }}</b></pre>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-none">
                        <div class="row">
                            <div class="col text-center">
                                <button type="button" id="canceller-btn" value="{{ $customerGig->workerBids->where('worker_id', auth()->user()->id)->first()->id }}" class="mb-2 btn btn-outline-danger btn-rounded">Cancel this bid</button>
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
        @foreach($customerGig->workerBids->where('worker_id', '!=', auth()->user()->id)->where('is_cancelled', 0) as $bid)
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
                                    <pre><b>{{ $bid->description }}</b></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End worker info & price-->
        @endforeach

    @elseif($customerGig->status == 'running' && $customerGig->workerBids->where('is_selected', '1')->where('worker_id', auth()->user()->id)->first())
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
                            @foreach($customerGig->workerBids->where('is_selected', '1')->where('worker_id', auth()->user()->id) as $bid)
                                <div class="list-group-item border-top text-dark">
                                    <!-- worker profile -->
                                    <div class="row">
                                        <div class="col-auto align-self-center text-center">
                                            <i class="material-icons text-template-primary">
                                                <figure class="avatar avatar-60 border-0">
                                                    <img src="{{ asset('uploads/images/users/'.$bid->customerGig->customer->image) }}" alt="">
                                                </figure>
                                            </i>
                                        </div>
                                        <div class="col pl-0">
                                            <div class="row mb-1">
                                                <div class="col">
                                                    <p class="mb-0">{{ $bid->customerGig->customer->full_name }}</p>
                                                </div>
                                                <div class="col-auto pl-0">
                                                    <p class="small text-mute text-trucated mt-1">
                                                        @php
                                                            $percent = 100 - (($bid->customerGig->customer->rating->max_rate - $bid->customerGig->customer->rating->rate)/$bid->customerGig->customer->rating->max_rate)*100;
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
                                                <input type="text" class="form-control" id="phone" placeholder="phone" readonly value="{{ $bid->customerGig->customer->phone }}">
                                                <div class="input-group-prepend">
                                                    <a href="tel:{{ $bid->customerGig->customer->phone }}">
                                                        <span class="input-group-text bg-success text-white dz-clickable" onclick="" id="phone">Call</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="budget" placeholder="budget" readonly value="Order price">
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
                                                        New budget for more work
                                                        <hr>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <b> {{ 'New budget' }} ৳</b>
                                                        </div>
                                                        <div class="col text-right">
                                                            <div class="form-group mb-2 ">
                                                                <input type="number" class="form-control text-center" id="price" placeholder="550">
                                                            </div>
                                                            <input type="hidden" id="bid-id" value="{{ $bid->id }}">
                                                            <button type="button" class="btn btn-success mb-2" id="update-budget"><b>Submit</b></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- work detail -->
                                    <pre><b>{{ $bid->description }}</b></pre>
                                    <hr>
                                    <b>{{ 'Details:' }}</b>
                                    <pre>{{ $bid->customerGig->description }}</pre>
                                    <br>
                                    <b>{{ 'Address:' }}</b>
                                    <p>{{ $bid->customerGig->address }}</p>
                                    <br>
                                    <b>{{ 'Image:' }}</b><br>

                                    @if($bid->customerGig->image)
                                        <img src="{{ asset('uploads/images/jobs/'.$bid->customerGig->image) }}" class="text-center" style="width: 100%; max-height: 2000px; border: 10px solid darkred; border-radius: 25px;">
                                    @else
                                        <b>Image not uploaded</b>
                                    @endif
                                    <hr>
                                    <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                                        <button disabled type="button" class="btn btn-outline-success active col"><small>Time  </small>{{ $customerGig->day }}<small> Days</small></button>
                                        <button disabled type="button" class="btn btn-success col">{{  date('h:i a m/d/Y', strtotime($customerGig->created_at)) }}</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Active Bids -->
            <!-- End running Bids -->
    @elseif($customerGig->status == 'completed' && $customerGig->workerBids->where('is_selected', '1')->where('worker_id', auth()->user()->id)->first())
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
                            @foreach($customerGig->workerBids->where('is_selected', '1')->where('worker_id', auth()->user()->id) as $bid)
                                <div class="list-group-item border-top text-dark">
                                    <!-- worker profile -->
                                    <div class="row">
                                        <div class="col-auto align-self-center text-center">
                                            <i class="material-icons text-template-primary">
                                                <figure class="avatar avatar-60 border-0">
                                                    <img src="{{ asset('uploads/images/users/'.$bid->customerGig->customer->image) }}" alt="">
                                                </figure>
                                            </i>
                                        </div>
                                        <div class="col pl-0">
                                            <div class="row mb-1">
                                                <div class="col">
                                                    <p class="mb-0">{{ $bid->customerGig->customer->full_name }}</p>
                                                </div>
                                                <div class="col-auto pl-0">
                                                    <p class="small text-mute text-trucated mt-1">
                                                        @php
                                                            $percent = 100 - (($bid->customerGig->customer->rating->max_rate - $bid->customerGig->customer->rating->rate)/$bid->customerGig->customer->rating->max_rate)*100;
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
                                                <input type="text" class="form-control" id="budget" placeholder="budget" readonly value="Order price">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-info text-white" id="budget">
                                                        {{ $bid->budget }} ৳
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- work detail -->
                                    <pre><b>{{ $bid->description }}</b></pre>
                                    <hr>
                                    <b>{{ 'Details:' }}</b>
                                    <pre>{{ $bid->customerGig->description }}</pre>
                                    <br>
                                    <b>{{ 'Address:' }}</b>
                                    <p>{{ $bid->customerGig->address }}</p>
                                    <br>
                                    <hr>
                                    <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                                        <button disabled type="button" class="btn btn-outline-success active">
                                            <b>Delivery Date</b> <br>
                                            <small>
                                                {{ date('h:i:s a m/d/y', strtotime($customerGig->updated_at)) }}
                                            </small>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Completed Bids -->
            <!-- End Completed Bids -->
    @elseif($customerGig->status == 'cancelled' || $customerGig->workerBids->where('is_cancelled', '1')->where('worker_id', auth()->user()->id))
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
                                    <figure class="avatar avatar-60"><img src="{{ asset('uploads/images/users/'.$customerGig->customer->image) }}" alt=""></figure>
                                </div>
                                <div class="col pl-0 align-self-center">
                                    <h5 class="mb-1">{{ $customerGig->customer->full_name }}</h5>
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
                                    <button disabled class="btn btn-danger btn-rounded-54 shadow" data-toggle="modal" data-target="#addmoney"> <b>{{ $customerGig->budget }}</b> </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-none">
                            <div class="row">
                                <div class="col">
                                    <p><b>{{ $customerGig->title }}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End owner info & price-->
                <!--Start work detail , address, day-->
                <div class="container">
                    <h4 class="mb-3"><b>Work detail:</b></h4>
                    <pre>{{ $customerGig->description }}</pre>
                    <h4 class="mb-3"><b>Address:</b></h4>
                    <p>{{ $customerGig->address }}</p>
                    <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                        <button disabled type="button" class="btn btn-outline-danger active">
                            <b>Cancelled Date</b> <br>
                            <small>
                                    {{ date('h:i:s a m/d/Y', strtotime($customerGig->workerBids->where('worker_id', auth()->user()->id)->first()->updated_at)) }}
                            </small>
                        </button>
                    </div>
                </div>
                <!--End work detail , address, day-->
                <hr>
    @endif
    <!-- footer-->
<script>
    $(document).ready(function() {
        //Cancel worker bid with confirm alert
        $('#canceller-btn').click(function(){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData();
                    formData.append('bid', $(this).val())
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('worker.cancelWorkerBid') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Successfully bid cancelled.',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(function() {
                                //your code to be executed after 1 second
                                location.reload()
                            }, 1000);//2 second
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

        //Price update by worker with confirm alert
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
                    formData.append('price', $('#price').val())
                    formData.append('bid', $('#bid-id').val())
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('worker.changePriceForMoreWork') }}",
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

    });
</script>
@endsection
