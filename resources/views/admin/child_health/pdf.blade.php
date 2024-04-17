<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PDF</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="To learn as much as I can, attain good grades and advance my education further. I believe that self-motivation and a strict routine has helped me achieve my goals so far, and I will use the same method in the future.">
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

  <style>
    body {
      font-family: ipag;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      font-family: ipag;
      font-size: 13px;
    }

    td,
    th {
      border: 1px solid black;
      text-align: left;
      font-family: ipag;
      font-size: 13px;

    }

    * {
      box-sizing: border-box;
    }

    .column {
      float: left;
      width: 50%;
      padding: 10px;
    }

    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    .line {
      height: 10px;
      right: 10px;
      margin: auto;
      left: -5px;
      width: 100%;
      border-top: 1px solid #000;
      -webkit-transform: rotate(14deg);
      -ms-transform: rotate(14deg);
      transform: rotate(14deg);
    }

    .diagonal {
      width: 150px;
      height: 40px;
    }

    .diagonal span.lb {
      bottom: 2px;
      left: 2px;
    }

    .diagonal span.rt {
      top: 2px;
      right: 2px;
    }

    .diagonalCross2 {
      background: linear-gradient(to top right, #fff calc(50% - 1px), black, #fff calc(50% + 1px))
    }
  </style>
</head>

<body>
  <div class="content" style="box-sizing: border-box; max-width: 850px; display: block; margin: 0 auto; padding: 20px;border-radius: 7px; margin-top: 20px;background-color: #fff; border: 1px solid #dddddd;">
    <div class="row">
      <div class="column">
        <p style="text-align:left;">Form</p>
        <p style="margin-top: 2px;">Child Health Examination Form</p>
      </div>
      <div class="column" style="width: 45%;">
        <h6 style="margin-left:100px;margin-bottom: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Primary&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Secondary</h6>
        <table style="margin-bottom: 15px;">
          <thead>
            <tr>
              <td colspan="2" style="text-align:center;">Class</td>
              <td colspan="1" class="diagonalCross2" style="widtd:0px;border-right:hidden; border-left:hidden;"></td>
              <td colspan="1" style="text-align:center;">Grade </td>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>4</td>
              <td>5</td>
              <td>6</td>
              <td>1</td>
              <td>2</td>
              <td>3</td>
            </tr>
          </thead>
          <tbody>
                                    <tr>

                                        <td colspan="4">Class</td>
                                            @foreach($child_health as $key=>$ch)
                                            @if($key=="class")
                                            @foreach($grade as $gr)
                                                <td>{{$ch[$gr]}}</td>
                                            @endforeach
                                            @endif
                                            @endforeach

                                        @for($i=0;$i<$empty; $i++)
                                        <td></td>
                                        @endfor
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="4">Grade</td>
                                            @foreach($child_health as $key=>$ch)
                                            @if($key=="section")
                                            @foreach($grade as $gr)
                                                <td>{{$ch[$gr]}}</td>
                                            @endforeach
                                            @endif
                                            @endforeach

                                        @for($i=0;$i<$empty; $i++)
                                        <td></td>
                                        @endfor



                                    </tr>
            <!-- <tr>
              <td colspan="4">Class  佐藤 清</td>
              <td>1</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td colspan="4">Grade</td>
              <td>2</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr> -->
          </tbody>
        </table>
      </div>
    </div>


    <table class="">
      <thead class="colspanHead">
        <tr>
          <td colspan="30" style="text-align:center;vertical-align: middle;width:47%;">
            Student Name 佐藤 清</td>
          <td colspan="1" style="text-align:left;width:8%;">
          </td>
          <td colspan="1" style="text-align:center;vertical-align: middle;width:8%;">
          </td>
          <td colspan="1" style="text-align:center;vertical-align: middle;width:8%;">
          </td>
          <td colspan="1" style="text-align:center;vertical-align: middle;border-right:hidden;">
          </td>
          <td colspan="1" style="text-align:center;vertical-align: middle;border-right:hidden;">
          </td>
          <td colspan="25" style="text-align:center;vertical-align: middle;">
          </td>
      </thead>
      <tbody>
        <tr>
          <td colspan="10" style="width:1%;">School Name</td>
          <td colspan="20" style="width:20%;"></td>
          <td colspan="5"></td>
          <td colspan="25"></td>
        </tr>
      </tbody>

      <tbody style="border: 1px solid black;">
        <tr>
          <td colspan="10" style="text-align:center;">Age 佐藤 清</td>
          <td colspan="7">6</td>
          <td colspan="7">7</td>
          <td colspan="6">8</td>
          <td colspan="1">9</td>
          <td colspan="1">10</td>
          <td colspan="3">11</td>
          <td colspan="8">12</td>
          <td colspan="8">13</td>
          <td colspan="9">14</td>
        </tr>
        <tr>
          <td colspan="10" style="text-align:center;">Fiscal Year</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td colspan="10" style="text-align:center;">Height</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td colspan="10" style="text-align:center;">Weight</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td colspan="10" style="text-align:center;">Nutritional Status</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td colspan="10" style="text-align:center;">Spine/Chest/Limb</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td rowspan="2" style="width: 0px;">Eyesight</td>
          <td colspan="9" style="text-align:center;">Right</td>
          <td colspan="7"></td>
          <td colspan="7">( )</td>
          <td colspan="6">( )</td>
          <td colspan="1">( )</td>
          <td colspan="1">( )</td>
          <td colspan="3">( )</td>
          <td colspan="8">( )</td>
          <td colspan="8">( )</td>
          <td colspan="9">( )</td>
        </tr>
        <tr>
          <td colspan="9" style="text-align:center;">Left</td>
          <td colspan="7"></td>
          <td colspan="7">( )</td>
          <td colspan="6">( )</td>
          <td colspan="1">( )</td>
          <td colspan="1">( )</td>
          <td colspan="3">( )</td>
          <td colspan="8">( )</td>
          <td colspan="8">( )</td>
          <td colspan="9">( )</td>
        </tr>
        <tr>
          <td colspan="10" style="text-align:center;">Eye Diseases and abnormalities</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td rowspan="2" style="width: 0px;">Hearing</td>
          <td colspan="9" style="text-align:center;">Right</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1" style="background-color:#00000014;"></td>
          <td colspan="1"></td>
          <td colspan="3" style="background-color:#00000014;"></td>
          <td colspan="8"></td>
          <td colspan="8" style="background-color:#00000014;"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td colspan="9" style="text-align:center;">Left</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1" style="background-color:#00000014;"></td>
          <td colspan="1"></td>
          <td colspan="3" style="background-color:#00000014;"></td>
          <td colspan="8"></td>
          <td colspan="8" style="background-color:#00000014;"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td colspan="10" style="text-align:center;">Otorhinolaryngopathy</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td colspan="10" style="text-align:center;">Skin Diseases</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td rowspan="2" style="width: 0px;">Tuberculosis</td>
          <td colspan="9" style="text-align:center;">Diseases and abnormalities</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td colspan="9" style="text-align:center;">Instruction Category</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td rowspan="2" style="width: 0px;">Heart</td>
          <td colspan="9" style="text-align:center;">Clinical Medical Examination</td>
          <td colspan="7"></td>
          <td colspan="7" style="background-color:#00000014;"></td>
          <td colspan="6" style="background-color:#00000014;"></td>
          <td colspan="1" style="background-color:#00000014;"></td>
          <td colspan="1" style="background-color:#00000014;"></td>
          <td colspan="3" style="background-color:#00000014;"></td>
          <td colspan="8"></td>
          <td colspan="8" style="background-color:#00000014;"></td>
          <td colspan="9" style="background-color:#00000014;"></td>
        </tr>
        <tr>
          <td colspan="9" style="text-align:center;">Diseases and abnormalities</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>

        <tr>
          <td rowspan="2" style="width: 0px;">Urine</td>
          <td colspan="9" style="text-align:center;">Protein</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td colspan="9" style="text-align:center;">Glucose</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td colspan="10" style="text-align:center;">Glucose</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td colspan="10" style="text-align:center;">Other Diseases and abnormalities</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td rowspan="2" style="width: 0px;">School Doctors</td>
          <td colspan="9" style="text-align:center;">Findings</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td colspan="9" style="text-align:center;">Data</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td colspan="10" style="text-align:center;">Follow Up Treatments</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>
        <tr>
          <td colspan="10" style="">Remark</td>
          <td colspan="7"></td>
          <td colspan="7"></td>
          <td colspan="6"></td>
          <td colspan="1"></td>
          <td colspan="1"></td>
          <td colspan="3"></td>
          <td colspan="8"></td>
          <td colspan="8"></td>
          <td colspan="9"></td>
        </tr>
      </tbody>
    </table>


  </div> <!-- end table-responsive-->


</body>

</html>