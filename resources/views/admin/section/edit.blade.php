<!-- Center modal content -->
<div class="modal fade editSection" id="editSectionModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditSectionModalLabel">Edit Class</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="sectionEditForm" autocomplete="off">
                    @csrf
                    <input type="hidden" name="sid" id="sectionID">
                    <div class="form-group">
                        <label for="name">{{ __('messages.name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="editsectionName" name="name" class="form-control" placeholder="{{ __('messages.enter_name') }}">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" id="sectionEditSubmit" class="btn btn-success waves-effect waves-light">{{ __('messages.update') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->