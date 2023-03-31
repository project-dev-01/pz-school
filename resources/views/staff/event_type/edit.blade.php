<!-- Center modal content -->
<div class="modal fade editEventType" id="editEventTypeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditEventTypeModalLabel">Edit Event Type</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="eventTypeEditForm" method="post" action="{{ route('event_type.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" id="event_type_id" name="event_type_id">
                    <div class="form-group">
                        <label for="name">{{ __('messages.event_type_name') }}</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Event Type name">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" id="eventTypeEditSubmit" class="btn btn-success waves-effect waves-light">Update</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->