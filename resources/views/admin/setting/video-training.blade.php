@extends('admin.layout.app')
    @push('title')
        Video training
    @endpush
    @push('head')

    @endpush
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumb-->
            <div class="row pt-2 pb-2">
                <div class="col-sm-9">
                    <h4 class="page-title">Video Training</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javaScript:void();">Ashooo</a></li>
                        <li class="breadcrumb-item"><a href="javaScript:void();">setting</a></li>
                        <li class="breadcrumb-item active" aria-current="page">video-training</li>
                    </ol>
                </div>
            </div>
            <!-- End Breadcrumb-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <label>Customer video training link</label>
                            <div class="input-group bootstrap-touchspin input-group-lg">
                                <span class="input-group-text bootstrap-touchspin-postfix btn btn-secondary btn-lg update">Update Now</span>
                                <input id="demo4_2" type="text" value="{{ $setting->customer_video_training_url }}" name="demo4_2" class="customer form-control-lg form-control" style="display: block;">
                                <span class="input-group-text bootstrap-touchspin-prefix">
                                <a href="{{ $setting->customer_video_training_url }}" target="_blank" class="btn-social btn-outline-dribbble waves-effect waves-light m-1"><i class="fa fa-eye"></i></a>
                                </span>
                            </div>
                            <hr>
                            <label>Worker video training link</label>
                            <div class="input-group bootstrap-touchspin input-group-lg">
                                <span class="input-group-text bootstrap-touchspin-postfix btn btn-secondary btn-lg update">Update Now</span>
                                <input id="demo4_2" type="text" value="{{ $setting->worker_video_training_url }}" name="demo4_2" class="worker form-control-lg form-control" style="display: block;">
                                <span class="input-group-text bootstrap-touchspin-prefix">
                                <a href="{{ $setting->worker_video_training_url }}" target="_blank" class="btn-social btn-outline-dribbble waves-effect waves-light m-1"><i class="fa fa-eye"></i></a>
                                </span>
                            </div>
                            <hr>
                            <label>Membership video training link</label>
                            <div class="input-group bootstrap-touchspin input-group-lg">
                                <span class="input-group-text bootstrap-touchspin-postfix btn btn-secondary btn-lg update">Update Now</span>
                                <input id="demo4_2" type="text" value="{{ $setting->membership_video_training_url }}" name="demo4_2" class="membership form-control-lg form-control" style="display: block;">
                                <span class="input-group-text bootstrap-touchspin-prefix">
                                <a href="{{ $setting->membership_video_training_url }}" target="_blank" class="btn-social btn-outline-dribbble waves-effect waves-light m-1"><i class="fa fa-eye"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--End Row-->
        </div>
        <!-- End container-fluid-->
    </div>
    <script>
        $(document).ready(function() {
           //Submit new category
           $('.update').click(function(){
               var formData = new FormData();
               formData.append('customer_video_training_url', $('.customer').val())
               formData.append('worker_video_training_url', $('.worker').val())
               formData.append('membership_video_training_url', $('.membership').val())
               $.ajax({
                   method: 'POST',
                   url: "{{ route('admin.updateVideoTraining') }}",
                   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                   data: formData,
                   processData: false,
                   contentType: false,
                   success: function (data) {
                       Swal.fire({
                           position: 'top-end',
                           icon: 'success',
                           title: 'Successfully video training updated',
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
               });
           });
        });
    </script>

@endsection
@push('foot')

@endpush
