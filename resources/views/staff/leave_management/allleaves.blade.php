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
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

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
				<div class="page-title-box" style="display: inline-flex; align-items: center;">
					<div class="page-title-icon">
                    <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g clip-path="url(#clip0_122_3580)">
        <path d="M0.0202342 7.91378C0.0202342 7.25256 -0.00771459 6.59133 0.0202342 5.93395C0.0563401 5.55371 0.223237 5.19596 0.494462 4.91741C0.765688 4.63885 1.12572 4.45543 1.51749 4.39623C1.64961 4.37648 1.78306 4.36621 1.91676 4.36548H4.60383V1.75135C4.5853 1.51634 4.66449 1.28386 4.82398 1.10507C4.98347 0.926273 5.21019 0.815805 5.45427 0.797962C5.69835 0.78012 5.9398 0.856361 6.1255 1.00992C6.31119 1.16348 6.42593 1.38179 6.44446 1.6168C6.44854 1.69236 6.44854 1.76806 6.44446 1.84361V4.35395H17.5082V4.18095C17.5082 3.37749 17.5082 2.57787 17.5082 1.77826C17.5023 1.54171 17.5944 1.31264 17.764 1.14141C17.9336 0.970189 18.1668 0.870841 18.4125 0.865233C18.6582 0.859625 18.8961 0.948214 19.0739 1.11151C19.2518 1.2748 19.355 1.49943 19.3608 1.73597C19.3608 2.54712 19.3608 3.35827 19.3608 4.16941V4.36548H22.0678C22.3208 4.35688 22.573 4.39854 22.8086 4.48784C23.0442 4.57715 23.2582 4.71219 23.4372 4.88457C23.6162 5.05695 23.7565 5.26297 23.8492 5.4898C23.942 5.71664 23.9852 5.95943 23.9763 6.20306C23.9763 6.76817 23.9763 7.33328 23.9763 7.90993L0.0202342 7.91378Z" fill="#3A4265" />
        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.000144945 9.70129H6V10.8095H8V9.70129H24.0001V22.9526C24.0182 23.3692 23.8838 23.7786 23.6204 24.1095C23.3569 24.4404 22.9812 24.6718 22.5588 24.7633C22.4014 24.7959 22.2407 24.8114 22.0797 24.8094H1.92461C1.49174 24.8272 1.06621 24.6974 0.722953 24.4429C0.379694 24.1883 0.140706 23.8253 0.0480552 23.4178C0.0143581 23.2714 -0.00171658 23.1218 0.000144945 22.9718V9.70129ZM8 11.8095H6V13.8095H8V11.8095Z" fill="#3A4265" />
    </g>
    <defs>
        <clipPath id="clip0_122_3580">
            <rect width="24" height="24" fill="white" transform="translate(0 0.809509)" />
        </clipPath>
    </defs>
</svg>
					</div>
					<!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
					<ol class="breadcrumb m-0 responsivebc">
						<li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.leave_management') }}</a></li>
						<li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.leave_approval') }}</a></li>
					</ol>

				</div>
			</div>
		</div>
    <!-- end page title -->

    <!--General Details -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <!-- Button placed on the left side -->
                        <h4 class="navv"> {{ __('messages.select_ground') }}
                            <h4>
                                <button class="btn btn-link " type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                    </li>
                </ul>

                <div class="card-body collapse show">
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
                <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <!-- Button placed on the left side -->
                        <h4 class="navv"> {{ __('messages.leave_list') }}
                            <h4>
                                <button class="btn btn-link " type="button" id="collapseButton2" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                    </li>
                </ul>
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="table-responsive">
                        <table id="all-leave-list" class="" style="border-collapse: collapse;width:100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2">#</th>
                                        <th rowspan="2">{{ __('messages.employee_name') }}</th>
                                        <th rowspan="2">{{ __('messages.leave_type') }}</th>
                                        <th rowspan="2">{{ __('messages.leave_request_for') }}</th>
                                        <th rowspan="2">{{ __('messages.no._of._days') }} / {{ __('messages.hours') }}</th>
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
                                    <!-- <tr>
                                        <th class="align-top" rowspan="2">#</th>
                                        <th class="align-top" rowspan="2">{{ __('messages.employee_name') }}</th>
                                        <th class="align-top" rowspan="2">{{ __('messages.leave_type') }}</th>
                                        <th class="align-top" rowspan="2">{{ __('messages.no._of._days') }}</th>
                                        <th class="align-top" rowspan="2">{{ __('messages.from_leave') }}</th>
                                        <th class="align-top" rowspan="2">{{ __('messages.to_leave') }}</th>
                                        <th class="align-top" rowspan="2">{{ __('messages.reason') }}</th>
                                        <th class="align-top" rowspan="2">{{ __('messages.document') }}</th>
                                        <th class="text-center" rowspan="2">{{ __('messages.approval_status') }}</th>
                                        <th class="align-middle" rowspan="2">{{ __('messages.applied_date') }}</th>
                                        <th class="align-middle" rowspan="2">{{ __('messages.action') }}</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">%</td>
                                        <td class="text-center">%</td>
                                        <td class="text-center">%</td>
                                    </tr> -->
                                </thead>
                                <!-- <tr>
                                        <th rowspan="6"></th>
                                        <th rowspan="3">{{ __('messages.approval_status') }}</th>
                                        <th rowspan="2"></th>
                                    </tr> -->
                                <!-- <tr>
                                        <th>#</th>
                                        <th>{{ __('messages.employee_name') }}</th>
                                        <th>{{ __('messages.leave_type') }}</th>
                                        <th>{{ __('messages.no._of._days') }}</th>
                                        <th>{{ __('messages.from_leave') }}</th>
                                        <th>{{ __('messages.to_leave') }}</th>
                                        <th>{{ __('messages.reason') }}</th>
                                        <th>{{ __('messages.document') }}</th>
                                        <th>{{ __('messages.approval_status') }}</th>
                                        <th>{{ __('messages.applied_date') }}</th>
                                        <th>{{ __('messages.action') }}</th>
                                    </tr> -->
                                <!-- <tr>
                                        <td class="text-center">1st</td>
                                        <td class="text-center">2nd</td>
                                        <td class="text-center">3rd</td>
                                    </tr> -->
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
    @include('teacher.leave_management.details')
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
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    var AllLeaveList = "{{ route('staff.leave_management.leave_approval_history_by_staff') }}";
    var leaveFilesUrl = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/admin-documents/leaves/' }}";
    var leaveApprovedUrl = "{{ config('constants.api.staff_leave_approved') }}";
    var staffLeaveDetailsShowUrl = "{{ config('constants.api.staff_leave_details') }}";
    // $(function() {
    //     $(".alloptions").maxlength({
    //         alwaysShow: !0,
    //         separator: "/",
    //         preText: " ",
    //         postText: " chars available.",
    //         validate: !0,
    //         //fontSize:"20%",
    //         warningClass: "badge badge-success badge-custom",
    //         limitReachedClass: "badge badge-danger badge-custom",
    //     })

    // });
    // Get PDF Footer Text

    var header_txt = "{{ __('messages.all_leaves') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
    var staff_leaveapproval_storage = localStorage.getItem('staff_leaveapproval_details');
</script>
<script src="{{ asset('js/custom/staff_all_leave.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection