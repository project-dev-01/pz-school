@extends('layouts.admin-layout')
@section('title','Employee')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('messages.add_employee') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12 addEmployeeForm">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="" class="icon-dual" id="span-parent"></span>{{ __('messages.academic_details') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="addEmployeeForm" method="post" action="{{ route('employee.add') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">{{ __('messages.branch_name') }}<span class="text-danger">*</span></label>
                                    <select class="form-control" name="branch_id" id="empBranchName">
                                        <option value="">Select Branch</option>
                                        <option>Malaysia</option>
                                        <option>Singapore</option>
                                    </select>
                                    <span class="text-danger error-text branch_id_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="role">{{ __('messages.role') }}<span class="text-danger">*</span></label>
                                    <select class="form-control" name="role">
                                        <option value="">Select Role</option>
                                        @foreach($roles as $r)
                                        <option value="{{$r['id']}}">{{$r['role_name']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text role_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-4">
                                    <label for="joining_date">{{ __('messages.joining_date') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control homeWorkAdd" name="joining_date" id="joiningDate" placeholder="" aria-describedby="inputGroupPrepend">
                                    </div>
                                    <span class="text-danger error-text joining_date_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation">{{ __('messages.designation') }}<span class="text-danger">*</span></label>
                                    <select class="form-control" id="empDesignation" name="designation">
                                        <option value="">Select Designation</option>
                                        <option>BEd</option>
                                        <option>MEd</option>
                                        <option>BElEd</option>
                                        <option>DEd </option>
                                        <option>DLEd </option>
                                    </select>
                                    <span class="text-danger error-text designation_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department">{{ __('messages.department') }}<span class="text-danger">*</span></label>
                                    <select class="form-control" id="empDepartment" name="department">
                                        <option value="">Select Department</option>
                                        <option value="press">Accounting and Finance Department</option>
                                        <option value="net">Human Performance</option>
                                        <option value="mouth">Health Promotion</option>
                                        <option value="other">Other..</option>
                                    </select>
                                    <span class="text-danger error-text department_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qualification">Quatification<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="qualification" id="empQuatification" placeholder="" aria-describedby="inputGroupPrepend">
                                    <span class="text-danger error-text qualification_error"></span>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="" class="icon-dual" id="span-parent"></span> Details
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
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
                                    <input type="text" class="form-control" name="name" placeholder="" aria-describedby="inputGroupPrepend">
                                </div>
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">{{ __('messages.gender') }}</label>
                                <select class="form-control" name="gender">
                                    <option value="">Choose..</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                                <span class="text-danger error-text gender_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="religion">{{ __('messages.religion') }}</label>
                                <select class="form-control" name="religion">
                                    <option value="">Choose..</option>
                                    <option>Hindu</option>
                                    <option>Muslim</option>
                                    <option>Christain</option>
                                    <option>Others</option>
                                </select>
                                <span class="text-danger error-text religion_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="blood_group">{{ __('messages.blood_group') }}</label>
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
                                <span class="text-danger error-text blood_group_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="birthday">{{ __('messages.date_of_birth') }}</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-birthday-cake"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="birthday" id="empDOB" placeholder="" aria-describedby="inputGroupPrepend">
                                </div>
                                <span class="text-danger error-text birthday_error"></span>
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
                                <input type="text" class="form-control" name="mobile_no" placeholder="" aria-describedby="inputGroupPrepend">
                            </div>
                            <span class="text-danger error-text mobile_no_error"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="present_address">{{ __('messages.present_address') }}</label>
                                <textarea class="form-control" name="present_address" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                                    </textarea>
                                <span class="text-danger error-text present_address_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="permanent_address">Permanent Address</label>
                                <textarea class="form-control" name="permanent_address" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                                    </textarea>
                                <span class="text-danger error-text permanent_address_error"></span>
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
                </div>
            </div>
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="" class="icon-dual" id="span-parent"></span>{{ __('messages.login_details') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
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
                                    <input type="email" class="form-control" name="email" placeholder="" aria-describedby="inputGroupPrepend">
                                </div>
                                <span class="text-danger error-text email_error"></span>
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
                                    <input type="password" class="form-control" name="password" placeholder="" aria-describedby="inputGroupPrepend">
                                </div>
                                <span class="text-danger error-text password_error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="confirm_password">{{ __('messages.retype_password') }}<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-unlock"></span>
                                        </div>
                                    </div>
                                    <input type="password" class="form-control" name="confirm_password" placeholder="" aria-describedby="inputGroupPrepend">
                                </div>
                                <span class="text-danger error-text confirm_password_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="" class="icon-dual" id="span-parent"></span>{{ __('messages.social_links') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="facebook_url">{{ __('messages.facebook') }}</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fab fa-facebook-f"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="facebook_url" placeholder="" aria-describedby="inputGroupPrepend">
                                </div>
                                <span class="text-danger error-text facebook_url_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="twitter_url">{{ __('messages.twitter') }}</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fab fa-twitter"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="twitter_url" placeholder="" aria-describedby="inputGroupPrepend">
                                </div>
                                <span class="text-danger error-text twitter_url_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="linkedin_url">{{ __('messages.linkedin') }}</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fab fa-linkedin-in"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="linkedin_url" placeholder="" aria-describedby="inputGroupPrepend">
                                </div>
                                <span class="text-danger error-text linkedin_url_error"></span>
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
                                    <label for="">Bank Brancsh<span class="text-danger">*</span></label>
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
                        <button class="btn btn-primary-bl waves-effect waves-light" type="save">
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