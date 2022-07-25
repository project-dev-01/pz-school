@extends('layouts.admin-layout')
@section('title','Stoppage')
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
                <h4 class="page-title">Stoppage</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Stoppage<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addTransportStoppageModal">Add Stoppage</button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap" id="transport-stoppage-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Stop Position</th>
                                    <th>Stop Time</th>
                                    <th>Route Fare</th>
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
        @include('admin.transport_stoppage.add')
        @include('admin.transport_stoppage.edit')
    </div>
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //transportStoppage stoppages
    var transportStoppageList = "{{ route('admin.transport_stoppage.list') }}";
    var transportStoppageDetails = "{{ route('admin.transport_stoppage.details') }}";
    var transportStoppageDelete = "{{ route('admin.transport_stoppage.delete') }}";
</script>

<script src="{{ asset('public/js/custom/transport_stoppage.js') }}"></script>

@endsection