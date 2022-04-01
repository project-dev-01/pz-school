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
                                    <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
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
                                                    <h5 class="mb-0"><i class='mdi mdi-chevron-down font-18'></i> Today <span class="text-muted font-14">(10)</span></h5>
                                                </a>
                                                <!-- Right modal -->
                                                <!-- <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#right-modal">Rightbar Modal</button> -->
                                                <div class="collapse show" id="todayTasks">
                                                    <div class="card mb-0 shadow-none">
                                                        <div class="card-body pb-0" id="task-list-one">
                                                            <!-- task -->
                                                            <div class="row justify-content-sm-between task-item">
                                                                <div class="col-lg-6 mb-2">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input taskListDashboard2" id="task1">
                                                                        <label class="custom-control-label" for="task1">
                                                                            Half Yearly Exam
                                                                        </label>
                                                                    </div> <!-- end checkbox -->
                                                                </div> <!-- end col -->
                                                                <div class="col-lg-6">
                                                                    <div class="d-sm-flex justify-content-between">

                                                                        <div class="mt-3 mt-sm-0">
                                                                            <ul class="list-inline font-13 text-sm-right">
                                                                                <li class="list-inline-item pr-1">
                                                                                    <i class='mdi mdi-calendar-month-outline font-16 mr-1'></i>
                                                                                    Today 10am
                                                                                </li>
                                                                                <li class="list-inline-item pr-1">
                                                                                    <i class='mdi mdi-tune font-16 mr-1'></i>
                                                                                    3/7
                                                                                </li>
                                                                                <li class="list-inline-item pr-2">
                                                                                    <i class='mdi mdi-comment-text-multiple-outline font-16 mr-1'></i>
                                                                                    21
                                                                                </li>
                                                                                <li class="list-inline-item">
                                                                                    <span class="badge badge-soft-danger p-1">High</span>
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

                                                <!-- upcoming tasks -->
                                                <div class="mt-4">
                                                    <a class="text-dark" data-toggle="collapse" href="#upcomingTasks" aria-expanded="false" aria-controls="upcomingTasks">
                                                        <h5 class="mb-0">
                                                            <i class='mdi mdi-chevron-down font-18'></i> Upcoming <span class="text-muted font-14">(5)</span>
                                                        </h5>
                                                    </a>

                                                    <div class="collapse show" id="upcomingTasks">
                                                        <div class="card mb-0 shadow-none">
                                                            <div class="card-body pb-0" id="task-list-two">
                                                                <!-- task -->
                                                                <div class="row justify-content-sm-between task-item">
                                                                    <div class="col-lg-6 mb-2">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input taskListDashboard" id="task4">
                                                                            <label class="custom-control-label" for="task4">
                                                                                Sports Day
                                                                            </label>
                                                                        </div> <!-- end checkbox -->
                                                                    </div> <!-- end col -->
                                                                    <div class="col-lg-6">
                                                                        <div class="d-sm-flex justify-content-between">
                                                                            <div class="mt-3 mt-sm-0">
                                                                                <ul class="list-inline font-13 text-sm-right">
                                                                                    <li class="list-inline-item pr-1">
                                                                                        <i class='mdi mdi-calendar-month-outline font-16 mr-1'></i>
                                                                                        Tomorrow
                                                                                        7am
                                                                                    </li>
                                                                                    <li class="list-inline-item pr-1">
                                                                                        <i class='mdi mdi-tune font-16 mr-1'></i>
                                                                                        1/12
                                                                                    </li>
                                                                                    <li class="list-inline-item pr-2">
                                                                                        <i class='mdi mdi-comment-text-multiple-outline font-16 mr-1'></i>
                                                                                        36
                                                                                    </li>
                                                                                    <li class="list-inline-item">
                                                                                        <span class="badge badge-soft-danger p-1">High</span>
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
                                                </div>
                                                <!-- end upcoming tasks -->

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
                                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                                    <li class="nav-item">
                                        <h4 class="nav-link">
                                            <span data-feather="file-text" class="icon-dual" id="span-parent"></span> Homework List
                                            <h4>
                                    </li>
                                </ul><br>
                                <div class="card-body">

                                    <div class="row mt-4" data-plugin="dragula" data-containers='["task-list-one", "task-list-two", "task-list-three"]'>
                                        <div class="col">
                                            <a class="text-dark" data-toggle="collapse" href="#hmenv" aria-expanded="false" aria-controls="hmenv">
                                                <h5 class="mb-0"><i class='mdi mdi-chevron-down font-18'></i> Study of the Environment<span class="text-muted font-14"></span></h5>
                                            </a>
                                            <!-- Right modal -->
                                            <!-- <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#right-modal">Rightbar Modal</button> -->
                                            <div class="collapse show" id="hmenv">
                                                <div class="card mb-0 shadow-none">
                                                    <div class="card-body pb-0" id="task-list-one">
                                                        <!-- task -->
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <a href="{{ route('student.homework')}}">Ecosystems </a>
                                                            </div> <!-- end col -->
                                                            <div class="col-sm-6">
                                                                <div class="d-sm-flex">
                                                                    <div>
                                                                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="{{ route('parent.homework')}}" role="button" aria-haspopup="false" aria-expanded="false">
                                                                            <img src="{{ asset('images/users/default.jpg') }}" alt="user-image" class="rounded-circle admin_picture">
                                                                        </a>
                                                                    </div>
                                                                    <div class="mt-3 mt-sm-0">
                                                                        <ul class="list-inline font-13 text-sm-right">
                                                                            <li class="list-inline-item pr-1">
                                                                                Saran
                                                                            </li>
                                                                            <li class="list-inline-item">
                                                                                <span class="badge badge-soft-danger">InComplete</span>
                                                                            </li>
                                                                            <li class="list-inline-item pr-1">
                                                                                <i class='mdi mdi-calendar-month-outline font-16'></i>
                                                                                Submission Date : 20-01-2022
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

                                    <div class="row mt-4" data-plugin="dragula" data-containers='["task-list-one", "task-list-two", "task-list-three"]'>
                                        <div class="col">
                                            <a class="text-dark" data-toggle="collapse" href="#hmmaths" aria-expanded="false" aria-controls="hmmaths">
                                                <h5 class="mb-0"><i class='mdi mdi-chevron-down font-18'></i> Mathematics<span class="text-muted font-14"></span></h5>
                                            </a>
                                            <!-- Right modal -->
                                            <!-- <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#right-modal">Rightbar Modal</button> -->
                                            <div class="collapse show" id="hmmaths">
                                                <div class="card mb-0 shadow-none">
                                                    <div class="card-body pb-0" id="task-list-one">
                                                        <!-- task -->
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <a href="{{ route('student.homework')}}">Geometry </a>
                                                            </div> <!-- end col -->
                                                            <div class="col-sm-">
                                                                <div class="d-sm-flex">
                                                                    <div>
                                                                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                                            <img src="{{ asset('images/users/default.jpg') }}" alt="user-image" class="rounded-circle admin_picture">
                                                                        </a>
                                                                    </div>
                                                                    <div class="mt-3 mt-sm-0">
                                                                        <ul class="list-inline font-13 text-sm-right">
                                                                            <li class="list-inline-item pr-1">
                                                                                Saran
                                                                            </li>
                                                                            <li class="list-inline-item">
                                                                                <span class="badge badge-soft-danger">InComplete</span>
                                                                            </li>
                                                                            <li class="list-inline-item">
                                                                                <i class='mdi mdi-calendar-month-outline font-16 mr-1'></i>
                                                                                Submission Date : 23-01-2022
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
            <!-- end modal-->
        </div>
        <!-- end col-12 -->
    </div> <!-- end row -->
    @include('student.dashboard.report_card')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="book" class="icon-dual" id="span-parent"></span> Test Score Analysis
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="mt-4 chartjs-chart">
                        <canvas id="radar-chart-test-marks" height="350" data-colors="#39afd1,#a17fe0"></canvas>
                        <!-- <canvas id="marksChart" height="350" data-colors="#39afd1,#a17fe0"></canvas> -->
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="book-open" class="icon-dual" id="span-parent"></span> Marks by Subject
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
</div> <!-- container -->
@endsection
@section('scripts')
<script>
    var getTimetableCalendorStudent = "{{ config('constants.api.get_timetable_calendor_student') }}";
</script>
<script src="{{ asset('js/custom/student_calendor.js') }}"></script>
@endsection