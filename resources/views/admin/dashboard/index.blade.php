@extends('layouts.admin-layout')
@section('title','Dashboard')
@section('calendar')
<!-- full calendar css start-->
<link href="{{ asset('libs/@fullcalendar/core/main.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/@fullcalendar/daygrid/main.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/@fullcalendar/bootstrap/main.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/@fullcalendar/timegrid/main.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/@fullcalendar/list/main.min.css') }}" rel="stylesheet" type="text/css" />
<!-- full calendar css end-->
@endsection
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">
<!-- date picker -->
<link href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/greeting.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/calendar.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/calendarresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- <style>
    svg {
        height: 48px;
        margin: 0 2em;
        fill: darkorange;
    }
</style> -->
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <!-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div> -->
                <h4 class="page-title">{{ __('messages.dashboard') }}</h4>
            </div>
        </div>
    </div>
    @if(Session::get('greetting_id') == '1')
    <div class="row" id="hideGreeting">
        <div class="col-md-6 col-xl-6">
            <div class="widget-rounded-circle card-box">
                <div class="card-widgets">
                    <!-- <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a> -->
                </div>
                <div class="row">
                    <div class="col-6">
                        <p class="greetingText">
                            {{ $greetings }}
                        </p>
                        <h3 class="greetingName">{{ Session::get('name') }}</h3>
                    </div>
                    <div class="col-6">
                        <div class="float-right">
                            <div class="greetingCntRing">
                                <span id="greetingRingCnt">3</span>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>
    @endif
    <!-- end page title -->
    <!-- <div class="row">
        <div class="col-md-3 col-xl-3 col-sm-3 col-lg-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-pink border-pink border">
                            <i class="mdi mdi-account-group font-22 avatar-title text-pink"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1"><span data-plugin="counterup">{{$count['employee_count']}}</span></h3>
                            <p class="text-muted mb-1 text-truncate">{{ __('messages.employee') }}</p>
                        </div>
                    </div>
                </div> 
            </div>
        </div> 

        <div class="col-md-3 col-xl-3 col-sm-3 col-lg-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                            <i class="mdi mdi-school font-22 avatar-title text-success"></i>
                        </div>
                    </div>
                    <div class="col-6">

                        <div class="text-right">
                            <h3 class="mt-1"><span data-plugin="counterup">{{$count['student_count']}}</span></h3>
                            <p class="text-muted mb-1 text-truncate">{{ __('messages.students') }}</p>
                        </div>
                    </div>
                </div> 
            </div>
        </div> 

        <div class="col-md-3 col-xl-3 col-sm-3 col-lg-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                            <i class="mdi mdi-human-male-child font-22 avatar-title text-info"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1"><span data-plugin="counterup">{{$count['parent_count']}}</span></h3>
                            <p class="text-muted mb-1 text-truncate">{{ __('messages.parents') }}</p>
                        </div>
                    </div>
                </div> 
            </div>
        </div> 

        <div class="col-md-3 col-xl-3 col-sm-3 col-lg-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                            <i class="mdi mdi-teach font-22 avatar-title text-warning"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1"><span data-plugin="counterup">{{$count['teacher_count']}}</span></h3>
                            <p class="text-muted mb-1 text-truncate">{{ __('messages.teachers') }}</p>
                        </div>
                    </div>
                </div> 
            </div>
        </div> 
    </div> -->
    @php
    $taskBladeFileName = 'task'; // Your dynamic file name variable
    $calendarBladeFileName = 'calendar'; // Your dynamic file name variable
    $attendanceBladeFileName = 'attendance'; // Your dynamic file name variable
    $studentPlanLeaveBladeFileName = 'student_plan_leave'; // Your dynamic file name variable
    $studentTransferListBladeFileName = 'student_transfer_list'; // Your dynamic file name variable
    $studentNewJoiningBladeFileName = 'studentnewjoining'; // Your dynamic file name variable
    $shortcutBladeFileName = 'shortcut'; // Your dynamic file name variable
    $bulletinBladeFileName = 'bulletin'; // Your dynamic file name variable
    $bladeKeyAndDashboardHideUnhideVal = [
    'attendance' => 'AttendanceReport',
    'calendar' => 'Calendar',
    'task' => 'Task',
    'student_transfer_list' => 'StudentTransferredList',
    'shortcut' => 'ShortcutLinks',
    'bulletin' => 'BulletinBoard',
    'student_plan_leave' => 'StudentPlanToLeave',
    'studentnewjoining' => 'StudentNewJoining',
    ];
    @endphp

    @forelse($get_data_hide_unhide_dashboard as $r)

    @php
    $foundKey = array_search($r['widget_value'], $bladeKeyAndDashboardHideUnhideVal);
    @endphp

    @if ($foundKey !== false)
    @if ($r['visibility'] == '0')
    @include('admin.dashboard.order_base_show_div.' . $foundKey, ['row_details' => $r])

    @endif
    @endif

    @empty
    @endforelse
    <!-- Add New Event MODAL -->
    <div class="modal fade viewEvent" id="admin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myviewEventModalLabel" style="color: #6FC6CC"> <i class="fas fa-info-circle"></i>{{ __('messages.event_details') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="card-box eventpopup" style="background-color: #8adfee14;">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <style>
                                            .table td {
                                                border-top: none;
                                                text-align: justify;
                                            }
                                        </style>
                                        <tr>
                                            <td>{{ __('messages.title') }}</td>
                                            <td id="title"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.type') }}</td>
                                            <td id="type"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.start_date') }}</td>
                                            <td id="start_date"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.end_date') }}</td>
                                            <td id="end_date"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.audience') }}</td>
                                            <td id="audience"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.description') }}</td>
                                            <td id="description"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade " id="bulk-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myviewBulkModalLabel"> <i class="fas fa-info-circle"></i>{{ __('messages.details') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="card-box">
                                <div class="table-responsive">
                                    <p class="text-center"> {{ __('messages.name') }} :<span id="bulk_name"></span></p><br>
                                </div>
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade " id="birthday-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myviewBirthdayModalLabel"> <i class="fas fa-info-circle"></i>{{ __('messages.birthday') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="card-box">
                                <div class="table-responsive">
                                    <p class="text-center"> {{ __('messages.happy_birthday') }} <span id="name"></span></p>
                                </div>
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @include('admin.dashboard.check_list')
    @include('admin.dashboard.task')
    @include('admin.dashboard.task-show')
    @include('admin.dashboard.exam-schedule')
    @include('admin.dashboard.taskupdate')

</div> <!-- container -->
@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<!-- <script src="{{ asset('date-picker/jquery-ui.js') }}"></script> -->
<script>
    toastr.options.preventDuplicates = true;
</script>

<script src="{{ asset('js/validation/validation.js') }}"></script>

<!-- full calendar js start -->
<script src="{{ asset('libs/@fullcalendar/core/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/bootstrap/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/daygrid/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/timegrid/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/list/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/interaction/main.min.js') }}"></script>
<!-- full calendar js end -->
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
<!-- button js added -->
<script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>

<script>
    var getBirthdayCalendorAdmin = "{{ config('constants.api.get_birthday_calendor_admin') }}";
    var getEventCalendorAdmin = "{{ config('constants.api.get_event_calendor_admin') }}";
    var getEventGroupCalendorAdmin = "{{ config('constants.api.get_event_group_calendor_admin') }}";
    var getBulkCalendor = "{{ config('constants.api.get_bulk_calendor_admin') }}";
    var readUpdateTodoUrl = "{{ config('constants.api.read_update_todo') }}";
    var getAssignClassUrl = "{{ config('constants.api.get_assign_class') }}";
    var pathDownloadFileUrl = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/images/todolist/' }}";
    var toDoCommentsUrl = "{{ config('constants.api.to_do_comments') }}";
    var getScheduleExamDetailsUrl = "{{ config('constants.api.get_schedule_exam_details') }}";

    var UserName = "{{ Session::get('name') }}";
    var hiddenWks = "{{ $hiddenWeekends }}";
    // task all url
    var calendorAddTaskCalendor = "{{ config('constants.api.calendor_add_task_calendor') }}";
    var calendorListTaskCalendor = "{{ config('constants.api.calendor_list_task_calendor') }}";
    var calendorEditTaskCalendor = "{{ config('constants.api.calendor_edit_task_calendor') }}";
    var calendorUpdateTaskCalendor = "{{ config('constants.api.calendor_update_task_calendor') }}";
    var calendorDeleteTaskCalendor = "{{ config('constants.api.calendor_delete_task_calendor') }}";
    // work week
    var getWorkWeekUrl = "{{ config('constants.api.work_week') }}";
    var getPublicHolidays = "{{ config('constants.api.get_public_holidays') }}";
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
    var absent_attendance_reportUrl = "{{ config('constants.api.absent_attendance_report') }}";
    var teacherSectionUrl = "{{ config('constants.api.section_by_class') }}";
    // var presentStudentTerminationListUrl = "{{ route('admin.student_termination.list') }}";

    var studentPlanToLeaveListUrl = "{{ config('constants.api.student_plan_to_leave') }}";
    var studentTransferListUrl = "{{ config('constants.api.student_transfer_list') }}";
    var studentNewJoiningListUrl = "{{ config('constants.api.student_new_joining_list') }}";

    var header_txt = "{{ __('messages.student_plan_to_leave') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
    var deptIDs = "{{ (isset($get_settings_row['department_id']) ? $get_settings_row['department_id'] : null) }}";
    var classIDS = "{{ (isset($get_settings_row['class_id']) ? $get_settings_row['class_id'] : null) }}";
    var secIDs = "{{ (isset($get_settings_row['section_id']) ? $get_settings_row['section_id'] : null) }}";
    var patternNames = "{{ (isset($get_settings_row['pattern']) ? $get_settings_row['pattern'] : null) }}";
</script>
<!-- <script src="{{ asset('js/custom/admin_calendor.js') }}"></script> -->
<script src="{{ asset('js/custom/admin_calendor_new_cal.js') }}"></script>
<script src="{{ asset('js/custom/admin/dashboard.js') }}"></script>
<script src="{{ asset('js/custom/greeting.js') }}"></script>
<script src="{{ asset('js/custom/dashboard_attendance_report_stg.js') }}"></script>
@if(!empty(Session::get('school_roleid')))
<script>
var checkpermissions = "{{ route('admin.school_role.checkpermissions') }}";
</script>
<script src="{{ asset('js/custom/permissions.js') }}"></script>
@endif
@endsection