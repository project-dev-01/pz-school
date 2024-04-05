@extends('layouts.admin-layout')
@section('title',' ' . __('messages.student_list') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<!-- <link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}"> -->

<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

@endsection
@section('content')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <!--<ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Wizard</li>
                    </ol>-->
                </div>
                <h4 class="page-title">{{ __('messages.student_list') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.students_list') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="col-md-12">
                        <ul class="nav nav-pills navtab-bg nav-justified">
                            <li class="nav-item">
                                <a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                    {{ __('messages.students_list') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#profile1" data-toggle="tab" aria-expanded="true" class="nav-link">
                                    {{ __('messages.setting_student_information') }}
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="home1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item">
                                                    <h4 class="nav-link">{{ __('messages.select_ground') }}
                                                        <h4>
                                                </li>
                                            </ul><br>
                                            <div class="card-body">
                                                <form id="StudentFilter" autocomplete="off">
                                                    <div class="row">
                                                        <!-- <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="academic_year">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                                                                <select id="academic_year" name="academic_year" class="form-control">
                                                                    <option value="">{{ __('messages.select_academic_year') }}</option>
                                                                    @foreach($academic_year_list as $year)
                                                                    <option value="{{ $year['id'] }}" {{ session('academic_session_id') == $year['id'] ? 'selected' : '' }}>
                                                                        {{ $year['name'] }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div> -->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="student_name">{{ __('messages.student_name') }}</label>
                                                                <input type="text" name="student_name" class="form-control" id="student_name"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="department_id_filter">{{ __('messages.department') }}</label>
                                                                <select id="department_id_filter" name="department_id_filter" class="form-control">
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
                                                                <label for="class_id">{{ __('messages.grade') }}</label>
                                                                <select id="class_id" class="form-control" name="class_id">
                                                                    <option value="">{{ __('messages.select_grade') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="section_id">{{ __('messages.class') }}</label>
                                                                <select id="section_id" class="form-control" name="section_id">
                                                                    <option value="">{{ __('messages.select_class') }}</option>
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
                                                                <label for="student_status">{{ __('messages.status') }}</label>
                                                                <select id="student_status" class="form-control" name="status">
                                                                    <option value="">{{ __('messages.select_status') }}</option>
                                                                    <option value="0">{{ __('messages.active') }}</option>
                                                                    <option value="1">{{ __('messages.de_active') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-right m-b-0">
                                                        <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                                            {{ __('messages.filter') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="student">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item">
                                                    <h4 class="nav-link">
                                                        {{ __('messages.students_list') }}
                                                        <h4>
                                                </li>
                                            </ul><br>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                            <table class="table w-100 nowrap " id="student-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th> {{ __('messages.name') }}</th>
                                                                        <th> {{ __('messages.name_common') }}</th>
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
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group text-right m-b-0">
                                                            <form method="post" action="{{ route('admin.student_list.excel')}}">
                                                                @csrf
                                                                <input type="hidden" name="student_name" id="excelStudentName">
                                                                <input type="hidden" name="department_id" id="excelDepartment">
                                                                <input type="hidden" name="class_id" id="excelClassID">
                                                                <input type="hidden" name="section_id" id="excelSectionID">
                                                                <input type="hidden" name="status" id="excelStatus">
                                                                <input type="hidden" name="session" id="excelSession">
                                                                <input type="hidden" name="academic_year" id="academicYear">
                                                                <div class="clearfix float-right" style="margin-top:20px;">
                                                                    <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                                                        {{ __('messages.download') }}
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item">
                                                    <h4 class="nav-link">
                                                        {{ __('messages.setting_student_information') }}
                                                        <h4>
                                                </li>
                                            </ul><br>
                                            <!-- <div class="card-body"> -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card-body">
                                                        <form id="StudentSettingFilter" autocomplete="off">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <ul class="list-unstyled">
                                                                        <li>
                                                                            <div class="checkbox checkbox-primary mb-2">
                                                                                <input id="checkboxStudentDetails" name="checkboxStudentDetails" type="checkbox" {{ isset($get_student_download_settings['student_info']) ? $get_student_download_settings['student_info'] == "1" ? "checked" : "" : "" }}>
                                                                                <label for="checkboxStudentDetails">
                                                                                    {{ __('messages.student_details') }}
                                                                                </label>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox checkbox-primary mb-2">
                                                                                <input id="checkboxParentDetails" name="checkboxParentDetails" type="checkbox" {{ isset($get_student_download_settings['parent_info']) ? $get_student_download_settings['parent_info'] == "1" ? "checked" : "" : "" }}>
                                                                                <label for="checkboxParentDetails">
                                                                                    {{ __('messages.parent_details') }}
                                                                                </label>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox checkbox-primary mb-2">
                                                                                <input id="checkboxSchoolDetails" name="checkboxSchoolDetails" type="checkbox" {{ isset($get_student_download_settings['school_info']) ? $get_student_download_settings['school_info'] == "1" ? "checked" : "" : "" }}>
                                                                                <label for="checkboxSchoolDetails">
                                                                                    {{ __('messages.school_information') }}
                                                                                </label>
                                                                            </div>
                                                                        </li>
                                                                        <!-- <li>
                                                                            <div class="checkbox checkbox-primary mb-2">
                                                                                <input id="checkboxAcademic" name="checkboxAcademic" type="checkbox" {{ isset($get_student_download_settings['grade_class_info']) ? $get_student_download_settings['grade_class_info'] == "1" ? "checked" : "" : "" }} onchange="updateCheckboxes(this)">
                                                                                <label for="checkboxAcademic">
                                                                                    {{ __('messages.academic_details') }}
                                                                                </label>
                                                                            </div>
                                                                            <div class="card" style="background-color:#8adfee14;">
                                                                                <div class="card-body">
                                                                                    <ul>
                                                                                        <li class="list-unstyled">
                                                                                            <ul class="list-inline m-b-0">
                                                                                                <li class="list-inline-item">
                                                                                                    <div class="checkbox checkbox-primary mb-2">
                                                                                                        <input id="checkboxGrade" name="checkboxGrade" type="checkbox" {{ isset($get_student_download_settings['academic_info']) ? $get_student_download_settings['academic_info'] == "1" ? "checked" : "" : "" }}>
                                                                                                        <label for="checkboxGrade">
                                                                                                            {{ __('messages.grade') }}&{{ __('messages.classes') }}
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </li>
                                                                                                <li class="list-inline-item">
                                                                                                    <select id="gardeClassAcademic" name="gardeClassAcademic" class="form-control" style="width: 200px;background-color: white;">
                                                                                                        @forelse($academic_year_list as $r)
                                                                                                        <option value="{{$r['id']}}" {{ isset($get_student_download_settings['grade_class_academic_year']) ?  $get_student_download_settings['grade_class_academic_year'] == $r['id'] ? 'selected' : '' : "" }}>{{$r['name']}}</option>
                                                                                                        @empty
                                                                                                        @endforelse
                                                                                                    </select>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </li> -->
                                                                                         <!-- <li class="list-unstyled">
                                                                                        <ul class="list-inline m-b-0">
                                                                                            <li class="list-inline-item">
                                                                                                <div class="checkbox checkbox-primary mb-2">
                                                                                                    <input id="checkbox2" type="checkbox" checked>
                                                                                                    <label for="checkbox2">
                                                                                                        Activity
                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="list-inline-item" style="margin-left: 54px;">
                                                                                                <select id="inputState" class="form-control" style="width: 200px;background-color: white;">
                                                                                                @forelse($academic_year_list as $r)
                                                                                                    <option value="{{$r['id']}}">{{$r['name']}}</option>
                                                                                                    @empty
                                                                                                    @endforelse
                                                                                                </select>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </li> -->
                                                                         <!-- <li class="list-unstyled">
                                                                            <ul class="list-inline m-b-0">
                                                                                <li class="list-inline-item">
                                                                                    <div class="checkbox checkbox-primary mb-2">
                                                                                        <input id="checkboxAttendance" name="checkboxAttendance" type="checkbox" {{ isset($get_student_download_settings['attendance_info']) ? $get_student_download_settings['attendance_info'] == "1" ? "checked" : "" : "" }}>
                                                                                        <label for="checkboxAttendance">
                                                                                            {{ __('messages.attendance') }}
                                                                                        </label>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="list-inline-item" style="margin-left: 22px;">
                                                                                    <select id="attendanceAcademic" name="attendanceAcademic" class="form-control" style="width: 200px;background-color: white;">
                                                                                        @forelse($academic_year_list as $r)
                                                                                        <option value="{{$r['id']}}" {{ isset($get_student_download_settings['attendance_academic_year']) ?  $get_student_download_settings['attendance_academic_year'] == $r['id'] ? 'selected' : '' : "" }}>{{$r['name']}}</option>
                                                                                        @empty
                                                                                        @endforelse
                                                                                    </select>
                                                                                </li>
                                                                            </ul>
                                                                        </li> -->
                                                                        <!-- <li class="list-unstyled">
                                                                            <ul class="list-inline m-b-0">
                                                                                <li class="list-inline-item">
                                                                                    <div class="checkbox checkbox-primary mb-2">
                                                                                        <input id="checkboxTestResult" name="checkboxTestResult" type="checkbox" {{ isset($get_student_download_settings['test_result_info']) ? $get_student_download_settings['test_result_info'] == "1" ? "checked" : "" : "" }}>
                                                                                        <label for="checkboxTestResult">
                                                                                            {{ __('messages.test_results') }}
                                                                                        </label>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="list-inline-item" style="margin-left: 18px;">
                                                                                    <select id="testResultAcademic" name="testResultAcademic" class="form-control" style="width: 200px;background-color: white;">
                                                                                        @forelse($academic_year_list as $r)
                                                                                        <option value="{{$r['id']}}" {{ isset($get_student_download_settings['test_result_academic_year']) ?  $get_student_download_settings['test_result_academic_year'] == $r['id'] ? 'selected' : '' : "" }}>{{$r['name']}}</option>
                                                                                        @empty
                                                                                        @endforelse
                                                                                    </select>
                                                                                </li>
                                                                            </ul>
                                                                        </li> -->
                                                                        <!-- <li class="list-unstyled">
                                                                                        <ul class="list-inline m-b-0">
                                                                                            <li class="list-inline-item">
                                                                                                <div class="checkbox checkbox-primary mb-2">
                                                                                                    <input id="checkbox2" type="checkbox" checked>
                                                                                                    <label for="checkbox2">
                                                                                                        Interview
                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="list-inline-item" style="margin-left: 41px;">
                                                                                                <select id="inputState" class="form-control" style="width: 200px;background-color: white;">
                                                                                                   @forelse($academic_year_list as $r)
                                                                                                    <option value="{{$r['id']}}">{{$r['name']}}</option>
                                                                                                    @empty
                                                                                                    @endforelse
                                                                                                </select>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </li>  -->
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-md-3">
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="form-group text-left m-b-0">
                                                                <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                                                    {{ __('messages.save') }}
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- </div>  -->
                                        </div> <!-- end card-->
                                    </div> <!-- end col -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->

            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col -->
</div>
<!--- end row -->
</div>
<!-- container -->

@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- button js added -->
<!-- <script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.3/js/buttons.colVis.min.js"></script> -->

<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    function updateCheckboxes(academicCheckbox) {
        // Get the checkboxes you want to manage
        var gradeCheckbox = document.getElementById("checkboxGrade");
        var attendanceCheckbox = document.getElementById("checkboxAttendance");
        var testCheckbox = document.getElementById("checkboxTestResult");

        // Add similar lines for other checkboxes as needed

        if (!academicCheckbox.checked) {
            // If Academic checkbox is unchecked, uncheck other checkboxes
            gradeCheckbox.checked = false;
            attendanceCheckbox.checked = false;
            testCheckbox.checked = false;
            // Add similar lines for other checkboxes as needed
        } else {
            // If Academic checkbox is checked, check other checkboxes
            gradeCheckbox.checked = true;
            attendanceCheckbox.checked = true;
            testCheckbox.checked = true;
            // Add similar lines for other checkboxes as needed
        }
    }
</script>

<script>
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";

    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var studentDelete = "{{ route('admin.student.delete') }}";
    var studentList = "{{ route('admin.student.list') }}";
    var studentSettings = "{{ route('admin.student.student_setting') }}";
    // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_student') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end// Get PDF Footer Text

    // Get PDF Footer Text
    var header_txt = "{{ __('messages.student_list') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
    // localStorage variables
    var student_list_storage = localStorage.getItem('admin_student_list_details');
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
</script>
<script src="{{ asset('js/custom/student.js') }}"></script>
@endsection