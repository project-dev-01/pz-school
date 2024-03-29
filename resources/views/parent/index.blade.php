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

                    <span class=" fas fa-user-circle" id="parent"></span>
                    <span class="header-title mb-3" id="parent">{{ __('messages.add_parent') }}</span>
                <hr>						
                <form id="demo-form" data-parsley-validate="">
                    <span class="fas fa-user-check  " id="span-parent"></span>
                    <span class="header-title mb-3"id="span-parent">Parent Details
                    <hr id="hr"></span>
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">{{ __('messages.name') }}<span class="text-danger">*</span></label>												
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
                        <label for="relation">{{ __('messages.relation') }}<span class="text-danger">*</span></label>
                        <input type="text" id="relation" class="form-control" name="relation"
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    </div>
                        <div class="row">
                        <div class="col-md-6">
                    <div class="form-group">
                        <label for="father_name">{{ __('messages.father_name') }}<span class="text-danger">*</span></label>
                        <input type="" id="father_name" class="form-control" name="father_name"
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="mother_name">{{ __('messages.mother_name') }}<span class="text-danger">*</span></label>
                        <input type="" id="mother_name" class="form-control" name="mother_name"
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                    <div class="form-group">
                        <label for="occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                        <input type="text" id="occupation" class="form-control" name="occupation"
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="income">{{ __('messages.income') }}</label>
                                <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="fas fa-calculator"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="income" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label for="education">{{ __('messages.education') }}</label>
                        <input type="text" id="education" class="form-control" name="education"
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    </div>
                        <div class="row">
                        <div class="col-md-4">
                    <div class="form-group">
                        <label for="city">{{ __('messages.city') }}</label>
                        <input type="text" id="city" class="form-control" name="city"
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label for="state">{{ __('messages.state') }}</label>
                        <input type="text" id="state" class="form-control" name="state"
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="mobile_no">Mobile No<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="fas fa-phone-volume"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="mobile_no" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div> 
                    </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" class="form-control" name="address"
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
                            <label for="email">Email<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="far fa-envelope-open"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="email" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div> 
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="password">{{ __('messages.password') }}<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="fas fa-unlock"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="password" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div> 
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="retype_password">{{ __('messages.retype_password') }}<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="fas fa-unlock"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="retype_password" placeholder="" aria-describedby="inputGroupPrepend"
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
                            <label for="facebook">{{ __('messages.facebook') }}</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="fab fa-facebook-f"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="facebook" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div>                                      
                    </div>
                    <div class="col-md-4">
                    <div class="form-group mb-3">
                            <label for="twitter">{{ __('messages.twitter') }}</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="fab fa-twitter"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="twitter" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                    <div class="form-group mb-3">
                            <label for="linkedin">{{ __('messages.linkedin') }}</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="fab fa-linkedin-in"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="linkedin" placeholder="" aria-describedby="inputGroupPrepend"
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