<!-- Topbar Start -->
<link href="{{ asset('css/custom/navbar.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/parent_responsive.css') }}" rel="stylesheet" type="text/css" />
<div class="navbar-custom" style="background-color:white;">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">

            @if(Session::get('role_id') != '1')
            <li class="d-lg-inline-block schl">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="tooltip" title="{{ Session::get('school_name') }}" href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ config('constants.image_url').'/common-asset/images/'.config('constants.school_image') }}" class="mr-2 rounded-circle schllogo" alt="{{ Session::get('school_name') }}" style="margin-bottom: 2px;">
                </a>
            </li>
            @endif

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" style="margin-right: 10px;margin-top: 2px;">
                    <i class="fe-bell noti-icon"></i>
                    <span class="badge badge-danger rounded-circle noti-icon-badge badge-count">0</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0 notificationfont">
                            <span class="float-right">
                                <a href="javascript:void(0)" class="text-dark" id="mark-all-read">
                                    <small class="notificationfonts">{{ __('messages.mark_all_as_read') }}</small>
                                </a>
                            </span class="notificationfont">{{ __('messages.notification') }}
                        </h5>
                    </div>
                    <div class="notification-list-show">
                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                        </a>
                    </div>
            </li>

            @if(Session::get('role_id') == '4' || Session::get('role_id') == '5')
            <li class="dropdown notification-list topbar-dropdown">
                @php $cpath=explode('/',\Request::path()); @endphp
                <a class="nav-link dropdown-toggle waves-effect waves-light" href="{{ route($cpath[0].'.chat')}}" style="margin-right: 8px;margin-top: 2px;">
                    <i class="far fa-comment-alt noti-icon"></i>
                    <span class="badge badge-danger rounded-circle noti-icon-badge chat-count">0</span>
                </a>
            </li>
            @endif


            @if(Session::get('role_id') == '2' || Session::get('role_id') == '4')
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-calendar-clock font-22"></i>
                    <span class="badge badge-danger rounded-circle noti-icon-badge remainder-badge-count">0</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                    <!-- item-->
                    <div class="dropdown-item noti-title" style="border-bottom: 2px solid #e5e8eb;">
                        <h5 class="m-0">
                            <span class="float-right">
                                <a href="javascrip:void(0)" class="text-dark">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#436ce5;">×</button>
                                </a>
                            </span>Reminders
                        </h5>
                    </div>
                    <div class="noti-scroll remainder-list-show" data-simplebar>

                    </div>
            </li>
            @endif

            @if(Session::get('role_id') == '5')
            <li class="dropdown d-inline-block">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ Session::get('picture') ? config('constants.image_url').'/'.$branch_id.'/users/images/'.Session::get('picture') : config('constants.image_url').'/common-asset/images/users/st.webp' }}" alt="user-image" class="rounded-circle admin_picture" style="width:31px;margin-bottom:4px;margin-left: -13px;margin-right: -12px;" onmouseover="showStudentName()" onmouseout="hideStudentName()">
                    <span id="studentName" class="student-name"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    @forelse (Session::get('all_child', []) as $child)
                    <a class="dropdown-item responsiveAllChild" href="javascript:void(0)" data-id="{{ $child['id'] }}">
                        <i class="fe-user iconsuser"></i>
                        <span class="childname">{{ $child['name'] }}</span>
                    </a>
                    @empty
                    @endforelse
                </div>
            </li>
            @endif
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ Session::get('picture') && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.Session::get('picture') ? config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.Session::get('picture') : config('constants.image_url').'/common-asset/images/users/default.webp' }}" alt="user-image" class="rounded-circle admin_picture" style="margin-bottom: 2px;">
                    <span class="pro-user-name ml-1 user_name">
                        <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0 userfont">{{ __('messages.welcome') }} ! {{ Session::get('name') }}</h6>
                    </div>

                    <!-- item-->
                    @if(Session::get('role_id') == '1')
                    <a href="{{ route('super_admin.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-user fonticon"></i>
                        <span class=userfont1>{{ __('messages.my_account') }}</span>
                    </a>
                    @elseif(Session::get('role_id') == '3')
                    <a href="{{ route('staff.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-userfonticon"></i>
                        <span class=userfont1>{{ __('messages.my_account') }}</span>
                    </a>
                    @elseif(Session::get('role_id') == '4')
                    <a href="{{ route('teacher.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-user fonticon"></i>
                        <span class=userfont1>{{ __('messages.my_account') }}</span>
                    </a>
                    @elseif(Session::get('role_id') == '5')
                    <a href="{{ route('parent.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-user fonticon"></i>
                        <span class=userfont1>{{ __('messages.my_account') }}</span>
                    </a>
                    @elseif(Session::get('role_id') == '6')
                    <a href="{{ route('student.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span class=userfont1>{{ __('messages.my_account') }}</span>
                    </a>
                    @else
                    <a href="{{ route('admin.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-user fonticon"></i>
                        <span class=userfont1>{{ __('messages.my_account') }}</span>
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
                        <i class="fe-log-out fonticon"></i>
                        <span class=userfont2>{{ __('messages.logout') }}</span>
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
                    @elseif(Session::get('role_id') == '7')
                    <form id="logout-form" action="{{ route('guest.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @else
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @endif
                </div>
            </li>


            <li class="dropdown d-lg-inline-block topbar-dropdown" style="margin-right: -6px;">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    @if(app()->getLocale() == 'en')
                    <img src="{{ config('constants.image_url').'/common-asset/images/flags/USA.webp' }}" alt="user-image" style="height: 24px;width: 27px;">
                    @endif
                    @if(app()->getLocale() == 'japanese')
                    <img src="{{ config('constants.image_url').'/common-asset/images/flags/JPN.webp' }}" alt="user-image" style="height: 24px;width: 27px;">
                    @endif
                    @if(app()->getLocale() == 'malay')
                    <img src="{{ config('constants.image_url').'/common-asset/images/flags/MAL.webp' }}" alt="user-image" style="height: 24px;width: 27px;">
                    @endif
                </a>
                <!--<div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                <!--<a href="{{ route('changeLang', ['lang' => 'en']) }}" class="dropdown-item @if(app()->getLocale() == 'en') active @endif">
                        <img src="{{ config('constants.image_url').'/common-asset/images/flags/us.jpg' }}" alt="en" value="en" class="mr-1" style="height: 15px;" /><span class="align-middle">English</span>
                    </a>

                    <!-- item-->
                <!-- <a href="{{ route('changeLang', ['lang' => 'japanese']) }}" class="dropdown-item @if(app()->getLocale() == 'japanese') active @endif">
                        <img src="{{ config('constants.image_url').'/common-asset/images/flags/jpn.png' }}" alt="japanese" value="japanese" class="mr-1" style="height: 15px;" /><span class="align-middle">日本語</span>
                    </a>
                    <a href="{{ route('changeLang', ['lang' => 'malay']) }}" class="dropdown-item @if(app()->getLocale() == 'malay') active @endif">
                        <img src="{{ config('constants.image_url').'/common-asset/images/flags/mal.png' }}" alt="malay" value="malay" class="mr-1" style="height: 15px;/"><span class=" align-middle">Malay</span>
                    </a>
                </div>-->
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a href="{{ route('changeLang', ['lang' => 'en']) }}" class="dropdown-item flagsp @if(app()->getLocale() == 'en') active @endif">
                        <img src="{{ config('constants.image_url').'/common-asset/images/flags/USA.webp' }}" alt="en" value="en" class="flag2" /><span class="flagfont2">English</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('changeLang', ['lang' => 'japanese']) }}" class="dropdown-item flagsp @if(app()->getLocale() == 'japanese') active @endif">
                        <img src="{{ config('constants.image_url').'/common-asset/images/flags/JPN.webp' }}" alt="japanese" value="japanese" class="flag2" /><span class="flagfont2">日本語</span>
                    </a>
                    <a href="{{ route('changeLang', ['lang' => 'malay']) }}" class="dropdown-item @if(app()->getLocale() == 'malay') active @endif">
                        <img src="{{ config('constants.image_url').'/common-asset/images/flags/MAL.webp' }}" alt="malay" value="malay" class="flag2"><span class="flagfont2">Malay</span>
                    </a>
                </div>

            </li>
        </ul>

        <!-- LOGO -->
        <div class="logo-box">

            <a href="javascript:void(0)" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{ config('constants.image_url').'/common-asset/images/Suzen-app-logo.webp' }}" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ config('constants.image_url').'/common-asset/images/Logo.webp' }}" alt="" style="height:35px; width:100px;">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light sidebarresponsive" style="width:23px;height:60px;">
                    <i class="fe-menu"></i>
                </button>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->