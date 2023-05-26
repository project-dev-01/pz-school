<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="shortcut icon" href="{{ config('constants.image_url').'/public/common-asset/images/favicon.ico' }}">
	<title>404</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link href="{{ asset('public/css/custom/loginstyle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('public/css/custom/opensans-font.css') }}" rel="stylesheet" type="text/css" />
</head>
<style>
	@media only screen and (min-device-width: 280px) and (max-device-width: 653px) {
		.errorbackgroundd img {
			height: 646px;
			width: 100%;
			margin-left: 12px;
		}

		.eopppss {
			position: absolute;
			top: 49px;
			font-weight: 700;
			font-size: 18px;
			left: 5px;
		}

		.errortext {
			position: absolute;
			left: 5px;
			top: 166px;
			font-size: 7px;
		}
	}

	@media only screen and (min-device-width: 320px) and (max-device-width: 660px) {
		.errorbackgroundd img {
			height: 646px;
			width: 100%;
			margin-left: 47px;
		}

		.eopppss {
			position: absolute;
			top: 49px;
			font-weight: 700;
			font-size: 25px;
			left: 5px;
		}

		.errortext {
			position: absolute;
			left: 5px;
			top: 166px;
			font-size: 10px;
		}
	}

	@media only screen and (min-device-width: 820px) and (max-device-width: 1180px) {
		.errorbackgroundd img {
			height: 646px;
			width: 100%;
			margin-left: 60px;
		}

		.eopppss {
			left: 65px;
		}

		.errortext {
			left: 68px;
		}
	}

	@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
		.errorbackgroundd img {
			height: 646px;
			width: 100%;
			margin-left: 60px;
		}

		.eopppss {
			left: 65px;
		}

		.errortext {
			left: 68px;
		}
	}
</style>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="errorbackgroundd img">
					<img src="{{ config('constants.image_url').'/public/common-asset/images/Illustration.jpg' }}">
					<h1 class="eopppss">Oppps. Something <br>went wrong </h1>
					<p class="errortext">This page is currently not available. We are working<br> on the problem & appreciate your patience
						<a href="{{url('/')}}" class="link_404">Go to Home</a>
				</div>
			</div>
		</div>
		<!-- end row -->
	</div>

	<!-- Vendor js -->
	<script src="{{ asset('public/js/vendor.min.js') }}"></script>

	<!-- App js -->
	<script src="{{ asset('public/js/app.min.js') }}"></script>

</body>

</html>