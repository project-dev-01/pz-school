@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.add_fees_group') . '')
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
@endsection
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
                        <h4 class="navv">
                        {{ __('messages.add_fees_group') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="feesGroupForm" method="post" action="{{ route('admin.fees_group.add') }}" autocomplete="off">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">{{ __('messages.fees_group_name') }}<span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('messages.enter_fees_group_name') }}">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">{{ __('messages.description') }}</label>
                                <textarea id="description" name="description" rows="3" class="form-control" placeholder="{{ __('messages.enter_description') }}"></textarea>
                            </div>
                        </div>
                        @forelse ($fees_type as $key => $type)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>
                                    <div>
                                        <label class="list-group-item list-group-item-info btn-block btn-lg" data-toggle="collapse" data-target="#FeesType{{$type['id']}}" aria-expanded="false" aria-controls="FeesType{{$type['id']}}">
                                            <input type="checkbox" class="form-group" name="fees[{{$key}}][fees_type_id]" value="{{$type['id']}}"> {{ $type['name'] }}
                                        </label>
                                    </div>
                                    </p>
                                    <div id="FeesType{{$type['id']}}" aria-expanded="false" class="collapse">
                                        <div class="card card-body">
                                            <div class="col-12">
                                                <ul class="nav nav-pills navtab-bg nav-justified">
                                                    <li class="nav-item" id="{{$Yearly_ID}}" data-fees_group_id="{{$Yearly_ID}}">
                                                        <a href="#year{{$type['id']}}" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                            {{$Yearly}}
                                                        </a>
                                                    </li>
                                                    <li class="nav-item" id="{{$Semester_ID}}" data-fees_group_id="{{$Semester_ID}}">
                                                        <a href="#semester{{$type['id']}}" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                            {{$Semester}}
                                                        </a>
                                                    </li>
                                                    <li class="nav-item" id="{{$Monthly_ID}}" data-fees_group_id="{{$Monthly_ID}}">
                                                        <a href="#monthly{{$type['id']}}" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                            {{$Monthly}}
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="year{{$type['id']}}">
                                                        <div class="row">
                                                            <div class="col-12">

                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="table-responsive">
                                                                            <table class="table dt-responsive nowrap w-100 ">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>{{ __('messages.due_date') }}</th>
                                                                                        <th>{{ __('messages.amount') }}</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <!-- hiddent feilds start-->
                                                                                            <input type="hidden" name="fees[{{$key}}][yearly_fees_details][0][payment_mode_id]" value="{{$Yearly_ID}}">
                                                                                            <input type="hidden" name="fees[{{$key}}][yearly_fees_details][0][yearly]" value="1">
                                                                                            <!-- hiddent feilds end-->
                                                                                            <input type="text" name="fees[{{$key}}][yearly_fees_details][0][due_date]" class="form-control date-picker" data-provide="datepicker" placeholder="{{ __('messages.yyyy_mm_dd') }}" style="width: 70%;">
                                                                                        </td>
                                                                                        <td> <input type="number" name="fees[{{$key}}][yearly_fees_details][0][amount]" class="form-control"></td>
                                                                                    </tr>

                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="semester{{$type['id']}}">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="table-responsive">
                                                                                <table class="table dt-responsive nowrap w-100">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>{{ __('messages.semester_name') }}</th>
                                                                                            <th>{{ __('messages.due_date') }}</th>
                                                                                            <th>{{ __('messages.amount') }}</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @forelse ($semester as $skey => $sem)
                                                                                        <tr>
                                                                                            <td>
                                                                                                <!-- hiddent feilds start-->
                                                                                                <input type="hidden" name="fees[{{$key}}][semester_fees_details][{{$skey}}][payment_mode_id]" value="{{$Semester_ID}}">
                                                                                                <input type="hidden" name="fees[{{$key}}][semester_fees_details][{{$skey}}][semester]" value="{{ $sem['id'] }}">
                                                                                                <!-- hiddent feilds end-->
                                                                                                <input type="text" disabled class="form-control" value="{{ $sem['name'] }}" style="width: 70%;">
                                                                                            </td>
                                                                                            <td><input type="text" name="fees[{{$key}}][semester_fees_details][{{$skey}}][due_date]" class="form-control date-picker" data-provide="datepicker" placeholder="{{ __('messages.yyyy_mm_dd') }}" style="width: 70%;"></td>
                                                                                            <td> <input type="number" name="fees[{{$key}}][semester_fees_details][{{$skey}}][amount]" class="form-control"></td>
                                                                                        </tr>
                                                                                        @empty
                                                                                        @endforelse
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="monthly{{$type['id']}}">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="table-responsive">
                                                                                <table class="table dt-responsive nowrap w-100">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>{{ __('messages.month_name') }}</th>
                                                                                            <th>{{ __('messages.due_date') }}</th>
                                                                                            <th>{{ __('messages.amount') }}</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @forelse ($month as $mkey => $mon)
                                                                                        <tr>
                                                                                            <td>
                                                                                                <!-- hiddent feilds start-->
                                                                                                <input type="hidden" name="fees[{{$key}}][monthly_fees_details][{{$mkey}}][payment_mode_id]" value="{{$Monthly_ID}}">
                                                                                                <input type="hidden" name="fees[{{$key}}][monthly_fees_details][{{$mkey}}][monthly]" value="{{ $mon['id'] }}">
                                                                                                <!-- hiddent feilds end-->
                                                                                                <input type="text" disabled class="form-control" value="{{ __('messages.' . strtolower($mon['name'])) }}" style="width: 70%;">
                                                                                            </td>
                                                                                            <td><input type="text" name="fees[{{$key}}][monthly_fees_details][{{$mkey}}][due_date]" class="form-control date-picker" data-provide="datepicker" placeholder="{{ __('messages.yyyy_mm_dd') }}" style="width: 70%;"></td>
                                                                                            <td> <input type="number" name="fees[{{$key}}][monthly_fees_details][{{$mkey}}][amount]" class="form-control"></td>
                                                                                        </tr>
                                                                                        @empty
                                                                                        @endforelse
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
                        @empty
                        @endforelse
                        <div class="form-group">
                            <a href="{{ route('admin.fees_group') }}" class="btn btn-light">{{ __('messages.back') }}</a>
                            <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.save') }}</button>
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
    //event routes
    var feesGroupList = "{{ route('admin.fees_group') }}";
</script>

<script src="{{ asset('js/custom/fees_group.js') }}"></script>

@endsection