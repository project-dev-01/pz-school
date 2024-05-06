@extends('layouts.admin-layout')
@section('title',' ' . __('messages.to_do_list') . '')
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
                <h4 class="page-title">{{ __('messages.to_do_list') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            To Do Task
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0" id="task-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.title') }}</th>
                                    <th>{{ __('messages.date') }} & {{ __('messages.time') }}</th>
                                    <th>{{ __('messages.priority') }}</th>
                                    <th>{{ __('messages.description') }}</th>
                                    <th>{{ __('messages.action') }}</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Sports Day</td>
                                    <td>Tommorrow 10am</td>
                                    <td><span class="badge badge-soft-danger p-1">High</span></td>
                                    <td>All Should wear sports dress</td>
                                    <td>
                                        <div class="button-list">
                                            <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="" id=""><i class="fe-eye"></i></a>
                                        </div>
                                    </td>
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
    @include('parent.task.add')
</div>
<!-- container -->
@endsection