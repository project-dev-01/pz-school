<div class="modal fade leavedetails" id="leavedetails" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width:750px;margin:1.75rem auto !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold" id="myleavedetailsModalLabel">{{ __('messages.leave_details') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="department-form" method="post" autocomplete="off">                                        
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="row">
                                <div class="col-sm-6"><h5>{{ __('messages.emp_name') }} :</h5></div>
                                <div class="col-sm-5"><h4 class="font-weight-bold">{{ __('messages.hajmal') }}</h4></div></div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-6"><h5>{{ __('messages.emp_id') }} :</h5></div>
                                    <div class="col-sm-5"><h4 class="font-weight-bold">1010</h4></div>
                                </div>                            
                            </div>                            
                        </div>
                        <div class="row">                            
                            <div class="col-md-6"> 
                                <div class="row">
                                <div class="col-sm-6"><h5>{{ __('messages.gender') }} :</h5></div>
                                <div class="col-sm-5"><h4 class="font-weight-bold">Male</h4></div></div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-6"><h5>{{ __('messages.mobile_no') }} :</h5></div>
                                    <div class="col-sm-5"><h4 class="font-weight-bold">9600787841</h4></div>
                                </div>             
                            </div>                            
                        </div>
                        <div class="row"> 
                        <div class="col-md-6"> 
                                <div class="row">
                                <div class="col-sm-6"><h5>From Date :</h5></div>
                                <div class="col-sm-5"><h4 class="font-weight-bold">22/08/2022</h4></div></div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-6"><h5>To Date :</h5></div>
                                    <div class="col-sm-5"><h4 class="font-weight-bold">22/08/2022</h4></div>
                                </div>             
                            </div> 
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->