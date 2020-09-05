<!doctype html>
<html lang="en" class="deeppurple-theme">
<!-- This system developed by DataTech BD ltd. Phone: 01304734623-25 | info@datatechbd.com | 23-08-2020-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="Maxartkiller">

    <title>Login | {{ $setting->name }}</title>

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
            <img src="{{ asset('uploads/images/'.$setting->logo_login) }}" alt="logo" class="logo-small">
            <!--Show error & session message -->
            @include('includes.message')
            <form class="form-signin mt-3" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="number" id="inputPhone" class="form-control form-control-lg text-center" name="phone" placeholder="Phone" required autofocus>
                </div>

                <div class="form-group">
                    <input type="password" id="inputPassword" class="form-control form-control-lg text-center" name="password" placeholder="Password" required>
                </div>
                <a href="#" class="mt-4 d-block" data-toggle="modal" data-target="#exampleModalCenter">Forgot Password?</a>
                <!-- login buttons -->
                <input type="submit" class="mt-4 d-block btn btn-default btn-lg btn-rounded shadow btn-block" value="Login">
                <!-- login buttons -->
            </form>
        </div>
    </div>


</div>


<!-- color chooser menu start -->
<div class="modal fade " id="colorscheme" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-header theme-header border-0">
                <h6 class="">Color Picker</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div class="text-center theme-color">
                    <button class="m-1 btn red-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="red-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn blue-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="blue-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn yellow-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="yellow-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn green-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="green-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn pink-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="pink-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn orange-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="orange-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn purple-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="purple-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn deeppurple-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="deeppurple-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn lightblue-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="lightblue-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn teal-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="teal-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn lime-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="lime-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn deeporange-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="deeporange-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn gray-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="gray-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn black-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="black-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-6 text-left">
                    <div class="row">
                        <div class="col-auto text-right align-self-center"><i class="material-icons text-warning vm">wb_sunny</i></div>
                        <div class="col-auto text-center align-self-center px-0">
                            <div class="custom-control custom-switch float-right">
                                <input type="checkbox" name="themelayout" class="custom-control-input" id="theme-dark">
                                <label class="custom-control-label" for="theme-dark"></label>
                            </div>
                        </div>
                        <div class="col-auto text-left align-self-center"><i class="material-icons text-dark vm">brightness_2</i></div>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <div class="row">
                        <div class="col-auto text-right align-self-center">LTR</div>
                        <div class="col-auto text-center align-self-center px-0">
                            <div class="custom-control custom-switch float-right">
                                <input type="checkbox" name="rtllayout" class="custom-control-input" id="theme-rtl">
                                <label class="custom-control-label" for="theme-rtl"></label>
                            </div>
                        </div>
                        <div class="col-auto text-left align-self-center">RTL</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- color chooser menu ends -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="header-title mb-0">Login</h5>
            </div>
            <div class="modal-body text-center pr-4 pl-4">
                <figure class="avatar avatar-120 rounded-circle mt-0 border-0">
                    <img src="img/user1.png" alt="user image">
                </figure>
                <h5 class="my-3">Ananya Johnsons</h5>
                <div class="form-group text-left float-label">
                    <input type="password" class="form-control text-center" placeholder="Password">
                    <button class="overlay btn btn-sm btn-link text-success">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
                <div class="text-center">
                    <button class="btn btn-default btn-rounded btn-block col">Login</button>
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

</body>
<!-- This system developed by DataTech BD ltd. Phone: 01304734623-25 | info@datatechbd.com | 23-08-2020-->
</html>

