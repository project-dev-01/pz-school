@extends('layouts.admin-layout')
@section('title','Vehicle Master')
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
                        <li class="breadcrumb-item active">Branch</li>
                    </ol>-->
                </div> 
                <h4 class="page-title">Vehicle Master</h4>
            </div>
        </div>
    </div>     
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                <ul class="nav nav-tabs nav-bordered">
                    <li class="nav-item">
                        <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                        Vehicle List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Create Vehicle
                        </a>
                    </li> 
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="profile-b1">
                            <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Vehicle No</th>
                                <th>Capacity</th>
                                <th>Driver Name</th>
                                <th>Driver Phone</th>
                                <th>Driver License</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>TN 32-0011</td>
                                <td>30</td>
                                <td>Kumaran</td>
                                <td>998763676</td>
                                <td>165783999333</td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
                    </div>
                    <div class="tab-pane" id="home-b1">
                        <form id="demo-form" >                                         
                    <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">Vehicle No<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="email" required parsley-type="email" class="form-control"
                                    id="inputEmail3" placeholder="">
                        </div>
                    </div>
                    </div>
                    
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">Route Name<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="email" required parsley-type="email" class="form-control"
                                    id="inputEmail3" placeholder="">
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">Capacity<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="email" required parsley-type="email" class="form-control"
                                    id="inputEmail3" placeholder="">
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">Driver Name<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="email" required parsley-type="email" class="form-control"
                                    id="inputEmail3" placeholder="">
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">Driver Phone<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="email" required parsley-type="email" class="form-control"
                                    id="inputEmail3" placeholder="">
                        </div>
                    </div>
                    </div>
                   
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">Driver License<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="email" required parsley-type="email" class="form-control"
                                    id="inputEmail3" placeholder="">
                        </div>
                    </div>
                    </div>
                    </div>										
                    <div class="col-md-2"></div>
                    </div>										  
                </form>
                <div class="col-8 offset-4" style="margin-left:34%;">
                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                                Save
                            </button>
                            
                        </div> 
                    </div>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

        
</div> <!-- container -->

</div>
<!-- container -->
@endsection