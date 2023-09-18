<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Feedback Request Template</title>
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
                      <h4 class="head">Special Limited-Time Offer: Enroll Now for Exclusive Benefits!</h4>
                    </td>
                  </tr>
                </table>
                <!-- End Header-->
                <!-- Card Image-->
                <div class="card limitedoffer">
                  <img src="{{ asset('images/emailnotification/banner.png') }}" class="specialoffer">
                </div>
                <!-- End card Image-->
                <!-- Start Table-->
                <table width="100%">
                  <tr>
                    <td>
                      <p><b>Dear Parents/Guardian,</b></p>
                      <p>We have fantastic news to share! For a short time, seize the opportunity to enroll your child at {{$school_name}} and enjoy a host of exclusive benefits:</p>
                    </td>
                  </tr>
                </table>
                <!-- End Table-->
                <!-- Card-->
                <div class="card specialoffers">
                  <div class="stwo">
                    <table>
                      <tr>
                        <td style="padding: 2px 0px 19px 0px">
                          <p><b>Waived Enrollment Fee:</b><br>
                            Take advantage of this offer and save on the enrollment fee, making it easier dor you to secure a spot for your child at our esteemed institution spot for your child.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="stwo">
                    <table>
                      <tr>
                        <td style="padding: 2px 0px 19px 0px">
                          <p><b>Campus Tour:</b><br>
                            Experience our state-of-the-art campus & witness firsthand the excellent facilities & nurturing environment we offer. Schedule a personalized tour with our admission team.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="stwo">
                    <table>
                      <tr>
                        <td style="padding: 2px 0px 36px 0px">
                          <p><b> Discounted Tuition Fee:</b><br>
                            Take advantage of this offer and save on the enrollment fee, making it easier dor you to secure a spot for your child at our esteemed institution spot for your child.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- End card-->
                <!-- Footer Table-->
                <table>
                  <tr>
                    <td>
                      <p>At <b>{{$school_name}}</b>, we're dedicated to providing a well-rounded education, boasting committed educators and a diverse array of activities to foster individual talents.</p>
                      <p>Don't let this chance slip away – this offer is valid until <b>[Expiration Date]</b>.</ /p>
                      <p>Get in touch with our admissions team at <b>[Admissions Contact Information]</b> to discover more and secure your child's spot.</p>
                      <p>Together, we eagerly anticipate unlocking your child's full potential.</p>
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