@extends('layouts.admin-layout')
@section('title','Stream Type')
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
                <h4 class="page-title">Stream Type</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">Stream Type<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" style="width:150px" data-toggle="modal" data-target="#addStreamTypeModal">Add Stream Type</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0" id="stream-type-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Stream Type Name</th>
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
    @include('admin.stream_type.add')
    @include('admin.stream_type.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //streamType routes
    var streamTypeList = "{{ route('admin.stream_type.list') }}";
    var streamTypeDetails = "{{ route('admin.stream_type.details') }}";
    var streamTypeDelete = "{{ route('admin.stream_type.delete') }}";
</script>

<script src="{{ asset('js/custom/stream_type.js') }}"></script>

@endsection