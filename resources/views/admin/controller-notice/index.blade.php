@extends('admin.layout.app')
    @push('head')

    @endpush
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumb-->
            <div class="row pt-2 pb-2">
                <div class="col-sm-9">
                    <h4 class="page-title">Controller notices </h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javaScript:void();">Ashooo</a></li>
                        <li class="breadcrumb-item"><a href="javaScript:void();">Controller</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Notice</li>
                    </ol>
                </div>
            </div>
            <!-- End Breadcrumb-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Controller notices table</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-success shadow-success">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Controller</th>
                                        <th scope="col">Upazila</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Detail</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($notices as $notice)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $notice->controller->full_name }}</td>
                                        <td>{{ $notice->controller->upazila->name }}</td>
                                        <td>{{ $notice->title }}</td>
                                        <td> <pre> {{ $notice->detail }} </pre></td>
                                        <td> {{ date('d/m/Y h-m-s', strtotime($notice->created_at)) }} </td>
                                        <td>
                                            <input type="hidden" class="hidden-id" value="{{ $notice->id }}">
                                            <button type="button" id="edit" class="edit-button btn btn-outline-warning waves-effect waves-light m-1"> <i class="fa fa-edit"></i> </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--End Row-->
        </div>
        <!-- End container-fluid-->
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
                        <div class="input-group input-group-lg mb-3">
                           <div class="input-group-prepend">
                           <span class="input-group-text">Title</span>
                           </div>
                            <input type="hidden" id="notice-id">
                           <input type="text" class="form-control" name="title" id="title">
                         </div>
                        <div class="input-group input-group-lg mb-3">
                           <textarea rows="4" class="form-control" id="detail" placeholder="Notice detail ..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" id="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" ><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-primary" id="add-submit-button"><i class="fa fa-check-square-o"></i> Add new notice</button>
                    <button type="button" class="btn btn-primary" id="edit-submit-button"><i class="fa fa-check-square-o"></i> Edit notice</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <script>
        $(document).ready(function() {

            //Show modal for edit and set data
            $(".edit-button").click(function(){
                $('#modal').modal('show');
                $('#modal-title').html('Edit notice');
                $('#add-submit-button').hide();
                $('#edit-submit-button').show();
                $('#title').val($(this).parent().parent().find('td').eq(3).text());
                $('#detail').val($(this).parent().parent().find('td').eq(4).text());
                $('#notice-id').val($(this).parent().parent().find('.hidden-id').val());
            });

            //Submit edited category
            $('#edit-submit-button').click(function(){

                var formData = new FormData();
                formData.append('id', $('#notice-id').val())
                formData.append('title', $('#title').val())
                formData.append('detail', $('#detail').val())
                $.ajax({
                    method: 'POST',
                    url: '/admin/controller-notice/update',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#modal').modal('hide');
                        $('#category-name').val('');
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
