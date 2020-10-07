<div class="sidebar">
    <div class="mt-4 mb-3">
        <div class="row">
            <div class="col-auto">
                <figure class="avatar avatar-60 border-0"><img src="{{ asset('uploads/images/users/'.auth()->user()->image) }}" alt=""></figure>
            </div>
            <div class="col pl-0 align-self-center">
                <h5 class="mb-1">{{ auth()->user()->full_name }} </h5>
                <p class="text-mute small">{{ auth()->user()->phone }}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="list-group main-menu">
                <a href="{{ route('worker.home.index') }}" class="list-group-item list-group-item-action @if(Route::is('worker.home.index')) active @endif"><i class="material-icons icons-raised">home</i>Home</a>
                <a href="{{ route('worker.job.index') }}" class="list-group-item list-group-item-action @if(Route::is('worker.job.index')) active @endif"><i class="material-icons icons-raised">work</i>My Job</a>
                <a href="{{ route('worker.gig.index') }}" class="list-group-item list-group-item-action @if(Route::is('worker.gig.index')) active @endif"><i class="material-icons icons-raised">add_to_queue</i>Gigs</a>


                <a href="#" onclick="logout()" class="list-group-item list-group-item-action"><i class="material-icons icons-raised bg-danger">power_settings_new</i>Logout</a>
            </div>
        </div>
    </div>
</div>
<a href="javascript:void(0)" class="closesidemenu"><i class="material-icons icons-raised bg-dark ">close</i></a>
