@extends('layouts.admin-layout')
@section('title','Staff Category')
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
                <h4 class="page-title">{{ __('messages.staff_category') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">{{ __('messages.staff_category') }} </h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addstaffcategoryModal">{{ __('messages.add_staff_category') }}</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table mb-0" id="staffcategory-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.staff_category') }}</th>
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
    @include('staff.staffCategories.add')
    @include('staff.staffCategories.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
  //department routes
    var staffcategoryList = "{{ route('staff.staffcategory.list') }}";
    var staffcategoryDetails = "{{ route('staff.staffcategory.details') }}";
    var staffcategoryDelete = "{{ route('staff.staffcategory.delete') }}";
</script>

<script src="{{ asset('public/js/custom/staffcategory.js') }}"></script>

@endsection