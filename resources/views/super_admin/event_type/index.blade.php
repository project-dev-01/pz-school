@extends('layouts.admin-layout')
@section('title','Event Type')
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
                <h4 class="page-title">Event Types</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">Event Type</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addEventType">Add Event Type</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table w-100 nowrap" id="event-type-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Branch</th>
                                <th>Event Type Name</th>
                                <th>Action</th>
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
    @include('super_admin.event_type.add')
    @include('super_admin.event_type.edit')
</div>
<!-- container -->
@endsection