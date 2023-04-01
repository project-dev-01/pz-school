<!-- Center modal content -->
<div class="modal fade addSectionAllocationModal" id="addSectionAllocationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddSectionAllocationModalLabel">Add Section Allocation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="sectionAllocationForm" method="post" action="{{ route('section_allocation.add') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="class_name">{{ __('messages.class_Name') }}</label>
                        <select class="form-control" id="class_name" name="class_name">
                            <option value="">Choose Class</option>
                            @foreach($classDetails as $class)
                            <option value="{{$class->id}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text class_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="section_name">Section Name</label>
                        <select class="form-control" id="section_name" name="section_name">
                            <option value="">Choose Section</option>
                            @foreach($sectionDetails as $section)
                            <option value="{{$section->id}}">{{$section->name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text section_name_error"></span>
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