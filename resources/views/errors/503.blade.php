<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>503</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="To learn as much as I can, attain good grades and advance my education further. I believe that self-motivation and a strict routine has helped me achieve my goals so far, and I will use the same method in the future.">
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
    <link href="{{ asset('css/custom-minified/admin_login.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom-minified/opensans-font.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom/errorpage.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="loading auth-fluid-pages pb-0">

    <div class="row">
        <!--Auth fluid left content -->
        <div class="col-md-6" style="background: #F4F7FC;">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">
				<div class="auth-brand text-center text-lg-left">
                            <div class="auth-logo">
                                <div class="auth-logo">
                                    <a href="" class="logo logo-dark">
                                        <span class="logo-lg">
                                            <img src="{{ config('constants.image_url').'/common-asset/images/Suzen-app-logo.png' }}" alt="" height="60px">
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <div class="responsive">
                        <h1 class="eoppps">Service Unavailable</h1>
                        <p class="etext">This page should clearly state that the service is temporarily unavailable and provide some explanation for the inconvenience<br> It's essential to maintain transparency and reassure users that the issue is temporary</p>
                    </div>
                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="col-md-6">
                <img src="{{ asset('images/Illustrationerror.jpg') }}" class="bg-image-content">
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->

    <!-- Vendor js -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- App js -->
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script>
        document.getElementById('retryButton').addEventListener('click', function() {
            location.reload(); // Reload the page when the button is clicked
        });
    </script>
    <script>window.UserHelpPublicProjectID="Y7YyGqyq2"</script>
        <script src="https://run.userhelp.co" async></script>
</body>

</html>