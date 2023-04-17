@extends('layouts.admin-layout')
@section('title','Branch')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Datatables</li> -->
                        </ol>
                    </div>
                    <h4 class="page-title">{{ __('messages.branch') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <ul class="nav nav-tabs" >
                        <li class="nav-item">
                            <h4 class="nav-link">
                                <span data-feather="" class="icon-dual" id="span-parent"></span> {{ __('messages.branch_list') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <form id="filter">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country">{{ __('messages.country') }}<span class="text-danger">*</span></label>
                                        <select id="country" class="form-control" name="country" required="">
                                            <option value="">Select</option>
                                            @foreach($countries as $c)
                                            <option value="{{$c['id']}}">{{$c['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="state">{{ __('messages.state') }}<span class="text-danger">*</span></label>
                                        <select id="state" class="form-control" name="state" required="">
                                            <option value="">{{ __('messages.select_state') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city">{{ __('messages.city') }}<span class="text-danger">*</span></label>
                                        <select id="city" class="form-control" required="">
                                            <option value="">{{ __('messages.select_city') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" id="branch-filter" type="button">
                                {{ __('messages.filter') }}
                                </button>
                                <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                    Cancel
                                </button>-->
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs" >
                        <li class="nav-item">
                            <h4 class="nav-link">
                                <span data-feather="" class="icon-dual" id="span-parent"></span> {{ __('messages.branch_list') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table w-100 nowrap" id="branch-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('messages.branch_name') }}</th>
                                        <th>{{ __('messages.school_name') }}</th>
                                        <th>{{ __('messages.email') }}</th>
                                        <th>{{ __('messages.mobile_no') }}</th>
                                        <th>{{ __('messages.currency') }}</th>
                                        <th>{{ __('messages.symbol') }}</th>
                                        <th>{{ __('messages.country') }}</th>
                                        <th>{{ __('messages.state') }}</th>
                                        <th>City</th>
                                        <th>Address</th>
                                        <th>{{ __('messages.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->

    <!-- end row -->
</div> <!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('public/js/custom/branch.js') }}"></script>
@endsection