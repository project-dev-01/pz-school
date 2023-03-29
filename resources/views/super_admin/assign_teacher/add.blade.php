<!-- Center modal content -->
<div class="modal fade addAssignTeachernModal" id="addAssignTeachernModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddAssignTeachernModalLabel">Add Assign Teacher</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="addAssignTeacherForm" method="post" action="{{ route('assign_teacher.add') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="branch_id">Branch<span class="text-danger">*</span></label>
                        <select id="add_branch_id"  class="form-control" name="branch_id">
                            <option value="">Choose Branch</option>
                            <option value="">Malaysia</option>
                            <option value="">Singapore</option>
                        </select>
                        <span class="text-danger error-text branch_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="class_name">Standard</label>
                        <select class="form-control add_class_name" id="class_name" name="class_name">
                            <option value="">Select</option>
                            <option>I</option>
                            <option>II</option>
                            <option>III</option>
                            <option>IV</option>
                            <option>V</option>
                            <option>VI</option>
                            <option>VII</option>
                            <option>VIII</option>
                            <option>IX</option>
                            <option>X</option>
                            
                        </select>
                        <span class="text-danger error-text class_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="section_name">{{ __('messages.class') }}</label>
                        <select class="form-control" id="section_name" name="section_name">
                            <option value="">Select</option>
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                            <option>D</option>
                            <option>E</option>
                        </select>
                        <span class="text-danger error-text section_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="class_teacher">Class Teacher</label>
                        <select class="form-control" id="class_teacher" name="class_teacher">
                            <option value="">Choose Teacher</option>
                            <option>Taylor</option>
                            <option>Smith</option>
                            <option>David</option>
                            <option>Cameron</option>
                            <option>Starc</option>
                            
                        </select>
                        <span class="text-danger error-text class_teacher_error"></span>
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