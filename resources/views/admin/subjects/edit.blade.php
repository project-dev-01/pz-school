<!-- Center modal content -->
<div class="modal fade editSubjectModel" id="editSubjectModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditSubjectModelLabel">Edit Class</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="subjectUpdateForm" autocomplete="off">
                    @csrf
                    <input type="hidden" id="editsubjectID" name="id">
                    <div class="form-group">
                        <label for="name">Subject Name<span class="text-danger">*</span></label>
                        <input type="text" id="editsubjectName" name="name" class="form-control" placeholder="Enter subject name">
                    </div>
                    <div class="form-group">
                        <label for="short_name">Short Name<span class="text-danger">*</span></label>
                        <input type="text" id="editshortName" name="short_name" class="form-control" placeholder="Enter short name">
                    </div>
                    <div class="form-group">
                        <label for="subject_code">Subject Code</label>
                        <input type="text" id="editsubjectCode" name="subject_code" class="form-control" placeholder="Enter subject code">
                    </div>
                    <div class="form-group">
                        <label for="subject_author">Subject Author</label>
                        <input type="text" id="editsubjectAuthor" name="subject_author" class="form-control" placeholder="Enter subject author">
                    </div>
                    <div class="form-group">
                        <label for="subjectType">Subject Type</label>
                        <select class="form-control" id="editsubjectType" name="subject_type">
                            <option value="">Choose Subject type</option>
                            <option value="Theory">Theory</option>
                            <option value="Practical">Practical</option>
                            <option value="Optional">Optional</option>
                            <option value="Mandatory">Mandatory</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subjectColor">Subject Color</label>
                        <select class="form-control" id="editsubjectColor" name="subject_color_calendor" placeholder="Enter subject color">
                            <option value="bg-primary">primary</option>
                            <option value="bg-secondary">secondary</option>
                            <option value="bg-success">success</option>
                            <option value="bg-danger">danger</option>
                            <option value="bg-warning">warning</option>
                            <option value="bg-info">info</option>
                        </select>
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