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

        .fc-toolbar {
            text-align: center;
        }

        .fc-scroller {
            height: 315px !important;
        }
    }

    @media screen and (min-device-width: 280px) and (max-device-width: 653px) {
        .popupresponsive {
            margin: 0px -78px 0px -78px;

        }

        .eventpopup {
            margin: 0px -30px 0px -27px;
        }

        .fc-toolbar {
            text-align: center;
        }

        .fc-scroller {
            height: 315px !important;
        }

        .fc-head-container {
            width: 205px;
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
    <div class="row">
        <div class="col-md-3 col-xl-3 col-sm-3 col-lg-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-pink border-pink border">
                            <i class="fe-users font-22 avatar-title text-pink"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1"><span data-plugin="counterup">{{$count['employee_count']}}</span></h3>
                            <p class="text-muted mb-1 text-truncate">{{ __('messages.employee') }}</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-3 col-xl-3 col-sm-3 col-lg-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                            <i class="fe-user-check font-22 avatar-title text-success"></i>
                        </div>
                    </div>
                    <div class="col-6">

                        <div class="text-right">
                            <h3 class="mt-1"><span data-plugin="counterup">{{$count['student_count']}}</span></h3>
                            <p class="text-muted mb-1 text-truncate">{{ __('messages.students') }}</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-3 col-xl-3 col-sm-3 col-lg-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                            <i class="fe-user font-22 avatar-title text-info"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1"><span data-plugin="counterup">{{$count['parent_count']}}</span></h3>
                            <p class="text-muted mb-1 text-truncate">{{ __('messages.parents') }}</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-3 col-xl-3 col-sm-3 col-lg-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                            <i class="fe-user-plus font-22 avatar-title text-warning"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1"><span data-plugin="counterup">{{$count['teacher_count']}}</span></h3>
                            <p class="text-muted mb-1 text-truncate">{{ __('messages.teachers') }}</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

    <!-- end row-->
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">{{ __('messages.to_do_list') }}
                                    <h4>
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
                                                                        <span class="badge badge-soft-success p-1">{{ __('messages.low') }}</span>
                                                                        @endif
                                                                        @if($today['priority'] == "Medium")
                                                                        <span class="badge badge-soft-info p-1">{{ __('messages.medium') }}</span>
                                                                        @endif
                                                                        @if($today['priority'] == "High")
                                                                        <span class="badge badge-soft-danger p-1">{{ __('messages.high') }}</span>
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
                                                                            <i class='mdi mdi-calendar-month-outline font-16'></i>
                                                                            {{ date('j F y g a', strtotime($upcoming['due_date']));}}

                                                                        </li>
                                                                        <!-- <li class="list-inline-item pr-1">
                                                                                    <i class='mdi mdi-tune font-16 mr-1'></i>
                                                                                    1/12
                                                                                </li> -->

                                                                        <li class="list-inline-item mt-3 mt-sm-0">
                                                                            @if($upcoming['priority'] == "Low")
                                                                            <span class="badge badge-soft-success p-1">{{ __('messages.low') }}</span>
                                                                            @endif
                                                                            @if($upcoming['priority'] == "Medium")
                                                                            <span class="badge badge-soft-info p-1">{{ __('messages.medium') }}</span>
                                                                            @endif
                                                                            @if($upcoming['priority'] == "High")
                                                                            <span class="badge badge-soft-danger p-1">{{ __('messages.high') }}</span>
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
                                                <i class='mdi mdi-chevron-down font-18'></i> {{ __('messages.past') }} <span class="text-muted font-14">( {{count($get_to_do_list_dashboard['old'])}} )</span>
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
                                                                            <?php setlocale(LC_ALL, 'ja.UTF-8');
                                                                            ?>
                                                                            {{ date('j F y g a', strtotime($old['due_date']));}}

                                                                        </li>
                                                                        <!-- <li class="list-inline-item pr-1">
                                                                                    <i class='mdi mdi-tune font-16 mr-1'></i>
                                                                                    1/12
                                                                                </li> -->

                                                                        <li class="list-inline-item mt-3 mt-sm-0">
                                                                            @if($old['priority'] == "Low")
                                                                            <span class="badge badge-soft-success p-1">{{ __('messages.low') }}</span>
                                                                            @endif
                                                                            @if($old['priority'] == "Medium")
                                                                            <span class="badge badge-soft-info p-1">{{ __('messages.medium') }}</span>
                                                                            @endif
                                                                            @if($old['priority'] == "High")
                                                                            <span class="badge badge-soft-danger p-1">{{ __('messages.high') }}</span>
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
                            <div id="new_calendor"></div>
                        </div> <!-- end col -->

                    </div> <!-- end row -->
                </div> <!-- end card body-->
            </div> <!-- end card -->

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
                                                <tr id="start_time_row" style="display:none">
                                                    <td>{{ __('messages.start_time') }}</td>
                                                    <td id="start_time"></td>
                                                </tr>
                                                <tr id="end_time_row" style="display:none">
                                                    <td>{{ __('messages.end_time') }}</td>
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
        </div>
        <!-- end col-12 -->
    </div> <!-- end row -->
    @include('admin.dashboard.check_list')
    @include('admin.dashboard.task')
    @include('admin.dashboard.task-show')
    @include('admin.dashboard.exam-schedule')
    @include('admin.dashboard.taskupdate')

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
    var getBirthdayCalendorAdmin = "{{ config('constants.api.get_birthday_calendor_admin') }}";
    var getEventCalendorAdmin = "{{ config('constants.api.get_event_calendor_admin') }}";
    var getEventGroupCalendorAdmin = "{{ config('constants.api.get_event_group_calendor_admin') }}";
    var getBulkCalendor = "{{ config('constants.api.get_bulk_calendor_admin') }}";
    var readUpdateTodoUrl = "{{ config('constants.api.read_update_todo') }}";
    var getAssignClassUrl = "{{ config('constants.api.get_assign_class') }}";
    var pathDownloadFileUrl = "{{ asset('public/images/todolist/') }}";
    var toDoCommentsUrl = "{{ config('constants.api.to_do_comments') }}";
    var getScheduleExamDetailsUrl = "{{ config('constants.api.get_schedule_exam_details') }}";

    var UserName = "{{ Session::get('name') }}";
    // task all url
    var calendorAddTaskCalendor = "{{ config('constants.api.calendor_add_task_calendor') }}";
    var calendorListTaskCalendor = "{{ config('constants.api.calendor_list_task_calendor') }}";
    var calendorEditTaskCalendor = "{{ config('constants.api.calendor_edit_task_calendor') }}";
    var calendorUpdateTaskCalendor = "{{ config('constants.api.calendor_update_task_calendor') }}";
    var calendorDeleteTaskCalendor = "{{ config('constants.api.calendor_delete_task_calendor') }}";
</script>
<!-- <script src="{{ asset('public/js/custom/admin_calendor.js') }}"></script> -->
<script src="{{ asset('public/js/custom/admin_calendor_new_cal.js') }}"></script>
<script src="{{ asset('public/js/custom/admin/dashboard.js') }}"></script>
<script src="{{ asset('public/js/custom/greeting.js') }}"></script>
@endsection