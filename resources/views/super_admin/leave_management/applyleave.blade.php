@extends('layouts.admin-layout')
@section('title','LeaveManagement')
@section('content')

 <!-- Start Content-->
<div class="container-fluid">
    
<div class="row">
    <div class="col-xl-12">
        <div class="card">
        <div class="card-body">                
                <span class="fas fa-cubes" id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">Leave Can Avail
                    <hr id="hr"></span>
                    <div class="border mt-4 mt-lg-0 rounded">
                    <div class="row">
                        <div class="col-lg-3" id="top-header">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="fas fa-hat-wizard font-24"></i>
                                            <p class="text-muted mb-1">Annual</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1" style="color:blue"><span data-plugin="counterup">0</span></h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="text-muted float-right">Total Strength</span></h6>
                                </div>

                            </div>
                        </div><!-- end col-->
                        <div class="col-lg-3" id="top-header">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="fas fa-clinic-medical font-24"></i>
                                            <p class="text-muted mb-1">Medical</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1" style="color:blue"><span data-plugin="counterup">2</span></h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="text-muted float-right">Total Strength</span></h6>
                                </div>

                            </div>
                        </div><!-- end col-->
                        <div class="col-lg-3" id="top-header">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="fas fa-compass font-24"></i>
                                            <p class="text-muted mb-1">Compassionate</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1" style="color:blue"><span data-plugin="counterup">1</span></h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="text-muted float-right">Total Strength</span></h6>
                                </div>

                            </div>
                        </div><!-- end col-->
                        <div class="col-lg-3">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="fas fa-receipt font-24"></i>
                                            <p class="text-muted mb-1">Unpaid</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1" style="color:blue"><span data-plugin="counterup">0</span></h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="text-muted float-right">Total Strength</span></h6>
                                </div>
                            </div> <!-- end card-box-->
                        </div>
                    </div><!-- end col-->
                </div> <!-- end row -->


                <!--General Details -->
                <span class="fab fa-audible" id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">General Details
                    <hr id="hr"></span>
                    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                
                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="" autocomplete="off">
                        <!--1st row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heard">Leave Requested<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                    <option value="Ann">Annual</option>
                                    <option value="med">Medical</option>
                                    <option value="com">Compensate</option>
                                    <option value="unpaid">Unpaid</option>
                                    <option value="other">Other..</option>      
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heard">Leave From<span class="text-danger">*</span></label>                                   
                                    <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="far fa-calendar-alt"></span>
                                    </div>
                                </div>
                                <input type="text" class="form-control homeWorkAdd" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                                    <label for="heard">To<span class="text-danger">*</span></label>                                   
                                    <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="far fa-calendar-alt"></span>
                                    </div>
                                </div>
                                <input type="text" class="form-control homeWorkAdd" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!--2st row-->
                        <div class="row">
                            <div class="col-md-8">
                            <label for="message">Reason(s)<span class="text-danger">*</span></label>
                            <textarea id="message" class="form-control" name="message"
                            data-parsley-trigger="keyup" data-parsley-minlength="20"
                            data-parsley-maxlength="100"
                            data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.."
                            data-parsley-validation-threshold="10">
                            </textarea>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heard">Posting Date<span class="text-danger">*</span></label>                                   
                                    <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="far fa-calendar-alt"></span>
                                    </div>
                                </div>
                                <input type="text" class="form-control homeWorkAdd" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                                </div>
                            </div>                          
                        </div>
                         <!--3rd row-->
                         <br/>
                         <div class="row">
                            <div class="col-md-4">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="Save">Submit</button>
                            </div>
                            <div class="col-md-4">
                                
                              
                            </div>                          
                        </div>
                    </form>                 

                </div> <!-- end card-body -->
            </div> <!-- end card-->
         </div> <!-- end col -->
        </div>                    
                    
                <!--Last Leave Taken -->
                  <span class="fas fa-stream" id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">Leave History
                    <hr id="hr"></span><br>
                    <div class="border mt-4 mt-lg-0 rounded">
                    <div class="row">
        <div class="col-xl-12">
            <div class="card">               
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>                                               
                                                <th class="text-center">S.no</th>
                                                <th class="text-center">Leave Type</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Reason(s)</th> 
                                                <th class="text-center">Admin Remarks</th>  
                                                <th class="text-center">Leave Status</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>                                                
                                                <td>Annual</td>
                                                <td class="text-center">02/01/2022</td>
                                                <td>Festival</td>
                                                <td class="text-warning">Waiting for approval</td>  
                                                <td class="text-warning">Waiting for approval</td>                                                
                                            </tr>
                                            
                                            <tr>
                                                <td class="text-center">2</td>                                                
                                                <td>Unpaid</td>
                                                <td class="text-center">10/12/2021</td>
                                                <td>Fever</td>          
                                                <td class="text-success">Approved</td>          
                                                <td class="text-success">Approved</td>
                                                                                       
                                            </tr>
                                            
                                            <tr>
                                                <td class="text-center">3</td>                                                
                                                <td>Medical</td>
                                                <td class="text-center">05/08/2021</td>
                                                <td>Festival</td> 
                                                <td class="text-danger">your request is Rejected</td>          
                                                <td class="text-danger">Rejected</td>                                                
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
    </div>

    </div>

        </div>
    </div>
</div>
</div>
@endsection

