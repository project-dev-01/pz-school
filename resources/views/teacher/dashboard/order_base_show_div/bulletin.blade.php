
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
                        <a href="{{ route('teacher.buletin_board') }}" class="btn btn-primary width-xs waves-effect waves-light">{{ __('messages.go_to_bulletin') }}</a>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="buletin-table-dashboard">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.title') }}</th>
                                    <th>{{ __('messages.file') }}</th>
                                    <th>{{ __('messages.publish_dates') }}</th>
                                    <th>{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody >
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>
<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileModalLabel">{{ __('messages.file_details') }}</h5>
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
                                        <td id="fileTitle"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.description') }}</td>
                                        <td id="fileDescription" style="white-space: pre-line;"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.download') }}</td>
                                        <td>
                                            <ul id="fileLinksContainer"></ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.preview') }}</td>
                                        <td > <ul id="fileLinksPreviewContainer"></ul></td>
                                    </tr>
                                </table>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->
                </div>
                <iframe id="filePreview" src="" style="display: none; width: 100%; height: 500px;"></iframe>
            </div>
        </div>
    </div>
</div>