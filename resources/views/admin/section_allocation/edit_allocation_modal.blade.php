<!-- Center modal content -->
<div class="modal fade editSectionAllocationModal" id="editSectionAllocationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditSectionAllocationModalLabel">Edit Classes Allocation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="editsectionAllocationForm" autocomplete="off">
                    @csrf
                    <input type="hidden" id="sectionAlloID" name="said">
                    <div class="form-group">
                        <label for="class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="editClassID" name="class_id">
                            <option value="">{{ __('messages.choose_grade') }}</option>
                            @forelse($classDetails as $class)
                            <option value="{{$class['id']}}">{{$class['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                        <select class="form-control" id="editSectionID" name="section_id">
                            <option value="">Choose Class</option>
                            @forelse($sectionDetails as $section)
                            <option value="{{$section['id']}}">{{$section['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="capacity">{{ __('messages.capacity') }}</label>
                        <input type="number" id="editsectionCapacity" name="capacity" class="form-control" placeholder="{{ __('messages.enter_capacity') }}">
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