@extends('layouts.admin-layout')
@section('title','Employee')
@section('content')
<!-- Start Content-->
<style>
    /* table css*/
    table.dataTable td,
    table.dataTable th {
        font-family: Open Sans !important;
        color: #3A4265 !important;
        font-weight: 500 !important;
    }

    .form-control-light {
        background-color: white !important;
        border: 1px solid #ECECEC !important;
    }
</style>
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Datatables</li> -->
                    </ol>
                </div>
                <h4 class="page-title">Employee List</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">Employee List<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap" id="employee-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Short Name</th>
                                    <th>Grade</th>
                                    <th>Stream Type</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Email</th>
                                    <th>Mobile No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div> <!-- end table-responsive-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->

    <!-- end row -->
</div> <!-- container -->
@endsection

@section('scripts')
<script>
    // employee
    var employeeList = "{{ route('admin.employee.list') }}";
    var employeeDelete = "{{ route('admin.employee.delete') }}";
    var employeeImg = "{{ asset('public/images/staffs/') }}";
    // default image test
    var defaultImg = "{{ asset('public/images/users/default.jpg') }}";
</script>
<script src="{{ asset('public/js/custom/employee.js') }}"></script>
@endsection