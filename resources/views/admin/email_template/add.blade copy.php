<!-- Center modal content -->
<div class="modal fade addEmailTemplate" id="addEmailTemplateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddEmailTemplateModalLabel">{{ __('messages.add_email_template') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="emailTemplateForm" method="post" action="{{ route('admin.email_template.add') }}" autocomplete="off">
                    @csrf

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
                        <textarea class="form-control clrtext" rows="5" name="template_body" id="template_body" placeholder="{{ __('messages.enter_template_body') }}"></textarea>
                    
                        <span class="text-danger error-text template_body_error"></span>
                    </div>
                    <div class="mt-md">
							<strong>Dynamic Tag : </strong>
							<a data-value=" {name} " class="btn btn-default btn-xs btn_tag ">{name}</a>
							<a data-value=" {email} " class="btn btn-default btn-xs btn_tag">{email}</a>
							<a data-value=" {mobile_no} " class="btn btn-default btn-xs btn_tag">{mobile_no}</a>
						</div>
                    <div class="form-group">
                        <label for="tags">{{ __('messages.tags') }} <span class="text-danger">*</span></label>
                        <input type="text" id="tags" name="tags" class="form-control" placeholder="{{ __('messages.enter_tags') }}">
                        <span class="text-danger error-text tags_error"></span>
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