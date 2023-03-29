<!-- Center modal content -->
<div class="modal fade addAssignTeachernModal" id="addAssignTeachernModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddAssignTeachernModalLabel">{{ __('messages.add_assign_teacher') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="addAssignTeacherForm" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="changeClassName">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                        <select class="form-control add_class_name" id="changeClassName" name="class_name">
                            <option value="">Choose Grade</option>
                            @forelse($classDetails as $class)
                            <option value="{{$class['id']}}">{{$class['name']}}</option>
                            @empty
                            @endforelse

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sectionID">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="sectionID" name="section_name">
                            <option value="">Choose Class</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="assignClassTeacher">{{ __('messages.grade_teacher') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="assignClassTeacher" name="class_teacher">
                            <option value="">Choose Grade Teacher</option>
                            @forelse($getAllTeacherList as $teacher)
                            <option value="{{ $teacher['user_id'] }}">{{$teacher['name']}}</option>
                            @empty
                            @endforelse
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subjectType">{{ __('messages.type') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="subjectType" name="type">
                            <option value="0">Main</option>
                            <option value="2">Sub</option>
                            <option value="3">Alternative</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.submit') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->