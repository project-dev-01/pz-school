@extends('layouts.admin-layout')
@section('title','Hostel Room')
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
                        <!-- <li class="breadcrumb-item"><a href="{{ route('admin.add_classes')}}">Add Class</a></li> -->
                    </ol>
                </div>
                <h4 class="page-title">Hostel Room</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">Hostel Room</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addHostelRoomModal">Add Hostel Room</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table mb-0 text-center" id="hostel-room-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Room Number</th>
                                <th>Hostel Name</th>
                                <th>Block</th>
                                <th>Floor</th>
                                <th>No of Beds</th>
                                <th>Cost Per Bed</th>
                                <th>Remarks</th>
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
    @include('admin.hostel_room.add')
    @include('admin.hostel_room.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
  //hostelRoom routes
    var hostelRoomList = "{{ route('admin.hostel_room.list') }}";
    var hostelRoomDetails = "{{ route('admin.hostel_room.details') }}";
    var hostelRoomDelete = "{{ route('admin.hostel_room.delete') }}";
</script>

<script src="{{ asset('js/custom/hostel_room.js') }}"></script>

@endsection