<!-- Modal Structure -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: #6FC6CC">{{ __('messages.comments') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card-box eventpopup">
                    <div class="table-responsive">
                        
                        <table class="table dt-responsive nowrap w-100 dataTable no-footer" id="commentTable">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>{{ __('messages.Message') }}</th>
                                <th>{{ __('messages.register_time') }}</th>
                                <th>{{ __('messages.register') }}</th>
                                <th>{{ __('messages.updated') }}</th>
                                <th>{{ __('messages.updated_time') }}</th>
                                <th>{{ __('messages.action') }}</th>                    
                                    </tr>
                                </thead>
                               
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                <button type="button" class="btn btn-primary-bl waves-effect waves-light saveStudentRemarksBtn">{{ __('messages.save') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
