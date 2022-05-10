@extends('layouts.admin-layout')
@section('title','Staff Position')
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
                <h4 class="page-title">Staff Position</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">Staff Position</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addStaffPositionModal">Add Staff Position</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table mb-0" id="staff-position-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Staff Position Name</th>
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
    @include('admin.staff_position.add')
    @include('admin.staff_position.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
  //staffPosition routes
    var staffPositionList = "{{ route('admin.staff_position.list') }}";
    var staffPositionDetails = "{{ route('admin.staff_position.details') }}";
    var staffPositionDelete = "{{ route('admin.staff_position.delete') }}";
</script>

<script src="{{ asset('js/custom/staff_position.js') }}"></script>

@endsection