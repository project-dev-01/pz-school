<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Event Invitation Template</title>
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
                      <h4 class="head">Reminder: Invitation For [Event Name]</h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p><b>Dear [Parent/Guardian's Name],</b></p>
                    </td>
                  </tr>
                </table>
                <!-- End Header-->
                <!-- Card-->
                <div class="eventreminder">
                  <img src="{{ asset('images/emailnotification/invited.png') }}" class="invited">
                  <h4 class="eventdetails">[Event Name]</h4>
                  <p class="invitationdetails"><b>Date:</b> 12 January 2023</p>
                  <p class="invitationdetails"><b>Location:</b> School Hall</p>
                  <p class="invitationdetails"><b>Theme:</b> School Hall</p>

                </div>
                <!-- End card-->
                <!-- Footer Table-->
                <table>
                  <tr>
                    <td>
                      <p>This event is a fantastic opportunity for students to enjoy sports and contribute to their educational journey.</p>
                      <p>Your support is vital. Please ensure your child is well-prepared and arrives on time. Any event requirements <b>[materials, dress code]</b> should be known to your child.</p>
                      <p>Safety is paramount. We've taken measures for a secure, enjoyable event.</p>
                      <p>For any questions or concerns, contact us at <b>[School Contact Information].</b></p>
                      <p>Thank you for your continued support in your child's education. </p>
                      <p>We look forward to seeing you at the event!</p>
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