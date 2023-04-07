<!-- Center modal content -->
<div class="modal fade addSubjectModal" id="addSubjectModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddSubjectModalLabel">{{ __('messages.add_subject') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="addSubjectSubmit" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('messages.subject_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="subjectName" name="name" class="form-control" placeholder="{{ __('messages.enter_subject_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="short_name">{{ __('messages.short_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="shortName" name="short_name" class="form-control" placeholder="{{ __('messages.enter_short_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="subject_code">{{ __('messages.subject_code') }}</label>
                        <input type="text" id="subjectCode" name="subject_code" class="form-control" placeholder="{{ __('messages.enter_subject_code') }}">
                    </div>
                    <div class="form-group">
                        <label for="subjectType">{{ __('messages.subject_type_1') }}</label>
                        <select class="form-control" id="subjectType" name="subject_type">
                            <option value="">{{ __('messages.select_subject_type_1') }}</option>
                            <option value="Optional">Optional</option>
                            <option value="Mandatory">Mandatory</option>
                            <option value="Task">Task</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subjectType">{{ __('messages.subject_type_2') }}</label>
                        <select class="form-control" id="subjectTypeTwo" name="subject_type_2">
                            <option value="">{{ __('messages.select_subject_type_2') }}</option>
                            <option value="Theory">Theory</option>
                            <option value="Practical">Practical</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="times_per_week">{{ __('messages.minimum_times_per_week') }}</label>
                        <input type="number" id="times_per_week" name="times_per_week" class="form-control times_per_week">
                    </div>
                    <div class="form-group">
                        <label for="subjectColor">{{ __('messages.subject_colour') }}</label>
                        <input type="text" id="subjectColor" name="subject_color_calendor" class="form-control subjectColor" value="#4a81d4">
                    </div>
                    <div class="form-group">
                        <div class="checkbox checkbox-success form-check-inline">
                            <input type="checkbox" id="excludeExams" name="exam_exclude">
                            <label for="excludeExams">{{ __('messages.exclude_from_exams') }}</label>
                        </div>
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