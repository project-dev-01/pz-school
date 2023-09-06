<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Announcement Template</title>
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
                      <h4 class="head">Special Announcement</h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p><b>Dear [Parent/ Guardian],</b></p>
                      <p>We're gearing up for an exciting year of growth and learning, and we're thrilled to share a special announcement.</p>
                    </td>
                  </tr>
                </table>
                <!-- End Header-->
                <!-- Card-->
                <div class="announcement">
                  <img src="{{ asset('public/images/emailnotification/special.png') }}" class="special">
                  <h4 class="eventdetails">[SPECIAL ANNOUNCEMENT NAME]</h4>
                  <p class="invitationdetails"><b>Date:</b> 12 January 2023</p>
                  <p class="invitationdetails"><b>Location:</b> School Hall</p>
                  <p class="invitationdetails"><b>Theme:</b> School Hall</p>
                </div>
                <!-- End card-->

                <!-- Footer Table-->
                <table>
                  <tr>
                    <td>
                      <p>Join us for an enriching experience that aims to <b>[briefly describe event significance]</b>. </p>
                      <p>We encourage all students, parents, and guardians to be part of this event to foster community spirit and enhance our school’s culture.</p>
                      <p>Please save the date and plan to attend with your child. Your presence and support are vital for the success of our school's initiatives.</p>
                      <p>Any specific preparations or materials required will be communicated in advance.</p>
                      <p>Safety is paramount. We've taken all precautions for a secure and enjoyable event. Your cooperation is appreciated.</p>
                      <p>For any questions or information, reach out to us at [School Contact Information]. We're here to assist.</p>
                      <p>Thank you for your continuous support, shaping our vibrant school community. Looking forward to seeing you at the event!</p>
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