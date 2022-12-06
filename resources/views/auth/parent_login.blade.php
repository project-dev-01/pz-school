<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/images/favicon.ico') }}">
    <!-- App css -->
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('public/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="{{ asset('public/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('public/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
    <!-- icons -->
    <link href="{{ asset('public/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/parent_login.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/opensans-font.css') }}" rel="stylesheet" type="text/css" />
</head>


<body class="loading auth-fluid-pages pb-0">
    <div class="auth-fluid">
        <div class="col-md-6">
            <div class="auth-fluid-right text-center parentlogin">
                <div class="">
                    <!--Auth fluid left content -->
                    <div class="auth-user-testimonial bg">
                        <p class="mb-3 text-white text">A parent’s love is whole no matter how many times divided</p>
                    </div> <!-- end auth-user-testimonial-->
                </div>
            </div>

        </div>
        <!-- end Auth fluid right content -->

        <!--Auth fluid left content -->
        <div class="col-md-6 col">
            <div class="auth-fluid-form-box">
                <div class="align-items-center d-flex h-100">
                    <div class="card-body">

                        <!-- Logo -->
                        <div class="auth-brand text-center text-lg-left">
                            <div class="auth-logo">
                                <div class="auth-logo">
                                    <a href="" class="logo logo-dark">
                                        <span class="logo-lg">
                                            <img src="{{ asset('public/images/Suzen-app-logo.png') }}" alt="" height="60px">
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- form -->
                        <div class="form">
                            <form id="LoginAuth" action="{{ route('parent.authenticate') }}" method="post">
                                <h1 class="welcomeback">Welcome back,</h1>
                                <input type="hidden" name="branch_id" value="1">
                                <!-- <input type="hidden" name="branch_id" value="2"> -->
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
                                    <!-- <span class="badge badge-secondary smk"><img src="{{ asset('public/images/school.jpg') }}" class="mr-2 rounded-circle" alt="">SMK Kiaramas</span> -->
                                    <span class="badge badge-secondary smk"><img src="{{ asset('public/images/school.jpg') }}" class="mr-2 rounded-circle" alt="">Maahad Tahfiz Al-Quran Darul Saadah Lilbanat</span>
                                </div>

                                <div class="form-group">
                                    <input class="form-control login-email" type="email" id="email" name="email" required="" placeholder="Enter your email">
                                </div>

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password">
                                        <div class="input-group-append" data-password="false">
                                            <div class="input-group-text">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <label class="sign custom-control-label" for="checkbox-signin">Remember me</label>
                                        <a href="{{route('forgot_password')}}" class="forget float-right"><small>Forgot your password?</small></a>
                                    </div>
                                </div>
                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-block signin" type="submit">Sign In </button>
                                </div>

                            </form>

                            <!-- end form-->

                            <!-- Footer-->
                            <footer class="footer">
                                <p class="text-muted">2020 - <script>
                                        document.write(new Date().getFullYear())
                                    </script> &copy; by <a href="javascript: void(0);" class="text-muted">Paxsuzen</a> </p>
                            </footer>

                        </div> <!-- end .card-body -->
                    </div> <!-- end .align-items-center.d-flex.h-100-->
                </div>
            </div>

            <!-- end auth-fluid-form-box-->

            <!-- Auth fluid right content -->
        </div>
    </div>
    <!-- end auth-fluid-->

    <!-- Vendor js -->
    <script src="{{ asset('public/js/vendor.min.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- App js -->
    <script src="{{ asset('public/js/app.min.js') }}"></script>
    <!-- <script src="{{ asset('public/js/custom/login.js') }}"></script> -->

</body>

</html>