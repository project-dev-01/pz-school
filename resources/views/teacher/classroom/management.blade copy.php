@extends('layouts.admin-layout')
@section('title',' ' . __('messages.classroom_management') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">

<link href="{{ asset('css/custom/classroom.css') }}" rel="stylesheet" type="text/css" />
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection
@section('css')
<link href="{{ asset('css/custom/classroom.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('messages.classroom_management') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> {{ __('messages.classroom') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="classroomFilter" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="changeClassName">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                        @forelse ($teacher_class as $class)
                                        <option value="{{ $class['class_id'] }}">{{ $class['class_name'] }}</option>
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
                                    <label for="subjectID">{{ __('messages.subject') }}<span class="text-danger">*</span></label>
                                    <select id="subjectID" class="form-control" name="subject_id">
                                        <option value="">{{ __('messages.select_subject') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_date">{{ __('messages.date') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control value=" <?php echo date('d-m-Y'); ?>" name="class_date" placeholder="{{ __('messages.dd_mm_yyyy') }}" id="classDate" require="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="semester_id">{{ __('messages.semester') }}</label>
                                    <select id="semester_id" class="form-control" name="semester_id">
                                        <option value="0">{{ __('messages.select_semester') }}</option>
                                        @forelse($semester as $sem)
                                        <option value="{{$sem['id']}}" {{ $current_semester == $sem['id'] ? 'selected' : ''}}>{{$sem['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="session_id">{{ __('messages.session') }}</label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="0">{{ __('messages.select_session') }}</option>
                                        @forelse($session as $ses)
                                        <option value="{{$ses['id']}}" {{$current_session == $ses['id'] ? 'selected' : ''}}>{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ __('messages.count_down') }}</label>
                                    <div>
                                        <!-- #classroom_count_down is always 100% responsive to it's container-->

                                        <div id="classroom_count_down">
                                            <div class="countdown-wrapper">
                                                <div class="countdown-main">
                                                    <!-- <div class="countdown-section-days days">
                                                        <div class="countdown-number-container">
                                                            <div class="countdown-number-days">
                                                                <div class="countdown-number-next position-0-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-0">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-0">0</div>
                                                                </div>
                                                            </div>
                                                            <div class="countdown-number-days">
                                                                <div class="countdown-number-next position-1-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-1">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-1">0</div>
                                                                </div>
                                                            </div>
                                                            <div class="countdown-number-days">
                                                                <div class="countdown-number-next position-2-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-2">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-2">0</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="countdown-label-container">DAYS</div>
                                                    </div>
                                                    <div class="countdown-separator">
                                                        <div class="countdown-separator-top">
                                                            <div class="countdown-dot"></div>
                                                            <div class="countdown-dot"></div>
                                                        </div>
                                                    </div> -->
                                                    <div class="countdown-section-other hours">
                                                        <div class="countdown-number-container">
                                                            <div class="countdown-number-other">
                                                                <div class="countdown-number-next position-3-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-3">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-3">0</div>
                                                                </div>
                                                            </div>
                                                            <div class="countdown-number-other">
                                                                <div class="countdown-number-next position-4-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-4">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-4">0</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="countdown-label-container">HOURS</div>
                                                    </div>
                                                    <div class="countdown-separator">
                                                        <div class="countdown-separator-top">
                                                            <div class="countdown-dot"></div>
                                                            <div class="countdown-dot"></div>
                                                        </div>
                                                    </div>
                                                    <div class="countdown-section-other minutes">
                                                        <div class="countdown-number-container">
                                                            <div class="countdown-number-other">
                                                                <div class="countdown-number-next position-5-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-5">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-5">0</div>
                                                                </div>
                                                            </div>
                                                            <div class="countdown-number-other">
                                                                <div class="countdown-number-next position-6-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-6">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-6">0</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="countdown-label-container">MINUTES</div>
                                                    </div>
                                                    <div class="countdown-separator">
                                                        <div class="countdown-separator-top">
                                                            <div class="countdown-dot"></div>
                                                            <div class="countdown-dot"></div>
                                                        </div>
                                                    </div>
                                                    <div class="countdown-section-other seconds">
                                                        <div class="countdown-number-container">
                                                            <div class="countdown-number-other">
                                                                <div class="countdown-number-next position-7-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-7">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-7">0</div>
                                                                </div>
                                                            </div>
                                                            <div class="countdown-number-other">
                                                                <div class="countdown-number-next position-8-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-8">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-8">0</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="countdown-label-container">SECONDS</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
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
                </div>
            </div>
            <div class="classRoomHideSHow" style="display: none;">
                <div class="">
                    <div class="row">
                        <div class="col-md-6 col-xl-3" id="top-header">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <p class="mb-1">{{ __('messages.present') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="presentCount" style="color:black"></span></h3>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="">
                                            <p class="mb-1">{{ __('messages.absent') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="absentCount" style="color:black"></span></h3>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="">
                                            <p class="mb-1">{{ __('messages.late') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="lateCount" style="color:black"></span></h3>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="">
                                            <p class="mb-1">{{ __('messages.excused') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="excuseCount" style="color:black"></span></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="float-right" id="totalStrength"></span></h6>
                                </div>

                            </div>
                        </div><!-- end col-->
                        <div class="col-md-6 col-xl-3" id="top-header">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="fas fa-user-graduate font-24"></i><br><br>
                                            <p class="mb-1">{{ __('messages.perfect') }}<br>{{ __('messages.attendance') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="perfectAttendance" style="color:black"></span></h3>

                                        </div>
                                    </div>
                                </div><br><br>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="float-right">{{ __('messages.100%_of_class') }}</span></h6>
                                </div>

                            </div>
                        </div><!-- end col-->
                        <div class="col-md-6 col-xl-3" id="top-header">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="  fas fa-user-tie  font-24"></i><br><br>
                                            <p class="mb-1">{{ __('messages.average') }}<br>{{ __('messages.attendance') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="avg_attendance" style="color:black"></span></h3>

                                        </div>
                                    </div>
                                </div><br><br>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="float-right">{{ __('messages.100%_of_class') }}</span></h6>
                                </div>

                            </div>
                        </div><!-- end col-->
                        <div class="col-md-6 col-xl-3" id="top-header">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="fas fa-chalkboard-teacher font-24"></i><br><br>
                                            <p class="mb-1">{{ __('messages.below') }}<br>{{ __('messages.attendance') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="belowAttendance" style="color:black"></span></h3>

                                        </div>
                                    </div>
                                </div><br><br>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="float-right">{{ __('messages.100%_of_class') }}</span></h6>
                                </div>
                            </div> <!-- end card-box-->
                        </div>
                    </div>
                </div>
            </div><!-- end col-->
            <div class="row classRoomHideSHow" style="display: none;">
                <div class="col-xl-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">{{ __('messages.classroom_details') }}
                                    <h4>
                            </li>
                        </ul><br>
                        <ul class="nav nav-pills navtab-bg nav-justified">
                            <li class="nav-item">
                                <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link">
                                    {{ __('messages.layout_mode') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                    {{ __('messages.list_mode') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#shortest" data-toggle="tab" aria-expanded="false" class="nav-link">
                                    {{ __('messages.short_test') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#dailyreport" data-toggle="tab" aria-expanded="false" class="nav-link">
                                    {{ __('messages.daily_report') }}
                                </a>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="profile-b1">
                                    <div class="row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4 form-group text-right m-b-0">
                                            <a href="javascript: void(0);" class="text-reset mb-2 d-block">
                                                <i class='fas fa-circle' style='font-size:14px;color:#60a05b'></i>
                                                <span class="mb-0 mt-1" style="text-align:center">{{ __('messages.present') }}</span>
                                                <i class='fas fa-circle' style='font-size:14px;color:#358fde'></i>
                                                <span class="mb-0 mt-1">{{ __('messages.late') }}</span>
                                                <i class='fas fa-circle' style='font-size:14px;color:#de354f'></i>
                                                <span class="mb-0 mt-1">{{ __('messages.absent') }}</span>
                                                <i class='fas fa-circle' style='font-size:14px;color:#696969'></i>
                                                <span class="mb-0 mt-1">{{ __('messages.excused') }}</span>
                                            </a>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div id="layoutModeGrid"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane show active" id="home-b1">
                                    <form id="addListMode" method="post" action="{{ route('teacher.classroom.add') }}" autocomplete="off">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="changeAttendance">{{ __('messages.select_attendance') }}</label>
                                                            <select id="changeAttendance" class="form-control">
                                                                <option value="">{{ __('messages.not_selected') }}</option>
                                                                <option value="present">{{ __('messages.present') }}</option>
                                                                <option value="absent">{{ __('messages.absent') }}</option>
                                                                <option value="late">{{ __('messages.late') }}</option>
                                                                <option value="excused">Excused</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.attendance_status') }}</label><br>
                                                            <div id="attendaceTakenSts"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="class_id" id="listModeClassID">
                                                <input type="hidden" name="section_id" id="listModeSectionID">
                                                <input type="hidden" name="subject_id" id="listModeSubjectID">
                                                <input type="hidden" name="semester_id" id="listModeSemesterID">
                                                <input type="hidden" name="session_id" id="listModeSessionID">
                                                <input type="hidden" name="date" id="listModeSelectedDate">
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <!-- <table data-toggle="table" data-page-size="3" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable "> -->
                                                    <!-- <table id="listModeClassRoom" class="table table-striped table-nowrap"> -->
                                                    <table id="listModeClassRoom" class="table dt-responsive nowrap w-100">
                                                        <!-- <table class="display" width="100%"> -->
                                                        <!-- <table id="listModeClassRoom" class="display" style="width:100%"> -->
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>{{ __('messages.student_name') }}</th>
                                                                <th>{{ __('messages.attendance') }}</th>
                                                                <th>{{ __('messages.remarks') }}</th>
                                                                <th>{{ __('messages.reasons') }}</th>
                                                                <th>{{ __('messages.student_behaviour') }}</th>
                                                                <th>{{ __('messages.class_behaviour') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <!-- <tbody id="listModeClassRoom"> -->
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <br>
                                                <div class="form-group text-right m-b-0">
                                                    <button class="btn btn-primary-bl waves-effect waves-light" id="saveClassRoomAttendance" type="submit">
                                                        {{ __('messages.save') }}
                                                    </button>
                                                </div>
                                            </div> <!-- end card-box-->
                                        </div>
                                    </form>
                                    <div class="modal fade" id="stuRemarksPopup" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <label for="heard">{{ __('messages.remarks') }}</label>
                                                    <input type="hidden" id="studenetID" />
                                                    <textarea class="form-control" id="student_remarks" rows="5" placeholder="{{ __('messages.enter_remarks') }}" name="student_remarks"></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                                                    <button type="button" id="studentRemarksSave" class="btn btn-primary">{{ __('messages.save') }}</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <div class="card">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <h4 class="navv">{{ __('messages.student_leave_request') }}
                                                    <h4>
                                            </li>
                                        </ul><br>
                                        <div class="card-body">
                                            <form id="updatestudentleave" method="post" action="{{ route('teacher.studentleave.update') }}" autocomplete="off">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="stdleaves" class="table w-100 nowrap" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>{{ __('messages.student_name') }}</th>
                                                                    <th>{{ __('messages.from_leave') }}</th>
                                                                    <th>{{ __('messages.to_leave') }}</th>
                                                                    <th>{{ __('messages.reason') }}</th>
                                                                    <th>{{ __('messages.document') }}</th>
                                                                    <th>{{ __('messages.status') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="stdleaves_body"></tbody>
                                                        </table>
                                                        <input type="hidden" id="addstd_leave_Remarks" />
                                                    </div>
                                                </div>

                                        </div> <!-- end col-->

                                        </form>
                                    </div>
                                </div>
                                <!-- student leave remarks popup -->
                                <div class="modal fade" id="stuLeaveRemarksPopup" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <label for="heard">{{ __('messages.remarks') }}</label>
                                                <input type="hidden" id="studenet_leave_tbl_id" />
                                                <textarea class="form-control" id="student_leave_remarks" rows="5" placeholder="{{ __('messages.enter_remarks') }}" name="student_leave_remarks"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                                                <button type="button" id="student_leave_RemarksSave" class="btn btn-primary">{{ __('messages.save') }}</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <div class="tab-pane" id="dailyreport">
                                    <form id="addDailyReport" method="post" action="{{ route('teacher.classroom.add_daily_report') }}" autocomplete="off">
                                        <input type="hidden" name="class_id" id="dailyReportClassID">
                                        <input type="hidden" name="section_id" id="dailyReportSectionID">
                                        <input type="hidden" name="subject_id" id="dailyReportSubjectID">
                                        <input type="hidden" name="semester_id" id="dailyReportSemesterID">
                                        <input type="hidden" name="session_id" id="dailyReportSessionID">
                                        <input type="hidden" name="date" id="dailyReportSelectedDate">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="daily_report">{{ __('messages.report') }}<span class="text-danger">*</span></label>
                                                    <textarea class="form-control" id="daily_report" rows="5" name="daily_report" placeholder="{{ __('messages.enter_description') }}"></textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label id="dailyReportLastUpdate"></label>
                                                            <!-- <label for="heard">Last Updated: 29-01-2022 12:00:00 AM</label> -->
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group text-right m-b-0">
                                                    <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                                        {{ __('messages.save') }}
                                                    </button>
                                                </div>
                                            </div> <!-- end col-->

                                        </div>
                                    </form>
                                    <form id="addDailyReportRemarks" method="post" action="{{ route('teacher.classroom.add_daily_report_remarks') }}" autocomplete="off">
                                        <input type="hidden" name="class_id" id="dailyReportRemarksClassID">
                                        <input type="hidden" name="section_id" id="dailyReportRemarksSectionID">
                                        <input type="hidden" name="subject_id" id="dailyReportRemarksSubjectID">
                                        <input type="hidden" name="semester_id" id="dailyReportRemarksSemesterID">
                                        <input type="hidden" name="session_id" id="dailyReportRemarksSessionID">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="dailyReportRemarks" class="table dt-responsive nowrap w-100">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>{{ __('messages.student_name') }}</th>
                                                                    <th>{{ __('messages.student_remarks') }}</th>
                                                                    <th>{{ __('messages.remarks') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div> <!-- end card-box-->
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <div class="form-group text-right m-b-0">
                                                        <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                                            {{ __('messages.save') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="shortest">

                                    <div class="card">
                                        <div class="card-body">
                                            <form id="getShortTest" action="{{ route('teacher.classroom.get_short_test') }}" method="post">
                                                <input type="hidden" name="class_id" id="shortTestClassID">
                                                <input type="hidden" name="section_id" id="shortTestSectionID">
                                                <input type="hidden" name="subject_id" id="shortTestSubjectID">
                                                <input type="hidden" name="semester_id" id="shortTestSemesterID">
                                                <input type="hidden" name="session_id" id="shortTestSessionID">
                                                <input type="hidden" name="date" id="shortTestSelectedDate">

                                                <div id="dynamic-field-1" class="form-group dynamic-field">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="field" class="font-weight-bold">{{ __('messages.short_test') }}<span class="text-danger">*</span></label>
                                                            <input type="text" id="field" class="form-control shortTestAdd" name="field[]" />
                                                            <span id="shortTestError"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="grade" class="font-weight-bold">{{ __('messages.status') }}<span class="text-danger">*</span></label>
                                                            <select id="grade" class="form-control" name="grade[]">
                                                                <option value="marks">{{ __('messages.mark') }}</option>
                                                                <option value="grade">{{ __('messages.grade') }}</option>
                                                                <option value="text">{{ __('messages.text') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div>
                                                        <button type="button" id="add-button" class="btn btn-success text-uppercase shadow-sm">
                                                            <i class="fe-plus-circle"></i> {{ __('messages.add') }}</button>
                                                        <button type="button" id="remove-button" class="btn btn-danger text-uppercase" disabled="disabled">
                                                            <i class="fe-minus-circle"></i>{{ __('messages.remove') }}</button>
                                                        <button type="submit" id="save-button" class="btn btn-info waves-effect waves-light text-uppercase">
                                                            <i class="fe-save"></i>{{ __('messages.save') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row shortTestHideSHow">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table dt-responsive nowrap w-100">
                                                            <thead>
                                                                <tr>
                                                                    <th> {{ __('messages.s.no') }}</th>
                                                                    <th>{{ __('messages.short_test_name') }}</th>
                                                                    <th>{{ __('messages.status') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="shortTestAppend">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div> <!-- end card-box-->
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row shortTestHideSHow">
                                        <!-- <div class="row"> -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form id="addShortTest" method="post" action="{{ route('teacher.classroom.add_short_test') }}" autocomplete="off">
                                                        @csrf
                                                        <div id="shortTestTableAppend">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group text-right m-b-0">
                                                                <button type="submit" class="btn btn-primary-bl waves-effect waves-light">{{ __('messages.save') }}</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- </div> end card-box -->
                                    </div>

                                </div>

                            </div>
                        </div> <!-- end card-box-->
                    </div> <!-- end col -->

                </div>
                <!-- end row -->

            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->

</div> <!-- container -->
@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- button js added -->
<script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>

<script>
    var teacherSectionUrl = "{{ config('constants.api.teacher_section') }}";
    var teacherSubjectUrl = "{{ config('constants.api.teacher_subject') }}";
    var getStudentAttendance = "{{ config('constants.api.get_student_attendance') }}";
    var getDailyReportRemarks = "{{ config('constants.api.get_daily_report_remarks') }}";
    var getClassRoomWidget = "{{ config('constants.api.get_classroom_widget_data') }}";
    var getShortTest = "{{ config('constants.api.get_short_test') }}";
    // student leave apply
    var getStudentLeave = "{{ config('constants.api.get_student_leaves') }}";
    var imgurl = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/teacher/student-leaves/' }}";
    var teacher_leave_remarks_updated = "{{ config('constants.api.teacher_leave_approve') }}";
    var getAbsentLateExcuse = "{{ config('constants.api.get_absent_late_excuse') }}";

    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    // localStorage variables
    var teacher_classroom_details = localStorage.getItem('teacher_classroom_details');
    // Get PDF Footer Text
    var header_txt = "{{ __('messages.classroom_management') }}";

    var footer_txt = "{{ session()->get('footer_text') }}";

    // Get PDF Header & Footer Text End
</script>
<script src="{{ asset('js/custom/classroom.js') }}"></script>
<script src="{{ asset('js/custom/short-test.js') }}"></script>
<!-- <script src="https://use.fontawesome.com/fe459689b4.js"></script> -->
@endsection