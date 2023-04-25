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
    <!-- icons -->
    <link href="{{ asset('public/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/admin_login.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/opensans-font.css') }}" rel="stylesheet" type="text/css" />
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
                        <div class="form-group" style="text-align:right;">
                             <select class="vodiapicker">
                                <option value="en" data-thumbnail="{{ asset('public/images/USA.png') }}">ENG</option>
                                <option value="japanese" data-thumbnail="{{ asset('public/images/JPN.png') }}">JPN</option>
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
                                            <img src="{{ asset('public/images/Suzen-app-logo.png') }}" alt="" height="60px">
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- form -->
                        <div class="form">
                            <form id="LoginAuth" action="{{ route('staff.authenticate') }}" method="post">
                                <h1 class="welcomeback">{{ __('messages.welcome_back') }},</h1>
                                <input type="hidden" name="branch_id" value="{{$branch_id}}">
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
                                    <span class="badge badge-secondary smk"><img src="{{ asset('public/images/').'/'.$school_image }}" class="mr-2 rounded-circle" alt="">{{$school_name}}</span>
                                    <!-- <span class="badge badge-secondary smk"><img src="{{ asset('public/images/school.jpg') }}" class="mr-2 rounded-circle" alt="">Maahad Tahfiz Al-Quran Darul Saadah Lilbanat</span> -->
                                </div>

                                <div class="form-group">
                                    <input class="form-control login-email" type="email" id="email" value="{{ Cookie::get('email') ? Cookie::get('email'):'' }}" name="email" required="" placeholder="{{ __('messages.enter_your_email') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" name="password" value="{{ Cookie::get('password') ? Cookie::get('password'):'' }}" placeholder="{{ __('messages.enter_your_password') }}">
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
        
    console.log('value',value)
        window.location.href = url + "?lang=" + value;
        var text = this.innerText;
        var item = '<li><img src="'+ img +'" alt="" /><span >'+ text +'</span></li>';
        $('.btn-select').html(item);
        $('.btn-select').attr('value', value);
        $(".b").toggle();
        //console.log(value);
    });

    console.log('1',locale)
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
        var text = "JPN";
        var item = '<li><img src="'+ img +'" alt="" /><span >'+ text +'</span></li>';
        $('.btn-select').html(item);
        $('.btn-select').attr('value', value);
    } else {
        var img = "{{ asset('public/images/USA.png') }}";
        var value = "en";
        var text = "ENG";
        var item = '<li><img src="'+ img +'" alt="" /><span >'+ text +'</span></li>';
        $('.btn-select').html(item);
        $('.btn-select').attr('value', value);
    }
</script>
    <!-- <script src="{{ asset('public/js/custom/login.js') }}"></script> -->

</body>

</html>