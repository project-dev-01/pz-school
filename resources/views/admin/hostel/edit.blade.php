<!-- Center modal content -->
<div class="modal fade editHostel" id="editHostelModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditHostelModalLabel">{{ __('messages.edit_hostel') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-hostel-form" method="post" action="{{ route('admin.hostel.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="name">{{ __('messages.hostel_name') }}<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="{{ __('messages.enter_the_hostel_name') }}">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="category">{{ __('messages.category') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="category" name="category">
                            <option value="">{{ __('messages.select_the_category') }}</option>
                            @foreach($category as $cat)
                            <option value="{{$cat['id']}}">{{$cat['name']}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text category_error"></span>
                    </div>
                    <div id="test"></div>
                    <div class="form-group" id="watchman">
                        <label for="watchman">{{ __('messages.warden_name') }}<span class="text-danger">*</span></label>
                        <select class="form-control select2-multiple" id="watch" data-toggle="select2" name="watchman[]" multiple="multiple" data-placeholder="{{ __('messages.choose_the_warden_name') }}">
                            <option value="">{{ __('messages.select_warden') }}</option>
                            @forelse($warden as $war)
                            <option value="{{$war['id']}}">{{$war['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                        <span class="text-danger error-text watchman_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="address">{{ __('messages.hostel_address') }}<span class="text-danger">*</span></label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="{{ __('messages.enter_hostel_address') }}">
                        <span class="text-danger error-text address_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="remarks">{{ __('messages.remarks') }}</label>
                        <textarea type="text" name="remarks" class="form-control" placeholder="{{ __('messages.enter_remarks') }}"> </textarea>
                        <span class="text-danger error-text remarks_error"></span>
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