@extends('layouts.admin-layout')
@section('title','Academic Year')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title"> {{ __('messages.academic_year') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> {{ __('messages.academic_year') }}<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#academicYearModal"> {{ __('messages.add') }}</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="academic-year-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> {{ __('messages.academic_year') }}</th>
                                    <th> {{ __('messages.action') }}</th>
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
        @include('admin.acdemic_year.add')
        @include('admin.acdemic_year.edit')

    </div>
</div>
<!-- container -->
@endsection
@section('scripts')
<script>
    var academicYearAddUrl = "{{ config('constants.api.academic_year_add') }}";
    var academicYearGetRowUrl = "{{ config('constants.api.academic_year_details') }}";
    var academicYearUpdateUrl = "{{ config('constants.api.academic_year_update') }}";
    var academicYearDeleteUrl = "{{ config('constants.api.academic_year_delete') }}";
    var academicYearList = "{{ route('admin.academic_year.list') }}";
</script>
<script src="{{ asset('public/js/custom/academic_year.js') }}"></script>
@endsection