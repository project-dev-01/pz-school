<!-- Center modal content -->
<div class="modal fade editSoapSubCategory" id="editSoapSubCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditSoapSubCategoryModalLabel">{{ __('messages.edit_sub_category') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-soap-sub-category-form" method="post" action="{{ route('admin.soap_sub_category.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="soap_type_id">{{ __('messages.soap_type') }}<span class="text-danger">*</span></label>
                        <select id="edit_soap_type_id" class="form-control" name="soap_type_id">
                            <option value="">{{ __('messages.select_soap_type') }}</option>
                            <option value="1">Subjective</option>
                            <option value="2">Objective</option>
                            <option value="3">Assessment</option>
                            <option value="4">Plan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="soap_category_id">{{ __('messages.category') }} <span class="text-danger">*</span></label>
                        <select id="soap_category_id" class="form-control" name="soap_category_id">
                            <option value="">{{ __('messages.select_category') }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">{{ __('messages.sub_category_name') }} <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('messages.enter_sub_category_name') }}">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="document">{{ __('messages.photo') }}</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="edit_photo" class="custom-file-input" name="photo" accept="image/png, image/gif, image/jpeg" >
                                <input type="hidden"  name="old_photo" >
                                <label class="custom-file-label" for="document">{{ __('messages.choose_file') }}</label>
                            </div>
                        </div>
                        <a href="" target="_blank"><span id="edit_photo_name"></span></a>
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