<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Event Reminder Template</title>
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
              <td class="content-wrap" style="padding: 30px;border: 3px solid #4fc6e1;background-color: #fff;" valign="top">
                <table width="100%">
                  <tr>
                    <td>
                      <img src="{{ config('constants.image_url').'/public/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle" alt="">
                      <p style="font-size: 15px; color: #343556; font-weight: 800; margin-top: -37px; text-align: right; margin-bottom: 37px;">{{$school_name}}</p>
                    </td>
                  </tr>
                              <tr>
                                <td>
                                   <h5>Dear [Parent/Guardian's Name],</h5>
                                   <p>We're excited to remind you about the upcoming [Event Name] at {{$school_name}}:</p>
                                   <p style="font-size:15px;line-height:30px;">
                                    <b>Event:</b>Sports Day<br>
                                    <b>Date:</b> 30-August-2023<br>
                                   <b>Time:</b> 6PM - 9PM<br>
                                    <b>Location:</b> Saujana Resort Seksyen U2, 40150 , Selangor Darul Ehsan, Malaysia<br>
                                    </p>
                                    <p>This event is a fantastic opportunity for students to enjoy sports and contribute to their educational journey.</p>
                                    <p>Your support is vital. Please ensure your child is well-prepared and arrives on time. Any event requirements (materials, dress code) should be known to your child.</p>
                                    <p>Safety is paramount. We've taken measures for a secure, enjoyable event.</p>
                                    <p>For any questions or concerns, contact us at [School Contact Information].</p>
                                    <p>Thank you for your continued support in your child's education. We look forward to seeing you at the event!</p>
                                    <p><b>Regards,</b></p>
                                    <h6>{{$school_name}}</h6>
                                </td>
                                </tr>
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