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
                    <button id="" onclick="window.location.href='{{ route('customer.showOrderForm', \Illuminate\Support\Facades\Crypt::encryptString($gig->id)) }}'" type="button" class="btn btn-success">Order Now</button>
                </div>
            </div>
            <!--End work detail , address, day-->
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
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content shadow">
                <div class="modal-header">
                    <h5 class="header-title mb-0" id="modal-title">Title</h5>
                </div>
                <div class="modal-body text-center pr-4 pl-4">
                    <figure class="avatar avatar-120 rounded-circle mt-0 border-0">
                        <img id="worker-image" src="{{ asset('assets/mobile/img/order-now.png') }}" alt="user image">
                    </figure>
                    <h5 class="my-3">Ananya Johnsons</h5>
                    <div class="form-group text-left float-label">
                        <input type="password" class="form-control text-center" placeholder="Password">
                        <button class="overlay btn btn-sm btn-link text-success">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-default btn-rounded btn-block col">Another register</button>
                        <br>
                        <a href="#">Not you? Sign in as different user</a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <!-- page level script -->

    <script>
        $(document).ready(function(){
            //Show modal
            $("#order-now").click(function (){
                $('#modal').modal('show');
                $('#modal-title').html( $('.gig-title').text() );
                $('#worker-image').attr("src", $('.worker-profile-image').attr("src"));
                //$('#worker-image').attr("src", $(this).parent().parent().parent().find('[class*="worker-profile-image"]').attr("src"));
            });
            $("#order-bhjnow").click(function (){
                //console.log(getInput());
                var userName = $('#user-name').val();
                var fullName = $('#full-name').val();
                var phone = $('#phone').val();
                var password = $('#password').val();
                var confirmPassword = $('#confirm-password').val();
                var referralCode = $('#referral').val();
                var districtId = $('#district-id').val();
                var upazilaId = $('#upazila-id').val();
                var gender = $('.gender:checked').val();
                var image = $('#profile-image')[0].files[0];

                var formData = new FormData();
                formData.append('userName', userName)
                formData.append('fullName', fullName)
                formData.append('phone', phone)
                formData.append('password', password)
                formData.append('confirmPassword', confirmPassword)
                formData.append('referralCode', referralCode)
                formData.append('district', districtId)
                formData.append('upazila', upazilaId)
                formData.append('gender', gender)
                formData.append('profilePicture', image)

                $.ajax({
                    method: 'POST',
                    url: '/guest/submit/customer-register',
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
                                //your code to be executed after 1 second
                                window.location = "{{ route('customer.home.index') }}";
                            }, 1000); //1 second
                        }else{
                            Swal.fire({
                                icon: data.type,
                                title: 'Oops...',
                                text: data.message,
                                footer: ''
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
