<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>403</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Paxsuzen School is a premier educational institution that offers quality education to students of all ages. Our curriculum is designed to prepare future leaders for success in the global marketplace.">
	<meta name="keywords" content="Paxsuzen School, education, future leaders, curriculum">
	<meta content="Paxsuzen" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<!-- App favicon -->
	<link rel="shortcut icon" href="{{ config('constants.image_url').'/public/common-asset/images/favicon.ico' }}">
	<!-- App css -->
	<link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
	<link href="{{ asset('public/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
	<!-- icons -->
	<link href="{{ asset('public/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('public/css/custom-minified/admin_login.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('public/css/custom-minified/opensans-font.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('public/css/custom/errorpage.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="loading auth-fluid-pages pb-0">

	<div class="auth-fluid">
		<!--Auth fluid left content -->
		<div class="col-md-6" style="background: #F4F7FC;">
			<div class="align-items-center d-flex h-100">
				<div class="card-body">
					<div class="auth-brand text-center text-lg-left">
						<div class="auth-logo">
							<div class="auth-logo">
								<a href="" class="logo logo-dark">
									<span class="logo-lg">
										<img src="{{ config('constants.image_url').'/public/common-asset/images/Suzen-app-logo.png' }}" alt="" height="60px">
									</span>
								</a>
							</div>
						</div>
					</div>
					<div class="responsive">
						<h1 class="eopppss">Access Denied</h1>
						<p class="etextt">Sorry, You Are Not Allowed to Access This Page.</p>
						<a class="link_404" href="{{ url()->previous() }}">Back</a>
					</div>
				</div> <!-- end .card-body -->
			</div> <!-- end .align-items-center.d-flex.h-100-->
		</div>
		<!-- end auth-fluid-form-box-->

		<!-- Auth fluid right content -->
		<div class="col-md-6">
			<img src="{{ asset('public/images/error403.jpg') }}" class="bg-image-content">
		</div>
		<!-- end Auth fluid right content -->
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

</body>

</html>