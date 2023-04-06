<!-- Center modal content -->
<div class="modal fade editTransportVehicle" id="editTransportVehicleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditTransportVehicleModalLabel">Edit Vehicle</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-transport-vehicle-form" method="post" action="{{ route('admin.transport_vehicle.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">           
                    <div class="form-group">
                        <label for="vehicle_no">{{ __('messages.vehicle_number') }}<span class="text-danger">*</span></label>
                        <input type="text" id="vehicle_no" name="vehicle_no" class="form-control" placeholder="{{ __('messages.enter_vehicle_number') }}">
                        <span class="text-danger error-text vehicle_no_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="capacity">{{ __('messages.capacity') }}<span class="text-danger">*</span></label>
                        <input type="text"  name="capacity" class="form-control" placeholder="{{ __('messages.enter_capacity') }}">
                        <span class="text-danger error-text capacity_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="insurance_renewal">{{ __('messages.insurance_renewal') }}<span class="text-danger">*</span></label>
                        <input type="text"  name="insurance_renewal" class="form-control" placeholder="{{ __('messages.enter_insurance_renewal') }}">
                        <span class="text-danger error-text insurance_renewal_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="driver_name">{{ __('messages.driver_name') }}<span class="text-danger">*</span></label>
                        <input type="text"  name="driver_name" class="form-control" placeholder="{{ __('messages.enter_driver_name') }}">
                        <span class="text-danger error-text driver_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="driver_phone">{{ __('messages.driver_phone') }}<span class="text-danger">*</span></label>
                        <input type="text"  name="driver_phone" class="form-control" placeholder="{{ __('messages.enter_driver_phone') }}">
                        <span class="text-danger error-text driver_phone_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="driver_license">{{ __('messages.driver_license_no') }}<span class="text-danger">*</span></label>
                        <input type="text"  name="driver_license" class="form-control" placeholder="{{ __('messages.enter_driver_license_no') }}">
                        <span class="text-danger error-text driver_license_error"></span>
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