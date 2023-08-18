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

  <table class="body-wrap" style="width: 100%;">
    <tr>
      <td class="container" width="800" style="display: block !important; max-width: 800px !important;" valign="top">
        <div class="content" style="padding:20px; margin-top: 20px;">
          <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction">
            <tr>
              <td class="content-wrap" style="text-align: justify;line-height: 25px;padding: 30px;border: 3px solid #4fc6e1;background-color: #fff;" valign="top">
                <table width="100%">
                  <tr>
                    <td>
                      <img src="{{ config('constants.image_url').'/public/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle" alt="">
                      <p style="font-size: 15px; color: #343556; font-weight: 800; margin-top: -37px; text-align: right; margin-bottom: 37px;">{{$school_name}}</p>
                    </td>
                  </tr>
                   <tr>
                      <td>
                        <p><b>Welcome to {{$school_name}}! Here are your login details for our online platform:</b></p>
                      </td>
                  </tr>
                </table>
                      <h5>For Students:</h5>
                      <table>
                        <tbody>
                          <tr>
                            <td><b>Email:</b></td>
                            <td>email@email.com</td>
                          </tr>
                          <tr>
                            <td><b>Password:</b></td>
                            <td>NHIO89HJ90</td>
                          </tr>
                        </tbody>
                      </table>

                      <h5>For Parents/Guardians:</h5>
                      <table>
                        <tbody>
                        <tr>
                            <td><b>Email:</b></td>
                            <td>email@email.com</td>
                          </tr>
                          <tr>
                            <td><b>Password:</b></td>
                            <td>NHIO89HJ90</td>
                          </tr>
                        </tbody>
                      </table>
                      <h6>Remember, these are temporary passwords. Please change them after your first login for security.</h6>
                      <h5>Access the platform:</h5>
                      <ol>
                      <li>Go to [school website URL]</li>
                      <li>Click "login" or "student/parent" portal.</li>
                      <li>Enter provided username and temporary password.</li>
                      <li>Create a new password for future logins.</li>
                      </ol>
                      <p>Explore course materials, grades, attendance, announcements, and teacher communication. Need help? Reach out at [support email] or [support phone number].</p>
                      <p>We look forward to embarking on this academic journey together!</p>
                      <p><b>Best regards,</b></p>
                      <h6>{{$school_name}}</h6>
              </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
  </table>
</body>

</html>