<!-- Center modal content -->
<div class="modal fade examTimeTable" id="examTimeTable" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myexamTimeTableModallLabel">Schedule Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">Exam : Annual Exam</h5>
                <h6 class="text-center">{{ __('messages.grade') }} : I(A)</h6>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr style="background-color:#0ABAB5">
                                <th>{{ __('messages.subject') }}</th>
                                <th>{{ __('messages.date') }}</th>
                                <th>{{ __('messages.starting_time') }}</th>
                                <th>{{ __('messages.ending_time') }}</th>
                                <th>Hall Room</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Mathematics</td>
                                <td>16.Feb.2022</td>
                                <td>3:10 PM</td>
                                <td>4:10 PM</td>
                                <td>01</td>
                            </tr>
                            <tr>
                                <td>English</td>
                                <td>17.Feb.2022</td>
                                <td>3:10 PM</td>
                                <td>4:10 PM</td>
                                <td>01</td>
                            </tr>
                            <tr>
                                <td>History</td>
                                <td>19.Feb.2022</td>
                                <td>3:10 PM</td>
                                <td>4:10 PM</td>
                                <td>01</td>
                            </tr>
                            <tr>
                                <td>Geography</td>
                                <td>21.Feb.2022</td>
                                <td>3:10 PM</td>
                                <td>4:10 PM</td>
                                <td>01</td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->