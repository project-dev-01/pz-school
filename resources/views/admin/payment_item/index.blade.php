@extends('layouts.admin-layout')
@section('title','Payment Item')
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
                <h4 class="page-title">Payment Item</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">Payment Item<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addPaymentItemModal">Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="payment-item-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Payment Item Name</th>
                                    <th>Action</th>
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
    @include('admin.payment_item.add')
    @include('admin.payment_item.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //paymentItem routes
    var paymentItemList = "{{ route('admin.payment_item.list') }}";
    var paymentItemDetails = "{{ route('admin.payment_item.details') }}";
    var paymentItemDelete = "{{ route('admin.payment_item.delete') }}";
</script>

<script src="{{ asset('public/js/custom/payment_item.js') }}"></script>

@endsection