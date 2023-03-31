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
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">{{ __('messages.close') }}</button>
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
                        <h4>Sports Day</h4>

                        <div class="row">
                            <div class="col-6">
                                <!-- assignee -->
                                <p class="mt-2 mb-1 text-muted">{{ __('messages.assigned_to') }}</p>
                                <div class="media">
                                    <!-- <img src="../assets/images/users/user-9.jpg" alt="Arya S" class="rounded-circle mr-2" height="24" /> -->
                                    <div class="media-body">
                                        <h5 class="mt-1 font-size-14">
                                            Class X
                                        </h5>
                                    </div>
                                </div>
                                <!-- end assignee -->
                            </div> <!-- end col -->

                            <div class="col-6">
                                <!-- start due date -->
                                <p class="mt-2 mb-1 text-muted">{{ __('messages.due_date') }}</p>
                                <div class="media">
                                    <i class='mdi mdi-calendar-month-outline font-18 text-success mr-1'></i>
                                    <div class="media-body">
                                        <h5 class="mt-1 font-size-14">
                                            Feb 5 - 10:00 AM
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
                                    <p>This is a task Description </p>
                                    <ul>
                                        <li>Allocate a teacher or assistant to each station as an overall leader with another to supervise and help run each station - older pupils are often very keen to help with this, it's a brilliant chance to give them some responsibility </li>
                                        <li>Have a clipboard, pen and score sheet for each station </li>
                                        <li>Check that you have all the equipment for each station and put these aside so they are easy to access on the day</li>
                                    </ul>
                                    <p>End of Description</p>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end task description -->

                        <!-- start sub tasks/checklists -->
                        <h5 class="mt-4 mb-2 font-size-16">{{ __('messages.checklists') }}/S{{ __('messages.sub-tasks') }}</h5>
                        <div class="custom-control custom-checkbox mt-1">
                            <input type="checkbox" class="custom-control-input" id="checklist1">
                            <label class="custom-control-label strikethrough" for="checklist1">
                                A sports equipment list is useful to have to ensure nothing is missed
                            </label>
                        </div>

                        <div class="custom-control custom-checkbox mt-1">
                            <input type="checkbox" class="custom-control-input" id="checklist2">
                            <label class="custom-control-label strikethrough" for="checklist2">
                                Contact your PTA chair and see if they are available to arrange drinks for the adults
                            </label>
                        </div>

                        <div class="custom-control custom-checkbox mt-1">
                            <input type="checkbox" class="custom-control-input" id="checklist3">
                            <label class="custom-control-label strikethrough" for="checklist3">
                            Have a couple of first aid kits accessible and a first aider at the event 
                            </label>
                        </div>
                        <!-- end sub tasks/checklists -->

                        <!-- start attachments -->
                        <h5 class="mt-4 mb-2 font-size-16">{{ __('messages.attachment') }}</h5>
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
                                        <a href="javascript:void(0);" class="text-muted font-weight-bold">Schedule.zip</a>
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
                                        <a href="javascript:void(0);" class="text-muted font-weight-bold">Rules.jpg</a>
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
                                    <!-- <img src="{{ asset('public/images/users/user-9.jpg') }}" class="mr-2 rounded-circle" height="36" alt="Arya Stark" /> -->
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-0 font-size-14">
                                            <span class="float-right text-muted font-12">4:30am</span>
                                            James
                                        </h5>
                                        <p class="mt-1 mb-0 text-muted">
                                            Is it Compulsory To wears Sport Dress?
                                        </p>
                                    </div>
                                </div> <!-- end comment -->

                                <hr />

                                <div class="media mt-2 p-1">
                                    <!-- <img src="../assets/images/users/user-5.jpg" class="mr-2 rounded-circle" height="36" alt="Dominc B" /> -->
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-0 font-size-14">
                                            <span class="float-right text-muted font-12">3:30am</span>
                                            William
                                        </h5>
                                        <p class="mt-1 mb-0 text-muted">
                                            @James...- Yes, Participants All Must to wear Sport Dress.
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
                                            <button type="submit" class="btn btn-sm btn-success"><i class="mdi mdi-send mr-1"></i>{{ __('messages.submit') }}</button>
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

<!-- Right modal content -->
<div id="right-modal-dashboard-2" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-center">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <!-- <div class="text-center">
                    <h4 class="mt-0">Text in a modal</h4>
                    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">{{ __('messages.close') }}</button>
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
                        <h4>Half Yearly Exam</h4>

                        <div class="row">
                            <div class="col-6">
                                <!-- assignee -->
                                <p class="mt-2 mb-1 text-muted">{{ __('messages.assigned_to') }}</p>
                                <div class="media">
                                    <!-- <img src="../assets/images/users/user-9.jpg" alt="Arya S" class="rounded-circle mr-2" height="24" /> -->
                                    <div class="media-body">
                                        <h5 class="mt-1 font-size-14">
                                            Class I to X
                                        </h5>
                                    </div>
                                </div>
                                <!-- end assignee -->
                            </div> <!-- end col -->

                            <div class="col-6">
                                <!-- start due date -->
                                <p class="mt-2 mb-1 text-muted">{{ __('messages.due_date') }}</p>
                                <div class="media">
                                    <i class='mdi mdi-calendar-month-outline font-18 text-success mr-1'></i>
                                    <div class="media-body">
                                        <h5 class="mt-1 font-size-14">
                                            Feb 2 - 10:00 AM
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
                                    <p>This is a task Description </p>
                                    <ul>
                                        <li>Portion will be from Lesson 1 to Lesson 3 </li>
                                        <li>Exam Marks will be 50 </li>
                                    </ul>
                                    <p>End of Description</p>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end task description -->

                        <!-- start sub tasks/checklists -->
                        <h5 class="mt-4 mb-2 font-size-16">{{ __('messages.checklists') }}/{{ __('messages.sub-tasks') }}</h5>
                        <div class="custom-control custom-checkbox mt-1">
                            <input type="checkbox" class="custom-control-input" id="checklist1">
                            <label class="custom-control-label strikethrough" for="checklist1">
                                All Should Bring needed Stationary Things for Exam
                            </label>
                        </div>

                        <div class="custom-control custom-checkbox mt-1">
                            <input type="checkbox" class="custom-control-input" id="checklist2">
                            <label class="custom-control-label strikethrough" for="checklist2">
                                Don't Use Green and Red Pens
                            </label>
                        </div>

                        <!-- <div class="custom-control custom-checkbox mt-1">
                            <input type="checkbox" class="custom-control-input" id="checklist3">
                            <label class="custom-control-label strikethrough" for="checklist3">
                                
                            </label>
                        </div> -->
                        <!-- end sub tasks/checklists -->

                        <!-- start attachments -->
                        <h5 class="mt-4 mb-2 font-size-16">{{ __('messages.attachment') }}</h5>
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
                                        <a href="javascript:void(0);" class="text-muted font-weight-bold">Exam-Schedule.zip</a>
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
                                        <a href="javascript:void(0);" class="text-muted font-weight-bold">Exam-Portions.jpg</a>
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
                                    <!-- <img src="{{ asset('public/images/users/user-9.jpg') }}" class="mr-2 rounded-circle" height="36" alt="Arya Stark" /> -->
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-0 font-size-14">
                                            <span class="float-right text-muted font-12">4:30am</span>
                                            Arya Stark
                                        </h5>
                                        <p class="mt-1 mb-0 text-muted">
                                            Should I Use Glittering Pens?
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
                                            @Arya Sta...- Yes You should Glittering Pens, other than Red and Green Pens.
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
                                            <button type="submit" class="btn btn-sm btn-success"><i class="mdi mdi-send mr-1"></i>{{ __('messages.submit') }}</button>
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