 <!-- end row-->
 <div class="row">
     <div class="col-xl-12">
         <div class="row">
             <div class="col">
                 <div class="card">
                     <ul class="nav nav-tabs">
                         <li class="nav-item">
                             <h4 class="navv">{{ __('messages.leave_details') }}
                                 <h4>
                         </li>
                     </ul>
                     <div class="card-body">
                         <a href="{{ route('teacher.student_leave.list')}}">
                             <div class="row">
                                 <div class="col-md-3 col-xl-3 col-sm-3 col-lg-3">
                                     <div class="widget-rounded-circle card-box">
                                         <div class="row">
                                             <p class="mb-1 text-truncate" style="width: 100%;">{{ __('messages.total_leaves') }}</p>
                                             <div class="col-6">
                                                 <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                                     <i class="mdi mdi-text-box-check-outline font-22 avatar-title text-info"></i>
                                                 </div>
                                             </div>
                                             <div class="col-6">
                                                 <div class="text-right">
                                                     <h3 class="mt-1"><span data-plugin="counterup">{{$total_count}}</span></h3>

                                                 </div>
                                             </div>
                                         </div> <!-- end row-->
                                     </div> <!-- end widget-rounded-circle-->
                                 </div> <!-- end col-->
                                 <div class="col-md-3 col-xl-3 col-sm-3 col-lg-3">
                                     <div class="widget-rounded-circle card-box">
                                         <div class="row">
                                             <p class="mb-1 text-truncate" style="width: 100%;">{{ __('messages.leaves_approved') }}</p>
                                             <div class="col-6">
                                                 <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                                     <i class="mdi mdi-application-import font-22 avatar-title text-success"></i>
                                                 </div>
                                             </div>
                                             <div class="col-6">
                                                 <div class="text-right">
                                                     <h3 class="mt-1"><span data-plugin="counterup">{{$approve_count}}</span></h3>

                                                 </div>
                                             </div>
                                         </div> <!-- end row-->
                                     </div> <!-- end widget-rounded-circle-->
                                 </div> <!-- end col-->
                                 <div class="col-md-3 col-xl-3 col-sm-3 col-lg-3">
                                     <div class="widget-rounded-circle card-box">
                                         <div class="row">
                                             <p class="mb-1 text-truncate" style="width: 100%;">{{ __('messages.leaves_rejected') }}</p>
                                             <div class="col-6">
                                                 <div class="avatar-lg rounded-circle bg-soft-pink border-pink border">
                                                     <i class="mdi mdi-account-cash-outline font-22 avatar-title text-pink"></i>
                                                 </div>
                                             </div>
                                             <div class="col-6">
                                                 <div class="text-right">
                                                     <h3 class="mt-1"><span data-plugin="counterup">{{$reject_count}}</span></h3>

                                                 </div>
                                             </div>
                                         </div> <!-- end row-->
                                     </div> <!-- end widget-rounded-circle-->
                                 </div> <!-- end col-->
                                 <div class="col-md-3 col-xl-3 col-sm-3 col-lg-3">
                                     <div class="widget-rounded-circle card-box">
                                         <div class="row">
                                             <p class="mb-1 text-truncate" style="width: 100%;">{{ __('messages.leaves_pending') }}</p>
                                             <div class="col-6">
                                                 <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                                     <i class="mdi mdi-timetable font-22 avatar-title text-warning"></i>
                                                 </div>
                                             </div>
                                             <div class="col-6">
                                                 <div class="text-right">
                                                     <h3 class="mt-1"><span data-plugin="counterup">{{$pending_count}}</span></h3>

                                                 </div>
                                             </div>
                                         </div> <!-- end row-->
                                     </div> <!-- end widget-rounded-circle-->
                                 </div> <!-- end col-->
                             </div> <!-- end row -->
                         </a>

                     </div> <!-- end card-body -->
                 </div> <!-- end card -->
             </div> <!-- end col -->
         </div> <!-- end row -->
     </div> <!-- end col -->

     <!-- task details -->
     <!-- task panel end -->
 </div> <!-- end card-box -->