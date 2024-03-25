<!-- Topbar Start -->
<link href="{{ asset('css/custom/navbar.css') }}" rel="stylesheet" type="text/css" />
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
                                    <small>{{ __('messages.mark_all_as_read') }}</small>
                                </a>
                            </span>{{ __('messages.notification') }}
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
                <a class="nav-link dropdown-toggle waves-effect waves-light" href="{{ route($cpath[0].'.chat')}}">
                    <i class="far fa-comment-alt noti-icon"></i>
                    <span class="badge badge-danger rounded-circle noti-icon-badge chat-count">0</span>
                </a>
            </li>
            @endif
            <!-- <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-calendar-clock font-22"></i>
                    <span class="badge badge-danger rounded-circle noti-icon-badge remainder-badge-count">0</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">Reminders
                            <span class="float-right">
                                <a href="javascript:void(0)" class="text-dark" id="mark-all-read">
                                    <small>Reminders</small>
                                </a>
                            </span>
                        </h5>
                    </div>
                    <div class="remainder-list-show">
                        <a href="javascript:void(0);" class="dropdown-item mark-as-read" data-id="">
                            <p class="notify-details">Title</p>
                            <p class="text-muted mb-0 user-msg">
                                <small>10:00 AM</small>
                                <small>3 Min ago</small>
                            </p>
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item mark-as-read" data-id="">
                            <p class="notify-details">Title</p>
                            <p class="text-muted mb-0 user-msg">
                                <small>10:00 AM</small>
                                <small>3 Min ago</small>
                            </p>
                        </a>
                    </div>
            </li> -->
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
            <!-- <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" href="">
                    <i class="mdi mdi-calendar-clock font-22"></i>
                    <span class="badge badge-danger rounded-circle noti-icon-badge chat-count">0</span>
                </a>
            </li> -->

            <!--<li class="dropdown notification-list topbar-dropdown">
                <div class="lang-select mt-1 ml-2" style="margin-right: -20px !important;">
                    <button class="btn-select" value=""></button>
                    <div class="b">
                        <ul id="a">
                            <li><a href="#" data-value="action"><img src="{{ config('constants.image_url').'/common-asset/images/USA.png' }}" alt="en" value="en" /><span>English</span></li>
                            <li><a href="#" data-value="another action"><img src="{{ config('constants.image_url').'/common-asset/images/JPN.png' }}" alt="japanese" value="japanese" /><span>日本語</span></li>
                            <li><a href="#" data-value="something else here"><img src="{{ config('constants.image_url').'/common-asset/images/MAL.png' }}" alt="malay" value="malay" /><span>Malay</span></li>
                        </ul>
                    </div>
                </div>
            </li>-->




           <!-- <li class="dropdown d-lg-inline-block topbar-dropdown" style="margin-right: -6px;">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ config('constants.image_url').'/common-asset/images/flags/us.jpg' }}" alt="user-image" style="height: 21px; width: 30px;margin-bottom: 3px;">
                </a>
                <div class="dropdown-menu dropdown-menu-left">
                    <!-- item-->
                    <!--<a href="" class="dropdown-item">
                        <img src="{{ config('constants.image_url').'/common-asset/images/flags/us.jpg' }}" alt="en" value="en" class="mr-1" style="height: 15px;" /><span class="align-middle">English</span>
                    </a>

                    <!-- item-->
                    <!--<a href="" class="dropdown-item">
                        <img src="{{ config('constants.image_url').'/common-asset/images/flags/jpn.png' }}" alt="japanese" value="japanese" class="mr-1" style="height: 15px;" /><span class="align-middle">日本語</span>
                    </a>
                    <a href="" class="dropdown-item">
                        <img src="{{ config('constants.image_url').'/common-asset/images/flags/mal.png' }}" alt="malay" value="malay" class="mr-1" style="height: 15px;/"><span class=" align-middle">Malay</span>
                    </a>

                </div>
</li>-->
<li class="dropdown d-lg-inline-block topbar-dropdown" style="margin-right: -6px;">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                @if(app()->getLocale() == 'en')
                    <img src="{{ config('constants.image_url').'/common-asset/images/flags/us.jpg' }}" alt="user-image" style="height: 21px; width: 30px;margin-bottom: 3px;">
                @endif
                @if(app()->getLocale() == 'japanese')
                    <img src="{{ config('constants.image_url').'/common-asset/images/flags/jpn.png' }}" alt="user-image" style="height: 21px; width: 30px;margin-bottom: 3px;">
                @endif
                @if(app()->getLocale() == 'malay')
                    <img src="{{ config('constants.image_url').'/common-asset/images/flags/mal.png' }}" alt="user-image" style="height: 21px; width: 30px;margin-bottom: 3px;">
                @endif
                </a>
                <div class="dropdown-menu dropdown-menu-left">
                    <!-- item-->
                    <a href="{{ route('changeLang', ['lang' => 'en']) }}" class="dropdown-item @if(app()->getLocale() == 'en') active @endif">
                        <img src="{{ config('constants.image_url').'/common-asset/images/flags/us.jpg' }}" alt="en" value="en" class="mr-1" style="height: 15px;" /><span class="align-middle">English</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('changeLang', ['lang' => 'japanese']) }}" class="dropdown-item @if(app()->getLocale() == 'japanese') active @endif">
                        <img src="{{ config('constants.image_url').'/common-asset/images/flags/jpn.png' }}" alt="japanese" value="japanese" class="mr-1" style="height: 15px;" /><span class="align-middle">日本語</span>
                    </a>
                    <a href="{{ route('changeLang', ['lang' => 'malay']) }}" class="dropdown-item @if(app()->getLocale() == 'malay') active @endif">
                        <img src="{{ config('constants.image_url').'/common-asset/images/flags/mal.png' }}" alt="malay" value="malay" class="mr-1" style="height: 15px;/"><span class=" align-middle">Malay</span>
                    </a>

                </div>
            </li>




                <!-- <li class="dropdown d-none d-lg-inline-block">
                <div class="form-group">
                    
                    <input type="text" class="form-control changeLang" name="country" id="countryLang" placeholder="Country" data-parsley-trigger="change">
                </div>
            </li> -->
                <!-- <li class="dropdown d-none d-lg-inline-block">
                <div class="form-group ">
                    <label class="control-label"></label>
                    <select class="form-control custom-select changeLang" style="white-space: nowrap; text-overflow: ellipsis; margin-top: 20px;
			  margin-left:4px; max-height: 30px; padding-top: 5px; -webkit-line-clamp: 2; display: inline-grid; width:150px;" name="all_child" id="changeChildren" required>
                        <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English<img src="{{ asset('images/USA.png') }}" ></option>
                        <option value="japanese" {{ session()->get('locale') == 'japanese' ? 'selected' : '' }}>Japanese</option>
                    </select>
                </div>
            </li> -->
                <!--@if(Session::get('role_id') != '1')
            <li class="d-lg-inline-block schl">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="tooltip" title="{{ Session::get('school_name') }}" href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="header-span"><b> {{ Session::get('school_name') }} </b>
                </a>
            </li>

            @endif-->
            @if(Session::get('role_id') != '1')
            <li class="d-lg-inline-block schl">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="tooltip" title="{{ Session::get('school_name') }}" href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ config('constants.image_url').'/common-asset/images/'.config('constants.school_image') }}" class="mr-2 rounded-circle" alt="{{ Session::get('school_name') }}" style="margin-bottom: 5px; margin-left: 0px;">
                </a>
            </li>
            @endif

            @if(Session::get('role_id') == '5')
            <!-- Original dropdown for larger screens -->
            <li class="dropdown d-none d-lg-inline-block allChild">
                <div class="form-group">
                    <label class="control-label"></label>
                    <select class="form-control custom-select all_child" style="white-space: nowrap; text-overflow: ellipsis; margin-top: 20px;
            margin-left:-16px; max-height: 30px; padding-top: 5px; -webkit-line-clamp: 2; display: inline-grid; width:150px;" name="all_child" id="changeChildren" required>
                        <option disabled>Select Children</option>
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

            <!-- Additional dropdown for small screens -->
            <!--<li class="dropdown d-inline-block d-lg-none">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-friends img"></i><!-- Change the icon to a user icon or any other suitable icon -->
<!--</a>
                <div class="dropdown-menu" aria-labelledby="userDropdown">
                    @if(Session::get('all_child'))
                    @forelse (Session::get('all_child') as $child)
                    <a class="dropdown-item" href="#child_{{ $child['id'] }}">{{ $child['name'] }}</a>
                    @empty
                    @endforelse
                    @endif
                </div>
            </li>-->
            <li class="dropdown d-inline-block d-lg-none">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ Session::get('picture') && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.Session::get('picture') ? config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.Session::get('picture') : config('constants.image_url').'/common-asset/images/users/students.png' }}" alt="user-image" class="rounded-circle admin_picture" style="width:25px;margin-bottom:3px;margin-left: -11px;">
                </a>
                <div class="dropdown-menu" aria-labelledby="userDropdown">
                    @if(Session::get('all_child'))
                    @forelse (Session::get('all_child') as $child)
                    <a class="dropdown-item" href="#child_{{ $child['id'] }}">{{ $child['name'] }}</a>
                    @empty
                    @endforelse
                    @endif
                </div>
            </li>
            @endif
            




            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ Session::get('picture') && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.Session::get('picture') ? config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.Session::get('picture') : config('constants.image_url').'/common-asset/images/users/default.jpg' }}" alt="user-image" class="rounded-circle admin_picture">
                    <span class="pro-user-name ml-1 user_name">
                        <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('messages.welcome') }} ! {{ Session::get('name') }}</h6>
                    </div>

                    <!-- item-->
                    @if(Session::get('role_id') == '1')
                    <a href="{{ route('super_admin.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>{{ __('messages.my_account') }}</span>
                    </a>
                    @elseif(Session::get('role_id') == '3')
                    <a href="{{ route('staff.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>{{ __('messages.my_account') }}</span>
                    </a>
                    @elseif(Session::get('role_id') == '4')
                    <a href="{{ route('teacher.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>{{ __('messages.my_account') }}</span>
                    </a>
                    @elseif(Session::get('role_id') == '5')
                    <a href="{{ route('parent.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>{{ __('messages.my_account') }}</span>
                    </a>
                    @elseif(Session::get('role_id') == '6')
                    <a href="{{ route('student.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>{{ __('messages.my_account') }}</span>
                    </a>
                    @else
                    <a href="{{ route('admin.settings')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>{{ __('messages.my_account') }}</span>
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
                        <span>{{ __('messages.logout') }}</span>
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
        </ul>

        <!-- LOGO -->
        <div class="logo-box">

            <a href="javascript:void(0)" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{ config('constants.image_url').'/common-asset/images/Suzen-app-logo.png' }}" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ config('constants.image_url').'/common-asset/images/Logo.png' }}" alt="" height="45">
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