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
<style>
.news-app-promo-buttons__buttons 
{
  display: block;
}
.news-app-promo-buttons__logo 
{
  display: inline-block;
}
.news-app-promo-subsection 
{
  display: inline-block;
  margin: 0 auto;
  margin-right: 10px;
}
.authenticator_logo 
{
  display: inline-block;
  width: 90px;
  margin-bottom: 22px;
  vertical-align: initial;
}
.news-app-promo__play-store,
.news-app-promo__app-store
 {
  display: block;
  width: 100px;
  height: auto;
}
.btn-primary-bl {
    color: #fff;
    border-color: #0ABAB5;
    background-color: #6FC6CC;
    border-radius: 60px;
    text-align: center;
}
</style>

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
                                    <img src="{!! $qr_url !!}" alt="image not found" style="height: 195px;">
                                </div>
                                <p>{{ __('messages.you_must_set_up_your_google_authenticator') }}</p>
    
                              <div id="" class="news-app-promo">
                              <div class="news-app-promo__section">
                                  <div class="news-app-promo-subsection">
                                  <a class="" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en&gl=US" target="_parent">
                                  <img class="authenticator_logo" src="..\public\images\authenticator.png"> 
                                  </a>
                                  </div>
                                  <div class="news-app-promo-subsection">
                                      <a class="news-app-promo-subsection--link news-app-promo-subsection--playstore" href="https://play.google.com/store/search?q=google+authenticator&c=apps" target="_parent">
                                        <img class="news-app-promo__play-store" src="..\public\images\Googleplay.png" style="height: 90px;margin-left: -15px; width: 130px;">
                                        
                                      </a>
                                      <a class="news-app-promo-subsection--link news-app-promo-subsection--appstore" href="https://apps.apple.com/us/app/google-authenticator/id388497605" target="_parent">
                                          <img class="news-app-promo__app-store" src="..\public\images\appstore.png" style="margin-bottom: 30px;margin-top: -15px;">
                                      </a>
                                  </div>
                              </div>
                              <div class="news-app-promo__section">
                              </div>
                              </div>
                          <form class="form-horizontal" method="POST" action="{{ route('complete.registration') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" class="form-control" name="secret" value="{{ $secret }}">
                                    <div>
                                        <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
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