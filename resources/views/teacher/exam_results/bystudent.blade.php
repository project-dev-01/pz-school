@extends('layouts.admin-layout')
@section('title','By Student')
@section('content')
<style>
    .btn-primary-bl {
        width: 100px;
        margin-bottom: 5px;
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
                <h4 class="page-title">{{ __('messages.by_student') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                        {{ __('messages.select_ground') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="bystudentfilter" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btwyears">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                                    <select id="btwyears" class="form-control" name="year">
                                        <option value="">{{ __('messages.select_academic_year') }}</option>
                                        @forelse($academic_year_list as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="changeClassName">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">Select Grade</option>
                                        <!-- <option value="All">All</option> -->
                                        @forelse ($classnames as $class)

                                        <option value="{{ $class['class_id'] }}">{{ $class['class_name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="section_drp_div">
                                <div class="form-group">
                                    <label for="sectionID">{{ __('messages.class') }}<span class="text-danger">*</span>
                                    </label>
                                    <select id="sectionID" class="form-control" name="section_id">
                                        <option value="">Select Class</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="semester_id">{{ __('messages.semester') }}</label>
                                    <select id="semester_id" class="form-control" name="semester_id">
                                        <option value="0">Select Semester</option>
                                        @foreach($semester as $sem)
                                        <option value="{{$sem['id']}}">{{$sem['name']}}</option>
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
                                        <option value="{{$ses['id']}}" {{'1' == $ses['id'] ? 'selected' : ''}}>{{$ses['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="examnames">{{ __('messages.test_name') }}<span class="text-danger">*</span></label>
                                    <select id="examnames" class="form-control" name="exam_id">
                                        <option value="">Select Exams</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="student_id">{{ __('messages.student') }}</label>
                                    <select id="student_id" class="form-control" name="student_id">
                                        <option value="">Select Student</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                            {{ __('messages.get') }}
                            </button>
                        </div>
                    </form>


                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


    <div class="row" style="display: none;" id="bystudent_bodycontent">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            Student
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <div id="byStudentTableAppend">

                                </div>
                                <div class="col-md-12">
                                    <div class="clearfix mt-4">
                                        <form method="post" action="{{ route('teacher.exam_results.downbystudent') }}">
                                            @csrf
                                            <input type="hidden" name="exam_id" id="downExamID">
                                            <input type="hidden" name="class_id" id="downClassID">
                                            <input type="hidden" name="semester_id" id="downSemesterID">
                                            <input type="hidden" name="session_id" id="downSessionID">
                                            <input type="hidden" name="section_id" id="downSectionID">
                                            <input type="hidden" name="academic_year" id="downAcademicYear">
                                            <div class="clearfix float-right">
                                                <button type="submit" class="btn btn-primary-bl waves-effect waves-light exportToPDF" id="exportToPDF">{{ __('messages.pdf') }}</button>
                                                <button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel">{{ __('messages.download') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- <div class="row" id="bystudent_analysis">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Student Analysis</h4>

                    <div class="mt-4 chartjs-chart">
                        <canvas id="radar-chart-test-bystudent" height="350" data-colors="#39afd1,#a17fe0"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div> <!-- container -->

@endsection
@section('scripts')
<script src="{{ asset('public/js/dist/jquery.table2excel.js') }}"></script>
<script>
    var sectionByClass = "{{ config('constants.api.exam_results_get_class_by_section') }}";
    var examsByclassandsection = "{{ config('constants.api.exam_by_classSection') }}";
    var getbyStudent = "{{ config('constants.api.tot_grade_calcu_byStudent') }}";
    // default image test
    var teacher_id = "{{ Session::get('ref_user_id') }}";
    var defaultImg = "{{ asset('public/images/users/default.jpg') }}";
    var getStudentList = "{{ config('constants.api.get_student_details') }}";
</script>
<script src="{{ asset('public/js/custom/bystudent.js') }}"></script>
@endsection