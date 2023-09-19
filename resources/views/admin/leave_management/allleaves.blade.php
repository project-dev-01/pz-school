@extends('layouts.admin-layout')
@section('title',' ' . __('messages.all_leaves') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection
@section('content')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 6px 20px;
    }

    tr th {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 6px 20px;

    }

    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc_disabled:before {
        right: 1em;
        content: "\2191";
        top: 22px;
    }

    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:after {
        right: 0.5em;
        content: "\2193";
        top: 22px;
    }
</style>

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">{{ __('messages.all_leaves') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!--General Details -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> {{ __('messages.select_ground') }}
                            <h4>
                    </li>
                </ul><br>

                <div class="card-body">
                    <form id="allLeaveFilter" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="levelOneStatus">{{ __('messages.level_one_staff_approval') }}</label>
                                    <select id="levelOneStatus" class="form-control" required="">
                                        <option value="All">{{ __('messages.all') }}</option>
                                        <option value="Approve">{{ __('messages.approved') }}</option>
                                        <option value="Pending">{{ __('messages.pending') }}</option>
                                        <option value="Reject">{{ __('messages.reject') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="levelTwoStatus">{{ __('messages.level_two_staff_approval') }}</label>
                                    <select id="levelTwoStatus" class="form-control" required="">
                                        <option value="All">{{ __('messages.all') }}</option>
                                        <option value="Approve">{{ __('messages.approved') }}</option>
                                        <option value="Pending">{{ __('messages.pending') }}</option>
                                        <option value="Reject">{{ __('messages.reject') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="levelThreeStatus">{{ __('messages.level_three_staff_approval') }}</label>
                                    <select id="levelThreeStatus" class="form-control" required="">
                                        <option value="All">{{ __('messages.all') }}</option>
                                        <option value="Approve">{{ __('messages.approved') }}</option>
                                        <option value="Pending">{{ __('messages.pending') }}</option>
                                        <option value="Reject">{{ __('messages.reject') }}</option>
                                    </select>
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
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> {{ __('messages.leave_list') }}
                            <h4>
                    </li>
                </ul><br>

                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table id="all-leave-list" class="" style="border-collapse: collapse;width:100%">
                                <thead>
                                <tr>
                                        <th rowspan="2">#</th>
                                        <th rowspan="2">{{ __('messages.employee_name') }}</th>
                                        <th rowspan="2">{{ __('messages.leave_type') }}</th>
                                        <th rowspan="2">{{ __('messages.no._of._days') }}</th>
                                        <th rowspan="2">{{ __('messages.from_leave') }}</th>
                                        <th rowspan="2">{{ __('messages.to_leave') }}</th>
                                        <th rowspan="2">{{ __('messages.reason') }}</th>
                                        <th rowspan="2">{{ __('messages.document') }}</th>
                                        <th colspan="3">{{ __('messages.approval_status') }}</th>
                                        <!-- <th>{{ __('messages.2nd') }}</th>
                                        <th>{{ __('messages.3rd') }}</th> -->
                                        <th rowspan="2">{{ __('messages.applied_date') }}</th>
                                        <th rowspan="2">{{ __('messages.action') }}</th>
                                    </tr>
                                    <tr>
                                        <th>{{ __('messages.1st') }}</th>
                                        <th>{{ __('messages.2nd') }}</th>
                                        <th>{{ __('messages.3rd') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
    <!-- student leave remarks popup -->
    <div class="modal fade" id="LeaveRemarksPopup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <label for="heard">{{ __('messages.remarks') }}</label>
                    <input type="hidden" id="leave_tbl_id" />
                    <textarea class="form-control" id="leave_remarks" rows="5" placeholder="{{ __('messages.enter_remarks') }}" name="leave_remarks"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                    <button type="button" id="leave_RemarksSave" class="btn btn-primary">{{ __('messages.save') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @include('admin.leave_management.details')
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
    var AllLeaveList = "{{ route('admin.leave_management.list') }}";
    var leaveFilesUrl = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/admin-documents/leaves/' }}";
    var leaveApprovedUrl = "{{ config('constants.api.staff_leave_approved') }}";
    var staffLeaveDetailsShowUrl = "{{ config('constants.api.staff_leave_details') }}";

    // Get PDF Footer Text

    var header_txt = "{{ __('messages.all_leaves') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End

    var admin_allleaves_storage = localStorage.getItem('admin_alltleaves_details');
</script>
<script src="{{ asset('js/custom/admin_all_leave.js') }}"></script>
@endsection