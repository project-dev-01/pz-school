<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="{{ asset('public/images/favicon.ico') }}">
    <title>500</title>
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
            <div class="col-lg-12" style="margin-bottom:10px;">
                <div class="text-center">
                    <h1 class="eoppps">Internal Server Error </h1>
                    <p class="etext">please refresh and try again</p>
                    <a href="{{url('/')}}" class="link_404">Go to Home</a>
                    <!-- item-->
                    <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>{{ __('messages.logout') }}</span>
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