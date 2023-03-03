@extends('layouts.admin-layout')
@section('title','Edit Fees group')
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
                        <h4 class="navv">Edit Fees group
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="edit-fees-group-form" method="post" action="{{ route('admin.fees_group.update') }}" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" value="{{$fees_group['id']}}">           
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Fees Group Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" value="{{$fees_group['name']}}"  class="form-control" placeholder="Enter Fees Group Name">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" rows="3" class="form-control" placeholder="Enter description">{{$fees_group['description']}}</textarea>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table dt-responsive nowrap w-100" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fees Type</th>
                                        <th>Due Date</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($fees_type as $key=>$type)
                                        <tr>
                                            <td>
                                                <div class="checkbox-replace">
                                                    <label class="i-checks">
                                                        <input type="checkbox" name="fees[{{$key}}][fees_type_id]" value="{{$type['fees_type_id']}}" @if($type['id']) checked @endif> <i></i>
                                                    </label>
                                                </div>
                                            </td>
                                            <input type="hidden" name="fees[{{$key}}][fees_group_details_id]" value="{{$type['id']}}">
                                            <td>{{$type['name']}}</td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control date-picker" name="fees[{{$key}}][due_date]" value="{{$type['due_date']}}"  autocomplete="off">
                                                    <span class="error"></span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="fees[{{$key}}][amount]" class="form-control" autocomplete="off" value="{{$type['amount']}}">
                                                    <span class="error"></span>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No Data Available</td>
                                        </td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            
                            <a href="{{ route('admin.fees_group') }}" class="btn btn-light">Back</a>
                            <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
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