@extends('layouts.admin-layout')
@section('title','Exam Marks')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection
@section('content')
<style>
    .ellipse {
        white-space: nowrap;
        display: inline-block;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .two-lines {
        -webkit-line-clamp: 2;
        display: inline-grid;
        white-space: normal;
    }

    .width {
        width: 130px;
    }
</style>
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">{{ __('messages.exam_marks') }}</h4>
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
                                <h4 class="navv">{{ __('messages.exam_marks') }}
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <form id="testresultFilter" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="changeClassName">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                            <select id="changeClassName" class="form-control" name="class_id">
                                                <option value="">{{ __('messages.select_grade') }}</option>
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
                                                <option value="">{{ __('messages.select_class') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="examnames">{{ __('messages.test_name') }}<span class="text-danger">*</span></label>
                                            <select id="examnames" class="form-control" name="exam_id">
                                                <option value="">{{ __('messages.select_exams') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="subjectID">{{ __('messages.subject') }}<span class="text-danger">*</span></label>
                                            <select id="subjectID" class="form-control" name="subject_id">
                                                <option value="">{{ __('messages.select_subject') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="paperID">{{ __('messages.paper_name') }}</label>
                                            <select id="paperID" class="form-control" name="paper_id">
                                                <option value="">{{ __('messages.select_paper') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="semester_id">{{ __('messages.semester') }}</label>
                                            <select id="semester_id" class="form-control" name="semester_id">
                                                <option value="0">{{ __('messages.select_semester') }}</option>
                                                @foreach($semester as $sem)
                                                <option value="{{$sem['id']}}" {{ $current_semester == $sem['id'] ? 'selected' : ''}}>{{$sem['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="session_id">{{ __('messages.session') }}</label>
                                            <select id="session_id" class="form-control" name="session_id">
                                                <option value="0">{{ __('messages.select_session') }}</option>
                                                @foreach($session as $ses)
                                                <option value="{{$ses['id']}}" {{$current_session == $ses['id'] ? 'selected' : ''}}>{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                        {{ __('messages.filter') }}
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
            <div class="card" id="mark_by_subject_card" style="display:none;">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> {{ __('messages.marks_by_subject') }}
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
                        <input type="hidden" name="paper_id" id="listModePaperID">
                        <input type="hidden" name="semester_id" id="listModeSemesterID">
                        <input type="hidden" name="session_id" id="listModeSessionID">
                        <input type="hidden" name="grade_category" id="grade_category">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <div class="card-body">
                                    <!-- <table id="stdmarks" data-toggle="table" data-page-size="7" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable "> -->
                                    <table id="stdmarks" class="table w-100 nowrap">
                                        <thead>
                                            <tr>
                                                <th width="10%">#</th>
                                                <th class="text-center" width="10%">{{ __('messages.student_name') }}</th>
                                                <th class="text-center" width="20%">{{ __('messages.score') }}</th>
                                                <th class="text-center" width="15%">{{ __('messages.grade') }}</th>
                                                <th class="text-center" width="15%">{{ __('messages.pass') }}/{{ __('messages.fail') }}</th>
                                                <th class="text-center" width="15%">{{ __('messages.ranking') }}</th>
                                                <th class="text-center" width="15%">{{ __('messages.status') }}</th>
                                                <th class="text-center" width="30%">{{ __('messages.memo') }}</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <br>
                                    <div class="form-group text-right m-b-0">

                                        <button class="btn btn-primary-bl waves-effect waves-light" id="saveClassRoomAttendance" type="submit">
                                            {{ __('messages.save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card" id="subject_average_card" style="display:none">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.subject_average') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Portlet card -->
                        <div class="">
                            <div class="card-body">
                                <div class="card-widgets">
                                    <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                    <a data-toggle="collapse" href="#cardCollpase4" role="button" aria-expanded="false" aria-controls="cardCollpase4"><i class="mdi mdi-minus"></i></a>
                                    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                </div>
                                <h4 class="header-title mb-0">{{ __('messages.subject_average') }}</h4>

                                <div id="cardCollpase4" class="collapse pt-3 show" dir="ltr">
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
                        <h4 class="navv">{{ __('messages.scores_by_graph') }}
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
                            <h4 class="header-title mb-0">{{ __('messages.statistics') }}</h4>

                            <div id="cardCollpase3" class="collapse pt-3 show">
                                <div class="text-center">

                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <h3 data-plugin="">{{ __('messages.number_of_student') }}</h3>
                                            <p class="text-muted font-13 mb-0 text-truncate">{{ __('messages.y_axis') }}</p>
                                        </div>
                                        <div class="col-6">
                                            <h3 data-plugin="">{{ __('messages.grade') }}</h3>
                                            <p class="text-muted font-13 mb-0 text-truncate">{{ __('messages.x_axis') }}</p>
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
                        <h4 class="navv">{{ __('messages.graphs') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="row">
                    <div class="col-lg-12" id="donut-chart" style="display:none">
                        <!-- Portlet card -->
                        <div class="">
                            <div class="card-body" dir="ltr">
                                <div class="card-widgets">
                                    <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                    <a data-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="false" aria-controls="cardCollpase1"><i class="mdi mdi-minus"></i></a>
                                    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                </div>
                                <h4 class="header-title mb-0">{{ __('messages.test_execution_summary') }}</h4>

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
                                <h4 class="header-title">{{ __('messages.test_score_analysis') }}</h4>
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
                                <h4 class="header-title">{{ __('messages.marks_by_subject') }} </h4>
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

<div class="modal fade" id="stuRemarksPopup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <label for="heard">{{ __('messages.remarks') }}</label>
                <input type="hidden" id="studenetID" />
                <textarea class="form-control" id="student_remarks" maxlength="50" rows="5" placeholder="{{ __('messages.enter_memo_here') }}" name="student_remarks"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                <button type="button" id="studentRemarksSave" class="btn btn-primary">{{ __('messages.save') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>


<script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('libs/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('libs/morris.js06/morris.min.js') }}"></script>
<script src="{{ asset('libs/raphael/raphael.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<!-- hightcharts js -->
<!-- <script src="{{ asset('js/highcharts/highcharts.js') }}"></script> -->
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script>
    var teacherSectionUrl = "{{ config('constants.api.teacher_section') }}";
    // var teacherSubjectUrl = "{{ config('constants.api.subject_by_class') }}";
    var subjectByExamNames = "{{ config('constants.api.subject_by_exam_names') }}";
    var examBySubjects = "{{ config('constants.api.exam_by_teacher_subjects') }}";
    var subjectByPapers = "{{ config('constants.api.subject_by_papers') }}";

    var examsList = "{{ config('constants.api.get_testresult_exams') }}";
    var paperList = "{{ config('constants.api.get_paper_list') }}";

    var getSubjectMarks = "{{ config('constants.api.get_testresult_marks_subject_vs') }}";
    var getMarks_vs_grade = "{{ config('constants.api.get_marks_vs_grade') }}";
    var getsubjectdivision = "{{ config('constants.api.get_subject_division') }}";
    var getSubjectAverage = "{{ config('constants.api.get_subject_average') }}";
    var getStudentSubjectMark = "{{ config('constants.api.get_student_subject_mark') }}";
    var getStudentGrade = "{{ config('constants.api.get_student_grade') }}";
    var getSubjectDivisionMark = "{{ config('constants.api.get_subject_division_mark') }}";
    var getSubjectMarkStatus = "{{ config('constants.api.get_subject_mark_status') }}";
    var teacherID = ref_user_id;
    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    // localStorage variables
    var exam_mark_storage = localStorage.getItem('teacher_exam_mark_details');
</script>
<script src="{{ asset('js/custom/testresult.js') }}"></script>
@endsection