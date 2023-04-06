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
                        <label for="title">{{ __('messages.title') }}<span class="text-danger">*</span></label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="{{ __('messages.enter_title') }}">
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="date">{{ __('messages.date') }} & {{ __('messages.time') }}<span class="text-danger">*</span></label>
                        <input type="text" id="date" name="date" class="form-control" placeholder="Enter Date & Time">
                        <span class="text-danger error-text date_error"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="priority">{{ __('messages.priority') }}<span class="text-danger">*</span></label>
                        <select id="priority" class="form-control" required="">
                            <option value="Low">{{ __('messages.low') }}</option>
                            <option value="Medium">{{ __('messages.medium') }}</option>
                            <option value="High">{{ __('messages.high') }}</option>
                        </select>
                        <span class="text-danger error-text priority_error"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">{{ __('messages.description') }}<span class="text-danger">*</span></label>
                        <input type="text" id="description" name="description" class="form-control" placeholder="{{ __('messages.enter_description') }}">
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