<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Event Invitation Email Template</title>
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
  body {
  background-color: #e6e6e6;
  width:90vh;
  margin: auto;
}
h1 {
  text-shadow: 2px 2px #a6a6a6;
  text-align:center;
}
h2 {
  color: #ff9900;
  text-shadow: 1px 1px black;
  text-align: center;
}
#left {
  width: 40vh;
  float: left;
}
#right {
  width: 40vh;
  float: right;
}

p, address{
  text-align: center;
}

hr {
    margin-top: 1.5rem;
    margin-bottom: 1.5rem;
    border: 0;
    border-top: 3px solid #e5e8eb;
}
  </style>
<body style="font-family: Open Sans; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">

  <table class="body-wrap" style="width: 100%;">
    <tr>
      <td class="container" width="700" style="display: block !important; max-width: 700px !important;" valign="top">
        <div class="content" style="padding:20px; margin-top: 20px;">
          <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction">
            <tr>
              <td class="content-wrap" style="padding: 30px;border: 3px solid #4fc6e1;background-color: #fff;" valign="top">
                <table width="100%">
                  <tr>
                    <td>
                      <img src="{{ config('constants.image_url').'/public/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle" alt="">
                      <p style="font-size: 15px; color: #343556; font-weight: 800; margin-top: -37px; text-align: right; margin-bottom: 37px;">{{$school_name}}</p>
                    </td>
                  </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="left">
                                <h1>Dear [User],</h1>
                                <h2>Save The Date! </h2>
                                <p>You're invited to our enchanting Annual Day Event at {{$school_name}}!</p>
                                <p>Join us for an unforgettable evening of mesmerizing performances and heartwarming student talent. This year's theme: [Event Theme], promising a joyous celebration.</p>
                                <p>Event Name</p>
                                 <p id="date">Tuesday 3<sup>rd</sup> August, 6-9pm</p>
                                <address>
                                  @ {{$school_name}}<br>
                                  Saujana Resort Seksyen U2, 40150 , <br>
                                  Selangor Darul Ehsan, Malaysia<br>
                                </address>
                                <p>Let's make memories on this special day!</p>
                                <hr>
                                <p style="text-align:right"><b>Best regards,</b></p>
                                <h6 style="text-align:right">{{$school_name}}</h6>
                            </table>
                        </td>
                    </tr>
                </table>
              </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
    </tbody>
  </table>
</body>
</html>