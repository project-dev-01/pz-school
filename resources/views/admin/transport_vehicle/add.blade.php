<!-- Center modal content -->
<div class="modal fade addTransportVehicle" id="addTransportVehicleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddTransportVehicleModalLabel">Add Vehicle</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="transportVehicleForm" method="post" action="{{ route('admin.transport_vehicle.add') }}" autocomplete="off">
                    @csrf                   
                 
                    <div class="form-group">
                        <label for="vehicle_no">{{ __('messages.vehicle_number') }}<span class="text-danger">*</span></label>
                        <input type="text" id="vehicle_no" name="vehicle_no" class="form-control" placeholder="Enter Vehicle Number">
                        <span class="text-danger error-text vehicle_no_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="capacity">{{ __('messages.capacity') }}<span class="text-danger">*</span></label>
                        <input type="text"  name="capacity" class="form-control" placeholder="Enter Capacity">
                        <span class="text-danger error-text capacity_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="insurance_renewal">Insurance Renewal<span class="text-danger">*</span></label>
                        <input type="text"  name="insurance_renewal" class="form-control" placeholder="Enter Insurance Renewal">
                        <span class="text-danger error-text insurance_renewal_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="driver_name">Driver Name<span class="text-danger">*</span></label>
                        <input type="text"  name="driver_name" class="form-control" placeholder="Enter Driver Name">
                        <span class="text-danger error-text driver_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="driver_phone">Driver Phone<span class="text-danger">*</span></label>
                        <input type="text"  name="driver_phone" class="form-control" placeholder="Enter Driver Phone">
                        <span class="text-danger error-text driver_phone_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="driver_license">Driver License No<span class="text-danger">*</span></label>
                        <input type="text"  name="driver_license" class="form-control" placeholder="Enter Driver License No">
                        <span class="text-danger error-text driver_license_error"></span>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit"  class="btn btn-success waves-effect waves-light">{{ __('messages.submit') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->