@extends('layouts.admin-layout')
@section('title','Class Room Management')
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
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
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
                                    <label for="changeClassName">Class<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">Select Class</option>
                                        @forelse ($teacher_class as $class)
                                        <option value="{{ $class['class_id'] }}">{{ $class['class_name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sectionID">Section<span class="text-danger">*</span></label>
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
                                    <label for="heard">Count Down<span class="text-danger">*</span></label>
                                    <input type="text" id="basic-timepicker" class="form-control btn dropdown-toggle btn-light" placeholder="01:00:00" disabled>

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
            <div class="card classRoomHideSHow"><br>
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
                                        <h3 class="my-1" style="color:blue"><span data-plugin="counterup">5</span></h3>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="">
                                        <p class="text-muted mb-1">Absent</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h3 class="my-1" style="color:blue"><span data-plugin="counterup">1</span></h3>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="">
                                        <p class="text-muted mb-1">Late</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h3 class="my-1" style="color:blue"><span data-plugin="counterup">3</span></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="progress progress-sm m-0">
                                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    </div>
                                </div>
                                <h6 class="text-uppercase"><span class="text-muted float-right">Total Strength</span></h6>
                            </div>

                        </div>
                    </div><!-- end col-->
                    <div class="col-lg-3" id="top-header">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-6">
                                    <div class="">
                                        <i class="fas fa-user-graduate font-24"></i><br><br>
                                        <p class="text-muted mb-1">Perfect attendance</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h3 class="my-1" style="color:blue"><span data-plugin="counterup">10</span></h3>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="progress progress-sm m-0">
                                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    </div>
                                </div>
                                <h6 class="text-uppercase"><span class="text-muted float-right">48% of class</span></h6>
                            </div>

                        </div>
                    </div><!-- end col-->
                    <div class="col-lg-3" id="top-header">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-6">
                                    <div class="">
                                        <i class="  fas fa-user-tie  font-24"></i><br><br>
                                        <p class="text-muted mb-1">Average Attendance</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h3 class="my-1" style="color:blue"><span data-plugin="counterup">0</span></h3>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="progress progress-sm m-0">
                                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    </div>
                                </div>
                                <h6 class="text-uppercase"><span class="text-muted float-right">72% of class</span></h6>
                            </div>

                        </div>
                    </div><!-- end col-->
                    <div class="col-lg-3">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-6">
                                    <div class="">
                                        <i class="fas fa-chalkboard-teacher font-24"></i><br><br>
                                        <p class="text-muted mb-1">Below Attendance</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h3 class="my-1" style="color:blue"><span data-plugin="counterup">1</span></h3>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="progress progress-sm m-0">
                                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    </div>
                                </div>
                                <h6 class="text-uppercase"><span class="text-muted float-right">29% of class</span></h6>
                            </div>
                        </div> <!-- end card-box-->
                    </div>
                </div>
            </div><!-- end col-->
            <div class="row classRoomHideSHow">
                <div class="col-xl-12">
                    <div class="card">
                        <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
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
                                        <div class="col-md-9"></div>
                                        <div class="col-md-3">
                                            <a href="javascript: void(0);" class="text-reset mb-2 d-block">
                                                <i class='fas fa-circle' style='font-size:14px;color:#60a05b'></i>
                                                <span class="mb-0 mt-1" style="text-align:center">Present</span>
                                                <i class='fas fa-circle' style='font-size:14px;color:#358fde'></i>
                                                <span class="mb-0 mt-1">Late</span>
                                                <i class='fas fa-circle' style='font-size:14px;color:#de354f'></i>
                                                <span class="mb-0 mt-1">Absent</span>
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
                                    <form id="addformdata" method="post" action="{{ route('teacher.classroom.add') }}" autocomplete="off">
                                        @csrf
                                        <div class="col-md-2">
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
                                        <input type="hidden" name="class_id" id="listModeClassID">
                                        <input type="hidden" name="section_id" id="listModeSectionID">
                                        <input type="hidden" name="subject_id" id="listModeSubjectID">
                                        <input type="hidden" name="date" id="listModeSelectedDate">
                                        <div class="col-md-12">
                                            <!-- <table data-toggle="table" data-page-size="3" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable "> -->
                                            <!-- <table id="listModeClassRoom" class="table table-striped table-nowrap"> -->
                                            <table id="listModeClassRoom" class="table table-centered table-striped dt-responsive nowrap w-100" width="100%">
                                                <!-- <table class="display" width="100%"> -->
                                                <thead>
                                                    <tr>
                                                        <th data-field="state" data-checkbox="true"></th>
                                                        <th data-field="id" data-switchable="false">Student name
                                                        </th>
                                                        <th data-field="name">Attentance</th>
                                                        <th data-field="Remarks">Remarks</th>
                                                        <th data-field="Reasons">Reasons</th>
                                                        <th data-field="sbehaviour">Student behaviour</th>
                                                        <th data-field="crbehaviour">Class Room behaviour</th>

                                                    </tr>
                                                </thead>
                                                <!-- <tbody id="listModeClassRoom"> -->
                                                <tbody>
                                                </tbody>
                                            </table>
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
                                </div> <!-- end col-->

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

                                <div class="tab-pane" id="dailyreport">
                                    <form id="addDailyReport" method="post" action="{{ route('teacher.classroom.add_daily_report') }}" autocomplete="off">
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
                                    <div class="col-md-12">
                                        <table data-toggle="table" data-page-size="7" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable ">
                                            <thead>
                                                <tr>
                                                    <th>S.no</th>
                                                    <th data-field="id" data-switchable="false">Student Name
                                                    </th>
                                                    <th data-field="name">Student Remarks</th>
                                                    <th data-field="Remarks">Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">Lucas</a>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="heard">English Stories</label>
                                                        </div>
                                                    </td>
                                                    <td> <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">Mia</a>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="heard">Articals</label>
                                                        </div>
                                                    </td>
                                                    <td> <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- end card-box-->

                                </div>

                                <div class="tab-pane" id="shortest">

                                    <div class="card">
                                        <div class="card-body">
                                            <form id="getShortTest" action="{{ route('teacher.classroom.get_short_test') }}" method="post">
                                                <input type="hidden" name="class_id" id="shortTestClassID">
                                                <input type="hidden" name="section_id" id="shortTestSectionID">
                                                <input type="hidden" name="subject_id" id="shortTestSubjectID">
                                                <input type="hidden" name="date" id="shortTestSelectedDate">

                                                <div id="dynamic-field-1" class="form-group dynamic-field">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="field" class="font-weight-bold">Short Test<span class="text-danger">*</span></label>
                                                            <input type="text" id="field" class="form-control" name="field[]" />
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
                                                <div class="form-group mb-0">
                                                    <div>
                                                        <button type="button" id="add-button" class="btn btn-secondary text-uppercase shadow-sm">
                                                            <i class="fas fa-plus fa-fw"></i> Add</button>
                                                        <button type="button" id="remove-button" class="btn btn-secondary text-uppercase ml-1" disabled="disabled">
                                                            <i class="fas fa-minus fa-fw"></i> Remove</button>
                                                        <button type="submit" class="btn btn-primary-bl waves-effect waves-light">Save</button>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row shortTestHideSHow">
                                        <div class="col-md-12">
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
                                        </div> <!-- end card-box-->
                                    </div>
                                    <br />
                                    <div class="row shortTestHideSHow">
                                        <form id="addShortTest" method="post" action="{{ route('teacher.classroom.add_short_test') }}" autocomplete="off">
                                            @csrf
                                            <div class="col-md-12">
                                                <div id="shortTestTableAppend"></div>
                                                <!-- <thead>
                                                    <tr>
                                                        <th>S.no</th>
                                                        <th>Student Name</th>
                                                        <th>Skill</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>5</td>
                                                        <td class="table-user">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">Charlotte</a>
                                                        </td>
                                                        <td> <input type="text" class="form-control text-right" style="width:100px;" readonly value="90" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                        </td>
                                                    </tr>
                                                </tbody> -->
                                            </div> <!-- end card-box-->
                                            <div class="col-md-12">
                                                <div class="clearfix mt-4">
                                                    <button type="submit" class="btn btn-primary-bl waves-effect waves-light float-right">Save</button>
                                                </div>
                                            </div>
                                        </form>
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
    // default image test
    var defaultImg = "{{ asset('images/users/default.jpg') }}";
</script>
<script src="{{ asset('js/custom/classroom.js') }}"></script>
<script src="{{ asset('js/custom/short-test.js') }}"></script>

@endsection