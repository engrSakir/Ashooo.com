<!doctype html>
<html lang="en" class="deeppurple-theme">
<!-- This system developed by DataTech BD ltd. Phone: 01304734623-25 | info@datatechbd.com | 28-08-2020-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="Maxartkiller">

    <title>@stack('title')</title>

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
    @stack('head')
</head>

<body>
<!-- Loader -->
@include('includes.loader')
<!-- Loader ends -->

<!--Start logout-->
@include('includes.logout')
<!--End logout-->

<!-- Sidebar -->
@include('membership.layout.sidebar')
<!-- Sidebar ends -->

@yield('content')

<!-- notification -->
@include('membership.layout.notification')
<!-- notification ends -->

<!-- color chooser menu start -->
@include('membership.layout.color-choser')
<!-- color chooser menu ends -->

<!-- Modal -->
@include('membership.layout.modal')

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
@stack('foot')

</body>

<!-- This system developed by DataTech BD ltd. Phone: 01304734623-25 | info@datatechbd.com | 28-08-2020-->
</html>
