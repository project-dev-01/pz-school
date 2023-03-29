@extends('layouts.admin-layout')
@section('title','Exam Term')
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
                <h4 class="page-title">{{ __('messages.exam_term_list') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.exam_term_list') }}<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addExamTermModal">{{ __('messages.add') }}</button>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="exam-term-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.name') }}</th>
                                    <th>{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
        <!--- end row -->
        @include('admin.exam_term.add')
        @include('admin.exam_term.edit')
    </div>
</div>
<!-- container -->
@endsection
@section('scripts')
<script>
    // examTerm routes
    var examTermList = "{{ route('admin.exam_term.list') }}";
    var examTermDetails = "{{ route('admin.exam_term.details') }}";
    var examTermDelete = "{{ route('admin.exam_term.delete') }}";
</script>
<script src="{{ asset('public/js/custom/exam_term.js') }}"></script>
@endsection