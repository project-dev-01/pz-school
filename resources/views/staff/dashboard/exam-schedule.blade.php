<!-- Center modal content -->
<div class="modal fade examSchedule" id="examScheduleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myexamScheduleModalLabel">{{ __('messages.exam_details') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="card-box">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tr>
                                        <td>{{ __('messages.exam_name') }}</td>
                                        <td id="examName"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.grade') }}</td>
                                        <td id="examStandard"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.class') }}</td>
                                        <td id="examClass"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.subject') }}</td>
                                        <td id="examSubject"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.exam_time') }}</td>
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