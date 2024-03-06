 <!-- Add New Event MODAL -->
 <div class="modal fade viewEvent" id="event-modal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="myviewEventModalLabel" style="color: #6FC6CC"> <i class="fas fa-info-circle"></i> {{ __('messages.event_details') }} </h4>
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
             </div>
             <div class="modal-body">
                 <div class="row">
                     <div class="col">
                         <div class="card-body eventpopup" style="background-color: #8adfee14;"">
                                        <div class=" table-responsive">
                             <style>
                                 .table td {
                                     border-top: none;
                                     text-align: justify;
                                 }
                             </style>
                             <table class="table">
                                 <tr>
                                     <td>{{ __('messages.title') }}</td>
                                     <td id="title"></td>
                                 </tr>
                                 <tr>
                                     <td>{{ __('messages.type') }}</td>
                                     <td id="type"></td>
                                 </tr>
                                 <tr>
                                     <td>{{ __('messages.start_date') }}</td>
                                     <td id="start_date"></td>
                                 </tr>
                                 <tr>
                                     <td>{{ __('messages.end_date') }}</td>
                                     <td id="end_date"></td>
                                 </tr>
                                 <tr>
                                     <td>{{ __('messages.audience') }}</td>
                                     <td id="audience"></td>
                                 </tr>
                                 <tr>
                                     <td>{{ __('messages.description') }}</td>
                                     <td id="description"></td>
                                 </tr>
                             </table>
                         </div>
                     </div> <!-- end card-box -->
                 </div> <!-- end col -->
             </div>
         </div>
     </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->