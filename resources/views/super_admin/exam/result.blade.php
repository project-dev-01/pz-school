@extends('layouts.admin-layout')
@section('title','Exam Result')
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
                <h4 class="page-title">Exam Result</h4>
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
                            Exam
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heard">Select Branch<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Cuddalore</option>
                                        <option value="press">Singapore</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heard">Roll No<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- <div class="form-group">
                                    <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                        Get Result
                                    </button>
                                </div> -->
                                <div class="form-group" style="padding:25px;">
                                    <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                        Get Result
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>

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
                            Exam Result
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <tr>
                                            <th>Roll No</th>
                                            <td>PZ123456</td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td>xxx</td>
                                        </tr>
                                        <tr>
                                            <td>DOB</td>
                                            <td>01-01-2002</td>
                                        </tr>
                                        <tr>
                                            <td>Class</td>
                                            <td>11</td>
                                        </tr>
                                        <tr>
                                            <td>Section</td>
                                            <td>A</td>
                                        </tr>
                                    </table>
                                </div> <!-- end table-responsive-->
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr style="background-color:#0ABAB5">
                                                <th>Roll No.</th>
                                                <th>Name</th>
                                                <th>English</th>
                                                <th>Maths</th>
                                                <th>Science</th>
                                                <th>Computer Science</th>
                                                <th>Total</th>
                                            <tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>PZ123456</td>
                                                <td>xxx</td>
                                                <td>90</td>
                                                <td>80</td>
                                                <td>70</td>
                                                <td>80</td>
                                                <td>320</td>
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

</div> <!-- container -->

@endsection