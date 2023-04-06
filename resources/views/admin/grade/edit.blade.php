<!-- Center modal content -->
<div class="modal fade editGrade" id="editGradeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditGradeModalLabel">Edit Grade</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-grade-form" method="post" action="{{ route('admin.grade.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="grade">{{ __('messages.grade_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="grade" name="grade" class="form-control" placeholder="{{ __('messages.enter_grade_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="grade_point">{{ __('messages.grade_point') }} <span class="text-danger">*</span></label>
                        <input type="text" id="grade_point" name="grade_point" class="form-control" placeholder="Enter Grade Point">
                    </div>
                    <div class="form-group">
                        <label for="min_mark">{{ __('messages.minimum_percentage') }}<span class="text-danger">*</span></label>
                        <input type="text" id="min_mark" name="min_mark" class="form-control" placeholder="Enter Minimun Percentage">
                    </div>
                    <div class="form-group">
                        <label for="max_mark">{{ __('messages.maximum_percentage') }}<span class="text-danger">*</span></label>
                        <input type="text" id="max_mark" name="max_mark" class="form-control" placeholder="Enter Maximum Percentage">
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
                            <option value="">Select Grade Category</option>
                            @forelse($grade_category as $gc)
                            <option value="{{$gc['id']}}">{{$gc['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="notes">{{ __('messages.notes') }}</label>
                        <input type="text" name="notes" class="form-control" placeholder="Enter Notes">
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