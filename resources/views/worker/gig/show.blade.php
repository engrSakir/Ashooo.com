@extends('worker.layout.app')
@push('title') Gigs @endpush
@push('head')

@endpush
@section('content')
    <div class="wrapper homepage">
        <!-- header -->
        <div class="header">
            <div class="row no-gutters">
                <div class="col-auto">
                    <button class="btn  btn-link text-dark menu-btn"><i class="material-icons">menu</i><span class="new-notification"></span></button>
                </div>
                <div class="col text-center"><img src="{{ asset('uploads/images/'.$setting->logo_header) }}" alt="" class="header-logo"></div>
                <div class="col-auto">
                    <a href="#" class="btn  btn-link text-dark position-relative"><i class="material-icons">notifications_none</i><span class="counts">9+</span></a>
                </div>
            </div>
        </div>
        <!-- header ends -->
        <!-- Start title -->
        <div class="">
            <div class="alert alert-primary text-center active-job" role="alert">
                <b id="">GIG</b>
            </div>
        </div>
        <!-- End title -->
        <div class="container">
            <b>{{ $workerGig->title }}</b>
           <div class="row">
               <div class="col text-center">
                   <div class="card shadow border-0">
                       <div class="card-body">
                           <div class="row no-gutters h-100">
                               <div class="col">
                                   <p>{{ $workerGig->customerBids->where('status','!=', 'cancelled')->count() }}<br><small class="text-secondary">Orders</small></p>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="col text-center">
                   <div class="card shadow border-0">
                       <div class="card-body">
                           <div class="row no-gutters h-100">
                               <div class="col">
                                   <p>{{ $workerGig->budget }}<br><small class="text-secondary">Price</small></p>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
        </div>
        <!-- Start My Gigs -->

        <!--End Canceller info & price-->
        <br>
        <!--Start work detail , address, day-->
        <div class="container">
            <h4 class="mb-3"><b>About this gig:</b></h4>
            <p>{{ $workerGig->description }}</p>
            <h4 class="mb-3"><b>Tags:</b></h4>
            <p>{{ $workerGig->tags }}</p>
            <div class="row">
                <div class="col">
                    <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                        <button disabled type="button" class="btn btn-outline-success active"><b>{{ $workerGig->day }}</b> <br> <small>  Day </small></button>
                        <button disabled type="button" class="btn btn-outline-success active"><b>{{ '$workerGig->' }}</b> <br> <small> Click </small></button>
                    </div>
                </div>
                <div class="col">
                    <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                        <button type="button" onclick="window.location.href='{{ route('worker.editWorkerGig', \Illuminate\Support\Facades\Crypt::encryptString($workerGig->id)) }}'" class="btn btn-success edit-btn"><b>Edit &nbsp;</b></button>
                        <button type="button" class="btn btn-danger delete-btn"><b>Delete</b></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End My Gigs -->



        <!-- footer-->
        <div class="footer">
            <div class="no-gutters">
                <div class="col-auto mx-auto">
                    <div class="row no-gutters justify-content-center">
                        <div class="col-auto">
                            <a href="{{ route('customer.home.index') }}" class="btn btn-link-default active">
                                <i class="material-icons">home</i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-link-default">
                                <i class="material-icons">insert_chart_outline</i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-link-default">
                                <i class="material-icons">account_balance_wallet</i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-link-default">
                                <i class="material-icons">widgets</i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-link-default">
                                <i class="material-icons">account_circle</i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer ends-->
    </div>

    <script>
        $(document).ready(function() {
            //Submit new Job
            $('#gig-submit-button').click(function(){
                var formData = new FormData();
                formData.append('title', $('#title').val())
                formData.append('description', $('#description').val())
                formData.append('service', $('#service').val())
                formData.append('day', $('#day').val())
                formData.append('address', $('#tags').val())
                formData.append('price', $('#price').val())

                $.ajax({
                    method: 'POST',
                    url: "{{ route('worker.gig.store') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#title').val('');
                        $('#description').val('');
                        $('#tags').val('');
                        //$('#service').val('');
                        $('#day').val('');
                        $('#price').val('');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Successfully add new gig.',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function() {
                            location.reload();
                        }, 1000); //1 second
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

            //Delete
            $('.delete-btn').click(function(){

            });
        });
    </script>
@endsection
