<!-- Add New Event MODAL -->
<div class="modal fade" id="teacher-modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-3 px-4 border-bottom-0 d-block">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" style="color: #6FC6CC">{{ __('messages.schedule') }}</h5>
            </div>
            <div class="modal-body p-4">
                <form id="addDailyReport" method="post" action="{{ route('teacher.classroom.add_daily_report') }}" autocomplete="off">
                    <div class="card popupresponsive" style="line-height: 40px; padding: 12px 40px 0px 40px; background-color: #8adfee14; ">

                        <div class="col-12">
                            <div class="row hover1">
                                <div class="col-6">
                                    <div class="col-md-12 font-weight-bold">{{ __('messages.grade') }}</div>
                                </div>
                                <div class="col-6">
                                    <input type="hidden" id="setCurDate" name="date">
                                    <input type="hidden" id="ttclassID" name="class_id">
                                    <input type="hidden" id="ttsemesterID" name="semester_id">
                                    <input type="hidden" id="ttsessionID" name="session_id">
                                    <div class="col-md-12" id="standard-name"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row hover1">
                                <div class="col-6">
                                    <div class="col-md-12 font-weight-bold">{{ __('messages.class') }}</div>
                                </div>
                                <div class="col-6">
                                    <input type="hidden" id="ttSectionID" name="section_id">
                                    <div class="col-md-12" id="section-name"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row hover1">
                                <div class="col-6">
                                    <div class="col-md-12 font-weight-bold">{{ __('messages.subject_name') }} </div>
                                </div>
                                <div class="col-6">
                                    <input type="hidden" id="ttSubjectID" name="subject_id">
                                    <div class="col-md-12" id="subject-name"></div>
                                </div>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="row hover1">
                                <div class="col-6">
                                    <div class="col-md-12 font-weight-bold">{{ __('messages.timing') }} </div>
                                </div>
                                <div class="col-6">
                                    <input type="hidden" id="ttDate">
                                    <div class="col-md-12" id="timing-class"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row hover1">
                                <div class="col-6">
                                    <div class="col-md-12 font-weight-bold">{{ __('messages.teacher_name') }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="col-md-12" id="teacher-name"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- <div class="form-group"> -->
                            <!-- <label class="control-label font-weight-bold">Notes :</label> -->
                            <textarea class="form-control" style="margin: 5px 0px 10px 0px;" placeholder="{{ __('messages.enter_your_notes') }}" id="calNotes" name="daily_report"></textarea>
                            <!-- </div> -->
                        </div>
                    </div>
                    <div class="row mt-2">
                        <!-- <div class="col-6 text-right">
                                        <a href="{{ route('teacher.classroom.management')}}"><button type="button" class="btn btn-primary width-xs waves-effect waves-light">Go to Class</button></a>
                                    </div> -->
                        <div class="col-6 text-left">
                            <button type="submit" class="btn btn-success" id="btn-save-event">{{ __('messages.save') }}</button>
                        </div>
                        <div class="col-6 text-right">
                            <!-- <button type="button" class="btn btn-light mr-1" data-dismiss="modal">{{ __('messages.close') }}</button> -->
                            <button type="button" id="goToClassRoom" class="btn btn-primary width-xs waves-effect waves-light">{{ __('messages.go_to_classroom') }}</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div> <!-- end modal-content-->
</div> <!-- end modal dialog-->