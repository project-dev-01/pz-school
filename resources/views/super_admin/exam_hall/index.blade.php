@extends('layouts.admin-layout')
@section('title','Exam Halls')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">List</li>
                        <!-- <li class="breadcrumb-item"><a href="{{ route('super_admin.add_classes')}}">Add Class</a></li> -->
                    </ol>
                </div>
                <h4 class="page-title">Exam Hall List</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">Exam Hall List</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('super_admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addClassModal">Add Hall</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table mb-0" id="exam-Hall">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Branch</th>
                                <th>Hall No</th>
                                <th>No Of Seats</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Malaysia</td>
                                <td>101</td>
                                <td>30</td>
                                <td>
                                    <div class="button-list">
                                        <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="" id="viewEventBtn">View</a>
                                        <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="" id="deleteEventBtn">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Malaysia</td>
                                <td>103</td>
                                <td>20</td>
                                <td>
                                    <div class="button-list">
                                        <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="" id="viewEventBtn">View</a>
                                        <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="" id="deleteEventBtn">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Malaysia</td>
                                <td>106</td>
                                <td>30</td>
                                <td>
                                    <div class="button-list">
                                        <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="" id="viewEventBtn">View</a>
                                        <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="" id="deleteEventBtn">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Malaysia</td>
                                <td>115</td>
                                <td>50</td>
                                <td>
                                    <div class="button-list">
                                        <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="" id="viewEventBtn">View</a>
                                        <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="" id="deleteEventBtn">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Malaysia</td>
                                <td>118</td>
                                <td>30</td>
                                <td>
                                    <div class="button-list">
                                        <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="" id="viewEventBtn">View</a>
                                        <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="" id="deleteEventBtn">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
    <!--- end row -->

</div>
<!-- container -->
@endsection