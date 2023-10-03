<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Email Verification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ config('constants.image_url').'/public/common-asset/images/favicon.ico'}}">

    <!-- App css -->
    <link href="{{ asset('public/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('public/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{ asset('public/css/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('public/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('public/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- <link href="{{ asset('public/css/common.css')}}" rel="stylesheet" type="text/css" /> -->
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

        .btn-primary-bl {
            color: #fff;
            border-color: #0ABAB5;
            background-color: #6FC6CC;
            text-align: center;
            margin-top: 20px;
            border-radius: 0px;
        }

        .logout-checkmark {
            width: 100px;
            margin: 0 auto;
            padding: 15px 0;
        }
    </style>
</head>

<body>
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center w-75 m-auto">
                                <div class="auth-logo">
                                    <a href="" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ config('constants.image_url').'/public/common-asset/images/logo-dark.png'}}" alt="" height="50">
                                        </span>
                                    </a>
                                </div>
                            </div>

                            <div class="text-center">
                                <div class="mt-4">
                                    <div class="logout-checkmark">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                            <circle class="path circle" fill="none" stroke="#4bd396" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                                            <polyline class="path check" fill="none" stroke="#4bd396" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                                        </svg>
                                    </div>
                                </div>

                                @if($application == "Verified")
                                <h4 class="text-center" style="color: #000000;">Email Verified Successfully</h4>
                                @else
                                <h4 class="text-center" style="color: #000000;">Your Email Already Verified</h4>
                                @endif
                            </div>
                            <div class="form-group" style="text-align: center;">
                                <button class="btn btn-primary-bl waves-effect waves-light">
                                    Go to Home
                                </button>
                            </div>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>

    <!-- Start Content-->

    <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2">Open Modal</button> -->

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
            initialCountry: "my",
            //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            //preferredCountries: ['cn', 'jp'],
            preventInvalidNumbers: true,
            // utilsScript: "js/utils.js"
        });

        $(".country").countrySelect({
            defaultCountry: "my",
            responsiveDropdown: true
        });
    </script>

</body>

</html>