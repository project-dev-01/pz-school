<!-- Center modal content -->
<div class="modal fade addExamTerm" id="addExamTermModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddExamTermModalLabel">Add Exam Term</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="exam-term-form" method="post"  action="{{ route('admin.exam_term.add') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="name">Term Name</label>
                        <input type="text"  name="name" class="form-control" placeholder="Enter Term name">
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