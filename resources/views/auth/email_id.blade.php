<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email ID Card Template</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="To learn as much as I can, attain good grades and advance my education further. I believe that self-motivation and a strict routine has helped me achieve my goals so far, and I will use the same method in the future.">
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
                      <h4 class="head">School ID Card Issuance</h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p><b>Dear Parent/ Guardian,</b></p>
                      <p>Your child's academic journey at <b>{{$school_name}}</b> is about to begin! To enhance security and identification, we will be issuing ID cards for all students.</p>
                      <p>Please find below the details for the issuance of the ID card.</p>
                    </td>
                  </tr>
                </table>
                <!-- End Header-->
                <!-- Fees Table-->
                <table class="idcard-table">
                  <thead>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="idcardright">Student's Name</td>
                      <td class="idcardleft" style="color: #000000;text-align: center;">Muhammad Zikry Bin Muhammad Adam</td>
                    </tr>
                    <tr>
                      <td class="idcardright">Registered Number</td>
                      <td class="idcardleft" style="color: #000000;text-align: center;">BRO-022</td>
                    </tr>
                    <tr>
                      <td class="idcardright">Roll Number</td>
                      <td class="idcardleft" style="color: #000000;text-align: center;">819230123123</td>
                    </tr>
                    <tr>
                      <td class="idcardright">Date Of Birth</td>
                      <td class="idcardleft" style="color: #000000;text-align: center;">23 Jun 2000</td>
                    </tr>
                    <tr>
                      <td class="idcardright">Grade/Class</td>
                      <td class="idcardleft" style="color: #000000;text-align: center;">Grade 1 / Class 1</td>
                    </tr>
                    <tr>
                      <td class="idcardright">Date & Time Of Issuance</td>
                      <td class="idcardleft" style="color: #000000;text-align: center;">21 July 2023</td>
                    </tr>
                  </tbody>
                </table>
                 <!-- End Fees Table-->
                <!-- Footer Table-->
                <table>
                  <tr>
                    <td>
                      <p>The ID card is essential for various school activities, such as library usage, event access and other facilities. Please ensure your child brings a clear passport-sized photo with their full name written on the back.</p>
                      <p>If, for any reason, your child cannot attend the issuance session, kindly inform the school office, and we will make alternative arrangements.</p>
                      <p>Looking forward to a successful academic year!</p>
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