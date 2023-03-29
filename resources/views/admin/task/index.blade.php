@extends('layouts.admin-layout')
@section('title','To Do List')
@section('css')
<!-- <style>
    /* checklist css start  */
    li>p {
        display: inline-block;
        margin-right: 10px;
        cursor: pointer;
    }

    .done {
        text-decoration: line-through;
        color: gray;
    }

    /* checklist end  */
    /* files add remove css start  */
    #files-area {
        width: 93%;
        margin: 0 auto;
    }

    .file-block {
        border-radius: 10px;
        background-color: rgba(144, 163, 203, 0.2);
        margin: 5px;
        color: initial;
        display: inline-flex;
    }

    .file-block>span.name {
        padding-right: 10px;
        width: max-content;
        display: inline-flex;
    }

    .file-delete {
        display: flex;
        width: 24px;
        color: initial;
        background-color: #6eb4ff00;
        font-size: large;
        justify-content: center;
        margin-right: 3px;
        cursor: pointer;
    }

    .file-delete:hover {
        background-color: rgba(144, 163, 203, 0.2);
        border-radius: 10px;
    }

    .file-delete>span {
        transform: rotate(45deg);
    }

    /* files add remove css end  */
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: blue !important;
    }
</style> -->
@endsection
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
                <h4 class="page-title">{{ __('messages.to_do_list') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.to_do_list') }}<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addToDoTask">Add</button> -->
                        <a type="button" class="btn add-btn btn-rounded waves-effect waves-light" href="{{ route('admin.task.create')}}">Add</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap" id="to-do-list-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Date & Time</th>
                                    <th>Priority</th>
                                    <th>Description</th>
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
    </div>
    <!--- end row -->
</div>
<!-- container -->
@endsection
@section('scripts')
<script>
    var gettoDoListURL = "{{ route('admin.task.get') }}";
    var getToDORowURL = "{{ config('constants.api.get_to_do_row') }}";
    var deleteToDoList = "{{ config('constants.api.delete_to_do_list') }}";
</script>
<script src="{{ asset('public/js/custom/to-do-list.js') }}"></script>

@endsection