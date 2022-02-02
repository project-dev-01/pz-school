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
                <h4 class="page-title">Classroom</h4>
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
								<input type="text" id="basic-timepicker" class="form-control" placeholder="01:00:00" disabled>
                                
                            </div>
                        </div>
                    </div>
                    <hr>
					
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
											</div></div><!-- end col-->
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
                            </ul><br>
                            <div class="card-box">
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="profile-b1">
									<div class="row">
									<div class="col-md-9"></div>								
									 <div class="col-md-3">
                                            <a href="javascript: void(0);" class="text-reset mb-2 d-block">
                                               <i class='fas fa-square-full' style='font-size:20px;color:#59a2fe'></i>
											   <span class="mb-0 mt-1">Present</span>
												 <i class='fas fa-square-full' style='font-size:20px;color:grey'></i>
												 <span class="mb-0 mt-1">Absent</span>
												<i class='fas fa-square-full' style='font-size:20px;color:#e9e94b'></i>
												<span class="mb-0 mt-1">Late</span>
                                            </a>
                                        </div>
										</div>
                                        <div class="col-md-12">										
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color:#59a2fe;color:white;text-align:center">
                                                                William
                                                            </div>
                                                        </div> <!-- end card-box-->
                                                    </div> <!-- end col -->
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color:#e9e94b;color:white;text-align:center">
                                                                James
                                                            </div>
                                                        </div> <!-- end card-box-->
                                                    </div> <!-- end col -->
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color:#59a2fe;color:white;text-align:center">
                                                                Benjamin
                                                            </div>
                                                        </div> <!-- end card-box-->
                                                    </div> <!-- end col -->
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color:#59a2fe;color:white;text-align:center">
                                                                Lucas
                                                            </div>
                                                        </div> <!-- end card-box-->
                                                    </div> <!-- end col -->
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color:#59a2fe;color:white;text-align:center">
                                                                Charlotte
                                                            </div>
                                                        </div> <!-- end card-box-->
                                                    </div> <!-- end col -->
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color:grey;color:white;text-align:center">
                                                                Sophia
                                                            </div>
                                                        </div> <!-- end card-box-->
                                                    </div> <!-- end col -->
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color:#59a2fe;color:white;text-align:center">
                                                                Amelia
                                                            </div>
                                                        </div> <!-- end card-box-->
                                                    </div> <!-- end col -->
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color:#e9e94b;color:white;text-align:center">
                                                                Isabella
                                                            </div>
                                                        </div> <!-- end card-box-->
                                                    </div> <!-- end col -->
													 <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color:#e9e94b;color:white;text-align:center">
                                                                Mia
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
                                                                <td>William</td>
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
                                                                <td>James</td>
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
                                                                <td> <input type="text" class="form-control" value="Heavy Traffic" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
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
                                                                <td>Benjamin</td>
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
                                                                <td>Lucas</td>
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
                                                                <td>Charlotte</td>
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
                                                                <td>Sophia</td>
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
                                                                <td> <input type="text" class="form-control" value="Fever" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
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
                                                                <td>Amelia</td>
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
                                                                <td>Isabella</td>
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
                                                                <td> <input type="text" class="form-control" value="missing books" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
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
                                                                <td>Mia</td>
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
                                                                <td> <input type="text" class="form-control" value="Bus Breakdown" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
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
                                                                <td> <input type="text" class="form-control"  id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
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
                                                <textarea class="form-control" id="product-description" rows="5" placeholder="Enter Your Notes">Your progress for this term is excellent</textarea>
                                            </div>
											 <div class="row">
											 <div class="col-md-6">
												<div class="form-group">
													<label for="heard">Last Updated: 29-01-2022  12:00:00 AM</label>
												</div>
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