@extends('customer.layout.app')
@push('title') Special profiles @endpush
@push('head')

@endpush
@section('content')
    <div class="wrapper homepage">
        <!-- header -->
        <div class="header">
            <div class="row no-gutters">
                <div class="col-auto">
                    <button class="btn  btn-link text-dark menu-btn"><i class="material-icons">menu</i><span class="new-notification"></span></button>
                </div>
                <div class="col text-center"><img src="{{ asset(get_static_option('header_logo') ?? 'uploads/images/uploads/header_logo.png') }}" alt="" class="header-logo"></div>
                <div class="col-auto">
                    <a href="#" class="btn  btn-link text-dark position-relative"><i class="material-icons">notifications_none</i><span class="counts">9+</span></a>
                </div>
            </div>
        </div>
        <!-- header ends -->
        <!-- Start title -->
        <div>
            <div class="alert alert-primary text-center" role="alert">
                <b>{{ $service->name }}</b>
            </div>
        </div>


        <!-- Start worker's bid of this area-->
        <div class="container">
            <div class="row text-center">
                @foreach($special_profiles as $special_profile)
                    <div class="col-md-6 col-xl-3 col-lg-4">
                        <div class="card shadow border-0 mb-3">
                            <div class="card-body">
                                <div class="avatar avatar-60 no-shadow border-0">
                                    <div class="overlay bg-template"></div>
                                    <figure class="avatar avatar-60 border-0">
                                        <img src="{{ asset($special_profile->image ?? 'uploads/images/defaults/user.png') }}" alt="">
                                    </figure>
                                </div>
                                <p class="mt-3 mb-0 font-weight-bold">{{ $special_profile->description }}</p>
                                <a href="tel:{{ auth()->user()->upazila->controllers->first()->phone }}"> <p class="mt-3 mb-0 font-weight-bold">{{ 'Call Now' }}</p></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- End worker's bid of this area-->
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

    <script>
    </script>
@endsection
