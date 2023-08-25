@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.fees_invoice') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('public/datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('public/datatable/css/buttons.dataTables.min.css') }}">
<!-- date picker -->
<link href="{{ asset('public/date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">
<style>
    @media (min-width: 992px) {

        .container,
        .container-lg,
        .container-md,
        .container-sm {
            max-width: 800px;
        }
    }

    .table td,
    .table th {
        padding: 0.85rem;
        vertical-align: top;
        border-top: 1px solid #080b0c;

    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: none;
    }

    .responsive {
        border-bottom: 1px solid #080b0c;
    }

    @media screen and (min-device-width: 280px) and (max-device-width: 653px) {
        .responsive {
            border-bottom: none;
        }
    }

    @media screen and (min-device-width: 320px) and (max-device-width: 670px) {
        .responsive {
            border-bottom: none;
        }
    }
</style>
@endsection
@section('content')
@php
use \App\Http\Controllers\ParentController;
@endphp
        <!-- Start Content-->
        <div class="container" style="margin-top: 20px;">
            <div class="row">

                <div class="col-12">
                    <div class="card-box">
                        <!-- Logo & title -->
                        <div class="clearfix">
                            <div class="float-left">
                                <div class="auth-logo">
                                    <div class="logo logo-dark">
                                        <span class="logo-lg">
                                            <img src="{{ config('constants.image_url').'/public/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle" alt="">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right" style="font-weight: 800;font-size: 15px;">
                            
                            
                                <h3>{{ __('messages.invoice') }}<a href="{{ route('parent.invoice.download', [$student_id , $group_id]) }}" target="_blank" style="padding-left:30px;"><i class="fa fa-print"></i></a></h3>
                                <p>{{ $school_name }}</p>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;margin-left: 10px;">
                            <div class="col-md-6">
                                <h4>{{ __('messages.to') }}: {{ $parent['first_name'] }} {{ $parent['last_name'] }}</h4>
                                <div class="mt-3" style="line-height: 10px;">
                                    <p>{{ $parent['address'] }},</p>
                                    <p><i class="fa fa-envelope"></i> {{ $parent['email'] }} {{ $school_name }}</p>
                                    <p><i class="fa fa-phone"></i> {{ $parent['mobile_no'] }}</p>
                                </div>
                            </div><!-- end col -->
                            <div class="col-md-2">
                            </div><!-- end col -->

                            <div class="col-md-4">
                                <h4>{{ __('messages.invoice_details') }}</h4>
                                <div class="mt-3" style="line-height: 10px;">
                                    <p class="m-b-10"><strong>{{ __('messages.invoice_date') }} : </strong> <span class="float-right">{{$date}}</span></p>
                                    <p class="m-b-10"><strong>{{ __('messages.invoice_no') }} : </strong> <span class="float-right"></span></p>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table mt-4 table-centered">
                                        <thead>
                                            <tr>
                                                <th><b>{{ __('messages.fees_name') }}</b></th>
                                                <th style="width: 15%"><b>{{ __('messages.due_date') }}</b></th>
                                                <th style="width: 15%"><b>{{ __('messages.price') }}</b></th>
                                                <th style="width: 15%"><b>{{ __('messages.paid') }}</b></th>
                                                <th style="width: 15%" class="text-right"><b>{{ __('messages.amount') }}</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                @php 
                                    $total_fine = 0;
                                    $total_balance = 0;
                                @endphp
                                @forelse ($student_fees_history as $key => $row)
                                @php
                                $count = 1;
                                $total_discount = 0;
                                $total_paid = 0;
                                $total_amount = 0;
                                // calc
                                if($row['payment_status_id'] == 1 && isset($row['paid_date'])){
                                $type_amount = round($row['paid_amount']);
                                }else{
                                $type_amount = round(0);
                                }
                                $balance = ($row['amount'] - $type_amount);
                                $total_balance += $balance;
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
                                <tr class="responsive">
                                    <td>
                                        <b>{{ __('messages.' . strtolower($row['payment_mode_name'])) }}</b> <br />
                                        {{ $row['name'] }}
                                    </td>
                                    <td>
                                        {{ $row['due_date'] }}
                                    </td>
                                    <td>${{ $fees_amount }}</td>
                                    <td>${{ $paid_amt }}</td>
                                    <td>${{ $balance }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="4">{{ __('messages.no_data_available') }}</td>
                                </tr>
                                @endforelse
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin-bottom: -40px;">
                            <div class="col-sm-6">
                                <div class="clearfix pt-3">
                                    <h3>{{ __('messages.payment_method') }}</h3>

                                    <small class="text-muted">
                                    {{ __('messages.offline') }}
                                    </small>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-sm-6">
                                <div class="float-right">
                                    <!-- <p><b>{{ __('messages.sub_total') }} :</b> <span class="float-right"><b>${{$total_balance}}</b></span></p> -->
                                    <!-- <p><b>{{ __('messages.fine') }} :</b> <span class="float-right"><b>${{$total_fine}}</b></span></p> -->

                                    <p style="border-top: 2px solid #080b0c;"><b>{{ __('messages.total') }}:</b> <span class="float-right"><b> ${{$total_balance - $total_fine}}</b></span></p>
                                </div>

                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="clearfix pt-5">
                                    <h3>{{ __('messages.terms_conditions')}}</h3>
                                    <small class="text-muted">
                                    {{ __('messages.i_agree_to')}}
                            </small>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-sm-6">
                                <div class="float-right pt-5">
                                    <h3 class="animated fadeInDown" style="font-size:18px; margin-top: 50px;">{{ $school_name }}</h3>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        <hr style="border-bottom: 1px solid #080b0c;">
                        <!-- end row -->
                    </div> <!-- end card-box -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('public/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('public/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('public/date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- button js added -->
<script src="{{ asset('public/buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('public/js/validation/validation.js') }}"></script>
<script>
    var sectionByClass = "{{ config('constants.api.section_by_class') }}";
    var getStudentList = "{{ config('constants.api.get_student_details') }}";
    var getFeesAllocatedStudents = "{{ config('constants.api.get_fees_allocated_students') }}";
    var feesTypeGroupUrl = "{{ config('constants.api.fees_type_group') }}";
    // default image test
    var defaultImg = "{{ config('constants.image_url').'/public/common-asset/images/users/default.jpg' }}";
    var studentImg = "{{ config('constants.image_url').'/public/'.config('constants.branch_id').'/users/images' }}";
    var editFeesPageUrl = '{{ route("admin.fees.edit", ":id") }}';
    var feesDelete = '{{ route("admin.fees.fees_delete") }}';
    // localStorage variables
    var fees_storage = localStorage.getItem('admin_fees_details');
</script>

<script src="{{ asset('public/js/custom/parent_fees.js') }}"></script>

@endsection