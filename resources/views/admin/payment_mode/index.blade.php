@extends('layouts.admin-layout')
@section('title','Payment Mode')
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
                <h4 class="page-title">{{ __('messages.payment_mode') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.payment_mode') }}<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addPaymentModeModal">Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="payment-mode-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Payment Mode Name</th>
                                    <th>{{ __('messages.action') }}</th>
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
    @include('admin.payment_mode.add')
    @include('admin.payment_mode.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //paymentMode routes
    var paymentModeList = "{{ route('admin.payment_mode.list') }}";
    var paymentModeDetails = "{{ route('admin.payment_mode.details') }}";
    var paymentModeDelete = "{{ route('admin.payment_mode.delete') }}";
</script>

<script src="{{ asset('public/js/custom/payment_mode.js') }}"></script>

@endsection