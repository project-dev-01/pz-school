@extends('layouts.admin-layout')
@section('title','Event')
@section('css')
<link rel="stylesheet" href="{{ asset('public/libs/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/libs/dropify/css/dropify.min.css') }}">
<style>
    .datepicker {
        z-index: 99999 !important;
    }
</style>
@endsection
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
                <h4 class="page-title">Event</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Event
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="form-group pull-right">
                        <div class="col-xs-2 col-sm-2">
                            <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                            <a type="button" class="btn add-btn btn-rounded waves-effect waves-light" href="{{ route('admin.event.create')}}">Add</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table w-100 nowrap" id="event-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>{{ __('messages.type') }}</th>
                                    <th>Audience</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Publish</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
    <!--- end row -->
    @include('admin.event.view')
    @include('admin.event.publish')
</div>
<!-- container -->

@endsection
@section('scripts')
<script>
    //event routes
    var eventList = "{{ route('admin.event.list') }}";
    var eventDetails = "{{ route('admin.event.details') }}";
    var eventDelete = "{{ route('admin.event.delete') }}";
    var eventPublish = "{{ route('admin.event.publish') }}";
</script>
<script src="{{ asset('public/libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('public/libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('public/js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('public/js/custom/event.js') }}"></script>

@endsection