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
@section('component_css')
<!-- date picker -->
<link href="{{ asset('public/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">
<link href="{{ asset('public/css/custom/greeting.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/css/custom/calendar.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/css/custom/calendarresponsive.css') }}" rel="stylesheet" type="text/css" />
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
                            <div class="row" data-plugin="dragula" data-containers='["task-list-one", "task-list-two", "task-list-three"]'>
                                <div class="col">
                                    <a class="text-dark" data-toggle="collapse" href="#todayTasks" aria-expanded="false" aria-controls="todayTasks">
                                        <h5 class="mb-0"><i class='mdi mdi-chevron-down font-18'></i>{{ __('messages.today') }}<span class="text-muted font-14">( {{ isset($get_to_do_list_dashboard['today']) ? count($get_to_do_list_dashboard['today']) : "0"}} )</span></h5>
                                    </a>
                                    <!-- Right modal -->
                                    <!-- <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#right-modal">Rightbar Modal</button> -->

                                    @if(isset($get_to_do_list_dashboard['today']))
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
                                                                <img src="{{ config('constants.image_url').'/public/common-asset/images/users/12.jpg' }}" lt="image" class="avatar-xs rounded-circle" data-toggle="tooltip" data-placement="bottom" title="" />
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
                                    @endif

                                    <!-- upcoming tasks -->
                                    <div class="mt-4">
                                        <a class="text-dark" data-toggle="collapse" href="#upcomingTasks" aria-expanded="false" aria-controls="upcomingTasks">
                                            <h5 class="mb-0">
                                                <i class='mdi mdi-chevron-down font-18'></i>{{ __('messages.upcoming') }} <span class="text-muted font-14">( {{isset($get_to_do_list_dashboard['upcoming']) ? count($get_to_do_list_dashboard['upcoming']) : "0"}} )</span>
                                            </h5>
                                        </a>
                                        @if(isset($get_to_do_list_dashboard['upcoming']))
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
                                                                    <img src="{{ config('constants.image_url').'/public/common-asset/images/users/12.jpg' }}" lt="image" class="avatar-xs rounded-circle" data-toggle="tooltip" data-placement="bottom" title="" />
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
                                        @endif

                                    </div>
                                    <!-- end upcoming tasks -->
                                    <!-- old tasks -->
                                    <div class="mt-4">
                                        <a class="text-dark" data-toggle="collapse" href="#pastTasks" aria-expanded="false" aria-controls="pastTasks">
                                            <h5 class="">
                                                <i class='mdi mdi-chevron-down font-18'></i>{{ __('messages.past') }}<span class="text-muted font-14">( {{isset($get_to_do_list_dashboard['old']) ? count($get_to_do_list_dashboard['old']) : "0"}} )</span>
                                            </h5>
                                        </a>
                                        @if(isset($get_to_do_list_dashboard['old']))
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
                                                                    <img src="{{ config('constants.image_url').'/public/common-asset/images/users/12.jpg' }}" lt="image" class="avatar-xs rounded-circle" data-toggle="tooltip" data-placement="bottom" title="" />
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
                                        @endif

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
                            <h4 class="modal-title" id="myviewEventModalLabel" style="color: #6FC6CC"> <i class="fas fa-info-circle"></i> {{ __('messages.event_details') }} </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="card-body eventpopup" style="background-color: #8adfee14;"">
                                        <div class=" table-responsive">
                                        <style>
                                            .table td {
                                                border-top: none;
                                                text-align: justify;
                                            }
                                        </style>
                                        <table class="table">
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
                                        <p class="text-center">{{ __('messages.name') }} :<span id="bulk_name"></span></p><br>
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
                        <h5 class="modal-title" style="color: #6FC6CC">{{ __('messages.schedule') }}</h5>
                    </div>
                    <div class="modal-body p-4">
                        <form id="addDailyReport" method="post" action="{{ route('teacher.classroom.add_daily_report') }}" autocomplete="off">
                            <div class="card popupresponsive" style="line-height: 40px; padding: 12px 40px 0px 40px; background-color: #8adfee14; ">

                                <div class="col-12">
                                    <div class="row hover1">
                                        <div class="col-6">
                                            <div class="col-md-12 font-weight-bold">{{ __('messages.grade') }}</div>
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
                                            <div class="col-md-12 font-weight-bold">{{ __('messages.class') }}</div>
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
                                            <div class="col-md-12 font-weight-bold">{{ __('messages.subject_name') }} </div>
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
                                            <div class="col-md-12 font-weight-bold">{{ __('messages.timing') }} </div>
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
                                            <div class="col-md-12 font-weight-bold">{{ __('messages.teacher_name') }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="col-md-12" id="teacher-name"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- <div class="form-group"> -->
                                    <!-- <label class="control-label font-weight-bold">Notes :</label> -->
                                    <textarea class="form-control" style="margin: 5px 0px 10px 0px;" placeholder="{{ __('messages.enter_your_notes') }}" id="calNotes" name="daily_report"></textarea>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="row mt-2">
                                <!-- <div class="col-6 text-right">
                                        <a href="{{ route('teacher.classroom.management')}}"><button type="button" class="btn btn-primary width-xs waves-effect waves-light">Go to Class</button></a>
                                    </div> -->
                                <div class="col-6 text-left">
                                    <button type="submit" class="btn btn-success" id="btn-save-event">{{ __('messages.save') }}</button>
                                </div>
                                <div class="col-6 text-right">
                                    <!-- <button type="button" class="btn btn-light mr-1" data-dismiss="modal">{{ __('messages.close') }}</button> -->
                                    <button type="button" id="goToClassRoom" class="btn btn-primary width-xs waves-effect waves-light">{{ __('messages.go_to_classroom') }}</button>
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
                            <label for="sr_btwyears">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                            <select id="sr_btwyears" class="form-control studentRank" name="year">
                                <option value="">{{ __('messages.select_academic_year') }}</option>
                                @forelse($academic_year_list as $r)
                                <option value="{{$r['id']}}">{{$r['name']}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sr_class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                            <select id="sr_class_id" class="form-control" name="class_id">
                                <option value="">{{ __('messages.select_grade') }}</option>
                                @forelse ($classes as $class)
                                <option value="{{ $class['class_id'] }}">{{ $class['class_name'] }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sr_section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                            <select id="sr_section_id" class="form-control " name="section_id">
                                <option value="">{{ __('messages.select_class') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sr_student_id">{{ __('messages.student') }}<span class="text-danger">*</span></label>
                            <select id="sr_student_id" class="form-control studentRank" name="student_id">
                                <option value="">{{ __('messages.select_student') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sr_examnames">{{ __('messages.test_name') }}<span class="text-danger">*</span></label>
                            <select id="sr_examnames" class="form-control studentRank" name="examnames">
                                <option value="">{{ __('messages.select_exams') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sr_semester_id">{{ __('messages.semester') }}</label>
                            <select id="sr_semester_id" class="form-control studentRank" name="semester_id">
                                <option value="0">{{ __('messages.select_semester') }}</option>
                                @forelse($semester as $sem)
                                <option value="{{$sem['id']}}" {{ $current_semester == $sem['id'] ? 'selected' : ''}}>{{$sem['name']}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sr_session_id">{{ __('messages.session') }}</label>
                            <select id="sr_session_id" class="form-control studentRank" name="session_id">
                                <option value="0">{{ __('messages.select_session') }}</option>
                                @forelse($session as $ses)
                                <option value="{{$ses['id']}}" {{$current_session == $ses['id'] ? 'selected' : ''}}>{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                @empty
                                @endforelse
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
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="st_btwyears">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                            <select id="st_btwyears" class="form-control studentSemester" name="year">
                                <option value="">{{ __('messages.select_academic_year') }}</option>
                                @forelse($academic_year_list as $r)
                                <option value="{{$r['id']}}">{{$r['name']}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="st_class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                            <select id="st_class_id" class="form-control" name="class_id">
                                <option value="">{{ __('messages.select_grade') }}</option>
                                @forelse ($classes as $class)
                                <option value="{{ $class['class_id'] }}">{{ $class['class_name'] }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="st_section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                            <select id="st_section_id" class="form-control " name="section_id">
                                <option value="">{{ __('messages.select_class') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="st_student_id">{{ __('messages.student') }}<span class="text-danger">*</span></label>
                            <select id="st_student_id" class="form-control studentSemester" name="student_id">
                                <option value="">{{ __('messages.select_student') }}</option>
                            </select>
                        </div>
                    </div>
                </div><br>
                <div class="table-responsive">
                    <table class="table table-bordered w-100 nowrap">

                        <thead id="st_semester_wise_head">
                        </thead>
                        <tbody id="st_semester_wise_body">
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
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="ems_btwyears">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                            <select id="ems_btwyears" class="form-control examMarkStatus" name="year">
                                <option value="">{{ __('messages.select_academic_year') }}</option>
                                @forelse($academic_year_list as $r)
                                <option value="{{$r['id']}}">{{$r['name']}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="ems_class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                            <select id="ems_class_id" class="form-control" name="class_id">
                                <option value="">{{ __('messages.select_grade') }}</option>
                                @forelse ($classes as $class)
                                <option value="{{ $class['class_id'] }}">{{ $class['class_name'] }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="ems_section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                            <select id="ems_section_id" class="form-control " name="section_id">
                                <option value="">{{ __('messages.select_class') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="ems_student_id">{{ __('messages.student') }}<span class="text-danger">*</span></label>
                            <select id="ems_student_id" class="form-control examMarkStatus" name="student_id">
                                <option value="">{{ __('messages.select_student') }}</option>
                            </select>
                        </div>
                    </div>
                </div><br>
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
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <h4 class="navv"> {{ __('messages.student_top_10_ranking') }}</h4>
                </li>
            </ul><br>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="st10_btwyears">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                            <select id="st10_btwyears" class="form-control studentTop" name="year">
                                <option value="">{{ __('messages.select_academic_year') }}</option>
                                @forelse($academic_year_list as $r)
                                <option value="{{$r['id']}}">{{$r['name']}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="st10_class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                            <select id="st10_class_id" class="form-control" name="class_id">
                                <option value="">{{ __('messages.select_grade') }}</option>
                                @forelse ($classes as $class)
                                <option value="{{ $class['class_id'] }}">{{ $class['class_name'] }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="st10_section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                            <select id="st10_section_id" class="form-control " name="section_id">
                                <option value="">{{ __('messages.select_class') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="st10_semester_id">{{ __('messages.semester') }}</label>
                            <select id="st10_semester_id" class="form-control studentTop" name="semester_id">
                                <option value="0">{{ __('messages.select_semester') }}</option>
                                @forelse($semester as $sem)
                                <option value="{{$sem['id']}}" {{ $current_semester == $sem['id'] ? 'selected' : ''}}>{{$sem['name']}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="st10_session_id">{{ __('messages.session') }}</label>
                            <select id="st10_session_id" class="form-control studentTop" name="session_id">
                                <option value="0">{{ __('messages.select_session') }}</option>
                                @forelse($session as $ses)
                                <option value="{{$ses['id']}}" {{$current_session == $ses['id'] ? 'selected' : ''}}>{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="st10_examnames">{{ __('messages.test_name') }}<span class="text-danger">*</span></label>
                            <select id="st10_examnames" class="form-control studentTop" name="examnames">
                                <option value="">{{ __('messages.select_exams') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered w-100 nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.student_name') }}</th>
                                <th>{{ __('messages.total_marks') }}</th>
                                <th>{{ __('messages.marks') }}</th>
                                <th>{{ __('messages.rank') }}</th>
                            </tr>
                        </thead>
                        <tbody id="top_student_table">

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
                    <h4 class="navv"> {{ __('messages.student_bottom_10_ranking') }}</h4>
                </li>
            </ul><br>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sb10_btwyears">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                            <select id="sb10_btwyears" class="form-control studentBottom" name="year">
                                <option value="">{{ __('messages.select_academic_year') }}</option>
                                @forelse($academic_year_list as $r)
                                <option value="{{$r['id']}}">{{$r['name']}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sb10_class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                            <select id="sb10_class_id" class="form-control" name="class_id">
                                <option value="">{{ __('messages.select_grade') }}</option>
                                @forelse ($classes as $class)
                                <option value="{{ $class['class_id'] }}">{{ $class['class_name'] }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sb10_section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                            <select id="sb10_section_id" class="form-control " name="section_id">
                                <option value="">{{ __('messages.select_class') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sb10_semester_id">{{ __('messages.semester') }}</label>
                            <select id="sb10_semester_id" class="form-control studentBottom" name="semester_id">
                                <option value="0">{{ __('messages.select_semester') }}</option>
                                @forelse($semester as $sem)
                                <option value="{{$sem['id']}}" {{ $current_semester == $sem['id'] ? 'selected' : ''}}>{{$sem['name']}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sb10_session_id">{{ __('messages.session') }}</label>
                            <select id="sb10_session_id" class="form-control studentBottom" name="session_id">
                                <option value="0">{{ __('messages.select_session') }}</option>
                                @forelse($session as $ses)
                                <option value="{{$ses['id']}}" {{$current_session == $ses['id'] ? 'selected' : ''}}>{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sb10_examnames">{{ __('messages.test_name') }}<span class="text-danger">*</span></label>
                            <select id="sb10_examnames" class="form-control studentBottom" name="examnames">
                                <option value="">{{ __('messages.select_exams') }}</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered w-100 nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.student_name') }}</th>
                                <th>{{ __('messages.total_marks') }}</th>
                                <th>{{ __('messages.marks') }}</th>
                                <th>{{ __('messages.rank') }}</th>
                            </tr>
                        </thead>
                        <tbody id="bottom_student_table">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end card-->
</div> <!-- end col -->
</div> <!-- end row -->
</div> <!-- end row -->
@include('teacher.dashboard.check_list')
@include('teacher.dashboard.task')
@include('teacher.dashboard.task-show')
@include('teacher.dashboard.exam-schedule')
@include('admin.dashboard.taskupdate')

</div> <!-- container -->
@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('public/libs/moment/min/moment.min.js') }}"></script>
<!-- full calendar js end -->
<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('public/libs/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('public/libs/morris.js06/morris.min.js') }}"></script>
<script src="{{ asset('public/libs/raphael/raphael.min.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- validation -->
<script src="{{ asset('public/js/validation/validation.js') }}"></script>

<!-- full calendar js start -->
<script src="{{ asset('public/libs/@fullcalendar/core/main.min.js') }}"></script>
<script src="{{ asset('public/libs/@fullcalendar/bootstrap/main.min.js') }}"></script>
<script src="{{ asset('public/libs/@fullcalendar/daygrid/main.min.js') }}"></script>
<script src="{{ asset('public/libs/@fullcalendar/timegrid/main.min.js') }}"></script>
<script src="{{ asset('public/libs/@fullcalendar/list/main.min.js') }}"></script>
<script src="{{ asset('public/libs/@fullcalendar/interaction/main.min.js') }}"></script>
<!-- full calendar js end -->
<script src="{{ asset('public/libs/flatpickr/flatpickr.min.js') }}"></script>
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
    var pathDownloadFileUrl = "{{ config('constants.image_url').'/public/'.config('constants.branch_id').'/images/todolist/' }}";
    var toDoCommentsUrl = "{{ config('constants.api.to_do_comments') }}";
    var getScheduleExamDetailsUrl = "{{ config('constants.api.get_schedule_exam_details_by_teacher') }}";

    var UserName = "{{ Session::get('name') }}";
    // task all url
    var calendorAddTaskCalendor = "{{ config('constants.api.calendor_add_task_calendor') }}";
    var calendorListTaskCalendor = "{{ config('constants.api.calendor_list_task_calendor') }}";
    var calendorEditTaskCalendor = "{{ config('constants.api.calendor_edit_task_calendor') }}";
    var calendorUpdateTaskCalendor = "{{ config('constants.api.calendor_update_task_calendor') }}";
    var calendorDeleteTaskCalendor = "{{ config('constants.api.calendor_delete_task_calendor') }}";


    var teacherSectionUrl = "{{ config('constants.api.teacher_section') }}";
    var subjectByExamNames = "{{ config('constants.api.subject_by_exam_names') }}";

    var getMarksByStudent = "{{ config('constants.api.get_marks_by_student') }}";

    var getTenStudent = "{{ config('constants.api.get_ten_student') }}";
    var getStudentList = "{{ config('constants.api.get_student_details') }}";
    var all_exam_subject_scores = "{{ config('constants.api.all_exam_subject_scores') }}";


    var getTestScore = "{{ config('constants.api.get_test_score_dashboard') }}";
    // all exam subject scores
    var allExamSubjectScores = "{{ config('constants.api.all_exam_subject_scores') }}";
    // all exam subject ranks
    var allExamSubjectRanks = "{{ config('constants.api.all_exam_subject_ranks') }}";
    var examByStudent = "{{ config('constants.api.exam_by_student') }}";
    var examSubjectMarkHighLowAvg = "{{ config('constants.api.exam_subject_mark_high_low_avg') }}";
</script>
<!-- to calendor  -->
<!-- <script src="{{ asset('public/js/custom/teacher_calendor.js') }}"></script> -->
<!-- <script src="{{ asset('public/js/custom/teacher_calendor_new.js') }}"></script> -->
<script src="{{ asset('public/js/custom/teacher_calendor_new_cal.js') }}"></script>

<!-- to do list -->
<script src="{{ asset('public/js/custom/teacher_dashboard.js') }}"></script>
<script src="{{ asset('public/js/custom/admin/dashboard.js') }}"></script>
<script src="{{ asset('public/js/custom/greeting.js') }}"></script>

@endsection