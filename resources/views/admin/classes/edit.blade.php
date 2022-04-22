<!-- Center modal content -->
<div class="modal fade editClassModal" id="editClassModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditClassModalLabel">Edit Class</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="classesUpdateForm" autocomplete="off">
                    @csrf
                    <input type="hidden" id="classID" name="class_id">
                    <div class="form-group">
                        <label for="name">Class Name</label>
                        <input type="text" id="editclassName" name="name" class="form-control" placeholder="Enter class name">
                    </div>
                    <div class="form-group">
                        <label for="name_numeric">Class Numeric</label>
                        <input type="text" id="editnameNumeric" name="name_numeric" class="form-control" placeholder="Enter class numeric">
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