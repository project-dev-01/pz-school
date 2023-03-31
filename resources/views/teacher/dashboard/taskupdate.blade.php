<!-- Center modal content -->
<div class="modal fade updateTasksModal" id="updateTasksModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myupdateTasksModalLabel" style="color: #6FC6CC">Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" style="background-color: #8adfee14;">
                <form id="taskUpdate" autocomplete="off">
                    @csrf
                    <input type="hidden" id="calendorID" name="calendar_id" class="form-control">
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" id="taskTitle" name="title" class="form-control" placeholder="Enter title">
                        <span id="titleError" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="taskDescription" name="description" rows="3" class="form-control" placeholder="Enter description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="startEndDate">{{ __('messages.start_date') }}</label>
                        <p id="startDate"></p>
                    </div>
                    <div class="form-group">
                        <label for="endDate">{{ __('messages.end_date') }}</label>
                        <p id="endDate"></p>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="button" id="updateCalBtn" class="btn btn-success waves-effect waves-light">Update</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->