@extends('layouts.admin-layout')
@section('title','Floor')
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
                <h4 class="page-title">Floor</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Floor<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" id="addHostelFloor" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addHostelFloorModal">Add</button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="hostel-floor-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Floor Name</th>
                                    <th>Block</th>
                                    <th>Floor Warden</th>
                                    <th>Total Room</th>
                                    <th>Floor Leader</th>
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
        @include('admin.hostel_floor.add')
        @include('admin.hostel_floor.edit')
    </div>
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //hostelFloor floors
    var hostelFloorList = "{{ route('admin.hostel_floor.list') }}";
    var hostelFloorDetails = "{{ route('admin.hostel_floor.details') }}";
    var hostelFloorDelete = "{{ route('admin.hostel_floor.delete') }}";
</script>

<script src="{{ asset('public/js/custom/hostel_floor.js') }}"></script>
<script src="{{ asset('public/js/pages/form-advanced.init.js') }}"></script>

@endsection