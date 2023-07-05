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
    <link href="{{ asset('public/css/custom/error.css') }}" rel="stylesheet" type="text/css" />
</head>
<style>
    .error403 {
        position: relative;
        display: flex;
        flex-direction: row;
        align-items: stretch;
        background: url(../public/images/error403.jpg);
        background-size: cover;
        min-height: 100vh;
    }
</style>

<body class="loading auth-fluid-pages pb-0">

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="col-md-6" style="background: #F4F7FC;">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">
                    <div class="text-left w-100 m-auto">
                        <h1 class="eoppps">Access Denied</h1>
                        <p class="etext">Your request to access this page has been denied. <br>Seems like you entry is not being permitted.</p>
                        <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span>Go to Login</span>
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
                        <br>
                        <a href="{{url('/')}}" class="link_404">Go to Home</a>
                    </div>
                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="col-md-6">
            <div class="auth-fluid-right text-center error403">
                <div class="">

                </div>
            </div>
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