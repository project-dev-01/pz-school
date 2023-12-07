@extends('layouts.admin-layout')
@section('title',' ' . __('messages.export_result') . '')
@section('component_css')
<!-- date picker -->
<link href="{{ asset('public/date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">{{ __('messages.exam_report') }}</h4>
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
                        {{ __('messages.export_result') }}
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
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                        <!-- <option value="All">All</option> -->
                                        @forelse ($classnames as $class)

                                        <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
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
                                        <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="student_id">{{ __('messages.report_type') }}</label>
                                    <select id="report_type" class="form-control" name="report_type">
                                        <option value="All">{{ __('messages.all') }}</option>
                                        <option value="1">{{ __('messages.report_card') }}</option>
                                        <option value="2">{{ __('messages.personal_test_res') }}</option>
                                        <option value="3">{{ __('messages.english_communication') }}</option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                            {{ __('messages.get_pdf') }}
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
                        {{ __('messages.student') }}
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
                                        <form method="post" action="{{ route('admin.exam_results.downbystudent') }}">
                                            @csrf
                                            <input type="hidden" name="exam_id" id="downExamID">
                                            <input type="hidden" name="class_id" id="downClassID">
                                            <input type="hidden" name="semester_id" id="downSemesterID">
                                            <input type="hidden" name="session_id" id="downSessionID">
                                            <input type="hidden" name="section_id" id="downSectionID">
                                            <input type="hidden" name="academic_year" id="downAcademicYear">
                                            <div class="clearfix float-right" style="margin-bottom:5px;">
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
<!-- validation js -->
<script src="{{ asset('public/js/validation/validation.js') }}"></script>
<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('public/js/dist/jquery.table2excel.js') }}"></script>
<script>
    var sectionByClass = "{{ config('constants.api.exam_results_get_class_by_section') }}";
    var examsByclassandsection = "{{ config('constants.api.exam_by_classSection') }}";
    var getbyStudent = "{{ config('constants.api.tot_grade_calcu_byStudent') }}";
    // default image test
    var teacher_id = null;
    var defaultImg = "{{ config('constants.image_url').'/public/common-asset/images/users/default.jpg' }}";
    var downloadFileName = "{{ __('messages.by_student') }}";
    var getStudentList = "{{ config('constants.api.get_student_details') }}";
    // localStorage variables
   // var exam_result_by_student_storage = localStorage.getItem('admin_exam_result_by_student_details');
</script>
<script src="{{ asset('public/js/custom/bystudent.js') }}"></script>
@endsection