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
                            <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
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
                                                                        <div id="homework-checked-status" class="apex-charts" data-colors="#775DD0,#FEB019"></div>
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
                                                            <label for="heard">Status</label>
                                                            <select id="heard" class="form-control" required="">
                                                                <option value="">Choose Filter</option>
                                                                <option value="">Complete</option>
                                                                <option value="">Incomplete</option>
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
                                            <form id="evaluateHomework"  method="post" action="{{ route('teacher.homework.evaluation') }}"  enctype="multipart/form-data" autocomplete="off">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <!-- <table class="table table-bordered mb-0"> -->
                                                        <table data-toggle="table" data-page-size="7" data-buttons-class="xs btn-light" data-pagination="true" class="table  text-center table-striped table-nowrap custom-table mb-0 datatable ">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Student</th>
                                                                    <th>Register No</th>
                                                                    <th>Status</th>
                                                                    <th data-field="user-status">Score</th>
                                                                    <th>Remarks</th>
                                                                    <th>Submission</th>
                                                                    <th>Student Remarks</th>
                                                                    <th>Correction</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="homework_modal_table">
                                                                
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
                                            </form>
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