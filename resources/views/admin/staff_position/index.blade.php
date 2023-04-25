@extends('layouts.admin-layout')
@section('title','Staff Position')
@section('content')
<link href="{{ asset('public/css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
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
                <h4 class="page-title">{{ __('messages.staff_position') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.staff_position') }}<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addStaffPositionModal">{{ __('messages.add') }}</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="staff-position-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.staff_position_name') }}</th>
                                    <th>{{ __('messages.action') }}</th>
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

<script src="{{ asset('public/js/custom/staff_position.js') }}"></script>

@endsection