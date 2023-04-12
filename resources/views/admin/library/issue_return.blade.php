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
                                <th>Book Title</th>
                                <th>Cover</th>
                                <th>{{ __('messages.role') }}</th>
                                <th>User name</th>
                                <th>Date of Issue</th>
                                <th>Date of Expiry</th>
                                <th>Fine</th>
                                <th>{{ __('messages.status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                                <td>1</td>
                                <td>Oxford Dictionary</td>
                                <td>Oxford Dictionary of English</td>
                                <td>Dictionary</td>
                                <td>William</td>
                                <td>02/02/2022</td>
                                <td>02/03/2022</td>
                                <td>0</td>
                                <td> 
                                    <div class="button-list">
                                        <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="" id="viewEventBtn">View</a>
                                        <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="" id="deleteEventBtn">{{ __('messages.delete') }}</a>
                                    </div>
                                </td>
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
                        <label for="inputEmail3" class="col-3 col-form-label">Book Category<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <select id="heard" class="form-control" required="">
                            <option value="">select</option>
                            <option value="press">Press</option>
                            <option value="net">Internet</option>
                            <option value="mouth">Word of mouth</option>
                            <option value="other">Other..</option>
                        </select>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">Book Title<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <select id="heard" class="form-control" required="">
                            <option value="">select</option>
                            <option value="press">Press</option>
                            <option value="net">Internet</option>
                            <option value="mouth">Word of mouth</option>
                            <option value="other">Other..</option>
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
                            {{ __('messages.save') }}
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