@extends('layouts.admin-layout')
@section('title','Assign Leave approval')
@section('component_css')
<!-- date picker -->
<link href="{{ asset('public/date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">
<!-- Bootstrap Tables css -->
<link href="{{ asset('public/libs/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css" />
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
                <h4 class="page-title">{{ __('messages.assign_leave_approval') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            {{ __('messages.assign_leave_approval') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <label class="form-inline mb-3">
                        {{ __('messages.show') }}
                        <select id="demo-show-entries" class="form-control form-control-sm ml-1 mr-1">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                        {{ __('messages.entries') }}
                    </label>

                    <div class="table-responsive">
                        <table id="demo-foo-pagination" class="table w-100 nowrap" data-page-size="10">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.employee_name') }}</th>
                                    <th>{{ __('messages.department_name') }}</th>
                                    <th>{{ __('messages.level_one_staff_approval') }}</th>
                                    <th>{{ __('messages.level_two_staff_approval') }}</th>
                                    <th>{{ __('messages.level_three_staff_approval') }}</th>
                                    <th>{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i =1;
                                @endphp
                                @forelse($get_all_staff_details as $value)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$value['name']}}</td>
                                    <td>{{$value['department_name']}}</td>
                                    <td>
                                        <select id="levelOneStaffApproval{{$value['id']}}" class="form-control">
                                            <option value="">{{ __('messages.select_staff') }}</option>
                                            @forelse($get_all_staff_details as $val)
                                            @if ($val['id'] == $value['level_one_staff_id'])
                                            <option value="{{$val['id']}}" selected>{{$val['name']}}</option>
                                            @else
                                            <option value="{{$val['id']}}">{{$val['name']}}</option>
                                            @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </td>
                                    <td>
                                        <select id="levelTwoStaffApproval{{$value['id']}}" class="form-control">
                                            <option value="">{{ __('messages.select_staff') }}</option>
                                            @forelse($get_all_staff_details as $val)
                                            @if ($val['id'] == $value['level_two_staff_id'])
                                            <option value="{{$val['id']}}" selected>{{$val['name']}}</option>
                                            @else
                                            <option value="{{$val['id']}}">{{$val['name']}}</option>
                                            @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </td>
                                    <td>
                                        <select id="levelThreeStaffApproval{{$value['id']}}" class="form-control">
                                            <option value="">{{ __('messages.select_staff') }}</option>
                                            @forelse($get_all_staff_details as $val)
                                            @if ($val['id'] == $value['level_three_staff_id'])
                                            <option value="{{$val['id']}}" selected>{{$val['name']}}</option>
                                            @else
                                            <option value="{{$val['id']}}">{{$val['name']}}</option>
                                            @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary-bl waves-effect waves-light assignLeaveApprove" data-id="{{$value['id']}}" type="button">
                                            {{ __('messages.save') }}
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr class="active">
                                    <td colspan="5">
                                        <div class="text-right">
                                            <ul class="pagination pagination-split justify-content-end footable-pagination m-t-10"></ul>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div> <!-- end .table-responsive-->
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div>
    <!-- container -->
</div>
@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('public/date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('public/js/validation/validation.js') }}"></script>
<!-- Bootstrap Tables js -->
<script src="{{ asset('public/libs/bootstrap-table/bootstrap-table.min.js') }}"></script>
<script src="{{ asset('public/libs/footable/footable.all.min.js') }}"></script>
<script src="{{ asset('public/js/pages/foo-tables.init.js') }}"></script>

<script>
    var assignLeaveApprovalUrl = "{{ config('constants.api.assign_leave_approval') }}";
</script>
<!-- <script src="{{ asset('public/js/custom/sections.js') }}"></script> -->
<script src="{{ asset('public/js/custom/assign_leave_approval.js') }}"></script>

@endsection