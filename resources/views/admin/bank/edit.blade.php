<!-- Center modal content -->
<div class="modal fade editBank" id="editBankModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditBankModalLabel">{{ __('messages.edit_bank') }}</h4>
                <button type="button" class="close editClose" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-bank-form" method="post" action="{{ route('admin.bank.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="name">{{ __('messages.bank_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('messages.enter_bank_name') }}">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="country">{{ __('messages.country') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="country"  id="edit_country" placeholder="{{ __('messages.country') }}">
                        <span class="text-danger error-text country_error"></span>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light editClose" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.update') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->