@extends('layouts.admin-layout')
@section('title','Employee Attendance')
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
                <h4 class="page-title">Employee Attendance</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row" >
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Select Ground
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="employeeAttendanceFilter" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                            <input type="hidden" id="employee" name="employee" value="{{$employee}}">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date">Date<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="date" id="employeeDate">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                Filter
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
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                           Employee List
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
                                        <table class="table table-bordered mb-0 text-center" id="timetable_table">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Check In</th>
                                                    <th>Check Out</th>
                                                    <th>Total Hours</th>
                                                    <th>Remarks</th>
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
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                Save
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
<script>
    var getEmployeAttendanceList = "{{ route('teacher.attendance.employee_list') }}";
    var employeeByDepartment = "{{ config('constants.api.employee_by_department') }}";
</script>
<script src="{{ asset('public/js/custom/teacher_attendance_list.js') }}"></script>

@endsection