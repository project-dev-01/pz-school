@extends('layouts.admin-layout')
@section('title','Class Room Management')
@section('css')
<style>
    .radio_group {
        width: 40px;
        height: 53px;
        margin: 8px;
        position: relative;
        text-align: right;
        font-size: 25px;
    }

    .radio_group_1 {
        width: 30px;
        height: 53px;
        position: relative;
        text-align: right;
        font-size: 25px;
    }

    .radio_group_1 input[type="radio"] {
        opacity: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0px;
        top: 0px;
        margin: 0;
        padding: 0;
        z-index: 1;
        cursor: pointer;
    }

    .radio_group_1 input[type="radio"]+label {
        color: #95a5a6;
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
        transform: scale(.8);
    }

    .radio_group_1 input[type="radio"]:checked+label {
        color: #FFD700;
        transform: scale(1.1);
    }

    .radio_group input[type="radio"] {
        opacity: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0px;
        top: 0px;
        margin: 0;
        padding: 0;
        z-index: 1;
        cursor: pointer;
    }

    .radio_group input[type="radio"]+label {
        color: #95a5a6;
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
        transform: scale(.8);
    }

    .radio_group input[type="radio"]:checked+label {
        color: #3498db;
        transform: scale(1.1);
    }
</style>
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">Classroom Management</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="file-text" class="icon-dual" id="span-parent"></span> Classroom
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="classroomFilter" autocomplete="off">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="changeClassName">Standard<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">Select Class</option>
                                        @forelse ($class as $cla)
                                        <option value="{{ $cla['id'] }}">{{ $cla['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sectionID">Class Name<span class="text-danger">*</span></label>
                                    <select id="sectionID" class="form-control" name="section_id">
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="subjectID">Subject<span class="text-danger">*</span></label>
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
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Count Down</label>
                                    <div id="classroom_count_down"></div>
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
            <div class="card classRoomHideSHow" style="display: none;"><br>
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-3" id="top-header">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <p class="text-muted mb-1">Present</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1" style="color:blue"><span data-plugin="counterup" id="presentCount"></span></h3>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="">
                                            <p class="text-muted mb-1">Absent</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1" style="color:blue"><span data-plugin="counterup" id="absentCount"></span></h3>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="">
                                            <p class="text-muted mb-1">Late</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1" style="color:blue"><span data-plugin="counterup" id="lateCount"></span></h3>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="">
                                            <p class="text-muted mb-1">Excused</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1" style="color:blue"><span data-plugin="counterup" id="excuseCount"></span></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="text-muted float-right" id="totalStrength"></span></h6>
                                </div>

                            </div>
                        </div><!-- end col-->
                        <div class="col-lg-3" id="top-header">
                            <div class="card-box" style="height:212px;">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="fas fa-user-graduate font-24"></i><br><br>
                                            <p class="text-muted mb-1">Perfect attendance</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1" style="color:blue"><span data-plugin="counterup" id="perfectAttendance"></span></h3>

                                        </div>
                                    </div>
                                </div><br><br>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="text-muted float-right">100% of class</span></h6>
                                </div>

                            </div>
                        </div><!-- end col-->
                        <div class="col-lg-3" id="top-header">
                            <div class="card-box" style="height:212px;">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="  fas fa-user-tie  font-24"></i><br><br>
                                            <p class="text-muted mb-1">Average Attendance</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1" style="color:blue"><span data-plugin="counterup" id="avg_attendance"></span></h3>

                                        </div>
                                    </div>
                                </div><br><br>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="text-muted float-right">100% of class</span></h6>
                                </div>

                            </div>
                        </div><!-- end col-->
                        <div class="col-lg-3">
                            <div class="card-box" style="height:212px;">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="fas fa-chalkboard-teacher font-24"></i><br><br>
                                            <p class="text-muted mb-1">Below Attendance</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1" style="color:blue"><span data-plugin="counterup" id="belowAttendance"></span></h3>

                                        </div>
                                    </div>
                                </div><br><br>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="text-muted float-right">100% of class</span></h6>
                                </div>
                            </div> <!-- end card-box-->
                        </div>
                    </div>
                </div>
            </div><!-- end col-->
            <div class="row classRoomHideSHow" style="display: none;">
                <div class="col-xl-12">
                    <div class="card">
                        <ul class="nav nav-tabs" >
                            <li class="nav-item">
                                <h4 class="nav-link">
                                    <span data-feather="file-text" class="icon-dual" id="span-parent"></span> Classroom details
                                    <h4>
                            </li>
                        </ul><br>
                        <ul class="nav nav-tabs nav-bordered">
                            <li class="nav-item">
                                <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                    Layout Mode
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
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
                                <div class="tab-pane show active" id="profile-b1">
                                    <div class="row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
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
                                <style>
                                    #aa:hover {
                                        text-decoration: underline;
                                    }
                                </style>
                                <div class="tab-pane" id="home-b1">
                                    <form id="addListMode" method="post" action="{{ route('admin.classroom.add') }}" autocomplete="off">
                                        @csrf
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
                                        </div>
                                        <input type="hidden" name="class_id" id="listModeClassID">
                                        <input type="hidden" name="section_id" id="listModeSectionID">
                                        <input type="hidden" name="subject_id" id="listModeSubjectID">
                                        <input type="hidden" name="date" id="listModeSelectedDate">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <!-- <table data-toggle="table" data-page-size="3" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable "> -->
                                                <!-- <table id="listModeClassRoom" class="table table-striped table-nowrap"> -->
                                                <table id="listModeClassRoom" class="table table-centered table-striped dt-responsive nowrap w-100" width="100%">
                                                    <!-- <table class="display" width="100%"> -->
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Student name</th>
                                                            <th>Attentance</th>
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
                                        </div> <!-- end card-box-->
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <div class="form-group text-right m-b-0">
                                                    <button class="btn btn-primary-bl waves-effect waves-light" id="saveClassRoomAttendance" type="submit">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
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
                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                                    <button type="button" id="studentRemarksSave" class="btn btn-primary">Save</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <form id="updatestudentleave" method="post" action="{{ route('teacher.studentleave.update') }}" autocomplete="off">
                                        <div class="col-md-12">
                                            <ul class="nav nav-tabs" >
                                                <li class="nav-item">
                                                    <h4 class="nav-link">
                                                        <span data-feather="external-link" class="icon-dual" id="span-parent"></span> Student Leave Request
                                                        <h4>
                                                </li>
                                            </ul><br>
                                            <div class="table-responsive">
                                                <table id="stdleaves" class="table table-centered table-striped dt-responsive nowrap w-100" width="100%">
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
                                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                                <button type="button" id="student_leave_RemarksSave" class="btn btn-primary">Save</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <div class="tab-pane" id="dailyreport">
                                    <form id="addDailyReport" method="post" action="{{ route('admin.classroom.add_daily_report') }}" autocomplete="off">
                                        <input type="hidden" name="class_id" id="dailyReportClassID">
                                        <input type="hidden" name="section_id" id="dailyReportSectionID">
                                        <input type="hidden" name="subject_id" id="dailyReportSubjectID">
                                        <input type="hidden" name="date" id="dailyReportSelectedDate">
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
                                        </div> <!-- end col-->
                                        <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                    <form id="addDailyReportRemarks" method="post" action="{{ route('admin.classroom.add_daily_report_remarks') }}" autocomplete="off">
                                        <input type="hidden" name="class_id" id="dailyReportRemarksClassID">
                                        <input type="hidden" name="section_id" id="dailyReportRemarksSectionID">
                                        <input type="hidden" name="subject_id" id="dailyReportRemarksSubjectID">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="dailyReportRemarks" class="table table-centered table-striped dt-responsive nowrap w-100" width="100%">
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
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <div class="form-group text-right m-b-0">
                                                    <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="shortest">

                                    <div class="card">
                                        <div class="card-body">
                                            <form id="getShortTest" action="{{ route('admin.classroom.get_short_test') }}" method="post">
                                                <input type="hidden" name="class_id" id="shortTestClassID">
                                                <input type="hidden" name="section_id" id="shortTestSectionID">
                                                <input type="hidden" name="subject_id" id="shortTestSubjectID">
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
                                                        <button type="button" id="add-button" class="btn btn-secondary text-uppercase shadow-sm">
                                                            <i class="fas fa-plus fa-fw"></i> Add</button>
                                                        <button type="button" id="remove-button" class="btn btn-secondary text-uppercase" disabled="disabled">
                                                            <i class="fas fa-minus fa-fw"></i> Remove</button>
                                                        <button type="submit" id="save-button" class="btn btn-primary-bl text-uppercase">
                                                            Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row shortTestHideSHow">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-nowrap">
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
                                        </div> <!-- end card-box-->
                                    </div>
                                    <br />
                                    <div class="row shortTestHideSHow">
                                        <!-- <div class="row"> -->
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <form id="addShortTest" method="post" action="{{ route('admin.classroom.add_short_test') }}" autocomplete="off">
                                                    @csrf
                                                    <div id="shortTestTableAppend">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="clearfix mt-4">
                                                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light float-right">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
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
    var teacherSectionUrl = "{{ config('constants.api.section_by_class') }}";
    var teacherSubjectUrl = "{{ config('constants.api.subject_by_class') }}";
    var getStudentAttendance = "{{ config('constants.api.get_student_attendance') }}";
    var getDailyReportRemarks = "{{ config('constants.api.get_daily_report_remarks') }}";
    var getClassRoomWidget = "{{ config('constants.api.get_classroom_widget_data') }}";
    var getShortTest = "{{ config('constants.api.get_short_test') }}";
    // student leave apply
    var getStudentLeave = "{{ config('constants.api.get_student_leaves') }}";
    var imgurl = "{{ asset('teacher/student-leaves/') }}";
    var teacher_leave_remarks_updated= "{{ config('constants.api.teacher_leave_approve') }}";
    // default image test
    var defaultImg = "{{ asset('images/users/default.jpg') }}";
    var studentImg = "{{ asset('users/images/') }}";
</script>
<script src="{{ asset('js/custom/classroom.js') }}"></script>
<script src="{{ asset('js/custom/short-test.js') }}"></script>
@endsection