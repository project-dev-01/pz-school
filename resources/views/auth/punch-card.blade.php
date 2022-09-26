@extends('layouts.punchcard-layout')
@section('title','Punch Card')
@section('content')
<link href="{{ asset('public/css/custom/greeting.css') }}" rel="stylesheet" type="text/css" />
<style>
    body[data-sidebar-size=condensed] .logo span.logo-lg {
        display: inline-block;
    }

    .smk {
        height: 62px;
        background: #D2EDEF;
        font-family: 'Open Sans';
        font-size: 14px;
        text-align: left;
        color: #16191D;
    }
</style>

<body class="loading authentication-bg authentication-bg-pattern" style="background-color:#2F2F8F">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-9">
                    <div class="card">
                        <div class="card-body p-4">

                            <ul class="list-unstyled topnav-menu float-right mb-0">

                                <li class="dropdown notification-list topbar-dropdown">
                                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false">
                                        <img src="{{ Session::get('picture') && asset('public/images/staffs/'.Session::get('picture')) ? asset('public/images/staffs/'.Session::get('picture')) : asset('public/images/users/default.jpg') }}" style="height:50px;width:50px" alt="user-image" class="rounded-circle admin_picture">
                                        <span class="pro-user-name ml-1 user_name">
                                            <i class="mdi mdi-chevron-down"></i>
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <!-- item-->
                                        <div class="dropdown-header noti-title">
                                            <h6 class="text-overflow m-0">Welcome ! {{ Cookie::get('user_name') ?Cookie::get('user_name'):$temp_user_name }}</h6>
                                        </div>
                                        <div class="dropdown-divider"></div>

                                        <!-- item-->
                                        <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                                            <i class="fe-log-out"></i>
                                            <span>Logout</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('admin.logout.punchcard') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>

                                    </div>
                                </li>
                            </ul>

                            <!-- LOGO -->
                            <div class="auth-logo">

                                <a href="javascript:void(0)" class="logo logo-dark text-left">
                                    <span class="logo-lg">
                                        <div class="form-group">
                                            <span class="badge badge-secondary smk"><img src="{{ asset('public/images/school.jpg') }}" class="mr-2 rounded-circle" alt="">SMK Kiaramas</span>
                                        </div>
                                    </span>
                                </a>
                            </div>

                            <div class="clearfix"></div>
                            <hr>
                            <div class="row" id="hideGreeting">
                                <div class="col-md-8 col-xl-8">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="card-widgets">
                                            <!-- <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a> -->
                                        </div>
                                        <div class="row">
                                            <div class="col-8">
                                                <p class="greetingText">
                                                    {{ $greetings }}

                                                </p>
                                                <h3 class="greetingName">{{ Cookie::get('user_name') ?Cookie::get('user_name'):$temp_user_name }}</h3>
                                            </div>
                                            <div class="col-4">
                                                <div class="float-right">
                                                    <div class="greetingCntRing">
                                                        <span id="greetingRingCnt">5</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->
                            </div>
                            <div class="text-center mt-4">
                                <form id="" action="{{ route('employee.punchcard') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                                    @csrf

                                    <div class="card">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <h4 class="navv"> ( <span class="date"></span> ) - @if($session==1) Morning Session @elseif($session==2) Evening Session @endif</h4>
                                            </li>
                                        </ul>
                                        <input type="hidden" name="session" id="session" value="{{$session}}">
                                        <div class="card-body">
                                            <div class="table-responsive mt-md mb-md">
                                                <table class="table table-striped table-bordered table-condensed mb-none">
                                                    <tbody>
                                                        <tr>
                                                            <th width="25%">Check In Time</th>
                                                            <td width="25%" class="check_in_time">{{$punchcard['check_in_time']}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="25%">Check Out Time</th>
                                                            <td width="25%" class="check_out_time">{{$punchcard['check_out_time']}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <br>

                                    </div>
                                    <div class="form-group text-center m-b-0">
                                        <button class="btn btn-success waves-effect waves-light" id="check_in" type="button" {{$punchcard['check_in_status']}}>
                                            {{$punchcard['check_in']}}
                                        </button>
                                    </div>

                                    <div class="form-group text-center m-b-0">
                                        <button class="btn btn-warning waves-effect waves-light" id="check_out" type="button" {{$punchcard['check_out_status']}}>
                                            {{$punchcard['check_out']}}
                                        </button>
                                    </div>
                                </form>

                            </div>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

</body>

@endsection

@section('scripts')
<script>
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var punchcard = "{{ route('employee.punchcard') }}";
</script>
<script src="{{ asset('public/js/custom/punchcard.js') }}"></script>
<script src="{{ asset('public/js/custom/greeting_punchcard.js') }}"></script>

@endsection