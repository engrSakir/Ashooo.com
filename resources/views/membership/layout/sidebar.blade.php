<div class="sidebar">
    <div class="mt-4 mb-3">
        <div class="row">
            <div class="col-auto">
                <figure class="avatar avatar-60 border-0"><img src="{{ asset(auth()->user()->image ?? 'uploads/images/defaults/user.png') }}" alt=""></figure>
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
                <a href="{{ route('membership.home.index') }}" class="list-group-item list-group-item-action active"><i class="material-icons icons-raised">home</i>Home</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="material-icons icons-raised">notifications</i>Notification <span class="badge badge-dark text-white">2</span></a>
                <a href="#" class="list-group-item list-group-item-action"><i class="material-icons icons-raised">find_in_page</i>History</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="material-icons icons-raised">view_quilt<span class="new-notification"></span></i>Pages Controls</a>
                <a href="{{ route('language') }}" class="list-group-item list-group-item-action"><i class="material-icons icons-raised">language</i>@if(current_language() == 'bn') {{ __('English') }} @else {{ __('বাংলা') }} @endif</a>
                <a href="javascript:void(0)" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#colorscheme"><i class="material-icons icons-raised">color_lens</i>{{ __('customer/sidebar.color_change') }}</a>
                <a href="#" onclick="logout()" class="list-group-item list-group-item-action"><i class="material-icons icons-raised bg-danger">power_settings_new</i>{{ __('Logout') }}</a>
            </div>
        </div>
    </div>
</div>
<a href="javascript:void(0)" class="closesidemenu"><i class="material-icons icons-raised bg-dark ">close</i></a>
