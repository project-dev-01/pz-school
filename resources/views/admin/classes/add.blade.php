<!-- Center modal content -->
<div class="modal fade addClassModal" id="addClassModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddClassModalLabel">Add Grade</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="classSubmit" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="name">Grade Name<span class="text-danger">*</span></label>
                        <input type="text" id="className" name="name" class="form-control" placeholder="Enter class name">
                    </div>
                    <div class="form-group">
                        <label for="name_numeric">Grade Numeric<span class="text-danger">*</span></label>
                        <input type="text" id="nameNumeric" name="name_numeric" class="form-control" placeholder="Enter class numeric">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->