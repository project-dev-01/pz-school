@extends('layouts.admin-layout')
@section('title','Create Branch')
@section('content')
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
                <h4 class="page-title">{{ __('messages.create_branch') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-lg-12">
            @include('super_admin.branch.add')
        </div> <!-- end col -->
    </div>
    <!-- end row-->


    <!-- end row -->

</div> <!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('public/js/custom/branch.js') }}"></script>
@endsection