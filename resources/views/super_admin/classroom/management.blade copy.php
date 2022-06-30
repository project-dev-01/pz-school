@extends('layouts.admin-layout')
@section('title','Class Room Management')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
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
        <div class="col-xl-6">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4  class="nav-link">
                            Classroom details
                        <h4>
                    </li>
                </ul><br>								
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="heard">Shifts<span class="text-danger">*</span></label>
                                <select id="heard" class="form-control" required="">
                                    <option value="">Morning</option>
                                    <option value="press">Evening</option>                                               
                                </select>
                            </div>
                        </div>		
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Date<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="far fa-calendar-alt"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>				
                    </div>
                    <div class="col-md-12">	
                        <div class="card">										
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header" style="background-color:#59a2fe;color:white">
                                            Student-1
                                        </div>												   
                                    </div> <!-- end card-box-->
                                </div> <!-- end col -->
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header" style="background-color:#59a2fe;color:white">
                                            Student-2
                                        </div>												   
                                    </div> <!-- end card-box-->
                                </div> <!-- end col -->
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header" style="background-color:#59a2fe;color:white">
                                            Student-3
                                        </div>												   
                                    </div> <!-- end card-box-->
                                </div> <!-- end col -->
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header" style="background-color:#59a2fe;color:white">
                                            Student-1
                                        </div>												   
                                    </div> <!-- end card-box-->
                                </div> <!-- end col -->
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header" style="background-color:#59a2fe;color:white">
                                            Student-2
                                        </div>												   
                                    </div> <!-- end card-box-->
                                </div> <!-- end col -->
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header" style="background-color:#59a2fe;color:white">
                                            Student-3
                                        </div>												   
                                    </div> <!-- end card-box-->
                                </div> <!-- end col -->
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header" style="background-color:#59a2fe;color:white">
                                            Student-1
                                        </div>												   
                                    </div> <!-- end card-box-->
                                </div> <!-- end col -->
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header" style="background-color:#59a2fe;color:white">
                                            Student-2
                                        </div>												   
                                    </div> <!-- end card-box-->
                                </div> <!-- end col -->
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header" style="background-color:#59a2fe;color:white">
                                            Student-3
                                        </div>												   
                                    </div> <!-- end card-box-->
                                </div> <!-- end col -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" >
                        <div class="card">
                            <div class="card-body">										                                
                                <table data-toggle="table"
                                data-page-size="5"
                                data-buttons-class="xs btn-light"
                                data-pagination="true" class="table-bordered ">
                                    <thead class="thead-light">
                                        <tr>
                                            <th data-field="state" data-checkbox="true"></th>
                                            <th data-field="id" data-switchable="false">Student Name</th>
                                            <th data-field="name">Attentance</th>
                                            <th data-field="date">Remarks</th>
                                            <th data-field="amount">Rating</th>
                                            <th data-field="user-status">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Student-1</td>
                                            <td>Isidra</td>
                                            <td>Boudreaux</td>
                                            <td> <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                                        required>
                                            </td>
                                            <td> <div class="text-warning mb-2 font-13">
                                                    <i class="far fa-star" style='font-size:20px;color:green'></i>											
                                                    <i class="far fa-star text-danger" style='font-size:20px;'></i>											
                                                    <i class="far fa-heart" style='font-size:20px;'></i>
                                                    <i class='far fa-grin' style='font-size:20px;color:golden'></i>
                                                    <i class='far fa-angry' style='font-size:20px;color:red'></i> 
                                                    <i class=' far fa-thumbs-up' style='font-size:20px;color:blue'></i>													
                                                <i class='far fa-thumbs-down' style='font-size:20px;color:red'></i>
                                                </div>
                                                </td>
                                            <td><span class="badge badge-success">Good</span></td>
                                        </tr>
                                        <tr>
                                            <td>Student-2</td>
                                            <td>Isidra</td>
                                            <td>Boudreaux</td>
                                            <td> <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                                        required>
                                            </td>
                                        <td> <div class="text-warning mb-2 font-13">
                                                    <i class="far fa-star" style='font-size:20px;color:green'></i>											
                                                    <i class="far fa-star text-danger" style='font-size:20px;'></i>											
                                                    <i class="far fa-heart" style='font-size:20px;'></i>
                                                    <i class='far fa-grin' style='font-size:20px;color:golden'></i>
                                                    <i class='far fa-angry' style='font-size:20px;color:red'></i> 
                                                    <i class=' far fa-thumbs-up' style='font-size:20px;color:blue'></i>													
                                                <i class='far fa-thumbs-down' style='font-size:20px;color:red'></i>
                                                </div>
                                                </td>
                                            <td><span class="badge badge-success">Good</span></td>
                                        </tr>
                                        <tr>
                                            <td>Student-3</td>
                                            <td>Isidra</td>
                                            <td>Boudreaux</td>
                                            <td> <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                                        required>
                                            </td>
                                            <td> <div class="text-warning mb-2 font-13">
                                                    <i class="far fa-star" style='font-size:20px;color:green'></i>											
                                                    <i class="far fa-star text-danger" style='font-size:20px;'></i>											
                                                    <i class="far fa-heart" style='font-size:20px;'></i>
                                                    <i class='far fa-grin' style='font-size:20px;color:golden'></i>
                                                    <i class='far fa-angry' style='font-size:20px;color:red'></i> 
                                                    <i class=' far fa-thumbs-up' style='font-size:20px;color:blue'></i>													
                                                <i class='far fa-thumbs-down' style='font-size:20px;color:red'></i>
                                                </div>
                                                </td>
                                            <td><span class="badge badge-success">Good</span></td>
                                        </tr>
                                        <tr>
                                            <td>Student-4</td>
                                            <td>Isidra</td>
                                            <td>Boudreaux</td>
                                            <td> <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                                        required>
                                            </td>
                                            <td> <div class="text-warning mb-2 font-13">
                                                    <i class="far fa-star" style='font-size:20px;color:green'></i>											
                                                    <i class="far fa-star text-danger" style='font-size:20px;'></i>											
                                                    <i class="far fa-heart" style='font-size:20px;'></i>
                                                    <i class='far fa-grin' style='font-size:20px;color:golden'></i>
                                                    <i class='far fa-angry' style='font-size:20px;color:red'></i> 
                                                    <i class=' far fa-thumbs-up' style='font-size:20px;color:blue'></i>													
                                                <i class='far fa-thumbs-down' style='font-size:20px;color:red'></i>
                                                </div>
                                                </td>
                                            <td><span class="badge badge-success">Good</span></td>
                                        </tr>
                                        <tr>
                                            <td>Student-5</td>
                                            <td>Isidra</td>
                                            <td>Boudreaux</td>
                                            <td> <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend"
                                                        required>
                                            </td>
                                            <td> <div class="text-warning mb-2 font-13">
                                                    <i class="far fa-star" style='font-size:20px;color:green'></i>											
                                                    <i class="far fa-star text-danger" style='font-size:20px;'></i>											
                                                    <i class="far fa-heart" style='font-size:20px;'></i>
                                                    <i class='far fa-grin' style='font-size:20px;color:golden'></i>
                                                    <i class='far fa-angry' style='font-size:20px;color:red'></i> 
                                                    <i class=' far fa-thumbs-up' style='font-size:20px;color:blue'></i>													
                                                <i class='far fa-thumbs-down' style='font-size:20px;color:red'></i>
                                                </div>
                                                </td>
                                            <td><span class="badge badge-success">Good</span></td>
                                        </tr>
                                
                                    </tbody>
                                </table>
                            </div> <!-- end card-box-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->
                </div><br>
                <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary waves-effect waves-light" type="Save">
                        Save
                    </button>
                    <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                        Cancel
                    </button>-->
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->

</div> <!-- container -->
@endsection