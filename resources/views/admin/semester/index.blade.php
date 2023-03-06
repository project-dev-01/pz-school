@extends('layouts.admin-layout')
@section('title','Semester')
@section('content')
<style>
    .datepicker {
      z-index: 1600 !important; /* has to be larger than 1050 */
    }
</style>
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
                <h4 class="page-title">Semester</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">Semester<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addSemesterModal">Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="semester-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Semester Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Year</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
    <!--- end row -->
    @include('admin.semester.add')
    @include('admin.semester.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //semester routes
    var semesterList = "{{ route('admin.semester.list') }}";
    var semesterDetails = "{{ route('admin.semester.details') }}";
    var semesterDelete = "{{ route('admin.semester.delete') }}";
</script>

<script src="{{ asset('public/js/custom/semester.js') }}"></script>

@endsection