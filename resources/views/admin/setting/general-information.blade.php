@extends('admin.layout.app')
    @push('title')
        Setting
    @endpush
    @push('head')
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    @endpush
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumb-->
            <div class="row pt-2 pb-2">
                <div class="col-sm-9">
                    <h4 class="page-title"> General Information</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javaScript:void();">ashooo</a></li>
                        <li class="breadcrumb-item"><a href="javaScript:void();">setting</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> General Information</li>
                    </ol>
                </div>
            </div>
            <!-- End Breadcrumb-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                              <form action="{{ route('admin.updateGeneralInformation') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-xl-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <label >Application name</label>
                                                <input type="text" class="form-control" name="name" value="{{ get_static_option('name') }}">
                                                <br>
                                                <br>
                                                <label >logo</label>
                                                <input type="file" accept="image/*" class="form-control" name="logo" value="{{ get_static_option('logo') }}">
                                                <span class="user-profile"><img src="{{ asset(get_static_option('logo') ) }}" class="img-circle" alt="user avatar"></span>
                                                <br>
                                                <br>
                                                <label >logo white</label>
                                                <input type="file" accept="image/*" class="form-control" name="logo_white" value="{{ get_static_option('logo_white') }}">
                                                <span class="user-profile"><img src="{{ asset(get_static_option('logo_white')) }}" class="img-circle" alt="user avatar"></span>
                                                <br>
                                                <br>
                                                <label >logo header</label>
                                                <input type="file" accept="image/*" class="form-control" name="header_logo" value="{{ get_static_option('header_logo') }}">
                                                <span class="user-profile"><img src="{{ asset(get_static_option('header_logo')) }}" class="img-circle" alt="user avatar"></span>
                                                <br>
                                                <br>
                                                <label >logo header white</label>
                                                <input type="file" accept="image/*" class="form-control" name="header_logo_white" value="{{ get_static_option('header_logo_white') }}">
                                                <span class="user-profile"><img src="{{ asset(get_static_option('header_logo_white')) }}" class="img-circle" alt="user avatar"></span>
                                                <br>
                                                <br>
                                                <label >fav</label>
                                                <input type="file" accept="image/*" class="form-control" name="fav" value="{{ get_static_option('fav') }}">
                                                <span class="user-profile"><img src="{{ asset(get_static_option('fav')) }}" class="img-circle" alt="user avatar"></span>
                                                <br>
                                                <br>
                                                <label >motto</label>
                                                <input type="text" class="form-control" name="motto" value="{{ get_static_option('motto') }}">
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <label >sms username</label>
                                                <input type="text" name="sms_username" class="form-control" value="{{ get_static_option('sms_username') }}">
                                                <br>
                                                <label >sms key</label>
                                                <input type="text" name="sms_key" class="form-control" value="{{ get_static_option('sms_key') }}">
                                                <br>
                                                <label >Per day password reset sms limit</label>
                                                <input type="number" name="reset_sms_count" class="form-control" value="{{ get_static_option('reset_sms_count') }}">
                                                <br>
                                                <label >reset sms template</label>
                                                <input type="text" name="reset_sms_template" class="form-control" value="{{ get_static_option('reset_sms_template') }}">
                                                <br>
                                                <label >welcome sms template</label>
                                                <input type="text" name="welcome_sms_template" class="form-control" value="{{ get_static_option('welcome_sms_template') }}">
                                                <br>
                                                <label >worker activation price</label>
                                                <input type="number" name="worker_activation_price" class="form-control" value="{{ get_static_option('worker_activation_price') }}">
                                                <br>
                                                <label >per customer referral price</label>
                                                <input type="number" name="per_customer_referral_price" class="form-control" value="{{ get_static_option('per_customer_referral_price') }}">
                                                <br>
                                                <label >per worker referral price</label>
                                                <input type="number" name="per_worker_referral_price" class="form-control" value="{{ get_static_option('per_worker_referral_price') }}">
                                                <br>
                                                <label >per membership referral price</label>
                                                <input type="number" name="per_membership_referral_price" class="form-control" value="{{ get_static_option('per_membership_referral_price') }}">
                                                <br>
                                                <label >admin percent on worker job</label>
                                                <input type="number" name="admin_percent_on_worker_job" class="form-control" value="{{ get_static_option('admin_percent_on_worker_job') }}">
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-block waves-effect waves-light mb-1">UPDATE/আপডেট</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!--End Row-->
        </div>
        <!-- End container-fluid-->
    </div>
@endsection
@push('foot')

@endpush
