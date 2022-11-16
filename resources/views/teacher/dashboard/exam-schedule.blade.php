<style>
    @media screen and (min-device-width: 280px) and (max-device-width: 653px) {
        .exampopup {
            padding: 0px 0px 0px 0px;

        }
    }
</style>

<!-- Center modal content -->
<div class="modal fade examSchedule" id="examScheduleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myexamScheduleModalLabel" style="color: #6FC6CC">Exam Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="card-box exampopup" style="background-color: #8adfee14; ">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tr>
                                        <td>Exam Name</td>
                                        <td id="examName"></td>
                                    </tr>
                                    <tr>
                                        <td>Grade</td>
                                        <td id="examStandard"></td>
                                    </tr>
                                    <tr>
                                        <td>Class</td>
                                        <td id="examClass"></td>
                                    </tr>
                                    <tr>
                                        <td>Subject</td>
                                        <td id="examSubject"></td>
                                    </tr>
                                    <tr>
                                        <td>Exam Time</td>
                                        <td id="examTiming"></td>
                                    </tr>
                                </table>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->