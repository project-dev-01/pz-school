@extends('layouts.admin-layout')
@section('title',' ' . __('messages.exam_result') . '')
@section('component_css')
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
                <h4 class="page-title">{{ __('messages.exam_result') }}</h4>
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
                        {{ __('messages.exam') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="byexamfilter" data-parsley-validate="">
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
                                    <label for="changeClassName">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
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
                                        <option value="{{$sem['id']}}">{{$sem['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" style="display:none;">
                                <div class="form-group">
                                    <label for="session_id">{{ __('messages.session') }}</label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="0">{{ __('messages.select_session') }}</option>
                                        @forelse($session as $ses)
                                        <option value="{{$ses['id']}}">{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                        @empty
                                        @endforelse
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
                                    <label for="heard">{{ __('messages.roll_no') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="registerno" name="registerno">
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


    <div class="row" id="exam_details_div" style="display: none;">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                        {{ __('messages.exam_result') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                            <header><b>{{ __('messages.student_general_details') }}</b></header>
                                            <h4>
                                    </li>
                                </ul>
                                <br>
                                <!-- <header><b style="line-height:35px;">Student General Details</b></header>-->
                                <div id="byStudentGeneralDetails">
                                </div>
                            </div>
                        </div>
                        <br>



                        <div class="col-sm-12">
                            <div class="card-box">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                            <header><b>{{ __('messages.individual_subject') }}</b></header>
                                            <h4>
                                    </li>
                                </ul>
                                <br>
                                <!--<header><b style="line-height:35px;">Individual Subject</b></header>-->
                                <div id="byStudentTableAppend">
                                </div>
                                <div class="col-md-12">
                                    <div class="clearfix mt-4">
                                        <form method="post" action="{{ route('admin.exam_results.downbystudentroll') }}">
                                            @csrf
                                            <input type="hidden" name="exam_id" id="downExamID">
                                            <input type="hidden" name="class_id" id="downClassID">
                                            <input type="hidden" name="section_id" id="downSectionID">
                                            <input type="hidden" name="registerno" id="downRegisterNoID">
                                            <input type="hidden" name="semester_id" id="downSemesterID">
                                            <input type="hidden" name="session_id" id="downSessionID">
                                            <input type="hidden" name="academic_year" id="downAcademicYear">
                                            
                                            <div class="clearfix float-right" style="margin-bottom:5px;">
                                                <button type="submit" class="btn btn-primary-bl waves-effect waves-light exportToPDF" id="exportToPDF">{{ __('messages.pdf') }}</button>
                                                <button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel">{{ __('messages.download') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

</div> <!-- container -->


@endsection
@section('scripts')
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('js/dist/jquery.table2excel.js') }}"></script>
<script>
    var sectionByClass = "{{ config('constants.api.exam_results_get_class_by_section') }}";

    var examsByclassandsection = "{{ config('constants.api.exam_by_classSection') }}";
    var getbyresult = "{{ config('constants.api.student_result') }}";
    var getgradeBysubject = "{{ config('constants.api.get_grade_bysubject') }}";
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
    var teacher_id = null;
    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var downloadFileName = "{{ __('messages.individual_result') }}";
    // localStorage variables
    var exam_result_individual_storage = localStorage.getItem('admin_exam_result_individual_details');

</script>
<script src="{{ asset('js/custom/exam_result.js') }}"></script>
@if(!empty(Session::get('school_roleid')))
<script>
var checkpermissions = "{{ route('admin.school_role.checkpermissions') }}";
</script>
<script src="{{ asset('js/custom/permissions.js') }}"></script>
@endif
@endsection