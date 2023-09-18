<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Promotion Template</title>
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
                      <h4 class="head">Exciting News! [Promotion Name] Promotion at [{{$school_name}}]</h4>
                    </td>
                  </tr>
                </table>
                <!-- End Header-->
                <!-- Card Image-->
                <div class="card promo">
                  <img src="{{ asset('images/emailnotification/promo.png') }}" class="specialpromo">
                </div>
                <!-- End card Image-->
                <!-- Start Table-->
                <table width="100%">
                  <tr>
                    <td>
                      <p><b>Dear Parents/Guardian,</b></p>
                      <p>Dear [User Name], Get ready for an extraordinary academic year with our <b>[Promotion Name]</b>. This promo will be ended on <b>[Date : Time]</b>.</p>
                      <p>Below what will be included on our promotion:</p>
                    </td>
                  </tr>
                </table>
                <!-- End Table-->
                <!-- Card-->
                <!-- Card-->
                <div class="card promos">
                  <div class="two">
                    <table>
                      <tr>
                        <td style="padding: 2px 0px 19px 0px">
                          <p><b>Enrolment Discounts:</b><br>
                            Register now for the upcoming year and enjoy exclusive discounts.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="two">
                    <table>
                      <tr>
                        <td style="padding: 2px 0px 19px 0px">
                          <p><b>Exciting Extracurriculars:</b><br>
                            New activities from robotics to arts to nurture well-rounded students.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="two">
                    <table>
                      <tr>
                        <td style="padding: 2px 0px 36px 0px">
                          <p><b>Personalized Learning: </b><br>
                            Tailored approaches and technology to meet each student's needs.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="two">
                    <table>
                      <tr>
                        <td style="padding: 2px 0px 36px 0px">
                          <p><b>Community Engagement:</b><br>
                            Join events fostering connections and collaboration.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="two">
                    <table>
                      <tr>
                        <td style="padding: 2px 0px 19px 0px">
                          <p><b>Expanded Facilities:</b><br>
                            Upgraded spaces for a safe and inspiring environment.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="two">
                    <table>
                      <tr>
                        <td style="padding: 2px 0px 19px 0px">
                          <p><b>Merit Scholarships:</b><br>
                            Recognizing academic excellence.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="two">
                    <table>
                      <tr>
                        <td style="padding: 2px 0px 19px 0px">
                          <p><b>Tech Integration:</b><br>
                            Equip students with 21st-century skills.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="two">
                    <table>
                      <tr>
                        <td style="padding: 2px 0px 19px 0px">
                          <p><b>Parent-Teacher Conferences: </b><br>
                            Open communication for progress and concerns.</p>
                        </td>
                      </tr>
                    </table>
                  </div>

                </div>
                <!-- End card-->
                <!-- End card-->
                <!-- Footer Table-->
                <table>
                  <tr>
                    <td>
                      <p>Thank you for choosing <b>[School Name]</b> as the launchpad for your child's educational journey.</p>
                      <p>We eagerly await another fantastic year of learning and growth.</p>
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