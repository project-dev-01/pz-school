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
            </div> <!-- end card-box -->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="teacher_calendor"></div>
                        </div>
                    </div> <!-- end row -->
                </div> <!-- end card body-->
            </div> <!-- end card -->

            <!-- Add New Event MODAL -->
            <div class="modal fade" id="teacher-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header py-3 px-4 border-bottom-0 d-block">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h5 class="modal-title">Schedule</h5>
                        </div>
                        <div class="modal-body p-4">
                        <form id="addDailyReport" method="post" action="{{ route('teacher.classroom.add_daily_report') }}" autocomplete="off">
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
                                        <!-- <div class="form-group"> -->
                                        <!-- <label class="control-label font-weight-bold">Notes :</label> -->
                                        <textarea class="form-control" style="margin: 12px;" placeholder="Enter your notes" id="calNotes" name="daily_report"></textarea>
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
                            </form>
                        </div>
                    </div> <!-- end modal-content-->
                </div> <!-- end modal dialog-->
            </div>
        </div>
        <!-- end col-12 -->
    </div> <!-- end row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="edit" class="icon-dual" id="span-parent"></span> Top Scoreres of class
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="mt-4 chartjs-chart">
                        <div id="chart-hor-stack-bar-chart" style="min-height: 365px;"></div>
                        <!-- <canvas id="marksChart" height="350" data-colors="#39afd1,#a17fe0"></canvas> -->
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="edit" class="icon-dual" id="span-parent"></span> Top 10 ranking
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-box">
                                <div class="table-responsive">
                                    <table data-toggle="table" data-page-size="5" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable ">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Score</th>
                                                <th>Grade</th>
                                                <th>Ranking</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>William</th>
                                                <td>99</td>
                                                <td>A</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <th>James</th>
                                                <td>85</td>
                                                <td>B</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <th>Benjamin</th>
                                                <td>75</td>
                                                <td>C</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <th>Lucas</th>
                                                <td>60</td>
                                                <td>D</td>
                                                <td>4</td>
                                            </tr>
                                            <tr>
                                                <th>Sophia</th>
                                                <td>85</td>
                                                <td>B</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <th>Amelia</th>
                                                <td>75</td>
                                                <td>C</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <th>Charlotte</th>
                                                <td>40</td>
                                                <td>D</td>
                                                <td>22</td>
                                            </tr>
                                            <tr>
                                                <th>Isabella</th>
                                                <td>50</td>
                                                <td>D</td>
                                                <td>11</td>
                                            </tr>
                                            <tr>
                                                <th>Mia</th>
                                                <td>40</td>
                                                <td>D</td>
                                                <td>12</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div>
                    <!--- end row -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="edit" class="icon-dual" id="span-parent"></span> Bottom 10 ranking
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-box">
                                <div class="table-responsive">
                                    <table data-toggle="table" data-page-size="5" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable ">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Score</th>
                                                <th>Grade</th>
                                                <th>Ranking</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Charlotte</th>
                                                <td>40</td>
                                                <td>D</td>
                                                <td>22</td>
                                            </tr>
                                            <tr>
                                                <th>Isabella</th>
                                                <td>50</td>
                                                <td>D</td>
                                                <td>11</td>
                                            </tr>
                                            <tr>
                                                <th>Mia</th>
                                                <td>40</td>
                                                <td>D</td>
                                                <td>12</td>
                                            </tr>
                                            <tr>
                                                <th>William</th>
                                                <td>99</td>
                                                <td>A</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <th>James</th>
                                                <td>85</td>
                                                <td>B</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <th>Benjamin</th>
                                                <td>75</td>
                                                <td>C</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <th>Lucas</th>
                                                <td>60</td>
                                                <td>D</td>
                                                <td>4</td>
                                            </tr>
                                            <tr>
                                                <th>Sophia</th>
                                                <td>85</td>
                                                <td>B</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <th>Amelia</th>
                                                <td>75</td>
                                                <td>C</td>
                                                <td>3</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div>
                    <!--- end row -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="edit" class="icon-dual" id="span-parent"></span> Top 10 Improments
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-box">
                                <div class="table-responsive">
                                    <table data-toggle="table" data-page-size="5" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable ">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Score</th>
                                                <th>Grade</th>
                                                <th>Ranking</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>William</th>
                                                <td>99</td>
                                                <td>A</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <th>James</th>
                                                <td>85</td>
                                                <td>B</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <th>Benjamin</th>
                                                <td>75</td>
                                                <td>C</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <th>Lucas</th>
                                                <td>60</td>
                                                <td>D</td>
                                                <td>4</td>
                                            </tr>
                                            <tr>
                                                <th>Sophia</th>
                                                <td>85</td>
                                                <td>B</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <th>Amelia</th>
                                                <td>75</td>
                                                <td>C</td>
                                                <td>3</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div>
                    <!--- end row -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="edit" class="icon-dual" id="span-parent"></span> Bottom 10 Deteriorate
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-box">
                                <div class="table-responsive">
                                    <table data-toggle="table" data-page-size="5" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable ">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Score</th>
                                                <th>Grade</th>
                                                <th>Ranking</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Charlotte</th>
                                                <td>40</td>
                                                <td>D</td>
                                                <td>22</td>
                                            </tr>
                                            <tr>
                                                <th>Isabella</th>
                                                <td>50</td>
                                                <td>D</td>
                                                <td>11</td>
                                            </tr>
                                            <tr>
                                                <th>William</th>
                                                <td>99</td>
                                                <td>A</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <th>James</th>
                                                <td>85</td>
                                                <td>B</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <th>Benjamin</th>
                                                <td>75</td>
                                                <td>C</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <th>Lucas</th>
                                                <td>60</td>
                                                <td>D</td>
                                                <td>4</td>
                                            </tr>
                                            <tr>
                                                <th>Sophia</th>
                                                <td>85</td>
                                                <td>B</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <th>Amelia</th>
                                                <td>75</td>
                                                <td>C</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <th>Mia</th>
                                                <td>40</td>
                                                <td>D</td>
                                                <td>12</td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div>
                    <!--- end row -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    @include('teacher.dashboard.check_list')

</div> <!-- container -->
@endsection
@section('scripts')
<script>
    var getTimetableCalendor = "{{ config('constants.api.get_timetable_calendor') }}";
    var redirectionURL = "{{ route('teacher.classroom.management')}}";
</script>
<script src="{{ asset('js/custom/teacher_calendor.js') }}"></script>
@endsection