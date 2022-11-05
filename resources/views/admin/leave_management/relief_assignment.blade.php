@extends('layouts.admin-layout')
@section('title','Relief Assignment')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Relief Assignment</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> Leave List
                            <h4>
                    </li>
                </ul><br>

                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table id="releive-all-leave-list" class="table nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee Name</th>
                                        <th>Leave Type</th>
                                        <th>No.Of.Days</th>
                                        <th>From Leave</th>
                                        <th>To Leave</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
        @include('admin.leave_management.relief_details')
    </div>
    <!-- container -->
    @endsection
    @section('scripts')
    <script>
        var AllLeaveList = "{{ route('admin.relief_assignment.list') }}";
        var getSubjectsByStaffIdWithDateUrl = "{{ config('constants.api.get_subjects_by_staff_id_with_date') }}";
        var reliefAssignmentOtherTeacher = "{{ config('constants.api.relief_assignment_other_teacher') }}";
        var getStaffListByTimeslot = "{{ config('constants.api.get_staff_list_by_timeslot') }}";
    </script>
    <script src="{{ asset('public/js/custom/relief_assignment.js') }}"></script>
    @endsection