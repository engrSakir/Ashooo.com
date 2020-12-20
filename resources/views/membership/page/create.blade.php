@extends('membership.layout.app')
@push('title') Create @endpush
@section('content')
    <!-- Start job posting area -->
    <div class="container">
        <div class="card shadow mt-4 h-500"> <!-- use bg-template as class for multi color -->
            <div class="card-body">
                <div class="row">
                    <div class="container">
                        <form action="">
                            <div class="form-group">
                                <lable>Logo</lable>
                                <input type="file" id="logo" accept="image/*" class="form-control form-control-lg" placeholder="{{ __('Title') }}...">
                            </div>
                            <div class="form-group">
                                <lable>Brand name</lable>
                                <input type="text" id="name" class="form-control form-control-lg" placeholder="{{ __('Brand name') }}...">
                            </div>
                            <div class="form-group">
                                <lable>Mobile no.</lable>
                                <input type="text" id="mobile" class="form-control form-control-lg" placeholder="{{ __('Mobile no.') }}...">
                            </div>
                            <div class="form-group">
                                <lable>Title</lable>
                                <input type="text" id="title" class="form-control form-control-lg" placeholder="{{ __('Title') }}...">
                            </div>
                            <div class="form-group">
                                <lable>Description</lable>
                                <textarea class="form-control form-control-lg" id="description" rows="6" placeholder="{{ __('Description') }}"></textarea>
                            </div>
                            <div class="form-group">
                                <lable>Address</lable>
                                <input type="text" id="address" class="form-control form-control-lg" placeholder="{{ __('Address') }}">
                            </div>
                            @for($image_amount=1; $image_amount <= auth()->user()->membership->membershipPackage->image_count; $image_amount++)
                                <div class="form-group">
                                    <lable>Image- {{ $image_amount }}</lable>
                                    <input type="file" id="image" accept="image/*" class="form-control form-control-lg" placeholder="{{ __('Title') }}...">
                                </div>
                            @endfor
                            <div class="form-group">
                                <lable>Category </lable>
                                <select id="service" class="form-control form-control-lg">
                                    <option disabled selected>{{ __('Category') }}</option>
                                    @foreach(auth()->user()->membershipService as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="button" id="job-submit-button" class="mb-2 btn btn-lg btn-success w-100 btn-rounded">{{ __('SAVE') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
    <!-- End job posting area -->
@endsection
