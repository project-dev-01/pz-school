<!-- Center modal content -->
<div class="modal fade addGrade" id="addGradeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddGradeModalLabel">{{ __('messages.add_grade') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="grade-form" method="post" action="{{ route('admin.grade.add') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="grade">{{ __('messages.grade_name') }}<span class="text-danger">*</span></label>
                        <input type="text" name="grade" class="form-control" placeholder="Enter Grade Name">
                    </div>
                    <div class="form-group">
                        <label for="grade_point">{{ __('messages.grade_point') }}<span class="text-danger">*</span></label>
                        <input type="text" name="grade_point" class="form-control" placeholder="{{ __('messages.enter_grade_point') }}">
                    </div>
                    <div class="form-group">
                        <label for="min_mark">{{ __('messages.minimum_percentage') }}<span class="text-danger">*</span></label>
                        <input type="text" name="min_mark" class="form-control" placeholder="{{ __('messages.enter_minimun_percentage') }}">
                    </div>
                    <div class="form-group">
                        <label for="max_mark">{{ __('messages.maximum_percentage') }}<span class="text-danger">*</span></label>
                        <input type="text" name="max_mark" class="form-control" placeholder="{{ __('messages.enter_maximum_percentage') }}">
                    </div>
                    <div class="form-group">
                        <label for="status">{{ __('messages.status') }}<span class="text-danger">*</span></label>
                        <select class="form-control" name="status">
                            <option value="Pass">{{ __('messages.pass') }}</option>
                            <option value="Fail">{{ __('messages.fail') }}</option>
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
                        <label for="notes">{{ __('messages.notes') }}</label>
                        <input type="text" name="notes" class="form-control" placeholder="{{ __('messages.enter_notes') }}">
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