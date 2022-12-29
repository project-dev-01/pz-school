<!-- Center modal content -->
<div class="modal fade editSoapCategory" id="editSoapCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditSoapCategoryModalLabel">Edit Soap Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-soap-category-form" method="post" action="{{ route('admin.soap_category.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="name"> Category Name <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Soap Category Name">
                        <span class="text-danger error-text name_error"></span>
                    </div>
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
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->