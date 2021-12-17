@extends('layouts.admin-layout')
@section('title','Employee')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
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
                    <span class="header-title mb-3" id="span-parent">Academic Details
                        <hr id="hr">
                    </span>
                    <form id="demo-form" action="{{ route('employee.add') }}" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Branch Name <span class="text-danger">*</span></label>
                                    <select class="form-control" name="branch_id" id="empBranchName">
                                        <option value="">Select Branch</option>
                                        @foreach($branches as $b)
                                        <option value="{{$b['id']}}">{{$b['name']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text branch_id_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Role<span class="text-danger">*</span></label>
                                    <select class="form-control" name="role">
                                        <option value="">Select Role</option>
                                        @foreach($roles as $r)
                                        <option value="{{$r['role_id']}}">{{$r['role_name']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text branch_id_error"></span>
                                    <!-- <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required=""> -->
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
                                        <input type="text" class="form-control" id="joiningDate" placeholder="" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heard">Designation<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">select</option>
                                        <option value="press">Press</option>
                                        <option value="net">Internet</option>
                                        <option value="mouth">Word of mouth</option>
                                        <option value="other">Other..</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heard">Department<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Select</option>
                                        <option value="press">Press</option>
                                        <option value="net">Internet</option>
                                        <option value="mouth">Word of mouth</option>
                                        <option value="other">Other..</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heard">Quatification<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="empQuatification" placeholder="" aria-describedby="inputGroupPrepend" required>
                                </div>
                            </div>
                        </div>
                        <span class="fas fa-user-check  " id="span-parent"></span>
                        <span class="header-title mb-3" id="span-parent">Employee Details
                            <hr id="hr">
                        </span>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">First Name<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-graduate"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="heard">Gender</label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Male</option>
                                        <option value="press">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heard">Religion</label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Male</option>
                                        <option value="press">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heard">Blood Group</label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Choose..</option>
                                        <option value="press">Press</option>
                                        <option value="net">Internet</option>
                                        <option value="mouth">Word of mouth</option>
                                        <option value="other">Other..</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="">Date Of Birth</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-birthday-cake"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="empDOB" placeholder="" aria-describedby="inputGroupPrepend" required>
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
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="message">Present Address</label>
                                    <textarea id="message" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                        </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="message">Permanent Address</label>
                                    <textarea id="message" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                        </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message">Profile Picture</label>
                                    <textarea id="message" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                        </textarea>
                                </div>
                            </div>
                        </div>
                        <span class="fas fa-user-lock " id="span-parent"></span>
                        <span class="header-title mb-3" id="span-parent"> Login Details
                            <hr id="hr">
                        </span>
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
                                        <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
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
                                        <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
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
                                        <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="fas fa-globe  " id="span-parent"></span>
                        <span class="header-title mb-3" id="span-parent">Social Links
                            <hr id="hr">
                        </span>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="validationCustomUsername">Facebook</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fab fa-facebook-f"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="validationCustomUsername">Twitter</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fab fa-twitter"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="validationCustomUsername">Linkedin</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fab fa-linkedin-in"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="fas fa-university " id="span-parent"></span>
                        <span class="header-title mb-3" id="span-parent"> Bank Details
                            <hr id="hr">
                        </span>
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
                                    <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Account Holder<span class="text-danger">*</span></label>
                                    <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Bank Branch<span class="text-danger">*</span></label>
                                    <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="validationCustomUsername">Bank Address</label>
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="validationCustomUsername">IFSC Code</label>
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="">Account No<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
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