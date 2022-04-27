@extends('layouts.admin-layout')
@section('title','Assign Subjects Teacher')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
                <h4 class="page-title">Assign Subjects Teacher</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">Assign Subjects Teacher</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addAssignClassSubjectModal">Add</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table mb-0" id="class-assign-subjects-teacher-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Class Name</th>
                                <th>Section Name</th>
                                <th>Subject Name</th>
                                <th>Teacher Name</th>
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
    @include('admin.assign_class_subject_teacher.add')
    @include('admin.assign_class_subject_teacher.edit')

</div>
<!-- container -->
@endsection
@section('scripts')
<script>
    var classAssignTeacherAddUrl = "{{ config('constants.api.teacher_assign_sub_add') }}";
    var classAssignTeacherGetRowUrl = "{{ config('constants.api.teacher_assign_sub_details') }}";
    var classAssignTeacherUpdateUrl = "{{ config('constants.api.teacher_assign_sub_update') }}";
    var classAssignTeacherDeleteUrl = "{{ config('constants.api.teacher_assign_sub_delete') }}";

    var sectionByClassUrl = "{{ config('constants.api.section_by_class') }}";

    var classAssignTeacherSubList = "{{ route('admin.teacher_assign_subject.list') }}";
</script>
<script src="{{ asset('js/custom/assign_class_subject_teacher.js') }}"></script>
@endsection