@extends('layouts.admin-layout')
@section('title','Student Leave Details')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

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
                    <h4 class="page-title">Student Leave Details</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <ul class="nav nav-tabs" >
                        <li class="nav-item">
                            <h4 class="nav-link">
                                <span data-feather="" class="icon-dual" id="span-parent"></span> Student Leave Details List
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <form id="studentLeaveList" data-parsley-validate="" autocomplete="off">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="changeClassName">Standard<span class="text-danger">*</span></label>
                                        <select id="changeClassName" class="form-control" name="class_id">
                                            <option value="">Select Standard</option>
                                            @forelse ($classes as $class)
                                            <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sectionID">Class<span class="text-danger">*</span></label>
                                        <select id="sectionID" class="form-control" name="section_id">
                                            <option value="">Select Class</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                    Filter
                                </button>
                            </div>
                        </form>


                    </div> <!-- end card-body -->
                </div>
                <div class="card studentLeaveShow" style="display: none;">
                    <ul class="nav nav-tabs" >
                        <li class="nav-item">
                            <h4 class="nav-link">
                                <span data-feather="" class="icon-dual" id="span-parent"></span> Student Leave Details List
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table w-100 nowrap" id="student-leave-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Standard</th>
                                        <th>Class</th>
                                        <th>Leave from</th>
                                        <th>To Leave</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                        <th>Document</th>
                                        <th>Teacher Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->

    <!-- end row -->
</div> <!-- container -->
@endsection
@section('scripts')
<script>
    var sectionByClassUrl = "{{ config('constants.api.section_by_class') }}";
    var allStutdentLeaveList = "{{ config('constants.api.get_all_student_leaves') }}";
    var studentDocUrl = "{{ asset('teacher/student-leaves/') }}";
    // default image test
    var defaultImg = "{{ asset('images/users/default.jpg') }}";
</script>
<script src="{{ asset('js/custom/student_leave_list.js') }}"></script>
@endsection