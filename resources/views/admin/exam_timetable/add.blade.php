<!-- Center modal content -->
<div class="modal fade examTimeTable" id="examTimeTable" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myexamTimeTableModallLabel">Schedule Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h5 class="text-center" id="exam"></h5>
                <h6 class="text-center" id="class-section"></h6>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-centered dt-responsive nowrap w-100" width="100%">
                        <thead>
                            <tr style="background-color:#0ABAB5">
                                <th>Subject</th>
                                <th>Paper Name</th>
                                <th>Date</th>
                                <th>Starting Time</th>
                                <th>Ending Time</th>
                                <th>Location</th>
                                <th>Distributor</th>
                            </tr>
                        </thead>
                        <tbody id="exam-timetable">

                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
                <div class="form-group text-right m-b-0">
                    <form method="post" id="downloadExcel" action="{{ route('admin.exam_schedule_download_excel')}}">
                        @csrf
                        <input type="hidden" name="exam_name" id="exam_name">
                        <input type="hidden" name="class_section_name" id="class_section_name">
                        <input type="hidden" name="class_id" id="class_id">
                        <input type="hidden" name="section_id" id="section_id">
                        <input type="hidden" name="exam_id" id="exam_id">
                        <input type="hidden" name="semester_id" id="semester_id">
                        <input type="hidden" name="session_id" id="session_id">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                            Download
                        </button>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->