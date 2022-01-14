<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{ asset('images/users/default.jpg') }}" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user mr-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings mr-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock mr-1"></i>
                        <span>Lock Screen</span>
                    </a>

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

            <ul id="side-menu">
                <li class="menu-title">Menu Details</li>
                @if(Session::get('role_id'))
                @if(Session::get('role_id') == '1')
                <li>
                    <a href="{{ route('super_admin.dashboard')}}" class="nav-link {{ (request()->is('super_admin/dashboard*')) ? 'active' : '' }}">
                        <i data-feather="airplay" class="icon-dual"></i>
                        <span> Dashboards </span>
                    </a>
                </li>
                <li>
                    <a href="#sidebarBranch" data-toggle="collapse">
                        <i class="fas fa-users"></i>
                        <span> Branch </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarBranch">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('branch.index')}}" class="nav-link {{ (request()->is('super_admin/branch*')) ? 'active' : '' }}">
                                    <span> Branch List </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('branch.create')}}" class="nav-link {{ (request()->is('super_admin/branch*')) ? 'active' : '' }}">
                                    <span> Create Branch </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarAdmission" data-toggle="collapse">
                        <i class="fe-edit"></i>
                        <span> Admission </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAdmission">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('super_admin.admission')}}" class="nav-link {{ (request()->is('super_admin/admission/index')) ? 'active' : '' }}">
                                    <span>Create Admission</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admission.import')}}" class="nav-link {{ (request()->is('super_admin/admission/import')) ? 'active' : '' }}">
                                    <span>Multiple Import</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarParent" data-toggle="collapse">
                        <i class="fe-user-plus"></i>
                        <span> Parents </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarParent">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('super_admin.parent')}}" class="nav-link {{ (request()->is('super_admin/parent*')) ? 'active' : '' }}">
                                    <span>Add Parent</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarEmployee" data-toggle="collapse">
                        <i class="fas fa-users"></i>
                        <span> Employee </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEmployee">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('super_admin.department')}}" class="nav-link {{ (request()->is('super_admin/department*')) ? 'active' : '' }}">
                                    <span> Add Department </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('super_admin.designation')}}" class="nav-link {{ (request()->is('super_admin/designation*')) ? 'active' : '' }}">
                                    <span>Add Designation </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('super_admin.employee')}}" class="nav-link {{ (request()->is('super_admin/employee')) ? 'active' : '' }}">
                                     <span>Add Employee</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('super_admin.listemployee')}}" class="nav-link {{ (request()->is('super_admin/listemployee')) ? 'active' : '' }}">
                                    <span>Employee List</span>
                                </a>
                            </li>                       
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarAcademic" data-toggle="collapse">
                        <i data-feather="home"></i>
                        <span> Academic </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAcademic">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('super_admin.section')}}" class="nav-link {{ (request()->is('super_admin/section*')) ? 'active' : '' }}">
                                    <span> Section </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('super_admin.class')}}" class="nav-link {{ (request()->is('super_admin/class*')) ? 'active' : '' }}">
                                    <span> Class </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('super_admin.section_allocation')}}" class="nav-link {{ (request()->is('super_admin/section_allocation*')) ? 'active' : '' }}">
                                    <span> Sections Allocation </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('super_admin.assign_teacher')}}" class="nav-link {{ (request()->is('super_admin/assign_teacher*')) ? 'active' : '' }}">
                                    <span> Assign Class Teacher </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarHomework" data-toggle="collapse">
                        <i class="fe-book-open"></i>
                        <span> Homework </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarHomework">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('super_admin.homework')}}" class="nav-link {{ (request()->is('super_admin/employee*')) ? 'active' : '' }}">
                                    <span>Add Homework</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarMultilevel" data-toggle="collapse">
                        <i data-feather="book"></i>
                        <span> Exam Master</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMultilevel">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#sidebarMultilevel2" data-toggle="collapse">
                                <i data-feather="book-open" class="icons-xs icon-dual"></i> &nbsp;
                                    Exam <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarMultilevel2">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('exam.term')}}" class="nav-link {{ (request()->is('super_admin/exam/term')) ? 'active' : '' }}">
                                                <span>Exam Term</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('exam.hall')}}" class="nav-link {{ (request()->is('super_admin/exam/hall')) ? 'active' : '' }}">
                                                <span>Exam Hall</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('exam.mark_distribution')}}" class="nav-link {{ (request()->is('super_admin/exam/mark_distribution')) ? 'active' : '' }}">
                                                <span>Distribution</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('exam.exam')}}" class="nav-link {{ (request()->is('super_admin/exam/exam')) ? 'active' : '' }}">
                                                <span>Exam Setup</span>
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarSupervision" data-toggle="collapse">
                        <i data-feather="share-2"></i>
                        <span> Supervision </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarSupervision">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#sidebarHostel" data-toggle="collapse">
                                    Hostel<span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarHostel">
                                    <ul class="nav-second-level">

                                        <li>
                                            <a href="{{ route('super_admin.hostel')}}" class="nav-link {{ (request()->is('super_admin/hostel')) ? 'active' : '' }}">
                                                <span> Hostel Master </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('hostel.room')}}" class="nav-link {{ (request()->is('super_admin/hostel/room')) ? 'active' : '' }}">
                                                <span> Hostel Room </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('hostel.category')}}" class="nav-link {{ (request()->is('super_admin/hostel/category')) ? 'active' : '' }}">
                                                <span> Category </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarTransport" data-toggle="collapse">
                                    Transport<span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarTransport">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('transport.route')}}" class="nav-link {{ (request()->is('super_admin/transport/route')) ? 'active' : '' }}">
                                                <span> Route Master </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('transport.vehicle')}}" class="nav-link {{ (request()->is('super_admin/transport/vehicle')) ? 'active' : '' }}">
                                                <span> Vehicle Master</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('transport.stoppage')}}" class="nav-link {{ (request()->is('super_admin/transport/stoppage')) ? 'active' : '' }}">
                                                <span> Stoppage</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('transport.assignvehicle')}}" class="nav-link {{ (request()->is('super_admin/transport/assignvehicle')) ? 'active' : '' }}">
                                                <span> Assign Vehicle</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarLibrary" data-toggle="collapse">
                        <i class="fe-book-open"></i>
                        <span> Library </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarLibrary">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('library.book')}}" class="nav-link {{ (request()->is('super_admin/book')) ? 'active' : '' }}">
                                    <span>Book</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('library.bookcategory')}}" class="nav-link {{ (request()->is('super_admin/bookcategory')) ? 'active' : '' }}">
                                    <span>Book Category</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="{{ route('library.issuedbook')}}" class="nav-link {{ (request()->is('super_admin/issuedbook')) ? 'active' : '' }}">
                                    <span>My Issued Book</span>
                                </a>
                            </li>  -->
                            <li>
                                <a href="{{ route('library.issuereturn')}}" class="nav-link {{ (request()->is('super_admin/book')) ? 'active' : '' }}">
                                    <span>Book Issue/Return</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarEvents" data-toggle="collapse">
                        <i data-feather="map"></i>
                        <span> Events </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEvents">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('super_admin.event_type')}}" class="nav-link {{ (request()->is('super_admin/event_type*')) ? 'active' : '' }}">
                                    <span> Event Type </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('super_admin.event')}}" class="nav-link {{ (request()->is('super_admin/event/*')) ? 'active' : '' }}">
                                    <span> Events </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ route('users.user')}}" class="nav-link {{ (request()->is('super_admin/users*')) ? 'active' : '' }}">
                        <i data-feather="user" class="icon-dual"></i>
                        <span> User List </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('forum.index')}}" target=”_blank” class="nav-link {{ (request()->is('super_admin/forum*')) ? 'active' : '' }}">
                        <i data-feather="external-link" class="icon-dual"></i>
                        <span> Forum </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('super_admin.settings')}}" class="nav-link {{ (request()->is('super_admin/settings*')) ? 'active' : '' }}">
                        <i data-feather="settings" class="icon-dual"></i>
                        <span> Settings </span>
                    </a>
                </li>
                @elseif(Session::get('role_id') == '2')
                <li>
                    <a href="{{ route('admin.dashboard')}}" class="nav-link {{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
                        <i data-feather="airplay" class="icon-dual"></i>
                        <span> Dashboards </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.settings')}}" class="nav-link {{ (request()->is('admin/settings*')) ? 'active' : '' }}">
                        <i data-feather="settings" class="icon-dual"></i>
                        <span> Settings </span>
                    </a>
                </li>
                @elseif(Session::get('role_id') == '3')
                <li>
                    <a href="{{ route('staff.dashboard')}}" class="nav-link {{ (request()->is('staff/dashboard*')) ? 'active' : '' }}">
                        <i data-feather="airplay" class="icon-dual"></i>
                        <span> Dashboards </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('staff.settings')}}" class="nav-link {{ (request()->is('staff/settings*')) ? 'active' : '' }}">
                        <i data-feather="settings" class="icon-dual"></i>
                        <span> Settings </span>
                    </a>
                </li>
                @elseif(Session::get('role_id') == '4')
                <li>
                    <a href="{{ route('teacher.dashboard')}}" class="nav-link {{ (request()->is('teacher/dashboard*')) ? 'active' : '' }}">
                        <i data-feather="airplay" class="icon-dual"></i>
                        <span> Dashboards </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('teacher.settings')}}" class="nav-link {{ (request()->is('teacher/settings*')) ? 'active' : '' }}">
                        <i data-feather="settings" class="icon-dual"></i>
                        <span> Settings </span>
                    </a>
                </li>
                @elseif(Session::get('role_id') == '5')
                <li>
                    <a href="{{ route('parent.dashboard')}}" class="nav-link {{ (request()->is('parent/dashboard*')) ? 'active' : '' }}">
                        <i data-feather="airplay" class="icon-dual"></i>
                        <span> Dashboards </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('parent.settings')}}" class="nav-link {{ (request()->is('parent/settings*')) ? 'active' : '' }}">
                        <i data-feather="settings" class="icon-dual"></i>
                        <span> Settings </span>
                    </a>
                </li>
                @elseif(Session::get('role_id') == '6')
                <li>
                    <a href="{{ route('student.dashboard')}}" class="nav-link {{ (request()->is('student/dashboard*')) ? 'active' : '' }}">
                        <i data-feather="airplay" class="icon-dual"></i>
                        <span> Dashboards </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('student.settings')}}" class="nav-link {{ (request()->is('student/settings*')) ? 'active' : '' }}">
                        <i data-feather="settings" class="icon-dual"></i>
                        <span> Settings </span>
                    </a>
                </li>
                @endif

                @endif

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->