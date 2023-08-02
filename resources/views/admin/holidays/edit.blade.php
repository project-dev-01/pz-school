<!-- Center modal content -->
<div class="modal fade editHolidays" id="editHolidaysModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditHolidaysModalLabel">{{ __('messages.edit_semester') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-holidays-form" method="post" action="{{ route('admin.holidays.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="name">{{ __('messages.holiday_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('messages.enter_semester_name') }}">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="text">{{ __('messages.date') }}<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="far fa-calendar-alt"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control datepicker" id="edit_date" name="date" aria-describedby="inputGroupPrepend">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.update') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->