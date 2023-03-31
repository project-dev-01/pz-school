@extends('layouts.admin-layout')
@section('title','Assign Leave approval')
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
                <h4 class="page-title">Assign Leave approval</h4>
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
                            Assign Leave approval
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
                        <table id="demo-foo-pagination" class="table w-100 nowrap" data-page-size="5">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employee Name</th>
                                    <th>{{ __('messages.department_name') }}</th>
                                    <th>Approval Head</th>
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
                                        <select id="staffID_{{$value['id']}}" class="form-control">
                                            <option value="">Select Staff</option>
                                            @forelse($get_all_staff_details as $val)
                                            @if ($val['id'] == $value['assigner_staff_id'])
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
                                            Save
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
    @endsection
    @section('scripts')
    <script src="{{ asset('public/libs/footable/footable.all.min.js') }}"></script>
    <script src="{{ asset('public/js/pages/foo-tables.init.js') }}"></script>

    <script>
        var assignLeaveApprovalUrl = "{{ config('constants.api.assign_leave_approval') }}";
    </script>
    <!-- <script src="{{ asset('public/js/custom/sections.js') }}"></script> -->
    <script src="{{ asset('public/js/custom/assign_leave_approval.js') }}"></script>

    @endsection