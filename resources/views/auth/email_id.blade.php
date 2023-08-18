<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Confirmation Template</title>
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
              <td class="content-wrap" style="text-align: justify;line-height: 25px;padding: 30px;border: 3px solid #4fc6e1;background-color: #fff;" valign="top">
                <table width="100%">
                  <tr>
                    <td>
                      <img src="{{ config('constants.image_url').'/public/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle" alt="">
                      <p style="font-size: 15px; color: #343556; font-weight: 800; margin-top: -37px; text-align: right; margin-bottom: 37px;">{{$school_name}}</p>
                    </td>
                  </tr>
                   <tr>
                      <td>
                        <h4>Subject: School ID Card Issuance - [student name]</h4>
                        <h4>Dear Parent/ Guardian,</h4>
                        <p>Your child's academic journey at {{$school_name}} is about to begin! To enhance security and identification, we will be issuing ID cards for all students.</p>
                      </td>
                  </tr>
                </table>
                <h5>Please find below the details for the issuance of the ID card:]</h5>
                <table class="gmail-table">
                  <tbody>
                    <tr>
                      <td>Student's Full Name:</td>
                      <td>佐藤 清</td>
                    </tr>
                    <tr>
                      <td>Student's Register Number:</td>
                      <td>BR0-022</td>
                    </tr>
                    <tr>
                      <td>Student's Roll Number:</td>
                      <td>872388923</td>
                    </tr>
                    <tr>
                      <td>Date of Birth:</td>
                      <td>27-03-1992</td>
                    </tr>
                    <tr>
                      <td>Grade/Class: </td>
                      <td>Grade 1 / Class 1 </td>
                    </tr>
                    <tr>
                      <td>Date and Time of Issuance</td>
                      <td>21-07-2023</td>
                    </tr>
                  </tbody>
                </table>
                <table>
                  <tr>
                    <td>
                     <p>The ID card is essential for various school activities, such as library usage, event access and other facilities. Please ensure your child brings a clear passport-sized photo with their full name written on the back.</p>
                    <p>If, for any reason, your child cannot attend the issuance session, kindly inform the school office, and we will make alternative arrangements.</p>
                     <p>Should you have any questions or concerns, please feel free to contact our school office at (School Office Contact Details).</p>
                    <p>Looking forward to a successful academic year!</p>
                    </td>
                  </tr>
                   <tr>
                      <td>
                         <p><b>Best regards,</b></p>
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