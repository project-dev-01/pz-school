<!-- Center modal content -->
<div class="modal fade addTransportAssign" id="addTransportAssignModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddTransportAssignModalLabel">{{ __('messages.add_assign') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="transportAssignForm" method="post" action="{{ route('admin.transport_assign.add') }}" autocomplete="off">
                    @csrf                   
                 
                    <div class="form-group">
                        <label for="route_id">{{ __('messages.route') }}<span class="text-danger">*</span></label>
                        <select class="form-control" name="route_id">
                            <option value="">Select Route</option>
                            @forelse($route as $rou)
                            <option value="{{$rou['id']}}">{{ $rou['name'] }}</option>
                            @empty
                            @endforelse
                        </select>
                        <span class="text-danger error-text stop_position_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="stoppage_id">{{ __('messages.stoppage') }}<span class="text-danger">*</span></label>
                        <select class="form-control" name="stoppage_id">
                            <option value="">Select Stoppage</option>
                            @forelse($stoppage as $stop)
                            <option value="{{$stop['id']}}">{{ $stop['stop_position'] }}</option>
                            @empty
                            @endforelse
                        </select>
                        <span class="text-danger error-text stoppage_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="vehicle_id">{{ __('messages.vehicle') }}<span class="text-danger">*</span></label>
                        <select class="form-control" name="vehicle_id">
                            <option value="">Select Vehicle</option>
                            @forelse($vehicle as $veh)
                            <option value="{{$veh['id']}}">{{ $veh['vehicle_no'] }}</option>
                            @empty
                            @endforelse
                        </select>
                        <span class="text-danger error-text vehicle_id_error"></span>
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