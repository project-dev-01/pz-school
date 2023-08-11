<!-- Center modal content -->
<div class="modal fade addBank" id="addBankModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddBankModalLabel">{{ __('messages.add_bank') }}</h4>
                <button type="button" class="close addClose" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="bankForm" method="post" action="{{ route('admin.bank.add') }}" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ __('messages.bank_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('messages.enter_bank_name') }}">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="country">{{ __('messages.country') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="country"  id="country" placeholder="{{ __('messages.country') }}">
                        <span class="text-danger error-text country_error"></span>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light addClose" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.submit') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->