<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>2FA</title>
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
</head>


<body class="loading auth-fluid-pages pb-0">
    <div class="auth-fluid">
        <div class="col-md-12">
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
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="card card-default">
                            <h4 class="card-heading text-center mt-4">{{ __('messages.set_up_google_authenticator') }}</h4>

                            <div class="card-body" style="text-align: center;">
                                <p>{{ __('messages.set_up_your_two_factor_authentication') }} <strong>{{ $secret }}</strong></p>
                                <div>
                                    <img src="{!! $qr_url !!}" alt="image not found">
                                </div>
                                <p>{{ __('messages.you_must_set_up_your_google_authenticator') }}</p>
                                <form class="form-horizontal" method="POST" action="{{ route('complete.registration') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" class="form-control" name="secret" value="{{ $secret }}">
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                        {{ __('messages.complete_registration') }}
                                        </button>
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
</body>

</html>