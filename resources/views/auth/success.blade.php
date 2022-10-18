<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Successful</title>
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
		<link href="{{ asset('public/css/custom/loginstyle.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body class="body">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center">
                                    <div class="auth-logo">
                                        <a href="" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="{{ asset('public/images/Suzen-app-logo.png') }}" alt="" height="40px">
                                            </span>
                                        </a>
                                    </div><br>
									<h3 class="passrecov">Successful</h3>
                                    <p class="text-muted opoos">Your new password has been created. You can now use the new password <br>to gain access to your account again.</p>
                                </div>

                                <!-- <form action="#"> -->
								<div class="form-group">
                                        <span class="badge badge-secondary smk"><img src="{{ asset('public/images/school.jpg') }}" class="mr-2 rounded-circle" alt="">SMK Kubang Keriang</span>
                                 </div>
                                    
								<br>
								
								<div class="ring">
								<span>3<br>Seconds</span>	 
								</div>

								 <p style="text-align:center">Ok</p>
								 
                                    <div class="form-group mb-0 text-center">
                                    <a href="{{route('admin.login')}}"><button class="btn btn-block signin">Login Page</button></a>
                                    </div><br>
									
									
                                    </div>


                                <!-- </form> -->

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
		
		<!-- Peity chart-->
        <script src="{{ asset('public/libs/peity/jquery.peity.min.js') }}"></script>

        <!-- Init js-->
        <script src="{{ asset('public/js/pages/peity.init.js') }}"></script>
        
    </body>
</html>