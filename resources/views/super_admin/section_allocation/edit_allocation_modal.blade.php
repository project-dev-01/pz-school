<!-- Center modal content -->
<div class="modal fade editSectionAllocationModal" id="editSectionAllocationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditSectionAllocationModalLabel">Edit Section Allocation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="editsectionAllocationForm" method="post" action="{{ route('section_allocation.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="said">
                    <div class="form-group">
                        <label for="name">{{ __('messages.branch_name') }}<span class="text-danger">*</span></label>
                        <select id="editSecAllBranchId" class="form-control" name="branch_id">
                            <option value="">{{ __('messages.select_branch') }}</option>
                            @foreach($branches as $b)
                            <option value="{{$b['id']}}">{{$b['name']}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text branch_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="class_name">{{ __('messages.class_Name') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="class_name" name="class_name">
                            <option value="">{{ __('messages.select_class') }}</option>
                        </select>
                        <span class="text-danger error-text class_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="section_name">{{ __('messages.section_name') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="section_name" name="section_name">
                            <option value="">{{ __('messages.select_section') }}</option>
                        </select>
                        <span class="text-danger error-text section_name_error"></span>
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