<!-- Center modal content -->
<div class="modal fade editAssClassSubjectModel" id="editAssClassSubjectModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditAssClassSubjectModelLabel">{{ __('messages.edit_assign_class_subject') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="updateAssignClassSubject" autocomplete="off">
                    @csrf
                    <input type="hidden" id="assign_class_sub_id" name="assign_class_sub_id">
                    <div class="form-group">
                        <label for="editchangeClassName">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                        <select class="form-control add_class_name" id="editchangeClassName" name="class_name">
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
                        <label for="assignSubjects">{{ __('messages.subject') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="assignSubjects" name="subject_id">
                            <option value="">{{ __('messages.select_subject') }}</option>
                            @forelse($getSubjectList as $sub)
                            <option value="{{ $sub['id'] }}">{{$sub['name']}}</option>
                            @empty
                            @endforelse
                        </select>
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