<!-- Center modal content -->
<div class="modal fade editTransportStoppage" id="editTransportStoppageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditTransportStoppageModalLabel">Edit Stoppage</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-transport-stoppage-form" method="post" action="{{ route('admin.transport_stoppage.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">           
                    <div class="form-group">
                        <label for="stop_position">Stop Position<span class="text-danger">*</span></label>
                        <input type="text" id="stop_position" name="stop_position" class="form-control" placeholder="Enter Stop Position ">
                        <span class="text-danger error-text stop_position_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="stop_time">Stop Time<span class="text-danger">*</span></label>
                        <input type="time"  name="stop_time" class="form-control" placeholder="Enter Stop Time">
                        <span class="text-danger error-text stop_time_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="route_fare">Route Fare<span class="text-danger">*</span></label>
                        <input type="text"  name="route_fare" class="form-control" placeholder="Enter Route Fare">
                        <span class="text-danger error-text route_fare_error"></span>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->