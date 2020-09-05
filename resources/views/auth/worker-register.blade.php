<!doctype html>
<html lang="en" class="deeppurple-theme">


<!-- Mirrored from maxartkiller.com/website/Fimobile/Fimobile-HTML/modal.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Dec 2019 13:37:35 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="Maxartkiller">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register-Customer | {{ $setting->name }}</title>

    <!-- Material design icons CSS -->
    <link rel="stylesheet" href="{{ asset('assets/mobile/vendor/materializeicon/material-icons.css')}}">

    <!-- Roboto fonts CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/mobile/vendor/bootstrap-4.4.1/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Swiper CSS -->
    <link href="{{ asset('assets/mobile/vendor/swiper/css/swiper.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/mobile/css/style.css') }}" rel="stylesheet">

    <!--SweetAlert 2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>

<body>
<!-- Loader -->
@include('includes.loader')
<!-- Loader ends -->

<div class="wrapper">
    <!-- header -->
    <div class="header">
        <div class="row no-gutters">
            <div class="col-auto">
                <a href="{{ route('welcome') }}" class="btn  btn-link text-dark"><i class="material-icons">chevron_left</i></a>
            </div>
            <div class="col text-center"></div>
            <div class="col-auto">
            </div>
        </div>
    </div>
    <!-- header ends -->

    <div class="row no-gutters login-row">
        <div class="col align-self-center px-3 text-center">
            <br>
            <img src="{{ asset('uploads/images/'.$setting->logo_login) }}" alt="logo" class="logo-small">
            <form class="form-signin mt-3" method="post" id="upload_form" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <!--Image upload with preview start -->
                    <div class="figure-profile shadow my-4">
                        <figure><img id="profile-image-preview" alt=""></figure>
                        <div class="btn btn-dark text-white floating-btn">
                            <i class="material-icons">camera_alt</i>
                            <input type="file" accept="image/*" id="profile-image" class="float-file">
                        </div>
                    </div>
                    <!--Image upload with preview end -->
                </div>
                <div class="form-group">
                    <input type="text" id="user-name" class="form-control form-control-lg text-center" placeholder="Username" required autofocus>
                </div>
                <div class="form-group">
                    <input type="text" id="full-name" class="form-control form-control-lg text-center" placeholder="Full Name" required autofocus>
                </div>
                <div class="form-group">
                    <input type="number" id="phone" class="form-control form-control-lg text-center" placeholder="Phone Number" required>
                </div>
                <div class="form-group">
                    <input type="password" id="password" class="form-control form-control-lg text-center" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="password" id="confirm-password" class="form-control form-control-lg text-center" placeholder="Confirm Password" required>
                </div>
                <div class="form-group">
                    <input type="text" minlength="6" maxlength="6" id="referral" class="form-control form-control-lg text-center" placeholder="Referral code">
                </div>
                <div class="form-group">
                    <select class="form-control form-control-lg" id="district-id">
                        <option selected disabled> Chose district</option>
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control form-control-lg" id="upazila-id">
                        <option selected disabled value="" id="upazila-loader">
                            <span class="badge badge-warning mb-1">Loading ...</span>
                        </option>
                        <!-- Insert by ajax -->
                    </select>
                </div>
                <div class="row mx-0">
                    <div class="col-6 col-md-6 col-lg-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" name="gender" class="custom-control-input gender" id="male" value="male">
                            <label class="custom-control-label" for="male">Male</label>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 col-lg-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" name="gender" class="custom-control-input gender" id="female" value="female">
                            <label class="custom-control-label" for="female">Female</label>
                        </div>
                    </div>
                </div>

                <p class="mt-4 d-block text-secondary">
                    By clicking register your are agree to the
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter">Worker Registration</a>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter">Membership Registration</a>
                </p>
            </form>
        </div>
    </div>

    <!-- login buttons -->
    <div class="row mx-0 bottom-button-container">
        <div class="col">
            <a href="#" id="customer-register" class="btn btn-default btn-lg btn-rounded shadow btn-block">Register</a>
        </div>
    </div>
    <!-- login buttons -->
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="header-title mb-0">Login</h5>
            </div>
            <div class="modal-body text-center pr-4 pl-4">
                <figure class="avatar avatar-120 rounded-circle mt-0 border-0">
                    <img src="{{ asset('assets/mobile/img/user1.png') }}" alt="user image">
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


<!-- jquery, popper and bootstrap js -->
<script src="{{ asset('assets/mobile/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/mobile/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/mobile/vendor/bootstrap-4.4.1/js/bootstrap.min.js') }}"></script>

<!-- swiper js -->
<script src="{{ asset('assets/mobile/vendor/swiper/js/swiper.min.js') }}"></script>

<!-- cookie js -->
<script src="{{ asset('assets/mobile/vendor/cookie/jquery.cookie.js') }}"></script>

<!-- template custom js -->
<script src="{{ asset('assets/mobile/js/main.js') }}"></script>

<!-- page level script -->
<script>
    $(document).ready(function(){
        //Hide upazila first
        $("#upazila-id").hide()
        //Get upazila after click on district
        $("#district-id").change(function(){
            var districtId = $(this).val();
            $("#upazila-id").show() //now show district
            $.ajax({
                method: 'POST',
                url: '/guest/get/upazila-of-a-district',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: { districtId: districtId},
                dataType: 'JSON',
                beforeSend: function (){
                    $("#upazila-loader").show()
                },
                complete: function (){
                    $("#upazila-loader").hide()
                },
                success: function (response) {
                    //console.log(response)
                    var upazilaOption='<option selected disabled> Chose upazila</option>';
                    response.forEach(function(upazila){
                        upazilaOption += '<option value='+upazila.id+'>'+upazila.name+'</option>';
                    })
                    $("#upazila-id").html(upazilaOption)
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
        //Profile image upload preview
        $("#profile-image").change(function (event){
            if(event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("profile-image-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        })
        //Customer register submit
        $("#customer-register").click(function (){

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
</body>
<!-- This system developed by DataTech BD ltd. Phone: 01304734623-25 | info@datatechbd.com | 24-08-2020-->
</html>
