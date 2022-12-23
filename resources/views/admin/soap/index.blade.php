@extends('layouts.admin-layout')
@section('title','SOAP')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    
       
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UI</a></li>
                        <li class="breadcrumb-item active">Tabs & Accordions</li>
                    </ol>
                </div>
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
                                <p class="col-md-12">Name :<span class="font-weight-semibold student_name"></span> </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <p class="col-md-12">Grade :<span class="font-weight-semibold student_class"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <p class="col-md-12">Class :<span class="font-weight-semibold student_section"></span></p>
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
                        <a href="#l1" data-toggle="tab"  aria-expanded="true" class="nav-link">
                            logs
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- start Dashboard -->
                    <div class="tab-pane show active" id="d1">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xl-3">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                                <i class="fe-bar-chart font-22 avatar-title text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="mt-1"><span data-plugin="counterup">58</span>%</h3>
                                                <p class="text-muted mb-1 text-truncate">Physical Status
                                                </p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-sm-6 col-xl-3">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                                <i class="fe-bar-chart-2 font-22 avatar-title text-success"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="text-dark mt-1"><span data-plugin="counterup">127</span>%</h3>
                                                <p class="text-muted mb-1 text-truncate">psychological
                                                    Status</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-sm-6 col-xl-3">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                                <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="text-dark mt-1"><span data-plugin="counterup">0.58</span>%</h3>
                                                <p class="text-muted mb-1 text-truncate">Normal</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-sm-6 col-xl-3">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                                <i class="fe-eye font-22 avatar-title text-warning"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="text-dark mt-1"><span data-plugin="counterup">78</span>%</h3>
                                                <p class="text-muted mb-1 text-truncate">Today's Visits
                                                </p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->

                        <div class="row">
                            <div class="col-xl-6 col-sm-6 col-md-6">
                                <div class="card-box color">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Edit
                                                Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Export
                                                Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mb-3">Old Records</h4>
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                            <thead class="thead-light">
                                                <tr>
                                                    <th>S.no</th>
                                                    <th colspan="2">Student Name</th>
                                                    <th>Email</th>
                                                    <th>Standard</th>
                                                    <th>Class</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($soap_student_list as $key=>$student)
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
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div> <!-- end col -->
                            <div class="col-xl-6 col-sm-6 col-md-6">
                                <div class="card-box color">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Edit
                                                Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Export
                                                Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mb-3">New Records</h4>
                                    <form id="studentFilter" autocomplete="off" method="post" action="{{ route('admin.student.list') }}" enctype="multipart/form-data">
                                        <div class="row">                          
                                            <div class="col-md-3">
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
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="section_id">Class</label>
                                                    <select id="section_id" class="form-control" name="section_id">
                                                        <option value="">Select Class</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
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
                                            <button class="btn btn-primary waves-effect waves-light" type="Save">
                                                Filter
                                            </button>
                                        </div>
                                    
                                    </form>
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                            <thead class="thead-light">
                                                <tr>
                                                    <th>S.no</th>
                                                    <th colspan="2">Student Name</th>
                                                    <th>Email</th>
                                                </tr>
                                            </thead>
                                            <tbody id="student_body">
                                            </tbody>
                                        </table>
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
                                        <div class="row">
                                            <div class="col-md-6 col-xl-3">
                                                <div class="widget-rounded-circle card-box">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                                                <i class="fe-bar-chart font-22 avatar-title text-primary" data-toggle="modal" data-target="#personalinfo"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="text-right">
                                                                <h3 class="mt-1"><span data-plugin="counterup">58</span>%
                                                                </h3>
                                                                <p class="text-muted mb-1 text-truncate">
                                                                    Academic Status</p>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end row-->
                                                </div> <!-- end widget-rounded-circle-->
                                            </div> <!-- end col-->

                                            <div class="col-md-6 col-xl-3">
                                                <div class="widget-rounded-circle card-box">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                                                <i class="fe-bar-chart-2 font-22 avatar-title text-success" data-toggle="modal" data-target="#personalinfo"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="text-right">
                                                                <h3 class="text-dark mt-1"><span data-plugin="counterup">127</span>%
                                                                </h3>
                                                                <p class="text-muted mb-1 text-truncate">
                                                                    Classroom Management Status</p>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end row-->
                                                </div> <!-- end widget-rounded-circle-->
                                            </div> <!-- end col-->

                                            <div class="col-md-6 col-xl-3">
                                                <div class="widget-rounded-circle card-box">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                                                <i class="fe-bar-chart-line- font-22 avatar-title text-info" data-toggle="modal" data-target="#personalinfo"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="text-right">
                                                                <h3 class="text-dark mt-1"><span data-plugin="counterup">0.58</span>%
                                                                </h3>
                                                                <p class="text-muted mb-1 text-truncate">
                                                                    Attendance Report</p>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end row-->
                                                </div> <!-- end widget-rounded-circle-->
                                            </div> <!-- end col-->

                                            <div class="col-md-6 col-xl-3">
                                                <div class="widget-rounded-circle card-box">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                                                <i class="fe-eye font-22 avatar-title text-warning" data-toggle="modal" data-target="#personalinfo"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="text-right">
                                                                <h3 class="text-dark mt-1"><span data-plugin="counterup">78</span>%
                                                                </h3>
                                                                <p class="text-muted mb-1 text-truncate">
                                                                    Homework Status</p>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end row-->
                                                </div> <!-- end widget-rounded-circle-->
                                            </div> <!-- end col-->
                                        </div>
                                        <!-- end row-->


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
                                                                        <input type="text" name="fname" class="form-control alloptions" maxlength="50" id="fname" placeholder="Ahmad Ali" aria-describedby="inputGroupPrepend">
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
                                                                    <select id="blooddgrp" name="blooddgrp" class="form-control">
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
                                                                        <input type="text" name="dob" class="form-control" id="dob" placeholder="DD-MM-YYYY" aria-describedby="inputGroupPrepend">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Passport">Passport
                                                                        Number</label>
                                                                    <input type="text" maxlength="50" id="passport" class="form-control alloptions" placeholder="Passport Number" name="txt_passport">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_nric">NRIC
                                                                        Number</label>
                                                                    <input type="text" maxlength="50" id="txt_nric" class="form-control alloptions" placeholder="Identifaction Number" name="txt_nric" data-parsley-trigger="change">
                                                                </div>
                                                            </div>
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
                                                                    <select class="form-control" name="txt_race" id="race">
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
                                                                    <input type="tel" class="form-control" name="txt_mobile_no" id="txt_mobile_no" placeholder="(XXX)-(XXX)-(XXXX)" data-parsley-trigger="change">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="drp_country">Country</label>
                                                                    <input type="text" maxlength="50" id="drp_country" class="form-control alloptions" placeholder="Country" name="drp_country" data-parsley-trigger="change">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="drp_state">State/Province</label>
                                                                    <input type="text" maxlength="50" id="drp_state" class="form-control alloptions" placeholder="State/Province" name="drp_state" data-parsley-trigger="change">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="drp_city">City</label>
                                                                    <input type="text" maxlength="50" id="drp_city" class="form-control alloptions" placeholder="City" name="drp_city" data-parsley-trigger="change">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="drp_post_code">Zip/Postal
                                                                        Code</label>
                                                                    <input type="text" maxlength="50" id="drp_post_code" class="form-control alloptions" placeholder="Zip/Postal_Code" name="drp_post_code" data-parsley-trigger="change">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txtarea_paddress">Address
                                                                        1</label>
                                                                    <input type="text" maxlength="255" id="txtarea_address" class="form-control alloptions" placeholder="Address 1" name="txtarea_paddress" data-parsley-trigger="change">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txtarea_permanent_address">Address
                                                                        2</label>
                                                                    <input type="text" maxlength="255" id="txtarea_permanent_address" class="form-control alloptions" placeholder="Address 2" name="txtarea_permanent_address" data-parsley-trigger="change">
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
                                                                    <select id="btwyears" class="form-control" name="year">
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
                                                                    <input type="text" id="txt_regiter_no" class="form-control" name="txt_regiter_no" placeholder="Registration Number" data-parsley-trigger="change">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_roll_no">Roll
                                                                        No<span class="text-danger">*</span></label>
                                                                    <input type="text" id="txt_roll_no" class="form-control" name="txt_roll_no" placeholder="Roll No" data-parsley-trigger="change">
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
                                                                        <input type="text" class="form-control" id="admission_date" name="admission_date" placeholder="DD-MM-YYYY" aria-describedby="inputGroupPrepend">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="std_class_id">Grade<span class="text-danger">*</span></label>
                                                                    <select id="std_class_id" class="form-control" name="std_class_id">
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
                                                                    <select id="std_section_id" class="form-control" name="std_section_id">
                                                                        <option value="">Select Class</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="categy">Category<span class="text-danger">*</span></label>
                                                                    <select id="categy" name="categy" class="form-control">
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
                                                                    <select id="std_session_id" class="form-control" name="std_session_id">
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
                                                                    <select id="std_semester_id" class="form-control" name="std_semester_id">
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
                                                                    <input type="text" class="form-control" id="father_name" placeholder="John Leo" aria-describedby="inputGroupPrepend">
                                                                    <input type="hidden" name="father_id" id="father_id">
                                                                    <div id="father_list">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="mother_name">Mother
                                                                        Name</label>
                                                                    <input type="text" class="form-control" id="mother_name" placeholder="Aisha Mal" aria-describedby="inputGroupPrepend">
                                                                    <input type="hidden" name="mother_id" id="mother_id">
                                                                    <div id="mother_list">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="guardian_name">Guardian
                                                                        Name</label>
                                                                    <input type="text" class="form-control" id="guardian_name" placeholder="Amir Shan" aria-describedby="inputGroupPrepend">
                                                                    <input type="hidden" name="guardian_id" id="guardian_id">
                                                                    <div id="guardian_list">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="relation">Guardian
                                                                        Relation</label>
                                                                    <select class="form-control" name="relation" id="relation">
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
                    <div class="tab-pane" id="l1">
                        <p>Vakal text here dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                            ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis
                            parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec,
                            pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                        <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                            arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam
                            dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus
                            elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula,
                            porttitor eu, consequat vitae, eleifend ac, enim.</p>
                    </div>

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
    var subCategoryList = "{{ config('constants.api.sub_category_list_by_category') }}";
    var notesList = "{{ config('constants.api.notes_list_by_sub_category') }}";
    var soapDelete = "{{ config('constants.api.soap_delete') }}";
    var soapSubjectDelete = "{{ route('admin.soap_subject.delete') }}";
    var studentDetails = "{{ config('constants.api.student_details') }}";
    var studentSoapList = "{{ config('constants.api.student_soap_list') }}";
    var url = "{{ URL::to('/') }}";
    var soapSubjectDetails = "{{ config('constants.api.soap_subject_details') }}";
    var soapStudentList = "{{ config('constants.api.soap_student_list') }}";
    var sectionByClassUrl = "{{ config('constants.api.section_by_class') }}";
    var academic_session_id = "{{ Session::get('academic_session_id') }}";
    var user_name = "{{ Session::get('name') }}";
    
</script>

<script src="{{ asset('public/js/custom/soap.js') }}"></script>
<script src="{{ asset('public/js/custom/soap_subject.js') }}"></script>

@endsection