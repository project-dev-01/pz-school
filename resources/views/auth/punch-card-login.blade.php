<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>PunchCard Login</title>
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
    <!-- <link href="{{ asset('css/custom/login.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom/opensans-font.css') }}" rel="stylesheet" type="text/css" /> -->
    <link href="{{ asset('css/custom-minified/login.min.css') }}" rel="stylesheet" type="text/css" />
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
                    <div class="auth-user-testimonial">
                        <p class="mb-3 text-white text"></p>
                        <!-- <p class="mb-3 text-white text">{{ __('messages.teaching_is_the_greatest') }}<br>{{ __('messages.act_of_optimism') }}</p> -->
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
                        <div class="form-group" style="text-align:right;">
                             <select class="vodiapicker">
                                <option value="en" data-thumbnail="{{ config('constants.image_url').'/common-asset/images/USA.png' }}">ENG</option>
                                <option value="japanese" data-thumbnail="{{ config('constants.image_url').'/common-asset/images/JPN.png' }}">JPN</option>
                            </select>
                            <div class="lang-select" style="float: right; margin-top:-15px;">
                                <button class="btn-select" value=""></button>
                                <div class="b" style="text-align:justify;">
                                    <ul id="a" style="margin-bottom:0px;"></ul>
                                </div>
                            </div>
                        </div>

                        <!-- Logo -->
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

                        <!-- form -->
                        <div class="form">
                            <form id="getOtp" action="{{ route('employee.punchcarddetails') }}" method="post" enctype="multipart/form-data" autocomplete="off">
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
                                <h1 class="welcomeback">{{ __('messages.welcome_back') }}</h1>
                                <div class="form-group">
                                    <!-- <span class="badge badge-secondary smk"><img src="{{ asset('images/school.png') }}" class="mr-2 rounded-circle" alt="">BERJAYA</span> -->
                                    <span class="badge badge-secondary smk"><img src="{{ config('constants.image_url').'/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle" alt="">{{$school_name}}</span>
                                </div>
                                <input class="form-control" type="hidden" name="session" value="{{$session}}">
                                <input class="form-control" type="hidden" name="branch_id" value="{{$branch_id}}">
                                <div class="form-group">
                                    <input class="form-control" type="email" id="email" name="email" value="{{Cookie::get('email')}}" required placeholder="{{ __('messages.enter_your_email') }}">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password" value="{{Cookie::get('password')}}" required placeholder="{{ __('messages.enter_your_password') }}">
                                </div>
                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-block signin" type="submit">{{ __('messages.sign_in') }}</button>
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
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- App js -->
    <script src="{{ asset('js/app.min.js') }}"></script>
    <!-- <script src="{{ asset('js/custom/login.js') }}"></script> -->

    <script type="text/javascript">
        var locale = "{{ Session::get('locale') }}";
        var url = "{{ route('changeLang') }}";
        var langArray = [];
        $('.vodiapicker option').each(function() {
            var img = $(this).attr("data-thumbnail");
            var text = this.innerText;
            var value = $(this).val();
            var item = '<li><img src="' + img + '" alt="" value="' + value + '"/><span>' + text + '</span></li>';
            langArray.push(item);
        })

        $('#a').html(langArray);

        //Set the button value to the first el of the array
        $('.btn-select').html(langArray[0]);
        $('.btn-select').attr('value', 'en');

        //change button stuff on click
        $('#a li').click(function() {

            var img = $(this).find('img').attr("src");
            var value = $(this).find('img').attr('value');

            console.log('value', value)
            window.location.href = url + "?lang=" + value;
            var text = this.innerText;
            var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
            $('.btn-select').html(item);
            $('.btn-select').attr('value', value);
            $(".b").toggle();
            //console.log(value);
        });

        console.log('1', locale)
        $(".btn-select").click(function() {
            $(".b").toggle();
        });

        //check local storage for the lang
        var sessionLang = locale;
        // console.log('en',sessionLang)
        if (locale == "japanese") {
            //find an item with value of sessionLang\
            var img = "{{ config('constants.image_url').'/common-asset/images/JPN.png' }}";
            var value = "japanese";
            var text = "JPN";
            var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
            $('.btn-select').html(item);
            $('.btn-select').attr('value', value);
        } else {
            var img = "{{ config('constants.image_url').'/common-asset/images/USA.png' }}";
            var value = "en";
            var text = "ENG";
            var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
            $('.btn-select').html(item);
            $('.btn-select').attr('value', value);
        }
    </script>
</body>

</html>