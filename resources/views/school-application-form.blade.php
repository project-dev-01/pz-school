<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>School Application Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/images/favicon.ico')}}">

    <!-- App css -->
    <link href="{{ asset('public/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('public/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{ asset('public/css/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('public/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('public/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/common.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/opensans-font.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="loading" style="background-color:#2F2F8F">
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center w-75 m-auto">
                        <div class="auth-logo">
                            <a href="" class="logo logo-dark text-center">
                                <span class="logo-lg">
                                    <img src="{{ asset('public/images/logo-dark.png')}}" alt="" height="50">
                                </span>
                            </a>
                        </div>
                        <h3 class="text-center" style="color:#596368">Student Application Form</h3>
                    </div>
                    <hr style="border:1px solid #6FC6CC">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <h4 class="navv">
                                        Student Details
                                        <h4>
                                </li>
                            </ul><br>
                            <form>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">First name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="fname" maxlength="50" placeholder="Ahmad Ali" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Last Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="lname" maxlength="50" placeholder="Muhammad Jaafar" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Gender<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">Male</option>
                                                    <option value="press">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Age<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="sage" id="age" require="" placeholder="Eg:3">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Date of Birth<span class="text-danger">*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control" id="name" placeholder="DD/MM/YY" aria-describedby="inputGroupPrepend" required>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="far fa-calendar-alt"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Phone Number<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="phone" placeholder="Phone no" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Email<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="email" placeholder="Email id" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Address 1<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="name" placeholder="Address 1" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Address 2<span class="text-danger">*</span><br></label>
                                                <input type="text" class="form-control" id="address" placeholder="Address 2" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">City<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">Malaysia</option>
                                                    <option value="press">Singapore</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">State<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">Malaysia</option>
                                                    <option value="press">Singapore</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Postal Code<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="pin" placeholder="Postal-code" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                            School Information
                                            <h4>
                                    </li>
                                </ul><br>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Standard<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">I</option>
                                                    <option value="press">II</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">School Year<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">2021-2022</option>
                                                    <option value="press">2022-2023</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">School Last Attended<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="pin" placeholder="School Last Attend" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">School Address1<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="sadd" placeholder="Address 1" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">School Address2<span class="text-danger">*</span><br></label>
                                                <input type="text" class="form-control" id="sadd2" placeholder="Address 2" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">City<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">Malaysia</option>
                                                    <option value="press">Singapore</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">State<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">Malaysia</option>
                                                    <option value="press">Singapore</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Postal Code<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="spin" placeholder="Postal-code" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                            Parent /Guardian's Information
                                            <h4>
                                    </li>
                                </ul><br>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Parent /Guardian's Name<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">Parent</option>
                                                    <option value="">Guardian's</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">First Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="firstname" placeholder="John" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Last Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="lastname" placeholder="Leo" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Phone Number<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="pnumber" placeholder="Phone no" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Occupation<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">Business</option>
                                                    <option value="">IT/ Software</option>
                                                    <option value="">Civil department</option>
                                                    <option value="">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Parent/Guardian's Name - Secondary<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">Parent</option>
                                                    <option value="">Guardian's</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">First Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="ffname" placeholder="Aisha" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Last Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="llname" placeholder="Mal" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Phone Number<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="name" placeholder="Phone no" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Occupation<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">Business</option>
                                                    <option value="">IT/ Software</option>
                                                    <option value="">Civil department</option>
                                                    <option value="">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                            Emergency Contact Details
                                            <h4>
                                    </li>
                                </ul><br>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Emergency Contact Person<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="ename" placeholder="John Leo" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">First Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="elname" placeholder="John" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Last Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="elname" placeholder="Leo" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div> <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heard">Phone Number<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="name" placeholder="Phone no" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck11">
                                                    <label class="custom-control-label" for="customCheck11">I agree to {terms & conditions} provided by the school. I also certify that all information in this form is true and accurate.</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Date<span class="text-danger">*</span>: 09-02-2022</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </form>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                    Submit
                                </button>
                            </div>

                        </div>
                    </div>
                </div> <!-- end card-->
            </div> <!-- container -->
            <div class="col-md-2"></div>
        </div>
        <!-- END wrapper -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="{{ asset('public/js/vendor.min.js')}}"></script>

        <!-- Plugins js-->
        <script src="{{ asset('public/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>

        <!-- Init js-->
        <script src="{{ asset('public/js/pages/form-wizard.init.js')}}"></script>

        <!-- App js -->
        <script src="{{ asset('public/js/app.min.js')}}"></script>

</body>

</html>