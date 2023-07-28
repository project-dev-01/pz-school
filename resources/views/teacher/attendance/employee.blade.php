@extends('layouts.admin-layout')
@section('title','Employee Attendance')
@section('component_css')
<!-- date picker -->
<link href="{{ asset('public/date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/date-picker/style.css') }}" rel="stylesheet" type="text/css" />

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
                    <!--<ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Wizard</li>
                    </ol>-->
                </div>
                <h4 class="page-title">{{ __('messages.employee_attendance') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                        {{ __('messages.select_ground') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="employeeAttendanceFilter" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                            <input type="hidden" id="employee" name="employee" value="{{$employee}}">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="session_id">{{ __('messages.session') }}<span class="text-danger">*</span></label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="">{{ __('messages.select_session') }}</option>
                                        @forelse($session as $ses)
                                        <option value="{{$ses['id']}}" {{$current_session == $ses['id'] ? 'selected' : ''}}>{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date">{{ __('messages.month') }}/{{ __('messages.year') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="date" placeholder="{{ __('messages.mm_yyyy') }}" id="employeeDate">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                            {{ __('messages.filter') }}
                            </button>
                            <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                Cancel
                            </button>-->
                        </div>

                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
    <div class="row" id="employee_attendance" style="display:none;">
        <div class="col-xl-12 addEmployeeAttendanceForm">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                        {{ __('messages.employee_list') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="addEmployeeAttendanceForm" method="post" action="{{ route('teacher.attendance.employee_add') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="table-responsive">
                                        <table class="table w-100 nowrap" id="timetable_table">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('messages.date') }}</th>
                                                    <th>{{ __('messages.status') }}</th>
                                                    <th>{{ __('messages.check_in') }}</th>
                                                    <th>{{ __('messages.check_out') }}</th>
                                                    <th>{{ __('messages.total_hours') }}</th>
                                                    <th>{{ __('messages.reason') }}</th>
                                                    <th>{{ __('messages.remarks') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody id="employee_attendance_body">

                                            </tbody>
                                        </table>

                                    </div> <!-- end table-responsive-->

                                </div> <!-- end card-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->
                        <input type="hidden" id="employee_form_employee" name="employee">
                        <input type="hidden" id="employee_form_session_id" name="session_id">
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                            {{ __('messages.save') }}
                            </button>
                            <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                            Cancel
                        </button>-->
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

</div> <!-- container -->

@endsection
@section('scripts')
<script src="{{ asset('public/libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- plugin js -->
<script src="{{ asset('public/libs/moment/min/moment.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('public/libs/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('public/libs/morris.js06/morris.min.js') }}"></script>
<script src="{{ asset('public/libs/raphael/raphael.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('public/js/validation/validation.js') }}"></script>
<script src="{{ asset('public/date-picker/jquery-ui.js') }}"></script>
<!-- hightcharts js -->
<script src="{{ asset('public/js/highcharts/highcharts.js') }}"></script>
<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<script>
     toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('public/date-picker/jquery-ui.js') }}"></script>
<script>
    var getEmployeAttendanceList = "{{ route('teacher.attendance.employee_list') }}";
    var employeeByDepartment = "{{ config('constants.api.employee_by_department') }}";
    var getTeacherAbsentExcuse = "{{ config('constants.api.get_teacher_absent_excuse') }}";
    
    // localStorage variables
    var teacher_employee_attendance_storage = localStorage.getItem('teacher_employee_attendance_details');
</script>
<script src="{{ asset('public/js/custom/teacher_attendance_list.js') }}"></script>

@endsection