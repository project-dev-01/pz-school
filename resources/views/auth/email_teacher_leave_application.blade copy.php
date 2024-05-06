<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Teacher Leave Application Template</title>
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
  <script>window.UserHelpPublicProjectID="Y7YyGqyq2"</script>
        <script src="https://run.userhelp.co" async></script>

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
                      <h4 class="head">Teacher Leave Application</h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p><b>Dear Sir/Madam,</b></p>
                      <p>I humbly request a leave of absence from my teaching duties at <b>[{{$school_name}}]</b> starting from <b>[start date]</b> to <b>[end date]</b> </p>
                    </td>
                  </tr>
                </table>
                <!-- End Header-->
                <!-- Fees Table-->
                <table width="100%">
                  <tr>
                    <td class="texts">
                      <p><b>My reason for this leave request:</b></p>
                      <ol>
                        <li>Point A</li>
                        <li>Point B</li>
                        <li>Point C</li>
                      </ol>
                    </td>
                  </tr>
                </table>
                <!-- End Fees Table-->
                <!-- Footer Table-->
                <table>
                  <tr>
                    <td>
                      <p>I will diligently prepare all necessary materials for the substitute teacher and remain available for any guidance required during my absence.</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p>I kindly seek your approval for this leave, and if there are any specific tasks I need to address before departing, please do inform me.</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p>I deeply appreciate your understanding and consideration.</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
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