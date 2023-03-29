<!-- Center modal content -->
<div class="modal fade addqualify" id="addqualifyModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddqualifyModalLabel">{{ __('messages.add_qualification') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="addqualify" method="post"  action="{{ route('admin.qualification.add') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('messages.qualification') }}<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Qualificaiton">
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