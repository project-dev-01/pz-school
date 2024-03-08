@extends('layouts.admin-layout')
@section('title',' ' . __('messages.classroom_attendance') . '')
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
                <h4 class="page-title">{{ __('messages.classroom_attendance') }}</h4>
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
                                    <label for="class_date">{{ __('messages.date') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control value=" <?php echo date('d-m-Y'); ?>" name="class_date" placeholder="{{ __('messages.dd_mm_yyyy') }}" id="classDate" require="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="semester_id">{{ __('messages.semester') }}</label>
                                    <select id="semester_id" class="form-control" name="semester_id">
                                        <option value="0">{{ __('messages.select_semester') }}</option>
                                        @forelse($semester as $sem)
                                        <option value="{{$sem['id']}}">{{$sem['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="session_id">{{ __('messages.session') }}</label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="0">{{ __('messages.select_session') }}</option>
                                        @forelse($session as $ses)
                                        <option value="{{$ses['id']}}">{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                        @empty
                                        @endforelse
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
                </div>
            </div>
            <div class="row classRoomHideSHow" style="display: none;">
                <div class="col-xl-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">{{ __('messages.classroom_details') }}
                                    <h4>
                            </li>
                        </ul><br>
                        <form id="addListMode" method="post" action="{{ route('teacher.attendance.add') }}" autocomplete="off">
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
    var getStudentAttendance = "{{ config('constants.api.get_student_attendance_no_subject') }}";
    // student leave apply
    var getStudentLeave = "{{ config('constants.api.get_student_leaves') }}";
    var imgurl = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/teacher/student-leaves/' }}";
    var getAbsentLateExcuse = "{{ config('constants.api.get_absent_late_excuse') }}";

    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    // localStorage variables
    var teacher_classroom_attendance = localStorage.getItem('teacher_classroom_attendance');
    // Get PDF Footer Text
    var header_txt = "{{ __('messages.classroom_attendance') }}";

    var footer_txt = "{{ session()->get('footer_text') }}";

    // Get PDF Header & Footer Text End
</script>
<script src="{{ asset('js/custom/classroom_attendance_no_sub.js') }}"></script>
<!-- <script src="https://use.fontawesome.com/fe459689b4.js"></script> -->
@endsection