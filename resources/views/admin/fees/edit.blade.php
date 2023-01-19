@extends('layouts.admin-layout')
@section('title','Edit Fees group')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
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
                    <div class="table-responsive">
                        <table class="table w-100 nowrap">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="mb-6">Academic Year : <span class="text-muted mr-2">{{$student['academic_year']}}</span></label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mb-4">Grade : <span class="text-muted mr-2">{{$student['class_name']}}
                                                    1</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="mb-4">Class : <span class="text-muted mr-2">{{$student['section_name']}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mb-6">Student Name : <span class="text-muted mr-2">{{$student['name']}}</span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="mb-4">Parent Name : <span class="text-muted mr-2">{{$student['parent_name']}}</span></label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mb-4">Phone No : <span class="text-muted mr-2"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="mb-6">Email : <span class="text-muted mr-2">{{$student['email']}}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </table>
                    </div>

                    <div class="">
                        <div class="">
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
                                                        <a href="#fee{{$fee['fees_type_id']}}" data-toggle="tab" aria-expanded="false" class="nav-link  {{ ($key==0) ? 'active' : '' }}">
                                                            {{$fee['fees_name']}}
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @foreach($fees as $key=>$fee)
                                                <div class="tab-content">
                                                    <div class="tab-pane show {{ ($key==0) ? 'active' : '' }}"  id="fee{{$fee['fees_type_id']}}">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="payment_item">Payment Item</label>
                                                                <select id="payment_item{{$fee['fees_type_id']}}" class="form-control payment_item" name="payment_item">
                                                                    <option value="">Select Payment Item</option>
                                                                    @forelse ($payment_item as $item)
                                                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                                                    @empty
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!--  End Student Fee Monthly -->
                                                    </div>
                                                </div>
                                            @endforeach
                                            
                                            <div class="payment_1 payment_clear" style="display:none;">
                                                            <div class="">
                                                                <div class="col-12">
                                                                    <div class="card">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="student Name">Date<span class="text-danger">*</span></label>
                                                                                    <input type="text" id="humanfd-datepicker" class="form-control" placeholder="MM/DD/YYYY">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="payment_status">Payment Status</label>
                                                                                    <select  class="form-control" name="payment_status">
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
                                                                            <button class="btn btn-primary waves-effect waves-light" type="Save">
                                                                                Save
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--  Start Student Fee Semester -->
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

                                                                                            <tr>
                                                                                                <td><input type="checkbox" id="semester1" />
                                                                                                </td>
                                                                                                <td><input type="text" disabled class="form-control inputDateFld1" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                </td>
                                                                                                <td>Semester
                                                                                                    1
                                                                                                </td>
                                                                                                <td><select id="student Name" disabled class="form-control dropDwn1" name="class_id">
                                                                                                        <option value="">
                                                                                                            Choose
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Waived
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Paid
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Not
                                                                                                            Paid
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>

                                                                                                <td><input type="checkbox" id="semester2" />
                                                                                                </td>
                                                                                                <td><input type="text" disabled class="form-control inputDateFld2" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                </td>
                                                                                                <td>Semester
                                                                                                    2
                                                                                                </td>
                                                                                                <td><select id="student Name" disabled class="form-control dropDwn2" name="class_id">
                                                                                                        <option value="">
                                                                                                            Choose
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Waived
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Paid
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Not
                                                                                                            Paid
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>

                                                                                                <td><input type="checkbox" id="semester3" />
                                                                                                </td>
                                                                                                <td><input type="text" disabled class="form-control inputDateFld3" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                </td>
                                                                                                <td>Semester
                                                                                                    3
                                                                                                </td>
                                                                                                <td><select id="student Name" disabled class="form-control dropDwn3" name="class_id">
                                                                                                        <option value="">
                                                                                                            Choose
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Waived
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Paid
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Not
                                                                                                            Paid
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>


                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="form-group text-right m-b-0">
                                                                                <button class="btn btn-primary waves-effect waves-light" type="Save">Save</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--  End Student Fee Semester -->

                                                        <!--  Start Student Fee Monthly -->
                                                        <div  style="display:none;">
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
                                                                                            <tr>
                                                                                                <td><input type="checkbox">
                                                                                                </td>
                                                                                                <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                </td>
                                                                                                <td>Jan
                                                                                                </td>
                                                                                                <td><select id="student Name" class="form-control" name="class_id">
                                                                                                        <option value="">
                                                                                                            Choose
                                                                                                            Payment
                                                                                                            Status
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Waived
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Paid
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Not
                                                                                                            Paid
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input type="checkbox">
                                                                                                </td>
                                                                                                <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                </td>
                                                                                                <td>Feb
                                                                                                </td>
                                                                                                <td><select id="student Name" class="form-control" name="class_id">
                                                                                                        <option value="">
                                                                                                            Choose
                                                                                                            Payment
                                                                                                            Status
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Waived
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Paid
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Not
                                                                                                            Paid
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input type="checkbox">
                                                                                                </td>
                                                                                                <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                </td>

                                                                                                <td>March
                                                                                                </td>
                                                                                                <td><select id="student Name" class="form-control" name="class_id">
                                                                                                        <option value="">
                                                                                                            Choose
                                                                                                            Payment
                                                                                                            Status
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Waived
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Paid
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Not
                                                                                                            Paid
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input type="checkbox">
                                                                                                </td>
                                                                                                <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                </td>

                                                                                                <td>April
                                                                                                </td>
                                                                                                <td><select id="student Name" class="form-control" name="class_id">
                                                                                                        <option value="">
                                                                                                            Choose
                                                                                                            Payment
                                                                                                            Status
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Waived
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Paid
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Not
                                                                                                            Paid
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input type="checkbox">
                                                                                                </td>
                                                                                                <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                </td>

                                                                                                <td>May
                                                                                                </td>
                                                                                                <td><select id="student Name" class="form-control" name="class_id">
                                                                                                        <option value="">
                                                                                                            Choose
                                                                                                            Payment
                                                                                                            Status
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Waived
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Paid
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Not
                                                                                                            Paid
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input type="checkbox">
                                                                                                </td>
                                                                                                <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                </td>

                                                                                                <td>June
                                                                                                </td>
                                                                                                <td><select id="student Name" class="form-control" name="class_id">
                                                                                                        <option value="">
                                                                                                            Choose
                                                                                                            Payment
                                                                                                            Status
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Waived
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Paid
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Not
                                                                                                            Paid
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input type="checkbox">
                                                                                                </td>
                                                                                                <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                </td>

                                                                                                <td>July
                                                                                                </td>
                                                                                                <td><select id="student Name" class="form-control" name="class_id">
                                                                                                        <option value="">
                                                                                                            Choose
                                                                                                            Payment
                                                                                                            Status
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Waived
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Paid
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Not
                                                                                                            Paid
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input type="checkbox">
                                                                                                </td>
                                                                                                <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                </td>

                                                                                                <td>Aug
                                                                                                </td>
                                                                                                <td><select id="student Name" class="form-control" name="class_id">
                                                                                                        <option value="">
                                                                                                            Choose
                                                                                                            Payment
                                                                                                            Status
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Waived
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Paid
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Not
                                                                                                            Paid
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input type="checkbox">
                                                                                                </td>
                                                                                                <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                </td>

                                                                                                <td>Sep
                                                                                                </td>
                                                                                                <td><select id="student Name" class="form-control" name="class_id">
                                                                                                        <option value="">
                                                                                                            Choose
                                                                                                            Payment
                                                                                                            Status
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Waived
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Paid
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Not
                                                                                                            Paid
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input type="checkbox">
                                                                                                </td>
                                                                                                <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                </td>

                                                                                                <td>Oct
                                                                                                </td>
                                                                                                <td><select id="student Name" class="form-control" name="class_id">
                                                                                                        <option value="">
                                                                                                            Choose
                                                                                                            Payment
                                                                                                            Status
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Waived
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Paid
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Not
                                                                                                            Paid
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input type="checkbox">
                                                                                                </td>
                                                                                                <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                </td>

                                                                                                <td>Nov
                                                                                                </td>
                                                                                                <td><select id="student Name" class="form-control" name="class_id">
                                                                                                        <option value="">
                                                                                                            Choose
                                                                                                            Payment
                                                                                                            Status
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Waived
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Paid
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Not
                                                                                                            Paid
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input type="checkbox">
                                                                                                </td>
                                                                                                <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY">
                                                                                                </td>

                                                                                                <td>Dec
                                                                                                </td>
                                                                                                <td><select id="student Name" class="form-control" name="class_id">
                                                                                                        <option value="">
                                                                                                            Choose
                                                                                                            Payment
                                                                                                            Status
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Waived
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Paid
                                                                                                        </option>
                                                                                                        <option value="">
                                                                                                            Not
                                                                                                            Paid
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
                                                                                            </thead>
                                                                                    </table>

                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="form-group text-right m-b-0">
                                                                                <button class="btn btn-primary waves-effect waves-light" type="Save">
                                                                                    Save
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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