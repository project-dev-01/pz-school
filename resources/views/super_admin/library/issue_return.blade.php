@extends('layouts.admin-layout')
@section('title','Book Manage')
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
                <h4 class="page-title">Book Manage</h4>
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
                            Book List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                             Book Issue
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
                                <th>Branch</th>
                                <th>Book Title</th>
                                <th>Cover</th>
                                <th>Role</th>
                                <th>User name</th>
                                <th>Date of Issue</th>
                                <th>Date of Expiry</th>
                                <th>Fine</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Kuala Lumpur</td>
                                <td>Brilliant</td>
                                <td>NSP</td>
                                <td>Teacher</td>
                                <td>Anish</td>
                                <td>26-01-2022</td>
                                <td>28-02-2022</td>
                                <td></td>
                                <td>Issued</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Kuala Lumpur</td>
                                <td>Mainframe Computer</td>
                                <td>MFC</td>
                                <td>Student</td>
                                <td>William</td>
                                <td>21-01-2022</td>
                                <td>18-02-2022</td>
                                <td>50</td>
                                <td>Returned</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Kuala Lumpur</td>
                                <td>Networking</td>
                                <td>NTW</td>
                                <td>Student</td>
                                <td>Mia</td>
                                <td>26-01-2022</td>
                                <td>11-03-2022</td>
                                <td></td>
                                <td>Issued</td>
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
                        <label for="inputEmail3" class="col-3 col-form-label">Branch<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <select id="heard" class="form-control" required="">
                            <option value="">Select</option>
                            <option value="">Malaysia</option>
                            <option value="">Singapore</option>
                        </select>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">Book Category<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <select id="heard" class="form-control" required="">
                            <option value="">Select</option>
                            <option value="press">Communication</option>
                            <option value="net">Network</option>
                            <option value="mouth">Technology</option>
                            <option value="other">Story</option>
                        </select>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">Book Title<span class="text-danger">*</span></label>
                        <div class="col-9">
                        <input type="text" required parsley-type="email" class="form-control"
                                    id="inputEmail3" placeholder="">
                        </select>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">Role</label>
                        <div class="col-9">
                            <input type="email" required parsley-type="email" class="form-control"
                                    id="inputEmail3" placeholder="">
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">User Name</label>
                        <div class="col-9">
                            <input type="email" required parsley-type="email" class="form-control"
                                    id="inputEmail3" placeholder="">
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">Date of Expiry<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="email" required parsley-type="email" class="form-control homeWorkAdd"
                                    id="inputEmail3" placeholder="">
                        </div>
                    </div>
                    </div>								
                    </div>										
                    <div class="col-md-2"></div>
                    </div>										  
                </form>
                <div class="col-8 offset-4" style="margin-left:34%;">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
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
@endsection