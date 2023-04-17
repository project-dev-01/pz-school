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
    <link rel="shortcut icon" href="{{ asset('public/images/favicon.ico')}}">

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
                                    <img src="{{ asset('public/images/logo-dark.png')}}" alt="" height="50">
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
                            <form>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="fname" maxlength="50" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="lname" maxlength="50" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.gender') }}<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
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
                                                <label for="heard">{{ __('messages.age') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="sage" id="age" require="" placeholder="Eg:3">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.date_of_birth') }}<span class="text-danger">*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control" id="name" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend" required>
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
                                                <label for="heard">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="phone" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.address_1') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="name" placeholder="{{ __('messages.enter_address_1') }}" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.address_2') }}<span class="text-danger">*</span><br></label>
                                                <input type="text" class="form-control" id="address" placeholder="{{ __('messages.enter_address_2') }}" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.city') }}<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">{{ __('messages.select_city') }}</option>
                                                    <option value="">Malaysia</option>
                                                    <option value="press">Singapore</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.state') }}<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">{{ __('messages.select_state') }}</option>
                                                    <option value="Malaysia">Malaysia</option>
                                                    <option value="press">Singapore</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.postal_code') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="pin" placeholder="{{ __('messages.postal_code') }}" aria-describedby="inputGroupPrepend" required>
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
                                                <label for="heard">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">{{ __('messages.select_grade') }}</option>
                                                    <option value="">I</option>
                                                    <option value="press">II</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.school_year') }}<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">{{ __('messages.select') }} {{ __('messages.school_year') }}</option>
                                                    <option value="">2021-2022</option>
                                                    <option value="press">2022-2023</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.school_last_attended') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="pin" placeholder="{{ __('messages.school_last_attend') }}" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.school_address1') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="sadd" placeholder="{{ __('messages.enter_address_1') }}" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.school_address2') }}<span class="text-danger">*</span><br></label>
                                                <input type="text" class="form-control" id="sadd2" placeholder="{{ __('messages.enter_address_2') }}" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.city') }}<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">{{ __('messages.select_city') }}</option>
                                                    <option value="">Malaysia</option>
                                                    <option value="press">Singapore</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.state') }}<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">{{ __('messages.select_state') }}</option>
                                                    <option value="">Malaysia</option>
                                                    <option value="press">Singapore</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.postal_code') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="spin" placeholder="{{ __('messages.postal_code') }}" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                        {{ __('messages.parent_guardian_information') }}
                                            <h4>
                                    </li>
                                </ul><br>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.parent') }}/{{ __('messages.guardians_name') }}<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">{{ __('messages.select_parent_guardian_name') }}</option>
                                                    <option value="">Parent</option>
                                                    <option value="">Guardian's</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="firstname" placeholder="{{ __('messages.sato') }}" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="lastname" placeholder="{{ __('messages.akari') }}" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="pnumber" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">{{ __('messages.select_occupation') }}</option>
                                                    <option value="">Business</option>
                                                    <option value="">IT/ Software</option>
                                                    <option value="">Civil department</option>
                                                    <option value="">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.parent_guardian_secondary') }}<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">{{ __('messages.select_parent_guardian_secondary') }}</option>
                                                    <option value="">{{ __('messages.parent') }}</option>
                                                    <option value="">{{ __('messages.guardia') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="ffname" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="llname" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="name" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">{{ __('messages.select_occupation') }}</option>
                                                    <option value="">Business</option>
                                                    <option value="">IT/ Software</option>
                                                    <option value="">Civil department</option>
                                                    <option value="">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                        {{ __('messages.emergency_contact_details') }}
                                            <h4>
                                    </li>
                                </ul><br>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.emergency_contact_person') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="ename" placeholder="{{ __('messages.sato') }}" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="elname" placeholder="{{ __('messages.akari') }}" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="elname" placeholder="{{ __('messages.leo') }}" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div> <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="name" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck11">
                                                    <label class="custom-control-label" for="customCheck11">{{ __('messages.i_agree_to_terms_conditions') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{ __('messages.date') }}<span class="text-danger">*</span>: 09-02-2022</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </form>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                {{ __('messages.submit') }}
                                </button>
                            </div>

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

</body>

</html>