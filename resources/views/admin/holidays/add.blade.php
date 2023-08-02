<!-- Center modal content -->
<div class="modal fade addHolidays" id="addHolidaysModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddHolidaysModalLabel">{{ __('messages.holidays') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="holidaysForm" method="post" action="{{ route('admin.holidays.add') }}" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ __('messages.holiday_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('messages.enter_semester_name') }}">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="date">{{ __('messages.date') }}<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="far fa-calendar-alt"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control datepicker" id="date" name="date" aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.submit') }}</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->