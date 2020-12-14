<!doctype html>
<html lang="en" class="deeppurple-theme">
<!-- This system developed by DataTech BD ltd. Phone: 01304734623-25 | info@datatechbd.com | 23-08-2020-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="Ashooo">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login | {{ setting('name') }}</title>

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
            <img src="{{ asset('uploads/images/'.setting('logo_login')) }}" alt="logo" class="logo-small">
            <!--Show error & session message -->
            @include('includes.message')
            <form class="form-signin mt-3" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="number" id="inputPhone" class="form-control form-control-lg text-center" name="phone" placeholder="{{ __('Phone') }}" required autofocus>
                </div>

                <div class="form-group">
                    <input type="password" id="inputPassword" class="form-control form-control-lg text-center" name="password" placeholder="{{ __('Password') }}" required>
                </div>
                <a href="#" class="mt-4 d-block" data-toggle="modal" data-target="#exampleModalCenter">{{ __('Forgot Password?') }}</a>
                <!-- login buttons -->
                <input type="submit" class="mt-4 d-block btn btn-default btn-lg btn-rounded shadow btn-block" value="{{ __('Login') }}">
                <!-- login buttons -->
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="header-title mb-0">{{ __('Reset password') }}</h5>
            </div>
            <div class="modal-body text-center pr-4 pl-4">
                <figure class="avatar avatar-120 rounded-circle mt-0 border-0">
                    <img src="{{ asset('assets/mobile/img/change-password.png') }}" alt="user image">
                </figure>
                <h5 class="my-3">{{ __('Type your phone number') }}</h5>

                <div class="form-group text-left float-label">
                    <div class="error"></div>
                    <input type="number" class="form-control text-center" id="phone-number" placeholder="{{ __('Phone number') }}">
                </div>
                <div class="text-center">
                    <button class="btn btn-default btn-rounded btn-block col" id="reset-btn">{{ __('Reset Password') }}</button>
                    <br>
                    <a href="#" data-dismiss="modal">{{ __('Remember your password? Sign in') }}</a>
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

<script>
    $(document).ready(function(){
        $('#reset-btn').click(function (){
            var formData = new FormData();
            formData.append('phone', $('#phone-number').val())
            $.ajax({
                method: 'POST',
                url: "{{ route('resetPassword') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data)
                   var successMessage =
                   '<div class="alert alert-'+data.type+'" role="alert">\n' +
                   data.message+
                   '                <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                   '                    <span aria-hidden="true">×</span>\n' +
                   '                </button>\n' +
                   '            </div>'

                    $('.error').html(successMessage)
                },
                error: function (xhr) {
                    var errorMessage = '' +
                        '<div class="alert alert-danger" role="alert">';
                    $.each(xhr.responseJSON.errors, function(key,value) {
                        errorMessage +=(''+value+'<br>');
                    });
                    errorMessage +='<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                        '                    <span aria-hidden="true">×</span>\n' +
                        '                </button>\n' +
                        '            </div>';

                    $('.error').html(errorMessage)

                    //console.log(errorMessage)
                },
            })
        });

    });
</script>
</body>
<!-- This system developed by DataTech BD ltd. Phone: 01304734623-25 | info@datatechbd.com | 23-08-2020-->
</html>

