<header class="topbar-nav">
    <nav class="navbar navbar-expand fixed-top gradient-ibiza">
        <ul class="navbar-nav mr-auto align-items-center">
            <li class="nav-item">
                <a class="nav-link toggle-menu" href="javascript:void();">
                    <i class="icon-menu menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <form class="search-bar">
                    <input type="text" class="form-control" placeholder="Enter keywords">
                    <a href="javascript:void();"><i class="icon-magnifier"></i></a>
                </form>
            </li>
        </ul>

        <ul class="navbar-nav align-items-center right-nav-link">
            <li class="nav-item dropdown-lg">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
                    <i class="icon-bell"></i><span class="badge badge-primary badge-up">10</span></a>
                <div class="dropdown-menu dropdown-menu-right animated fadeIn">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            You have 10 Notifications
                            <span class="badge badge-primary">10</span>
                        </li>
                        <li class="list-group-item">
                            <a href="javaScript:void();">
                                <div class="media">
                                    <i class="icon-people fa-2x mr-3 text-info"></i>
                                    <div class="media-body">
                                        <h6 class="mt-0 msg-title">New Registered Users</h6>
                                        <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="javaScript:void();">
                                <div class="media">
                                    <i class="icon-cup fa-2x mr-3 text-warning"></i>
                                    <div class="media-body">
                                        <h6 class="mt-0 msg-title">New Received Orders</h6>
                                        <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="javaScript:void();">
                                <div class="media">
                                    <i class="icon-bell fa-2x mr-3 text-danger"></i>
                                    <div class="media-body">
                                        <h6 class="mt-0 msg-title">New Updates</h6>
                                        <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item"><a href="javaScript:void();">See All Notifications</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item language">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" href="{{ route('language') }}">
                    @if(current_language() != 'en')
                    <i class="flag-icon flag-icon-bd"></i>
                    @else
                        <i class="flag-icon flag-icon-us"></i>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                    <span class="user-profile"><img src="{{ asset('assets/images/avatars/avatar-17.png') }}" class="img-circle" alt="user avatar"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right animated fadeIn">
                    <li class="dropdown-item user-details">
                        <a href="javaScript:void();">
                            <div class="media">
                                <div class="avatar"><img class="align-self-start mr-3" src="{{ asset('assets/images/avatars/avatar-17.png') }}" alt="user avatar"></div>
                                <div class="media-body">
                                    <h6 class="mt-2 user-title">{{ auth()->user()->full_name }}</h6>
                                    <p class="user-subtitle">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-item" onclick="logout()"> <a  style="cursor: pointer;"><i class="icon-power mr-2"></i> Logout</a> </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
