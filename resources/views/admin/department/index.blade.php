@extends('layouts.admin-layout')
@section('title','Department')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <!-- <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">List</li>
                    </ol> -->
                </div>
                <h4 class="page-title">Department</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">Department<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addDepartmentModal">Add Department</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0" id="department-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Department Name</th>
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
        @include('admin.department.add')
        @include('admin.department.edit')
    </div>
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //department routes
    var departmentList = "{{ route('admin.department.list') }}";
    var departmentDetails = "{{ route('admin.department.details') }}";
    var departmentDelete = "{{ route('admin.department.delete') }}";
</script>

<script src="{{ asset('js/custom/department.js') }}"></script>

@endsection