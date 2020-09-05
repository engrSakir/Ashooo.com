<!DOCTYPE html>
<html lang="en">
<!-- This system developed by DataTech BD ltd. Phone: 01304734623-25 | info@datatechbd.com | 24-08-2020-->
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>@stack('title')</title>
  <!--favicon-->
  <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
  @stack('head')
</head>

<body onload="info_noti()">

<!-- Start wrapper-->
 <div id="wrapper">

    <!--Start sidebar-wrapper-->
    @include('controller.layout.sidebar')
    <!--End sidebar-wrapper-->

    <!--Start topbar header-->
    @include('controller.layout.topbar')
    <!--End topbar header-->

    <div class="clearfix">

    </div>
    <!--Start content-wrapper-->
     @yield('content')
    <!--End content-wrapper-->

   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

	<!--Start footer-->
	@include('controller.layout.footer')
	<!--End footer-->
  </div>
<!--End wrapper-->
  @stack('foot')
</body>
<!-- This system developed by DataTech BD ltd. Phone: 01304734623-25 | info@datatechbd.com | 24-08-2020-->
</html>
