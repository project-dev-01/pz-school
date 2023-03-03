@extends('layouts.admin-layout')
@section('title','Edit Employee')
@section('css')
<link rel="stylesheet" href="{{ asset('public/libs/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/libs/dropify/css/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/mobile-country/css/intlTelInput.css') }}">
<link rel="stylesheet" href="{{ asset('public/country/css/countrySelect.css') }}">
<style>
    .switch {
        height: 24px;
        display: block;
        position: relative;
        cursor: pointer;
    }

    .switch input {
        display: none;
    }

    .switch input+span {
        padding-left: 50px;
        min-height: 24px;
        line-height: 24px;
        display: block;
        color: #99a3ba;
        position: relative;
        vertical-align: middle;
        white-space: nowrap;
        transition: color 0.3s ease;
    }

    .switch input+span:before,
    .switch input+span:after {
        content: '';
        display: block;
        position: absolute;
        border-radius: 12px;
    }

    .switch input+span:before {
        top: 0;
        left: 0;
        width: 42px;
        height: 24px;
        background: #e4ecfa;
        transition: all 0.3s ease;
    }

    .switch input+span:after {
        width: 18px;
        height: 18px;
        background: #fff;
        top: 3px;
        left: 3px;
        box-shadow: 0 1px 3px rgba(18, 22, 33, .1);
        transition: all 0.45s ease;
    }

    .switch input+span em {
        width: 8px;
        height: 7px;
        background: #99a3ba;
        position: absolute;
        left: 8px;
        bottom: 7px;
        border-radius: 2px;
        display: block;
        z-index: 1;
        transition: all 0.45s ease;
    }

    .switch input+span em:before {
        content: '';
        width: 2px;
        height: 2px;
        border-radius: 1px;
        background: #fff;
        position: absolute;
        display: block;
        left: 50%;
        top: 50%;
        margin: -1px 0 0 -1px;
    }

    .switch input+span em:after {
        content: '';
        display: block;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        border: 1px solid #99a3ba;
        border-bottom: 0;
        width: 6px;
        height: 4px;
        left: 1px;
        bottom: 6px;
        position: absolute;
        z-index: 1;
        transform-origin: 0 100%;
        transition: all 0.45s ease;
        transform: rotate(-35deg) translate(0, 1px);
    }

    .switch input+span strong {
        font-weight: normal;
        position: relative;
        display: block;
        top: 1px;
    }

    .switch input+span strong:before,
    .switch input+span strong:after {
        font-size: 14px;
        font-weight: 500;
        display: block;
        font-family: 'Mukta Malar', Arial;
        -webkit-backface-visibility: hidden;
    }

    .switch input+span strong:before {
        content: 'Unlock';
        transition: all 0.3s ease 0.2s;
    }

    .switch input+span strong:after {
        content: 'Lock';
        opacity: 0;
        visibility: hidden;
        position: absolute;
        left: 0;
        top: 0;
        color: #007bff;
        transition: all 0.3s ease;
        transform: translate(2px, 0);
    }

    .switch input:checked+span:before {
        background: rgba(0, 123, 255, .35);
    }

    .switch input:checked+span:after {
        background: #fff;
        transform: translate(18px, 0);
    }

    .switch input:checked+span em {
        transform: translate(18px, 0);
        background: #007bff;
    }

    .switch input:checked+span em:after {
        border-color: #007bff;
        transform: rotate(0deg) translate(0, 0);
    }

    .switch input:checked+span strong:before {
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        transform: translate(-2px, 0);
    }

    .switch input:checked+span strong:after {
        opacity: 1;
        visibility: visible;
        transform: translate(0, 0);
        transition: all 0.3s ease 0.2s;
    }

    html {
        -webkit-font-smoothing: antialiased;
    }

    * {
        box-sizing: border-box;
    }

    *:before,
    *:after {
        box-sizing: border-box;
    }

    .switch {
        display: table;
        margin: 12px auto;
        min-width: 118px;
    }

    .dribbble {
        position: fixed;
        display: block;
        right: 20px;
        bottom: 20px;
    }

    .dribbble img {
        display: block;
        height: 28px;
    }

    .iti {
        display: block;
    }

    .country-select {
        display: block;
    }
</style>
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
            <form id="editEmployeeForm" method="post" action="{{ route('admin.employee.update') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="nav-link">Personal details<h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-lg-3">
                                    <div class="mt-3">
                                        <input type="hidden" name="old_photo" id="oldPhoto" value="{{ $employee['photo'] }}" />
                                        <input type="file" name="photo" id="photo" data-plugins="dropify" data-default-file="{{ $employee['photo'] && asset('public/images/staffs/').'/'.$employee['photo'] ? asset('public/images/staffs/').'/'.$employee['photo'] : asset('public/images/users/default.jpg') }}" />
                                        <p class="text-muted text-center mt-2 mb-0">Photo</p>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row -->
                        <input type="hidden" class="form-control" id="id" name="id" value="{{$employee['id']}}">
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
                                        <input type="text" class="form-control shortNameChange" value="{{$employee['first_name']}}" name="first_name" id="firstName" placeholder="AHMAD">
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
                                        <input type="text" class="form-control shortNameChange" value="{{$employee['last_name']}}" name="last_name" id="lastName" placeholder="ABDULLAH">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
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
                                    <label for="short_name">Short name</label>
                                    <input type="text" value="{{$employee['short_name']}}" class="form-control" name="short_name" id="shortName" placeholder="AHMAD ABDULLAH">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="religion">Religion</label>
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
                                    <label for="race">Race</label>
                                    <select class="form-control" name="race" id="addRace">
                                        <option value="">Choose race</option>
                                        @forelse($races as $r)
                                        <option value="{{$r['id']}}" {{$employee['race'] == $r['id'] ? 'selected' : ''}}>{{$r['races_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Passport">Passport Number</label>
                                    <input type="text" class="form-control" name="passport" value="{{$employee['passport']}}" id="Passport" placeholder="Passport Number">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nric_number">NRIC Number</label>
                                    <input type="text" class="form-control" name="nric_number" value="{{$employee['nric_number']}}" id="nricNumber" placeholder="NRIC Number">
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
                                        <input type="text" class="form-control" name="birthday" value="{{$employee['birthday']}}" placeholder="YYYY-MM-DD" id="empDOB">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="mobile_no">Mobile No</label>
                                <input type="text" class="form-control number_validation" value="{{$employee['mobile_no']}}" placeholder="(XXX)-(XXX)-(XXXX)" name="mobile_no" id="mobile_no">   
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employment_status">Employment status</label>
                                    <select class="form-control" name="employment_status" id="employment_status">
                                        <option value="">Choose employment status</option>
                                        <option value="Under_Probation" {{$employee['employment_status'] =="Under_Probation" ? 'selected' : '' }}>Under Probation</option>
                                        <option value="Employed" {{$employee['employment_status'] =="Employed" ? 'selected' : '' }}>Employed</option>
                                        <option value="Transferred" {{$employee['employment_status'] =="Transferred" ? 'selected' : '' }}>Transferred</option>
                                        <option value="Resign" {{$employee['employment_status'] =="Resign" ? 'selected' : '' }}>Resign</option>
                                        <option value="Retired" {{$employee['employment_status'] =="Retired" ? 'selected' : '' }}>Retired</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" value="{{$employee['country']}}" class="form-control" name="country" id="Country" placeholder="Country">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state">State/Province</label>
                                    <input type="text" value="{{$employee['state']}}" class="form-control" name="state" id="State" placeholder="State/Province">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" value="{{$employee['city']}}" class="form-control" name="city" id="City" placeholder="City">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="post_code">Zip/Postal code</label>
                                    <input type="text" value="{{$employee['post_code']}}" class="form-control" name="post_code" id="postCode" placeholder="Zip/Postal code">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="present_address">Address 1</label>
                                    <input class="form-control" name="present_address" id="present_address" value="{{$employee['present_address']}}" placeholder="Address 1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="permanent_address">Address 2</label>
                                    <input class="form-control" name="permanent_address" id="permanent_address" value="{{$employee['permanent_address']}}" placeholder="Address 2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">Employee Details<h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="role_id">Role<span class="text-danger">*</span></label>
                                    <!-- <select class="form-control" name="role_id" id="role_id"> -->
                                    <select class="form-control select2-multiple" data-toggle="select2" id="role_id" name="role_id" multiple="multiple" data-placeholder="Choose The Role">
                                        <option value="">Select Role</option>
                                        @forelse($roles as $r)
                                        @php
                                        $selected = "";
                                        @endphp
                                        @foreach(explode(',', $role['role_id']) as $info)
                                        @if($r['id'] == $info)
                                        @php
                                        $selected = "Selected";
                                        @endphp
                                        @endif
                                        @endforeach
                                        <option value="{{$r['id']}}" {{ $selected }}>{{$r['role_name']}}</option>
                                        @empty
                                        @endforelse

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
                                        <input type="text" class="form-control" value="{{$employee['joining_date']}}" name="joining_date" id="joiningDate" placeholder="YYYY-MM-DD">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation_id">Designation</label>
                                    <select class="form-control select2-multiple" data-toggle="select2" id="empDesignation" name="designation_id[]" multiple="multiple" data-placeholder="Choose The Designation">
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
                                    <label for="department_id">Department</label>
                                    <select class="form-control select2-multiple" data-toggle="select2" id="empDepartment" name="department_id" multiple="multiple" data-placeholder="Choose The Department">
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
                                    <input type="number" value="{{$employee['salary_grade']}}" class="form-control" name="salary_grade" id="salaryGrade" placeholder="Salary Grade">
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
                                    <select class="form-control select2-multiple" data-toggle="select2" id="staffQualification" name="staff_qualification_id" multiple="multiple" data-placeholder="Choose The Qualification">
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
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">Login Details<h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" value="{{$role['id']}}" class="form-control" name="role_user_id" id="role_user_id">
                            <div class="col-md-5">
                                <div class="form-group mb-3">
                                    <label for="email">Email<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-envelope-open"></span>
                                            </div>
                                        </div>
                                        <input type="email" value="{{$role['email']}}" class="form-control" name="email" id="email" placeholder="xxxxx@gmail.com">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-unlock"></span>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="*********">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <label class="switch">Authentication

                                        <input id="edit_status" name="status" type="checkbox" {{ $employee['status'] == "1" ? "checked" : "" }}>
                                        <span>
                                            <em></em>
                                            <strong></strong>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <!-- <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="confirm_password">Retype Password</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-unlock"></span>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">Social Link<h4>
                        </li>
                    </ul>
                    <div class="card-body">
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
                                        <input type="text" class="form-control" name="facebook_url" value="{{$employee['facebook_url']}}" id="facebook_url" placeholder="Fb.com">
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
                                        <input type="text" class="form-control" name="twitter_url" value="{{$employee['twitter_url']}}" id="twitter_url" placeholder="twitter.com">
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
                                        <input type="text" class="form-control" name="linkedin_url" value="{{$employee['linkedin_url']}}" id="linkedin_url" placeholder="linked.com">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">Medical History<h4>
                        </li>
                    </ul>
                    <div class="card-body">
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
                                        <input type="text" id="height" class="form-control" value="{{$employee['height']}}" name="height" placeholder="Height" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="weight">Weight</label>
                                        <input type="text" id="weight" class="form-control" value="{{$employee['weight']}}" name="weight" placeholder="Weight" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="allergy">Allergy</label>
                                        <input type="text" id="allergy" class="form-control" value="{{$employee['allergy']}}" name="Allergy" placeholder="Allergy" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="blood_group">Blood Group</label>
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
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">Bank Details<h4>
                        </li>
                    </ul>
                    <div class="card-body">
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
                                        <input type="text" id="bank_name" value="{{ isset($bank['bank_name']) ? $bank['bank_name']:' ' }}" class="form-control" name="bank_name" placeholder="Bank Name" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="holder_name">Account Holder<span class="text-danger">*</span></label>
                                        <input type="text" id="holder_name" value="{{ isset($bank['holder_name']) ? $bank['holder_name']:''}}" class="form-control" name="holder_name" placeholder="Ali" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bank_branch">Bank Branch<span class="text-danger">*</span></label>
                                        <input type="text" id="bank_branch" value="{{ isset($bank['bank_branch']) ? $bank['bank_branch']:'' }}" class="form-control" name="bank_branch" placeholder="Branch Name" data-parsley-trigger="change">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="bank_address">Bank Address<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ isset($bank['bank_address']) ? $bank['bank_address']:'' }}" id="bank_address" name="bank_address" placeholder="Bank Address" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="ifsc_code">IFSC Code<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ isset($bank['ifsc_code']) ? $bank['ifsc_code']:''}}" id="ifsc_code" name="ifsc_code" placeholder="IFSC Code" aria-describedby="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="">Account No<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ isset($bank['account_no']) ? $bank['account_no']:'' }}" id="account_no" name="account_no" placeholder="Account Number" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                Update
                            </button>
                            <a href="{{ route('admin.listemployee') }}" class="btn btn-primary-bl waves-effect waves-light">
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div> <!-- end col -->
    </div> <!-- end row-->
</div><!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('public/mobile-country/js/intlTelInput.js') }}"></script>
<script src="{{ asset('public/country/js/countrySelect.js') }}"></script>
<script>
    var input = document.querySelector("#mobile_no");
    intlTelInput(input, {
        allowExtensions: true,
        autoFormat: false,
        autoHideDialCode: false,
        autoPlaceholder: false,
        defaultCountry: "auto",
        ipinfoToken: "yolo",
        nationalMode: false,
        numberType: "MOBILE",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        //preferredCountries: ['cn', 'jp'],
        preventInvalidNumbers: true,
        // utilsScript: "js/utils.js"
    });

    $("#Country").countrySelect({
        responsiveDropdown: true
    });
</script>
<script src="{{ asset('public/libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('public/libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('public/js/pages/form-fileuploads.init.js') }}"></script>
<script src="{{ asset('public/js/pages/form-advanced.init.js') }}"></script>

<script>
    var employeeListShow = "{{ route('admin.listemployee') }}";
    var employeeList = null;
</script>
<script src="{{ asset('public/js/custom/employee.js') }}"></script>
@endsection