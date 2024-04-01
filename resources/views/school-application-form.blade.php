<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ __('messages.school_application_form') }}</title>
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
    <link href="{{ asset('css/custom/spinner.css') }}" rel="stylesheet" type="text/css" />


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

        #hyper {

            text-decoration: none;
        }

        #terms,
        #agree {

            font-size: 12px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }

        .toggle {
            width: 300px;
        }
    </style>
</head>

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
    <div id="overlay">
        <div class="lds-spinner">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="auth-logo">
                                    <a href="" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ config('constants.image_url').'/common-asset/images/logo-dark.png'}}" alt="" height="50">
                                        </span>
                                    </a>
                                </div>
                                <div class="form-group" style="position: relative;">
                                    <div class="lang-select" style="position: absolute; top: -50px; right: -50px;">
                                        <button class="btn-select" value=""></button>
                                        <div class="b" style="text-align: justify;">
                                            <ul id="a" style="margin-bottom: 0;">
                                                <li><img src="{{ config('constants.image_url').'/common-asset/images/USA.png' }}" alt="en" value="en" /><span>English</span></li>
                                                <li><img src="{{ config('constants.image_url').'/common-asset/images/JPN.png' }}" alt="japanese" value="japanese" /><span>日本語</span></li>
                                                <li><img src="{{ config('constants.image_url').'/common-asset/images/MAL.png' }}" alt="malay" value="malay" /><span>Malay</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <h4 class="text-center" style="color:#596368">{{ __('messages.japanese_school_kuala') }}</h4>
                        <!-- <div class="text-center form-group">
                            <div class="lang-select">
                                <button class="btn-select" value=""></button>
                                <div class="b" style="text-align:justify;">
                                    <ul id="a" style="margin-bottom:0px;">
                                        <li><img src="{{ config('constants.image_url').'/common-asset/images/USA.png' }}" alt="en" value="en" /><span>English</span></li>
                                        <li><img src="{{ config('constants.image_url').'/common-asset/images/JPN.png' }}" alt="japanese" value="japanese" /><span>日本語</span></li>
                                        <li><img src="{{ config('constants.image_url').'/common-asset/images/MAL.png' }}" alt="malay" value="malay" /><span>Malay</span></li>

                                    </ul>
                                </div>
                            </div>
                        </div>-->

                    </div>
                    <hr style="border:1px solid #6FC6CC">
                    <div class="card">
                        <div class="card-body">
                            <form id="verifyApplication" method="post" action="{{ route('application.verify') }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">{{ __('messages.please_check_before_applying') }}
                                            <h4>
                                    </li>
                                </ul><br>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12" style="text-align: justify;">
                                            <p style="margin-bottom: 5px;font-size: 12px;">・{{ __('messages.if_you_would_like_to_submit_an_application') }}</p>
                                            <p style="font-size: 12px;">※{{ __('messages.this_email_address_will_be_used_for_logging') }}</p>
                                            <p style="margin-bottom: 5px;font-size: 12px;">・{{ __('messages.admission_conditions_info') }}</p>
                                            <p style="font-size: 12px;">・{{ __('messages.if_your_child_sibling_is_currently') }}</p>
                                            <p style="margin-bottom: 5px;font-size: 12px;">・{{ __('messages.school_contact') }}</p>
                                            <p style="margin-bottom: 5px; margin-left: 20px;font-size: 12px;">{{ __('messages.primary_secondary') }}: <u><a href="mailto:jsk2@jskl.edu.my">jsk2@jskl.edu.my</a></u></p>
                                            <p style="margin-left: 20px;font-size: 12px;">{{ __('messages.kindergarten') }}: <u><a href="mailto:kindergarten2@jskl.edu.my">kindergarten2@jskl.edu.my</a></u></p>
                                            <p style="margin-bottom: 5px;font-size: 12px;">・{{ __('messages.please_check_the_link_below_for') }}</p>
                                            <p style="margin-bottom: 5px;font-size: 12px;">・{{ __('messages.please_check_the_terms_of_service') }}</p>
                                            <p style="font-size: 12px;">・{{ __('messages.please_check_the_privacy_policy_regarding') }}</p>

                                            <div id="agree">
                                                <span class="toggle" style="font-family: Arial, Helvetica, sans-serif;font-weight:400">
                                                    <input type="checkbox" name="agree">
                                                    <label style="font-family:Arial, Helvetica, sans-serif;font-weight:400;font-size: 12px;"> {{ __('messages.i_confirmed_the_admission') }}</label></span>
                                            </div>
                                            <div id="terms">
                                                <span class="toggle" style="font-family: Arial, Helvetica, sans-serif;font-weight:400">
                                                    <input type="checkbox" name="terms">
                                                    <label style="font-family:Arial, Helvetica, sans-serif;font-weight:400;font-size: 12px;"> {{ __('messages.i_agree_to_the_terms_of_service') }}</label></span>
                                            </div>
                                            <div id="terms">
                                                <span class="toggle">
                                                    <input type="checkbox" name="terms">
                                                    <label style="font-family:Arial, Helvetica, sans-serif;font-weight:400;font-size: 12px;"> {{ __('messages.i_agree_to_our_school') }}</label></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                            {{ __('messages.school_registration') }}
                                            <h4>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <div id="guardian_details">
                                        <div class="row">
                                            <div class="col-md-12" style="text-align: justify;">
                                                <p style="margin-bottom: 5px;font-size: 12px;">・{{ __('messages.after_entering_the_email_address') }}</p>
                                                <p style="font-size: 12px;">・{{ __('messages.an_email_will_be_sent_to_the_email_address') }}</p>
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group-center">
                                                    <!-- <label for="first_name">{{ __('messages.email') }}<span class="text-danger">*</span></label> -->
                                                    <input type="text" class="form-control" id="verify_email" name="email" maxlength="50" placeholder="{{ __('messages.enter_your_email') }}" aria-describedby="inputGroupPrepend">
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


                                <!-- <div class="form-group text-center m-b-0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox text-center">

                                                    <!-- <a href="https://app.box.com/s/bimvbk6e3txoxqpkbhnqalgt3s123eu3" target="_blank"></a> -->
                                <!--<input type="checkbox" name="submit_instruction" class="custom-control-input" id="submit_instruction">

                                                    <label class="custom-control-label" for="submit_instruction">{{ __('messages.i_have_read_the_submit_instruction') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                                <div class="form-group text-center m-b-0">

                                    <button class="btn btn-primary-bl waves-effect waves-light" disabled id="submit" type="submit">
                                        {{ __('messages.verify') }}
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div> <!-- end card-->
            </div> <!-- container -->
        </div>
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

    <!-- add spinner  -->
    <!-- <div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div> -->

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
    <script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('js/pages/form-fileuploads.init.js') }}"></script>
    <script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
    <script type="text/javascript">
        var locale = "{{ Session::get('locale') }}";
        var url = "{{ route('changeLang') }}";
        //change button stuff on click
        $('#a li').click(function() {
            var img = $(this).find('img').attr("src");
            var value = $(this).find('img').attr('value');
            window.location.href = url + "?lang=" + value;
            var text = this.innerText;
            var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
            $('.btn-select').html(item);
            $('.btn-select').attr('value', value);
            $(".b").toggle();
        });

        $(".btn-select").click(function() {
            $(".b").toggle();
        });
        var locale_lang = "{{ Cookie::get('locale') }}";
        var language_name = "{{ $language_name }}";
        if (locale_lang) {
            if (locale_lang == "japanese") {
                //find an item with value of sessionLang\
                var img = "{{ config('constants.image_url').'/common-asset/images/JPN.png' }}";
                var value = "japanese";
                var text = "日本語";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            } else if (locale_lang == "malay") {
                var img = "{{ config('constants.image_url').'/common-asset/images/MAL.png' }}";
                var value = "malay";
                var text = "Malay";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            } else {
                var img = "{{ config('constants.image_url').'/common-asset/images/USA.png' }}";
                var value = "en";
                var text = "English";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            }
        } else if (language_name) {
            if (language_name == "japanese") {
                //find an item with value of sessionLang\
                var img = "{{ config('constants.image_url').'/common-asset/images/JPN.png' }}";
                var value = "japanese";
                var text = "日本語";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            } else if (language_name == "malay") {
                var img = "{{ config('constants.image_url').'/common-asset/images/MAL.png' }}";
                var value = "malay";
                var text = "Malay";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            } else {
                var img = "{{ config('constants.image_url').'/common-asset/images/USA.png' }}";
                var value = "en";
                var text = "English";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            }
        } else {
            if (locale == "japanese") {
                //find an item with value of sessionLang\
                var img = "{{ config('constants.image_url').'/common-asset/images/JPN.png' }}";
                var value = "japanese";
                var text = "日本語";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            } else if (locale == "malay") {
                var img = "{{ config('constants.image_url').'/common-asset/images/MAL.png' }}";
                var value = "malay";
                var text = "Malay";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            } else {
                var img = "{{ config('constants.image_url').'/common-asset/images/USA.png' }}";
                var value = "en";
                var text = "English";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            }
        }
    </script>
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