<div class="tab-pane" id="log" data-tab="log">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                        {{ __('messages.log_list') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-xl-12 col-md-12">
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-nowrap table-hover table-centered m-0" id="log-table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('messages.no') }}</th>
                                                <th>{{ __('messages.title') }}</th>
                                                <th>{{ __('messages.soap_type') }}</th>
                                                <th>{{ __('messages.action_by') }}</th>
                                                <th>{{ __('messages.action_type') }}</th>
                                                <th>{{ __('messages.date') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody id="log-body">
                                            <tr >
                                                <td colspan="6" class="text-center">{{ __('messages.no_data_available') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end .table-responsive-->
                            </div> <!-- end card-box-->
                        </div>
                    </div> <!-- end card-box-->
                </div> <!-- end col -->
            </div>
        </div>
    </div><!-- end row -->
</div>