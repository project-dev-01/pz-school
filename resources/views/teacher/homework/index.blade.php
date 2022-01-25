@extends('layouts.admin-layout')
@section('title','Homework')
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
                <span class=" fas fa-user-graduate  " id="parent"></span>
                    <span class="header-title mb-3" id="parent">Add Homework</span>
                <hr>
                    
                    <form id="demo-form" data-parsley-validate="">                                         
                    <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-9">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-3 col-form-label">Class<span class="text-danger">*</span></label>
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
                        <label for="inputEmail3" class="col-3 col-form-label">Section<span class="text-danger">*</span></label>
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
                        <label for="inputEmail3" class="col-3 col-form-label">Subject<span class="text-danger">*</span></label>
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
                        <label for="inputEmail3" class="col-3 col-form-label">Date Of Homework<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="far fa-calendar-alt"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">Date Of Submission<span class="text-danger">*</span></label>
                        <div class="col-9">
                                <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="far fa-calendar-alt"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div>
                    </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-8 offset-3">
                            <div class="checkbox checkbox-purple">
                                <input id="checkbox6" type="checkbox">
                                <label for="checkbox6">
                                    Published later
                                </label>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-12">
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">Schedule Date<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="far fa-calendar-alt"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">Homework<span class="text-danger">*</span></label>
                        <div class="col-9">
                                <textarea class="form-control" id="product-description" rows="5" placeholder="Please enter description"></textarea>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">Attachment File<span class="text-danger">*</span></label>
                        <div class="col-9">
                                <div class="input-group m-b-20">
                                <input class="form-control" id="single-input" type="text" value="" placeholder="">
                                <div class="input-group-append">
                                    <button type="button" id="check-minutes" class="btn waves-effect waves-light btn-primary-bl">Select File</button>
                                </div>
                            </div> 
                        </div>
                    </div>
                    </div>
                        <div class="form-group row">
                        <div class="col-8 offset-3">
                            <div class="checkbox checkbox-purple">
                                <input id="checkbox6" type="checkbox">
                                <label for="checkbox6">
                                    Send Notification Sms
                                </label>
                            </div>
                        </div>
                    </div>
                    </div>										
                    <div class="col-md-1"></div>
                    </div>
                        
                </form>
                    <div class="col-8 offset-4">
                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                                Save
                            </button>
                            
                        </div>                                      
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

        </div> 
    <!-- end row -->


    
</div> <!-- container -->
@endsection