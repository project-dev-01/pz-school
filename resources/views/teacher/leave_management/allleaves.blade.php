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
                <h4 class="page-title">All Leaves</h4>
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
                        <h4 class="navv">
                            Select Ground
                            <h4>
                    </li>
                </ul><br>

                <div class="card-body">
                    <form id="allLeaveFilter" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="changeLeaveSts">Leave Status</label>
                                    <select id="changeLeaveSts" class="form-control" required="">
                                        <option value="All">All</option>
                                        <option value="Approve">Approved</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Reject">Reject</option>
                                    </select>
                                </div>
                            </div>
                        </div>
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
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            Leave List
                            <h4>
                    </li>
                </ul><br>

                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table id="all-leave-list" class="table w-100 nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee Name</th>
                                        <th>Leave Type</th>
                                        <th>No.Of.Days</th>
                                        <th>From Leave</th>
                                        <th>To Leave</th>
                                        <th>Reason</th>
                                        <th>Document</th>
                                        <th>Status</th>
                                        <!-- <th>Remarks</th> -->
                                        <th>Applied Date</th>
                                        <th>Action</th>
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
                    <label for="heard">Remarks</label>
                    <input type="hidden" id="leave_tbl_id" />
                    <textarea class="form-control" id="leave_remarks" rows="5" placeholder="Enter remarks here" name="leave_remarks"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="button" id="leave_RemarksSave" class="btn btn-primary">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @include('teacher.leave_management.details')
</div> <!-- container -->

@endsection
@section('scripts')
<script>
    var AllLeaveList = "{{ route('teacher.leave_management.leave_approval_history_by_staff') }}";
    var leaveFilesUrl = "{{ asset('public/admin-documents/leaves/') }}";
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
</script>
<script src="{{ asset('public/js/custom/staff_all_leave.js') }}"></script>
@endsection