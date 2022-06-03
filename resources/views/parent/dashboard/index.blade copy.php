@extends('layouts.admin-layout')
@section('title','Dashboard')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div>
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
                                    <ul class="nav nav-tabs" >
                                        <li class="nav-item">
                                            <h4 class="nav-link">
                                                <span data-feather="home" class="icon-dual" id="span-parent"></span> To Do List
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
                                <ul class="nav nav-tabs" >
                                    <li class="nav-item">
                                        <h4 class="nav-link">
                                            <span data-feather="book-open" class="icon-dual" id="span-parent"></span>HomeWork List
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
                                                                <a href="{{ route('parent.homework')}}">{{$homework['subject_name']}} </a>
                                                            </div> <!-- end col -->
                                                            <div class="col-sm-6">
                                                                <div class="d-sm-flex">
                                                                    <!-- <div>
                                                                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="{{ route('parent.homework')}}" role="button" aria-haspopup="false" aria-expanded="false">
                                                                                <img src="{{ Session::get('picture') && asset('users/images/'.Session::get('picture')) ? asset('users/images/'.Session::get('picture')) : asset('images/users/default.jpg') }}" alt="user-image" class="rounded-circle admin_picture">
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
                        </div> <!-- end col -->

                    </div> <!-- end row -->
                </div> <!-- end card body-->
            </div> <!-- end card -->

            <!-- Add New Event MODAL -->
            <div class="modal fade" id="student-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header py-3 px-4 border-bottom-0 d-block">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h5 class="modal-title">Schedule</h5>
                        </div>
                        <div class="modal-body p-4">
                            <form class="needs-validation" name="event-form" id="form-event" novalidate>
                                <div class="row">
                                    <!-- <div class="col-4">
                                        <div class="col-md-12 font-weight-bold">Timetable List </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="col-md-12 font-weight-bold">:</div>
                                    </div>
                                    <div class="col-7">
                                        <div class="col-md-12" id="event-title"></div>
                                    </div> -->
                                    <div class="col-4">
                                        <div class="col-md-12 font-weight-bold">Subject Name </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="col-md-12 font-weight-bold">:</div>
                                    </div>
                                    <div class="col-7">
                                        <div class="col-md-12" id="subject-name"></div>
                                    </div>

                                    <div class="col-4">
                                        <div class="col-md-12 font-weight-bold">Timing </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="col-md-12 font-weight-bold">:</div>
                                    </div>
                                    <div class="col-7">
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
                                        <!-- <div class="form-group"> -->
                                        <!-- <label class="control-label font-weight-bold">Notes :</label> -->
                                        <textarea class="form-control" style="margin: 12px;" placeholder="Enter Your Notes"></textarea>
                                        <!-- </div> -->
                                    </div>
                                    <div class="col-12">
                                        <button type="button" class="btn btn-success" style="margin: 12px;">Save</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> <!-- end modal-content-->
                </div> <!-- end modal dialog-->
            </div>

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
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="map" class="icon-dual" id="span-parent"></span> Test Score Analysis
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
    </div>
    <!--General Details -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="external-link" class="icon-dual" id="span-parent"></span> General Details
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="stdGeneralDetails" method="post" action="{{ route('parent.studentleave.add') }}" novalidate>
                        @csrf
                        <input type="hidden" name="class_id" id="listModeClassID">
                        <input type="hidden" name="section_id" id="listModeSectionID" />
                        <input type="hidden" name="student_id" id="listModestudentID" />
                        <input type="hidden" name="reasons" id="listModereason" />
                        <input type="hidden" name="reasonstxt" id="listModereasontext" />
                        <!--1st row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="changeStdName">Student Name<span class="text-danger">*</span></label>
                                    <select id="changeStdName" class="form-control" name="changeStdName">
                                        <option value="">Select Student</option>
                                        @forelse ($get_std_names_dashboard as $std)

                                        <option value="{{ $std['id'] }}" data-classid="{{ $std['class_id'] }}" data-sectionid="{{ $std['section_id'] }}">{{ $std['first_name'] }}</option>

                                        @empty

                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heard">Leave From<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" autocomplete="off" name="frm_ldate" class="form-control" id="frm_ldate">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heard">To<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" autocomplete="off" name="to_ldate" class="form-control" id="to_ldate">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--2st row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="changelev">Reason(s)<span class="text-danger">*</span></label>
                                    <select id="changelevReasons" class="form-control" name="changelevReasons">
                                        <option value="">Select Student</option>
                                        @forelse ($get_leave_reasons_dashboard as $res)
                                        <option value="{{ $res['id'] }}">{{ $res['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" id="remarks_div" style="display:none;">
                                <div class="form-group">
                                    <label for="heard">Remarks</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="text" name="remarks" class="form-control" id="remarks">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="document">Attachment File</label>

                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="homework_file" class="custom-file-input" name="file">
                                            <label class="custom-file-label" for="document">Choose file</label>
                                        </div>
                                    </div>
                                    <span id="file_name"></span>

                                </div>
                            </div>
                        </div>
                        <div class="clearfix mt-4">
                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light float-right">Apply</button>
                        </div>
                    </form>
                </div> <!-- end card-body -->
                <div class="col-md-12">
                    <ul class="nav nav-tabs" >
                        <li class="nav-item">
                            <h4 class="nav-link">
                                <span data-feather="external-link" class="icon-dual" id="span-parent"></span> Leave status
                                <h4>
                        </li>
                    </ul><br>
                    <div class="card-body">
                        <table class="table mb-0" id="studentleave-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student Name</th>
                                    <th>Leave From</th>
                                    <th>To From</th>
                                    <th>Teacher remarks</th>
                                    <th>Reason</th>
                                    <th>Document</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    @include('parent.dashboard.check_list')
</div> <!-- container -->
@endsection
@section('scripts')
<script>
    // get timetable list
    var getTimetableCalendorStudent = "{{ config('constants.api.get_timetable_calendor_student') }}";
    var getEventCalendorStudent = "{{ config('constants.api.get_event_calendor_student') }}";
    // todo list js
    var readUpdateTodoUrl = "{{ config('constants.api.read_update_todo') }}";
    var getAssignClassUrl = "{{ config('constants.api.get_assign_class') }}";
    var pathDownloadFileUrl = "{{ asset('images/todolist/') }}";
    var toDoCommentsUrl = "{{ config('constants.api.to_do_comments') }}";
    var getTestScore = "{{ config('constants.api.get_test_score_dashboard') }}";
    var UserName = "{{ Session::get('name') }}";
    // general details get student names
    var stutdentleaveList = "{{ route('parent.student_leave.list') }}";
    var reuploadFileUrl = "{{ route('parent.reupload_file.add') }}";
    
    // leave apply
</script>
<!-- to do list -->
<script src="{{ asset('js/custom/parent_dashboard.js') }}"></script>
<script src="{{ asset('js/custom/admin/dashboard.js') }}"></script>


<!-- get timetable list -->
<script src="{{ asset('js/custom/student_calendor.js') }}"></script>
@endsection