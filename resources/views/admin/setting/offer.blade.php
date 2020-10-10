@extends('admin.layout.app')
    @push('title')
        Offer Manage
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
                    <h4 class="page-title">Offer</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javaScript:void();">Ashooo</a></li>
                        <li class="breadcrumb-item"><a href="javaScript:void();">setting</a></li>
                        <li class="breadcrumb-item active" aria-current="page">offer</li>
                    </ol>
                </div>
            </div>
            <!-- End Breadcrumb-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <textarea name="" id="english-description" class="summernote" cols="30" rows="10">{{ $setting->en_offer }}</textarea>
                                    <button type="button" class="btn btn-danger btn-block waves-effect waves-light mb-1 update">UPDATE</button>
                                </div>
                                <div class="col-6">
                                    <textarea name="" id="bengali-description" class="summernote" cols="30" rows="10">{{ $setting->bn_offer }}</textarea>
                                    <button type="button" class="btn btn-danger btn-block waves-effect waves-light mb-1 update">আপডেট</button>
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
                   url: "{{ route('admin.updateOffer') }}",
                   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                   data: formData,
                   processData: false,
                   contentType: false,
                   success: function (data) {
                       Swal.fire({
                           position: 'top-end',
                           icon: 'success',
                           title: 'Successfully offer updated',
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
