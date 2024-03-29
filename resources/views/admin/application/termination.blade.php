<div class="modal fade updateTermination" id="terminationModal" tabindex="-1" role="dialog" aria-labelledby="DetailsModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DetailsModalTitle">Termination Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <div class="modal-body">
            <form id="terminationEditForm" method="post" action="{{ route('admin.termination.update') }}" autocomplete="off">
                    @csrf 
                    <input type="hidden" name="id" id="id">
                <div class="table-responsive">
                    <table class="table table-centered table-borderless table-striped mb-0">
                        <tbody>
                            <tr>
                                <td>{{ __('messages.name') }}</td>
                                <td>:</td>
                                <td id="name"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.apply_date') }}</td>
                                <td>:</td>
                                <td id="date"></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.control_number') }}</td>
                                <td>:</td>
                                <td id="control_number"></td>
                            </tr>
                            
                            <tr>
                                <td>{{ __('messages.scheduled_date_of_termination_5_business_day') }}</td>
                                <td>:</td>
                                <td><div class="input-group input-group-merge">
                                            <input type="text" class="form-control" id="schedule_date_of_termination" name="schedule_date_of_termination" readonly  placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="far fa-calendar-alt"></span>
                                                </div>
                                            </div>
                                        </div></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.reason_for_transfer') }}</td>
                                <td>:</td>
                                <td ><input type="text" class="form-control" id="reason_for_transfer"  name="reason_for_transfer" readonly placeholder="{{ __('messages.enter_reason_for_transfer') }}" aria-describedby="inputGroupPrepend">
                                    </td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.transfer_destination_school_name') }}</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="transfer_destination_school_name" readonly  name="transfer_destination_school_name" placeholder="{{ __('messages.enter_transfer_destination_school_name') }}" aria-describedby="inputGroupPrepend">
                                    </td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.transfer_destination_tel') }}</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="transfer_destination_tel" readonly name="transfer_destination_tel" placeholder="{{ __('messages.enter_transfer_destination_tel') }}" aria-describedby="inputGroupPrepend">
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.parent_guardian_phone_number_after_transfer') }}</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="parent_phone_number_after_transfer" readonly  name="parent_phone_number_after_transfer" placeholder="{{ __('messages.enter_parent_guardian_phone_number_after_transfer') }}" aria-describedby="inputGroupPrepend">
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.parent_email_address_after_transfer') }}</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="parent_email_address_after_transfer" readonly  name="parent_email_address_after_transfer" placeholder="{{ __('messages.enter_parent_email_address_after_transfer') }}" aria-describedby="inputGroupPrepend">
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.school_fees_payment_status') }}<span class="text-danger">*</span></td>
                                <td>:</td>
                                <td> <select id="school_fees_payment_status" name="school_fees_payment_status" class="form-control" >
                                        <option value="">{{ __('messages.select_payment_status') }}</option>
                                        <option value="Paid">{{ __('messages.paid') }}</option>
                                        <option value="Unpaid">{{ __('messages.unpaid') }}</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.termination_status') }}<span class="text-danger">*</span></td>
                                <td>:</td>
                                <input type="hidden"  name="termination_status_old">
                                <td> <select id="termination_status" class="form-control" name="termination_status">
                                        <option value="">{{ __('messages.select_status') }}</option>
                                        <option value="Approved">{{ __('messages.approved') }}</option>
                                        <option value="Pending">{{ __('messages.pending') }}</option>
                                        <option value="Send Back">{{ __('messages.send_back') }}</option>
                                        <option value="Rejected">{{ __('messages.rejected') }}</option>
                                    </select></td>
                            </tr>
                            <tr id="remarks_row" style="display:none">
                                <td>{{ __('messages.remarks') }}</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="remarks"  name="remarks" placeholder="{{ __('messages.enter_remarks') }}" aria-describedby="inputGroupPrepend">
                                    
                                </td>
                            </tr>
                            <tr id="student_status_row" style="display:none">
                                <td>{{ __('messages.student_status') }}</td>
                                <td>:</td>
                                <td> <select id="student_status" class="form-control" name="student_status">
                                        <option value="">{{ __('messages.select_status') }}</option>
                                        <option value="Active">{{ __('messages.active') }}</option>
                                        <option value="Deactive">{{ __('messages.de_active') }}</option>
                                    </select></td>
                            </tr>
                            <tr id="date_of_termination_row" style="display:none">
                                <td>{{ __('messages.date_of_termination') }}</td>
                                <td>:</td>
                                <td>
                                
                    <div class="form-group">
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="far fa-calendar-alt"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control datepicker" id="date_of_termination" name="date_of_termination" aria-describedby="inputGroupPrepend">
                        </div>
                        <label for="date_of_termination" class="error"></label>
                    </div>    </td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.delete_google_address') }}</td>
                                <td>:</td>
                                <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input allDayCheck" id="delete_google_address" name="delete_google_address">
                            <label class="custom-control-label" for="delete_google_address"></label>
                        </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.close') }}</button>
                <button type="submit" id="terminationUpdate" class="btn btn-success waves-effect waves-light">{{ __('messages.save') }}</button>
            </div>
</form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->