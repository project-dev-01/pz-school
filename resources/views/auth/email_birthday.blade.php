<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Birthday Template</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <link href="{{ asset('public/css/custom-minified/opensans-font.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('public/css/custom/emailnotification.css') }}" rel="stylesheet" type="text/css" />

</head>
<style>
 img.birthday {
  max-height: 38vh;
}

.text {
  padding: 1em;
}

.muted {
  opacity: 0.8;
}

.space {
  height: 100px;
}
</style>
<body style="font-family: Open Sans; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">

  <table class="body-wrap" style="width: 100%;">
    <tr>
      <td class="container" width="800" style="display: block !important; max-width: 800px !important;" valign="top">
        <div class="content" style="padding:20px; margin-top: 20px;">
          <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action">
            <tr>
              <td class="content-wrap" style="text-align: justify;line-height: 25px;padding: 30px;border: 3px solid #4fc6e1;background-color: #fff;" valign="top">
                <table width="100%">
                  <tr>
                    <td>
                      <img src="{{ config('constants.image_url').'/public/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle" alt="">
                      <p style="font-size: 15px; color: #343556; font-weight: 800; margin-top: -37px; text-align: right; margin-bottom: 37px;">{{$school_name}}</p>
                    </td>
                  </tr>
                </table>
                <div class="row">
                             
                             <div class="col-6">
                                <div class="text">
                                 <h1>Happy Birthday!</h1>
                                 <p>Your presence brings joy to our school; your dedication and compassion inspire us all. Wishing you a day of happiness and success.</p>
                                <p style="margin-top: 35px;"><b>Best regards,</b></p>
                                <h5>{{$school_name}}</h5>
                                </div>
                             </div>
                             <div class="col-6">
                              <img src="https://raw.githubusercontent.com/DenverCoder1/Responsive-Birthday-Card/main/birthday.svg" alt="birthday" class="birthday">
                             </div>      
                               <div class="space"></div>
                  </div>
                                                             
              </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
  </table>
</body>
</html>