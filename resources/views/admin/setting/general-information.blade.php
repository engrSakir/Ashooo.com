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
                        <li class="breadcrumb-item"><a href="javaScript:void();">Ashooo</a></li>
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
                            <div class="row">
                                <div class="col-md-6 col-xl-6">
                                    <div class="card">
                                        <div class="card-header text-uppercase">Text Input</div>
                                        <div class="card-body">
                                            <label for="basic-input">Application name</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->name }}">
                                            <br>
                                            <label for="basic-input">logo</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->logo }}">
                                            <br>
                                            <label for="basic-input">logo login</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->logo_login }}">
                                            <br>
                                            <label for="basic-input">logo login white</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->logo_login_white }}">
                                            <br>
                                            <label for="basic-input">logo header</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->logo_header }}">
                                            <br>
                                            <label for="basic-input">logo header white</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->logo_header_white }}">
                                            <br>
                                            <label for="basic-input">search</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->search }}">
                                            <br>
                                            <label for="basic-input">fav</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->fav }}">
                                            <br>
                                            <label for="basic-input">motto</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->motto }}">
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-6">
                                    <div class="card">
                                        <div class="card-header text-uppercase">Text Input</div>
                                        <div class="card-body">
                                            <label for="basic-input">sms username</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->sms_username }}">
                                            <br>
                                            <label for="basic-input">sms key</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->sms_key }}">
                                            <br>
                                            <label for="basic-input">Per day password reset sms limit</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->reset_sms_count }}">
                                            <br>
                                            <label for="basic-input">reset sms template</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->reset_sms_template }}">
                                            <br>
                                            <label for="basic-input">welcome sms template</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->welcome_sms_template }}">
                                            <br>
                                            <label for="basic-input">worker activation price</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->worker_activation_price }}">
                                            <br>
                                            <label for="basic-input">per customer referral price</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->per_customer_referral_price }}">
                                            <br>
                                            <label for="basic-input">per worker referral price</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->per_worker_referral_price }}">
                                            <br>
                                            <label for="basic-input">per membership referral price</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->per_membership_referral_price }}">
                                            <br>
                                            <label for="basic-input">admin percent on worker job</label>
                                            <input type="text" id="basic-input" class="form-control" value="{{ $setting->admin_percent_on_worker_job }}">
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--End Row-->
        </div>
        <!-- End container-fluid-->
    </div>
    <script>
        $('.summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 600,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
    <script>
        $(document).ready(function() {
           //Submit new category
           $('.update').click(function(){
               var formData = new FormData();
               formData.append('english_description', $('#english-description').val())
               formData.append('bengali_description', $('#bengali-description').val())
               $.ajax({
                   method: 'POST',
                   url: "{{ route('admin.updatePrivacyPolicy') }}",
                   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                   data: formData,
                   processData: false,
                   contentType: false,
                   success: function (data) {
                       Swal.fire({
                           position: 'top-end',
                           icon: 'success',
                           title: 'Successfully privacy policy updated',
                           showConfirmButton: false,
                           timer: 1500
                       })
                       setTimeout(function() {
                           location.reload();
                       }, 800);//

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
@push('foot')

@endpush
