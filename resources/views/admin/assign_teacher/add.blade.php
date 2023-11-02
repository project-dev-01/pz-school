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
                        <label for="gender">Department<span class="text-danger">*</span></label>
                        <select id="gender" name="gender" class="form-control">
                            <option value="">Select Department</option>
                            <option value="Primary">Primary</option>
                            <option value="Secondary">Secondary</option>
                            <option value="Kindergarden">Kindergarden</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="changeClassName">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                        <select class="form-control add_class_name" id="changeClassName" name="class_name">
                            <option value="">{{ __('messages.choose_grade') }}</option>
                            @forelse($classDetails as $class)
                            <option value="{{$class['id']}}">{{$class['name']}}</option>
                            @empty
                            @endforelse

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sectionID">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="sectionID" name="section_name">
                            <option value="">{{ __('messages.select_class') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="assignClassTeacher">{{ __('messages.grade_teacher') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="assignClassTeacher" name="class_teacher">
                            <option value="">{{ __('messages.select_grade_teacher') }}</option>
                            @forelse($getAllTeacherList as $teacher)
                            <option value="{{ $teacher['user_id'] }}">{{$teacher['name']}}</option>
                            @empty
                            @endforelse
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subjectType">{{ __('messages.type') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="subjectType" name="type">
                            <option value="0">{{ __('messages.main') }}</option>
                            <option value="2">Sub</option>
                            <option value="3">{{ __('messages.alternative') }}</option>
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