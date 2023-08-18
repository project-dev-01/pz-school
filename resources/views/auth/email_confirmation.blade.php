<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Confirmation Template</title>
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
      <td class="container" width="600" style="display: block !important; max-width: 600px !important;" valign="top">
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
                        <p>We're excited to have you on board! To begin using your new account, please confirm and verify your email address.</p>
                        <a href="#" class="btn btn-primary-bl waves-effect waves-light" style="margin-bottom: 10px;">Verify Email Address</a>
                        <hr color="#343556" align="center" width="100%" size="1" noshade style="margin-top: 5px; padding: 0;" />
                        <p>If you did not sign up for this account, you can ignore this email and the account will be deleted.</p>
                        <p>Looking forward to having you with us!</p>
                      </td>
                  </tr>
                   
                  </tbody>
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