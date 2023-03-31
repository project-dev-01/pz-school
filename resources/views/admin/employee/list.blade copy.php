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
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form class="search-bar mb-3">
                                        <div class="position-relative">
                                            <input type="text" class="form-control form-control-light" placeholder="Search...">
                                            <span class="mdi mdi-magnify"></span>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-6">
                                    <div class="text-lg-right mt-3 mt-lg-0">
                                        <button type="button" class="btn btn-white waves-effect mr-1">
                                            <svg width="12" height="15" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.86686 6.4833L3.55019 1.16663H11.6669C11.9446 1.16663 12.1446 1.28885 12.2669 1.5333C12.3891 1.77774 12.3669 2.01107 12.2002 2.2333L8.86686 6.4833ZM11.7169 13.1L8.33353 9.71663V10.5C8.33353 10.8666 8.20308 11.1806 7.94219 11.442C7.68086 11.7029 7.36686 11.8333 7.00019 11.8333C6.63353 11.8333 6.31975 11.7029 6.05886 11.442C5.79753 11.1806 5.66686 10.8666 5.66686 10.5V7.16663L0.383529 1.7833C0.261306 1.64996 0.200195 1.49441 0.200195 1.31663C0.200195 1.13885 0.266862 0.983297 0.400195 0.849964C0.533529 0.71663 0.691751 0.649963 0.874862 0.649963C1.05842 0.649963 1.21686 0.71663 1.3502 0.849964L12.6669 12.1666C12.8002 12.3 12.8642 12.4555 12.8589 12.6333C12.8531 12.8111 12.7835 12.9666 12.6502 13.1C12.5169 13.2222 12.3613 13.2862 12.1835 13.292C12.0058 13.2973 11.8502 13.2333 11.7169 13.1Z" fill="#6FC6CC" />
                                            </svg>
                                            Exclude Data
                                        </button>
                                        <button type="button" class="btn btn-white waves-effect mr-1">
                                            <svg width="12" height="15" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.86686 6.4833L3.55019 1.16663H11.6669C11.9446 1.16663 12.1446 1.28885 12.2669 1.5333C12.3891 1.77774 12.3669 2.01107 12.2002 2.2333L8.86686 6.4833ZM11.7169 13.1L8.33353 9.71663V10.5C8.33353 10.8666 8.20308 11.1806 7.94219 11.442C7.68086 11.7029 7.36686 11.8333 7.00019 11.8333C6.63353 11.8333 6.31975 11.7029 6.05886 11.442C5.79753 11.1806 5.66686 10.8666 5.66686 10.5V7.16663L0.383529 1.7833C0.261306 1.64996 0.200195 1.49441 0.200195 1.31663C0.200195 1.13885 0.266862 0.983297 0.400195 0.849964C0.533529 0.71663 0.691751 0.649963 0.874862 0.649963C1.05842 0.649963 1.21686 0.71663 1.3502 0.849964L12.6669 12.1666C12.8002 12.3 12.8642 12.4555 12.8589 12.6333C12.8531 12.8111 12.7835 12.9666 12.6502 13.1C12.5169 13.2222 12.3613 13.2862 12.1835 13.292C12.0058 13.2973 11.8502 13.2333 11.7169 13.1Z" fill="#6FC6CC" />
                                            </svg>
                                            Sort Data</button>
                                        <button type="button" class="btn btn-white waves-effect mr-1">
                                            <svg width="12" height="15" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.00033 14.1667C1.63366 14.1667 1.31988 14.0362 1.05899 13.7753C0.797659 13.514 0.666992 13.2 0.666992 12.8333V5.38334C0.666992 5.20557 0.700326 5.03601 0.766992 4.87468C0.833659 4.71379 0.928103 4.57223 1.05033 4.45001L4.28366 1.21668C4.40588 1.09445 4.54744 1.00001 4.70833 0.933344C4.86966 0.866677 5.03921 0.833344 5.21699 0.833344H10.0003C10.367 0.833344 10.681 0.963788 10.9423 1.22468C11.2032 1.48601 11.3337 1.80001 11.3337 2.16668V12.8333C11.3337 13.2 11.2032 13.514 10.9423 13.7753C10.681 14.0362 10.367 14.1667 10.0003 14.1667H2.00033ZM6.00033 10.55C6.08921 10.55 6.17255 10.536 6.25033 10.508C6.3281 10.4805 6.40033 10.4333 6.46699 10.3667L8.21699 8.61668C8.33921 8.49445 8.40033 8.34445 8.40033 8.16668C8.40033 7.9889 8.33366 7.83334 8.20033 7.70001C8.0781 7.57779 7.92255 7.51379 7.73366 7.50801C7.54477 7.50268 7.38921 7.56668 7.26699 7.70001L6.66699 8.26668V6.16668C6.66699 5.97779 6.60321 5.81934 6.47566 5.69134C6.34766 5.56379 6.18921 5.50001 6.00033 5.50001C5.81144 5.50001 5.65321 5.56379 5.52566 5.69134C5.39766 5.81934 5.33366 5.97779 5.33366 6.16668V8.26668L4.73366 7.68334C4.60033 7.56112 4.44477 7.50001 4.26699 7.50001C4.08921 7.50001 3.93366 7.56668 3.80033 7.70001C3.6781 7.82223 3.61699 7.97779 3.61699 8.16668C3.61699 8.35557 3.6781 8.51112 3.80033 8.63334L5.53366 10.3667C5.60033 10.4333 5.67255 10.4805 5.75033 10.508C5.8281 10.536 5.91144 10.55 6.00033 10.55Z" fill="#6FC6CC" />
                                            </svg>
                                            {{ __('messages.download_csv') }}</button>
                                    </div>
                                </div><!-- end col-->
                            </div> <!-- end row -->
                        </div> <!-- end card-box -->
                    </div><!-- end col-->
                </div>
                <script>
                    $('#employee-table').DataTable({
                        "paging": false,
                        "searching": false,
                        "ordering": false
                    });
                </script>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered nowrap" data-mdb-paging="false" id="employee-table">
                            <thead style="background-color:#E9D528">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.name') }}</th>
                                    <th>Short Name</th>
                                    <th>{{ __('messages.grade') }}</th>
                                    <th>Stream Type</th>
                                    <th>Department</th>
                                    <th>{{ __('messages.designation') }}</th>
                                    <th>{{ __('messages.email') }}</th>
                                    <th>Mobile No</th>
                                    <th>{{ __('messages.action') }}</th>
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