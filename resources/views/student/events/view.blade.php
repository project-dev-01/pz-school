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
<div class="modal fade viewEvent" id="viewEventModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <table class="table w-100 nowrap">
                                    <tr>
                                        <td>Title</td>
                                        <td class="title"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.type') }}</td>
                                        <td class="type"></td>
                                    </tr>
                                    <tr>
                                        <td>Start Date</td>
                                        <td class="start_date"></td>
                                    </tr>
                                    <tr>
                                        <td>End Date</td>
                                        <td class="end_date"></td>
                                    </tr>
                                    <tr>
                                        <td>Audience</td>
                                        <td class="audience"></td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
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