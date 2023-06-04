<!-- Center modal content -->
<div class="modal fade addHostelRoom" id="addHostelRoomModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddHostelRoomModalLabel">{{ __('messages.add_hostel_room') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="hostelRoomForm" method="post" action="{{ route('admin.hostel_room.add') }}" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ __('messages.room_number') }}<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="{{ __('messages.enter_the_room_number') }}">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="hostel">{{ __('messages.hostel') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="hostel" name="hostel_id">
                            <option value="">{{ __('messages.select_the_hostel') }}</option>
                            @forelse($hostel as $hos)
                            <option value="{{$hos['id']}}">{{$hos['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                        <span class="text-danger error-text hostel_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="block">{{ __('messages.select_block') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="block" name="block">
                            <option value="">{{ __('messages.select_the_block') }}</option>
                            @forelse($block as $blo)
                            <option value="{{$blo['id']}}">{{$blo['block_name']}}</option>
                            @empty
                            @endforelse
                        </select>
                        <span class="text-danger error-text block_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="floor">{{ __('messages.floor') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="floor" name="floor">
                            <option value="">{{ __('messages.select_the_floor') }}</option>
                        </select>
                        <span class="text-danger error-text floor_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="no_of_beds">{{ __('messages.capacity') }}<span class="text-danger">*</span></label>
                        <input type="text" name="no_of_beds" class="form-control" placeholder="{{ __('messages.enter_the_capacity') }}">
                        <span class="text-danger error-text no_of_beds_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="bed_fee">{{ __('messages.cost_per_bed') }}<span class="text-danger">*</span></label>
                        <input type="text" name="bed_fee" class="form-control" placeholder="{{ __('messages.enter_the_cost_per_bed') }}">
                        <span class="text-danger error-text bed_fee_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="remarks">{{ __('messages.remarks') }}</label>
                        <textarea type="text" name="remarks" class="form-control" placeholder="{{ __('messages.enter_the_remarks') }}"> </textarea>
                        <span class="text-danger error-text remarks_error"></span>
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