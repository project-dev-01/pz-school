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
<link href="{{ asset('css/custom/calendarresponsive.css') }}" rel="stylesheet" type="text/css" />
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
<!-- <script src="{{ asset('js/custom/teacher_calendor_new.js') }}"></script> -->
<script src="{{ asset('js/custom/teacher_calendor_new_cal.js') }}"></script>

<!-- to do list -->
<script src="{{ asset('js/custom/teacher_dashboard.js') }}"></script>
<script src="{{ asset('js/custom/admin/dashboard.js') }}"></script>
<script src="{{ asset('js/custom/greeting.js') }}"></script>

@endsection