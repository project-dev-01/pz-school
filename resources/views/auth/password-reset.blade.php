<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Renew Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ config('constants.image_url').'/public/images/favicon.ico' }}">

		<!-- App css -->
		<link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="{{ asset('public/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<!-- icons -->
		<link href="{{ asset('public/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('public/css/custom/loginstyle.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body class="body">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body">
                                
                                <div class="text-center">
                                    <div class="auth-logo">
                                        <a href="index.html" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="{{ config('constants.image_url').'/public/images/Suzen-app-logo.png' }}" alt="" height="40px">
                                            </span>
                                        </a>
                                    </div><br>
									<h3 class="passrecov">{{ __('messages.renew_password') }}</h3>
                                    <p class="text-muted opoos">Dear user of teachxxxxx@suzen.com from SMK Kiaramas. <br>{{ __('messages.your_old_password_resetted') }}</p>
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
                                        <span class="badge badge-secondary smk"><img src="{{ config('constants.image_url').'/public/images/school.jpg' }}" class="mr-2 rounded-circle" alt="">SMK Kiaramas</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge">
                                            <input type="email"  class="form-control" name="email" placeholder="{{ __('messages.enter_the_email') }}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge">
                                            <input type="password"  class="form-control" name="password" placeholder="{{ __('messages.new_password') }}">
                                            <div class="input-group-append" data-password="false">
                                                <div class="input-group-text">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge">
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Retype new password">
                                            <div class="input-group-append" data-password="false">
                                                <div class="input-group-text">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-block signin" type="submit">{{ __('messages.confirm') }}</button>
                                    </div><br>

                                </form>

                                <div class="text-center">
                                    <h5 class="mt-3 text-muted passfooter">2020 - <script>document.write(new Date().getFullYear())</script> &copy; by <a href="javascript: void(0);" class="text-muted">Paxsuzen</a> </h5>
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

        <!-- App js -->
        <script src="{{ asset('public/js/app.min.js') }}"></script>
        
    </body>
</html>