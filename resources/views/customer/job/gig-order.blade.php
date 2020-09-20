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
    @if($gigOrder->status == 'active')
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
                                <figure class="avatar avatar-60"><img src="{{ asset('uploads/images/users/'.$gigOrder->customer->image) }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">{{ $gigOrder->customer->full_name }}</h5>
                                <p class="text-mute small"> ***** </p>
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
                                <button disabled class="btn btn-info btn-rounded-54 shadow" data-toggle="modal" data-target="#addmoney"> <b>{{ $gigOrder->budget }}</b> </button>
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
                                <input type="hidden" id="gig-id" value="{{ $gigOrder->id }}">
                                <input type="number" id="budget" placeholder="250" class="form-control form-control-lg text-center">
                                <br>
                                <button type="button" id="submit" class="mb-2 btn btn-lg btn-info" style="width: 100%">Submit</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--End owner info & price-->
            <!--Start work detail , address, day-->
            <div class="container">
                <h5 class="mb-3"><b> {{ $gigOrder->gig->title }} </b></h5>
                <br>
                <h4 class="mb-3"><b>Work details:</b></h4>
                <p>{{ $gigOrder->description }}</p>
                <h4 class="mb-3"><b>Address:</b></h4>
                <p>{{ $gigOrder->address }}</p>
                <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                    <button disabled type="button" class="btn btn-outline-success active"><small>Time </small>{{ $gigOrder->gig->day }}<small> Days</small></button>
                    <button id="job-cancel" onclick="window.location.href='{{ route('customer.cancelGigOrder', \Illuminate\Support\Facades\Crypt::encryptString($gigOrder->id)) }}'" type="button" class="btn btn-danger">Cancel</button>
                </div>
            </div>
            <!--End work detail , address, day-->
            <hr>
            <!-- End Bids -->
    @elseif($gigOrder->status == 'cancelled')
        <!-- Start title -->
            <div class="">
                <div class="alert alert-danger text-center" role="alert">
                    <b id=""> CANCELLED ORDER</b>
                </div>
            </div>
            <!-- End title -->
            <!--Start Canceller info & price-->
            <div class="container">
                <div class="card bg-danger shadow mt-4 h-190">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-60"><img src="{{ asset('uploads/images/users/'.$gigOrder->cancelInfo->canceller->image) }}" alt=""></figure>
                            </div>
                            <div class="col pl-0 align-self-center">
                                <h5 class="mb-1">{{ $gigOrder->cancelInfo->canceller->full_name }}</h5>
                                <p class="text-mute small"><b>Under dev.. ***</b></p>
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
                                <button disabled class="btn btn-danger btn-rounded-54 shadow" data-toggle="modal" data-target="#addmoney"> <b>{{ $gigOrder->budget }}</b> </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-none">
                        <div class="row">
                            <div class="col">
                                <p><b>{{ $gigOrder->gig->title }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Canceller info & price-->
            <hr>
            <!--Start work detail , address, day-->
            <div class="container">
                <h4 class="mb-3"><b>Work details:</b></h4>
                <p>{{ $gigOrder->description }}</p>
                <h4 class="mb-3"><b>Address:</b></h4>
                <p>{{ $gigOrder->address }}</p>
                <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                    <button disabled type="button" class="btn btn-outline-danger active"><b>Cancelled Date</b> <br> <small> {{ date('h:i:s a m/d/y', strtotime($gigOrder->updated_at)) }}</small></button>
                </div>
            </div>
    @endif
    <!-- footer-->
        <div class="footer">
            <div class="no-gutters">
                <div class="col-auto mx-auto">
                    <div class="row no-gutters justify-content-center">
                        <div class="col-auto">
                            <a href="{{ route('customer.home.index') }}" class="btn btn-link-default active">
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
    <!-- page level script -->
    <script>
        $(document).ready(function(){
            $("#submit").click(function (){
                var formData = new FormData();
                formData.append('gig', $('#gig-id').val())
                formData.append('budget', $('#budget').val())
                $.ajax({
                    method: 'POST',
                    url: "{{ route('customer.updateBudgetGigOrder') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.type == 'success'){
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
                        }else{
                            Swal.fire({
                                icon: data.type,
                                title: 'Oops...',
                                text: data.message,
                                footer: 'something going wrong'
                            })
                        }
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
