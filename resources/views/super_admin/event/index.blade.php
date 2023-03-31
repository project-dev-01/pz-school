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
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.event') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">{{ __('messages.event') }}</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addEvent">Add Event</button>
                    </div>
                </div>
                </p>
                <div class="table-responsive">
                    <table class="table w-100 nowrap" id="event-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.title') }}</th>
                                <th>{{ __('messages.type') }}</th>
                                <th>{{ __('messages.audience') }}</th>
                                <th>{{ __('messages.start_date') }}</th>
                                <th>{{ __('messages.end_date') }}</th>
                                <th>Created By</th>
                                <th>Publish</th>
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
    @include('super_admin.event.add')
    @include('super_admin.event.view')
    @include('super_admin.event.publish')
</div>
<!-- container -->

@endsection
