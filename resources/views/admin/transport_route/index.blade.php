@extends('layouts.admin-layout')
@section('title','Route')
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
                <h4 class="page-title">{{ __('messages.route') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.route') }}<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addTransportRouteModal">{{ __('messages.add') }}</button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap" id="transport-route-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.route_name') }}</th>
                                    <th>{{ __('messages.start_place') }}</th>
                                    <th>{{ __('messages.stop_place') }}</th>
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
        @include('admin.transport_route.add')
        @include('admin.transport_route.edit')
    </div>
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //transportRoute routes
    var transportRouteList = "{{ route('admin.transport_route.list') }}";
    var transportRouteDetails = "{{ route('admin.transport_route.details') }}";
    var transportRouteDelete = "{{ route('admin.transport_route.delete') }}";
</script>

<script src="{{ asset('public/js/custom/transport_route.js') }}"></script>

@endsection