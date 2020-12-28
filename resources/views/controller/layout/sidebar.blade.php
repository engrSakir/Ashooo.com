<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo text-center">
        <a href="{{ route('controller.dashboard.index') }}">
            <img src="{{ asset(get_static_option('logo') ?? 'uploads/images/defaults/logo-white.png') }}" width="200px" height="80" class="logo center" alt="ashooo">

        </a>
    </div>
    <ul class="sidebar-menu do-nicescrol">
        <br>
        <li class="sidebar-header">{{ __('CONTROLLER DASHBOARD') }}</li>
        <li><a href="{{ route('controller.dashboard.index') }}" class="waves-effect">
                <i class="fa fa-circle-o text-red"></i> <span>{{ __('Dashboard') }}</span></a></li>
        <li><a href="{{ route('controller.user.index') }}" class="waves-effect">
                <i class="fa fa-circle-o text-red"></i> <span>{{ __('Users') }}</span></a></li>
        <li><a href="{{ route('controller.notice.index') }}" class="waves-effect">
                <i class="fa fa-circle-o text-red"></i> <span>{{ __('Notice') }}</span></a></li>
        <li><a href="{{ route('controller.ads.index') }}" class="waves-effect">
                <i class="fa fa-circle-o text-red"></i> <span>{{ __('Ads') }}.</span></a></li>
        <li><a href="{{ route('controller.ads.index') }}" class="waves-effect">
                <i class="fa fa-circle-o text-red"></i> <span>{{ __('Special') }}</span></a></li>

    </ul>

</div>
