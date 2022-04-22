@extends('layouts.admin-layout')
@section('title','Section Allocation')
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
                <h4 class="page-title">Section</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">Section Allocation</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addSectionAllocationModal">Add</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table mb-0" id="section-allocation-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Class Name</th>
                                <th>Section Name</th>
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
    @include('admin.section_allocation.add_allocation_modal')
    @include('admin.section_allocation.edit_allocation_modal')

</div>
<!-- container -->
@endsection
@section('scripts')
<script>
    var secAlloAddUrl = "{{ config('constants.api.allocate_section_add') }}";
    var secAlloGetRowUrl = "{{ config('constants.api.allocate_section_details') }}";
    var secAlloUpdateUrl = "{{ config('constants.api.allocate_section_update') }}";
    var secAlloDeleteUrl = "{{ config('constants.api.allocate_section_delete') }}";
    
    var secAlloList = "{{ route('admin.section_allocation.list') }}";
</script>
<script src="{{ asset('js/custom/section_allocation.js') }}"></script>
@endsection