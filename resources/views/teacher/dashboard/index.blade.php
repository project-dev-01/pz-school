@extends('layouts.admin-layout')
@section('title','Dashboard')
@section('content')
<link href="{{ asset('public/css/custom/greeting.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/css/custom/calendar.css') }}" rel="stylesheet" type="text/css" />
<style>
    .badge-soft-success {
        background-color: #77D9B0;
        color: black;
        display: inline-block;
        padding: 8px 30px;
        width: 97px;
        height: 24px;
        border-radius: 5px;
    }

    .badge-soft-info {
        background-color: #E2C181;
        color: black;
        display: inline-block;
        padding: 8px 30px;
        width: 97px;
        height: 24px;
        border-radius: 5px;
    }

    .badge-soft-danger {
        background-color: #E45555;
        color: black;
        display: inline-block;
        padding: 8px 30px;
        width: 97px;
        height: 24px;
        border-radius: 5px;
    }

    .pr-2 {
        width: 150px;
    }

    .table td {
        border-top: none;
    }

    .homework-list {
        display: inline-block;
        position: relative;
        padding-right: 10px;
    }

    .homework-list::after {
        content: ":";
        position: absolute;
        right: 10px;
    }

    .hover1:hover {
        background-color: #D1E9EF;
    }

    @media screen and (min-device-width: 320px) and (max-device-width: 660px) {
        .popupresponsive {
            margin: 0px -65px 0px -70px;
            word-wrap: break-word;
        }
    }

    @media screen and (min-device-width: 280px) and (max-device-width: 653px) {
        .popupresponsive {
            margin: 0px -78px 0px -78px;

        }

        .eventpopup {
            margin: 0px -30px 0px -27px;
        }
    }

    @media screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        .popupresponsive {
            margin: 0px -65px 0px -65px;
        }

    }
</style>

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
                                <span id="greetingRingCnt">5</span>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>
    @endif
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="">
                            <svg width="24" height="21" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.67 9.13C17.04 10.06 18 11.32 18 13V16H22V13C22 10.82 18.43 9.53 15.67 9.13Z" fill="#3A4265" />
                                <path d="M8 8C10.2091 8 12 6.20914 12 4C12 1.79086 10.2091 0 8 0C5.79086 0 4 1.79086 4 4C4 6.20914 5.79086 8 8 8Z" fill="#3A4265" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14 8C16.21 8 18 6.21 18 4C18 1.79 16.21 0 14 0C13.53 0 13.09 0.0999998 12.67 0.24C13.5 1.27 14 2.58 14 4C14 5.42 13.5 6.73 12.67 7.76C13.09 7.9 13.53 8 14 8Z" fill="#3A4265" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 9C5.33 9 0 10.34 0 13V16H16V13C16 10.34 10.67 9 8 9Z" fill="#3A4265" />
                            </svg>
                            <p class="mb-1 text-truncate">Teachers</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="my-1"><span style="color:#3A4265" data-plugin="counterup">{{$count['teacher_count']}}</span></h3>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="progress progress-sm m-0">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        </div>
                    </div>
                    <h6 class="text-uppercase"><span class="float-right" style="color:#3A4265">Total Strength</span></h6>
                </div>
            </div> <!-- end card-box-->

        </div> <!-- end col-->
    </div>
    <!-- end row-->
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">To Do List<h4>
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
                                        <div class="card shadow-none">
                                            <div class="card-body" id="task-list-one">
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
                                                                    <li class="list-inline-item" id="comments{{ $today['id'] }}">
                                                                        <i class='mdi mdi-comment-text-multiple-outline font-16 mr-1'></i>
                                                                        {{$today['total_comments']}}
                                                                    </li>
                                                                    <li class="list-inline-item mt-3 mt-sm-0">
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
                                                <hr class="my-2" style="margin-bottom: 1px!important;;margin-top: 1px!important;" />
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
                                            <div class="card shadow-none">
                                                <div class="card-body" id="task-list-two">
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
                                                                        <li class="list-inline-item" id="comments{{ $upcoming['id'] }}">
                                                                            <i class='mdi mdi-comment-text-multiple-outline font-16 mr-1'></i>
                                                                            {{$upcoming['total_comments']}}
                                                                        </li>
                                                                        <li class="list-inline-item mt-3 mt-sm-0">
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
                                                    <hr class="my-2" style="margin-bottom: 1px!important;;margin-top: 1px!important;" />
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
                                            <h5 class="">
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
                                                                <div>
                                                                    <img src="{{ asset('public/images/users/12.jpg') }}" lt="image" class="avatar-xs rounded-circle" data-toggle="tooltip" data-placement="bottom" title="" />
                                                                </div>
                                                                <div class="mt-3 mt-sm-0">
                                                                    <ul class="list-inline font-13 text-sm-center">
                                                                        <li class="list-inline-item pr-1" id="comments{{ $old['id'] }}">
                                                                            <i class='mdi mdi-comment-text-multiple-outline font-16'></i>
                                                                            {{$old['total_comments']}}
                                                                        </li>
                                                                        <li class="list-inline-item pr-2">
                                                                            <i class='mdi mdi-calendar-month-outline font-16'></i>
                                                                            {{ date('j F y g a', strtotime($old['due_date']));}}

                                                                        </li>
                                                                        <!-- <li class="list-inline-item pr-1">
                                                                                    <i class='mdi mdi-tune font-16 mr-1'></i>
                                                                                    1/12
                                                                                </li> -->

                                                                        <li class="list-inline-item mt-3 mt-sm-0">
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
                                                    <hr class="my-2" style="margin-bottom: 1px!important;;margin-top: 1px!important;" />
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
        <!-- task panel end -->
    </div> <!-- end card-box -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div id="" class="m-t-20">
                                <br>
                            </div>

                        </div> <!-- end col-->

                        <div class="col-lg-12">
                            <!-- <div id="admin_calendor"></div> -->
                            <!-- <div id="new_calendor"></div> -->
                            <div id="teacher_calendor"></div>
                        </div> <!-- end col -->

                    </div> <!-- end row -->
                </div> <!-- end card body-->
            </div> <!-- end card -->

            <!-- Add New Event MODAL -->
            <div class="modal fade viewEvent" id="event-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myviewEventModalLabel" style="color: #6FC6CC"> <i class="fas fa-info-circle"></i> Event Details </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="card-body eventpopup" style="background-color: #8adfee14;"">
                                        <div class=" table-responsive">
                                        <table class="table">
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

        <div class="modal fade " id="birthday-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myviewBirthdayModalLabel"> <i class="fas fa-info-circle"></i> Birthday </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="card-box">
                                    <div class="table-responsive">
                                        <p class="text-center"> Happy Birthday <span id="name"></span></p>
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
        <!-- Add New Event MODAL -->
        <div class="modal fade" id="teacher-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header py-3 px-4 border-bottom-0 d-block">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" style="color: #6FC6CC">Schedule</h5>
                    </div>
                    <div class="modal-body p-4">
                        <form id="addDailyReport" method="post" action="{{ route('teacher.classroom.add_daily_report') }}" autocomplete="off">
                            <div class="card popupresponsive" style="line-height: 40px; padding: 12px 40px 0px 40px; background-color: #8adfee14; ">

                                <div class="col-12">
                                    <div class="row hover1">
                                        <div class="col-6">
                                            <div class="col-md-12 font-weight-bold">Standard </div>
                                        </div>
                                        <div class="col-6">
                                            <input type="hidden" id="setCurDate" name="date">
                                            <input type="hidden" id="ttclassID" name="class_id">
                                            <input type="hidden" id="ttsemesterID" name="semester_id">
                                            <input type="hidden" id="ttsessionID" name="session_id">
                                            <div class="col-md-12" id="standard-name"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row hover1">
                                        <div class="col-6">
                                            <div class="col-md-12 font-weight-bold">Section </div>
                                        </div>
                                        <div class="col-6">
                                            <input type="hidden" id="ttSectionID" name="section_id">
                                            <div class="col-md-12" id="section-name"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row hover1">
                                        <div class="col-6">
                                            <div class="col-md-12 font-weight-bold">Subject Name </div>
                                        </div>
                                        <div class="col-6">
                                            <input type="hidden" id="ttSubjectID" name="subject_id">
                                            <div class="col-md-12" id="subject-name"></div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="row hover1">
                                        <div class="col-6">
                                            <div class="col-md-12 font-weight-bold">Timing </div>
                                        </div>
                                        <div class="col-6">
                                            <input type="hidden" id="ttDate">
                                            <div class="col-md-12" id="timing-class"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row hover1">
                                        <div class="col-6">
                                            <div class="col-md-12 font-weight-bold">Teacher Name </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="col-md-12" id="teacher-name"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- <div class="form-group"> -->
                                    <!-- <label class="control-label font-weight-bold">Notes :</label> -->
                                    <textarea class="form-control" style="margin: 5px 0px 10px 0px;" placeholder="Enter your notes" id="calNotes" name="daily_report"></textarea>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="row mt-2">
                                <!-- <div class="col-6 text-right">
                                        <a href="{{ route('teacher.classroom.management')}}"><button type="button" class="btn btn-primary width-xs waves-effect waves-light">Go to Class</button></a>
                                    </div> -->
                                <div class="col-6 text-left">
                                    <button type="submit" class="btn btn-success" id="btn-save-event">Save</button>
                                </div>
                                <div class="col-6 text-right">
                                    <!-- <button type="button" class="btn btn-light mr-1" data-dismiss="modal">Close</button> -->
                                    <button type="button" id="goToClassRoom" class="btn btn-primary width-xs waves-effect waves-light">Go to Classroom</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div> <!-- end modal-content-->
        </div> <!-- end modal dialog-->
    </div>
</div>
<!-- end col-12 -->
</div> <!-- end row -->

<!-- <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <h4 class="navv">
                        Top Scoreres of class
                        <h4>
                </li>
            </ul><br>
            <div class="card-body">
                <div class="mt-4 chartjs-chart">
                    <div id="chart-hor-stack-bar-chart" style="min-height: 365px;"></div>
                </div>
            </div>
        </div>
    </div>
</div> -->
@include('teacher.dashboard.check_list')
@include('teacher.dashboard.task')
@include('teacher.dashboard.task-show')
@include('teacher.dashboard.exam-schedule')

</div> <!-- container -->
@endsection
@section('scripts')
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
    var pathDownloadFileUrl = "{{ asset('public/images/todolist/') }}";
    var toDoCommentsUrl = "{{ config('constants.api.to_do_comments') }}";
    var getScheduleExamDetailsUrl = "{{ config('constants.api.get_schedule_exam_details_by_teacher') }}";

    var UserName = "{{ Session::get('name') }}";
    // task all url
    var calendorAddTaskCalendor = "{{ config('constants.api.calendor_add_task_calendor') }}";
    var calendorListTaskCalendor = "{{ config('constants.api.calendor_list_task_calendor') }}";
    var calendorDeleteTaskCalendor = "{{ config('constants.api.calendor_delete_task_calendor') }}";
</script>
<!-- to calendor  -->
<!-- <script src="{{ asset('public/js/custom/teacher_calendor.js') }}"></script> -->
<!-- <script src="{{ asset('public/js/custom/teacher_calendor_new.js') }}"></script> -->
<script src="{{ asset('public/js/custom/teacher_calendor_new_cal.js') }}"></script>

<!-- to do list -->
<script src="{{ asset('public/js/custom/admin/dashboard.js') }}"></script>
<script src="{{ asset('public/js/custom/greeting.js') }}"></script>

@endsection