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
                      <h4 class="head">Delayed Payment Reminder</h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p><b>Dear Parent/ Guardian,</b></p>
                      <p>This is a reminder of unpaid school fees for [child's name], urging prompt payment through online or bank transfer methods.</p>
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
                      <td class="idcardright">Grade/Class</td>
                      <td class="idcardleft" style="color: #000000;text-align: center;">Grade 1/Class 1</td>
                    </tr>
                    <tr>
                      <td class="idcardright">Billing Period</td>
                      <td class="idcardleft" style="color: #000000;text-align: center;">March/June</td>
                    </tr>
                    <tr>
                      <td class="idcardright">Due Date</td>
                      <td class="idcardleft" style="color: #000000;text-align: center;">31 March 2023</td>
                    </tr>
                    <tr>
                      <td class="idcardright">Validity Date</td>
                      <td class="idcardleft" style="color: #000000;text-align: center;">24 June 2023</td>
                    </tr>
                    <tr>
                      <td class="idcardright">Remarks</td>
                      <td class="idcardleft" style="color: #FF0E0E;text-align: center;">A fine of RMX per day will be charged after the due date</td>
                    </tr>
                  </tbody>
                </table>
                 <!-- End Fees Table-->
                <!-- Footer Table-->
                <table>
                  <tr>
                    <td>
                      <p>To facilitate the payment process, you can choose one of the following methods:</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p><b>Online Payment:</b></p>
                      <p>Log in to the parent portal on our school website [Website URL] and navigate to the 'Fees' section to make an online payment using your preferred payment method.</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p><b>Bank Transfer:</b></p>
                      <p>You can make a direct bank transfer to the school's account ustng the following details:</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p style="line-height: 8.4px; margin-top: 10px;"><b>Bank Name : </b>Bank Name</p>
                      <p style="line-height: 8.4px;"><b>Account Name : </b>[Account Name]</p>
                      <p style="line-height: 8.4px;"><b>Account Number : </b>[Account Number]</p>
                      <p style="line-height: 8.4px; margin-bottom: 25px;"><b>Reference : </b>[Invoice Student ID]</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p>If you've already paid, please share transaction details.</p>
                      <p>If you are facing any challenges, contact our finance department for further assistance. Your timely response is appreciated.</p>
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