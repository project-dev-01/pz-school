<!-- Center modal content -->
<div class="modal fade editTransportRoute" id="editTransportRouteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditTransportRouteModalLabel">Edit Route</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-transport-route-form" method="post" action="{{ route('admin.transport_route.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="name">{{ __('messages.route_name') }} <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter The Route Name">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="start_place">{{ __('messages.start_place') }}<span class="text-danger">*</span></label>
                        <input type="text" name="start_place" class="form-control" placeholder="Enter The Start Place">
                        <span class="text-danger error-text start_place_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="stop_place">{{ __('messages.stop_place') }}<span class="text-danger">*</span></label>
                        <input type="text" name="stop_place" class="form-control" placeholder="Enter The Stop Place">
                        <span class="text-danger error-text stop_place_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="remarks">{{ __('messages.remarks') }}</label>
                        <textarea type="text" name="remarks" class="form-control" placeholder="Enter Remarks"> </textarea>
                        <span class="text-danger error-text remarks_error"></span>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.update') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->