@extends('layouts.admin-layout')
@section('title','By Subject')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">              
                </div>
                <h4 class="page-title">By Subject</h4>
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
                                    <label for="heard">Standard<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Select Standard</option>                                   
                                        <option value="">I</option>                                    
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Class Rome<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">                                    
                                        <option value="">A</option>                                                              
                                    </select>
                                </div>
                            </div>                                                
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Exam Name<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Annual</option>
                                        <option value="">Quarterly</option>
                                    </select>
                                </div>
                            </div>                                                                    
                        </div>
                    </form>
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                            Get
                        </button>                 
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
                            Subject (Mathematics)
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                            <div class="table-responsive">
                            <table class="table w-100 nowrap table-bordered table-striped" id="">
                                <thead>
                                    <tr>
                                        <th class="align-top" rowspan="2">S.no.</th>
                                        <th class="align-top" rowspan="2">Subject Name</th>
                                        <th class="align-top th-sm - 6 rem" rowspan="2">Tot. Students</th>
                                        <th class="align-top" rowspan="2">Absent</th>
                                        <th class="align-top" rowspan="2">Present</th>
                                        <th class="align-top" rowspan="2">Class Teacher Name</th>
                                        <th class="text-center">A+</th>
                                        <th class="text-center">A</th>
                                        <th class="text-center">A-</th>
                                        <th class="text-center">B+</th>
                                        <th class="text-center">B</th>
                                        <th class="text-center">C+</th>
                                        <th class="text-center">C</th>
                                        <th class="text-center">D</th>
                                        <th class="text-center">E</th>
                                        <th class="text-center">PASS</th>
                                        <th class="text-center">G</th>
                                        <th class="text-center">Avg. grade of subject</th>
                                        <th class="text-center">%</th>
                                    </tr>
                                    <tr>
                                    <td class="text-center">%</td>
                                    <td class="text-center">%</td>
                                    <td class="text-center">%</td>
                                    <td class="text-center">%</td>                                   
                                    <td class="text-center">%</td>
                                    <td class="text-center">%</td>
                                    <td class="text-center">%</td>
                                    <td class="text-center">%</td>
                                    <td class="text-center">%</td>
                                    <td class="text-center">%</td>
                                    <td class="text-center">%</td>
                                    <td class="text-center">%</td>
                                    <td class="text-center">%</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                   <td class="text-center" rowspan="2">1</td>
                                   <td class="text-center" rowspan="2">Mathematics</td>
                                   <td class="text-right" rowspan="2">255</td>  
                                   <td class="text-right">40</td>
                                   <td class="text-right">215</td>
                                   <td class="text-center" rowspan="2">William</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">10</td>
                                   <td class="text-right">4</td>
                                   <td class="text-right">3</td>
                                   <td class="text-right">1</td>
                                   <td class="text-right">5</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">23</td>
                                   <td class="text-right">1</td>
                                   <td class="text-right" rowspan="2">2.71</td>
                                   <td class="text-right" rowspan="2">95.83</td>
                                </tr>
                                <tr>  
                                <td class="text-right">0.00</td>  
                                    <td class="text-right">0.00</td>                                
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">41.67</td>
                                   <td class="text-right">16.67</td>
                                   <td class="text-right">12.50</td>
                                   <td class="text-right">4.17</td>
                                   <td class="text-right">20.83</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">95.83</td>
                                   <td class="text-right">4.17</td>                              
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Subject Analysis</h4>

                    <div class="mt-4 chartjs-chart">
                        <canvas id="radar-chart-test-teacher-bystudentmarks" height="350" data-colors="#39afd1,#a17fe0"></canvas>
                        <!-- <canvas id="marksChart" height="350" data-colors="#39afd1,#a17fe0"></canvas> -->
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
</div> <!-- container -->

@endsection