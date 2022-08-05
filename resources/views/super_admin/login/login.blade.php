<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login</title>
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
    <link href="{{ asset('public/css/custom/login.css') }}" rel="stylesheet" type="text/css" />

</head>


<body class="loading auth-fluid-pages pb-0">
    <div class="row">
        <div class="col-md-6">
            <div class="">
                <div class="auth-fluid">
                    <!--Auth fluid left content -->
                    <!-- Auth fluid right content -->

                    <div class="">
                        <div class="auth-user-testimonial bg">
                            <h2 class="mb-3 text-white text">Teaching is the greatest act of optimism</h2>
                        </div> <!-- end auth-user-testimonial-->
                    </div>
                </div>
            </div>
        </div>
        <!-- end Auth fluid right content -->
        <div class="col-md-6">
            <div class="">
                <div class="card-body" style="margin:0px 55px 0px 30px;">
                    <!-- Logo -->
                    <div class="">
                        <div class="auth-logo">
                            <a href="" class="logo logo-dark">
                                <span class="logo-lg">
                                    <img src="{{ asset('public/images/Suzen-app-logo.png') }}" alt="" height="60px">
                                </span>
                            </a>
                        </div>
                    </div><br><br>
                    <div>
                        <!-- form -->
                        <form id="LoginAuth" action="{{ route('super_admin.authenticate') }}" method="post">
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
                            <h1 class="welcomeback">Welcome back,</h1>
                            <div class="form-group">
                                <span class="badge badge-secondary smk"><img src="{{ asset('public/images/logo-pz-01.png') }}" class="mr-2 rounded-circle" alt="">Paxsuzen</span>
                            </div>

                            <div class="form-group">
                                <input class="form-control login-email" type="email" id="email" name="email" required="" placeholder="Enter your email">
                            </div>
                            <!-- <div class="form-group">
                                        <input class="form-control login-email" type="password" required="" id="password" placeholder="Enter your password">
                                    </div>-->
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
                            <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signin">
                                    <label class="custom-control-label sign" for="checkbox-signin">Remember me</label>
                                    <a href="{{route('forgot_password')}}" class="float-right forget"><small>Forgot your password?</small></a>
                                </div>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-block signin" type="submit">Sign In </button>
                            </div>

                        </form>


                        <!-- end form-->
                    </div><br><br>
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

    </div>
    <!-- end auth-fluid-->

    <!-- Vendor js -->
    <script src="{{ asset('public/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('public/js/app.min.js') }}"></script>

</body>

</html>