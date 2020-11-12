<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="{{ route('controller.dashboard.index') }}">
            &nbsp;
            <img src="{{ asset('uploads/images/'.$setting->logo) }}" width="200px" class="logo center" alt="Ashooo">
        </a>
    </div>
    <ul class="sidebar-menu do-nicescrol">
        <li class="sidebar-header">CONTROLLER DASHBOARD</li>
        <li>
            <a href="index.html" class="waves-effect">
                <i class="icon-home"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                <li><a href="index3.html"><i class="fa fa-circle-o"></i> Dashboard v3</a></li>
            </ul>
        </li>
        <li><a href="{{ route('controller.user.index') }}" class="waves-effect"><i class="fa fa-circle-o text-red"></i> <span>Users</span></a></li>
        <li><a href="{{ route('controller.notice.index') }}" class="waves-effect"><i class="fa fa-circle-o text-red"></i> <span>Notice</span></a></li>
        <li><a href="{{ route('controller.ads.index') }}" class="waves-effect"><i class="fa fa-circle-o text-red"></i> <span>Ads.</span></a></li>

    </ul>

</div>
