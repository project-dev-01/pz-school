@extends('layouts.admin-layout')
@section('title','Class Room Management')
@section('css')
<style>
    .radio_group {
        width: 35px;
        height: 35px;
        margin: 0px 3px 0px 0px;
        position: relative;
        text-align: right;
        font-size: 25px;
        background-color: #08b9e133;
    }

    .radio_group_1 {
        width: 30px;
        height: 53px;
        position: relative;
        text-align: right;
        font-size: 25px;
    }

    .radio_group_1 input[type="radio"] {
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

    .radio_group_1 input[type="radio"]+label {
        color: #95a5a6;
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
        transform: scale(.8);
    }

    .radio_group_1 input[type="radio"]:checked+label {
        color: #FFD700;
        transform: scale(1.1);
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
    
    /*start counter Code*/
    #classroom_count_down .countdown-wrapper {
        width: 100%;
        display: inline-block;
        position: relative;
    }

    #classroom_count_down .countdown-wrapper:after {
        padding-top: 17%;
        display: block;
        content: '';
    }

    #classroom_count_down .countdown-main {
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
    }

    #classroom_count_down .countdown-section-days {
        display: inline;
        height: 100%;
        width: 30%;
        float: left;
    }

    #classroom_count_down .countdown-section-other {
        display: inline;
        height: 100%;
        width: 20%;
        float: left;
    }

    #classroom_count_down .countdown-separator {
        display: inline;
        height: 100%;
        width: 3.33%;
        float: left;
    }

    #classroom_count_down .countdown-separator-top {
        height: 85%;
        width: 100%;
        text-align: center;
    }

    #classroom_count_down .countdown-dot {
        width: 60%;
        height: 14%;
        border-radius: 75%;
        border: 1px solid #000000;
        background-color: #404040;
        margin: auto;
        margin-top: 107%;

    }

    #classroom_count_down .countdown-number-container {
        width: 100%;
        height: 85%;
        position: relative;
    }

    #classroom_count_down .countdown-number-days {
        width: 33.33%;
        height: 100%;
        float: left;
        display: inline;
        border-radius: 7%;
        -webkit-perspective: 1000px;
        /* Chrome, Safari, Opera  */
        perspective: 1000px;
        position: relative;

    }

    #classroom_count_down .countdown-number-other {
        width: 50%;
        height: 100%;
        float: left;
        display: inline;
        border-radius: 7%;
        -webkit-perspective: 1000px;
        /* Chrome, Safari, Opera  */
        perspective: 1000px;
        position: relative;
    }


    #classroom_count_down .countdown-number-top {
        width: 100%;
        height: 50%;
        border-top-left-radius: 7%;
        border-top-right-radius: 7%;
        border: 1px solid #000000;
        overflow: hidden;
        background-color: #404040;
        color: #FFFFFF;
        transform-origin: bottom left;
    }

    #classroom_count_down .countdown-number-bottom {
        width: 100%;
        height: 50%;
        border-bottom-left-radius: 7%;
        border-bottom-right-radius: 7%;
        border: 1px solid #000000;
        background-color: #404040;
        color: #FFFFFF;
        overflow: hidden;

        background: -moz-linear-gradient(top, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.2) 1%, rgba(0, 0, 0, 0) 100%);
        /* FF3.6-15 */
        background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.2) 1%, rgba(0, 0, 0, 0) 100%);
        /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.2) 1%, rgba(0, 0, 0, 0) 100%);
        /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000', endColorstr='#59000000', GradientType=0);
        /* IE6-9 */
    }

    #classroom_count_down .countdown-number-inner {
        width: 100%;
        height: 200%;
        vertical-align: middle;
        text-align: center;
        font-weight: bold;
        transform-origin: top;
    }

    #classroom_count_down .countdown-number-next {
        position: absolute;
        width: 100%;
        height: 100%;
        vertical-align: middle;
        text-align: center;
        font-weight: bold;
        z-index: -9999;
        border-radius: 7%;
        color: #FFFFFF;
        border: 1px solid #000000;
        background-color: #404040;
    }


    #classroom_count_down .countdown-number-top .countdown-number-inner {
        transform-origin: bottom left;
    }

    #classroom_count_down .shadow {
        z-index: 999;
        height: 100%;
        width: 100%;
        background: -moz-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.2) 99%, rgba(0, 0, 0, 0.2) 100%);
        /* FF3.6-15 */
        background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.2) 99%, rgba(0, 0, 0, 0.2) 100%);
        /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.2) 99%, rgba(0, 0, 0, 0.2) 100%);
        /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000', endColorstr='#59000000', GradientType=0);
        /* IE6-9 */
    }

    #classroom_count_down .countdown-number-bottom .countdown-number-inner {
        transform: translateY(-52.5%);
    }

    #classroom_count_down .countdown-label-container {
        height: 15%;
        width: 100%;
        vertical-align: middle;
        text-align: center;
        color: #000000;
        padding-top: 5px;
        font-size: 12px;
    }

    #classroom_count_down .countdown-number-container .ready {
        display: none;
    }

    /*End counter Code*/
</style>
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Classroom Management</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> Classroom
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="classroomFilter" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="changeClassName">Standard<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">Select Class</option>
                                        @forelse ($class as $cla)
                                        <option value="{{ $cla['id'] }}">{{ $cla['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sectionID">Class Name<span class="text-danger">*</span></label>
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
                        </div>
                        <div class="row">
                            <div class="col-md-3">
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
                            <div class="col-md-3">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Count Down</label>
                                    <div>
                                        <!-- #classroom_count_down is always 100% responsive to it's container-->

                                        <div id="classroom_count_down">
                                            <div class="countdown-wrapper">
                                                <div class="countdown-main">
                                                    <div class="countdown-section-days days">
                                                        <div class="countdown-number-container">
                                                            <div class="countdown-number-days">
                                                                <div class="countdown-number-next position-0-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-0">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-0">0</div>
                                                                </div>
                                                            </div>
                                                            <div class="countdown-number-days">
                                                                <div class="countdown-number-next position-1-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-1">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-1">0</div>
                                                                </div>
                                                            </div>
                                                            <div class="countdown-number-days">
                                                                <div class="countdown-number-next position-2-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-2">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-2">0</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="countdown-label-container">DAYS</div>
                                                    </div>
                                                    <div class="countdown-separator">
                                                        <div class="countdown-separator-top">
                                                            <div class="countdown-dot"></div>
                                                            <div class="countdown-dot"></div>
                                                        </div>
                                                    </div>
                                                    <div class="countdown-section-other hours">
                                                        <div class="countdown-number-container">
                                                            <div class="countdown-number-other">
                                                                <div class="countdown-number-next position-3-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-3">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-3">0</div>
                                                                </div>
                                                            </div>
                                                            <div class="countdown-number-other">
                                                                <div class="countdown-number-next position-4-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-4">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-4">0</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="countdown-label-container">HOURS</div>
                                                    </div>
                                                    <div class="countdown-separator">
                                                        <div class="countdown-separator-top">
                                                            <div class="countdown-dot"></div>
                                                            <div class="countdown-dot"></div>
                                                        </div>
                                                    </div>
                                                    <div class="countdown-section-other minutes">
                                                        <div class="countdown-number-container">
                                                            <div class="countdown-number-other">
                                                                <div class="countdown-number-next position-5-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-5">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-5">0</div>
                                                                </div>
                                                            </div>
                                                            <div class="countdown-number-other">
                                                                <div class="countdown-number-next position-6-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-6">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-6">0</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="countdown-label-container">MINUTES</div>
                                                    </div>
                                                    <div class="countdown-separator">
                                                        <div class="countdown-separator-top">
                                                            <div class="countdown-dot"></div>
                                                            <div class="countdown-dot"></div>
                                                        </div>
                                                    </div>
                                                    <div class="countdown-section-other seconds">
                                                        <div class="countdown-number-container">
                                                            <div class="countdown-number-other">
                                                                <div class="countdown-number-next position-7-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-7">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-7">0</div>
                                                                </div>
                                                            </div>
                                                            <div class="countdown-number-other">
                                                                <div class="countdown-number-next position-8-next">0</div>
                                                                <div class="countdown-number-top">
                                                                    <div class="shadow">
                                                                        <div class="countdown-number-inner position-8">0</div>
                                                                    </div>
                                                                </div>
                                                                <div class="countdown-number-bottom">
                                                                    <div class="countdown-number-inner position-8">0</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="countdown-label-container">SECONDS</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
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
            <div class="card classRoomHideSHow" style="display: none;"><br>
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-3" id="top-header">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <p class="mb-1">Present</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="presentCount" style="color:black"></span></h3>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="">
                                            <p class="mb-1">Absent</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="absentCount" style="color:black"></span></h3>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="">
                                            <p class="mb-1">Late</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="lateCount" style="color:black"></span></h3>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="">
                                            <p class="mb-1">Excused</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="excuseCount" style="color:black"></span></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="float-right" id="totalStrength"></span></h6>
                                </div>

                            </div>
                        </div><!-- end col-->
                        <div class="col-lg-3" id="top-header">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="fas fa-user-graduate font-24"></i><br><br>
                                            <p class="mb-1">Perfect attendance</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="perfectAttendance" style="color:black"></span></h3>

                                        </div>
                                    </div>
                                </div><br><br>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="float-right">100% of class</span></h6>
                                </div>

                            </div>
                        </div><!-- end col-->
                        <div class="col-lg-3" id="top-header">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="  fas fa-user-tie  font-24"></i><br><br>
                                            <p class="mb-1">Average Attendance</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="avg_attendance" style="color:black"></span></h3>

                                        </div>
                                    </div>
                                </div><br><br>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="float-right">100% of class</span></h6>
                                </div>

                            </div>
                        </div><!-- end col-->
                        <div class="col-lg-3">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="fas fa-chalkboard-teacher font-24"></i><br><br>
                                            <p class="mb-1">Below Attendance</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="my-1"><span data-plugin="counterup" id="belowAttendance" style="color:black"></span></h3>

                                        </div>
                                    </div>
                                </div><br><br>
                                <div class="mt-3">
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <h6 class="text-uppercase"><span class="float-right">100% of class</span></h6>
                                </div>
                            </div> <!-- end card-box-->
                        </div>
                    </div>
                </div>
            </div><!-- end col-->
            <div class="row classRoomHideSHow" style="display: none;">
                <div class="col-xl-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv"> Classroom details
                                    <h4>
                            </li>
                        </ul><br>
                        <style>
                            .nav-tabs .nav-link.active {
                                border-color: #328eeb #328eeb #fff;
                            }
                        </style>
                        <ul class="nav nav-tabs" style="border-bottom: 1px solid #328eeb;background-color: #F4F7FC;">
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
                                <a href="#dailyreport" data-toggle="tab" aria-expanded="false" class="nav-link">
                                    Daily Report
                                </a>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="profile-b1">
                                    <div class="row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <a href="javascript: void(0);" class="text-reset mb-2 d-block">
                                                <i class='fas fa-circle' style='font-size:14px;color:#60a05b'></i>
                                                <span class="mb-0 mt-1" style="text-align:center">Present</span>
                                                <i class='fas fa-circle' style='font-size:14px;color:#358fde'></i>
                                                <span class="mb-0 mt-1">Late</span>
                                                <i class='fas fa-circle' style='font-size:14px;color:#de354f'></i>
                                                <span class="mb-0 mt-1">Absent</span>
                                                <i class='fas fa-circle' style='font-size:14px;color:#696969'></i>
                                                <span class="mb-0 mt-1">Excused</span>
                                            </a>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div id="layoutModeGrid"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="home-b1">
                                    <form id="addListMode" method="post" action="{{ route('admin.classroom.add') }}" autocomplete="off">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3">
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
                                                </div>
                                                <input type="hidden" name="class_id" id="listModeClassID">
                                                <input type="hidden" name="section_id" id="listModeSectionID">
                                                <input type="hidden" name="subject_id" id="listModeSubjectID">
                                                <input type="hidden" name="semester_id" id="listModeSemesterID">
                                                <input type="hidden" name="session_id" id="listModeSessionID">
                                                <input type="hidden" name="date" id="listModeSelectedDate">
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <!-- <table data-toggle="table" data-page-size="3" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable "> -->
                                                    <!-- <table id="listModeClassRoom" class="table table-striped table-nowrap"> -->
                                                    <table id="listModeClassRoom" class="table dt-responsive nowrap w-100">
                                                        <!-- <table class="display" width="100%"> -->
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Student name</th>
                                                                <th>Attentance</th>
                                                                <th>Remarks</th>
                                                                <th>Reasons</th>
                                                                <th>Student behaviour</th>
                                                                <th>Class behaviour</th>

                                                            </tr>
                                                        </thead>
                                                        <!-- <tbody id="listModeClassRoom"> -->
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div><br>
                                                <div class="form-group text-right m-b-0">
                                                    <button class="btn btn-primary-bl waves-effect waves-light" id="saveClassRoomAttendance" type="submit">
                                                        Save
                                                    </button>
                                                </div>
                                            </div> <!-- end card-box-->
                                        </div>
                                    </form>
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
                                    <div class="card">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <h4 class="navv">Student Leave Request
                                                    <h4>
                                            </li>
                                        </ul><br>
                                        <div class="card-body">
                                            <form id="updatestudentleave" method="post" action="{{ route('teacher.studentleave.update') }}" autocomplete="off">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="stdleaves" class="table w-100 nowrap" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Student name</th>
                                                                    <th>From Leave</th>
                                                                    <th>To Leave</th>
                                                                    <th>Reason</th>
                                                                    <th>Document</th>
                                                                    <th>Status</th>
                                                                    <th>Remarks</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="stdleaves_body"></tbody>
                                                        </table>
                                                        <input type="hidden" id="addstd_leave_Remarks" />
                                                    </div>
                                                </div>

                                        </div> <!-- end col-->

                                        </form>
                                    </div>
                                </div>
                                <!-- student leave remarks popup -->
                                <div class="modal fade" id="stuLeaveRemarksPopup" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <label for="heard">Remarks</label>
                                                <input type="hidden" id="studenet_leave_tbl_id" />
                                                <textarea class="form-control" id="student_leave_remarks" rows="5" placeholder="Enter remarks here" name="student_leave_remarks"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                                <button type="button" id="student_leave_RemarksSave" class="btn btn-primary">Save</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <div class="tab-pane" id="dailyreport">
                                    <form id="addDailyReport" method="post" action="{{ route('admin.classroom.add_daily_report') }}" autocomplete="off">
                                        <input type="hidden" name="class_id" id="dailyReportClassID">
                                        <input type="hidden" name="section_id" id="dailyReportSectionID">
                                        <input type="hidden" name="subject_id" id="dailyReportSubjectID">
                                        <input type="hidden" name="semester_id" id="dailyReportSemesterID">
                                        <input type="hidden" name="session_id" id="dailyReportSessionID">
                                        <input type="hidden" name="date" id="dailyReportSelectedDate">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="daily_report">Report<span class="text-danger">*</span></label>
                                                    <textarea class="form-control" id="daily_report" rows="5" name="daily_report" placeholder="Please enter description"></textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label id="dailyReportLastUpdate"></label>
                                                            <!-- <label for="heard">Last Updated: 29-01-2022 12:00:00 AM</label> -->
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group text-right m-b-0">
                                                    <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                                        Save
                                                    </button>
                                                </div>
                                            </div> <!-- end col-->

                                        </div>
                                    </form>
                                    <form id="addDailyReportRemarks" method="post" action="{{ route('admin.classroom.add_daily_report_remarks') }}" autocomplete="off">
                                        <input type="hidden" name="class_id" id="dailyReportRemarksClassID">
                                        <input type="hidden" name="section_id" id="dailyReportRemarksSectionID">
                                        <input type="hidden" name="subject_id" id="dailyReportRemarksSubjectID">
                                        <input type="hidden" name="semester_id" id="dailyReportRemarksSemesterID">
                                        <input type="hidden" name="session_id" id="dailyReportRemarksSessionID">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="dailyReportRemarks" class="table dt-responsive nowrap w-100">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Student Name</th>
                                                                    <th>Student Remarks</th>
                                                                    <th>Remarks</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div> <!-- end card-box-->
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <div class="form-group text-right m-b-0">
                                                        <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                                            Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="shortest">

                                    <div class="card">
                                        <div class="card-body">
                                            <form id="getShortTest" action="{{ route('admin.classroom.get_short_test') }}" method="post">
                                                <input type="hidden" name="class_id" id="shortTestClassID">
                                                <input type="hidden" name="section_id" id="shortTestSectionID">
                                                <input type="hidden" name="subject_id" id="shortTestSubjectID">
                                                <input type="hidden" name="semester_id" id="shortTestSemesterID">
                                                <input type="hidden" name="session_id" id="shortTestSessionID">
                                                <input type="hidden" name="date" id="shortTestSelectedDate">

                                                <div id="dynamic-field-1" class="form-group dynamic-field">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="field" class="font-weight-bold">Short Test<span class="text-danger">*</span></label>
                                                            <input type="text" id="field" class="form-control shortTestAdd" id="Hours" name="field[]" />
                                                            <span id="shortTestError"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="grade" class="font-weight-bold">Status<span class="text-danger">*</span></label>
                                                            <select id="grade" class="form-control" name="grade[]">
                                                                <option value="marks">Marks</option>
                                                                <option value="grade">Grade</option>
                                                                <option value="text">Text</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div>
                                                        <button type="button" id="add-button" class="btn btn-success text-uppercase shadow-sm">
                                                            <i class="fe-plus-circle"></i> Add</button>
                                                        <button type="button" id="remove-button" class="btn btn-danger text-uppercase" disabled="disabled">
                                                            <i class="fe-minus-circle"></i> Remove</button>
                                                        <button type="submit" id="save-button" class="btn btn-info waves-effect waves-light text-uppercase">
                                                            <i class="fe-save"></i> Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row shortTestHideSHow">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table dt-responsive nowrap w-100">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.no</th>
                                                                    <th>Short Test Name</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="shortTestAppend">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div> <!-- end card-box-->
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row shortTestHideSHow">
                                        <!-- <div class="row"> -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form id="addShortTest" method="post" action="{{ route('admin.classroom.add_short_test') }}" autocomplete="off">
                                                        @csrf
                                                        <div id="shortTestTableAppend">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group text-right m-b-0">
                                                                <button type="submit" class="btn btn-primary-bl waves-effect waves-light">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- </div> end card-box -->
                                    </div>

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
    var teacherSectionUrl = "{{ config('constants.api.section_by_class') }}";
    var teacherSubjectUrl = "{{ config('constants.api.subject_by_class') }}";

    // var teacherSectionUrl = "{{ config('constants.api.teacher_section') }}";
    // var teacherSubjectUrl = "{{ config('constants.api.teacher_subject') }}";

    var getStudentAttendance = "{{ config('constants.api.get_student_attendance') }}";
    var getDailyReportRemarks = "{{ config('constants.api.get_daily_report_remarks') }}";
    var getClassRoomWidget = "{{ config('constants.api.get_classroom_widget_data') }}";
    var getShortTest = "{{ config('constants.api.get_short_test') }}";
    // student leave apply
    var getStudentLeave = "{{ config('constants.api.get_student_leaves') }}";
    var imgurl = "{{ asset('public/teacher/student-leaves/') }}";
    var teacher_leave_remarks_updated = "{{ config('constants.api.teacher_leave_approve') }}";
    var getAbsentLateExcuse = "{{ config('constants.api.get_absent_late_excuse') }}";

    // default image test
    var defaultImg = "{{ asset('public/images/users/default.jpg') }}";
    var studentImg = "{{ asset('public/users/images/') }}";
</script>
<script src="{{ asset('public/js/custom/classroom.js') }}"></script>
<script src="{{ asset('public/js/custom/short-test.js') }}"></script>
@endsection