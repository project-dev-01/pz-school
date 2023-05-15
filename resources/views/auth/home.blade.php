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
</head>
<style>


/* .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    
    width: unset;
} */


.col-md-6 {
}
.auth-brand {
    position: absolute;
    padding-left: 50px;
    top: unset;
}
.card-body {
    padding: 8px;
}
</style>

<body class="loading auth-fluid-pages pb-0">
    
    <!-- <header style="background-color:#6fc6cc">
        <section class="hero" >
            <div class="container" >
                <div class="row justify-content-between pt-2 pb-2" >
                    <nav class="col-md-6 col-sm-6 col-xs-6 navbar navbar-light">
                        <a class="navbar-brand" href="#">
                            <img src="{{ config('constants.image_url').'/public/images/'.$school_image }}" width="30" height="30" class="d-inline-block align-top" alt="">
                            {{$school_name}}
                        </a>
                    </nav>
                    <nav class="col-md-6 col-sm-6 col-xs-6 navbar navbar-expand-lg navbar-light ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Application</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Login
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Parent</a>
                                <a class="dropdown-item" href="#">Student</a>
                                <a class="dropdown-item" href="#">Teacher</a>
                                </div>
                            </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </section>
    </header> -->
    <section class="features-list" >
        <div class="row">
            <div class="col-md-6 ">
                <div class="row">
                    <div class=" text-center">
                        <div class="form-group mt-2">
                        <div  class="col-md-3"></div>
                        <div class="col-md-6">
                        </div>
                        <div  class="col-md-3"></div>
                        <div class="auth-brand text-center text-lg-left">
                            <div class="auth-logo">
                                <div class="auth-logo">
                                    <a href="" class="logo logo-dark">
                                        <span class="logo-lg">
                                            <img src="{{ config('constants.image_url').'/public/images/Suzen-app-logo.png' }}" alt="" height="60px">
                                        </span>
                                    </a>
                                </div>
                            </div>

                        </div><span class="badge badge-secondary smk text-center" style="width:50%"><img src="{{ config('constants.image_url').'/public/images/'.$school_image }}" class="mr-2 rounded-circle" alt="">{{$school_name}}</span>
                        </div>
                        <br>
                        <div class="row hero-content">
                            <div class="col-md-12">
                                <h1 class="animated fadeInDown">Welcome To {{$school_name}} School</h1>
                                <p class="color-white">To learn as much as I can, attain good grades and advance my education further.<br> I believe that self-motivation and a strict routine has helped me achieve my goals so far, and I will use the same method in the future.</p>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                
                <div class="row">
                    <div  class="col-md-3"></div>
                    <div class="col-md-6">
                        <h3 class="mb-3 text-center">Contact Us<span class="text-uppercase margin-l-20"></span></h3>
                    </div>
                    <div  class="col-md-2"></div>
                </div>
                
                <div class="row">
                    <div  class="col-md-4"></div>
                    <div class="col-md-6">
                    <!-- <div class="row">
                            <div  class="col-md-1"><i class="fa fa-map-marker"></i></div>
                            <div  class=" col-md-10"><p align="justify" class="pr-5"></i>No.338, Jln Tun Razak,Kampung Datuk Keramat, 55000 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur, Malaysia</p></div>
                        </div> -->
                        <div class="row">
                            <div  class="col-md-1"><i class="fa fa-map-marker"></i></div>
                            <div  class=" col-md-10"><p align="justify">{{$home['address']}}</p></div>
                        </div>

                        <div class="row">
                            <div  class="col-md-1"><i class="fa fa-phone"></i></div>
                            <div  class=" col-md-10"><p ></i>{{$home['mobile_no']}}</p></div>
                            
                        </div>

                        <div class="row">
                            <div  class="col-md-1"><i class="fa fa-envelope"></i></div>
                            <div  class="col-md-10"><p></i>{{$home['email']}}</p></div>
                        </div>
                       
                    </div>
                    <div  class="col-md-2"></div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        
                        <h3 class="text-center mb-3">Location<span class="text-uppercase margin-l-20"></span></h3>
						  <!-- Google Map -->
						<div class="map height-500" style="height:350px">
						    <iframe src="{{$home['location']}}" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>
                    </div>
                </div>
                <!-- <div class="row">
                    
                    <div class="col-md-12">
                        <div class="col-md-6 ">

                        </div>
                        <div class="col-md-6">
                            <h1>Showcase your Product or Service</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a lorem quis neque interdum consequat ut sed sem. Duis quis tempor nunc. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
                            <blockquote class="team-quote">
                                <div class="avatar"><img src="img/avatar.png" alt="User Avatar"></div>
                                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a lorem quis neque interdum consequat ut sed sem. Duis quis tempor nunc." - Steve Jobs</p>
                                <div class="logo-quote">
                                    <a href="http://tympanus.net/codrops/"><img src="img/codrops-logo.png" alt="Codrops Logo"></a>
                                </div>
                            </blockquote>
                            <a href="" class="download-btn">Download! <i class="fa fa-download"></i></a>
                        </div>
                    </div>
                </div> -->
            </div>
            <!-- end Auth fluid right content -->

            <!--Auth fluid left content -->
            <div class="col-md-6">
                <!-- <div class="row">
                    <div class=" text-center">
                        <div class="form-group">
                            <span class="badge badge-secondary smk" style="width:50%"><img src="{{ config('constants.image_url').'/public/images/'.$school_image }}" class="mr-2 rounded-circle" alt="">{{$school_name}}</span>
                        </div>
                        <br>
                        <div class="row hero-content">
                            <div class="col-md-12">
                                <h1 class="animated fadeInDown">Welcome to<br>The Paxsuzen School for Children</h1>
                                <p>The Mission of The Bronx Charter School for Children is to empower our children to achieve their greatest potential both as students and as members of their communities.</p>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <br> -->
                <div class="row">
                    <!-- <div class="col-md-1 pt-2"></div> -->
                    <div class="col-md-6 pt-2">
                                <!-- Simple card -->
                        <div class="card" style="height:405px">
                            <a href="{{ route('parent.login') }}">
                                <img class="card-img-top img-fluid" style="padding: 10px;height: 370px;" src="{{$parent_image}}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Parent Login</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 pt-2">
                                <!-- Simple card -->
                        <div class="card" style="height:405px">
                            <a href="{{ route('student.login') }}">
                                <img class="card-img-top img-fluid" style="padding: 10px;height: 370px;" src="{{$student_image}}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Student Login</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- <div class="col-md-1"></div>
                    <div class="col-md-1"></div> -->
                    <div class="col-md-6">
                                <!-- Simple card -->
                        <div class="card" style="height:405px">
                            <a href="{{ route('teacher.login') }}">
                                <img class="card-img-top img-fluid" style="padding: 10px;height: 370px;" src="{{$teacher_image}}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Teacher Login</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                                <!-- Simple card -->
                        <div class="card" style="height:405px">
                            <a href="{{ route('application') }}">
                                <img class="card-img-top img-fluid" style="padding: 10px;height: 370px;" src="{{$application}}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Application</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- <div class="col-md-1"></div> -->
                    <!-- <div class="col-md-3">	</div>	 -->
                    <!-- <div class="col-md-6 feature-2 wp2 delay-05s">
                        <div class="feature-icon">
                            <a href="#about"><i class="fa fa-users"></i></a>
                            Parent
                        </div>						
                    </div>
                    <div class="col-md-6 feature-3 wp2 delay-1s">
                        <div class="feature-icon">
                            <a href="#about"><i class="fa fa-child"></i></a>
                            Student
                        </div>
                    </div> -->
                    <!-- <div class="col-md-6 feature-2 wp2 delay-05s">
                        <div class="feature-icon">
                            <a href="#about"><i class="fa fa-user"></i></a>
                            Teacher
                        </div>						
                    </div> -->
                    <!-- <div class="col-md-3"></div>	 -->
                </div>
                <!-- <br>
                <br>
                <div class="row">
                    <div  class="col-md-2"></div>
                    <div  class="col-md-8">
                        <div class="form-group">
                            <span class="badge badge-secondary smkr pt-2">Application</span>
                        </div>
                    </div>
                    <div  class="col-md-2"></div>
                </div>
                <br> -->
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