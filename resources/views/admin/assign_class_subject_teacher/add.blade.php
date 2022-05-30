<!-- Center modal content -->
<div class="modal fade addAssignClassSubjectModal" id="addAssignClassSubjectModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddAssignClassSubjectModalLabel">Add Subject Teacher</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="addAssignClassSubject" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="changeClassName">Class Name<span class="text-danger">*</span></label>
                        <select class="form-control add_class_name" id="changeClassName" name="class_name">
                            <option value="">Choose Class</option>
                            @forelse($classDetails as $class)
                            <option value="{{$class['id']}}">{{$class['name']}}</option>
                            @empty
                            @endforelse

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sectionID">Section Name<span class="text-danger">*</span></label>
                        <select class="form-control" id="sectionID" name="section_name">
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
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->