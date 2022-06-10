@extends('layouts.admin-layout')
@section('title','Assign Teacher')
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
                    </ol>
                </div> -->
                <h4 class="page-title">Assign Teacher</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Section Allocation<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addAssignTeachernModal">Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="assign-class-teacher-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Class Name</th>
                                    <th>Section Name</th>
                                    <th>Teacher Name</th>
                                    <th>Type</th>
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
    <!--- end row -->
    @include('admin.assign_teacher.add')
    @include('admin.assign_teacher.edit')
</div>
<!-- container -->
@endsection
@section('scripts')
<script>
    var assignTeacherAddUrl = "{{ config('constants.api.assign_teacher_add') }}";
    var assignTeacherDetailsUrl = "{{ config('constants.api.assign_teacher_details') }}";
    var assignTeacherUpdateUrl = "{{ config('constants.api.assign_teacher_update') }}";
    var assignTeacherDeleteUrl = "{{ config('constants.api.assign_teacher_delete') }}";
    var sectionByClassUrl = "{{ config('constants.api.section_by_class') }}";

    var assignTeacherList = "{{ route('admin.assign_teacher.list') }}";
</script>
<script src="{{ asset('js/custom/teacher-allocation.js') }}"></script>
@endsection