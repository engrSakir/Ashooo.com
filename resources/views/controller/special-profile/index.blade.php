@extends('controller.layout.app')
@push('title') Special service @endpush
@push('head')

@endpush
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumb-->
            <div class="row pt-2 pb-2">
                <div class="col-sm-9">
                    <h4 class="page-title">Special service </h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javaScript:void();">ashooo</a></li>
                        <li class="breadcrumb-item"><a href="javaScript:void();">Controller</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Special service</li>
                    </ol>
                </div>
                <div class="col-sm-3">
                    <div class="btn-group float-sm-right">
                        <button type="button" id="add-new" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-plus"></i> Add new profile</button>
                    </div>
                </div>
            </div>
            <!-- End Breadcrumb-->
            <div class="row">
                @foreach(auth()->user()->upazila->special_profiles as $profile)
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="profile-card-2">
                        <div class="card profile-primary">
                            <div class="card-body text-center">
                                <div class="user-box">
                                    <img src="{{ asset($profile->image ?? 'uploads/images/defaults/user.png') }}" alt="user avatar">
                                </div>
                                <h5 class="mb-1">{{ $profile->name }}</h5>
                                <h6 class="text-muted">{{ $profile->description }}</h6>
                                <div class="card-body">
                                    <ul class="list-group shadow-none">
                                        <li class="list-group-item">
                                            <div class="list-icon">
                                                <i class="fa fa-phone-square"></i>
                                            </div>
                                            <div class="list-details">
                                                <span>{{ $profile->phone }}</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="list-inline mt-2">
                                    <a href="javascript:void()" class="list-inline-item btn-social btn-facebook waves-effect waves-light"><i class="fa fa-smile-o"></i></a>
                                    <a href="javascript:void()" class="list-inline-item btn-social btn-google-plus waves-effect waves-light"><i class="fa fa-trash-o"></i></a>
                                    <a href="javascript:void()" class="list-inline-item btn-social btn-twitter waves-effect waves-light"><i class="fa ti-face-sad"></i></a>
                                </div>
                                <hr>
                                <a href="javascript:void():" class="list-inline-item btn btn-primary btn-block waves-effect waves-light">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- End container-fluid -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"><i class="fa fa-star"></i> <!--Title insert by ajax--> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                    <form action="#" id="add-new-from">
                        <input type="hidden" id="special-profile-id">
                        <div class="input-group input-group-lg mb-3">
                            <select class="form-control" id="special-service">
                                @foreach($special_services as $special_service)
                                <option value="{{ $special_service->id }}">{{ $special_service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group input-group-lg mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Name</span>
                            </div>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="input-group input-group-lg mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Phone</span>
                            </div>
                            <input type="text" class="form-control" name="phone" id="phone">
                        </div>
                        <div class="input-group input-group-lg mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Image</span>
                            </div>
                            <input type="file" accept="image/*" class="form-control" name="image" id="image">
                        </div>
                        <div class="input-group input-group-lg mb-3">
                            <textarea rows="4" class="form-control" id="description" placeholder="Service details ..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" id="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" ><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-primary" id="add-submit-button"><i class="fa fa-check-square-o"></i> Add new profile</button>
                    <button type="button" class="btn btn-primary" id="edit-submit-button"><i class="fa fa-check-square-o"></i> Edit profile</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <script>
        $(document).ready(function() {
            //Show modal for add
            $('#add-new').click(function(){
                $('#modal').modal('show');
                $('#edit-submit-button').hide();
                $('#add-submit-button').show();
                $('#modal-title').html('Add a new special profile');
                $('#add-new-from').trigger("reset");
            });

            //Submit new special profile
            $('#add-submit-button').click(function(){
                var formData = new FormData();
                formData.append('service', $('#special-service').val())
                formData.append('name', $('#name').val())
                formData.append('phone', $('#phone').val())
                formData.append('description', $('#description').val())
                formData.append('image', $('#image')[0].files[0])
                $.ajax({
                    method: 'POST',
                    url: '{{ route('controller.special-profile.store') }}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#modal').modal('hide');
                        $('#add-new-from').trigger("reset");
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Successfully add ',
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

            //Show modal for edit and set data
            $(".edit-button").click(function(){
                $('#modal').modal('show');
                $('#modal-title').html('Edit notice');
                $('#add-submit-button').hide();
                $('#edit-submit-button').show();
                $('#title').val($(this).parent().find('.notice-title').text());
                $('#detail').val($(this).parent().find('.notice-detail').text());
                $('#notice-id').val($(this).parent().find('.hidden-id').val());
            });

            //Submit edited category
            $('#edit-submit-button').click(function(){

                var formData = new FormData();
                formData.append('id', $('#notice-id').val())
                formData.append('title', $('#title').val())
                formData.append('detail', $('#detail').val())
                $.ajax({
                    method: 'POST',
                    url: "{{ route('controller.notice.update') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#modal').modal('hide');
                        $('#title').val('');
                        $('#detail').val('');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Successfully edited '+data.title,
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
