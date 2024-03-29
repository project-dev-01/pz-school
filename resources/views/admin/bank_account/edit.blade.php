@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.edit_bank_account') . '')
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
@section('css')

<link rel="stylesheet" href="{{ asset('mobile-country/css/intlTelInput.css') }}">
<link rel="stylesheet" href="{{ asset('country/css/countrySelect.css') }}">
<style>
    

    .country-select {
        display: block;
    }
    </style>

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

                <h4 class="page-title">{{ __('messages.bank_account') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.edit_bank_account') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="bankAccountEditForm" method="post" action="{{ route('admin.bank_account.update') }}" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" value="{{isset($bank_account['id']) ? $bank_account['id'] : ''}}">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_name">{{ __('messages.bank_name') }}<span class="text-danger">*</span></label>
                                    <select class="form-control select2" data-toggle="select2" id="bank_name" name="bank_name"  data-placeholder="{{ __('messages.select_bank') }}">
                                        <option value="">{{ __('messages.select_bank') }}</option>
                                        @forelse($bank as $bk)
                                        <option value="{{$bk['id']}}"  {{ isset($bank_account['bank_name']) ? $bank_account['bank_name'] == $bk['id'] ? 'selected' : '' : '' }}>{{$bk['name']}}</option>
                                        @empty
                                        @endforelse

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="holder_name">{{ __('messages.account_holder') }}<span class="text-danger">*</span></label>
                                    <input type="text" id="holder_name" value="{{ isset($bank_account['holder_name']) ? $bank_account['holder_name']:''}}" class="form-control" name="holder_name" placeholder="{{ __('messages.enter_account_holder') }}" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_branch">{{ __('messages.bank_branch') }}</label>
                                    <input type="text" id="bank_branch" value="{{ isset($bank_account['bank_branch']) ? $bank_account['bank_branch']:'' }}" class="form-control" name="bank_branch" placeholder="{{ __('messages.enter_bank_branch') }}" data-parsley-trigger="change">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="ifsc_code">{{ __('messages.ifsc_code') }}</label>
                                    <input type="text" class="form-control" value="{{ isset($bank_account['ifsc_code']) ? $bank_account['ifsc_code']:''}}" id="ifsc_code" name="ifsc_code" placeholder="{{ __('messages.enter_ifsc_code') }}" aria-describedby="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="">{{ __('messages.account_no') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ isset($bank_account['account_no']) ? $bank_account['account_no']:'' }}" id="account_no" name="account_no" placeholder="{{ __('messages.enter_account_no') }}" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="bank_address">{{ __('messages.address_1') }}</label>
                                    <input type="text" class="form-control" value="{{ isset($bank_account['bank_address']) ? $bank_account['bank_address']:'' }}" id="bank_address" name="bank_address" placeholder="{{ __('messages.enter_bank_address') }}" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_address_2">{{ __('messages.address_2') }}</label>
                                    <input class="form-control" name="bank_address_2" value="{{$bank_account['bank_address_2']}}" id="bank_address_2" placeholder="{{ __('messages.enter_address_2') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">{{ __('messages.city') }}</label>
                                    <input type="text"  class="form-control" name="city" value="{{$bank_account['city']}}" id="city" placeholder="{{ __('messages.enter_city') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state">{{ __('messages.state_province') }}</label>
                                    <input type="text" class="form-control" name="state" value="{{$bank_account['state']}}" id="state" placeholder="{{ __('messages.enter') }} {{ __('messages.state_province') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="post_code">{{ __('messages.zip_postal_code') }}</label>
                                    <input type="text"  class="form-control" name="post_code" value="{{$bank_account['post_code']}}" id="post_code" placeholder="{{ __('messages.enter') }} {{ __('messages.zip_postal_code') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country">{{ __('messages.country') }}</label>
                                    <input type="text" class="form-control" name="country" value="{{$bank_account['country']}}" id="country" placeholder="{{ __('messages.country') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="routing_number">{{ __('messages.routing_number') }}</label>
                                    <input type="text" class="form-control" name="routing_number" value="{{$bank_account['routing_number']}}" id="routing_number" placeholder="{{ __('messages.routing_number') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="swift_code">{{ __('messages.swift_code') }}</label>
                                    <input type="text" class="form-control" name="swift_code" value="{{$bank_account['swift_code']}}" id="swift_code" placeholder="{{ __('messages.swift_code') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{$bank_account['email']}}" name="email" id="email" placeholder="{{ __('messages.email') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="status" id="status" {{ isset($bank_account['status']) ? $bank_account['status'] == "1" ? "checked" : ""  : ""}}>
                                    <label class="custom-control-label" for="status">{{ __('messages.status') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                                {{ __('messages.update') }}
                            </button>
                            <a href="{{ route('admin.bank_account') }}" class="btn btn-primary-bl waves-effect waves-light">
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
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('mobile-country/js/intlTelInput.js') }}"></script>
<script src="{{ asset('country/js/countrySelect.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    $("#country").countrySelect({
        defaultCountry: "my",
        responsiveDropdown: true
    });
</script>
<script>
    //bankAccount routes
    var bankAccountList = "{{ route('admin.bank_account') }}";
    var getBankByCountry = "{{ config('constants.api.bank_list') }}";
</script>
<script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/custom/bank_account.js') }}"></script>

@endsection