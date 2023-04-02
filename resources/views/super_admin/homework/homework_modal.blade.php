<!-- Center modal content -->
<div class="modal fade firstModal" id="addClassModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h4 class="modal-title" id="myaddClassModalLabel">Add Class</h4> -->
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <ul class="nav nav-tabs" >
                                <li class="nav-item">
                                    <h4 class="nav-link">
                                        View Homework Details
                                        <h4>
                                </li>
                            </ul><br>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-box">
                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <!-- Portlet card -->
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="card-widgets">
                                                                        <!-- <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a> -->
                                                                        <a data-toggle="collapse" href="#cardCollpase19" role="button" aria-expanded="false" aria-controls="cardCollpase19"><i class="mdi mdi-minus"></i></a>
                                                                        <!-- <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a> -->
                                                                    </div>
                                                                    <h4 class="header-title mb-0">Homework Status</h4>

                                                                    <div id="cardCollpase19" class="collapse pt-3 show" dir="ltr">
                                                                        <div id="homework-status" class="apex-charts" data-colors="#00b19d,#f1556c"></div>
                                                                    </div> <!-- collapsed end -->
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="card-widgets">
                                                                        <!-- <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a> -->
                                                                        <a data-toggle="collapse" href="#cardCollapseChecked" role="button" aria-expanded="false" aria-controls="cardCollapseChecked"><i class="mdi mdi-minus"></i></a>
                                                                        <!-- <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a> -->
                                                                    </div>
                                                                    <h4 class="header-title mb-0">Checked Status</h4>

                                                                    <div id="cardCollapseChecked" class="collapse pt-3 show" dir="ltr">
                                                                        <div id="homework-checked-status" class="apex-charts" data-colors="#FEB019,#775DD0"></div>
                                                                    </div> <!-- collapsed end -->
                                                                </div>
                                                            </div>
                                                        </div> <!-- end card-body -->
                                                    </div> <!-- end card-->
                                                </div> <!-- end col-->
                                            </div>
                                            <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="heard">{{ __('messages.status') }}</label>
                                                            <select id="heard" class="form-control" required="">
                                                                <option value="">Choose Filter</option>
                                                                <option value="">{{ __('messages.complete') }}</option>
                                                                <option value="">{{ __('messages.incomplete') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="heard">Checked</label>
                                                            <select id="heard" class="form-control" required="">
                                                                <option value="">Choose Filter</option>
                                                                <option value="">Checked</option>
                                                                <option value="">Unchecked</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                            </div> <!-- end table-responsive-->
                                            <div class="row">
                                            <div class="col-md-12">
                                                <!-- <table class="table table-bordered mb-0"> -->
                                                <table data-toggle="table" data-page-size="7" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable ">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{ __('messages.student') }}</th>
                                                            <th>{{ __('messages.register_no') }}</th>
                                                            <th>{{ __('messages.subject') }}</th>
                                                            <th>{{ __('messages.status') }}</th>
                                                            <th data-field="user-status">{{ __('messages.score') }}</th>
                                                            <th>{{ __('messages.remarks') }}</th>
                                                            <th>Submission</th>
                                                            <th>Student Remarks</th>
                                                            <th>Correction</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>William</td>
                                                            <td>RSM-00-1</td>
                                                            <td>Geography</td>
                                                            <td><button type="button" class="btn btn-outline-danger btn-rounded waves-effect waves-light">Incomplete</button></td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <label for="heard">{{ __('messages.status') }}</label>
                                                                    <select id="heard" class="form-control" required="">
                                                                        <option value="">Marks</option>
                                                                        <option value="press">Grade</option>
                                                                        <option value="">Text</option>
                                                                    </select>
                                                                </div>
                                                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>

                                                            </td>
                                                            <td><input type="text" class="form-control" id="name" placeholder="" value="Better" aria-describedby="inputGroupPrepend" required></td>
                                                            <td>
                                                                <i data-feather="file-text" class="icon-dual"></i>
                                                                <span class="ml-2 font-weight-semibold"><a href="javascript: void(0);" class="text-reset">internal-test.pdf</a></span>
                                                            </td>
                                                            <td>Homework submit</td>
                                                            <td>
                                                                <div class="checkbox checkbox-primary mb-3">
                                                                    <input id="checkbox2" type="checkbox" checked>
                                                                    <label for="checkbox2"></label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>Benjamin</td>
                                                            <td>RSM-00-3</td>
                                                            <td>Geography</td>
                                                            <td><button type="button" class="btn btn-outline-success btn-rounded waves-effect waves-light">Complete</button></td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <label for="heard">{{ __('messages.status') }}</label>
                                                                    <select id="heard" class="form-control" required="">
                                                                        <option value="">Marks</option>
                                                                        <option value="press">Grade</option>
                                                                        <option value="">Text</option>
                                                                    </select>
                                                                </div>
                                                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>

                                                            </td>
                                                            <td><input type="text" class="form-control" id="name" placeholder="" value="Nice" aria-describedby="inputGroupPrepend" required></td>
                                                            <td>
                                                                <i data-feather="file-text" class="icon-dual"></i>
                                                                <span class="ml-2 font-weight-semibold"><a href="javascript: void(0);" class="text-reset">internal-test.pdf</a></span>
                                                            </td>
                                                            <td>Homework submit</td>
                                                            <td>
                                                                <div class="checkbox checkbox-primary mb-3">
                                                                    <input id="checkbox2" type="checkbox">
                                                                    <label for="checkbox2"></label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>Charlotte</td>
                                                            <td>RSM-00-4</td>
                                                            <td>Geography</td>
                                                            <td><button type="button" class="btn btn-outline-danger btn-rounded waves-effect waves-light">Incomplete</button></td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <select id="heard" class="form-control" required="">
                                                                        <option value="">Marks</option>
                                                                        <option value="press">Grade</option>
                                                                        <option value="">Text</option>
                                                                    </select>
                                                                </div>
                                                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>

                                                            </td>
                                                            <td><input type="text" class="form-control" id="name" placeholder="" value="Need Improvement" aria-describedby="inputGroupPrepend" required></td>
                                                            <td>
                                                                <i data-feather="file-text" class="icon-dual"></i>
                                                                <span class="ml-2 font-weight-semibold"><a href="javascript: void(0);" class="text-reset">internal-test.pdf</a></span>
                                                            </td>
                                                            <td>Homework submit</td>
                                                            <td>
                                                                <div class="checkbox checkbox-primary mb-3">
                                                                    <input id="checkbox2" type="checkbox" checked>
                                                                    <label for="checkbox2"></label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div> <!-- end table-responsive-->
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group text-right m-b-0">
                                                        <button class="btn btn-primary waves-effect waves-light" type="Save">
                                                            Save
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>

                                        </div> <!-- end card-box -->
                                    </div> <!-- end col-->
                                </div>
                                <!-- end row-->

                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->