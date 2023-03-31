@extends('layouts.admin-layout')
@section('title','Hostel')

@section('css')
<link rel="stylesheet" href="{{ asset('public/country/css/countrySelect.css') }}">
@endsection
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
                <h4 class="page-title">{{ __('messages.hostel') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.hostel') }}<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" id="addHostel" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addHostelModal">Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap" id="hostel-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.hostel_name') }}</th>
                                    <th>{{ __('messages.category') }}</th>
                                    <th>{{ __('messages.warden') }}</th>
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
        @include('admin.hostel.add')
        @include('admin.hostel.edit')
    </div>
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //hostel routes
    var hostelList = "{{ route('admin.hostel.list') }}";
    var hostelDetails = "{{ route('admin.hostel.details') }}";
    var hostelDelete = "{{ route('admin.hostel.delete') }}";
</script>

<script src="{{ asset('public/js/custom/hostel.js') }}"></script>
<script src="{{ asset('public/country/js/countrySelect.js') }}"></script>
<script src="{{ asset('public/js/pages/form-advanced.init.js') }}"></script>

@endsection