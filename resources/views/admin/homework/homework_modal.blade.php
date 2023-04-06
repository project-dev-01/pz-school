<!-- Center modal content -->
<div class="modal fade firstModal" id="addClassModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myaddClassModalLabel">{{ __('messages.homework_details') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <h4 class="navv">
                                    {{ __('messages.view_homework_details') }}
                                        <h4>
                                </li>
                            </ul><br>
                            <div class="card-body">
                                <div class="col-xl-12">

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-widgets">
                                                        <!-- <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a> -->
                                                        <a data-toggle="collapse" href="#cardCollpase19" role="button" aria-expanded="false" aria-controls="cardCollpase19"><i class="mdi mdi-minus"></i></a>
                                                        <!-- <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a> -->
                                                    </div>
                                                    <h4 class="header-title mb-0">{{ __('messages.homework_status') }}</h4>

                                                    <div id="cardCollpase19" class="collapse pt-3 show" dir="ltr">
                                                        <div id="homework-status" class="apex-charts" data-colors="#00b19d,#f1556c"></div>
                                                    </div> <!-- collapsed end -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-widgets">
                                                        <!-- <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a> -->
                                                        <a data-toggle="collapse" href="#cardCollapseChecked" role="button" aria-expanded="false" aria-controls="cardCollapseChecked"><i class="mdi mdi-minus"></i></a>
                                                        <!-- <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a> -->
                                                    </div>
                                                    <h4 class="header-title mb-0">{{ __('messages.checked_status') }}</h4>

                                                    <div id="cardCollapseChecked" class="collapse pt-3 show" dir="ltr">
                                                        <div id="homework-checked-status" class="apex-charts" data-colors="#775DD0,#FEB019"></div>
                                                    </div> <!-- collapsed end -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <h4 class="navv">
                                    {{ __('messages.homework_details') }}
                                        <h4>
                                </li>
                            </ul><br>
                            <div class="card-body">
                                <form id="evaluateHomework" method="post" action="{{ route('admin.homework.evaluation') }}" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table data-page-size="7" data-buttons-class="xs btn-light" data-pagination="true" class="table table-bordered table-centered dt-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{ __('messages.student') }}</th>
                                                            <th>{{ __('messages.register_no') }}</th>
                                                            <th>{{ __('messages.status') }}</th>
                                                            <th data-field="user-status">{{ __('messages.score') }}</th>
                                                            <th>{{ __('messages.remarks') }}</th>
                                                            <th>{{ __('messages.submission') }}</th>
                                                            <th>{{ __('messages.student_remarks') }}</th>
                                                            <th>{{ __('messages.correction') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="homework_modal_table">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> <!-- end table-responsive-->
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group text-right m-b-0">
                                                <button class="btn btn-primary-b1 waves-effect waves-light" type="submit">
                                                    Save
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div> <!-- end card-->

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->