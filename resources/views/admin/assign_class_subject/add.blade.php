<!-- Center modal content -->
<div class="modal fade addAssignClassSubjectModal" id="addAssignClassSubjectModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddAssignClassSubjectModalLabel">{{ __('messages.add_subjects') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="addAssignClassSubject" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="addchangeClassName">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                        <select class="form-control add_class_name" id="addchangeClassName" name="class_name">
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
                        <label for="assignSubjects">{{ __('messages.subject') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="assignSubjects" name="subject_id">
                            <option value="">Choose Subject</option>
                            @forelse($getSubjectList as $sub)
                            <option value="{{ $sub['id'] }}">{{$sub['name']}}</option>
                            @empty
                            @endforelse
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