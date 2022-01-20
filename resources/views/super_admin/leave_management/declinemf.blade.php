<div class="modal fade declineleave" id="declineModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width:750px;margin:1.75rem auto !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold" id="declineleaveModelLabel">Leave Decline Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="department-form" method="post" autocomplete="off">                   
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="row">
                                <div class="col-sm-6"><h5>Emp Name :</h5></div>
                                <div class="col-sm-5"><h4 class="font-weight-bold">Hajmal</h4></div></div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-6"><h5>Emp Id :</h5></div>
                                    <div class="col-sm-5"><h4 class="font-weight-bold">1010</h4></div>
                                </div>                            
                            </div>                            
                        </div><br>
                        <div class="row">                          
                            <div class="col-md-12">                              
                            
                                    <label for="message">Admin Reason(s)<span class="text-danger">*</span></label>
                                    <textarea id="message" class="form-control" name="message"
                                    data-parsley-trigger="keyup" data-parsley-minlength="20"
                                    data-parsley-maxlength="100"
                                    data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.."
                                    data-parsley-validation-threshold="10">
                                    </textarea>                                                      
                            </div>                  
                        </div>  <br/>   
                        <div class="row">
                            <div class="col-md-6">                            
                            <button type="button" class="btn btn-success waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Confirm</button>
                            </div>
                        </div>                  
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->