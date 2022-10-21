@extends('layouts.admin-layout')
@section('title','Assign Class Subjects')
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
                <h4 class="page-title">Assign Class Subjects</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Assign Class Subjects<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addAssignClassSubjectModal">Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="class-assign-subjects-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Class Name</th>
                                    <th>Section Name</th>
                                    <th>Subject Name</th>
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
        @include('admin.assign_class_subject.add')
        @include('admin.assign_class_subject.edit')

    </div>
</div>
<!-- container -->
@endsection
@section('scripts')
<script>
    var classAssignAddUrl = "{{ config('constants.api.class_assign_add') }}";
    var classAssignGetRowUrl = "{{ config('constants.api.class_assign_details') }}";
    var classAssignUpdateUrl = "{{ config('constants.api.class_assign_update') }}";
    var classAssignDeleteUrl = "{{ config('constants.api.class_assign_delete') }}";

    var sectionByClassUrl = "{{ config('constants.api.section_by_class') }}";

    var classAssignSubList = "{{ route('admin.class_assign_subject.list') }}";
    var academic_session_id = "{{ Session::get('academic_session_id') }}";
</script>
<script src="{{ asset('public/js/custom/assign_class_subject.js') }}"></script>
@endsection