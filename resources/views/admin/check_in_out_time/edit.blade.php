<!-- Center modal content -->
<div class="modal fade editCheckInOutTime" id="editCheckInOutTimeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditCheckInOutTimeModalLabel">{{ __('messages.edit_check_in_out_time') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="check-in-out-time-form" method="post" action="{{ route('admin.check_in_out_time.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="check_in">{{ __('messages.check_in_time') }}<span class="text-danger">*</span></label>
                        <input type="text" id="check_in" name="check_in" class="form-control timepicker" placeholder="{{ __('messages.enter_check_in_time') }}">
                        <span class="text-danger error-text check_in_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="check_out">{{ __('messages.check_out_time') }}<span class="text-danger">*</span></label>
                        <input type="text" id="check_out" name="check_out" class="form-control timepicker" placeholder="{{ __('messages.enter_check_out_time') }}">
                        <span class="text-danger error-text check_out_error"></span>
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