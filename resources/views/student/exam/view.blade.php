<style>
    .modal-lg,
    .modal-xl {
        max-width: max-content;
    }
</style>
<!-- Center modal content -->
<div class="modal fade examTimeTable" id="examTimeTable" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myexamTimeTableModallLabel">{{ __('messages.schedule_details') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h5 class="text-center" >{{ __('messages.exam') }}<span id="exam"></span></h5>
                <h6 class="text-center" >{{ __('messages.grade') }}<span id="class-section"></span></h6>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered dt-responsive">
                        <thead>
                            <tr style="background-color:#0ABAB5">
                                <th>{{ __('messages.subject') }}</th>
                                <th>{{ __('messages.paper_name') }}</th>
                                <th>{{ __('messages.date') }}</th>
                                <th>{{ __('messages.starting_time') }}</th>
                                <th>{{ __('messages.ending_time') }}</th>
                                <th>{{ __('messages.location') }}</th>
                                <th>{{ __('messages.distributor') }}</th>
                            </tr>
                        </thead>
                        <tbody id="exam-timetable">

                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->