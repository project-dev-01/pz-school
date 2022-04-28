<!-- Topbar Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">
            <li class="dropdown notification-list topbar-dropdown">
                <form class="app-search">
                    <div class="app-search-box dropdown">
                    <!-- <img src="{{ Session::get('picture') && asset('users/images/'.Session::get('picture')) ? asset('users/images/'.Session::get('picture')) : asset('images/users/default.jpg') }}" alt="user-image" class="rounded-circle admin_picture"> -->
                        <img class="d-flex mr-2 rounded-circle" src="{{ asset('images/users/default.jpg') }}" alt="Generic placeholder image" height="32">
                    </div>
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false">
                        <span style="color:#0ABAB5"><b> {{ Session::get('school_name') }} </b>
                    </a>
                </form>
            </li>

            @if(Session::get('role_id') == '5')

            <li class="dropdown notification-list topbar-dropdown">

                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">

                    My Children :
                </a>
            </li>
            <li class="dropdown d-none d-lg-inline-block">
                <div class="form-group ">
                    <label class="control-label"></label>
                    <select class="form-control custom-select" name="category" id="event-category" required>
                        <!-- <option disabled >Select Children</option> -->
                        <option Selected>Benjamin</option>
                        <option>Charlotte Isabella</option>
                    </select>
                    <div class="invalid-feedback">Please select a valid event category</div>
                </div>
            </li>

            @endif
            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>


            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ Session::get('picture') && asset('users/images/'.Session::get('picture')) ? asset('users/images/'.Session::get('picture')) : asset('images/users/default.jpg') }}" alt="user-image" class="rounded-circle admin_picture">
                    <span class="pro-user-name ml-1 user_name">
                        <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome ! {{ Session::get('name') }}</h6>
                    </div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>Settings</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a>
                    @if(Session::get('role_id') == '1')
                    <form id="logout-form" action="{{ route('super_admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @else
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @endif
                </div>
            </li>
        </ul>

        <!-- LOGO -->
        <div class="logo-box">

            <a href="javascript:void(0)" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{ asset('images/logo-sm.png') }}" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('images/300x83-3.png') }}" alt="" height="45">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->