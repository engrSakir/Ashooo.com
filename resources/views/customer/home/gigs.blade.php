@extends('customer.layout.app')
@push('title') Service @endpush
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
            <div class="col text-center"><img src="{{ asset('uploads/images/'.$setting->logo_header) }}" alt="" class="header-logo"></div>
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
        <div class="row">
            <div class="col-12 px-0">
                <div class="list-group list-group-flush ">

                    @foreach($service->gigs as $gig)
                        <a class="list-group-item border-top text-dark" href="{{ route('customer.showGigDetail',\Illuminate\Support\Facades\Crypt::encryptString($gig->id)) }}">
                            <div class="row">
                                <div class="col-auto align-self-center">
                                    <i class="material-icons text-template-primary">
                                        <figure class="avatar avatar-60 border-0">
                                            <img src="{{ asset('uploads/images/users/'.$gig->worker->image) }}" alt="">
                                        </figure>
                                    </i>
                                </div>
                                <div class="col pl-0">
                                    <div class="row mb-1">
                                        <div class="col">
                                            <p class="mb-0">{{ $gig->worker->full_name }}</p>
                                        </div>
                                        <div class="col-auto pl-0">
                                            <p class="small text-mute text-trucated mt-1">****</p>
                                        </div>
                                    </div>
                                    <p class="small text-mute">{{ \Illuminate\Support\Str::limit($gig->title, 25) }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
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
