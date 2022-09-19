@include('includes.header')
@yield('css')
</head>

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
    <!-- add spinner  -->
    <!-- <div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div> -->
    <div id="overlay">
        <div class="lds-spinner">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Begin page -->
    <div id="wrapper">
<!-- Topbar Start -->
<div class="navbar-custom" style="background-color:white;">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fe-bell noti-icon"></i>
                    <span class="badge badge-danger rounded-circle noti-icon-badge badge-count">0</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">
                            <span class="float-right">
                                <a href="javascript:void(0)" class="text-dark" id="mark-all-read">
                                    <small>Mark all as read</small>
                                </a>
                            </span>Notification
                        </h5>
                    </div>

                    <div class="notification-list-show">
                        <!-- <div class="noti-scroll" data-simplebar> -->

                        <!-- item-->
                        <!-- <div class="notification-list"></div> -->
                        <!-- <a href="javascript:void(0);" class="dropdown-item notify-item active">
                            <div class="notify-icon">
                                <img src="../assets/images/users/user-1.jpg" class="img-fluid rounded-circle" alt="" />
                            </div>
                            <p class="notify-details">Cristina Pride</p>
                            <p class="text-muted mb-0 user-msg">
                                <small>Hi, How are you? What about our next meeting</small>
                            </p>
                        </a> -->
                        <!-- </div> -->

                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                            <!-- View all
                        <i class="fe-arrow-right"></i> -->
                        </a>

                    </div>
            </li>
            @if(Session::get('role_id') != '1')
            <li class="d-lg-inline-block" style="white-space: nowrap;width: 100px;overflow: hidden;text-overflow: ellipsis;">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="tooltip" title="{{ Session::get('school_name') }}" href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="header-span"><b> {{ Session::get('school_name') }} </b>
                </a>
            </li>
            @endif
            @if(Session::get('role_id') == '5')
            <li class="dropdown d-none d-lg-inline-block allChild">
                <div class="form-group ">
                    <label class="control-label"></label>
                    <select class="form-control custom-select" style="white-space: nowrap; text-overflow: ellipsis; margin-top: 20px;
			  margin-left:4px; max-height: 30px; padding-top: 5px; -webkit-line-clamp: 2; display: inline-grid; width:150px;" name="all_child" id="changeChildren" required>
                        <!-- <option disabled >Select Children</option> -->
                        @if(Session::get('all_child'))
                        @forelse (Session::get('all_child') as $child)
                        <option value="{{ $child['id'] }}" {{ Session::get('student_id') == $child['id'] ? 'selected' : ''}}>{{ $child['name'] }}</option>
                        @empty
                        @endforelse
                        @endif
                    </select>
                    <div class="invalid-feedback">Please select a valid event category</div>
                </div>
            </li>

            @endif
            <li class="dropdown d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>


            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ Session::get('picture') && asset('public/images/staffs/'.Session::get('picture')) ? asset('public/images/staffs/'.Session::get('picture')) : asset('public/images/users/default.jpg') }}" alt="user-image" class="rounded-circle admin_picture">
                    <span class="pro-user-name ml-1 user_name">
                        <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout.punchcard') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>

        <!-- LOGO -->
        <div class="logo-box">

            <a href="javascript:void(0)" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{ asset('public/images/Suzen-app-logo.png') }}" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('public/images/Logo.png') }}" alt="" height="45">
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
<!-- <sidebar> -->
    <!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu" style="background-color:#2F2F8F">
    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{ asset('public/images/users/default.jpg') }}" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">


                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out mr-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- <ul class="list-unstyled topnav-menu mb-0">
                <li>
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('public/images/favicon.ico') }}" alt="user-image" height="50px" width="50px" class="rounded-circle admin_picture">
                        <span style="color:#0ABAB5"><b> {{ Session::get('school_name') }}</b> </span>
                    </a>
                </li>

            </ul><br> -->

        </div>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                @yield('content')
            </div> <!-- content -->
            @include('includes.footer')
            @yield('scripts')

</body>

</html>