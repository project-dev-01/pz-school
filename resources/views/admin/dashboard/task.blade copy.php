<!-- Center modal content -->
<div class="modal fade addTasks" id="addTasksModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddTasksModalLabel" style="color: #6FC6CC">{{ __('messages.add') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" style="background-color: #8adfee14;">
                <form id="taskAdd" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="title">{{ __('messages.title') }} <span class="text-danger">*</span></label>
                        <input type="text" id="taskTitle" name="title" class="form-control" placeholder="{{ __('messages.enter_title') }}">
                        <span id="titleError" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('messages.description') }}</label>
                        <textarea id="taskDescription" name="description" rows="3" class="form-control" placeholder="{{ __('messages.enter_description') }}"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>{{ __('messages.date') }}<span class="text-danger">*</span></label>
                                <input id="taskdateSlot" name="taskdateSlot" class="form-control taskdateSlot" placeholder="YYYY-MM-DD">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label><!--{{ __('messages.time') }}--> Start Time</label>
                                <input id="tasktimeSlotStart" name="tasktimeSlotStart" class="form-control" placeholder="HH:MM">
                            </div>
                            <div class="col-sm-6">
                                <label><!--{{ __('messages.time') }}--> End Time</label>
                                <input id="tasktimeSlotEnd" name="tasktimeSlotEnd" class="form-control" placeholder="HH:MM">
                            </div>
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <label>{{ __('messages.date') }}<span class="text-danger">*</span></label>
                        <input id="taskdateSlot"  name="taskdateSlot" class="form-control taskdateSlot" placeholder="YYYY-MM-DD">
        
                    </div>
                    
                    <div class="form-group displayTimeSlot">
                        <label>{{ __('messages.time') }}</label>
                        <input id="tasktimeSlotStart" name="tasktimeSlotStart" class="form-control" placeholder="HH:MM">
                        <input id="tasktimeSlotEnd" name="tasktimeSlotEnd" class="form-control" placeholder="HH:MM">
                    </div>-->

                    <div class="form-group mb-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input allDayCheck" id="allDayCheck">
                            <label class="custom-control-label" for="allDayCheck">All day</label>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="startEndDate">{{ __('messages.start_date') }}</label>
                        <p id="startDate"></p>
                    </div>
                    <div class="form-group">
                        <label for="endDate">{{ __('messages.end_date') }}</label>
                        <p id="endDate"></p>
                    </div> -->

                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" id="saveBtn" class="btn btn-success waves-effect waves-light">{{ __('messages.save') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->