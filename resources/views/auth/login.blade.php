<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Paxsuzen School is a premier educational institution that offers quality education to students of all ages. Our curriculum is designed to prepare future leaders for success in the global marketplace.">
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
    <!--<link href="{{ asset('css/custom/admin_login.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom/opensans-font.css') }}" rel="stylesheet" type="text/css" />-->
    <link href="{{ asset('css/custom-minified/admin_login.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom-minified/opensans-font.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<style>
    .teacherlogin {
        position: relative;
        display: flex;
        min-height: 100vh;
        flex-direction: row;
        align-items: stretch;
        background: url('<?= $image_url ?>');
        background-size: cover;
    }
</style>

<body class="loading auth-fluid-pages pb-0">
    <div class="auth-fluid">
        <div class="col-md-6 ">
            <div class="auth-fluid-right text-center teacherlogin">
                <div class="">
                    <!--Auth fluid left content -->
                    <div class="auth-user-testimonial bg">
                        <p class="mb-3 text-white text">{{ __('messages.teaching_is_the_greatest') }}<br>{{ __('messages.act_of_optimism') }}</p>
                    </div> <!-- end auth-user-testimonial-->
                </div>
            </div>

        </div>
        <!-- end Auth fluid right content -->

        <!--Auth fluid left content -->
        <div class="col-md-6 col">
            <div class="auth-fluid-form-box">
                <div class="align-items-center d-flex h-100">
                    <div class="card-body">
                        <!--  <div class="form-group" style="text-align:right;">
                            <div class="lang-select" style="float: right; margin-top:-15px;">
                                <button class="btn-select" value=""></button>
                                <div class="b" style="text-align:justify;">
                                    <ul id="a" style="margin-bottom:0px;">
                                        <li><img src="{{ config('constants.image_url').'/common-asset/images/USA.png' }}" alt="en" value="en" /><span>English</span></li>
                                        <li><img src="{{ config('constants.image_url').'/common-asset/images/JPN.png' }}" alt="japanese" value="japanese" /><span>日本語</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>-->

                        <!-- Logo -->
                        <!--<div class="auth-brand text-center text-lg-left">
                            <div class="auth-logo">
                                <div class="auth-logo">
                                    <a href="" class="logo logo-dark">
                                        <span class="logo-lg">
                                            <img src="{{ config('constants.image_url').'/common-asset/images/Suzen-app-logo.png' }}" alt="" height="60px">
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>-->
                        <div class="form-group" style="text-align:right;">
                            <div class="lang-select" style="float: right; margin-top:20px;">
                                <button class="btn-select" value=""></button>
                                <div class="b" style="text-align:justify;">
                                    <ul id="a" style="margin-bottom:0px;">
                                        <li><img src="{{ config('constants.image_url').'/common-asset/images/USA.png' }}" alt="en" value="en" /><span>English</span></li>
                                        <li><img src="{{ config('constants.image_url').'/common-asset/images/JPN.png' }}" alt="japanese" value="japanese" /><span>日本語</span></li>
                                        <li><img src="{{ config('constants.image_url').'/common-asset/images/MAL.png' }}" alt="malay" value="malay" /><span>Malay</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Logo -->
                        <div class="auth-logo">
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

                        <!-- form -->
                        <div class="form">
                            <form id="LoginAuth" action="{{ route('admin.authenticate') }}" method="post">
                                <h1 class="welcomeback">{{ __('messages.welcome_back') }}</h1>
                                <input type="hidden" name="branch_id" value="{{$branch_id}}">
                                <input type="hidden" name="user_browser" id="user_browser" value="">
                                <input type="hidden" name="user_os" id="user_os" value="">
                                <input type="hidden" name="user_device" id="user_device" value="">
                                <!-- <input type="hidden" name="branch_id" value="2"> -->
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
                                <div class="form-group">
                                    <!-- <span class="badge badge-secondary smk"><img src="{{ asset('images/school.png') }}" class="mr-2 rounded-circle" alt="">SMK BERJAYA</span> -->
                                    <span class="badge badge-secondary smk"><img src="{{ config('constants.image_url').'/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle" alt="">{{$school_name}}</span>
                                    <!-- <span class="badge badge-secondary smk"><img src="{{ asset('images/school.jpg') }}" class="mr-2 rounded-circle" alt="">Maahad Tahfiz Al-Quran Darul Saadah Lilbanat</span> -->
                                </div>

                                <div class="form-group">
                                    <input class="form-control login-email" type="email" value="{{ Cookie::get('email') ? Cookie::get('email'):'' }}" id="email" name="email" required="" placeholder="{{ __('messages.enter_your_email') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" value="{{ Cookie::get('password') ? Cookie::get('password'):'' }}" name="password" placeholder="{{ __('messages.enter_your_password') }}">
                                        <div class="input-group-append" data-password="false">
                                            <div class="input-group-text">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="remember" value="1" {{ Cookie::get('remember') ? 'checked' : '' }} id="checkbox-signin">
                                        <label class="sign custom-control-label" for="checkbox-signin">{{ __('messages.remember_me') }}</label>
                                        <a href="{{route('forgot_password')}}" class="forget float-right"><small>{{ __('messages.forgot_your_password') }}?</small></a>
                                    </div>
                                </div>
                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-block signin" type="submit">{{ __('messages.sign_in') }} </button>
                                </div>

                            </form>

                            <!-- end form-->

                            <!-- Footer-->
                            <footer class="footer">
                                <p class="text-muted">2020 - <script>
                                        document.write(new Date().getFullYear())
                                    </script> &copy; by <a href="javascript: void(0);" class="text-muted">Paxsuzen</a> </p>
                            </footer>

                        </div> <!-- end .card-body -->
                    </div> <!-- end .align-items-center.d-flex.h-100-->
                </div>
            </div>

            <!-- end auth-fluid-form-box-->

            <!-- Auth fluid right content -->
        </div>
    </div>
    <!-- end auth-fluid-->

    <!-- Vendor js -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>

    <script src="{{ asset('js/custom/user_config.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- App js -->
    <script src="{{ asset('js/app.min.js') }}"></script>

    <script type="text/javascript">
        var locale = "{{ Session::get('locale') }}";
        var url = "{{ route('changeLang') }}";
        //change button stuff on click
        $('#a li').click(function() {
            var img = $(this).find('img').attr("src");
            var value = $(this).find('img').attr('value');
            window.location.href = url + "?lang=" + value;
            var text = this.innerText;
            var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
            $('.btn-select').html(item);
            $('.btn-select').attr('value', value);
            $(".b").toggle();
        });

        $(".btn-select").click(function() {
            $(".b").toggle();
        });
        var locale_lang = "{{ Cookie::get('locale') }}";
        var language_name = "{{ $language_name }}";
        if (locale_lang) {
            if (locale_lang == "japanese") {
                //find an item with value of sessionLang\
                var img = "{{ config('constants.image_url').'/common-asset/images/JPN.png' }}";
                var value = "japanese";
                var text = "日本語";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            } else if (locale_lang == "malay") {
                var img = "{{ config('constants.image_url').'/common-asset/images/MAL.png' }}";
                var value = "malay";
                var text = "Malay";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            } else {
                var img = "{{ config('constants.image_url').'/common-asset/images/USA.png' }}";
                var value = "en";
                var text = "English";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            }
        } else if (language_name) {
            if (language_name == "japanese") {
                //find an item with value of sessionLang\
                var img = "{{ config('constants.image_url').'/common-asset/images/JPN.png' }}";
                var value = "japanese";
                var text = "日本語";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            } else if (language_name == "malay") {
                var img = "{{ config('constants.image_url').'/common-asset/images/MAL.png' }}";
                var value = "malay";
                var text = "Malay";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            } else {
                var img = "{{ config('constants.image_url').'/common-asset/images/USA.png' }}";
                var value = "en";
                var text = "English";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            }
        } else {
            if (locale == "japanese") {
                //find an item with value of sessionLang\
                var img = "{{ config('constants.image_url').'/common-asset/images/JPN.png' }}";
                var value = "japanese";
                var text = "日本語";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            } else if (locale == "malay") {
                var img = "{{ config('constants.image_url').'/common-asset/images/MAL.png' }}";
                var value = "malay";
                var text = "Malay";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            } else {
                var img = "{{ config('constants.image_url').'/common-asset/images/USA.png' }}";
                var value = "en";
                var text = "English";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            }
        }
    </script>

</body>

</html>