<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu" style="background-color:#2F2F8F">
    <div class="h-100" data-simplebar>
        <style>
            /*sidebar span code*/
            span,
            i {
                font-family: 'Open Sans';
                font-style: normal;
                font-weight: 400;
                font-size: 14px;
                line-height: 22px;
                letter-spacing: 0.0133em;
                color: #C4C7D2;
            }

            span:hover {
                color: #6FC6CC;
            }

            li>a>svg:hover {
                color: #6FC6CC;
            }

            /*svg for icons*/
            svg {
                width: 12px;
                height: 15px;
            }
        </style>
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
            <!-- <ul class="list-unstyled topnav-menu mb-0">
                <li>
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('images/favicon.ico') }}" alt="user-image" height="50px" width="50px" class="rounded-circle admin_picture">
                        <span style="color:#0ABAB5"><b> {{ Session::get('school_name') }}</b> </span>
                    </a>
                </li>

            </ul><br> -->

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
                            <!-- <li>
                                <a href="{{ route('admission.import')}}" class="nav-link {{ (request()->is('super_admin/admission/import')) ? 'active' : '' }}">
                                    <span>Multiple Import</span>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarStudentDetails" data-toggle="collapse">
                        <i class="fas fa-users"></i>
                        <span> Student Details </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarStudentDetails">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('student.index')}}" class="nav-link {{ (request()->is('super_admin/student*')) ? 'active' : '' }}">
                                    <span> Student List </span>
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
                                <a href="{{ route('super_admin.homework')}}" class="nav-link {{ (request()->is('super_admin/homework*')) ? 'active' : '' }}">
                                    <span>Add Homework</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('super_admin.evaluation_report')}}" class="nav-link {{ (request()->is('super_admin/evaluation_report*')) ? 'active' : '' }}">
                                    <span>Evoluation Report</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarTasks" data-toggle="collapse">
                        <i data-feather="external-link" class="icon-dual"></i>
                        <span> Tasks </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarTasks">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('super_admin.task')}}" class="nav-link {{ (request()->is('super_admin/task*')) ? 'active' : '' }}">
                                    <span>To Do List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarAttendance" data-toggle="collapse">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span> Attendance </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAttendance">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('attendance.student_entry')}}" class="nav-link {{ (request()->is('super_admin/attendance/student_entry')) ? 'active' : '' }}">
                                    <span> Student </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('attendance.employee_entry')}}" class="nav-link {{ (request()->is('super_admin/attendance/employee_entry')) ? 'active' : '' }}">
                                    <span> Employee </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('attendance.exam_entry')}}" class="nav-link {{ (request()->is('super_admin/attendance/exam_entry')) ? 'active' : '' }}">
                                    <span> Exam </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebartimeTable" data-toggle="collapse">
                        <i data-feather="external-link" class="icon-dual"></i>
                        <span> Time Table </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebartimeTable">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('super_admin.timetable.lesson')}}" class="nav-link {{ (request()->is('super_admin/task*')) ? 'active' : '' }}">
                                    <span>Add Lesson</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('super_admin.timetable.index')}}" class="nav-link {{ (request()->is('super_admin/timetable*')) ? 'active' : '' }}">
                                    <span> Time Table </span>
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
                            <li>
                                <a href="#sidebarSchedule" data-toggle="collapse">
                                    <i class="fas fa-dna"></i> &nbsp;
                                    Exam Schedule <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarSchedule">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('super_admin.timetable.viewexam')}}" class="nav-link {{ (request()->is('super_admin/exam/timetable')) ? 'active' : '' }}">
                                                <span>Schedule</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('super_admin.timetable.set_examwise')}}" class="nav-link {{ (request()->is('super_admin/exam/set_examwise')) ? 'active' : '' }}">
                                                <span>Add Schedule</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarMarks" data-toggle="collapse">
                                    <i class="fas fa-marker"></i> &nbsp;
                                    Marks <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarMarks">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('super_admin.exam.mark_entry')}}" class="nav-link {{ (request()->is('super_admin/exam/timetable')) ? 'active' : '' }}">
                                                <span>Mark Entries</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('super_admin.exam.grade_range')}}" class="nav-link {{ (request()->is('super_admin/exam/set_examwise')) ? 'active' : '' }}">
                                                <span>Grade Range</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarResult" data-toggle="collapse">
                                    <i data-feather="book-open" class="icons-xs icon-dual"></i> &nbsp;
                                    Exam Results<span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarResult">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('super_admin.exam_results.byclass')}}" class="nav-link {{ (request()->is('super_admin/exam_results')) ? 'active' : '' }}">
                                                <span>By Class</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('super_admin.exam_results.bysubject')}}" class="nav-link {{ (request()->is('super_admin/exam_results')) ? 'active' : '' }}">
                                                <span>By Subject</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('super_admin.exam_results.bystudent')}}" class="nav-link {{ (request()->is('super_admin/exam_results')) ? 'active' : '' }}">
                                                <span>By Student</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('super_admin.exam_results.overall')}}" class="nav-link {{ (request()->is('super_admin/exam_results')) ? 'active' : '' }}">
                                                <span>Overall</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('super_admin.exam.result')}}" class="nav-link {{ (request()->is('super_admin/exam*')) ? 'active' : '' }}">
                                                <span>Individual Result </span>
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
                <!-- <li>
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
                            <li>
                                <a href="{{ route('library.issuedbook')}}" class="nav-link {{ (request()->is('super_admin/issuedbook')) ? 'active' : '' }}">
                                    <span>My Issued Book</span>
                                </a>
                            </li> 
                            <li>
                                <a href="{{ route('library.issuereturn')}}" class="nav-link {{ (request()->is('super_admin/book')) ? 'active' : '' }}">
                                    <span>Book Issue/Return</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li>
                    <a href="#sidebarEvents" data-toggle="collapse">
                        <i class="fas fa-map"></i>
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
                    <a href="#sidebarLeaveManage" data-toggle="collapse">
                        <i data-feather="map"></i>
                        <span> Leave Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarLeaveManage">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('super_admin.leave_management.allleaves')}}" class="nav-link {{ (request()->is('super_admin/leave_management*')) ? 'active' : '' }}">
                                    <span> All Leave</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('super_admin.leave_management.applyleave')}}" class="nav-link {{ (request()->is('super_admin/leave_management*')) ? 'active' : '' }}">
                                    <span> Leave Apply </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('super_admin.leave_management.approvalleave')}}" class="nav-link {{ (request()->is('super_admin/leave_management*')) ? 'active' : '' }}">
                                    <span> Leave Approval </span>
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
                    <a href="{{ route('super_admin.schoolcrm.app.form')}}" target=”_blank” class="nav-link {{ (request()->is('application-form')) ? 'active' : '' }}">

                        <i class="fab fa-wpforms"></i>
                        <span> Application Form </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('super_admin.forum.rolls-chooseforum')}}" target=”_blank” class="nav-link {{ (request()->is('super_admin/forum*')) ? 'active' : '' }}">
                        <i class="far fa-comments"></i>
                        <span> Forum </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('super_admin.settings')}}" class="nav-link {{ (request()->is('super_admin/settings*')) ? 'active' : '' }}">
                        <i data-feather="settings" class="icon-dual"></i>
                        <span> Settings </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('super_admin.faq.index')}}" class="nav-link {{ (request()->is('super_admin/settings*')) ? 'active' : '' }}">
                        <i class="fas fa-question"></i>
                        <span> FAQs </span>
                    </a>
                </li>
                @elseif(Session::get('role_id') == '2')
                <li>
                    <a href="{{ route('admin.dashboard')}}" class="nav-link {{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
                        <!--<i data-feather="airplay" class="icon-dual"></i>-->
                        <svg width="40" height="40" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.33333 20.3333H16.3333C16.687 20.3333 17.0261 20.1929 17.2761 19.9428C17.5262 19.6928 17.6667 19.3536 17.6667 19V8.33333C17.6667 7.97971 17.5262 7.64057 17.2761 7.39052C17.0261 7.14048 16.687 7 16.3333 7H8.33333C7.97971 7 7.64057 7.14048 7.39052 7.39052C7.14048 7.64057 7 7.97971 7 8.33333V19C7 19.3536 7.14048 19.6928 7.39052 19.9428C7.64057 20.1929 7.97971 20.3333 8.33333 20.3333ZM7 29.6667C7 30.0203 7.14048 30.3594 7.39052 30.6095C7.64057 30.8595 7.97971 31 8.33333 31H16.3333C16.687 31 17.0261 30.8595 17.2761 30.6095C17.5262 30.3594 17.6667 30.0203 17.6667 29.6667V24.3333C17.6667 23.9797 17.5262 23.6406 17.2761 23.3905C17.0261 23.1405 16.687 23 16.3333 23H8.33333C7.97971 23 7.64057 23.1405 7.39052 23.3905C7.14048 23.6406 7 23.9797 7 24.3333V29.6667ZM20.3333 29.6667C20.3333 30.0203 20.4738 30.3594 20.7239 30.6095C20.9739 30.8595 21.313 31 21.6667 31H29.6667C30.0203 31 30.3594 30.8595 30.6095 30.6095C30.8595 30.3594 31 30.0203 31 29.6667V20.3333C31 19.9797 30.8595 19.6406 30.6095 19.3905C30.3594 19.1405 30.0203 19 29.6667 19H21.6667C21.313 19 20.9739 19.1405 20.7239 19.3905C20.4738 19.6406 20.3333 19.9797 20.3333 20.3333V29.6667ZM21.6667 16.3333H29.6667C30.0203 16.3333 30.3594 16.1929 30.6095 15.9428C30.8595 15.6928 31 15.3536 31 15V8.33333C31 7.97971 30.8595 7.64057 30.6095 7.39052C30.3594 7.14048 30.0203 7 29.6667 7H21.6667C21.313 7 20.9739 7.14048 20.7239 7.39052C20.4738 7.64057 20.3333 7.97971 20.3333 8.33333V15C20.3333 15.3536 20.4738 15.6928 20.7239 15.9428C20.9739 16.1929 21.313 16.3333 21.6667 16.3333Z" fill="#C4C7D2" />
                        </svg>
                        <span> Dashboards </span>
                    </a>
                </li>
                <li>
                    <a href="#sidebarAdmission" data-toggle="collapse">
                        <!--<i class="fe-edit"></i>-->
                        <svg width="24" height="27" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_107_5)">
                                <path d="M23.3 5.68187L12.57 0.144366C12.3931 0.0527597 12.1979 0.00505066 12 0.00505066C11.8021 0.00505066 11.6069 0.0527597 11.43 0.144366L0.700013 5.68187C0.489608 5.78952 0.312533 5.95566 0.188843 6.16156C0.0651537 6.36746 -0.000238621 6.60492 6.54294e-07 6.84712C6.54294e-07 7.19446 0.133778 7.52758 0.371949 7.77318C0.61012 8.01878 0.933195 8.15673 1.27002 8.15673H22.73C23.0668 8.15673 23.3899 8.01878 23.628 7.77318C23.8662 7.52758 24 7.19446 24 6.84712C24.0002 6.60492 23.9348 6.36746 23.8112 6.16156C23.6875 5.95566 23.5104 5.78952 23.3 5.68187ZM12 7.07399C11.6044 7.07399 11.2178 6.95303 10.8889 6.72641C10.56 6.49979 10.3036 6.17771 10.1522 5.80086C10.0008 5.42401 9.96128 5.00933 10.0385 4.60926C10.1156 4.2092 10.3061 3.8417 10.5858 3.55327C10.8655 3.26484 11.2218 3.06841 11.6098 2.98883C11.9978 2.90926 12.3999 2.95012 12.7654 3.10622C13.1308 3.26231 13.4432 3.52664 13.663 3.8658C13.8827 4.20495 14 4.6037 14 5.0116C14 5.55858 13.7893 6.08316 13.4142 6.46993C13.0391 6.8567 12.5304 7.07399 12 7.07399Z" fill="#C4C7D2" />
                                <path d="M5 10.1676H3V14.2923H5V10.1676Z" fill="#C4C7D2" />
                                <path d="M9 10.1676H7V14.2923H9V10.1676Z" fill="#C4C7D2" />
                                <path d="M13 10.1676H11V14.2923H13V10.1676Z" fill="#C4C7D2" />
                                <path d="M17 10.1676H15V14.2923H17V10.1676Z" fill="#C4C7D2" />
                                <path d="M21 10.1676H19V14.2923H21V10.1676Z" fill="#C4C7D2" />
                                <path d="M21 18.4171C21.2652 18.4171 21.5196 18.3085 21.7071 18.1151C21.8946 17.9217 22 17.6594 22 17.3859C22 17.1124 21.8946 16.8502 21.7071 16.6568C21.5196 16.4634 21.2652 16.3547 21 16.3547H3C2.73478 16.3547 2.48044 16.4634 2.29291 16.6568C2.10537 16.8502 2 17.1124 2 17.3859C2 17.6594 2.10537 17.9217 2.29291 18.1151C2.48044 18.3085 2.73478 18.4171 3 18.4171H4C4 18.4171 2 20.4795 2 26.6667H22C22 20.4795 20 18.4171 20 18.4171H21ZM16.21 19.6649L11.53 24.4909C11.3958 24.6244 11.2166 24.6991 11.03 24.6991C10.8435 24.6991 10.6642 24.6244 10.53 24.4909L8.34998 22.2428C8.25625 22.147 8.18187 22.0329 8.1311 21.9073C8.08033 21.7816 8.0542 21.6468 8.0542 21.5107C8.0542 21.3746 8.08033 21.2398 8.1311 21.1141C8.18187 20.9885 8.25625 20.8744 8.34998 20.7786C8.53734 20.5865 8.79081 20.4787 9.05499 20.4787C9.31918 20.4787 9.57265 20.5865 9.76001 20.7786L10.53 21.5726C10.6642 21.7061 10.8435 21.7808 11.03 21.7808C11.2166 21.7808 11.3958 21.7061 11.53 21.5726L14.79 18.2006C14.9783 18.0064 15.2337 17.8973 15.5 17.8973C15.7663 17.8973 16.0217 18.0064 16.21 18.2006C16.3983 18.3948 16.5041 18.6581 16.5041 18.9327C16.5041 19.2073 16.3983 19.4707 16.21 19.6649Z" fill="#C4C7D2" />
                            </g>
                            <defs>
                                <clipPath id="clip0_107_5">
                                    <rect width="24" height="26.6667" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span> Admission </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAdmission">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.admission')}}" class="nav-link {{ (request()->is('admin/admission/index')) ? 'active' : '' }}">
                                    <span>Create Admission</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="{{ route('admin.admission.import')}}" class="nav-link {{ (request()->is('admin/admission/import')) ? 'active' : '' }}">
                                    <span>Multiple Import</span>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarStudentDetails" data-toggle="collapse">
                        <!--<i class="fas fa-user-graduate"></i>-->
                        <svg width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_59_2130)">
                                <path d="M5.65939 2.52906C4.71434 2.52906 3.80799 2.91067 3.13974 3.58994C2.47149 4.26921 2.09607 5.19049 2.09607 6.15112V15.7027C1.51005 15.602 0.978038 15.2937 0.594355 14.8323C0.210673 14.3709 0.00010696 13.7863 0 13.1822V3.38131C0 2.70321 0.265 2.05289 0.736708 1.57341C1.20841 1.09392 1.84819 0.824554 2.51528 0.824554H18.3406C18.8606 0.824718 19.3678 0.988711 19.7924 1.29396C20.2169 1.59921 20.5379 2.0307 20.7113 2.52906H5.65939Z" fill="#C4C7D2" />
                                <path d="M21.4847 3.59438H5.65939C4.99229 3.59438 4.35252 3.86375 3.88081 4.34323C3.4091 4.82271 3.1441 5.47304 3.1441 6.15113V15.952C3.1441 16.6301 3.4091 17.2804 3.88081 17.7599C4.35252 18.2394 4.99229 18.5088 5.65939 18.5088H21.4847C22.1518 18.5088 22.7916 18.2394 23.2633 17.7599C23.735 17.2804 24 16.6301 24 15.952V6.15113C24 5.47304 23.735 4.82271 23.2633 4.34323C22.7916 3.86375 22.1518 3.59438 21.4847 3.59438ZM9.1179 6.47072C9.49101 6.47072 9.85574 6.58319 10.166 6.79389C10.4762 7.0046 10.718 7.30408 10.8608 7.65447C11.0036 8.00486 11.0409 8.39041 10.9681 8.76238C10.8953 9.13435 10.7157 9.47603 10.4518 9.74421C10.188 10.0124 9.85187 10.195 9.48593 10.269C9.11999 10.343 8.74069 10.305 8.39598 10.1599C8.05128 10.0148 7.75666 9.76897 7.54937 9.45363C7.34208 9.13829 7.23144 8.76755 7.23144 8.38829C7.23144 7.87972 7.43019 7.39198 7.78397 7.03237C8.13775 6.67275 8.61758 6.47072 9.1179 6.47072ZM5.55458 14.6736C5.55458 13.6848 5.94104 12.7364 6.62895 12.0371C7.31685 11.3379 8.24986 10.945 9.22271 10.945C10.1956 10.945 11.1286 11.3379 11.8165 12.0371C12.5044 12.7364 12.8908 13.6848 12.8908 14.6736H5.55458ZM21.6943 13.7149H15.1965C15.1409 13.7149 15.0876 13.6924 15.0483 13.6524C15.009 13.6125 14.9869 13.5583 14.9869 13.5018C14.9869 13.4453 15.009 13.3911 15.0483 13.3511C15.0876 13.3112 15.1409 13.2887 15.1965 13.2887H21.6943C21.7499 13.2887 21.8032 13.3112 21.8425 13.3511C21.8818 13.3911 21.9039 13.4453 21.9039 13.5018C21.9039 13.5583 21.8818 13.6125 21.8425 13.6524C21.8032 13.6924 21.7499 13.7149 21.6943 13.7149ZM21.6943 12.2234H15.1965C15.1409 12.2234 15.0876 12.201 15.0483 12.161C15.009 12.1211 14.9869 12.0669 14.9869 12.0104C14.9869 11.9538 15.009 11.8997 15.0483 11.8597C15.0876 11.8197 15.1409 11.7973 15.1965 11.7973H21.6943C21.7499 11.7973 21.8032 11.8197 21.8425 11.8597C21.8818 11.8997 21.9039 11.9538 21.9039 12.0104C21.9039 12.0669 21.8818 12.1211 21.8425 12.161C21.8032 12.201 21.7499 12.2234 21.6943 12.2234ZM21.6943 10.732H15.1965C15.1409 10.732 15.0876 10.7095 15.0483 10.6696C15.009 10.6296 14.9869 10.5754 14.9869 10.5189C14.9869 10.4624 15.009 10.4082 15.0483 10.3683C15.0876 10.3283 15.1409 10.3059 15.1965 10.3059H21.6943C21.7499 10.3059 21.8032 10.3283 21.8425 10.3683C21.8818 10.4082 21.9039 10.4624 21.9039 10.5189C21.9039 10.5754 21.8818 10.6296 21.8425 10.6696C21.8032 10.7095 21.7499 10.732 21.6943 10.732ZM21.6943 9.24054H15.1965C15.1409 9.24054 15.0876 9.21809 15.0483 9.17813C15.009 9.13817 14.9869 9.08398 14.9869 9.02748C14.9869 8.97097 15.009 8.91678 15.0483 8.87682C15.0876 8.83686 15.1409 8.81441 15.1965 8.81441H21.6943C21.7499 8.81441 21.8032 8.83686 21.8425 8.87682C21.8818 8.91678 21.9039 8.97097 21.9039 9.02748C21.9039 9.08398 21.8818 9.13817 21.8425 9.17813C21.8032 9.21809 21.7499 9.24054 21.6943 9.24054Z" fill="#C4C7D2" />
                            </g>
                            <defs>
                                <clipPath id="clip0_59_2130">
                                    <rect width="24" height="17.6842" fill="white" transform="translate(0 0.824554)" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span> Student Details </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarStudentDetails">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.student.index')}}" class="nav-link {{ (request()->is('admin/student*')) ? 'active' : '' }}">
                                    <span> Student List </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- <li>
                    <a href="{{ route('admin.classroom.management')}}" class="nav-link {{ (request()->is('admin/classroom*')) ? 'active' : '' }}">
                        <i data-feather="file-text" class="icon-dual"></i>
                        <span> Classroom Management </span>
                    </a>
                </li> -->
                <li>
                    <a href="#sidebarParent" data-toggle="collapse">
                        <!--<i class="fe-user-plus"></i>-->
                        <svg width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_59_2138)">
                                <path d="M0 19C0.0521565 18.629 0.0962869 18.2581 0.148443 17.9131C0.294192 16.9252 0.537261 15.9517 0.874621 15.0047C1.23927 13.9279 1.81449 12.922 2.57172 12.0371C3.46053 10.9926 4.72431 10.2767 6.13441 10.019C7.69185 9.69538 9.32112 9.85307 10.7723 10.4679C11.53 10.8079 12.2045 11.2876 12.7543 11.8776C13.2132 12.3638 13.6028 12.9023 13.9137 13.4801L13.9779 13.5914C14.284 13.253 14.6359 12.9525 15.0251 12.6974C15.7892 12.212 16.6865 11.9368 17.6128 11.9035C18.3739 11.8527 19.1385 11.9396 19.8636 12.1595C20.7852 12.459 21.5877 13.0084 22.1665 13.7361C22.7898 14.5283 23.2433 15.4236 23.5025 16.3736C23.7288 17.148 23.8858 17.9383 23.9719 18.7366C23.9719 18.8219 23.992 18.9072 24 18.9963L0 19Z" fill="#C4C7D2" />
                                <path d="M7.76327 8.64652C6.87324 8.64799 6.00274 8.40526 5.26199 7.94905C4.52124 7.49284 3.94354 6.84367 3.60203 6.08373C3.26051 5.32378 3.17053 4.48724 3.34349 3.67999C3.51644 2.87274 3.94455 2.13108 4.57362 1.54892C5.20269 0.966753 6.00442 0.570256 6.87733 0.409618C7.75024 0.24898 8.65506 0.331423 9.47727 0.646516C10.2995 0.96161 11.0021 1.49519 11.4962 2.17969C11.9902 2.86419 12.2535 3.66884 12.2527 4.49178C12.2517 5.59274 11.7785 6.64838 10.9369 7.42723C10.0953 8.20608 8.95399 8.64456 7.76327 8.64652Z" fill="#C4C7D2" />
                                <path d="M18.018 4.35823C18.7079 4.3597 19.3818 4.5504 19.9545 4.90617C20.5271 5.26193 20.9727 5.76679 21.2349 6.35682C21.4971 6.94686 21.564 7.59554 21.4273 8.22078C21.2905 8.84601 20.9562 9.41968 20.4667 9.86917C19.9772 10.3187 19.3545 10.6238 18.6773 10.7459C18.0002 10.868 17.2991 10.8016 16.6628 10.5551C16.0265 10.3086 15.4836 9.89314 15.1028 9.36123C14.722 8.82932 14.5204 8.20491 14.5235 7.56702C14.523 7.14362 14.6132 6.72431 14.7889 6.33332C14.9646 5.94233 15.2224 5.5874 15.5473 5.28905C15.8722 4.99069 16.2579 4.75483 16.6819 4.59506C17.106 4.43529 17.5601 4.3548 18.018 4.35823Z" fill="#C4C7D2" />
                            </g>
                            <defs>
                                <clipPath id="clip0_59_2138">
                                    <rect width="24" height="18.6667" fill="white" transform="translate(0 0.333313)" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span> Parents </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarParent">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.parent.create')}}" class="nav-link {{ (request()->is('admin/parent*')) ? 'active' : '' }}">
                                    <span>Add Parent</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.parent')}}" class="nav-link {{ (request()->is('admin/parent/*')) ? 'active' : '' }}">
                                    <span>Parent List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarEmployee" data-toggle="collapse">
                        <!--<i class="fas fa-users"></i>-->
                        <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_59_2147)">
                                <path d="M6.34223 7.4312C5.7425 7.43071 5.15636 7.21811 4.65793 6.8203C4.15949 6.4225 3.77115 5.85735 3.54202 5.19631C3.3129 4.53528 3.25328 3.80805 3.37069 3.1066C3.4881 2.40515 3.77727 1.76097 4.20165 1.25553C4.62602 0.750092 5.16654 0.406094 5.75483 0.267034C6.34313 0.127973 6.95278 0.200097 7.5067 0.474287C8.06063 0.748476 8.53395 1.21241 8.8668 1.80743C9.19965 2.40245 9.3771 3.10183 9.37668 3.81713C9.37446 4.77569 9.0539 5.69417 8.4852 6.37151C7.91649 7.04885 7.14595 7.42988 6.34223 7.4312Z" fill="#C4C7D2" />
                                <path d="M10.0812 12.184H2.5592V12.0737C2.5592 11.5395 2.5592 11.0077 2.5592 10.476C2.55223 10.1513 2.60512 9.82865 2.71412 9.53093C2.82313 9.23321 2.98559 8.96766 3.19006 8.75302C3.49863 8.41913 3.89476 8.22323 4.31089 8.19875C4.50226 8.18621 4.69572 8.19875 4.88708 8.19875H8.18226C8.42965 8.19278 8.67548 8.24659 8.90497 8.35693C9.13446 8.46728 9.34285 8.63187 9.51759 8.84081C9.69559 9.04377 9.83701 9.28791 9.93318 9.5583C10.0294 9.82869 10.0783 10.1196 10.0769 10.4133C10.0769 10.9877 10.0769 11.562 10.0769 12.1389C10.0854 12.1464 10.0833 12.1589 10.0812 12.184Z" fill="#C4C7D2" />
                                <path d="M23.7708 20.6612C23.7708 20.7858 23.7294 20.9053 23.6558 20.9937C23.5821 21.0821 23.482 21.132 23.3776 21.1327H0.622457C0.568257 21.1374 0.513817 21.1288 0.462548 21.1073C0.411278 21.0858 0.364273 21.0519 0.32447 21.0078C0.284667 20.9636 0.252921 20.9102 0.231212 20.8508C0.209503 20.7914 0.198303 20.7272 0.198303 20.6624C0.198303 20.5976 0.209503 20.5335 0.231212 20.4741C0.252921 20.4147 0.284667 20.3612 0.32447 20.3171C0.364273 20.273 0.411278 20.2391 0.462548 20.2176C0.513817 20.1961 0.568257 20.1874 0.622457 20.1922H23.3776C23.4818 20.1922 23.5819 20.2416 23.6556 20.3295C23.7294 20.4175 23.7708 20.5368 23.7708 20.6612Z" fill="#C4C7D2" />
                                <path d="M23.9832 14.0475L23.2829 19.5276C23.2829 19.5426 23.2829 19.5576 23.2724 19.5802H0.736022C0.687656 19.2065 0.641397 18.8404 0.595134 18.4717L0.147222 14.983C0.103062 14.6369 0.0546973 14.2883 0.0168457 13.9396C0.000234573 13.7784 0.0210506 13.6147 0.0770412 13.4666C0.133032 13.3184 0.222051 13.1914 0.33438 13.0995C0.521583 12.9284 0.752638 12.8397 0.988369 12.8486H23.0264C23.2118 12.8363 23.3962 12.8885 23.5571 12.9989C23.718 13.1094 23.8486 13.2733 23.9327 13.4706C24.0029 13.6509 24.0207 13.8539 23.9832 14.0475Z" fill="#C4C7D2" />
                                <path d="M17.6956 7.4312C17.0959 7.43071 16.5097 7.21811 16.0113 6.8203C15.5129 6.4225 15.1246 5.85735 14.8954 5.19631C14.6663 4.53528 14.6067 3.80805 14.7241 3.1066C14.8415 2.40515 15.1307 1.76097 15.555 1.25553C15.9794 0.750092 16.5199 0.406094 17.1082 0.267034C17.6965 0.127973 18.3062 0.200097 18.8601 0.474287C19.414 0.748476 19.8873 1.21241 20.2202 1.80743C20.553 2.40245 20.7305 3.10183 20.7301 3.81713C20.7284 4.7759 20.408 5.69475 19.8392 6.37224C19.2704 7.04972 18.4995 7.43054 17.6956 7.4312Z" fill="#C4C7D2" />
                                <path d="M21.4345 12.184H13.9125V12.0737C13.9125 11.5403 13.9125 11.0077 13.9125 10.476C13.9059 10.1513 13.9589 9.8288 14.0679 9.53114C14.1769 9.23347 14.3392 8.96788 14.5434 8.75302C14.852 8.41913 15.2481 8.22323 15.6642 8.19875C15.8577 8.18621 16.0491 8.19875 16.2425 8.19875H19.5356C19.7819 8.19577 20.0262 8.25071 20.2546 8.36042C20.483 8.47014 20.691 8.63248 20.8668 8.83816C21.0426 9.04384 21.1826 9.28882 21.279 9.5591C21.3753 9.82939 21.426 10.1197 21.4282 10.4133C21.4282 10.9877 21.4282 11.562 21.4282 12.1389C21.4387 12.1464 21.4366 12.1589 21.4345 12.184Z" fill="#C4C7D2" />
                            </g>
                            <defs>
                                <clipPath id="clip0_59_2147">
                                    <rect width="24" height="20.9321" fill="white" transform="translate(0 0.200623)" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span> Employee </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEmployee">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#sideBarEmpMasters" data-toggle="collapse">
                                    <i class="fe-book-open"></i> &nbsp;
                                    Masters <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sideBarEmpMasters">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('admin.qualification')}}" class="nav-link {{ (request()->is('admin/qualification*')) ? 'active' : '' }}">
                                                <span> Add Qualification </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.staffcategory')}}" class="nav-link {{ (request()->is('admin/staffcategory*')) ? 'active' : '' }}">
                                                <span> Add Staff Category </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.department')}}" class="nav-link {{ (request()->is('admin/department*')) ? 'active' : '' }}">
                                                <span> Add Department </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.designation')}}" class="nav-link {{ (request()->is('admin/designation*')) ? 'active' : '' }}">
                                                <span>Add Designation </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.staff_position')}}" class="nav-link {{ (request()->is('admin/staff_position*')) ? 'active' : '' }}">
                                                <span>Staff Position </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.stream_type')}}" class="nav-link {{ (request()->is('admin/stream_type*')) ? 'active' : '' }}">
                                                <span>Stream Type </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.religion')}}" class="nav-link {{ (request()->is('admin/religion*')) ? 'active' : '' }}">
                                                <span>Religion </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.race')}}" class="nav-link {{ (request()->is('admin/race*')) ? 'active' : '' }}">
                                                <span>Race </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="{{ route('admin.employee')}}" class="nav-link {{ (request()->is('admin/employee')) ? 'active' : '' }}">
                                    <span>Add Employee</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.listemployee')}}" class="nav-link {{ (request()->is('admin/listemployee')) ? 'active' : '' }}">
                                    <span>Employee List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebartimeTable" data-toggle="collapse">
                        <!-- <i class="far fa-calendar-alt"></i>-->
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_59_2192)">
                                <path d="M20.0459 24.0952H6.00084C5.82356 24.0952 5.65354 24.0231 5.52818 23.8949C5.40282 23.7666 5.3324 23.5926 5.3324 23.4111V3.85696C5.3324 3.67552 5.40282 3.50152 5.52818 3.37322C5.65354 3.24493 5.82356 3.17285 6.00084 3.17285H20.0459C20.2231 3.173 20.393 3.24515 20.5182 3.37342C20.6435 3.5017 20.7138 3.67562 20.7138 3.85696V23.4111C20.7138 23.5925 20.6435 23.7664 20.5182 23.8946C20.393 24.0229 20.2231 24.0951 20.0459 24.0952ZM8.0846 10.1814H18.1196C18.2969 10.1814 18.4669 10.1093 18.5923 9.98101C18.7176 9.85272 18.7881 9.67871 18.7881 9.49727V9.48294C18.7881 9.3015 18.7176 9.12749 18.5923 8.9992C18.4669 8.8709 18.2969 8.79883 18.1196 8.79883H8.0846C7.99682 8.79883 7.9099 8.81652 7.8288 8.8509C7.7477 8.88528 7.67401 8.93567 7.61194 8.9992C7.54987 9.06272 7.50064 9.13814 7.46705 9.22114C7.43345 9.30414 7.41616 9.3931 7.41616 9.48294V9.49727C7.41616 9.58711 7.43345 9.67607 7.46705 9.75907C7.50064 9.84207 7.54987 9.91749 7.61194 9.98101C7.67401 10.0445 7.7477 10.0949 7.8288 10.1293C7.9099 10.1637 7.99682 10.1814 8.0846 10.1814ZM9.65345 7.21557H16.5659C16.7432 7.21557 16.9132 7.1435 17.0386 7.0152C17.1639 6.88691 17.2343 6.7129 17.2343 6.53146C17.2342 6.35013 17.1637 6.17627 17.0384 6.0481C16.913 5.91993 16.7431 5.84793 16.5659 5.84793H9.65345C9.56539 5.8474 9.47809 5.86468 9.39657 5.89879C9.31506 5.9329 9.24093 5.98316 9.17845 6.04667C9.11597 6.11019 9.06637 6.18572 9.0325 6.26891C8.99863 6.35211 8.98116 6.44134 8.98109 6.53146C8.98109 6.62164 8.99851 6.71093 9.03234 6.79419C9.06618 6.87746 9.11577 6.95305 9.17825 7.01663C9.24074 7.0802 9.31489 7.13051 9.39644 7.16465C9.478 7.1988 9.56534 7.2161 9.65345 7.21557Z" fill="#C4C7D2" />
                                <path d="M8.62195 0.978877C8.62195 0.862833 8.64429 0.747925 8.68768 0.640714C8.73107 0.533502 8.79467 0.43609 8.87484 0.354034C8.95502 0.271979 9.0502 0.206889 9.15496 0.162481C9.25972 0.118073 9.37199 0.0952148 9.48538 0.0952148H23.1371C23.3661 0.0952148 23.5858 0.188315 23.7477 0.354034C23.9096 0.519753 24.0006 0.744515 24.0006 0.978877V20.1265C24.0006 20.3608 23.9096 20.5856 23.7477 20.7513C23.5858 20.917 23.3661 21.0101 23.1371 21.0101H22.8721C22.6431 21.0101 22.4235 20.917 22.2616 20.7513C22.0997 20.5856 22.0087 20.3608 22.0087 20.1265V2.74621C22.0087 2.51184 21.9177 2.28708 21.7558 2.12136C21.5939 1.95564 21.3743 1.86254 21.1453 1.86254H9.48538C9.37199 1.86254 9.25972 1.83969 9.15496 1.79528C9.0502 1.75087 8.95502 1.68578 8.87484 1.60372C8.79467 1.52167 8.73107 1.42425 8.68768 1.31704C8.64429 1.20983 8.62195 1.09492 8.62195 0.978877Z" fill="#C4C7D2" />
                                <path d="M0.00840513 7.08881H3.76635V7.24707C3.76635 12.0731 3.76523 16.8991 3.76299 21.7252C3.763 21.8111 3.73389 21.8944 3.68063 21.9609C3.18196 22.5876 2.67825 23.2109 2.17061 23.8406C2.13523 23.8844 2.09082 23.9197 2.04055 23.944C1.99028 23.9682 1.93539 23.9808 1.87982 23.9808C1.82424 23.9808 1.76936 23.9682 1.71909 23.944C1.66881 23.9197 1.6244 23.8844 1.58902 23.8406C1.4594 23.6808 1.33072 23.5212 1.20297 23.3618C0.824766 22.891 0.446002 22.4213 0.0722804 21.9471C0.0280183 21.8909 0.00389631 21.8209 0.00392517 21.7487C0.000563355 16.9085 0.000563355 12.0681 0.00392517 7.22758C0.00112366 7.18514 0.00560361 7.14328 0.00840513 7.08881Z" fill="#C4C7D2" />
                                <path d="M3.75737 6.14037H0.0100654C0.00670357 6.09679 0.00109863 6.05493 0.00109863 6.01307C0.00109863 5.34444 0.00109863 4.67581 0.00109863 4.00604C0.00109863 3.4521 0.266683 3.08052 0.754706 2.93486C0.817359 2.91613 0.882187 2.9061 0.947451 2.90504C1.56378 2.90504 2.18012 2.88096 2.79645 2.90791C3.3702 2.93314 3.75289 3.35347 3.76465 3.94354C3.7781 4.6546 3.76465 5.3668 3.76465 6.07843C3.76346 6.09921 3.76103 6.11989 3.75737 6.14037Z" fill="#C4C7D2" />
                            </g>
                            <defs>
                                <clipPath id="clip0_59_2192">
                                    <rect width="24" height="24" fill="white" transform="translate(0 0.0952148)" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span> Time Table </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebartimeTable">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.timetable.create')}}" class="nav-link {{ (request()->is('super_admin/timetable*')) ? 'active' : '' }}">
                                    <span>Class Schedule</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.timetable')}}" class="nav-link {{ (request()->is('super_admin/timetable*')) ? 'active' : '' }}">
                                    <span> Time Table </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sideBarAcademic" data-toggle="collapse">
                        <!--<i data-feather="home"></i>-->
                        <svg width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_59_2159)">
                                <path d="M12.0082 0.333357C12.3265 0.333368 12.6405 0.404131 12.9251 0.540022L23.5031 5.58224H23.5171C23.647 5.62866 23.761 5.70847 23.8462 5.81281C23.9315 5.91715 23.9847 6.04195 24 6.17336C23.9982 6.30157 23.9577 6.42658 23.8832 6.5334C23.8087 6.64021 23.7035 6.7243 23.5801 6.77558L21.0137 8.27336C18.3696 9.82003 15.7193 11.3659 13.0627 12.9111C12.7472 13.1111 12.3767 13.2178 11.9977 13.2178C11.6187 13.2178 11.2482 13.1111 10.9327 12.9111C7.45176 10.8845 3.9732 8.85335 0.496966 6.8178C0.379773 6.75335 0.27226 6.67412 0.17734 6.58224C0.115835 6.52749 0.0677813 6.46047 0.0366231 6.38598C0.00546495 6.31149 -0.00803291 6.23136 -0.00290644 6.15132C0.00222003 6.07128 0.0258503 5.99332 0.0662845 5.92298C0.106719 5.85265 0.162958 5.79169 0.230996 5.74447C0.310931 5.67767 0.399533 5.62091 0.494631 5.57558L11.1403 0.502248C11.4121 0.383066 11.7091 0.325266 12.0082 0.333357Z" fill="#C4C7D2" />
                                <path d="M21.1514 12.4066C21.1514 13.0444 21.1374 13.68 21.1514 14.3178C21.1643 15.0128 20.8884 15.6845 20.3838 16.1866C19.6546 16.9248 18.7675 17.5053 17.7825 17.8889C16.5167 18.4161 15.1736 18.7556 13.8 18.8955C12.7461 19.017 11.6818 19.0319 10.6247 18.94C8.75486 18.8117 6.93588 18.3016 5.29134 17.4444C4.51122 17.0555 3.83519 16.5013 3.31526 15.8244C3.0033 15.3987 2.84004 14.8902 2.84865 14.3711C2.84865 13.0978 2.84865 11.8244 2.84865 10.5511C2.8478 10.4175 2.86585 10.2845 2.90231 10.1555C2.9083 10.1149 2.92398 10.0761 2.94813 10.0422C2.97228 10.0082 3.00428 9.97996 3.04166 9.95959C3.07903 9.93921 3.1208 9.92726 3.16378 9.92463C3.20675 9.922 3.24979 9.92877 3.2896 9.94442C3.38779 9.96817 3.48148 10.0064 3.56725 10.0578C5.83263 11.38 8.09101 12.7244 10.3611 14.0266C10.846 14.3304 11.4138 14.4923 11.9942 14.4923C12.5746 14.4923 13.1424 14.3304 13.6273 14.0266C15.9604 12.6822 18.2724 11.3133 20.5961 9.95553C20.6498 9.92442 20.7011 9.89109 20.7571 9.8622C20.9461 9.76887 21.0814 9.82664 21.121 10.0244C21.1396 10.1242 21.149 10.2253 21.149 10.3266C21.1537 11.0244 21.1514 11.7155 21.1514 12.4066Z" fill="#C4C7D2" />
                                <path d="M23.1624 12.5133C23.1624 13.6244 23.1624 14.7467 23.1624 15.8622C23.1591 15.9211 23.173 15.9798 23.2027 16.0316C23.2323 16.0834 23.2766 16.1263 23.3304 16.1555C23.5427 16.2768 23.7097 16.4585 23.8077 16.675C23.9056 16.8916 23.9296 17.132 23.8763 17.3622C23.8387 17.5901 23.7293 17.8018 23.5627 17.9692C23.396 18.1366 23.18 18.252 22.9431 18.3C22.6665 18.3611 22.3762 18.3295 22.1212 18.2105C21.8662 18.0915 21.6621 17.8923 21.5433 17.6467C21.4199 17.4087 21.3873 17.1373 21.4512 16.879C21.515 16.6207 21.6713 16.3916 21.8932 16.2311C21.9841 16.1758 22.057 16.0974 22.1036 16.0047C22.1502 15.912 22.1686 15.8088 22.1569 15.7067C22.1569 13.7355 22.1569 11.7667 22.1569 9.79776C22.1398 9.66544 22.1673 9.53139 22.2352 9.41482C22.3031 9.29825 22.4079 9.20515 22.5348 9.14888C22.6818 9.07777 22.8171 8.98887 22.9618 8.91331C23.1064 8.83776 23.1391 8.87332 23.1694 9.00221C23.1819 9.06069 23.1874 9.12033 23.1857 9.17998L23.1624 12.5133Z" fill="#C4C7D2" />
                            </g>
                            <defs>
                                <clipPath id="clip0_59_2159">
                                    <rect width="24" height="18.6667" fill="white" transform="translate(0 0.333313)" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span> Academic</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sideBarAcademic">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#sidebarForClassSec" data-toggle="collapse">
                                    <i class="fe-book-open"></i> &nbsp;
                                    Class & Sections <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarForClassSec">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('admin.section')}}" class="nav-link {{ (request()->is('admin/section*')) ? 'active' : '' }}">
                                                <span> Section </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.classes')}}" class="nav-link {{ (request()->is('admin/classes*')) ? 'active' : '' }}">
                                                <span> Classes </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.section_allocation')}}" class="nav-link {{ (request()->is('admin/section_allocation*')) ? 'active' : '' }}">
                                                <span> Sections Allocation </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.assign_teacher')}}" class="nav-link {{ (request()->is('admin/assign_teacher*')) ? 'active' : '' }}">
                                                <span> Assign Class Teacher </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarForSub" data-toggle="collapse">
                                    <i class="fe-book"></i> &nbsp;
                                    Subjects <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarForSub">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('admin.subjects')}}" class="nav-link {{ (request()->is('admin/subjects*')) ? 'active' : '' }}">
                                                <span> Subjects </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.class_assign_subject')}}" class="nav-link {{ (request()->is('admin/class_assign*')) ? 'active' : '' }}">
                                                <span> Class Assign </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.teacher_assign_subject')}}" class="nav-link {{ (request()->is('admin/teacher_assign*')) ? 'active' : '' }}">
                                                <span> Teacher Assign </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarHomework" data-toggle="collapse">
                        <!--<i class="fe-book-open"></i>-->
                        <svg width="24" height="27" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 1.6668H3.93801V3.1181H5.0536V1.6668H5.28419H20.0992C20.9784 1.64405 21.8384 1.90614 22.5299 2.40755C23.2215 2.90896 23.7008 3.61801 23.8847 4.41156C23.9536 4.69416 23.9873 4.98309 23.9851 5.27273C23.9851 12.2033 23.9851 15.1361 23.9851 22.0712C24.0144 22.7616 23.8171 23.4441 23.419 24.0293C23.0209 24.6146 22.4406 25.0753 21.7539 25.3511C21.2377 25.5735 20.6724 25.6816 20.1029 25.6668H5.07593V24.2086H3.96034V25.6531H0.0111668L0 1.6668ZM3.96034 5.18696V6.96762H5.07593V5.18696H3.96034ZM5.07593 10.8V9.02962H3.96034V10.8H5.07593ZM3.98268 12.8586V14.6324H5.09826V12.8586H3.98268ZM5.09826 16.6944H3.98268V18.4785H5.09826V16.6944ZM5.09826 20.537H3.98268V22.3108H5.09826V20.537Z" fill="#C4C7D2" />
                        </svg>
                        <span> Homework </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarHomework">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.homework')}}" class="nav-link {{ (request()->is('admin/employee*')) ? 'active' : '' }}">
                                    <span>Add Homework</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.evaluation_report')}}" class="nav-link {{ (request()->is('admin/evaluation_report*')) ? 'active' : '' }}">
                                    <span>Evoluation Report</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarTasks" data-toggle="collapse">
                        <!-- <i data-feather="external-link" class="icon-dual"></i> -->
                        <svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.40087 0.864441V2.21359C4.39407 2.49344 4.44513 2.7717 4.55081 3.03102C4.65649 3.29035 4.81453 3.52521 5.01515 3.72097C5.33433 4.02942 5.74738 4.22314 6.18914 4.27158C6.63089 4.32002 7.07624 4.22042 7.45497 3.98849C7.76124 3.80698 8.01252 3.54612 8.18211 3.23361C8.35171 2.92111 8.43328 2.56862 8.41819 2.21359C8.41819 1.81949 8.41819 1.42251 8.41819 1.0284V0.864441H15.5818V1.1032C15.5818 1.55196 15.5819 2.00072 15.5992 2.44948C15.6835 2.9343 15.9429 3.37155 16.3283 3.67863C16.7138 3.98572 17.1986 4.14139 17.6913 4.11625C18.184 4.09111 18.6503 3.88691 19.0024 3.54219C19.3544 3.19748 19.5677 2.73611 19.602 2.24524C19.602 1.79072 19.602 1.33621 19.602 0.870191C19.6424 0.870191 19.6799 0.870191 19.7174 0.870191C20.4672 0.870191 21.2141 0.870191 21.9611 0.870191C22.4311 0.865816 22.888 1.0252 23.2529 1.32086C23.6177 1.61652 23.8677 2.02992 23.9597 2.48975C23.9866 2.6407 23.9991 2.79384 23.9971 2.94714C23.9971 8.8328 23.9971 14.7194 23.9971 20.607C24.0052 20.8816 23.9567 21.155 23.8548 21.4103C23.753 21.6656 23.5998 21.8974 23.4047 22.0914C23.2097 22.2854 22.9769 22.4376 22.7207 22.5385C22.4645 22.6394 22.1903 22.6869 21.915 22.6782H2.08222C1.80715 22.6869 1.53318 22.6394 1.27718 22.5387C1.02117 22.438 0.788519 22.2861 0.593511 22.0924C0.398503 21.8987 0.245239 21.6672 0.14318 21.4123C0.0411206 21.1573 -0.00756946 20.8843 3.98242e-05 20.6099C3.98242e-05 14.7204 3.98242e-05 8.8328 3.98242e-05 2.94714C-0.00492326 2.67848 0.0434605 2.41148 0.142405 2.16156C0.24135 1.91163 0.388892 1.6837 0.576543 1.49091C0.764193 1.29812 0.988214 1.14427 1.23574 1.03823C1.48327 0.932189 1.74941 0.876061 2.01879 0.873071C2.77726 0.873071 3.53281 0.873071 4.29128 0.873071L4.40087 0.864441ZM19.7808 15.6591H11.8587V17.1435H19.7808V15.6591ZM11.8558 9.65552H19.778V8.17691H11.8558V9.65552ZM8.16729 13.9964L5.94669 16.0705L4.91999 15.0119L3.83852 16.0561L5.89476 18.1791L9.19972 15.0982L8.16729 13.9964ZM5.94669 8.99389C5.60061 8.63718 5.26029 8.2891 4.91999 7.93528L3.83852 8.97951L5.89476 11.1054L9.19972 8.02445L8.16729 6.92844L5.94669 8.99389Z" fill="#C4C7D2" />
                        </svg>
                        <span> Tasks </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarTasks">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.task')}}" class="nav-link {{ (request()->is('admin/task*')) ? 'active' : '' }}">
                                    <span>To Do List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarAttendance" data-toggle="collapse">
                        <!--<i class="fas fa-chalkboard-teacher"></i>-->
                        <svg width="24" height="29" viewBox="0 0 24 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_59_2184)">
                                <path d="M11.2567 4.31207V2.11065H10.0526V0.666656H13.9496V2.09817H12.7435V4.30748C16.6027 4.65141 19.7033 6.333 21.911 9.50321C23.5559 11.8661 24.2232 14.5165 23.9352 17.3795C23.6385 20.3463 22.2288 23.0944 19.9854 25.0794C17.742 27.0645 14.8285 28.1417 11.8221 28.0976C8.8156 28.0536 5.93546 26.8916 3.75212 24.8418C1.56878 22.792 0.241509 20.0039 0.0332032 17.0297C-0.197159 13.7531 0.794459 10.8382 2.98091 8.36115C5.16736 5.88405 7.95289 4.58643 11.2567 4.31207ZM19.5915 16.286C19.5663 12.0387 16.1705 8.68014 11.9908 8.69195C7.79534 8.70377 4.37831 12.0952 4.40611 16.225C4.43391 20.3548 7.76356 23.7324 11.9041 23.7363C13.9919 23.7363 15.8401 23.0209 17.3322 21.5428C18.8163 20.0771 19.5537 18.2853 19.5915 16.286Z" fill="#C4C7D2" />
                                <path d="M11.9987 22.2641C8.63131 22.2641 5.8855 19.5475 5.87491 16.2007C5.86432 12.8644 8.64256 10.1005 12.0027 10.1274C15.4197 10.1543 18.1033 12.8369 18.1165 16.2C18.1304 19.5455 15.3694 22.2628 11.9987 22.2641ZM7.52914 16.4843L10.4087 19.3388L16.5066 14.0531L15.5322 12.9557L10.4689 17.3533L8.54922 15.4735L7.52914 16.4843Z" fill="#C4C7D2" />
                            </g>
                            <defs>
                                <clipPath id="clip0_59_2184">
                                    <rect width="24" height="27.4286" fill="white" transform="translate(0 0.666656)" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span> Attendance </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAttendance">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.attendance.student_entry')}}" class="nav-link {{ (request()->is('admin/attendance/student_entry')) ? 'active' : '' }}">
                                    <span> Student </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.attendance.employee_entry')}}" class="nav-link {{ (request()->is('admin/attendance/employee_entry')) ? 'active' : '' }}">
                                    <span> Employee </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.attendance.employee_report')}}" class="nav-link {{ (request()->is('admin/attendance/employee/report')) ? 'active' : '' }}">
                                    <span> Employee Report</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.attendance.exam_entry')}}" class="nav-link {{ (request()->is('admin/attendance/exam_entry')) ? 'active' : '' }}">
                                    <span> Exam </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarLeaveManage" data-toggle="collapse">
                        <i data-feather="map"></i>
                        <span> Leave Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarLeaveManage">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.leave_management.allleaves')}}" class="nav-link {{ (request()->is('admin/leave_management*')) ? 'active' : '' }}">
                                    <span> All Leave</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.leave_management.applyleave')}}" class="nav-link {{ (request()->is('admin/leave_management*')) ? 'active' : '' }}">
                                    <span> Leave Apply </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.leave_management.assign_leave_approver')}}" class="nav-link {{ (request()->is('admin/leave_management*')) ? 'active' : '' }}">
                                    <span> Assign Leave Approval </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ route('admin.student_leave.list')}}" class="nav-link {{ (request()->is('admin/student_leave*')) ? 'active' : '' }}">
                        <i class="far fa-user"></i>
                        <span> Student Leave Details </span>
                    </a>
                </li>
                <li>
                    <a href="#sidebarMultilevel" data-toggle="collapse">
                        <!--<i data-feather="book"></i>-->
                        <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_59_2202)">
                                <path d="M11.6723 7.52307H23.9923C23.9923 7.57178 23.9989 7.61596 23.9989 7.66013C23.9989 11.4662 23.9989 15.2726 23.9989 19.0794C23.9989 20.1385 23.5335 20.9076 22.617 21.3754C22.2871 21.5319 21.9266 21.6068 21.5639 21.5941C15.6759 21.5941 9.78752 21.5941 3.89876 21.5941C2.87519 21.5941 2.12471 21.1149 1.67136 20.1577C1.52487 19.8286 1.45347 19.4689 1.46271 19.1065C1.46271 16.5194 1.46271 13.9318 1.46271 11.3438C1.46271 11.3098 1.46271 11.2759 1.46271 11.2306C3.31323 12.7428 5.36039 13.1902 7.58014 12.3803C9.7999 11.5704 11.1261 9.88598 11.6723 7.52307ZM5.83013 17.3213H4.96823C4.67874 17.3213 4.54109 17.4584 4.54 17.7563C4.54 18.3431 4.54 18.9302 4.54 19.5177C4.54 19.8156 4.67983 19.955 4.96713 19.9561C5.52426 19.9561 6.08247 19.9482 6.63959 19.9561C6.99462 19.964 7.10713 19.7205 7.11697 19.46C7.13881 18.8879 7.12789 18.3136 7.11697 17.7404C7.11697 17.4595 6.97059 17.3191 6.69968 17.3179C6.41347 17.3202 6.1218 17.3213 5.83013 17.3213ZM5.84105 13.5833C5.54938 13.5833 5.25771 13.5833 4.96713 13.5833C4.67656 13.5833 4.54219 13.7305 4.5411 14.0262C4.5411 14.6137 4.5411 15.2008 4.5411 15.7876C4.5411 16.0844 4.68093 16.2248 4.97041 16.226C5.52754 16.226 6.08502 16.226 6.64287 16.226C6.7062 16.2326 6.77015 16.2247 6.83025 16.203C6.89036 16.1813 6.94517 16.1463 6.99084 16.1003C7.03652 16.0543 7.07197 15.9986 7.0947 15.9369C7.11743 15.8753 7.12689 15.8093 7.12243 15.7434C7.13008 15.1612 7.12899 14.5778 7.12243 13.9956C7.12243 13.7283 6.96512 13.5844 6.70513 13.5833C6.41674 13.581 6.12945 13.5833 5.84105 13.5833ZM15.4542 9.81688C15.1712 9.81688 14.8883 9.81688 14.6054 9.81688C14.3224 9.81688 14.1771 9.96074 14.176 10.2553C14.176 10.8405 14.176 11.4265 14.176 12.0133C14.176 12.2953 14.3246 12.4517 14.5944 12.4517C15.1636 12.4517 15.7338 12.4517 16.303 12.4517C16.575 12.4517 16.7246 12.2999 16.7257 12.0189C16.7257 11.4277 16.7257 10.8367 16.7257 10.2462C16.7257 9.96301 16.5804 9.81802 16.3019 9.81688C16.0233 9.81575 15.7338 9.81688 15.452 9.81688H15.4542ZM15.4542 19.9572H16.303C16.5739 19.9572 16.7213 19.8054 16.7224 19.5223C16.7224 18.931 16.7224 18.3401 16.7224 17.7495C16.7224 17.4799 16.5804 17.3191 16.3226 17.3157C15.7404 17.3089 15.157 17.31 14.5748 17.3157C14.317 17.3157 14.175 17.4765 14.1739 17.7461C14.1739 18.3419 14.1739 18.9374 14.1739 19.5325C14.1739 19.8032 14.3279 19.955 14.5923 19.9572H15.4542ZM15.4465 16.1875C15.7338 16.1875 16.0211 16.1875 16.3073 16.1875C16.3631 16.1934 16.4194 16.1865 16.4722 16.1671C16.5251 16.1478 16.5731 16.1165 16.6128 16.0755C16.6526 16.0345 16.683 15.9849 16.702 15.9302C16.7209 15.8755 16.7279 15.8171 16.7224 15.7593C16.7224 15.165 16.7224 14.5695 16.7224 13.9729C16.7224 13.7022 16.5804 13.5516 16.3193 13.5493C15.7367 13.5493 15.1541 13.5493 14.5715 13.5493C14.3181 13.5493 14.176 13.7011 14.175 13.9673C14.175 14.5665 14.175 15.1668 14.175 15.7672C14.1711 15.8239 14.1792 15.8807 14.1986 15.9338C14.2179 15.9869 14.2482 16.035 14.2872 16.0749C14.3263 16.1147 14.3731 16.1453 14.4247 16.1645C14.4762 16.1838 14.5311 16.1912 14.5857 16.1863C14.8774 16.1886 15.1592 16.1875 15.4465 16.1875ZM20.2913 9.81688C20.0051 9.81688 19.7178 9.81688 19.4305 9.81688C19.1432 9.81688 19.0197 9.95848 19.0176 10.2417C19.0176 10.8367 19.0176 11.4322 19.0176 12.028C19.0176 12.3089 19.1596 12.4517 19.4294 12.4517C20.004 12.4517 20.5782 12.4517 21.1521 12.4517C21.2078 12.457 21.264 12.4495 21.3165 12.4296C21.3691 12.4097 21.4167 12.378 21.456 12.3367C21.4953 12.2954 21.5253 12.2456 21.5437 12.1908C21.5622 12.1361 21.5687 12.0778 21.5628 12.0201C21.5628 11.4295 21.5628 10.8386 21.5628 10.2473C21.5628 9.97207 21.4176 9.81915 21.1532 9.81688C20.8659 9.81462 20.5786 9.81688 20.2913 9.81688ZM20.2913 16.1875H21.1401C21.4176 16.1875 21.565 16.0334 21.5661 15.7434C21.5661 15.1567 21.5661 14.5699 21.5661 13.9843C21.5661 13.7067 21.4252 13.5516 21.1587 13.5504C20.5811 13.5459 20.0025 13.5459 19.4228 13.5504C19.1596 13.5504 19.023 13.6965 19.0208 13.9741C19.0208 14.5737 19.0208 15.1736 19.0208 15.774C19.0208 16.0425 19.1694 16.1875 19.4305 16.1886C19.7145 16.1886 20.0018 16.1875 20.288 16.1875H20.2913ZM10.6574 19.9606C10.9436 19.9606 11.2309 19.9606 11.5182 19.9606C11.5718 19.9651 11.6256 19.9576 11.6761 19.9387C11.7266 19.9197 11.7725 19.8897 11.8109 19.8507C11.8492 19.8117 11.879 19.7646 11.8982 19.7127C11.9175 19.6607 11.9257 19.605 11.9224 19.5494C11.9268 18.94 11.9268 18.331 11.9224 17.7223C11.9263 17.6688 11.9188 17.615 11.9006 17.5647C11.8824 17.5144 11.8539 17.4688 11.817 17.4311C11.7801 17.3933 11.7357 17.3644 11.687 17.3462C11.6382 17.3281 11.5862 17.3211 11.5346 17.3259C10.9426 17.3259 10.3505 17.3259 9.75839 17.3259C9.70916 17.321 9.65949 17.3271 9.61271 17.3437C9.56593 17.3603 9.52312 17.3871 9.48713 17.4223C9.45114 17.4575 9.42281 17.5002 9.40403 17.5477C9.38525 17.5951 9.37646 17.6462 9.37824 17.6974C9.37169 18.3204 9.37059 18.9434 9.37824 19.5653C9.37824 19.8213 9.53335 19.9572 9.78242 19.9595C10.0708 19.9606 10.3658 19.9606 10.6574 19.9606ZM20.2836 19.9606H21.1456C21.4143 19.9606 21.5618 19.8054 21.5628 19.5223C21.5628 18.9355 21.5628 18.3499 21.5628 17.7631C21.5628 17.4777 21.4197 17.327 21.1466 17.3259C20.572 17.3259 19.9974 17.3259 19.4239 17.3259C19.1639 17.3259 19.0208 17.4618 19.0187 17.728C19.0132 18.3374 19.0187 18.9457 19.0187 19.5551C19.0187 19.8179 19.1661 19.9584 19.4217 19.9606C19.709 19.9606 19.9963 19.9606 20.2836 19.9606ZM9.37605 14.8961C9.37631 15.2362 9.50559 15.5625 9.73595 15.8046C9.96631 16.0466 10.2793 16.185 10.6072 16.1897C11.3238 16.1999 11.882 15.6585 11.8897 14.9437C11.8992 14.7687 11.8746 14.5935 11.8173 14.4286C11.7601 14.2638 11.6714 14.1125 11.5565 13.984C11.4416 13.8554 11.3029 13.7522 11.1487 13.6805C10.9945 13.6088 10.8279 13.5701 10.6589 13.5667C10.4899 13.5633 10.322 13.5952 10.1652 13.6606C10.0084 13.726 9.86591 13.8235 9.74626 13.9472C9.62661 14.071 9.53226 14.2186 9.46884 14.381C9.40542 14.5435 9.37423 14.7175 9.37715 14.8927L9.37605 14.8961Z" fill="#C4C7D2" />
                                <path d="M18.1436 2.78145C18.1436 2.37026 18.1436 1.98852 18.1436 1.59546C18.1436 1.35305 18.2813 1.1922 18.4877 1.17861C18.5398 1.17067 18.593 1.17481 18.6434 1.19073C18.6937 1.20665 18.7401 1.23396 18.7791 1.27068C18.818 1.30741 18.8487 1.35264 18.8687 1.40312C18.8888 1.4536 18.8979 1.50807 18.8952 1.56261C18.8952 1.95907 18.8952 2.35553 18.8952 2.77578H19.0503C19.969 2.77578 20.8877 2.77578 21.8065 2.77578C22.3096 2.76976 22.7989 2.94607 23.19 3.27428C23.5811 3.60248 23.8494 4.06198 23.9486 4.57345C23.978 4.72257 23.993 4.87435 23.9934 5.02655C23.9934 5.56348 23.9934 6.10153 23.9934 6.63845C23.9934 6.66451 23.9934 6.69056 23.9869 6.72568H11.7302C11.7841 6.0372 11.7224 5.34425 11.5477 4.67767C11.3769 4.00712 11.1103 3.36684 10.7568 2.77805L18.1436 2.78145Z" fill="#C4C7D2" />
                                <path d="M5.51009 0.590698C8.5273 0.590698 11.0202 3.14618 11.0278 6.2601C11.0298 7.77723 10.4506 9.23307 9.41743 10.3073C8.3843 11.3816 6.98193 11.9863 5.51883 11.9884C4.05573 11.9905 2.65176 11.3898 1.61576 10.3185C0.579756 9.24726 -0.00339827 7.79309 -0.00542638 6.27595C-0.00979597 3.16543 2.4765 0.600893 5.51009 0.590698ZM9.41542 6.3122C9.40998 5.24292 8.99815 4.21899 8.26928 3.46257C7.54041 2.70614 6.5533 2.27824 5.52211 2.27169C4.4936 2.27169 3.50721 2.69536 2.77994 3.44949C2.05267 4.20362 1.64409 5.22644 1.64409 6.29295C1.64409 7.35945 2.05267 8.38227 2.77994 9.1364C3.50721 9.89053 4.4936 10.3142 5.52211 10.3142C7.65993 10.3063 9.41542 8.50973 9.41542 6.3122Z" fill="#C4C7D2" />
                                <path d="M5.39756 6.38353H5.55814C6.04535 6.38353 6.53256 6.38353 7.01977 6.38353C7.27211 6.38353 7.42287 6.53645 7.42396 6.7766C7.42506 7.01674 7.27431 7.1606 7.0176 7.1606C6.36216 7.1606 5.70672 7.1606 5.05128 7.1606C4.7891 7.1606 4.65583 7.0258 4.65583 6.75394C4.65583 6.06296 4.65583 5.37274 4.65583 4.68328C4.6549 4.6327 4.66358 4.58243 4.68138 4.53533C4.69918 4.48824 4.72576 4.44524 4.75959 4.40879C4.79342 4.37234 4.83384 4.34316 4.87855 4.32292C4.92326 4.30267 4.97137 4.29175 5.02014 4.29078C5.06892 4.28981 5.11739 4.29882 5.16281 4.31728C5.20823 4.33574 5.2497 4.3633 5.28485 4.39838C5.32 4.43346 5.34814 4.47537 5.36766 4.52173C5.38719 4.56808 5.39772 4.61798 5.39865 4.66855C5.40521 5.17829 5.39865 5.68803 5.39865 6.19776L5.39756 6.38353Z" fill="#C4C7D2" />
                            </g>
                            <defs>
                                <clipPath id="clip0_59_2202">
                                    <rect width="24" height="21" fill="white" transform="translate(0 0.595215)" />
                                </clipPath>
                            </defs>
                        </svg>
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
                                            <a href="{{ route('admin.exam_term')}}" class="nav-link {{ (request()->is('admin/exam_term/index')) ? 'active' : '' }}">
                                                <span>Exam Term</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.exam_hall')}}" class="nav-link {{ (request()->is('admin/exam_hall/index')) ? 'active' : '' }}">
                                                <span>Exam Hall</span>
                                            </a>
                                        </li>
                                        <!-- <li>
                                            <a href="{{ route('admin.exam.mark_distribution')}}" class="nav-link {{ (request()->is('admin/exam/mark_distribution')) ? 'active' : '' }}">
                                                <span>Distribution</span>
                                            </a>
                                        </li> -->
                                        <li>
                                            <a href="{{ route('admin.exam')}}" class="nav-link {{ (request()->is('admin/exam/index')) ? 'active' : '' }}">
                                                <span>Exam Setup</span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarSchedule" data-toggle="collapse">
                                    <i class="fas fa-dna"></i> &nbsp;
                                    Exam Schedule <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarSchedule">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('admin.timetable.viewexam')}}" class="nav-link {{ (request()->is('admin/exam/timetable')) ? 'active' : '' }}">
                                                <span>Schedule</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.timetable.set_examwise')}}" class="nav-link {{ (request()->is('admin/exam/set_examwise')) ? 'active' : '' }}">
                                                <span>Add Schedule</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarMarks" data-toggle="collapse">
                                    <i class="fas fa-marker"></i> &nbsp;
                                    Marks <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarMarks">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('admin.exam.grade')}}" class="nav-link {{ (request()->is('admin/exam/set_examwise')) ? 'active' : '' }}">
                                                <span>Grade Range</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="{{ route('admin.test_result')}}" class="nav-link {{ (request()->is('admin/test_result*')) ? 'active' : '' }}">
                                    <i class="fas fa-marker"></i> &nbsp;
                                    <span> Test Result </span>
                                </a>
                            </li>
                            <li>
                                <a href="#sidebarResult" data-toggle="collapse">
                                    <i data-feather="book-open" class="icons-xs icon-dual"></i> &nbsp;
                                    Exam Results<span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarResult">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('admin.exam_results.byclass')}}" class="nav-link {{ (request()->is('admin/exam_results')) ? 'active' : '' }}">
                                                <span>By Class</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.exam_results.bysubject')}}" class="nav-link {{ (request()->is('admin/exam_results')) ? 'active' : '' }}">
                                                <span>By Subject</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.exam_results.bystudent')}}" class="nav-link {{ (request()->is('admin/exam_results')) ? 'active' : '' }}">
                                                <span>By Student</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.exam_results.overall')}}" class="nav-link {{ (request()->is('admin/exam_results')) ? 'active' : '' }}">
                                                <span>Overall</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.exam.result')}}" class="nav-link {{ (request()->is('admin/exam*')) ? 'active' : '' }}">
                                                <span>Individual Result </span>
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
                        <!-- <i data-feather="share-2"></i>-->
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_59_2212)">
                                <path d="M15.3399 17.0057C15.2446 16.9451 15.158 16.899 15.0772 16.8413C14.7712 16.6105 14.4681 16.374 14.1592 16.1433C14.134 16.1291 14.1061 16.1202 14.0773 16.1172C14.0485 16.1142 14.0194 16.1172 13.9918 16.126C13.8099 16.1923 13.6367 16.2817 13.452 16.3452C13.4169 16.3552 13.3861 16.3764 13.3642 16.4056C13.3424 16.4348 13.3306 16.4703 13.3307 16.5067C13.2759 16.9105 13.2182 17.3143 13.1604 17.7181C13.1316 17.92 13.0594 17.9834 12.8516 17.9834H11.1195C10.9059 17.9834 10.8309 17.9171 10.8107 17.695C10.7529 17.2826 10.6923 16.8701 10.6288 16.4605C10.6228 16.4373 10.612 16.4155 10.5971 16.3966C10.5821 16.3778 10.5635 16.3622 10.5422 16.3509C10.3488 16.2644 10.1525 16.1808 9.96486 16.1087C9.93861 16.1044 9.91175 16.1056 9.88595 16.112C9.86014 16.1185 9.83592 16.1301 9.81475 16.1462C9.49144 16.3856 9.17102 16.6307 8.84771 16.873C8.67163 17.0057 8.60234 16.9999 8.44935 16.847C8.02982 16.4317 7.6122 16.0144 7.19651 15.5953C7.05795 15.4568 7.05795 15.3905 7.17631 15.2319C7.42456 14.903 7.67572 14.5771 7.91532 14.2425C7.93196 14.2173 7.94312 14.1889 7.94809 14.1591C7.95306 14.1293 7.95173 14.0988 7.94418 14.0695C7.87778 13.8849 7.78829 13.7118 7.7219 13.5272C7.71302 13.4942 7.69353 13.465 7.6664 13.4442C7.63927 13.4233 7.60603 13.412 7.5718 13.4119L6.34783 13.2388C6.15153 13.21 6.08803 13.1379 6.08514 12.9504V11.2054C6.08514 11.0006 6.15443 10.9314 6.35649 10.917C6.76352 10.8593 7.17054 10.7958 7.57756 10.7439C7.61242 10.7418 7.6458 10.7291 7.67316 10.7074C7.70053 10.6858 7.72057 10.6562 7.73056 10.6228C7.79985 10.444 7.86624 10.2651 7.94418 10.095C7.96142 10.0646 7.96795 10.0293 7.96271 9.9948C7.95748 9.96028 7.94079 9.92851 7.91532 9.90461C7.67283 9.58734 7.43324 9.27007 7.19364 8.94991C7.05508 8.76821 7.05796 8.69898 7.21672 8.54034L8.46956 7.28857C8.60235 7.15878 8.68027 7.15878 8.83616 7.28857C9.16235 7.5395 9.48856 7.78755 9.82342 8.02983C9.84975 8.04525 9.87901 8.05501 9.90933 8.05848C9.93965 8.06196 9.97036 8.05908 9.9995 8.05002C10.1843 7.98368 10.3575 7.89427 10.5393 7.82793C10.5704 7.81994 10.5982 7.80217 10.6184 7.77725C10.6387 7.75233 10.6504 7.72156 10.6519 7.68949C10.7067 7.27992 10.7674 6.87324 10.8251 6.46367C10.854 6.25889 10.9232 6.19543 11.1138 6.19543H12.8602C13.0623 6.19543 13.1287 6.26177 13.1489 6.48386C13.2066 6.89054 13.2701 7.29722 13.325 7.70679C13.3263 7.73924 13.3379 7.77043 13.3581 7.79585C13.3784 7.82126 13.4062 7.83957 13.4376 7.84812C13.6165 7.92023 13.7984 7.98656 13.9774 8.06732C14.0058 8.08293 14.0384 8.08911 14.0706 8.08496C14.1028 8.08081 14.1328 8.06656 14.1564 8.04425C14.4768 7.7962 14.7972 7.55681 15.1205 7.31453C15.3024 7.17609 15.3688 7.18186 15.5304 7.34337C15.9422 7.75294 16.3531 8.16347 16.763 8.57496C16.9131 8.72494 16.916 8.79416 16.789 8.96145C16.5408 9.28737 16.2896 9.6133 16.0471 9.94499C16.0324 9.96998 16.023 9.99773 16.0195 10.0265C16.0161 10.0553 16.0186 10.0845 16.0269 10.1123C16.0933 10.294 16.1857 10.467 16.2492 10.6516C16.2584 10.6872 16.2794 10.7185 16.3087 10.7405C16.3381 10.7626 16.3742 10.7739 16.4109 10.7728L17.6204 10.9429C17.8253 10.9747 17.886 11.0439 17.886 11.2516C17.886 11.8284 17.886 12.4053 17.886 12.9821C17.886 13.1956 17.8225 13.2705 17.5973 13.2907C17.1874 13.3484 16.7746 13.409 16.3647 13.4724C16.341 13.4786 16.3189 13.4894 16.2996 13.5043C16.2802 13.5191 16.2641 13.5377 16.2521 13.559C16.1655 13.7522 16.0847 13.9484 16.0125 14.1358C16.0044 14.1884 16.0168 14.2421 16.0471 14.2858C16.2867 14.6089 16.5321 14.929 16.7746 15.2492C16.916 15.4366 16.9102 15.4914 16.7428 15.6587C16.3291 16.0741 15.9143 16.4875 15.4987 16.899C15.4485 16.9385 15.3955 16.9742 15.3399 17.0057ZM9.783 12.1024C9.78358 12.5409 9.91438 12.9693 10.1588 13.3335C10.4033 13.6976 10.7504 13.9811 11.1563 14.1479C11.5621 14.3148 12.0083 14.3576 12.4385 14.2709C12.8687 14.1841 13.2634 13.9718 13.5727 13.6607C13.882 13.3497 14.092 12.9539 14.176 12.5235C14.26 12.0931 14.2142 11.6475 14.0446 11.2432C13.8749 10.8388 13.589 10.4938 13.223 10.2519C12.8569 10.01 12.4273 9.88213 11.9884 9.88441C11.6976 9.88441 11.4096 9.94188 11.1411 10.0535C10.8726 10.1652 10.6288 10.3288 10.4238 10.5349C10.2189 10.7411 10.0567 10.9857 9.94672 11.2547C9.83674 11.5237 9.7811 11.8118 9.783 12.1024Z" fill="#C4C7D2" />
                                <path d="M12.4792 22.4858C12.6841 22.2781 12.8545 22.0993 13.0334 21.9291C13.0768 21.8781 13.13 21.8363 13.1899 21.8063C13.2499 21.7764 13.3152 21.7588 13.3821 21.7548C13.449 21.7507 13.516 21.7603 13.5791 21.7828C13.6422 21.8053 13.7001 21.8404 13.7493 21.8859C13.8428 21.9621 13.9024 22.072 13.9154 22.1918C13.9283 22.3116 13.8936 22.4318 13.8186 22.5262C13.3394 23.0165 12.8583 23.503 12.3753 23.9856C12.2948 24.064 12.1879 24.1093 12.0755 24.1125C11.9632 24.1157 11.8538 24.0766 11.7691 24.0029C11.7261 23.9714 11.6855 23.9367 11.6478 23.8991C11.2264 23.478 10.8049 23.0626 10.3892 22.6358C10.3004 22.5451 10.235 22.4343 10.1987 22.3127C10.1743 22.2196 10.1835 22.1209 10.2246 22.0338C10.2658 21.9468 10.3363 21.8771 10.4238 21.8368C10.513 21.7857 10.6168 21.7661 10.7184 21.7813C10.8201 21.7965 10.9136 21.8455 10.9839 21.9205C11.1484 22.0762 11.3072 22.2406 11.466 22.3993L11.5814 22.5089V19.6563C11.5763 19.5694 11.5972 19.483 11.6414 19.408C11.6856 19.333 11.7511 19.2729 11.8297 19.2352C11.9 19.1966 11.9799 19.1785 12.06 19.1831C12.1402 19.1877 12.2174 19.2147 12.2829 19.2612C12.3523 19.3054 12.4083 19.3678 12.4449 19.4414C12.4815 19.5151 12.4974 19.5974 12.4907 19.6794C12.4907 20.5447 12.4907 21.4273 12.4907 22.3012L12.4792 22.4858Z" fill="#C4C7D2" />
                                <path d="M19.6699 5.08502L19.5458 5.19751C18.9281 5.81666 18.3094 6.43486 17.6897 7.05209C17.6341 7.11284 17.5642 7.15881 17.4864 7.18585C17.4086 7.2129 17.3252 7.22016 17.2439 7.207C17.1626 7.19384 17.0858 7.16066 17.0205 7.11045C16.9552 7.06025 16.9034 6.9946 16.8698 6.91941C16.8308 6.81897 16.8252 6.70865 16.8538 6.60477C16.8824 6.50088 16.9437 6.40895 17.0286 6.34256C17.6387 5.7311 18.2478 5.12251 18.8559 4.51682C18.8924 4.48547 18.931 4.45656 18.9714 4.43029L18.9512 4.39568C18.9165 4.39568 18.879 4.39568 18.8415 4.39568C18.5961 4.39568 18.3536 4.39568 18.1082 4.39568C17.9943 4.39276 17.8859 4.34624 17.8053 4.26573C17.7247 4.18522 17.6782 4.07686 17.6752 3.96304C17.6696 3.90416 17.6763 3.84477 17.6949 3.78862C17.7135 3.73247 17.7436 3.68079 17.7832 3.63686C17.8228 3.59293 17.8711 3.55771 17.9251 3.53342C17.9791 3.50914 18.0375 3.49632 18.0967 3.49579C18.7818 3.49579 19.4659 3.49579 20.1491 3.49579C20.206 3.49615 20.2622 3.50785 20.3144 3.53019C20.3667 3.55253 20.414 3.58507 20.4535 3.6259C20.493 3.66673 20.524 3.71503 20.5446 3.76796C20.5652 3.8209 20.575 3.87742 20.5735 3.9342C20.5735 4.60335 20.5735 5.27538 20.5735 5.95319C20.5739 6.01324 20.5622 6.07277 20.5389 6.12815C20.5157 6.18354 20.4814 6.23365 20.4383 6.27543C20.3951 6.31722 20.3439 6.34983 20.2877 6.37128C20.2316 6.39274 20.1717 6.40259 20.1116 6.40025C20.0515 6.39915 19.9922 6.38603 19.9372 6.36165C19.8822 6.33727 19.8326 6.30213 19.7915 6.25831C19.7503 6.21449 19.7183 6.16287 19.6975 6.1065C19.6766 6.05013 19.6672 5.99015 19.6699 5.93011C19.6699 5.6561 19.6699 5.38498 19.6699 5.08502Z" fill="#C4C7D2" />
                                <path d="M5.01708 19.7775H5.86577C5.95552 19.7734 6.04427 19.7976 6.11942 19.8468C6.19456 19.896 6.25227 19.9676 6.28435 20.0515C6.32481 20.1341 6.33683 20.2279 6.31857 20.3181C6.3003 20.4083 6.25277 20.49 6.18332 20.5504C6.09627 20.6241 5.98819 20.6685 5.87444 20.6773C5.20665 20.6773 4.54078 20.6773 3.87684 20.6773C3.8154 20.6798 3.75413 20.6695 3.69693 20.647C3.63972 20.6244 3.58785 20.5902 3.54465 20.5465C3.50144 20.5028 3.46785 20.4505 3.44602 20.3931C3.42418 20.3357 3.41459 20.2743 3.41786 20.213C3.41786 19.5554 3.41786 18.8987 3.41786 18.243C3.41786 18.1836 3.42958 18.1247 3.45236 18.0697C3.47513 18.0148 3.50852 17.9649 3.5506 17.9228C3.59269 17.8808 3.64265 17.8474 3.69763 17.8247C3.75262 17.8019 3.81156 17.7902 3.87107 17.7902C3.93059 17.7902 3.98951 17.8019 4.0445 17.8247C4.09948 17.8474 4.14946 17.8808 4.19155 17.9228C4.23363 17.9649 4.26701 18.0148 4.28979 18.0697C4.31257 18.1247 4.32429 18.1836 4.32429 18.243C4.32429 18.5113 4.32429 18.7766 4.32429 19.042V19.0622L4.4282 18.967C5.04596 18.3497 5.66467 17.7315 6.28435 17.1124C6.33922 17.0496 6.40927 17.002 6.48781 16.974C6.56636 16.946 6.65079 16.9386 6.73302 16.9525C6.81525 16.9664 6.89254 17.0011 6.95752 17.0533C7.0225 17.1056 7.07298 17.1736 7.10416 17.2508C7.14334 17.3515 7.14876 17.4622 7.11961 17.5662C7.09046 17.6702 7.02831 17.762 6.94251 17.8277L5.11524 19.6534L5.01708 19.7775Z" fill="#C4C7D2" />
                                <path d="M1.58769 11.6323H4.44264C4.53888 11.6297 4.63342 11.658 4.71239 11.713C4.79136 11.768 4.8506 11.8469 4.88142 11.938C4.91459 12.0278 4.91699 12.1261 4.88826 12.2174C4.85953 12.3088 4.80127 12.388 4.72264 12.4427C4.62979 12.5005 4.52315 12.5324 4.41378 12.535C3.53045 12.535 2.64711 12.535 1.76378 12.535H1.59058L1.70028 12.6562C1.87348 12.8321 2.05534 13.0023 2.21988 13.1898C2.29859 13.275 2.3423 13.3867 2.3423 13.5027C2.3423 13.6187 2.29859 13.7304 2.21988 13.8157C2.13111 13.9011 2.01265 13.9489 1.88937 13.9489C1.76608 13.9489 1.6476 13.9011 1.55883 13.8157C1.08926 13.3522 0.621623 12.885 0.155902 12.4139C0.108463 12.3717 0.0704932 12.3199 0.0444972 12.262C0.0185013 12.2041 0.00506592 12.1413 0.00506592 12.0779C0.00506592 12.0144 0.0185013 11.9517 0.0444972 11.8937C0.0704932 11.8358 0.108463 11.7841 0.155902 11.7419C0.604303 11.2919 1.0527 10.8429 1.5011 10.3949C1.54289 10.3485 1.59363 10.3109 1.65028 10.2845C1.70693 10.2581 1.76833 10.2434 1.8308 10.2413C1.89327 10.2392 1.95552 10.2496 2.01384 10.2721C2.07217 10.2946 2.12536 10.3285 2.17023 10.372C2.2151 10.4155 2.25075 10.4676 2.27501 10.5251C2.29927 10.5827 2.31166 10.6445 2.31145 10.707C2.31123 10.7694 2.2984 10.8312 2.27374 10.8886C2.24908 10.946 2.21309 10.9978 2.16792 11.041C2.01781 11.2025 1.85616 11.3554 1.70028 11.514C1.66852 11.5429 1.63965 11.5775 1.58769 11.6323Z" fill="#C4C7D2" />
                                <path d="M11.5179 1.69888L10.9724 2.24689C10.9234 2.30678 10.8611 2.35441 10.7904 2.38595C10.7197 2.4175 10.6427 2.43211 10.5653 2.4286C10.4773 2.42741 10.3917 2.39906 10.3204 2.34743C10.2491 2.2958 10.1955 2.22341 10.167 2.14017C10.1297 2.05888 10.118 1.96818 10.1335 1.88011C10.1489 1.79203 10.1908 1.71072 10.2536 1.64696C10.3864 1.5114 10.5249 1.37872 10.6577 1.24316L11.6392 0.265397C11.6824 0.21129 11.7373 0.167608 11.7998 0.137588C11.8623 0.107568 11.9307 0.09198 12 0.09198C12.0693 0.09198 12.1378 0.107568 12.2002 0.137588C12.2627 0.167608 12.3176 0.21129 12.3609 0.265397C12.7881 0.695153 13.2269 1.13068 13.6397 1.56332C13.7211 1.64899 13.7788 1.75435 13.8071 1.86905C13.8322 1.95994 13.8243 2.05679 13.7846 2.14237C13.745 2.22794 13.6762 2.29666 13.5906 2.3363C13.5007 2.39226 13.3942 2.41563 13.2891 2.4025C13.184 2.38937 13.0866 2.34054 13.0132 2.2642C12.8516 2.11133 12.6986 1.94981 12.5427 1.79406C12.5081 1.75945 12.4792 1.71907 12.4474 1.68157H12.4099V1.81425C12.4099 2.7228 12.4099 3.63134 12.4099 4.53988C12.4147 4.65687 12.3737 4.77112 12.2955 4.85837C12.2174 4.94561 12.1083 4.99898 11.9914 5.00714C11.8843 5.01274 11.7785 4.98142 11.6918 4.91841C11.6051 4.8554 11.5427 4.76453 11.5151 4.66102C11.5093 4.59963 11.5093 4.53783 11.5151 4.47643V1.68157L11.5179 1.69888Z" fill="#C4C7D2" />
                                <path d="M4.94777 4.41586C5.52511 4.99271 6.08513 5.56957 6.64226 6.10893C6.74618 6.21276 6.85011 6.31371 6.95114 6.42043C7.03797 6.50403 7.09007 6.61728 7.09703 6.73757C7.10398 6.85786 7.06529 6.97634 6.98867 7.06939C6.90735 7.15865 6.79462 7.21301 6.67408 7.22108C6.55354 7.22914 6.43456 7.19029 6.34205 7.11265C6.30297 7.08394 6.26629 7.05211 6.23236 7.01747L4.41374 5.20038L4.2896 5.08213C4.2896 5.37055 4.2896 5.6186 4.2896 5.87242C4.29946 5.96329 4.2826 6.05507 4.24107 6.13652C4.19954 6.21797 4.13515 6.28556 4.05577 6.33101C3.96917 6.3777 3.87074 6.39795 3.77272 6.38923C3.6747 6.38052 3.58141 6.34322 3.50442 6.28198C3.46089 6.24239 3.4259 6.19435 3.40158 6.14079C3.37726 6.08723 3.36413 6.02928 3.36298 5.97048C3.36298 5.29845 3.36298 4.62353 3.36298 3.95149C3.36289 3.8923 3.37488 3.83372 3.39821 3.77932C3.42155 3.72491 3.45574 3.67584 3.4987 3.63508C3.54165 3.59432 3.59247 3.56273 3.64805 3.54226C3.70363 3.52178 3.7628 3.51283 3.82195 3.51597C4.48301 3.51597 5.14406 3.51597 5.80511 3.51597C5.86748 3.51098 5.93021 3.51895 5.98934 3.53938C6.04847 3.5598 6.10271 3.59223 6.14868 3.63463C6.19465 3.67704 6.23133 3.72849 6.25642 3.78575C6.28151 3.84301 6.29448 3.90485 6.29448 3.96736C6.29448 4.02986 6.28151 4.0917 6.25642 4.14896C6.23133 4.20622 6.19465 4.25767 6.14868 4.30008C6.10271 4.34248 6.04847 4.37491 5.98934 4.39533C5.93021 4.41576 5.86748 4.42373 5.80511 4.41874C5.5251 4.41874 5.26242 4.41586 4.94777 4.41586Z" fill="#C4C7D2" />
                                <path d="M19.0435 19.7515L18.4864 19.2006L17.043 17.7585C16.9816 17.7063 16.9349 17.639 16.9075 17.5632C16.8802 17.4874 16.8731 17.4058 16.8872 17.3265C16.9012 17.2472 16.9357 17.1729 16.9874 17.111C17.039 17.0492 17.106 17.0019 17.1816 16.9739C17.2782 16.9385 17.3835 16.9344 17.4826 16.9624C17.5816 16.9904 17.6692 17.0489 17.733 17.1297L19.5689 18.9641C19.6007 18.9987 19.6237 19.042 19.6526 19.0795L19.6959 19.0593V18.2574C19.6924 18.1841 19.7065 18.1109 19.7372 18.0442C19.7678 17.9774 19.8141 17.919 19.872 17.8738C19.956 17.8146 20.0557 17.7817 20.1585 17.7791C20.2613 17.7765 20.3625 17.8045 20.4493 17.8594C20.5102 17.8926 20.5596 17.9434 20.5911 18.0052C20.6225 18.067 20.6345 18.1368 20.6254 18.2055C20.6254 18.8747 20.6254 19.5477 20.6254 20.2245C20.6262 20.2825 20.6153 20.3401 20.5933 20.3939C20.5714 20.4476 20.5388 20.4964 20.4976 20.5373C20.4564 20.5782 20.4074 20.6104 20.3535 20.632C20.2996 20.6536 20.2419 20.6641 20.1838 20.6629C19.5112 20.6629 18.8357 20.6629 18.1631 20.6629C18.0495 20.6519 17.9442 20.5985 17.8683 20.5133C17.7924 20.4282 17.7515 20.3175 17.7537 20.2035C17.7559 20.0895 17.801 19.9805 17.8801 19.8983C17.9592 19.8161 18.0665 19.7668 18.1804 19.7601C18.4546 19.7486 18.7289 19.7515 19.0435 19.7515Z" fill="#C4C7D2" />
                                <path d="M22.4239 12.512H19.5747C19.4571 12.5169 19.3422 12.4759 19.2543 12.3977C19.1664 12.3194 19.1124 12.2101 19.1038 12.0928C19.0951 11.9755 19.1325 11.8594 19.208 11.7691C19.2835 11.6789 19.3912 11.6215 19.5083 11.6092C19.6584 11.6092 19.797 11.6092 19.9615 11.6092H22.3719C22.3373 11.5689 22.3171 11.54 22.2911 11.5141C22.1265 11.3468 21.962 11.1766 21.7946 11.0122C21.7085 10.9243 21.6603 10.8063 21.6603 10.6834C21.6603 10.5605 21.7085 10.4424 21.7946 10.3546C21.8883 10.2681 22.0124 10.222 22.1399 10.2264C22.2675 10.2307 22.3881 10.285 22.4758 10.3777C22.9204 10.8363 23.3794 11.2833 23.8297 11.7361C23.8819 11.7769 23.9241 11.829 23.9531 11.8884C23.9822 11.9479 23.9973 12.0132 23.9973 12.0794C23.9973 12.1455 23.9822 12.2108 23.9531 12.2703C23.9241 12.3298 23.8819 12.3819 23.8297 12.4226C23.3948 12.8629 22.955 13.3013 22.5105 13.7378C22.4602 13.8019 22.3939 13.8517 22.3183 13.8821C22.2427 13.9126 22.1604 13.9226 22.0796 13.9112C21.9989 13.8998 21.9226 13.8674 21.8584 13.8172C21.7942 13.767 21.7443 13.7009 21.7137 13.6253C21.678 13.5366 21.6702 13.4391 21.6913 13.3458C21.7124 13.2526 21.7616 13.1679 21.8321 13.1033L22.4239 12.512Z" fill="#C4C7D2" />
                            </g>
                            <defs>
                                <clipPath id="clip0_59_2212">
                                    <rect width="24" height="24" fill="white" transform="translate(0 0.0952148)" />
                                </clipPath>
                            </defs>
                        </svg>
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
                                            <a href="{{ route('admin.hostel')}}" class="nav-link {{ (request()->is('admin/hostel')) ? 'active' : '' }}">
                                                <span> Hostel Master </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.hostel_room')}}" class="nav-link {{ (request()->is('admin/hostel/room')) ? 'active' : '' }}">
                                                <span> Hostel Room </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.hostel_category')}}" class="nav-link {{ (request()->is('admin/hostel/category')) ? 'active' : '' }}">
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
                                            <a href="{{ route('admin.transport_route')}}" class="nav-link {{ (request()->is('admin/transport_route')) ? 'active' : '' }}">
                                                <span> Route Master </span>
                                            </a>
                                        </li>
                                        <!-- <li>
                                            <a href="" class="nav-link {{ (request()->is('')) ? 'active' : '' }}">
                                                <span> Vehicle Master</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="nav-link {{ (request()->is('')) ? 'active' : '' }}">
                                                <span> Stoppage</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="nav-link {{ (request()->is('')) ? 'active' : '' }}">
                                                <span> Assign Vehicle</span>
                                            </a>
                                        </li> -->
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- <li>
                    <a href="#sidebarLibrary" data-toggle="collapse">
                        <i class="fe-book-open"></i>
                        <span> Library </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarLibrary">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.library.book')}}" class="nav-link {{ (request()->is('admin/book')) ? 'active' : '' }}">
                                    <span>Book</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.library.bookcategory')}}" class="nav-link {{ (request()->is('admin/bookcategory')) ? 'active' : '' }}">
                                    <span>Book Category</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.library.issuedbook')}}" class="nav-link {{ (request()->is('admin/issuedbook')) ? 'active' : '' }}">
                                    <span>My Issued Book</span>
                                </a>
                            </li> 
                            <li>
                                <a href="{{ route('admin.library.issuereturn')}}" class="nav-link {{ (request()->is('admin/book')) ? 'active' : '' }}">
                                    <span>Book Issue/Return</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li>
                    <a href="#sidebarEvents" data-toggle="collapse">
                        <!--<i class="fas fa-map"></i>-->
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_59_2234)">
                                <path d="M2.28743e-05 9.70142H24V22.9527C24.0181 23.3693 23.8836 23.7787 23.6202 24.1096C23.3568 24.4406 22.9811 24.6719 22.5587 24.7634C22.4013 24.7961 22.2405 24.8115 22.0795 24.8095H1.92449C1.49161 24.8273 1.06609 24.6975 0.722831 24.443C0.379572 24.1884 0.140584 23.8254 0.0479331 23.4179C0.014236 23.2715 -0.00183866 23.1219 2.28743e-05 22.972V9.70142ZM12.0819 11.5736C11.9309 11.5694 11.7821 11.6094 11.6552 11.6884C11.5283 11.7673 11.4293 11.8814 11.3712 12.0157C11.0118 12.7115 10.6445 13.4035 10.2892 14.0993C10.2291 14.2268 10.135 14.3366 10.0164 14.4176C9.89789 14.4987 9.75917 14.548 9.61439 14.5606L7.30263 14.8797C7.15318 14.8875 7.0099 14.9397 6.89261 15.0292C6.77532 15.1187 6.68979 15.2411 6.64783 15.3795C6.60182 15.5152 6.59929 15.6611 6.64059 15.7982C6.6819 15.9354 6.76511 16.0573 6.87941 16.1483C7.44637 16.6635 8.00534 17.1863 8.56831 17.686C8.68001 17.7795 8.76345 17.9003 8.80983 18.0356C8.85621 18.1709 8.86381 18.3158 8.83183 18.4549C8.69209 19.2238 8.55633 19.9926 8.43256 20.7615C8.40654 20.9234 8.43013 21.089 8.50044 21.2382C8.54584 21.3271 8.61036 21.4058 8.68971 21.4689C8.76906 21.532 8.86143 21.5782 8.96071 21.6044C9.05999 21.6305 9.16391 21.6361 9.26559 21.6207C9.36727 21.6053 9.46439 21.5692 9.55051 21.515C10.2412 21.1651 10.932 20.8191 11.6147 20.4616C11.7538 20.3825 11.9124 20.3407 12.0739 20.3407C12.2354 20.3407 12.394 20.3825 12.533 20.4616C13.2038 20.8102 13.8786 21.1536 14.5573 21.4919C14.6653 21.5505 14.7852 21.5859 14.9087 21.5957C15.0277 21.6049 15.1472 21.586 15.2569 21.5407C15.3666 21.4953 15.4632 21.4249 15.5383 21.3356C15.6134 21.2462 15.6648 21.1406 15.688 21.0279C15.7111 20.9151 15.7054 20.7986 15.6713 20.6884C15.5475 19.9696 15.4277 19.2468 15.272 18.5318C15.2324 18.3737 15.239 18.2081 15.2911 18.0533C15.3433 17.8986 15.4389 17.7608 15.5675 17.6553C16.1344 17.1478 16.6854 16.625 17.2444 16.1176C17.3417 16.0419 17.4174 15.9436 17.4642 15.8319C17.511 15.7202 17.5274 15.5989 17.5119 15.4794C17.4923 15.3006 17.4048 15.1351 17.2663 15.0145C17.1278 14.8939 16.948 14.8268 16.7613 14.8259L14.4615 14.5145C14.3087 14.5009 14.1626 14.4476 14.0388 14.3603C13.915 14.2729 13.8182 14.1548 13.7588 14.0186C13.4234 13.3497 13.0761 12.6846 12.7327 12.0157C12.6786 11.8904 12.5888 11.7823 12.4736 11.7041C12.3584 11.6259 12.2226 11.5806 12.0819 11.5736Z" fill="#C4C7D2" />
                                <path d="M0.01999 7.91378C0.01999 7.25256 -0.00795873 6.59133 0.01999 5.93395C0.056096 5.55371 0.222993 5.19596 0.494218 4.91741C0.765444 4.63885 1.12548 4.45543 1.51724 4.39623C1.64936 4.37648 1.78282 4.36621 1.91651 4.36548H4.60359V1.75135C4.58506 1.51634 4.66425 1.28386 4.82374 1.10507C4.98323 0.926273 5.20995 0.815805 5.45403 0.797962C5.69811 0.78012 5.93956 0.856361 6.12525 1.00992C6.31095 1.16348 6.42568 1.38179 6.44422 1.6168C6.4483 1.69236 6.4483 1.76806 6.44422 1.84361V4.35395H17.5079V4.18095C17.5079 3.37749 17.5079 2.57787 17.5079 1.77826C17.5021 1.54171 17.5941 1.31264 17.7637 1.14141C17.9333 0.970189 18.1666 0.870841 18.4123 0.865233C18.6579 0.859625 18.8959 0.948214 19.0737 1.11151C19.2515 1.2748 19.3547 1.49943 19.3605 1.73597C19.3605 2.54712 19.3605 3.35827 19.3605 4.16941V4.36548H22.0676C22.3206 4.35688 22.5728 4.39854 22.8083 4.48784C23.0439 4.57715 23.2579 4.71219 23.4369 4.88457C23.616 5.05695 23.7562 5.26297 23.849 5.4898C23.9417 5.71664 23.985 5.95943 23.9761 6.20306C23.9761 6.76817 23.9761 7.33328 23.9761 7.90993L0.01999 7.91378Z" fill="#C4C7D2" />
                            </g>
                            <defs>
                                <clipPath id="clip0_59_2234">
                                    <rect width="24" height="24" fill="white" transform="translate(0 0.809509)" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span> Events </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEvents">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.event_type')}}" class="nav-link {{ (request()->is('admin/event_type*')) ? 'active' : '' }}">
                                    <span> Event Type </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.event')}}" class="nav-link {{ (request()->is('admin/event/*')) ? 'active' : '' }}">
                                    <span> Events </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ route('admin.forum.index')}}" target=”_blank” class="nav-link {{ (request()->is('admin/forum*')) ? 'active' : '' }}">
                        <!--<i class="far fa-comments"></i>--->
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.7502 9.30668C17.8006 11.08 18.5614 13.3232 18.0297 16.063L18.1258 16.1133C18.7084 16.3704 19.291 16.6246 19.8708 16.8876C19.9065 16.9085 19.9482 16.9152 19.9882 16.9065C20.0282 16.8978 20.0638 16.8743 20.0886 16.8403C20.3797 16.5337 20.7448 16.3154 21.1452 16.2084C21.5456 16.1015 21.9663 16.1101 22.3624 16.2332C22.7585 16.3563 23.1153 16.5894 23.3947 16.9076C23.6741 17.2259 23.8657 17.6173 23.9491 18.0403C24.012 18.3706 24.0073 18.7111 23.9353 19.0394C23.8634 19.3677 23.7258 19.6763 23.5316 19.9451C23.3374 20.2139 23.091 20.4367 22.8086 20.599C22.5262 20.7612 22.2141 20.8591 21.8929 20.8864C21.5717 20.9137 21.2486 20.8697 20.9448 20.7572C20.641 20.6447 20.3634 20.4664 20.1303 20.2339C19.8971 20.0014 19.7136 19.72 19.5919 19.4082C19.4702 19.0963 19.413 18.7611 19.424 18.4245C19.4232 18.3987 19.417 18.3734 19.4058 18.3504C19.3945 18.3274 19.3785 18.3073 19.3589 18.2915C18.7452 18.0137 18.1258 17.7418 17.5121 17.4699C17.382 17.6886 17.2632 17.9132 17.1247 18.1201C16.6513 18.8423 16.0411 19.4553 15.3318 19.921C14.6225 20.3867 13.8292 20.6952 13.0012 20.8274C12.7806 20.8658 12.5543 20.8776 12.3309 20.8953C12.2987 20.8918 12.2663 20.8994 12.2387 20.917C12.2111 20.9347 12.1898 20.9613 12.1782 20.9929C11.9249 21.51 11.5314 21.9376 11.0469 22.2224C10.2821 22.6883 9.43592 22.9897 8.55807 23.109C8.25546 23.1593 7.9472 23.1918 7.6361 23.2184C8.51284 22.4411 9.333 21.6224 9.64127 20.4077C8.16806 19.7444 6.99821 18.5102 6.37755 16.9645L5.67333 17.1566C5.35658 17.2423 5.03982 17.3339 4.72024 17.4108C4.67274 17.4159 4.62875 17.4393 4.59687 17.4765C4.56498 17.5136 4.54745 17.5618 4.5477 17.6117C4.5056 18.0375 4.35106 18.4426 4.10135 18.7818C3.85163 19.1211 3.51658 19.3811 3.13361 19.5328C2.73522 19.6951 2.30127 19.7373 1.88107 19.6546C1.46087 19.572 1.0713 19.3678 0.75663 19.0653C0.441959 18.7627 0.214815 18.374 0.101024 17.9433C-0.012767 17.5126 -0.00863717 17.0572 0.112934 16.6288C0.234506 16.2004 0.468643 15.8162 0.788737 15.52C1.10883 15.2238 1.50204 15.0273 1.92365 14.953C2.34527 14.8786 2.77838 14.9294 3.17376 15.0995C3.56914 15.2696 3.91092 15.5522 4.16024 15.9152C4.17675 15.9377 4.19826 15.9557 4.2229 15.9675C4.24754 15.9794 4.27457 15.9848 4.30165 15.9832C4.84749 15.8384 5.39334 15.6877 5.93918 15.531C5.95679 15.5247 5.97382 15.5168 5.99009 15.5074C5.7885 14.2001 5.97739 12.8597 6.53104 11.6687C7.0847 10.4777 7.97621 9.49398 9.08413 8.85153C8.99363 8.621 8.9003 8.39046 8.80131 8.16289C8.65424 7.7964 8.51848 7.42991 8.36576 7.06343C8.35651 7.02904 8.33566 6.99932 8.30707 6.97976C8.27847 6.9602 8.24406 6.95213 8.21021 6.95703C7.77372 6.97049 7.3427 6.8528 6.96829 6.61795C6.59388 6.38309 6.29179 6.04091 6.09789 5.63203C5.90399 5.22314 5.82641 4.7647 5.87435 4.31111C5.92229 3.85753 6.09373 3.42784 6.36835 3.07302C6.64297 2.71821 7.00921 2.45317 7.42364 2.30936C7.83807 2.16555 8.28329 2.14901 8.70646 2.26169C9.12962 2.37436 9.51295 2.61154 9.81099 2.94507C10.109 3.2786 10.3093 3.69448 10.3879 4.14336C10.464 4.52537 10.4449 4.92139 10.3324 5.29348C10.22 5.66557 10.0181 6.00126 9.74591 6.26839C9.70851 6.29789 9.68309 6.34102 9.67471 6.3892C9.66633 6.43739 9.67559 6.4871 9.70067 6.52848C9.92127 7.06934 10.1334 7.61316 10.3512 8.15402C10.3653 8.19244 10.3851 8.23086 10.4077 8.28111C11.7676 7.88531 13.2163 7.98965 14.5114 8.57666L16.5958 4.79653C16.2104 4.35192 16.0011 3.77083 16.0104 3.17099C16.0171 2.83804 16.0903 2.51023 16.2254 2.20858C16.3604 1.90692 16.5542 1.63807 16.7944 1.41925C17.0347 1.20042 17.316 1.03645 17.6204 0.937846C17.9248 0.839238 18.2455 0.808167 18.562 0.846622C18.8786 0.885077 19.184 0.992209 19.4586 1.16116C19.7332 1.33011 19.971 1.55714 20.1568 1.82772C20.3426 2.0983 20.4722 2.40645 20.5374 2.73243C20.6026 3.05841 20.602 3.39503 20.5355 3.72072C20.4204 4.27722 20.117 4.77163 19.6811 5.11315C19.2452 5.45467 18.706 5.62035 18.1626 5.57975C18.0578 5.55534 17.9482 5.57195 17.8543 5.62642C17.7605 5.68089 17.689 5.76945 17.6535 5.8753C17.0624 6.97772 16.4516 8.06831 15.8491 9.16481C15.8039 9.20324 15.7756 9.25939 15.7502 9.30668Z" fill="#C4C7D2" />
                        </svg>
                        <span> Forum </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.leave_type')}}" target=”_blank” class="nav-link {{ (request()->is('admin/leave_type*')) ? 'active' : '' }}">
                        <i class="far fa-comments"></i>
                        <span> Leave Type </span>
                    </a>
                </li>
                <li>
                    <a href="#sideBarSettings" data-toggle="collapse">
                        <!-- <i data-feather="settings" class="icon-dual"></i> -->
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_59_2284)">
                                <path d="M12.1447 13.2052H1.08195C0.869997 13.2189 0.65905 13.1661 0.478598 13.0541C0.298146 12.9421 0.15721 12.7765 0.0754908 12.5806C0.0164159 12.4358 -0.00778721 12.2791 0.00484663 12.1232C0.0174805 11.9674 0.0665963 11.8166 0.148221 11.6832C0.229846 11.5498 0.341689 11.4374 0.474746 11.3552C0.607802 11.273 0.758347 11.2231 0.914212 11.2097H12.1405C12.2076 11.0127 12.2621 10.8199 12.3418 10.6354C12.6014 10.027 13.0086 9.49288 13.5267 9.0814C14.0447 8.66992 14.6573 8.39407 15.3088 8.27879C15.9604 8.1635 16.6304 8.21244 17.2583 8.42116C17.8861 8.62989 18.452 8.99181 18.9048 9.47419C19.3395 9.92582 19.6538 10.4793 19.819 11.084C19.8215 11.1037 19.828 11.1228 19.8382 11.14C19.8483 11.1571 19.8618 11.172 19.8779 11.1838C19.894 11.1956 19.9123 11.2039 19.9317 11.2084C19.9512 11.2129 19.9713 11.2133 19.9909 11.2097H22.96C23.0968 11.2009 23.2339 11.2202 23.363 11.2664C23.492 11.3126 23.6102 11.3848 23.7102 11.4786C23.8102 11.5723 23.8899 11.6855 23.9444 11.8112C23.9989 11.937 24.0271 12.0725 24.0271 12.2096C24.0271 12.3466 23.9989 12.4822 23.9444 12.6079C23.8899 12.7336 23.8102 12.8469 23.7102 12.9406C23.6102 13.0343 23.492 13.1065 23.363 13.1527C23.2339 13.199 23.0968 13.2182 22.96 13.2094H20.0035C19.982 13.2058 19.96 13.2066 19.9388 13.2116C19.9176 13.2167 19.8976 13.2259 19.88 13.2388C19.8624 13.2517 19.8476 13.268 19.8364 13.2867C19.8252 13.3054 19.8178 13.3261 19.8148 13.3477C19.6447 13.9597 19.326 14.5203 18.887 14.9796C18.4481 15.4388 17.9025 15.7826 17.2986 15.9804C16.7889 16.1679 16.2449 16.2443 15.7032 16.2045C15.1615 16.1648 14.6345 16.0097 14.1576 15.7498C13.2959 15.3082 12.6303 14.5606 12.2914 13.6538C12.2369 13.528 12.1992 13.3771 12.1447 13.2052ZM17.9948 12.2075C17.9948 11.8128 17.8777 11.427 17.6583 11.0988C17.439 10.7707 17.1272 10.5149 16.7625 10.3639C16.3977 10.2129 15.9964 10.1734 15.6092 10.2503C15.222 10.3273 14.8663 10.5174 14.5871 10.7965C14.3079 11.0755 14.1178 11.4311 14.0408 11.8182C13.9638 12.2053 14.0033 12.6065 14.1544 12.9711C14.3055 13.3357 14.5613 13.6474 14.8896 13.8666C15.2179 14.0859 15.6038 14.2029 15.9986 14.2029C16.5262 14.2018 17.0321 13.9924 17.4059 13.6202C17.7798 13.248 17.9914 12.7433 17.9948 12.2158V12.2075Z" fill="#C4C7D2" />
                                <path d="M11.8637 3.21532H22.9474C23.2121 3.20031 23.472 3.29103 23.6698 3.46753C23.8676 3.64402 23.9871 3.89184 24.0021 4.15645C24.0171 4.42106 23.9264 4.6808 23.7498 4.87853C23.5733 5.07625 23.3254 5.19576 23.0607 5.21077H11.8637C11.8008 5.38684 11.7505 5.56291 11.6792 5.73479C11.3186 6.64418 10.6262 7.38284 9.74176 7.80152C8.97637 8.18733 8.10323 8.304 7.26334 8.13269C6.59308 8.01156 5.96582 7.71834 5.4431 7.28179C4.92038 6.84525 4.52017 6.28037 4.2817 5.64257C4.23944 5.54113 4.20714 5.43583 4.18524 5.32816C4.18524 5.22755 4.10976 5.21077 4.0175 5.21077H1.04842C0.850946 5.22166 0.654793 5.17266 0.48567 5.07017C0.316546 4.96769 0.182353 4.8165 0.100672 4.63645C0.0297274 4.48724 -0.00304361 4.32276 0.00530182 4.15777C0.0136473 3.99277 0.0628466 3.83243 0.148484 3.69113C0.234122 3.54984 0.353511 3.43201 0.495946 3.34823C0.638382 3.26445 0.799407 3.21734 0.964553 3.21113C1.96263 3.21113 2.96071 3.21113 3.96298 3.21113C3.99055 3.21526 4.01867 3.21385 4.04569 3.20699C4.07271 3.20013 4.09811 3.18796 4.12037 3.17117C4.14262 3.15439 4.1613 3.13333 4.17532 3.10924C4.18934 3.08515 4.19842 3.0585 4.20202 3.03086C4.39211 2.37157 4.75398 1.7746 5.2506 1.30098C5.74722 0.827368 6.36077 0.494118 7.0285 0.335318C7.96449 0.0791761 8.96321 0.193273 9.81725 0.653918C10.3027 0.896827 10.7318 1.23867 11.0771 1.65745C11.4223 2.07622 11.676 2.56263 11.8218 3.08536C11.8329 3.12954 11.847 3.17295 11.8637 3.21532ZM5.99268 4.20466C5.99103 4.59932 6.10648 4.98561 6.32444 5.31467C6.5424 5.64374 6.85308 5.90081 7.21719 6.05337C7.5813 6.20593 7.98249 6.24713 8.37002 6.17176C8.75756 6.09639 9.11404 5.90784 9.39438 5.62995C9.67472 5.35205 9.86632 4.9973 9.94497 4.61054C10.0236 4.22379 9.98577 3.82242 9.83623 3.45716C9.68668 3.09191 9.43214 2.77919 9.1048 2.55855C8.77746 2.33791 8.39202 2.21925 7.99722 2.21758C7.47066 2.22087 6.96654 2.43115 6.59381 2.80297C6.22107 3.17479 6.00966 3.67829 6.00526 4.20466H5.99268Z" fill="#C4C7D2" />
                                <path d="M11.893 21.2373C11.7211 21.5978 11.5827 21.9709 11.3772 22.3105C10.8928 23.1349 10.1134 23.7447 9.19656 24.0167C8.28685 24.3027 7.30466 24.2526 6.42877 23.8756C5.55289 23.4986 4.84155 22.8197 4.42423 21.9625C4.33155 21.7581 4.25171 21.5481 4.18519 21.3337C4.179 21.2943 4.15742 21.2589 4.1252 21.2353C4.09297 21.2118 4.05272 21.2019 4.01325 21.2079H1.02741C0.824263 21.2115 0.624908 21.1527 0.456202 21.0395C0.287496 20.9263 0.157544 20.7642 0.083848 20.5749C0.0242861 20.4226 0.00293495 20.258 0.0216632 20.0955C0.0403914 19.933 0.0986279 19.7776 0.191286 19.6428C0.283944 19.508 0.408206 19.3979 0.553222 19.3222C0.698239 19.2464 0.859598 19.2073 1.02321 19.2083C1.57257 19.2083 2.12195 19.2083 2.67131 19.2083C3.12002 19.2083 3.56873 19.2083 4.01745 19.2083C4.03841 19.2119 4.05987 19.2112 4.08057 19.2064C4.10127 19.2015 4.1208 19.1926 4.13799 19.1801C4.15519 19.1676 4.1697 19.1518 4.18069 19.1336C4.19167 19.1154 4.19892 19.0952 4.20197 19.0741C4.37105 18.4413 4.70201 17.8634 5.1623 17.3973C5.84546 16.6988 6.76137 16.2754 7.73618 16.2074C8.71099 16.1394 9.67685 16.4316 10.4504 17.0284C11.114 17.5333 11.5965 18.2391 11.8259 19.0406C11.8259 19.0825 11.8553 19.1286 11.8721 19.1873H22.9432C23.0786 19.175 23.215 19.1903 23.3443 19.2324C23.4735 19.2744 23.5928 19.3423 23.695 19.4319C23.7972 19.5215 23.8801 19.631 23.9386 19.7536C23.9972 19.8762 24.0302 20.0095 24.0356 20.1452C24.041 20.281 24.0187 20.4165 23.9701 20.5433C23.9215 20.6702 23.8476 20.7859 23.7529 20.8834C23.6581 20.9808 23.5446 21.058 23.4191 21.1102C23.2936 21.1624 23.1588 21.1885 23.0229 21.187H11.8595L11.893 21.2373ZM6.02199 20.2018C6.022 20.5961 6.13886 20.9816 6.35783 21.3096C6.57681 21.6375 6.88807 21.8933 7.25233 22.0446C7.61659 22.1958 8.01752 22.2359 8.40451 22.1595C8.79149 22.0832 9.14719 21.894 9.42669 21.6158C9.70618 21.3375 9.89695 20.9828 9.97492 20.5962C10.0529 20.2097 10.0146 19.8088 9.86476 19.444C9.71496 19.0792 9.4604 18.767 9.13324 18.5467C8.80608 18.3265 8.42098 18.208 8.02654 18.2064C7.76213 18.2025 7.4996 18.2512 7.25425 18.3498C7.0089 18.4484 6.78563 18.5948 6.59749 18.7806C6.40934 18.9663 6.26008 19.1877 6.15839 19.4317C6.05671 19.6757 6.00463 19.9375 6.00522 20.2018H6.02199Z" fill="#C4C7D2" />
                            </g>
                            <defs>
                                <clipPath id="clip0_59_2284">
                                    <rect width="24" height="24" fill="white" transform="translate(0 0.209534)" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span> Settings </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sideBarSettings">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.settings')}}" class="nav-link {{ (request()->is('admin/settings*')) ? 'active' : '' }}">
                                    <span> General Settings</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.settings.logo')}}" class="nav-link {{ (request()->is('admin/settings*')) ? 'active' : '' }}">
                                    <span> Logo </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ route('admin.faq.index')}}" class="nav-link {{ (request()->is('admin/settings*')) ? 'active' : '' }}">
                        <!-- <i class="fas fa-question"></i> -->
                        <!--<i class="fas fa-question"></i>-->
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.08171 0.243231C2.76064 0.356801 1.51649 1.08837 0.766601 2.19249C0.563862 2.491 0.313088 3.0067 0.206566 3.34412C-0.0108295 4.03279 9.10194e-05 3.64385 9.10194e-05 10.7017C9.10194e-05 17.7985 -0.0103579 17.4431 0.218249 18.1251C0.783 19.8098 2.24727 20.9967 4.01002 21.1985C4.21762 21.2223 6.14711 21.2359 9.33259 21.2361L14.3295 21.2364L17.1521 22.6456C19.6315 23.8836 20.0147 24.0643 20.3047 24.1323C20.7038 24.226 21.3091 24.2358 21.6552 24.1543C22.7744 23.8906 23.6145 23.0619 23.9188 21.9216L24 21.6171V12.9507C24 4.76607 23.9964 4.26609 23.935 3.95787C23.7437 2.99724 23.3238 2.19224 22.6767 1.54552C21.9275 0.796687 20.9561 0.34469 19.8793 0.243884C19.3945 0.198485 4.6092 0.197904 4.08171 0.243231ZM13.2584 4.79739C14.1859 4.95024 15.0177 5.41057 15.4892 6.03187C15.7075 6.31954 15.934 6.767 16.0177 7.07634C16.0994 7.37804 16.1305 8.18133 16.0742 8.53503C15.9406 9.37361 15.421 10.0903 14.2783 11.0123C13.5617 11.5904 13.4241 11.8211 13.4241 12.4444V12.7875H12.1673H10.9105L10.9306 12.1983C10.967 11.13 11.0667 10.9567 12.2268 9.94396C13.0331 9.24002 13.3465 8.90536 13.5369 8.54493C13.6082 8.40985 13.6227 8.33044 13.6207 8.0839C13.6186 7.8284 13.6031 7.75632 13.5115 7.57726C13.2591 7.0841 12.6479 6.87473 11.9445 7.04048C11.6293 7.11475 11.4476 7.21548 11.2416 7.43018C11.033 7.64764 10.9004 7.90274 10.8408 8.20113C10.8169 8.32043 10.7944 8.42287 10.7908 8.42882C10.7783 8.44916 8.29035 8.28229 8.26607 8.25948C8.22791 8.22361 8.33381 7.64042 8.4391 7.30686C8.55531 6.93859 8.73591 6.57035 8.94456 6.27635C9.16446 5.9665 9.66061 5.51163 10.001 5.30781C10.8525 4.79801 12.0877 4.60445 13.2584 4.79739ZM12.644 13.7864C13.6441 14.0605 14.0314 15.4191 13.3305 16.1944C12.9998 16.5603 12.6095 16.719 12.0949 16.6969C11.8009 16.6842 11.7326 16.6673 11.49 16.5475C11.1741 16.3915 10.9429 16.1591 10.7863 15.8404C10.6931 15.6508 10.6849 15.6001 10.6849 15.217C10.6849 14.8399 10.6942 14.7801 10.7827 14.5914C11.107 13.8997 11.8636 13.5725 12.644 13.7864Z" fill="#C4C7D2" />
                        </svg>
                        <span> FAQs </span>
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
                    <a href="#sidebarAdmission" data-toggle="collapse">
                        <i class="fe-edit"></i>
                        <span> Admission </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAdmission">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('staff.admission')}}" class="nav-link {{ (request()->is('staff/admission/index')) ? 'active' : '' }}">
                                    <span>Create Admission</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="{{ route('staff.admission.import')}}" class="nav-link {{ (request()->is('staff/admission/import')) ? 'active' : '' }}">
                                    <span>Multiple Import</span>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarStudentDetails" data-toggle="collapse">
                        <i class="fas fa-users"></i>
                        <span> Student Details </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarStudentDetails">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('staff.student.index')}}" class="nav-link {{ (request()->is('staff/student*')) ? 'active' : '' }}">
                                    <span> Student List </span>
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
                                <a href="{{ route('staff.parent')}}" class="nav-link {{ (request()->is('staff/parent*')) ? 'active' : '' }}">
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
                                <a href="{{ route('staff.qualification')}}" class="nav-link {{ (request()->is('staff/qualification*')) ? 'active' : '' }}">
                                    <span> Add Qualification </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('staff.staffcategory')}}" class="nav-link {{ (request()->is('staff/staffcategory*')) ? 'active' : '' }}">
                                    <span> Add Staff Category </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('staff.department')}}" class="nav-link {{ (request()->is('staff/department*')) ? 'active' : '' }}">
                                    <span> Add Department </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('staff.designation')}}" class="nav-link {{ (request()->is('staff/designation*')) ? 'active' : '' }}">
                                    <span>Add Designation </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('staff.employee')}}" class="nav-link {{ (request()->is('staff/employee')) ? 'active' : '' }}">
                                    <span>Add Employee</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('staff.listemployee')}}" class="nav-link {{ (request()->is('staff/listemployee')) ? 'active' : '' }}">
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
                                <a href="{{ route('staff.section')}}" class="nav-link {{ (request()->is('staff/section*')) ? 'active' : '' }}">
                                    <span> Section </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('staff.classes')}}" class="nav-link {{ (request()->is('staff/classes*')) ? 'active' : '' }}">
                                    <span> Classes </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('staff.section_allocation')}}" class="nav-link {{ (request()->is('staff/section_allocation*')) ? 'active' : '' }}">
                                    <span> Sections Allocation </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('staff.assign_teacher')}}" class="nav-link {{ (request()->is('staff/assign_teacher*')) ? 'active' : '' }}">
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
                                <a href="{{ route('staff.homework')}}" class="nav-link {{ (request()->is('staff/employee*')) ? 'active' : '' }}">
                                    <span>Add Homework</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarAttendance" data-toggle="collapse">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span> Attendance </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAttendance">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('staff.attendance.student_entry')}}" class="nav-link {{ (request()->is('staff/attendance/student_entry')) ? 'active' : '' }}">
                                    <span> Student </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('staff.attendance.employee_entry')}}" class="nav-link {{ (request()->is('staff/attendance/employee_entry')) ? 'active' : '' }}">
                                    <span> Employee </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('staff.attendance.exam_entry')}}" class="nav-link {{ (request()->is('staff/attendance/exam_entry')) ? 'active' : '' }}">
                                    <span> Exam </span>
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
                                            <a href="{{ route('staff.exam.term')}}" class="nav-link {{ (request()->is('staff/exam/term')) ? 'active' : '' }}">
                                                <span>Exam Term</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('staff.exam.hall')}}" class="nav-link {{ (request()->is('staff/exam/hall')) ? 'active' : '' }}">
                                                <span>Exam Hall</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('staff.exam.mark_distribution')}}" class="nav-link {{ (request()->is('staff/exam/mark_distribution')) ? 'active' : '' }}">
                                                <span>Distribution</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('staff.exam.exam')}}" class="nav-link {{ (request()->is('staff/exam/exam')) ? 'active' : '' }}">
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
                                            <a href="{{ route('staff.hostel')}}" class="nav-link {{ (request()->is('staff/hostel')) ? 'active' : '' }}">
                                                <span> Hostel Master </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('staff.hostel.room')}}" class="nav-link {{ (request()->is('staff/hostel/room')) ? 'active' : '' }}">
                                                <span> Hostel Room </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('staff.hostel.category')}}" class="nav-link {{ (request()->is('staff/hostel/category')) ? 'active' : '' }}">
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
                                            <a href="{{ route('staff.transport.route')}}" class="nav-link {{ (request()->is('staff/transport/route')) ? 'active' : '' }}">
                                                <span> Route Master </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('staff.transport.vehicle')}}" class="nav-link {{ (request()->is('staff/transport/vehicle')) ? 'active' : '' }}">
                                                <span> Vehicle Master</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('staff.transport.stoppage')}}" class="nav-link {{ (request()->is('staff/transport/stoppage')) ? 'active' : '' }}">
                                                <span> Stoppage</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('staff.transport.assignvehicle')}}" class="nav-link {{ (request()->is('staff/transport/assignvehicle')) ? 'active' : '' }}">
                                                <span> Assign Vehicle</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- <li>
                    <a href="#sidebarLibrary" data-toggle="collapse">
                        <i class="fe-book-open"></i>
                        <span> Library </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarLibrary">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('staff.library.book')}}" class="nav-link {{ (request()->is('staff/book')) ? 'active' : '' }}">
                                    <span>Book</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('staff.library.bookcategory')}}" class="nav-link {{ (request()->is('staff/bookcategory')) ? 'active' : '' }}">
                                    <span>Book Category</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('staff.library.issuedbook')}}" class="nav-link {{ (request()->is('staff/issuedbook')) ? 'active' : '' }}">
                                    <span>My Issued Book</span>
                                </a>
                            </li> 
                            <li>
                                <a href="{{ route('staff.library.issuereturn')}}" class="nav-link {{ (request()->is('staff/book')) ? 'active' : '' }}">
                                    <span>Book Issue/Return</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li>
                    <a href="#sidebarEvents" data-toggle="collapse">
                        <i class="fas fa-map"></i>
                        <span> Events </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEvents">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('staff.event_type')}}" class="nav-link {{ (request()->is('staff/event_type*')) ? 'active' : '' }}">
                                    <span> Event Type </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('staff.event')}}" class="nav-link {{ (request()->is('staff/event/*')) ? 'active' : '' }}">
                                    <span> Events </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarLeaveManage" data-toggle="collapse">
                        <i data-feather="map"></i>
                        <span> Leave Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarLeaveManage">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('staff.leave_management.applyleave')}}" class="nav-link {{ (request()->is('staff/leave_management*')) ? 'active' : '' }}">
                                    <span> Leave Apply </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ route('staff.forum.index')}}" target=”_blank” class="nav-link {{ (request()->is('staff/forum*')) ? 'active' : '' }}">
                        <i class="far fa-comments"></i>
                        <span> Forum </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('staff.settings')}}" class="nav-link {{ (request()->is('staff/settings*')) ? 'active' : '' }}">
                        <i data-feather="settings" class="icon-dual"></i>
                        <span> Settings </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('staff.faq.Index')}}" class="nav-link {{ (request()->is('staff/faq*')) ? 'active' : '' }}">
                        <i class="fas fa-question"></i>
                        <span> FAQs </span>
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
                    <a href="{{ route('teacher.analyticrep.analyticreport')}}" class="nav-link {{ (request()->is('teacher/analyticrep*')) ? 'active' : '' }}">
                        <i data-feather="activity" class="icon-dual"></i>
                        <span> Analytic </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('teacher.classroom.management')}}" class="nav-link {{ (request()->is('teacher/classroom*')) ? 'active' : '' }}">
                        <i data-feather="file-text" class="icon-dual"></i>
                        <span> Classroom Management </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('teacher.test_result')}}" class="nav-link {{ (request()->is('teacher/test_result*')) ? 'active' : '' }}">
                        <i class="fas fa-marker"></i>
                        <span> Test Result </span>
                    </a>
                </li>
                <!-- <li>
                    <a href="#sidebarAdmission" data-toggle="collapse">
                        <i class="fe-edit"></i>
                        <span> Admission </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAdmission">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('teacher.admission')}}" class="nav-link {{ (request()->is('teacher/admission/index')) ? 'active' : '' }}">
                                    <span>Create Admission</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li>
                    <a href="#sidebarStudentDetails" data-toggle="collapse">
                        <i class="fas fa-user-graduate"></i>
                        <span> Student Details </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarStudentDetails">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('teacher.student.index')}}" class="nav-link {{ (request()->is('teacher/student*')) ? 'active' : '' }}">
                                    <span> Student List </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- <li>
                    <a href="#sidebarParent" data-toggle="collapse">
                        <i class="fe-user-plus"></i>
                        <span> Parents </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarParent">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('teacher.parent')}}" class="nav-link {{ (request()->is('teacher/parent*')) ? 'active' : '' }}">
                                    <span>Add Parent</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li>
                    <a href="#sidebarHomework" data-toggle="collapse">
                        <i class="fe-book-open"></i>
                        <span> Homework </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarHomework">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('teacher.homework')}}" class="nav-link {{ (request()->is('teacher/homework*')) ? 'active' : '' }}">
                                    <span>Add Homework</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('teacher.evaluation_report')}}" class="nav-link {{ (request()->is('teacher/evaluation_report*')) ? 'active' : '' }}">
                                    <span>Evoluation Report</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarAttendance" data-toggle="collapse">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span> Attendance Report</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAttendance">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('teacher.attendance.list')}}" class="nav-link {{ (request()->is('teacher/attendance/list')) ? 'active' : '' }}">
                                    <span> List </span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="{{ route('teacher.attendance.student_entry')}}" class="nav-link {{ (request()->is('teacher/attendance/student_entry')) ? 'active' : '' }}">
                                    <span> Student </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('teacher.attendance.exam_entry')}}" class="nav-link {{ (request()->is('teacher/attendance/exam_entry')) ? 'active' : '' }}">
                                    <span> Exam </span>
                                </a>
                            </li> -->
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
                                <a href="#sidebarResult" data-toggle="collapse">
                                    <i data-feather="book-open" class="icons-xs icon-dual"></i> &nbsp;
                                    Exam Results<span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarResult">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('teacher.exam_results.byclass')}}" class="nav-link {{ (request()->is('teacher/exam_results')) ? 'active' : '' }}">
                                                <span>By Class</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('teacher.exam_results.bysubject')}}" class="nav-link {{ (request()->is('teacher/exam_results')) ? 'active' : '' }}">
                                                <span>By Subject</span>
                                            </a>
                                        </li>
                                        <a href="{{ route('teacher.exam_results.bystudent')}}" class="nav-link {{ (request()->is('teacher/exam_results')) ? 'active' : '' }}">
                                            <span>By Student</span>
                                        </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>

        </div>
        </li>
        <li>
            <a href="#sidebarLeaveManage" data-toggle="collapse">
                <i data-feather="map"></i>
                <span> Leave Management </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarLeaveManage">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{ route('teacher.leave_management.allleaves')}}" class="nav-link {{ (request()->is('teacher/leave_management*')) ? 'active' : '' }}">
                            <span> Leave Approval</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('teacher.leave_management.applyleave')}}" class="nav-link {{ (request()->is('teacher/leave_management*')) ? 'active' : '' }}">
                            <span> Leave Apply </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <a href="{{ route('teacher.chat')}}" class="nav-link {{ (request()->is('teacher/chat*')) ? 'active' : '' }}">

                <i data-feather="message-square"></i>
                <span> Chat </span>
            </a>
        </li>
        <li>
            <a href="{{ route('teacher.forum.index')}}" target=”_blank” class="nav-link {{ (request()->is('teacher/forum*')) ? 'active' : '' }}">

                <i class="far fa-comments"></i>
                <span> Forum </span>
            </a>
        </li>
        <li>
            <a href="{{ route('schoolcrm.app.form')}}" target=”_blank” class="nav-link {{ (request()->is('application-form')) ? 'active' : '' }}">

                <i class="fab fa-wpforms"></i>
                <span> Application Form </span>
            </a>
        </li>
        <li>
            <a href="{{ route('teacher.settings')}}" class="nav-link {{ (request()->is('teacher/settings*')) ? 'active' : '' }}">
                <i data-feather="settings" class="icon-dual"></i>
                <span> Settings </span>
            </a>
        </li>
        <li>
            <a href="{{ route('teacher.faq.Index')}}" class="nav-link {{ (request()->is('teacher/faq*')) ? 'active' : '' }}">
                <i class="fas fa-question"></i>
                <span> FAQs </span>
            </a>
        </li>
        @elseif(Session::get('role_id') == '5')
        <li>
            <a href="{{ route('parent.dashboard')}}" class="nav-link {{ (request()->is('parent/dashboard')) ? 'active' : '' }}">
                <i data-feather="airplay" class="icon-dual"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('parent.analyticrep.analyticreport')}}" class="nav-link {{ (request()->is('parent/analyticrep*')) ? 'active' : '' }}">
                <i data-feather="activity" class="icon-dual"></i>
                <span> Analytic </span>
            </a>
        </li>
        <li>
            <a href="{{ route('parent.exam.schedule')}}" class="nav-link {{ (request()->is('parent/exam*')) ? 'active' : '' }}">
                <i class="fas fa-dna"></i>

                <span> Exam Schedule </span>
            </a>
        </li>
        <li>
            <a href="{{ route('parent.report_card')}}" class="nav-link {{ (request()->is('parent/report_card*')) ? 'active' : '' }}">
                <i class="far fa-id-card"></i>
                <span> Report Card </span>
            </a>
        </li>
        <!-- <li>
                    <a href="#sidebarLibrary" data-toggle="collapse">
                        <i class="fe-book-open"></i>
                        <span> Library </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarLibrary">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('parent.library.books')}}" class="nav-link {{ (request()->is('parent/book')) ? 'active' : '' }}">
                                    <span>Book</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('parent.library.book_issued')}}" class="nav-link {{ (request()->is('parent/book_issued')) ? 'active' : '' }}">
                                    <span>Issued Book</span>
                                </a>
                            </li> 
                        </ul>
                    </div>
                </li>       -->
        <li>
            <a href="{{ route('parent.events')}}" class="nav-link {{ (request()->is('parent/events*')) ? 'active' : '' }}">
                <i class="fas fa-map"></i>
                <span> Events </span>
            </a>
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
                        <a href="{{ route('parent.homework')}}" class="nav-link {{ (request()->is('parent/homework*')) ? 'active' : '' }}">
                            <span>Homework List</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <a href="{{ route('parent.attendance')}}" class="nav-link {{ (request()->is('super_admin/attendance/')) ? 'active' : '' }}">
                <i class="fas fa-chalkboard-teacher"></i>
                <span> Attendance </span>
            </a>
        </li>
        <li>
            <a href="{{ route('parent.timetable.index')}}" class="nav-link {{ (request()->is('parent/timetable*')) ? 'active' : '' }}">
                <i class="far fa-calendar-alt"></i>
                <span> Time Table </span>
            </a>
        </li>
        <li>
            <a href="{{ route('parent.chat')}}" class="nav-link {{ (request()->is('parent/chat*')) ? 'active' : '' }}">
                <i data-feather="message-square"></i>
                <span> Chat </span>
            </a>
        </li>
        <li>
            <a href="{{ route('schoolcrm.app.form')}}" target=”_blank” class="nav-link {{ (request()->is('application-form')) ? 'active' : '' }}">

                <i class="fab fa-wpforms"></i>
                <span> Application Form </span>
            </a>
        </li>
        <li>
            <a href="{{ route('parent.forum.index')}}" target=”_blank” class="nav-link {{ (request()->is('parent/forum*')) ? 'active' : '' }}">
                <i class="far fa-comments"></i>
                <span> Forum </span>
            </a>
        </li>
        <li>
            <a href="{{ route('parent.settings')}}" class="nav-link {{ (request()->is('parent/settings*')) ? 'active' : '' }}">
                <i data-feather="settings" class="icon-dual"></i>
                <span> Settings </span>
            </a>
        </li>
        <li>
            <a href="{{ route('parent.faq.Index')}}" class="nav-link {{ (request()->is('parent/faq*')) ? 'active' : '' }}">
                <i class="fas fa-question"></i>
                <span> FAQs </span>
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
            <a href="{{ route('student.analyticrep.analyticreport')}}" class="nav-link {{ (request()->is('student/analyticrep*')) ? 'active' : '' }}">
                <i data-feather="activity" class="icon-dual"></i>
                <span> Analytic </span>
            </a>
        </li>
        <li>
            <a href="{{ route('student.timetable')}}" class="nav-link {{ (request()->is('super_admin/timetable*')) ? 'active' : '' }}">
                <i class="far fa-calendar-alt"></i>
                <span> Time Table </span>
            </a>
        </li>
        <li>
            <a href="{{ route('student.exam.schedule')}}" class="nav-link {{ (request()->is('student/exam*')) ? 'active' : '' }}">
                <i class="fas fa-dna"></i>

                <span> Exam Schedule </span>
            </a>
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
                        <a href="{{ route('student.homework')}}" class="nav-link {{ (request()->is('student/homework*')) ? 'active' : '' }}">
                            <span>Homework List</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <a href="{{ route('student.report_card')}}" class="nav-link {{ (request()->is('student/report_card*')) ? 'active' : '' }}">
                <i class="far fa-id-card"></i>
                <span> Report Card </span>
            </a>
        </li>
        <!-- <li>
                    <a href="#sidebarLibrary" data-toggle="collapse">
                        <i class="fe-book-open"></i>
                        <span> Library </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarLibrary">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('student.library.books')}}" class="nav-link {{ (request()->is('student/book')) ? 'active' : '' }}">
                                    <span>Book</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('student.library.book_issued')}}" class="nav-link {{ (request()->is('student/book_issued')) ? 'active' : '' }}">
                                    <span>Issued Book</span>
                                </a>
                            </li> 
                        </ul>
                    </div>
                </li> -->
        <li>
            <a href="{{ route('student.events')}}" class="nav-link {{ (request()->is('student/events*')) ? 'active' : '' }}">
                <i class="fas fa-map"></i>
                <span> Events </span>
            </a>
        </li>
        <li>
            <a href="{{ route('student.forum.index')}}" target=”_blank” class="nav-link {{ (request()->is('student/forum*')) ? 'active' : '' }}">
                <i class="far fa-comments"></i>
                <span> Forum </span>
            </a>
        </li>
        <li>
            <a href="{{ route('student.faq.Index')}}" class="nav-link {{ (request()->is('student/faq*')) ? 'active' : '' }}">
                <i class="fas fa-question"></i>
                <span> FAQs </span>
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