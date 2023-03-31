@extends('layouts.admin-layout')
@section('title','Add Schedule')
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
                <h4 class="page-title">Add Schedule</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                        {{ __('messages.select_ground') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard"> Branch<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                    <option value="">Select Branch</option>
                                        <option value="">Malaysia</option>
                                        <option value="press">Singapore</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Standard<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option>Select Standard</option>
                                        <option>I</option>
                                        <option>II</option>
                                        <option>III</option>
                                        <option>IV</option>
                                        <option>V</option>
                                        <option>VI</option>
                                        <option>VII</option>
                                        <option>VIII</option>
                                        <option>IX</option>
                                        <option>X</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Class Name<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option>Select Class Name</option>
                                        <option value="All">All</option>
                                        <option>A</option>
                                        <option>B</option>
                                        <option>C</option>
                                        <option>D</option>
                                        <option>E</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Exam<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option>Select Exam</option>
                                        <option value="">1st term</option>
                                        <option value="">Half Yearly</option>
                                        <option value="">Quater Yearly</option>
                                        <option value="">Annual</option>
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
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Add Schedule
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
                                                <th>Subject <span class="text-danger">*</span></th>
                                                <th>Date <span class="text-danger">*</span></th>
                                                <th>{{ __('messages.starting_time') }} <span class="text-danger">*</span></th>
                                                <th>{{ __('messages.ending_time') }} <span class="text-danger">*</span></th>
                                                <th>Hall Room <span class="text-danger">*</span></th>
                                                <th>XXXName<span class="text-danger">*</span></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="input-group mb-2">
                                                        <input type="text" readonly class="form-control" id="inlineFormInputGroup" value="English" placeholder="">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group mb-2">
                                                        <input type="text" class="form-control" id="inlineFormInputGroup" value="2022-01-20" placeholder="">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                        </div>
                                                        <input type="text" class="form-control" id="inlineFormInputGroup" value="3:55 PM" placeholder="">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                        </div>
                                                        <input type="text" class="form-control" id="inlineFormInputGroup" value="3:55 PM" placeholder="">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-2">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <select id="heard" class="form-control" required="" placeholder="Select">
                                                                    <option value="All">01</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-2">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <input type="text" id="example-gridsize" class="form-control" placeholder="Full Mark">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" id="example-gridsize" class="form-control" placeholder="Pass Mark">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
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

@endsection