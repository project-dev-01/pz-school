@extends('layouts.admin-layout')
@section('title','Evaluation Report')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <!--<ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Wizard</li>
                    </ol>-->
                </div>
                <h4 class="page-title">Evaluation Report</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Select Ground
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Select Branch<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Malaysia</option>
                                        <option value="press">Singapore</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Standard<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                    <option value="">Select Standard</option>
                                        <option value="">All</option>
                                        <option value="">I</option>
                                        <option value="press">II</option>
                                        <option value="">III</option>
                                        <option value="press">IV</option>
                                        <option value="">V</option>
                                        <option value="press">VI</option>
                                        <option value="">VII</option>
                                        <option value="press">VIII</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Class <span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                    <option value="">Select Class </option>
                                        <option value="">A</option>
                                        <option value="">B</option>
                                        <option value="press">C</option>
                                        <option value="">D</option>
                                        <option value="press">E</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Choose Subject<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">                                          
                                        <option value="press">English</option>    
                                        <option value="">Mathematics</option>
                                        <option value="press">History</option>
                                        <option value="">Study of the Environment</option>
                                        <option value="press">Geography</option>
                                        <option value="">Natural Sciences</option>
                                        <option value="press">Civics Education</option>
                                        <option value="">Arts Education</option>
                                        
                                    </select>
                                </div>
                            </div>  
                        </div>
                    </form>
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                            Filter
                        </button>
                        <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                            Cancel
                        </button>-->
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Evaluation Report
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text"  class="form-control" placeholder="Search">
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Subject</th>
                                                <th>Standard</th>
                                                <th>Class</th>
                                                <th>Date of Homework</th>
                                                <th>Date of Submission</th>
                                                <th>Complete/Incomplete</th>
                                                <th>Total Student</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Geography</td>
                                                <td>First</td>
                                                <td>A</td>
                                                <td>18-02-2022</td>
                                                <td>23-02-2022</td>
                                                <td>1/2</td>
                                                <td>3</td>
                                                <td><a href="" class="btn btn-circle btn-default" data-toggle="modal" data-target=".firstModal"><i class="fas fa-bars"></i> Details</a></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Physics</td>
                                                <td>First</td>
                                                <td>A</td>
                                                <td>29-01-2022</td>
                                                <td>07-02-2022</td>
                                                <td>3/1</td>
                                                <td>5</td>
                                                <td><a href="" class="btn btn-circle btn-default" data-toggle="modal" data-target=".secondModal"><i class="fas fa-bars"></i> Details</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->

                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                            Save
                        </button>
                        <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                            Cancel
                        </button>-->
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

</div> <!-- container -->

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
                            View Report Details
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Student</th>
                                                <th>Register No</th>
                                                <th>Subject</th>
                                                <th>Status</th>
                                                <th>Rank Out of 5</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>William</td>
                                                <td>RSM-00-1</td>
                                                <td>Geography</td>
                                                <td><button type="button" class="btn btn-outline-danger btn-rounded waves-effect waves-light">Incomplete</button></td>
                                                <td>3</td>
                                                <td>Better</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Benjamin</td>
                                                <td>RSM-00-3</td>
                                                <td>Geography</td>
                                                <td><button type="button" class="btn btn-outline-success btn-rounded waves-effect waves-light">Complete</button></td>
                                                <td>5</td>
                                                <td>Nice</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Charlotte</td>
                                                <td>RSM-00-4</td>
                                                <td>Geography</td>
                                                <td><button type="button" class="btn btn-outline-danger btn-rounded waves-effect waves-light">Incomplete</button></td>
                                                <td>2</td>
                                                <td>Need Improvement</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->

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


<div class="modal fade secondModal" id="addClassModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                            View Report Details
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Student</th>
                                                <th>Register No</th>
                                                <th>Subject</th>
                                                <th>Status</th>
                                                <th>Rank Out of 5</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>James</td>
                                                <td>RSM-00-2</td>
                                                <td>Physics</td>
                                                <td><button type="button" class="btn btn-outline-success btn-rounded waves-effect waves-light">Present Properly</button></td>
                                                <td>3</td>
                                                <td>Better</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Lucas</td>
                                                <td>RSM-00-8</td>
                                                <td>Physics</td>
                                                <td><button type="button" class="btn btn-outline-success btn-rounded waves-effect waves-light">Complete</button></td>
                                                <td>5</td>
                                                <td>Nice</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Sophia</td>
                                                <td>RSM-00-6</td>
                                                <td>Physics</td>
                                                <td><button type="button" class="btn btn-outline-danger btn-rounded waves-effect waves-light">Incomplete</button></td>
                                                <td>2</td>
                                                <td>Need Improvement</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Isabella</td>
                                                <td>RSM-00-7</td>
                                                <td>Physics</td>
                                                <td><button type="button" class="btn btn-outline-success btn-rounded waves-effect waves-light">Incomplete</button></td>
                                                <td>5</td>
                                                <td>Nice</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->

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
@endsection