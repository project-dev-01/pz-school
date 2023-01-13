@extends('layouts.admin-layout')
@section('title','Fees Allocation')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Fees Allocation Details</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> Fees Allocation<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="feesAllocation" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_id">Grade<span class="text-danger">*</span></label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">Select Grade</option>
                                        @forelse ($classnames as $class)
                                        <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="section_id">Class<span class="text-danger">*</span></label>
                                    <select id="section_id" class="form-control" name="section_id">
                                        <option value="">Select Class</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="group_id">Fees Group<span class="text-danger">*</span></label>
                                    <select id="group_id" class="form-control" name="group_id">
                                        <option value="">Select Fees Group</option>
                                        @forelse ($fees_group_list as $group_list)
                                        <option value="{{ $group_list['id'] }}">{{ $group_list['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                    Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Student Details -->

    <!-- Student Fees Allocation Details List-->
    <div class="row">
        <div class="col-xl-12 col-sm-12 col-md-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Student Fees Allocation Details List<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap" id="">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Grade</th>
                                    <th>Class</th>
                                    <th>Student Name</th>
                                    <th>Payment Status</th>
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
    </div>
    <!-- End Student Fees Allocation Details List-->
</div><!-- /.modal-dialog -->
<!-- container -->
@endsection
@section('scripts')
<script>
    var sectionByClass = "{{ config('constants.api.section_by_class') }}";
    var getStudentList = "{{ config('constants.api.get_student_details') }}";
</script>
<script src="{{ asset('public/js/custom/fees_allocation.js') }}"></script>
@endsection