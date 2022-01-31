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
                <h4 class="page-title">By Student</h4>
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
                                    <label for="heard">Class Room<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                    <option value="">Select Class Room</option>
                                        <option value="">A</option>                                                      
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Exam Name<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                    <option value="">Select Exam Name</option>
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
                                        <th class="align-middle" rowspan="3">S.no.</th>
                                        <th class="align-middle" rowspan="3">Student Name</th>                                        
                                        <th class="text-center"colspan="14">Subject Name</th>                                
                                    </tr>   
                                    <tr>                                     
                                        <th colspan="2" class="text-center">Mathematics</th> 
                                    </tr>      
                                    <tr>
                                        <th class="text-center">Mark</th>
                                        <th class="text-center">Grade</th>                                                              
                                    </tr>                           
                                </thead>
                                <tbody>
                                    <tr>
                                    <td class="text-center">1</td>
                                   <td class="text-left">William</td>     
                                   <td class="text-center">40</td>   
                                   <td class="text-center">E</td>  
                                 
                                    </tr> 
                                    <tr>
                                   <td class="text-center">2</td>
                                   <td class="text-left">James</td>     
                                   <td class="text-center">68</td>   
                                   <td class="text-center">B+</td>  
                       
                                    </tr> 
                                    <tr>                                 
                                   <td class="text-center">3</td>
                                   <td class="text-left">Benjamin</td>     
                                   <td class="text-center">70</td>   
                                   <td class="text-center">A-</td>  
                             
                                    </tr> 
                                    <tr> 
                                   <td class="text-center">4</td>
                                   <td class="text-left">Lucas</td>     
                                   <td class="text-center">40</td>   
                                   <td class="text-center">E</td>  
                                    </tr> 
                                    <tr> 
                                   <td class="text-center">5</td>
                                   <td class="text-left">Charlotte</td>   
                                   <td class="text-center text-warning font-weight-bold">25</td>  
                                   <td class="text-center text-warning font-weight-bold">G</td>  
                                    </tr> 
                                    <tr> 
                                   <td class="text-center">6</td>
                                   <td class="text-left">Sophia</td>     
                                   <td class="text-center">60</td>   
                                   <td class="text-center">B+</td>                             
                                    </tr> 
                                    <tr>                               
                                   <td class="text-center">7</td>
                                   <td class="text-left">Amelia</td>     
                                   <td class="text-center">80</td>   
                                   <td class="text-center">A</td> 
                                    </tr>
                                    <tr> 
                                   <td class="text-center">8</td>
                                   <td class="text-left">Isabella</td>     
                                   <td class="text-center">73</td>   
                                   <td class="text-center">A-</td>  
                                    </tr>
                                    <tr> 
                                   <td class="text-center">9</td>
                                   <td class="text-left">Mia</td>     
                                   <td class="text-center">50</td>  
                                   <td class="text-center">C</td>  
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

</div> <!-- container -->

@endsection