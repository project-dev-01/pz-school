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
        <div class="col-xl-12 editEmployeeForm">
            <div class="card">
                <div class="card-body">
                    <span class=" fas fa-user-circle  " id="parent"></span>
                    <span class="header-title mb-3" id="parent">Edit Employee</span>
                    <hr>
                    <span class="fas fa-home  " id="span-parent"></span>
                    <span class="header-title mb-3" id="span-parent">Academic Details
                        <hr id="hr">
                    </span>
                    <form id="editEmployeeForm" method="post" action="{{ route('admin.employee.update') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <input type="hidden" class="form-control" id="id" name="id" value="{{$employee['id']}}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="role">Role<span class="text-danger">*</span></label>
                                    <select class="form-control" name="role_id" id="role_id">
                                        <option value="">Select Role</option>
                                        @foreach($roles as $r)
                                        <option value="{{$r['id']}}" {{$role['role_id'] == $r['id'] ? 'Selected':''}}>{{$r['role_name']}}</option>
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
                                        <input type="text" class="form-control" name="joining_date" id="joiningDate" placeholder="" value="{{$employee['joining_date']}}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation">Designation<span class="text-danger">*</span></label>
                                    <select class="form-control" id="empDesignation" name="designation_id">
                                        <option value="">Select Designation</option>
                                        @foreach($designation as $des)
                                        <option value="{{$des['id']}}" {{$employee['designation_id'] == $des['id'] ? 'Selected':''}}>{{$des['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department">Department<span class="text-danger">*</span></label>
                                    <select class="form-control" id="empDepartment" name="department_id">
                                        <option value="">Select Department</option>
                                        @foreach($department as $dep)
                                        <option value="{{$dep['id']}}" {{$employee['department_id'] == $dep['id'] ? 'Selected':''}}>{{$dep['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qualification">Quatification<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="qualification" value="{{$employee['qualification']}}" id="empQuatification" placeholder="" aria-describedby="inputGroupPrepend">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="salary_grade">Salary Grade</label>
                                    <input type="text" class="form-control" name="salary_grade" value="{{$employee['salary_grade']}}" id="salaryGrade">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="staff_position">Staff Position</label>
                                    <input type="text" class="form-control" name="staff_position" value="{{$employee['staff_position']}}" id="staffPosition">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="staff_category">Staff Category</label>
                                    <input type="text" class="form-control" name="staff_category" value="{{$employee['staff_category']}}" id="staffCategory">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nric_number">NRIC Number</label>
                                    <input type="text" class="form-control" name="nric_number" value="{{$employee['nric_number']}}" id="nricNumber">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="passport">Passport</label>
                                    <input type="text" class="form-control" name="passport" value="{{$employee['passport']}}" id="passport">
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
                                        <input type="text" class="form-control" id="userName" name="name" placeholder="" value="{{$employee['name']}}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="">Choose..</option>
                                        <option {{$employee['gender'] == "Male" ? 'selected' : ''}}>Male</option>
                                        <option {{$employee['gender'] == "Female" ? 'selected' : ''}}>Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="religion">Religion</label>
                                    <select class="form-control" name="religion" id="religion">
                                        <option value="">Choose..</option>
                                        <option {{$employee['religion'] == "Hindu" ? 'selected' : ''}}>Hindu</option>
                                        <option {{$employee['religion'] == "Muslim" ? 'selected' : ''}}>Muslim</option>
                                        <option {{$employee['religion'] == "Christain" ? 'selected' : ''}}>Christain</option>
                                        <option {{$employee['religion'] == "Others" ? 'selected' : ''}}>Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="blood_group">Blood Group</label>
                                    <select class="form-control" name="blood_group" id="blood_group">
                                        <option value="">Choose..</option>
                                        <option {{$employee['blood_group'] == "A+" ? 'selected' : ''}}>A+</option>
                                        <option {{$employee['blood_group'] == "A-" ? 'selected' : ''}}>A-</option>
                                        <option {{$employee['blood_group'] == "AB+" ? 'selected' : ''}}>AB+</option>
                                        <option {{$employee['blood_group'] == "AB-" ? 'selected' : ''}}>AB-</option>
                                        <option {{$employee['blood_group'] == "B+" ? 'selected' : ''}}>B+</option>
                                        <option {{$employee['blood_group'] == "B-" ? 'selected' : ''}}>B-</option>
                                        <option {{$employee['blood_group'] == "O+" ? 'selected' : ''}}>O+</option>
                                        <option {{$employee['blood_group'] == "O-" ? 'selected' : ''}}>O-</option>
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
                                        <input type="text" class="form-control" name="birthday" id="empDOB" placeholder="" value="{{$employee['birthday']}}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="mobile_no">Mobile No<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-phone-volume"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="mobile_no" placeholder="" id="mobile_no" value="{{$employee['mobile_no']}}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="present_address">Present Address</label>
                                    <textarea class="form-control" name="present_address" id="present_address" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">{{$employee['present_address']}}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="permanent_address">Permanent Address</label>
                                    <textarea class="form-control" name="permanent_address" id="permanent_address" data-parsley-trigger="keyup" data-parsley-minlength="20" value="{{$employee['joining_date']}}" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">{{$employee['permanent_address']}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="photo">Profile Picture</label>
                                    <input type="file" name="photo">
                                </div>
                            </div>
                        </div> -->
                        <span class="fas fa-globe" id="span-parent"></span>
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
                                        <input type="text" class="form-control" name="facebook_url" id="facebook_url" placeholder="" value="{{$employee['facebook_url']}}" aria-describedby="inputGroupPrepend">
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
                                        <input type="text" class="form-control" name="twitter_url" id="twitter_url" placeholder="" value="{{$employee['twitter_url']}}" aria-describedby="inputGroupPrepend">
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
                                        <input type="text" class="form-control" name="linkedin_url" id="linkedin_url" placeholder="" value="{{$employee['linkedin_url']}}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="fas fa-university " id="span-parent"></span>
                        <span class="header-title mb-3" id="span-parent"> Bank Details
                            <hr id="hr">
                        </span>
                        @if($bank)
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Bank Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="bank_name" id="bank_name" data-parsley-trigger="change" value="{{$bank['bank_name']}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Account Holder<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="holder_name" id="holder_name" data-parsley-trigger="change" value="{{$bank['holder_name']}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Bank Branch<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="bank_branch" id="bank_branch" data-parsley-trigger="change" value="{{$bank['bank_branch']}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="validationCustomUsername">Bank Address</label>
                                    <input type="text" class="form-control" name="bank_address" id="bank_address" placeholder="" aria-describedby="inputGroupPrepend" value="{{$bank['bank_address']}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="validationCustomUsername">IFSC Code</label>
                                    <input type="text" class="form-control" name="ifsc_code" placeholder="" id="ifsc_code" aria-describedby="inputGroupPrepend" value="{{$bank['ifsc_code']}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="">Account No<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="account_no" placeholder="" id="account_no" aria-describedby="inputGroupPrepend" value="{{$bank['account_no']}}">
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="skip_bank_details" name="skip_bank_details">
                                <label class="custom-control-label" for="skip_bank_details">Skipped Bank Details</label>
                            </div>
                        </div>
                        <div id="bank_details_form">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Bank Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="bank_name" id="bank_name" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Account Holder<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="holder_name" id="holder_name" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Bank Branch<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="bank_branch" id="bank_branch" data-parsley-trigger="change">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="validationCustomUsername">Bank Address</label>
                                        <input type="text" class="form-control" name="bank_address" id="bank_address" placeholder="" aria-describedby="inputGroupPrepend" ">
                                        </div>
                                    </div>
                                    <div class=" col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="validationCustomUsername">IFSC Code</label>
                                            <input type="text" class="form-control" name="ifsc_code" placeholder="" id="ifsc_code" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="">Account No<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="account_no" id="account_no" placeholder="" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                    Update
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

@section('scripts')
<script>
    var employeeListShow = "{{ route('admin.listemployee') }}";
</script>
<script src="{{ asset('js/custom/employee.js') }}"></script>
@endsection