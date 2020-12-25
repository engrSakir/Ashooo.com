@extends('admin.layout.app')
    @push('title') Membership @endpush
    @push('head')

    @endpush
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumb-->
            <div class="row pt-2 pb-2">
                <div class="col-sm-9">
                    <h4 class="page-title">Membership package manage </h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javaScript:void();">ashooo</a></li>
                        <li class="breadcrumb-item"><a href="javaScript:void();">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Package Membership</li>
                    </ol>
                </div>
                <div class="col-sm-3">
                    <div class="btn-group float-sm-right">
                        <button type="button" id="add-new" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-plus"></i> Add membership</button>
                    </div>
                </div>
            </div>
            <!-- End Breadcrumb-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach($packages as $package)
                                    <div class="col-lg-4">
                                        <div class="pricing-table">
                                            <div class="card border border-success">
                                                <div class="card-body text-center">
                                                    <div class="price-title text-success package-name">{{ $package->name }}</div>
                                                    <input type="hidden" class="hidden-id" value="{{ $package->id }}">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item"><b>3 Month price </b> <i class="three_month_price">{{ $package->three_month_price }}</i> ৳</li>
                                                        <li class="list-group-item"><b>6 Month price </b> <i class="six_month_price">{{ $package->six_month_price }}</i> ৳</li>
                                                        <li class="list-group-item"><b>12 Month price </b> <i class="twelve_month_price">{{ $package->twelve_month_price }}</i> ৳</li>
                                                        <li class="list-group-item"><b>Mobile Number</b>
                                                            @if($package->mobile_availability == 1)
                                                                <span class="badge badge-success shadow-success m-1 mobile_availability">Active</span>
                                                            @else
                                                                <span class="badge badge-danger shadow-danger m-1 mobile_availability">Inactive</span>
                                                            @endif
                                                           </li>
                                                        <li class="list-group-item"><b>Description</b>
                                                            @if($package->description_availability == 1)
                                                                <span class="badge badge-success shadow-success m-1 description_availability">Active</span>
                                                            @else
                                                                <span class="badge badge-danger shadow-danger m-1 description_availability">Inactive</span>
                                                            @endif
                                                        </li>
                                                        <li class="list-group-item"><b>Image</b>
                                                            <span class="badge badge-success shadow-success m-1 image_count">{{ $package->image_count }}</span>
                                                        </li>
                                                        <li class="list-group-item"><b>Position</b>
                                                            <span class="badge badge-success shadow-success m-1 position">{{ $package->position }}</span>
                                                        </li>
                                                    </ul>
                                                    <a href="javascript:void();" class="btn btn-outline-success my-3 btn-round edit-button">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
                        <input type="hidden" id="package-id">
                        <div class="input-group input-group-lg mb-3">
                           <div class="input-group-prepend">
                           <span class="input-group-text">Package Name</span>
                           </div>
                           <input type="text" class="form-control" name="name" id="name">
                         </div>
                        <div class="input-group input-group-lg mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Position Number</span>
                            </div>
                            <input type="number" class="form-control" name="position" id="position">
                        </div>
                        <div class="input-group input-group-lg mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Maximum Image</span>
                            </div>
                            <input type="number" class="form-control" name="image" id="image">
                        </div>
                        <div class="input-group input-group-lg mb-3">
                           <div class="input-group-prepend">
                           <span class="input-group-text">Price of 3 Month</span>
                           </div>
                           <input type="number" class="form-control" name="three" id="three">
                         </div>
                        <div class="input-group input-group-lg mb-3">
                           <div class="input-group-prepend">
                           <span class="input-group-text">Price of 6 Month</span>
                           </div>
                           <input type="number" class="form-control" name="six" id="six">
                         </div>
                        <div class="input-group input-group-lg mb-3">
                           <div class="input-group-prepend">
                           <span class="input-group-text">Price of 12 Month</span>
                           </div>
                           <input type="number" class="form-control" name="twelve" id="twelve">
                         </div>
                        <div class="input-group input-group-lg mb-3">
                            <input type="checkbox" id="phone" value="" class="filled-in chk-col-success">
                            <label for="phone" class="btn-round btn-info waves-effect waves-light">Is available phone number !!!!</label>
                        </div>
                        <div class="input-group input-group-lg mb-3">
                            <input type="checkbox" id="description" value="" class="filled-in chk-col-success">
                            <label for="description" class="btn-round btn-info waves-effect waves-light">Is available description !!!!!!!!!!!</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" id="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" ><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-primary" id="add-submit-button"><i class="fa fa-check-square-o"></i> Add new package</button>
                    <button type="button" class="btn btn-primary" id="edit-submit-button"><i class="fa fa-check-square-o"></i> Edit package</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <script>
        $(document).ready(function() {

            //Assign checkbox box value
            $('#phone').change(function (){
                if($('#phone').prop('checked')) {
                    $('#phone').val('1')
                } else {
                    $('#phone').val('0')
                }
            })

            $('#description').change(function (){
                if($('#description').prop('checked')) {
                    $('#description').val('1')
                } else {
                    $('#description').val('0')
                }
            })

           //Show modal for add
           $('#add-new').click(function(){
               $('#modal').modal('show');
               $('#edit-submit-button').hide();
               $('#add-submit-button').show();
               $('#modal-title').html('Add a new package');
               $('#add-new-from').trigger("reset");
           });

           //Submit new category
           $('#add-submit-button').click(function(){
               var formData = new FormData();
               formData.append('package_name', $('#name').val())
               formData.append('position_number', $('#position').val())
               formData.append('maximum_image', $('#image').val())
               formData.append('price_of_3_month', $('#three').val())
               formData.append('price_of_6_month', $('#six').val())
               formData.append('price_of_12_month', $('#twelve').val())
               formData.append('is_available_phone_number', $('#phone').val())
               formData.append('is_available_description', $('#description').val())

               $.ajax({
                   method: 'POST',
                   url: "{{ route('admin.membership-package.store') }}",
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
                           title: 'Successfully add new package.',
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
                $('#modal-title').html('Edit membership package');
                $('#add-submit-button').hide();
                $('#edit-submit-button').show();

                $('#name').val($(this).parent().find('.package-name').text());
                $('#position').val($(this).parent().find('.position').text());
                $('#image').val($(this).parent().find('.image_count').text());
                $('#three').val($(this).parent().find('.three_month_price').text());
                $('#six').val($(this).parent().find('.six_month_price').text());
                $('#twelve').val($(this).parent().find('.twelve_month_price').text());
                $('#package-id').val($(this).parent().find('.hidden-id').text());

                if ($(this).parent().find('.mobile_availability').text() == 'Active'){
                    $('#phone').prop("checked", true )
                    $('#phone').val('1')
                }else{
                    $('#phone').prop("checked", false )
                    $('#phone').val('1')
                }
                if ($(this).parent().find('.description_availability').text() == 'Active'){
                    $('#description').prop('checked', true )
                    $('#description').val('1')
                }else{
                    $('#description').prop('checked', false )
                    $('#description').val('0')
                }
                $('#package-id').val($(this).parent().find('.hidden-id').val());
            });

            //Submit edited category
            $('#edit-submit-button').click(function(){
                var formData = new FormData();
                formData.append('package', $('#package-id').val())
                formData.append('package_name', $('#name').val())
                formData.append('position_number', $('#position').val())
                formData.append('maximum_image', $('#image').val())
                formData.append('price_of_3_month', $('#three').val())
                formData.append('price_of_6_month', $('#six').val())
                formData.append('price_of_12_month', $('#twelve').val())
                formData.append('is_available_phone_number', $('#phone').val())
                formData.append('is_available_description', $('#description').val())
                $.ajax({
                    method: 'POST',
                    url: "{{ route('admin.updateMembershipPackage') }}",
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
                            title: 'Successfully updated',
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
