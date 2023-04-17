<!-- Center modal content -->
<div class="modal fade editEventType" id="editEventType" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <label for="name">{{ __('messages.branch_name') }}<span class="text-danger">*</span></label>
                        <select id="branch_id" class="form-control" name="branch_id">
                            <option value="">{{ __('messages.select_branch') }}</option>
                            @foreach($branches as $b)
                            <option value="{{$b['id']}}">{{$b['name']}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text branch_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('messages.event_type_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('messages.enter_event_type_name') }}">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" id="eventTypeEditSubmit" class="btn btn-success waves-effect waves-light">{{ __('messages.update') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->