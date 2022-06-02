<!-- Center modal content -->
<div class="modal fade editAssClassSubjectModel" id="editAssClassSubjectModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditAssClassSubjectModelLabel">Edit Assign Subject Teacher</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="updateAssignClassSubject" autocomplete="off">
                    @csrf
                    <input type="hidden" id="assign_class_sub_id" name="assign_class_sub_id">
                    <div class="form-group">
                        <label for="editchangeClassName">Class Name<span class="text-danger">*</span></label>
                        <select class="form-control add_class_name" id="editchangeClassName" name="class_name">
                            <option value="">Choose Class</option>
                            @forelse($classDetails as $class)
                            <option value="{{$class['id']}}">{{$class['name']}}</option>
                            @empty
                            @endforelse

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sectionID">Section Name<span class="text-danger">*</span></label>
                        <select class="form-control editsectionID" id="sectionID" name="section_name">
                            <option value="">Choose Section</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="assignSubjects">Subjects<span class="text-danger">*</span></label>
                        <select class="form-control" id="assignSubjects" name="subject_id">
                            <option value="">Choose Subject</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="assignClassTeacher">Class Teacher<span class="text-danger">*</span></label>
                        <select class="form-control" id="assignClassTeacher" name="class_teacher">
                            <option value="">Choose Teacher</option>
                            @forelse($getAllTeacherList as $teacher)
                            <option value="{{ $teacher['id'] }}">{{$teacher['name']}} ({{$teacher['role_name']}})</option>
                            @empty
                            @endforelse

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editsubjectType">Type<span class="text-danger">*</span></label>
                        <select class="form-control" id="editsubjectType" name="type">
                            <option value="0">Main</option>
                            <option value="1">Alternative</option>
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