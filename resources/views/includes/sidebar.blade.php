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
                        <i data-feather="map"></i>
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
                     
                        <i data-feather="external-link" class="icon-dual"></i>
                        <span> Application Form </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('super_admin.forum.rolls-chooseforum')}}" target=”_blank” class="nav-link {{ (request()->is('super_admin/forum*')) ? 'active' : '' }}">
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
                <li>
                    <a href="{{ route('super_admin.faq.index')}}" class="nav-link {{ (request()->is('super_admin/settings*')) ? 'active' : '' }}">
                        <i class="fas fa-question"></i>
                        <span> FAQs </span>
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
                    <a href="#sidebarAdmission" data-toggle="collapse">
                        <i class="fe-edit"></i>
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
                        <i class="fas fa-users"></i>
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
                        <i class="fe-user-plus"></i>
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
                        <i class="fas fa-users"></i>
                        <span> Employee </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEmployee">
                        <ul class="nav-second-level">
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
                    <i data-feather="external-link" class="icon-dual"></i>
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
                    <a href="#sidebarAcademic" data-toggle="collapse">
                        <i data-feather="home"></i>
                        <span> Academic </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAcademic">
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
                    <a href="#sidebarHomework" data-toggle="collapse">
                        <i class="fe-book-open"></i>
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
                    <i data-feather="external-link" class="icon-dual"></i>
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
                        <i data-feather="map"></i>
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
                                <a href="{{ route('admin.attendance.exam_entry')}}" class="nav-link {{ (request()->is('admin/attendance/exam_entry')) ? 'active' : '' }}">
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
                                <a href="{{ route('admin.test_result')}}"  class="nav-link {{ (request()->is('admin/test_result*')) ? 'active' : '' }}">
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
                                            <a href="{{ route('admin.hostel')}}" class="nav-link {{ (request()->is('admin/hostel')) ? 'active' : '' }}">
                                                <span> Hostel Master </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.hostel.room')}}" class="nav-link {{ (request()->is('admin/hostel/room')) ? 'active' : '' }}">
                                                <span> Hostel Room </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.hostel.category')}}" class="nav-link {{ (request()->is('admin/hostel/category')) ? 'active' : '' }}">
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
                                            <a href="{{ route('admin.transport.route')}}" class="nav-link {{ (request()->is('admin/transport/route')) ? 'active' : '' }}">
                                                <span> Route Master </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.transport.vehicle')}}" class="nav-link {{ (request()->is('admin/transport/vehicle')) ? 'active' : '' }}">
                                                <span> Vehicle Master</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.transport.stoppage')}}" class="nav-link {{ (request()->is('admin/transport/stoppage')) ? 'active' : '' }}">
                                                <span> Stoppage</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.transport.assignvehicle')}}" class="nav-link {{ (request()->is('admin/transport/assignvehicle')) ? 'active' : '' }}">
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
                        <i data-feather="map"></i>
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
                        <i data-feather="external-link" class="icon-dual"></i>
                        <span> Forum </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.settings')}}" class="nav-link {{ (request()->is('admin/settings*')) ? 'active' : '' }}">
                        <i data-feather="settings" class="icon-dual"></i>
                        <span> Settings </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.faq.index')}}" class="nav-link {{ (request()->is('admin/settings*')) ? 'active' : '' }}">
                        <i class="fas fa-question"></i>
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
                        <i data-feather="map"></i>
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
                        <i data-feather="map"></i>
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
                        <i data-feather="external-link" class="icon-dual"></i>
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
                        <i data-feather="activity" class="icon-dual"></i>.                     
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
                        <i data-feather="file-plus" class="icon-dual"></i>
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
                        <i class="fas fa-users"></i>
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
                        <i data-feather="map"></i>
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
                     
                        <i data-feather="external-link" class="icon-dual"></i>
                        <span> Forum </span>
                    </a>
                </li>
                <li>
                <a href="{{ route('schoolcrm.app.form')}}" target=”_blank” class="nav-link {{ (request()->is('application-form')) ? 'active' : '' }}">
                     
                        <i data-feather="external-link" class="icon-dual"></i>
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
                    <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('parent.analyticrep.analyticreport')}}" class="nav-link {{ (request()->is('parent/analyticrep*')) ? 'active' : '' }}">                    
                        <i data-feather="activity" class="icon-dual"></i>.                     
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
                        <i data-feather="book" class="icons-xs icon-dual"></i>
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
                        <i data-feather="map"></i>    
                        <span> Attendance </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('parent.timetable.index')}}" class="nav-link {{ (request()->is('parent/timetable*')) ? 'active' : '' }}">
                    <i data-feather="external-link" class="icon-dual"></i>
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
                     
                        <i data-feather="external-link" class="icon-dual"></i>
                        <span> Application Form </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('parent.forum.index')}}" target=”_blank” class="nav-link {{ (request()->is('parent/forum*')) ? 'active' : '' }}">
                        <i data-feather="external-link" class="icon-dual"></i>
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
                        <i data-feather="activity" class="icon-dual"></i>.                     
                        <span> Analytic </span>
                    </a>
                </li> 
                <li>
                    <a href="{{ route('student.timetable')}}" class="nav-link {{ (request()->is('super_admin/timetable*')) ? 'active' : '' }}">
                        <i data-feather="external-link" class="icon-dual"></i>
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
                        <i data-feather="book" class="icons-xs icon-dual"></i>
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
                        <i data-feather="external-link" class="icon-dual"></i>
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