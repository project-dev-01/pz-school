<!-- Center modal content -->
<div class="modal fade addAssignTeachernModal" id="addAssignTeachernModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddAssignTeachernModalLabel">{{ __('messages.assign_teacher') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="addAssignTeacherForm" method="post" action="{{ route('assign_teacher.add') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="class_name">{{ __('messages.class_Name') }}</label>
                        <select class="form-control" id="classNameFilter" name="class_name">
                            <option value="">{{ __('messages.select_class') }}</option>
                            @foreach($classDetails as $class)
                            <option value="{{$class->id}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text class_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="section_name">{{ __('messages.section_name') }}</label>
                        <select class="form-control" id="section_name" name="section_name">
                            <option value="">{{ __('messages.select_section') }}</option>
                        </select>
                        <span class="text-danger error-text section_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="class_teacher">{{ __('messages.class_teacher') }}</label>
                        <select class="form-control" id="class_teacher" name="class_teacher">
                            <option value="">{{ __('messages.select_teacher') }}</option>
                            @foreach($teacherDetails as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text class_teacher_error"></span>
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