<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>TWO-FACTOR AUTHENTICATION</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
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
    <link href="{{ asset('public/css/custom/admin_login.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/opensans-font.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .title {
            max-width: 400px;
            margin: auto;
            text-align: center;
            font-family: "Poppins", sans-serif;
        }

        .otp-input-fields {
            margin: auto;
            background-color: white;
            box-shadow: 0px 0px 8px 0px #02025044;
            max-width: 400px;
            width: auto;
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 40px;
        }

        input {
            height: 40px;
            width: 40px;
            background-color: transparent;
            border-radius: 4px;
            border: 1px solid #2f8f1f;
            text-align: center;
            outline: none;
            font-size: 16px;

            &::-webkit-outer-spin-button,
            &::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* Firefox */
            &[type="number"] {
                -moz-appearance: textfield;
            }

            &:focus {
                border-width: 2px;
                border-color: darken(#2f8f1f, 5%);
                font-size: 20px;
            }
        }

        .result {
            max-width: 400px;
            margin: auto;
            padding: 24px;
            text-align: center;

            p {
                font-size: 24px;
                font-family: "Antonio", sans-serif;
                opacity: 1;
                transition: color 0.5s ease;

                &._ok {
                    color: green;
                }

                &._notok {
                    color: red;
                    border-radius: 3px;
                }
            }
        }
    </style>
</head>


<body class="loading auth-fluid-pages pb-0">
    <div class="auth-fluid">
        <div class="col-md-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="card card-default">
                            <h4 class="card-heading text-center mt-4">Verification Code</h4>
                            <div class="card-body" style="text-align: center;">
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
                                <form class="form-horizontal" class="otp-form" name="otp-form" method="POST" action="{{ route('2fa.post') }}">
                                    {{ csrf_field() }}
                                    <div class="title">
                                        <h3>TWO-FACTOR AUTHENTICATION</h3>
                                        <!-- <p class="info">An otp has been sent to ********k876@gmail.com</p> -->
                                        <p class="msg">Enter 6-digit code from your authenticator application</p>
                                    </div>
                                    <div class="otp-input-fields">
                                        <input type="number" class="otp__digit otp__field__1">
                                        <input type="number" class="otp__digit otp__field__2">
                                        <input type="number" class="otp__digit otp__field__3">
                                        <input type="number" class="otp__digit otp__field__4">
                                        <input type="number" class="otp__digit otp__field__5">
                                        <input type="number" class="otp__digit otp__field__6">
                                    </div>

                                    <div class="result">
                                        <!-- <p id="_otp" class="_notok">855412</p> -->
                                        <input id="verify_otp" type="hidden" class="form-control" name="otp">
                                    </div>
                                    <div class="form-group">
                                        <div class="mt-3">
                                            <a class="btn btn-light" href="{{ url()->previous() }}">Back</a>
                                            <button type="submit" class="btn btn-primary">
                                                Login
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end auth-fluid-->
    <!-- Vendor js -->
    <script src="{{ asset('public/js/vendor.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('public/js/app.min.js') }}"></script>
    <script>
        $(function() {
            var otp_inputs = document.querySelectorAll(".otp__digit")
            var mykey = "0123456789".split("")
            otp_inputs.forEach((_) => {
                _.addEventListener("keyup", handle_next_input)
            })

            function handle_next_input(event) {
                let current = event.target
                let index = parseInt(current.classList[1].split("__")[2])
                current.value = event.key

                if (event.keyCode == 8 && index > 1) {
                    current.previousElementSibling.focus()
                }
                if (index < 6 && mykey.indexOf("" + event.key + "") != -1) {
                    var next = current.nextElementSibling;
                    next.focus()
                }
                var _finalKey = ""
                for (let {
                        value
                    }
                    of otp_inputs) {
                    _finalKey += value
                }
                if (_finalKey.length == 6) {
                    // document.querySelector("#_otp").classList.replace("_notok", "_ok")
                    // document.querySelector("#_otp").innerText = _finalKey
                    $("#verify_otp").val(_finalKey);
                } else {
                    // document.querySelector("#_otp").classList.replace("_ok", "_notok")
                    // document.querySelector("#_otp").innerText = _finalKey
                    $("#verify_otp").val(_finalKey);
                }
            }
        });
    </script>
</body>

</html>