@extends('layouts.admin-layout')
@section('title',' ' . __('messages.export_examresult') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
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
                <h4 class="page-title">{{ __('messages.export_examresult') }}</h4>
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
                    <form id="bysubjectfilter" data-parsley-validate="" >
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btwyears"> {{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
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
                                        <label for="department_id">{{ __('messages.department') }}<span class="text-danger">*</span></label>
                                        <select id="department_id" name="department_id" class="form-control">
                                            <option value="">{{ __('messages.select_department') }}</option>
                                                @forelse($department as $r)
                                                <option value="{{$r['id']}}">{{$r['name']}}</option>
                                                @empty
                                                @endforelse
                                        </select>
                                        </div>
                                    </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="changeClassName"> {{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="section_drp_div">
                                <div class="form-group">
                                    <label for="sectionID" id="lblsectionId">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                    <select id="sectionID" class="form-control" name="section_id">
                                        <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="examnames">{{ __('messages.test_name') }}<span class="text-danger">*</span></label>
                                    <select id="examnames" class="form-control" name="examnames">
                                        <option value="">{{ __('messages.select_exams') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="student_id">{{ __('messages.report_type') }}</label>
                                    <select id="report_type" class="form-control" name="report_type">
                                        <option value="">{{ __('messages.select') }}</option>
                                        <option value="report_card">{{ __('messages.report_card') }}</option>
                                        <option value="personal_test_res">{{ __('messages.personal_test_res') }}</option>
                                        <option value="english_communication">{{ __('messages.english_communication') }}</option>
                                        
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


    <div class="row" style="display: none;" id="byec_body">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                        {{ __('messages.english_communication') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            
                            <!-- <div id="btnAppend">
                            </div> -->

                            <div class="col-md-12">
                                <div class="clearfix mt-4">
                                    <form method="post" action="{{ route('admin.exam_results.downbyecreport') }}">
                                        @csrf
                                        
                                        <input type="hidden" name="department_id" class="downDepartmentID">
                                        <input type="hidden" name="exam_id" class="downExamID">
                                        <input type="hidden" name="class_id" class="downClassID">
                                        <input type="hidden" name="semester_id" class="downSemesterID">
                                        <input type="hidden" name="session_id" class="downSessionID">
                                        <input type="hidden" name="section_id" class="downSectionID">
                                        <input type="hidden" name="academic_year" class="downAcademicYear">
                                        <input type="hidden" name="report_type" class="downReport_type">
                                        
                                        <div class="clearfix float-right" style="margin-bottom:5px;">
                                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light exportToPDF" id="exportToPDF">{{ __('messages.download') }} {{ __('messages.pdf') }}</button>
                                            <!--<button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel">{{ __('messages.download') }}</button>-->
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- end row-->

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <div class="row" style="display: none;" id="byreport_body">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                        {{ __('messages.report_card') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            
                            <!-- <div id="btnAppend">
                            </div> -->
                            <div class="col-md-12">
                                <div class="clearfix mt-4">
                                    <form method="post" action="{{ route('admin.exam_results.downbyreportcard') }}">
                                        @csrf                                        
                                        <input type="hidden" name="department_id" class="downDepartmentID">
                                        <input type="hidden" name="exam_id" class="downExamID">
                                        <input type="hidden" name="class_id" class="downClassID">
                                        <input type="hidden" name="semester_id" class="downSemesterID">
                                        <input type="hidden" name="session_id" class="downSessionID">
                                        <input type="hidden" name="section_id" class="downSectionID">
                                        <input type="hidden" name="academic_year" class="downAcademicYear">
                                        <input type="hidden" name="report_type" class="downReport_type">
                                        <div class="clearfix float-right" style="margin-bottom:5px;">
                                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light exportToPDF" id="exportToPDF">{{ __('messages.download') }} {{ __('messages.pdf') }}</button>
                                            <!--<button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel">{{ __('messages.download') }}</button>-->
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- end row-->

                    </div> <!-- end card-body -->
                    <div class="row d-none">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table w-100 nowrap " id="student-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> {{ __('messages.name') }}</th>
                                            <th> {{ __('messages.register_no') }}</th>
                                            <th> {{ __('messages.roll_no') }}</th>
                                            <th> {{ __('messages.gender') }}</th>
                                            <th> {{ __('messages.email') }}</th>
                                            <th> {{ __('messages.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                        </div> <!-- end col-->
                        
                    </div>
                </div> <!-- end card-->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <div class="row" style="display: none;" id="bypersonal_body">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                        Secondary  {{ __('messages.personal_test_res') }} 
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            
                            <div id="primary_personal">
                                <h4> Report  Secondary School Only </h4>
                            </div>

                            <div class="col-md-12" id="secondary_personal">
                                <div class="clearfix mt-4">
                                    <form method="post" action="{{ route('admin.exam_results.downbypersoanalreport') }}">
                                        @csrf
                                        <input type="hidden" name="department_id" class="downDepartmentID">
                                        <input type="hidden" name="exam_id" class="downExamID">
                                        <input type="hidden" name="class_id" class="downClassID">
                                        <input type="hidden" name="semester_id" class="downSemesterID">
                                        <input type="hidden" name="session_id" class="downSessionID">
                                        <input type="hidden" name="section_id" class="downSectionID">
                                        <input type="hidden" name="academic_year" class="downAcademicYear">
                                        <input type="hidden" name="report_type" class="downReport_type">
                                        <div class="clearfix float-right" style="margin-bottom:5px;">
                                        <button type="submit" class="btn btn-primary-bl waves-effect waves-light exportToPDF" id="exportToPDF">{{ __('messages.download') }} {{ __('messages.pdf') }}</button>
                                        <!--<button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel">{{ __('messages.download') }}</button>-->
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- end row-->

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- <div class="row" id="bysubject_analysis">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Subject Analysis</h4>

                    <div class="mt-4 chartjs-chart">
                        <canvas id="radar-chart-test-bystudentmarks" height="350" data-colors="#39afd1,#a17fe0"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div> <!-- container -->

@endsection
@section('scripts')

<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('js/dist/jquery.table2excel.js') }}"></script>

<script>
    
    var studentList = "{{ route('admin.exam_result.sutdentlist') }}";
    var sectionByClass = "{{ config('constants.api.exam_results_get_class_by_section') }}";

    var examsByclassandsection = "{{ config('constants.api.exam_by_classSection') }}";
    var getbySubject = "{{ config('constants.api.tot_grade_calcu_bySubject') }}";
    var Allexams = "{{ config('constants.api.all_exams_list') }}";
    var getbySubjectAllstd = "{{ config('constants.api.all_bysubject_list') }}";
    var getgradeBysubject = "{{ config('constants.api.get_grade_bysubject') }}";
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
    var teacher_id = null;
    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var downloadFileName = "{{ __('messages.by_subject') }}";
    // localStorage variables
    var exam_result_by_subject_storage = localStorage.getItem('admin_exam_result_by_subject_details');
</script>
<script src="{{ asset('js/custom/byreport.js') }}"></script>
@endsection