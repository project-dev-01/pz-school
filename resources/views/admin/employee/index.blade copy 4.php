@extends('layouts.admin-layout')
@section('title','Employee')
@section('css')
<link rel="stylesheet" href="{{ asset('libs/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('libs/dropify/css/dropify.min.css') }}">
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Employee</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12 addEmployeeForm">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Personal Details<h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="addEmployeeForm" method="post" action="{{ route('admin.employee.add') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-lg-3">
                                    <div class="mt-3">
                                        <input type="file" name="photo" id="photo" data-plugins="dropify" data-default-file="{{ asset('images/700x500.png') }}" />
                                        <p class="text-muted text-center mt-2 mb-0">Photo</p>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row -->
                        <!-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="photo">Profile Picture</label>
                                    <div class="containers-img">
                                        <div class="imageWrapper">
                                            <img class="image" src="{{ asset('images/700x500.png') }}">
                                        </div>
                                    </div>

                                    <button class="file-upload">
                                        <input type="file" name="photo" id="photo" class="file-input">Choose File
                                    </button>
                                </div>


                            </div>
                        </div> -->

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name"> First name<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-graduate"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control shortNameChange" name="first_name" placeholder="Ahmad Ali" id="firstName">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name"> Last name</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-graduate"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control shortNameChange" name="last_name" placeholder="Ali" id="lastName">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="">Choose Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="short_name">Short name</label>
                                    <input type="text" class="form-control" name="short_name" placeholder="aa" id="shortName">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="religion">Religion</label>
                                    <select class="form-control" name="religion" id="religion">
                                        <option value="">Choose Religion</option>
                                        @forelse($religion as $r)
                                        <option value="{{$r['id']}}">{{$r['religions_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="race">Race</label>
                                    <select class="form-control" name="race" id="addRace">
                                        <option value="">Choose race</option>
                                        @forelse($races as $r)
                                        <option value="{{$r['id']}}">{{$r['races_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Passport">Passport</label>
                                    <input type="text" class="form-control" placeholder="passport number" name="passport" id="Passport">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nric_number">NRIC Number</label>
                                    <input type="text" class="form-control" name="nric_number" placeholder="nric number" id="nricNumber">
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
                                        <input type="text" class="form-control" name="birthday" placeholder="DD/MM/YYYY" id="empDOB">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="mobile_no">Mobile No</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-phone-volume"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="mobile_no" placeholder="(xx)-00000-0000" id="mobile_no">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employment_status">Employment status</label>
                                    <select class="form-control" name="employment_status" id="employment_status">
                                        <option value="">Choose employment status</option>
                                        <option value="Under_Probation">Under Probation</option>
                                        <option value="Employed">Employed</option>
                                        <option value="Transferred">Transferred</option>
                                        <option value="Resign">Resign</option>
                                        <option value="Retired">Retired</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" placeholder="malaysia" name="country" id="Country">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state">State/Province</label>
                                    <input type="text" class="form-control" name="state" id="State" placeholder="state">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" name="city" id="City" placeholder="city">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="post_code">Zip/Postal code</label>
                                    <input type="text" class="form-control" name="post_code" id="postCode" placeholder="000000">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="present_address">Address Line 1(Street address)</label>
                                    <input class="form-control" name="present_address" id="present_address" placeholder="johor">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="permanent_address">Address Line 2</label>
                                    <input class="form-control" name="permanent_address" id="permanent_address" placeholder="johor">
                                </div>
                            </div>
                        </div>

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">Employee Details<h4>
                        </li>
                    </ul>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="role_id">Role<span class="text-danger">*</span></label>
                                    <select class="form-control" name="role_id" id="role_id">
                                        <option value="">Select Role</option>
                                        @foreach($roles as $r)
                                        <option value="{{$r['id']}}">{{$r['role_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-4">
                                    <label for="joining_date">Joining Date</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="joining_date" id="joiningDate">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation_id">Designation</label>
                                    <select class="form-control select2-multiple" data-toggle="select2" id="empDesignation" name="designation_id" multiple="multiple" data-placeholder="Choose ...">
                                        <option value="">Select Designation</option>
                                        @if(!empty($emp_designation))
                                        @foreach($emp_designation as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department_id">Department</label>
                                    <select class="form-control select2-multiple" data-toggle="select2" id="empDepartment" name="department_id" multiple="multiple" data-placeholder="Choose ...">
                                        <option value="">Select Department</option>
                                        @forelse($emp_department as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="staff_position">Staff Position</label>
                                    <select class="form-control" id="staffPosition" name="staff_position">
                                        <option value="">Select Position</option>
                                        @forelse($staff_positions as $r)
                                        <option value="{{$r['id']}}">{{$r['staff_positions_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="salary_grade">Salary Grade</label>
                                    <input type="number" class="form-control" name="salary_grade" id="salaryGrade">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="staff_category">Staff Category</label>
                                    <select class="form-control" id="staffCategory" name="staff_category">
                                        <option value="">Select Category</option>
                                        @forelse($staff_categories as $r)
                                        <option value="{{$r['id']}}">{{$r['staff_categories_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qualifications">Staff Qualification</label>
                                    <select class="form-control select2-multiple" data-toggle="select2" id="staffQualification" name="staff_qualification_id" multiple="multiple" data-placeholder="Choose ...">
                                        <option value="">Select Qualification</option>
                                        @forelse($qualifications as $r)
                                        <option value="{{$r['id']}}">{{$r['qualification_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="stream_type">Stream Type</label>
                                    <select class="form-control" id="streamType" name="stream_type">
                                        <option value="">Select Stream Type</option>
                                        @forelse($stream_types as $r)
                                        <option value="{{$r['id']}}">{{$r['stream_types_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
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
                                        <input type="email" class="form-control" name="email" id="email">
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
                                        <input type="password" class="form-control" name="password" id="password">
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
                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password">
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
                                        <input type="text" class="form-control" name="facebook_url" id="facebook_url">
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
                                        <input type="text" class="form-control" name="twitter_url" id="twitter_url">
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
                                        <input type="text" class="form-control" name="linkedin_url" id="linkedin_url">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="fas fa-briefcase-medical" id="span-parent"></span>
                        <span class="header-title mb-3" id="span-parent"> Medical History
                            <hr id="hr">
                        </span>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="skip_medical_history" name="skip_medical_history">
                                <label class="custom-control-label" for="skip_medical_history">Skipped Medical History</label>
                            </div>
                        </div>
                        <div id="medical_history_form">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="height">Height</label>
                                        <input type="text" id="height" class="form-control" name="height" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="weight">Weight</label>
                                        <input type="text" id="weight" class="form-control" name="weight" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="allergy">Allergy</label>
                                        <input type="text" id="allergy" class="form-control" name="allergy" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="blood_group">Blood Group</label>
                                        <select class="form-control" name="blood_group" id="blood_group">
                                            <option value="">Choose Blood Group</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                        </select>
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
                                <input type="checkbox" class="custom-control-input" id="skip_bank_details" name="skip_bank_details">
                                <label class="custom-control-label" for="skip_bank_details">Skipped Bank Details</label>
                            </div>
                        </div>
                        <div id="bank_details_form">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bank_name">Bank Name<span class="text-danger">*</span></label>
                                        <input type="text" id="bank_name" class="form-control" name="bank_name" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="holder_name">Account Holder<span class="text-danger">*</span></label>
                                        <input type="text" id="holder_name" class="form-control" name="holder_name" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bank_branch">Bank Branch<span class="text-danger">*</span></label>
                                        <input type="text" id="bank_branch" class="form-control" name="bank_branch" data-parsley-trigger="change">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="bank_address">Bank Address<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="bank_address" name="bank_address" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="ifsc_code">IFSC Code<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" aria-describedby="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="">Account No<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="account_no" name="account_no" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                        </div>

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
@section('scripts')
<script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/pages/form-fileuploads.init.js') }}"></script>

<script>
    var employeeListShow = "{{ route('admin.listemployee') }}";
</script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/custom/employee.js') }}"></script>
@endsection