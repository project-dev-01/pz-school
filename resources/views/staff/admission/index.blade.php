@extends('layouts.admin-layout')
@section('title','Admission')
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
                    <span class="header-title mb-3" id="parent">Student Admission</span>
                <hr>
                    <span class="fas fa-home  " id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">Academic Details
                    <hr id="hr"></span>
                    <form id="demo-form" data-parsley-validate="" autocomplete="off">                                         
                    <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="heard">Academic Year<span class="text-danger">*</span></label>
                        <select id="heard" class="form-control" required="">
                            <option value="">2021-2022</option>  
                            <option value="">2020-2021</option>
                            <option value="press">2019-2020</option>
                            <option value="net">2018-2029</option>
                            <option value="mouth">2017-2018</option>
                            <option value="other">2016-2017</option>
                        </select>
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Register No<span class="text-danger">*</span></label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Roll<span class="text-danger">*</span></label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                        <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="">Admission Date<span class="text-danger">*</span></label>												
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
                    <div class="row">
                    <div class="col-md-3">
                    <div class="form-group">
                        <label for="heard">Standard<span class="text-danger">*</span></label>
                        <select id="heard" class="form-control" required="">
                            <option value="">Select Standard</option>                            
                            <option value="press">I</option>
                            <option value="net">II</option>
                            <option value="mouth">III</option>
                            <option value="other">IV</option>
                            <option value="other">V</option>
                            <option value="other">VI</option>
                            <option value="other">VII</option>
                            <option value="other">VIII</option>
                            <option value="other">IX</option>
                            <option value="other">X</option>
                        </select>
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label for="heard">Class Name<span class="text-danger">*</span></label>
                        <select id="heard" class="form-control" required="">
                            <option value="">Select Class Name</option>
                            <option value="press">A</option>
                            <option value="net">B</option>
                            <option value="mouth">C</option>
                            <option value="other">D</option>
                            <option value="other">E</option>
                        </select>
                    </div>
                    </div>
                        <div class="col-md-3">
                        <div class="form-group">
                        <label for="">Category<span class="text-danger">*</span></label>
                        <select id="heard" class="form-control" required="">
                            <option value="">Choose..</option>
                            <option value="press">Press</option>
                            <option value="net">Internet</option>
                            <option value="mouth">Word of mouth</option>
                            <option value="other">Other..</option>
                        </select>
                    </div> 
                    </div>										
                    </div>
                    <span class="fas fa-user-check  " id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">Student Details
                    <hr id="hr"></span>
                    <div class="row">
                        <div class="col-md-4">
                    <div class="form-group">
                        <label for="">First Name<span class="text-danger">*</span></label>
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
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">Last Name</label>
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
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="heard">Gender<span class="text-danger">*</span></label>
                        <select id="heard" class="form-control" required="">
                            <option value="">Male</option>
                            <option value="press">Female</option>
                            </select>
                    </div>                                       
                    </div>
                    </div>
                        <div class="row">
                        <div class="col-md-6">
                    <div class="form-group">
                        <label for="heard">Blood Group<span class="text-danger">*</span></label>
                        <select id="heard" class="form-control" required="">
                            <option value="">Select Blood Group</option>
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
                    <div class="col-md-6">
                    <div class="form-group mb-3">
                            <label for="">Date Of Birth</label>
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
                        <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">Mother Tongue</label>
                            <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                        </div> 
                    </div>
                        <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Religion</label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Caste</label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>										
                    </div>

                        <div class="row">
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
                        <div class="col-md-4">
                    <div class="form-group">
                        <label for="">City</label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label for="">State</label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
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
                    <span class="header-title mb-3" id="span-parent">  Login Details
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
                    <span class="fas fa-user-tie" id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">Guardian Details
                    <hr id="hr"></span>
                    <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck11">
                                <label class="custom-control-label" for="customCheck11">Skipped Bank Details</label>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-6">  
                    <div class="form-group">
                        <label for="heard">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group mb-3">
                                <label for="heard">Relation<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                        </div> 
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                    <div class="form-group">
                        <label for="heard">Father Name</label>
                        <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group mb-3">
                                <label for="heard">Mother Name</label>
                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                        </div> 
                    </div>
                    </div>
                        <div class="row">
                        <div class="col-md-4">
                        <div class="form-group">
                        <label for="">Occupation<span class="text-danger">*</span></label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                        <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Income</label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Education</label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>										
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="validationCustomUsername">City</label>
                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
                        </div>                                      
                    </div>
                    <div class="col-md-4">
                    <div class="form-group mb-3">
                            <label for="validationCustomUsername">State</label>
                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                    required>
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
                    <span class="fas fa-bus-alt  " id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">Transport Details
                    <hr id="hr"></span>
                        <div class="row"> 
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="heard">Transport Route<span class="text-danger">*</span></label>
                        <select id="heard" class="form-control" required="">
                            <option value="">First select the branch</option>
                            <option value="press">Press</option>
                            <option value="net">Internet</option>
                            <option value="mouth">Word of mouth</option>
                            <option value="other">Other..</option>
                        </select>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="heard">Vechicle No<span class="text-danger">*</span></label>
                        <select id="heard" class="form-control" required="">
                            <option value="">First select the branch</option>
                            <option value="press">Press</option>
                            <option value="net">Internet</option>
                            <option value="mouth">Word of mouth</option>
                            <option value="other">Other..</option>
                        </select>
                    </div>
                    </div>
                    </div>
                    <span class="fas fa-hotel" id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">Hostel Details
                    <hr id="hr"></span>
                        <div class="row"> 
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="heard">Hostel Name</label>
                        <select id="heard" class="form-control" required="">
                            <option value="">First select the branch</option>
                            <option value="press">Press</option>
                            <option value="net">Internet</option>
                            <option value="mouth">Word of mouth</option>
                            <option value="other">Other..</option>
                        </select>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="heard">Room Name</label>
                        <select id="heard" class="form-control" required="">
                            <option value="">First select the hostel</option>
                            <option value="press">Press</option>
                            <option value="net">Internet</option>
                            <option value="mouth">Word of mouth</option>
                            <option value="other">Other..</option>
                        </select>
                    </div>
                    </div>
                    </div>
                    <span class="fas fa-holly-berry" id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">Previous School Details
                    <hr style="margin-top:-1%;margin-left:20%;color:blue"></span>
                        <div class="row">  
                        <div class="col-md-6">
                    <div class="form-group">
                        <label for="">School Name</label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Qualification</label>
                        <input type="" id="" class="form-control" name=""
                                data-parsley-trigger="change" required="">
                    </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Remarks</label>
                        <textarea id="message" class="form-control" name="message"
                            data-parsley-trigger="keyup" data-parsley-minlength="20"
                            data-parsley-maxlength="100"
                            data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.."
                            data-parsley-validation-threshold="10">
                        </textarea>
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