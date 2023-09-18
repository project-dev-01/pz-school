@extends('layouts.admin-layout')
@section('title','Add Event')
@section('component_css')
<link href="{{ asset('libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />

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
<style>
    .ui-datepicker {
        width: 21.4em;
    }

    @media screen and (min-device-width: 320px) and (max-device-width: 660px) {
        .ui-datepicker {
            width: 14.4em;
        }
    }

    @media screen and (min-device-width: 360px) and (max-device-width: 740px) {
        .ui-datepicker {
            width: 17.4em;
        }
    }

    @media screen and (min-device-width: 375px) and (max-device-width: 667px) {
        .ui-datepicker {
            width: 18.6em;
        }
    }

    @media screen and (min-device-width: 390px) and (max-device-width: 844px) {
        .ui-datepicker {
            width: 19.8em;
        }
    }

    @media screen and (min-device-width: 412px) and (max-device-width: 915px) {
        .ui-datepicker {
            width: 21.5em;
        }
    }

    @media screen and (min-device-width: 540px) and (max-device-width: 720px) {
        .ui-datepicker {
            width: 31.3em;
        }
    }

    @media screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        .ui-datepicker {
            width: 13.2em;
        }
    }

    @media screen and (min-device-width: 820px) and (max-device-width: 1180px) {
        .ui-datepicker {
            width: 14.3em;
        }
    }
</style>
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">{{ __('messages.event') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.add_event') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="eventForm" method="post" action="{{ route('admin.event.add') }}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">{{ __('messages.title') }}<span class="text-danger">*</span></label>
                                    <input type="text" id="title" name="title" class="form-control" placeholder="{{ __('messages.enter_title') }}">
                                    <span class="text-danger error-text title_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type">{{ __('messages.type') }}<span class="text-danger">*</span></label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="">{{ __('messages.select') }}</option>
                                        @forelse($type as $typ)
                                        <option value="{{$typ['id']}}">{{$typ['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <span class="text-danger error-text type_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="audience">{{ __('messages.audience') }}<span class="text-danger">*</span></label>
                                    <select class="form-control" id="audience" name="audience">
                                        <option value="">{{ __('messages.select') }}</option>
                                        <option value="1">EveryBody</option>
                                        <option value="2">Selected Grade</option>
                                        <option value="3">Selected Group</option>
                                    </select>
                                    <span class="text-danger error-text audience_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4" id="class">
                                <div class="form-group">
                                    <label for="class">{{ __('messages.grade') }}</label>
                                    <select class="form-control select2-multiple" data-toggle="select2" name="class[]" id="classes" multiple="multiple" data-placeholder="Choose ...">
                                        @forelse($class as $cla)
                                        <option value="{{$cla['id']}}">{{$cla['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <span class="text-danger error-text class_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4" id="group_row">
                                <div class="form-group">
                                    <label for="group">{{ __('messages.group') }}</label>
                                    <select class="form-control select2-multiple" data-toggle="select2" name="group[]" id="group" multiple="multiple" data-placeholder="Choose ...">
                                        @forelse($group as $gro)
                                        <option value="{{$gro['id']}}">{{$gro['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <span class="text-danger error-text group_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start_date">{{ __('messages.start_date') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="start_date" id="event_start_date" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                    </div>
                                    <span class="text-danger error-text start_date_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="end_date">{{ __('messages.end_date') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="end_date" id="event_end_date" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                    </div>
                                    <span class="text-danger error-text end_date_error"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mt-3">
                                    <div class="custom-control custom-checkbox form-check">
                                        <input type="checkbox" class="custom-control-input" name="all_day" id="allDay" checked>
                                        <label class="custom-control-label" for="allDay">{{ __('messages.all_day') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mt-3">
                                    <div class="custom-control custom-checkbox form-check">
                                        <input type="checkbox" class="custom-control-input" name="holiday" id="holiday" checked>
                                        <label class="custom-control-label" for="holiday">{{ __('messages.holiday') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 time" style="display:none">
                                <div class="form-group">
                                    <label>{{ __('messages.start_time') }}</label>
                                    <input type="text" class="form-control timepicker" name="start_time" id="add_start_time">
                                    <span class="text-danger error-text start_time_error"></span>
                                </div>
                            </div>
                            <div class="col-md-3 time" style="display:none">
                                <div class="form-group">
                                    <label>{{ __('messages.end_time') }}</label>
                                    <input type="text" class="form-control timepicker" name="end_time" id="add_end_time">
                                    <span class="text-danger error-text end_time_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="description">{{ __('messages.description') }}</label>
                                    <textarea class="form-control" name="description"></textarea>
                                    <span class="text-danger error-text description_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-right m-b-0">
                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                                {{ __('messages.save') }}
                            </button>
                            <a href="{{ route('admin.event') }}" class="btn btn-primary-bl waves-effect waves-light">
                                {{ __('messages.back') }}
                            </a>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- col -->
    </div> <!-- row -->
</div> <!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('libs/mohithg-switchery/switchery.min.js') }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('libs/selectize/js/standalone/selectize.min.js') }}"></script>
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
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    //event routes
    var eventList = "{{ route('admin.event') }}";
</script>
<script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/custom/event.js') }}"></script>

@endsection