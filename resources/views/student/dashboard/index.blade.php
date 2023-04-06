@extends('layouts.admin-layout')
@section('title','Dashboard')
@section('calendar')
<!-- full calendar css start-->
<link href="{{ asset('public/libs/@fullcalendar/core/main.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/libs/@fullcalendar/daygrid/main.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/libs/@fullcalendar/bootstrap/main.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/libs/@fullcalendar/timegrid/main.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/libs/@fullcalendar/list/main.min.css') }}" rel="stylesheet" type="text/css" />
<!-- full calendar css end-->
@endsection
@section('css')
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
        text-align: center;
    }

    .table th {
        text-align: center;
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
                                <span id="greetingRingCnt">5</span>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>
    @endif
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">{{ __('messages.to_do_list') }}<h4>
                            </li>
                        </ul>
                        <div class="card-body">
                            <div class="row mt-4" data-plugin="dragula" data-containers='["task-list-one", "task-list-two", "task-list-three"]'>
                                <div class="col">
                                    <a class="text-dark" data-toggle="collapse" href="#todayTasks" aria-expanded="false" aria-controls="todayTasks">
                                        <h5 class="mb-0"><i class='mdi mdi-chevron-down font-18'></i>{{ __('messages.today') }}<span class="text-muted font-14">( {{count($get_to_do_list_dashboard['today'])}} )</span></h5>
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
                                                            <div>
                                                                <img src="{{ asset('public/images/users/12.jpg') }}" lt="image" class="avatar-xs rounded-circle" data-toggle="tooltip" data-placement="bottom" title="" />
                                                            </div>
                                                            <div class="mt-3 mt-sm-0">
                                                                <ul class="list-inline font-13 text-sm-center">
                                                                    <li class="list-inline-item" id="comments{{ $today['id'] }}">
                                                                        <i class='mdi mdi-comment-text-multiple-outline font-16 mr-1'></i>
                                                                        {{$today['total_comments']}}
                                                                    </li>
                                                                    <li class="list-inline-item pr-1">
                                                                        <i class='mdi mdi-calendar-month-outline font-16 mr-1'></i>
                                                                        <!-- Today 10am -->
                                                                        {{ date('j F y g a', strtotime($today['due_date']));}}
                                                                    </li>
                                                                    <!-- <li class="list-inline-item pr-1">
                                                                                <i class='mdi mdi-tune font-16 mr-1'></i>
                                                                                3/7
                                                                            </li> -->

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
                                                <i class='mdi mdi-chevron-down font-18'></i>{{ __('messages.upcoming') }}<span class="text-muted font-14">( {{count($get_to_do_list_dashboard['upcoming'])}} )</span>
                                            </h5>
                                        </a>
                                        @forelse ($get_to_do_list_dashboard['upcoming'] as $upcoming)
                                        <div class="collapse" id="upcomingTasks">
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
                                                                <div>
                                                                    <img src="{{ asset('public/images/users/12.jpg') }}" lt="image" class="avatar-xs rounded-circle" data-toggle="tooltip" data-placement="bottom" title="" />
                                                                </div>
                                                                <div class="mt-3 mt-sm-0">
                                                                    <ul class="list-inline font-13 text-sm-center">
                                                                        <li class="list-inline-item" id="comments{{ $upcoming['id'] }}">
                                                                            <i class='mdi mdi-comment-text-multiple-outline font-16 mr-1'></i>
                                                                            {{$upcoming['total_comments']}}
                                                                        </li>
                                                                        <li class="list-inline-item pr-1">
                                                                            <i class='mdi mdi-calendar-month-outline font-16 mr-1'></i>
                                                                            {{ date('j F y g a', strtotime($upcoming['due_date']));}}

                                                                        </li>
                                                                        <!-- <li class="list-inline-item pr-1">
                                                                                    <i class='mdi mdi-tune font-16 mr-1'></i>
                                                                                    1/12
                                                                                </li> -->
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
                                                <i class='mdi mdi-chevron-down font-18'></i>{{ __('messages.past') }}<span class="text-muted font-14">( {{count($get_to_do_list_dashboard['old'])}} )</span>
                                            </h5>
                                        </a>
                                        @forelse ($get_to_do_list_dashboard['old'] as $old)
                                        <div class="collapse" id="pastTasks">
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
                                                                        <li class="list-inline-item" id="comments{{ $old['id'] }}">
                                                                            <i class='mdi mdi-comment-text-multiple-outline font-16'></i>
                                                                            {{$old['total_comments']}}
                                                                        </li>
                                                                        <li class="list-inline-item pr-1">
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
            <!-- tasks panel -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv"> {{ __('messages.homework_list') }}
                                            <h4>
                                    </li>
                                </ul><br>
                                <div class="card-body">
                                    @forelse ($get_homework_list_dashboard as $key => $homework)
                                    <div class="row mt-4" data-plugin="dragula" data-containers='["homework-list-show"]'>
                                        <div class="col">
                                            <a class="text-dark" data-toggle="collapse" href="#hmenv{{$key}}" aria-expanded="false" aria-controls="hmenv{{$key}}">
                                                <h5 class="mb-0"><i class='mdi mdi-chevron-down font-18'></i> {{$homework['title']}}<span class="text-muted font-14"></span></h5>
                                            </a>
                                            <!-- Right modal -->
                                            <!-- <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#right-modal">Rightbar Modal</button> -->
                                            <div class="collapse" id="hmenv{{$key}}">
                                                <div class="card mb-0 shadow-none">
                                                    <div class="card-body pb-0" id="homework-list-show">
                                                        <!-- task -->
                                                        <div class="row">
                                                            <div class="col-sm-7">
                                                                <a href="{{ route('student.homework')}}">{{$homework['subject_name']}} </a>
                                                            </div> <!-- end col -->
                                                            <div class="col-sm-5">
                                                                <div class="d-sm-flex">
                                                                    <!-- <div>
                                                                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="{{ route('parent.homework')}}" role="button" aria-haspopup="false" aria-expanded="false">
                                                                                <img src="{{ Session::get('picture') && asset('public/users/images/'.Session::get('picture')) ? asset('public/users/images/'.Session::get('picture')) : asset('public/images/users/default.jpg') }}" alt="user-image" class="rounded-circle admin_picture">
                                                                            </a>
                                                                        </div> -->
                                                                    <div class="mt-3 mt-sm-0">
                                                                        <ul class="list-inline font-13 text-sm-right">
                                                                            <li class="list-inline-item" style="margin-right: 45px; margin-left:25px;margin-bottom: 10px;">
                                                                                <span class="badge badge-soft-danger" style="padding:8px 22px;">{{ __('messages.incomplete') }}</span>
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
                                    <p class="text-center">No Homework data available</p>
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
                        </div> <!-- end col -->

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
                            <h5 class="modal-title" style="color: #6FC6CC">{{ __('messages.schedule') }}</h5>
                        </div>
                        <div class="modal-body p-4">
                            <form id="addStudentReport" method="post" action="{{ route('student.classroom.add_daily_report_remarks') }}" autocomplete="off">
                                <div class="card popupresponsive" style="line-height: 40px; padding: 12px 40px 0px 40px; background-color: #8adfee14; ">

                                    <div class="col-12">
                                        <div class="row hover1">
                                            <div class="col-6">
                                                <div class="col-md-12 font-weight-bold homework-list">{{ __('messages.standard') }} </div>
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
                                                <div class="col-md-12 font-weight-bold homework-list">{{ __('messages.section') }}</div>
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
                                                <div class="col-md-12 font-weight-bold homework-list">{{ __('messages.subject_name') }} </div>
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
                                                <div class="col-md-12 font-weight-bold homework-list">Timing </div>
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
                                                <div class="col-md-12 font-weight-bold homework-list">Teacher Name </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="col-md-12" id="teacher-name"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row hover1">
                                            <div class="col-6">
                                                <div class="col-md-12 font-weight-bold homework-list">{{ __('messages.notes') }}</div>
                                            </div>
                                            <div class="col-6">
                                                <textarea class="form-control" style="margin: 12px; height: 42px;width: 80%;" placeholder="Enter your notes" id="calNotes" name="student_remarks"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="col-12">
                                        <textarea class="form-control" style="margin: 12px;" placeholder="Enter your notes" id="calNotes" name="student_remarks"></textarea>
                                    </div>-->

                                    <!--<div class="row mt-2">-->
                                    <div class="col-11 text-right">
                                        <button type="submit" class="btn btn-success" id="btn-save-event">{{ __('messages.save') }}</button>
                                    </div>
                                    <!--</div>-->
                                </div>
                            </form>
                        </div>
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
                        <h4 class="modal-title" id="myviewEventModalLabel" style="color: #6FC6CC"> <i class="fas fa-info-circle"></i> Event Details </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="card-box eventpopup" style="background-color: #8adfee14;">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
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
                                            <tr id="start_time_row" style="display:none">
                                                <td>Start Time</td>
                                                <td id="start_time"></td>
                                            </tr>
                                            <tr id="end_time_row" style="display:none">
                                                <td>End Time</td>
                                                <td id="end_time"></td>
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
        <!-- end modal-->
    </div>
    <!-- end col-12 -->
</div> <!-- end row -->


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <h4 class="navv">{{ __('messages.test_score_analysis') }}
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
    <!-- <div class="col-lg-12">
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
                    <a data-toggle="collapse" href=
                    "#cardCollpase2" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
                    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                </div>
                <h4 class="header-title mb-0">Marks by Subject</h4>

                <div id="cardCollpase2" class="collapse pt-3 show" dir="ltr">
                    <div id="apex-line-1" class="apex-charts" data-colors="#9B59B6,#E91E63,#4A6F4B,#f7b84b,#4a81d4"></div>
                </div>
            </div>
        </div>
    </div> -->
</div>
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <h4 class="navv"> {{ __('messages.student_ranking_class') }} & {{ __('messages.subject') }}</h4>
                </li>
            </ul><br>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="semester_id">{{ __('messages.semester') }}</label>
                            <select id="sr_semester_id" class="form-control studentRank" name="semester_id">
                                <option value="0">{{ __('messages.select_semester') }}</option>
                                @foreach($semester as $sem)
                                <option value="{{$sem['id']}}" {{ $current_semester == $sem['id'] ? 'selected' : ''}}>{{$sem['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="session_id">{{ __('messages.session') }}</label>
                            <select id="sr_session_id" class="form-control studentRank" name="session_id">
                                <option value="0">{{ __('messages.select_session') }}</option>
                                @foreach($session as $ses)
                                <option value="{{$ses['id']}}" {{'1' == $ses['id'] ? 'selected' : ''}}>{{$ses['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="examnames">{{ __('messages.test_name') }}<span class="text-danger">*</span></label>
                            <select id="sr_examnames" class="form-control studentRank" name="examnames">
                                <option value="">{{ __('messages.select_exams') }}</option>
                                @foreach($exams as $exam)
                                <option value="{{$exam['id']}}">{{$exam['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 form-inline">
                        <div class="form-group">
                            <label for=""><b> {{ __('messages.class_rank') }} : <span id="class_rank"></span> <br>{{ __('messages.total_marks') }}: <span id="class_total"></span></b></label>
                        </div>
                    </div>
                </div><br>
                <div class="table-responsive">
                    <table class="table table-bordered w-100 nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.subject') }}</th>
                                <th>{{ __('messages.marks') }}</th>
                                <th>{{ __('messages.subject_position') }}</th>
                            </tr>
                        </thead>
                        <tbody id="student_rank_body">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end card-->
</div> <!-- end col -->
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <h4 class="navv">{{ __('messages.semester_wise_exam_marks') }}
                        <h4>
                </li>
            </ul><br>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered w-100 nowrap" id="">
                        <thead>
                            <tr>
                                <th rowspan="2">#</th>
                                <th rowspan="2">{{ __('messages.exam_name') }}</th>
                                @forelse ($all_exam_subject_scores as $ddkey => $scores)
                                @php
                                $countsub = count($scores['exam_marks']);
                                @endphp
                                @if($ddkey =='0')
                                <th colspan="{{$countsub}}">Subjects</th>
                                @endif
                                @empty
                                @endforelse
                            </tr>
                            <tr>
                                @forelse ($all_exam_subject_scores as $skey => $scores)
                                @forelse ($scores['exam_marks'] as $key => $marks)
                                @if($skey =='0')
                                <th>{{ $marks['subject_name'] }}</th>
                                @endif
                                @empty
                                @endforelse
                                @empty
                                @endforelse
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($all_exam_subject_scores as $scrkey => $scores)
                            <tr>
                                <td>{{ $scrkey+1 }}</td>
                                <td>{{ $scores['exam_name'] }}</td>
                                @forelse ($scores['exam_marks'] as $marks)
                                <td>{{ $marks['mark'] }}</td>
                                @empty
                                @endforelse
                            </tr>
                            @empty
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end card-->
</div> <!-- end col -->
<div class="row">
    <div class="col-xl-12 col-md-12">
        <!-- Portlet card -->
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <h4 class="navv"> {{ __('messages.exam_marks_status') }}
                        <h4>
                </li>
            </ul><br>
            <div class="card-body">
                <ul class="nav nav-tab nav-bordered float-right">
                    <li class="nav-item">
                        <a href="#mcex" data-toggle="tab" aria-expanded="true" class="nav-link active">
                            <b style="font-size:12px">{{ __('messages.marks_in_class_each_exam') }}</b>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#rcex" data-toggle="tab" aria-expanded="false" class="nav-link">
                            <b style="font-size:12px">{{ __('messages.rank_in_class_each_exam') }}</b>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#score-class" data-toggle="tab" aria-expanded="false" class="nav-link">
                            <b style="font-size:12px">{{ __('messages.score_in_class') }}</b>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="mcex">
                        <div class="card-body" dir="ltr">
                            <div class="card-widgets">
                                <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                <a data-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="false" aria-controls="cardCollpase1"><i class="mdi mdi-minus"></i></a>
                                <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                            </div>
                            <h4 class="header-title mb-0"></h4>

                            <div id="cardCollpase1" class="collapse pt-3 show">
                                <div class="text-center">
                                    <div class="mt-3 chartjs-chart">
                                        <canvas id="allExamSubjectScoresChart" height="150"></canvas>
                                    </div>
                                </div>
                            </div> <!-- end collapse-->
                        </div> <!-- end card-body-->
                    </div>
                    <div class="tab-pane" id="rcex">
                        <div class="card-body" dir="ltr">
                            <div class="card-widgets">
                                <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                <a data-toggle="collapse" href="#cardCollpase2" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
                                <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                            </div>
                            <h4 class="header-title mb-0"></h4>

                            <div id="cardCollpase2" class="collapse pt-3 show">
                                <div class="text-center">
                                    <div class="mt-3 chartjs-chart">
                                        <canvas id="allExamSubjectRankChart" height="150"></canvas>
                                    </div>
                                </div>
                            </div> <!-- end collapse-->
                        </div> <!-- end card-body-->
                    </div>
                    <div class="tab-pane" id="score-class">
                        <div class="card-body" dir="ltr">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="examID">{{ __('messages.test_name') }}<span class="text-danger">*</span></label>
                                    <select id="scoreExamID" class="form-control" name="examID">
                                        <option value="">{{ __('messages.select_exams') }}</option>
                                        @foreach($exams as $exam)
                                        <option value="{{$exam['id']}}">{{$exam['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-widgets">
                                <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                <a data-toggle="collapse" href="#cardCollpase2" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
                                <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                            </div>
                            <h4 class="header-title mb-0"></h4>

                            <div id="cardCollpase2" class="collapse pt-3 show">
                                <div class="text-center">
                                    <div class="mt-3 chartjs-chart">
                                        <canvas id="examSubjectMarkHighLowAvg" height="150"></canvas>
                                    </div>
                                </div>
                            </div> <!-- end collapse-->
                        </div> <!-- end card-body-->
                    </div>
                </div>
            </div> <!-- end card-box-->

        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
@include('student.dashboard.check_list')
@include('student.dashboard.exam-schedule')
</div> <!-- container -->
@endsection
@section('scripts')
<!-- full calendar js start -->
<script src="{{ asset('public/libs/@fullcalendar/core/main.min.js') }}"></script>
<script src="{{ asset('public/libs/@fullcalendar/bootstrap/main.min.js') }}"></script>
<script src="{{ asset('public/libs/@fullcalendar/daygrid/main.min.js') }}"></script>
<script src="{{ asset('public/libs/@fullcalendar/timegrid/main.min.js') }}"></script>
<script src="{{ asset('public/libs/@fullcalendar/list/main.min.js') }}"></script>
<script src="{{ asset('public/libs/@fullcalendar/interaction/main.min.js') }}"></script>
<!-- full calendar js end -->
<script>
    var getTimetableCalendorStudent = "{{ config('constants.api.get_timetable_calendor_student') }}";
    var getEventCalendorStudent = "{{ config('constants.api.get_event_calendor_student') }}";
    var getEventGroupCalendorStudent = "{{ config('constants.api.get_event_group_calendor_student') }}";
    var getBulkCalendor = "{{ config('constants.api.get_bulk_calendor_student') }}";
    // todo list js
    var readUpdateTodoUrl = "{{ config('constants.api.read_update_todo') }}";
    var getAssignClassUrl = "{{ config('constants.api.get_assign_class') }}";
    var pathDownloadFileUrl = "{{ asset('public/images/todolist/') }}";
    var toDoCommentsUrl = "{{ config('constants.api.to_do_comments') }}";
    var getTestScore = "{{ config('constants.api.get_test_score_dashboard') }}";

    var UserName = "{{ Session::get('name') }}";
    var getScheduleExamDetailsUrl = "{{ config('constants.api.get_schedule_exam_details_by_student') }}";
    // all exam subject scores
    var allExamSubjectScores = "{{ config('constants.api.all_exam_subject_scores') }}";
    // all exam subject ranks
    var allExamSubjectRanks = "{{ config('constants.api.all_exam_subject_ranks') }}";

    var getMarksByStudent = "{{ config('constants.api.get_marks_by_student') }}";
    // exam subject mark high low avg
    var examSubjectMarkHighLowAvg = "{{ config('constants.api.exam_subject_mark_high_low_avg') }}";
    // leave apply
</script>
<!-- <script src="{{ asset('public/js/custom/student_calendor.js') }}"></script> -->
<script src="{{ asset('public/js/custom/student_dashboard.js') }}"></script>
<!-- <script src="{{ asset('public/js/custom/student_calendor_new.js') }}"></script> -->
<script src="{{ asset('public/js/custom/student_calendor_new_cal.js') }}"></script>
<!-- to do list -->
<script src="{{ asset('public/js/custom/admin/dashboard.js') }}"></script>
<script src="{{ asset('public/js/custom/greeting.js') }}"></script>


@endsection