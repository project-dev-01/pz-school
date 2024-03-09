<div class="modal fade nursingPopup" id="nursingPopup" tabindex="-1" role="dialog" aria-labelledby="nursingPopupTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nursingPopupTitle">{{ __('messages.homeroom_teacher') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-centered table-borderless table-striped mb-0">
                        <tbody>
                            <tr>
                                <td>{{ __('messages.name') }}</td>
                                <td>:</td>
                                <td id="studentName"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.leave_date') }}</td>
                                <td>:</td>
                                <td id="leaveStartEndDate"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.no._of._days') }}</td>
                                <td>:</td>
                                <td id="noOfDaysLeave"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.apply_date') }}</td>
                                <td>:</td>
                                <td id="applyLeaveDate"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.document') }}</td>
                                <td>:</td>
                                <td id="documentDetails"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.leave_type') }} ( {{ __('messages.from_parent') }} )</td>
                                <td>:</td>
                                <td id="showleaveType"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.absense_reason') }} ( {{ __('messages.from_parent') }} )</td>
                                <td>:</td>
                                <td id="absentReasonFromParent"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.leave_type') }} ( {{ __('messages.nursing') }} )</td>
                                <td>:</td>
                                <td id="dropLeaveType">
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.absense_reason') }} ( {{ __('messages.nursing') }} )</td>
                                <td>:</td>
                                <td id="absentReason">

                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.leave_type') }} ( {{ __('messages.class_incharge') }} )</td>
                                <td>:</td>
                                <td id="showleaveTypeTeacher">
                                    <select id="changeLevType" class="form-control" name="changeLevType">
                                        <option value="">{{ __('messages.select_leave_type') }}</option>
                                        @forelse ($get_student_leave_types as $ress)
                                        <option value="{{ $ress['id'] }}">{{ $ress['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.absense_reason') }}( {{ __('messages.class_incharge') }} )</td>
                                <td>:</td>
                                <td id="absentReasonForTeacher">
                                    <select id="changelevReasons1" class="form-control" name="changelevReasons1">
                                        <option value="">{{ __('messages.select_reason') }}</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.your_remarks') }}</td>
                                <td>:</td>
                                <td>
                                    <textarea maxlength="255" id="yourRemarks" class="form-control" placeholder="Enter the text..." name="remarks" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.leave_status') }}</td>
                                <td>:</td>
                                <td>
                                    <input type="hidden" name="studentLeaveID" id="studentLeaveID">
                                    <select id="leave_status_name" name="leave_status_name" class="form-control">
                                        <option value="">{{ __('messages.select_leave_type') }}</option>
                                        <option value="Approve">{{ __('messages.approve') }}</option>
                                        <option value="Reject">{{ __('messages.reject') }}</option>
                                        <option value="Pending" selected>{{ __('messages.pending') }}</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.close') }}</button>
                <button type="button" id="stdLeaveapprovedLeave" class="btn btn-success waves-effect waves-light">{{ __('messages.save') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->