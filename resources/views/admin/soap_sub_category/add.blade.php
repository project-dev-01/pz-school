<!-- Center modal content -->
<div class="modal fade addSoapSubCategory" id="addSoapSubCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddSoapSubCategoryModalLabel">Add Sub Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="soapSubCategoryForm" method="post" action="{{ route('admin.soap_sub_category.add') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="soap_type_id">Soap Type<span class="text-danger">*</span></label>
                        <select id="soap_type_id" class="form-control" name="soap_type_id">
                            <option value="">Select Soap Type</option>
                            <option value="1">Subjective</option>
                            <option value="2">Objective</option>
                            <option value="3">Assessment</option>
                            <option value="4">Plan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="soap_category_id">Category <span class="text-danger">*</span></label>
                        <select id="soap_category_id" class="form-control" name="soap_category_id">
                            <option value="">Select Category</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Sub Category Name <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Sub Category Name">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="document">Photo</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="photo" class="custom-file-input" name="photo" accept="image/png, image/gif, image/jpeg" >
                                <label class="custom-file-label" for="document">Choose file</label>
                            </div>
                        </div>
                        <span id="photo_name"></span>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->