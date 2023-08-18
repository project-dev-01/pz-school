<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Anniversary Email</title>
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
<style>
p, address{
  text-align: justify;
}

#date {
  text-align: center;
  font-weight: bold;
  font-size: 18px;
  text-shadow: 0.3px 0.3px black
}

</style>
<body>

  <table class="body-wrap" style="width: 100%;">
    <tr>
      <td class="container" width="800" style="display: block !important; max-width: 800px !important;" valign="top">
        <div class="content" style="padding:20px; margin-top: 20px;">
          <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction">
            <tr>
              <td class="content-wrap" style="padding: 30px;border: 3px solid #4fc6e1;background-color: #eeebe5;" valign="top">
                <table width="100%">
                  <tr>
                    <td>
                      <img src="{{ config('constants.image_url').'/public/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle" alt="">
                      <p style="font-size: 15px; color: #343556; font-weight: 800; margin-top: -37px; text-align: right; margin-bottom: 37px;">{{$school_name}}</p>
                    </td>
                  </tr>
                  <tr>
                                    <td>
                                    <h5> Subject: Join Us for {{$school_name}}'s Anniversary Celebration!</h5>
                                   <h5>Hello [User],</h5>
                                   <p>You're cordially invited to celebrate a momentous occasion: [Xth] Anniversary of {{$school_name}}! Your presence as a cherished member of our school community will truly make this event memorable.</p>
                                   <p id="date">Tuesday 3<sup>rd</sup> August, 6-9pm</p>
                                   <p style="text-align:center;">
                                    @ {{$school_name}}<br>
                                    Saujana Resort Seksyen U2, 40150 , <br>
                                    Selangor Darul Ehsan, Malaysia<br>
                                  </p>
                                   <p>Over the past [Xth] years, {{$school_name}} has been a beacon of education, fostering a culture of growth and learning. Your support has played a vital role in our journey, and we eagerly anticipate creating lasting memories and envisioning a bright future together.</p> 
                                   <p>Kindly RSVP by [RSVP Date] to assist us in planning for this significant celebration. For more information, please visit our website at [Your School Website] or contact our event organizing committee at [Contact Information].</p>
                                   <p>Let's come together to celebrate {{$school_name}}'s achievements and the remarkable community that defines it. Your presence will add joy and significance to this momentous event.</p>
                                   <p>We genuinely hope to see you there!</p>
                                   <p><b>Best Regards,</b></p>
                                   <h6>{{$school_name}}</h6>
                                     </td>
                                </tr>
                 
                  
                 
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