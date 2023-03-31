<!-- Center modal content -->
<div class="modal fade addLeaveType" id="addLeaveTypeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddLeaveTypeModalLabel">Add Leave Type</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="leaveTypeForm" method="post" action="{{ route('admin.leave_type.add') }}" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label for="name">Leave Type Name<span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Leave Type Name">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="short_name">{{ __('messages.short_name') }}</label>
                        <input type="text" id="short_name" name="short_name" class="form-control" placeholder="Enter Short Name">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="leave_days">Leave Days<span class="text-danger">*</span></label>
                        <input type="text" id="leave_days" name="leave_days" class="form-control number_validation" placeholder="Enter Leave Days">
                        <span class="text-danger error-text leave_days_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="gender">{{ __('messages.gender') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="">Select Gender</option>
                            <option value="All">All</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.submit') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->