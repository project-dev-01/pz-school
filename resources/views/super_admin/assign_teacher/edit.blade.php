<!-- Center modal content -->
<div class="modal fade editAssignTeacherModal" id="editAssignTeacherModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditAssignTeacherModalLabel">Edit Assign Teacher</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="editAssignTeacherForm" method="post" action="{{ route('assign_teacher.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" id="assign_teacher_id" name="assign_teacher_id">
                    <div class="form-group">
                        <label for="branch_id">{{ __('messages.branch') }}<span class="text-danger">*</span></label>
                        <select id="edit_branch_id"  class="form-control" name="branch_id">
                            <option value="">Choose Branch</option>
                            @foreach($branches as $b)
                            <option value="{{$b['id']}}">{{$b['name']}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text branch_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="class_name">{{ __('messages.class_Name') }}</label>
                        <select class="form-control edit_class_name" id="class_name" name="class_name">
                            <option value="">Choose Class</option>
                            
                        </select>
                        <span class="text-danger error-text class_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="section_name">{{ __('messages.section_name') }}</label>
                        <select class="form-control" id="section_name" name="section_name">
                            <option value="">Choose Section</option>
                        </select>
                        <span class="text-danger error-text section_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="class_teacher">{{ __('messages.class_teacher') }}</label>
                        <select class="form-control" id="class_teacher" name="class_teacher">
                            <option value="">{{ __('messages.select_teacher') }}</option>
                            
                        </select>
                        <span class="text-danger error-text class_teacher_error"></span>
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