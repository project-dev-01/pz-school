<!-- Center modal content -->
<div class="modal fade addStaffLeaveAssign" id="addStaffLeaveAssignModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddStaffLeaveAssignModalLabel">{{ __('messages.add_leave_type') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="staffLeaveAssignForm" method="post" action="{{ route('admin.staff_leave_assign.add') }}" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label for="staff_id">{{ __('messages.staff') }}<span class="text-danger">*</span></label>
                        <select class="form-control" name="staff_id" id="staff_id">
                            <option value="">{{ __('messages.select_staff') }}</option>
                            @forelse($staff as $s)
                            <option value="{{$s['id']}}">{{$s['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="leave_type">{{ __('messages.leave_type') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="leave_type" name="leave_type">
                            <option value="">{{ __('messages.select_leave_type') }}</option>
                            @forelse($leave_type as $type)
                            <option value="{{$type['id']}}">{{$type['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                        <span class="text-danger error-text category_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="leave_days">{{ __('messages.leave_days') }}<span class="text-danger">*</span></label>
                        <input type="text" id="leave_days" name="leave_days" class="form-control" placeholder="{{ __('messages.enter_leave_days') }}">
                        <span class="text-danger error-text leave_days_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="academic_session_id">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="academic_session_id" name="academic_session_id">
                            <option value="0">{{ __('messages.select_academic_year') }}</option>
                            @forelse($academic_year as $ay)
                            <option value="{{$ay['id']}}">{{$ay['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                        <span class="text-danger error-text category_error"></span>
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