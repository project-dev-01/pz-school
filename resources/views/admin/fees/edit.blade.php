@extends('layouts.admin-layout')
@section('title','Edit Fees group')
@section('content')
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
                                            <label class="mb-4">Academic Year : <span class="text-muted mr-2">{{$student['academic_year']}}</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="mb-4">Grade : <span class="text-muted mr-2">{{$student['class_name']}}
                                                    1</span>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="mb-4">Class : <span class="text-muted mr-2">{{$student['section_name']}}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="mb-4">Student Name : <span class="text-muted mr-2">{{$student['name']}}</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="mb-4">Parent Name : <span class="text-muted mr-2">{{$student['parent_name']}}</span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="mb-4">Phone No : <span class="text-muted mr-2"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="mb-4">Email : <span class="text-muted mr-2">{{$student['email']}}</span>
                                            </label>
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
                                            <table class="table table-bordered table-centered mb-0">
                                                <thead class="">
                                                    <tr>
                                                        <th>#</th>
                                                      <th>Fees Type</th>
                                                      <th>Due Date</th>
                                                      <th>Status</th>
                                                      <th>Amount</th>
                                                      <th>Discount</th>
                                                      <th>Fine</th>
                                                      <th>Paid</th>
                                                      <th>Balance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                <td>Hostel Fees</td>
                                <td>29.Jan.2023</td>
                                <td><div class="badge label-table badge-danger">Unpaid</div></td>
                                <td>₹10000.00</td>
                                <td>₹0.00</td> 
                                <td>₹0.00</td> 
                                <td>₹0.00</td> 
                                <td>₹10000.00</td>
                                                    </tr>
                                                    <tr>
                                                         <td>2</td>
                                <td>PTA Fees</td>
                                <td>29.Feb.2023</td>
                                <td> <div class="badge label-table badge-danger">Unpaid</div></td>
                                <td>₹10000.00</td>
                                <td>₹0.00</td> 
                                <td>₹0.00</td> 
                                <td>₹0.00</td> 
                                <td>₹10000.00</td>
                                                   
                                                    <tr>
                                                        <th scope="row" colspan="8" class="text-right">Grand Total :</th>
                                                        <td ><div class="font-weight-bold" >₹20000.00</div></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" colspan="8" class="text-right">Paid :</th>
                                                        <td>₹0.00</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" colspan="8" class="text-right">Discount :</th>
                                                        <td>₹0.00</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" colspan="8" class="text-right">Fine :</th>
                                                        <td><div class="font-weight-bold">₹0.00</div></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" colspan="8" class="text-right">Balance :</th>
                                                        <td><div class="font-weight-bold">₹0.00</div></td>
                                                    </tr> 
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
                                                <ul class="nav nav-pills navtab-bg nav-justified">
                                                    @foreach($fees as $key=>$fee)
                                                    <li class="nav-item">
                                                        <a href="#fee{{$fee['fees_type_id']}}" data-fees_type_id="{{$fee['fees_type_id']}}" data-toggle="tab" aria-expanded="false" class="nav-link  {{ ($key==0) ? 'active' : '' }}">
                                                            {{$fee['fees_name']}}
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <form id="editFeesForm" method="post" action="{{ route('admin.fees.update') }}" autocomplete="off">
                                                @csrf

                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="payment_mode">Payment Mode</label>
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
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="student Name">Date<span class="text-danger">*</span></label>
                                                                            <input type="text"  name="fees[1][date]" class="form-control date-picker" placeholder="MM/DD/YYYY">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="payment_status">Payment Status</label>
                                                                            <select  class="form-control" name="fees[1][payment_status]">
                                                                                <option value="">Select Payment Status</option>
                                                                                @forelse ($payment_status as $status)

                                                                                <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                                                                                @empty
                                                                                @endforelse
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="form-group text-right m-b-0">
                                                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
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
                                                                                        <th>
                                                                                        </th>
                                                                                        <th>Date
                                                                                        </th>
                                                                                        <th>Semester
                                                                                        </th>
                                                                                        <th>Payment
                                                                                            Status
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach($semester as $sem)
                                                                                    <tr>
                                                                                        <td><input type="checkbox"   name="fees[2][{{$sem['id']}}][status]">
                                                                                        <input type="hidden" value="{{$sem['id']}}" name="fees[2][{{$sem['id']}}][semester]">
                                                                                        </td>
                                                                                        <td><input type="text"  class="form-control date-picker" placeholder="MM/DD/YYYY" name="fees[2][{{$sem['id']}}][date]">
                                                                                        </td>
                                                                                        <td>{{$sem['name']}}
                                                                                        </td>
                                                                                        <td>
                                                                                            <select class="form-control dropDwn1" name="fees[2][{{$sem['id']}}][payment_status]" >
                                                                                                <option value="">Choose Payment Status</option>
                                                                                                    @forelse ($payment_status as $status)
                                                                                                        <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                                                                                                    @empty
                                                                                                    @endforelse
                                                                                            </select>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @endforeach

                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="form-group text-right m-b-0">
                                                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Save</button>
                                                                    </div>
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
                                                                                            <input type="checkbox">
                                                                                        <th>Date
                                                                                        </th>
                                                                                        <th>Month
                                                                                        </th>
                                                                                        <th>Payment
                                                                                            Status
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach($month as $mon)
                                                                                    <tr>
                                                                                        <td><input type="checkbox" name="fees[3][{{$mon['id']}}][status]">
                                                                                        <input type="hidden" value="{{$mon['id']}}" name="fees[3][{{$mon['id']}}][month]">
                                                                                        </td>
                                                                                        <td><input type="text" class="form-control date-picker"  placeholder="MM/DD/YYYY" name="fees[3][{{$mon['id']}}][date]">
                                                                                        </td>
                                                                                        <td>{{$mon['name']}}
                                                                                        </td>
                                                                                        <td><select class="form-control" name="fees[3][{{$mon['id']}}][payment_status]">
                                                                                                <option value="">Choose Payment Status</option>
                                                                                                @forelse ($payment_status as $status)
                                                                                                        <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                                                                                                    @empty
                                                                                                    @endforelse
                                                                                            </select>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="form-group text-right m-b-0">
                                                                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                                                                            Save
                                                                        </button>
                                                                    </div>
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
</script>

<script src="{{ asset('public/js/custom/fees.js') }}"></script>

@endsection