<style>
    .table td {
        border-top: none;
    }

    @media screen and (min-device-width: 280px) and (max-device-width: 653px) {
        .eventpopup {
            margin: 0px -30px 0px -27px;
        }

    }
</style>
<!-- Center modal content -->
<div class="modal fade viewEvent" id="viewEvent" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myviewEventModalLabel" style="color: #6FC6CC"> <i class="fas fa-info-circle"></i> Event Details </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="card-box eventpopup" style="background-color: #8adfee14;">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tr>
                                        <td>{{ __('messages.title') }}</td>
                                        <td class="title">Volley Ball</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.type') }}</td>
                                        <td class="type">Sports</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.start_date') }}</td>
                                        <td class="start_date">26-01-2022</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.end_date') }}</td>
                                        <td class="end_date">28-01-2022</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.audience') }}</td>
                                        <td class="audience">{{ __('messages.all') }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.description') }}</td>
                                        <td class="description">Enjoy</td>
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