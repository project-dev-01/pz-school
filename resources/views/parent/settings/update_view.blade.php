<div class="modal fade DetailsModal" id="updateViewModal" tabindex="-1" role="dialog" aria-labelledby="DetailsModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DetailsModalTitle">{{ __('messages.update_view') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive mt-md mb-md">
                    <table class="table table-centered table-striped table-bordered table-condensed mb-none">
                        <thead>
                            <tr>
                                <th width="20%">{{ __('messages.field_name') }}</th>
                                <th width="20%">{{ __('messages.old_value') }}</th>
                                <th width="20%">{{ __('messages.new_value') }}</th>
                                <th width="20%">{{ __('messages.status') }}</th>
                                <th width="20%">{{ __('messages.remarks') }}</th>
                            </tr>
                        </thead>
                    
                        <tbody id="parent_update_view_body">
                            
                        </tbody>
                    </table>
              <div class="col-6">
                        <div class="form-group">
                            <label for="remarks">{{ __('messages.remarks') }}</label>
                            <textarea maxlength="255" id="remarks" class="form-control alloptions" placeholder="{{ __('messages.enter_the_remarks') }}" name="txtarea_prev_remarks" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                            </textarea>
                        </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.close') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->