@extends('layouts.admin-layout')
@section('title','Admission')
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
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="" class="icon-dual" id="span-parent"></span>Academic Details
                            <h4>
                    </li>
                </ul>
                <div class="card-body">

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <span class=" fas fa-user-graduate" id="parent"></span>
                                    <span class="header-title mb-3" id="parent">Student Admission</span>
                                    <hr>
                                    <span class="fas fa-home  " id="span-parent"></span>
                                    <span class="header-title mb-3" id="span-parent">Academic Details
                                        <hr id="hr">
                                    </span>
                                    <form id="addadmission" method="post" action="{{ route('admin.admission.add') }}" enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="btwyears">Academic Year<span class="text-danger">*</span></label>
                                                    <select id="btwyears" class="form-control" name="year">
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
                                                    <label for="">Register No<span class="text-danger">*</span></label>
                                                    <input type="" id="txt_regiter_no" class="form-control" name="txt_regiter_no" data-parsley-trigger="change">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Roll<span class="text-danger">*</span></label>
                                                    <input type="" id="txt_roll_no" class="form-control" name="txt_roll_no" data-parsley-trigger="change">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label for="">Admission Date<span class="text-danger">*</span></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="far fa-calendar-alt"></span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control homeWorkAdd" id="admission_date" name="admission_date" placeholder="" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="class_id">Standard<span class="text-danger">*</span></label>
                                                    <select id="class_id" class="form-control" name="class_id">
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
                                                    <select id="section_id" class="form-control" name="section_id">
                                                        <option value="">Select Class Name</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Category<span class="text-danger">*</span></label>
                                                    <select id="categy" name="categy" class="form-control">
                                                        <option value="">Choose..</option>
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
                                        <span class="fas fa-user-check" id="span-parent"></span>
                                        <span class="header-title mb-3" id="span-parent">Student Details
                                            <hr id="hr">
                                        </span>
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
                                                        <input type="text" name="fname" class="form-control" id="fname" placeholder="" aria-describedby="inputGroupPrepend">
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
                                                        <input type="text" name="lname" class="form-control" id="lname" placeholder="" aria-describedby="inputGroupPrepend">
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="blooddgrp">Blood Group</label>
                                                    <select id="blooddgrp" name="blooddgrp" class="form-control">
                                                        <option value="">Select Blood Group</option>
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
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="">Date Of Birth</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-birthday-cake"></span>
                                                            </div>
                                                        </div>
                                                        <input type="text" name="dob" class="form-control homeWorkAdd" id="dob" placeholder="" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label for="">Mother Tongue</label>
                                                    <input type="" id="txt_mothertongue" class="form-control" name="txt_mothertongue" data-parsley-trigger="change">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Religion</label>
                                                    <input type="txt_religion" id="" class="form-control" name="txt_religion" data-parsley-trigger="change">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Caste</label>
                                                    <input type="" id="txt_caste" class="form-control" name="txt_caste" data-parsley-trigger="change">
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
                                                        <input type="text" name="txt_mobile_no" class="form-control" id="txt_mobile_no" placeholder="" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">City</label>
                                                    <input type="" id="drp_city" class="form-control" name="drp_city" data-parsley-trigger="change">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">State</label>
                                                    <input type="" id="drp_state" class="form-control" name="drp_state" data-parsley-trigger="change">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="txtarea_paddress">Present Address</label>
                                                    <textarea id="txtarea_paddress" class="form-control" name="txtarea_paddress">
                                        </textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="txtarea_permanent_address">Permanent Address</label>
                                                    <textarea id="txtarea_permanent_address" class="form-control" name="txtarea_permanent_address">
                                        </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="document" class="col-form-label">Photo</label>
                                                    <div class="col-12">
                                                        <input type="file" class="custom-file-input" name="photo">
                                                        <label class="custom-file-label" for="document">Choose file</label>
                                                        <span id="file_name"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="col-12">
                                    
                                    <label for="pc">Profile Picture</label>
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="file" data-plugins="dropify" data-height="300" name="photo"/>
                                        </div>
                                    </div>>
                                </div> -->
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
                                                        <input type="text" name="txt_emailid" class="form-control" id="txt_emailid" placeholder="" aria-describedby="inputGroupPrepend">
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
                                                        <input type="password" name="txt_pwd" class="form-control" id="txt_pwd" placeholder="" aria-describedby="inputGroupPrepend">
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
                                                        <input type="password" name="txt_retype_pwd" class="form-control" id="txt_retype_pwd" placeholder="" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="fas fa-user-tie" id="span-parent"></span>
                                        <span class="header-title mb-3" id="span-parent">Guardian Details
                                            <hr id="hr">
                                        </span>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="check_guardian" name="check_guardian">
                                                <label class="custom-control-label" for="check_guardian">Guardian Already Exist</label>
                                            </div>
                                        </div>
                                        <div class="row" id="parent_list" style="display:none;">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="heard">Guardian<span class="text-danger">*</span></label>
                                                    <select id="parent_id" name="parent_id" class="form-control">
                                                        <option value="">Select Guardian</option>
                                                        @foreach($parent as $par)
                                                        <option value="{{$par['id']}}">{{$par['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck11">
                                    <label class="custom-control-label" for="customCheck11">Skipped Bank Details</label>
                                </div>
                            </div> -->
                                        <div id="guardian_form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="heard">Name<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="txt_name" id="txt_name" placeholder="" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="heard">Relation<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="txt_relation" id="txt_relation" placeholder="" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="heard">Father Name</label>
                                                        <input type="text" class="form-control" name="txt_fathernam" id="txt_fathernam" placeholder="" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="heard">Mother Name</label>
                                                        <input type="text" class="form-control" name="txt_mothernam" id="txt_mothernam" placeholder="" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Occupation<span class="text-danger">*</span></label>
                                                        <input type="" id="txt_occupation" class="form-control" name="txt_occupation" data-parsley-trigger="change">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Income</label>
                                                        <input type="" id="txt_income" class="form-control" name="txt_income" data-parsley-trigger="change">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Education</label>
                                                        <input type="" id="txt_eduction" class="form-control" name="txt_eduction" data-parsley-trigger="change">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="validationCustomUsername">City</label>
                                                        <input type="text" class="form-control" id="txt_guardian_city" name="txt_guardian_city" placeholder="" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="validationCustomUsername">State</label>
                                                        <input type="text" class="form-control" id="txt_guardian_state" name="txt_guardian_state" placeholder="" aria-describedby="inputGroupPrepend">
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
                                                            <input type="text" class="form-control" id="txt_guardian_mobileno" name="txt_guardian_mobileno" placeholder="" aria-describedby="inputGroupPrepend">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="message">Address</label>
                                                <textarea id="txt_guardian_address" class="form-control" name="txt_guardian_address" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
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
                                                            <input type="text" class="form-control" id="txt_guardian_email" name="txt_guardian_email" placeholder="" aria-describedby="inputGroupPrepend">
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
                                                            <input type="password" class="form-control" name="txt_guardian_pwd" id="txt_guardian_pwd" placeholder="" aria-describedby="inputGroupPrepend">
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
                                                            <input type="password" class="form-control" name="txt_guardian_retyppwd" id="txt_guardian_retyppwd" placeholder="" aria-describedby="inputGroupPrepend">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="fas fa-bus-alt  " id="span-parent"></span>
                                        <span class="header-title mb-3" id="span-parent">Transport Details
                                            <hr id="hr">
                                        </span>
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
                                                        <option value="">First select the branch</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="fas fa-hotel" id="span-parent"></span>
                                        <span class="header-title mb-3" id="span-parent">Hostel Details
                                            <hr id="hr">
                                        </span>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="drp_hostelnam">Hostel Name</label>
                                                    <select id="drp_hostelnam" name="drp_hostelnam" class="form-control">
                                                        <option value="">Select Hostel</option>
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
                                                        <option value="">First select the hostel</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="fas fa-holly-berry" id="span-parent"></span>
                                        <span class="header-title mb-3" id="span-parent">Previous School Details
                                            <hr style="margin-top:-1%;margin-left:20%;color:blue">
                                        </span>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">School Name</label>
                                                    <input type="" id="txt_prev_schname" class="form-control" name="txt_prev_schname" data-parsley-trigger="change">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Qualification</label>
                                                    <input type="" id="txt_prev_qualify" class="form-control" name="txt_prev_qualify" data-parsley-trigger="change">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="message">Remarks</label>
                                            <textarea id="txtarea_prev_remarks" class="form-control" name="txtarea_prev_remarks" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
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
                @section('scripts')
                <script>
                    var sectionByClass = "{{ route('admin.section_by_class') }}";
                    var vehicleByRoute = "{{ route('admin.vehicle_by_route') }}";
                    var roomByHostel = "{{ route('admin.room_by_hostel') }}";
                    var indexAdmission = "{{ route('admin.student.index') }}";
                </script>
                <script src="{{ asset('js/custom/admission.js') }}"></script>
                @endsection