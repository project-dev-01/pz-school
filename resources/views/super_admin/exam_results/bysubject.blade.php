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
                                    <label for="heard">Class Name<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Select Class Name</option>
                                        <option value="">A</option>
                                        <option value="">B</option>
                                        <option value="press">C</option>
                                        <option value="">D</option>
                                        <option value="press">E</option>
                                        <option value="">F</option>                             
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
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Subject (All)
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
                                        <th class="align-top" rowspan="2">{{ __('messages.subject_name') }}</th>
                                        <th class="align-top th-sm - 6 rem" rowspan="2">Tot. Students</th>
                                        <th class="align-top" rowspan="2">{{ __('messages.absent') }}</th>
                                        <th class="align-top" rowspan="2">{{ __('messages.present') }}</th>
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
                                <tr>
                                   <td class="text-center" rowspan="2">2</td>
                                   <td class="text-center" rowspan="2">History</td>
                                   <td class="text-right" rowspan="2">87</td>  
                                   <td class="text-right" >8</td>
                                   <td class="text-right" >79</td>
                                   <td class="text-center" rowspan="2">Benjamin</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">1</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">2</td>
                                   <td class="text-right">6</td>
                                   <td class="text-right">7</td>
                                   <td class="text-right">16</td>
                                   <td class="text-right">14</td>
                                   <td class="text-right" rowspan="2">7.97</td>
                                   <td class="text-right" rowspan="2">53.33</td>
                                </tr>
                                <tr>                                  
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">3.33</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">6.67</td>
                                   <td class="text-right">20.00</td>
                                   <td class="text-right">23.33</td>
                                   <td class="text-right">53.33</td>
                                   <td class="text-right">46.67</td>                              
                                </tr>
                                <tr>
                                   <td class="text-center" rowspan="2">3</td>
                                   <td class="text-center" rowspan="2">Study of the Environment</td>
                                   <td class="text-right" rowspan="2">172</td>  
                                   <td class="text-right">51</td>
                                   <td class="text-right">121</td>
                                   <td class="text-center" rowspan="2">James</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">4</td>
                                   <td class="text-right">3</td>
                                   <td class="text-right">2</td>
                                   <td class="text-right">3</td>
                                   <td class="text-right">5</td>
                                   <td class="text-right">1</td>
                                   <td class="text-right">2</td>
                                   <td class="text-right">1</td>
                                   <td class="text-right">21</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right" rowspan="2">3.89</td>
                                   <td class="text-right" rowspan="2">100.00</td>
                                </tr>
                                <tr> 
                                <td class="text-right">0.00</td>                                
                                   <td class="text-right">0.00</td>                                 
                                   <td class="text-right">0.00</td>

                                   <td class="text-right">19.05</td>
                                   <td class="text-right">14.29</td>
                                   <td class="text-right">9.52</td>
                                   <td class="text-right">14.29</td>
                                   <td class="text-right">23.81</td>
                                   <td class="text-right">4.76</td>
                                   <td class="text-right">9.52</td>
                                   <td class="text-right">4.76</td>
                                   <td class="text-right">100.00</td>  
                                   <td class="text-right">0.00</td>                              
                                </tr>
                                <tr>
                                   <td class="text-center" rowspan="2">4</td>
                                   <td class="text-center" rowspan="2">Geography</td>
                                   <td class="text-right" rowspan="2">254</td>  
                                   <td class="text-right">50</td>
                                   <td class="text-right">205</td>
                                   <td class="text-center" rowspan="2">Lucas</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">2</td>
                                   <td class="text-right">2</td>
                                   <td class="text-right">4</td>
                                   <td class="text-right">4</td>
                                   <td class="text-right">4</td>
                                   <td class="text-right">3</td>
                                   <td class="text-right">3</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">22</td>
                                   <td class="text-right">10</td>
                                   <td class="text-right" rowspan="2">5.72</td>
                                   <td class="text-right" rowspan="2">68.75</td>
                                </tr>
                                <tr> 
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">6.25</td>
                                   <td class="text-right">6.25</td>
                                   <td class="text-right">12.50</td>
                                   <td class="text-right">12.50</td>
                                   <td class="text-right">12.50</td>
                                   <td class="text-right">9.38</td>
                                   <td class="text-right">9.38</td>
                                   <td class="text-right">0.00</td>  
                                   <td class="text-right">68.75</td>   
                                   <td class="text-right">31.75</td>                              
                                </tr>
                                <tr>
                                   <td class="text-center" rowspan="2">5</td>
                                   <td class="text-center" rowspan="2">Natural Sciences</td>
                                   <td class="text-right" rowspan="2">37</td>  
                                   <td class="text-right">4</td>
                                   <td class="text-right">33</td>
                                   <td class="text-center" rowspan="2">Charlotte</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">1</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">3</td>
                                   <td class="text-right">2</td>
                                   <td class="text-right">3</td>
                                   <td class="text-right">3</td>
                                   <td class="text-right">6</td>
                                   <td class="text-right">18</td>
                                   <td class="text-right">15</td>
                                   <td class="text-right" rowspan="2">7.45</td>
                                   <td class="text-right" rowspan="2">54.55</td>
                                </tr>
                                <tr> 
                                <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">6.25</td>
                                   <td class="text-right">6.25</td>
                                   <td class="text-right">12.50</td>
                                   <td class="text-right">12.50</td>
                                   <td class="text-right">12.50</td>
                                   <td class="text-right">9.38</td>
                                   <td class="text-right">9.38</td>
                                   <td class="text-right">0.00</td>  
                                   <td class="text-right">68.75</td>   
                                   <td class="text-right">31.75</td>                              
                                </tr>
                                <tr>
                                   <td class="text-center" rowspan="2">6</td>
                                   <td class="text-center" rowspan="2">Civics Education</td>
                                   <td class="text-right" rowspan="2">35</td>  
                                   <td class="text-right">0</td>
                                   <td class="text-right">35</td>
                                   <td class="text-center" rowspan="2">Sophia</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">1</td>
                                   <td class="text-right">3</td>
                                   <td class="text-right">4</td>
                                   <td class="text-right">8</td>
                                   <td class="text-right">27</td>
                                   <td class="text-right" rowspan="2">8.63</td>
                                   <td class="text-right" rowspan="2">22.86</td>
                                </tr>
                                <tr> 
                                <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">6.25</td>
                                   <td class="text-right">6.25</td>
                                   <td class="text-right">12.50</td>
                                   <td class="text-right">12.50</td>
                                   <td class="text-right">12.50</td>
                                   <td class="text-right">9.38</td>
                                   <td class="text-right">9.38</td>
                                   <td class="text-right">0.00</td>  
                                   <td class="text-right">68.75</td>   
                                   <td class="text-right">31.75</td>                              
                                </tr>
                                <tr>
                                   <td class="text-center" rowspan="2">7</td>
                                   <td class="text-center" rowspan="2">Physical Education</td>
                                   <td class="text-right" rowspan="2">37</td>  
                                   <td class="text-right">18</td>
                                   <td class="text-right">19</td>
                                   <td class="text-center" rowspan="2">Amelia</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">1</td>
                                   <td class="text-right">1</td>
                                   <td class="text-right">3</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">5</td>
                                   <td class="text-right">14</td>
                                   <td class="text-right" rowspan="2">8.32</td>
                                   <td class="text-right" rowspan="2">26.32</td>
                                </tr>
                                <tr> 
                                <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">5.26</td>
                                   <td class="text-right">5.26</td>
                                   <td class="text-right">15.79</td>
                                   <td class="text-right">0.00</td>  
                                   <td class="text-right">26.32</td>   
                                   <td class="text-right">73.68</td>                              
                                </tr>
                                <tr>
                                   <td class="text-center" rowspan="2">8</td>
                                   <td class="text-center" rowspan="2">English</td>
                                   <td class="text-right" rowspan="2">35</td>  
                                   <td class="text-right">14</td>
                                   <td class="text-right">21</td>
                                   <td class="text-center" rowspan="2">Isabella</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">1</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">1</td>
                                   <td class="text-right">1</td>
                                   <td class="text-right">3</td>
                                   <td class="text-right">18</td>
                                   <td class="text-right" rowspan="2">8.68</td>
                                   <td class="text-right" rowspan="2">14.29</td>
                                </tr>
                                <tr> 
                                <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">4.76</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">4.76</td>
                                   <td class="text-right">4.76</td>  
                                   <td class="text-right">14.29</td>   
                                   <td class="text-right">85.71</td>                              
                                </tr>
                                <tr>
                                   <td class="text-center" rowspan="2"></td>
                                   <td class="text-center" rowspan="2">Total :</td>
                                   <td class="text-right" rowspan="2">912</td>  
                                   <td class="text-right">255</td>
                                   <td class="text-right">728</td>
                                   <td class="text-center" rowspan="2"></td>
                                   <td class="text-right">0</td>
                                   <td class="text-right">16</td>
                                   <td class="text-right">10</td>
                                   <td class="text-right">10</td>
                                   <td class="text-right">12</td>
                                   <td class="text-right">17</td>
                                   <td class="text-right">11</td>
                                   <td class="text-right">21</td>
                                   <td class="text-right">19</td>
                                   <td class="text-right">116</td>
                                   <td class="text-right">99</td>
                                   <td class="text-right" rowspan="2">6.77</td>
                                   <td class="text-right" rowspan="2">15.95</td>
                                </tr>
                                <tr>  
                                <td class="text-right">27.96</td>
                                   <td class="text-right">79.82</td>                                                                 <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">4.76</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">0.00</td>
                                   <td class="text-right">4.76</td>
                                   <td class="text-right">4.76</td>  
                                   <td class="text-right">14.29</td>   
                                   <td class="text-right">85.71</td>                              
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
                        <canvas id="radar-chart-test-bystudentmarks" height="350" data-colors="#39afd1,#a17fe0"></canvas>
                        <!-- <canvas id="marksChart" height="350" data-colors="#39afd1,#a17fe0"></canvas> -->
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
</div> <!-- container -->

@endsection