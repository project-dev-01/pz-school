@extends('layouts.admin-layout')
@section('title','Subjects')
@section('css')
<link href="{{ asset('libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
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
                <h4 class="page-title">Subjects</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">Subjects</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addSubjectModal">Add Subject</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table mb-0" id="subjects-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subject Name</th>
                                <th>Short Name</th>
                                <th>Subject Code</th>
                                <th>Subject Type</th>
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
    @include('admin.subjects.add')
    @include('admin.subjects.edit')

</div>
<!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('js/pages/form-pickers.init.js') }}"></script>

<script>
    var subjectsAddUrl = "{{ config('constants.api.subject_add') }}";
    var subjectsGetRowUrl = "{{ config('constants.api.subject_details') }}";
    var subjectsUpdateUrl = "{{ config('constants.api.subject_update') }}";
    var subjectsDeleteUrl = "{{ config('constants.api.subject_delete') }}";

    var subjectsList = "{{ route('admin.subjects.list') }}";
</script>
<script src="{{ asset('js/custom/subjects.js') }}"></script>
@endsection