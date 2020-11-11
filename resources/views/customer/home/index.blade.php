@extends('customer.layout.app')
@push('title') Home @endpush
@push('head')

@endpush
@section('content')
    <!-- Start job posting area -->
    <div class="container">
        <div class="card bg-template shadow mt-4 h-500">
            <div class="card-body">
                <div class="row">
                    <div class="container">
                        <div class="form-group">
                            <input type="text" id="title" class="form-control form-control-lg" placeholder="Title here...">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control form-control-lg" id="description" rows="6" placeholder="Job Description"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" id="address" class="form-control form-control-lg" placeholder="Address details here...">
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <select id="service" class="form-control form-control-lg">
                                        <option disabled selected>Category</option>
                                        @foreach($categories as $category)
                                            <optgroup label="{{ $category->name }}">
                                                @foreach($category->services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="number" id="day" class="form-control form-control-lg" placeholder="Days 1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="number" id="budget" class="form-control form-control-lg" placeholder="Your Budget">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <button type="button" id="job-submit-button" class="mb-2 btn btn-lg btn-success w-100 btn-rounded">Post Job</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
    <!-- End job posting area -->

    <!-- Start admin notice box -->
    @foreach($adminNotice as $adminNotice)
        <section class="jumbotron text-center mt-3 bg-white shadow-sm">
            <div class="container">
                <p class="lead">{{ $adminNotice->title }}</p>
                <p class="text-secondary text-mute small"> {{ $adminNotice->detail }} </p>
            </div>
        </section>
    @endforeach
    <!-- End admin notice box -->
    <!-- Start controller notice box -->
    @foreach(auth()->user()->upazila->controllers as $controller)
        @foreach($controller->controllerNotice as $controllerNotice)
            <section class="jumbotron text-center mt-3 bg-white shadow-sm">
                <div class="container">
                    <div class="container">
                        <p class="lead">{{ $controllerNotice->title }}</p>
                        <p class="text-secondary text-mute small">{{ $controllerNotice->detail }}</p>
                    </div>
                </div>
            </section>
    @endforeach
@endforeach
    <!-- End controller notice box -->

    <!-- Start top ads. by controller this upazila -->
    <div class="swiper-container offer-slide swiper-container-horizontal swiper-container-android">
        <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
            @foreach(auth()->user()->upazila->controllers as $controller)
                @foreach($controller->controllerAds as $controllerAds)
                    <div class="swiper-slide swiper-slide-active">
                        <div class="card shadow border-0 bg-template">
                            <div class="card-body">
                                <a  @if($controllerAds->url) href="{{ $controllerAds->url }}" target="_blank" @endif >
                                    <img src="{{ asset('uploads/images/ads/controller/'.$controllerAds->image) }}" height="100%" width="100%" style="border-radius: 5px;">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
    </div>
    <!-- End top ads.  by controller this upazila -->
    <hr>
    <!-- Start title -->
    <div class="alert alert-primary text-center" role="alert">
        <b>Find your service by category</b>
    </div>
    <!-- End title -->
    <!-- Start worker service category -->
    <div class="container">
        <div class="row text-center mt-4">
            @foreach($categories as $category)
                <div class="col-6 col-md-3">
                    <div class="card shadow border-0 mb-3">
                        <div class="card-body">
                            <div class="avatar avatar-60 no-shadow border-0">
                                <div class="overlay bg-template"></div>
                                <img src="{{ asset('uploads/images/worker/service-category/'.$category->icon) }}" height="50px" width="50px" style="border-radius: 15px;">
                            </div>
                            <a href="{{ route('customer.showServices',\Illuminate\Support\Facades\Crypt::encryptString($category->id)) }}"> <p class="mt-3 mb-0 font-weight-bold">{{ $category->name }}</p></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- End worker service category -->

    <!-- Start middle ads. by admin for all-->
    <div class="swiper-container offer-slide swiper-container-horizontal swiper-container-android">
        <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
            @foreach($adminAds as $adminAds)
                <div class="swiper-slide swiper-slide-active">
                    <div class="card shadow border-0 bg-template">
                        <div class="card-body">
                            <a  @if($adminAds->url) href="{{ $adminAds->url }}" target="_blank" @endif >
                                <img src="{{ asset('uploads/images/ads/admin/'.$adminAds->image) }}" height="100%" width="100%" style="border-radius: 5px;">
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
    </div>
    <!-- End middle ads. by admin for all-->

<script>
    $(document).ready(function() {
        //Submit new Job
        $('#job-submit-button').click(function(){
            var formData = new FormData();
            formData.append('title', $('#title').val())
            formData.append('description', $('#description').val())
            formData.append('address', $('#address').val())
            formData.append('service', $('#service').val())
            formData.append('day', $('#day').val())
            formData.append('budget', $('#budget').val())

            $.ajax({
                method: 'POST',
                url: "{{ route('customer.storeCustomerGig') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#title').val('');
                    $('#description').val('');
                    $('#address').val('');
                    //$('#service').val('');
                    $('#day').val('');
                    $('#budget').val('');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Successfully add new job.',
                        showConfirmButton: false,
                        timer: 1500
                    })
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
