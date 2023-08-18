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
                                   <h5>Dear Parent/ Guardian,</h5>
                                   <p>We're gearing up for an exciting year of growth and learning, and we're thrilled to share a special announcement.</p>
                                   <p style="font-size:15px; line-height:30px;">
                                    <b>Event:</b> Sports Day<br>
                                    <b>Date:</b> 30-August-2023<br>
                                   <b>Time:</b> 6PM - 9PM<br>
                                    <b>Location:</b> Saujana Resort Seksyen U2, 40150 , Selangor Darul Ehsan, Malaysia<br>
                                    </p>
                                    <p>Join us for an enriching experience that aims to [briefly describe event significance]. We encourage all students, parents, and guardians to be part of this event to foster community spirit and enhance our school’s culture.</p>
                                    <p>Please save the date and plan to attend with your child. Your presence and support are vital for the success of our school's initiatives.  Any specific preparations or materials required will be communicated in advance.</p>
                                    <p>Safety is paramount. We've taken all precautions for a secure and enjoyable event. Your cooperation is appreciated.</p>
                                    <p>For any questions or information, reach out to us at [School Contact Information]. We're here to assist.</p>
                                    <p>Thank you for your continuous support, shaping our vibrant school community. Looking forward to seeing you at the event!</p>
                                    <p><b>Best Regards,</b></p>
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