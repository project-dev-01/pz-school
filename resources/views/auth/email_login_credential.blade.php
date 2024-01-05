<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Login Credential Template</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Paxsuzen School is a premier educational institution that offers quality education to students of all ages. Our curriculum is designed to prepare future leaders for success in the global marketplace.">
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
                      <h4 class="head">Welcome to [{{$school_name}}]</h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p><b>Dear [Username]</b></p>
                      <p>Welcome to <b>[school name]!</b> Here are your login details for our online platform</p>
                    </td>
                  </tr>
                </table>
                <!-- End Header-->
                <!-- Card-->
                <div class="login">
                  <p>Login credentials for <b>Student :</b></p>
                  <table>
                    <tbody>
                      <tr>
                        <td>
                          <p style="line-height: 10px;"><b>Email : </b>email@email.com</p>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <p><b>Password : </b>NHIO89HJ90</p>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <p>The password are temporary. Kindly change them after your first login for security.</p>
                </div>
                <!-- End card-->
                <!-- Card-->
                <div class="login">
                  <p>Login credentials for <b> Parents/Guardian : </b></p>
                  <table>
                    <tbody>
                      <tr>
                        <td>
                          <p style="line-height: 10px;"><b>Email : </b>email@email.com</p>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <p><b>Password : </b>NHIO89HJ90</p>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <p>The password are temporary. Kindly change them after your first login for security.</p>
                </div>
                <!-- End card-->
                <!-- Footer Table-->
                <table>
                  <tr>
                    <td>
                      <p>Remember, these are temporary passwords. Please change them after your first login for security.</p>
                      <p><b>Access the platform:</b></p>
                      <ol class="texts">
                        <li>Go to <b>[school website URL]</b></li>
                        <li>Click <b>"Login"</b> or <b>"Student/Parent" portal.</b></li>
                        <li>Enter provided username and temporary password.</li>
                        <li>Create a new password for future logins.</li>
                      </ol>
                      <p>Explore course materials, grades, attendance, announcements, and teacher communication. </p>
                      <p>We look forward to embarking on this academic journey together!</p>
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