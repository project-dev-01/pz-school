<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>School Application Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ config('constants.image_url').'/common-asset/images/favicon.ico'}}">

    <!-- App css -->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{ asset('css/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- <link href="{{ asset('css/common.css')}}" rel="stylesheet" type="text/css" /> -->
    <link href="{{ asset('css/custom/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom/opensans-font.css') }}" rel="stylesheet" type="text/css" />


    <!-- date picker -->
    <link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- toaster alert -->
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('mobile-country/css/intlTelInput.css') }}">
    <link rel="stylesheet" href="{{ asset('country/css/countrySelect.css') }}">

    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body class="loading">
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
                                    <img src="{{ config('constants.image_url').'/common-asset/images/logo-dark.png'}}" alt="" height="50">
                                </span>
                            </a>
                        </div>
                        <h3 class="text-center" style="color:#596368">{{ __('messages.student_application_form') }}</h3>
                    </div>
                    <hr style="border:1px solid #6FC6CC">
                    <div class="card">
                        <div class="card-body">
                            <form id="verifyApplication" method="post" action="{{ route('application.verify') }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">{{ __('messages.contact_details') }}
                                            <h4>
                                    </li>
                                </ul><br>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <i class="fa fa-map-marker"></i>
                                                <span style="margin-left: 12px;">{{ isset($contact['address'])?$contact['address']:''}}</span>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <i class="fa fa-phone"></i>
                                                <span style="margin-left: 10px;"><a href="tel:123-456-7890">{{ isset($contact['mobile_no'])?$contact['mobile_no']:''}}</a></span>
                                            </div>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <i class="fa fa-envelope"></i>
                                                <span style="margin-left: 11px;"><a href="mailto:{{ isset($contact['email'])?$contact['email']:''}}">{{ isset($contact['email'])?$contact['email']:''}}</a></span>
                                            </div>
                                        </div>

                                    </div><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox text-center">
                                                <input type="checkbox" name="terms_condition" class="custom-control-input" id="terms_condition">
                                                <label class="custom-control-label" for="terms_condition">I Understand and Accept the Terms</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                            {{ __('messages.email_verification') }}
                                            <h4>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <div id="guardian_details">
                                        <div class="row">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group -center">
                                                <!-- <label for="first_name">{{ __('messages.email') }}<span class="text-danger">*</span></label> -->
                                                <input type="text" class="form-control" id="verify_email" name="email" maxlength="50" placeholder="Enter Your Email" aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
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
                                <hr> -->
                                <div class="form-group text-center m-b-0">
                                    <button class="btn btn-primary-bl waves-effect waves-light" disabled id="submit" type="submit" >
                                        Verify
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div> <!-- end card-->
            </div> <!-- container -->
            <div class="col-md-2"></div>
        </div>
    </div>
    <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2">Open Modal</button> -->

    <div class="modal fade" id="aggrement" role="dialog">
        <div class="modal-dialog" style="max-width: 600px;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background: #6FC6CC;color: #fff;text-align: left;border-top-left-radius: 4px; border-top-right-radius: 4px;">
                    <h4 class="modal-title" style="font-size: 20px;font-family: roboto;">Agreement</h4>
                </div>
                <div class="modal-body">
                    <p style="font-size: 14px;color: #4a4747;font-family: roboto;line-height: 23px;margin-bottom: 0px;padding: 0px 15px 0px;height: 200px;overflow-y: scroll;text-align: justify;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <div class="text-center">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="background: #6FC6CC;color: #fff; padding: 7px 21px;margin-top: 30px;margin-bottom: 15px;">I Agree</button>
                    </div>
                </div>
                <!-- <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div> -->
            </div>

        </div>
    </div>
    <!-- END wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="{{ asset('js/vendor.min.js')}}"></script>

    <!-- Plugins js-->
    <script src="{{ asset('libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>

    <!-- Init js-->
    <script src="{{ asset('js/pages/form-wizard.init.js')}}"></script>

    <!-- App js -->
    <script src="{{ asset('js/app.min.js')}}"></script>

    <script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>

    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/validation/validation.js') }}"></script>
    <script src="{{ asset('js/custom/student_application.js') }}"></script>
    <!-- Init js-->
    <script src="{{ asset('mobile-country/js/intlTelInput.js') }}"></script>
    <script src="{{ asset('country/js/countrySelect.js') }}"></script>

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