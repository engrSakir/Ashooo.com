@extends('admin.layout.app')
    @push('head')

    @endpush
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumb-->
            <div class="row pt-2 pb-2">
                <div class="col-sm-9">
                    <h4 class="page-title">Worker | Services </h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javaScript:void();">ashooo</a></li>
                        <li class="breadcrumb-item"><a href="javaScript:void();">Service</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List</li>
                    </ol>
                </div>
                <div class="col-sm-3">
                    <div class="btn-group float-sm-right">
                        <button type="button" id="add-new" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-plus"></i> Add new service</button>
                    </div>
                </div>
            </div>
            <!-- End Breadcrumb-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Service Table</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-success shadow-success">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col">Service Name</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($services as $service)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td><img src="{{ asset('uploads/images/worker/service/'.$service->icon) }}" height="50px" width="50px" style="border-radius: 15px;"></td>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ $service->category->name }}</td>
                                        <td>
                                            <input type="hidden" class="hidden-id" value="{{ $service->id }}">
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
                                <span class="input-group-text">Name</span>
                           </div>
                           <input type="hidden" id="service-id">
                           <input type="text" class="form-control" name="service-name" id="service-name">
                        </div>
                        <div class="input-group input-group-lg mb-3">
                            <input type="file" class="form-control valid" accept="image/*" id="icon" name="icon" required="" aria-invalid="false">
                        </div>

                        <div class="input-group input-group-lg mb-3">
                           <div class="input-group-prepend">
                                <span class="input-group-text">Category</span>
                           </div>
                            <select class="form-control" id="category-id">
                                <option disabled selected value="">Chose category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </form>
                </div>
                <div class="modal-footer" id="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" ><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-primary" id="add-submit-button"><i class="fa fa-check-square-o"></i> Add new service</button>
                    <button type="button" class="btn btn-primary" id="edit-submit-button"><i class="fa fa-check-square-o"></i> Edit service</button>
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
               $('#modal-title').html('Add a new service');
               $('#service-name').val('');
               $('#category-id').prop('selectedIndex',0); //Reset dropdown after click on edit
           });

           //Submit new
           $('#add-submit-button').click(function(){

               var formData = new FormData();
               formData.append('name', $('#service-name').val())
               formData.append('category', $('#category-id').val())
               formData.append('icon', $('#icon')[0].files[0])

               $.ajax({
                   method: 'POST',
                   url: '/admin/worker-service',
                   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                   data: formData,
                   processData: false,
                   contentType: false,
                   success: function (data) {
                       $('#modal').modal('hide');
                       $('#service-name').val('');
                       $('#category-id').val('');
                       Swal.fire({
                           position: 'top-end',
                           icon: 'success',
                           title: 'Successfully add '+data.name,
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
                $('#modal-title').html('Edit service');
                $('#add-submit-button').hide();
                $('#edit-submit-button').show();
                $('#service-name').val($(this).parent().parent().find('td').eq(2).text());
                //Find by value
                //$('#category-id').find('option[value="2"]').attr("selected",true);
                //Find by option
                var option = $(this).parent().parent().find('td').eq(3).text();
                $('#category-id').attr("selected",false)
                $('#category-id').find('option:contains('+option+')').attr("selected",true);

                $('#service-id').val($(this).parent().parent().find('.hidden-id').val());
            });

            //Submit edited
            $('#edit-submit-button').click(function(){

                var formData = new FormData();
                formData.append('id', $('#service-id').val())
                formData.append('name', $('#service-name').val())
                formData.append('category', $('#category-id').val())
                formData.append('icon', $('#icon')[0].files[0])
                $.ajax({
                    method: 'POST',
                    url: '/admin/worker-service/update',
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
                            title: 'Successfully edited '+data.name,
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
