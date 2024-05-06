@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.fees_details') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/feesresponsive.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<style>
    .bank-list {
        display: inline-block;
        width: 50%;
        position: relative;
        padding-right: 10px;
    }

    .bank-list::after {
        content: ":";
        position: absolute;
        right: 10px;
    }
</style>
@php
use \App\Http\Controllers\ParentController;
@endphp
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h2 class="page-title">{{ __('messages.fees_details') }}</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.invoice_history') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="invoice_history" class="table table-bordered table-centered mb-0">
                            <thead class="">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.fees_group') }}</th>
                                    <th>{{ __('messages.fees_type') }}</th>
                                    <th>{{ __('messages.payment_mode') }}</th>
                                    <th>{{ __('messages.due_date') }}</th>
                                    <th>{{ __('messages.paid_date') }}</th>
                                    <th>{{ __('messages.payment_status') }}</th>
                                    <th>{{ __('messages.amount') }}</th>
                                    <!-- <th>Discount</th> -->
                                    <!-- <th>Fine</th> -->
                                    <th>{{ __('messages.paid') }}</th>
                                    <th>{{ __('messages.balance') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($student_fees_history as $key => $row)
                                @php
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

                                $args = [
                                'payment_status_id'=>$row['payment_status_id'],
                                'payment_mode_id'=>$row['payment_mode_id'],
                                'due_date'=>$row['due_date'],
                                'paid_date'=>$row['paid_date'],
                                'amount'=>$row['amount'],
                                'paid_amount'=>$row['paid_amount'],
                                'payment_mode_name'=>$row['payment_mode_name'],
                                ];
                                $paidDetails = ParentController::paidStatusDetails($args);
                                //echo "<pre>";
                                //print_r($paidDetails['paidSts']);
                                //print_r($paidDetails['labelmode']);

                                $labelmode = isset($paidDetails['labelmode'])?$paidDetails['labelmode']:'';
                                $paidSts = isset($paidDetails['paidSts'])?$paidDetails['paidSts']:'';

                                @endphp
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $row['fees_group_name'] }}</td>
                                    <td>{{ $row['name'] }}</td>
                                    <td>{{ __('messages.' . strtolower($row['payment_mode_name'])) }}</td>
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
                                    <td class="text-center" colspan="9">{{ __('messages.no_data_available') }}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end card-->
    </div> <!-- end col -->


    <div class="row" id="banks">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link" id="title">
                        {{ __('messages.bank_details') }} 
                        <h4>
                    </li>
                </ul>
                <div class="card-body" id="bank_list">
                    @foreach($banks as $key=>$bank)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>
                                    <div>
                                        <a class="list-group-item list-group-item-info btn-block btn-lg" data-toggle="collapse" href="#bank-{{$key}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fas fa-caret-square-down"></i> {{ $bank['bank_name'] }} - {{ $bank['account_no'] }}
                                        </a>
                                    </div>
                                    </p>
                                    <div class="collapse" id="bank-{{$key}}">
                                        <div class="card card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <p class="col-md-12"><span class="font-weight-semibold bank-list">{{ __('messages.bank_name') }}</span>{{$bank['bank_name']}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <p class="col-md-12"><span class="font-weight-semibold bank-list">{{ __('messages.bank_branch') }}</span>{{$bank['bank_branch']}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <p class="col-md-12"><span class="font-weight-semibold bank-list">{{ __('messages.account_holder') }}</span>{{$bank['holder_name']}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <p class="col-md-12"><span class="font-weight-semibold bank-list">{{ __('messages.account_no') }}</span>{{$bank['account_no']}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <p class="col-md-12"><span class="font-weight-semibold bank-list">{{ __('messages.email') }}</span>{{$bank['email']}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <p class="col-md-12"><span class="font-weight-semibold bank-list">{{ __('messages.country') }}</span>{{$bank['country']}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <p class="col-md-12"><span class="font-weight-semibold bank-list">{{ __('messages.ifsc_code') }} </span>{{$bank['ifsc_code']}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <p class="col-md-12"><span class="font-weight-semibold bank-list">{{ __('messages.routing_number') }} </span>{{$bank['routing_number']}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <p class="col-md-12"><span class="font-weight-semibold bank-list">{{ __('messages.swift_code') }} </span>{{$bank['swift_code']}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

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
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- button js added -->
<script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    var changePaymentModeUrl = "{{ config('constants.api.change_payment_mode') }}";
    var activeTabDetails = "{{ config('constants.api.fee_active_tab_details') }}";
    var feesGetPayModeIdUrl = "{{ config('constants.api.fees_get_pay_mode_id') }}";
</script>
<!-- <script src="{{ asset('js/custom/fees.js') }}"></script> -->
<script src="{{ asset('js/custom/fees_edit.js') }}"></script>
@endsection