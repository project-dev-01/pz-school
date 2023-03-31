@extends('layouts.admin-layout')
@section('title','Class Room Management')
@section('css')
<link href="{{ asset('public/css/custom/classroom.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('messages.classroom_management') }}t</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> {{ __('messages.classroom') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="classroomFilter" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="changeClassName">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">Select Grade</option>
                                        @forelse ($teacher_class as $class)
                                        <option value="{{ $class['class_id'] }}">{{ $class['class_name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sectionID">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                    <select id="sectionID" class="form-control" name="section_id">
                                        <option value="">Select Class</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="subjectID">{{ __('messages.subject') }}<span class="text-danger">*</span></label>
                                    <select id="subjectID" class="form-control" name="subject_id">
                                        <option value="">Select Subject</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_date">Date<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="<?php echo date('d-m-Y'); ?>" name="class_date" id="classDate" require="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="semester_id">Semester</label>
                                    <select id="semester_id" class="form-control" name="semester_id">
                                        <option value="0">Select Semester</option>
                                        @foreach($semester as $sem)
                                        <option value="{{$sem['id']}}" {{ $current_semester == $sem['id'] ? 'selected' : ''}}>{{$sem['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="session_id">Session</label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="0">Select Session</option>
                                        @foreach($session as $ses)
                                        <option value="{{$ses['id']}}" {{'1' == $ses['id'] ? 'selected' : ''}}>{{$ses['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Count Down</label>
                                    <div>
                                        <!-- #classroom_count_down is always 100% responsive to it's container-->

                                        <div id="classroom_count_down">
                                            <div class="countdown-wrapper">
                                                <div class="countdown-main">
                                                    <!-- <div class="countdown-section-days days">
                                                        <div class="countdown-number-container">
                                                            <div class="countdown-number-days">
                                                                <div class="countdown-number-next position-0-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-0">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-0">0</div>
                                                                </div>
                                                            </div>
                                                            <div class="countdown-number-days">
                                                                <div class="countdown-number-next position-1-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-1">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-1">0</div>
                                                                </div>
                                                            </div>
                                                            <div class="countdown-number-days">
                                                                <div class="countdown-number-next position-2-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-2">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-2">0</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="countdown-label-container">DAYS</div>
                                                    </div>
                                                    <div class="countdown-separator">
                                                        <div class="countdown-separator-top">
                                                            <div class="countdown-dot"></div>
                                                            <div class="countdown-dot"></div>
                                                        </div>
                                                    </div> -->
                                                    <div class="countdown-section-other hours">
                                                        <div class="countdown-number-container">
                                                            <div class="countdown-number-other">
                                                                <div class="countdown-number-next position-3-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-3">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-3">0</div>
                                                                </div>
                                                            </div>
                                                            <div class="countdown-number-other">
                                                                <div class="countdown-number-next position-4-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-4">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-4">0</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="countdown-label-container">HOURS</div>
                                                    </div>
                                                    <div class="countdown-separator">
                                                        <div class="countdown-separator-top">
                                                            <div class="countdown-dot"></div>
                                                            <div class="countdown-dot"></div>
                                                        </div>
                                                    </div>
                                                    <div class="countdown-section-other minutes">
                                                        <div class="countdown-number-container">
                                                            <div class="countdown-number-other">
                                                                <div class="countdown-number-next position-5-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-5">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-5">0</div>
                                                                </div>
                                                            </div>
                                                            <div class="countdown-number-other">
                                                                <div class="countdown-number-next position-6-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-6">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-6">0</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="countdown-label-container">MINUTES</div>
                                                    </div>
                                                    <div class="countdown-separator">
                                                        <div class="countdown-separator-top">
                                                            <div class="countdown-dot"></div>
                                                            <div class="countdown-dot"></div>
                                                        </div>
                                                    </div>
                                                    <div class="countdown-section-other seconds">
                                                        <div class="countdown-number-container">
                                                            <div class="countdown-number-other">
                                                                <div class="countdown-number-next position-7-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-7">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-7">0</div>
                                                                </div>
                                                            </div>
                                                            <div class="countdown-number-other">
                                                                <div class="countdown-number-next position-8-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-8">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-8">0</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="countdown-label-container">SECONDS</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                    Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="classRoomHideSHow" style="display: none;">
                <div class="">
                    <div class="row">
                        <div class="col-md-6 col-xl-3" id="top-header">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <p class="mb-1">Present</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="presentCount" style="color:black"></span></h3>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="">
                                            <p class="mb-1">Absent</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="absentCount" style="color:black"></span></h3>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="">
                                            <p class="mb-1">Late</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="lateCount" style="color:black"></span></h3>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="">
                                            <p class="mb-1">Excused</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="excuseCount" style="color:black"></span></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="float-right" id="totalStrength"></span></h6>
                                </div>

                            </div>
                        </div><!-- end col-->
                        <div class="col-md-6 col-xl-3" id="top-header">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="fas fa-user-graduate font-24"></i><br><br>
                                            <p class="mb-1">Perfect<br>attendance</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="perfectAttendance" style="color:black"></span></h3>

                                        </div>
                                    </div>
                                </div><br><br>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="float-right">100% of class</span></h6>
                                </div>

                            </div>
                        </div><!-- end col-->
                        <div class="col-md-6 col-xl-3" id="top-header">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="  fas fa-user-tie  font-24"></i><br><br>
                                            <p class="mb-1">Average<br>Attendance</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="avg_attendance" style="color:black"></span></h3>

                                        </div>
                                    </div>
                                </div><br><br>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="float-right">100% of class</span></h6>
                                </div>

                            </div>
                        </div><!-- end col-->
                        <div class="col-md-6 col-xl-3" id="top-header">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="fas fa-chalkboard-teacher font-24"></i><br><br>
                                            <p class="mb-1">Below<br>Attendance</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="belowAttendance" style="color:black"></span></h3>

                                        </div>
                                    </div>
                                </div><br><br>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="float-right">100% of class</span></h6>
                                </div>
                            </div> <!-- end card-box-->
                        </div>
                    </div>
                </div>
            </div><!-- end col-->
            <div class="row classRoomHideSHow" style="display: none;">
                <div class="col-xl-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv"> Classroom details
                                    <h4>
                            </li>
                        </ul><br>
                        <ul class="nav nav-pills navtab-bg nav-justified">
                            <li class="nav-item">
                                <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link">
                                    Layout Mode
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                    List Mode
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#shortest" data-toggle="tab" aria-expanded="false" class="nav-link">
                                    Short Test
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#dailyreport" data-toggle="tab" aria-expanded="false" class="nav-link">
                                    Daily Report
                                </a>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="profile-b1">
                                    <div class="row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4 form-group text-right m-b-0">
                                            <a href="javascript: void(0);" class="text-reset mb-2 d-block">
                                                <i class='fas fa-circle' style='font-size:14px;color:#60a05b'></i>
                                                <span class="mb-0 mt-1" style="text-align:center">Present</span>
                                                <i class='fas fa-circle' style='font-size:14px;color:#358fde'></i>
                                                <span class="mb-0 mt-1">Late</span>
                                                <i class='fas fa-circle' style='font-size:14px;color:#de354f'></i>
                                                <span class="mb-0 mt-1">Absent</span>
                                                <i class='fas fa-circle' style='font-size:14px;color:#696969'></i>
                                                <span class="mb-0 mt-1">Excused</span>
                                            </a>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div id="layoutModeGrid"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane show active" id="home-b1">
                                    <form id="addListMode" method="post" action="{{ route('staff.classroom.add') }}" autocomplete="off">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="changeAttendance">Select Attendance</label>
                                                            <select id="changeAttendance" class="form-control">
                                                                <option value="">Not Selected</option>
                                                                <option value="present">Present</option>
                                                                <option value="absent">Absent</option>
                                                                <option value="late">Late</option>
                                                                <option value="excused">Excused</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Attendance Status</label><br>
                                                            <div id="attendaceTakenSts"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="class_id" id="listModeClassID">
                                                <input type="hidden" name="section_id" id="listModeSectionID">
                                                <input type="hidden" name="subject_id" id="listModeSubjectID">
                                                <input type="hidden" name="semester_id" id="listModeSemesterID">
                                                <input type="hidden" name="session_id" id="listModeSessionID">
                                                <input type="hidden" name="date" id="listModeSelectedDate">
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <!-- <table data-toggle="table" data-page-size="3" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable "> -->
                                                    <!-- <table id="listModeClassRoom" class="table table-striped table-nowrap"> -->
                                                    <table id="listModeClassRoom" class="table dt-responsive nowrap w-100">
                                                        <!-- <table class="display" width="100%"> -->
                                                        <!-- <table id="listModeClassRoom" class="display" style="width:100%"> -->
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Student name</th>
                                                                <th>Attendance</th>
                                                                <th>Remarks</th>
                                                                <th>Reasons</th>
                                                                <th>Student behaviour</th>
                                                                <th>Class behaviour</th>
                                                            </tr>
                                                        </thead>
                                                        <!-- <tbody id="listModeClassRoom"> -->
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <br>
                                                <div class="form-group text-right m-b-0">
                                                    <button class="btn btn-primary-bl waves-effect waves-light" id="saveClassRoomAttendance" type="submit">
                                                        Save
                                                    </button>
                                                </div>
                                            </div> <!-- end card-box-->
                                        </div>
                                    </form>
                                    <div class="modal fade" id="stuRemarksPopup" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <label for="heard">Remarks</label>
                                                    <input type="hidden" id="studenetID" />
                                                    <textarea class="form-control" id="student_remarks" rows="5" placeholder="Enter remarks here" name="student_remarks"></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                                                    <button type="button" id="studentRemarksSave" class="btn btn-primary">Save</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <div class="card">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <h4 class="navv">Student Leave Request
                                                    <h4>
                                            </li>
                                        </ul><br>
                                        <div class="card-body">
                                            <form id="updatestudentleave" method="post" action="{{ route('staff.studentleave.update') }}" autocomplete="off">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="stdleaves" class="table w-100 nowrap" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Student name</th>
                                                                    <th>From Leave</th>
                                                                    <th>To Leave</th>
                                                                    <th>Reason</th>
                                                                    <th>Document</th>
                                                                    <th>Status</th>
                                                                    <th>Remarks</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="stdleaves_body"></tbody>
                                                        </table>
                                                        <input type="hidden" id="addstd_leave_Remarks" />
                                                    </div>
                                                </div>

                                        </div> <!-- end col-->

                                        </form>
                                    </div>
                                </div>
                                <!-- student leave remarks popup -->
                                <div class="modal fade" id="stuLeaveRemarksPopup" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <label for="heard">Remarks</label>
                                                <input type="hidden" id="studenet_leave_tbl_id" />
                                                <textarea class="form-control" id="student_leave_remarks" rows="5" placeholder="Enter remarks here" name="student_leave_remarks"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                                                <button type="button" id="student_leave_RemarksSave" class="btn btn-primary">Save</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <div class="tab-pane" id="dailyreport">
                                    <form id="addDailyReport" method="post" action="{{ route('staff.classroom.add_daily_report') }}" autocomplete="off">
                                        <input type="hidden" name="class_id" id="dailyReportClassID">
                                        <input type="hidden" name="section_id" id="dailyReportSectionID">
                                        <input type="hidden" name="subject_id" id="dailyReportSubjectID">
                                        <input type="hidden" name="semester_id" id="dailyReportSemesterID">
                                        <input type="hidden" name="session_id" id="dailyReportSessionID">
                                        <input type="hidden" name="date" id="dailyReportSelectedDate">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="daily_report">Report<span class="text-danger">*</span></label>
                                                    <textarea class="form-control" id="daily_report" rows="5" name="daily_report" placeholder="Please enter description"></textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label id="dailyReportLastUpdate"></label>
                                                            <!-- <label for="heard">Last Updated: 29-01-2022 12:00:00 AM</label> -->
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group text-right m-b-0">
                                                    <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                                        Save
                                                    </button>
                                                </div>
                                            </div> <!-- end col-->

                                        </div>
                                    </form>
                                    <form id="addDailyReportRemarks" method="post" action="{{ route('staff.classroom.add_daily_report_remarks') }}" autocomplete="off">
                                        <input type="hidden" name="class_id" id="dailyReportRemarksClassID">
                                        <input type="hidden" name="section_id" id="dailyReportRemarksSectionID">
                                        <input type="hidden" name="subject_id" id="dailyReportRemarksSubjectID">
                                        <input type="hidden" name="semester_id" id="dailyReportRemarksSemesterID">
                                        <input type="hidden" name="session_id" id="dailyReportRemarksSessionID">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="dailyReportRemarks" class="table dt-responsive nowrap w-100">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Student Name</th>
                                                                    <th>Student Remarks</th>
                                                                    <th>Remarks</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div> <!-- end card-box-->
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <div class="form-group text-right m-b-0">
                                                        <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                                            Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="shortest">

                                    <div class="card">
                                        <div class="card-body">
                                            <form id="getShortTest" action="{{ route('staff.classroom.get_short_test') }}" method="post">
                                                <input type="hidden" name="class_id" id="shortTestClassID">
                                                <input type="hidden" name="section_id" id="shortTestSectionID">
                                                <input type="hidden" name="subject_id" id="shortTestSubjectID">
                                                <input type="hidden" name="semester_id" id="shortTestSemesterID">
                                                <input type="hidden" name="session_id" id="shortTestSessionID">
                                                <input type="hidden" name="date" id="shortTestSelectedDate">

                                                <div id="dynamic-field-1" class="form-group dynamic-field">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="field" class="font-weight-bold">Short Test<span class="text-danger">*</span></label>
                                                            <input type="text" id="field" class="form-control shortTestAdd" id="Hours" name="field[]" />
                                                            <span id="shortTestError"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="grade" class="font-weight-bold">Status<span class="text-danger">*</span></label>
                                                            <select id="grade" class="form-control" name="grade[]">
                                                                <option value="marks">Marks</option>
                                                                <option value="grade">Grade</option>
                                                                <option value="text">Text</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div>
                                                        <button type="button" id="add-button" class="btn btn-success text-uppercase shadow-sm">
                                                            <i class="fe-plus-circle"></i> {{ __('messages.add') }}</button>
                                                        <button type="button" id="remove-button" class="btn btn-danger text-uppercase" disabled="disabled">
                                                            <i class="fe-minus-circle"></i> Remove</button>
                                                        <button type="submit" id="save-button" class="btn btn-info waves-effect waves-light text-uppercase">
                                                            <i class="fe-save"></i> Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row shortTestHideSHow">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table dt-responsive nowrap w-100">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.no</th>
                                                                    <th>Short Test Name</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="shortTestAppend">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div> <!-- end card-box-->
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row shortTestHideSHow">
                                        <!-- <div class="row"> -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form id="addShortTest" method="post" action="{{ route('staff.classroom.add_short_test') }}" autocomplete="off">
                                                        @csrf
                                                        <div id="shortTestTableAppend">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group text-right m-b-0">
                                                                <button type="submit" class="btn btn-primary-bl waves-effect waves-light">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- </div> end card-box -->
                                    </div>

                                </div>

                            </div>
                        </div> <!-- end card-box-->
                    </div> <!-- end col -->

                </div>
                <!-- end row -->

            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->

</div> <!-- container -->
@endsection
@section('scripts')
<script>
    var teacherSectionUrl = "{{ config('constants.api.teacher_section') }}";
    var teacherSubjectUrl = "{{ config('constants.api.teacher_subject') }}";
    var getStudentAttendance = "{{ config('constants.api.get_student_attendance') }}";
    var getDailyReportRemarks = "{{ config('constants.api.get_daily_report_remarks') }}";
    var getClassRoomWidget = "{{ config('constants.api.get_classroom_widget_data') }}";
    var getShortTest = "{{ config('constants.api.get_short_test') }}";
    // student leave apply
    var getStudentLeave = "{{ config('constants.api.get_student_leaves') }}";
    var imgurl = "{{ asset('public/teacher/student-leaves/') }}";
    var teacher_leave_remarks_updated = "{{ config('constants.api.teacher_leave_approve') }}";
    var getAbsentLateExcuse = "{{ config('constants.api.get_absent_late_excuse') }}";

    // default image test
    var defaultImg = "{{ asset('public/images/users/default.jpg') }}";
    var studentImg = "{{ asset('public/users/images/') }}";
</script>
<script src="{{ asset('public/js/custom/classroom.js') }}"></script>
<script src="{{ asset('public/js/custom/short-test.js') }}"></script>
<!-- <script src="https://use.fontawesome.com/fe459689b4.js"></script> -->
@endsection