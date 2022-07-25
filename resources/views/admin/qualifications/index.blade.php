@extends('layouts.admin-layout')
@section('title','Qualification')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <!-- <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">List</li>
                    </ol> -->
                </div>
                <h4 class="page-title">Qualification</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">Qualification<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addqualifyModal">Add Qualification</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="qualification-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Qualification Name</th>
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
    @include('admin.qualifications.add')
    @include('admin.qualifications.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //qualification routes
    var qualifyList = "{{ route('admin.qualification.list') }}";
    var qualifyDetails = "{{route('admin.qualification.details')}}";
    var qualifyDelete = "{{ route('admin.qualification.delete') }}";
</script>

<script src="{{ asset('public/js/custom/qualification.js') }}"></script>

@endsection