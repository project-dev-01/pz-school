<!-- Center modal content -->
<div class="modal fade addDesignation" id="addDesignationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddDesignationModalLabel">{{ __('messages.add_designation') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="designation-form" method="post" action="{{ route('admin.designation.add') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('messages.designation_name') }}<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="{{ __('messages.enter_designation_name') }}">
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