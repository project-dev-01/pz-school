<!-- Center modal content -->
<div class="modal fade editHostelBlock" id="editHostelBlockModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditHostelBlockModalLabel">Edit Block</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-hostel-block-form" method="post" action="{{ route('admin.hostel_block.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">           
                    <div class="form-group">
                        <label for="block_name">Block Name<span class="text-danger">*</span></label>
                        <input type="text" id="block_name" name="block_name" class="form-control" placeholder="Enter Block Name ">
                        <span class="text-danger error-text block_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="block_warden">Block Warden<span class="text-danger">*</span></label>
                        <input type="text"  name="block_warden" class="form-control" placeholder="Enter Block Warden">
                        <span class="text-danger error-text block_warden_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="total_floor">Total Floor<span class="text-danger">*</span></label>
                        <input type="text"  name="total_floor" class="form-control" placeholder="Enter Total Floor">
                        <span class="text-danger error-text total_floor_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="block_leader">Block Leader</label>
                        <input type="text"  name="block_leader" class="form-control" placeholder="Enter Block Leader">
                        <span class="text-danger error-text block_leader_error"></span>
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