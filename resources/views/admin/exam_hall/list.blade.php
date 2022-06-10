@extends('layouts.admin-layout')
@section('title','Exam Hall')
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.add_classes')}}">Add Class</a></li>
                    </ol>
                </div> -->
                <h4 class="page-title">Exam Hall List</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">Exam Hall List<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addExamHallModal">Add Hall</button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0" id="exam-hall-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Hall No</th>
                                    <th>No Of Seats</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
        <!--- end row -->
        @include('admin.exam_hall.add')
        @include('admin.exam_hall.edit')
    </div>
</div>
<!-- container -->
@endsection
@section('scripts')
<script>
    // examHall routes
    var examHallList = "{{ route('admin.exam_hall.list') }}";
    var examHallDetails = "{{ route('admin.exam_hall.details') }}";
    var examHallDelete = "{{ route('admin.exam_hall.delete') }}";
</script>
<script src="{{ asset('js/custom/exam_hall.js') }}"></script>
@endsection