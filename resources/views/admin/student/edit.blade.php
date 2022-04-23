@extends('layouts.admin-layout')
@section('title','Edit Student')
@section('content')
@section('css')
<style>
    .user-img {
        position: absolute;
        z-index: 1;
        padding: 5px;
        width: 100%;
        height: 100%;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        overflow: hidden;
        text-align: center;
    }
</style>
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
                                        <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="fas fa-users"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">{{$student['name']}}</a></h5>
                                            </div>
                                        </div>
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
                            <span class="header-title mb-3" id="span-parent" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Basic Details</span>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-lg-right mt-3 mt-lg-0">
                                    <button type="button" class="btn btn-white btn-rounded waves-effect waves-light mr-1"><i class="fas fa-lock mr-1"></i> Authentication</button>
                            </div>
                        </div><!-- end col-->
                    </div> <!-- end row -->								    
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <form id="editadmission" method="post" action="{{ route('admin.student.update') }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <input type="hidden" name="student_id" value="{{$student['id']}}">
                                <input type="hidden" name="parent_id" value="{{$student['parent_id']}}">
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
                                                <input type="text" class="form-control homeWorkAdd" id="admission_date" value="{{$student['admission_date']}}" name="admission_date" placeholder="" aria-describedby="inputGroupPrepend">
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
                                                <input type="text" name="fname" class="form-control" value="{{$student['first_name']}}" id="fname" placeholder="" aria-describedby="inputGroupPrepend">
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
                                                <input type="text" name="dob" class="form-control homeWorkAdd" value="{{$student['birthday']}}" id="dob" placeholder="" aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="">Mother Tongue</label>
                                            <input type="" id="txt_mothertongue" class="form-control" value="{{$student['mother_tongue']}}" name="txt_mothertongue" data-parsley-trigger="change">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Religion</label>
                                            <input type="txt_religion" id="" class="form-control" value="{{$student['religion']}}" name="txt_religion" data-parsley-trigger="change">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Caste</label>
                                            <input type="" id="txt_caste" class="form-control" value="{{$student['caste']}}" name="txt_caste" data-parsley-trigger="change">
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
                                                <input type="text" name="txt_mobile_no" class="form-control" value="{{$student['mobile_no']}}" id="txt_mobile_no" placeholder="" aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">City</label>
                                            <input type="" id="drp_city" class="form-control" name="drp_city" data-parsley-trigger="change" value="{{$student['city']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">State</label>
                                            <input type="" id="drp_state" class="form-control" name="drp_state" data-parsley-trigger="change" value="{{$student['state']}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txtarea_paddress">Present Address</label>
                                            <textarea id="txtarea_paddress" class="form-control" name="txtarea_paddress">{{$student['current_address']}}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txtarea_permanent_address">Permanent Address</label>
                                            <textarea id="txtarea_permanent_address" class="form-control" name="txtarea_permanent_address">{{$student['permanent_address']}}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="document">Photo</label>
                                            <div class="col-12">
                                                    <input type="file"  class="custom-file-input" name="photo">
                                                    <label class="custom-file-label" for="document">Choose file</label>
                                                    @if($student['photo'])
                                                    <a target="_blank"  href="{{asset('users/images/')}}/{{$student['photo']}}" alt="your Photo">Photo Preview</a>
                                                    @endif
                                                    <input type="hidden" name="old_photo" value="{{$student['photo']}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-12">
                                        
                                        <label for="pc">Profile Picture</label>
                                        <div class="card">
                                            <div class="card-body">
                                                <input type="file" data-plugins="dropify" data-height="300" name="photo" data-default-file="{{asset('users/images')}}/{{$student['photo']}}"/>
                                                <input type="hidden" name="old_photo" value="{{$student['photo']}}">
                                            </div> 
                                        </div> 
                                    </div> -->
                                </div>
                                <span class="fas fa-user-tie" id="span-parent"></span>
                                <span class="header-title mb-3" id="span-parent">Guardian Details
                                    <hr id="hr">
                                </span>
                                <!-- <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck11">
                                        <label class="custom-control-label" for="customCheck11">Skipped Bank Details</label>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="heard">Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="txt_name" id="txt_name" placeholder="" aria-describedby="inputGroupPrepend" value="{{$student['name']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="email">Email<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-envelope-open"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" id="txt_guardian_email" name="txt_guardian_email" placeholder="" aria-describedby="inputGroupPrepend" value="{{$student['parent_email']}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="heard">Relation<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="txt_relation" id="txt_relation" placeholder="" aria-describedby="inputGroupPrepend" value="{{$student['relation']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="heard">Father Name</label>
                                            <input type="text" class="form-control" name="txt_fathernam" id="txt_fathernam" placeholder="" aria-describedby="inputGroupPrepend" value="{{$student['father_name']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="heard">Mother Name</label>
                                            <input type="text" class="form-control" name="txt_mothernam" id="txt_mothernam" placeholder="" aria-describedby="inputGroupPrepend" value="{{$student['mother_name']}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Occupation<span class="text-danger">*</span></label>
                                            <input type="" id="txt_occupation" class="form-control" name="txt_occupation" data-parsley-trigger="change" value="{{$student['occupation']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Income</label>
                                            <input type="" id="txt_income" class="form-control" name="txt_income" data-parsley-trigger="change" value="{{$student['income']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Education</label>
                                            <input type="" id="txt_eduction" class="form-control" name="txt_eduction" data-parsley-trigger="change" value="{{$student['education']}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="validationCustomUsername">City</label>
                                            <input type="text" class="form-control" id="txt_guardian_city" name="txt_guardian_city" placeholder="" aria-describedby="inputGroupPrepend" value="{{$student['parent_city']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="validationCustomUsername">State</label>
                                            <input type="text" class="form-control" id="txt_guardian_state" name="txt_guardian_state" placeholder="" aria-describedby="inputGroupPrepend" value="{{$student['parent_state']}}">
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
                                                <input type="text" class="form-control" id="txt_guardian_mobileno" name="txt_guardian_mobileno" placeholder="" aria-describedby="inputGroupPrepend" value="{{$student['parent_mobile_no']}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message">Address</label>
                                    <textarea id="txt_guardian_address" class="form-control" name="txt_guardian_address" >{{$student['address']}}
                                    </textarea>
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
                                <span class="fas fa-holly-berry" id="span-parent"></span>
                                <span class="header-title mb-3" id="span-parent">Previous School Details
                                    <hr style="margin-top:-1%;margin-left:20%;color:blue">
                                </span>
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
                                </div>
                                <div class="form-group">
                                    <label for="message">Remarks</label>
                                    <textarea id="txtarea_prev_remarks" class="form-control" name="txtarea_prev_remarks">{{$student['remarks']}}
                                    </textarea>
                                </div>
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
                    </div>
                            
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div><!-- end row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <span class="header-title mb-3" id="span-parent" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">Parent Information</span>
                    <br><br>
                    <div class="collapse" id="collapseExample1">
                        <div class="">
                        <div class="table-responsive mt-md mb-md">
							<table class="table table-striped table-bordered table-condensed mb-none">
								<tbody>
									<tr>
										<th>Name</th>
										<td>{{$student['name']}}</td>
										<th>Relation</th>
										<td>{{$student['relation']}}</td>
									</tr>
									<tr>
										<th>Occupation</th>
										<td>{{$student['occupation']}}</td>
										<th>Income</th>
										<td>{{$student['income']}}</td>
									</tr>
									<tr>
										<th>Education</th>
										<td>{{$student['education']}}</td>
										<th>City</th>
										<td>{{$student['parent_city']}}</td>
									</tr>
									<tr>
										<th>State</th>
										<td>{{$student['parent_state']}}</td>
										<th>Mobile No</th>
										<td>{{$student['parent_mobile_no']}}</td>
									</tr>
									<tr>
										<th>Email</th>
										<td colspan="3">{{$student['parent_email']}}</td>
									</tr>
									<tr class="quick-address">
										<th>Address</th>
										<td colspan="3" height="80px;">{{$student['address']}}</td>
									</tr>
								</tbody>
							</table>
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
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var vehicleByRoute = "{{ route('admin.vehicle_by_route') }}";
    var roomByHostel = "{{ route('admin.room_by_hostel') }}";
    var indexAdmission = "{{ route('admin.admission') }}";
</script>
<script src="{{ asset('js/custom/student.js') }}"></script>
@endsection