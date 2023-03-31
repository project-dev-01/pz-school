<!-- Center modal content -->
<div class="modal fade editExamHall" id="editExamHallModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditExamHallModalLabel">Edit Location</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-exam-hall-form" method="post" action="{{ route('admin.exam_hall.update') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="hall_no">{{ __('messages.location_name') }}</label>
                        <input type="text"  name="hall_no" class="form-control" placeholder="Enter Location Name">
                    </div>
                    <div class="form-group">
                        <label for="no_of_seats">{{ __('messages.no_of_seats') }}</label>
                        <input type="text"  name="no_of_seats" class="form-control" placeholder="Enter No of Seats">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->