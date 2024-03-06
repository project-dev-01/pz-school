<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <h4 class="navv">{{ __('messages.staff_leave_details') }}</h4>
                </li>
            </ul><br>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered w-100 nowrap" id="staff-leave-list">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.name') }}</th>
                                <th>{{ __('messages.leave_type') }}</th>
                                <th>{{ __('messages.leave_from') }}</th>
                                <th>{{ __('messages.to_from') }}</th>
                                <th>{{ __('messages.reason') }}</th>
                                <th>{{ __('messages.status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end card-->
</div>