<!-- Center modal content -->
<div class="modal fade addShortcut" id="addShortCutModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddBankModalLabel">{{ __('messages.add_shortcut_link') }}</h4>
                <button type="button" class="close addClose" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="shortcutLinkForm" method="post" action="{{ route('staff.shortcut_link.add') }}" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ __('messages.title') }}<span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('messages.enter_sidebar_name') }}">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="country">{{ __('messages.link') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="link"  id="link" placeholder="{{ __('messages.enter_link') }}">
                        <span class="text-danger error-text link_error"></span>
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