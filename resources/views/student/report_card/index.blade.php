@extends('layouts.admin-layout')
@section('title','Report Card')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

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
                            Report Card List
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>
                                    <div>
                                        <a class="list-group-item list-group-item-info btn-block btn-lg" data-toggle="collapse" href="#quarterlyExam" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fas fa-caret-square-down"></i> Quarterly Exam - 20 Jan 2022
                                        </a>
                                    </div>
                                    </p>
                                    <div class="collapse" id="quarterlyExam">
                                        <div class="card card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card-box">
                                                        <div class="table-responsive">
                                                            <table class="table mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Subject</th>
                                                                        <th>Score</th>
                                                                        <th>Grade</th>
                                                                        <th>Ranking</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row">English</th>
                                                                        <td>75</td>
                                                                        <td>B</td>
                                                                        <td>7</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Maths</th>
                                                                        <td>60</td>
                                                                        <td>C</td>
                                                                        <td>17</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Science</th>
                                                                        <td>90</td>
                                                                        <td>A</td>
                                                                        <td>3</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Physics</th>
                                                                        <td>75</td>
                                                                        <td>B</td>
                                                                        <td>8</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Result</th>
                                                                        <td>Pass</td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div> <!-- end card-box -->
                                                </div> <!-- end col -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>
                                    <div>
                                        <a class="list-group-item list-group-item-info btn-block btn-lg" data-toggle="collapse" href="#annualExam" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fas fa-caret-square-down"></i> Annual Exam - 21 Jan 2022
                                        </a>
                                    </div>
                                    </p>
                                    <div class="collapse" id="annualExam">
                                        <div class="card card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card-box">
                                                        <div class="table-responsive">
                                                            <table class="table mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Subject</th>
                                                                        <th>Score</th>
                                                                        <th>Grade</th>
                                                                        <th>Ranking</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row">English</th>
                                                                        <td>75</td>
                                                                        <td>B</td>
                                                                        <td>7</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Maths</th>
                                                                        <td>60</td>
                                                                        <td>C</td>
                                                                        <td>17</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Science</th>
                                                                        <td>90</td>
                                                                        <td>A</td>
                                                                        <td>3</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Physics</th>
                                                                        <td>75</td>
                                                                        <td>B</td>
                                                                        <td>8</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Result</th>
                                                                        <td>Pass</td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div> <!-- end card-box -->
                                                </div> <!-- end col -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="form-group text-right m-b-0">

                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->



</div> <!-- container -->
@endsection