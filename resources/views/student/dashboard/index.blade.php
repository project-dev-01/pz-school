@extends('layouts.admin-layout')
@section('title','Dashboard')
@section('content')
<!-- <link href="{{ asset('public/css/custom/calendar.css') }}" rel="stylesheet" type="text/css" /> -->
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
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="">
                <!-- tasks panel -->
                <div class="row">
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv"> To Do List
                                                <h4>
                                        </li>
                                    </ul>
                                    <div class="card-body">
                                        <div class="row mt-4" data-plugin="dragula" data-containers='["task-list-one", "task-list-two", "task-list-three"]'>
                                            <div class="col">
                                                <a class="text-dark" data-toggle="collapse" href="#todayTasks" aria-expanded="false" aria-controls="todayTasks">
                                                    <h5 class="mb-0"><i class='mdi mdi-chevron-down font-18'></i> Today <span class="text-muted font-14">( {{count($get_to_do_list_dashboard['today'])}} )</span></h5>
                                                </a>
                                                <!-- Right modal -->
                                                <!-- <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#right-modal">Rightbar Modal</button> -->

                                                @forelse ($get_to_do_list_dashboard['today'] as $today)
                                                <div class="collapse show" id="todayTasks">
                                                    <div class="card mb-0 shadow-none">
                                                        <div class="card-body pb-0" id="task-list-one">
                                                            <!-- task -->
                                                            <div class="row justify-content-sm-between task-item">
                                                                <div class="col-lg-6 mb-2">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" data-id="{{ $today['id'] }}" class="custom-control-input admintaskListDashboard" id="today{{ $today['id'] }}" {{ ($today['user_id']) ? "checked" : "" }}>
                                                                        <label class="custom-control-label" for="today{{ $today['id'] }}">
                                                                            {{$today['title']}}
                                                                        </label>
                                                                    </div> <!-- end checkbox -->
                                                                </div> <!-- end col -->
                                                                <div class="col-lg-6">
                                                                    <div class="d-sm-flex justify-content-between">

                                                                        <div class="mt-3 mt-sm-0">
                                                                            <ul class="list-inline font-13 text-sm-right">
                                                                                <li class="list-inline-item pr-1">
                                                                                    <i class='mdi mdi-calendar-month-outline font-16 mr-1'></i>
                                                                                    <!-- Today 10am -->
                                                                                    {{ date('j F y g a', strtotime($today['due_date']));}}
                                                                                </li>
                                                                                <!-- <li class="list-inline-item pr-1">
                                                                                <i class='mdi mdi-tune font-16 mr-1'></i>
                                                                                3/7
                                                                            </li> -->
                                                                                <li class="list-inline-item pr-2" id="comments{{ $today['id'] }}">
                                                                                    <i class='mdi mdi-comment-text-multiple-outline font-16 mr-1'></i>
                                                                                    {{$today['total_comments']}}
                                                                                </li>
                                                                                <li class="list-inline-item">
                                                                                    @if($today['priority'] == "Low")
                                                                                    <span class="badge badge-soft-success p-1">{{$today['priority']}}</span>
                                                                                    @endif
                                                                                    @if($today['priority'] == "Medium")
                                                                                    <span class="badge badge-soft-info p-1">{{$today['priority']}}</span>
                                                                                    @endif
                                                                                    @if($today['priority'] == "High")
                                                                                    <span class="badge badge-soft-danger p-1">{{$today['priority']}}</span>
                                                                                    @endif
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div> <!-- end .d-flex-->
                                                                </div> <!-- end col -->
                                                            </div>
                                                            <!-- end task -->
                                                        </div> <!-- end card-body-->
                                                    </div> <!-- end card -->
                                                </div> <!-- end .collapse-->
                                                @empty
                                                <p></p>
                                                @endforelse

                                                <!-- upcoming tasks -->
                                                <div class="mt-4">
                                                    <a class="text-dark" data-toggle="collapse" href="#upcomingTasks" aria-expanded="false" aria-controls="upcomingTasks">
                                                        <h5 class="mb-0">
                                                            <i class='mdi mdi-chevron-down font-18'></i> Upcoming <span class="text-muted font-14">( {{count($get_to_do_list_dashboard['upcoming'])}} )</span>
                                                        </h5>
                                                    </a>
                                                    @forelse ($get_to_do_list_dashboard['upcoming'] as $upcoming)
                                                    <div class="collapse show" id="upcomingTasks">
                                                        <div class="card mb-0 shadow-none">
                                                            <div class="card-body pb-0" id="task-list-two">
                                                                <!-- task -->
                                                                <div class="row justify-content-sm-between task-item">
                                                                    <div class="col-lg-6 mb-2">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" data-id="{{ $upcoming['id'] }}" class="custom-control-input admintaskListDashboard" id="upcoming{{ $upcoming['id'] }}" {{ ($upcoming['user_id']) ? "checked" : "" }}>
                                                                            <label class="custom-control-label" for="upcoming{{ $upcoming['id'] }}">
                                                                                {{$upcoming['title']}}
                                                                            </label>
                                                                        </div> <!-- end checkbox -->
                                                                    </div> <!-- end col -->
                                                                    <div class="col-lg-6">
                                                                        <div class="d-sm-flex justify-content-between">
                                                                            <div class="mt-3 mt-sm-0">
                                                                                <ul class="list-inline font-13 text-sm-right">
                                                                                    <li class="list-inline-item pr-1">
                                                                                        <i class='mdi mdi-calendar-month-outline font-16 mr-1'></i>
                                                                                        {{ date('j F y g a', strtotime($upcoming['due_date']));}}

                                                                                    </li>
                                                                                    <!-- <li class="list-inline-item pr-1">
                                                                                    <i class='mdi mdi-tune font-16 mr-1'></i>
                                                                                    1/12
                                                                                </li> -->
                                                                                    <li class="list-inline-item pr-2" id="comments{{ $upcoming['id'] }}">
                                                                                        <i class='mdi mdi-comment-text-multiple-outline font-16 mr-1'></i>
                                                                                        {{$upcoming['total_comments']}}
                                                                                    </li>
                                                                                    <li class="list-inline-item">
                                                                                        @if($upcoming['priority'] == "Low")
                                                                                        <span class="badge badge-soft-success p-1">{{$upcoming['priority']}}</span>
                                                                                        @endif
                                                                                        @if($upcoming['priority'] == "Medium")
                                                                                        <span class="badge badge-soft-info p-1">{{$upcoming['priority']}}</span>
                                                                                        @endif
                                                                                        @if($upcoming['priority'] == "High")
                                                                                        <span class="badge badge-soft-danger p-1">{{$upcoming['priority']}}</span>
                                                                                        @endif
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div> <!-- end .d-flex-->
                                                                    </div> <!-- end col -->
                                                                </div>
                                                                <!-- end task -->
                                                            </div> <!-- end card-body-->
                                                        </div> <!-- end card -->
                                                    </div> <!-- end collapse-->
                                                    @empty
                                                    <p></p>
                                                    @endforelse

                                                </div>
                                                <!-- end upcoming tasks -->
                                                <!-- old tasks -->
                                                <div class="mt-4">
                                                    <a class="text-dark" data-toggle="collapse" href="#pastTasks" aria-expanded="false" aria-controls="pastTasks">
                                                        <h5 class="mb-0">
                                                            <i class='mdi mdi-chevron-down font-18'></i> Past <span class="text-muted font-14">( {{count($get_to_do_list_dashboard['old'])}} )</span>
                                                        </h5>
                                                    </a>
                                                    @forelse ($get_to_do_list_dashboard['old'] as $old)
                                                    <div class="collapse show" id="pastTasks">
                                                        <div class="card mb-0 shadow-none">
                                                            <div class="card-body pb-0" id="task-list-two">
                                                                <!-- task -->
                                                                <div class="row justify-content-sm-between task-item">
                                                                    <div class="col-lg-6 mb-2">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" data-id="{{ $old['id'] }}" class="custom-control-input admintaskListDashboard" id="old{{ $old['id'] }}" {{ ($old['user_id']) ? "checked" : "" }}>
                                                                            <label class="custom-control-label" for="old{{ $old['id'] }}">
                                                                                {{$old['title']}}
                                                                            </label>
                                                                        </div> <!-- end checkbox -->
                                                                    </div> <!-- end col -->
                                                                    <div class="col-lg-6">
                                                                        <div class="d-sm-flex justify-content-between">
                                                                            <div class="mt-3 mt-sm-0">
                                                                                <ul class="list-inline font-13 text-sm-right">
                                                                                    <li class="list-inline-item pr-1">
                                                                                        <i class='mdi mdi-calendar-month-outline font-16 mr-1'></i>
                                                                                        {{ date('j F y g a', strtotime($old['due_date']));}}

                                                                                    </li>
                                                                                    <!-- <li class="list-inline-item pr-1">
                                                                                    <i class='mdi mdi-tune font-16 mr-1'></i>
                                                                                    1/12
                                                                                </li> -->
                                                                                    <li class="list-inline-item pr-2" id="comments{{ $old['id'] }}">
                                                                                        <i class='mdi mdi-comment-text-multiple-outline font-16 mr-1'></i>
                                                                                        {{$old['total_comments']}}
                                                                                    </li>
                                                                                    <li class="list-inline-item">
                                                                                        @if($old['priority'] == "Low")
                                                                                        <span class="badge badge-soft-success p-1">{{$old['priority']}}</span>
                                                                                        @endif
                                                                                        @if($old['priority'] == "Medium")
                                                                                        <span class="badge badge-soft-info p-1">{{$old['priority']}}</span>
                                                                                        @endif
                                                                                        @if($old['priority'] == "High")
                                                                                        <span class="badge badge-soft-danger p-1">{{$old['priority']}}</span>
                                                                                        @endif
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div> <!-- end .d-flex-->
                                                                    </div> <!-- end col -->
                                                                </div>
                                                                <!-- end task -->
                                                            </div> <!-- end card-body-->
                                                        </div> <!-- end card -->
                                                    </div> <!-- end collapse-->
                                                    @empty
                                                    <p></p>
                                                    @endforelse

                                                </div>
                                                <!-- end old tasks -->
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->


                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div> <!-- end col -->

                    <!-- task details -->
                </div>
                <!-- task panel end -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- tasks panel -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv"> Homework List
                                            <h4>
                                    </li>
                                </ul><br>
                                <div class="card-body">

                                    @forelse ($get_homework_list_dashboard as $homework)
                                    <div class="row mt-4" data-plugin="dragula" data-containers='["task-list-one", "task-list-two", "task-list-three"]'>
                                        <div class="col">
                                            <a class="text-dark" data-toggle="collapse" href="#hmenv" aria-expanded="false" aria-controls="hmenv">
                                                <h5 class="mb-0"><i class='mdi mdi-chevron-down font-18'></i> {{$homework['title']}}<span class="text-muted font-14"></span></h5>
                                            </a>
                                            <!-- Right modal -->
                                            <!-- <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#right-modal">Rightbar Modal</button> -->
                                            <div class="collapse show" id="hmenv">
                                                <div class="card mb-0 shadow-none">
                                                    <div class="card-body pb-0" id="task-list-one">
                                                        <!-- task -->
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <a href="{{ route('student.homework')}}">{{$homework['subject_name']}} </a>
                                                            </div> <!-- end col -->
                                                            <div class="col-sm-6">
                                                                <div class="d-sm-flex">
                                                                    <!-- <div>
                                                                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="{{ route('parent.homework')}}" role="button" aria-haspopup="false" aria-expanded="false">
                                                                                <img src="{{ Session::get('picture') && asset('public/users/images/'.Session::get('picture')) ? asset('public/users/images/'.Session::get('picture')) : asset('public/images/users/default.jpg') }}" alt="user-image" class="rounded-circle admin_picture">
                                                                            </a>
                                                                        </div> -->
                                                                    <div class="mt-3 mt-sm-0">
                                                                        <ul class="list-inline font-13 text-sm-right">
                                                                            <li class="list-inline-item">
                                                                                <span class="badge badge-soft-danger">InComplete</span>
                                                                            </li>
                                                                            <li class="list-inline-item pr-1">
                                                                                <i class='mdi mdi-calendar-month-outline font-16'></i>
                                                                                Submission Date : {{$homework['date_of_submission']}}
                                                                            </li>
                                                                            <li class="list-inline-item text-danger">
                                                                            </li>

                                                                        </ul>
                                                                    </div>
                                                                </div> <!-- end .d-flex-->
                                                            </div> <!-- end col -->
                                                        </div>
                                                        <!-- end task -->
                                                    </div> <!-- end card-body-->
                                                </div> <!-- end card -->
                                            </div> <!-- end .collapse-->

                                        </div> <!-- end col -->
                                    </div> <!-- Maths row -->
                                    @empty
                                    <p></p>
                                    @endforelse

                                </div> <!-- end card-body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div> <!-- end col -->

                <!-- task details -->
            </div>
            <!-- task panel end -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="student_calendor"></div>
                        </div>
                    </div> <!-- end row -->
                </div> <!-- end card body-->
            </div> <!-- end card -->

            <!-- Add New Event MODAL -->
            <!-- Add New Event MODAL -->
            <div class="modal fade" id="student-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header py-3 px-4 border-bottom-0 d-block">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h5 class="modal-title">Schedule</h5>
                        </div>
                        <div class="modal-body p-4">
                            <form id="addStudentReport" method="post" action="{{ route('student.classroom.add_daily_report_remarks') }}" autocomplete="off">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="col-md-12 font-weight-bold">Standard </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="col-md-12 font-weight-bold">:</div>
                                    </div>
                                    <div class="col-7">

                                        <input type="hidden" id="setCurDate" name="date">
                                        <input type="hidden" id="ttclassID" name="class_id">
                                        <div class="col-md-12" id="standard-name"></div>
                                    </div>
                                    <div class="col-4">
                                        <div class="col-md-12 font-weight-bold">Section </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="col-md-12 font-weight-bold">:</div>
                                    </div>
                                    <div class="col-7">
                                        <input type="hidden" id="ttSectionID" name="section_id">
                                        <div class="col-md-12" id="section-name"></div>
                                    </div>

                                    <div class="col-4">
                                        <div class="col-md-12 font-weight-bold">Subject Name </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="col-md-12 font-weight-bold">:</div>
                                    </div>
                                    <div class="col-7">
                                        <input type="hidden" id="ttSubjectID" name="subject_id">
                                        <div class="col-md-12" id="subject-name"></div>
                                    </div>

                                    <div class="col-4">
                                        <div class="col-md-12 font-weight-bold">Timing </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="col-md-12 font-weight-bold">:</div>
                                    </div>
                                    <div class="col-7">
                                        <input type="hidden" id="ttDate">
                                        <div class="col-md-12" id="timing-class"></div>
                                    </div>
                                    <div class="col-4">
                                        <div class="col-md-12 font-weight-bold">Teacher Name </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="col-md-12 font-weight-bold">:</div>
                                    </div>
                                    <div class="col-7">
                                        <div class="col-md-12" id="teacher-name"></div>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control" style="margin: 12px;" placeholder="Enter your notes" id="calNotes" name="student_remarks"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6 text-left">
                                        <button type="submit" class="btn btn-success" id="btn-save-event">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> <!-- end modal-content-->
                </div> <!-- end modal dialog-->
            </div>
            <div class="modal fade " id="bulk-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myviewBulkModalLabel"> <i class="fas fa-info-circle"></i> Details </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="card-box">
                                        <div class="table-responsive">
                                            <p class="text-center"> Name :<span id="bulk_name"></span></p><br>
                                        </div>
                                    </div> <!-- end card-box -->
                                </div> <!-- end col -->
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div class="modal fade viewEvent" id="event-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myviewEventModalLabel"> <i class="fas fa-info-circle"></i> Event Details </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="card-box">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tr>
                                                    <td>Title</td>
                                                    <td id="title"></td>
                                                </tr>
                                                <tr>
                                                    <td>Type</td>
                                                    <td id="type"></td>
                                                </tr>
                                                <tr>
                                                    <td>Start Date</td>
                                                    <td id="start_date"></td>
                                                </tr>
                                                <tr>
                                                    <td>End Date</td>
                                                    <td id="end_date"></td>
                                                </tr>
                                                <tr id="start_time_row" style="display:none">
                                                    <td>Start Time</td>
                                                    <td id="start_time"></td>
                                                </tr>
                                                <tr id="end_time_row" style="display:none">
                                                    <td>End Time</td>
                                                    <td id="end_time"></td>
                                                </tr>
                                                <tr>
                                                    <td>Audience</td>
                                                    <td id="audience"></td>
                                                </tr>
                                                <tr>
                                                    <td>Description</td>
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
            <!-- end modal-->
        </div>
        <!-- end col-12 -->
    </div> <!-- end row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> Test Score Analysis
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="mt-4 chartjs-chart">
                        <canvas id="radar-chart-test-marks" data-colors="#39afd1,#a17fe0"></canvas>
                        <!-- <canvas id="marksChart" height="350" data-colors="#39afd1,#a17fe0"></canvas> -->
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Marks by Subject
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="card-widgets">
                        <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                        <a data-toggle="collapse" href="#cardCollpase2" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
                        <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                    </div>
                    <h4 class="header-title mb-0">Marks by Subject</h4>

                    <div id="cardCollpase2" class="collapse pt-3 show" dir="ltr">
                        <div id="apex-line-1" class="apex-charts" data-colors="#9B59B6,#E91E63,#4A6F4B,#f7b84b,#4a81d4"></div>
                    </div> <!-- collapsed end -->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    @include('student.dashboard.check_list')
    @include('student.dashboard.exam-schedule')
</div> <!-- container -->
@endsection
@section('scripts')
<script>
    var getTimetableCalendorStudent = "{{ config('constants.api.get_timetable_calendor_student') }}";
    var getEventCalendorStudent = "{{ config('constants.api.get_event_calendor_student') }}";
    var getBulkCalendor = "{{ config('constants.api.get_bulk_calendor_student') }}";
    // todo list js
    var readUpdateTodoUrl = "{{ config('constants.api.read_update_todo') }}";
    var getAssignClassUrl = "{{ config('constants.api.get_assign_class') }}";
    var pathDownloadFileUrl = "{{ asset('public/images/todolist/') }}";
    var toDoCommentsUrl = "{{ config('constants.api.to_do_comments') }}";
    var getTestScore = "{{ config('constants.api.get_test_score_dashboard') }}";

    var UserName = "{{ Session::get('name') }}";
    var getScheduleExamDetailsUrl = "{{ config('constants.api.get_schedule_exam_details_by_student') }}";
</script>
<!-- <script src="{{ asset('public/js/custom/student_calendor.js') }}"></script> -->
<!-- <script src="{{ asset('public/js/custom/student_dashboard.js') }}"></script> -->
<!-- <script src="{{ asset('public/js/custom/student_calendor_new.js') }}"></script> -->
<script src="{{ asset('public/js/custom/student_calendor_new_cal.js') }}"></script>
<!-- to do list -->
<script src="{{ asset('public/js/custom/admin/dashboard.js') }}"></script>
@endsection