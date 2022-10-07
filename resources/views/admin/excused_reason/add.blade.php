<!-- Center modal content -->
<div class="modal fade addExcusedReason" id="addExcusedReasonModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddExcusedReasonModalLabel">Add Absent Reason</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="excusedReasonForm" method="post" action="{{ route('admin.excused_reason.add') }}" autocomplete="off">
                    @csrf                   
                 
                    <div class="form-group">
                        <label for="name">Reason Name<span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Reason name">
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