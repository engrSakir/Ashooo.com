@extends('guest.layout')

@section('content')
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
@endsection
