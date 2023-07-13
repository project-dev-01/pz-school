<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>401</title>
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

    <div class="row">
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
                        <h1 class="eoppps">Unauthorized</h1>
                        <p class="etext">You are not authorized to access this page</p>
                        <!-- <a href="{{url('/')}}" class="link_404">Go to Login</a> -->
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
                <img src="{{ asset('public/images/Illustrationerror.jpg') }}" class="bg-image-content">
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
    <script>
        document.getElementById('retryButton').addEventListener('click', function() {
            location.reload(); // Reload the page when the button is clicked
        });
    </script>
</body>

</html>