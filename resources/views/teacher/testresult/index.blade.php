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
                    <span data-feather="clipboard" class="icon-dual"id="parent"></span>
                        <span class="header-title mb-3" id="parent">Test Result</span>
                    <hr>
                    <span data-feather="edit" class="icon-dual" id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">Marks By Subject 
                    <hr id="hr"></span>
                    
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
                                    <div class="table-responsive">
                                        <table class="table w-100 nowrap" id="">
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
                                                    <td>Amirtha</td>
                                                    <td><input type="text" value="90" class="form-control"></td>
                                                    <td><input type="text" value="S" class="form-control" readonly></td>
                                                    <td>1</td>
                                                    <td><input type="text" value="" class="form-control" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Vimal</td>
                                                    <td><input type="text" value="85" class="form-control"></td>
                                                    <td><input type="text" value="A" class="form-control" readonly></td>
                                                    <td>2</td>
                                                    <td><input type="text" value="" class="form-control" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Krishna</td>
                                                    <td><input type="text" value="78" class="form-control"></td>
                                                    <td><input type="text" value="B" class="form-control" readonly></td>
                                                    <td>3</td>
                                                    <td><input type="text" value="" class="form-control" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Vishnu Priya</td>
                                                    <td><input type="text" value="70" class="form-control"></td>
                                                    <td><input type="text" value="C" class="form-control" readonly></td>
                                                    <td>4</td>
                                                    <td><input type="text" value="" class="form-control" readonly></td>
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
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div>

                    <span data-feather="bar-chart-2" class="icon-dual" id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">Scores by Graph
                    <hr id="hr"></span>

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

                    <span data-feather="book-open" class="icon-dual" id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">Total Marks 
                    <hr id="hr"></span>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table w-100 nowrap" id="">
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
                                                    <td>Amirtha</td>
                                                    <td><input type="text" value="90" class="form-control"></td>
                                                    <td><input type="text" value="80" class="form-control"></td>
                                                    <td><input type="text" value="95" class="form-control"></td>
                                                    <td><input type="text" value="85" class="form-control"></td>
                                                    <td>350</td>
                                                    <td><input type="text" value="S" class="form-control" readonly></td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Vimal</td>
                                                    <td><input type="text" value="85" class="form-control"></td>
                                                    <td><input type="text" value="80" class="form-control"></td>
                                                    <td><input type="text" value="90" class="form-control"></td>
                                                    <td><input type="text" value="80" class="form-control"></td>
                                                    <td>335</td>
                                                    <td><input type="text" value="A" class="form-control" readonly></td>
                                                    <td>2</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Krishna</td>
                                                    <td><input type="text" value="75" class="form-control"></td>
                                                    <td><input type="text" value="70" class="form-control"></td>
                                                    <td><input type="text" value="75" class="form-control"></td>
                                                    <td><input type="text" value="70" class="form-control"></td>
                                                    <td>300</td>
                                                    <td><input type="text" value="B" class="form-control" readonly></td>
                                                    <td>3</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Vishnu Priya</td>
                                                    <td><input type="text" value="70" class="form-control"></td>
                                                    <td><input type="text" value="70" class="form-control"></td>
                                                    <td><input type="text" value="70" class="form-control"></td>
                                                    <td><input type="text" value="70" class="form-control"></td>
                                                    <td>280</td>
                                                    <td><input type="text" value="C" class="form-control" readonly></td>
                                                    <td>4</td>
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
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div>

                    <span data-feather="activity" class="icon-dual" id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">Graphs
                    <hr id="hr"></span>

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
                                                        <h3 >47</h3>
                                                        <p class="text-muted font-13 mb-0 text-truncate">Pass</p>
                                                    </div>
                                                    <div class="col-3">
                                                        <h3 >4</h3>
                                                        <p class="text-muted font-13 mb-0 text-truncate">Fail</p>
                                                    </div>
                                                    <div class="col-3">
                                                        <h3 >23</h3>
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
