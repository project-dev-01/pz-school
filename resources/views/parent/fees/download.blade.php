<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Invoice</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Paxsuzen School is a premier educational institution that offers quality education to students of all ages. Our curriculum is designed to prepare future leaders for success in the global marketplace.">
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
  <link href="{{ asset('css/custom/feesinvoice.css') }}" rel="stylesheet" type="text/css" />

  <style>
    @font-face {
      font-family: ipag;
      font-style: normal;
      font-weight: normal;
      src: url("storage_path('fonts/ipag.ttf')");
    }

    body {
      font-family: ipag !important;
    }

    td {
      font-family: ipag !important;
    }

    header {
      position: fixed;
      top: -60px;
      left: 0px;
      right: 0px;
      height: 50px;
      font-size: 20px !important;

      /** Extra personal styles **/
      background-color: #fff;
      color: #111;
      text-align: center;
      line-height: 35px;
    }

    footer {
      position: fixed;
      bottom: -60px;
      left: 0px;
      right: 0px;
      font-size: 20px !important;

      /** Extra personal styles **/
      background-color: #fff;
      color: #111;
      text-align: center;
      line-height: 35px;
    }
  </style>
</head>

<body>
  @php
  use \App\Http\Controllers\ParentController;
  @endphp
  <table class="body-wrap">
    <tr>
      <td class="container">
        <div class="content">
          <table class="main">
            <tr>
              <td class="content-wrap">
                <table width="100%">
                  <tr>
                    <td>
                      <img src="{{ config('constants.image_url').'/common-asset/images/'.$school_image }}" class="mr-2 rounded-circle" alt="">
                      <p class="invoice" style="font-size: 20px;"><strong>{{ __('messages.invoice') }}{{ $school_name }}</strong></p>
                      <p class="schoolname"><strong>{{ $school_name }}</strong></p>
                    </td>
                  </tr>
                </table>
                <table class="table table-borderless mb-0">

                  <tbody>
                    <tr>
                      <td style="border-top: none;" width="40%">
                        <p style="font-size: 20px;"><strong>{{ __('messages.to') }}: {{ $parent['first_name'] }} {{ $parent['last_name'] }}</strong></h4>
                        <div class="mt-3" style="line-height: 10px;">
                          <p>{{ $parent['address'] }},</p>
                          <p><i class="fa fa-envelope"></i> {{ $parent['email'] }}</p>
                          <p><i class="fa fa-phone"></i> {{ $parent['mobile_no'] }}</p>
                        </div>
                      </td>
                      <td width="25%" style="border-top: none;"></td>
                      <td style="border-top: none;">
                        <p style="font-size: 20px;"><strong>{{ __('messages.invoice_details') }}</strong></p>
                        <div class="mt-3" style="line-height: 10px;">
                          <p class="m-b-10"><strong>{{ __('messages.invoice_date') }} : </strong> <span class="float-centre">{{$date}}</span></p>
                          <p class="m-b-10"><strong>{{ __('messages.invoice_no') }} : </strong> <span class="float-centre"></span></p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                  </tbody>
                </table>

                <table>
                  <td>
                    <p><strong>Dear [{{$parent_name}}],</strong></p>
                    <p>We hope you are doing well. Please find below the invoice for your child, [{{$student_name}}]'s school fees for the current academic period:
                    </p>
                  </td>
            </tr>
          </table>

          <table class="table mt-2 table-centered main">
            <thead>
              <tr>
                <th><b>{{ __('messages.fees_name') }} </b></th>
                <th style="width: 15%"><b>{{ __('messages.due_date') }}</b></th>
                <th style="width: 15%"><b>{{ __('messages.price') }}</b></th>
                <th style="width: 15%"><b>{{ __('messages.paid') }}</b></th>
                <th style="width: 15%"><b>{{ __('messages.amount') }}</b></th>
              </tr>
            </thead>
            <tbody>

              @php
              $total_fine = 0;
              $total_balance = 0;
              @endphp
              @forelse ($student_fees_history as $key => $row)
              @php
              $count = 1;
              $total_discount = 0;
              $total_paid = 0;
              $total_amount = 0;
              if($row['payment_status_id'] == 1 && isset($row['paid_date'])){
              $type_amount = round($row['paid_amount']);
              }else{
              $type_amount = round(0);
              }
              $balance = ($row['amount'] - $type_amount);
              $total_balance += $balance;
              $balance = number_format($balance, 2, '.', '');
              $fees_amount = number_format($row['amount'], 2, '.', '');
              $paid_amt = number_format($type_amount, 2, '.', '');

              $args = [
              'payment_status_id'=>$row['payment_status_id'],
              'payment_mode_id'=>$row['payment_mode_id'],
              'due_date'=>$row['due_date'],
              'paid_date'=>$row['paid_date'],
              'amount'=>$row['amount'],
              'paid_amount'=>$row['paid_amount'],
              'payment_mode_name'=>$row['payment_mode_name'],
              ];
              $paidDetails = ParentController::paidStatusDetails($args);

              $labelmode = isset($paidDetails['labelmode'])?$paidDetails['labelmode']:'';
              $paidSts = isset($paidDetails['paidSts'])?$paidDetails['paidSts']:'';

              @endphp
              <tr class="responsive">
                <td>
                  <b>{{ __('messages.' . strtolower($row['payment_mode_name'])) }}</b> <br />
                  {{ $row['name'] }}
                </td>
                <td>
                  {{ $row['due_date'] }}
                </td>
                <td>${{ $fees_amount }}</td>
                <td>${{ $paid_amt }}</td>
                <td>${{ $balance }}</td>
              </tr>
              @empty
              <tr>
                <td class="text-center" colspan="4">{{ __('messages.no_data_available') }}</td>
              </tr>
              @endforelse

            </tbody>
          </table>
          <!-- Table Total -->
          <table>
            <tbody>
              <tr>
                <td width="50%">
                  <h3>{{ __('messages.payment_method') }}</h3>
                </td>
                <td width="25%">
                  <p style="margin-left: 128px;"><b>{{ __('messages.total') }} :</b> </p>
                </td>
                <td width="25%">
                  <p style="margin-right: 22px;"><span><b>${{$total_balance - $total_fine}}</b></span></p>
                </td>
              </tr>
              <tr>
                <td>

                  <small class="text-muted">
                    {{ __('messages.offline') }}
                  </small>
                </td>
              </tr>
              <tr>
                <td width="70%">

                  <p style="margin-bottom: 0px;"><strong>{{ __('messages.terms_conditions')}}</strong></p>
                </td>
                <td width="30%">

                </td>

              </tr>
              <tr>
                <td> <small class="text-muted">
                    {{ __('messages.i_agree_to')}} </small>

                </td>
                <td class="float-right">
                  <p style="font-size: 14px; color: #000000; margin-right: -31px;text-align:right;">{{ $school_name }}</p>
                </td>

              </tr>
              <tr>
                <td colspan="3">
                  <hr>
                  <footer class="footer footer-alt">
                    <p class="text-muted" style="text-align: center;">2020 - <script>
                        document.write(new Date().getFullYear())
                      </script> &copy; by <a href="javascript: void(0);" class="text-muted">Paxsuzen</a> </p>
                  </footer>
                </td>
              </tr>
            </tbody>
          </table>
          <!-- /Table Total -->
  </table>
  </table>
  </div>
  </td>
  </tr>
  </table>
</body>

</html>