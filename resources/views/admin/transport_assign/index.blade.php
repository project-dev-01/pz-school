@extends('layouts.admin-layout')
@section('title','Assign')
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
                <h4 class="page-title">Assign</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Assign<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addTransportAssignModal">Add Assign</button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap" id="transport-assign-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Route</th>
                                    <th>Stoppage</th>
                                    <th>Vehicle</th>
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
        @include('admin.transport_assign.add')
        @include('admin.transport_assign.edit')
    </div>
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //transportAssign assigns
    var transportAssignList = "{{ route('admin.transport_assign.list') }}";
    var transportAssignDetails = "{{ route('admin.transport_assign.details') }}";
    var transportAssignDelete = "{{ route('admin.transport_assign.delete') }}";
</script>

<script src="{{ asset('public/js/custom/transport_assign.js') }}"></script>

@endsection