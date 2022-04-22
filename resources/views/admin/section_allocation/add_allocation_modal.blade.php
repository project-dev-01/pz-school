<!-- Center modal content -->
<div class="modal fade addSectionAllocationModal" id="addSectionAllocationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddSectionAllocationModalLabel">Add Section Allocation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="sectionAllocationForm" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="class_id">Class Name</label>
                        <select class="form-control" id="classID" name="class_id">
                            <option value="">Choose Class</option>
                            @forelse($classDetails as $class)
                            <option value="{{$class['id']}}">{{$class['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="section_id">Section Name</label>
                        <select class="form-control" id="sectionID" name="section_id">
                            <option value="">Choose Section</option>
                            @forelse($sectionDetails as $section)
                            <option value="{{$section['id']}}">{{$section['name']}}</option>
                            @empty
                            @endforelse
                        </select>
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