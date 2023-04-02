<!-- Center modal content -->
<div class="modal fade editHostelRoom" id="editHostelRoomModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditHostelRoomModalLabel">Edit Hostel Room</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-hostel-room-form" method="post" action="{{ route('admin.hostel_room.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="name">{{ __('messages.room_number') }}</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter The Room Number">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="hostel">{{ __('messages.hostel') }}</label>
                        <select class="form-control" id="hostel" name="hostel_id">
                            <option value="">Select The Hostel</option>
                            @foreach($hostel as $hos)
                            <option value="{{$hos['id']}}">{{$hos['name']}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text hostel_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="block">{{ __('messages.select_block') }}</label>
                        <select class="form-control" id="edit_block" name="block">
                            <option value="">Select The Block</option>
                            @foreach($block as $blo)
                            <option value="{{$blo['id']}}">{{$blo['block_name']}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text block_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="floor">{{ __('messages.floor') }}</label>
                        <select class="form-control" id="edit_floor" name="floor">
                            <option value="">Select The Floor</option>
                        </select>
                        <span class="text-danger error-text floor_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="no_of_beds">{{ __('messages.capacity') }}</label>
                        <input type="text" name="no_of_beds" class="form-control" placeholder="Enter The Capacity">
                        <span class="text-danger error-text no_of_beds_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="bed_fee">{{ __('messages.cost_per_bed') }}</label>
                        <input type="text" name="bed_fee" class="form-control" placeholder="Enter The Cost Per Bed">
                        <span class="text-danger error-text bed_fee_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="remarks">{{ __('messages.remarks') }}</label>
                        <textarea type="text" name="remarks" class="form-control" placeholder="Enter The Remarks"> </textarea>
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