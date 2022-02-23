@extends('layouts.admin-layout')
@section('title','Class Room Management')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">Classroom Management</h4>
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
                            <span data-feather="file-text" class="icon-dual" id="span-parent"></span> Classroom
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="heard">Class name<span class="text-danger">*</span></label>
                                <select id="heard" class="form-control" required="">
                                    <option value="">I</option>
                                    <option value="press">II</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="heard">Subject<span class="text-danger">*</span></label>
                                <select id="heard" class="form-control" required="">
                                    <option value="">English</option>
                                    <option value="press">Maths</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="heard">Date<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="<?php echo date('d-m-Y'); ?>" name="class_date" id="classDate" require="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="heard">Count Down<span class="text-danger">*</span></label>
                                <input type="text" id="basic-timepicker" class="form-control btn dropdown-toggle btn-light" placeholder="01:00:00" disabled>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card"><br>
                <div class="row">

                    <div class="col-lg-3" id="top-header">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-6">
                                    <div class="">
                                        <p class="text-muted mb-1">Present</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h3 class="my-1" style="color:blue"><span data-plugin="counterup">5</span></h3>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="">
                                        <p class="text-muted mb-1">Absent</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h3 class="my-1" style="color:blue"><span data-plugin="counterup">1</span></h3>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="">
                                        <p class="text-muted mb-1">Late</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h3 class="my-1" style="color:blue"><span data-plugin="counterup">3</span></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="progress progress-sm m-0">
                                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    </div>
                                </div>
                                <h6 class="text-uppercase"><span class="text-muted float-right">Total Strength</span></h6>
                            </div>

                        </div>
                    </div><!-- end col-->
                    <div class="col-lg-3" id="top-header">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-6">
                                    <div class="">
                                        <i class="fas fa-user-graduate font-24"></i><br><br>
                                        <p class="text-muted mb-1">Perfect attendance</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h3 class="my-1" style="color:blue"><span data-plugin="counterup">10</span></h3>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="progress progress-sm m-0">
                                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    </div>
                                </div>
                                <h6 class="text-uppercase"><span class="text-muted float-right">48% of class</span></h6>
                            </div>

                        </div>
                    </div><!-- end col-->
                    <div class="col-lg-3" id="top-header">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-6">
                                    <div class="">
                                        <i class="  fas fa-user-tie  font-24"></i><br><br>
                                        <p class="text-muted mb-1">Average Attendance</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h3 class="my-1" style="color:blue"><span data-plugin="counterup">0</span></h3>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="progress progress-sm m-0">
                                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    </div>
                                </div>
                                <h6 class="text-uppercase"><span class="text-muted float-right">72% of class</span></h6>
                            </div>

                        </div>
                    </div><!-- end col-->
                    <div class="col-lg-3">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-6">
                                    <div class="">
                                        <i class="fas fa-chalkboard-teacher font-24"></i><br><br>
                                        <p class="text-muted mb-1">Below Attendance</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h3 class="my-1" style="color:blue"><span data-plugin="counterup">1</span></h3>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="progress progress-sm m-0">
                                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    </div>
                                </div>
                                <h6 class="text-uppercase"><span class="text-muted float-right">29% of class</span></h6>
                            </div>
                        </div> <!-- end card-box-->
                    </div>
                </div>
            </div><!-- end col-->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                            <li class="nav-item">
                                <h4 class="nav-link">
                                    <span data-feather="file-text" class="icon-dual" id="span-parent"></span> Classroom details
                                    <h4>
                            </li>
                        </ul><br>
                        <ul class="nav nav-tabs nav-bordered">
                            <li class="nav-item">
                                <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                    Layout Mode
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                    List Mode
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#shortest" data-toggle="tab" aria-expanded="false" class="nav-link">
                                    Short Test
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#rp" data-toggle="tab" aria-expanded="false" class="nav-link">
                                    Daily Report
                                </a>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="profile-b1">
                                    <div class="row">
                                        <div class="col-md-9"></div>
                                        <div class="col-md-3">
                                            <a href="javascript: void(0);" class="text-reset mb-2 d-block">
                                                <i class='fas fa-circle' style='font-size:14px;color:#60a05b'></i>
                                                <span class="mb-0 mt-1" style="text-align:center">Present</span>
                                                <i class='fas fa-circle' style='font-size:14px;color:#358fde'></i>
                                                <span class="mb-0 mt-1">Late</span>
                                                <i class='fas fa-circle' style='font-size:14px;color:#de354f'></i>
                                                <span class="mb-0 mt-1">Absent</span>
                                            </a>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-header" style="background-color:#60a05b;color:white;text-align:left">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle" height="40" />
                                                            <label style="text-align:center">William</label>
                                                        </div>
                                                    </div> <!-- end card-box-->
                                                </div> <!-- end col -->
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-header" style="background-color:#de354f;color:white;text-align:left">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle" height="40" />
                                                            <label style="text-align:center">James</label>
                                                        </div>
                                                    </div> <!-- end card-box-->
                                                </div> <!-- end col -->
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-header" style="background-color:#60a05b;color:white;text-align:left">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle" height="40" />
                                                            <label style="text-align:center">Benjamin</label>
                                                        </div>
                                                    </div> <!-- end card-box-->
                                                </div> <!-- end col -->
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-header" style="background-color:#60a05b;color:white;text-align:left">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle" height="40" />
                                                            <label style="text-align:center">Lucas</label>
                                                        </div>
                                                    </div> <!-- end card-box-->
                                                </div> <!-- end col -->
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-header" style="background-color:#60a05b;color:white;text-align:left">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle" height="40" />
                                                            <label style="text-align:center">Charlotte</label>
                                                        </div>
                                                    </div> <!-- end card-box-->
                                                </div> <!-- end col -->
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-header" style="background-color:#358fde;color:white;text-align:left">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle" height="40" />
                                                            <label style="text-align:center">Sophia</label>
                                                        </div>
                                                    </div> <!-- end card-box-->
                                                </div> <!-- end col -->
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-header" style="background-color:#60a05b;color:white;text-align:left">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle" height="40" />
                                                            <label style="text-align:center">Amelia</label>
                                                        </div>
                                                    </div> <!-- end card-box-->
                                                </div> <!-- end col -->
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-header" style="background-color:#358fde;color:white;text-align:left">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle" height="40" />
                                                            <label style="text-align:center">Isabella</label>
                                                        </div>
                                                    </div> <!-- end card-box-->
                                                </div> <!-- end col -->
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-header" style="background-color:#358fde;color:white;text-align:left">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle" height="40" />
                                                            <label style="text-align:center">Mia</label>
                                                        </div>
                                                    </div> <!-- end card-box-->
                                                </div> <!-- end col -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <style>
                                    #aa:hover {
                                        text-decoration: underline;
                                    }
                                </style>
                                <div class="tab-pane" id="home-b1">
                                    <div class="col-md-12">
                                        <table data-toggle="table" data-page-size="7" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable ">
                                            <thead>
                                                <tr>
                                                    <th data-field="state" data-checkbox="true"></th>
                                                    <th data-field="id" data-switchable="false">Student Name
                                                    </th>
                                                    <th data-field="name">Attentance</th>
                                                    <th data-field="Remarks">Remarks</th>
                                                    <th data-field="Reasons">Reasons</th>
                                                    <th data-field="amount">Rating</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> </td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">William</a>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="dropdown-toggle" id="aa" style="color:blue" data-toggle="dropdown" aria-expanded="false">
                                                                Mark</a>
                                                            <div class="dropdown-menu dropdown-menu-center">
                                                                <a class="dropdown-item" href="#">Present</a>
                                                                <a class="dropdown-item" href="#">Late</a>
                                                                <a class="dropdown-item" href="#">Absent</a>
                                                                <a class="dropdown-item" href="#">Excused</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-info waves-effect waves-light" data-toggle="modal" data-target="#centermodal">Add Remarks</button>
                                                    </td>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="heard"></label>
                                                            <select id="heard" class="form-control" required="">
                                                                <option value="">Choose</option>
                                                                <option value="press">Fever</option>
                                                                <option value="">Bus Breakdown</option>
                                                                <option value="press">Book Missing</option>
                                                                <option value="">Others</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-warning mb-2 font-13">
                                                            <i class="far fa-star" style='font-size:20px;color:green'></i>
                                                            <i class="far fa-star text-danger" style='font-size:20px;'></i>
                                                            <i class="far fa-heart" style='font-size:20px;'></i>
                                                            <i class='far fa-grin' style='font-size:20px;color:golden'></i>
                                                            <i class='far fa-angry' style='font-size:20px;color:red'></i>
                                                            <i class=' far fa-thumbs-up' style='font-size:20px;color:blue'></i>
                                                            <i class='far fa-thumbs-down' style='font-size:20px;color:red'></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">James</a>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="dropdown-toggle" id="aa" style="color:blue" data-toggle="dropdown" aria-expanded="false">
                                                                Late</a>
                                                            <div class="dropdown-menu dropdown-menu-center">
                                                                <a class="dropdown-item" href="#">Present</a>
                                                                <a class="dropdown-item" href="#">Late</a>
                                                                <a class="dropdown-item" href="#">Absent</a>
                                                                <a class="dropdown-item" href="#">Excused</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-info waves-effect waves-light" data-toggle="modal" data-target="#centermodal">Add Remarks</button>
                                                    </td>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="heard"></label>
                                                            <select id="heard" class="form-control" required="">
                                                                <option value="">Choose</option>
                                                                <option value="press">Fever</option>
                                                                <option value="">Bus Breakdown</option>
                                                                <option value="press">Book Missing</option>
                                                                <option value="">Others</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-warning mb-2 font-13">
                                                            <i class="far fa-star" style='font-size:20px;color:green'></i>
                                                            <i class="far fa-star text-danger" style='font-size:20px;'></i>
                                                            <i class="far fa-heart" style='font-size:20px;'></i>
                                                            <i class='far fa-grin' style='font-size:20px;color:golden'></i>
                                                            <i class='far fa-angry' style='font-size:20px;color:red'></i>
                                                            <i class=' far fa-thumbs-up' style='font-size:20px;color:blue'></i>
                                                            <i class='far fa-thumbs-down' style='font-size:20px;color:red'></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">Benjamin</a>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="dropdown-toggle" id="aa" style="color:blue" data-toggle="dropdown" aria-expanded="false">
                                                                Mark</a>
                                                            <div class="dropdown-menu dropdown-menu-center">
                                                                <a class="dropdown-item" href="#">Present</a>
                                                                <a class="dropdown-item" href="#">Late</a>
                                                                <a class="dropdown-item" href="#">Absent</a>
                                                                <a class="dropdown-item" href="#">Excused</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-info waves-effect waves-light" data-toggle="modal" data-target="#centermodal">Add Remarks</button>
                                                    </td>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="heard"></label>
                                                            <select id="heard" class="form-control" required="">
                                                                <option value="">Choose</option>
                                                                <option value="press">Fever</option>
                                                                <option value="">Bus Breakdown</option>
                                                                <option value="press">Book Missing</option>
                                                                <option value="">Others</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-warning mb-2 font-13">
                                                            <i class="far fa-star" style='font-size:20px;color:green'></i>
                                                            <i class="far fa-star text-danger" style='font-size:20px;'></i>
                                                            <i class="far fa-heart" style='font-size:20px;'></i>
                                                            <i class='far fa-grin' style='font-size:20px;color:golden'></i>
                                                            <i class='far fa-angry' style='font-size:20px;color:red'></i>
                                                            <i class=' far fa-thumbs-up' style='font-size:20px;color:blue'></i>
                                                            <i class='far fa-thumbs-down' style='font-size:20px;color:red'></i>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">Lucas</a>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="dropdown-toggle" id="aa" style="color:blue" data-toggle="dropdown" aria-expanded="false">
                                                                Mark</a>
                                                            <div class="dropdown-menu dropdown-menu-center">
                                                                <a class="dropdown-item" href="#">Present</a>
                                                                <a class="dropdown-item" href="#">Late</a>
                                                                <a class="dropdown-item" href="#">Absent</a>
                                                                <a class="dropdown-item" href="#">Excused</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-info waves-effect waves-light" data-toggle="modal" data-target="#centermodal">Add Remarks</button>
                                                    </td>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="heard"></label>
                                                            <select id="heard" class="form-control" required="">
                                                                <option value="">Choose</option>
                                                                <option value="press">Fever</option>
                                                                <option value="">Bus Breakdown</option>
                                                                <option value="press">Book Missing</option>
                                                                <option value="">Others</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-warning mb-2 font-13">
                                                            <i class="far fa-star" style='font-size:20px;color:green'></i>
                                                            <i class="far fa-star text-danger" style='font-size:20px;'></i>
                                                            <i class="far fa-heart" style='font-size:20px;'></i>
                                                            <i class='far fa-grin' style='font-size:20px;color:golden'></i>
                                                            <i class='far fa-angry' style='font-size:20px;color:red'></i>
                                                            <i class=' far fa-thumbs-up' style='font-size:20px;color:blue'></i>
                                                            <i class='far fa-thumbs-down' style='font-size:20px;color:red'></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">Charlotte</a>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="dropdown-toggle" id="aa" style="color:blue" data-toggle="dropdown" aria-expanded="false">
                                                                Mark</a>
                                                            <div class="dropdown-menu dropdown-menu-center">
                                                                <a class="dropdown-item" href="#">Present</a>
                                                                <a class="dropdown-item" href="#">Late</a>
                                                                <a class="dropdown-item" href="#">Absent</a>
                                                                <a class="dropdown-item" href="#">Excused</a>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <button type="button" class="btn btn-outline-info waves-effect waves-light" data-toggle="modal" data-target="#centermodal">Add Remarks</button>
                                                    </td>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="heard"></label>
                                                            <select id="heard" class="form-control" required="">
                                                                <option value="">Choose</option>
                                                                <option value="press">Fever</option>
                                                                <option value="">Bus Breakdown</option>
                                                                <option value="press">Book Missing</option>
                                                                <option value="">Others</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-warning mb-2 font-13">
                                                            <i class="far fa-star" style='font-size:20px;color:green'></i>
                                                            <i class="far fa-star text-danger" style='font-size:20px;'></i>
                                                            <i class="far fa-heart" style='font-size:20px;'></i>
                                                            <i class='far fa-grin' style='font-size:20px;color:golden'></i>
                                                            <i class='far fa-angry' style='font-size:20px;color:red'></i>
                                                            <i class=' far fa-thumbs-up' style='font-size:20px;color:blue'></i>
                                                            <i class='far fa-thumbs-down' style='font-size:20px;color:red'></i>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">Sophia</a>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="dropdown-toggle" id="aa" style="color:blue" data-toggle="dropdown" aria-expanded="false">
                                                                Absent</a>
                                                            <div class="dropdown-menu dropdown-menu-center">
                                                                <a class="dropdown-item" href="#">Present</a>
                                                                <a class="dropdown-item" href="#">Late</a>
                                                                <a class="dropdown-item" href="#">Absent</a>
                                                                <a class="dropdown-item" href="#">Excused</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-info waves-effect waves-light" data-toggle="modal" data-target="#centermodal">Add Remarks</button>
                                                    </td>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="heard"></label>
                                                            <select id="heard" class="form-control" required="">
                                                                <option value="">Choose</option>
                                                                <option value="press">Fever</option>
                                                                <option value="">Bus Breakdown</option>
                                                                <option value="press">Book Missing</option>
                                                                <option value="">Others</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-warning mb-2 font-13">
                                                            <i class="far fa-star" style='font-size:20px;color:green'></i>
                                                            <i class="far fa-star text-danger" style='font-size:20px;'></i>
                                                            <i class="far fa-heart" style='font-size:20px;'></i>
                                                            <i class='far fa-grin' style='font-size:20px;color:golden'></i>
                                                            <i class='far fa-angry' style='font-size:20px;color:red'></i>
                                                            <i class=' far fa-thumbs-up' style='font-size:20px;color:blue'></i>
                                                            <i class='far fa-thumbs-down' style='font-size:20px;color:red'></i>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">Amelia</a>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="dropdown-toggle" id="aa" style="color:blue" data-toggle="dropdown" aria-expanded="false">
                                                                Mark</a>
                                                            <div class="dropdown-menu dropdown-menu-center">
                                                                <a class="dropdown-item" href="#">Present</a>
                                                                <a class="dropdown-item" href="#">Late</a>
                                                                <a class="dropdown-item" href="#">Absent</a>
                                                                <a class="dropdown-item" href="#">Excused</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-info waves-effect waves-light" data-toggle="modal" data-target="#centermodal">Add Remarks</button>
                                                    </td>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="heard"></label>
                                                            <select id="heard" class="form-control" required="">
                                                                <option value="">Choose</option>
                                                                <option value="press">Fever</option>
                                                                <option value="">Bus Breakdown</option>
                                                                <option value="press">Book Missing</option>
                                                                <option value="">Others</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-warning mb-2 font-13">
                                                            <i class="far fa-star" style='font-size:20px;color:green'></i>
                                                            <i class="far fa-star text-danger" style='font-size:20px;'></i>
                                                            <i class="far fa-heart" style='font-size:20px;'></i>
                                                            <i class='far fa-grin' style='font-size:20px;color:golden'></i>
                                                            <i class='far fa-angry' style='font-size:20px;color:red'></i>
                                                            <i class=' far fa-thumbs-up' style='font-size:20px;color:blue'></i>
                                                            <i class='far fa-thumbs-down' style='font-size:20px;color:red'></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">Isabella</a>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="dropdown-toggle" id="aa" style="color:blue" data-toggle="dropdown" aria-expanded="false">
                                                                Late</a>
                                                            <div class="dropdown-menu dropdown-menu-center">
                                                                <a class="dropdown-item" href="#">Present</a>
                                                                <a class="dropdown-item" href="#">Late</a>
                                                                <a class="dropdown-item" href="#">Absent</a>
                                                                <a class="dropdown-item" href="#">Excused</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-info waves-effect waves-light" data-toggle="modal" data-target="#centermodal">Add Remarks</button>
                                                    </td>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="heard"></label>
                                                            <select id="heard" class="form-control" required="">
                                                                <option value="">Choose</option>
                                                                <option value="press">Fever</option>
                                                                <option value="">Bus Breakdown</option>
                                                                <option value="press">Book Missing</option>
                                                                <option value="">Others</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-warning mb-2 font-13">
                                                            <i class="far fa-star" style='font-size:20px;color:green'></i>
                                                            <i class="far fa-star text-danger" style='font-size:20px;'></i>
                                                            <i class="far fa-heart" style='font-size:20px;'></i>
                                                            <i class='far fa-grin' style='font-size:20px;color:golden'></i>
                                                            <i class='far fa-angry' style='font-size:20px;color:red'></i>
                                                            <i class=' far fa-thumbs-up' style='font-size:20px;color:blue'></i>
                                                            <i class='far fa-thumbs-down' style='font-size:20px;color:red'></i>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">Mia</a>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="dropdown-toggle" id="aa" style="color:blue" data-toggle="dropdown" aria-expanded="false">
                                                                Late</a>
                                                            <div class="dropdown-menu dropdown-menu-center">
                                                                <a class="dropdown-item" href="#">Present</a>
                                                                <a class="dropdown-item" href="#">Late</a>
                                                                <a class="dropdown-item" href="#">Absent</a>
                                                                <a class="dropdown-item" href="#">Excused</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-info waves-effect waves-light" data-toggle="modal" data-target="#centermodal">Add Remarks</button>
                                                    </td>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="heard"></label>
                                                            <select id="heard" class="form-control" required="">
                                                                <option value="">Choose</option>
                                                                <option value="press">Fever</option>
                                                                <option value="">Bus Breakdown</option>
                                                                <option value="press">Book Missing</option>
                                                                <option value="">Others</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-warning mb-2 font-13">
                                                            <i class="far fa-star" style='font-size:20px;color:green'></i>
                                                            <i class="far fa-star text-danger" style='font-size:20px;'></i>
                                                            <i class="far fa-heart" style='font-size:20px;'></i>
                                                            <i class='far fa-grin' style='font-size:20px;color:golden'></i>
                                                            <i class='far fa-angry' style='font-size:20px;color:red'></i>
                                                            <i class=' far fa-thumbs-up' style='font-size:20px;color:blue'></i>
                                                            <i class='far fa-thumbs-down' style='font-size:20px;color:red'></i>
                                                        </div>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div> <!-- end card-box-->
                                </div> <!-- end col-->

                                <div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <label for="heard">Remarks</label>
                                                <textarea class="form-control" id="product-description" rows="5" placeholder="Please enter description"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <div class="tab-pane" id="rp">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="heard">Report<span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="product-description" rows="5" placeholder="Please enter description"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="heard">Last Updated: 29-01-2022 12:00:00 AM</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div> <!-- end col-->
                                    <div class="form-group text-right m-b-0">
                                        <button class="btn btn-primary-bl waves-effect waves-light" id="branch-filter" type="button">
                                            Save
                                        </button>
                                    </div>
                                    <div class="col-md-12">
                                        <table data-toggle="table" data-page-size="7" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable ">
                                            <thead>
                                                <tr>
                                                    <th>S.no</th>
                                                    <th data-field="id" data-switchable="false">Student Name
                                                    </th>
                                                    <th data-field="name">Student Remarks</th>
                                                    <th data-field="Remarks">Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">Lucas</a>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="heard">English Stories</label>
                                                        </div>
                                                    </td>
                                                    <td> <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td class="table-user">
                                                        <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                        <a href="javascript:void(0);" class="text-body font-weight-semibold">Mia</a>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="heard">Articals</label>
                                                        </div>
                                                    </td>
                                                    <td> <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- end card-box-->

                                </div>

                                <div class="tab-pane" id="shortest">

                                    <div class="card">
                                        <div class="card-body">
                                            <form action="" method="post">
                                                <div id="dynamic-field-1" class="form-group dynamic-field">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="field" class="font-weight-bold">Short Test<span class="text-danger">*</span></label>
                                                            <input type="text" id="field" class="form-control" name="field[]" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="field" class="font-weight-bold">Status<span class="text-danger">*</span></label>
                                                            <select id="heard" class="form-control" required="">
                                                                <option value="press">Marks</option>
                                                                <option value="">Grade</option>
                                                                <option value="press">Text</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <div>
                                                        <button type="button" id="add-button" class="btn btn-secondary text-uppercase shadow-sm">
                                                            <i class="fas fa-plus fa-fw"></i> Add</button>
                                                        <button type="button" id="remove-button" class="btn btn-secondary text-uppercase ml-1" disabled="disabled">
                                                            <i class="fas fa-minus fa-fw"></i> Remove</button>
                                                        <button type="submit" class="btn btn-primary-bl waves-effect waves-light">Save</button>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table data-toggle="table" data-page-size="10" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable ">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">S.no</th>
                                                        <th class="text-center" data-field="id" data-switchable="false">Short Test Name
                                                        </th>
                                                        <th class="text-center" data-field="name">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">1</td>
                                                        <td class="table-user text-left">
                                                            <label for="heard">Skill</label>
                                                        </td>
                                                        <td>
                                                            <div class="table-user text-left">
                                                                <label for="heard">Grade</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td class="table-user">
                                                            <label for="heard">Grammer</label>
                                                        </td>
                                                        <td>
                                                            <div class="form-group text-left">
                                                                <label for="heard">Mark</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td class="table-user">
                                                            <label for="heard">GeoGenius</label>
                                                        </td>
                                                        <td>
                                                            <div class="form-group text-left">
                                                                <label for="heard">Mark</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> <!-- end card-box-->
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table data-toggle="table" data-page-size="7" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable ">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">S.no</th>
                                                        <th class="text-center" data-field="id" data-switchable="false">Student Name
                                                        </th>
                                                        <th class="text-center" style="width: 100px;" data-field="name">Skill</th>
                                                        <th class="text-center" data-field="Remarks">Grammer</th>
                                                        <th class="text-center">GeoGenius</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">1</td>
                                                        <td class="table-user">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">William</a>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <input type="text" class="form-control text-center" style="width:100px;" id="name" placeholder="" readonly value="A" aria-describedby="inputGroupPrepend" required>
                                                            </div>
                                                        </td>
                                                        <td><input type="text" class="form-control text-right" style="width:100px;" readonly value="75" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                        </td>
                                                        <td> <input type="text" class="form-control text-right" style="width:100px;" readonly value="45" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">2</td>
                                                        <td class="table-user">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">James</a>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <input type="text" class="form-control text-center" style="width:100px;" id="name" placeholder="" readonly value="C" aria-describedby="inputGroupPrepend" required>
                                                            </div>
                                                        </td>
                                                        <td> <input type="text" class="form-control text-right" style="width:100px;" readonly value="60" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                        </td>
                                                        <td> <input type="text" class="form-control text-right" style="width:100px;" readonly value="55" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                        </td>
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">3</td>
                                                        <td class="table-user">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">Benjamin</a>
                                                        </td>
                                                        <td>

                                                            <input type="text" class="form-control text-center" style="width:100px;" readonly value="C" placeholder="" required>

                                                        </td>
                                                        <td> <input type="text" class="form-control text-right" style="width:100px;" readonly value="44" placeholder="" required>
                                                        </td>
                                                        <td> <input type="text" class="form-control text-right" style="width:100px;" readonly value="99" placeholder="" required>
                                                        </td>
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">4</td>
                                                        <td class="table-user">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                            <a class="text-body font-weight-semibold">Lucas</a>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <input type="text" class="form-control text-center" style="width:100px;" value="A">
                                                            </div>
                                                        </td>
                                                        <td> <input type="text" class="form-control text-right" style="width:100px;" value="66">
                                                        </td>
                                                        <td> <input type="text" class="form-control text-right" style="width:100px;" value="80">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">5</td>
                                                        <td class="table-user">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">Charlotte</a>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <input type="text" class="form-control text-center" style="width:100px;" id="name" readonly value="B+" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                            </div>
                                                        </td>
                                                        <td> <input type="text" class="form-control text-right" style="width:100px;" id="name" readonly value="57" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                        </td>
                                                        <td> <input type="text" class="form-control text-right" style="width:100px;" readonly value="90" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                        </td>
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">6</td>
                                                        <td class="table-user">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">Sophia</a>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <input type="text" class="form-control text-center" style="width:100px;" readonly value="D" required>
                                                            </div>
                                                        </td>
                                                        <td> <input type="text" class="form-control text-right" style="width:100px;" readonly value="80" required />
                                                        </td>
                                                        <td>
                                                            <div> <input type="text" class="form-control text-right" style="width:100px;" readonly value="70" required /></div>
                                                        </td>
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">7</td>
                                                        <td class="table-user">
                                                            <img src="{{ asset('images/users/default.jpg') }}" class="mr-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body font-weight-semibold"> Amelia</a>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <input type="text" class="form-control text-center" style="width:100px;" id="name" placeholder="" readonly value="G" aria-describedby="inputGroupPrepend" required>
                                                            </div>
                                                        </td>
                                                        <td> <input type="text" class="form-control text-right" style="width:100px;" id="name" placeholder="" readonly value="50" aria-describedby="inputGroupPrepend" required>
                                                        </td>
                                                        <td> <input type="text" class="form-control text-right" style="width:100px;" readonly value="70" id="name" placeholder="" required>
                                                        </td>
                                                    </tr>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> <!-- end card-box-->
                                    </div>
                                    <div class="clearfix mt-4">
                                        <button type="submit" class="btn btn-primary-bl waves-effect waves-light float-right">Save</button>
                                    </div><br />
                                </div>

                            </div>
                        </div> <!-- end card-box-->
                    </div> <!-- end col -->

                </div>
                <!-- end row -->

            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->

</div> <!-- container -->
@endsection