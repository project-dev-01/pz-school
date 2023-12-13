@extends('layouts.admin-layout')
@section('title',' ' . __('messages.attendance_report') . '')
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
                                    <label for="changeClassName">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                        @forelse ($class as $cla)
                                        <option value="{{ $cla['id'] }}">{{ $cla['name'] }}</option>
                                        @empty
                                        @endforelse
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
                                    <label for="subjectID">Pattern<span class="text-danger">*</span></label>
                                    <select id="pattern" class="form-control" name="subject_id">
                                        <option value="">Select Pattern</option>
                                        <option>Day</option>
                                        <option>Month</option>
                                        <option>Term</option>
                                        <option>Year</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" class="dates" id="term" style="display:none">
                                <div class="form-group">
                                    <label for="semesterID">{{ __('messages.term') }}</label>
                                    <select class="form-control" name="semester_id">
                                        <option value="">{{ __('messages.select_term') }}</option>
                                        <option>First Term</option>
                                        <option>Second Term</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" class="dates" id="day" style="display:none">
                                <div class="form-group">
                                    <label for="class_date">{{ __('messages.month') }}/{{ __('messages.year') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="class_date" id="termDay" placeholder="{{ __('messages.mm_yyyy') }}">
                                </div>
                            </div>
                            <div class="col-md-3"  class="dates" id="year" style="display:none">
                                <div class="form-group">
                                    <label for="class_date">{{ __('messages.month') }}/{{ __('messages.year') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="class_date" id="termYear" placeholder="{{ __('messages.mm_yyyy') }}">
                                </div>
                            </div>
                            <div class="col-md-3" class="dates" id="month" style="display:none">
                                <div class="form-group">
                                    <label for="class_date">{{ __('messages.month') }}/{{ __('messages.year') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="class_date" id="termMonth" placeholder="{{ __('messages.mm_yyyy') }}">
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


    <div class="row attendanceReport" style="display:none">
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

                                <div id="day_table" class="tables" style="display:none">

                                    <div class="row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <table class="">
                                                    <tr>
                                                        <!-- <th><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i> {{ __('messages.present') }}</button></th>
                                                    <th><button type="button" class="btn btn-xs btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i> {{ __('messages.absent') }}</button></th>
                                                    <th><button type="button" class="btn btn-xs btn-info waves-effect waves-light"><i class="mdi mdi-ufo"></i> {{ __('messages.holiday') }}</button></th>
                                                    <th><button type="button" class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i> {{ __('messages.late') }}</button></th> -->
                                                        <th style="text-align:center">Total Students: 28</th>
                                                        <th style="text-align:center">Present Students: 24</th>
                                                        <th style="text-align:center">Absent Students: 4</th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table w-100 nowrap ">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> {{ __('messages.name') }}</th>
                                                <th> {{ __('messages.name_english') }}</th>
                                                <th> {{ __('messages.grade') }}</th>
                                                <th> {{ __('messages.class') }}</th>
                                                <th> No of Present</th>
                                                <th> No of Absent</th>
                                                <th> No of Late </th>
                                                <th>Homeroom Teacher Reason</th>
                                                <th>Nursing Teacher Reason</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td> 佐藤 直美</td>
                                                <td> Naomi Sato</td>
                                                <td> 1年</td>
                                                <td> 1組</td>
                                                <td> 18</td>
                                                <td> 2</td>
                                                <td> 1</td>
                                                <td>Good</td>
                                                <td> </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td> 生田 宏枝</td>
                                                <td> Hiroe Ikuta</td>
                                                <td> 1年</td>
                                                <td> 1組</td>
                                                <td> 16</td>
                                                <td> 4</td>
                                                <td> 1</td>
                                                <td> Sick Leave </td>
                                                <td> </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td> 平良 孝浩</td>
                                                <td> Takahiro Taira</td>
                                                <td> 1年</td>
                                                <td> 1組</td>
                                                <td> 20</td>
                                                <td> 0</td>
                                                <td> 2</td>
                                                <td> Execellent </td>
                                                <td> </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td> 水田 崇</td>
                                                <td> Takashi Mizuta</td>
                                                <td> 1年</td>
                                                <td> 1組</td>
                                                <td> 17</td>
                                                <td> 3</td>
                                                <td> 4</td>
                                                <td> </td>
                                                <td> </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div id="term_table" class="tables" style="display:none">
                                    <div class="row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <table class="">
                                                    <tr>
                                                        <!-- <th><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i> {{ __('messages.present') }}</button></th>
                                                    <th><button type="button" class="btn btn-xs btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i> {{ __('messages.absent') }}</button></th>
                                                    <th><button type="button" class="btn btn-xs btn-info waves-effect waves-light"><i class="mdi mdi-ufo"></i> {{ __('messages.holiday') }}</button></th>
                                                    <th><button type="button" class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i> {{ __('messages.late') }}</button></th> -->
                                                        <th style="text-align:center">Total Students : 28</th>
                                                        <th style="text-align:center">Totall School Days : 24</th>
                                                        <th style="text-align:center">Total Holidays : 4</th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table w-100 nowrap " id="">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> {{ __('messages.name') }}</th>
                                                <th> {{ __('messages.name_english') }}</th>
                                                <th> {{ __('messages.grade') }}</th>
                                                <th> {{ __('messages.class') }}</th>
                                                <th> Status </th>
                                                <th>Homeroom Teacher Reason</th>
                                                <th>Nursing Teacher Reason</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td> 佐藤 直美</td>
                                                <td> Naomi Sato</td>
                                                <td> 1年</td>
                                                <td> 1組</td>
                                                <td> Present</td>
                                                <td>Good</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td> 生田 宏枝</td>
                                                <td> Hiroe Ikuta</td>
                                                <td> 1年</td>
                                                <td> 1組</td>
                                                <td> Absent</td>
                                                <td> Sick Leave </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td> 平良 孝浩</td>
                                                <td> Takahiro Taira</td>
                                                <td> 1年</td>
                                                <td> 1組</td>
                                                <td> Present</td>
                                                <td> Execellent </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td> 水田 崇</td>
                                                <td> Takashi Mizuta</td>
                                                <td> 1年</td>
                                                <td> 1組</td>
                                                <td> Present</td>
                                                <td> </td>
                                                <td></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

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
                            <input type="hidden" name="semester" id="excelSemester">
                            <input type="hidden" name="session" id="excelSession">
                            <input type="hidden" name="date" id="excelDate">
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
                            <input type="hidden" name="semester_id" id="downExcelSemester">
                            <input type="hidden" name="session_id" id="downExcelSession">
                            <input type="hidden" name="year_month" id="downExcelDate">
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
    $("#pattern").on("change", function() {
        var pattern = $(this).val();
        console.log('ch', pattern)
        $(".dates").hide();
        $(".tables").hide();
        if (pattern == "Term") {
            $("#term").show();
            $("#month").hide();
            $("#day").hide();
            $("#year").hide();
            $("#term_table").show();
        } else if (pattern == "Month") {
            $("#month").show();
            $("#term").hide();
            $("#day").hide();
            $("#year").hide();
            $("#month_table").show();
        } else if (pattern == "Day") {
            $("#day").show();
            $("#month").hide();
            $("#term").hide();
            $("#year").hide();
            $("#day_table").show();
        } else if (pattern == "Year") {
            $("#year").show();
            $("#month").hide();
            $("#term").hide();
            $("#day").hide();
            $("#term_table").show();
        }
    });
    var teacherSectionUrl = "{{ config('constants.api.section_by_class') }}";
    var teacherSubjectUrl = "{{ config('constants.api.subject_by_class') }}";
    var getAttendanceListTeacher = "{{ config('constants.api.get_attendance_list_teacher') }}";
    var getReasonsByStudent = "{{ config('constants.api.get_reasons_by_student') }}";

    // default image test
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images' }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var admin_studentattentanceReport_storage = localStorage.getItem('admin_studentattentanceReport_details');
</script>
<script src="{{ asset('js/custom/teacher_attendance_list.js') }}"></script>
@endsection