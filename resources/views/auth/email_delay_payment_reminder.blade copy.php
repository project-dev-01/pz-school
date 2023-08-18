
                                <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Delay Payment Reminder Template</title>
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
      <td class="container" width="850" style="display: block !important; max-width: 850px !important;" valign="top">
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
                                   <h5>Subject: Delay Payment Reminder for Outstanding School Fees</h5>
                                   <h5>Dear [Parent/Guardian's Name],</h5>
                                   <p>I hope this email finds you well. We would like to bring to your attention the outstanding school fees for your child, [Child's Name], for the current academic term. As of [Today's Date], the payment for the fees has not been received.</p>
                                   <p>We understand that situations may arise that could lead to delays in payment. However, we kindly request your immediate attention to this matter to ensure the smooth continuation of your child's education at {{$school_name}}.</p>
                                   <p>Here are the details of the outstanding fees:</p>
                                   <!--<p style="font-size:15px;line-height:30px;">
                                    <b>Student's Name:</b>[Child's Name]<br>
                                    <b>Grade/Class:</b> [Grade/Class]<br>
                                   <b>Total Outstanding Amount:</b>  [Total Outstanding Amount]<br>
                                    <b>Due Date:</b> [Original Due Date]<br>
                                    </p>-->
                                   <table class="gmail-table">
                  <tbody>
                    <tr>
                      <td><b>Student's Name</b></td>
                      <td>佐藤 清</td>
                    </tr>
                    <tr>
                      <td><b>Grade/Class</b></td>
                      <td>Grade 1 / Class 1 </td>
                    </tr>
                    <tr>
                      <td><b>Billing Period</b></td>
                      <td>March/June 23</td>
                    </tr>
                    <tr>
                      <td><b>Due Date</b></td>
                      <td>31/March/23</td>
                    </tr>
                    <tr>
                      <td><b>Validity Date</b></td>
                      <td>24/June 23</td>
                    </tr>
                    <tr>
                      <td><b>Remarks</b></td>
                      <td style="color:red;">A fine of Rs15/- per day will be changed after the due date</td>
                    </tr>
                  </tbody>
                </table>

                                    <p>To facilitate the payment process, you can choose one of the following methods:</p>

                                    <p><b>Online Payment:</b> Log in to the parent portal on our school website [Website URL] and navigate to the 'Fees' section to make an online payment using your preferred payment method.</p>
                                    <p><b>Bank Transfer:</b> You can make a direct bank transfer to the school's account using the following details:</p>
                                   <p style="font-size:15px;line-height:30px;">
                                    <b>Bank Name:</b>[Bank Name]<br>
                                    <b>Account Name:</b>[Account Name]<br>
                                   <b>Account Number:</b> [Account Number]<br>
                                    <b>Reference:</b>[Invoice/Student ID]<br>
                                    </p>
                                    
                                    <p>If you have already made the payment, please accept our apologies for any inconvenience caused. In this case, please provide us with the transaction details at [School Email Address] so that we can update our records accordingly.</p>
                                    <p>We understand that circumstances can vary, and if you are facing challenges in meeting the payment deadline, we encourage you to communicate with our school's finance department at [Finance Department Email/Phone Number]. We are here to work together and find a suitable solution to address your concerns.</p>
                                    <p>Your timely response to this matter is greatly appreciated. We believe that maintaining clear communication will help us support your child's educational journey effectively.</p>
                                    <p>Thank you for your understanding and cooperation. We look forward to your prompt response.</p>
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
                                   