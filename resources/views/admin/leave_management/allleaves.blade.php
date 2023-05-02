@extends('layouts.admin-layout')
@section('title','All Leaves')
@section('content')
<!-- Start Content-->
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
                        <h4 class="navv"> {{ __('messages.select_ground') }}<h4>
                    </li>
                </ul><br>

                <div class="card-body">
                    <form id="allLeaveFilter" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="changeLeaveSts">{{ __('messages.leave_status') }}</label>
                                    <select id="changeLeaveSts" class="form-control" required="">
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
                            <table id="all-leave-list" class="table nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('messages.employee_name') }}</th>
                                        <th>{{ __('messages.leave_type') }}</th>
                                        <th>{{ __('messages.no._of._days') }}</th>
                                        <th>{{ __('messages.from_leave') }}</th>
                                        <th>{{ __('messages.to_leave') }}</th>
                                        <th>{{ __('messages.reason') }}</th>
                                        <th>{{ __('messages.document') }}</th>
                                        <th>{{ __('messages.status') }}</th>
                                        <!-- <th>Remarks</th> -->
                                        <th>{{ __('messages.applied_date') }}</th>
                                        <th>{{ __('messages.action') }}</th>
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
<script>
    var AllLeaveList = "{{ route('admin.leave_management.list') }}";
    var leaveFilesUrl = "{{ config('constants.image_url').'/public/admin-documents/leaves/' }}";
    var leaveApprovedUrl = "{{ config('constants.api.staff_leave_approved') }}";
    var staffLeaveDetailsShowUrl = "{{ config('constants.api.staff_leave_details') }}";
</script>
<script src="{{ asset('public/js/custom/admin_all_leave.js') }}"></script>
@endsection