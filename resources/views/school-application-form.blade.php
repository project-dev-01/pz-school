<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ __('messages.school_application_from') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ config('constants.image_url').'/public/images/favicon.ico'}}">

    <!-- App css -->
    <link href="{{ asset('public/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('public/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{ asset('public/css/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('public/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('public/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/common.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/opensans-font.css') }}" rel="stylesheet" type="text/css" />

    
    <!-- date picker -->
    <link href="{{ asset('public/date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/date-picker/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- toaster alert -->
    <link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/mobile-country/css/intlTelInput.css') }}">
    <link rel="stylesheet" href="{{ asset('public/country/css/countrySelect.css') }}">

    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body class="loading" style="background-color:#2F2F8F">
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center w-75 m-auto">
                        <div class="auth-logo">
                            <a href="" class="logo logo-dark text-center">
                                <span class="logo-lg">
                                    <img src="{{ config('constants.image_url').'/public/images/logo-dark.png'}}" alt="" height="50">
                                </span>
                            </a>
                        </div>
                        <h3 class="text-center" style="color:#596368">{{ __('messages.student_application_form') }}</h3>
                    </div>
                    <hr style="border:1px solid #6FC6CC">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <h4 class="navv">
                                    {{ __('messages.student_details') }} 
                                        <h4>
                                </li>
                            </ul><br>
                            <form id="addApplication" method="post" action="{{ route('application.add') }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="first_name" name="first_name" maxlength="50" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="last_name">{{ __('messages.last_name') }}</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name" maxlength="50" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gender">{{ __('messages.gender') }}</label>
                                                <select id="gender" name="gender" class="form-control" >
                                                    <option value="">{{ __('messages.select_gender') }}</option>
                                                    <option value="Male">{{ __('messages.male') }}</option>
                                                    <option value="Female">{{ __('messages.female') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="date_of_birth">{{ __('messages.date_of_birth') }}</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend" >
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
                                                <label for="mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control number_validation mobile_no" id="mobile_no" name="mobile_no" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address_1">{{ __('messages.address_1') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="address_1" name="address_1" placeholder="{{ __('messages.enter_address_1') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address_2">{{ __('messages.address_2') }}<br></label>
                                                <input type="text" class="form-control" id="address_2" name="address_2" placeholder="{{ __('messages.enter_address_2') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="country">{{ __('messages.country') }}<span class="text-danger">*</span></label>
                                                <input type="text" maxlength="50" id="country" class="form-control country" placeholder="{{ __('messages.country') }}" name="country" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="state">{{ __('messages.state') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="state" name="state" placeholder="{{ __('messages.enter') }} {{ __('messages.state') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="city">{{ __('messages.city') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="city" name="city" placeholder="{{ __('messages.enter_city') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="postal_code">{{ __('messages.postal_code') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="{{ __('messages.enter') }} {{ __('messages.postal_code') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                        {{ __('messages.school_information') }}
                                            <h4>
                                    </li>
                                </ul><br>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="grade">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="grade" name="grade" placeholder="{{ __('messages.enter') }} {{ __('messages.grade') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="school_year">{{ __('messages.school_year') }}<span class="text-danger">*</span></label>
                                                <select id="school_year" name="school_year" class="form-control" >
                                                    <option value="">{{ __('messages.select') }} {{ __('messages.school_year') }}</option>
                                                    @forelse($academic_year_list as $r)
                                                    <option value="{{$r['id']}}">{{$r['name']}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="school_last_attended">{{ __('messages.school_last_attended') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="school_last_attended" name="school_last_attended" placeholder="{{ __('messages.enter') }} {{ __('messages.school_last_attend') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="school_address_1">{{ __('messages.school_address1') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="school_address_1" name="school_address_1" placeholder="{{ __('messages.enter_address_1') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="school_address_2">{{ __('messages.school_address2') }}<br></label>
                                                <input type="text" class="form-control" id="school_address_2" name="school_address_2" placeholder="{{ __('messages.enter_address_2') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="school_country">{{ __('messages.country') }}<span class="text-danger">*</span></label>
                                                <input type="text" maxlength="50" id="school_country" name="school_country" class="form-control country" placeholder="{{ __('messages.country') }}" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="school_state">{{ __('messages.state') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="school_state" name="school_state" placeholder="{{ __('messages.enter') }} {{ __('messages.state') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="school_city">{{ __('messages.city') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="school_city" name="school_city" placeholder="{{ __('messages.enter') }} {{ __('messages.state') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="school_postal_code">{{ __('messages.postal_code') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="school_postal_code" name="school_postal_code" placeholder="{{ __('messages.enter') }} {{ __('messages.postal_code') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                        {{ __('messages.mother_details') }}
                                            <h4>
                                    </li>
                                </ul><br>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mother_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="mother_first_name" name="mother_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mother_last_name">{{ __('messages.last_name') }}</label>
                                                <input type="text" class="form-control" id="mother_last_name" name="mother_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mother_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="mother_email" name="mother_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mother_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="mother_phone_number" name="mother_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mother_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                <select id="mother_occupation" name="mother_occupation" class="form-control" >
                                                    <option value="">{{ __('messages.select_occupation') }}</option>
                                                    <option>Business</option>
                                                    <option>IT/ Software</option>
                                                    <option>Civil department</option>
                                                    <option>Others</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                        {{ __('messages.father_details') }}
                                            <h4>
                                    </li>
                                </ul><br>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="father_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="father_first_name" name="father_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="father_last_name">{{ __('messages.last_name') }}</label>
                                                <input type="text" class="form-control" id="father_last_name" name="father_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="father_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="father_email" name="father_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="father_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="father_phone_number" name="father_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="father_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                <select id="father_occupation" name="father_occupation" class="form-control" >
                                                    <option value="">{{ __('messages.select_occupation') }}</option>
                                                    <option>Business</option>
                                                    <option>IT/ Software</option>
                                                    <option>Civil department</option>
                                                    <option>Others</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                        {{ __('messages.guardian_details') }}
                                            <h4>
                                    </li>
                                </ul><br>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="guardian_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="guardian_first_name" name="guardian_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="guardian_last_name">{{ __('messages.last_name') }}</label>
                                                <input type="text" class="form-control" id="guardian_last_name" name="guardian_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="guardian_relation">{{ __('messages.relation') }}<span class="text-danger">*</span></label>
                                                <select id="guardian_relation" name="guardian_relation" class="form-control" >
                                                    <option value="">{{ __('messages.select_relation') }}</option>
                                                    @forelse($relation as $r)
                                                    <option value="{{$r['id']}}">{{$r['name']}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="guardian_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="guardian_email" name="guardian_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="guardian_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="guardian_phone_number" name="guardian_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="guardian_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                <select id="guardian_occupation" name="guardian_occupation" class="form-control" >
                                                    <option value="">{{ __('messages.select_occupation') }}</option>
                                                    <option>Business</option>
                                                    <option>IT/ Software</option>
                                                    <option>Civil department</option>
                                                    <option>Others</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="terms_condition" class="custom-control-input" id="terms_condition">
                                                    <label class="custom-control-label" for="terms_condition">{{ __('messages.i_agree_to_terms_conditions') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{ __('messages.date') }}<span class="text-danger">*</span>: {{ date('Y-m-d') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary-bl waves-effect waves-light" id="submit" type="submit" disabled>
                                    {{ __('messages.submit') }}
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div> <!-- end card-->
            </div> <!-- container -->
            <div class="col-md-2"></div>
        </div>
        <!-- END wrapper -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="{{ asset('public/js/vendor.min.js')}}"></script>

        <!-- Plugins js-->
        <script src="{{ asset('public/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>

        <!-- Init js-->
        <script src="{{ asset('public/js/pages/form-wizard.init.js')}}"></script>

        <!-- App js -->
        <script src="{{ asset('public/js/app.min.js')}}"></script>
        
        <script src="{{ asset('public/libs/moment/min/moment.min.js') }}"></script>

        <script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
        <script src="{{ asset('public/date-picker/jquery-ui.js') }}"></script>
        <script src="{{ asset('public/js/validation/validation.js') }}"></script>
        <script src="{{ asset('public/js/custom/student_application.js') }}"></script>
        <!-- Init js-->
        <script src="{{ asset('public/mobile-country/js/intlTelInput.js') }}"></script>
        <script src="{{ asset('public/country/js/countrySelect.js') }}"></script>
        
        <script>
            
            var application = "{{ route('schoolcrm.app.form') }}";
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
                //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
                //preferredCountries: ['cn', 'jp'],
                preventInvalidNumbers: true,
                // utilsScript: "js/utils.js"
            });

            $(".country").countrySelect({
                responsiveDropdown: true
            });
        </script>

</body>

</html>