@extends('layouts.admin-layout')
@section('title','Soap Category')
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
                    </ol>
                </div> -->
                <h4 class="page-title">{{ __('messages.soap_category') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.soap_category') }}<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addSoapCategoryModal">{{ __('messages.add') }}</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="soap-category-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.category_name') }}</th>
                                    <th>{{ __('messages.soap_type') }}</th>
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
    @include('admin.soap_category.add')
    @include('admin.soap_category.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //soapCategory routes
    var soapCategoryList = "{{ route('admin.soap_category.list') }}";
    var soapCategoryDetails = "{{ route('admin.soap_category.details') }}";
    var soapCategoryDelete = "{{ route('admin.soap_category.delete') }}";
</script>

<script src="{{ asset('public/js/custom/soap_category.js') }}"></script>

@endsection