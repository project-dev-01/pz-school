@extends('layouts.admin-layout')
@section('title','Student Attendance')
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
                <h4 class="page-title"> Attendance List</h4>
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
                            Select Ground
                            <h4>
                    </li>
                </ul><br>
                <br>
                <div class="card-body">
                    <form id="attendanceFilter" autocomplete="off">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="changeClassName">Class<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">Select Class</option>
                                        @forelse ($teacher_class as $class)
                                        <option value="{{ $class['class_id'] }}">{{ $class['class_name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sectionID">Section<span class="text-danger">*</span></label>
                                    <select id="sectionID" class="form-control" name="section_id">
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="subjectID">Subject<span class="text-danger">*</span></label>
                                    <select id="subjectID" class="form-control" name="subject_id">
                                        <option value="">Select Subject</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_date">Date<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="class_date" id="classDate">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                    Filter
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
                        <h4 class="nav-link">
                            Attendance Report
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
                                                    <th><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i> Present</button></th>
                                                    <th><button type="button" class="btn btn-xs btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i> Absent</button></th>
                                                    <th><button type="button" class="btn btn-xs btn-info waves-effect waves-light"><i class="mdi mdi-ufo"></i> Holiday</button></th>
                                                    <th><button type="button" class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i> Late</button></th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div id="attendanceListShow"></div>

                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->
                    <!-- <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                            Download
                        </button>
                    </div> -->

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
    <!-- end page title -->

    <div class="row attendanceReport">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Daily Present and Late Analysis
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
<script>
    var teacherSectionUrl = "{{ config('constants.api.teacher_section') }}";
    var teacherSubjectUrl = "{{ config('constants.api.teacher_subject') }}";
    var getAttendanceListTeacher = "{{ config('constants.api.get_attendance_list_teacher') }}";
    var getReasonsByStudent = "{{ config('constants.api.get_reasons_by_student') }}";

    // default image test
    var defaultImg = "{{ asset('public/images/users/default.jpg') }}";
</script>
<script src="{{ asset('public/js/custom/teacher_attendance_list.js') }}"></script>
@endsection