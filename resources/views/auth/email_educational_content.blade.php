<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Educational Content Template</title>
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
                                    <h5>Dear [User]</h5>
                                   <p>We hope you're doing well and looking forward to the upcoming semester at [School Name].We're thrilled to introduce our new email notification system, designed to keep you updated with essential educational content and announcements.</p>
                                    <p><b>With these email notifications, you'll receive:</b></p>
                                    <ol>
                                    <li><b>Weekly Curriculum Highlights:</b> Stay informed about subjects covered each week for valuable insights into your child's education.</li>
                                    <li><b>Important School Announcements:</b> Timely updates on events, exams, parent-teacher meetings, and more.</li>
                                    <li><b>Parent/Teacher Conference Reminders:</b> Automated alerts for scheduled meetings.</li>
                                    <li><b>Education Insights and Tips:</b>Access to educational articles, study tips, and learning resources.</li>
                                    <li><b>Extracurricular Opportunities:</b> Information on workshops, clubs, and activities to support your child's interests.</li>
                                    <li><b>Important Deadlines:</b> Stay on top of assignments, projects, and exams.</li>
                                    <li><b>Student Achievements:</b> Celebrate student milestones within our school community.</li>
                                    </ol>
                                    <p>Your privacy is essential to us. Your email address will only be used for educational content and school related notifications. You can easily update your preferences or unsubscribe at any time.</p>
                                    <p>Please add our email address [school@email.com] to your contact list to ensure you receive these updates.</p>
                                    <p>If you have any questions, reach out to our administration team at [phone number] or [email address].</p>
                                    <p>Thank you for your ongoing support in providing the best education for your child. </p>
                                    <p>Together, we create an inspiring learning environment for all students.</p>
                                    <p><b>Regards,</b></p>
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