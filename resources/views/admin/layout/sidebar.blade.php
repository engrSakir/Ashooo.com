<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="{{ route('admin.dashboard.index') }}">
            &nbsp;
            <img src="{{ asset( get_static_option('logo_white')  ?? 'uploads/images/defaults/logo-white.png') }}" width="200px" class="logo center" alt="ashooo">
        </a>
    </div>
    <ul class="sidebar-menu do-nicescrol">
        <br>
        <br>
        <li class="sidebar-header">{{ __('ADMIN DASHBOARD') }} </li>
        <li>
            <a href="{{ route('admin.dashboard.index') }}" class="waves-effect">
                <i class="icon-home"></i> <span>{{ __('Dashboard') }}</span>
            </a>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-briefcase"></i>
                <span>{{ __('Area') }}</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.district.index') }}"><i class="fa fa-circle-o"></i> {{ __('District') }} </a></li>
                <li><a href="{{ route('admin.upazila.index') }}"><i class="fa fa-circle-o"></i> {{ __('Upazila') }} </a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-briefcase"></i>
                <span>{{ __('Worker | Service') }}</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.worker-service-category.index') }}"><i class="fa fa-circle-o"></i>{{ __(' Category') }}</a></li>
                <li><a href="{{ route('admin.worker-service.index') }}"><i class="fa fa-circle-o"></i> {{ __('Service') }}</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-briefcase"></i>
                <span>{{ __('General. | Service') }}</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.membership-service-category.index') }}"><i class="fa fa-circle-o"></i> {{ __('Category') }}</a></li>
                <li><a href="{{ route('admin.membership-service.index') }}"><i class="fa fa-circle-o"></i> {{ __('Service') }}</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-briefcase"></i>
                <span>{{ __('Special. | Service') }}</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.special-service.index') }}"><i class="fa fa-circle-o"></i> {{ __('Service') }}</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-briefcase"></i>
                <span>{{ __('Notices') }}</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.admin-notice.index') }}"><i class="fa fa-circle-o"></i> {{ __('Admin notices') }}</a></li>
            </ul>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.controller-notice.index') }}"><i class="fa fa-circle-o"></i> {{ __('Controller notices') }}</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-briefcase"></i>
                <span>{{ __('Ads.') }}</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.admin-ads.index') }}"><i class="fa fa-circle-o"></i> {{ __('Admin ads') }}.</a></li>
            </ul>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.controller-ads.index') }}"><i class="fa fa-circle-o"></i> {{ __('Controller ads') }}.</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-briefcase"></i>
                <span>{{ __('Membership') }}</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.membership-package.index') }}"><i class="fa fa-circle-o"></i> {{ __('Memberships') }}</a></li>
            </ul>
        </li>

        <li class="sidebar-header">SETTING</li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-briefcase"></i>
                <span>{{ __('Pages') }}</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            @foreach(get_all_static_pages() as $page)
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('admin.page.edit',$page->id) }}"><i class="fa fa-circle-o"></i> @if(current_language() == 'bn'){{ ($page->bn_name) }} @else {{ ($page->en_name) }} @endif</a></li>
                </ul>
            @endforeach
        </li>
        <li><a href="{{ route('admin.updateGeneralInformation') }}" class="waves-effect"><i class="fa fa-circle-o text-aqua"></i>
                <span>{{ __('Static Options') }}</span></a>
        </li>
        <li><a href="javascript:0" target="_blank" class="waves-effect translation-btn"><i class="fa fa-circle-o text-red"></i>
                <span>{{ __('Translation') }} ({{ current_language() }})</span></a>
        </li>
        <br>
        <br>
        <br>
        <br>
    </ul>
</div>


<script>
    $(document).ready(function() {
        //Show modal
        $('.translation-btn').click(function(){
            let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,
            width=0,height=0,left=-1000,top=-1000`;
            open('{{ url('/language-management/'. current_language() .'/translations') }}', 'test', params);
        });
    });
</script>
