<!-- Center modal content -->
<div class="modal fade addExamPaper" id="addExamPaperModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddExamPaperModalLabel">{{ __('messages.add') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="exam-paper-form" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="changeClassName">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                        <select class="form-control add_class_name" id="changeClassName" name="class_id">
                            <option value="">{{ __('messages.choose_grade') }}</option>
                            @forelse($classDetails as $class)
                            <option value="{{$class['id']}}">{{$class['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subjectID">{{ __('messages.subject') }}<span class="text-danger">*</span></label>
                        <select id="subjectID" class="form-control" name="subject_id">
                            <option value="">Select Subject</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="paper_name"> {{ __('messages.paper_name') }}<span class="text-danger">*</span></label>
                        <input type="text" name="paper_name" class="form-control" placeholder="{{ __('messages.enter_paper_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="paper_type">{{ __('messages.paper_type') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="paper_type" name="paper_type">
                            <option value="">{{ __('messages.select_paper_type') }}</option>
                            @forelse($get_paper_type as $gpt)
                            <option value="{{$gpt['id']}}">{{$gpt['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="grade_category">{{ __('messages.grade_category') }}<span class="text-danger">*</span></label>
                        <select class="form-control" name="grade_category">
                            <option value="">{{ __('messages.select_grade_category') }}</option>
                            @forelse($grade_category as $gc)
                            <option value="{{$gc['id']}}">{{$gc['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject_weightage">{{ __('messages.subject_weightage') }}</label>
                        <input type="number" name="subject_weightage" class="form-control" placeholder="{{ __('messages.enter_subject_weightage') }}">
                    </div>
                    <div class="form-group">
                        <label for="notes">{{ __('messages.notes') }}</label>
                        <textarea name="notes" class="form-control" maxlength="255" placeholder="{{ __('messages.enter_notes') }}"></textarea>
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