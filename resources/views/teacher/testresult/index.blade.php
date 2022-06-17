@extends('layouts.admin-layout')
@section('title','Test Result')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">Test Result</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv"> Test Result
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <form id="testresultFilter" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="changeClassName">Standard<span class="text-danger">*</span></label>
                                            <select id="changeClassName" class="form-control" name="class_id">
                                                <option value="">Select Standard</option>
                                                @forelse ($teacher_class as $class)
                                                <option value="{{ $class['class_id'] }}">{{ $class['class_name'] }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sectionID">Class<span class="text-danger">*</span></label>
                                            <select id="sectionID" class="form-control" name="section_id">
                                                <option value="">Select Class</option>
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
                                            <label for="examnames">Test Name<span class="text-danger">*</span></label>
                                            <select id="examnames" class="form-control" name="exam_id">
                                                <option value="">Select Exams</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                        Filter
                                    </button>
                                    <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                                Cancel
                                            </button>-->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" id="mark_by_subject_card" style="display:none">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> Marks By Subject
                            <h4>
                    </li>
                </ul><br>
                <form id="addstudentmarks" method="post" action="{{ route('teacher.subjectmarks.add') }}" autocomplete="off">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="class_id" id="listModeClassID">
                        <input type="hidden" name="section_id" id="listModeSectionID">
                        <input type="hidden" name="subject_id" id="listModeSubjectID">
                        <input type="hidden" name="exam_id" id="listModeexamID">
                        <input type="hidden" name="fullmark" id="fullmark">
                        <input type="hidden" name="passmark" id="passmark">
                        <div class="col-md-12">
                            <div class="card-box">
                                <!-- <table id="stdmarks" data-toggle="table" data-page-size="7" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable "> -->
                                <table id="stdmarks" class="table" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="10%">#</th>
                                            <th class="text-center" width="10%">Student Name</th>
                                            <th class="text-center" width="20%">Score</th>
                                            <th class="text-center" width="15%">Grade</th>
                                            <th class="text-center" width="15%">Pass/Fail</th>
                                            <th class="text-center" width="15%">Ranking</th>
                                            <th class="text-center" width="15%">Status</th>
                                            <th class="text-center" width="30%">Memo</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <br>
                                <div class="form-group text-right m-b-0">

                                    <button class="btn btn-primary-bl waves-effect waves-light" id="saveClassRoomAttendance" type="submit">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card" id="subjectdivTableAppend" style="display:none">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Marks By Subject Division
                            <h4>
                    </li>
                </ul><br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <form id="tblsubjectdivSave" method="post" action="{{ route('teacher.subjectdivision.add') }}" autocomplete="off">
                                @csrf
                                <div id="subjectdivTableAppend_text">
                                </div>
                                <div class="col-md-12">
                                    <div class="clearfix mt-4">
                                        <button type="submit" class="btn btn-primary-bl waves-effect waves-light float-right">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- end table-responsive-->
                    </div>
                </div> <!-- end card body-->
            </div>
            <div class="card" id="subject_average_card" style="display:none">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Subject Average
                            <h4>
                    </li>
                </ul><br>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Portlet card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="card-widgets">
                                    <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                    <a data-toggle="collapse" href="#cardCollpase3" role="button" aria-expanded="false" aria-controls="cardCollpase3"><i class="mdi mdi-minus"></i></a>
                                    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                </div>
                                <!-- <h4 class="header-title mb-0">Subject Average</h4> -->

                                <div id="cardCollpase3" class="collapse pt-3 show" dir="ltr">
                                    <div id="subject-avg-chart" class="apex-charts" data-colors="#f672a7"></div>
                                </div> <!-- collapsed end -->

                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div>
                </div>
            </div> <!-- end card body-->


            <div class="card" id="scores_by_graph_card" style="visibility: hidden;">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Scores by Graph
                            <h4>
                    </li>
                </ul><br>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card-body" dir="ltr">
                            <div class="card-widgets">
                                <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                <a data-toggle="collapse" href="#cardCollpase3" role="button" aria-expanded="false" aria-controls="cardCollpase3"><i class="mdi mdi-minus"></i></a>
                                <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                            </div>
                            <h4 class="header-title mb-0">Statistics</h4>

                            <div id="cardCollpase3" class="collapse pt-3 show">
                                <div class="text-center">

                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <h3 data-plugin="">Number of Student</h3>
                                            <p class="text-muted font-13 mb-0 text-truncate">Y Axis</p>
                                        </div>
                                        <div class="col-6">
                                            <h3 data-plugin="">Grade</h3>
                                            <p class="text-muted font-13 mb-0 text-truncate">X Axis</p>
                                        </div>
                                    </div> <!-- end row -->
                                    <div id="test-bar-chart" style="height: 270px;" class="morris-chart mt-3"></div>

                                </div>
                            </div> <!-- end collapse-->
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <div class="card" id="graphs_card" style="display:none">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Graphs
                            <h4>
                    </li>
                </ul><br>
                <div class="row">
                    <div class="col-lg-6" id="donut-chart" style="display:none">
                        <!-- Portlet card -->
                        <div class="card">
                            <div class="card-body" dir="ltr">
                                <div class="card-widgets">
                                    <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                    <a data-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="false" aria-controls="cardCollpase1"><i class="mdi mdi-minus"></i></a>
                                    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                </div>
                                <h4 class="header-title mb-0">Test Execution Summary</h4>

                                <div id="cardCollpase1" class="collapse pt-3 show">
                                    <div class="text-center">

                                        <div id="donut-chart-test-summary" data-colors="#4fc6e1,#6658dd,#ebeff2" style="height: 270px;" class="morris-chart mt-3"></div>

                                    </div>
                                </div> <!-- end collapse-->
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                    <div class="col-lg-6" id="radar-chart" style="display:none">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Test Score Analysis</h4>
                                <div class="mt-4 chartjs-chart">
                                    <canvas id="radar-chart-test-marks" data-colors="#39afd1,#a17fe0"></canvas>
                                    <!-- <canvas id="marksChart" height="350" data-colors="#39afd1,#a17fe0"></canvas> -->
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>


            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col-->

    <!-- container -->
</div>


<!-- Center modal content -->
<div class="modal fade studentSubDivMarkModal" id="studentSubDivMarkModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h4 class="modal-title" id="myaddClassModalLabel">Add Class</h4> -->
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Subject Average</h4>
                                <div class="mt-4 chartjs-chart">
                                    <div id="student-div-subject-mark" class="apex-charts" data-colors="#4fc6e1"></div>
                                    <!-- <canvas id="marksChart" height="350" data-colors="#39afd1,#a17fe0"></canvas> -->
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Student Divison Mark</h4>
                                <div class="mt-4 chartjs-chart">
                                    <canvas id="student-radar-chart" data-colors="#39afd1,#a17fe0"></canvas>
                                    <!-- <canvas id="marksChart" height="350" data-colors="#39afd1,#a17fe0"></canvas> -->
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col -->

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Center modal content -->
<div class="modal fade studentMarkModal" id="studentMarkModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h4 class="modal-title" id="myaddClassModalLabel">Add Class</h4> -->
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Marks by Subject Division</h4>
                                <div class="mt-4 chartjs-chart">
                                    <canvas id="radar-chart-2" height="350" data-colors="#39afd1,#a17fe0"></canvas>
                                    <canvas id="marksChart" height="350" data-colors="#39afd1,#a17fe0"></canvas>
                                </div>
                            </div> 
                        </div>
                    </div> -->

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Marks by Subject </h4>
                                <div class="mt-4 chartjs-chart">
                                    <div id="student-subject-mark" class="apex-charts" data-colors="#f672a7"></div>
                                    <!-- <canvas id="marksChart" height="350" data-colors="#39afd1,#a17fe0"></canvas> -->
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col -->

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('scripts')
<script>
    var teacherSectionUrl = "{{ config('constants.api.teacher_section') }}";
    var teacherSubjectUrl = "{{ config('constants.api.teacher_subject') }}";
    var examsList = "{{ config('constants.api.get_testresult_exams') }}";
    var getSubjectMarks = "{{ config('constants.api.get_testresult_marks_subject_vs') }}";
    var getMarks_vs_grade = "{{ config('constants.api.get_marks_vs_grade') }}";
    var getsubjectdivision = "{{ config('constants.api.get_subject_division') }}";
    var getSubjectAverage = "{{ config('constants.api.get_subject_average') }}";
    var getStudentSubjectMark = "{{ config('constants.api.get_student_subject_mark') }}";
    var getStudentGrade = "{{ config('constants.api.get_student_grade') }}";
    var getSubjectDivisionMark = "{{ config('constants.api.get_subject_division_mark') }}";
    var getSubjectMarkStatus = "{{ config('constants.api.get_subject_mark_status') }}";

    // default image test
    var defaultImg = "{{ asset('images/users/default.jpg') }}";
</script>
<script src="{{ asset('js/custom/testresult.js') }}"></script>
@endsection