<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Anniversary Template</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="To learn as much as I can, attain good grades and advance my education further. I believe that self-motivation and a strict routine has helped me achieve my goals so far, and I will use the same method in the future.">
  <meta name="keywords" content="Paxsuzen School, education, future leaders, curriculum">
  <meta content="Paxsuzen" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{ config('constants.image_url').'/common-asset/images/favicon.ico' }}">
  <!-- App css -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
  <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
  <!-- icons -->
  <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/custom-minified/opensans-font.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/custom/emailnotification.css') }}" rel="stylesheet" type="text/css" />
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
                      <img src="{{ config('constants.image_url').'/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle header">
                      <p class="schoolname">{{$school_name}}</p>
                      <hr>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h4 class="headanniversary" style="font-size: 20px;">[{{$school_name}}] Anniversary Celebration</h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p><b>Hello [Username],</b></p>
                      <p>You're cordially invited to celebrate a momentous occasion: <b>[Xth] Anniversary</b> of <b>[{{$school_name}}]!</b>
                      <p>
                      <p>Your presence as a cherished member of our school community will truly make this event memorable.</p>

                    </td>
                  </tr>
                </table>
                <!-- End Header-->
                <!-- Card-->
                <div class="event">
                  <img src="{{ asset('images/emailnotification/invited.png') }}" class="invited">
                  <h4 class="eventdetails">[Event Name]</h4>
                  <p class="details"><b>Date:</b> 12 January 2023</p>
                  <p class="details"><b>Location:</b> School Hall</p>
                  <p class="details"><b>RSVP Date:</b> 8-11 January 2023</p>
                  <p class="details"><b> RSVP Contact:</b> Email or Phone number</p>

                </div>
                <!-- End card-->
                <!-- Footer Table-->
                <table>
                  <tr>
                    <td>
                      <p>Over the past <b>[Xth]</b> years, <b>[{{$school_name}}]</b> has been a beacon of education, fostering a culture of growth and learning. Your support has played a vital role in our journey, and we eagerly anticipate creating lasting memories and envisioning a bright future together.</p>
                      <p>Kindly RSVP by <b>[RSVP Date]</b> to assist us in planning for this significant celebration.</p>
                      <p>For more information, please visit our website at <b>[Your School Website]</b> or contact our event organizing committee at <b>[Contact Information]</b>.</p>
                      <p>Let's come together to celebrate <b>[{{$school_name}}]'s</b> achievements and the remarkable community that defines it.</p>
                      <p>Your presence will add joy and significance to this momentous event.</p>
                      <p>We genuinely hope to see you there!</p>
                      <h4 class="heads">Best regards,</h4>
                      <h6>{{$school_name}}</h6>
                      <hr style="width: 552px; height: 1px;">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p class="footerfont">For help & support, kindly use contact information below.</p>
                      <img src="{{ config('constants.image_url').'/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle footerlogo">
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