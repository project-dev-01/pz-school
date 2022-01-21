@extends('layouts.admin-layout')
@section('title','Mark Entry')
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
                <h4 class="page-title">Mark Entry</h4>
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
                                        <option value="">Cuddalore</option>
                                        <option value="press">Singapore</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Exam<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Annual</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="heard">Class<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">1</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="heard">Section<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="All">All</option>
                                        <option value="1">A</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="heard">Subject<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="All">English</option>
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
                            Mark Entries
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
                                                <th>Student Name</th>
                                                <th>Roll No</th>
                                                <th>IsAbsent</th>
                                                <th>xxxName</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>xxxx</td>
                                                <td>Pz001</td>
                                                <td>
                                                    <div class="form-group col-md-6">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" checked id="customCheck11">
                                                            <label class="custom-control-label" for="customCheck11"></label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group col-md-4">
                                                        <input type="text" class="form-control" id="inputCity">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>yyy</td>
                                                <td>Pz002</td>
                                                <td>
                                                    <div class="form-group col-md-6">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" checked id="customCheck11">
                                                            <label class="custom-control-label" for="customCheck11"></label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group col-md-4">
                                                        <input type="text" class="form-control" id="inputCity">
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

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
    <div class="form-group text-right m-b-0">
        <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
            Save
        </button>
        <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                            Cancel
                        </button>-->
    </div>
    @include('super_admin.exam_timetable.add')

</div> <!-- container -->

@endsection