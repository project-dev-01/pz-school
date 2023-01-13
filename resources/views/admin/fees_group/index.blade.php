@extends('layouts.admin-layout')
@section('title','Fees Group')
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
                <h4 class="page-title">Fees Group</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">Fees Group<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <a href="{{ route('admin.fees_group.create')}}" class="btn add-btn btn-rounded waves-effect waves-light"> Add</a>
                        <!-- <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addFeesGroupModal">Add</button> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="fees-group-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fees Group Name</th>
                                    <th>Description</th>
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
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //feesGroup routes
    var feesGroupList = "{{ route('admin.fees_group.list') }}";
    var feesGroupDelete = "{{ route('admin.fees_group.delete') }}";
</script>

<script src="{{ asset('public/js/custom/fees_group.js') }}"></script>

@endsection