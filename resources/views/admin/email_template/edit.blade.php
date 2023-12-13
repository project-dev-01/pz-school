<!-- Center modal content -->
<div class="modal fade editEmailType" id="editEmailTypeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditEmailTypeModalLabel">{{ __('messages.edit_email_type') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-email-type-form" method="post" action="{{ route('admin.email_type.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="type_id">{{ __('messages.email_type') }}</label>
                        <select class="form-control" id="type_id" name="type_id">
                            <option value="">{{ __('messages.select_email_type') }}</option>
                            @forelse($email_type as $type)
                            <option value="{{$type['id']}}">{{$type['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">{{ __('messages.subject') }} <span class="text-danger">*</span></label>
                        <input type="text" id="subject" name="subject" class="form-control" placeholder="{{ __('messages.enter_subject') }}">
                        <span class="text-danger error-text subject_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="template_body">{{ __('messages.template_body') }} <span class="text-danger">*</span></label>
                        <input type="text" id="template_body" name="template_body" class="form-control" placeholder="{{ __('messages.enter_template_body') }}">
                        <span class="text-danger error-text template_body_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="tags">{{ __('messages.tags') }} <span class="text-danger">*</span></label>
                        <input type="text" id="tags" name="tags" class="form-control" placeholder="{{ __('messages.enter_tags') }}">
                        <span class="text-danger error-text tags_error"></span>
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