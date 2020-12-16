<!doctype html>
<html lang="en" class="deeppurple-theme">
<!-- This system developed by DataTech BD ltd. Phone: 01304734623-25 | info@datatechbd.com | 23-08-2020-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="Ashooo">

    <title>Area Controller | {{ get_static_option('name') }}</title>

    <!-- Material design icons CSS -->
    <link rel="stylesheet" href="{{ asset('assets/mobile/vendor/materializeicon/material-icons.css') }}">

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
    <!--====== AJAX ======-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                <a href="javascript:void(0)" onclick="window.history.go(-1); return false;" class="btn  btn-link text-dark"><i class="material-icons">navigate_before</i></a>
            </div>
            <div class="col text-center"><img src="img/logo-header.png" alt="" class="header-logo"></div>
        </div>
    </div>
    <!-- header ends -->

    <div class="container">
        <!-- page content here -->

        @foreach($upazila->controllers as $controller)
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-primary  justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="#" class="text-white">
                                <i class="fa fa-home"></i> {{ $controller->full_name }}</a>
                        </li>
                    </ol>
                </nav>
                <div class="card shadow border-0 mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="font-weight-normal mb-1 phone-number">{{ $controller->phone }}</h5>
                                <p class="text-mute small text-secondary mb-2">{{ $controller->email }}</p>
                            </div>
                            <div class="col-auto pl-0">
                                <a href="tel:{{ $controller->phone }}">
                                    <button class="call-button avatar avatar-50 no-shadow border-0 bg-template">
                                        <i class="material-icons">call</i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
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

