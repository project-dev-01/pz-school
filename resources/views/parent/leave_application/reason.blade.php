<!-- Full width modal content -->
<div id="knowtheReasons" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">{{ __('messages.reason_details') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card" style="overflow-y: auto; max-height: 500px; overflow-x: hidden;">
                            <div class="table-responsive">
                                <table class="table w-100 nowrap" id="studentleave-table">
                                    <!--<h4 class="header-title">{{ __('messages.reason') }}</h4>-->
                                    <div id="showAllReasons">
                                        <!-- Content to be displayed dynamically -->
                                    </div>
                                </table>
                            </div>
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- end modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
