<!-- Center modal content -->
<div class="modal fade editGrade" id="editGradeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditGradeModalLabel">Edit Grade</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-grade-form" method="post" action="{{ route('admin.grade.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="grade">Grade Name<span class="text-danger">*</span></label>
                        <input type="text"  id="grade" name="grade" class="form-control" placeholder="Enter Grade name">
                    </div>
                    <div class="form-group">
                        <label for="grade_point">Grade Point <span class="text-danger">*</span></label>
                        <input type="text"  id="grade_point" name="grade_point" class="form-control" placeholder="Enter Grade Point">
                    </div>
                    <div class="form-group">
                        <label for="min_mark">Minimun Percentage<span class="text-danger">*</span></label>
                        <input type="text"  id="min_mark" name="min_mark" class="form-control" placeholder="Enter Minimun Percentage">
                    </div>
                    <div class="form-group">
                        <label for="max_mark">Maximum Percentage<span class="text-danger">*</span></label>
                        <input type="text"  id="max_mark" name="max_mark" class="form-control" placeholder="Enter Maximum Percentage">
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