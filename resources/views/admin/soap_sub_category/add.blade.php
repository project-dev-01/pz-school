<!-- Center modal content -->
<div class="modal fade addSoapSubCategory" id="addSoapSubCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddSoapSubCategoryModalLabel">{{ __('messages.add_sub_category') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="soapSubCategoryForm" method="post" action="{{ route('admin.soap_sub_category.add') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="soap_type_id">{{ __('messages.soap_type') }}<span class="text-danger">*</span></label>
                        <select id="soap_type_id" class="form-control" name="soap_type_id">
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
                        <label for="name">{{ __('messages.sub_category_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('messages.enter_sub_category_name') }}">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="document">{{ __('messages.photo') }}</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="photo" class="custom-file-input" name="photo" accept="image/png, image/gif, image/jpeg" >
                                <label class="custom-file-label" for="document">{{ __('messages.choose_file') }}</label>
                            </div>
                        </div>
                        <span id="photo_name"></span>
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