@extends('worker.layout.app')
@push('title') Gigs @endpush
@push('head')

@endpush
@section('content')

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
                                    <p class="text text-success mb-2">{{ $gig->customerBids->where('status', '!=', 'cancelled')->count() }}</p>
                                    <p class="text-mute small text-secondary mb-2">{{ 'Orders' }}</p>
                                </div>
                                <div class="col-3 text-center">
                                    <button type="button" class="mb-2 btn btn-lg btn-success view-btn" onclick="window.location.href='{{ route('worker.showWorkerGig', \Illuminate\Support\Facades\Crypt::encryptString($gig->id)) }}'">
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

    <script>
        $(document).ready(function() {
            //Submit new Job
            $('#gig-submit-button').click(function(){
                var formData = new FormData();
                formData.append('title', $('#title').val())
                formData.append('description', $('#description').val())
                formData.append('service', $('#service').val())
                formData.append('day', $('#day').val())
                formData.append('tags', $('#tags').val())
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
