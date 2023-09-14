<!-- Center modal content -->
<!-- <div class="modal fade DetailsModal" id="DetailsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myDetailsModalLabel">Staff Leave Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h4 class="header-title">Already Taken Leave Details</h4>
                <div class="table-responsive">
                    <table class="table table-centered table-borderless table-striped mb-0">
                        <tbody>
                            <tr>
                                <td>Casual Leave</td>
                                <td>:</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>Casual Leave</td>
                                <td>:</td>
                                <td>1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <h4 class="header-title">Leave Details</h4>
                <div class="table-responsive">
                    <table class="table table-centered table-borderless table-striped mb-0">
                        <tbody>
                            <tr>
                                <td>{{ __('messages.name') }}</td>
                                <td>:</td>
                                <td id="staffName"></td>
                            </tr>
                            <tr>
                                <td>Leave Date</td>
                                <td>:</td>
                                <td id="leaveDates"></td>
                            </tr>
                            <tr>
                                <td>No.Of.Days</td>
                                <td>:</td>
                                <td id="noOfDays"></td>
                            </tr>
                            <tr>
                                <td>Apply Date</td>
                                <td>:</td>
                                <td id="applyDate"></td>
                            </tr>
                            <tr>
                                <td>Leave Type</td>
                                <td>:</td>
                                <td id="leaveType"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.reason') }}</td>
                                <td>:</td>
                                <td id="reason"></td>
                            </tr>
                            <tr>
                                <td>Documents</td>
                                <td>:</td>
                                <td id="documents"></td>
                            </tr>
                            <tr>
                                <td>Staff Remarks</td>
                                <td>:</td>
                                <td id="remarks"></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td id="leave_status"></td>
                            </tr>
                            <tr>
                                <td>Your Remarks</td>
                                <td>:</td>
                                <td><textarea maxlength="255" id="assiner_remarks" class="form-control alloptions" placeholder="Enter the text..." name="txtarea_prev_remarks" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                            </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Leave Status</td>
                                <td>:</td>
                                <td>
                                    <input type="hidden" name="leave_id" id="leave_id">
                                    <select id="leave_status_name" name="leave_status_name" class="form-control">
                                        <option value="">Select Leave Type</option>
                                        <option value="Approve">{{ __('messages.approve') }}</option>
                                        <option value="Reject">Reject</option>
                                        <option value="Pending">Pending</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                    <button type="button" id="approvedLeave" class="btn btn-success waves-effect waves-light">{{ __('messages.save') }}</button>
                </div>
            </div>
        </div>
    </div>
</div> -->



<!-- Long Content Scroll Modal -->
<div class="modal fade DetailsModal" id="DetailsModal" tabindex="-1" role="dialog" aria-labelledby="DetailsModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DetailsModalTitle">{{ __('messages.staff_leave_details') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="header-title">{{ __('messages.already_taken_leave_details') }}</h4>
                <div class="table-responsive">
                    <table id="alreadyTakenLeave" class="table table-centered table-borderless table-striped mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('messages.leave_type') }}</th>
                                <th>{{ __('messages.total_leave') }}</th>
                                <th>{{ __('messages.used_leave') }}</th>
                                <th>{{ __('messages.remaining_leave') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <hr>
                <h4 class="header-title">{{ __('messages.leave_details') }} </h4>
                <div class="table-responsive">
                    <table class="table table-centered table-borderless table-striped mb-0">
                        <tbody>
                            <tr>
                                <td>{{ __('messages.name') }}</td>
                                <td>:</td>
                                <td id="staffName"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.leave_date') }}</td>
                                <td>:</td>
                                <td id="leaveDates"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.no._of._days') }}</td>
                                <td>:</td>
                                <td id="noOfDays"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.apply_date') }}</td>
                                <td>:</td>
                                <td id="applyDate"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.leave_type') }}</td>
                                <td>:</td>
                                <td id="leaveType"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.reason') }}</td>
                                <td>:</td>
                                <td id="reason"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.document') }}</td>
                                <td>:</td>
                                <td id="documents"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.1st_approver_remarks') }}</td>
                                <td>:</td>
                                <td id="1st_approver_remarks"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.2nd_approver_remarks') }}</td>
                                <td>:</td>
                                <td id="2nd_approver_remarks"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.3rd_approver_remarks') }}</td>
                                <td>:</td>
                                <td id="3rd_approver_remarks"></td>
                            </tr>
                            <!-- <tr>
                                <td>{{ __('messages.status') }}</td>
                                <td>:</td>
                                <td id="leave_status"></td>
                            </tr> -->
                            <tr>
                                <td>{{ __('messages.your_remarks') }}</td>
                                <td>:</td>
                                <td><textarea maxlength="255" id="assiner_remarks" class="form-control alloptions" placeholder="Enter the text..." name="txtarea_prev_remarks" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                            </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.leave_status') }}</td>
                                <td>:</td>
                                <td>
                                    <input type="hidden" name="leave_id" id="leave_id">
                                    <input type="hidden" name="approver_level" id="approver_level">
                                    <select id="leave_status_name" name="leave_status_name" class="form-control">
                                        <option value="">{{ __('messages.select_leave_type') }}</option>
                                        <option value="Approve">{{ __('messages.approve') }}</option>
                                        <option value="Reject">{{ __('messages.reject') }}</option>
                                        <option value="Pending">{{ __('messages.pending') }}</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.close') }}</button>
                <button type="button" id="approvedLeave" class="btn btn-success waves-effect waves-light">{{ __('messages.save') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->