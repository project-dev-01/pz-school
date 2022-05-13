@extends('layouts.admin-layout')
@section('title','Event')
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
            <div class="card-box">
                <h4 class="header-title">Event</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addEventModal">Add Event</button>
                    </div>
                </div>
                </p>
                <div class="table-responsive">
                    <table class="table mb-0" id="event-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Type</th>
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
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
    <!--- end row -->
    @include('admin.event.add')
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

<script src="{{ asset('js/custom/type.js') }}"></script>

@endsection