@extends('layouts.admin-layout')
@section('title','Leave Approvel')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                        <span class="fas fa-stream" id="span-parent"></span>
                        List of Leaves
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="">
                        <div class="row">
                        <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>                                               
                                                <th class="text-center">S.no</th>
                                                <th class="text-center">Employee Name</th>
                                                <th class="text-center">Leave Date From</th>                                                
                                                <th class="text-center">No.Of.Days</th>
                                                <th class="text-center">Reason(s)</th>                                                
                                                <th class="text-center">Action</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>                                                
                                                <td>Arun kumar</td>
                                                <td class="text-center">02/01/2022</td>
                                                <td class="text-center">1</td>
                                                <td>Festival</td>                                                
                                                <td><div class="button-list">
                                <a href="" class="btn btn-success btn-sm waves-effect waves-light" data-toggle="tooltip" title="Approved"><i class="far fa-thumbs-up"></i></a>                                
                                <a href="" data-toggle="modal" data-target="#declineModel" class="btn btn-danger btn-sm waves-effect waves-light" data-toggle="tooltip" title="Decline"><i class="fas fa-eject"></i></a>
                                <a href="" data-toggle="modal" data-target="#leavedetails" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="tooltip" title="Open"><i class="fas fa-folder-open"></i></a>
                        </div></td> 
                                            </tr>
                                            
                                            <tr>
                                                <td class="text-center">2</td>                                                
                                                <td>Bala</td>
                                                <td class="text-center">10/12/2021</td>
                                                <td class="text-center">1</td>
                                                <td>Fever</td>                                                
                                                <td><div class="button-list">
                                <a href="" class="btn btn-success btn-sm waves-effect waves-light" data-toggle="tooltip" title="Approved"><i class="far fa-thumbs-up"></i></a>                                
                                <a href="" data-toggle="modal" data-target="#declineModel" class="btn btn-danger btn-sm waves-effect waves-light" data-toggle="tooltip" title="Decline"><i class="fas fa-eject"></i></a>
                                <a href="" data-toggle="modal" data-target="#leavedetails" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="tooltip" title="Open"><i class="fas fa-folder-open"></i></a>
                        </div></td>
                                            </tr>
                                            
                                            <tr>
                                                <td class="text-center">3</td>                                                
                                                <td>Haja</td>
                                                <td class="text-center">05/08/2021</td>
                                                <td class="text-center">3</td>
                                                <td>Festival</td>  
                                                <td><div class="button-list">
                                <a href="" class="btn btn-success btn-sm waves-effect waves-light" data-toggle="tooltip" title="Approved"><i class="far fa-thumbs-up"></i></a>                                
                                <a href="" data-toggle="modal" data-target="#declineModel" class="btn btn-danger btn-sm waves-effect waves-light" data-toggle="tooltip" title="Decline"><i class="fas fa-eject"></i></a>
                                <a href="" data-toggle="modal" data-target="#leavedetails" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="tooltip" title="Open"><i class="fas fa-folder-open"></i></a>
                               
                        </div></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">4</td>                                                
                                                <td>Mohan</td>
                                                <td class="text-center">05/05/2021</td>
                                                <td class="text-center">2</td>
                                                <td>Festival</td>  
                                                <td><div class="button-list">
                                <a href="" class="btn btn-success btn-sm waves-effect waves-light" data-toggle="tooltip" title="Approved"><i class="far fa-thumbs-up"></i></a>                                
                                <a href="" data-toggle="modal" data-target="#declineModel" class="btn btn-danger btn-sm waves-effect waves-light" data-toggle="tooltip" title="Decline"><i class="fas fa-eject"></i></a>
                                <a href="" data-toggle="modal" data-target="#leavedetails" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="tooltip" title="Open"><i class="fas fa-folder-open"></i></a>
                               
                        </div></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">5</td>                                                
                                                <td>Guna</td>
                                                <td class="text-center">05/04/2021</td>
                                                <td class="text-center">2</td>
                                                <td>Festival</td>  
                                                <td><div class="button-list">
                                <a href="" class="btn btn-success btn-sm waves-effect waves-light" data-toggle="tooltip" title="Approved"><i class="far fa-thumbs-up"></i></a>                                
                                <a href="" data-toggle="modal" data-target="#declineModel" class="btn btn-danger btn-sm waves-effect waves-light" data-toggle="tooltip" title="Decline"><i class="fas fa-eject"></i></a>
                                <a href="" data-toggle="modal" data-target="#leavedetails" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="tooltip" title="Open"><i class="fas fa-folder-open"></i></a>
                               
                        </div></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">6</td>                                                
                                                <td>Karthi</td>
                                                <td class="text-center">22/02/2021</td>
                                                <td class="text-center">2</td>
                                                <td>Festival</td>  
                                                <td><div class="button-list">
                                <a href="" class="btn btn-success btn-sm waves-effect waves-light" data-toggle="tooltip" title="Approved"><i class="far fa-thumbs-up"></i></a>                                
                                <a href="" data-toggle="modal" data-target="#declineModel" class="btn btn-danger btn-sm waves-effect waves-light" data-toggle="tooltip" title="Decline"><i class="fas fa-eject"></i></a>
                                <a href="" data-toggle="modal" data-target="#leavedetails" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="tooltip" title="Open"><i class="fas fa-folder-open"></i></a>
                               
                        </div></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">7</td>                                                
                                                <td>Kumar</td>
                                                <td class="text-center">10/01/2021</td>
                                                <td class="text-center">3</td>
                                                <td>Festival</td>  
                                                <td><div class="button-list">
                                <a href="" class="btn btn-success btn-sm waves-effect waves-light" data-toggle="tooltip" title="Approved"><i class="far fa-thumbs-up"></i></a>                                
                                <a href="" data-toggle="modal" data-target="#declineModel" class="btn btn-danger btn-sm waves-effect waves-light" data-toggle="tooltip" title="Decline"><i class="fas fa-eject"></i></a>
                                <a href="" data-toggle="modal" data-target="#leavedetails" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="tooltip" title="Open"><i class="fas fa-folder-open"></i></a>
                               
                        </div></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
        @include('super_admin.leave_management.leavedetailsmf')
    </div>
   <!-- end row -->   
   @include('super_admin.leave_management.declinemf')
</div> <!-- container -->

@endsection