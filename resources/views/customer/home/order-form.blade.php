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
                            <p class="text-mute small">{{ '*****' }}</p>
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
                            <button disabled class="btn btn-info btn-rounded-54 shadow" data-toggle="modal" data-target="#addmoney"> <b>{{ $gig->price }}</b> </button>
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
        <!-- Start order now area -->
        <div class="container">
            <div class="card bg-template shadow mt-4 h-500">
                <div class="card-body">
                    <div class="row">
                        <div class="container">
                            <input id="gig-id" type="hidden" value="{{$gig->id}}">
                            <div class="form-group">
                                <textarea class="form-control form-control-lg" id="description" rows="6" placeholder="Job Description"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" id="address" class="form-control form-control-lg" placeholder="Address details here...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <!-- End order now area -->
        <div class="container">
            <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                <button disabled type="button" class="btn btn-outline-success active"><small>Time </small>{{ $gig->day }}<small> Days</small></button>
                <button id="job-submit" type="button" class="btn btn-success">
                    Confirm order
                </button>
            </div>
        </div>
        <hr>
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
            //Submit
            $("#job-submit").click(function (){
                var formData = new FormData();
                formData.append('gig', $('#gig-id').val())
                formData.append('description', $('#description').val())
                formData.append('address', $('#address').val())

                $.ajax({
                    method: 'POST',
                    url: "{{ route('customer.submitOrderForm') }}",
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
                            window.location = "{{ route('customer.job.index') }}";
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
        });
    </script>
@endsection
