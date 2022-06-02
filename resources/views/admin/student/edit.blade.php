@extends('layouts.admin-layout')
@section('title','Edit Student')
@section('content')
@section('css')
<link rel="stylesheet" href="{{ asset('libs/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('libs/dropify/css/dropify.min.css') }}">
@endsection
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <!-- <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Wizard</li>
                    </ol>-->
                </div>
                <h4 class="page-title">Student Profile</h4>
            </div>
        </div>
    </div>     
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card-box" style="background-color:powderblue;">
                <div class="row">
                    <div class="col-xl-3">
                        @if($student['photo'])
                            <img src="{{ asset('users/images//') }}/{{$student['photo']}}" alt="" class="img-fluid mx-auto d-block rounded user-img">
                        @else
                            <img src="{{ asset('images/users/default.jpg') }}" alt="" class="img-fluid mx-auto d-block rounded">
                        @endif
                        
                    </div> <!-- end col -->
                    <div class="col-lg-7">
                        <div class="pl-xl-3 mt-3 mt-xl-0">                                              
                            <h1 class="mb-3">{{$student['first_name']}} {{$student['last_name']}}</h5>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div>
                                        <!-- <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="fas fa-users"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset"></a></h5>
                                            </div>
                                        </div> -->
                                        <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="fas fa-birthday-cake"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">{{$student['birthday']}}</a></h5>
                                            </div>
                                        </div>
                                        <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="fas fa-school"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">{{$student['class_name']}} ({{$student['section_name']}})</a></h5>
                                            </div>
                                        </div>
                                    
                                        <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="fas fa-phone-volume"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">{{$student['mobile_no']}}</a></h5>
                                            </div>
                                        </div>
                                        <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="far fa-envelope"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">{{$student['email']}}</a></h5>
                                            </div>
                                        </div>
                                        <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="fas fa-home"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">{{$student['current_address']}}</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div><!-- end row -->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div><!-- end row-->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">                                          
                            <span class="header-title mb-3" id="span-parent" data-toggle="collapse" href="#basic_detail" role="button" aria-expanded="false" aria-controls="basic_detail"><i class="fas fa-user-edit"></i> Student Information</span>
                        </div>
                        <div class="col-lg-4">
                            <!-- <div class="text-lg-right mt-3 mt-lg-0">
                                    <button type="button" class="btn btn-white btn-rounded waves-effect waves-light mr-1"><i class="fas fa-lock mr-1"></i> Authentication</button>
                            </div> -->
                        </div><!-- end col-->
                    </div> <!-- end row -->	
                    <br>							    
                    <div class="collapse" id="basic_detail">
                        <form id="editadmission" method="post" action="{{ route('admin.student.update') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <input type="hidden" name="student_id" value="{{$student['id']}}">


                            <div class="card">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">Student Details</h4>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-lg-3">
                                                <div class="mt-3">
                                                    <input type="hidden" name="old_photo" id="oldPhoto" value="{{ $student['photo'] }}" />
                                                    <input type="file" name="photo" id="photo" data-plugins="dropify" data-default-file="{{ $student['photo'] && asset('users/images/').'/'.$student['photo'] ? asset('users/images/').'/'.$student['photo'] : asset('images/users/default.jpg') }}" />
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
                                                    <input type="text" name="fname" class="form-control" value="{{$student['first_name']}}" id="fname" placeholder="" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="">Last Name<span class="text-danger">*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user-graduate"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="lname" class="form-control" id="lname" value="{{$student['last_name']}}" placeholder="" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select id="gender" name="gender" class="form-control">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male" {{$student['gender'] == "Male" ? "Selected" : "" }}>Male</option>
                                                    <option value="Female" {{$student['gender'] == "Female" ? "Selected" : "" }}>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">Email<span class="text-danger">*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="far fa-envelope-open"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="txt_emailid" class="form-control" id="txt_emailid" placeholder="" aria-describedby="inputGroupPrepend" value="{{$student['email']}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="blooddgrp">Blood Group</label>
                                                <select id="blooddgrp" name="blooddgrp" class="form-control">
                                                    <option value="">Select Blood Group</option>
                                                    <option {{$student['blood_group'] == "O+" ? "Selected" : "" }}>O+</option>
                                                    <option {{$student['blood_group'] == "A+" ? "Selected" : "" }}>A+</option>
                                                    <option {{$student['blood_group'] == "B+" ? "Selected" : "" }}>B+</option>
                                                    <option {{$student['blood_group'] == "AB+" ? "Selected" : "" }}>AB+</option>
                                                    <option {{$student['blood_group'] == "O-" ? "Selected" : "" }}>O-</option>
                                                    <option {{$student['blood_group'] == "A-" ? "Selected" : "" }}>A-</option>
                                                    <option {{$student['blood_group'] == "B-" ? "Selected" : "" }}>B-</option>
                                                    <option {{$student['blood_group'] == "AB-" ? "Selected" : "" }}>AB-</option>
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
                                                    <input type="text" name="dob" class="form-control" value="{{$student['birthday']}}" id="dob" placeholder="" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_nric">NRIC Number</label>
                                                <input type="text" maxlength="50" id="txt_nric" class="form-control alloptions" value="{{$student['nric']}}" placeholder="Identifaction Number" name="txt_nric" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_religion">Religion</label>
                                                <select class="form-control" name="txt_religion" id="religion">
                                                    <option value="">Choose Religion</option>
                                                    @forelse($religion as $r)
                                                    <option value="{{$r['id']}}" {{$student['religion'] == $r['id'] ? "selected" : ""}}>{{$r['religions_name']}}</option>
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
                                                    <option value="{{$r['id']}}" {{$student['race'] == $r['id'] ? "selected" : ""}}>{{$r['races_name']}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="">Contact Number<span class="text-danger">*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-phone-volume"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="txt_mobile_no" class="form-control" value="{{$student['mobile_no']}}" id="txt_mobile_no" placeholder="" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="drp_country">Country</label>
                                                <input type="" id="drp_country" class="form-control" name="drp_country" data-parsley-trigger="change" value="{{$student['country']}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="drp_state">State/Province</label>
                                                <input type="" id="drp_state" class="form-control" name="drp_state" data-parsley-trigger="change" value="{{$student['state']}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="drp_city">City</label>
                                                <input type="" id="drp_city" class="form-control" name="drp_city" data-parsley-trigger="change" value="{{$student['city']}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="drp_post_code">Zip/Postal Code</label>
                                                <input type="" id="drp_post_code" class="form-control" name="drp_post_code" data-parsley-trigger="change" value="{{$student['post_code']}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txtarea_paddress">Address 1</label>
                                                <input type="" id="txtarea_paddress" class="form-control" name="txtarea_paddress" data-parsley-trigger="change" value="{{$student['current_address']}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txtarea_permanent_address">Address 2</label>
                                                <input type="" id="txtarea_permanent_address" class="form-control" name="txtarea_permanent_address" data-parsley-trigger="change" value="{{$student['permanent_address']}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">Basic Details</h4>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="btwyears">Academic Year<span class="text-danger">*</span></label>
                                                <select id="btwyears" class="form-control" name="year">
                                                    <option {{$student['year'] == "2021-2022" ? "Selected" : "" }}>2021-2022</option>
                                                    <option {{$student['year'] == "2020-2021" ? "Selected" : "" }}>2020-2021</option>
                                                    <option {{$student['year'] == "2019-2020" ? "Selected" : "" }}>2019-2020</option>
                                                    <option {{$student['year'] == "2018-2019" ? "Selected" : "" }}>2018-2019</option>
                                                    <option {{$student['year'] == "2017-2018" ? "Selected" : "" }}>2017-2018</option>
                                                    <option {{$student['year'] == "2016-2017" ? "Selected" : "" }}>2016-2017</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Register No<span class="text-danger">*</span></label>
                                                <input type="" id="txt_regiter_no" class="form-control" name="txt_regiter_no" value="{{$student['register_no']}}" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Roll<span class="text-danger">*</span></label>
                                                <input type="" id="txt_roll_no" class="form-control" name="txt_roll_no" value="{{$student['roll_no']}}" data-parsley-trigger="change">
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
                                                    <input type="text" class="form-control" id="admission_date" value="{{$student['admission_date']}}" name="admission_date" placeholder="" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="class_id">Standard<span class="text-danger">*</span></label>
                                                <select id="class_id" class="form-control" name="class_id">
                                                    <option value="">Select Standard</option>
                                                    @foreach($class as $cla)
                                                    <option value="{{$cla['id']}}" {{$student['class_id'] == $cla['id'] ? "Selected" : "" }}>{{$cla['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="section_id">Class Name<span class="text-danger">*</span></label>
                                                <select id="section_id" class="form-control"  name="section_id">                              
                                                    <option value="">Select Class Name</option>
                                                    @foreach($section as $sec)
                                                    <option value="{{$sec['section_id']}}" {{$student['section_id'] == $sec['section_id'] ? "Selected" : "" }}>{{$sec['section_name']}}</option>
                                                    @endforeach
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
                                                    <option value="1" {{$student['category_id'] == 1 ? "Selected" : "" }}>One</option>
                                                    <option value="2" {{$student['category_id'] == 2 ? "Selected" : "" }}>Two</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="session_id">Session</label>
                                                <select id="session_id" class="form-control"  name="session_id">                              
                                                    <option value="0">Select Session</option>
                                                    @foreach($session as $ses)
                                                        <option value="{{$ses['id']}}" {{$student['session_id'] == $ses['id'] ? "Selected" : "" }}>{{$ses['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="semester_id">Semester</label>
                                                <select id="semester_id" class="form-control"  name="semester_id">                              
                                                    <option value="0">Select Semester</option>
                                                    @foreach($semester as $sem)
                                                        <option value="{{$sem['id']}}" {{$student['semester_id'] == $sem['id'] ? "Selected" : "" }}>{{$sem['name']}}</option>
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
                                        <h4 class="navv">Father Details<h4>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="father_name">Father Name</label>
                                                <input type="text" class="form-control"  maxlength="50" id="father_name"  aria-describedby="inputGroupPrepend">
                                                <input type="hidden" name="father_id" id="father_id"  value="{{$student['father_id']}}">
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
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="father_address_2"> Address 2</label>
                                                    <input type="text" class="form-control" id="father_address_2" readonly>
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
                                                <input type="hidden" name="mother_id" id="mother_id" value="{{$student['mother_id']}}">
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
                                                <input type="hidden" name="guardian_id" id="guardian_id" value="{{$student['guardian_id']}}">
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
                                                    <option value="{{$r['id']}}" {{$student['relation'] == $r['id'] ? "selected" : ""}}>{{$r['name']}}</option>
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
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="guardian_address_2"> Address 2</label>
                                                    <input type="text" class="form-control" id="guardian_address_2" readonly>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">Transport Details</h4>
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
                                                    <option value="{{$trans['id']}}" {{$student['route_id'] == $trans['id'] ? "Selected" : "" }}>{{$trans['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="drp_transport_vechicleno">Vechicle No</label>
                                                <select id="drp_transport_vechicleno" name="drp_transport_vechicleno" class="form-control">
                                                    <option value="">First select the branch</option>
                                                    
                                                    @foreach($vehicle as $veh)
                                                    <option value="{{$veh['vehicle_id']}}" {{$student['vehicle_id'] == $veh['vehicle_id'] ? "Selected" : "" }}>{{$veh['vehicle_no']}}</option>
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
                                        <h4 class="navv">Hostel Details</h4>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="drp_hostelnam">Hostel Name</label>
                                                <select id="drp_hostelnam" name="drp_hostelnam" class="form-control">
                                                    <option value="">Select Hostel</option>
                                                    @foreach($hostel as $hos)
                                                    <option value="{{$hos['id']}}" {{$student['hostel_id'] == $hos['id'] ? "Selected" : "" }}>{{$hos['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="drp_roomname">Room Name</label>
                                                <select id="drp_roomname" name="drp_roomname" class="form-control">
                                                    <option value="">First select the hostel</option>
                                                    
                                                    @foreach($room as $roo)
                                                    <option value="{{$roo['room_id']}}" {{$student['room_id'] == $roo['room_id'] ? "Selected" : "" }}>{{$roo['room_name']}}</option>
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
                                        <h4 class="navv">Previous School Details</h4>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">School Name</label>
                                                <input type="" id="txt_prev_schname" class="form-control" name="txt_prev_schname" data-parsley-trigger="change" value="{{$student['school_name']}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Qualification</label>
                                                <input type="" id="txt_prev_qualify" class="form-control" name="txt_prev_qualify" data-parsley-trigger="change" value="{{$student['qualification']}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="message">Remarks</label>
                                                <textarea id="txtarea_prev_remarks" class="form-control" name="txtarea_prev_remarks">{{$student['remarks']}}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="card">
                                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                                    <li class="nav-item">
                                        <h4 class="nav-link">
                                            Change Password
                                            <h4>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="password">Password</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-unlock"></span>
                                                        </div>
                                                    </div>
                                                    <input type="password" class="form-control"  name="password" aria-describedby="inputGroupPrepend" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="confirm_password">Retype Password</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-unlock"></span>
                                                        </div>
                                                    </div>
                                                    <input type="password" class="form-control"  name="confirm_password" aria-describedby="inputGroupPrepend" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                    Update
                                </button>
                                <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                    Cancel
                                </button>-->
                            </div>
                        </form>
                    </div>
                            
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div><!-- end row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <span class="header-title mb-3" id="span-parent" data-toggle="collapse" href="#parent_detail" role="button" aria-expanded="false" aria-controls="parent_detail"><i class="fas fa-users"></i> Parent Information</span>
                    <br><br>
                    <div class="collapse" id="parent_detail">

                        <div class="card" id="father_info" style="display:none">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <h4 class="navv">Father Details</h4>
                                </li>
                            </ul>
                            <div class="card-body">
                                <div class="table-responsive mt-md mb-md">
                                    <table class="table table-striped table-bordered table-condensed mb-none">
                                        <tbody>
                                            <tr>
                                                <th width="25%">Name</th>
                                                <td width="25%" class="father_name"></td>
                                                <th width="25%">Date of Birth</th>
                                                <td width="25%" class="father_date_of_birth"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">Passport</th>
                                                <td width="25%" class="father_passport"></td>
                                                <th width="25%">NRIC Number</th>
                                                <td width="25%" class="father_nric"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">Email</th>
                                                <td width="25%" class="father_email"></td>
                                                <th width="25%">Mobile No</th>
                                                <td width="25%" class="father_mobile_no"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">Blood Group</th>
                                                <td width="25%" class="father_blood_group"></td>
                                                <th width="25%">Education</th>
                                                <td width="25%" class="father_education"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">Occupation</th>
                                                <td width="25%" class="father_occupation"></td>
                                                <th width="25%">Income</th>
                                                <td width="25%" class="father_income"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">Country</th>
                                                <td width="25%" class="father_country"></td>
                                                <th width="25%">State/Province</th>
                                                <td width="25%"  class="father_state"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">City</th>
                                                <td width="25%" class="father_city"></td>
                                                <th width="25%">Zip/Postal Code</th>
                                                <td width="25%" class="father_postal_code"></td>
                                            </tr>
                                            <tr class="quick-address">
                                                <th width="25%">Address 1</th>
                                                <td width="25%" class="father_address"></td>
                                                <th width="25%">Address 2</th>
                                                <td width="25%" colspan="3" height="80px;" class="father_address_2"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card" id="mother_info" style="display:none">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <h4 class="navv">Mother Details</h4>
                                </li>
                            </ul>
                            <div class="card-body">
                                <div class="table-responsive mt-md mb-md">
                                    <table class="table table-striped table-bordered table-condensed mb-none">
                                        <tbody>
                                            <tr>
                                                <th width="25%">Name</th>
                                                <td width="25%" class="mother_name"></td>
                                                <th width="25%">Date of Birth</th>
                                                <td width="25%" class="mother_date_of_birth"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">Passport</th>
                                                <td width="25%" class="mother_passport"></td>
                                                <th width="25%">NRIC Number</th>
                                                <td width="25%" class="mother_nric"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">Email</th>
                                                <td width="25%" class="mother_email"></td>
                                                <th width="25%">Mobile No</th>
                                                <td width="25%" class="mother_mobile_no"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">Blood Group</th>
                                                <td width="25%" class="mother_blood_group"></td>
                                                <th width="25%">Education</th>
                                                <td width="25%" class="mother_education"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">Occupation</th>
                                                <td width="25%" class="mother_occupation"></td>
                                                <th width="25%">Income</th>
                                                <td width="25%" class="mother_income"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">Country</th>
                                                <td width="25%" class="mother_country"></td>
                                                <th width="25%">State/Province</th>
                                                <td width="25%"  class="mother_state"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">City</th>
                                                <td width="25%" class="mother_city"></td>
                                                <th width="25%">Zip/Postal Code</th>
                                                <td width="25%" class="mother_postal_code"></td>
                                            </tr>
                                            <tr class="quick-address">
                                                <th width="25%">Address 1</th>
                                                <td width="25%" class="mother_address"></td>
                                                <th width="25%">Address 2</th>
                                                <td width="25%" colspan="3" height="80px;" class="mother_address_2"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card" id="guardian_info" style="display:none">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <h4 class="navv">Guardian Details ({{$student['relation']}})</h4>
                                </li>
                            </ul>
                            <div class="card-body">
                                <div class="table-responsive mt-md mb-md">
                                    <table class="table table-striped table-bordered table-condensed mb-none">
                                        <tbody>
                                            <tr>
                                                <th width="25%">Name</th>
                                                <td width="25%" class="guardian_name"></td>
                                                <th width="25%">Date of Birth</th>
                                                <td width="25%" class="guardian_date_of_birth"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">Passport</th>
                                                <td width="25%" class="guardian_passport"></td>
                                                <th width="25%">NRIC Number</th>
                                                <td width="25%" class="guardian_nric"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">Email</th>
                                                <td width="25%" class="guardian_email"></td>
                                                <th width="25%">Mobile No</th>
                                                <td width="25%" class="guardian_mobile_no"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">Blood Group</th>
                                                <td width="25%" class="guardian_blood_group"></td>
                                                <th width="25%">Education</th>
                                                <td width="25%" class="guardian_education"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">Occupation</th>
                                                <td width="25%" class="guardian_occupation"></td>
                                                <th width="25%">Income</th>
                                                <td width="25%" class="guardian_income"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">Country</th>
                                                <td width="25%" class="guardian_country"></td>
                                                <th width="25%">State/Province</th>
                                                <td width="25%"  class="guardian_state"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">City</th>
                                                <td width="25%" class="guardian_city"></td>
                                                <th width="25%">Zip/Postal Code</th>
                                                <td width="25%" class="guardian_postal_code"></td>
                                            </tr>
                                            <tr class="quick-address">
                                                <th width="25%">Address 1</th>
                                                <td width="25%" class="guardian_address"></td>
                                                <th width="25%">Address 2</th>
                                                <td width="25%" colspan="3" height="80px;" class="guardian_address_2"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
</div> <!-- container -->
@endsection
@section('scripts')
<script>
    var parentImg = "{{ asset('users/images/') }}";
    var defaultImg = "{{ asset('images/users/default.jpg') }}";
    var parentName = "{{ config('constants.api.parent_name') }}";
    var parentDetails = "{{ config('constants.api.parent_details') }}";
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var vehicleByRoute = "{{ route('admin.vehicle_by_route') }}";
    var roomByHostel = "{{ route('admin.room_by_hostel') }}";
    var indexAdmission = "{{ route('admin.admission') }}";
</script>

<script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/pages/form-fileuploads.init.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/custom/student.js') }}"></script>
@endsection