<!-- Center modal content -->
<div class="modal fade addSubjectModal" id="addSubjectModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddSubjectModalLabel">Add Subject</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="addSubjectSubmit" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="name">Subject Name<span class="text-danger">*</span></label>
                        <input type="text" id="subjectName" name="name" class="form-control" placeholder="Enter subject name">
                    </div>
                    <div class="form-group">
                        <label for="short_name">Short Name<span class="text-danger">*</span></label>
                        <input type="text" id="shortName" name="short_name" class="form-control" placeholder="Enter short name">
                    </div>
                    <div class="form-group">
                        <label for="subject_code">Subject Code</label>
                        <input type="text" id="subjectCode" name="subject_code" class="form-control" placeholder="Enter subject code">
                    </div>
                    <div class="form-group">
                        <label for="subjectType">Subject Type 1</label>
                        <select class="form-control" id="subjectType" name="subject_type">
                            <option value="">Choose Subject type 1</option>
                            <option value="Optional">Optional</option>
                            <option value="Mandatory">Mandatory</option>
                            <option value="Task">Task</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subjectType">Subject Type 2</label>
                        <select class="form-control" id="subjectTypeTwo" name="subject_type_2">
                            <option value="">Choose Subject type 2</option>
                            <option value="Theory">Theory</option>
                            <option value="Practical">Practical</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subjectColor">Subject Color</label>
                        <input type="text" id="subjectColor" name="subject_color_calendor" class="form-control subjectColor" value="#4a81d4">
                    </div>
                    <div class="form-group">
                        <div class="checkbox checkbox-success form-check-inline">
                            <input type="checkbox" id="excludeExams" name="exam_exclude">
                            <label for="excludeExams"> Exclude From Exams </label>
                        </div>
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