<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Promotion Email</title>
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
                                    <h4>Subject: Exciting Back-to-School Promotion at {{$school_name}}!</h4>
                                    <h5>Dear Parent/Guardian,</h5>
                                   <p>Get ready for an amazing academic year at [School Name] with our special back-to-school promotion! Here's what's in store:</p>
                                   <ol>
                                   <li><b>Enrolment Discounts:</b> Register now for the upcoming year and enjoy exclusive discounts.</li>
                                   <li><b>Enhanced Extracurricular:</b> New activities from robotics to arts to nurture well-rounded students.</li>
                                   <li><b>Personalized Learning:</b> Tailored approaches and technology to meet each student's needs.</li>
                                   <li><b>Community Engagement: </b> Join events fostering connections and collaboration.</li>
                                   <li><b>Expanded Facilities:</b> Upgraded spaces for a safe and inspiring environment.</li>
                                   <li><b>Merit Scholarships:</b>Recognizing academic excellence.</li>
                                   <li><b>Tech Integration: </b> Equip students with 21st-century skills.</li>
                                   <li><b>Parent-Teacher Conferences:</b> Open communication for progress and concerns.</li>
                                   </ol>
                                   <p>Explore more details on our website [School Website] or contact admissions at [Contact Info].</p>
                                   <p>Thank you for choosing [School Name] as the launchpad for your child's educational journey. We eagerly await another fantastic year of learning and growth.</p> 
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