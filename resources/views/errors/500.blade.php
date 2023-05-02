<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="shortcut icon" href="{{ asset('public/{{ config('constants.image_url').'/images/favicon.ico' }}">
	<title>Error Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link href="{{ asset('public/css/custom/loginstyle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('public/css/custom/opensans-font.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-lg-12" style="margin-top:30px; margin-bottom:30px;">
				<div class="text-center">
					<h1 class="eoppps">Oppps. Something went wrong </h1>
					<p class="etext">This page is currently not available. We are working on the problem & <br>appreciate your patience</p>
					<a href="{{url('/')}}" class="link_404">Go to Home</a>
				</div>
				<!-- end row -->

			</div> <!-- end col -->
			<div class="col-lg-12">
				<div class="errorbackground">
				</div>

			</div> <!-- end col -->
		</div>
		<!-- end row -->
	</div>

	<!-- Vendor js -->
	<script src="{{ asset('public/js/vendor.min.js') }}"></script>

	<!-- App js -->
	<script src="{{ asset('public/js/app.min.js') }}"></script>

</body>

</html>