<!-- Center modal content -->
<div class="modal fade addClassModal" id="addClassModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddClassModalLabel">{{ __('messages.add_grade') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="classSubmit" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="department">{{ __('messages.department') }}<span class="text-danger">*</span></label>
                        <select id="department_id" name="department_id" class="form-control">
                            <option value="">{{ __('messages.select_department') }}</option>
                            @forelse($department as $r)
                            <option value="{{$r['id']}}">{{$r['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('messages.grade_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="className" name="name" class="form-control" placeholder="{{ __('messages.enter_grade_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="name_numeric">{{ __('messages.grade_numeric') }}</label>
                        <input type="text" id="nameNumeric" name="name_numeric" class="form-control" placeholder="{{ __('messages.enter_grade_numeric') }}">
                    </div>
                    <div class="form-group">
                        <label for="short_name">{{ __('messages.short_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="short_name" name="short_name" class="form-control" placeholder="{{ __('messages.enter_short_name') }}">
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