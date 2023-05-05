@extends('layouts.admin-layout')
@section('title','Edit Hostel Group')
@section('component_css')
<link href="{{ asset('public/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
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
<link href="{{ asset('public/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('css')
<link href="{{ asset('public/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">{{ __('messages.hostel_group') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.edit_hostel_group') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="hostelGroupEditForm" method="post" action="{{ route('admin.hostel_group.update') }}" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" value="{{$group['id']}}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">{{ __('messages.group_name') }}<span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('messages.enter_group_name') }}" value="{{$group['name']}}">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="incharge_staff">{{ __('messages.incharge_staff') }}</label>
                                    <select class="form-control" name="incharge_staff">
                                        <option value="">{{ __('messages.select_incharge_staff') }}</option>
                                        @forelse($staff as $st)
                                        <option value="{{$st['id']}}" {{ $group['incharge_staff'] == $st['id'] ? "Selected" : ""}}>{{$st['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="incharge_student">{{ __('messages.incharge_student') }}</label>
                                    <select class="form-control" name="incharge_student">
                                        <option value="">{{ __('messages.select_incharge_student') }}</option>
                                        @forelse($student as $stu)
                                        <option value="{{$stu['id']}}" {{ $group['incharge_student'] == $stu['id'] ? "Selected" : ""}}>{{$stu['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="student">{{ __('messages.student') }}</label>
                                    <select class="form-control select2-multiple" data-toggle="select2" name="student[]" multiple="multiple" data-placeholder="{{ __('messages.choose_the_student') }}">
                                        <option value="">{{ __('messages.select_student') }}</option>
                                        @forelse($student as $stu)
                                        @php
                                        $selected = "";
                                        @endphp
                                        @foreach(explode(',', $group['student']) as $info)
                                        @if($stu['id'] == $info)
                                        @php
                                        $selected = "Selected";
                                        @endphp
                                        @endif
                                        @endforeach
                                        <option value="{{$stu['id']}}" {{ $selected }}>{{$stu['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="color"> {{ __('messages.color') }} <span class="text-danger">*</span></label>
                                    <input type="text" id="color" name="color" class="form-control color" placeholder="{{ __('messages.choose_color') }}" value="{{$group['color']}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-right m-b-0">
                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                            {{ __('messages.update') }}
                            </button>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- col -->
    </div> <!-- row -->
</div> <!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('public/libs/mohithg-switchery/switchery.min.js') }}"></script>
<script src="{{ asset('public/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('public/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('public/libs/selectize/js/standalone/selectize.min.js') }}"></script>
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
    //HostelGroup routes
    var hostelGroupList = "{{ route('admin.hostel_group') }}";
    var hostelGroupDetails = "{{ route('admin.hostel_group.details') }}";
    var hostelGroupDelete = "{{ route('admin.hostel_group.delete') }}";
</script>
<script src="{{ asset('public/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('public/js/pages/form-pickers.init.js') }}"></script>
<script src="{{ asset('public/js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('public/js/custom/hostel_group.js') }}"></script>

@endsection