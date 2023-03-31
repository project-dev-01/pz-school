@extends('layouts.admin-layout')
@section('title','To Do List')
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
                <h4 class="page-title">{{ __('messages.to_do_list') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">To Do Task</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addToDoTask">Add To Do Task</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table mb-0" id="task-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Date & Time</th>
                                <th>Priority</th>
                                <th>Description</th>
                                <th>{{ __('messages.action') }}</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sports Day</td>
                                <td>Tommorrow 10am</td>
                                <td><span class="badge badge-soft-danger p-1">High</span></td>
                                <td>All Should wear sports dress</td>
                                <td>
                                    <div class="button-list">
                                        <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="" id=""><i class="fe-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="" id=""><i class="fe-trash-2"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
    <!--- end row -->
    @include('super_admin.task.add')
</div>
<!-- container -->
@endsection