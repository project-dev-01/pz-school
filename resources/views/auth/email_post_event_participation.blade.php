<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Post Event Participaation Template</title>
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

<body>
  <table class="body-wrap">
    <tr>
      <td class="container">
        <div class="content">
          <table>
            <tr>
              <td class="content-wrap">
                <!-- Start Header-->
                <table width="100%">
                  <tr>
                    <td>
                      <img src="{{ config('constants.image_url').'/public/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle header">
                      <p class="schoolname">{{$school_name}}</p>
                      <hr>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h4 class="head">Thanks For Your Participation</h4>
                    </td>
                  </tr>
                </table>
                <!-- End Header-->
                <!-- Card-->
                <div class="thankyou">
                  <img src="{{ asset('public/images/emailnotification/thankyou.png') }}" class="thank">
                </div>
                <!-- End card-->

                <!-- Footer Table-->
                <table>
                  <tr>
                    <td>
                      <p><b>Hello [User],</b></p>
                      <p>A heartfelt thank you for being a part of [Event Name]. Your enthusiastic participation and support played a pivotal role in making the event a resounding success.</b>. </p>
                      <p>The dedication and hard work of our students truly shone through, reflecting their remarkable performances. We commend them for their outstanding efforts.</p>
                      <p>To our valued parents and guardians, your unwavering encouragement means the world to us. Your role in nurturing our students' growth is immeasurable.</p>
                      <p>A special appreciation goes out to our dedicated faculty, staff, and volunteers for their behind-the-scenes dedication.</p>
                      <p>The event fostered a sense of unity and community, warming our hearts. We're excited about future occasions like these.</p>
                      <p>Should you have any feedback or suggestions for upcoming events, kindly share them with us. Your insights are vital as we continually enhance the school experience.</p>
                      <h4 class="heads">Best regards,</h4>
                      <h6>{{$school_name}}</h6>
                      <hr style="width: 552px; height: 1px;">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p class="footerfont">For help & support, kindly use contact information below.</p>
                      <img src="{{ config('constants.image_url').'/public/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle footerlogo">
                      <p class="footerfont">schoolhelp@gmail.com</p>
                      <p class="footerfont" style="line-height: 1px;">+60 1234-2345-122</p>
                    </td>
                  </tr>
                </table>
                <!--End Footer Table-->
              </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
  </table>
</body>

</html>