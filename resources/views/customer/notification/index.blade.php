@extends('customer.layout.app')
@push('title') Notifications @endpush
@push('head')

@endpush
@section('content')
    <!-- Start title -->
   <div class="">
       <div class="alert alert-warning text-center" role="alert">
           <b id="bid-job">NOTIFICATIONS</b>
       </div>
   </div>
    <!-- End title -->
    <div class="container">
        <div class="row">
            <div class="col-12 px-0">
                <div class="list-group list-group-flush ">
                    @foreach(auth()->user()->notifications as $notification)
                    <a class="list-group-item border-top active text-dark" href="{{ url($notification->data['url']) }}">
                        <div class="row">
                            <div class="col-auto align-self-center">
                                <i class="material-icons text-template-primary">notifications_active</i>
                            </div>
                            <div class="col pl-0">
                                <div class="row mb-1">
                                    <div class="col">
                                        <p class="mb-0">{{ $notification->data['title'] }}</p>
                                    </div>
                                    <div class="col-auto pl-0">
                                        <p class="small text-mute text-trucated mt-1">{{ $notification->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                <p class="small text-mute">{{ $notification->data['message'] }}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>



<script>
    $(document).ready(function() {

    });

</script>
@endsection
