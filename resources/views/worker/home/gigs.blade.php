@extends('worker.layout.app')
@push('title') {{ __('Gigs') }} @endpush
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
                @foreach($service->customerGigs->where('status', 'active') as $customerGig)
                    @if($customerGig->customer->upazila_id == auth()->user()->upazila_id)
                        <!-- Check already bid or not -->
                            @if(!auth()->user()->workerBids()->where('customer_gig_id', $customerGig->id)->exists())
                                <div class="card shadow border-0 mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="font-weight-normal mb-1"><b>{{ Illuminate\Support\Str::limit($customerGig->title, 80) }}</b></h5>
                                                <p class="text text-warning mb-2">{{ Illuminate\Support\Str::limit($customerGig->description, 70) }}</p>
                                                <div class="row text-center">
                                                    <div class="col-4 text-center color-border">
                                                        <p class="text text-success mb-2">{{ __('Created') }}</p>
                                                        <p class="text-mute small text-secondary mb-2">{{ __(date('h:i a m/d/Y', strtotime($customerGig->created_at))) }}</p>
                                                    </div>
                                                    <div class="col-4 text-center color-border">
                                                        <p class="text text-success mb-2">{{ __('Budget') }}</p>
                                                        <p class="text-mute small text-secondary mb-2">{{ __($customerGig->budget) }}</p>
                                                    </div>
                                                    <div class="col-4 text-center color-border">
                                                        <p class="text text-success mb-2">{{ __('Bid sent') }}</p>
                                                        <p class="text-mute small text-secondary mb-2">{{ __($customerGig->workerBids->count()) }}</p>
                                                    </div>
                                                    <div class="col-12 text-center">
                                                        <button type="button" class="mb-2 btn btn-lg btn-success view-btn" onclick="window.location.href='{{ route('worker.showJob',\Illuminate\Support\Facades\Crypt::encryptString($customerGig->id) ) }}'">
                                                            <b>{{ __('Bid Now') }}</b>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- End worker's bid of this area-->

<script>
</script>
@endsection
