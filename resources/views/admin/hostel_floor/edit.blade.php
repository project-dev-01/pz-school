<!-- Center modal content -->
<div class="modal fade editHostelFloor" id="editHostelFloorModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditHostelFloorModalLabel">Edit Floor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-hostel-floor-form" method="post" action="{{ route('admin.hostel_floor.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">    
                    <div class="form-group">
                        <label for="floor_name">Floor Name<span class="text-danger">*</span></label>
                        <input type="text" id="floor_name" name="floor_name" class="form-control" placeholder="Enter Floor Name ">
                        <span class="text-danger error-text floor_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="block_id">Block<span class="text-danger">*</span></label>
                        <input type="text"  name="block_id" class="form-control" placeholder="Enter Block">
                        <span class="text-danger error-text block_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="floor_warden">Floor Warden<span class="text-danger">*</span></label>
                        <input type="text"  name="floor_warden" class="form-control" placeholder="Enter Floor Warden">
                        <span class="text-danger error-text floor_warden_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="floor_leader">Floor Leader</label>
                        <input type="text"  name="floor_leader" class="form-control" placeholder="Enter Floor Leader">
                        <span class="text-danger error-text floor_leader_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="total_room">Total Room<span class="text-danger">*</span></label>
                        <input type="text"  name="total_room" class="form-control" placeholder="Enter Total Room">
                        <span class="text-danger error-text total_room_error"></span>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->