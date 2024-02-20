@extends('layouts.admin-layout')
@section('title',' ' . __('messages.leave_history_by_staff') . '')
@section('component_css')
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection
@section('content')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<style>
    .table thead th,
    .table-bordered td,
    .table-bordered th {
        border: 1px solid black;
        line-height: 12px;
    }
</style>
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
                <h4 class="page-title">{{ __('messages.leave_history_by_staff') }}</h4>
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
                    <form id="employeeAttendanceReport" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="department_id">{{ __('messages.department') }}<span class="text-danger">*</span></label>
                                    <select class="form-control" name="department_id" id="department_id">
                                        <option value="">{{ __('messages.select_department') }}</option>
                                        @forelse($department as $dep)
                                        <option value="{{$dep['id']}}">{{$dep['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="staff_id">{{ __('messages.employee') }}<span class="text-danger">*</span></label>
                                    <select class="form-control" name="staff_id" id="staff_id">
                                        <option value="">{{ __('messages.select_employee') }}</option>
                                        <option value="All">{{ __('messages.all') }}</option>
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
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="row" id="employee_attendance" style="display:none;">
                <div class="col-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">
                                {{ __('messages.staff_leave_history') }} 
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <div id="leaveListDetailsAppend">
                            </div>
                            <div class="col-md-12">
                                <div class="clearfix mt-4">
                                    <form method="post" action="{{ route('admin.exam_results.downbystaffleave') }}">
                                        @csrf
                                    <input type="hidden" name="department_id" id="downDepartmentID">
                                    <input type="hidden" name="staff_id" id="downStaffID">
                                    <input type="hidden" name="academic_session_id" id="downAcademicSessionID">
                                        <div class="clearfix float-right" style="margin-bottom:5px;">
                                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light exportToPDF" id="exportToPDF">{{ __('messages.pdf') }}</button>
                                            <button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel">{{ __('messages.download') }}</button>
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
    <!-- container -->
    
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
    <script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
    <!-- hightcharts js -->
    <script src="{{ asset('js/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script>
        toastr.options.preventDuplicates = true;
    </script>
    <script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/dist/jquery.table2excel.js') }}"></script>
    <script>
        // var getEmployeAttendanceList = "{{ route('admin.attendance.employee_list') }}";
        var getEmployeLeaveList = "{{ route('admin.leave_management.employee_leave_list') }}";
        var employeeByDepartment = "{{ config('constants.api.employee_by_department') }}";
        var downloadFileName = "{{ __('messages.leave_history_by_staff') }}";
    </script>
    <script src="{{ asset('js/custom/emp_attendance_list.js') }}"></script>

    @endsection