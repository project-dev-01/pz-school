<!-- Center modal content -->
<div class="modal fade timeTableAdd" id="timeTableAdd" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mytimeTableAddModallLabel">Add Time Table</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="eventTypeForm" method="post" action="" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="branch_id">Branch<span class="text-danger">*</span></label>
                        <select class="form-control" id="branch_id" name="branch_id">
                            <option value="">Select Branch</option>
                            <option value="">Malaysia</option>
                            <option value="press">Singapore</option>
                        </select>
                        <span class="text-danger error-text branch_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="title">Standard<span class="text-danger">*</span></label>
                        <select id="priority" class="form-control" required="">
                            <option value="selct">Select Standard</option>
                            <option>I</option>
                            <option>II</option>
                            <option>III</option>
                            <option>IV</option>
                            <option>V</option>
                            <option>VI</option>
                            <option>VII</option>
                            <option>VIII</option>
                            <option>IX</option>
                            <option>X</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">{{ __('messages.class_Name') }}<span class="text-danger">*</span></label>
                        <select id="priority" class="form-control" required="">
                            <option value="selct">Select Class Name</option>
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                            <option>D</option>
                            <option>E</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">{{ __('messages.teacher') }}<span class="text-danger">*</span></label>
                        <select id="priority" class="form-control" required="">
                            <option value="selct">Select Teacher</option>
                            <option>Smith</option>
                            <option>Taylor</option>
                            <option>David</option>
                            <option>Starc</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Weekday<span class="text-danger">*</span></label>
                        <input type="text" id="description" name="description" class="form-control" placeholder="Enter Description">
                        <span class="text-danger error-text description_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Start Time<span class="text-danger">*</span></label>
                        <input type="number" id="description" name="description" class="form-control" placeholder="Enter Description">
                        <span class="text-danger error-text description_error"></span>
                    </div><div class="form-group">
                        <label for="description">End Time<span class="text-danger">*</span></label>
                        <input type="number" id="description" name="description" class="form-control" placeholder="Enter Description">
                        <span class="text-danger error-text description_error"></span>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" id="eventTypeSubmit" class="btn btn-success waves-effect waves-light">{{ __('messages.submit') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->