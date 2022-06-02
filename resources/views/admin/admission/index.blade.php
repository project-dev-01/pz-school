@extends('layouts.admin-layout')
@section('title','Admission')
@section('css')
<link rel="stylesheet" href="{{ asset('libs/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('libs/dropify/css/dropify.min.css') }}">
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12 addadmission">
            <div class="page-title-box">
                <h4 class="page-title">Student Admission</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <form id="addadmission" method="post" action="{{ route('admin.admission.add') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">Student Details<h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-lg-3">
                                    <div class="mt-3">
                                        <input type="file" name="photo" id="photo" data-plugins="dropify" data-default-file="{{ asset('images/700x500.png') }}" />
                                        <p class="text-muted text-center mt-2 mb-0">Photo</p>
                                    </div>
                                </div>
                            </div>
                        </div> 
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
                                        <input type="text" name="fname" class="form-control alloptions" maxlength="50" id="fname" placeholder="Ahmad Ali" aria-describedby="inputGroupPrepend" >
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
                                        <input type="text" name="lname" class="form-control alloptions" maxlength="50" id="lname" placeholder="Muhammad Jaafar" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select id="gender" name="gender" class="form-control">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="blooddgrp">Blood Group</label>
                                    <select id="blooddgrp" name="blooddgrp" class="form-control">
                                        <option value="">Pick Blood Type</option>
                                        <option>O+</option>
                                        <option>A+</option>
                                        <option>B+</option>
                                        <option>AB+</option>
                                        <option>O-</option>
                                        <option>A-</option>
                                        <option>B-</option>
                                        <option>AB-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="dob">Date Of Birth</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-birthday-cake"></span>
                                            </div>
                                        </div>
                                        <input type="text" name="dob" class="form-control" id="dob" placeholder="23 July 2024" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txt_nric">NRIC Number</label>
                                    <input type="text" maxlength="50" id="txt_nric" class="form-control alloptions" placeholder="Identifaction Number" name="txt_nric" data-parsley-trigger="change">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txt_religion">Religion</label>
                                    <select class="form-control" name="txt_religion" id="religion">
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
                                    <label for="txt_caste">Race</label>
                                    <select class="form-control" name="txt_race" id="addRace">
                                        <option value="">Choose race</option>
                                        @forelse($races as $r)
                                        <option value="{{$r['id']}}">{{$r['races_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="txt_mobile_no">Contact Number<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-phone-volume"></span>
                                            </div>
                                        </div>
                                        <input type="text" name="txt_mobile_no" class="form-control" id="txt_mobile_no" placeholder="(00)00000-00000" data-toggle="input-mask" data-mask-format="(00) 00000-00000" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="drp_country">Country</label>
                                    <input type="text" maxlength="50" id="drp_country" class="form-control alloptions" placeholder="country" name="drp_country" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="drp_state">State/Province</label>
                                    <input type="text" maxlength="50" id="drp_state" class="form-control alloptions" placeholder="state" name="drp_state" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="drp_city">City</label>
                                    <input type="text" maxlength="50" id="drp_city" class="form-control alloptions" placeholder="city" name="drp_city" data-parsley-trigger="change">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="drp_post_code">Zip/Postal Code</label>
                                    <input type="text" maxlength="50" id="drp_post_code" class="form-control alloptions" placeholder="Post Code" name="drp_post_code" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txtarea_paddress">Address 1</label>
                                    <input type="text" maxlength="50" id="txtarea_paddress" class="form-control alloptions" placeholder="Address" name="txtarea_paddress" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txtarea_permanent_address">Address 2</label>
                                    <input type="text" maxlength="50" id="txtarea_permanent_address" class="form-control alloptions" placeholder="Address" name="txtarea_permanent_address" data-parsley-trigger="change">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">Academic Details</h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="btwyears">Academic Year<span class="text-danger">*</span></label>
                                    <select id="btwyears" class="form-control" name="year" >
                                        <option>2021-2022</option>
                                        <option>2020-2021</option>
                                        <option>2019-2020</option>
                                        <option>2018-2019</option>
                                        <option>2017-2018</option>
                                        <option>2016-2017</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txt_regiter_no">Register No<span class="text-danger">*</span></label>
                                    <input type="text" id="txt_regiter_no" class="form-control" name="txt_regiter_no" placeholder="Insert the registration number" data-parsley-trigger="change" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txt_roll_no">Roll<span class="text-danger">*</span></label>
                                    <input type="text" id="txt_roll_no" class="form-control" name="txt_roll_no" placeholder="Input the roll" data-parsley-trigger="change" >
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="text">Admission Date<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="admission_date" name="admission_date" placeholder="23 July 2024" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="class_id">Standard<span class="text-danger">*</span></label>
                                    <select id="class_id" class="form-control" name="class_id" >
                                        <option value="">Select Standard</option>
                                        @foreach($class as $cla)
                                        <option value="{{$cla['id']}}">{{$cla['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="section_id">Class Name<span class="text-danger">*</span></label>
                                    <select id="section_id" class="form-control" name="section_id" >
                                        <option value="">Select Class Name</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="categy">Category<span class="text-danger">*</span></label>
                                    <select id="categy" name="categy" class="form-control" >
                                        <option value="">Choose the Category</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="session_id">Session</label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="0">Select Session</option>
                                        @foreach($session as $ses)
                                        <option value="{{$ses['id']}}">{{$ses['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="semester_id">Semester</label>
                                    <select id="semester_id" class="form-control" name="semester_id">
                                        <option value="0">Select Semester</option>
                                        @foreach($semester as $sem)
                                        <option value="{{$sem['id']}}">{{$sem['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">Student Login Details<h4>
                        </li>
                    </ul>
                    <div class="card-body">
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
                                        <input type="text" name="txt_emailid" class="form-control" id="txt_emailid" placeholder="xxxxx@gmail.com" aria-describedby="inputGroupPrepend" >
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
                                        <input type="password" name="txt_pwd" class="form-control" id="txt_pwd" placeholder="********" aria-describedby="inputGroupPrepend" >
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
                                        <input type="password" name="txt_retype_pwd" class="form-control" id="txt_retype_pwd" placeholder="*********" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">Father Details<h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="father_name">Father Name</label>
                                    <input type="text" class="form-control"  maxlength="50" id="father_name"  aria-describedby="inputGroupPrepend">
                                    <input type="hidden" name="father_id" id="father_id">
                                    <div id="father_list">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4" id="father_photo" style="display:none;">
                                
                            </div> 
                        </div>
                        <div id="father_form"  style="display:none;">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="heard">First Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"  maxlength="50" id="father_first_name"  aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="heard">Last Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"  maxlength="50" id="father_last_name"  aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select class="form-control"  id="father_gender" disabled>
                                            <option value="">Choose Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="birthday">Date Of Birth</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="fas fa-birthday-cake"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control"  id="father_date_of_birth" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Passport">Passport</label>
                                        <input type="text" class="form-control"id="father_passport" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="heard">NRIC Number</label>
                                        <input type="text" maxlength="50" id="father_nric" class="form-control" placeholder="Identifaction Number" data-parsley-trigger="change" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="blooddgrp">Blood Group</label>
                                        <select  class="form-control" id="father_blooddgrp" disabled>
                                            <option value="">Pick Blood Type</option>
                                            <option>O+</option>
                                            <option>A+</option>
                                            <option>B+</option>
                                            <option>AB+</option>
                                            <option>O-</option>
                                            <option>A-</option>
                                            <option>B-</option>
                                            <option>AB-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile_no">Mobile No<span class="text-danger">*</span></label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="fas fa-phone-volume"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" aria-describedby="inputGroupPrepend" id="father_mobile_no" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="education">Education</label>
                                        <input type="text"  class="form-control" data-parsley-trigger="change" id="father_education" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txt_occupation">Occupation<span class="text-danger">*</span></label>
                                        <input type="text" maxlength="50" id="father_occupation" class="form-control "  placeholder="Occupation" data-parsley-trigger="change" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txt_income">Income</label>
                                        <input type="text" maxlength="50" id="father_income" class="form-control "  placeholder="Income" data-parsley-trigger="change" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <input type="text"  class="form-control" id="father_country" data-parsley-trigger="change" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="validationCustomUsername">State/Province</label>
                                        <input type="text" class="form-control " maxlength="50" id="father_state"  placeholder="state" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="validationCustomUsername">City</label>
                                        <input type="text" class="form-control " maxlength="50" id="father_city"  placeholder="city" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_post_code">Zip/Postal code</label>
                                        <input type="text" class="form-control" id="father_post_code" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="father_address"> Address 1</label>
                                        <input type="text" class="form-control" id="father_address" readonly>
								        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="father_address_2"> Address 2</label>
                                        <input type="text" class="form-control" id="father_address_2" readonly>
								        </textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">Mother Details<h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mother_name">Mother Name</label>
                                    <input type="text" class="form-control"  maxlength="50" id="mother_name"  aria-describedby="inputGroupPrepend">
                                    <input type="hidden" name="mother_id" id="mother_id">
                                    <div id="mother_list">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4" id="mother_photo" style="display:none;">
                                
                            </div> 
                        </div>
                        <div id="mother_form"  style="display:none;">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="heard">First Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"  maxlength="50" id="mother_first_name"  aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="heard">Last Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"  maxlength="50" id="mother_last_name"  aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select class="form-control"  id="mother_gender" disabled>
                                            <option value="">Choose Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="birthday">Date Of Birth</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="fas fa-birthday-cake"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control"  id="mother_date_of_birth" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Passport">Passport</label>
                                        <input type="text" class="form-control"id="mother_passport" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="heard">NRIC Number</label>
                                        <input type="text" maxlength="50" id="mother_nric" class="form-control" placeholder="Identifaction Number" data-parsley-trigger="change" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="blooddgrp">Blood Group</label>
                                        <select  class="form-control" id="mother_blooddgrp" disabled>
                                            <option value="">Pick Blood Type</option>
                                            <option>O+</option>
                                            <option>A+</option>
                                            <option>B+</option>
                                            <option>AB+</option>
                                            <option>O-</option>
                                            <option>A-</option>
                                            <option>B-</option>
                                            <option>AB-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile_no">Mobile No<span class="text-danger">*</span></label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="fas fa-phone-volume"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" aria-describedby="inputGroupPrepend" id="mother_mobile_no" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="education">Education</label>
                                        <input type="text"  class="form-control" data-parsley-trigger="change" id="mother_education" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txt_occupation">Occupation<span class="text-danger">*</span></label>
                                        <input type="text" maxlength="50" id="mother_occupation" class="form-control"  placeholder="Occupation" data-parsley-trigger="change" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txt_income">Income</label>
                                        <input type="text" maxlength="50" id="mother_income" class="form-control"  placeholder="Income" data-parsley-trigger="change" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <input type="text"  class="form-control" id="mother_country" data-parsley-trigger="change" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="validationCustomUsername">State/Province</label>
                                        <input type="text" class="form-control" maxlength="50" id="mother_state"  placeholder="state" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="validationCustomUsername">City</label>
                                        <input type="text" class="form-control" maxlength="50" id="mother_city"  placeholder="city" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_post_code">Zip/Postal code</label>
                                        <input type="text" class="form-control" id="mother_post_code" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="mother_address"> Address 1</label>
                                        <input type="text" class="form-control" id="mother_address" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="mother_address_2"> Address 2</label>
                                        <input type="text" class="form-control" id="mother_address_2" readonly>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">Guardian Details<h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="guardian_name">Guardian Name</label>
                                    <input type="text" class="form-control"  maxlength="50" id="guardian_name"  aria-describedby="inputGroupPrepend">
                                    <input type="hidden" name="guardian_id" id="guardian_id">
                                    <div id="guardian_list">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="relation">Relation</label>
                                    <select class="form-control" name="relation">
                                        <option value="">Choose Relation</option>
                                        @forelse($relation as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-3" id="guardian_photo" style="display:none;">
                                
                            </div> 
                        </div>
                        <div id="guardian_form"  style="display:none;">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="heard">First Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"  maxlength="50" id="guardian_first_name"  aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="heard">Last Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"  maxlength="50" id="guardian_last_name"  aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select class="form-control"  id="guardian_gender" disabled>
                                            <option value="">Choose Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="birthday">Date Of Birth</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="fas fa-birthday-cake"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control"  id="guardian_date_of_birth" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Passport">Passport</label>
                                        <input type="text" class="form-control"id="guardian_passport" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="heard">NRIC Number</label>
                                        <input type="text" maxlength="50" id="guardian_nric" class="form-control" placeholder="Identifaction Number" data-parsley-trigger="change" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="blooddgrp">Blood Group</label>
                                        <select  class="form-control" id="guardian_blooddgrp" disabled>
                                            <option value="">Pick Blood Type</option>
                                            <option>O+</option>
                                            <option>A+</option>
                                            <option>B+</option>
                                            <option>AB+</option>
                                            <option>O-</option>
                                            <option>A-</option>
                                            <option>B-</option>
                                            <option>AB-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile_no">Mobile No<span class="text-danger">*</span></label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="fas fa-phone-volume"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" aria-describedby="inputGroupPrepend" id="guardian_mobile_no" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="education">Education</label>
                                        <input type="text"  class="form-control" data-parsley-trigger="change" id="guardian_education" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txt_occupation">Occupation<span class="text-danger">*</span></label>
                                        <input type="text" maxlength="50" id="guardian_occupation" class="form-control"  placeholder="Occupation" data-parsley-trigger="change" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txt_income">Income</label>
                                        <input type="text" maxlength="50" id="guardian_income" class="form-control"  placeholder="Income" data-parsley-trigger="change" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <input type="text"  class="form-control" id="guardian_country" data-parsley-trigger="change" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="validationCustomUsername">State/Province</label>
                                        <input type="text" class="form-control" maxlength="50" id="guardian_state"  placeholder="state" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="validationCustomUsername">City</label>
                                        <input type="text" class="form-control" maxlength="50" id="guardian_city"  placeholder="city" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_post_code">Zip/Postal code</label>
                                        <input type="text" class="form-control" id="guardian_post_code" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="guardian_address"> Address 1</label>
                                        <input type="text" class="form-control" id="guardian_address" readonly>
								        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="guardian_address_2"> Address 2</label>
                                        <input type="text" class="form-control" id="guardian_address_2" readonly>
								        </textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">Transport Details<h4>
                        </li>
                    </ul>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="drp_transport_route">Transport Route</label>

                                    <select id="drp_transport_route" name="drp_transport_route" class="form-control">
                                        <option value="">Select Transport</option>
                                        @foreach($transport as $trans)
                                        <option value="{{$trans['id']}}">{{$trans['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="drp_transport_vechicleno">Vechicle No</label>
                                    <select id="drp_transport_vechicleno" name="drp_transport_vechicleno" class="form-control">
                                        <option value="0">First select the branch</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">Hostel Details<h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="drp_hostelnam">Hostel Name</label>
                                    <select id="drp_hostelnam" name="drp_hostelnam" class="form-control">
                                        <option value="0">Select Hostel</option>
                                        @foreach($hostel as $hos)
                                        <option value="{{$hos['id']}}">{{$hos['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="drp_roomname">Room Name</label>
                                    <select id="drp_roomname" name="drp_roomname" class="form-control">
                                        <option value="0">First select the hostel</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">Previous School Details<h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_prev_schname">School Name</label>
                                    <input type="text" maxlength="50" id="txt_prev_schname" placeholder="Schoolname" class="form-control alloptions" name="txt_prev_schname" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_prev_qualify">Qualification</label>
                                    <input type="text" maxlength="50" id="txt_prev_qualify" placeholder="Qualification" class="form-control alloptions" name="txt_prev_qualify" data-parsley-trigger="change">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Remarks</label>
                            <textarea maxlength="255" id="txtarea_prev_remarks" class="form-control alloptions" placeholder="Enter the text..." name="txtarea_prev_remarks" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
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

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
        </div> <!-- end col -->
        </form>
    </div>
    <!-- end row -->
</div> <!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ asset('libs/autonumeric/autoNumeric-min.js') }}"></script>

<!-- Init js-->
<script src="{{ asset('js/pages/form-masks.init.js') }}"></script>
<script src="{{ asset('libs/jquery-mask-plugin/jquery.mask.min.js') }}"></script>
<!-- Init js-->
<script>
    $(function() {
        $(".alloptions").maxlength({
            alwaysShow: !0,
            separator: "/",
            preText: " ",
            postText: " chars available.",
            validate: !0,
            //fontSize:"20%",
            warningClass: "badge badge-success badge-custom",
            limitReachedClass: "badge badge-danger badge-custom",
        })

    });
</script>
<script>
    var parentImg = "{{ asset('users/images/') }}";
    var defaultImg = "{{ asset('images/users/default.jpg') }}";
    var parentName = "{{ config('constants.api.parent_name') }}";
    var parentDetails = "{{ config('constants.api.parent_details') }}";
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var vehicleByRoute = "{{ route('admin.vehicle_by_route') }}";
    var roomByHostel = "{{ route('admin.room_by_hostel') }}";
    var indexAdmission = "{{ route('admin.student.index') }}";
</script>

<script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/pages/form-fileuploads.init.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/custom/admission.js') }}"></script>
@endsection