@extends('controller.layout.app')
    @push('head')
        <!--Lightbox Css-->
        <link href="{{ asset('assets/plugins/fancybox/css/jquery.fancybox.min.css') }}" rel="stylesheet" type="text/css"/>
    @endpush
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumb-->
            <div class="row pt-2 pb-2">
                <div class="col-sm-9">
                    <h4 class="page-title">Users of {{ auth()->user()->upazila->name }}</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javaScript:void();">{{ $setting->name }}</a></li>
                        <li class="breadcrumb-item"><a href="javaScript:void();">Users of</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ auth()->user()->upazila->name }}</li>
                    </ol>
                </div>
            </div>
            <!-- End Breadcrumb-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-info nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#worker"><i class="icon-home"></i> <span class="hidden-xs">Worker</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#membership"><i class="icon-user"></i> <span class="hidden-xs">Membership</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#customer"><i class="icon-envelope-open"></i> <span class="hidden-xs">Customer</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#general"><i class="icon-envelope-open"></i> <span class="hidden-xs">General</span></a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div id="worker" class="container tab-pane active show">
                                    <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-success shadow-success">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Image</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Phone</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(auth()->user()->upazila->workers as $worker)
                                                    <tr>
                                                        <td scope="row">{{ $loop->iteration }}</td>
                                                        <td>
                                                            <span class="user-profile"><img src="{{ asset('uploads/images/users/'.$worker->image) }}" class="img-circle" alt="user avatar"></span>
                                                        </td>
                                                        <td>{{ $worker->full_name }}</td>
                                                        <td>{{ $worker->phone }}</td>
                                                        <td>
                                                            <input type="hidden" class="hidden-id" value="{{ $worker->id }}">
                                                            @if($worker->status == 1)
                                                                <button type="button" class="status-button btn btn-outline-success waves-effect waves-light m-1"> <i class="fa fa-smile-o"></i> </button>
                                                            @else
                                                                <button type="button" class="status-button btn btn-outline-danger waves-effect waves-light m-1"> <i class="fa ti-face-sad"></i> </button>
                                                            @endif
                                                            <button type="button" data-toggle="modal" data-target="#worker-details-of-id-{{ $worker->id }}" class="btn btn-outline-warning waves-effect waves-light m-1"> <i class="fa fa-eye"></i> </button>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="worker-details-of-id-{{ $worker->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modal-title"><i class="fa fa-star"></i> {{ $worker->full_name }} </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modal-title"><i class="fa fa-phone"></i> {{ $worker->phone }} </h5>
                                                                </div>
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modal-title"><i class="fa fa-id-card"></i> {{ $worker->nid }} </h5>
                                                                </div>
                                                                <div class="modal-body" id="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-lg-3 col-xl-3">
                                                                            <a href="{{ asset('uploads/images/users/'.$worker->image) }}" data-fancybox="images">
                                                                                <img src="{{ asset('uploads/images/users/'.$worker->image) }}" class="lightbox-thumb img-thumbnail">
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-md-6 col-lg-3 col-xl-3">
                                                                            <a href="{{ asset('uploads/images/nid/'.$worker->front_image) }}" data-fancybox="images">
                                                                                <img src="{{ asset('uploads/images/nid/'.$worker->front_image) }}" class="lightbox-thumb img-thumbnail">
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-md-6 col-lg-3 col-xl-3">
                                                                            <a href="{{ asset('uploads/images/nid/'.$worker->back_image) }}" data-fancybox="images">
                                                                                <img src="{{ asset('uploads/images/nid/'.$worker->back_image) }}" class="lightbox-thumb img-thumbnail">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer" id="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" ><i class="fa fa-times"></i> Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                                <div id="membership" class="container tab-pane fade">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="thead-warning shadow-warning">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(auth()->user()->upazila->memberships as $membership)
                                                <tr>
                                                    <td scope="row">{{ $loop->iteration }}</td>
                                                    <td>
                                                        <span class="user-profile"><img src="{{ asset('uploads/images/users/'.$membership->image) }}" class="img-circle" alt="user avatar"></span>
                                                    </td>
                                                    <td>{{ $membership->full_name }}</td>
                                                    <td>{{ $membership->phone }}</td>
                                                    <td>
                                                        <input type="hidden" class="hidden-id" value="{{ $membership->id }}">
                                                        @if($membership->status == 1)
                                                            <button type="button" class="status-button btn btn-outline-success waves-effect waves-light m-1"> <i class="fa fa-smile-o"></i> </button>
                                                        @else
                                                            <button type="button" class="status-button btn btn-outline-danger waves-effect waves-light m-1"> <i class="fa ti-face-sad"></i> </button>
                                                        @endif
                                                        <button type="button" data-toggle="modal" data-target="#membership-details-of-id-{{ $membership->id }}" class="btn btn-outline-warning waves-effect waves-light m-1"> <i class="fa fa-eye"></i> </button>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="membership-details-of-id-{{ $membership->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modal-title"><i class="fa fa-star"></i> {{ $membership->full_name }} </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modal-title"><i class="fa fa-phone"></i> {{ $membership->phone }} </h5>
                                                            </div>
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modal-title"><i class="fa fa-id-card"></i> {{ $membership->nid }} </h5>
                                                            </div>
                                                            <div class="modal-body" id="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-6 col-lg-3 col-xl-3">
                                                                        <a href="{{ asset('uploads/images/users/'.$membership->image) }}" data-fancybox="images">
                                                                            <img src="{{ asset('uploads/images/users/'.$membership->image) }}" class="lightbox-thumb img-thumbnail">
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-3 col-xl-3">
                                                                        <a href="{{ asset('uploads/images/nid/'.$membership->front_image) }}" data-fancybox="images">
                                                                            <img src="{{ asset('uploads/images/nid/'.$membership->front_image) }}" class="lightbox-thumb img-thumbnail">
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-3 col-xl-3">
                                                                        <a href="{{ asset('uploads/images/nid/'.$membership->back_image) }}" data-fancybox="images">
                                                                            <img src="{{ asset('uploads/images/nid/'.$membership->back_image) }}" class="lightbox-thumb img-thumbnail">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer" id="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" ><i class="fa fa-times"></i> Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="customer" class="container tab-pane fade">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="thead-info shadow-info">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(auth()->user()->upazila->customers as $customer)
                                                <tr>
                                                    <td scope="row">{{ $loop->iteration }}</td>
                                                    <td>
                                                        <span class="user-profile"><img src="{{ asset('uploads/images/users/'.$customer->image) }}" class="img-circle" alt="user avatar"></span>
                                                    </td>
                                                    <td>{{ $customer->full_name }}</td>
                                                    <td>{{ $customer->phone }}</td>
                                                    <td>
                                                        <input type="hidden" class="hidden-id" value="{{ $customer->id }}">
                                                        @if($customer->status == 1)
                                                        <button type="button" class="status-button btn btn-outline-success waves-effect waves-light m-1"> <i class="fa fa-smile-o"></i> </button>
                                                        @else
                                                            <button type="button" class="status-button btn btn-outline-danger waves-effect waves-light m-1"> <i class="fa ti-face-sad"></i> </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="general" class="container tab-pane fade">
                                    <h1><b>Upcomming</b></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End container-fluid-->
    </div>
    <!-- Modal -->

    <script>
        $(document).ready(function() {
            //Submit new
            $('.status-button').click(function(){
                $.ajax({
                    method: 'POST',
                    url: '{{ route('controller.userStatus') }}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: { person: $(this).parent().parent().find('.hidden-id').val()},
                    dataType: 'JSON',
                    success: function (data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Successfully status changed',
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
    <!--Lightbox-->
    <script src="{{ asset('assets/plugins/fancybox/js/jquery.fancybox.min.js') }}"></script>
@endpush

