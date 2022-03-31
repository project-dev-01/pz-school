<!-- Center modal content -->
<div class="modal fade editExam" id="editExamModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditExamModalLabel">Edit Exam </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-exam-form" method="post" action="{{ route('admin.exam.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="name"> Name <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter name">
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
                        <label for="type_id" class="col-3 col-form-label">Exam Type </label>
                        <select  class="form-control" name="type_id">
                            <option value="">Select Exam Type</option>
                            <option value="1">Marks</option>
                            <option value="2">Grade</option>
                            <option value="3">Marks and Grade</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="remarks"> Remarks</label>
                        <textarea type="text"  name="remarks" class="form-control" placeholder="Enter Remarks"></textarea>
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