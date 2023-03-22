<!-- Center modal content -->
<div class="modal fade addSemester" id="addSemesterModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddSemesterModalLabel">Add Semester</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="semesterForm" method="post" action="{{ route('admin.semester.add') }}" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label for="name">Semester Name<span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Semester Name">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="far fa-calendar-alt"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control datepicker" id="start_date" name="start_date" aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="far fa-calendar-alt"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control datepicker" id="end_date" name="end_date" aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="year">Academic Year<span class="text-danger">*</span></label>
                        <select id="btwyears" class="form-control" name="year" placeholder="Enter Acadenic Year">
                            <option value="">Choose Academic Year</option>
                            @forelse($academic_year_list as $r)
                            <option value="{{$r['id']}}">{{$r['name']}}</option>
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