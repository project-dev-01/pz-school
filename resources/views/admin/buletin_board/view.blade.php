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
<div class="modal fade viewBuletin" id="viewBuletinModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myviewBuletinModalLabel" style="color: #6FC6CC"> <i class="fas fa-info-circle"></i>{{ __('messages.buletin_details') }} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="card-box eventpopup" style="background-color: #8adfee14;">
                            <div class="table-responsive">
                                <table class="table w-100 nowrap">
                                    <tr>
                                        <td>{{ __('messages.title') }}</td>
                                        <td class="title"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.file') }}</td>
                                        <td class="file"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.publish_date') }}</td>
                                        <td class="publish_date"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.publish_end_date') }}</td>
                                        <td class="publish_end_date"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.target_user') }}</td>
                                        <td class="target_user"></td>
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