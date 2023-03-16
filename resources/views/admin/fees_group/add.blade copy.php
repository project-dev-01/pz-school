@extends('layouts.admin-layout')
@section('title','Add Fees group')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">Fees group</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Add Fees group
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="feesGroupForm" method="post" action="{{ route('admin.fees_group.add') }}" autocomplete="off">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Fees Group Name<span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter Fees Group Name">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" rows="3" class="form-control" placeholder="Enter description"></textarea>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fees Type</th>
                                        <th>Due Date</th>
                                        <th>Payment Mode</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($fees_type as $key=>$type)
                                    <tr>
                                        <td>
                                            <div class="checkbox-replace">
                                                <label class="i-checks">
                                                    <input type="checkbox" name="fees[{{$key}}][fees_type_id]" value="{{$type['id']}}"> <i></i>
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{$type['name']}}</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control date-picker" name="fees[{{$key}}][due_date]" value="" autocomplete="off">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                @forelse ($payment_mode as $mode)
                                                <input type="hidden" name="fees[{{$key}}][mode_id][]" class="form-control" value="{{ $mode['id'] }}">
                                                <input type="text" disabled name="fees[{{$key}}][payment_mode][]" class="form-control" value="{{ $mode['name'] }}">

                                                <!-- <input type="text" disabled class="form-control" name="fees[{{$key}}][payment_mode]" value="{{ $mode['name'] }}"> -->
                                                <br>
                                                @empty
                                                @endforelse
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                @forelse ($payment_mode as $mode)
                                                <input type="number" name="fees[{{$key}}][amount][]" class="form-control" value="">
                                                <br>
                                                @empty
                                                @endforelse
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">

                            <a href="{{ route('admin.fees_group') }}" class="btn btn-light">Back</a>
                            <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                        </div>

                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- col -->
    </div> <!-- row -->
</div> <!-- container -->
@endsection
@section('scripts')
<script>
    //event routes
    var feesGroupList = "{{ route('admin.fees_group') }}";
</script>

<script src="{{ asset('public/js/custom/fees_group.js') }}"></script>

@endsection