@extends('layouts.admin-layout')
@section('title',' ' . __('messages.student_leaves') . '')
@section('component_css')
<link href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<div class="container-fluid">

    <!-- Start Content-->
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:10px;margin-top:10px">
                <div class="page-title-icon">
                    <svg class="svg-icon" style="width: 20; height: 20;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <path d="M860 860.5H512c-28.3 0-51.2-22.9-51.2-51.2v-71.7h450.4v71.7c0 28.3-22.9 51.2-51.2 51.2zM630.6 519.7c-40-20.3-67.4-61.6-67.4-109.5 0-67.8 55-122.8 122.8-122.8s122.8 55 122.8 122.8c0 47.9-27.5 89.2-67.4 109.5 97.5 24.7 169.8 112.8 169.8 218H460.8c0-105.2 72.3-193.3 169.8-218zM491.5 410.1c0 31.4 7.6 60.9 20.8 87.2-74.5 53.9-123.2 141.4-123.2 240.4 0 13.4 1.2 26.6 2.9 39.5-156.6-14.1-279.3-145.4-279.3-305.7 0-169.6 137.5-307.1 307.1-307.1 72 0 138.1 25 190.4 66.5-69.7 29.6-118.7 98.7-118.7 179.2zM430.1 318c0-17-13.7-30.7-30.7-30.7S368.7 301 368.7 318v138.8l-94.8 94.8c-12 12-12 31.4 0 43.4s31.4 12 43.4 0l101.3-101.3c5.6-5.6 8.5-12.8 8.8-20.1 1.7-3.8 2.6-8 2.6-12.4V318z" fill="black" />
                    </svg>
                </div>
                <h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_leaves') }} </h4>
            </div>

        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            {{ __('messages.student_leave_details_list') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="studentLeaveList" data-parsley-validate="" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="student_name">{{ __('messages.student_name') }}</label>
                                    <input type="text" name="student_name" class="form-control" id="student_name">
                                </div>
                            </div>
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
                                    <label for="changeClassName">{{ __('messages.grade') }}</label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sectionID"> {{ __('messages.class') }}</label>
                                    <select id="sectionID" class="form-control" name="section_id">
                                        <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="leave_status">{{ __('messages.status') }}</label>
                                    <select id="leave_status" class="form-control" name="leave_status">
                                        <option value="">{{ __('messages.select_status') }}</option>
                                        <option value="Approve">{{ __('messages.approve') }}</option>
                                        <option value="Reject">{{ __('messages.reject') }}</option>
                                        <option value="Pending">{{ __('messages.pending') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ __('messages.date_range') }}</label>
                                    <input type="text" id="range-datepicker" name="date" class="form-control flatpickr-input active" placeholder="{{ __('messages.yyyy_mm_dd') }} {{ __('messages.to') }} {{ __('messages.yyyy_mm_dd') }}" readonly="readonly">
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                {{ __('messages.filter') }}
                            </button>
                        </div>
                    </form>


                </div> <!-- end card-body -->
            </div>
            <div class="card studentLeaveShow" style="display:none;">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> {{ __('messages.student_leave_details_list') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="student-leave-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> {{ __('messages.department') }}</th>
                                    <th> {{ __('messages.grade') }}</th>
                                    <th> {{ __('messages.class') }}</th>
                                    <th> {{ __('messages.attendance_no') }}</th>
                                    <th> {{ __('messages.student_name') }}</th>
                                    <th> {{ __('messages.from') }}</th>
                                    <th> {{ __('messages.to') }}</th>
                                    <th> {{ __('messages.leave_type') }}</th>
                                    <th> {{ __('messages.reason') }}</th>
                                    <th> {{ __('messages.homeroom_status') }}</th>
                                    <th> {{ __('messages.homeroom_teacher_remarks') }}</th>
                                    <th> {{ __('messages.nursing_status') }}</th>
                                    <th> {{ __('messages.nursing_teacher_remarks') }}</th>
                                    <th> {{ __('messages.document') }}</th>
                                    <th> {{ __('messages.status') }}</th>
                                    <th> {{ __('messages.status') }}</th>
                                    <th> {{ __('messages.action') }}</th>

                                    <!-- <th>#</th>
                                    <th> {{ __('messages.student_name') }}</th>
                                    <th> {{ __('messages.grade') }}</th>
                                    <th> {{ __('messages.class') }}</th>
                                    <th> {{ __('messages.from') }}</th>
                                    <th> {{ __('messages.to') }}</th>
                                    <th> {{ __('messages.status') }}</th>
                                    <th> {{ __('messages.homeroom_status') }}</th>
                                    <th> {{ __('messages.nursing_status') }}</th>
                                    <th> {{ __('messages.reason') }}</th>
                                    <th> {{ __('messages.document') }}</th>
                                    <th> {{ __('messages.homeroom_teacher_remarks') }}</th>
                                    <th> {{ __('messages.nursing_teacher_remarks') }}</th>
                                    <th> {{ __('messages.status') }}</th>
                                    <th> {{ __('messages.action') }}</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
            <div class="card studentLeaveShow" style="display:none;">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.student_Leave_authorization') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="stdGeneralDetails" method="post" action="{{ route('admin.studentleave.add') }}">
                        @csrf
                        <!--1st row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="direct_department_id">{{ __('messages.department') }}<span class="text-danger">*</span></label>
                                    <select id="direct_department_id" name="direct_department_id" class="form-control">
                                        <option value="">{{ __('messages.select_department') }}</option>
                                        @forelse($department as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="directClassName">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="directClassName" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="directsectionID">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                    <select id="directsectionID" class="form-control" name="section_id">
                                        <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="changeStdName">{{ __('messages.student_name') }}<span class="text-danger">*</span></label>
                                    <select id="changeStdName" class="form-control" name="changeStdName">
                                        <option value="">{{ __('messages.select_student') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heard">{{ __('messages.leave_from') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" autocomplete="off" name="frm_ldate" class="form-control" id="frm_ldate" placeholder="{{ __('messages.dd_mm_yyyy') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heard">{{ __('messages.to_leave') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" autocomplete="off" name="to_ldate" class="form-control" id="to_ldate" placeholder="{{ __('messages.dd_mm_yyyy') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--2st row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="total_leave">{{ __('messages.number_of_days_leave') }}<span class="text-danger">*</span></label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="{{ __('messages.enter_days_leave') }}">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="directchangeLevType">{{ __('messages.leave_type') }}<span class="text-danger">*</span></label>
                                    <select id="directchangeLevType" class="form-control" name="directchangeLevType">
                                        <option value="">{{ __('messages.select_leave_type') }}</option>
                                        @forelse ($get_student_leave_types as $ress)
                                        <option value="{{ $ress['id'] }}">{{ $ress['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="directchangeLevType">{{ __('messages.leave_type') }}<span class="text-danger">*</span></label>
                                    <select id="directchangeLevType" class="form-control" name="directchangeLevType">
                                        <option value="">{{ __('messages.select_leave_type') }}</option>
                                        @forelse ($get_student_leave_types as $ress)
                                        <option value="{{ $ress['id'] }}">{{ $ress['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="changelev">{{ __('messages.reason(s)') }}<span class="text-danger">*</span></label>
                                    <select id="changelevReasons" class="form-control" name="changelevReasons">
                                        <option value="">{{ __('messages.select_reason') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--3st row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="leave_file">{{ __('messages.attachment_file') }}</label>

                                    <div class="input-group">
                                        <div class="">
                                            <input type="file" id="leave_file" class="custom-file-input" name="file">
                                            <label class="custom-file-label" for="leave_file">{{ __('messages.choose_the_file') }}</label>
                                            <span id="file_name"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="changelev">{{ __('messages.remarks') }}</label>
                                    <textarea maxlength="255" id="txtarea_prev_remarks" class="form-control alloptions" placeholder="{{ __('messages.enter_the_remarks') }}" name="txtarea_prev_remarks" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="button" class="btn form-control" style="background-color: gray;color:white" data-toggle="modal" id="studentAllReasons"> {{ __('messages.click_here_for') }}</button>
                                    <!-- <input type="button" class="form-control" id="btnOpenDialog" value="Click Here For Reason Details" /> -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="stud_leave_status">{{ __('messages.status') }}<span class="text-danger">*</span></label>
                                    <select id="stud_leave_status" class="form-control" name="stud_leave_status">
                                        <option value="">{{ __('messages.select_status') }}</option>
                                        <option value="Approve">{{ __('messages.approve') }}</option>
                                        <option value="Reject">{{ __('messages.reject') }}</option>
                                        <option value="Pending">{{ __('messages.pending') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                {{ __('messages.apply') }}
                            </button>
                            <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                    Cancel
                                </button>-->
                        </div>

                    </form>

                </div>
            </div>
        </div><!-- end col-->
    </div>
    <!-- end row-->
    @include('admin.student_leave.reason')
    @include('admin.student_leave.nursing')
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
</div> <!-- container -->
@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>

<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('js/pages/form-pickers.init.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script>
    var sectionByClassUrl = "{{ config('constants.api.section_by_class') }}";
    var allStutdentLeaveList = "{{ config('constants.api.get_all_student_leaves') }}";
    var studentDocUrl = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/teacher/student-leaves/' }}";
    var teacher_leave_remarks_updated = "{{ config('constants.api.teacher_leave_approve') }}";
    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var admin_studentleave_storage = localStorage.getItem('admin_studentleave_details');
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
    var viewStudentLeaveDetailsRow = "{{ config('constants.api.view_student_leave_details_row') }}";
    var getReasonsByLeaveType = "{{ config('constants.api.get_reasons_by_leave_type') }}";
    var getStudentList = "{{ config('constants.api.get_student_details') }}";
    var leaveTypeWiseGetAllReason = "{{ config('constants.api.leave_type_wise_get_all_reason') }}";
    var holidayEventList = "{{ config('constants.api.holidays_list_event') }}";
</script>
<script src="{{ asset('js/custom/student_leave_list_byadmin.js') }}"></script>
<script src="{{ asset('js/custom/student_leave_direct_approve.js') }}"></script>
@if(!empty(Session::get('school_roleid')))
<script>
    var checkpermissions = "{{ route('admin.school_role.checkpermissions') }}";
</script>
<script src="{{ asset('js/custom/permissions.js') }}"></script>
@endif
@endsection