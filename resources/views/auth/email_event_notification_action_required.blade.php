<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Event Notification: Action Required Template</title>
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
                        <h4>Subject: Important Event Notification: Action Required</h4>
                        <h4>Respected Sir/Mam,</h4>
                        <p>I trust this email finds you well. We want to draw your attention to an upcoming event that requires your attention in our system.</p>
                        <h4>Event Details:</h4>
                        <p style="font-size:15px;line-height:30px;">
                                    <b>Event:</b>Sports Day<br>
                                    <b>Date:</b> 30-August-2023<br>
                                   <b>Time:</b> 6PM - 9PM<br>
                                    <b>Location:</b> Saujana Resort Seksyen U2, 40150 , Selangor Darul Ehsan, Malaysia<br>
                                    </p>
                                    <h4>Event Description:</h4>
                        <p>[Provide a brief description of the event, its purpose, and any relevant details.]</p>
                        <p>Please log in to our system at [System Link] to find more information about this event and any specific actions you need to take. It might include updating attendance, providing information, or any other necessary steps.</p>
                        <p>If you encounter any technical difficulties or have questions about the event, please reach out to our technical support team at [Support Email/Phone Number].</p>
                        <p>Your participation and cooperation are vital to the success of this event. We appreciate your dedication to our school community.</p>
                        <p>Thank you for your prompt attention to this matter.</p>
                      </td>
                  </tr>
                   <tr>
                      <td>
                         <p><b>Best regards,,</b></p>
                         <h6>[Your Name]</h6>
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