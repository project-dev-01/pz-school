@extends('layouts.admin-layout')
@section('title','Staff Leave Assign')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <!-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">List</li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.add_classes')}}">Add Class</a></li>
                    </ol>
                </div> -->
                <h4 class="page-title">Staff Leave Assign</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> Staff Leave Assign
                            <h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addStaffLeaveAssignModal">Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="staff-leave-assign-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Staff Name </th>
                                    <th>Leave Type </th>
                                    <th>Leave Days </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
    <!--- end row -->
    @include('admin.staff_leave_assign.add')
    @include('admin.staff_leave_assign.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //staff Leave Assign routes
    var staffLeaveAssignList = "{{ route('admin.staff_leave_assign.list') }}";
    var staffLeaveAssignDetails = "{{ route('admin.staff_leave_assign.details') }}";
    var staffLeaveAssignDelete = "{{ route('admin.staff_leave_assign.delete') }}";
</script>

<script src="{{ asset('public/js/custom/staff_leave_assign.js') }}"></script>

@endsection