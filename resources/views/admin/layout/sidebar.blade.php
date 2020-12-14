<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="{{ route('admin.dashboard.index') }}">
            &nbsp;
            <img src="{{ asset('uploads/images/'.setting('logo')) }}" width="200px" class="logo center" alt="Ashooo">
        </a>
    </div>
    <ul class="sidebar-menu do-nicescrol">
        <li class="sidebar-header">ADMIN DASHBOARD</li>
        <li>
            <a href="{{ route('admin.dashboard.index') }}" class="waves-effect">
                <i class="icon-home"></i> <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-briefcase"></i>
                <span>Area</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.district.index') }}"><i class="fa fa-circle-o"></i> District</a></li>
                <li><a href="{{ route('admin.upazila.index') }}"><i class="fa fa-circle-o"></i> Upazila</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-briefcase"></i>
                <span>Worker | Service</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.worker-service-category.index') }}"><i class="fa fa-circle-o"></i> Category</a></li>
                <li><a href="{{ route('admin.worker-service.index') }}"><i class="fa fa-circle-o"></i> Service</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-briefcase"></i>
                <span>Member. | Service</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.membership-service-category.index') }}"><i class="fa fa-circle-o"></i> Category</a></li>
                <li><a href="{{ route('admin.membership-service.index') }}"><i class="fa fa-circle-o"></i> Service</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-briefcase"></i>
                <span>Notices</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.admin-notice.index') }}"><i class="fa fa-circle-o"></i> Admin notices</a></li>
            </ul>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.controller-notice.index') }}"><i class="fa fa-circle-o"></i> Controller notices</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-briefcase"></i>
                <span>Ads.</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.admin-ads.index') }}"><i class="fa fa-circle-o"></i> Admin ads.</a></li>
            </ul>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.controller-ads.index') }}"><i class="fa fa-circle-o"></i> Controller ads.</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-briefcase"></i>
                <span>Membership</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.membership-package.index') }}"><i class="fa fa-circle-o"></i> Memberships</a></li>
            </ul>
        </li>

        <li class="sidebar-header">SETTING</li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="icon-briefcase"></i>
                <span>More</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.showOffer') }}"><i class="fa fa-circle-o"></i>Offer</a></li>
            </ul>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.showReferralIncome') }}"><i class="fa fa-circle-o"></i> Referral Income System</a></li>
            </ul>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.showVideoTraining') }}"><i class="fa fa-circle-o"></i> Video Training</a></li>
            </ul>
            <ul class="sidebar-submenu">
                <li><a href="{{ route('admin.showHelpLine') }}"><i class="fa fa-circle-o"></i> Help Line</a></li>
            </ul>
        </li>
        <li><a href="{{ url('/language-management/bn/translations') }}" target="_blank" class="waves-effect"><i class="fa fa-circle-o text-red"></i> <span>Translation</span></a></li>
        <li><a href="{{ route('admin.showAbout') }}" class="waves-effect"><i class="fa fa-circle-o text-red"></i> <span>About</span></a></li>
        <li><a href="{{ route('admin.showFaq') }}" class="waves-effect"><i class="fa fa-circle-o text-yellow"></i> <span>FAQ</span></a></li>
        <li><a href="{{ route('admin.showTermsAndCondition') }}" class="waves-effect"><i class="fa fa-circle-o text-aqua"></i> <span>Terms & Conditions</span></a></li>
        <li><a href="{{ route('admin.showPrivacyPolicy') }}" class="waves-effect"><i class="fa fa-circle-o text-aqua"></i> <span>Privacy Policy</span></a></li>
    </ul>
</div>
