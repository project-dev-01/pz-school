@extends('layouts.admin-layout')
@section('title','Event')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <!-- <li class="breadcrumb-item active">List</li> -->
                    </ol>
                </div>
                <h4 class="page-title">Events</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Event List
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table w-100 nowrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Type</th>
                                                <th>Audience</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Created By</th>
                                                <th>Publish</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>1</td>
                                                <td>Volley Ball</td>
                                                <td>Sports</td>
                                                <td>All</td>
                                                <td>26-01-2022</td>
                                                <td>28-01-2022</td>
                                                <td>Admin</td>
                                                <td>Published</td>
                                                <td>
                                                    <div class="button-list">
                                                        <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-toggle="modal" data-id="" data-target="#viewEvent"><i class="fe-eye"></i></a>
                                                        <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id=""><i class="fe-trash-2"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->

                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
    @include('parent.events.view')
</div>
<!-- container -->

@endsection