@extends('layouts.admin-layout')
@section('title','Employee')
@section('content')
<!-- Start Content-->
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
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table w-100 nowrap" id="employee-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee Name</th>
                                        <th>Email</th>
                                        <th>Mobile No</th>
                                        <th>Date of Birth</th>
                                        <th>Joining Date</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Present Address</th>
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
</script>
<script src="{{ asset('js/custom/employee.js') }}"></script>
@endsection
