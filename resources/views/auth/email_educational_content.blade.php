<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Educational Content Template</title>
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
  <script>window.UserHelpPublicProjectID="Y7YyGqyq2"</script>
        <script src="https://run.userhelp.co" async></script>

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
                      <h4 class="head">Welcome to [School Name]</h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p><b>Dear [User Name],</b></p>
                      <p>We hope you're doing well and looking forward to the upcoming semester at <b>[School Name].</b></p>
                      <p>We're thrilled to introduce our new email notification system, designed to keep you updated with essential educational content and announcements.</p>
                      <p>With these email notifications, you'll receive:</p>
                    </td>
                  </tr>
                </table>
                <!-- End Header-->
                <!-- Card-->
                <div class="card educational">
                  <div class="two">
                    <table>
                      <tr>
                        <td class="numbers">1</td>
                        <td style="padding: 2px 0px 19px 0px">
                          <p><b>Weekly Curriculum Highlights:</b><br>
                            Stay informed about subjects covered each week for valuable insights into your child's education.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="two">
                    <table>
                      <tr>
                        <td class="numbers">2</td>
                        <td style="padding: 2px 0px 19px 0px">
                          <p><b>Important School Announcements:</b><br>
                            imely updates on events, exams, parent-teacher meetings, and more.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="two">
                    <table>
                      <tr>
                        <td class="numbers">3</td>
                        <td style="padding: 2px 0px 36px 0px">
                          <p><b>Parent/Teacher Conference Reminders:</b><br>
                            Automated alerts for scheduled meetings.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="two">
                    <table>
                      <tr>
                        <td class="numbers">4</td>
                        <td style="padding: 2px 0px 36px 0px">
                          <p><b>Education Insights and Tips:</b><br>
                            Access to educational articles, study tips, and learning resources.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="two">
                    <table>
                      <tr>
                        <td class="numbers">5</td>
                        <td style="padding: 2px 0px 19px 0px">
                          <p><b>Extracurricular Opportunities:</b><br>
                            Information on workshops, clubs, and activities to support your child's interests.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="three">
                    <table>
                      <tr>
                        <td class="numbers">6</td>
                        <td style="padding: 2px 0px 30px 0px">
                          <p><b>Important Deadlines:</b><br>
                            Stay on top of assignments, projects, and exams.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="three">
                    <table>
                      <tr>
                        <td class="numbers">7</td>
                        <td style="padding: 2px 0px 36px 0px">
                          <p><b>Student Achievements:</b><br>
                            Celebrate student milestones within our school community.</p>
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
                      <p>Your privacy is essential to us.</p>
                      <p>Your email address will only be used for educational content and school related notifications.</p>
                      <p>You can easily update your preferences or unsubscribe at any time.</p>
                      <p>Please add our email address <b>[school@email.com]</b> to your contact list to ensure you receive these updates.</p>
                      <p>Thank you for your ongoing support in providing the best education for your child. </p>
                      <p>Together, we create an inspiring learning environment for all students.</p>
                      <h4 class="heads">Best regards,</h4>
                      <h6>{{$school_name}}</h6>
                      <hr>
                    </td>
                  </tr>
                  <tr class="emailfooter">
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