@extends('layouts.admin-layout')
@section('title','SOAP')
@section('content')
<style>
    .navtab-bg .nav-link {
    background-color: #bec2c6;
    }
    .text-truncate {   
    font-size: 13px;
    }
</style>
<div class="container-fluid">

    <!-- start page title -->
    
       
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">SOAP</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">               
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <p class="col-md-12"><b>Name :<span class="font-weight-semibold student_name"></span></b> </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <p class="col-md-12"><b>Grade :<span class="font-weight-semibold student_class"></span></b></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <p class="col-md-12"><b>Class :<span class="font-weight-semibold student_section"></span></b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                                
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div id="tabs">
                <!-- <h4 class="header-title mb-4">SOAP</h4>-->

                <ul class="nav nav-pills navtab-bg nav-justified">
                    <li class="nav-item">
                        <a href="#d1" data-toggle="tab"  aria-expanded="false" class="nav-link active">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#pi1" data-toggle="tab"  data-tab="info" aria-expanded="true" class="nav-link ">
                            Personal Info
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#subjective" data-toggle="tab" data-soap-type-id="1" data-tab="subjective" aria-expanded="true" class="nav-link">
                            S-Subjective
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#objective" data-toggle="tab" data-soap-type-id="2" data-tab="objective" aria-expanded="true" class="nav-link">
                            O-Objective
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#assessment" data-toggle="tab" data-soap-type-id="3" data-tab="assessment" aria-expanded="true" class="nav-link">
                            A-Assessment
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#plan" data-toggle="tab" data-soap-type-id="4" data-tab="plan" aria-expanded="true" class="nav-link">
                            P-Plan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#log" data-toggle="tab"  aria-expanded="true" data-tab="log" class="nav-link">
                            logs
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- start Dashboard -->
                    <div class="tab-pane show active" id="d1">

                        <div class="row">
                            <div class="col-xl-6 col-sm-6 col-md-6">
                                <div class="card">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">Old Records<h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">
                                        <form id="oldStudentFilter" autocomplete="off" enctype="multipart/form-data">
                                            <div class="row">                          
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="old_class_id">Grade</label>
                                                        <select id="old_class_id" class="form-control" name="class_id">
                                                            <option value="">Select Grade</option>
                                                            @forelse ($class as $clas)
                                                                <option value="{{ $clas['id'] }}">{{ $clas['name'] }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="old_section_id">Class</label>
                                                        <select id="old_section_id" class="form-control" name="section_id">
                                                            <option value="">Select Class</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="old_session_id">Session</label>
                                                        <select id="old_session_id" class="form-control"  name="session_id">                              
                                                        <option value="">Select Session</option>
                                                            @foreach($session as $ses)
                                                                <option value="{{$ses['id']}}">{{$ses['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group text-right m-b-0">
                                                <button class="btn btn-primary-bl waves-effect waves-light" style="width:80px" type="Save">
                                                    Filter
                                                </button>
                                            </div>
                                        </form>
                                        <div class="table-responsive">
                                            <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                            <thead class="">
                                                    <tr>
                                                        <th>S.no</th>
                                                        <th colspan="2">Student Name</th>
                                                        <th>Email</th>
                                                        <th>Grade</th>
                                                        <th>Class</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="old_student_body">
                                                    @forelse($soap_student_list as $key=>$student)
                                                        <tr class="student-row">
                                                            @php $key++; @endphp
                                                            <td>
                                                                {{$key}}
                                                            </td>
                                                            <td style="width: 36px;">
                                                                <img src="{{ $student['photo'] && asset('public/users/images/'.$student['photo']) ? asset('public/users/images/'.$student['photo']) : asset('public/images/users/default.jpg') }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                                            </td>
                                                            <td class="stu-name">
                                                                <h5 class="m-0 font-weight-normal ">{{$student['name']}}</h5>
                                                            </td>
                                                            <input type="hidden" class="student" value="{{$student['id']}}">
                                                            <td>
                                                                {{$student['email']}}
                                                            </td>
                                                            <td class="stu-class">
                                                                {{$student['class_name']}}
                                                            </td>
                                                            <td class="stu-section">
                                                                {{$student['section_name']}}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr >
                                                            <td colspan="6" class="text-center">No Data Available</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-xl-6 col-sm-6 col-md-6">
                                <div class="card">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">New Records<h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">
                                        <form id="newStudentFilter" autocomplete="off" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="class_id">Grade</label>
                                                        <select id="class_id" class="form-control" name="class_id">
                                                            <option value="">Select Grade</option>
                                                            @forelse ($class as $clas)
                                                                <option value="{{ $clas['id'] }}">{{ $clas['name'] }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="section_id">Class</label>
                                                        <select id="section_id" class="form-control" name="section_id">
                                                            <option value="">Select Class</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="session_id">Session</label>
                                                        <select id="session_id" class="form-control"  name="session_id">                              
                                                        <option value="">Select Session</option>
                                                            @foreach($session as $ses)
                                                                <option value="{{$ses['id']}}">{{$ses['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group text-right m-b-0">
                                                <button class="btn btn-primary-bl waves-effect waves-light" style="width:80px" type="Save">
                                                    Filter
                                                </button>
                                            </div>
                                        
                                        </form>
                                        <div class="table-responsive">
                                            <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                                <thead class="">
                                                    <tr>
                                                        <th>S.no</th>
                                                        <th colspan="2">Student Name</th>
                                                        <th>Email</th>
                                                        <th>Grade</th>
                                                        <th>Class</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="new_student_body">
                                                    <tr >
                                                        <td colspan="6" class="text-center">No Data Available</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                    <!-- end Dashboard -->
                    <!-- Start personal tab-->
                    <div class="tab-pane" id="pi1">
                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <div class="">
                                        <!-- Start Personal Info Popup -->
                                        <div class="modal fade viewEvent" id="personalinfo" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="personalinfo" style="color: #6FC6CC"> <i class="fas fa-info-circle"></i> Academic
                                                            Details</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="card-box eventpopup" style="background-color: #8adfee14;">
                                                                    <div class="table-responsive">
                                                                        <table class="table mb-0">
                                                                            <style>
                                                                                .table td {
                                                                                    border-top: none;
                                                                                }
                                                                            </style>
                                                                            <tr>
                                                                                <td>Name</td>
                                                                                <td id="title"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Class</td>
                                                                                <td id="type"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Subject</td>
                                                                                <td id="start_date">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Grade</td>
                                                                                <td id="end_date"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Description</td>
                                                                                <td id="description">
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div> <!-- end card-box -->
                                                            </div> <!-- end col -->
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                        <!-- End Personal Info Popup -->




                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="card">
                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <h4 class="navv">Student Details<h4>
                                                        </li>
                                                    </ul>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <input type="hidden" name="student_id" id="student_id">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="">First Name<span class="text-danger">*</span></label>
                                                                    <div class="input-group input-group-merge">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <span class="fas fa-user-graduate"></span>
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" name="fname" class="form-control alloptions" maxlength="50" id="fname" placeholder="Ahmad Ali" aria-describedby="inputGroupPrepend" readonly>
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
                                                                        <input type="text" name="lname" class="form-control alloptions" maxlength="50" id="lname" placeholder="Muhammad Jaafar" aria-describedby="inputGroupPrepend" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="gender">Gender</label>
                                                                    <select id="gender" name="gender" class="form-control" disabled>
                                                                        <option value="">Select Gender
                                                                        </option>
                                                                        <option value="Male">Male
                                                                        </option>
                                                                        <option value="Female">Female
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="blooddgrp">Blood
                                                                        Group</label>
                                                                    <select id="blooddgrp" name="blooddgrp" class="form-control" disabled>
                                                                        <option value="">Pick Blood Type
                                                                        </option>
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
                                                                    <label for="dob">Date Of
                                                                        Birth</label>
                                                                    <div class="input-group input-group-merge">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <span class="fas fa-birthday-cake"></span>
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" name="dob" class="form-control" id="dob" placeholder="DD-MM-YYYY" aria-describedby="inputGroupPrepend" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Passport">Passport
                                                                        Number</label>
                                                                    <input type="text" maxlength="50" id="passport" class="form-control alloptions" placeholder="Passport Number" name="txt_passport" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_nric">NRIC
                                                                        Number</label>
                                                                    <input type="text" maxlength="50" id="txt_nric" class="form-control alloptions" placeholder="Identifaction Number" name="txt_nric" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_religion">Religion</label>
                                                                    <select class="form-control" name="txt_religion" id="religion" disabled>
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
                                                                    <select class="form-control" name="txt_race" id="race" disabled>
                                                                        <option value="">Choose Race</option>
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
                                                                    <label for="txt_mobile_no">Mobile
                                                                        No<span class="text-danger">*</span></label>
                                                                    <input type="tel" class="form-control" name="txt_mobile_no" id="txt_mobile_no" placeholder="(XXX)-(XXX)-(XXXX)" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="drp_country">Country</label>
                                                                    <input type="text" maxlength="50" id="drp_country" class="form-control alloptions" placeholder="Country" name="drp_country" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="drp_state">State/Province</label>
                                                                    <input type="text" maxlength="50" id="drp_state" class="form-control alloptions" placeholder="State/Province" name="drp_state" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="drp_city">City</label>
                                                                    <input type="text" maxlength="50" id="drp_city" class="form-control alloptions" placeholder="City" name="drp_city" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="drp_post_code">Zip/Postal
                                                                        Code</label>
                                                                    <input type="text" maxlength="50" id="drp_post_code" class="form-control alloptions" placeholder="Zip/Postal_Code" name="drp_post_code" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txtarea_paddress">Address
                                                                        1</label>
                                                                    <input type="text" maxlength="255" id="txtarea_address" class="form-control alloptions" placeholder="Address 1" name="txtarea_paddress" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txtarea_permanent_address">Address
                                                                        2</label>
                                                                    <input type="text" maxlength="255" id="txtarea_permanent_address" class="form-control alloptions" placeholder="Address 2" name="txtarea_permanent_address" data-parsley-trigger="change" readonly>
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
                                                                    <label for="btwyears">Academic
                                                                        Year<span class="text-danger">*</span></label>
                                                                    <select id="btwyears" class="form-control" name="year" disabled>
                                                                        <option value="">Choose Academic Year</option>
                                                                        @forelse($academic_year_list as $r)
                                                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                                                        @empty
                                                                        @endforelse

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_regiter_no">Register
                                                                        No<span class="text-danger">*</span></label>
                                                                    <input type="text" id="txt_regiter_no" class="form-control" name="txt_regiter_no" placeholder="Registration Number" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_roll_no">Roll
                                                                        No<span class="text-danger">*</span></label>
                                                                    <input type="text" id="txt_roll_no" class="form-control" name="txt_roll_no" placeholder="Roll No" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label for="text">Admission
                                                                        Date<span class="text-danger">*</span></label>
                                                                    <div class="input-group input-group-merge">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <span class="far fa-calendar-alt"></span>
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" class="form-control" id="admission_date" name="admission_date" placeholder="DD-MM-YYYY" aria-describedby="inputGroupPrepend" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="std_class_id">Grade<span class="text-danger">*</span></label>
                                                                    <select id="std_class_id" class="form-control" name="std_class_id" disabled>
                                                                        <option value="">Select Grade</option>
                                                                        @foreach($class as $cla)
                                                                        <option value="{{$cla['id']}}">{{$cla['name']}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="std_section_id">Class
                                                                        Name<span class="text-danger">*</span></label>
                                                                    <select id="std_section_id" class="form-control" name="std_section_id" disabled>
                                                                        <option value="">Select Class</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="categy">Category<span class="text-danger">*</span></label>
                                                                    <select id="categy" name="categy" class="form-control" disabled>
                                                                        <option value="">Choose the
                                                                            Category</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="std_session_id">Session</label>
                                                                    <select id="std_session_id" class="form-control" name="std_session_id" disabled>
                                                                        <option value="0">Select Session</option>
                                                                        @foreach($session as $ses)
                                                                        <option value="{{$ses['id']}}">{{$ses['name']}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="std_semester_id">Semester</label>
                                                                    <select id="std_semester_id" class="form-control" name="std_semester_id" disabled>
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
                                                            <h4 class="navv">Parent/Guardian Details<h4>
                                                        </li>
                                                    </ul>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="father_name">Father
                                                                        Name</label>
                                                                    <input type="text" class="form-control" id="father_name" placeholder="John Leo" aria-describedby="inputGroupPrepend" readonly>
                                                                    <input type="hidden" name="father_id" id="father_id">
                                                                    <div id="father_list">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="mother_name">Mother
                                                                        Name</label>
                                                                    <input type="text" class="form-control" id="mother_name" placeholder="Aisha Mal" aria-describedby="inputGroupPrepend" readonly>
                                                                    <input type="hidden" name="mother_id" id="mother_id">
                                                                    <div id="mother_list">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="guardian_name">Guardian
                                                                        Name</label>
                                                                    <input type="text" class="form-control" id="guardian_name" placeholder="Amir Shan" aria-describedby="inputGroupPrepend" readonly>
                                                                    <input type="hidden" name="guardian_id" id="guardian_id">
                                                                    <div id="guardian_list">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="relation">Guardian
                                                                        Relation</label>
                                                                    <select class="form-control" name="relation" id="relation" disabled>
                                                                        <option value="">Choose Relation</option>
                                                                        @forelse($relation as $r)
                                                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                                                        @empty
                                                                        @endforelse

                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>


                                            </div> <!-- end col -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End personal info tab-->    
                    @include('admin.soap.subjective')
                    @include('admin.soap.objective')
                    @include('admin.soap.assessment')
                    @include('admin.soap.plan')
                    @include('admin.soap.log')

                    <!--End tab-->
                    <!--start popup-->

                    <!--Title popup-->
                    <div id="sstt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Title Details</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body p-4" id="modal-body">
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal -->
                    <!--End Title popup-->
                    <!--sub Title popup-->
                    <div id="notes-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Family Details</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <input type="hidden" id="notes-category-id">
                                <input type="hidden" id="notes-sub-category-id">
                                <div class="modal-body p-4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Family Details</th>
                                                </tr>
                                            </thead>

                                            <tbody id="notes-body">

                                            </tbody>
                                        </table>
                                    </div> <!-- end .table-responsive-->

                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal -->
                    <!--sub Title popup end-->

                    <!--delete popup /.modal -->
                    <div id="delete-notes" class="modal fade">
                        <div class="modal-dialog modal-confirm">
                            <div class="modal-content">
                                <div class="modal-header flex-column">
                                    <h4 class="modal-title w-100">Are you sure?</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p>Do you really want to delete these record? This process cannot
                                        be undone.</p>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger" id="remove_notes">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--delete popup end /.modal -->



                </div> <!-- container -->

            </div> <!-- content -->
        </div>

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        2015 -
                        <script>
                            document.write(new Date().getFullYear())
                        </script> &copy; UBold theme by
                        <a href="">Coderthemes</a>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="javascript:void(0);">About Us</a>
                            <a href="javascript:void(0);">Help</a>
                            <a href="javascript:void(0);">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->



        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">


        </div> <!-- end slimscroll-menu-->
    </div>
    <div class="rightbar-overlay"></div>
</div>
@endsection
@section('scripts')

<script>
    //soapCategory routes
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var imageUrl = "{{ asset('public/soap/images/') }}";
    var userImageUrl = "{{ asset('public/user/images/') }}";
    var subCategoryList = "{{ config('constants.api.sub_category_list_by_category') }}";
    var notesList = "{{ config('constants.api.notes_list_by_sub_category') }}";
    var soapDelete = "{{ config('constants.api.soap_delete') }}";
    var soapSubjectDelete = "{{ route('admin.soap_subject.delete') }}";
    var studentDetails = "{{ config('constants.api.student_details') }}";
    var studentSoapList = "{{ config('constants.api.student_soap_list') }}";
    var url = "{{ URL::to('/') }}";
    var soapSubjectDetails = "{{ config('constants.api.soap_subject_details') }}";
    var soapNewStudentList = "{{ config('constants.api.soap_student_list') }}";
    var soapOldStudentList = "{{ config('constants.api.old_soap_student_list') }}";
    var sectionByClassUrl = "{{ config('constants.api.section_by_class') }}";
    var academic_session_id = "{{ Session::get('academic_session_id') }}";
    var user_name = "{{ Session::get('name') }}";
    var user_id = "{{ Session::get('ref_user_id') }}";
    var soapLogList = "{{ route('admin.soap_log.list') }}";
    var defaultImg = "{{ asset('public/images/users/default.jpg') }}";
    var soapStudentIDUrl = "{{ route('admin.settings.soap_student_id') }}";
    
</script>

<script src="{{ asset('public/js/custom/soap.js') }}"></script>
<script src="{{ asset('public/js/custom/soap_subject.js') }}"></script>

@endsection