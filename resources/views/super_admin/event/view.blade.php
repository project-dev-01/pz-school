<!-- Center modal content -->
<div class="modal fade viewEvent" id="viewEvent" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myviewEventModalLabel"> <i class="fas fa-info-circle"></i> {{ __('messages.event_details') }} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="card-box">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tr>
                                        <td>{{ __('messages.title') }}</td>
                                        <td class="title"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.type') }}</td>
                                        <td class="type"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.start_date') }}</td>
                                        <td class="start_date"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.end_date') }}</td>
                                        <td class="end_date"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.audience') }}</td>
                                        <td class="audience"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.description') }}</td>
                                        <td class="description"></td>
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