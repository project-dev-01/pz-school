<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Student Leave Application Template</title>
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
      <td class="container" width="750" style="display: block !important; max-width: 750px !important;" valign="top">
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
                        <h4>Subject: Student Leave Application - 佐藤 清</h4>
                        <h4>Respected Sir/Mam,</h4>
                        <p>I hope this message finds you well. I am writing to formally request a leave of absence from [School Name] from [Start Date] to [End Date] due to [Reason for Leave]. I believe this time off is essential for [Explain the reason briefly].</p>
                        <p>I am notifying you through my teacher, [Teacher's Name], as per the school's procedure. I kindly ask for your consideration and approval for this leave. I understand the importance of my studies and assure you that I will catch up on any missed work promptly upon my return.</p>
                        <p>If there are any specific guidelines or requirements for me to follow during my leave, please let me know. I greatly appreciate your understanding and support.</p>
                        <p>Thank you for your attention to this matter.</p>
                      </td>
                  </tr>
                   <tr>
                      <td>
                         <p><b>Your's Sincerely,</b></p>
                         <h6>佐藤 清</h6>
                      </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
  </table>
</body>

</html>