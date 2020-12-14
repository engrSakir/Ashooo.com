@extends('worker.layout.app')
@push('title') {{ __('Gigs') }} @endpush
@push('head')

@endpush
@section('content')
        <!-- Start title -->
        <div class="">
            <div class="alert alert-primary text-center active-job" role="alert">
                <b id="">{{ __('Gigs') }}</b>
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
                                   <p>{{ $workerGig->customerBids->where('status','!=', 'cancelled')->count() }}<br><small class="text-secondary">{{ __('Orders') }}</small></p>
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
                                   <p>{{ $workerGig->budget }}<br><small class="text-secondary">{{ __('Price') }}</small></p>
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
            <h4 class="mb-3"><b>{{ __('About this gig:') }}</b></h4>
            <pre>{{ $workerGig->description }}</pre>
            <h4 class="mb-3"><b>{{ __('Tags:') }}</b></h4>
            <p>{{ $workerGig->tags }}</p>
            <div class="row">
                <div class="col">
                    <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                        <button disabled type="button" class="btn btn-outline-success active"><b>{{ $workerGig->day }}</b> <br> <small>  {{ __('Day') }} </small></button>
                        <button disabled type="button" class="btn btn-outline-success active"><b>{{ $workerGig->customerBids->where('status', '!=', 'cancelled')->count() }}</b> <br> <small> {{ __('Click') }} </small></button>
                    </div>
                </div>
                <div class="col">
                    <div class="btn-group btn-group-lg btn-group w-100 mb-2 text-center" role="group" aria-label="Basic example">
                        <button type="button" onclick="window.location.href='{{ route('worker.editWorkerGig', \Illuminate\Support\Facades\Crypt::encryptString($workerGig->id)) }}'" class="btn btn-success edit-btn"><b>{{ __('Edit') }} &nbsp;</b></button>
                        <button type="button" value="{{ $workerGig->id }}" class="btn btn-danger delete-btn"><b>{{ __('Delete') }}</b></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End My Gigs -->

    <script>
        $(document).ready(function() {
            //Delete
            $('.delete-btn').click(function(){
                Swal.fire({
                    title: 'Delete this gig ?',
                    text: "",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete now!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var formData = new FormData();
                        formData.append('gig', $(this).val())
                        $.ajax({
                            method: 'POST',
                            url: "{{ route('worker.deleteWorkerGig') }}",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: data.type,
                                    title: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                setTimeout(function() {
                                    location.replace("{{ route('worker.gig.index') }}")
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
                    }
                })
            });
        });
    </script>
@endsection
