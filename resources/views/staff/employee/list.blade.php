@extends('layouts.admin-layout')
@section('title','Employee')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

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
                    <h4 class="page-title">{{ __('messages.employee_list') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table w-100 nowrap" id="admin-employee-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('messages.employee_name') }}</th>
                                        <th>{{ __('messages.email') }}</th>
                                        <th>{{ __('messages.mobile_no') }}</th>
                                        <th>{{ __('messages.date_of_birth') }}</th>
                                        <th>{{ __('messages.joining_date') }}</th>
                                        <th>{{ __('messages.department') }}</th>
                                        <th>{{ __('messages.designation') }}</th>
                                        <th>{{ __('messages.present_address') }}</th>
                                        <th>{{ __('messages.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>John</td>
                                        <td>John@gmail.com</td>
                                        <td>+6898562</td>
                                        <td>27/03/2021</td>
                                        <td>01/01/2020</td>
                                        <td>Staff</td>
                                        <td>{{ __('messages.teacher') }}</td>
                                        <td>21,KL</td>
                                        <td>
                                            <div class="button-list">
                                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="" id="viewEventBtn">View</a>
                                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="" id="deleteEventBtn">{{ __('messages.delete') }}</a>
                                            </div>
                                        </td>
                                    <tr>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->

    <!-- end row -->
</div> <!-- container -->
@endsection