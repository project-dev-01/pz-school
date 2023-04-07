@extends('layouts.admin-layout')
@section('title','By Student')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">              
                </div>
                <h4 class="page-title">{{ __('messages.by_student') }}</h4>
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
                                    <label for="heard">{{ __('messages.standard') }}<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">{{ __('messages.select_standard') }}</option>
                                        <option value="">{{ __('messages.all') }}</option>
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
                                    <label for="heard">{{ __('messages.class_Name') }}<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                    <option value="">{{ __('messages.select_class') }}</option>
                                        <option value="">A</option>
                                        <option value="">B</option>
                                        <option value="press">C</option>
                                        <option value="">D</option>
                                        <option value="press">E</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">{{ __('messages.exam_name') }}<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                    <option value="">{{ __('messages.select_exam_name') }}e</option>
                                        <option value="">Annual</option>
                                        <option value="">Quarterly</option>
                                    </select>
                                </div>
                            </div>                                               
                        </div>
                    </form>
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                        {{ __('messages.get') }}
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
                            Student (All)
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
                                        <th class="align-middle" rowspan="3">{{ __('messages.s.no.') }}</th>                                    
                                        <th class="align-middle" rowspan="3">{{ __('messages.student_name') }}</th>                                   
                                        <th class="text-center"colspan="14">{{ __('messages.subject_name') }}</th>                            
                                    </tr>   
                                    <tr>
                                        <th colspan="2" class="align-top">English</th>
                                        <th colspan="2" class="align-top">Mathematics</th>                                        
                                        <th colspan="2" class="text-center">History</th> 
                                        <th colspan="2" class="align-top">Study of the Environment</th>
                                        <th colspan="2" class="align-top">Geography</th>                                        
                                        <th colspan="2" class="text-center">Natural Sciences</th>      
                                        <th colspan="2" class="text-center">Civics Education</th>                               
                                    </tr>      
                                    <tr>
                                        <th class="align-top">{{ __('messages.mark') }}</th>
                                        <th class="align-top">{{ __('messages.grade') }}</th> 
                                        <th class="text-center">{{ __('messages.mark') }}</th> 
                                        <th class="align-top">{{ __('messages.grade') }}</th>
                                        <th class="align-top">{{ __('messages.mark') }}</th>                                        
                                        <th class="text-center">{{ __('messages.grade') }}</th>
                                        <th class="text-center">{{ __('messages.mark') }}</th>  
                                        <th class="align-top">{{ __('messages.grade') }}</th>                                                                       
                                        <th class="text-center">{{ __('messages.mark') }}</th> 
                                        <th class="align-top">{{ __('messages.grade') }}</th>
                                        <th class="align-top">{{ __('messages.mark') }}</th>  
                                        <th class="text-center">{{ __('messages.grade') }}</th>      
                                        <th class="text-center">{{ __('messages.mark') }}</th>  
                                        <th class="text-center">{{ __('messages.grade') }}</th>                                
                                    </tr>                           
                                </thead>
                                <tbody>
                                    <tr>
                                    <td class="text-center">1</td>
                                   <td class="text-left">William</td>     
                                   <td class="text-center">40</td>   
                                   <td class="text-center">E</td>  
                                   <td class="text-center">80</td>  
                                   <td class="text-center">A</td>  
                                   <td class="text-center">23</td>  
                                   <td class="text-center">G</td>                   
                                   <td class="text-center">43</td>  
                                   <td class="text-center">E</td>  
                                   <td class="text-center">54</td>  
                                   <td class="text-center">C</td>  
                                   <td class="text-center">40</td>  
                                   <td class="text-center">E</td>  
                                   <td class="text-center">63</td>  
                                   <td class="text-center">B</td>
                                    </tr> 
                                    <tr>
                                   <td class="text-center">2</td>
                                   <td class="text-left">James</td>     
                                   <td class="text-center">68</td>   
                                   <td class="text-center">B+</td>  
                                   <td class="text-center">73</td>  
                                   <td class="text-center">A-</td>  
                                   <td class="text-center">40</td>  
                                   <td class="text-center">E</td>                   
                                   <td class="text-center">71</td>  
                                   <td class="text-center">A-</td>  
                                   <td class="text-center">90</td>  
                                   <td class="text-center">A+</td>  
                                   <td class="text-center">58</td>  
                                   <td class="text-center">C+</td>  
                                   <td class="text-center">95</td>  
                                   <td class="text-center">A+</td>
                                    </tr> 
                                    <tr>                                 
                                   <td class="text-center">3</td>
                                   <td class="text-left">Benjamin</td>     
                                   <td class="text-center">70</td>   
                                   <td class="text-center">A-</td>  
                                   <td class="text-center">61</td>  
                                   <td class="text-center">B</td>  
                                   <td class="text-center">50</td>  
                                   <td class="text-center">C</td>                   
                                   <td class="text-center">80</td>  
                                   <td class="text-center">A</td>  
                                   <td class="text-center">78</td>  
                                   <td class="text-center">A-</td>  
                                   <td class="text-center">73</td>  
                                   <td class="text-center">A-</td>  
                                   <td class="text-center">63</td>  
                                   <td class="text-center">B</td>
                                    </tr> 
                                    <tr> 
                                   <td class="text-center">4</td>
                                   <td class="text-left">Lucas</td>     
                                   <td class="text-center">40</td>   
                                   <td class="text-center">D</td>  
                                   <td class="text-center">52</td>  
                                   <td class="text-center">C</td>  
                                   <td class="text-center">45</td>  
                                   <td class="text-center">D</td>                   
                                   <td class="text-center">50</td>  
                                   <td class="text-center">C</td>  
                                   <td class="text-center text-warning font-weight-bold">5</td>  
                                   <td class="text-center text-warning font-weight-bold">G</td>  
                                   <td class="text-center">40</td>  
                                   <td class="text-center">E</td>  
                                   <td class="text-center">63</td>  
                                   <td class="text-center">B</td>
                                    </tr> 
                                    <tr> 
                                   <td class="text-center">5</td>
                                   <td class="text-left">Charlotte</td>     
                                   <td class="text-center">48</td>   
                                   <td class="text-center">D</td>  
                                   <td class="text-center">52</td>  
                                   <td class="text-center">C</td>  
                                   <td class="text-center text-warning font-weight-bold">25</td>  
                                   <td class="text-center text-warning font-weight-bold">G</td>                   
                                   <td class="text-center">50</td>  
                                   <td class="text-center">C</td>  
                                   <td class="text-center">51</td>  
                                   <td class="text-center">C</td>  
                                   <td class="text-center">40</td>  
                                   <td class="text-center">E</td>  
                                   <td class="text-center text-warning font-weight-bold">20</td>  
                                   <td class="text-center text-warning font-weight-bold">G</td>
                                    </tr> 
                                    <tr> 
                                   <td class="text-center">6</td>
                                   <td class="text-left">Sophia</td>     
                                   <td class="text-center">60</td>   
                                   <td class="text-center">B+</td>  
                                   <td class="text-center">68</td>  
                                   <td class="text-center">B+</td>  
                                   <td class="text-center">60</td>  
                                   <td class="text-center">B</td>                   
                                   <td class="text-center">37</td>  
                                   <td class="text-center">G</td>  
                                   <td class="text-center text-warning font-weight-bold">20</td>  
                                   <td class="text-center text-warning font-weight-bold">G</td>  
                                   <td class="text-center text-warning font-weight-bold">28</td>  
                                   <td class="text-center text-warning font-weight-bold">G</td>  
                                   <td class="text-center text-warning font-weight-bold">20</td>  
                                   <td class="text-center text-warning font-weight-bold">G</td>
                                    </tr> 
                                    <tr>                               
                                   <td class="text-center">7</td>
                                   <td class="text-left">Amelia</td>     
                                   <td class="text-center">80</td>   
                                   <td class="text-center">A</td>  
                                   <td class="text-center text-warning font-weight-bold">33</td>  
                                   <td class="text-center text-warning font-weight-bold">G</td>  
                                   <td class="text-center">54</td>  
                                   <td class="text-center">C</td>                   
                                   <td class="text-center">74</td>  
                                   <td class="text-center">A-</td>  
                                   <td class="text-center">80</td>  
                                   <td class="text-center">A</td>  
                                   <td class="text-center">55</td>  
                                   <td class="text-center">C+</td>  
                                   <td class="text-center">55</td>  
                                   <td class="text-center">C+</td>
                                    </tr>
                                    <tr> 
                                   <td class="text-center">8</td>
                                   <td class="text-left">Isabella</td>     
                                   <td class="text-center">73</td>   
                                   <td class="text-center">A-</td>  
                                   <td class="text-center">50</td>  
                                   <td class="text-center">C</td>  
                                   <td class="text-center">80</td>  
                                   <td class="text-center">A</td>                   
                                   <td class="text-center">43</td>  
                                   <td class="text-center">E</td>  
                                   <td class="text-center">87</td>  
                                   <td class="text-center">A</td>  
                                   <td class="text-center">69</td>  
                                   <td class="text-center">B+</td>  
                                   <td class="text-center">60</td>  
                                   <td class="text-center">B</td>
                                    </tr>
                                    <tr> 
                                   <td class="text-center">9</td>
                                   <td class="text-left">Mia</td>     
                                   <td class="text-center">50</td>   
                                   <td class="text-center">C</td>  
                                   <td class="text-center">92</td>  
                                   <td class="text-center">A+</td>  
                                   <td class="text-center">90</td>  
                                   <td class="text-center">A</td>                   
                                   <td class="text-center">75</td>  
                                   <td class="text-center">A-</td>  
                                   <td class="text-center">87</td>  
                                   <td class="text-center">A</td>  
                                   <td class="text-center">50</td>  
                                   <td class="text-center">C</td>  
                                   <td class="text-center">90</td>  
                                   <td class="text-center">A</td>
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
                    <h4 class="header-title">Student Analysis</h4>

                    <div class="mt-4 chartjs-chart">
                        <canvas id="radar-chart-test-bystudent" height="350" data-colors="#39afd1,#a17fe0"></canvas>
                        <!-- <canvas id="marksChart" height="350" data-colors="#39afd1,#a17fe0"></canvas> -->
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
</div> <!-- container -->

@endsection