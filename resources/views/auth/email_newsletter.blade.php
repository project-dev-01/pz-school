<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Newsletter Template</title>
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
                      <h4 class="head">Monthly Highlight - [Month/Year]</h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p><b>Dear [User Name],</b></p>
                      <p>We hope your month is off to a fantastic start! We are thrilled to share the latest updates from <b>[School Name]</b> with our beloved school community:</p>
                    </td>
                  </tr>
                </table>
                <!-- End Header-->
                <!-- Card-->
                <div class="card newsletter">
                  <div class="one">
                    <table>
                      <tr>
                        <td class="numbers"> 1</td>
                        <td style="padding: 20px 0px 0px 0px;">
                          <p><b>Principal's Message:</b><br>
                            <b>[Principal Name]</b> welcomes you all to an amazing month ahead. We appreciate the dedication of our students and staff during [last month/term] and look forward to upcoming events and initiatives.
                          </p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="two">
                    <table>
                      <tr>
                        <td class="numbers">2</td>
                        <td style="padding: 2px 0px 19px 0px">
                          <p><b>Academic Excellence:</b><br>
                            Congratulations to our students on their exceptional results in <b>[recent exams/competitions]</b>. Keep up the great work!</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="two">
                    <table>
                      <tr>
                        <td class="numbers">3</td>
                        <td style="padding: 2px 0px 19px 0px">
                          <p><b>Extracurricular Highlights:</b><br>
                            Our students continue to shine in sports, music, and more. Check out their achievements in various activities.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="two">
                    <table>
                      <tr>
                        <td class="numbers">4</td>
                        <td style="padding: 2px 0px 19px 0px">
                          <p><b>Upcoming Events:</b><br>
                            Stay tuned for exciting events, including <b>[event name]</b> and community service projects.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="two">
                    <table>
                      <tr>
                        <td class="numbers">5</td>
                        <td style="padding: 2px 0px 19px 0px">
                          <p><b>Parent-Teacher Meetings:</b><br>
                            Meet with teachers on <b>[date(s)]</b> to discuss your child's progress and strengths.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="three">
                    <table>
                      <tr>
                        <td class="numbers">6</td>
                        <td style="padding: 2px 0px 30px 0px">
                          <p><b>Staff Spotlight:</b><br>
                            Get to know our passionate teachers and their experiences.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="three">
                    <table>
                      <tr>
                        <td class="numbers">7</td>
                        <td style="padding: 2px 0px 19px 0px">
                          <p><b>School Facilities Update:</b><br>
                            We've upgraded <b>[specific school facilities]</b> to enhance the learning environment.</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="three">
                    <table>
                      <tr>
                        <td class="numbers">8</td>
                        <td style="padding: 2px 0px 30px 0px">
                          <p><b>Parent Partnership:</b><br>
                            Share your ideas and feedback with us. Your input matters!</p>
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
                      <p><b>Reminders:</b></p>
                      <ol class="text">
                        <li>Follow us on social media for real-time updates.</li>
                        <li>Check the school website for announcements and news.</li>
                        <li>Keep your contact information up-to-date with the school office.</li>
                      </ol>
                      <p>Thank you for being part of our family. Together, we create an outstanding educational experience.</p>
                      <p>Wishing you a wonderful month ahead!</p>
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