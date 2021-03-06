<!-- Center modal content -->
<div class="modal fade addLeaveType" id="addLeaveTypeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddLeaveTypeModalLabel">Add Leave Type</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="leaveTypeForm" method="post" action="{{ route('admin.leave_type.add') }}" autocomplete="off">
                    @csrf                   
                 
                    <div class="form-group">
                        <label for="name">Leave Type Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Leave Type name">
                        <span class="text-danger error-text name_error"></span>
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