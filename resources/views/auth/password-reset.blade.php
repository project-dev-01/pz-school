<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('public/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{ asset('public/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('public/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('public/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/common.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="loading authentication-bg-1 authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <div class="auth-logo">
                                    <a href="index.html" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('public/images/logo-dark.png') }}" alt="" height="50">
                                        </span>
                                    </a>

                                    <a href="index.html" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('public/images/logo-light.png') }}" alt="" height="50">
                                        </span>
                                    </a>
                                </div>
                                <p class="text-muted mb-4 mt-3">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                            </div>

                            <form id="LoginAuth" action="{{ route('reset_password_validation') }}" method="post">
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
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
									<label>Email Address</label>
									<input class="form-control" type="email" name="email">
								</div>
                                <div class="form-group">
									<label>Password</label>
									<input class="form-control" type="password" name="password">
								</div>
                                <div class="form-group">
									<label>Confirm Password</label>
									<input class="form-control" type="password" name="password_confirmation">
								</div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary-bn btn-block" type="submit">  Reset Password </button>
                                </div>

                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-white-50">Back to <a href="{{route('admin.login')}}" class="text-white ml-1"><b>Log in</b></a></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->


    <footer class="footer footer-alt">
        2020 - <script>
            document.write(new Date().getFullYear())
        </script> &copy; by <a href="https://paxsuzen.com">Paxsuzen</a>
    </footer>

    <!-- Vendor js -->
    <script src="{{ asset('public/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('public/js/app.min.js') }}"></script>
    <!-- <script src="{{ asset('public/js/custom/login.js') }}"></script> -->
</body>
</html>