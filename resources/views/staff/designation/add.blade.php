<!-- Center modal content -->
<div class="modal fade addDesignation" id="addDesignationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddDesignationModalLabel">Add Designation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="designationForm" method="post" action="#" autocomplete="off">
                    @csrf
                    
                    <div class="form-group">
                        <label for="branch_name">Branch Name</label>
                        <select class="form-control" id="branch_name" name="branch_name">
                            <option value="">Choose Branch</option>
                        </select>
                        <span class="text-danger error-text branch_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="designation_name">Designation Name</label>
                        <input type="text" id="designation_name" name="designation_name" class="form-control" placeholder="Enter Designation name">
                        <span class="text-danger error-text designation_name_error"></span>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="button" id="sectionSubmit" class="btn btn-success waves-effect waves-light">Submit</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->