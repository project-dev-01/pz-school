@extends('layouts.admin-layout')
@section('title','Vehicle')
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
                <h4 class="page-title">{{ __('messages.vehicle') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.vehicle') }}<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addTransportVehicleModal">{{ __('messages.add') }}</button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap" id="transport-vehicle-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.vehicle_number') }}</th>
                                    <th>{{ __('messages.capacity') }}</th>
                                    <th>{{ __('messages.insurance_renewal') }}</th>
                                    <th>{{ __('messages.driver_name') }}</th>
                                    <th>{{ __('messages.driver_phone') }}</th>
                                    <th>{{ __('messages.driver_license_number') }}</th>
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
        @include('admin.transport_vehicle.add')
        @include('admin.transport_vehicle.edit')
    </div>
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //transportVehicle vehicles
    var transportVehicleList = "{{ route('admin.transport_vehicle.list') }}";
    var transportVehicleDetails = "{{ route('admin.transport_vehicle.details') }}";
    var transportVehicleDelete = "{{ route('admin.transport_vehicle.delete') }}";
</script>

<script src="{{ asset('public/js/custom/transport_vehicle.js') }}"></script>

@endsection