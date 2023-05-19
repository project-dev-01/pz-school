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
    <link rel="shortcut icon" href="{{ config('constants.image_url').'/public/images/favicon.ico' }}">
    <!-- App css -->
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('public/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <!-- icons -->
    <link href="{{ asset('public/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/login.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/opensans-font.css') }}" rel="stylesheet" type="text/css" />
    <!-- <link href="{{ asset('public/css/custom-minified/admin_login.min.css') }}" rel="stylesheet" type="text/css" /> -->
    <link href="{{ asset('public/css/custom-minified/opensans-font.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('public/css/custom/homeresponsive.css') }}" rel="stylesheet" type="text/css" />
</head>
<body class="loading auth-fluid-pages pb-0">
    <section class="features-list" >
        <div class="col-md-12">
            <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="text-center">
                        <div class="form-group mt-2">
                        <div class="auth-brand text-center text-lg-left">
                            <div class="auth-logo">
                                <div class="auth-logo">
                                    <a href="" class="logo logo-dark">
                                        <span class="logo-lg">
                                            <img src="{{ config('constants.image_url').'/public/images/Suzen-app-logo.png' }}" alt="" height="60px" class="logo">
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <span class="badge badge-secondary smk text-center schl"><img src="{{ config('constants.image_url').'/public/images/'.$school_image }}" class="mr-2 rounded-circle" alt="">{{$school_name}}</span>
                        </div>
                        <div class="row hero-content">
                            <div class="col-md-12">
                                <h2 class="animated fadeInDown">Welcome To {{$school_name}} School</h2>
                                <p class="color-white" style="margin-left: 30px; margin-right: 30px;margin-bottom: 3px;">To learn as much as I can, attain good grades and advance my education further.<br> I believe that self-motivation and a strict routine has helped me achieve my goals so far, and I will use the same method in the future.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="mb-3 text-center">Contact Us<span class="text-uppercase margin-l-20"></span></h3>
                    </div>
                </div>
                <div class=" contact">
                <div class="row">
                    <div  class="col-md-2"></div>
                    <div class="col-md-8 contactresponsive">
                          <div class="row">
                            <div  class="col-sm-12 col-md-12 col-lg-12">
                            <div class="icon-item" style="margin-bottom: 5px;">
                            <i class="fa fa-map-marker"></i>
                            <span style="margin-left: 12px;">{{$home['address']}}</span>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                            <div  class="col-sm-8 col-md-8 col-lg-8">
                            <div class="icon-item" style="margin-bottom: 5px;">
                            <i class="fa fa-phone"></i>
                            <span style="margin-left: 10px;">{{$home['mobile_no']}}</span>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                            <div  class="col-sm-8 col-md-8 col-lg-8">
                            <div class="icon-item" style="margin-bottom: 5px;">
                            <i class="fa fa-envelope"></i>
                            <span style="margin-left: 7px;">{{$home['email']}}</span>
                        </div>
                        </div>
                        </div>
                        
                    </div>
                </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h3 class="text-center mb-3" style="margin-top: 10px;">Location<span class="text-uppercase margin-l-20"></span></h3>
						  <!-- Google Map -->
						<div class="map">
						    <iframe src="{{$home['location']}}" width="100%" height="210px" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>
                </div>
               </div>
            </div>
            <!-- end Auth fluid right content -->

            <!--Auth fluid left content -->
            <div class="col-md-6">
                <div class="">
                <div class="row">
                    <!-- <div class="col-md-1 pt-2"></div> -->
                    <div class="col-md-6 pt-2">
                                <!-- Simple card -->
                        <div class="card">
                            <a href="{{ route('parent.login') }}">
                                <img class="card-img-top img-fluid" src="{{$parent_image}}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Parent Login</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 pt-2">
                                <!-- Simple card -->
                        <div class="card">
                            <a href="{{ route('student.login') }}">
                                <img class="card-img-top img-fluid" src="{{$student_image}}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Student Login</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                                <!-- Simple card -->
                        <div class="card">
                            <a href="{{ route('teacher.login') }}">
                                <img class="card-img-top img-fluid" src="{{$teacher_image}}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Teacher Login</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                                <!-- Simple card -->
                        <div class="card">
                            <a href="{{ route('schoolcrm.app.form') }}">
                                <img class="card-img-top img-fluid" src="{{$application}}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Application</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
</div>
</div>
</div>
    </section>
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

    $(".btn-select").click(function(){
        $(".b").toggle();
    });
    //check local storage for the lang
    var sessionLang = locale;
    // console.log('en',sessionLang)
    if (locale=="japanese"){
        //find an item with value of sessionLang\
        var img = "{{ config('constants.image_url').'/public/images/JPN.png' }}";
        var value = "japanese";
        var text = "JPN";
        var item = '<li><img src="'+ img +'" alt="" /><span >'+ text +'</span></li>';
        $('.btn-select').html(item);
        $('.btn-select').attr('value', value);
    } else {
        var img = "{{ config('constants.image_url').'/public/images/USA.png' }}";
        var value = "en";
        var text = "ENG";
        var item = '<li><img src="'+ img +'" alt="" /><span >'+ text +'</span></li>';
        $('.btn-select').html(item);
        $('.btn-select').attr('value', value);
    }
</script>

</body>

</html>