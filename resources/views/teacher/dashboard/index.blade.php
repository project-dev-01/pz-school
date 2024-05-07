@extends('layouts.admin-layout')
@section('title',' ' . __('messages.dashboard') . '')
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
<link href="{{ asset('css/custom/commonresponsive.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/calendarresponsive.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
        <div class="page-title-box" style="display: inline-flex; align-items: center;">
                <div class="page-title-icon">
                    <svg width="20" height="20" viewBox="0 0 28 28" fill="#3A4265" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.33333 13.3333H9.33333C9.68696 13.3333 10.0261 13.1929 10.2761 12.9428C10.5262 12.6928 10.6667 12.3536 10.6667 12V1.33333C10.6667 0.979711 10.5262 0.640573 10.2761 0.390524C10.0261 0.140476 9.68696 0 9.33333 0H1.33333C0.979711 0 0.640573 0.140476 0.390524 0.390524C0.140476 0.640573 0 0.979711 0 1.33333V12C0 12.3536 0.140476 12.6928 0.390524 12.9428C0.640573 13.1929 0.979711 13.3333 1.33333 13.3333ZM0 22.6667C0 23.0203 0.140476 23.3594 0.390524 23.6095C0.640573 23.8595 0.979711 24 1.33333 24H9.33333C9.68696 24 10.0261 23.8595 10.2761 23.6095C10.5262 23.3594 10.6667 23.0203 10.6667 22.6667V17.3333C10.6667 16.9797 10.5262 16.6406 10.2761 16.3905C10.0261 16.1405 9.68696 16 9.33333 16H1.33333C0.979711 16 0.640573 16.1405 0.390524 16.3905C0.140476 16.6406 0 16.9797 0 17.3333V22.6667ZM13.3333 22.6667C13.3333 23.0203 13.4738 23.3594 13.7239 23.6095C13.9739 23.8595 14.313 24 14.6667 24H22.6667C23.0203 24 23.3594 23.8595 23.6095 23.6095C23.8595 23.3594 24 23.0203 24 22.6667V13.3333C24 12.9797 23.8595 12.6406 23.6095 12.3905C23.3594 12.1405 23.0203 12 22.6667 12H14.6667C14.313 12 13.9739 12.1405 13.7239 12.3905C13.4738 12.6406 13.3333 12.9797 13.3333 13.3333V22.6667ZM14.6667 9.33333H22.6667C23.0203 9.33333 23.3594 9.19286 23.6095 8.94281C23.8595 8.69276 24 8.35362 24 8V1.33333C24 0.979711 23.8595 0.640573 23.6095 0.390524C23.3594 0.140476 23.0203 0 22.6667 0H14.6667C14.313 0 13.9739 0.140476 13.7239 0.390524C13.4738 0.640573 13.3333 0.979711 13.3333 1.33333V8C13.3333 8.35362 13.4738 8.69276 13.7239 8.94281C13.9739 9.19286 14.313 9.33333 14.6667 9.33333Z" />
                    </svg>
                </div>
                <h4 class="page-title" style="margin-left: 10px;">{{ __('messages.dashboard') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
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
    @include('teacher.dashboard.order_base_show_div.leave_details')

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
    @include('teacher.dashboard.order_base_show_div.' . $foundKey, ['row_details' => $r])

    @endif
    @endif

    @empty
    @endforelse
<!-- modal popup -->
@include('teacher.dashboard.order_base_show_div.birthday_modal')
@include('teacher.dashboard.order_base_show_div.bulk_modal')
@include('teacher.dashboard.order_base_show_div.teacher_modal')
@include('teacher.dashboard.order_base_show_div.view_event_modal')

    <!-- leave details -->
    <!-- task -->
    <!-- teacher calendar -->
</div>
<!-- student_ranking_class and sub -->
<!-- semester_wise_exam_marks -->
<!-- student_top_10_ranking -->
<!-- student_bottom_10_ranking -->
<!-- staff_leave_details -->
<!-- shortcut links -->
</div>
</div>
@include('teacher.dashboard.check_list')
@include('teacher.dashboard.task')
@include('teacher.dashboard.task-show')
@include('teacher.dashboard.exam-schedule')
@include('admin.dashboard.taskupdate')

</div> <!-- container -->
@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- full calendar js end -->
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('libs/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('libs/morris.js06/morris.min.js') }}"></script>
<script src="{{ asset('libs/raphael/raphael.min.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- validation -->
<script src="{{ asset('js/validation/validation.js') }}"></script>

<!-- full calendar js start -->
<script src="{{ asset('libs/@fullcalendar/core/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/bootstrap/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/daygrid/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/timegrid/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/list/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/interaction/main.min.js') }}"></script>
<!-- full calendar js end -->
<!-- button js added -->
<script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>

<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
<script>
    // calendor js

    var getBirthdayCalendor = "{{ config('constants.api.get_birthday_calendor_teacher') }}";
    var getTimetableCalendor = "{{ config('constants.api.get_timetable_calendor') }}";
    var getBulkCalendor = "{{ config('constants.api.get_bulk_calendor_teacher') }}";
    var getEventCalendor = "{{ config('constants.api.get_event_calendor') }}";
    var getEventGroupCalendor = "{{ config('constants.api.get_event_group_calendor') }}";
    var redirectionURL = "{{ route('teacher.classroom.management')}}";
    // todo list js
    var readUpdateTodoUrl = "{{ config('constants.api.read_update_todo') }}";
    var getAssignClassUrl = "{{ config('constants.api.get_assign_class') }}";
    var pathDownloadFileUrl = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/images/todolist/' }}";
    var toDoCommentsUrl = "{{ config('constants.api.to_do_comments') }}";
    var getScheduleExamDetailsUrl = "{{ config('constants.api.get_schedule_exam_details_by_teacher') }}";

    var buletinBoardList = "{{ route('teacher.buletin_board.dashboradlist') }}";
    var image_url = "{{config('constants.image_url') . '/' . config('constants.branch_id') . '/admin-documents/buletin_files/'}}";

    var UserName = "{{ Session::get('name') }}";
    var hiddenWks = "{{ $hiddenWeekends }}";
    // task all url
    var calendorAddTaskCalendor = "{{ config('constants.api.calendor_add_task_calendor') }}";
    var calendorListTaskCalendor = "{{ config('constants.api.calendor_list_task_calendor') }}";
    var calendorEditTaskCalendor = "{{ config('constants.api.calendor_edit_task_calendor') }}";
    var calendorUpdateTaskCalendor = "{{ config('constants.api.calendor_update_task_calendor') }}";
    var calendorDeleteTaskCalendor = "{{ config('constants.api.calendor_delete_task_calendor') }}";


    var teacherSectionUrl = "{{ config('constants.api.teacher_section') }}";
    var subjectByExamNames = "{{ config('constants.api.subject_by_exam_names') }}";

    var getMarksByStudent = "{{ config('constants.api.get_marks_by_student') }}";

    // var getTenStudent = "{{ config('constants.api.get_ten_student') }}";
    var getTenStudent = "{{ config('constants.api.all_student_ranking') }}";
    var getStudentList = "{{ config('constants.api.get_student_details') }}";
    var all_exam_subject_scores = "{{ config('constants.api.all_exam_subject_scores') }}";
    var staffLeaveHistoryDashboardUrl = "{{ config('constants.api.staff_leave_history_dashboard') }}";

    var studentTransferListUrl = "{{ config('constants.api.student_transfer_list') }}";
    var studentNewJoiningListUrl = "{{ config('constants.api.student_new_joining_list') }}";

    var getTestScore = "{{ config('constants.api.get_test_score_dashboard') }}";
    // all exam subject scores
    var allExamSubjectScores = "{{ config('constants.api.all_exam_subject_scores') }}";
    // all exam subject ranks
    var allExamSubjectRanks = "{{ config('constants.api.all_exam_subject_ranks') }}";
    var examByStudent = "{{ config('constants.api.exam_by_student') }}";
    var examSubjectMarkHighLowAvg = "{{ config('constants.api.exam_subject_mark_high_low_avg') }}";
    var getPublicHolidays = "{{ config('constants.api.get_public_holidays') }}";
    // Get PDF Footer Text
    var header_txt = "{{ __('messages.assign') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
    // work week
    var getWorkWeekUrl = "{{ config('constants.api.work_week') }}";
</script>
<!-- to calendor  -->
<!-- <script src="{{ asset('js/custom/teacher_calendor.js') }}"></script> -->
<script src="{{ asset('js/custom/dashboard_attendance_report_stg.js') }}"></script>
<script src="{{ asset('js/custom/teacher_calendor_new_cal.js') }}"></script>

<!-- to do list -->
<script src="{{ asset('js/custom/teacher_dashboard.js') }}"></script>
<script src="{{ asset('js/custom/admin/dashboard.js') }}"></script>
<script src="{{ asset('js/custom/greeting.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>

@endsection