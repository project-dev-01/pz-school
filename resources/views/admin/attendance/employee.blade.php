@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.employee_attendance') . '')
@section('component_css')
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:10px;margin-top:10px">
                <div class="page-title-icon">
                <i class="fas fa-user-clock" style="color:#3A4265"></i>
                </div>
                <h4 class="page-title" style="margin-left: 10px;">{{ __('messages.employee_attendance') }}</h4>
            </div>
        
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.select_ground') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
                
                <div class="card-body collapse show">
                    <form id="employeeAttendanceFilter" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="department">{{ __('messages.department') }}<span class="text-danger">*</span></label>
                                    <select class="form-control" name="department" id="department">
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
                                    <label for="employee">{{ __('messages.employee') }}<span class="text-danger">*</span></label>
                                    <select class="form-control" name="employee" id="employee">
                                        <option value="">{{ __('messages.select_employee') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" style="display:none;">
                                <div class="form-group">
                                    <label for="session_id">{{ __('messages.session') }} <span class="text-danger">*</span></label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="">{{ __('messages.select_session') }} </option>
                                        @forelse($session as $ses)
                                        <option value="{{$ses['id']}}">{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date">{{ __('messages.month') }}/{{ __('messages.year') }} <span class="text-danger">*</span></label>
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
                    <form id="addEmployeeAttendanceForm" method="post" action="{{ route('admin.attendance.employee_add') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="table-responsive">
                                        <table class="table w-100 nowrap" id="timetable_table">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('messages.date') }} </th>
                                                    <th>{{ __('messages.status') }} </th>
                                                    <th>{{ __('messages.check_in') }} </th>
                                                    <th>{{ __('messages.check_out') }} </th>
                                                    <th>{{ __('messages.total_hours') }} </th>
                                                    <th>{{ __('messages.reason') }} </th>
                                                    <th>{{ __('messages.remarks') }} </th>
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
<script>
    var getEmployeAttendanceList = "{{ route('admin.attendance.employee_list') }}";
    var employeeByDepartment = "{{ config('constants.api.employee_by_department') }}";
    var getTeacherAbsentExcuse = "{{ config('constants.api.get_teacher_absent_excuse') }}";
    
    var admin_employee_attentance_storage = localStorage.getItem('admin_employee_attentance_details');
</script>
<script src="{{ asset('js/custom/attendance.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection