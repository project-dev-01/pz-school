@extends('layouts.admin-layout')
@section('title','Exam Schedule')
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
                <h4 class="page-title">Report Card</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Report Card</h4>

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
                    <!--- end row -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->

</div> <!-- container -->

@endsection