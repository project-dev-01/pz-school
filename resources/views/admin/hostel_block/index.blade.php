@extends('layouts.admin-layout')
@section('title','Block')
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
                <h4 class="page-title">Block</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Block<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addHostelBlockModal">Add Block</button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="hostel-block-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Block Name</th>
                                    <th>Block Warden</th>
                                    <th>Total Floor</th>
                                    <th>Block Leader</th>
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
        @include('admin.hostel_block.add')
        @include('admin.hostel_block.edit')
    </div>
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //hostelBlock blocks
    var hostelBlockList = "{{ route('admin.hostel_block.list') }}";
    var hostelBlockDetails = "{{ route('admin.hostel_block.details') }}";
    var hostelBlockDelete = "{{ route('admin.hostel_block.delete') }}";
</script>

<script src="{{ asset('public/js/custom/hostel_block.js') }}"></script>

@endsection