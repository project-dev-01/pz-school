@extends('layouts.admin-layout')
@section('title','')
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
                    <h4 class="page-title"> {{ __('messages.list') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table w-100 nowrap" id="branch-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Branch Name</th>
                                        <th> Name</th>
                                        <th>{{ __('messages.email') }}</th>
                                        <th>Mobile No</th>
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
                                        <td>Malaysia</td>
                                        <td>David</td>
                                        <td>david@mail.com</td>
                                        <td>743667377</td>
                                        <td>24-02-1985</td>
                                        <td>12-06-2019</td>
                                        <td>Maths</td>
                                        <td>MEd</td>
                                        <td>No.46, 2nd cross street,Johor</td>
                                        <td>
                                            <div class="button-list">
                                                <a href="' . route('branch.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteBranchBtn"><i class="fe-trash-2"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Singapore</td>
                                        <td>Smith</td>
                                        <td>smith@mail.com</td>
                                        <td>89652542</td>
                                        <td>02-12-1992</td>
                                        <td>18-08-2020</td>
                                        <td>Biology</td>
                                        <td>MEd</td>
                                        <td>No.12, 3rd Gand street,Johor</td>
                                        <td>
                                            <div class="button-list">
                                                <a href="' . route('branch.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteBranchBtn"><i class="fe-trash-2"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Malaysia</td>
                                        <td>Taylor</td>
                                        <td>taylor@mail.com</td>
                                        <td>372889922</td>
                                        <td>02-12-1991</td>
                                        <td>11-08-2021</td>
                                        <td>Chemistry</td>
                                        <td>BEd</td>
                                        <td>No.12, 2nd KM street,Johor</td>
                                        <td>
                                            <div class="button-list">
                                                <a href="' . route('branch.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteBranchBtn"><i class="fe-trash-2"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Singapore</td>
                                        <td>Cameron</td>
                                        <td>cameron@mail.com</td>
                                        <td>653672782</td>
                                        <td>12-02-1993</td>
                                        <td>22-04-2021</td>
                                        <td>Computer</td>
                                        <td>MEd</td>
                                        <td>No.23, 4th MC street,Johor</td>
                                        <td>
                                            <div class="button-list">
                                                <a href="' . route('branch.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteBranchBtn"><i class="fe-trash-2"></i></a>
                                            </div>
                                        </td>
                                    </tr>
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