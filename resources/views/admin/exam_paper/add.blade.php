<!-- Center modal content -->
<div class="modal fade addExamPaper" id="addExamPaperModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddExamPaperModalLabel">Add </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="exam-paper-form" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="changeClassName">Standard name<span class="text-danger">*</span></label>
                        <select class="form-control add_class_name" id="changeClassName" name="class_id">
                            <option value="">Choose Class</option>
                            @forelse($classDetails as $class)
                            <option value="{{$class['id']}}">{{$class['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subjectID">Subject<span class="text-danger">*</span></label>
                        <select id="subjectID" class="form-control" name="subject_id">
                            <option value="">Select Subject</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="paper_name">Paper Name<span class="text-danger">*</span></label>
                        <input type="text" name="paper_name" class="form-control" placeholder="Enter Paper Name">
                    </div>
                    <div class="form-group">
                        <label for="paper_type">Paper Type<span class="text-danger">*</span></label>
                        <select class="form-control" id="paper_type" name="paper_type">
                            <option value="">Select Paper Type</option>
                            <option value="Objective">Objective</option>
                            <option value="Subjective">Subjective</option>
                            <option value="Presentation">Presentation</option>
                            <option value="Objective + Subjective">Objective + Subjective</option>
                            <option value="Oral">Oral</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="grade_category">Grade Category<span class="text-danger">*</span></label>
                        <select class="form-control" name="grade_category">
                            <option value="">Select Grade Category</option>
                            @forelse($grade_category as $gc)
                            <option value="{{$gc['id']}}">{{$gc['name']}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject_weightage">Subject Weightage</label>
                        <input type="number" name="subject_weightage" class="form-control" placeholder="Enter Subject Weightage">
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea name="notes" class="form-control" maxlength="255" placeholder="Enter Notes"></textarea>
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