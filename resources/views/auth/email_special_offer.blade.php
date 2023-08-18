<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Special Offer Email</title>
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
<style>
.dealwrapper { max-width: 250px; background: #ffffff; border-radius: 8px; -webkit-box-shadow: 0px 0px 50px rgba(0,0,0,0.15); -moz-box-shadow: 0px 0px 50px rgba(0,0,0,0.15); box-shadow: 0px 0px 50px rgba(0,0,0,0.15); position: relative;}
.list-group { position: relative; display: block; background-color: #fff; border-radius: 5px;}
.list-group p { font-size: 12px; line-height: 15px; margin-bottom: 10px; font-style: italic;
  text-align: auto; }
.list-group-item .heading { color: #141f31;
  text-align: auto; /* For Edge */
  }
.list-group-item .text { color: #272727;}
.list-group-item.active .heading, .list-group-item.active .text { color: #ffffff;}
.ribbon-wrapper { width: 88px; height: 88px; overflow: hidden; position: absolute; top: -3px; right: -3px; z-index: 1;}
.ribbon-tag { text-align: center; -webkit-transform: rotate(45deg); -moz-transform: rotate(45deg); -ms-transform: rotate(45deg); -o-transform: rotate(45deg); position: relative; padding: 0px 0; top: 15px; width: 120px; color: #ffffff; -webkit-box-shadow: 0px 0px 3px rgba(0,0,0,0.3); -moz-box-shadow: 0px 0px 3px rgba(0,0,0,0.3); box-shadow: 0px 0px 3px rgba(0,0,0,0.3); text-shadow: rgba(255,255,255,0.5) 0px 1px 0px; background: #343434; }
.ribbon-tag:before, .ribbon-tag:after { content: ""; border-top: 3px solid #50504f; border-left: 3px solid transparent; border-right: 3px solid transparent; position:absolute; bottom: -3px;}
.ribbon-tag:before { left: 0;}
.ribbon-tag:after { right: 0;}
.dealwrapper.blue .ribbon-tag { background: rgba(73,73,250,1);
background: -moz-linear-gradient(top, rgba(73,73,250,1) 0%, rgba(106,69,255,1) 50%, rgba(8,0,247,1) 51%, rgba(64,54,209,1) 100%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(73,73,250,1)), color-stop(50%, rgba(106,69,255,1)), color-stop(51%, rgba(8,0,247,1)), color-stop(100%, rgba(64,54,209,1)));
background: -webkit-linear-gradient(top, rgba(73,73,250,1) 0%, rgba(106,69,255,1) 50%, rgba(8,0,247,1) 51%, rgba(64,54,209,1) 100%);
background: -o-linear-gradient(top, rgba(73,73,250,1) 0%, rgba(106,69,255,1) 50%, rgba(8,0,247,1) 51%, rgba(64,54,209,1) 100%);
background: -ms-linear-gradient(top, rgba(73,73,250,1) 0%, rgba(106,69,255,1) 50%, rgba(8,0,247,1) 51%, rgba(64,54,209,1) 100%);
background: linear-gradient(to bottom, rgba(73,73,250,1) 0%, rgba(106,69,255,1) 50%, rgba(8,0,247,1) 51%, rgba(64,54,209,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4949fa', endColorstr='#4036d1', GradientType=0 );}
.blue .list-group-item.active, .blue .list-group-item.active:focus, .blue .list-group-item.active:hover { background: rgba(73,73,250,1); border-color: #2525e0;}
</style>
<body >

  <table class="body-wrap" style="width: 100%;">
    <tr>
      <td class="container" width="900" style="display: block !important; max-width: 900px !important;" valign="top">
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
                    <h4>Special Limited-Time Offer: Enroll Now for Exclusive Benefits!</h4>
                    <br>               
                    <h5>Hello [User],</h5>
                                   <p>We have fantastic news to share! For a short time, seize the opportunity to enroll your child at {{$school_name}} and enjoy a host of exclusive benefits:</p>
                                    

                    <div class="container">
                      <div class="horizontal">
                      <div class="row">
                      <div class="col-4">
                          <div class="verticals four">
                            <div class="dealwrapper blue">
                              <div class="ribbon-wrapper">
                                <div class="ribbon-tag">Upcoming</div>
                              </div>
                              <div class="list-group">
                                <a href="#" class="list-group-item">
                                  <h5 class="heading">Waived Enrollment Fee</h5>
                                  <p class="text">Take advantage of this offer and save on the enrollment fee, making it easier for you to secure a spot for your child at our esteemed institution spot for your child.</p>
                                </a>
                              </div>
                            </div>​
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="verticals four">
                            <div class="dealwrapper blue">
                              <div class="ribbon-wrapper">
                                <div class="ribbon-tag">Upcoming</div>
                              </div>
                              <div class="list-group">
                                <a href="#" class="list-group-item">
                                  <h5 class="heading">Campus Tour</h5>
                                  <p class="text">Experience our state-of-the-art campus and witness firsthand the excellent facilities and nurturing environment we offer. Schedule a personalized tour with our admissions team.</p>
                                </a>
                              </div>
                            </div>​
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="verticals four">
                            <div class="dealwrapper blue">
                              <div class="ribbon-wrapper">
                                <div class="ribbon-tag">Upcoming</div>
                              </div>
                              <div class="list-group">
                                <a href="#" class="list-group-item">
                                  <h5 class="heading">Discounted Tuition Fee</h5>
                                  <p class="text">If you have more than one child, you'll be pleased to know that we are offering a discounted tuition rate for siblings, promoting accessibility to quality education for families.</p>
                                </a>
                              </div>
                            </div>​
                          </div>
                      </div>
		</div>
	</div>
</div>
                                    <p>At {{$school_name}}, we're dedicated to providing a well-rounded education, boasting committed educators and a diverse array of activities to foster individual talents. Don't let this chance slip away – this offer is valid until [Expiration Date].</p>
                                    <p>Get in touch with our admissions team at [Admissions Contact Information] to discover more and secure your child's spot.</p>
                                    <p>Together, we eagerly anticipate unlocking your child's full potential.</p>
                                    <p><b>Best Regards,</b></p>
                                    <h6>{{$school_name}}</h6>​
</div>
                         </td>
                    </tr>
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