@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.attendance_report') . '')
@section('component_css')
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />

<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

@endsection
@section('content')
<style>
    @media only screen and (min-device-width: 320px) and (max-device-width: 660px) {
        .btn-xs {
            padding: 0px 5px;
            border-radius: 0.15rem;
        }
        .btn-primary-bl {
            width: 100px;
            font-size: 12px;
        }

    }

    @media only screen and (min-device-width: 280px) and (max-device-width: 653px) {
        .btn-xs {
            padding: 0px 0px;
            border-radius: 0.15rem;
        }
        .btn-primary-bl {
            width: 90px;
            font-size: 12px;
        }

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
                <h4 class="page-title"> {{ __('messages.attendance_report') }}</h4>
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
                        {{ __('messages.select_ground') }}
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
                                    <label for="pattern">{{ __('messages.pattern') }}<span class="text-danger">*</span></label>
                                    <select id="pattern" class="form-control" name="pattern">
                                        <option value="">{{ __('messages.select_pattern') }}</option>
                                        <option>{{ __('messages.day') }}</option>
                                        <option>{{ __('messages.month') }}</option>
                                        <option>{{ __('messages.term') }}</option>
                                        <option>{{ __('messages.year') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" class="dates" id="term" style="display:none">
                                <div class="form-group">
                                    <label for="class_date">{{ __('messages.semester') }}<span class="text-danger">*</span></label>
                                    <select id="patternTerm" class="form-control" name="class_date">
                                        <option value="0">{{ __('messages.select_semester') }}</option>
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
                            <div class="col-md-3" id="subject" style="display:none">
                                <div class="form-group">
                                    <label for="subjectID">{{ __('messages.subject') }}<span class="text-danger">*</span></label>
                                    <select id="subjectID" class="form-control" name="subject_id">
                                        <option value="">{{ __('messages.select_subject') }}</option>
                                    </select>
                                </div>
                            </div>
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

                                <div id="attendanceListShow"></div>

                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->
                    <div class="form-group text-right m-b-0">

                        <form method="post" action="{{ route('teacher.student_attendance.excel')}}">
                            @csrf
                            <input type="hidden" name="subject" id="excelSubject">
                            <input type="hidden" name="class" id="excelClass">
                            <input type="hidden" name="section" id="excelSection">
                            <input type="hidden" name="pattern" id="excelPattern">
                            <input type="hidden" name="date" id="excelDate">
                            <div class="clearfix float-right">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                {{ __('messages.download') }}
                                </button>
                            </div>
                        </form>
                        <form method="post" action="{{ route('teacher.attendance.student_pdf')}}">
                            @csrf
                            <input type="hidden" name="subject_id" id="downExcelSubject">
                            <input type="hidden" name="class_id" id="downExcelClass">
                            <input type="hidden" name="section_id" id="downExcelSection">
                            <input type="hidden" name="pattern" id="downExcelPattern">
                            <input type="hidden" name="year_month" id="downExcelDate">
                            <div class="clearfix float-right">
                                <button class="btn btn-primary-bl waves-effect waves-light" style="margin-right:5px;" type="submit">
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

    <div class="row "  id="daily-present-late-chart" style="display:none">
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

    @include('teacher.attendance.lateanalytics')
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
    var teacherSectionUrl = "{{ config('constants.api.teacher_section') }}";
    var teacherSubjectUrl = "{{ config('constants.api.teacher_subject') }}";
    var getAttendanceListTeacher = "{{ config('constants.api.get_attendance_list_teacher') }}";
    var getReasonsByStudent = "{{ config('constants.api.get_reasons_by_student') }}";
    var getGradeByDepartmentUrl = "{{ config('constants.api.teacher_class') }}";
    var holidayList = "{{ config('constants.api.holidays_list') }}"

    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images' }}";
    // localStorage variables
    var teacher_student_attendance_report_storage = localStorage.getItem('teacher_student_attendance_report_details');
</script>
<script src="{{ asset('js/custom/teacher_attendance_list.js') }}"></script>
@endsection