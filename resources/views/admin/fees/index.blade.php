@extends('layouts.admin-layout')
@section('title','Fees')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <!--<div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UI</a></li>
                                            <li class="breadcrumb-item active">Tabs & Accordions</li>
                                        </ol>
                                    </div>-->
                <h4 class="page-title">Fees Details</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> Student Details<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        
                    <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btwyears">Academic year<span class="text-danger">*</span></label>
                                    <select id="btwyears" class="form-control" name="year">
                                        <option value="">Select Academic Year</option>
                                        @forelse($academic_year_list as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_id">Grade<span class="text-danger">*</span></label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">Select Grade</option>
                                        <!-- <option value="All">All</option> -->
                                        @forelse ($classnames as $class)

                                        <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="section_drp_div">
                                <div class="form-group">
                                    <label for="section_id">Class<span class="text-danger">*</span></label>
                                    <select id="section_id" class="form-control" name="section_id">
                                        <option value="">Select Class</option>
                                    </select>
                                </div>
                            </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="student_id">Student<span class="text-danger">*</span></label>
                                <select id="student_id" class="form-control" name="student_id">
                                    <option value="">Select Student</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="payment_item">Payment Item<span class="text-danger">*</span></label>
                                <select id="payment_item" class="form-control" name="payment_item">
                                    
                                    <option value="">Select Payment Item</option>
                                        @forelse ($payment_item as $item)

                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                        @empty
                                        @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="payment_status">Payment Status<span class="text-danger">*</span></label>
                                <select id="payment_status" class="form-control" name="payment_status">
                                    <option value="">Select Payment Status</option>
                                        @forelse ($payment_status as $status)

                                        <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                                        @empty
                                        @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary waves-effect waves-light" type="Save">
                            Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Student Details -->

    <!-- Student Fees Details List-->
    <div class="row">
        <div class="col-xl-12 col-sm-12 col-md-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Student Fees Details List<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap" id="">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Grade</th>
                                    <th>Class</th>
                                    <th>Student Name</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#</td>
                                    <td>Tingkatan 1</td>
                                    <td>Unggul</td>
                                    <td>ADAM IRFAN RAYYAN</td>
                                    <td>
                                        <div class="badge label-table badge-warning">Pending</div>
                                    </td>
                                    <td>
                                        <div class="button-list">
                                            <a href="#" data-toggle="modal" data-target="#viewModal" class="btn btn-blue waves-effect waves-light"><i class="fe-edit"></i></a>
                                            <a href="#" class="btn btn-danger waves-effect waves-light"><i class="fe-trash-2"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#</td>
                                    <td>Tingkatan 2</td>
                                    <td>Wawasan</td>
                                    <td>ADAM IRFAN RAYYAN</td>
                                    <td>
                                        <div class="badge label-table badge-success">Paid</div>
                                    </td>
                                    <td>
                                        <div class="button-list">
                                            <a href="#" data-toggle="modal" data-target="#viewModal" class="btn btn-blue waves-effect waves-light"><i class="fe-edit"></i></a>
                                            <a href="#" class="btn btn-danger waves-effect waves-light"><i class="fe-trash-2"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#</td>
                                    <td>Tingkatan 3</td>
                                    <td>Iltizam</td>
                                    <td>ADAM IRFAN RAYYAN</td>
                                    <td>
                                        <div class="badge label-table badge-warning">Pending</div>
                                    </td>
                                    <td>
                                        <div class="button-list">
                                            <a href="#" data-toggle="modal" data-target="#viewModal" class="btn btn-blue waves-effect waves-light"><i class="fe-edit"></i></a>
                                            <a href="#" class="btn btn-danger waves-effect waves-light"><i class="fe-trash-2"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
    </div>
    <!-- End Student Fees Details List-->

    <div class="modal" id="viewModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myviewEventModalLabel" style="color: #6FC6CC"> <i class="fas fa-info-circle"></i> Student Fees Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table w-100 nowrap">
                                        <h5> Student & Parent Information</h5>
                                        <hr>
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="mb-6">Academic Year : <span class="text-muted mr-2">2021-2022</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="mb-4">Grade : <span class="text-muted mr-2">Tingkatan
                                                                1</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="mb-4">Class : <span class="text-muted mr-2">Unggul</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="mb-6">Student Name : <span class="text-muted mr-2">Adam Irfan
                                                                Rayyan</span></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="mb-4">Parent Name : <span class="text-muted mr-2">Muhammad Radzi
                                                                Bin</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="mb-4">Phone No : <span class="text-muted mr-2">9000989801</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="mb-6">Email : <span class="text-muted mr-2">adam@gmail.com</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </table>
                                </div>

                                <div class="">
                                    <div class="">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <h4 class="navv">Student Fee Details<h4>
                                            </li>
                                        </ul>
                                        <div class="card">

                                            <div class="">
                                                <div class="col-xl-12 col-sm-12 col-md-12">
                                                    <div class="card-body">
                                                        <div class="col-10">
                                                            <ul class="nav nav-pills navtab-bg nav-justified">
                                                                <li class="nav-item">
                                                                    <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                                        School Fee
                                                                    </a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a href="#hostel" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                                        Hostel Fee
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a href="#pta" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                                        PTA Fee
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="tab-content">
                                                            <div class="tab-pane show active" id="home-b1">
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label for="tudent Name">Payment
                                                                            Mode<span class="text-danger">*</span></label>
                                                                        <select id="target" class="form-control" name="">
                                                                            <option value="content_0">
                                                                                Choose Payment Mode
                                                                            </option>
                                                                            <option value="content_1">
                                                                                Yearly</option>
                                                                            <option value="content_2">
                                                                                Semester</option>
                                                                            <option value="content_3">
                                                                                Monthly</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div id="content_1" class="inv">
                                                                    <div class="">
                                                                        <div class="col-12">
                                                                            <div class="card">
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="student Name">Date<span class="text-danger">*</span></label>
                                                                                            <input type="text" id="humanfd-datepicker" class="form-control" placeholder="MM/DD/YYYY">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="student Name">Payment
                                                                                                Status<span class="text-danger">*</span></label>
                                                                                            <select id="tudent Name" class="form-control" name="class_id">
                                                                                                <option value="">
                                                                                                    Choose
                                                                                                    Payment
                                                                                                    Status
                                                                                                </option>
                                                                                                <option value="">
                                                                                                    Waived
                                                                                                </option>
                                                                                                <option value="">
                                                                                                    Paid
                                                                                                </option>
                                                                                                <option value="">
                                                                                                    Not
                                                                                                    Paid
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="form-group text-right m-b-0">
                                                                                    <button class="btn btn-primary waves-effect waves-light" type="Save">
                                                                                        Save
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!--  Start Student Fee Semester -->
                                                                <div id="content_2" class="inv">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <div class="row">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-bordered table-hover">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>
                                                                                                        </th>
                                                                                                        <th>Date
                                                                                                        </th>
                                                                                                        <th>Semester
                                                                                                        </th>
                                                                                                        <th>Payment
                                                                                                            Status
                                                                                                        </th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>

                                                                                                    <tr>
                                                                                                        <td><input type="checkbox" id="semester1" />
                                                                                                        </td>
                                                                                                        <td><input type="text" disabled class="form-control inputDateFld1" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>
                                                                                                        <td>Semester
                                                                                                            1
                                                                                                        </td>
                                                                                                        <td><select id="student Name" disabled class="form-control dropDwn1" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>

                                                                                                        <td><input type="checkbox" id="semester2" />
                                                                                                        </td>
                                                                                                        <td><input type="text" disabled class="form-control inputDateFld2" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>
                                                                                                        <td>Semester
                                                                                                            2
                                                                                                        </td>
                                                                                                        <td><select id="student Name" disabled class="form-control dropDwn2" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>

                                                                                                        <td><input type="checkbox" id="semester3" />
                                                                                                        </td>
                                                                                                        <td><input type="text" disabled class="form-control inputDateFld3" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>
                                                                                                        <td>Semester
                                                                                                            3
                                                                                                        </td>
                                                                                                        <td><select id="student Name" disabled class="form-control dropDwn3" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>


                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-group text-right m-b-0">
                                                                                        <button class="btn btn-primary waves-effect waves-light" type="Save">Save</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--  End Student Fee Semester -->

                                                                <!--  Start Student Fee Monthly -->
                                                                <div id="content_3" class="inv">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <div class="row">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-hover table-bordered table-centered mb-0">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th style="width: 20px;">
                                                                                                            <input type="checkbox">
                                                                                                        <th>Date
                                                                                                        </th>
                                                                                                        <th>Month
                                                                                                        </th>
                                                                                                        <th>Payment
                                                                                                            Status
                                                                                                        </th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>
                                                                                                        <td>Jan
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>
                                                                                                        <td>Feb
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>March
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>April
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>May
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>June
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>July
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>Aug
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>Sep
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>Oct
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>Nov
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>Dec
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    </thead>
                                                                                            </table>

                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-group text-right m-b-0">
                                                                                        <button class="btn btn-primary waves-effect waves-light" type="Save">
                                                                                            Save
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--  End Student Fee Monthly -->
                                                            </div>

                                                            <!-- Hostel Fee -->
                                                            <div class="tab-pane" id="hostel">
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label for="tudent Name">Payment
                                                                            Mode<span class="text-danger">*</span></label>
                                                                        <select id="targett" class="form-control" name="">
                                                                            <option value="content_0">
                                                                                Choose Payment Mode
                                                                            </option>
                                                                            <option value="content_11">
                                                                                Yearly</option>
                                                                            <option value="content_12">
                                                                                Semester</option>
                                                                            <option value="content_13">
                                                                                Monthly</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div id="content_11" class="invv">
                                                                    <div class="">
                                                                        <div class="col-12">
                                                                            <div class="card">
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="student Name">Date<span class="text-danger">*</span></label>
                                                                                            <input type="text" id="humanfd-datepicker" class="form-control" placeholder="MM/DD/YYYY">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="student Name">Payment
                                                                                                Status<span class="text-danger">*</span></label>
                                                                                            <select id="tudent Name" class="form-control" name="class_id">
                                                                                                <option value="">
                                                                                                    Choose
                                                                                                    Payment
                                                                                                    Status
                                                                                                </option>
                                                                                                <option value="">
                                                                                                    Waived
                                                                                                </option>
                                                                                                <option value="">
                                                                                                    Paid
                                                                                                </option>
                                                                                                <option value="">
                                                                                                    Not
                                                                                                    Paid
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="form-group text-right m-b-0">
                                                                                    <button class="btn btn-primary waves-effect waves-light" type="Save">
                                                                                        Save
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!--  Start Student Fee Semester -->
                                                                <div id="content_12" class="invv">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <div class="row">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-bordered table-hover">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>
                                                                                                        </th>
                                                                                                        <th>Date
                                                                                                        </th>
                                                                                                        <th>Semester
                                                                                                        </th>
                                                                                                        <th>Payment
                                                                                                            Status
                                                                                                        </th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>

                                                                                                    <tr>
                                                                                                        <td><input type="checkbox" id="semester1" />
                                                                                                        </td>
                                                                                                        <td><input type="text" disabled class="form-control inputDateFld1" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>
                                                                                                        <td>Semester
                                                                                                            1
                                                                                                        </td>
                                                                                                        <td><select id="student Name" disabled class="form-control dropDwn1" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>

                                                                                                        <td><input type="checkbox" id="semester2" />
                                                                                                        </td>
                                                                                                        <td><input type="text" disabled class="form-control inputDateFld2" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>
                                                                                                        <td>Semester
                                                                                                            2
                                                                                                        </td>
                                                                                                        <td><select id="student Name" disabled class="form-control dropDwn2" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>

                                                                                                        <td><input type="checkbox" id="semester3" />
                                                                                                        </td>
                                                                                                        <td><input type="text" disabled class="form-control inputDateFld3" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>
                                                                                                        <td>Semester
                                                                                                            3
                                                                                                        </td>
                                                                                                        <td><select id="student Name" disabled class="form-control dropDwn3" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>


                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-group text-right m-b-0">
                                                                                        <button class="btn btn-primary waves-effect waves-light" type="Save">Save</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--  End Student Fee Semester -->

                                                                <div id="content_13" class="invv">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <div class="row">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-hover table-bordered table-centered mb-0">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th style="width: 20px;">
                                                                                                            <input type="checkbox">
                                                                                                        <th>Date
                                                                                                        </th>
                                                                                                        <th>Month
                                                                                                        </th>
                                                                                                        <th>Payment
                                                                                                            Status
                                                                                                        </th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>
                                                                                                        <td>Jan
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>
                                                                                                        <td>Feb
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>March
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>April
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>May
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>June
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>July
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>Aug
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>Sep
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>Oct
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>Nov
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>Dec
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    </thead>
                                                                                            </table>

                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-group text-right m-b-0">
                                                                                        <button class="btn btn-primary waves-effect waves-light" type="Save">
                                                                                            Save
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- End Of Hostel Fee -->

                                                            <!-- Start PTA Fee-->

                                                            <div class="tab-pane" id="pta">
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label for="tudent Name">Payment
                                                                            Mode<span class="text-danger">*</span></label>
                                                                        <select id="targettt" class="form-control" name="">
                                                                            <option value="content_0">
                                                                                Choose Payment Mode
                                                                            </option>
                                                                            <option value="content_14">
                                                                                Yearly</option>
                                                                            <option value="content_15">
                                                                                Semester</option>
                                                                            <option value="content_16">
                                                                                Monthly</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div id="content_14" class="invvv">
                                                                    <div class="">
                                                                        <div class="col-12">
                                                                            <div class="card">
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="student Name">Date<span class="text-danger">*</span></label>
                                                                                            <input type="text" id="humanfd-datepicker" class="form-control" placeholder="MM/DD/YYYY">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="student Name">Payment
                                                                                                Status<span class="text-danger">*</span></label>
                                                                                            <select id="tudent Name" class="form-control" name="class_id">
                                                                                                <option value="">
                                                                                                    Choose
                                                                                                    Payment
                                                                                                    Status
                                                                                                </option>
                                                                                                <option value="">
                                                                                                    Waived
                                                                                                </option>
                                                                                                <option value="">
                                                                                                    Paid
                                                                                                </option>
                                                                                                <option value="">
                                                                                                    Not
                                                                                                    Paid
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="form-group text-right m-b-0">
                                                                                    <button class="btn btn-primary waves-effect waves-light" type="Save">
                                                                                        Save
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!--  Start Student Fee Semester -->
                                                                <div id="content_15" class="invvv">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <div class="row">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-bordered table-hover">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>
                                                                                                        </th>
                                                                                                        <th>Date
                                                                                                        </th>
                                                                                                        <th>Semester
                                                                                                        </th>
                                                                                                        <th>Payment
                                                                                                            Status
                                                                                                        </th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>

                                                                                                    <tr>
                                                                                                        <td><input type="checkbox" id="semester1" />
                                                                                                        </td>
                                                                                                        <td><input type="text" disabled class="form-control inputDateFld1" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>
                                                                                                        <td>Semester
                                                                                                            1
                                                                                                        </td>
                                                                                                        <td><select id="student Name" disabled class="form-control dropDwn1" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>

                                                                                                        <td><input type="checkbox" id="semester2" />
                                                                                                        </td>
                                                                                                        <td><input type="text" disabled class="form-control inputDateFld2" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>
                                                                                                        <td>Semester
                                                                                                            2
                                                                                                        </td>
                                                                                                        <td><select id="student Name" disabled class="form-control dropDwn2" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>

                                                                                                        <td><input type="checkbox" id="semester3" />
                                                                                                        </td>
                                                                                                        <td><input type="text" disabled class="form-control inputDateFld3" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>
                                                                                                        <td>Semester
                                                                                                            3
                                                                                                        </td>
                                                                                                        <td><select id="student Name" disabled class="form-control dropDwn3" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>


                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-group text-right m-b-0">
                                                                                        <button class="btn btn-primary waves-effect waves-light" type="Save">Save</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--  End Student Fee Semester -->

                                                                <div id="content_16" class="invvv">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <div class="row">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-hover table-bordered table-centered mb-0">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th style="width: 20px;">
                                                                                                            <input type="checkbox">
                                                                                                        <th>Date
                                                                                                        </th>
                                                                                                        <th>Month
                                                                                                        </th>
                                                                                                        <th>Payment
                                                                                                            Status
                                                                                                        </th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>
                                                                                                        <td>Jan
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>
                                                                                                        <td>Feb
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>March
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>April
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>May
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>June
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>July
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>Aug
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>Sep
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>Oct
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>Nov
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><input type="checkbox">
                                                                                                        </td>
                                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                        </td>

                                                                                                        <td>Dec
                                                                                                        </td>
                                                                                                        <td><select id="student Name" class="form-control" name="class_id">
                                                                                                                <option value="">
                                                                                                                    Choose
                                                                                                                    Payment
                                                                                                                    Status
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Waived
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                                <option value="">
                                                                                                                    Not
                                                                                                                    Paid
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    </thead>
                                                                                            </table>

                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-group text-right m-b-0">
                                                                                        <button class="btn btn-primary waves-effect waves-light" type="Save">
                                                                                            Save
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End PTA Fee-->




                                                        </div>
                                                    </div>



                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->
                </div>

            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<!-- container -->
@endsection
@section('scripts')

<script>
    document
        .getElementById('target')
        .addEventListener('change', function () {
            'use strict';
            var vis = document.querySelector('.vis'),
                target = document.getElementById(this.value);
            if (vis !== null) {
                vis.className = 'inv';
            }
            if (target !== null) {
                target.className = 'vis';
            }
        });
</script>	
<script>
    document
        .getElementById('targett')
        .addEventListener('change', function () {
            'use strict';
            var vis = document.querySelector('.vis'),
                target = document.getElementById(this.value);
            if (vis !== null) {
                vis.className = 'invv';
            }
            if (target !== null) {
                target.className = 'vis';
            }
        });
</script>				
<script>
    document
        .getElementById('targettt')
        .addEventListener('change', function () {
            'use strict';
            var vis = document.querySelector('.vis'),
                target = document.getElementById(this.value);
            if (vis !== null) {
                vis.className = 'invvv';
            }
            if (target !== null) {
                target.className = 'vis';
            }
        });
</script>				
    <script>
        $(function () {
            $(document).on('change', '#semester1', function () {
                if ($(this).prop('checked') == false) {
                    $('.inputDateFld1').prop('disabled', true);
                    $('.dropDwn1').prop('disabled', true);
                } else {
                    $('.inputDateFld1').prop('disabled', false);
                    $('.dropDwn1').prop('disabled', false);
                }

            });
        });
    </script>
    <script>
        $(function () {
            $(document).on('change', '#semester2', function () {
                if ($(this).prop('checked') == false) {
                    $('.inputDateFld2').prop('disabled', true);
                    $('.dropDwn2').prop('disabled', true);
                } else {
                    $('.inputDateFld2').prop('disabled', false);
                    $('.dropDwn2').prop('disabled', false);
                }

            });
        });
    </script>
    <script>
        $(function () {
            $(document).on('change', '#semester3', function () {
                if ($(this).prop('checked') == false) {
                    $('.inputDateFld3').prop('disabled', true);
                    $('.dropDwn3').prop('disabled', true);
                } else {
                    $('.inputDateFld3').prop('disabled', false);
                    $('.dropDwn3').prop('disabled', false);
                }

            });
        });
    </script>
        
    <script>
        var sectionByClass = "{{ config('constants.api.section_by_class') }}";
        var getStudentList = "{{ config('constants.api.get_student_details') }}";
    </script>

<script src="{{ asset('public/js/custom/fees.js') }}"></script>

@endsection