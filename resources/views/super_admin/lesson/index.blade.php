@extends('layouts.admin-layout')
@section('title','Assign Time Table')
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
                    </ol>
                </div>
                <h4 class="page-title">Assign Time Table</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">Time Table List</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#timeTableAdd">Assign Time Table</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table w-100 nowrap" id="task-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Standard</th>
                                <th>{{ __('messages.class') }}</th>
                                <th>{{ __('messages.teacher') }}</th>
                                <th>Week Days</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>I</td>
                                <td>A</td>
                                <td>Starc</td>
                                <td>2</td>
                                <td>08:00</td>
                                <td>08:30</td>
                                <td>
                                    <div class="button-list">
                                        <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="" id=""><i class="fe-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="" id=""><i class="fe-trash-2"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>IV</td>
                                <td>E</td>
                                <td>Starc</td>
                                <td>2</td>
                                <td>11:00</td>
                                <td>11:30</td>
                                <td>
                                    <div class="button-list">
                                        <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="" id=""><i class="fe-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="" id=""><i class="fe-trash-2"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>X</td>
                                <td>C</td>
                                <td>Smith</td>
                                <td>5</td>
                                <td>09:00</td>
                                <td>10:00</td>
                                <td>
                                    <div class="button-list">
                                        <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="" id=""><i class="fe-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="" id=""><i class="fe-trash-2"></i></a>
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
    @include('super_admin.lesson.add')
</div>
<!-- container -->
@endsection