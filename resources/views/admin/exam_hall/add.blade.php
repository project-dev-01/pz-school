<!-- Center modal content -->
<div class="modal fade addExamHall" id="addExamHallModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddExamHallModalLabel">Add Exam Hall</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="exam-hall-form" method="post"  action="{{ route('admin.exam_hall.add') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="hall_no">Hall Number</label>
                        <input type="text"  name="hall_no" class="form-control" placeholder="Enter Hall Number">
                    </div>
                    <div class="form-group">
                        <label for="no_of_seats">No of Seats</label>
                        <input type="text"  name="no_of_seats" class="form-control" placeholder="Enter No of Seats">
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