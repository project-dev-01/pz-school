<!-- Center modal content -->
<div class="modal fade addExam" id="addExamModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddExamModalLabel">Add Exam </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="exam-form" method="post"  action="{{ route('admin.exam.add') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="name"> Name</label>
                        <input type="text"  name="name" class="form-control" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="term_id" class="col-3 col-form-label">Term </label>
                        <select  class="form-control" name="term_id">
                            <option value="">Select Term</option>
                            @foreach($term as $t)
                                <option value="{{$t['id']}}">{{$t['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="remarks"> Remarks</label>
                        <textarea type="text"  name="remarks" class="form-control" placeholder="Enter Remarks"></textarea>
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