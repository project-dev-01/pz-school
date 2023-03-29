@extends('layouts.admin-layout')
@section('title','Children Attendance')
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
                <h4 class="page-title">Student Attendance</h4>
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
                            Attendance
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
                                        <input type="text" id="attendanceList" class="form-control" name="year_month" placeholder="MM-YYYY" data-provide="datepicker" data-date-format="MM yyyy" data-date-min-view-mode="1">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="subject_id">Subject<span class="text-danger">*</span></label>
                                    <select id="subject_id" class="form-control" name="subject_id">
                                        <option value="">Select Subject</option>
                                        @forelse ($subjects as $sub)
                                        <option value="{{ $sub['subject_id'] }}">{{ $sub['subject_name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="student_id" value="{{$student_id}}" name="student_id">
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                Filter
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
                                <div id="attendanceListShow">
                                </div>

                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->
                    <!-- <div class="form-group text-right m-b-0">
                        <button id="exportAttendance" class="btn btn-primary-bl waves-effect waves-light" type="Save">
                            Download
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
<script>
    var getAttendanceList = "{{ config('constants.api.get_attendance_list') }}";
    // default image test
    var defaultImg = "{{ asset('public/images/users/default.jpg') }}";
</script>
<script src="{{ asset('public/js/custom/attendance_list.js') }}"></script>
@endsection