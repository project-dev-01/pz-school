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
                <h4 class="page-title">{{ __('messages.classroom') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid blue;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Classroom details
                            <h4>
                    </li>
                </ul><br>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="heard">Class name<span class="text-danger">*</span></label>
                                <select id="heard" class="form-control" required="">
                                    <option value="">class (A)</option>
                                    <option value="press">class (B)</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="heard">{{ __('messages.subject') }}<span class="text-danger">*</span></label>
                                <select id="heard" class="form-control" required="">
                                    <option value="">English</option>
                                    <option value="press">Maths</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="heard">Date<span class="text-danger">*</span></label>
                                <input type="text" class="form-control " value="<?php echo date('d-m-Y'); ?>" name="class_date" id="classDate" require="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="heard">Count Down<span class="text-danger">*</span></label>
                                <select id="heard" class="form-control" required="">
                                    <option value="">01:00 hours</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-3" id="top-header" style="border-right: 1px solid #26242436;">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class=" fas fa-users font-24"></i>
                                            <p class="text-muted mb-1">Average Attendance</p>
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
                                    <h6 class="text-uppercase"><span class="text-muted float-right">{{ __('messages.total_strength') }}</span></h6>
                                </div>

                            </div>
                        </div><!-- end col-->
                        <div class="col-lg-3" id="top-header" style="border-right: 1px solid #26242436;">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="fas fa-user-graduate font-24"></i>
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
                                    <h6 class="text-uppercase"><span class="text-muted float-right">48%
                                            of class</span></h6>
                                </div>

                            </div>
                        </div><!-- end col-->
                        <div class="col-lg-3" id="top-header" style="border-right: 1px solid #26242436;">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="  fas fa-user-tie  font-24"></i>
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
                                    <h6 class="text-uppercase"><span class="text-muted float-right">72%
                                            of class</span></h6>
                                </div>

                            </div>
                        </div><!-- end col-->
                        <div class="col-lg-3">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <i class="fas fa-chalkboard-teacher font-24"></i>
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
                                    <h6 class="text-uppercase"><span class="text-muted float-right">29%
                                            of class</span></h6>
                                </div>
                            </div> <!-- end card-box-->
                        </div>
                    </div><!-- end col-->
                    <hr>
                    <div class="row">
                        <div class="col-xl-12">
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
                                    <a href="#rp" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        Daily Report
                                    </a>
                                </li>
                            </ul>
                            <div class="card-box">
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="profile-b1">
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color:#59a2fe;color:white">
                                                                Fumio Kishida
                                                            </div>
                                                        </div> <!-- end card-box-->
                                                    </div> <!-- end col -->
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color:#59a2fe;color:white">
                                                                John Leo
                                                            </div>
                                                        </div> <!-- end card-box-->
                                                    </div> <!-- end col -->
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color:#59a2fe;color:white">
                                                                Williams mark
                                                            </div>
                                                        </div> <!-- end card-box-->
                                                    </div> <!-- end col -->
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color:#59a2fe;color:white">
                                                                Robert Frost
                                                            </div>
                                                        </div> <!-- end card-box-->
                                                    </div> <!-- end col -->
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color:#59a2fe;color:white">
                                                                Sylvia Plath
                                                            </div>
                                                        </div> <!-- end card-box-->
                                                    </div> <!-- end col -->
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color:#59a2fe;color:white">
                                                                Rudyard Kipling
                                                            </div>
                                                        </div> <!-- end card-box-->
                                                    </div> <!-- end col -->
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color:#59a2fe;color:white">
                                                                John Ashbery
                                                            </div>
                                                        </div> <!-- end card-box-->
                                                    </div> <!-- end col -->
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color:#59a2fe;color:white">
                                                                William Blake
                                                            </div>
                                                        </div> <!-- end card-box-->
                                                    </div> <!-- end col -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="home-b1">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <table data-toggle="table" data-page-size="5" data-buttons-class="xs btn-light" data-pagination="true" class="table table-striped table-nowrap custom-table mb-0 datatable ">
                                                        <thead>
                                                            <tr>
                                                                <th data-field="state" data-checkbox="true"></th>
                                                                <th data-field="id" data-switchable="false">Student Name
                                                                </th>
                                                                <th data-field="name">Attentance</th>
                                                                <th data-field="date">Remarks</th>
                                                                <th data-field="amount">Rating</th>
                                                                <th data-field="user-status">Short Test
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td></td>
                                                                <td>Fumio Kishida</td>
                                                                <td class="text-center">
                                                                    <div class="dropdown dropdown-action">
                                                                        <style>
                                                                            #aa:hover {
                                                                                text-decoration: underline;
                                                                            }
                                                                        </style>
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
                                                                <td> <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
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
                                                                <td> <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>John Leo</td>
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
                                                                <td> <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
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
                                                                <td> <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>Williams mark</td>
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
                                                                <td> <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
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
                                                                <td> <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div> <!-- end card-box-->
                                            </div> <!-- end col-->
                                        </div>
                                        <!-- end row -->
                                    </div>
                                    <div class="tab-pane" id="rp">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="heard">Report<span class="text-danger">*</span></label>
                                                <textarea class="form-control" id="product-description" rows="5" placeholder="Please enter description"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary waves-effect waves-light" type="Save">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end card-box-->
                        </div> <!-- end col -->

                    </div>
                    <!-- end row -->
                </div><br>

            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->

</div> <!-- container -->
@endsection