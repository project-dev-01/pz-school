@extends('layouts.admin-layout')
@section('title',' ' . __('messages.leave_history_by_staff') . '')
@section('component_css')
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
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
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:5px;margin-top:5px">
                <div class="page-title-icon">
                <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_122_3580)">
                                <path d="M0.0202342 7.91378C0.0202342 7.25256 -0.00771459 6.59133 0.0202342 5.93395C0.0563401 5.55371 0.223237 5.19596 0.494462 4.91741C0.765688 4.63885 1.12572 4.45543 1.51749 4.39623C1.64961 4.37648 1.78306 4.36621 1.91676 4.36548H4.60383V1.75135C4.5853 1.51634 4.66449 1.28386 4.82398 1.10507C4.98347 0.926273 5.21019 0.815805 5.45427 0.797962C5.69835 0.78012 5.9398 0.856361 6.1255 1.00992C6.31119 1.16348 6.42593 1.38179 6.44446 1.6168C6.44854 1.69236 6.44854 1.76806 6.44446 1.84361V4.35395H17.5082V4.18095C17.5082 3.37749 17.5082 2.57787 17.5082 1.77826C17.5023 1.54171 17.5944 1.31264 17.764 1.14141C17.9336 0.970189 18.1668 0.870841 18.4125 0.865233C18.6582 0.859625 18.8961 0.948214 19.0739 1.11151C19.2518 1.2748 19.355 1.49943 19.3608 1.73597C19.3608 2.54712 19.3608 3.35827 19.3608 4.16941V4.36548H22.0678C22.3208 4.35688 22.573 4.39854 22.8086 4.48784C23.0442 4.57715 23.2582 4.71219 23.4372 4.88457C23.6162 5.05695 23.7565 5.26297 23.8492 5.4898C23.942 5.71664 23.9852 5.95943 23.9763 6.20306C23.9763 6.76817 23.9763 7.33328 23.9763 7.90993L0.0202342 7.91378Z" fill="black" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.000144945 9.70129H6V10.8095H8V9.70129H24.0001V22.9526C24.0182 23.3692 23.8838 23.7786 23.6204 24.1095C23.3569 24.4404 22.9812 24.6718 22.5588 24.7633C22.4014 24.7959 22.2407 24.8114 22.0797 24.8094H1.92461C1.49174 24.8272 1.06621 24.6974 0.722953 24.4429C0.379694 24.1883 0.140706 23.8253 0.0480552 23.4178C0.0143581 23.2714 -0.00171658 23.1218 0.000144945 22.9718V9.70129ZM8 11.8095H6V13.8095H8V11.8095Z" fill="black" />
                            </g>
                            <defs>
                                <clipPath id="clip0_122_3580">
                                    <rect width="24" height="24" fill="white" transform="translate(0 0.809509)" />
                                </clipPath>
                            </defs>
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.leave_management') }} </a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);"> {{ __('messages.leave_history_by_staff') }}</a></li>
                </ol>

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