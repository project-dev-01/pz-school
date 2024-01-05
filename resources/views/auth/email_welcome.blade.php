<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Email Welcome Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Paxsuzen School is a premier educational institution that offers quality education to students of all ages. Our curriculum is designed to prepare future leaders for success in the global marketplace.">
    <meta name="keywords" content="Paxsuzen School, education, future leaders, curriculum">
    <meta content="Paxsuzen" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ config('constants.image_url').'/common-asset/images/favicon.ico' }}">
    <!-- App css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <!-- icons -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom-minified/opensans-font.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom/email.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <table class="body-wrap">
        <tr>
            <td class="container">
                <div class="content">
                    <table>
                        <tr>
                            <td class="content-wrap">
                                <!-- Start Header-->
                                <table width="100%">
                                    <tr>
                                        <td>
                                            <h4 class="head">Welcome to Suzen!</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>We are delighted to extend a warm welcome to you on JSKL Association Portal and we are thrilled to have you on board.</p>
                                        </td>
                                    </tr>
                                </table>
                                <!-- End Header-->
                                <!-- Card-->
                                <div class="login">
                                    <p>Your login credentials are provided below:</p>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <p style="line-height: 10px;"><b>Email : </b>email@email.com</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>Password : </b>HJ893HU389</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="btn btn-primary-bl">Confirm & Verify Email</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>The password was auto-generated, however feel free to change it <a href="">here.</a></p>
                                </div>
                                <!-- End card-->

                                <!-- Footer Table-->
                                <table>
                                    <tr>
                                        <td>
                                            <hr style="width: 552px; height: 1px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>

                                            <img src="{{ asset('images/emailnotification/Suzen-app-logo.png') }}" class="mr-2 footerlogo">
                                            <p class="footerfont" style="margin-top: 15px;">Suzen is an educational management platform that brings School Administration, Teachers, Parents & Children together, blurring the boundary from orthodox educational system.</p>
                                            <div class="social">
                                                <img src="{{ asset('images/emailnotification/vector.png') }}">
                                                <img src="{{ asset('images/emailnotification/Facebook.png') }}">
                                                <img src="{{ asset('images/emailnotification/TwitterX.png') }}">
                                                <img src="{{ asset('images/emailnotification/TikTok.png') }}">
                                            </div>
                                            <p class="footerfont" style="line-height: 9px;">Suzen HQ Address</p>
                                            <p class="footerfont" style="line-height: 9px;">Suzen Service Email</p>
                                            <p class="footerfont" style="line-height: 9px;">Contact Num</p>
                                        </td>
                                    </tr>
                                </table>
                                <!--End Footer Table-->
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>