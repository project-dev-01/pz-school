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
                            <option value="">Choose Branch</option>
                            <option value="">Cuddalore</option>
                            <option value="press">Singapore</option>
                        </select>
                        <span class="text-danger error-text branch_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="title">Class<span class="text-danger">*</span></label>
                        <select id="priority" class="form-control" required="">
                            <option value="selct">Select</option>
                            <option value="Low">First class</option>
                            <option value="Medium">First class</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Section<span class="text-danger">*</span></label>
                        <select id="priority" class="form-control" required="">
                            <option value="selct">Select</option>
                            <option value="Low">A</option>
                            <option value="Medium">B</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">Teacher<span class="text-danger">*</span></label>
                        <select id="priority" class="form-control" required="">
                            <option value="selct">Select</option>
                            <option value="Low">teacher 1</option>
                            <option value="Medium">teacher 2</option>
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
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" id="eventTypeSubmit" class="btn btn-success waves-effect waves-light">Submit</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->