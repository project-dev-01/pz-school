<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Password Recovery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ config('constants.image_url').'/public/images/favicon.ico' }}">

    <!-- App css -->
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('public/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{ asset('public/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />

    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> -->

    <link href="{{ asset('public/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('public/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('public/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/loginstyle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/opensans-font.css') }}" rel="stylesheet" type="text/css" />

</head>

<style>
    @media only screen and (min-device-width: 280px) and (max-device-width: 653px) {
        .card {
            width: 137%;
        }

        .passrecov {
            font-weight: 800;
            font-size: 25px;
            line-height: 48px;
            letter-spacing: -0.02em;
            color: #343556;
        }

        .opoos {
            padding: 0px 89px 0px 0px;
            line-height: 15px;
        }
    }

    @media only screen and (min-device-width: 320px) and (max-device-width: 614px) {
        .card {
            width: 115%;
        }

        .opoos {
            padding: 0px 14px 0px 0px;
        }
    }

    @media only screen and (min-device-width: 375px) and (max-device-width: 667px) {
        .card {
            width: 100%;
        }
    }

    @media only screen and (min-device-width: 360px) and (max-device-width: 740px) {
        .card {
            width: 100%;
        }
    }

    @media only screen and (min-device-width: 412px) and (max-device-width: 915px) {
        .card {
            width: 100%;
        }
    }
</style>

<body class="body password">
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="text-center">
                                <div class="auth-logo">
                                    <a href="index.html" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ config('constants.image_url').'/public/images/Suzen-app-logo.png' }}" alt="" height="40px">
                                        </span>
                                    </a>
                                </div><br>
                                <h3 class="passrecov">{{ __('messages.password_recovery') }}</h3>
                                <p class="text-muted opoos">{{ __('messages.oops_back_your_account') }}</p>
                            </div>
                            <form id="LoginAuth" action="{{ route('reset_password') }}" method="post">
                                <div class="form-group">
                                    <span class="badge badge-secondary smk"><img src="{{ config('constants.image_url').'/public/images/school.jpg' }}" class="mr-2 rounded-circle" alt="">SMK Kiaramas</span>
                                    <!-- <span class="badge badge-secondary smk"><img src="{{ asset('public/images/school.jpg') }}" class="mr-2 rounded-circle" alt="">Maahad Tahfiz Al-Quran Darul Saadah Lilbanat</span> -->
                                </div>
                                @if ( Session::get('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                                @endif
                                @if ( Session::get('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                                @endif
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" type="email" name="email" id="emailaddress" placeholder="{{ __('messages.enter_your_email') }}">
                                </div><br>
                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-block signin" id="send" type="submit" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Please Wait">{{ __('messages.sent_link') }}</button>
                                </div><br>
                                <div class="form-group mb-0 text-center">
                                    <a href="{{ url()->previous() }}"><button class="btn btn-block cancel" type="button">{{ __('messages.cancel') }}</button></a>
                                </div>

                            </form>

                            <div class="text-center">
                                <h5 class="mt-3 text-muted passfooter">2020 - <script>
                                        document.write(new Date().getFullYear())
                                    </script> &copy; by <a href="javascript: void(0);" class="text-muted">Paxsuzen</a> </h5>
                            </div>


                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->


                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->



    <!-- Vendor js -->
    <script src="{{ asset('public/js/vendor.min.js') }}"></script>

    <script src="{{ asset('public/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script> -->

    <script src="{{ asset('public/bootstrap/js/twitter-bootstrap.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('public/js/app.min.js') }}"></script>

</body>

<script>
    $('#send').on('click', function() {
        var $this = $(this);
        $this.button('loading');
        setTimeout(function() {
            $this.button('reset');
        }, 8000);
    });
</script>

</html>