@extends('layouts.admin-layout')
@section('title','Grade')
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
                <h4 class="page-title">Grade</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">Grade</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addGradeModal">Add Grade</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table dt-responsive nowrap w-100" id="grade-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Grade Category</th>
                                <th>Notes</th>
                                <th>Grade Name</th>
                                <th>Grade Point</th>
                                <th>Min Percentage</th>
                                <th>Max Percentage</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
    <!--- end row -->
    @include('admin.grade.add')
    @include('admin.grade.edit')

</div>
<!-- container -->
@endsection
@section('scripts')
<script>
// grade routes
    var gradeList = "{{ route('admin.grade.list') }}";
    var gradeDetails = "{{ route('admin.grade.details') }}";
    var gradeDelete = "{{ route('admin.grade.delete') }}";
</script>
<script src="{{ asset('public/js/custom/grade.js') }}"></script>
@endsection
