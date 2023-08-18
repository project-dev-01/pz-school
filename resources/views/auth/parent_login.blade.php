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

  <table class="body-wrap" style="width: 100%;">
    <tr>
      <td class="container" style="display: block !important; max-width: 600px !important;">
        <div class="content" style="padding:20px; margin-top: 20px;">
          <table>
            <tr> 
              <td class="content-wrap" style="text-align: justify;line-height: 25px;padding: 30px;background: #F2F2F2;">
              <table width="100%">
                  <tr> 
                    <td>
                      <img src="{{ config('constants.image_url').'/public/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle" alt="">
                      <p style="font-size: 15px; color: #343556; font-weight: 800; margin-top: -37px; text-align: right; margin-bottom: 37px;">{{$school_name}}</p>
                    </td>
                  </tr>
                  <tr>
                <td>
                     <h4>Greetings from {{$school_name}}</h4>
                </td>
                </tr>
                   <tr>
                      <td>
                        <p>This is a friendly reminder that your child's fee payment us due on the "due date". </p>
                        <p>We kindly request you to take care of this matter as soon as possible. Your prompt attention is highly appreciated.</p>
                      </td>
                  </tr>
                </table>
                <table class="gmail-table">
              <thead>
                <tr>
                  <th>Fees Reminder</th>
                  <th>Due Date</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Additional School Fees</td>
                  <td>August2023</td>
                  <td>10,000</td>
                </tr>
                <tr>
                  <td>School adminisitered Event Fees</td>
                  <td>September2023</td>
                  <td>10,000</td>
                </tr>
              </tbody>
            </table>
             <table>
            <tr>
              <td>
                <p>Thank you for your continued support in investing in our institution and our students.</p>
                <p><b>Best regards,</b></p>
                <h6>{{$school_name}}</h6>
                <hr>
              </td>
            </tr>
            <tr>
              <td>
             
                      <p>For help & support, kindly use contact information below.</p>
                      <p>schoolhelp@gmail.com</p>
                      <p>+60 1234-2345-122</p>
                      <img src="{{ config('constants.image_url').'/public/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle" style="float:right;" alt="">
              </td>
            </tr>
           </table>
              </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
  </table>
</body>
</html>