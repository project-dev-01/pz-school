@extends('layouts.admin-layout')
@section('title','Analytic Report')
@section('component_css')
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=0.5, user-scalable=no">
<style>
    @media only screen and (min-device-width: 320px) and (max-device-width: 844px) {
        .homework {
            height: 95%;
        }
    }

    @media only screen and (min-device-width: 390px) and (max-device-width: 896px) {
        .homeworkstatus {
            margin-top: 25px;
        }
    }
</style>
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
                <h4 class="page-title">{{ __('messages.analytic_report') }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            {{ __('messages.select_ground') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="analyticCrepFilter" autocomplete="off">
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
                                    <label for="subjectID">{{ __('messages.subject') }}<span class="text-danger">*</span></label>
                                    <select id="subjectID" class="form-control" name="subject_id">
                                        <option value="">{{ __('messages.select_subject') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="studentID">{{ __('messages.student') }}<span class="text-danger">*</span></label>
                                    <select id="studentID" class="form-control" name="student_id">
                                        <option value="">{{ __('messages.select_student') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="semester_id">{{ __('messages.semester') }}</label>
                                    <select id="semester_id" class="form-control" name="semester_id">
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
                                    <label for="session_id">{{ __('messages.session') }}</label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="0">{{ __('messages.select_session') }}</option>
                                        @forelse($session as $ses)
                                        <option value="{{$ses['id']}}" {{$current_session == $ses['id'] ? 'selected' : ''}}>{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                    {{ __('messages.filter') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <div class="row">
        <div class="col-xl-6 col-md-6" id="attendance_card" style="display:none">
            <!-- Portlet card -->
            <div class="card homework">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            {{ __('messages.attendance_report') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="col-md-12">
                        <div id="cardCollpaseAttrep" class="collapse pt-4 show" dir="ltr">
                            <div id="anylitc-attend" class="apex-charts" data-colors="#F5AA26,#F1556C,#4FC6E1"></div>
                        </div> <!-- collapsed end -->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-xl-6 col-md-6" id="homework_card" style="display:none">
            <!-- Portlet card -->
            <div class="card homework">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            {{ __('messages.homeWork_report') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="col-md-12 homeworkstatus">
                        <div id="cardCollpase19" class="collapse pt-4 show" dir="ltr">
                            <div id="homework-status" class="apex-charts" data-colors="#1FAB44,#f1556c,#4FC6E1"></div>
                        </div> <!-- collapsed end -->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <div class="row" id="attitude_card" style="display:none">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            {{ __('messages.attitude') }}
                            <h4>
                    </li>
                </ul><br>

                <div class="card-body">
                    <div class="col-xl-12">
                        <div class="" style="text-align:center">
                            <div id="attitude" class="attitude"></div>
                            <!-- <canvas id="marksChart" height="350" data-colors="#39afd1,#a17fe0"></canvas> -->
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>

    <div class="row" id="short_test_card" style="display:none">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            {{ __('messages.short_test') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="shortTest"></div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->
                    <!--- end row -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <div class="row" id="exam_result_card" style="display:none">
        <div class="col-md-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            {{ __('messages.exam_result') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="mt-4 chartjs-chart">
                            <canvas id="exam-result-analytic"></canvas>
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
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
                <div class="card">
                    <div class="card-body">
                        <div class="card-widgets">
                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                            <a data-toggle="collapse" href="#cardCollpase4" role="button" aria-expanded="false" aria-controls="cardCollpase4"><i class="mdi mdi-minus"></i></a>
                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                        </div>
                        <h4 class="header-title mb-0">{{ __('messages.subject_average') }}</h4>

                        <div id="cardCollpase4" class="collapse pt-3 show" dir="ltr">
                            <div id="subject-avg-chart-student" class="apex-charts" data-colors="#f672a7"></div>
                        </div> <!-- collapsed end -->

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div>
        </div>
    </div> <!-- end card body-->

    @include('teacher.dashboard.check_list')

</div> <!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('libs/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('libs/morris.js06/morris.min.js') }}"></script>
<script src="{{ asset('libs/raphael/raphael.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<!-- hightcharts js -->
<script src="{{ asset('js/highcharts/highcharts.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script>
    var teacherSectionUrl = "{{ config('constants.api.teacher_section') }}";
    var teacherSubjectUrl = "{{ config('constants.api.teacher_subject') }}";
    var getStudentListByClassSection = "{{ config('constants.api.get_student_list_by_class_section') }}";
    var getAttendanceLateGraph = "{{ config('constants.api.get_attendance_late_graph') }}";
    var getHomeworkGraphByStudent = "{{ config('constants.api.get_homework_graph_by_student') }}";
    var getAttitudeGraphByStudent = "{{ config('constants.api.get_attitude_graph_by_student') }}";
    var getShortTestGraphByStudent = "{{ config('constants.api.get_short_test_by_student') }}";
    var getSubjectAbgGraphByStudent = "{{ config('constants.api.get_subject_average_by_student') }}";
    var getExamMarksGraphByStudent = "{{ config('constants.api.get_exam_marks_by_student') }}";

    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    // localStorage variables
    var teacher_analytic_storage = localStorage.getItem('teacher_analytic_details');
</script>
<script src="{{ asset('js/custom/analytics.js') }}"></script>
@endsection