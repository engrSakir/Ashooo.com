<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="{{ route('controller.dashboard.index') }}">
            &nbsp;
            <img src="{{ asset('uploads/images/'.$setting->logo) }}" width="200px" class="logo center" alt="Ashooo">
        </a>
    </div>
    <ul class="sidebar-menu do-nicescrol">
        <li class="sidebar-header">{{ __('CONTROLLER DASHBOARD') }}</li>
        <li><a href="{{ route('controller.dashboard.index') }}" class="waves-effect">
                <i class="fa fa-circle-o text-red"></i> <span>{{ __('Dashboard') }}</span></a></li>
        <li><a href="{{ route('controller.user.index') }}" class="waves-effect">
                <i class="fa fa-circle-o text-red"></i> <span>{{ __('Users') }}</span></a></li>
        <li><a href="{{ route('controller.notice.index') }}" class="waves-effect">
                <i class="fa fa-circle-o text-red"></i> <span>{{ __('Notice') }}</span></a></li>
        <li><a href="{{ route('controller.ads.index') }}" class="waves-effect">
                <i class="fa fa-circle-o text-red"></i> <span>{{ __('Ads') }}.</span></a></li>

    </ul>

</div>
