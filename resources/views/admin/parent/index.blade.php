@extends('layouts.admin-layout')
@section('title','Parent List')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <!--<ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Wizard</li>
                    </ol>-->
                </div>
                <h4 class="page-title">{{ __('messages.parent') }}/{{ __('messages.guardian_list') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.parent') }}/{{ __('messages.guardian_list') }}<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table w-100 nowrap" id="parent-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> {{ __('messages.name') }}</th>
                                                <th> {{ __('messages.occupation') }}</th>
                                                <th> {{ __('messages.email') }}</th>
                                                <th> {{ __('messages.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->

                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

</div> <!-- container -->

@endsection
@section('scripts')
<script>
    var parentImg = "{{ config('constants.image_url').'/public/users/images/' }}";
    var defaultImg = "{{ config('constants.image_url').'/public/images/users/default.jpg' }}";
    var parentList = "{{ route('admin.parent.list') }}";
    var parentDelete = "{{ route('admin.parent.delete') }}";
</script>
<script src="{{ asset('public/js/custom/parent.js') }}"></script>
@endsection