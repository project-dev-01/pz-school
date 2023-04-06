<!-- Center modal content -->
<div class="modal fade editClass" id="editClassModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditClassModalLabel">Edit Class</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="classesUpdateForm" method="post" action="{{ route('class.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="class_id">
                    <div class="form-group">
                        <label for="name">{{ __('messages.branch_name') }}<span class="text-danger">*</span></label>
                        <select id="branch_id" class="form-control" name="branch_id">
                            <option value="">Select Branch</option>
                            @foreach($branches as $b)
                            <option value="{{$b['id']}}">{{$b['name']}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text branch_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('messages.name') }}</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter name">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="name_numeric">Class Numeric</label>
                        <input type="text" id="name_numeric" name="name_numeric" class="form-control" placeholder="Enter class numeric">
                        <span class="text-danger error-text name_numeric_error"></span>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" id="classEditSubmit" class="btn btn-success waves-effect waves-light">{{ __('messages.update') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->