@extends('layouts.admin-layout')
@section('title',' ' . __('messages.edit_termination') . '')
@section('component_css')
<link href="{{ asset('libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

@endsection
@section('content')
@section('css')
<link rel="stylesheet" href="{{ asset('libs/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('libs/dropify/css/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('mobile-country/css/intlTelInput.css') }}">
<link rel="stylesheet" href="{{ asset('country/css/countrySelect.css') }}">
<style>
    .switch {
        height: 24px;
        display: block;
        position: relative;
        cursor: pointer;
    }

    .switch input {
        display: none;
    }

    .switch input+span {
        padding-left: 50px;
        min-height: 24px;
        line-height: 24px;
        display: block;
        color: #99a3ba;
        position: relative;
        vertical-align: middle;
        white-space: nowrap;
        transition: color 0.3s ease;
    }

    .switch input+span:before,
    .switch input+span:after {
        content: '';
        display: block;
        position: absolute;
        border-radius: 12px;
    }

    .switch input+span:before {
        top: 0;
        left: 0;
        width: 42px;
        height: 24px;
        background: #e4ecfa;
        transition: all 0.3s ease;
    }

    .switch input+span:after {
        width: 18px;
        height: 18px;
        background: #fff;
        top: 3px;
        left: 3px;
        box-shadow: 0 1px 3px rgba(18, 22, 33, .1);
        transition: all 0.45s ease;
    }

    .switch input+span em {
        width: 8px;
        height: 7px;
        background: #99a3ba;
        position: absolute;
        left: 8px;
        bottom: 7px;
        border-radius: 2px;
        display: block;
        z-index: 1;
        transition: all 0.45s ease;
    }

    .switch input+span em:before {
        content: '';
        width: 2px;
        height: 2px;
        border-radius: 1px;
        background: #fff;
        position: absolute;
        display: block;
        left: 50%;
        top: 50%;
        margin: -1px 0 0 -1px;
    }

    .switch input+span em:after {
        content: '';
        display: block;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        border: 1px solid #99a3ba;
        border-bottom: 0;
        width: 6px;
        height: 4px;
        left: 1px;
        bottom: 6px;
        position: absolute;
        z-index: 1;
        transform-origin: 0 100%;
        transition: all 0.45s ease;
        transform: rotate(-35deg) translate(0, 1px);
    }

    .switch input+span strong {
        font-weight: normal;
        position: relative;
        display: block;
        top: 1px;
    }

    .switch input+span strong:before,
    .switch input+span strong:after {
        font-size: 14px;
        font-weight: 500;
        display: block;
        font-family: 'Mukta Malar', Arial;
        -webkit-backface-visibility: hidden;
    }

    .switch input+span strong:before {
        transition: all 0.3s ease 0.2s;
    }

    .switch input+span strong:after {
        opacity: 0;
        visibility: hidden;
        position: absolute;
        left: 0;
        top: 0;
        color: #007bff;
        transition: all 0.3s ease;
        transform: translate(2px, 0);
    }

    .switch input:checked+span:before {
        background: rgba(0, 123, 255, .35);
    }

    .switch input:checked+span:after {
        background: #fff;
        transform: translate(18px, 0);
    }

    .switch input:checked+span em {
        transform: translate(18px, 0);
        background: #007bff;
    }

    .switch input:checked+span em:after {
        border-color: #007bff;
        transform: rotate(0deg) translate(0, 0);
    }

    .switch input:checked+span strong:before {
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        transform: translate(-2px, 0);
    }

    .switch input:checked+span strong:after {
        opacity: 1;
        visibility: visible;
        transform: translate(0, 0);
        transition: all 0.3s ease 0.2s;
    }

    html {
        -webkit-font-smoothing: antialiased;
    }

    * {
        box-sizing: border-box;
    }

    *:before,
    *:after {
        box-sizing: border-box;
    }

    .switch {
        display: table;
        margin: 12px auto;
        min-width: 118px;
    }

    .dribbble {
        position: fixed;
        display: block;
        right: 20px;
        bottom: 20px;
    }

    .dribbble img {
        display: block;
        height: 28px;
    }

    .iti {
        display: block;
    }

    .country-select {
        display: block;
    }

    .ui-datepicker {
        width: 20.2em;
    }

    @media screen and (min-device-width: 320px) and (max-device-width: 660px) {
        .ui-datepicker {
            width: 14em;
        }
    }

    @media screen and (min-device-width: 360px) and (max-device-width: 740px) {
        .ui-datepicker {
            width: 13.9em;
        }
    }

    @media screen and (min-device-width: 375px) and (max-device-width: 667px) {
        .ui-datepicker {
            width: 14.8em;
        }
    }

    @media screen and (min-device-width: 390px) and (max-device-width: 844px) {
        .ui-datepicker {
            width: 16em;
        }
    }

    @media screen and (min-device-width: 412px) and (max-device-width: 915px) {
        .ui-datepicker {
            width: 17.8em;
        }
    }

    @media screen and (min-device-width: 540px) and (max-device-width: 720px) {
        .ui-datepicker {
            width: 27.6em;
        }
    }

    @media screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        .ui-datepicker {
            width: 13.2em;
        }
    }

    @media screen and (min-device-width: 820px) and (max-device-width: 1180px) {
        .ui-datepicker {
            width: 13.3em;
        }
    }
</style>
@if(Session::get('locale')=="en")
<style>
    .switch input+span strong:before {
        content: 'Unlock';
    }

    .switch input+span strong:after {
        content: 'Lock';
    }
</style>
@endif
@if(Session::get('locale')=="japanese")
<style>
    .switch input+span strong:before {
        content: 'アンロック';
    }

    .switch input+span strong:after {
        content: 'ロック';
    }
</style>
@endif
@endsection
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <!-- <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Wizard</li>
                    </ol>-->
                </div>
                <h4 class="page-title">{{ __('messages.edit_termination') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <form id="terminationEditForm" method="post" action="{{ route('parent.termination.update') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{$termination['id']}}">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">
                                    {{ __('messages.termination_details') }}
                                    <h4>
                            </li>
                        </ul><br>
                        @php
                        $readonly = "";
                        $disabled = "";
                        if($termination['termination_status']=="Approved") {
                        $readonly = "readonly";
                        $disabled = "disabled";
                        }
                        @endphp
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="student_id">{{ __('messages.student') }}<span class="text-danger">*</span></label>
                                        <select id="student_id" name="student_id" class="form-control" disabled>
                                            <option value="">{{ __('messages.select_student') }}</option>
                                            @if(Session::get('all_child'))
                                            @forelse (Session::get('all_child') as $child)
                                            <option value="{{ $child['id'] }}" {{ $termination['student_id'] == $child['id'] ? 'selected' : ''}}>{{ $child['name'] }}</option>
                                            @empty
                                            @endforelse
                                            @endif
                                        </select>
                                        <input type="hidden" value="{{$termination['student_id']}}" name="student_id">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="control_number">{{ __('messages.control_number') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="control_number" {{$readonly}} value="{{ $termination['control_number']}}" readonly name="control_number" placeholder="{{ __('messages.enter_school_name') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date">{{ __('messages.apply_date') }}</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control" id="date" disabled value="{{ $termination['date']}}" name="date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="far fa-calendar-alt"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{$termination['date']}}" name="date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="schedule_date_of_termination">{{ __('messages.scheduled_date_of_termination_5_business_day') }}</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control" {{$disabled}} id="schedule_date_of_termination" value="{{ $termination['schedule_date_of_termination']}}" name="schedule_date_of_termination" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="far fa-calendar-alt"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if($disabled == "disabled")
                                        <input type="hidden" value="{{$termination['schedule_date_of_termination']}}" name="schedule_date_of_termination">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="reason_for_transfer">{{ __('messages.reason_for_transfer') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" {{$readonly}} id="reason_for_transfer" value="{{ $termination['reason_for_transfer']}}" name="reason_for_transfer" placeholder="{{ __('messages.enter_scheduled_date_of_termination') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="transfer_destination_school_name">{{ __('messages.transfer_destination_school_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" {{$readonly}} id="transfer_destination_school_name" value="{{ $termination['transfer_destination_school_name']}}" name="transfer_destination_school_name" placeholder="{{ __('messages.enter_transfer_destination_school_name') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="transfer_destination_tel">{{ __('messages.transfer_destination_tel') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control number_validation" {{$readonly}} id="transfer_destination_tel" value="{{ $termination['transfer_destination_tel']}}" name="transfer_destination_tel" placeholder="{{ __('messages.enter_transfer_destination_tel') }}" aria-describedby="inputGroupPrepend">
                                        <label for="transfer_destination_tel" class="error"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="parent_phone_number_after_transfer">{{ __('messages.parent_guardian_phone_number_after_transfer') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control number_validation" {{$readonly}} id="parent_phone_number_after_transfer" value="{{ $termination['parent_phone_number_after_transfer']}}" name="parent_phone_number_after_transfer" placeholder="{{ __('messages.enter_parent_guardian_phone_number_after_transfer') }} " aria-describedby="inputGroupPrepend">
                                        <label for="parent_phone_number_after_transfer" class="error"></label>	
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="parent_email_address_after_transfer">{{ __('messages.parent_email_address_after_transfer') }}<span class="text-danger">*</span></label>
                                        
                                            <input type="text" name="parent_email_address_after_transfer" {{$readonly}} value="{{ $termination['parent_email_address_after_transfer']}}" class="form-control" id="parent_email_address_after_transfer" placeholder="xxxxx@gmail.com" aria-describedby="inputGroupPrepend">
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="parent_address_after_transfer">{{ __('messages.parent_address_after_transfer') }}<span class="text-danger">*</span></label>
                                        <textarea type="text" class="form-control" {{$readonly}} id="parent_address_after_transfer" name="parent_address_after_transfer" placeholder="{{ __('messages.enter_parent_address_after_transfer') }} " aria-describedby="inputGroupPrepend">{{ $termination['parent_address_after_transfer']}}</textarea>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="school_fees_payment_status">{{ __('messages.school_fees_payment_status') }}<span class="text-danger">*</span></label>
                                        <select id="school_fees_payment_status" name="school_fees_payment_status" class="form-control"  {{$disabled}}>
                                            <option value="">{{ __('messages.select_payment_status') }}</option>
                                            <option value="Paid" {{ $termination['school_fees_payment_status'] == "Paid" ? 'selected' : ''}}>{{ __('messages.paid') }}</option>
                                            <option value="Unpaid" {{ $termination['school_fees_payment_status'] == "Unpaid" ? 'selected' : ''}}>{{ __('messages.unpaid') }}</option>
                                        </select>
                                        @if($disabled == "disabled")
                                        <input type="hidden" value="{{$termination['school_fees_payment_status']}}" name="school_fees_payment_status">
                                        @endif
                                    </div>
                                </div> -->
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="termination_status">{{ __('messages.status') }}<span class="text-danger">*</span></label>
                                        <select id="termination_status" class="form-control" name="termination_status" >
                                            <option value="">{{ __('messages.select_status') }}</option>
                                            <option value="Approved" {{ $termination['termination_status'] == 'Approved' ? 'selected' : ''}}>{{ __('messages.approved') }}</option>
                                            <option value="Pending" {{ $termination['termination_status'] == 'Pending' ? 'selected' : ''}}>{{ __('messages.pending') }}</option>
                                            <option value="Send Back" {{ $termination['termination_status'] == "Send Back" ? 'selected' : ''}}>{{ __('messages.send_back') }}</option>
                                            <option value="Rejected" {{ $termination['termination_status'] == "Rejected" ? 'selected' : ''}}>{{ __('messages.rejected') }}</option>
                                        </select>
                                        <input type="hidden" value="{{$termination['termination_status']}}" name="termination_status">
                                       
                                    </div>
                                </div>
                                @if($termination['termination_status']=="Rejected" || $termination['termination_status'] == "Send Back")
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="remarks">{{ __('messages.remarks') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="remarks" value="{{$termination['remarks']}}" name="remarks" placeholder="{{ __('messages.enter_remarks') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                @endif -->
                                @if($termination['termination_status']=="Approved")
                                <input type="hidden" value="{{ $termination['date_of_termination']}}" name="old_date_of_termination">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date_of_termination">{{ __('messages.date_of_termination') }}<span class="text-danger">*</span></label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="far fa-calendar-alt"></span>
                                                </div>
                                            </div>
                                            
                                            <input type="text" class="form-control datepicker" value="{{$termination['date_of_termination']}}"  {{ $termination['date_of_termination'] < date('Y-m-d') ? 'disabled' : ''}} id="date_of_termination" name="date_of_termination" aria-describedby="inputGroupPrepend">
                                        </div>
                                        @if($termination['date_of_termination'] < date('Y-m-d'))
                                        <input type="hidden" value="{{ $termination['date_of_termination']}}" name="date_of_termination">
                                        @endif
                                    </div>
                                </div>
                                @endif
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="delete_google_address">{{ __('messages.delete_google_address') }}<span class="text-danger">*</span></label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input allDayCheck"  {{$disabled}} {{ $termination['delete_google_address'] == 'Yes' ? 'checked' : ''}} id="delete_google_address" name="delete_google_address">
                                            <label class="custom-control-label" for="delete_google_address"></label>
                                        </div>
                                        @if($disabled == "disabled")
                                        <input type="hidden" value="{{ $termination['delete_google_address']}}" name="delete_google_address">
                                        @endif
                                    </div>
                                </div> -->
                            </div><br>
                            <!-- </div><br>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">
                                    {{ __('messages.status') }}
                                    <h4>
                            </li>
                        </ul>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="enrollment">{{ __('messages.enrollment') }}<span class="text-danger">*</span></label>
                                        <select id="enrollment" disabled name="enrollment" class="form-control">
                                            <option value="">{{ __('messages.enrollment') }}</option>
                                            <option selected>Trail</option>
                                            <option>Official</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">{{ __('messages.status') }}<span class="text-danger">*</span></label>
                                        <select id="m"  name="m" class="form-control">
                                            <option value="">{{ __('messages.status') }}</option>
                                            <option>Withdraw Planned</option>
                                            <option>Reject</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                            <!-- <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">
                                    {{ __('messages.email_verification') }}
                                    <h4>
                            </li>
                        </ul>
                        <div class="card-body">
                            <div id="guardian_details">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="radio radio-success form-check-inline">
                                                <input type="radio" class="verify_email" id="mother" value="Seyon"  disabled name="verify_email" value="mother" checked="">
                                                <label for="mother"> Mother </label>
                                            </div>
                                            <div class="radio radio-success form-check-inline">
                                                <input type="radio" class="verify_email" id="father" value="Seyon"  disabled name="verify_email" value="father">
                                                <label for="father"> Father </label>
                                            </div>
                                            <div class="radio radio-success form-check-inline">
                                                <input type="radio" class="verify_email" id="guardian" value="Seyon"  disabled name="verify_email" value="guardian">
                                                <label for="guardian"> Guardian </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr> -->
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" id="submit" type="submit">
                                    {{ __('messages.update') }}
                                </button>
                                <a href="{{ route('parent.termination.index') }}" class="btn btn-primary-bl waves-effect waves-light">
                                    {{ __('messages.back') }}
                                </a>
                            </div>

                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div><!-- end row -->
</div> <!-- container -->
@endsection
@section('scripts')

<script>
    var terminationList = "{{ route('parent.termination.index') }}";
</script>
<!-- Plugins js-->
<script src="{{ asset('libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>

<!-- Init js-->
<script src="{{ asset('js/pages/form-wizard.init.js')}}"></script>
<script src="{{ asset('js/validation/validation.js') }}"></script>


<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>

<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script src="{{ asset('js/validation/validation.js') }}"></script>
<!-- Init js-->
<script src="{{ asset('mobile-country/js/intlTelInput.js') }}"></script>
<script src="{{ asset('country/js/countrySelect.js') }}"></script>
<script src="{{ asset('js/custom/parent_termination.js') }}"></script>

<script>
    toastr.options.preventDuplicates = true;
</script>

<script>
    var input = document.querySelector("#transfer_destination_tel");
    intlTelInput(input, {
        allowExtensions: true,
        autoFormat: false,
        autoHideDialCode: false,
        autoPlaceholder: false,
        defaultCountry: "auto",
        ipinfoToken: "yolo",
        nationalMode: false,
        numberType: "MOBILE",
        initialCountry: "my",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        preferredCountries: ['my', 'jp'],
        preventInvalidNumbers: true,
        // utilsScript: "js/utils.js"
    });

    
    var input = document.querySelector("#parent_phone_number_after_transfer");
    intlTelInput(input, {
        allowExtensions: true,
        autoFormat: false,
        autoHideDialCode: false,
        autoPlaceholder: false,
        defaultCountry: "auto",
        ipinfoToken: "yolo",
        nationalMode: false,
        numberType: "MOBILE",
        initialCountry: "my",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        preferredCountries: ['my', 'jp'],
        preventInvalidNumbers: true,
        // utilsScript: "js/utils.js"
    });

    $(".country").countrySelect({
        defaultCountry: "my",
        preferredCountries: ['my', 'jp'],
        responsiveDropdown: true
    });

    $("#date_of_birth").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
        maxDate: 0
    });
</script>

<!-- <script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script> -->
@endsection