<!-- Center modal content -->
<div class="modal fade editClassModal" id="editClassModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditClassModalLabel">Edit Grade</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="classesUpdateForm" autocomplete="off">
                    @csrf
                    <input type="hidden" id="classID" name="class_id">
                    <div class="form-group">
                        <label for="name">{{ __('messages.grade_name') }}</label>
                        <input type="text" id="editclassName" name="name" class="form-control" placeholder="Enter Grade Name">
                    </div>
                    <div class="form-group">
                        <label for="name_numeric">{{ __('messages.grade_numeric') }}</label>
                        <input type="text" id="editnameNumeric" name="name_numeric" class="form-control" placeholder="Enter Grade Numeric">
                    </div>
                    <div class="form-group">
                        <label for="short_name">{{ __('messages.short_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="edit_short_name" name="short_name" class="form-control" placeholder="Enter Short Name">
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