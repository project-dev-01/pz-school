@extends('layouts.admin-layout')
@section('title','Student Leave Details')
@section('component_css')
<link href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">

<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection
@section('content')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<div class="container-fluid">

    <!-- Start Content-->
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <!-- <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Datatables</li>
                        </ol>
                    </div> -->
                <h4 class="page-title">{{ __('messages.student_leave_details') }}</h4>
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
                                    <label for="changeClassName">{{ __('messages.grade') }}</label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                        @forelse ($classes as $class)
                                        <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                        @empty
                                        @endforelse
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
            <div class="card studentLeaveShow" style="display: none;">
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
                                    <th> {{ __('messages.student_name') }}</th>
                                    <th> {{ __('messages.grade') }}</th>
                                    <th> {{ __('messages.class') }}</th>
                                    <th> {{ __('messages.from') }}</th>
                                    <th> {{ __('messages.to') }}</th>
                                    <th> {{ __('messages.approval_status') }}</th>
                                    <th> {{ __('messages.status') }}</th>
                                    <th> {{ __('messages.reason') }}</th>
                                    <th> {{ __('messages.document') }}</th>
                                    <th> {{ __('messages.teacher_remarks') }}</th>
                                    <th> {{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
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
</script>
<script src="{{ asset('js/custom/student_leave_list.js') }}"></script>
@endsection