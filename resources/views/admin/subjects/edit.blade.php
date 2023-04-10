<!-- Center modal content -->
<div class="modal fade editSubjectModel" id="editSubjectModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditSubjectModelLabel">{{ __('messages.edit_subject') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="subjectUpdateForm" autocomplete="off">
                    @csrf
                    <input type="hidden" id="editsubjectID" name="id">
                    <div class="form-group">
                        <label for="name">{{ __('messages.subject_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="editsubjectName" name="name" class="form-control" placeholder="{{ __('messages.enter_subject_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="short_name">{{ __('messages.short_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="editshortName" name="short_name" class="form-control" placeholder="{{ __('messages.enter_short_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="subject_code">{{ __('messages.subject_code') }}</label>
                        <input type="text" id="editsubjectCode" name="subject_code" class="form-control" placeholder="{{ __('messages.enter_subject_code') }}">
                    </div>
                    <div class="form-group">
                        <label for="subjectType">{{ __('messages.subject_type_1') }}</label>
                        <select class="form-control" id="editsubjectType" name="subject_type">
                            <option value="">{{ __('messages.select_subject_type_1') }}</option>
                            <option value="Optional">Optional</option>
                            <option value="Mandatory">Mandatory</option>
                            <option value="Task">Task</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subjectType">{{ __('messages.subject_type_2') }}</label>
                        <select class="form-control" id="editsubjectTypeTwo" name="subject_type_2">
                            <option value="">{{ __('messages.select_subject_type_2') }}</option>
                            <option value="Theory">Theory</option>
                            <option value="Practical">Practical</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_times_per_week">{{ __('messages.minimum_times_per_week') }}</label>
                        <input type="number" id="edit_times_per_week" name="times_per_week" class="form-control times_per_week">
                    </div>
                    <div class="form-group">
                        <label for="editsubjectColor">{{ __('messages.subject_color') }}</label>
                        <input type="text" id="editsubjectColor" name="subject_color_calendor" placeholder="Select Color" class="form-control subjectColor">
                    </div>
                    <div class="form-group">
                        <div class="checkbox checkbox-success form-check-inline">
                            <input type="checkbox" id="editexcludeExams" name="exam_exclude">
                            <label for="excludeExams"> {{ __('messages.exclude_from_exams') }} </label>
                        </div>
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