<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Invoice Template</title>
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
                      <h4 class="head">INVOICE #123456</h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p><b>Dear [User Name],</b></p>
                      <p>We hope you are doing well. Please find below the invoice attachment file for your child, <b>[Student Name]</b>'s school fees for the current academic period:</p>
                    </td>
                  </tr>
                </table>
                <!-- End Header-->
                <!-- Fees Table-->
                <table class="invoice">
                  <thead>
                    <tr>
                      <th colspan="3">Details</th>
                      <th colspan="3">Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr style="border-bottom: 1px solid #7E7E7E;">
                      <td colspan="3">Additional School Fees</td>
                      <td colspan="3">RM 350.00</td>
                    </tr>
                    <tr>
                      <td colspan="3">School adminisitered Event Fees</td>
                      <td colspan="3">RM 350.00</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td class="status">Status</td>
                      <td class="unpaid">Unpaid</td>
                      <td class="totalamount">Total Amount</td>
                      <td style="padding: 16px;background: #070739; color: #FFFFFF;">RM 700.00</td>
                    </tr>
                  </tfoot>
                </table>
                <!-- End Fees Table-->
                <!-- Footer Table-->
                <table>
                  <tr>
                    <td>
                      <p>For any questions or assistance with the payment process, kindly reach out to our billing department at <b>[Billing Department Contact Number]</b> or <b>[Billing Department Email Address]</b>.</p>
                      <p>Your prompt consideration of this matter is greatly appreciated. We value the chance to nurture and educate your child as part of [{{$school_name}}]'s academic journey.</p>
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