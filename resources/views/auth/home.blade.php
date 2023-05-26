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
</head>
<style>
    .smk {
        height: 65px;
        background: #D2EDEF;
        font-family: 'Open Sans';
        font-size: 14px;
        text-align: center;
        color: #16191D;
        width: 50%;
        padding-left: 0px;
        margin-left: 119px;
    }

    .map {
        width: 100%;
        height: 100%;
    }

    .auth-user-testimonial {
        position: relative;
        margin: 0 auto;
        padding: 0 1.75rem;
        bottom: 3rem;
        left: 0;
        right: 0;
    }

    .auth-fluid .auth-fluid-form-box {
        max-width: 100%;
        border-radius: 0;
        z-index: 2;
        background-color: #fff;
        position: relative;
        width: 100%;
        height: auto;
    }

    @media screen and (min-device-width: 600px) and (max-device-width: 1024px) {
        .auth-fluid .auth-fluid-right {
            padding: 3rem 1rem;
        }

        .auth-fluid .auth-fluid-form-box {
            padding: 2rem 0rem;
        }
    }

    @media screen and (min-device-width: 1920px) and (max-device-width: 1080px) {
        .auth-fluid .auth-fluid-right {
            padding: 5rem 1rem;
        }

        .auth-fluid .auth-fluid-form-box {
            padding: 4rem 0rem;
        }
    }

    body {
        -ms-overflow-style: none;
        /* for Internet Explorer, Edge */
        scrollbar-width: none;
        /* for Firefox */
        overflow-y: scroll;
    }

    body::-webkit-scrollbar {
        display: none;
        /* for Chrome, Safari, and Opera */
    }
</style>

<body class="loading auth-fluid-pages pb-0">
    <div class="auth-fluid responsive" style="height:200px;">

        <!-- Auth fluid right content -->
        <div class="col-md-6 auth-fluid-right" style="background-color:#8b848414;color:black;">
            <div class="auth-user-testimonial">
                <div class="">
                        <div class="form-group">
                            <select class="vodiapicker">
                                <option value="en" data-thumbnail="{{ config('constants.image_url').'/public/common-asset/images/USA.png' }}">English</option>
                                <option value="japanese" data-thumbnail="{{ config('constants.image_url').'/public/common-asset/images/JPN.png' }}">日本語</option>
                            </select>
                            <div class="lang-select" style="float: right;">
                                <button class="btn-select" value=""></button>
                                <div class="b" style="text-align:justify;">
                                    <ul id="a" style="margin-bottom:0px;"></ul>
                                </div>
                            </div>
                        </div>
                        <!-- Logo -->
                        <div class="auth-logo">
                            <div class="auth-logo">
                                <div class="auth-logo">
                                    <a href="" class="logo logo-dark">
                                        <span class="logo-lg">
                                            <img src="{{ config('constants.image_url').'/public/common-asset/images/Suzen-app-logo.png' }}" alt="" height="50px">
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- form -->
                        <div class="form">
                            <form id="LoginAuth" action="{{ route('admin.authenticate') }}" method="post">
                                <div class="form-group">
                                    <!-- <span class="badge badge-secondary smk"><img src="{{ asset('public/images/school.png') }}" class="mr-2 rounded-circle" alt="">SMK BERJAYA</span> -->
                                    <span class="badge badge-secondary smk"><img src="{{ config('constants.image_url').'/public/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle" alt="">{{$school_name}}</span>
                                    <!-- <span class="badge badge-secondary smk"><img src="{{ asset('public/images/school.jpg') }}" class="mr-2 rounded-circle" alt="">Maahad Tahfiz Al-Quran Darul Saadah Lilbanat</span> -->
                                </div>

                                <h3 class="animated fadeInDown" style="text-align: center;">{{ __('messages.welcome_to') }} {{$school_name}} {{ __('messages.school') }}</h3>
                                <p class="card-text" style="text-align: center;">
                                {{ __('messages.to_learn_as_much_as_i_can') }}
                                </p>
                                <h3 class="mb-2 text-center">{{ __('messages.contact_us') }}</h3>
                                <div class="icon-item" style="margin-bottom: 5px; margin-left: 150px;">
                                <i class="fa fa-map-marker"></i>
                                <span style="margin-left: 12px;">{{$home['address']}}</span>
                            </div>
                            <div class="icon-item" style="margin-bottom: 5px; margin-left: 150px;">
                                <i class="fa fa-phone"></i>
                                <span style="margin-left: 10px;">{{$home['mobile_no']}}</span>
                            </div>
                            <div class="icon-item" style="margin-bottom: 5px; margin-left: 150px;">
                                <i class="fa fa-envelope"></i>
                                <span style="margin-left: 7px;">{{$home['email']}}</span>
                                </div>
                                <h3 class="text-center mb-2">{{ __('messages.location') }}</h3>
						  <!-- Google Map -->
                          
						<div class="maps">
						    <iframe src="{{$home['location']}}" frameborder="0" style="border:0;" allowfullscreen class="map"></iframe>
						</div>
                            </form>
                        </div> 
                            
                    </div> <!-- end .align-items-center.d-flex.h-100-->
                </div> <!-- end auth-user-testimonial-->
            </div>
            <!-- end Auth fluid right content -->
            
            <!--Auth fluid left content -->
            <div class="col-md-6 auth-fluid-form-box" style="background-color:#8b848414;">
                <div class="align-items-center d-flex h-100">
                    <div class="card-body">
                        <!-- Logo -->
                       <div class="row">
					   <div class="col-md-6" style="padding:10px">
                        <div class="card">
                        <a href="{{ route('parent.login') }}">
							<img src="{{$parent_image}}" style="height:200px" class="card-img-top" alt="...">
							  <div class="card-body">
                              <h6 class="card-title text-center" style="margin-bottom: 0px;">{{ __('messages.parent_login') }}</h6>
								 </div>
							</div>
						</div>
						<div class="col-md-6" style="padding:10px">
						 <div class="card">
                         <a href="{{ route('student.login') }}">
							<img src="{{$student_image}}" style="height:200px" class="card-img-top" alt="...">
							  <div class="card-body">
							  <h6 class="card-title text-center"style="margin-bottom: 0px;">{{ __('messages.student_login') }}</h6>
								 </div>
								 </div>
								 </div>
						</div>
						<div class="row">
						<div class="col-md-6" style="padding:10px">
						 <div class="card">
                         <a href="{{ route('teacher.login') }}">
							<img src="{{$teacher_image}}" style="height:200px" class="card-img-top" alt="...">
							  <div class="card-body">
							  <h6 class="card-title text-center"style="margin-bottom: 0px;">{{ __('messages.teacher_login') }}</h6>
								 </div>
						 </div>
						 </div>
						 <div class="col-md-6" style="padding:10px">
						 <div class="card">                          
                         <a href="{{ route('schoolcrm.app.form') }}">
							<img src="{{$application}}" style="height:200px" class="card-img-top" alt="...">
							  <div class="card-body">
							  <h6 class="card-title text-center"style="margin-bottom: 0px;">{{ __('messages.application') }}</h6>
								 </div>						  </div>
								 </div>
						</div>
                        <!-- Footer-->
                        <footer class="footer">
                                <p class="text-muted">2020 - <script>
                                        document.write(new Date().getFullYear())
                                    </script> &copy; by <a href="javascript: void(0);" class="text-muted">Paxsuzen</a> </p>
                            </footer>
                    </div> <!-- end .card-body -->
                </div> <!-- end .align-items-center.d-flex.h-100-->
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->

        <!--Auth fluid left content -->
        <div class="col-md-6 auth-fluid-form-box" style="background-color:#8b848414;">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="row">
                        <div class="col-md-6" style="padding:10px">
                            <div class="card">
                                <a href="{{ route('parent.login') }}">
                                    <img src="{{$parent_image}}" style="height:200px" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h6 class="card-title text-center" style="margin-bottom: 0px;">Parent Login</h6>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding:10px">
                            <div class="card">
                                <a href="{{ route('student.login') }}">
                                    <img src="{{$student_image}}" style="height:200px" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h6 class="card-title text-center" style="margin-bottom: 0px;">Teacher Login</h6>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="padding:10px">
                            <div class="card">
                                <a href="{{ route('teacher.login') }}">
                                    <img src="{{$teacher_image}}" style="height:200px" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h6 class="card-title text-center" style="margin-bottom: 0px;">Teacher Login</h6>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding:10px">
                            <div class="card">
                                <a href="{{ route('schoolcrm.app.form') }}">
                                    <img src="{{$application}}" style="height:200px" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h6 class="card-title text-center" style="margin-bottom: 0px;">Application</h6>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->
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

            window.location.href = url + "?lang=" + value;
            var text = this.innerText;
            var item = '<li><img src="' + img + '" alt="" /><span >' + text + '</span></li>';
            $('.btn-select').html(item);
            $('.btn-select').attr('value', value);
            $(".b").toggle();
            //console.log(value);
        });

        $(".btn-select").click(function() {
            $(".b").toggle();
        });
        //check local storage for the lang
        var sessionLang = locale;
        // console.log('en',sessionLang)
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
    </script>

</body>

</html>