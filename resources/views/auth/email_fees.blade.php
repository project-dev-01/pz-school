<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Fees Template</title>
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
                      <img src="{{ config('constants.image_url').'/public/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle header">
                      <p class="schoolname">{{$school_name}}</p>
                    <hr>
                  </td>
                  </tr>
                  <tr>
                    <td>
                      <h4 class="head">Fee Notice</h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p><b>Greetings from {{$school_name}}</b></p>
                      <p>This is a friendly reminder that your child's fee payment us due on the <b>[due date]</b>. </p>
                      <p>We kindly request you to take care of this matter as soon as possible. Your prompt attention is highly appreciated.</p>
                    </td>
                  </tr>
                </table>
                <!-- End Header-->
                <!-- Fees Table-->
                <table class="gmail-table">
                  <thead>
                    <tr>
                      <th>Fees Reminder</th>
                      <th>Due Date</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr style="border-bottom: 1px solid #7E7E7E;">
                      <td>Additional School Fees</td>
                      <td>23 August 2023</td>
                      <td>RM 350.00</td>
                    </tr>
                    <tr>
                      <td>School adminisitered Event Fees</td>
                      <td>12 Sept 2023</td>
                      <td>RM 350.00</td>
                    </tr>
                  </tbody>
                </table>
                 <!-- End Fees Table-->
                <!-- Footer Table-->
                <table>
                  <tr>
                    <td>
                      <p>Thank you for your continued support in investing in our institution and our students.</p>
                      <h4 class="heads">Best regards,</h4>
                      <h6>{{$school_name}}</h6>
                      <hr style="width: 552px; height: 1px;">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p class="footerfont">For help & support, kindly use contact information below.</p>
                      <img src="{{ config('constants.image_url').'/public/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle footerlogo">
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