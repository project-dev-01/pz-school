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
            <div class="card-box">
                <!-- tasks panel -->
                <div class="row">
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col">
                                <div class="card">
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
                                                                        <input type="checkbox" class="custom-control-input taskListDashboard" id="task1">
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
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div id="external-events" class="m-t-20">
                                <br>
                            </div>

                        </div> <!-- end col-->

                        <div class="col-lg-12">
                            <div id="calendar"></div>
                        </div> <!-- end col -->

                    </div> <!-- end row -->
                </div> <!-- end card body-->
            </div> <!-- end card -->

            <!-- Add New Event MODAL -->
            <div class="modal fade" id="event-modal" tabindex="-1">
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


    @include('parent.dashboard.report_card')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Test Score Analysis</h4>

                    <div class="mt-4 chartjs-chart">
                        <canvas id="radar-chart-test-marks" height="350" data-colors="#39afd1,#a17fe0"></canvas>
                        <!-- <canvas id="marksChart" height="350" data-colors="#39afd1,#a17fe0"></canvas> -->
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!--General Details -->
    <span class="fab fa-audible" id="span-parent"></span>
    <span class="header-title mb-3" id="span-parent">General Details
        <hr id="hr">
    </span>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">

                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="">
                        <!--1st row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heard">Child Name<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="Davy Jones">David Jones</option>
                                        <option value="Peter parker">Peter Parker</option>
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
                                        <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
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
                                        <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--2st row-->
                        <div class="row">
                            <div class="col-md-8">
                                <label for="message">Reason(s)<span class="text-danger">*</span></label>
                                <textarea id="message" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                            </textarea>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heard">Posting Date<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--3rd row-->
                        <br />
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="Save">Submit</button>
                            </div>
                            <div class="col-md-4">


                            </div>
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    @include('parent.dashboard.check_list')
</div> <!-- container -->
@endsection