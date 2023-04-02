@extends('layouts.admin-layout')
@section('title','Parent')
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
    <style>
    
    </style>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <span class=" fas fa-user-circle" id="parent" style=""></span>
                    <span class="header-title mb-3" id="parent">{{ __('messages.add_parent') }}</span>
                <hr>						
                <form id="demo-form" data-parsley-validate="">
                    <span class="fas fa-user-check  " id="span-parent"></span>
                    <span class="header-title mb-3"id="span-parent">Parent Details
                    <hr id="hr"></span>
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="">{{ __('messages.name') }}<span class="text-danger">*</span></label>												
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="far fa-user"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div> 
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('messages.relation') }}<span class="text-danger">*</span></label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    </div>
                        <div class="row">
                        <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('messages.father_name') }}<span class="text-danger">*</span></label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('messages.mother_name') }}<span class="text-danger">*</span></label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                    <div class="form-group">
                        <label for="">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('messages.income') }}</label>
                                <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="fas fa-calculator"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label for="">{{ __('messages.education') }}</label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    </div>
                        <div class="row">
                        <div class="col-md-4">
                    <div class="form-group">
                        <label for="">{{ __('messages.city') }}</label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label for="">{{ __('messages.state') }}</label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">Mobile No<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="fas fa-phone-volume"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div> 
                    </div>
                    </div>

                    <div class="form-group">
                        <label for="message">Address</label>
                        <textarea id="message" class="form-control" name="message"
                            data-parsley-trigger="keyup" data-parsley-minlength="20"
                            data-parsley-maxlength="100"
                            data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.."
                            data-parsley-validation-threshold="10">
                        </textarea>
                    </div>
                    <span class="fas fa-user-lock " id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">  {{ __('messages.login_details') }}
                    <hr id="hr"></span>
                    
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="far fa-envelope-open"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div> 
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="email">{{ __('messages.password') }}<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="fas fa-unlock"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div> 
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="email">{{ __('messages.retype_password') }}<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="fas fa-unlock"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div> 
                    </div>
                    </div>
                    <span class="fas fa-globe  " id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">{{ __('messages.social_links') }}
                    <hr id="hr"></span>
                        <div class="row">
                        <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="validationCustomUsername">{{ __('messages.facebook') }}</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="fab fa-facebook-f"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div>                                      
                    </div>
                    <div class="col-md-4">
                    <div class="form-group mb-3">
                            <label for="validationCustomUsername">{{ __('messages.twitter') }}</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="fab fa-twitter"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                    <div class="form-group mb-3">
                            <label for="validationCustomUsername">{{ __('messages.linkedin') }}</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="fab fa-linkedin-in"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div> 
                    </div>
                    </div>

                        <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                            Save
                        </button>
                        <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                            Cancel
                        </button>-->
                    </div>
                </form>
            
                    
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

        </div> 
    <!-- end row -->


    
</div> <!-- container -->
@endsection