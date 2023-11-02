<div class="modal fade DetailsModal" id="nursingPopup" tabindex="-1" role="dialog" aria-labelledby="DetailsModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DetailsModalTitle">Nursing Teacher</h5>
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
                                <td>佐藤 清</td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.leave_date') }}</td>
                                <td>:</td>
                                <td>17-10-2023/17-10-2023</td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.no._of._days') }}</td>
                                <td>:</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.apply_date') }}</td>
                                <td>:</td>
                                <td>17-10-2023</td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.document') }}</td>
                                <td>:</td>
                                <td id="documents">fever.pdf</td>
                            </tr>
                            <tr>
                                <td>Absense Reason(From Parent)</td>
                                <td>:</td>
                                <td> <select id="changeStdName" class="form-control" name="changeStdName">
                                        <option value="">Select the reason</option>
                                        <option value="">Fever</option>
                                        <option value="" selected>Sick</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Absense Reason(Class Incharge)</td>
                                <td>:</td>
                                <td>
                                    <select id="changeStdName" class="form-control" name="changeStdName">
                                        <option value="">Select the reason</option>
                                        <option value="" selected>Fever</option>
                                        <option value="">Sick</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Absense Reason</td>
                                <td>:</td>
                                <td>
                                    <select id="changeStdName" class="form-control" name="changeStdName">
                                        <option value="">Select the reason</option>
                                        <option value="" selected>Fever</option>
                                        <option value="">Sick</option>
                                    </select>
                                </td>
                            </tr>
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
                <button type="button" id="approvedLeave" class="btn btn-success waves-effect waves-light">{{ __('messages.save') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->