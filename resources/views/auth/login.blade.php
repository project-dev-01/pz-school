<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/images/favicon.ico') }}">
    <!-- App css -->
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('public/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="{{ asset('public/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('public/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
    <!-- icons -->
    <link href="{{ asset('public/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/admin_login.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/opensans-font.css') }}" rel="stylesheet" type="text/css" />
</head>


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
                        <div class="form-group" style="text-align:right;">
                            <!-- <label class="control-label"></label>
                            <select class="form-control custom-select changeLang" style="white-space: nowrap; text-overflow: ellipsis; margin-top: 20px;
                                    margin-left:4px; max-height: 30px; padding-top: 5px; -webkit-line-clamp: 2; display: inline-grid; width:150px;" name="all_child" id="changeChildren" required>
                                <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                                <option value="japanese" {{ session()->get('locale') == 'japanese' ? 'selected' : '' }}>Japanese</option>
                            </select> -->
                             <select class="vodiapicker">
                                <option value="en" data-thumbnail="{{ asset('public/images/USA.png') }}">EN</option>
                                <option value="japanese" data-thumbnail="{{ asset('public/images/JPN.png') }}">JAP</option>
                            </select>
                            <div class="lang-select" style="float: right; margin-top:-15px;">
                                <button class="btn-select" value=""></button>
                                <div class="b" style="text-align:justify;">
                                    <ul id="a" style="margin-bottom:0px;"></ul>
                                </div>
                            </div>
                            <!-- <select class="vodiapicker">
                                <option value="en"  data-thumbnail="{{ asset('public/images/USA.png') }}">EN</option>
                                <option value="japanese"  data-thumbnail="{{ asset('public/images/JPN.png') }}">Jap</option>
                            </select>
                            <div class="lang-select" style="float: right; margin-top:-15px;">
                                <button class="btn-select" value=""></button>
                                <div class="b" style="text-align:justify;">
                                    <ul id="a" style="margin-bottom:0px;">

                                    </ul>
                                </div>
                            </div> -->
                            <!-- <div class="col col-2 lang-select mt-1 ml-2 " style="float: right;">
                                <button class="btn-select" value="en"><li><img src="http://localhost/school_new/public/images/USA.png" alt=""><span>EN</span></li></button>
                                <div class="b">
                                    <ul id="a">
                                        <li>
                                            <img src="http://localhost/school_new/public/images/USA.png" alt="" value="en"><span>EN</span>
                                        </li>
                                        <li>
                                            <img src="http://localhost/school_new/public/images/JPN.png" alt="" value="japanese"><span>JAP</span>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->
                        </div>

                        <!-- Logo -->
                        <div class="auth-brand text-center text-lg-left">
                            <div class="auth-logo">
                                <div class="auth-logo">
                                    <a href="" class="logo logo-dark">
                                        <span class="logo-lg">
                                            <img src="{{ asset('public/images/Suzen-app-logo.png') }}" alt="" height="60px">
                                        </span>
                                    </a>
                                </div>
                            </div>
                           
                        </div>

                        <!-- form -->
                        <div class="form">
                            <form id="LoginAuth" action="{{ route('admin.authenticate') }}" method="post">
                                <h1 class="welcomeback">{{ __('messages.welcome_back') }},</h1>
                                <input type="hidden" name="branch_id" value="1">
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
                                    <!-- <span class="badge badge-secondary smk"><img src="{{ asset('public/images/school.png') }}" class="mr-2 rounded-circle" alt="">SMK BERJAYA</span> -->
                                    <span class="badge badge-secondary smk"><img src="{{ asset('public/images/school.jpg') }}" class="mr-2 rounded-circle" alt="">SMK Kiaramas</span>
                                    <!-- <span class="badge badge-secondary smk"><img src="{{ asset('public/images/school.jpg') }}" class="mr-2 rounded-circle" alt="">Maahad Tahfiz Al-Quran Darul Saadah Lilbanat</span> -->
                                </div>

                                <div class="form-group">
                                    <input class="form-control login-email" type="email" id="email" name="email" required="" placeholder="{{ __('messages.enter_your_email') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="{{ __('messages.enter_your_password') }}">
                                        <div class="input-group-append" data-password="false">
                                            <div class="input-group-text">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
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
    <!-- <script src="{{ asset('public/js/custom/login.js') }}"></script> -->
    <!-- <script type="text/javascript">
        var url = "{{ route('changeLang') }}";

        $(".changeLang").change(function() {
            window.location.href = url + "?lang=" + $(this).val();
        });
    </script> -->
    
<script type="text/javascript">
    

    var locale = "{{ Session::get('locale') }}";
    var url = "{{ route('changeLang') }}";
    var langArray = [];
    $('.vodiapicker option').each(function(){
        var img = $(this).attr("data-thumbnail");
        var text = this.innerText;
        var value = $(this).val();
        var item = '<li><img src="'+ img +'" alt="" value="'+value+'"/><span>'+ text +'</span></li>';
        langArray.push(item);
        })

        $('#a').html(langArray);

        //Set the button value to the first el of the array
        $('.btn-select').html(langArray[0]);
        $('.btn-select').attr('value', 'en');

        //change button stuff on click
        $('#a li').click(function(){
            
        var img = $(this).find('img').attr("src");
        var value = $(this).find('img').attr('value');
        
        window.location.href = url + "?lang=" + value;
        var text = this.innerText;
        var item = '<li><img src="'+ img +'" alt="" /><span >'+ text +'</span></li>';
        $('.btn-select').html(item);
        $('.btn-select').attr('value', value);
        $(".b").toggle();
        //console.log(value);
    });

    $(".btn-select").click(function(){
            $(".b").toggle();
        });

    //check local storage for the lang
    var sessionLang = locale;
    // console.log('en',sessionLang)
    if (locale=="japanese"){
        //find an item with value of sessionLang\
        var img = "{{ asset('public/images/JPN.png') }}";
        var value = "japanese";
        var text = "JAP";
        var item = '<li><img src="'+ img +'" alt="" /><span >'+ text +'</span></li>';
        $('.btn-select').html(item);
        $('.btn-select').attr('value', value);
    } else {
        var img = "{{ asset('public/images/USA.png') }}";
        var value = "en";
        var text = "EN";
        var item = '<li><img src="'+ img +'" alt="" /><span >'+ text +'</span></li>';
        $('.btn-select').html(item);
        $('.btn-select').attr('value', value);
    }
</script>

</body>

</html>