<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>419</title>
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
										<img src="{{ config('constants.image_url').'/common-asset/images/Suzen-app-logo.png' }}" alt="" height="60px">
									</span>
								</a>
							</div>
						</div>
					</div>
					<div class="responsive">
						<h1 class="eoppps">Page expired</h1>
						<p class="etext">This mismatch error leads to expired session. <br>Kindly try again later on</p>
						<a href="javascript:void(0)" id="retryButton" class="link_404">Retry</a>
						<br>
						@if(Session::get('role_id'))
						<a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							<span>Go to Home</span>
						</a>
						@if(Session::get('role_id') == '1')
						<form id="logout-form" action="{{ route('super_admin.logout') }}" method="POST" class="d-none">
							@csrf
						</form>
						@elseif(Session::get('role_id') == '3')
						<form id="logout-form" action="{{ route('staff.logout') }}" method="POST" class="d-none">
							@csrf
						</form>
						@elseif(Session::get('role_id') == '4')
						<form id="logout-form" action="{{ route('teacher.logout') }}" method="POST" class="d-none">
							@csrf
						</form>
						@elseif(Session::get('role_id') == '5')
						<form id="logout-form" action="{{ route('parent.logout') }}" method="POST" class="d-none">
							@csrf
						</form>
						@elseif(Session::get('role_id') == '6')
						<form id="logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
							@csrf
						</form>
						@else
						<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
							@csrf
						</form>
						@endif
						@else
						<a class="link_404" href="{{ url()->previous() }}">Back</a>
						@endif
					</div>
				</div> <!-- end .card-body -->
			</div> <!-- end .align-items-center.d-flex.h-100-->
		</div>
		<!-- end auth-fluid-form-box-->

		<!-- Auth fluid right content -->
		<div class="col-md-6">
			<img src="{{ asset('images/error419.jpg') }}" class="bg-image-content">
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
		var backPrevious = "{{ url()->previous() }}";
	</script>
	@if(Session::get('role_id') == '1')
	<script>
		var logoutIdle = "{{ route('super_admin.logout') }}";
	</script>
	@elseif(Session::get('role_id') == '2')
	<script>
		var logoutIdle = "{{ route('admin.logout') }}";
	</script>
	@elseif(Session::get('role_id') == '3')
	<script>
		var logoutIdle = "{{ route('staff.logout') }}";
	</script>
	@elseif(Session::get('role_id') == '4')
	<script>
		var logoutIdle = "{{ route('teacher.logout') }}";
	</script>
	@elseif(Session::get('role_id') == '5')
	<script>
		var logoutIdle = "{{ route('parent.logout') }}";
	</script>
	@elseif(Session::get('role_id') == '6')
	<script>
		var logoutIdle = "{{ route('student.logout') }}";
	</script>
	@else
	<script>
		var logoutIdle = null;
	</script>
	@endif
	<!-- App js -->
	<script src="{{ asset('js/app.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			if (logoutIdle) {
				logoutFunc();
			} else {
				window.location = backPrevious;
			}
		});

		function logoutFunc() {
			var formData = new FormData();
			formData.append("idle_timeout", "idle_timeout");
			$.ajax({
				cache: false,
				url: logoutIdle,
				data: formData,
				method: "post",
				processData: false,
				dataType: 'json',
				contentType: false,
				success: function(response) {
					window.location.href = response.redirect_url;
				},
				error: function(err) {
					console.log("'''logut error'''")
					console.log(err);
					// if (response.status === 419) {
					//     // CSRF token mismatch, handle the error here
					//     // You can refresh the page or show an error message
					//     alert('419');
					// } else {
					//     // Handle other errors
					//     alert('in else');
					// }
				}
			});
		}
		document.getElementById('retryButton').addEventListener('click', function() {
			location.reload(); // Reload the page when the button is clicked
		});
	</script>
</body>

</html>