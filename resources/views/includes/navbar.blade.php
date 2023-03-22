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
            <li class="dropdown d-none d-lg-inline-block">
                <div class="form-group ">
                    <label class="control-label"></label>
                    <select class="form-control custom-select changeLang" style="white-space: nowrap; text-overflow: ellipsis; margin-top: 20px;
			  margin-left:4px; max-height: 30px; padding-top: 5px; -webkit-line-clamp: 2; display: inline-grid; width:150px;" name="all_child" id="changeChildren" required>
                        <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                        <option value="japanese" {{ session()->get('locale') == 'japanese' ? 'selected' : '' }}>Japanese</option>
                    </select>
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
                    <img src="{{ Session::get('picture') && asset('public/users/images/'.Session::get('picture')) ? asset('public/users/images/'.Session::get('picture')) : asset('public/images/users/default.jpg') }}" alt="user-image" class="rounded-circle admin_picture">
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
                    @if(Session::get('role_id') == '1')
                    <a href="{{ route('super_admin.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a>
                    @elseif(Session::get('role_id') == '3')
                    <a href="{{ route('staff.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a>
                    @elseif(Session::get('role_id') == '4')
                    <a href="{{ route('teacher.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a>
                    @elseif(Session::get('role_id') == '5')
                    <a href="{{ route('parent.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a>
                    @elseif(Session::get('role_id') == '6')
                    <a href="{{ route('student.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a>
                    @else
                    <a href="{{ route('admin.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a>
                    @endif

                    <!-- item-->
                    <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>Settings</span>
                    </a> -->

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
                    @elseif(Session::get('role_id') == '3')
                    <form id="logout-form" action="{{ route('staff.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @elseif(Session::get('role_id') == '4')
                    <form id="logout-form" action="{{ route('teacher.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @elseif(Session::get('role_id') == '5')
                    <form id="logout-form" action="{{ route('parent.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @elseif(Session::get('role_id') == '6')
                    <form id="logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
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