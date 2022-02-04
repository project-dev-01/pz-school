<!-- Center modal content -->
<div class="modal fade addToDoTask" id="addToDoTask" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddToDoTaskModallLabel">Add To Do Task</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="eventTypeForm" method="post" action="" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="branch_id">Branch<span class="text-danger">*</span></label>
                        <select class="form-control" id="branch_id" name="branch_id">
                            <option value="">Choose Branch</option>
                            <option value="">Malaysia</option>
                            <option value="press">Singapore</option>
                        </select>
                        <span class="text-danger error-text branch_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="title">Title<span class="text-danger">*</span></label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title">
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="date">Date & Time<span class="text-danger">*</span></label>
                        <input type="text" id="date" name="date" class="form-control homeWorkAdd" placeholder="Enter Date & Time">
                        <span class="text-danger error-text date_error"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="priority">Priority<span class="text-danger">*</span></label>
                        <select id="priority" class="form-control" required="">
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                        <span class="text-danger error-text priority_error"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description<span class="text-danger">*</span></label>
                        <input type="text" id="description" name="description" class="form-control" placeholder="Enter Description">
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