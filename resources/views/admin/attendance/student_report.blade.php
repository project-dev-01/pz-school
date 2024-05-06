@extends('layouts.admin-layout')
@section('title',' ' . __('messages.student') . '')
@section('component_css')
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />

<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<style>
    @media only screen and (min-device-width: 320px) and (max-device-width: 660px) {
        .btn-xs {
            padding: 0px 5px;
            border-radius: 0.15rem;
        }

    }

    @media only screen and (min-device-width: 280px) and (max-device-width: 653px) {
        .btn-xs {
            padding: 0px 0px;
            border-radius: 0.15rem;
        }

    }

    .btn-primary-bl {
        margin-bottom: 5px;
        margin-right: 5px;
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
                            <g clip-path="url(#clip0_59_2184)">
                                <path d="M11.2567 4.31207V2.11065H10.0526V0.666656H13.9496V2.09817H12.7435V4.30748C16.6027 4.65141 19.7033 6.333 21.911 9.50321C23.5559 11.8661 24.2232 14.5165 23.9352 17.3795C23.6385 20.3463 22.2288 23.0944 19.9854 25.0794C17.742 27.0645 14.8285 28.1417 11.8221 28.0976C8.8156 28.0536 5.93546 26.8916 3.75212 24.8418C1.56878 22.792 0.241509 20.0039 0.0332032 17.0297C-0.197159 13.7531 0.794459 10.8382 2.98091 8.36115C5.16736 5.88405 7.95289 4.58643 11.2567 4.31207ZM19.5915 16.286C19.5663 12.0387 16.1705 8.68014 11.9908 8.69195C7.79534 8.70377 4.37831 12.0952 4.40611 16.225C4.43391 20.3548 7.76356 23.7324 11.9041 23.7363C13.9919 23.7363 15.8401 23.0209 17.3322 21.5428C18.8163 20.0771 19.5537 18.2853 19.5915 16.286Z" fill="black" />
                                <path d="M11.9987 22.2641C8.63131 22.2641 5.8855 19.5475 5.87491 16.2007C5.86432 12.8644 8.64256 10.1005 12.0027 10.1274C15.4197 10.1543 18.1033 12.8369 18.1165 16.2C18.1304 19.5455 15.3694 22.2628 11.9987 22.2641ZM7.52914 16.4843L10.4087 19.3388L16.5066 14.0531L15.5322 12.9557L10.4689 17.3533L8.54922 15.4735L7.52914 16.4843Z" fill="black" />
                            </g>
                            <defs>
                                <clipPath id="clip0_59_2184">
                                    <rect width="24" height="27.4286" fill="white" transform="translate(0 0.666656)" />
                                </clipPath>
                            </defs>
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.attendance_report') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.student') }}</a></li>
                </ol>

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
                    <form id="attendanceFilter" autocomplete="off">
                        <div class="row">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sectionID">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                    <select id="sectionID" class="form-control" name="section_id">
                                        <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pattern">Pattern<span class="text-danger">*</span></label>
                                    <select id="pattern" class="form-control" name="pattern">
                                        <option value="">{{ __('messages.select_pattern') }}</option>
                                        <option>Day</option>
                                        <option>Month</option>
                                        <option>Term</option>
                                        <option>Year</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" class="dates" id="term" style="display:none">
                                <div class="form-group">
                                    <label for="class_date">{{ __('messages.semester') }}<span class="text-danger">*</span></label>
                                    <select id="patternTerm" class="form-control" name="class_date">
                                        <option value="">{{ __('messages.select_semester') }}</option>
                                        @forelse($semester as $sem)
                                        <option value="{{$sem['id']}}">{{$sem['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" class="dates" id="day" style="display:none">
                                <div class="form-group">
                                    <label for="class_date">{{ __('messages.date') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="class_date" id="patternDay" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                </div>
                            </div>
                            <div class="col-md-3" class="dates" id="month" style="display:none">
                                <div class="form-group">
                                    <label for="class_date">{{ __('messages.month') }}/{{ __('messages.year') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="class_date" id="patternMonth" placeholder="{{ __('messages.mm_yyyy') }}">
                                </div>
                            </div>
                            <div class="col-md-3" class="dates" id="year" style="display:none">
                                <div class="form-group">
                                    <label for="class_date">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                                    <select id="patternYear" name="class_date" class="form-control">
                                        <option value="">{{ __('messages.select_academic_year') }}</option>
                                        @forelse($academic_year_list as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="class_date">{{ __('messages.year') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="class_date" id="patternYear" placeholder="{{ __('messages.yyyy') }}">
                                </div> -->
                            </div>
                            <div class="col-md-3" style="display:none">
                                <div class="form-group">
                                    <label for="subjectID">{{ __('messages.subject') }}<span class="text-danger">*</span></label>
                                    <select id="subjectID" class="form-control" name="subject_id">
                                        <option value="">{{ __('messages.select_subject') }}</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_date">{{ __('messages.month') }}/{{ __('messages.year') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="class_date" id="classDate" placeholder="{{ __('messages.mm_yyyy') }}">
                                </div>
                            </div> -->
                        </div>
                        <div>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                    {{ __('messages.filter') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


    <div class="row attendanceReport">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
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
                                            <div id="count-show">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div id="attendanceListShow"></div>


                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->
                    <div class="form-group text-right m-b-0">

                        <form method="post" action="{{ route('admin.attendance.student_excel')}}">
                            @csrf
                            <input type="hidden" name="subject" id="excelSubject">
                            <input type="hidden" name="class" id="excelClass">
                            <input type="hidden" name="section" id="excelSection">
                            <input type="hidden" name="pattern" id="excelPattern">
                            <input type="hidden" name="date" id="excelDate">
                            <input type="hidden" name="type" value="Day">
                            <div class="clearfix float-right">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                    {{ __('messages.download') }}
                                </button>
                            </div>
                        </form>
                        <form method="post" action="{{ route('admin.attendance.student_pdf')}}">
                            @csrf
                            <input type="hidden" name="subject_id" id="downExcelSubject">
                            <input type="hidden" name="class_id" id="downExcelClass">
                            <input type="hidden" name="section_id" id="downExcelSection">
                            <input type="hidden" name="pattern" id="downExcelPattern">
                            <input type="hidden" name="year_month" id="downExcelDate">
                            <input type="hidden" name="type" value="Day">
                            <div class="clearfix float-right">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                    {{ __('messages.pdf') }}
                                </button>
                            </div>
                        </form>

                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
    <!-- end page title -->

    <div class="row " id="daily-present-late-chart" style="display:none">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            {{ __('messages.daily_present_and_late_analysis') }}
                            <h4>
                    </li>
                </ul><br>
                <br>
                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="" autocomplete="off">
                        <div class="row ">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title"></h4>

                                        <div id="cardCollpase7" class="collapse pt-3 show" dir="ltr">
                                            <div id="late-present-absent" class="apex-mixed-1" data-colors="#1FAB44,#FEB019,#EB5234"></div>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

    @include('admin.attendance.lateanalytics')
</div> <!-- container -->

@endsection
@section('scripts')
<script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<!-- Chart JS -->
<!-- <script src="{{ asset('libs/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('libs/morris.js06/morris.min.js') }}"></script>
<script src="{{ asset('libs/raphael/raphael.min.js') }}"></script> -->
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script>
    var teacherSectionUrl = "{{ config('constants.api.section_by_class') }}";
    var teacherSubjectUrl = "{{ config('constants.api.subject_by_class') }}";
    var getAttendanceListTeacher = "{{ config('constants.api.get_attendance_list_teacher') }}";
    var getReasonsByStudent = "{{ config('constants.api.get_reasons_by_student') }}";
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
    var holidayList = "{{ config('constants.api.holidays_list') }}"

    // default image test
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images' }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var admin_studentattentanceReport_storage = localStorage.getItem('admin_studentattentanceReport_details');
</script>
<script src="{{ asset('js/custom/teacher_attendance_list.js') }}"></script>
@if(!empty(Session::get('school_roleid')))
<script>
    var checkpermissions = "{{ route('admin.school_role.checkpermissions') }}";
</script>
<script src="{{ asset('js/custom/permissions.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endif
@endsection