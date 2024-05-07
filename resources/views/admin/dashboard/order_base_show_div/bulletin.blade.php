
<div class="row">
    <div class="col-lg-12">
        <div class="card">
                <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.BulletinBoard') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton3" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                </ul>
          
                <div class="card-body collapse show">
                    <div class="form-group pull-right">
                        <div class="col-xs-2 col-sm-2">
                        <a href="{{ route('admin.buletin_board') }}" class="btn btn-primary width-xs waves-effect waves-light">{{ __('messages.go_to_bulletin') }}</a>

                        </div>
                    </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table dt-responsive nowrap w-100" id="buletin-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('messages.title') }}</th>
                                        <th>{{ __('messages.file') }}</th>
                                        <th>{{ __('messages.publish_dates') }}</th>
                                        <th>{{ __('messages.action') }}</th>
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
    </div>
</div>
<div class="modal fade viewBuletin" id="viewBuletinModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myviewBuletinModalLabel" style="color: #6FC6CC"> <i class="fas fa-info-circle"></i>{{ __('messages.buletin_details') }} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="card-box eventpopup" style="background-color: #8adfee14;">
                            <div class="table-responsive">
                                <table class="table w-100 nowrap">
                                    <tr>
                                        <td>{{ __('messages.title') }}</td>
                                        <td class="title"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.file') }}</td>
                                        <td class="file"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.publish_date') }}</td>
                                        <td class="publish_date"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.publish_end_date') }}</td>
                                        <td class="publish_end_date"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.target_user') }}</td>
                                        <td class="target_user"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.description') }}</td>
                                        <td class="description" style="white-space: pre-line;"></td>
                                    </tr>
                                </table>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->