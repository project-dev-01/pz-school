@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.student_attendance') . '')
@section('component_css')
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />

<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/parent_responsive.css') }}" rel="stylesheet" type="text/css" />

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
                <h4 class="page-title">{{ __('messages.student_attendance') }}</h4>
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
                        {{ __('messages.attendance') }}
                            <h4>
                    </li>
                </ul><br>
                <br>
                <div class="card-body">
                    <form id="getAttendanceList" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="attendanceList">{{ __('messages.month') }}/{{ __('messages.year') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge text-center">
                                        <input type="text" id="attendanceList" class="form-control" name="year_month" placeholder="{{ __('messages.mm_yyyy') }}" data-provide="datepicker" data-date-format="MM yyyy" data-date-min-view-mode="1">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="student_id" value="{{$student_id}}" name="student_id">
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


    <div class="row" id="attendanceReport">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                        {{ __('messages.attendance_report') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <table class="">
                                                <tr>
                                                    <th><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i> {{ __('messages.present') }}</button></th>
                                                    <th><button type="button" class="btn btn-xs btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i> {{ __('messages.absent') }}</button></th>
                                                    <th><button type="button" class="btn btn-xs btn-info waves-effect waves-light"><i class="mdi mdi-ufo"></i> {{ __('messages.holiday') }}</button></th>
                                                    <th><button type="button" class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i> {{ __('messages.late') }}</button></th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="attendanceListShow">
                                </div>

                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->
                    <div class="form-group text-right m-b-0">

                        <form method="post" action="{{ route('parent.attendance.student_excel')}}">
                            @csrf
                            <input type="hidden" name="subject" id="excelSubject">
                            <input type="hidden" name="student" id="excelStudent">
                            <input type="hidden" name="date" id="excelDate">
                            <div class="clearfix float-right">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                {{ __('messages.download') }} 11
                                </button>
                            </div>
                        </form>
                        <form method="post" action="{{ route('parent.attendance.student_pdf')}}">
                            @csrf
                            
                            <input type="hidden" name="subject_id" id="downExcelSubject">
                            <input type="hidden" name="student_id" id="downExcelStudent">
                            <input type="hidden" name="year_month" id="downExcelDate">
                            <div class="clearfix float-right">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="submit" style="margin-right:5px;">
                                {{ __('messages.pdf') }}
                                </button>
                            </div>
                        </form>

                    </div>
                    <!-- <div class="form-group text-right m-b-0">
                        <button id="exportAttendance" class="btn btn-primary-bl waves-effect waves-light" type="Save">
                            {{ __('messages.download') }}
                        </button>
                    </div> -->

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
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
     toastr.options.preventDuplicates = true;
</script>
<script>
    var getAttendanceList = "{{ config('constants.api.get_attendance_list') }}";
    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    
    var parent_attenance_storage = localStorage.getItem('parent_attentance_details');
</script>
<script src="{{ asset('js/custom/attendance_list.js') }}"></script>
@endsection