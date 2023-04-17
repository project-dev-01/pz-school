<!-- Center modal content -->
<div class="modal fade addAbsentReason" id="addAbsentReasonModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddAbsentReasonModalLabel">{{ __('messages.add_absent_reason') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="absentReasonForm" method="post" action="{{ route('admin.absent_reason.add') }}" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ __('messages.reason_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('messages.enter_reason') }}">
                        <span class="text-danger error-text name_error"></span>
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