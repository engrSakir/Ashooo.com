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
                <a href="{{ route('customer.home.index') }}" class="list-group-item list-group-item-action @if(Route::is('customer.home.index')) active @endif"><i class="material-icons icons-raised">home</i>{{ __('customer/sidebar.home') }}</a>
                <a href="{{ route('customer.myJob') }}" class="list-group-item list-group-item-action @if(Route::is('customer.myJob')) active @endif"><i class="material-icons icons-raised">work</i>{{ __('customer/sidebar.my_order') }}</a>
                <a href="{{ route('customer.showGeneralServiceCategory') }}" class="list-group-item list-group-item-action @if(Route::is('customer.showGeneralServiceCategory')) active @endif"><i class="material-icons icons-raised">blur_linear</i>{{ __('customer/sidebar.others') }}</a>
                <a href="{{ route('customer.profile.index') }}" class="list-group-item list-group-item-action @if(Route::is('customer.profile.index')) active @endif"><i class="material-icons icons-raised">face</i>{{ __('customer/sidebar.profile') }}</a>
                <a href="{{ route('language') }}" class="list-group-item list-group-item-action"><i class="material-icons icons-raised">language</i>{{ __('customer/sidebar.language_change') }}</a>
                <a href="javascript:void(0)" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#colorscheme"><i class="material-icons icons-raised">color_lens</i>{{ __('customer/sidebar.color_change') }}</a>
                <a href="#" onclick="logout()" class="list-group-item list-group-item-action"><i class="material-icons icons-raised bg-danger">power_settings_new</i>{{ __('customer/sidebar.logout') }}</a>
            </div>
        </div>
    </div>
</div>
<!---->
<a href="javascript:void(0)" class="closesidemenu"><i class="material-icons icons-raised bg-dark ">close</i></a>
