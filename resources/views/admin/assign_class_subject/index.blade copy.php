@extends('layouts.admin-layout')
@section('title','Assign Grade Subjects')
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
                <h4 class="page-title">Assign Grade Subjects</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Assign Grade Subjects<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="student Name">Grade<span class="text-danger">*</span></label>
                                <select id="student Name" class="form-control" name="class_id">
                                    <option value="">Select Grade</option>
                                    <option value="">Tingkatan 1</option>
                                    <option value="">Tingkatan 2</option>
                                    <option value="">Tingkatan 3</option>
                                    <option value="">Tingkatan 4</option>
                                    <option value="">Tingkatan 5</option>
                                    <option value="">Tingkatan 6</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="student Name">Class<span class="text-danger">*</span></label>
                                <select id="student Name" class="form-control" name="class_id">
                                    <option value="">Select Class</option>
                                    <option value="">Unggul</option>
                                    <option value="">Wawasan</option>
                                    <option value="">Iltizam</option>
                                    <option value="">Cemerlang</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="student Name">Subject<span class="text-danger">*</span></label>
                                <select id="student Name" class="form-control" name="class_id">
                                    <option value="">Select Subject</option>
                                    <option value="">Pengurusan Kelas</option>
                                    <option value="">Pendidikan Jasmani & Pendidikan Kesihatan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                            Filter
                        </button>
                    </div>
                </div>
            </div>

            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Assign Grade Subjects List<h4>
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
                                    <th>Grade</th>
                                    <th>Class</th>
                                    <th>Subject</th>
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