@extends('layouts.admin-layout')
@section('title','Designation')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">{{ __('messages.list') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.designation') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">{{ __('messages.designation') }}</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addDesignationModal">{{ __('messages.add_designation') }}</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table w-100 nowrap" id="designation-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Branch</th>
                                <th>{{ __('messages.designation_name') }}</th>
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
    @include('super_admin.designation.add')
    @include('super_admin.designation.edit')

</div>
<!-- container -->
@endsection