<!-- Start Content-->
<div class="container-fluid">

<div class="modal fade latedetails" id="latedetails" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full-width" style="width:80%;margin:1.75rem auto !important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">{{ __('messages.reasons_count') }}</h4>
                                <div class="mt-4 chartjs-chart">
                                    <canvas id="reason-chart" data-colors="#39afd1"></canvas>
                                    <!-- <canvas id="marksChart" height="350" data-colors="#39afd1,#a17fe0"></canvas> -->
                                </div>
                               
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>