<!-- Center modal content -->
<div class="modal fade editLeaveType" id="editLeaveTypeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditLeaveTypeModalLabel">Edit Leave Type</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-leave-type-form" method="post" action="{{ route('admin.leave_type.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="name">{{ __('messages.leave_type_name') }} <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('messages.enter_leave_type_name') }}">
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
                        <label for="gender">{{ __('messages.gender') }}</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="">{{ __('messages.select_gender') }}</option>
                            <option value="All">{{ __('messages.all') }}</option>
                            <option value="Male">{{ __('messages.male') }}</option>
                            <option value="Female">{{ __('messages.female') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.update') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->