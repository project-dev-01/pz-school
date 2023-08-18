<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Invoice Email</title>
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
              <td class="content-wrap" style="text-align: justify; line-height: 25px;padding: 30px;border: 3px solid #4fc6e1;background-color: #fff;" valign="top">
                <table width="100%">
                  <tr>
                    <td>
                      <img src="{{ config('constants.image_url').'/public/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle" alt="">
                      <p style="font-size: 15px; color: #343556; font-weight: 800; margin-top: -37px; text-align: right; margin-bottom: 37px;">{{$school_name}}</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Dear [User],</h5>
                      <p>We hope you are doing well. Please find below the invoice for your child, [Student Name]'s school fees for the current academic period:
                      </p>
                    </td>
                  </tr>
                </table>

                <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
                  <tbody>
                    <tr>
                    <tr class="visibleMobile">
                      <td height="20"></td>
                    </tr>
                    <tr>
                      <td>
                        <table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                          <tbody>
                            <tr>
                              <th style="font-size: 12px; color: #5b5b5b; line-height: 1; vertical-align: top; padding: 0 10px 7px 0;">
                                <b>Item#</b>
                              </th>
                              <th style="font-size: 12px; color: #5b5b5b; line-height: 1; vertical-align: top; padding: 0 0 7px;">
                                <b>Item Description</b>
                              </th>
                              <th style="font-size: 12px; color: #5b5b5b; line-height: 1; vertical-align: top; padding: 0 0 7px;">
                                <b>Quantity</b>
                              </th>
                              <th style="font-size: 12px; color: #1e2b33; line-height: 1; vertical-align: top; padding: 0 0 7px;">
                                <b>Unit Price</b>
                              </th>
                              <th style="font-size: 12px; color: #1e2b33; line-height: 1; vertical-align: top; padding: 0 0 7px;">
                                <b>Total Amount</b>
                              </th>
                            </tr>
                            <tr>
                              <td height="1" style="background: #bebebe;" colspan="6"></td>
                            </tr>
                            <tr>
                              <td height="1" style="background: #121212;" colspan="6"></td>
                            </tr>
                            <tr>
                              <td style="font-size: 12px; color: #ff0000;  line-height: 18px;  vertical-align: top; padding:10px 0;" class="article">
                                Tuition Fee
                              </td>
                              <td style="font-size: 12px; color: #646a6e;  line-height: 18px;  padding:10px 0;"><small>MHDV2G/A</small></td>
                              <td style="font-size: 12px; color: #646a6e;  line-height: 18px;  padding:10px 0;">1</td>
                              <td style="font-size: 12px; color: #1e2b33;  line-height: 18px;  padding:10px 0;">$299.95</td>
                              <td style="font-size: 12px; color: #1e2b33;  line-height: 18px; padding:10px 0;">$299.95</td>
                            </tr>
                            <tr>
                              <td height="1" colspan="5" style="border-bottom:1px solid #e4e4e4"></td>
                            </tr>
                            <tr>
                              <td style="font-size: 12px; color: #ff0000;  line-height: 18px;  padding:10px 0;" class="article">School Supplies</td>
                              <td style="font-size: 12px; color: #646a6e;  line-height: 18px;  padding:10px 0;"><small>MHDV2G/B</small></td>
                              <td style="font-size: 12px; color: #646a6e;  line-height: 18px;  padding:10px 0;">1</td>
                              <td style="font-size: 12px; color: #1e2b33;  line-height: 18px;  padding:10px 0;">$29.95</td>
                              <td style="font-size: 12px; color: #1e2b33;  line-height: 18px;  padding:10px 0;">$29.95</td>
                            </tr>
                            <tr>
                              <td height="1" colspan="5" style="border-bottom:1px solid #e4e4e4"></td>
                            </tr>
                            <tr>
                              <td style="font-size: 12px; color: #ff0000;  line-height: 18px;  padding:10px 0;" class="article">Extracurricular Activities</td>
                              <td style="font-size: 12px; color: #646a6e;  line-height: 18px;  padding:10px 0;"><small>MHDV2G/C</small></td>
                              <td style="font-size: 12px; color: #646a6e;  line-height: 18px;  padding:10px 0;">1</td>
                              <td style="font-size: 12px; color: #1e2b33;  line-height: 18px;  padding:10px 0;">$29.95</td>
                              <td style="font-size: 12px; color: #1e2b33;  line-height: 18px;  padding:10px 0;">$29.95</td>
                            </tr>
                            <tr>
                              <td height="1" colspan="5" style="border-bottom:1px solid #e4e4e4"></td>
                            </tr>
                            <tr>
                              <td style="font-size: 12px; color: #ff0000;  line-height: 18px;  padding:10px 0;" class="article">Other Fees (if applicable)</td>
                              <td style="font-size: 12px; color: #646a6e;  line-height: 18px;  padding:10px 0;"><small>MHDV2G/D</small></td>
                              <td style="font-size: 12px; color: #646a6e;  line-height: 18px;  padding:10px 0;">1</td>
                              <td style="font-size: 12px; color: #1e2b33;  line-height: 18px;  padding:10px 0;">$29.95</td>
                              <td style="font-size: 12px; color: #1e2b33;  line-height: 18px;  padding:10px 0;">$29.95</td>
                            </tr>
                            <tr>
                              <td height="1" colspan="5" style="border-bottom:1px solid #e4e4e4"></td>
                            </tr>
                          </tbody>
                        </table>

                        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
                          <tbody>
                            <tr>
                              <td>
                                <table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
                                  <tbody>
                                    <tr>
                                      <td>

                                        <!-- Table Total -->
                                        <table width="520" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                                          <tbody>
                                            <tr>
                                              <td style="font-size: 12px; color: #646a6e; vertical-align: top; text-align:right; ">
                                                Subtotal
                                              </td>
                                              <td style="font-size: 12px; color: #646a6e; vertical-align: top; text-align:right; white-space:nowrap;" width="80">
                                                $329.90
                                              </td>
                                            </tr>
                                            <tr>
                                              <td style="font-size: 12px; color: #646a6e; vertical-align: top; text-align:right; ">
                                                Shipping &amp; Handling
                                              </td>
                                              <td style="font-size: 12px; color: #646a6e; vertical-align: top; text-align:right; ">
                                                $15.00
                                              </td>
                                            </tr>
                                            <tr>
                                              <td style="font-size: 12px; color: #000; vertical-align: top; text-align:right; ">
                                                <strong>Grand Total (Incl.Tax)</strong>
                                              </td>
                                              <td style="font-size: 12px; color: #000; vertical-align: top; text-align:right; ">
                                                <strong>$344.90</strong>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td style="font-size: 12px; color: #b0b0b0; vertical-align: top; text-align:right; "><small>TAX</small></td>
                                              <td style="font-size: 12px; color: #b0b0b0; vertical-align: top; text-align:right; ">
                                                <small>$72.40</small>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                        <!-- /Table Total -->

                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                    <tr>
                      <td height="10"></td>
                    </tr>
                    <tr>
                      <td>
                        <p>For any questions or assistance with the payment process, kindly reach out to our billing department at [Billing Department Contact Number] or [Billing Department Email Address].</p>
                        <p>Your prompt consideration of this matter is greatly appreciated. We value the chance to nurture and educate your child as part of {{$school_name}}'s academic journey.</p>
                        <p><b>Best Regards,</b></p>
                        <h6>{{$school_name}}</h6>
                      </td>
                    </tr>
                  </tbody>
                </table>

          </table>
        </div>
      </td>
    </tr>
  </table>
</body>
</html>