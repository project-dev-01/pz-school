<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>POST EVENT PARTICIPATION EMAIL</title>
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
   *{
  box-sizing:border-box;
}
.wrapper-1{
  width:100%;
  height:100vh;
flex-direction: column;
}
.wrapper-2{
  text-align:center;
}
h1{
  color:#5892FF ;
  margin:0;
  margin-bottom:20px;
}

@media (min-width:360px){
  h1{
    font-size:3em;
    margin-top: 5px;
  }
  .go-home{
    margin-bottom:20px;
  }
}

@media (min-width:600px){
  .content{
  max-width:1000px;
  margin:0 auto;
}
  .wrapper-1{
  height: initial;
  max-width:500px;
  margin:0 auto;
  box-shadow: 4px 8px 40px 8px rgba(88, 146, 255, 30%);
}


}
</style>
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
                              <div class=content>
                                <div class="wrapper-1">
                                  <div class="wrapper-2">
                                        <h1>Thank you !</h1>
                                        <p>Thank You for Joining Us at <b>[Event Name]!</b></p>
                                  </div>
                                </div>
                              </div>
                              <h5>Hello [User],</h5>
                                   <p>A heartfelt thank you for being a part of [Event Name]. Your enthusiastic participation and support played a pivotal role in making the event a resounding success.</p>
                                    <p>The dedication and hard work of our students truly shone through, reflecting their remarkable performances. We commend them for their outstanding efforts.</p>
                                    <p>To our valued parents and guardians, your unwavering encouragement means the world to us. Your role in nurturing our students' growth is immeasurable.</p>
                                    <p>A special appreciation goes out to our dedicated faculty, staff, and volunteers for their behind-the-scenes dedication.</p>
                                    <p>The event fostered a sense of unity and community, warming our hearts. We're excited about future occasions like these.</p>
                                    <p>Should you have any feedback or suggestions for upcoming events, kindly share them with us. Your insights are vital as we continually enhance the school experience.</p>
                                    <p><b>Best Regards,</b></p>
                                    <h6>{{$school_name}}</h6>
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