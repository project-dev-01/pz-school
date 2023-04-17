@extends('layouts.admin-layout')
@section('title','Edit Fees group')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">{{ __('messages.fees_group') }}</h4>
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
                                <label for="name">{{ __('messages.fees_group_name') }}<span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" value="{{$fees_group['name']}}" class="form-control" placeholder="{{ __('messages.enter_fees_group_name') }}">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" rows="3" class="form-control" placeholder="{{ __('messages.enter_description') }}">{{$fees_group['description']}}</textarea>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            Edit Fees Group
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>
                                    <div>
                                        <a class="list-group-item list-group-item-info btn-block btn-lg" data-toggle="collapse" href="#English" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fas fa-check-square"></i> {{ __('messages.fees_details') }}
                                        </a>
                                    </div>
                                    </p>
                                    <div class="collapse" id="English">
                                        <div class="card card-body">
                                            <div class="col-12">
                                                <ul class="nav nav-pills navtab-bg nav-justified" id="">
                                                    <li class="nav-item" id="" data-fees_group_id="" data-allocation_id="" data-paid_amount="5000">
                                                        <a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                            Yearly Fees
                                                        </a>
                                                    </li>
                                                    <li class="nav-item" id="" data-fees_group_id="" data-allocation_id="1" data-paid_amount="6000">
                                                        <a href="#profile1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                            Semester Fees
                                                        </a>
                                                    </li>
                                                    <li class="nav-item" id="" data-fees_group_id="" data-allocation_id="" data-paid_amount="8000">
                                                        <a href="#messages1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                            Monthly Fees
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="home1">
                                                        <div class="row">
                                                            <div class="col-12">

                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="table-responsive">
                                                                            <table class="table dt-responsive nowrap w-100 ">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th> #</th>
                                                                                        <th>Due Date</th>
                                                                                        <th>{{ __('messages.amount') }}</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><input type="checkbox"></td>
                                                                                        <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY" style="width: 70%;"></td>
                                                                                        <td> <input type="number" name="" class="form-control" value="5000"></td>
                                                                                    </tr>

                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="profile1">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="table-responsive">
                                                                                <table class="table dt-responsive nowrap w-100">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th> #</th>
                                                                                            <th>Due Date</th>
                                                                                            <th>{{ __('messages.amount') }}</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td><input type="checkbox"></td>
                                                                                            <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY" style="width: 70%;"></td>
                                                                                            <td> <input type="number" name="" class="form-control" value="5000"></td>
                                                                                        </tr>

                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="messages1">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="table-responsive">
                                                                                <table class="table dt-responsive nowrap w-100">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th> #</th>
                                                                                            <th>Due Date</th>
                                                                                            <th>{{ __('messages.amount') }}</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td><input type="checkbox"></td>
                                                                                            <td><input type="text" class="form-control" data-provide="datepicker" placeholder="MM/DD/YYYY" style="width: 70%;"></td>
                                                                                            <td> <input type="number" name="" class="form-control" value="5000"></td>
                                                                                        </tr>

                                                                                    </tbody>
                                                                                </table>
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

                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

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