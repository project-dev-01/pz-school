@extends('layouts.admin-layout')
@section('title','Employee')
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
                    <span class=" fas fa-user-circle  " id="parent"></span>
                    <span class="header-title mb-3" id="parent">Add Employee</span>
                <hr>						
                <span class="fas fa-home  " id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">{{ __('messages.academic_details') }}
                    <hr id="hr"></span>
                    <form id="demo-form" data-parsley-validate="">                                         
                    <div class="row">										
                    <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Role<span class="text-danger">*</span></label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                        <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label for="">Joining Date<span class="text-danger">*</span></label>												
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
                        <label for="heard">Designation<span class="text-danger">*</span></label>
                        <select id="heard" class="form-control" required="">
                            <option value="">select Designation</option>
                            <option value="press">Academic coordinator</option>
                            <option value="net">Academic adviser</option>
                            <option value="mouth">Registrar</option>
                            <option value="other">Maintenance technician</option>                            
                            <option value="mouth">Teacher</option>
                            <option value="other">Teaching assistant</option>                            
                            <option value="other">Sports coach</option>
                        </select>
                    </div>
                    </div>									
                    </div>
                    <div class="row">
                    
                    <div class="col-md-4">
                    <div class="form-group">
                        <label for="heard">Department<span class="text-danger">*</span></label>
                        <select id="heard" class="form-control" required="">
                            <option value="">Select Department</option>
                            <option value="press">Accounting and Finance Department</option>
                            <option value="net">Human Performance</option>
                            <option value="mouth">Health Promotion</option>
                            <option value="other">Other..</option>
                        </select>
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label for="heard">Quatification<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                    </div>
                    </div>									
                    </div>
                    <span class="fas fa-user-check  " id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">Employee Details
                    <hr id="hr"></span>
                    <div class="row"> 
                        <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="fas fa-user-graduate"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                                </div>
                    </div>										
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="heard">{{ __('messages.gender') }}</label>
                        <select id="heard" class="form-control" required="">
                        <option value="">Select Gender</option>
                            <option value="">Male</option>
                            <option value="press">Female</option>
                            </select>
                    </div>                                       
                    </div>
                    </div>
                        <div class="row">
                        <div class="col-md-4">
                        <div class="form-group">
                        <label for="heard">{{ __('messages.religion') }}</label>
                        <select id="heard" class="form-control" required="">
                            <option value="">Select Religion</option>
                            <option value="">Christian</option>
                            <option value="press">Muslim</option>                            
                            <option value="press">Hindu</option>
                            </select>
                    </div>                                       
                    </div>
                        <div class="col-md-4">
                    <div class="form-group">
                        <label for="heard">{{ __('messages.blood_group') }}</label>
                        <select id="heard" class="form-control" required="">
                            <option value="">Select Blood group</option>
                            <option value="press">O+</option>
                            <option value="net">A+</option>
                            <option value="mouth">B+</option>
                            <option value="other">AB+</option>
                            <option value="other">O-</option>
                            <option value="other">A-</option>
                            <option value="other">B-</option>
                            <option value="other">AB-</option>
                        </select>
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group mb-3">
                            <label for="">{{ __('messages.date_of_birth') }}</label>
                                <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                            <span class="fas fa-birthday-cake"></span>
                                    </div>
                            </div>
                            <input type="text" class="form-control homeWorkAdd" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div> 
                    </div>
                    </div>
                        <div class="row">
                        <div class="col-md-12">
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
                    
                        <div class="row">
                        <div class="col-md-6">
                    <div class="form-group">
                        <label for="message">Present Address</label>
                        <textarea id="message" class="form-control" name="message"
                            data-parsley-trigger="keyup" data-parsley-minlength="20"
                            data-parsley-maxlength="100"
                            data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.."
                            data-parsley-validation-threshold="10">
                        </textarea>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="message">Permanent Address</label>
                        <textarea id="message" class="form-control" name="message"
                            data-parsley-trigger="keyup" data-parsley-minlength="20"
                            data-parsley-maxlength="100"
                            data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.."
                            data-parsley-validation-threshold="10">
                        </textarea>
                    </div>
                    </div>
                    </div>
                        <div class="row">
                        <div class="col-md-12">
                    <div class="form-group">
                        <label for="message">Profile Picture</label>
                        <textarea id="message" class="form-control" name="message"
                            data-parsley-trigger="keyup" data-parsley-minlength="20"
                            data-parsley-maxlength="100"
                            data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.."
                            data-parsley-validation-threshold="10">
                        </textarea>
                    </div>
                    </div>										
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
                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                                </div>
                        </div> 
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="email">Password<span class="text-danger">*</span></label>
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
                            <label for="email">Retype Password<span class="text-danger">*</span></label>
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
                    <span class="fas fa-university " id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent"> Bank Details
                    <hr id="hr"></span>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck11">
                                <label class="custom-control-label" for="customCheck11">Skipped Bank Details</label>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-4">
                        <div class="form-group">
                        <label for="">Bank Name<span class="text-danger">*</span></label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                        <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Account Holder<span class="text-danger">*</span></label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Bank Branch<span class="text-danger">*</span></label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>										
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="validationCustomUsername">Bank Address</label>
                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                        </div>                                      
                    </div>
                    <div class="col-md-4">
                    <div class="form-group mb-3">
                            <label for="validationCustomUsername">IFSC Code</label>
                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">Account No<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
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