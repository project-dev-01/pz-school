@extends('layouts.admin-layout')
@section('title','Test Result')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <!--<div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Wizard</li>
                    </ol>
                </div>
                <h4 class="page-title">Form Wizard</h4>-->
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <span data-feather="clipboard" class="icon-dual" id="parent"></span>
                    <span class="header-title mb-3" id="parent">Test Result</span>
                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form id="filter">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="subject">Subject<span class="text-danger">*</span></label>
                                                    <select id="subject" class="form-control" name="subject" required="">
                                                        <option value="">Select Subject</option>
                                                        <option value="">English</option>
                                                        <option value="">Mathematics</option>
                                                        <option value="">Science</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="standard">Standard<span class="text-danger">*</span></label>
                                                    <select id="standard" class="form-control" required="">
                                                        <option value="">Select Standard</option>
                                                        <option value="">I</option>
                                                        <option value="">II</option>
                                                        <option value="">III</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="class_room">Class Room<span class="text-danger">*</span></label>
                                                    <select id="class_room" class="form-control" required="">
                                                        <option value="">Select Class Room</option>
                                                        <option value="">A</option>
                                                        <option value="">B</option>
                                                        <option value="">C</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="test_name">Test Name<span class="text-danger">*</span></label>
                                                    <select id="test_name" class="form-control" required="">
                                                        <option value="">Select Test Name</option>
                                                        <option value="">Quaterly</option>
                                                        <option value="">MidTerm I</option>
                                                        <option value="">Half Yearly</option>
                                                        <option value="">Annual</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary-bl waves-effect waves-light" id="branch-filter" type="button">
                                                Filter
                                            </button>
                                            <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                                Cancel
                                            </button>-->
                                        </div>
                                    </form>
                                    <hr>
                                    <span data-feather="edit" class="icon-dual" id="span-parent"></span>
                                    <span class="header-title mb-3" id="span-parent">Marks By Subject
                                        <hr id="hr">
                                    </span>
                                    <div class="col-md-12">
                                        <table data-toggle="table" data-page-size="7" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable ">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Student Name</th>
                                                    <th>Score</th>
                                                    <th>Grade</th>
                                                    <th>Ranking</th>
                                                    <th>Memo</th>
                                                </tr>

                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>1</td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">William</a>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" value="90" class="form-control">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>S</td>
                                                    <td>1</td>
                                                    <td><input type="text" value="Excellent" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">James</a>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" value="85" class="form-control">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>A</td>
                                                    <td>2</td>
                                                    <td><input type="text" value="Good" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">Benjamin</a>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" value="78" class="form-control">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>B</td>
                                                    <td>3</td>
                                                    <td><input type="text" value="Better" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">Lucas</a>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" value="70" class="form-control">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>C</td>
                                                    <td>4</td>
                                                    <td><input type="text" value="Need Improvement" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">Charlotte</a>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" value="90" class="form-control">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>S</td>
                                                    <td>1</td>
                                                    <td><input type="text" value="Excellent" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">Sophia</a>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" value="85" class="form-control">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>A</td>
                                                    <td>2</td>
                                                    <td><input type="text" value="Good" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">Amelia</a>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" value="78" class="form-control">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>B</td>
                                                    <td>3</td>
                                                    <td><input type="text" value="Better" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>8</td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">Isabella</a>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" value="70" class="form-control">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>C</td>
                                                    <td>4</td>
                                                    <td><input type="text" value="Need Improvement" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>9</td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">Mia</a>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" value="70" class="form-control">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>C</td>
                                                    <td>4</td>
                                                    <td><input type="text" value="Need Improvement" class="form-control"></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary-bl waves-effect waves-light" id="branch-filter" type="button">
                                                Save
                                            </button>
                                        </div>
                                    </div> <!-- end table-responsive-->
                                    <hr>
                                    <div class="col-md-12">
                                        <!-- Portlet card -->
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-widgets">
                                                    <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                                    <a data-toggle="collapse" href="#cardCollpase3" role="button" aria-expanded="false" aria-controls="cardCollpase3"><i class="mdi mdi-minus"></i></a>
                                                    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                                </div>
                                                <h4 class="header-title mb-0">Subject Average</h4>

                                                <div id="cardCollpase3" class="collapse pt-3 show" dir="ltr">
                                                    <div id="subject-avg-chart" class="apex-charts" data-colors="#f672a7"></div>
                                                </div> <!-- collapsed end -->
                                            </div> <!-- end card-body -->
                                        </div> <!-- end card-->
                                    </div>
                                    <span data-feather="book-open" class="icon-dual" id="span-parent"></span>
                                    <span class="header-title mb-3" id="span-parent">Marks By Subject Division 
                                        <hr id="hr">
                                    </span>
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <table data-toggle="table" data-page-size="7" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable ">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Student Name</th>
                                                        <th>Test A Score(0.2)</th>
                                                        <th>Test B Score(0.2)</th>
                                                        <th>Test C Score(0.25)</th>
                                                        <th>Test D Score(0.35)</th>
                                                        <th>Total Score</th>
                                                        <th>Grade</th>
                                                        <th>Ranking</th>
                                                    </tr>

                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td class="table-user">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">William</a>
                                                        </td>
                                                        <td><input type="text" value="{{ 95*0.2 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 95*0.2 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 95*0.25 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 97*0.35 }}" class="form-control"></td>
                                                        <td>{{ (95*0.2 + 95*0.2 + 95*0.25 + 97*0.35) }}</td>
                                                        <td>S</td>
                                                        <td>1</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td class="table-user">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">James</a>
                                                        </td>
                                                        <td><input type="text" value="{{ 85*0.2 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 80*0.2 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 90*0.25 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 80*0.35 }}" class="form-control"></td>
                                                        <td>{{ (85*0.2 + 80*0.2 + 90*0.25 + 80*0.35) }}</td>
                                                        <td>B</td>
                                                        <td>2</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td class="table-user">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">Benjamin</a>
                                                        </td>
                                                        <td><input type="text" value="{{ 84*0.2 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 80*0.2 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 89*0.25 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 82*0.35 }}" class="form-control"></td>
                                                        <td>{{ (84*0.2 + 80*0.2 + 89*0.25 + 82*0.35) }}</td>
                                                        <td>B</td>
                                                        <td>3</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td class="table-user">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">Lucas</a>
                                                        </td>
                                                        <td><input type="text" value="{{ 85*0.2 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 80*0.2 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 87*0.25 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 80*0.35 }}" class="form-control"></td>
                                                        <td>{{ (85*0.2 + 80*0.2 + 87*0.25 + 80*0.35) }}</td>
                                                        <td>B</td>
                                                        <td>4</td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td class="table-user">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">Charlotte</a>
                                                        </td>
                                                        <td><input type="text" value="{{ 84*0.2 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 79*0.2 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 86*0.25 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 80*0.35 }}" class="form-control"></td>
                                                        <td>{{ (84*0.2 + 79*0.2 + 86*0.25 + 80*0.35) }}</td>
                                                        <td>B</td>
                                                        <td>5</td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td class="table-user">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">Sophia</a>
                                                        </td>
                                                        <td><input type="text" value="{{ 83*0.2 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 78*0.2 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 85*0.25 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 79*0.35 }}" class="form-control"></td>
                                                        <td>{{ (83*0.2 + 78*0.2 + 85*0.25 + 79*0.35) }}</td>
                                                        <td>B</td>
                                                        <td>4</td>
                                                    </tr>
                                                    <tr>
                                                        <td>7</td>
                                                        <td class="table-user">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">Amelia</a>
                                                        </td>
                                                        <td><input type="text" value="{{ 70*0.2 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 72*0.2 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 70*0.25 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 79*0.35 }}" class="form-control"></td>
                                                        <td>{{ (70*0.2 + 72*0.2 + 70*0.25 + 79*0.35) }}</td>
                                                        <td>C</td>
                                                        <td>7</td>
                                                    </tr>
                                                    <tr>
                                                        <td>8</td>
                                                        <td class="table-user">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">Isabella</a>
                                                        </td>
                                                        <td><input type="text" value="{{ 65*0.2 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 72*0.2 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 65*0.25 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 62*0.35 }}" class="form-control"></td>
                                                        <td>{{ (65*0.2 + 72*0.2 + 65*0.25 + 62*0.35) }}</td>
                                                        <td>C</td>
                                                        <td>8</td>
                                                    </tr>
                                                    <tr>
                                                        <td>9</td>
                                                        <td class="table-user">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">Mia</a>
                                                        </td>
                                                        <td><input type="text" value="{{ 55*0.2 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 56*0.2 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 65*0.25 }}" class="form-control"></td>
                                                        <td><input type="text" value="{{ 50*0.35 }}" class="form-control"></td>
                                                        <td>{{ (55*0.2 + 56*0.2 + 65*0.25 + 50*0.35) }}</td>
                                                        <td>E</td>
                                                        <td>8</td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                            <div class="form-group text-right m-b-0">
                                                <button class="btn btn-primary-bl waves-effect waves-light" id="branch-filter" type="button">
                                                    Save
                                                </button>
                                            </div>
                                        </div> <!-- end table-responsive-->

                                    </div> <!-- end card body-->
                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div>


                    <span data-feather="bar-chart-2" class="icon-dual" id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">Scores by Graph
                        <hr id="hr">
                    </span>

                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="card">
                                <div class="card-body" dir="ltr">
                                    <div class="card-widgets">
                                        <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                        <a data-toggle="collapse" href="#cardCollpase3" role="button" aria-expanded="false" aria-controls="cardCollpase3"><i class="mdi mdi-minus"></i></a>
                                        <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                    </div>
                                    <h4 class="header-title mb-0">Statistics</h4>

                                    <div id="cardCollpase3" class="collapse pt-3 show">
                                        <div class="text-center">

                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <h3 data-plugin="">Frequency of Test Scores</h3>
                                                    <p class="text-muted font-13 mb-0 text-truncate">Y Axis</p>
                                                </div>
                                                <div class="col-6">
                                                    <h3 data-plugin="">Test Scores</h3>
                                                    <p class="text-muted font-13 mb-0 text-truncate">X Axis</p>
                                                </div>
                                            </div> <!-- end row -->
                                            <div id="statistics-chart" data-colors="#02c0ce" style="height: 270px;" class="morris-chart mt-3"></div>

                                        </div>
                                    </div> <!-- end collapse-->
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div>


                    <span data-feather="activity" class="icon-dual" id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">Graphs
                        <hr id="hr">
                    </span>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Test Score Analysis</h4>
                                    <div class="mt-4 chartjs-chart">
                                        <canvas id="radar-chart-test-marks" height="350" data-colors="#39afd1,#a17fe0"></canvas>
                                        <!-- <canvas id="marksChart" height="350" data-colors="#39afd1,#a17fe0"></canvas> -->
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                        <div class="col-lg-6">
                            <!-- Portlet card -->
                            <div class="card">
                                <div class="card-body" dir="ltr">
                                    <div class="card-widgets">
                                        <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                        <a data-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="false" aria-controls="cardCollpase1"><i class="mdi mdi-minus"></i></a>
                                        <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                    </div>
                                    <h4 class="header-title mb-0">Test Execution Summary</h4>

                                    <div id="cardCollpase1" class="collapse pt-3 show">
                                        <div class="text-center">
                                            <div class="row mt-2">
                                                <div class="col-3">
                                                    <h3>9</h3>
                                                    <p class="text-muted font-13 mb-0 text-truncate">Pass</p>
                                                </div>
                                                <div class="col-3">
                                                    <h3>0</h3>
                                                    <p class="text-muted font-13 mb-0 text-truncate">Fail</p>
                                                </div>
                                                <div class="col-3">
                                                    <h3>0</h3>
                                                    <p class="text-muted font-13 mb-0 text-truncate">InProgress</p>
                                                </div>
                                            </div> <!-- end row -->

                                            <div id="lifetime-sales" data-colors="#4fc6e1,#6658dd,#ebeff2" style="height: 270px;" class="morris-chart mt-3"></div>

                                        </div>
                                    </div> <!-- end collapse-->
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div>


                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


</div> <!-- container -->
@endsection