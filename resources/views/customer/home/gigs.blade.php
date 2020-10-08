@extends('customer.layout.app')
@push('title') Gigs @endpush
@push('head')

@endpush
@section('content')

    <!-- Start title -->
    <div>
        <div class="alert alert-primary text-center" role="alert">
            <b>{{ $service->name }}</b>
        </div>
    </div>


    <!-- Start worker's bid of this area-->
    <div class="container">
        <div class="row">
            <div class="col-12 px-0">
                <div class="list-group list-group-flush ">

                    @foreach($service->workerGigs as $gig)
                        <a class="list-group-item border-top text-dark" href="{{ route('customer.showGigDetail',\Illuminate\Support\Facades\Crypt::encryptString($gig->id)) }}">
                            <div class="row">

                                <div class="col-auto align-self-center">
                                    <div class="row">
                                        &nbsp;
                                        <i class="material-icons text-template-primary">
                                            <figure class="avatar avatar-60 border-0">
                                                <img src="{{ asset('uploads/images/users/'.$gig->worker->image) }}" alt="">
                                            </figure>
                                        </i>
                                    </div>
                                    <div class="row">
                                        &nbsp;
                                        <span class="badge badge-primary mb-1">{{ $gig->budget }} ৳</span>
                                    </div>
                                </div>
                                <div class="col pl-0">
                                    <div class="row mb-1">
                                        <div class="col">
                                            <p class="mb-0">{{ $gig->worker->full_name }}</p>
                                        </div>
                                        <div class="col-auto pl-0">
                                            <p class="small text-mute text-trucated mt-1">
                                                @php
                                                    $percent = 100 - (($gig->worker->rating->max_rate - $gig->worker->rating->rate)/$gig->worker->rating->max_rate)*100;
                                                    if ($percent>80)
                                                        $star = 5;
                                                    else if ($percent>60)
                                                        $star = 4;
                                                    else if ($percent>40)
                                                        $star = 3;
                                                    else if ($percent>20)
                                                        $star = 2;
                                                    else if ($percent>1)
                                                        $star = 1;
                                                    else
                                                        $star = 0;
                                                @endphp
                                                @for ($starCounter = 1; $starCounter <= $star; $starCounter++)
                                                    <i class="material-icons btn-outline-warning small">star</i>
                                                @endfor
                                            </p>
                                        </div>
                                    </div>
                                    <p class="small text-mute">{{ \Illuminate\Support\Str::limit($gig->title, 25) }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <!-- End worker's bid of this area-->

<script>
</script>
@endsection
