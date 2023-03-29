@extends('layouts.admin-layout')
@section('title','Exam Paper')
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
                <h4 class="page-title">{{ __('messages.exam_paper') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.exam_paper') }}<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addExamPaperModal">{{ __('messages.add') }}</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table nowrap w-100" id="exam-paper-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.grade') }}</th>
                                    <th>{{ __('messages.subject') }}</th>
                                    <th>{{ __('messages.grade_category') }}</th>
                                    <th>{{ __('messages.paper_name') }}</th>
                                    <th>{{ __('messages.paper_type') }}</th>
                                    <th>{{ __('messages.subject_weightage') }}</th>
                                    <th>{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
    </div>
    <!--- end row -->
    @include('admin.exam_paper.add')
    @include('admin.exam_paper.edit')

</div>
<!-- container -->
@endsection
@section('scripts')
<script>
    // exam paper
    var examPaperAdd = "{{ config('constants.api.exam_paper_add') }}";
    var examPaperList = "{{ route('admin.exam_paper.list') }}";
    var examPaperDetails = "{{ config('constants.api.exam_paper_details') }}";
    var examPaperUpdate = "{{ config('constants.api.exam_paper_update') }}";
    var examPaperDelete = "{{ config('constants.api.exam_paper_delete') }}";
    var classesByAllSubjects = "{{ config('constants.api.classes_by_all_subjects') }}";
    
</script>
<script src="{{ asset('public/js/custom/exam_paper.js') }}"></script>
@endsection