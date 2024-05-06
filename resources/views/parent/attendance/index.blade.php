@extends('layouts.admin-layout')
@section('title',' ' . __('messages.student_attendance') . '')
@section('component_css')
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />

<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box" style="display: inline-flex; align-items: center;">
                <div class="page-title-icon">
                    <svg width="20" height="20" viewBox="0 0 28 28" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_59_2184)">
                            <path d="M11.2567 4.31207V2.11065H10.0526V0.666656H13.9496V2.09817H12.7435V4.30748C16.6027 4.65141 19.7033 6.333 21.911 9.50321C23.5559 11.8661 24.2232 14.5165 23.9352 17.3795C23.6385 20.3463 22.2288 23.0944 19.9854 25.0794C17.742 27.0645 14.8285 28.1417 11.8221 28.0976C8.8156 28.0536 5.93546 26.8916 3.75212 24.8418C1.56878 22.792 0.241509 20.0039 0.0332032 17.0297C-0.197159 13.7531 0.794459 10.8382 2.98091 8.36115C5.16736 5.88405 7.95289 4.58643 11.2567 4.31207ZM19.5915 16.286C19.5663 12.0387 16.1705 8.68014 11.9908 8.69195C7.79534 8.70377 4.37831 12.0952 4.40611 16.225C4.43391 20.3548 7.76356 23.7324 11.9041 23.7363C13.9919 23.7363 15.8401 23.0209 17.3322 21.5428C18.8163 20.0771 19.5537 18.2853 19.5915 16.286Z" fill="#3A4265" />
                            <path d="M11.9987 22.2641C8.63131 22.2641 5.8855 19.5475 5.87491 16.2007C5.86432 12.8644 8.64256 10.1005 12.0027 10.1274C15.4197 10.1543 18.1033 12.8369 18.1165 16.2C18.1304 19.5455 15.3694 22.2628 11.9987 22.2641ZM7.52914 16.4843L10.4087 19.3388L16.5066 14.0531L15.5322 12.9557L10.4689 17.3533L8.54922 15.4735L7.52914 16.4843Z" fill="#3A4265" />
                        </g>
                        <defs>
                            <clipPath id="clip0_59_2184">
                                <rect width="24" height="27.4286" fill="white" transform="translate(0 0.666656)" />
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                <h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_attendance') }}</h4>
            </div>
        </div>
    </div>

    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                    <h4 class="nav-link">
                            {{ __('messages.attendance') }}
                            <h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>      
               
                <div class="card-body collapse show">
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
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection