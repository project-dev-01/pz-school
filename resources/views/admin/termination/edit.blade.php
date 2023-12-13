@extends('layouts.admin-layout')
@section('title','Edit Termination')
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
                <h4 class="page-title">Edit Termination</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <form id="editApplication" method="post" action="" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <input type="hidden" id="id" value="Seyon" disabled name="id" value="{{ isset($application['id']) ? $application['id'] : ''}}">

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">
                                    Termination {{ __('messages.details') }}
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="academic_year">{{ __('messages.student') }}<span class="text-danger">*</span></label>
                                        <select id="academic_year" disabled   name="academic_year" class="form-control">
                                            <option value="">{{ __('messages.select_student') }}</option>
                                            <option selected>Daniel</option>
                                            <option >Edwin</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="school_last_attended">Control Number<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="school_last_attended" value="230089" disabled name="school_last_attended" placeholder="{{ __('messages.enter_school_name') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date_of_birth">{{ __('messages.date') }}</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control" disabled id="date_of_birth" name="date_of_birth" value="2023-10-26" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="far fa-calendar-alt"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date_of_birth">Scheduled date of Termination</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control" disabled id="date_of_birth" disabled name="date_of_birth" value="2023-12-02"  placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="far fa-calendar-alt"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="school_last_attended">Resaon for Transfer<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="school_last_attended" disabled value="Job Transfer"  name="school_last_attended" placeholder="{{ __('messages.enter_school_name') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="school_last_attended">Transfer Destination School Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="school_last_attended" disabled value="KMHHS"  name="school_last_attended" placeholder="{{ __('messages.enter_school_name') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="school_last_attended">Transfer Destination TEL<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="school_last_attended" disabled value="+91-6716767210"  name="school_last_attended" placeholder="{{ __('messages.enter_school_name') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="school_last_attended">Parent/Guardian Phone Number after Transfer<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="school_last_attended" disabled value="+91-8987819812"  name="school_last_attended" placeholder="{{ __('messages.enter_school_name') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="school_last_attended">Parent Email Address after Transfer<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="school_last_attended" disabled value="michael@gamil.com"  name="school_last_attended" placeholder="{{ __('messages.enter_school_name') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="school_last_attended">Parent Address after Transfer<span class="text-danger">*</span></label>
                                        <textarea type="textarea" class="form-control" id="school_last_attended" disabled  name="school_last_attended" placeholder="{{ __('messages.enter_school_name') }}" aria-describedby="inputGroupPrepend">32 NT St, Johor, Malaysia</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="school_last_attended">Status<span class="text-danger">*</span></label>
                                        <select id="changeStdName" disabled class="form-control" name="changeStdName">
                                        <option value="">Select Status</option>
                                        <option selected value="">Approved</option>
                                        <option value="">Pending</option>
                                        <option value="">Rejected</option>
                                    </select></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date_of_birth">Date of Termination</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control"  id="date_of_birth" name="date_of_birth" value="2023-12-22"  placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="far fa-calendar-alt"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                <a href="{{ route('admin.application.index') }}" class="btn btn-primary-bl waves-effect waves-light">
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
    var applicationList = "{{ route('admin.application.list') }}";
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
<!-- <script src="{{ asset('js/custom/admin_application.js') }}"></script> -->

<script>
    toastr.options.preventDuplicates = true;
</script>

<script>
    var input = document.querySelector(".mobile_no");
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