<!-- Right modal content -->
<div id="right-modal-dashboard" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <h4>Simple Admin Dashboard Template Design</h4>

                        <div class="row">
                            <div class="col-6">
                                <!-- assignee -->
                                <p class="mt-2 mb-1 text-muted">Assigned To</p>
                                <div class="media">
                                    <!-- <img src="../assets/images/users/user-9.jpg" alt="Arya S" class="rounded-circle mr-2" height="24" /> -->
                                    <div class="media-body">
                                        <h5 class="mt-1 font-size-14">
                                            Arya Stark
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
                                        <h5 class="mt-1 font-size-14">
                                            Today 10am
                                        </h5>
                                    </div>
                                </div>
                                <!-- end due date -->
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <!-- task description -->
                        <div class="row mt-3">
                            <div class="col">
                                <div id="bubble-editor" style="height: 120px;">
                                    <p>This is a task description with markup support</p>
                                    <ul>
                                        <li>Select a text to reveal the toolbar.</li>
                                        <li>Edit rich document on-the-fly, so elastic!</li>
                                    </ul>
                                    <p>End of air-mode area</p>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end task description -->

                        <!-- start sub tasks/checklists -->
                        <h5 class="mt-4 mb-2 font-size-16">Checklists/Sub-tasks</h5>
                        <div class="custom-control custom-checkbox mt-1">
                            <input type="checkbox" class="custom-control-input" id="checklist1">
                            <label class="custom-control-label strikethrough" for="checklist1">
                                Find out the old contract documents
                            </label>
                        </div>

                        <div class="custom-control custom-checkbox mt-1">
                            <input type="checkbox" class="custom-control-input" id="checklist2">
                            <label class="custom-control-label strikethrough" for="checklist2">
                                Organize meeting sales associates to understand need in detail
                            </label>
                        </div>

                        <div class="custom-control custom-checkbox mt-1">
                            <input type="checkbox" class="custom-control-input" id="checklist3">
                            <label class="custom-control-label strikethrough" for="checklist3">
                                Make sure to cover every small details
                            </label>
                        </div>
                        <!-- end sub tasks/checklists -->

                        <!-- start attachments -->
                        <h5 class="mt-4 mb-2 font-size-16">Attachments</h5>
                        <div class="card mb-1 shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-sm">
                                            <span class="avatar-title badge-soft-primary text-primary rounded">
                                                ZIP
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col pl-0">
                                        <a href="javascript:void(0);" class="text-muted font-weight-bold">Aibots-design.zip</a>
                                        <p class="mb-0 font-12">2.3 MB</p>
                                    </div>
                                    <div class="col-auto">
                                        <!-- Button -->
                                        <a href="javascript:void(0);" class="btn btn-link font-16 text-muted">
                                            <i class="dripicons-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-1 shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-sm">
                                            <span class="avatar-title badge-soft-primary text-primary rounded">
                                                JPG
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col pl-0">
                                        <a href="javascript:void(0);" class="text-muted font-weight-bold">Sports-design.jpg</a>
                                        <p class="mb-0 font-12">3.25 MB</p>
                                    </div>
                                    <div class="col-auto">
                                        <!-- Button -->
                                        <a href="javascript:void(0);" class="btn btn-link font-16 text-muted">
                                            <i class="dripicons-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end attachments -->

                        <!-- comments -->
                        <div class="row mt-3">
                            <div class="col">
                                <h5 class="mb-2 font-size-16">Comments</h5>

                                <div class="media mt-3 p-1">
                                    <!-- <img src="{{ asset('images/users/user-9.jpg') }}" class="mr-2 rounded-circle" height="36" alt="Arya Stark" /> -->
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-0 font-size-14">
                                            <span class="float-right text-muted font-12">4:30am</span>
                                            Arya Stark
                                        </h5>
                                        <p class="mt-1 mb-0 text-muted">
                                            Should I review the last 3 years legal documents as
                                            well?
                                        </p>
                                    </div>
                                </div> <!-- end comment -->

                                <hr />

                                <div class="media mt-2 p-1">
                                    <!-- <img src="../assets/images/users/user-5.jpg" class="mr-2 rounded-circle" height="36" alt="Dominc B" /> -->
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-0 font-size-14">
                                            <span class="float-right text-muted font-12">3:30am</span>
                                            Gary Somya
                                        </h5>
                                        <p class="mt-1 mb-0 text-muted">
                                            @Arya FYI..I have created some general guidelines last
                                            year.
                                        </p>
                                    </div>
                                </div> <!-- end comment-->

                                <hr />

                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <div class="row mt-2">
                            <div class="col">
                                <div class="border rounded">
                                    <form action="#">
                                        <textarea rows="3" class="form-control border-0 resize-none" placeholder="Your comment...."></textarea>
                                        <div class="p-2 bg-light d-flex justify-content-between align-items-center">
                                            <div>
                                                <a href="#" class="btn btn-sm px-2 font-16 btn-light"><i class="mdi mdi-cloud-upload-outline"></i></a>
                                                <a href="#" class="btn btn-sm px-2 font-16 btn-light"><i class="mdi mdi-at"></i></a>
                                            </div>
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