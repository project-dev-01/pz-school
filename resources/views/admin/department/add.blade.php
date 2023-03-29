<!-- Center modal content -->
<div class="modal fade addDepartment" id="addDepartmentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddDepartmentModalLabel">{{ __('messages.add_department') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="departmentForm" method="post" action="{{ route('admin.department.add') }}" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label for="department_name">{{ __('messages.department_name') }}<span class="text-danger">*</span></label>
                        <input type="text" id="department_name" name="department_name" class="form-control" placeholder="Enter Department Name">
                        <span class="text-danger error-text department_name_error"></span>
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