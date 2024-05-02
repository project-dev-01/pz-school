<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>UBold - Responsive Bootstrap 4 Admin Dashboard</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="health.css" rel="stylesheet" type="text/css" />
    <script>window.UserHelpPublicProjectID="Y7YyGqyq2"</script>
        <script src="https://run.userhelp.co" async></script>

<style>
    @font-face {
            font-family: ipag;
            font-style: normal;
            font-weight: normal;
            src: url($storage);
        } 
       
    .table td,
        .table th {
            padding: 2px;
        }

        .table {
            width: 100%;
            margin-bottom: 1px;
            color: black;
            text-align: center;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid black;
            text-align: center;
			font-size:11px;
        }


        table td {
            overflow: hidden;
            border: 1px solid #000;
            text-align: center;
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
         background: linear-gradient(to top right, #fff calc(50% - 1px), black , #fff calc(50% + 1px) )
        }
		@media screen and (min-device-width: 280px) and (max-device-width: 900px) 
 {
    .responsive
	{
	margin-top:10px;
	}
}
</style>

</head>

<body>
    <div class="content"
        style="box-sizing: border-box; max-width: 800px; display: block; margin: 0 auto; padding: 20px;border-radius: 7px; margin-top: 20px;background-color: #fff;">
        <table class="main" width="100%">
            <tr>
                <td class="content-wrap aligncenter" style="margin: 0;padding: 20px;
                    align=" center">


                    <div class="row">
                        <div class="col-md-6">
                            <h4 style="text-align:left;margin-left: 12px; ">Form</h4>
                            <div class="row" style="margin-top:30px;">
                                <h5 style="margin-left: 25px;margin-top: 2px;">Child Health Examination Form</h5>
                            </div>
                        </div> <!-- end table-responsive-->


                        <div class="col-md-6">
                            <table class="table table-bordered" style="margin-bottom: 15px;">
                                <thead>
                                    <tr>
                                        <h6>　　　　　　　　　Primary　　　　　　　　　Secondary</h6>
                                        <th colspan="2" style="text-align:center;border: 1px solid black;">Class</th>
                                        <th colspan="1" class="diagonalCross2"
                                            style="width:0px;border: 1px solid black;border-right:hidden; border-left:hidden;">
                                        </th>
                                        <th colspan="1" style="text-align:center;border: 1px solid black;">Grade</th>
                                        <th style=" border: 1px solid black;">1</th>
                                        <th style=" border: 1px solid black;">2</th>
                                        <th style=" border: 1px solid black;">3</th>
                                        <th style=" border: 1px solid black;">4</th>
                                        <th style=" border: 1px solid black;">5</th>
                                        <th style=" border: 1px solid black;">6</th>
                                        <th style=" border: 1px solid black;">1</th>
                                        <th style=" border: 1px solid black;">2</th>
                                        <th style=" border: 1px solid black;">3</th>
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
                                </tbody>
                            </table>
                        </div>

                        <div>
                        </div>



                    </div>

                    <div class="">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-responsive">
                                    <thead class="colspanHead">
                                        <tr>
                                            <td colspan="32"
                                                style="text-align:center; border: 1px solid black;vertical-align: middle;width:47%;">
                                                Student Name</td>
                                            <td colspan="2" style="text-align:left; border: 1px solid black;width:8%;">
                                            </td>
                                            <td colspan="1"
                                                style="text-align:center; border: 1px solid black;vertical-align: middle;width:8%;">
                                            </td>
                                            <td colspan="1"
                                                style="text-align:center; border: 1px solid black;vertical-align: middle;width:8%;">
                                            </td>
                                            <td colspan="1"
                                                style="text-align:center; border: 1px solid black;vertical-align: middle;border-right:hidden;">
                                            </td>
                                            <td colspan="1"
                                                style="text-align:center; border: 1px solid black;vertical-align: middle;border-right:hidden;">
                                            </td>

                                            <td colspan="10"
                                                style="text-align:center; border: 1px solid black;vertical-align: middle;">
                                            </td>



                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="26" style="width:1%;">School Name</td>
                                            <td colspan="6" style="width:20%;"></td>
                                            <td colspan="5"></td>
                                            <td colspan="5"></td>
                                        </tr>


                                    </tbody>

                                    <tbody style="border: 1px solid black;">

                                        <tr>
                                            <td colspan="26" style="text-align:center;">Age</td>
                                            <td colspan="2">6</td>
                                            <td colspan="2">7</td>
                                            <td colspan="2">8</td>
                                            <td colspan="2">9</td>
                                            <td colspan="2">10</td>
                                            <td colspan="2">11</td>
                                            <td colspan="2">12</td>
                                            <td colspan="2">13</td>
                                            <td colspan="2">14</td>
                                        </tr>

                                        <tr>
                                            <td colspan="26" style="text-align:center;">Fiscal Year</td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="26" style="text-align:center;">Height</td>
                                            @foreach($child_health as $key=>$ch)
                                            @if($key=="height")
                                            @foreach($grade as $gr)
                                                <td colspan="2">{{$ch[$gr]}}</td>
                                            @endforeach
                                            @endif
                                            @endforeach

                                        @for($i=0;$i<$empty; $i++)
                                        <td colspan="2"></td>
                                        @endfor
                                        </tr>
                                        <tr>
                                            <td colspan="26" style="text-align:center;">Weight</td>
                                            @foreach($child_health as $key=>$ch)
                                            @if($key=="weight")
                                            @foreach($grade as $gr)
                                                <td colspan="2">{{$ch[$gr]}}</td>
                                            @endforeach
                                            @endif
                                            @endforeach

                                        @for($i=0;$i<$empty; $i++)
                                        <td colspan="2"></td>
                                        @endfor
                                        </tr>
                                        <tr>
                                            <td colspan="26" style="text-align:center;">Nutritional Status</td>
                                            @foreach($child_health as $key=>$ch)
                                            @if($key=="nutritional_status")
                                            @foreach($grade as $gr)
                                                <td colspan="2">{{$ch[$gr]}}</td>
                                            @endforeach
                                            @endif
                                            @endforeach

                                        @for($i=0;$i<$empty; $i++)
                                        <td colspan="2"></td>
                                        @endfor
                                        </tr>
                                        <tr>
                                            <td colspan="26" style="text-align:center;">Spine/Chest/Limb</td>
                                            @foreach($child_health as $key=>$ch)
                                            @if($key=="spine_chest_limb")
                                            @foreach($grade as $gr)
                                                <td colspan="2">{{$ch[$gr]}}</td>
                                            @endforeach
                                            @endif
                                            @endforeach

                                        @for($i=0;$i<$empty; $i++)
                                        <td colspan="2"></td>
                                        @endfor
                                        </tr>

                                        <tr>
                                            <td rowspan="2" style="width: 0px;">Eyesight</td>
                                            <td colspan="25" style="text-align:center;">Right</td>
                                            @foreach($child_health as $key=>$ch)
                                            @if($key=="eye_sight_right")
                                            @foreach($grade as $gr)
                                                <td colspan="2">{{$ch[$gr]}}</td>
                                            @endforeach
                                            @endif
                                            @endforeach

                                        @for($i=0;$i<$empty; $i++)
                                        <td colspan="2"></td>
                                        @endfor
                                        </tr>
                                        <tr>
                                            <td colspan="25" style="text-align:center;">Left</td>
                                            @foreach($child_health as $key=>$ch)
                                            @if($key=="eye_sight_left")
                                            @foreach($grade as $gr)
                                                <td colspan="2">{{$ch[$gr]}}</td>
                                            @endforeach
                                            @endif
                                            @endforeach

                                        @for($i=0;$i<$empty; $i++)
                                        <td colspan="2"></td>
                                        @endfor
                                        </tr>
                                        <tr>
                                            <td colspan="26" style="text-align:center;">Eye Diseases and abnormalities
                                            </td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" style="width: 0px;">Hearing</td>
                                            <td colspan="25" style="text-align:center;">Right</td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2" style="background-color:#00000014;"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2" style="background-color:#00000014;"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1" style="background-color:#00000014;"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="25" style="text-align:center;">Left</td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2" style="background-color:#00000014;"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2" style="background-color:#00000014;"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1" style="background-color:#00000014;"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="26" style="text-align:center;">Otorhinolaryngopathy</td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="26" style="text-align:center;">Skin Diseases</td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" style="width: 0px;">Tuberculosis</td>
                                            <td colspan="25" style="text-align:center;">Diseases and abnormalities</td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="25" style="text-align:center;">Instruction Category</td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" style="width: 0px;">Heart</td>
                                            <td colspan="25" style="text-align:center;">Clinical Medical Examination
                                            </td>
                                            <td colspan="2"></td>
                                            <td colspan="2" style="background-color:#00000014;"></td>
                                            <td colspan="2" style="background-color:#00000014;"></td>
                                            <td colspan="2" style="background-color:#00000014;"></td>
                                            <td colspan="1" style="background-color:#00000014;"></td>
                                            <td colspan="2" style="background-color:#00000014;"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1" style="background-color:#00000014;"></td>
                                            <td colspan="2" style="background-color:#00000014;"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="25" style="text-align:center;">Diseases and abnormalities</td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                        </tr>

                                        <tr>
                                            <td rowspan="3" style="width: 0px;">Urine</td>
                                            <td colspan="25" style="text-align:center;">Protein</td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="25" style="text-align:center;">Glucose</td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="25" style="text-align:center;">Glucose</td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="26" style="text-align:center;">Other Diseases and abnormalities
                                            </td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" style="width: 0px;">School Doctors</td>
                                            <td colspan="25" style="text-align:center;">Findings</td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="25" style="text-align:center;">Data</td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="26" style="text-align:center;">Follow Up Treatments</td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="26" style="">Remark</td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                            <td colspan="2"></td>
                                            <td colspan="1"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                    </tbody>
                                </table>


                            </div> <!-- end table-responsive-->
                            <div>
                            </div>

                            <div>
                            </div>
                        </div>
                    </div>

            </tr>
        </table>
</body>

</html>