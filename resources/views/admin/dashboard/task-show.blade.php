<!-- Center modal content -->
<div class="modal fade showTasks" id="showTasksModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myshowTasksModalLabel" style="color: #6FC6CC">Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="card-box" style="background-color: #8adfee14;">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tr>
                                        <td>Title</td>
                                        <td id="taskShowTit"></td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td id="taskShowDesc"></td>
                                        <td><input type="hidden" id="calendorID" value=""></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.start_date') }}</td>
                                        <td id="startDateDetails"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.end_date') }}</td>
                                        <td id="endDateDetails"></td>
                                    </tr>
                                </table>
                            </div>
                            <br>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary" id="editEventBtn" type="button">
                                    Edit
                                </button>
                                <button class="btn btn-danger" id="deleteEventBtn" type="button">
                                    Delete
                                </button>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->