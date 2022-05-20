<!-- Center modal content -->
<div class="modal fade addHostelRoom" id="addHostelRoomModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddHostelRoomModalLabel">Add Hostel Room</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="hostelRoomForm" method="post" action="{{ route('admin.hostel_room.add') }}" autocomplete="off">
                    @csrf                   
                 
                    <div class="form-group">
                        <label for="name">Room Number</label>
                        <input type="text"  name="name" class="form-control" placeholder="Enter Room Number">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="hostel">Hostel</label>
                        <select class="form-control" id="hostel" name="hostel_id">
                            <option value="">Select</option>
                            @foreach($hostel as $hos)
                            <option value="{{$hos['id']}}">{{$hos['name']}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text hostel_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="block">Block</label>
                        <input type="text"  name="block" class="form-control" placeholder="Enter Block">
                        <span class="text-danger error-text block_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="floor">Floor</label>
                        <input type="text"  name="floor" class="form-control" placeholder="Enter Floor">
                        <span class="text-danger error-text floor_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="no_of_beds">Capacity</label>
                        <input type="text"  name="no_of_beds" class="form-control" placeholder="Enter Capacity">
                        <span class="text-danger error-text no_of_beds_error"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="bed_fee">Cost Per Bed</label>
                        <input type="text"  name="bed_fee" class="form-control" placeholder="Enter Cost Per Bed">
                        <span class="text-danger error-text bed_fee_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="remarks">Remarks</label>
                        <textarea type="text"  name="remarks" class="form-control" placeholder="Enter Remarks"> </textarea>
                        <span class="text-danger error-text remarks_error"></span>
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