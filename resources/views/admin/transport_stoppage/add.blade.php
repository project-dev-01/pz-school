<!-- Center modal content -->
<div class="modal fade addTransportStoppage" id="addTransportStoppageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddTransportStoppageModalLabel">{{ __('messages.add_stoppage') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="transportStoppageForm" method="post" action="{{ route('admin.transport_stoppage.add') }}" autocomplete="off">
                    @csrf                   
                 
                    <div class="form-group">
                        <label for="stop_position">{{ __('messages.stop_position') }}<span class="text-danger">*</span></label>
                        <input type="text" id="stop_position" name="stop_position" class="form-control" placeholder="Enter Stop Position ">
                        <span class="text-danger error-text stop_position_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="stop_time">{{ __('messages.stop_time') }}<span class="text-danger">*</span></label>
                        <input type="time"  name="stop_time" class="form-control" placeholder="Enter Stop Time">
                        <span class="text-danger error-text stop_time_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="route_fare">{{ __('messages.route_fare') }}<span class="text-danger">*</span></label>
                        <input type="text"  name="route_fare" class="form-control" placeholder="Enter Route Fare">
                        <span class="text-danger error-text route_fare_error"></span>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-success waves-effect waves-light">Submit</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->