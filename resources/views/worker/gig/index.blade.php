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
        <!-- Start job posting area -->
        <div class="container">
            <div class="card bg-template shadow mt-4 h-500">
                <div class="card-body">
                    <div class="row">
                        <div class="container">
                            <div class="form-group">
                                <input type="text" id="title" class="form-control form-control-lg" placeholder="Title here...">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control form-control-lg" id="description" rows="4" placeholder="Gig Description..."></textarea>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select id="service" class="form-control form-control-lg">
                                            <option disabled selected>Category</option>
                                            @foreach($categories as $category)
                                                <optgroup label="{{ $category->name }}">
                                                    @foreach($category->services as $service)
                                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="number" id="day" class="form-control form-control-lg" placeholder="Days 1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                <div class="form-group">
                                    <input type="text" id="tags" class="form-control form-control-lg" placeholder="Search tags">
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="number" id="price" class="form-control form-control-lg" placeholder="Price">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <button type="button" id="gig-submit-button" class="mb-2 btn btn-lg btn-success w-100 btn-rounded">Post Gig</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <!-- End job posting area -->

        <!-- Start My Gigs -->
        @foreach(auth()->user()->workerGigs as $gig)
        <div class="container cancelled-bid-job" id="">
            <div class="card shadow border-0 mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="font-weight-normal mb-1"><b>{{ Illuminate\Support\Str::limit($gig->title, 27)  }}</b></h5>
                            <div class="row text-center">
                                <div class="col-5 text-center color-border">
                                    <p class="text text-success mb-2">{{ 'Created' }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ date('h:i a m/d/y', strtotime($gig->created_at)) }}</p>
                                </div>
                                <div class="col-3 text-center color-border">
                                    <p class="text text-success mb-2">{{ $gig->customerBids->where('status', 'complete')->count() }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ 'Orders' }}</p>
                                </div>
                                <div class="col-3 text-center">
                                    <button type="button" class="mb-2 btn btn-lg btn-success view-btn" onclick="window.location.href='{{ route('worker.showCustomerBid', \Illuminate\Support\Facades\Crypt::encryptString($gig->id)) }}'">
                                        <i class="material-icons">visibility</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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
        });
    </script>
@endsection
