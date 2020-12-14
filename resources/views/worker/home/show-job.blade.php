@extends('worker.layout.app')
@push('title') {{ __('Job') }} @endpush
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
                    <b id=""> {{ __('BID JOB') }}</b>
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
                        <h3 class="mb-0 font-weight-normal">{{ __('Price ৳ ') }}</h3>
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
            <h4 class="mb-3"><b>{{ __('Work detail:') }}</b></h4>
            <pre>{{ $customerGig->description }}</pre>
            <h4 class="mb-3"><b>{{ __('Address:') }}</b></h4>
            <p>{{ $customerGig->address }}</p>
            <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                <button disabled type="button" class="btn btn-outline-success active col"><small> {{ __('Time') }} </small>{{ $customerGig->day }}<small> {{ __('Days') }}</small></button>
                <button disabled type="button" class="btn btn-success col">{{  date('h:i a m/d/Y', strtotime($customerGig->created_at)) }}</button>
            </div>
        </div>
        <!--End work detail , address, day-->
            <hr>

        @if(auth()->user()->workerBids()->where('customer_gig_id', $customerGig->id)->exists())
            <!-- Start bid title -->
            <div class="">
                <div class="alert alert-danger text-center" role="alert">
                    <b id=""> {{ __('BID ALREADY SUBMITTED') }}</b>
                </div>
            </div>
        <!-- End title -->
        @else
                <!-- Start bid title -->
                <div class="">
                    <div class="alert alert-info text-center" role="alert">
                        <b id=""> {{ __('Bid Now') }}</b>
                    </div>
                </div>
                <!-- End title -->
                <!-- Start Bids -->
                <div class="card-body">
                    <div class="row">
                        <div class="container">
                            <div class="form-group">
                                <input type="number" id="budget" class="form-control bg-secondary form-control-lg text-success text-center" placeholder="{{ __('Your Budget') }}">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control form-control-lg bg-secondary text-success" id="description" rows="6" placeholder="{{ __('Job Description') }}"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="job-id" value="{{ \Illuminate\Support\Facades\Crypt::encryptString($customerGig->id) }}">
                                <button type="button" id="bid-submit-button" class="mb-2 btn btn-lg btn-success w-100 btn-rounded">{{ __('Submit Now') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Bids -->
        @endif
<!-- Start bid title -->
    <div class="">
        <div class="alert alert-info text-center" role="alert">
            <b id=""> {{ __('All BIDS') }}/b>
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
                            <h3 class="mb-0 font-weight-normal">{{ __('Price ৳ ') }}</h3>
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

    <!-- footer-->
<script>
    $(document).ready(function() {
        //Submit new Job
        $('#bid-submit-button').click(function(){
            var formData = new FormData();
            formData.append('description', $('#description').val())
            formData.append('budget', $('#budget').val())
            formData.append('jobId', $('#job-id').val())
            $.ajax({
                method: 'POST',
                url: "{{ route('worker.storeWorkerBid') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#description').val('');
                    $('#budget').val('');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Bid Successful.',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(function() {
                        //your code to be executed after 1 second
                        location.replace("/worker/bid/"+$('#job-id').val())
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
        });
    });
</script>
@endsection
