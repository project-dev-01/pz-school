@extends('layouts.admin-layout')
@section('title',' ' . __('messages.student_attendance_report_settings') . '')

@section('component_css')
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('libs/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('libs/dropify/css/dropify.min.css') }}">
<style>
    .dropify-clear {
        display: none !important;
    }
</style>
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Extras</a></li> -->
                        <li class="breadcrumb-item active"></li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.student_attendance_report_settings') }}</h4>
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
                            {{ __('messages.student_attendance_report_settings') }}
                            <h4>
                    </li>
                </ul><br>
                <br>
                <div class="card-body">
                    <form id="attendanceFilter" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="department_id">{{ __('messages.department') }}</label>
                                    <select id="department_id" name="department_id" class="form-control">
                                        <option value="">{{ __('messages.select_department') }}</option>
                                        @forelse($department as $r)
                                        <option value="{{$r['id']}}" {{ isset($get_settings_row['department_id']) ?  $get_settings_row['department_id'] == $r['id'] ? 'selected' : '' : "" }}>{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="changeClassName">{{ __('messages.grade') }}</label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sectionID">{{ __('messages.class') }}</label>
                                    <select id="sectionID" class="form-control" name="section_id">
                                        <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pattern">Pattern</label>
                                    <select id="pattern" class="form-control" name="pattern">
                                        <!-- <option value="">Select Pattern</option> -->
                                        <option value="Day" {{ isset($get_settings_row['pattern']) ?  $get_settings_row['pattern'] == 'Day' ? 'selected' : '' : "" }}>Day</option>
                                        <option value="Month" {{ isset($get_settings_row['pattern']) ?  $get_settings_row['pattern'] == 'Month' ? 'selected' : '' : "" }}>Month</option>
                                        <option value="Term" {{ isset($get_settings_row['pattern']) ?  $get_settings_row['pattern'] == 'Term' ? 'selected' : '' : "" }}>Term</option>
                                        <option value="Year" {{ isset($get_settings_row['pattern']) ?  $get_settings_row['pattern'] == 'Year' ? 'selected' : '' : "" }}>Year</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                    {{ __('messages.save') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div>
        </div>
    </div>

</div> <!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/pages/form-fileuploads.init.js') }}"></script>

<script>
    var teacherSectionUrl = "{{ config('constants.api.section_by_class') }}";
    var teacherSubjectUrl = "{{ config('constants.api.subject_by_class') }}";
    var saveStgPage = "{{ config('constants.api.settings_attendance_report') }}";
    var getAttendanceListTeacher = "{{ config('constants.api.get_attendance_list_teacher') }}";
    var getReasonsByStudent = "{{ config('constants.api.get_reasons_by_student') }}";
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
    var holidayList = "{{ config('constants.api.holidays_list') }}";
    var deptIDs = "{{ (isset($get_settings_row['department_id']) ? $get_settings_row['department_id'] : null) }}";
    var classIDS = "{{ (isset($get_settings_row['class_id']) ? $get_settings_row['class_id'] : null) }}";
    var secIDs = "{{ (isset($get_settings_row['section_id']) ? $get_settings_row['section_id'] : null) }}";

    // default image test
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images' }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var admin_studentattentanceReport_storage = localStorage.getItem('admin_studentattentanceReport_details');
</script>
<script src="{{ asset('js/custom/student_attendance_report_stg.js') }}"></script>
<script>
    $('.dropify-im').dropify({
        messages: {
            default: drag_and_drop_to_check,
            replace: drag_and_drop_to_replace,
            remove: remove,
            error: oops_went_wrong
        }
    });
</script>
@endsection