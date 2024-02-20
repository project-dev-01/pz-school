<!-- student leave remarks popup -->
<div class="modal fade editModal" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myviewEventModalLabel" style="color: #6FC6CC"> <i class="fas fa-info-circle" style="margin-right:10px;"></i>{{ __('messages.comments') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="card-box eventpopup" >
                            <div class="table-responsive">
                                <table class="table w-100 nowrap">
                                    <tr>
                                        <td>Student A Not behave Well</td>
                                        <td><button type="button" id="studentRemarksSave" class="btn btn-blue btn-sm waves-effect waves-light" style="border-radius: 15px;width: 50px;">{{ __('messages.edit') }}</button></td>
                                    </tr>
                                    <tr>
                                        <td>Student A Not behave Well</td>
                                        <td> <button type="button" id="studentRemarksSave" class="btn btn-blue btn-sm waves-effect waves-light" style="border-radius: 15px;width: 50px;">{{ __('messages.edit') }}</button></td>
                                    </tr>
                                    
                                </table>
                                
                            </div> 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                            <button type="button" id="studentRemarksSave" class="btn btn-primary-bl waves-effect waves-light" style="border-radius: 0px;width: 80px;">{{ __('messages.save') }}</button>
                        </div>
                     </div> <!-- end card-box -->
                    </div> <!-- end col -->
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->