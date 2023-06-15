<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" /> -->
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
    <!--<link href="{{ asset('public/css/custom/admin_login.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/opensans-font.css') }}" rel="stylesheet" type="text/css" />-->
    <link href="{{ asset('public/css/custom-minified/admin_login.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom-minified/opensans-font.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/home.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="loading auth-fluid-pages pb-0">
    <div class="account-pages">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="lang-select">
                            <button class="btn-select" value=""></button>
                            <div class="b" style="text-align:justify;">
                                <ul id="a" style="margin-bottom:0px;">
                                    <li><img src="{{ config('constants.image_url').'/public/common-asset/images/USA.png' }}" alt="en" value="en" /><span>English</span></li>
                                    <li><img src="{{ config('constants.image_url').'/public/common-asset/images/JPN.png' }}" alt="japanese" value="japanese" /><span>日本語</span></li>

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
                                        <img src="{{ config('constants.image_url').'/public/common-asset/images/Suzen-app-logo.png' }}" alt="" height="45px" style="margin-bottom: 10px;">
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <!-- form -->
                        <div class="form">
                            <form id="LoginAuth" action="{{ route('admin.authenticate') }}" method="post">
                                <div class="form-group">
                                    <!-- <span class="badge badge-secondary smk"><img src="{{ asset('public/images/school.png') }}" class="mr-2 rounded-circle" alt="">SMK BERJAYA</span> -->
                                    <span class="badge badge-secondary smk"><img src="{{ config('constants.image_url').'/public/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle" alt="">{{$school_name}}</span>
                                    <!-- <span class="badge badge-secondary smk"><img src="{{ asset('public/images/school.jpg') }}" class="mr-2 rounded-circle" alt="">Maahad Tahfiz Al-Quran Darul Saadah Lilbanat</span> -->
                                </div>

                                <h3 class="animated fadeInDown" style="font-size:22px;">{{ __('messages.welcome_to') }} {{$school_name}}</h3>
                                <p class="card-text para">
                                    {{ __('messages.to_learn_as_much_as_i_can') }}
                                </p>
                                <h3 class="mb-2">{{ __('messages.contact_us') }}</h3>
                                <div class="icon-item">
                                    <i class="fa fa-map-marker"></i>
                                    <span style="margin-left: 12px;">Saujana Resort Seksyen U2, 40150 , Selangor Darul Ehsan, Malaysia</span>
                                </div>
                                <div class="icon-item" style="margin-right: 25px;">
                                    <i class="fa fa-phone"></i>
                                    <!-- <span style="margin-left: 10px;"><a href="tel:123-456-7890">{{$home['mobile_no']}}</a></span> -->
                                    <span style="margin-left: 10px;"><a href="tel:03-7846-5939">03-7846-5939</a></span>
                                </div>
                                <div class="icon-item">
                                    <i class="fa fa-envelope"></i>
                                    <span style="margin-left: 11px;"><a href="mailto:jskl2@jskl.edu.my">jskl2@jskl.edu.my</a></span>
                                </div>
                                <h3 class="text-center mb-2">{{ __('messages.location') }}</h3>
                                <div class="maps">
                                    <iframe src="{{$home['location']}}" frameborder="0" style="border:0;" allowfullscreen class="map"></iframe>
                                </div>

                            </form>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="card">
                                    <a href="{{ route('parent.login') }}">
                                        <img class="card-img-top img-fluid" src="{{$parent_image}}" alt="Card image cap">
                                        <div class="card-body" style="padding: 15px;">
                                            <h6 class="card-title text-center sfont">{{ __('messages.parent_login') }}</h6>
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-0"></div>
                            <div class="col-md-5">
                                <div class="card">
                                    <a href="{{ route('student.login') }}">
                                        <img class="card-img-top img-fluid" src="{{$student_image}}" alt="Card image cap">
                                        <div class="card-body" style="padding: 15px;">
                                            <h6 class="card-title text-center sfont">{{ __('messages.student_login') }}</h6>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="card">
                                    <a href="{{ route('teacher.login') }}">
                                        <img class="card-img-top img-fluid" src="{{$teacher_image}}" alt=" Card image cap">
                                        <div class="card-body" style="padding: 15px;">
                                            <h6 class="card-title text-center sfont">{{ __('messages.teacher_login') }}</h6>
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-0"></div>
                            <div class="col-md-5">
                                <div class="card">
                                    <a href="{{ route('schoolcrm.app.form') }}">
                                        <img class="card-img-top img-fluid" src="{{$application}}" alt="Card image cap">
                                        <div class="card-body" style="padding: 15px;">
                                            <h6 class="card-title text-center sfont">{{ __('messages.application') }}</h6>
                                        </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Google Map -->
    </div>

    <footer class="footer footer-alt">
        <p class="text-muted">2020 - <script>
                document.write(new Date().getFullYear())
            </script> &copy; by <a href="javascript: void(0);" class="text-muted">Paxsuzen</a> </p>
    </footer>


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
                var img = "{{ config('constants.image_url').'/public/common-asset/images/JPN.png' }}";
                var value = "japanese";
                var text = "日本語";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            } else {
                var img = "{{ config('constants.image_url').'/public/common-asset/images/USA.png' }}";
                var value = "en";
                var text = "English";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            }
        } else if (language_name) {
            if (language_name == "japanese") {
                //find an item with value of sessionLang\
                var img = "{{ config('constants.image_url').'/public/common-asset/images/JPN.png' }}";
                var value = "japanese";
                var text = "日本語";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            } else {
                var img = "{{ config('constants.image_url').'/public/common-asset/images/USA.png' }}";
                var value = "en";
                var text = "English";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            }
        } else {
            if (locale == "japanese") {
                //find an item with value of sessionLang\
                var img = "{{ config('constants.image_url').'/public/common-asset/images/JPN.png' }}";
                var value = "japanese";
                var text = "日本語";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            } else {
                var img = "{{ config('constants.image_url').'/public/common-asset/images/USA.png' }}";
                var value = "en";
                var text = "English";
                var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
                $('.btn-select').html(item);
                $('.btn-select').attr('value', value);
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
        //soapCategory routes
        var imageUrl = "{{ config('constants.image_url').'/public/soap/images/' }}";
        var soapIndex = "{{ route('admin.soap') }}";
        var soapDelete = "{{ config('constants.api.soap_delete') }}";
    </script>
    <!-- Summernote js -->
    <script src="{{ asset('public/libs/summernote/summernote-bs4.min.js') }}"></script>

</body>

</html>