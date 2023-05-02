@extends('layouts.admin-layout')
@section('title','Global Setting')
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
                <h4 class="page-title">{{ __('messages.global_settings') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.global_settings') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <!-- <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addGlobalSettingModal">Add</button> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="global-setting-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.academic_year') }}</th>
                                    <th>{{ __('messages.footer_text') }}</th>
                                    <th>{{ __('messages.timeZone') }}</th>
                                    <th>{{ __('messages.facebook_url') }}</th>
                                    <th>{{ __('messages.twitter_url') }}</th>
                                    <th>{{ __('messages.linkedIn_url') }}</th>
                                    <th>{{ __('messages.youtube_url') }}</th>
                                    <th>{{ __('messages.action') }}</th>
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
    @include('admin.global_setting.add')
    @include('admin.global_setting.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //globalSetting routes
    var globalSettingList = "{{ route('admin.global_setting.list') }}";
    var globalSettingDetails = "{{ route('admin.global_setting.details') }}";
    var globalSettingDelete = "{{ route('admin.global_setting.delete') }}";
</script>

<script src="{{ asset('public/js/custom/global_setting.js') }}"></script>

@endsection