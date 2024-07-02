<style>
    .badge-soft-primary {
     width: 97px !important;
    height: 24px !important;
    border-radius: 5px !important;
}
.badge-soft-secondary {
     width: 97px !important;
    height: 24px !important;
    border-radius: 5px !important;
}

</style>
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
        <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.student_transfer_list') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton3" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
          
            <div class="card-body collapse show">
                <div class="table-responsive">
                    <table class="table dt-responsive nowrap w-100" id="student-transfer-list">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> {{ __('messages.control_number') }}</th>
                                <th> {{ __('messages.name') }}</th>
                                <th> {{ __('messages.name_english') }}</th>
                                <th> {{ __('messages.gender') }}</th>
                                <th> {{ __('messages.email') }}</th>
                                <th> {{ __('messages.termination_academic_year') }}</th>
                                <th> {{ __('messages.grade') }}</th>
                                <th> {{ __('messages.status') }}</th>
                                <th> {{ __('messages.date_of_termination') }}</th>
                                <th> {{ __('messages.school_fees_payment_status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>