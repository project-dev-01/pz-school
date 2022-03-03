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
    <style>
        .rating {
            display: flex;
            width: 100%;
            justify-content: center;
            overflow: hidden;
            flex-direction: row-reverse;
            position: relative;
        }

        .rating-0 {
            filter: grayscale(100%);
        }

        .rating>input {
            display: none;
        }

        .rating>label {
            cursor: pointer;
            width: 30px;
            height: 30px;
            margin-top: auto;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23e3e3e3' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 76%;
            transition: .3s;
        }

        .rating>input:checked~label,
        .rating>input:checked~label~label {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23fcd93a' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
        }


        .rating>input:not(:checked)~label:hover,
        .rating>input:not(:checked)~label:hover~label {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23d8b11e' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
        }

        #rating-1:checked~.emoji-wrapper>.emoji {
            transform: translateY(-100px);
        }

        #rating-2:checked~.emoji-wrapper>.emoji {
            transform: translateY(-200px);
        }

        #rating-3:checked~.emoji-wrapper>.emoji {
            transform: translateY(-300px);
        }

        #rating-4:checked~.emoji-wrapper>.emoji {
            transform: translateY(-400px);
        }

        #rating-5:checked~.emoji-wrapper>.emoji {
            transform: translateY(-500px);
        }

        * {
            box-sizing: border-box;
            transition: all .1s ease-in-out;
        }

        .radio_group {
            width: 40px;
            height: 53px;
            margin: 8px;
            position: relative;
            text-align: right;
            font-size: 25px;
        }

        .radio_group input[type="radio"] {
            opacity: 0;
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0px;
            top: 0px;
            margin: 0;
            padding: 0;
            z-index: 1;
            cursor: pointer;
        }

        .radio_group input[type="radio"]+label {
            color: #95a5a6;
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
            transform: scale(.8);
        }

        .radio_group input[type="radio"]:checked+label {
            color: #3498db;
            transform: scale(1.1);
        }
    </style>

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
                    <form id="classroomFilter" autocomplete="off">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="changeClassName">Class<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">Select Class</option>
                                        @forelse ($teacher_class as $class)
                                        <option value="{{ $class['class_id'] }}">{{ $class['class_name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sectionID">Section<span class="text-danger">*</span></label>
                                    <select id="sectionID" class="form-control" name="section_id">
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="subjectID">Subject<span class="text-danger">*</span></label>
                                    <select id="subjectID" class="form-control" name="subject_id">
                                        <option value="">Select Subject</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_date">Date<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="<?php echo date('d-m-Y'); ?>" name="class_date" id="classDate" require="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="heard">Count Down<span class="text-danger">*</span></label>
                                    <input type="text" id="basic-timepicker" class="form-control btn dropdown-toggle btn-light" placeholder="01:00:00" disabled>

                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                    Filter
                                </button>
                            </div>
                        </div>
                    </form>
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
                                            <div id="layoutModeGrid"></div>
                                        </div>
                                    </div>
                                </div>
                                <style>
                                    #aa:hover {
                                        text-decoration: underline;
                                    }
                                </style>
                                <div class="tab-pane" id="home-b1">
                                    <form id="addformdata" method="post" action="{{ route('teacher.classroom.add') }}" autocomplete="off">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="changeAttendance">Select Attendance</label>
                                                    <select id="changeAttendance" class="form-control">
                                                        <option value="">Not Selected</option>
                                                        <option value="present">Present</option>
                                                        <option value="absent">Absent</option>
                                                        <option value="late">Late</option>
                                                        <option value="excused">Excused</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="changeAttendance">Search</label>
                                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="class_id" id="listModeClassID">
                                        <input type="hidden" name="section_id" id="listModeSectionID">
                                        <input type="hidden" name="subject_id" id="listModeSubjectID">
                                        <input type="hidden" name="date" id="listModeSelectedDate">
                                        <div class="">
                                            <table data-toggle="table" data-page-size="7" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable ">
                                                <thead>
                                                    <tr>
                                                        <th data-field="state" data-checkbox="true"></th>
                                                        <th data-field="id" data-switchable="false">Student Name
                                                        </th>
                                                        <th data-field="name">Attentance</th>
                                                        <th data-field="Remarks">Remarks</th>
                                                        <th data-field="Reasons">Reasons</th>
                                                        <th data-field="sbehaviour">student behaviour</th>
                                                        <th data-field="crbehaviour">Class Room behaviour</th>
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
                                                            <div class="rating">
                                                                <input type="radio" name="rating" id="rating-5">
                                                                <label for="rating-5"></label>
                                                                <input type="radio" name="rating" id="rating-4">
                                                                <label for="rating-4"></label>
                                                                <input type="radio" name="rating" id="rating-3">
                                                                <label for="rating-3"></label>
                                                                <input type="radio" name="rating" id="rating-2">
                                                                <label for="rating-2"></label>
                                                                <input type="radio" name="rating" id="rating-1">
                                                                <label for="rating-1"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="radio_group">
                                                                    <input type="radio" name="like">
                                                                    <label for="like">
                                                                        <i class="fas fa-thumbs-up"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="radio_group">
                                                                    <input type="radio" name="like">
                                                                    <label for="like">
                                                                        <i class="fas fa-thumbs-down"></i>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- <table data-toggle="table" data-page-size="3" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable "> -->
                                                    <!-- <table id="listModeClassRoom" class="table table-striped table-nowrap"> 
                                            <table id="listModeClassRoom" class="table table-striped table-nowrap custom-table mb-0 datatable">
                                                <!-- <table class="display" width="100%"> 
                                                <thead>
                                                    <tr>
                                                        <th data-field="state" data-checkbox="true"></th>
                                                        <th data-field="id" data-switchable="false">Student name
                                                        </th>
                                                        <th data-field="name">Attentance</th>
                                                        <th data-field="Remarks">Remarks</th>
                                                        <th data-field="Reasons">Reasons</th>
                                                        <th data-field="sbehaviour">Student behaviour</th>
                                                        <th data-field="crbehaviour">Class Room behaviour</th>

                                                    </tr>
                                                </thead>
                                                <!-- <tbody id="listModeClassRoom"> --
                                                <tbody>-->
                                                </tbody>
                                            </table>
                                        </div> <!-- end card-box-->
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <div class="form-group text-right m-b-0">
                                                    <button class="btn btn-primary-bl waves-effect waves-light" id="saveClassRoomAttendance" type="submit">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div> <!-- end col-->

                                <div class="modal fade" id="stuRemarksPopup" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <label for="heard">Remarks</label>
                                                <input type="hidden" id="studenetID" />
                                                <textarea class="form-control" id="student_remarks" rows="5" placeholder="Enter remarks here" name="student_remarks"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                                <button type="button" id="studentRemarksSave" class="btn btn-primary">Save</button>
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
@section('scripts')
<script>
    var teacherSectionUrl = "{{ config('constants.api.teacher_section') }}";
    var teacherSubjectUrl = "{{ config('constants.api.teacher_subject') }}";
    var getStudentAttendance = "{{ config('constants.api.get_student_attendance') }}";
    // default image test
    var defaultImg = "{{ asset('images/users/default.jpg') }}";
</script>
<!--<script src="{{ asset('js/custom/classroom.js') }}"></script>-->

@endsection