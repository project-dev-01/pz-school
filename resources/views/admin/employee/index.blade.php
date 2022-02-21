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
        <div class="col-xl-12 addEmployeeForm">
            <div class="card">
                <div class="card-body">
                    <span class=" fas fa-user-circle  " id="parent"></span>
                    <span class="header-title mb-3" id="parent">Add Employee</span>
                    <hr>
                    <span class="fas fa-home  " id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">Academic Details
                        <hr id="hr">
                    </span>
                    <form id="addEmployeeForm"  method="post" action="{{ route('employee.add') }}"  enctype="multipart/form-data" autocomplete="off">
                    @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="role">Role<span class="text-danger">*</span></label>
                                    <select class="form-control" name="role">
                                        <option value="">Select Role</option>
                                        @foreach($roles as $r)
                                        <option value="{{$r['id']}}">{{$r['role_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-4">
                                    <label for="joining_date">Joining Date<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control homeWorkAdd" name="joining_date" id="joiningDate" placeholder="" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation">Designation<span class="text-danger">*</span></label>
                                    <select class="form-control"  id="empDesignation" name="designation">
                                        <option value="">Select Designation</option>
                                        <option >BEd</option>
                                        <option >MEd</option>
                                        <option >BElEd</option>
                                        <option >DEd </option>
                                        <option >DLEd </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department">Department<span class="text-danger">*</span></label>
                                    <select class="form-control"  id="empDepartment" name="department">
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
                                    <label for="qualification">Quatification<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="qualification" id="empQuatification" placeholder="" aria-describedby="inputGroupPrepend" >
                                   
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
                                    <label for="name"> Name<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-graduate"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control"  name="name" placeholder="" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control"  name="gender">
                                        <option value="">Choose..</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="religion">Religion</label>
                                    <select class="form-control" name="religion">
                                        <option value="">Choose..</option>
                                        <option>Hindu</option>
                                        <option>Muslim</option>
                                        <option>Christain</option>
                                        <option>Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="blood_group">Blood Group</label>
                                    <select class="form-control" name="blood_group">
                                        <option value="">Choose..</option>
                                        <option>A+</option>
                                        <option>A-</option>
                                        <option>AB+</option>
                                        <option>AB-</option>
                                        <option>B+</option>
                                        <option>B-</option>
                                        <option>O+</option>
                                        <option>O-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="birthday">Date Of Birth</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-birthday-cake"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="birthday" id="empDOB" placeholder="" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="mobile_no">Mobile No<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-phone-volume"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="mobile_no"  placeholder="" aria-describedby="inputGroupPrepend" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="present_address">Present Address</label>
                                    <textarea  class="form-control" name="present_address" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="permanent_address">Permanent Address</label>
                                    <textarea  class="form-control" name="permanent_address" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="photo">Profile Picture</label>
                                    <input type="file" name="photo">
                                    <span class="text-danger error-text photo_error"></span>
                                </div>
                            </div>
                        </div> -->
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
                                        <input type="email" class="form-control" name="email" placeholder="" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="password">Password<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-unlock"></span>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control" name="password" placeholder="" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="confirm_password">Retype Password<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-unlock"></span>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="" aria-describedby="inputGroupPrepend" >
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
                                    <label for="facebook_url">Facebook</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fab fa-facebook-f"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="facebook_url" placeholder="" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="twitter_url">Twitter</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fab fa-twitter"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="twitter_url"  placeholder="" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="linkedin_url">Linkedin</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fab fa-linkedin-in"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="linkedin_url" placeholder="" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <span class="fas fa-university " id="span-parent"></span>
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
                                    <input type="text" id="" class="form-control" name="" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Account Holder<span class="text-danger">*</span></label>
                                    <input type="text" id="" class="form-control" name="" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Bank Branch<span class="text-danger">*</span></label>
                                    <input type="text" id="" class="form-control" name="" data-parsley-trigger="change">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="validationCustomUsername">Bank Address</label>
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="validationCustomUsername">IFSC Code</label>
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="">Account No<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
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