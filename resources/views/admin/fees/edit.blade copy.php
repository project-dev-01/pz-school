@extends('layouts.admin-layout')
@section('title','Edit Fees')
@section('content')
@php
use \App\Http\Controllers\AdminController;
@endphp

<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h2 class="page-title">Fees Details</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Student & Parent Information
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="mb-4">Student Name : <span class="text-muted mr-2">{{$student['name']}}</span></label>
                            </div>
                            <div class="col-md-4">
                                <label class="mb-4">Grade : <span class="text-muted mr-2">{{$student['class_name']}}</span></label>
                            </div>
                            <div class="col-md-4">
                                <label class="mb-4">Class : <span class="text-muted mr-2">{{$student['section_name']}}</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="mb-4">Academic Year : <span class="text-muted mr-2">{{$student['academic_year']}}</span></label>
                            </div>
                            <div class="col-md-4">
                                <label class="mb-4">Email : <span class="text-muted mr-2">{{$student['email']}}</span></label>
                            </div>
                            <div class="col-md-4">
                                <label class="mb-4">Parent Phone No : <span class="text-muted mr-2"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="mb-4">Parent Name : <span class="text-muted mr-2">{{$student['parent_name']}}</span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Invoice History
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="invoice_history" class="table table-bordered table-centered mb-0">
                            <thead class="">
                                <tr>
                                    <th>#</th>
                                    <th>Fees Group</th>
                                    <th>Fees Type</th>
                                    <th>Payment Mode</th>
                                    <th>Due Date</th>
                                    <th>Paid Date</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <!-- <th>Discount</th> -->
                                    <!-- <th>Fine</th> -->
                                    <th>Paid</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($student_fees_history as $key => $row)
                                @php
                                $args = [
                                'payment_status_id'=>$row['payment_status_id'],
                                'payment_mode_id'=>$row['payment_mode_id'],
                                'due_date'=>$row['due_date'],
                                'paid_date'=>$row['paid_date'],
                                'amount'=>$row['amount'],
                                'paid_amount'=>$row['paid_amount'],
                                'payment_mode_name'=>$row['payment_mode_name'],
                                ];
                                $paidDetails = AdminController::paidStatusDetails($args);
                                echo "<pre>";
                                print_r($paidDetails);
                                $count = 1;
                                $total_fine = 0;
                                $total_discount = 0;
                                $total_paid = 0;
                                $total_balance = 0;
                                $total_amount = 0;
                                // calc
                                if($row['payment_status_id'] == 1 && isset($row['paid_date'])){
                                $type_amount = round($row['paid_amount']);
                                }else{
                                $type_amount = round(0);
                                }
                                $balance = ($row['amount'] - $type_amount);
                                $balance = number_format($balance, 2, '.', '');
                                $fees_amount = number_format($row['amount'], 2, '.', '');
                                $paid_amt = number_format($type_amount, 2, '.', '');

                                $labelmode = '';
                                $paidSts = '';
                                $date1 = $row['due_date'];
                                $date2 = $row['paid_date'];

                                if ($type_amount == 0) {
                                if ($date1 >= $date2){
                                $paidSts = 'unpaid';
                                $labelmode = 'badge-danger';
                                }else{
                                $paidSts = 'delay';
                                $labelmode = 'badge-warning';
                                }

                                } elseif ($balance == 0) {
                                $paidSts = 'paid';
                                $labelmode = 'badge-success';
                                } else {
                                $paidSts = 'delay';
                                $labelmode = 'badge-warning';
                                }

                                @endphp
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $row['fees_group_name'] }}</td>
                                    <td>{{ $row['name'] }}</td>
                                    <td>{{ $row['payment_mode_name'] }}</td>
                                    <td>{{ $row['due_date'] }}</td>
                                    <td>{{ $row['paid_date'] }}</td>
                                    <td>
                                        <div class="badge label-table {{ $labelmode }}">{{ $paidSts }}</div>
                                    </td>
                                    <td>{{ $fees_amount }}</td>
                                    <!-- <td>0.00</td> -->
                                    <!-- <td>₹0.00</td> -->
                                    <td>{{ $paid_amt }}</td>
                                    <td>{{ $balance }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="9">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end card-->
    </div> <!-- end col -->

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <h4 class="navv">Student Fee Details<h4>
        </li>
    </ul>
    <div class="card">

        <div class="">
            <div class="col-xl-12 col-sm-12 col-md-12">
                <div class="card-body">
                    <div class="col-10">
                        <ul class="nav nav-pills navtab-bg nav-justified" id="apptabs">
                            @foreach($fees as $key=>$fee)
                            <li class="nav-item" id="{{$fee['fees_type_id']}}" data-payment_mode_id="{{$fee['payment_mode_id']}}" data-fees_group_id="{{$fee['id']}}" data-allocation_id="{{$fee['allocation_id']}}" data-paid_amount="{{$fee['paid_amount']}}">
                                <a href="#fee{{$fee['fees_type_id']}}" data-toggle="tab" aria-expanded="false" class="nav-link  {{ ($key==0) ? 'active' : '' }}">
                                    {{$fee['fees_name']}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <form id="editFeesForm" method="post" action="{{ route('admin.fees.update') }}" autocomplete="off">
                        @csrf
                        <input type="hidden" value="{{ $student_id }}" name="student_id" id="studentID" class="form-control">
                        <input type="hidden" value="{{ $student['academic_id'] }}" name="academic_year" id="academicYear" class="form-control">
                        <div class="col-md-5">
                            <div class="form-group" style="margin: 25px 6px;">
                                <label for="payment_mode">Payment Mode</label>
                                <input type="hidden" class="form-control payment_mode_onload" name="payment_mode_onload" value="" />
                                <select id="payment_mode{{$fee['fees_type_id']}}" class="form-control payment_mode" name="payment_mode">
                                    <option value="">Select Payment Mode</option>
                                    @forelse ($payment_mode as $mode)
                                    <option value="{{ $mode['id'] }}">{{ $mode['name'] }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="payment_1 payment_clear" style="display:none;">
                            <div class="">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="amount">Amount<span class="text-danger">*</span></label>
                                                        <input type="hidden" value="" id="yearFeesGroupDetailsID" name="fees[1][fees_group_details_id]">
                                                        <input type="text" id="yearAmt" name="fees[1][amount]" readonly class="fees_amount_1 initialEmpty form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="student Name">Date<span class="text-danger">*</span></label>
                                                        <input type="text" id="yearDate" name="fees[1][date]" class="form-control date-picker initialEmpty" placeholder="YYYY-MM-DD">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="payment_status">Payment Status<span class="text-danger">*</span></label>
                                                        <select class="form-control initialEmpty" id="yearPaySts" name="fees[1][payment_status]">
                                                            <option value="">Select Payment Status</option>
                                                            @forelse ($payment_status as $status)
                                                            <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="memo">Memo</label>
                                                        <textarea class="form-control initialEmpty" id="yearMemo" name="fees[1][memo]" placeholder="Enter Memo"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  Start Student Fees Semester -->
                        <div class="payment_2 payment_clear" style="display:none;">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 20px;">
                                                                    <input type="checkbox" id="selectAllSemester">
                                                                </th>
                                                                <th>Date<span class="text-danger">*</span>
                                                                </th>
                                                                <th>Semester
                                                                </th>
                                                                <th>Amount<span class="text-danger">*</span>
                                                                </th>
                                                                <th>Payment
                                                                    Status<span class="text-danger">*</span>
                                                                </th>
                                                                <th>Memo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($semester as $sem)
                                                            <tr>
                                                                <td class="semester-checked-area"><input type="checkbox" class="currentCheckBox isChecked_{{$sem['id']}} initialEmpty" id="{{$sem['id']}}" name="fees[2][{{$sem['id']}}][status]">
                                                                    <input type="hidden" value="{{$sem['id']}}" name="fees[2][{{$sem['id']}}][semester]">
                                                                </td>
                                                                <td><input type="text" disabled id="semesterDate{{$sem['id']}}" class="form-control date-picker checkbx_{{$sem['id']}} initialEmpty" placeholder="YYYY-MM-DD" name="fees[2][{{$sem['id']}}][date]">
                                                                </td>
                                                                <td>{{$sem['name']}}
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" value="" id="semesterFeesGroupDetailsID{{$sem['id']}}" name="fees[2][{{$sem['id']}}][fees_group_details_id]">
                                                                    <input type="text" id="semesterPayAmt{{$sem['id']}}" name="fees[2][{{$sem['id']}}][amount]" readonly class="fees_amount_2 initialEmpty form-control">
                                                                </td>
                                                                <td>
                                                                    <select class="form-control checkbx_{{$sem['id']}} initialEmpty" disabled id="semesterPaySts{{$sem['id']}}" name="fees[2][{{$sem['id']}}][payment_status]">
                                                                        <option value="">Choose Payment Status</option>
                                                                        @forelse ($payment_status as $status)
                                                                        <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                                                                        @empty
                                                                        @endforelse
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <textarea class="form-control checkbx_{{$sem['id']}} initialEmpty" disabled id="semesterMemo{{$sem['id']}}" name="fees[2][{{$sem['id']}}][memo]" placeholder="Enter Memo"></textarea>
                                                                </td>
                                                            </tr>
                                                            @endforeach

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  End Student Fees Semester -->

                        <!--  Start Student Fees Monthly -->
                        <div class="payment_3 payment_clear" style="display:none;">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-bordered table-centered mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 20px;">
                                                                    <input type="checkbox" id="selectAllMonth">
                                                                </th>
                                                                <th>Date<span class="text-danger">*</span>
                                                                </th>
                                                                <th>Month
                                                                </th>
                                                                <th>Amount<span class="text-danger">*</span>
                                                                </th>
                                                                <th>Payment
                                                                    Status<span class="text-danger">*</span>
                                                                </th>
                                                                <th>Memo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($month as $mon)
                                                            <tr>
                                                                <td class="month-checked-area"><input type="checkbox" class="currentCheckBox isChecked_{{$mon['id']}} initialEmpty" id="{{$mon['id']}}" name="fees[3][{{$mon['id']}}][status]">
                                                                    <input type="hidden" value="{{$mon['id']}}" name="fees[3][{{$mon['id']}}][month]">
                                                                </td>
                                                                <td><input type="text" disabled id="monthDate{{$mon['id']}}" class="form-control date-picker checkbx_{{$mon['id']}} initialEmpty" placeholder="YYYY-MM-DD" name="fees[3][{{$mon['id']}}][date]">
                                                                </td>
                                                                <td>{{$mon['name']}}
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" value="" id="monthFeesGroupDetailsID{{$mon['id']}}" name="fees[3][{{$mon['id']}}][fees_group_details_id]">
                                                                    <input type="text" name="fees[3][{{$mon['id']}}][amount]" id="monthPayAmt{{$mon['id']}}" readonly class="fees_amount_3 initialEmpty form-control">
                                                                </td>
                                                                <td><select class="form-control checkbx_{{$mon['id']}} initialEmpty" disabled id="monthPaySts{{$mon['id']}}" name="fees[3][{{$mon['id']}}][payment_status]">
                                                                        <option value="">Choose Payment Status</option>
                                                                        @forelse ($payment_status as $status)
                                                                        <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                                                                        @empty
                                                                        @endforelse
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <textarea class="form-control checkbx_{{$mon['id']}} initialEmpty" disabled id="monthMemo{{$mon['id']}}" name="fees[3][{{$mon['id']}}][memo]" placeholder="Enter Memo"></textarea>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>
</div>
</div> <!-- end card-box -->
</div> <!-- end col -->
</div> <!-- container -->
@endsection
@section('scripts')
<script>
    var changePaymentModeUrl = "{{ config('constants.api.change_payment_mode') }}";
    var activeTabDetails = "{{ config('constants.api.fee_active_tab_details') }}";
    var feesGetPayModeIdUrl = "{{ config('constants.api.fees_get_pay_mode_id') }}";
</script>
<!-- <script src="{{ asset('public/js/custom/fees.js') }}"></script> -->
<script src="{{ asset('public/js/custom/fees_edit.js') }}"></script>
@endsection