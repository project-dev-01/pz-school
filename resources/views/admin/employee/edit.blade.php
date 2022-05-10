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
                <h4 class="page-title">Edit Employee</h4>
            </div>
        </div>
    </div>

    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12 editEmployeeForm">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="" class="icon-dual" id="span-parent"></span>Personal details
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="editEmployeeForm" method="post" action="{{ route('admin.employee.update') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <input type="hidden" class="form-control" id="id" name="id" value="{{$employee['id']}}">
                        <span class="fas fa-user-check  " id="span-parent"></span>
                        <span class="header-title mb-3" id="span-parent">Personal details
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
                                        <input type="text" class="form-control" name="name" value="{{$employee['name']}}" id="userName">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Gender<span class="text-danger">*</span></label>
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="">Choose Gender</option>
                                        <option value="Male" {{$employee['gender'] =="Male" ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{$employee['gender'] == "Female" ? 'selected' : ''}}>Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="religion">Religion<span class="text-danger">*</span></label>
                                    <select class="form-control" name="religion" id="religion">
                                        <option value="">Choose Religion</option>
                                        @forelse($religion as $r)
                                        <option value="{{$r['id']}}" {{$employee['religion'] == $r['id'] ? 'selected' : ''}}>{{$r['religions_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="race">Race<span class="text-danger">*</span></label>
                                    <select class="form-control" name="race" id="addRace">
                                        <option value="">Choose race</option>
                                        @forelse($races as $r)
                                        <option value="{{$r['id']}}" {{$employee['race'] == $r['id'] ? 'selected' : ''}}>{{$r['races_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="blood_group">Blood Group<span class="text-danger">*</span></label>
                                    <select class="form-control" name="blood_group" id="blood_group">
                                        <option value="">Choose Blood Group</option>
                                        <option value="A+" {{$employee['blood_group'] == "A+" ? 'selected' : ''}}>A+</option>
                                        <option value="A-" {{$employee['blood_group'] == "A-" ? 'selected' : ''}}>A-</option>
                                        <option value="AB+" {{$employee['blood_group'] == "AB+" ? 'selected' : ''}}>AB+</option>
                                        <option value="AB-" {{$employee['blood_group'] == "AB-" ? 'selected' : ''}}>AB-</option>
                                        <option value="B+" {{$employee['blood_group'] == "B+" ? 'selected' : ''}}>B+</option>
                                        <option value="B-" {{$employee['blood_group'] == "B-" ? 'selected' : ''}}>B-</option>
                                        <option value="O+" {{$employee['blood_group'] == "O+" ? 'selected' : ''}}>O+</option>
                                        <option value="O-" {{$employee['blood_group'] == "O-" ? 'selected' : ''}}>O-</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Qualification">Qualification<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="qualification" value="{{$employee['qualification']}}" id="empQuatification">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Passport">Passport</label>
                                    <input type="text" class="form-control" name="passport" value="{{$employee['passport']}}" id="Passport">
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
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="birthday">Date Of Birth<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-birthday-cake"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="birthday" value="{{$employee['birthday']}}" id="empDOB">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="mobile_no">Mobile No<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-phone-volume"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" value="{{$employee['mobile_no']}}" name="mobile_no" id="mobile_no">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="present_address">Present Address<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="present_address" id="present_address" data-parsley-trigger="keyup" data-parsley-minlength="10" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                                    {{$employee['present_address']}}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="permanent_address">Permanent Address<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="permanent_address" id="permanent_address" data-parsley-trigger="keyup" data-parsley-minlength="10" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                                    {{$employee['permanent_address']}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="photo">Profile Picture</label>
                                    <input type="hidden" name="old_photo" id="oldPhoto" value="{{ $employee['photo'] }}" />
                                    <input type="file" name="photo" id="photo" data-plugins="dropify" data-default-file="{{asset('images/staffs/').'/'.$employee['photo']}}" />

                                </div>
                            </div>
                        </div>
                        <span class="fas fa-user-check  " id="span-parent"></span>
                        <span class="header-title mb-3" id="span-parent">Employee details
                            <hr id="hr">
                        </span>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="role_id">Role<span class="text-danger">*</span></label>
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
                                        <input type="text" class="form-control" value="{{$employee['joining_date']}}" name="joining_date" id="joiningDate">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation_id">Designation<span class="text-danger">*</span></label>
                                    <select class="form-control select2-multiple" data-toggle="select2" id="empDesignation" name="designation_id[]" multiple="multiple" data-placeholder="Choose ...">
                                        <option value="">Select Designation</option>
                                        @forelse($designation as $des)
                                        @php
                                        $selected = "";
                                        @endphp
                                        @foreach(explode(',', $employee['designation_id']) as $info)
                                        @if($des['id'] == $info)
                                        @php
                                        $selected = "Selected";
                                        @endphp
                                        @endif
                                        @endforeach
                                        <option value="{{$des['id']}}" {{ $selected }}>{{$des['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department_id">Department<span class="text-danger">*</span></label>
                                    <select class="form-control select2-multiple" data-toggle="select2" id="empDepartment" name="department_id" multiple="multiple" data-placeholder="Choose ...">
                                        <option value="">Select Department</option>
                                        @forelse($department as $dep)
                                        @php
                                        $selected = "";
                                        @endphp
                                        @foreach(explode(',', $employee['department_id']) as $info)
                                        @if($dep['id'] == $info)
                                        @php
                                        $selected = "Selected";
                                        @endphp
                                        @endif
                                        @endforeach
                                        <option value="{{$dep['id']}}" {{ $selected }}>{{$dep['name']}}</option>
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
                                        <option value="{{$r['id']}}" {{$employee['staff_position'] == $r['id'] ? 'Selected':''}}>{{$r['staff_positions_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="salary_grade">Salary Grade</label>
                                    <input type="text" value="{{$employee['salary_grade']}}" class="form-control" name="salary_grade" id="salaryGrade">
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
                                        <option value="{{$r['id']}}" {{$employee['staff_category'] == $r['id'] ? 'Selected':''}}>{{$r['staff_categories_name']}}</option>
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
                                        @forelse($qualifications as $qua)
                                        @php
                                        $selected = "";
                                        @endphp
                                        @foreach(explode(',', $employee['staff_qualification_id']) as $info)
                                        @if($qua['id'] == $info)
                                        @php
                                        $selected = "Selected";
                                        @endphp
                                        @endif
                                        @endforeach
                                        <option value="{{$qua['id']}}" {{ $selected }}>{{$qua['qualification_name']}}</option>
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
                                        <option value="{{$r['id']}}" {{$employee['stream_type_id'] == $r['id'] ? 'Selected':''}}>{{$r['stream_types_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                        </div>

                        <!-- <span class="fas fa-user-lock " id="span-parent"></span>
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
                        </div> -->
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
                                        <input type="text" class="form-control" name="facebook_url" value="{{$employee['facebook_url']}}" id="facebook_url">
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
                                        <input type="text" class="form-control" name="twitter_url" value="{{$employee['twitter_url']}}" id="twitter_url">
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
                                        <input type="text" class="form-control" name="linkedin_url" value="{{$employee['linkedin_url']}}" id="linkedin_url">
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
                                        <input type="text" id="bank_name" value="{{ isset($bank['bank_name']) ? $bank['bank_name']:' ' }}" class="form-control" name="bank_name" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="holder_name">Account Holder<span class="text-danger">*</span></label>
                                        <input type="text" id="holder_name" value="{{ isset($bank['holder_name']) ? $bank['holder_name']:''}}" class="form-control" name="holder_name" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bank_branch">Bank Branch<span class="text-danger">*</span></label>
                                        <input type="text" id="bank_branch" value="{{ isset($bank['bank_branch']) ? $bank['bank_branch']:'' }}" class="form-control" name="bank_branch" data-parsley-trigger="change">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="bank_address">Bank Address<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ isset($bank['bank_address']) ? $bank['bank_address']:'' }}" id="bank_address" name="bank_address" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="ifsc_code">IFSC Code<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ isset($bank['ifsc_code']) ? $bank['ifsc_code']:''}}" id="ifsc_code" name="ifsc_code" aria-describedby="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="">Account No<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ isset($bank['account_no']) ? $bank['account_no']:'' }}" id="account_no" name="account_no" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                Update
                            </button>
                            <a href="{{ route('admin.listemployee') }}" class="btn btn-secondary waves-effect m-l-5">
                                Back
                            </a>
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
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>

<script>
    var employeeListShow = "{{ route('admin.listemployee') }}";
</script>
<script src="{{ asset('js/custom/employee.js') }}"></script>
@endsection