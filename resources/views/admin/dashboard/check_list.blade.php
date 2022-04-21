<!-- Right modal content -->
<div id="right-modal-dashboard" class="modal fade toDoListModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-center">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <!-- <div class="text-center">
                    <h4 class="mt-0">Text in a modal</h4>
                    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div> -->
                <!-- <div class="text-center"> -->
                <div class="row">
                    <div class="col">
                        <div class="custom-control custom-checkbox float-left">
                            <input type="checkbox" checked class="custom-control-input" id="completedCheck">
                            <label class="custom-control-label" for="completedCheck">
                                Mark as completed
                            </label>
                        </div> <!-- end custom-checkbox-->
                        <div class="clearfix"></div>

                        <hr class="my-2" />
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h4 id="dashTitle"></h4>

                        <div class="row">
                            <div class="col-6">
                                <!-- assignee -->
                                <p class="mt-2 mb-1 text-muted">Assigned To</p>
                                <div class="media">
                                    <!-- <img src="../assets/images/users/user-9.jpg" alt="Arya S" class="rounded-circle mr-2" height="24" /> -->
                                    <div class="media-body">
                                        <h5 class="mt-1 font-size-14" id="assignClsAppend">
                                        </h5>
                                    </div>
                                </div>
                                <!-- end assignee -->
                            </div> <!-- end col -->

                            <div class="col-6">
                                <!-- start due date -->
                                <p class="mt-2 mb-1 text-muted">Due Date</p>
                                <div class="media">
                                    <i class='mdi mdi-calendar-month-outline font-18 text-success mr-1'></i>
                                    <div class="media-body">
                                        <h5 class="mt-1 font-size-14" id="dashDueDate">
                                        </h5>
                                    </div>
                                </div>
                                <!-- end due date -->
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <!-- task description -->
                        <div class="row mt-3">
                            <div class="col">
                                <div id="bubble-editor">
                                    <p>This is a task Description </p>
                                    <div id="dashTaskDesc"></div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end task description -->

                        <!-- start sub tasks/checklists -->
                        <h5 class="mt-4 mb-2 font-size-16">Checklists/Sub-tasks</h5>
                        <div id="dashCheckList">
                        </div>

                        <!-- end sub tasks/checklists -->

                        <!-- start attachments -->
                        <h5 class="mt-4 mb-2 font-size-16">Attachments</h5>
                        <div id="dashAttachments">
                        </div>
                        <!-- end attachments -->

                        <!-- comments -->
                        <div id="dashComments">
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <div class="border rounded">
                                    <form id="submitComment" action="" method="post">
                                        <textarea rows="3" name="comment" id="replyComment" class="form-control border-0 resize-none" placeholder="Your comment...."></textarea>
                                        
                                        <input type="hidden" name="to_do_list_id" id="toDoListId">
                                        <div class="p-2 bg-light d-flex justify-content-between align-items-center">
                                            <button type="submit" class="btn btn-sm btn-success"><i class="mdi mdi-send mr-1"></i>Submit</button>
                                        </div>
                                    </form>
                                </div> <!-- end .border-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end comments -->
                    </div> <!-- end col -->
                </div> <!-- end row-->
                <!-- </div> -->

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->