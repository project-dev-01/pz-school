@extends('layouts.admin-layout')
@section('title','All Leaves')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

 <!-- start page title -->
 <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">                   
                </div>
                <h4 class="page-title">All Leaves</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

     <!--General Details -->
     <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                        <span class="fab fa-audible" id="span-parent"></span>
                         Select Ground
                            <h4>
                    </li>
                </ul><br>           

                <div class="card-body">
                <form id="demo-form" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Employee Name</label>
                                    <input class="form-control" type="text" placeholder="Enter your Name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Leave Status</label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Approved</option>
                                        <option value="">Pending</option>
                                        <option value="">Decline</option>
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
        <div class="col-xl-12">
            <div class="card">
            <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                        <span class="fas fa-stream" id="span-parent"></span>
                         Leave List
                            <h4>
                    </li>
                </ul><br>           

                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="">
                        <div class="row">
                        <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>                                               
                                                <th class="text-center">S.no</th>
                                                <th class="text-center">Employee Name</th>
                                                <th class="text-center">No.Of.Days</th>                                                                                             
                                                <th class="text-center">Reason(s)</th>  
                                                <th class="text-center">Admin Remarks</th>                                                                                                
                                                <th class="text-center">Leave Status</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>                                                
                                                <td>Arun kumar</td>                                                
                                                <td class="text-center">1</td>
                                                <td>Festival</td>
                                                <td class="text-success">Approved</td>                                                
                                                <td class="text-success">Approved</td> 
                                            </tr>
                                            
                                            <tr>
                                                <td class="text-center">2</td>                                                
                                                <td>kumar</td>                                                
                                                <td class="text-center">3</td>
                                                <td>Festival</td>                                                
                                                <td class="text-success">Approved</td>                                                
                                                <td class="text-success">Approved</td> 
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>                                                
                                                <td>Mohan</td>                                                
                                                <td class="text-center">2</td>
                                                <td>Fever</td>                                                
                                                <td class="text-success">Approved</td>                                                
                                                <td class="text-success">Approved</td> 
                                            </tr>
                                            <tr>
                                                <td class="text-center">4</td>                                                
                                                <td>Haja</td>                                                
                                                <td class="text-center">1</td>
                                                <td>Festival</td>                                                
                                                <td class="text-danger">Your request is Rejected</td>                                                
                                                <td class="text-danger">Rejected</td> 
                                            </tr>
                                            <tr>
                                                <td class="text-center">5</td>                                                
                                                <td>Karthi</td>                                                
                                                <td class="text-center">1</td>
                                                <td>Festival</td>                           
                                                <td class="text-warning">Waiting for approval</td>                                                                     
                                                <td class="text-warning">Waiting for approval</td> 
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
   <!-- end row -->


   @include('super_admin.leave_management.leavedetailsmf')
</div> <!-- container -->

@endsection