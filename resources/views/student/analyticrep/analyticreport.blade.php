@extends('layouts.admin-layout')
@section('title','Analytic Report')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div>
                <h4 class="page-title">Analytic Report</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="edit" class="icon-dual" id="span-parent"></span> Select Ground
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Subject<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Select Subject</option>
                                        <option value="press">All</option>
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
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <h4 class="nav-link" style="border-bottom: 2px solid #0ABAB5;">
                    <span data-feather="map" class="icon-dual" id="span-parent"></span> Attendance Report
                </h4>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="mt-4 chartjs-chart" style="text-align:center">
                            <div id="anylitc-attend" style="min-height: 365px;"></div>
                            <!-- <canvas id="marksChart" height="350" data-colors="#39afd1,#a17fe0"></canvas> -->
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <h4 class="nav-link" style="border-bottom: 2px solid #0ABAB5;">
                    <span data-feather="book-open" class="icon-dual" id="span-parent"></span> HomeWork
                </h4>
                <div class="card-body">
                    <div class="col-md-12">
                        <div id="cardCollpase19" class="collapse pt-4 show" style="text-align:center" dir="ltr">
                            <div id="homework-status" class="apex-charts" data-colors="#00b19d,#f1556c"></div>
                        </div> <!-- collapsed end -->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="fa-app-store-ios" class="icon-dual" id="span-parent"></span> Attitude
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="">

                                <!-- <div id="statistics-dynam" data-colors="#02c0ce" class="morris-chart mt-3"></div>
                            <div id="legend"></div> 

                            <div id="cardCollpase5" class="collapse pt-3 show" dir="ltr">
                            <div id="apex-column-1" class="apex-charts" data-colors="#3283f6,#44cf9c,#CED4DC"></div>
                            </div>  collapsed end -->
                                <div id="attitude" class="attitude"></div>
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div>
                    <!--- end row -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="edit" class="icon-dual" id="span-parent"></span> Short Test
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="">
                                <div class="table-responsive">
                                    <table data-toggle="table" data-page-size="5" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable ">
                                        <thead>
                                            <tr>
                                                <th>S.no</th>
                                                <th>Short Test Name</th>
                                                <th>Grade</th>
                                                <th>Mark</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1</th>
                                                <th>Skill</th>
                                                <td>A</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <th>2</th>
                                                <th>Grammer</th>
                                                <td>-</td>
                                                <td>45</td>
                                            </tr>
                                            <tr>
                                                <th>3</th>
                                                <th>GeoGenius</th>
                                                <td>-</td>
                                                <td>45</td>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h4 class="nav-link" style="border-bottom: 2px solid #0ABAB5;">
                    <span data-feather="clipboard" class="icon-dual" id="span-parent"></span> Exam Result
                </h4>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mt-4 chartjs-chart">
                                <canvas id="radar-analytic" height="400" data-colors="#39afd1,#a17fe0"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mt-4 chartjs-chart">
                                <div id="line-23" class="apex-charts" data-colors="#f672a7"></div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    @include('teacher.dashboard.check_list')

</div> <!-- container -->
@endsection