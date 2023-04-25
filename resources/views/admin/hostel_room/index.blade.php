@extends('layouts.admin-layout')
@section('title','Hostel Room')
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.add_classes')}}">Add Class</a></li>
                    </ol>
                </div> -->
                <h4 class="page-title">{{ __('messages.hostel_room') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.hostel_room') }}<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addHostelRoomModal">{{ __('messages.add') }}</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 text-center" id="hostel-room-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.room_number') }}</th>
                                    <th>{{ __('messages.hostel_name') }}</th>
                                    <th>{{ __('messages.block') }}</th>
                                    <th>{{ __('messages.floor') }}</th>
                                    <th>{{ __('messages.no_of_beds') }}</th>
                                    <th>{{ __('messages.cost_per_bed') }}</th>
                                    <th>{{ __('messages.remarks') }}</th>
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
        @include('admin.hostel_room.add')
        @include('admin.hostel_room.edit')
    </div>
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //hostelRoom routes
    var hostelRoomList = "{{ route('admin.hostel_room.list') }}";
    var hostelRoomDetails = "{{ route('admin.hostel_room.details') }}";
    var hostelRoomDelete = "{{ route('admin.hostel_room.delete') }}";
    var floorByBlock = "{{ config('constants.api.floor_by_block') }}";
</script>

<script src="{{ asset('public/js/custom/hostel_room.js') }}"></script>

@endsection