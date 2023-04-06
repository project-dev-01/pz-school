<!-- Center modal content -->
<div class="modal fade addHostelFloor" id="addHostelFloorModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddHostelFloorModalLabel">{{ __('messages.add_floor') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="hostelFloorForm" method="post" action="{{ route('admin.hostel_floor.add') }}" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label for="floor_name">{{ __('messages.floor_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="floor_name" name="floor_name" class="form-control" placeholder="{{ __('messages.enter_the_floor_name') }}">
                        <span class="text-danger error-text floor_name_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="block_id">{{ __('messages.block') }}</label>
                        <select class="form-control" name="block_id">
                            <option value="">{{ __('messages.Select_block') }}</option>
                            @foreach($block as $blo)
                            <option value="{{$blo['id']}}">{{$blo['block_name']}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text block_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="floor_warden">{{ __('messages.floor_warden') }}<span class="text-danger">*</span></label>
                        <select class="form-control select2-multiple" data-toggle="select2" name="floor_warden[]" multiple="multiple" data-placeholder="Choose ...">
                            <option value="">Select Warden</option>
                            @forelse($warden as $war)
                            <option value="{{$war['id']}}">{{$war['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                        <span class="text-danger error-text floor_warden_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="floor_leader">{{ __('messages.floor_leader') }}<span class="text-danger">*</span></label>
                        <select class="form-control select2-multiple" data-toggle="select2" name="floor_leader[]" multiple="multiple" data-placeholder="Choose ...">
                            <option value="">Select Leader</option>
                            @forelse($leader as $lead)
                            <option value="{{$lead['id']}}">{{$lead['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                        <span class="text-danger error-text floor_leader_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="total_room">{{ __('messages.total_room') }}<span class="text-danger">*</span></label>
                        <input type="text" name="total_room" class="form-control" placeholder="{{ __('messages.enter_the_total_room') }}">
                        <span class="text-danger error-text total_room_error"></span>
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