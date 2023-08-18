<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Email Newsletter Template</title>
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
          <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action">
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
                      <h5>Dear [user],</h5>
                                  <p>We hope your month is off to a fantastic start! We are thrilled to share the latest updates from [School Name] with our beloved school community:</p>
                                  <h5>Principal's Message:</h5>
                                  <p>Welcome to a fantastic month ahead! Our principal, [principal name], extends heartfelt appreciation for the dedication and enthusiasm of our students and staff during [last month/term]. Exciting events and initiatives are on the horizon, enriching our school experience.</p>
                                  <h5>Academic Excellence:</h5>
                                  <p>Congratulations to our students on their academic achievements in [recent exams/competitions]. Your hard work inspires us all. Keep striving for excellence!</p>
                                  <h5>Extracurricular Highlights:</h5>
                                  <p>Our students continue to shine in sports, music, and various other activities. Please take a moment to explore their impressive achievements across these diverse fields.</p>
                                  <h5>Upcoming Events:</h5>
                                  <p>Exciting events this month! Stay tuned for schedules and info, including [event name] and community projects.</p>
                                  <h5>Parent-Teacher Meetings:</h5>
                                  <p>Connect with us at the upcoming parent-teacher meeting on [date] to discuss your child's development. Your presence matters!</p>
                                  <h5>Staff Spotlight:</h5>
                                  <p>Discover our dedicated faculty in this section. Know about their teaching philosophies and experiences as they share their insights.</p>
                                  <h5>School Facilities Update:</h5>
                                  <p>Exciting news! We've upgraded [specific school facilities] to create a better learning environment for our students.</p>
                                  <h5>Parent Partnership:</h5>
                                  <p>We appreciate parent-school collaboration. Share your ideas and feedback with us; your insights help us improve our school community.</p>
                                  <h5>Reminders:</h5>
                                 <ol>
                                  <li>Follow us on social media for instant updates and a peek into school life.</li>
                                  <li>Visit the school website for vital announcements and the latest news.</li>
                                  <li>Keep your contact information up to date with the school office.</li>
                                </ol>
                                <p>Thank you for being a part of [ school name] family. We create an excellent education together. Wishing you a great month ahead!</p>

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
  </table>
</body>

</html>