<!-- Center modal content -->
<div class="modal fade editShortcut" id="editBankModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditBankModalLabel">{{ __('messages.edit_shortcut') }}</h4>
                <button type="button" class="close editClose" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-shortcut-form" method="post" action="{{ route('admin.shortcut_link.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="name">{{ __('messages.title') }}<span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('messages.sidebar_name') }}">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="country">{{ __('messages.link') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="link"  id="link" placeholder="{{ __('messages.link') }}">
                        <span class="text-danger error-text link_error"></span>
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