<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;

use DateTime;
use DateInterval;
use DatePeriod;
use DateTimeZone;
use PDF;
use Dompdf\Exception;

use Illuminate\Support\Facades\Log;

class YorokuPdfController extends Controller
{
	
	public function downprimaryform1($id)
	{
		ini_set('max_execution_time', 600);
		ini_set('memory_limit', '1024M');
		//dd($student_id);
		$footer_text = session()->get('footer_text');
		$sdata = [
			'id' => $id,

		];
		$getstudent = Helper::PostMethod(config('constants.api.student_details'), $sdata);
		$student = $getstudent['data']['student'];
		$data = [
			'id' => $id,
			'department_id' => $student['department_id'],
		];
		$prev = json_decode($getstudent['data']['student']['previous_details']);
		$school_name = $prev->school_name;
		$pdata = [
			'id' => $student['father_id'],
		];
		$getparent = Helper::PostMethod(config('constants.api.parent_details'), $pdata);
		$getclasssec = Helper::PostMethod(config('constants.api.studentclasssection'), $data);
		$parent = $getparent['data']['parent'];

		$fonturl = storage_path('fonts/ipag.ttf');
		$output = "<!DOCTYPE html>";
		$output .= "<html><head>";
		$output .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
		$output .= '<style>';
		// $test .='* { font-family: DejaVu Sans, sans-serif; }';
		$output .= '@font-face {
                font-family: ipag;
                font-style: normal;
                font-weight: normal;
                src: url("' . $fonturl . '");
            } 
            body{ font-family: ipag !important;}
			.table {
            width: 100%;
            margin-bottom: 1px;
            color: black;
            text-align: center; border-collapse: collapse;
			}
			
			.table-bordered td,
			.table-bordered th {
            border: 1px solid black;
            text-align: center;
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
			</style>';
		$output .= "</head>";
		$output .= "<body>";
		$output .= '<main><p style=" text-align:center">小　学　校　児　童　指　導　要　録</p>
			<p class="float-left">様式１（学籍に関する記録）</p>
			<table class="table" width="100%">
			<tr>
			<td class="content-wrap aligncenter" style="margin: 0;padding: 20px;align=center">	
			<table class="table table-bordered">
			<thead>
			<tr>
			<td>' . $student['first_name'] . ' ' . $student['last_name'] . '</td>
			</tr>
			<tr>
			<td>' . $student['attendance_no'] . '</td>
			</tr>
			</thead>
			</table>
			</td>
			<td>
			<table class="table table-bordered" style="margin-bottom: 15px;">
			<thead>
			<tr>
			<td  colspan="2" style="text-align:center;width:50px;border: 1px solid black;">区分</td>
			<td colspan="1" class="diagonalCross2" style="width:50px;border: 1px solid black;border-right:hidden; border-left:hidden;"></td>
			<td  colspan="1" style="text-align:center;border: 1px solid black;">学年</td>
			';
		$getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
		//dd('$getgrade');
		foreach ($getgrade['data'] as $grade) {

			$output .= ' <td style=" border: 1px solid black;">' . $grade['name_numeric'] . '</td>';
		}

		$output .= '</tr>
			
			</thead>
			<tbody>
			<tr>
			<td colspan="4">学●   ●級</td>';
		foreach ($getclasssec['data'] as $sec) {

			$output .= '<td> ' . $sec['section'] . '</td>';
		}
		$output .= '</tr>
			<tr>
			<td colspan="4">整 理 番 号</td>
			';
		foreach ($getclasssec['data'] as $sec) {

			$output .= '<td> ' . $sec['studentPlace'] . '</td>';
		}
		$output .= '
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			<tr>
			<td colspan="2">
			<table class="table table-bordered">
			<thead class="colspanHead">
			<tr>
			<td colspan="15" style="text-align:center; border: 1px solid black;">学　　　　籍　　　　の　　　　記　　　　録</td>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td rowspan="2">児童</td>
			<td>ふりがな  氏名</td>
			<td colspan="3">' . $student['first_name'] . ' ' . $student['last_name'] . '<br>
			
			' . $student['birthday'] . '<br></td>
			<td colspan="">性 別</td>
			<td colspan="">' . $student['gender'] . '</td>
			<td colspan="3">入学前の経歴</td>
			<td colspan="5">' . $school_name . '</td>
			</tr>
			<tr>
			<td>現住所</td>
			<td colspan="5">' . $student['current_address'] . '</td>
			<td colspan="3">入学・編入学等</td>
			<td colspan="5"></td>
			</tr>
			<tr>
			<td rowspan="3">保護者</td>
			<td>ふりがな 氏名</td>
			<td colspan="5">' . $parent['first_name'] . ' ' . $parent['last_name'] . '</td>
			<td colspan="3">退　学　等</td>
			<td colspan="5"></td>
			</tr>
			
			<tr style="height:70px">
			<td rowspan="2">現住所</td>
			<td rowspan="2" colspan="5">' . $parent['address'] . ',' . $parent['address_2'] . ',' . $parent['city'] . ',' . $parent['state'] . ',' . $parent['post_code'] . ',' . $parent['country'] . '</td>
			<td colspan="3">卒業</td>
			<td colspan="5"></td>
			</tr>
			<tr>
			<td colspan="3" style="height:70px">進学先</td>
			<td colspan="5"></td>
			</tr>
			</tbody>
			</table>
			<table class="table table-bordered">
			<tr>
			<td colspan="4" style="width:90px">学校名
            及び
            所在地</td>';

		$bdata = [
			'id' => session()->get('branch_id'),
		];
		$getbranch = Helper::PostMethod(config('constants.api.branch_details'), $bdata);
		//dd($getbranch);
		$output .= '<td colspan="7">在マレーシア日本国大使館附属・クアラルンプール日本人会日本人学校<br>
            The Japanese School of Kuala Lumpur<br>
            Saujana Resort Seksyen U2, 40150 Shah Alam, Selangor Darul Ehsan, Malaysia<br>
            Tel: 03-78465939         Fax: 03-78465949

			</td>
			</tr>
			</table>
			<table class="table table-bordered">
			<tr>
			<td class="diagonal" style="width:122px;border-bottom:hidden">
			<span class="lb">年度</span>
			<span class="rt"></span>
			<div class="line"></div>
			</td>';
		foreach ($getclasssec['data'] as $ac) {

			$output .= ' <td style=" border: 1px solid black;">' . $ac['academic_year'] . '</td>';
		}

		$output .= '
			
			</tr>
			<tr>
			<td>学年</td>';
		foreach ($getgrade['data'] as $grade) {

			$output .= ' <td style=" border: 1px solid black;">' . $grade['name_numeric'] . '</td>';
		}

		$output .= '
			</tr>
			<tr style="height:80px">
			<td>校長氏名印</td>';
		foreach ($getclasssec['data'] as $princ) {
			$output .= ' <td style=" border: 1px solid black;">' . $princ['principal'] . '</td>';
		}

		$output .= '
			
			</tr>
			<tr style="height:80px">
			<td>学級担任者
            氏名印</td>';
		foreach ($getclasssec['data'] as $teach) {
			$output .= ' <td style=" border: 1px solid black;">' . $teach['teacher'] . '</td>';
		}

		$output .= '
			</tr>
			
			</table>
			</td>
			</tr>
			
			</table></main>';

		$output .= '</body></html>';
		$pdf = \App::make('dompdf.wrapper');
		// set size
		$customPaper = array(0, 0, 792.00, 1224.00);
		$pdf->set_paper($customPaper);
		$pdf->loadHTML($output);
		// filename
		$now = now();
		$name = strtotime($now);
		$fileName = __('messages.download_form1') . "-" . $name . ".pdf";
		return $pdf->download($fileName);
		// return $pdf->stream();        

	}

	public function downsecondaryform1($id)
	{
		$student_id = $id;
		$sdata = [
			'id' => $id,
		];

		$getstudent = Helper::PostMethod(config('constants.api.student_details'), $sdata);
		$student = $getstudent['data']['student'];
		$prev = json_decode($getstudent['data']['student']['previous_details']);
		$data = [
			'id' => $id,
			'department_id' => $student['department_id'],
		];
		$school_name = $prev->school_name;
		$pdata = [
			'id' => $student['father_id'],
		];
		$getparent = Helper::PostMethod(config('constants.api.parent_details'), $pdata);
		$parent = $getparent['data']['parent'];
		//dd($student);
		$footer_text = session()->get('footer_text');
        $getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
		$getclasssec = Helper::PostMethod(config('constants.api.studentclasssection'), $data);

		$fonturl = storage_path('fonts/ipag.ttf');
		$output = '<!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="utf-8" />
            <title>Secondary_yoroku_form1</title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="description" content="Paxsuzen School is a premier educational institution that offers quality education to students of all ages. Our curriculum is designed to prepare future leaders for success in the global marketplace.">
            <meta name="keywords" content="Paxsuzen School, education, future leaders, curriculum">
            <meta content="Paxsuzen" name="author" />
            <style>
                ';
                $output .='@font-face {
                font-family: Open Sans ipag;
                font-style: normal;
                font-weight: 300;
                src: url("' . $fonturl . '");
                }
                body 
                {
                    font-family: "ipag", "Open Sans", !important;
                }
       .table {
                    width: 100%;
                    
                    color: black;
                    text-align: center;
                    border-collapse: collapse; /* Ensures borders are collapsed */
                    border: 3px solid black;
                }
                
            .table {
                width: 100%;
                margin-bottom: 1px;
                color: black;
                text-align: center;
                border-collapse: collapse; /* Ensures borders are collapsed */
                border: 3px solid black;
            }
            
            .table th, .table td {
                text-align: center;
                padding: 10px; /* Add padding for better spacing */
                border: 2px solid black;
            }
            
        
        

            .diagonalCross2 {
                background: linear-gradient(to top right, #fff calc(50% - 1px), black, #fff calc(50% + 1px));
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
            /* bottom: 2px;
            left: 2px; */
            }
            
            .diagonal span.rt {
            /* top: 2px;
            right: 2px; */
            }
            /* .diagonalCross2 {
            background: linear-gradient(to top right, #fff calc(50% - 1px), black , #fff calc(50% + 1px) )
            } */
            table .cell-left {
            border-right: 0;
            }
            
            table .cell-middle {
            border-left: 0;
            border-right: 0;
            background-image: url(slash.png);
            background-position: center center;
            }
            
            table .cell-right {
            border-left: 0;
            }
             .diagonalCross 
                {
                    position: relative;
                    padding: 10px;
                    border: none;
                    text-align: center;
                }
                .diagonalCross::after 
                {
                    content: "";
                    position: absolute;
                    width: 2px; /* Thickness of the lines */
                    height: 3.6%;
                    background-color: black; /* Color of the lines */
                    top: 0;
                    left: 0%;
                    transform-origin: center;
                }
                .diagonalCross::after 
                {
                    transform: rotate(-45deg);
                }
                .content 
                {
                    box-sizing: border-box;
                    display: block;
                    margin: 0 auto;
                    padding: 20px;
                    border-radius: 7px;
                    background-color: #fff;
                    border: 1px solid #dddddd;
                    font-size: 15px;
                }

        </style>
        
        <body>
<div class="content">
<p style="text-align:center;">中　学　校　生　徒　指　導　要　録　</p>
<p style="padding: 20px; float: left;">様式１（学籍に関する記録)</p>
<table class="main" width="100%" style="font-size: 14px;">
    <tr>
        <td class="content-wrap aligncenter" style="padding: 20px;" >
            <table class="table table-bordered" align="right"
                style="margin-bottom: 15px; width: 40%; border: 2px solid black;">
                <thead>                            
                    <tr>
                        <td>区分</td>
                        <td class="diagonalCross" style="border-right:hidden; border-left:hidden;"></td>
                        <td>学年</td>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3">学 級 </td>';
                        $c=0;
                        foreach ($getclasssec['data'] as $sec) {
                        $c++;
                        if($c<=3)
                        {
			$output .= '<td> ' . $sec['section'] . '</td>';
                        }
		                }
                    $output .= '</tr>
                    <tr>
                        <td colspan="3">整理番号</td>';
                       $c=0;
                        foreach ($getclasssec['data'] as $sec) {
                        $c++;
                        if($c<=3)
                        {
			$output .= '<td> ' . $sec['studentPlace'] . '</td>';
                        }
		                }
                        $output .='</tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <thead class="colspanHead">
                    <tr>
                        <td colspan="13" style="text-align:center; border: 2px solid black;">学 籍 の 記 録</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="6" style="padding:0px !important">生 <br>徒</td>
                        <td style="padding:0px !important">ふりがな</td>
                        <td colspan="6" style="width:100px"></td>
                        <td rowspan="2" style="padding:0px !important">性 <br>別</td>
                        <td rowspan="2" style="padding:0px !important">' . $student['gender'] . '</td>
                        <td rowspan="3" colspan="2" >入学・編入学等</td>
                        <td rowspan="2" >入学 編入学</td>
                    </tr>
                    <tr>
                        <td>氏 名</td>
                        <td colspan="6"> ' . $student['first_name'] . ' ' . $student['last_name'] . '</td>
                    </tr>
                    <tr> 
                        <td rowspan="2">生年月日</td>
                        <td rowspan="2" colspan="8">' . $student['birthday'] . '</td>
                        <td style="border-top:hidden; font-size: 10px; text-align: left;" align="left">編入前<br>在学校名</td>
                    </tr>
                    
                    <tr>                       
                        <td  colspan="2" >転 入 学</td>
                        <td >年 月 日 第 学年転入学</td>
                    </tr>
                    <tr>
                        <td rowspan="2">現住所</td>
                        <td rowspan="2" colspan="8"> ' . $student['current_address'] . '</td>
                        <td  colspan="2" style="border-top:hidden"></td>
                        <td style="border-top:hidden;"></td>
                    </tr>
                    <tr>
                        <td rowspan="7" style="padding:0px !important">転学 <br>• <br> 退学等</td>
                        
                        <td style="padding:0px !important">転学するため学校 <br>を去った年月日</td>
                        <td ></td>
                    </tr>
                    <!-- 2nd row -->
                    <tr>
                        <td rowspan="5" style="padding:0px !important">保 <br>護<br>者</td>
                        <td >ふりがな</td>
                        <td colspan="8" ></td>    
                        <td rowspan="2" >退学等年月日<br>（除籍日)</td>
                        <td rowspan="2"></td>                    
                    </tr>
                    
                    <tr>
                        <td rowspan="2">氏 名</td>
                        <td colspan="8" rowspan="2"> ' . $parent['first_name'] . ' ' . $parent['last_name'] . '</td>
                      
                    </tr>
                    <tr>

                        <td>転学先学校名</td>
                        <td ></td>
                    </tr>
                    <tr>
                        <td rowspan="2" >現住所</td>
                        <td colspan="8" rowspan="2" > ' . $parent['address'] . ',' . $parent['address_2'] . ',' . $parent['city'] . ',' . $parent['state'] . ',' . $parent['post_code'] . ',' . $parent['country'] . '</td>
                        <td>同上所在地</td>
                        <td ></td>
                    </tr>
                    <tr>
                        <td>転入学年</td>
                        <td ></td>
                    </tr>
                    
                    <!-- <tr>                               
                        <td>事 由</td>
                        <td ></td>
                    </tr> -->
                    <!-- 3rd row -->
                    <tr>
                        <td rowspan="3" colspan="2">入学前の経歴</td>
                        <td colspan="8" rowspan="3"></td>
                        <td>事 由</td>
                        <td ></td>
                    </tr>
                    <tr>
                        <td colspan="2">卒 業</td>
                        <td ></td>
                    </tr>
                    <tr>                       
                        <td colspan="2">　進　学　先 <br> 　就　職　先　等</td>
                        <td ></td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td colspan="4" style="width:78px">学 校 名及 び所 在 地
                        （分校名・所在地等)</td>
                    <td colspan="7">在マレーシア日本国大使館附属・クアラルンプール日本人会日本人学校<br>
                        The Japanese School of Kuala Lumpur<br>
                        Saujana Resort Seksyen U2, 40150 Shah Alam, Selangor Darul Ehsan,
                        Malaysia<br>
                        Tel: 03-78465939 Fax: 03-78465949<br>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td colspan="3" style="width:104px;">年 度</td>';
                    $c=0;
                   foreach ($getclasssec['data'] as $ac) {
                    $c++;
                    if($c<=3)
                    {
			$output .= ' <td style=" border: 1px solid black;">' . $ac['academic_year'] . '</td>';
                    }
		}
               $output .= ' </tr>
                <tr>
                    <td class="cell-left">区分</td>
                    <td class="diagonalCross" style="border-right:hidden; border-left:hidden;"></td>
                    <td class="cell-right">学年</td>

                    <td>第1学年</td>
                    <td>第2学年</td>
                    <td>第3学年</td>
                </tr>
                <tr style="height:80px">
                    <td colspan="3">校長氏名印</td>';
                    $c=0;
		foreach ($getclasssec['data'] as $princ) {
            $c++;
            if($c<=3)
            {
			$output .= ' <td style=" border: 1px solid black;">' . $princ['principal'] . '</td>';
            }
		}

		$output .= '</tr>
                <tr style="height:80px">
                    <td colspan="3">学級担任者氏 名 印</td>';
                    $c=0;
		foreach ($getclasssec['data'] as $teach) {
            $c++;
            if($c<=3)
            {
			$output .= ' <td style=" border: 1px solid black;">' . $teach['teacher'] . '</td>';
            }
		}

		$output .= '</tr>
            </table>
        </td>
    </tr>
</table>
</div>
</body>
</html>';
		$pdf = \App::make('dompdf.wrapper');
		// set size
		$customPaper = array(0, 0, 792.00, 1224.00);
		$pdf->set_paper($customPaper);
		$pdf->loadHTML($output);
		// filename
		$now = now();
		$name = strtotime($now);
		$fileName = __('messages.download_form1') . $name . ".pdf";
		return $pdf->download($fileName);
		// return $pdf->stream();


	}
	public function downloadpriYorokuform2ab($id)
	{
		$student_id = $id;
		$footer_text = session()->get('footer_text');
		$sdata = [
			'id' => $id,
		];
		$getstudent = Helper::PostMethod(config('constants.api.student_details'), $sdata);
		$student = $getstudent['data']['student'];
		//dd($student);
		$data = [
			'id' => $id,
			'department_id' => $student['department_id'],
		];

		$getclasssec = Helper::PostMethod(config('constants.api.studentclasssection'), $data);
		$fonturl = storage_path('fonts/ipag.ttf');
		$output = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8" />
            <title>Primary_yoroku_form2_A & Primary_yoroku_form2_B</title>
          
            <style>
                ';
                $output .='@font-face {
                font-family: Open Sans ipag;
                font-style: normal;
                font-weight: 300;
                src: url("' . $fonturl . '");
                }
                body 
                {
                    font-family: "ipag", "Open Sans", !important;
                }
 .table {
                    width: 100%;
                    color: black;
                    text-align: center;
                    border-collapse: collapse; /* Ensures borders are collapsed */
                    border: 3px solid black;
                }
                .table {
                    width: 100%;
                    color: black;
                    text-align: center;
                    border-collapse: collapse; /* Ensures borders are collapsed */
                    border: 3px solid black;
                }
                
                .table th, .table td {
                    text-align: center;
                    padding: 4px; /* Add padding for better spacing */
                    border: 2px solid black;
                    
                }
                .table td
                {
                    color: #3A4265;
                }
                .diagonalCross 
                {
                    position: relative;
                    padding: 10px;
                    border: none;
                    text-align: center;
                }
                .diagonalCross::after 
                {
                    content: "";
                    position: absolute;
                    width: 2px; /* Thickness of the lines */
                    height: 2.5%;
                    background-color: black; /* Color of the lines */
                    top: 0;
                    left: 0%;
                    transform-origin: center;
                }
                .diagonalCross::after 
                {
                    transform: rotate(-45deg);
                }
                .content 
                {
                    box-sizing: border-box;
                    display: block;
                    margin: 0 auto;
                    padding: 20px;
                    border-radius: 7px;
                    background-color: #fff;
                    border: 1px solid #dddddd;
                    font-size: 14px;
                }
   
                    </style>
    <body>
        <div class="content">              
            <table class="main" width="100%">
                <tr>
                    <td class="content-wrap aligncenter" style="margin: 0;padding: 20px;text-align:center">
                       <p style="margin:0px; font-size:12px; text-align:left;"> 様式２（指導に関する記録）</p>
                        <table class="table table-bordered" width="100%" style="margin-bottom: 15px; ">
                            <thead>
                                <tr>
                                    <td>' . $student['first_name'] . ' ' . $student['last_name'] . '</td>
                                    <td>学　校　名</td>
                                    <td colspan="2" style="text-align:center;border: 1px solid black;">区分</td>
                                    <td colspan="1" class="diagonalCross"
                                        style="border: 2px solid black;border-right:hidden; border-left:hidden;"></td>
                                    <td colspan="1" style="text-align:center;border: 1px solid black;">学年</td>';
                                    $getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
		//dd($getgrade);
		$totgrade = ($student['department_id']==1)?'6':'3';
        $c=0;
		foreach ($getgrade['data'] as $grade) {
          $c++;
          if($c<=$totgrade)
          {
			//dd($grade);
			$output .= ' <td style=" border: 1px solid black;">' . $grade['name_numeric'] . '</td>';
          }
		}
                $output .= '</tr>
            </thead>
            <tbody>
                <tr>                          
                <td rowspan="2"></td>             
                    <td rowspan="2" >在マレーシア日本国大使館附属<br>
                    クアラルンプール日本人会日本人学校</td>
                    <td colspan="4">学　　級</td>';
                    foreach ($getclasssec['data'] as $sec) {

                    $output .= '<td> ' . $sec['section'] . '</td>';
                }
                $output .= ' </tr>
                <tr>
                    <td colspan="4">整理番号</td>';
                    foreach ($getclasssec['data'] as $sec) {

                        $output .= '<td> ' . $sec['studentPlace'] . '</td>';
                    }
                    $output .= '</tr>
            </tbody>
        </table>';
        $language = "国語";
		$math = '算数';
		$life = '生活';
		$music = '音楽';
		$art = '図工';
		$sport = '体育';
		$science = "理科";
		$socity = "社会";
		$homeeconomics = "家庭科";
		$foreignlanguage = "外国語";
		$english = "英語";
		$tech_homeeconomics = "技術・家庭科";


		$primarypaper1 = "知識・技能"; //Knowledge & Skills
		$primarypaper2 = "思考・判断・表現"; //Thinking, Judgment, and Expression
		$primarypaper3 = "主体的に学習に取り組む態度"; //Attitude to proactive learning
		$primarypaper4 = "評定"; // Rate / Rating

		$specialsubject1 = "特別の教科 道徳"; // Special Subject: Morality                     
		$specialsubject2 = "外 国 語 活 動"; // Foreign Language Activities
		$specialsubject3 = "総合"; // Comprehensive study time notes
		$specialsubject4 = "特 別 活 動 等 の 記 録"; // Records of special activities, etc
		$sp_paper1 = "学習活動"; // Learning and Activities
		$sp_paper2 = "観点";  //Perspectives
		$sp_paper3 = "評価";   //Rate  
		$sp_paper4 = "学級活動";   //Classroom Activities  
		$sp_paper5 = "生徒会活動";   //Student Council Activities  
		$sp_paper6 = "学校行事";   //School Event  
		$sp_paper7 = "児童会活動";   //Children's Association Activities    
		$sp_paper8 = "クラブ活動";   //Club Activities  

		if ($student['department_id'] == 1) // Primary 
		{

			$getprimarysubjects = array($language, $socity, $math, $science, $life, $music, $art, $homeeconomics, $sport, $foreignlanguage);
			$getprimarypapers = array($primarypaper1, $primarypaper2, $primarypaper3, $primarypaper4);
			$getspsubject1 = array($specialsubject1); // Special Subject: Morality ( 3rd Semester)  
			$getspsubject2 = array($specialsubject2); // Foreign Language Activities ( 3rd Semester)              
			$getspsubject3 = array($specialsubject3); // Comprehensive study time notes (3rd Semester )
			$getspsubject4 = array($specialsubject4); // Findings  ( 3rd Semester)  
			$specialsubject1papers = array("学習状況及び道徳性に係る成長の様子"); // Progress in learning and morality
			$specialsubject2papers = array($primarypaper1, $primarypaper2, $primarypaper3);
			$specialsubject3papers = array($sp_paper1, $sp_paper2, $sp_paper3);
			$specialsubject4papers = array($sp_paper4, $sp_paper7, $sp_paper8, $sp_paper6);
            $colspan=10;
		}
        
                        $output.='<table  width="100%" style="border:none;">
           
                                <tr>
                                <td style="width:50%">
                                <table class="table table-bordered">
                                <thead >
                                    <tr>
                                        <td colspan="'.$colspan.'" style="text-align:center; font-size: 14px; border: 2px solid black;">
                                        <p style="color:black; margin:0px 0px 0px 0px; letter-spacing:0; white-space:nowrap;height:40px;">各　教　科　の　学　習　の　記　録</p></td>
                                        </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td style="padding:0px !important">教科</td>
                                    <td style="width:12%;">観　　点</td>
                                    <td class="" style="width: 35%;border-right:hidden; border-left:hidden;"> </td>
                                    <td>学　　年</td>';
                                     $c=0;
                                foreach ($getgrade['data'] as $grade) {
                                $c++;
                                if($c<=$totgrade)
                                {
                                    //dd($grade);
                                    $output .= ' <td>' . $grade['name_numeric'] . '</td>';
                                }
                                }
                                   
                               $output .= ' </tr>';
                                foreach ($getprimarysubjects as $subject) {

                                    $n = count($getprimarypapers);
                                    $i = 0;
                                    foreach ($getprimarypapers as $papers) {
                                        $i++;
                        
                                        $output .= ' <tr>';
                                        if ($i == 1) {
                                            $output .= '<td rowspan="4" style="padding:0px">';
                                            $subject_chars = preg_split('//u', $subject, null, PREG_SPLIT_NO_EMPTY);
                                            foreach ($subject_chars as $char) {
                                                $output .= '<span style="display: inline-block; transform: rotate(0deg);">' . $char . '</span><br>';
                                            }
                                            $output .= '</td>';
                                        }
                                        $output .= '<td  style="text-align:left;" colspan="3">' . $papers . '</td>';
                        
                                        foreach ($getclasssec['data'] as $sec) {
                                            if ($sec['class_id'] == '') {
                                                $fmark = '';
                                            } else {
                                                $pdata = [
                                                    'branch_id' => session()->get('branch_id'),
                                                    'department_id' => $student['department_id'],
                                                    'class_id' =>  $sec['class_id'],
                                                    'section_id' =>  $sec['section_id'],
                                                    'academic_session_id' => $sec['academic_session_id'],
                                                    'student_id' => $student['id'],
                                                    'subject' => $subject,
                                                    'paper' => $papers,
                        
                                                ];
                                                $getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist1'), $pdata);
                        
                                                $mark = $getmarks['data'] ?? '';
                                                $fmark = '';
                        
                                                $fmark = (isset($mark['grade']) && $mark['grade'] != null) ? $mark['grade'] : '';
                                            }
                                            $output .= ' <td>' . $fmark . '</td>';
                                        }
                        
                        
                                        if ($i == $n) {
                                            $output .= '</tr>';
                                        }
                                    }
                                }
                        
                        
                            $output .= '</tbody>        
                        </table>
                        </td>
                        <td style="width:50%">';


		foreach ($getspsubject1 as $subject) {

			$n = count($specialsubject1papers);
			$output .= '<table class="table table-bordered specialtable">
			<thead class="colspanHead">
			<tr>
			
			<td colspan="' . ($n + 1) . '" style="text-align:center; border: 1px solid black;height:40px;">
			' . $subject . '
			</td>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td colspan="1">学年</td>';
			foreach ($specialsubject1papers as $papers) {
				$output .= '<td colspan="1">' . $papers . '</td>';
			}
			$output .= '</tr>';


			foreach ($getclasssec['data'] as $sec) {
				$output .= '<tr >
				<td style="height:40px;">' . $sec['class_numeric'] . '</td>';

				foreach ($specialsubject1papers as $papers) {
					if ($sec['class_id'] == '') {
						$output .= '<td  colspan="1"  ></td>';
					} else {
						$pdata = [
							'branch_id' => session()->get('branch_id'),
							'department_id' => $student['department_id'],
							'class_id' =>  $sec['class_id'],
							'section_id' =>  $sec['section_id'],
							'academic_session_id' => $sec['academic_session_id'],
							'student_id' => $student['id'],
							'subject' => $subject,
							'paper' => $papers,

						];
						$getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist1'), $pdata);

						$mark = $getmarks['data'];
						$fmark = '';
						if (isset($mark['score_type']) && $mark['score_type'] == 'Points') {
							$fmark = (isset($mark['grade_name']) && $mark['grade_name'] != null) ? $mark['grade_name'] : '';
						} elseif (isset($mark['score_type']) && $mark['score_type'] == 'Freetext') {
							$fmark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
						} elseif (isset($mark['score_type']) && $mark['score_type'] == 'Grade') {
							$fmark = (isset($mark['grade']) && $mark['grade'] != null) ? $mark['grade'] : '';
						} else {
							$fmark = (isset($mark['score']) && $mark['score'] != null) ? $mark['score'] : '';
						}


						$output .= '<td  colspan="1"  >' . $fmark . '</td>';
					}
				}
				$output .= '</tr>';
			}
			$output .= '
			</tbody>
			</table>';
		}
		if ($student['department_id'] == 1) {
			foreach ($getspsubject2 as $subject) {

				$n = count($specialsubject2papers);
				$output .= '<br><table class="table table-bordered specialtable">
			<thead class="colspanHead">
			<tr>
			
			<td colspan="' . ($n + 1) . '" style="text-align:center; border: 1px solid black;height:40px;">
			' . $subject . '
			</td>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td colspan="1">学年</td>';
				foreach ($specialsubject2papers as $papers) {
					$output .= '<td colspan="1">' . $papers . '</td>';
				}
				$output .= '</tr>';


				foreach ($getclasssec['data'] as $sec) {
					if ($sec['class_numeric'] == 3 || $sec['class_numeric'] == 4) {
						$output .= '<tr >
				<td style="height:40px;">' . $sec['class_numeric'] . '</td>';

						foreach ($specialsubject2papers as $papers) {
							if ($sec['class_id'] == '') {
								$output .= '<td  colspan="1"  ></td>';
							} else {
								$pdata = [
									'branch_id' => session()->get('branch_id'),
									'department_id' => $student['department_id'],
									'class_id' =>  $sec['class_id'],
									'section_id' =>  $sec['section_id'],
									'academic_session_id' => $sec['academic_session_id'],
									'student_id' => $student['id'],
									'subject' => $subject,
									'paper' => $papers,

								];
								$getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist1'), $pdata);

								$mark = $getmarks['data'];
								$fmark = '';
								if (isset($mark['score_type']) && $mark['score_type'] == 'Points') {
									$fmark = (isset($mark['grade_name']) && $mark['grade_name'] != null) ? $mark['grade_name'] : '';
								} elseif (isset($mark['score_type']) && $mark['score_type'] == 'Freetext') {
									$fmark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
								} elseif (isset($mark['score_type']) && $mark['score_type'] == 'Grade') {
									$fmark = (isset($mark['grade']) && $mark['grade'] != null) ? $mark['grade'] : '';
								} else {
									$fmark = (isset($mark['score']) && $mark['score'] != null) ? $mark['score'] : '';
								}


								$output .= '<td  colspan="1"  >' . $fmark . '</td>';
							}
						}
						$output .= '</tr>';
					}
				}
				$output .= '
			</tbody>
			</table>';
			}
		}
		foreach ($getspsubject3 as $subject) {

			$n = count($specialsubject3papers);
			$output .= '<br><table class="table table-bordered specialtable">
			<thead class="colspanHead">
			<tr>
			
			<td colspan="' . ($n + 1) . '" style="text-align:center; border: 1px solid black;height:40px;">
			' . $subject . '
			</td>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td colspan="1">学年</td>';
			foreach ($specialsubject3papers as $papers) {
				$output .= '<td colspan="1">' . $papers . '</td>';
			}
			$output .= '</tr>';


			foreach ($getclasssec['data'] as $sec) {
				if ($student['department_id'] == 1 && ($sec['class_numeric'] == 3 || $sec['class_numeric'] == 4 || $sec['class_numeric'] == 5 || $sec['class_numeric'] == 6)) {
					$output .= '<tr >
				<td style="height:40px;">' . $sec['class_numeric'] . '</td>';

					foreach ($specialsubject3papers as $papers) {
						if ($sec['class_id'] == '') {
							$output .= '<td  colspan="1"  ></td>';
						} else {
							$pdata = [
								'branch_id' => session()->get('branch_id'),
								'department_id' => $student['department_id'],
								'class_id' =>  $sec['class_id'],
								'section_id' =>  $sec['section_id'],
								'academic_session_id' => $sec['academic_session_id'],
								'student_id' => $student['id'],
								'subject' => $subject,
								'paper' => $papers,

							];
							$getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist1'), $pdata);

							$mark = $getmarks['data'];
							$fmark = '';
							if (isset($mark['score_type']) && $mark['score_type'] == 'Points') {
								$fmark = (isset($mark['grade_name']) && $mark['grade_name'] != null) ? $mark['grade_name'] : '';
							} elseif (isset($mark['score_type']) && $mark['score_type'] == 'Freetext') {
								$fmark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
							} elseif (isset($mark['score_type']) && $mark['score_type'] == 'Grade') {
								$fmark = (isset($mark['grade']) && $mark['grade'] != null) ? $mark['grade'] : '';
							} else {
								$fmark = (isset($mark['score']) && $mark['score'] != null) ? $mark['score'] : '';
							}


							$output .= '<td  colspan="1"  >' . $fmark . '</td>';
						}
					}
					$output .= '</tr>';
				} elseif ($student['department_id'] == 2) {
					$output .= '<tr >
				    <td style="height:70px;">' . $sec['class_numeric'] . '</td>';

					foreach ($specialsubject3papers as $papers) {
						if ($sec['class_id'] == '') {
							$output .= '<td  colspan="1"  ></td>';
						} else {
							$pdata = [
								'branch_id' => session()->get('branch_id'),
								'department_id' => $student['department_id'],
								'class_id' =>  $sec['class_id'],
								'section_id' =>  $sec['section_id'],
								'academic_session_id' => $sec['academic_session_id'],
								'student_id' => $student['id'],
								'subject' => $subject,
								'paper' => $papers,

							];
							$getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist1'), $pdata);

							$mark = $getmarks['data'];
							$fmark = '';
							if (isset($mark['score_type']) && $mark['score_type'] == 'Points') {
								$fmark = (isset($mark['grade_name']) && $mark['grade_name'] != null) ? $mark['grade_name'] : '';
							} elseif (isset($mark['score_type']) && $mark['score_type'] == 'Freetext') {
								$fmark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
							} elseif (isset($mark['score_type']) && $mark['score_type'] == 'Grade') {
								$fmark = (isset($mark['grade']) && $mark['grade'] != null) ? $mark['grade'] : '';
							} else {
								$fmark = (isset($mark['score']) && $mark['score'] != null) ? $mark['score'] : '';
							}


							$output .= '<td  colspan="1"  >' . $fmark . '</td>';
						}
					}
					$output .= '</tr>';
				}
			}
			$output .= '
			</tbody>
			</table>';
		}
		foreach ($getspsubject4 as $subject) {

			$n = count($getclasssec['data']);
			$output .= '<br><table class="table table-bordered specialtable">
                <thead class="colspanHead">
                <tr>
                
                <td colspan="' . ($n + 2) . '" style="text-align:center; border: 1px solid black;">
                ' . $subject . '
                </td>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td colspan="1">内　容</td>
                <td colspan="1">観　点 \ 学　年</td>';
			foreach ($getclasssec['data'] as $sec) {
				$output .= '<td colspan="1">' . $sec['class_numeric'] . '</td>';
			}
			$output .= '</tr>';

			$p = 0;
			$np = count($specialsubject4papers);
			foreach ($specialsubject4papers as $papers) {
				$p++;

				$output .= '<tr >
				<td style="height:60px;">' . $papers . '</td>';
				if ($p == 1) {
					$output .= '
                    <td rowspan="' . $np . '"></td>';
				}

				foreach ($getclasssec['data'] as $sec) {
					if ($sec['class_id'] == '') {
						$output .= '<td  colspan="1"  ></td>';
					} else {
						$pdata = [
							'branch_id' => session()->get('branch_id'),
							'department_id' => $student['department_id'],
							'class_id' =>  $sec['class_id'],
							'section_id' =>  $sec['section_id'],
							'academic_session_id' => $sec['academic_session_id'],
							'student_id' => $student['id'],
							'subject' => $subject,
							'paper' => $papers

						];
						$getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist1'), $pdata);

						$mark = $getmarks['data'];
						$fmark = '';
						if (isset($mark['score_type']) && $mark['score_type'] == 'Points') {
							$fmark = (isset($mark['grade_name']) && $mark['grade_name'] != null) ? $mark['grade_name'] : '';
						} elseif (isset($mark['score_type']) && $mark['score_type'] == 'Freetext') {
							$fmark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
						} elseif (isset($mark['score_type']) && $mark['score_type'] == 'Grade') {
							$fmark = (isset($mark['grade']) && $mark['grade'] != null) ? $mark['grade'] : '';
						} else {
							$fmark = (isset($mark['score']) && $mark['score'] != null) ? $mark['score'] : '';
						}


						$output .= '<td  colspan="1"  >' . $fmark . '</td>';
					}
				}
				$output .= '</tr>';
			}
			$output .= '
			</tbody>
			</table>';
		}
        $subject1 = "行動の記録"; //Record of actions
		$subject2 = "総合"; //comprehensive
		$subject3 = "出 欠 の 記 録"; //Record of attendance
		$ra_paper1 = "基本的な生活習慣";    //		Basic lifestyle habits							
		$ra_paper2 = "健康・体力の向上";    //	Improvement of health and physical fitness								
		$ra_paper3 = "自主・自律";    //		Self-discipline							
		$ra_paper4 = "責任感";        //	Responsibility							
		$ra_paper5 = "創意工夫";    // Creativity
		$ra_paper6 = "思いやり・協力";    //		Compassion and Cooperation							
		$ra_paper7 = "生命尊重・自然愛護";    //	Respect for life and love for nature								
		$ra_paper8 = "勤労・奉仕";    //		Labor & Service							
		$ra_paper9 = "公正・公平";        //		Fairness						
		$ra_paper10 = "公共心・公徳心";    //		Public Virtue							
		$getpaperlist1 = array($ra_paper1, $ra_paper2, $ra_paper3, $ra_paper4, $ra_paper5);
		$getpaperlist2 = array($ra_paper6, $ra_paper7, $ra_paper8, $ra_paper9, $ra_paper10);
		$description = "説明";
		$remarks = "備考";
		$output .= '</td>
			</tr>
			
			</table>
			
        </div>
        <!-- Page 2 -->
        <div class="content">
        <table class="main" width="100%">
            <tr>
                <td class="content-wrap aligncenter" style="margin: 0;padding: 20px;
				align=" center">
					<table class="table table-bordered" style="margin-bottom: 30px;width: 30%;">
						<thead>
							<tr>
								<td>' . $student['first_name'] . ' ' . $student['last_name'] . '</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="height:30px;"></td>
							</tr>
						</tbody>
					</table>';
                    $totcolsp = ($student['department_id']==1)?'22':'16';
					
					$output.='<table class="table table-bordered">
						<thead class="colspanHead">
							<tr>
								<td colspan="'. $totcolsp.'" style="text-align:center; border: 1px solid black;font-size:22px;">
								<p style="color:black; margin:0px 0px 0px 0px; letter-spacing:0; white-space:nowrap;font-size:20px;">行　　　　動　　　　の　　　　　記　　　録</p></td>
							</tr>
						</thead>
						<tbody>
                            
							<tr>
                            <td colspan="'.($totcolsp/2).'"> 
                            <table class="table table-bordered">
                            <tr>
								<td colspan="1" style="text-align:center;">項　　目</td>
								<td colspan="1" class="diagonalCross" style="border-right:hidden; border-left:hidden;"></td>
								<td colspan="1" style="text-align:center;">学　　年</td>';
                                for($c=1;$c<=$totgrade;$c++)
                                {
								$output.='<td colspan="1">'.$c.'</td>';
                                }
								
								
							$output.='</tr>';
							
							
		foreach ($getpaperlist1 as $papers) {
			$output .= ' <tr>';

			$output .= '<td  style="text-align:left;" colspan="3">' . $papers . '</td>';

			foreach ($getclasssec['data'] as $sec) {

				if ($sec['class_id'] == '') {
					$output .= ' <td></td>';
				} else {
					$pdata = [
						'branch_id' => session()->get('branch_id'),
						'department_id' => $student['department_id'],
						'class_id' =>  $sec['class_id'],
						'section_id' =>  $sec['section_id'],
						'academic_session_id' => $sec['academic_session_id'],
						'student_id' => $student['id'],
						'subject' => $subject1,
						'paper' => $papers,

					];
					$getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist1'), $pdata);
					//dd($getmarks);
					$mark = $getmarks['data'];
					$fmark = '';

					$fmark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';


					$output .= ' <td>' . $fmark . '</td>';
				}
			}
			$output .= '</tr>';
            }
            $output .= '</table></td> 
            <td colspan="'.($totcolsp/2).'"> 
                            <table class="table table-bordered">
                            <tr>
								<td colspan="1" style="text-align:center;">項　　目</td>
								<td colspan="1" class="diagonalCross" style="border-right:hidden; border-left:hidden;"></td>
								<td colspan="1" style="text-align:center;">学　　年</td>';
                                for($c=1;$c<=$totgrade;$c++)
                                {
								$output.='<td colspan="1">'.$c.'</td>';
                                }
								
								
							$output.='</tr>';
							
							
		foreach ($getpaperlist2 as $papers) {
			$output .= ' <tr>';

			$output .= '<td  style="text-align:left;" colspan="3">' . $papers . '</td>';

			foreach ($getclasssec['data'] as $sec) {

				if ($sec['class_id'] == '') {
					$output .= ' <td></td>';
				} else {
					$pdata = [
						'branch_id' => session()->get('branch_id'),
						'department_id' => $student['department_id'],
						'class_id' =>  $sec['class_id'],
						'section_id' =>  $sec['section_id'],
						'academic_session_id' => $sec['academic_session_id'],
						'student_id' => $student['id'],
						'subject' => $subject1,
						'paper' => $papers,

					];
					$getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist1'), $pdata);
					//dd($getmarks);
					$mark = $getmarks['data'];
					$fmark = '';

					$fmark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';


					$output .= ' <td>' . $fmark . '</td>';
				}
			}
			$output .= '</tr>';
        }
            $output .= '</table></td></tr>
            </table>
            ';
		
		
		$output .= '<table class="table table-bordered">
			<thead class="colspanHead">
			<tr>
			<td colspan="4" style="text-align:center; border: 1px solid black;">
            総　合　所　見　及　び　指　導　上　参　考　と　な　る　諸　事　項</td>
			</tr>
			</thead>
			<tbody>';

		$output .= '<tr>';
		$k = 0;
		foreach ($getclasssec['data'] as $sec) {
			$k++;
			if ($sec['class_id'] == '') {
				$fmark = '';
			} else {
				$pdata = [
					'branch_id' => session()->get('branch_id'),
					'department_id' => $student['department_id'],
					'class_id' =>  $sec['class_id'],
					'section_id' =>  $sec['section_id'],
					'academic_session_id' => $sec['academic_session_id'],
					'student_id' => $student['id'],
					'subject' => $subject2,
					'paper' => $description,


				];
				$getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist'), $pdata);
				//dd($getmarks);
				$mark = $getmarks['data'];
				$fmark = '';

				$fmark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
			}
			$output .= '<td  style="height: 200px;width: 0px; padding-top: 45px;">第<br>' . $k . '<br>学<br>年</td>';

			$output .= ' <td>' . $fmark . '</td>';
			if ($k==6) {
				$output .= '';
			} elseif ($k % 2 == 0) {
				$output .= '</tr><tr>';
			}
		}



		$output .= '</tr>';


		$output .= '</tbody>
			</table>
                    <table class="table table-bordered">
                    <thead class="colspanHead">
                        <tr>
                            <td colspan="22" style="text-align:center;">
                            <p style="color:black; margin:0px 0px 0px 0px; letter-spacing:0; white-space:nowrap;font-size:20px;">出　　欠　　の　　記　　録</p></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="1" style="width: 0px;">学年＼区分</td>
                            <td colspan="1" style="width: 0px;">授業数</td>
                            <td colspan="1" style="width: 0px;">出席停止<br>忌引き等の日数</td>
                            <td colspan="1" style="width: 0px;">出席しなけ<br>ればならない日数</td>
                            <td colspan="1" style="width: 0px;">欠席日数</td>
                            <td colspan="1" style="width: 0px;">出席日数</td>
                            <td colspan="16" style="width: 0px;">備　　　　　　考</td>
                            
                        </tr>';
                        $data1 = [
                            'branch_id' => session()->get('branch_id'),
                            'department_id' => $student['department_id'],
                            'pdf_report' => 10 // YOROKO FORM 2B
                
                        ];
                
                        foreach ($getclasssec['data'] as $sec) {
                            $totaldays = '0';
                            $suspension = '0';
                            $totalcomimg = '0';
                            $totpres = '0';
                            $totabs = '0';
                            if ($sec['class_id'] == '') {
                                $remark = '';
                            } else {
                                $attdata = [
                                    'branch_id' => session()->get('branch_id'),
                                    'department_id' => $student['department_id'],
                                    'class_id' =>  $sec['class_id'],
                                    'section_id' =>  $sec['section_id'],
                                    'academic_session_id' => $sec['academic_session_id'],
                                    'student_id' => $student['id']
                
                                ];
                                $pdata = [
                                    'branch_id' => session()->get('branch_id'),
                                    'department_id' => $student['department_id'],
                                    'class_id' =>  $sec['class_id'],
                                    'section_id' =>  $sec['section_id'],
                                    'academic_session_id' => $sec['academic_session_id'],
                                    'student_id' => $student['id'],
                                    'subject' => $subject3,
                                    'paper' => $remarks,
                
                
                                ];
                                $getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist'), $pdata);
                                //dd($getmarks);
                                $mark = $getmarks['data'];
                
                
                                $remark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
                
                
                                $getattendance = Helper::PostMethod(config('constants.api.getsem_studentattendance'), $attdata);
                                //dd($getattendance);
                                foreach ($getattendance['data'] as $att) {
                
                                    $totaldays += $att['no_schooldays'];
                                    $suspension += $att['suspension'];
                                    $totalcomimg += $att['totalcoming'];
                                    $totpres += $att['totpres'];
                                    $totabs += $att['totabs'];
                                }
                            }
                            $output .= ' <tr>
                            <td colspan="1" style="width: 0px;">' . $sec['class_numeric'] . '</td>
                            <td colspan="1" style="width: 0px;">' . $totaldays . '</td>
                            <td colspan="1" style="width: 0px;">' . $suspension . '</td>
                            <td colspan="1" style="width: 0px;">' . $totalcomimg . '</td>
                            <td colspan="1" style="width: 0px;">' . $totabs . '</td>
                            <td colspan="1" style="width: 0px;">' . $totpres . '</td>
                            <td colspan="16" style="width: 0px;;">' . $remark . '</td>            
                            </tr>';
                        }
                        $output .= '</tbody>
                            </table>
                            
				</td>
			</tr>
		</table>
        </div>

    </body>
</html>';
      
		$pdf = \App::make('dompdf.wrapper');
		// set size
		$customPaper = array(0, 0, 792.00, 1224.00);
		$pdf->set_paper($customPaper);
		$pdf->loadHTML($output);
		// filename
		$now = now();
		$name = strtotime($now);
		$fileName = __('messages.download_form2a') . $name . ".pdf";
		return $pdf->download($fileName);
		// return $pdf->stream();
	}
	public function downloadsecYorokuform2ab($id)
	{
		$student_id = $id;
		$footer_text = session()->get('footer_text');
		$sdata = [
			'id' => $id,
		];
		$getstudent = Helper::PostMethod(config('constants.api.student_details'), $sdata);
		$student = $getstudent['data']['student'];
		//dd($student);
		$data = [
			'id' => $id,
			'department_id' => $student['department_id'],
		];

		$getclasssec = Helper::PostMethod(config('constants.api.studentclasssection'), $data);
		$fonturl = storage_path('fonts/ipag.ttf');
		$output = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8" />
            <title>Primary_yoroku_form2_A & Primary_yoroku_form2_B</title>
          
            <style>
                ';
                $output .='@font-face {
                font-family: Open Sans ipag;
                font-style: normal;
                font-weight: 300;
                src: url("' . $fonturl . '");
                }
                body 
                {
                    font-family: "ipag", "Open Sans", !important;
                }
 .table {
                    width: 100%;
                    color: black;
                    text-align: center;
                    border-collapse: collapse; /* Ensures borders are collapsed */
                    border: 3px solid black;
                }
                .table {
                    width: 100%;
                    color: black;
                    text-align: center;
                    border-collapse: collapse; /* Ensures borders are collapsed */
                    border: 3px solid black;
                }
                
                .table th, .table td {
                    text-align: center;
                    padding: 4px; /* Add padding for better spacing */
                    border: 2px solid black;
                    
                }
                .table td
                {
                    color: #3A4265;
                }
                .diagonalCross 
                {
                    position: relative;
                    padding: 10px;
                    border: none;
                    text-align: center;
                }
                .diagonalCross::after 
                {
                    content: "";
                    position: absolute;
                    width: 2px; /* Thickness of the lines */
                    height: 2.5%;
                    background-color: black; /* Color of the lines */
                    top: 0;
                    left: 0%;
                    transform-origin: center;
                }
                .diagonalCross::after 
                {
                    transform: rotate(-45deg);
                }
                .content 
                {
                    box-sizing: border-box;
                    display: block;
                    margin: 0 auto;
                    padding: 20px;
                    border-radius: 7px;
                    background-color: #fff;
                    border: 1px solid #dddddd;
                    font-size: 14px;
                }
   
                    </style>
    <body>
        <div class="content">              
            <table class="main" width="100%">
                <tr>
                    <td class="content-wrap aligncenter" style="margin: 0;padding: 20px;text-align:center">
                       <p style="margin:0px; font-size:12px; text-align:left;"> 様式２（指導に関する記録）</p>
                        <table class="table table-bordered" width="100%" style="margin-bottom: 15px; ">
                            <thead>
                                <tr>
                                    <td>' . $student['first_name'] . ' ' . $student['last_name'] . '</td>
                                    <td>学　校　名</td>
                                    <td colspan="2" style="text-align:center;border: 1px solid black;">区分</td>
                                    <td colspan="1" class="diagonalCross"
                                        style="border: 2px solid black;border-right:hidden; border-left:hidden;"></td>
                                    <td colspan="1" style="text-align:center;border: 1px solid black;">学年</td>';
                                    $getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
		//dd($getgrade);
		$totgrade = 3;
        $c=0;
		foreach ($getgrade['data'] as $grade) {
          $c++;
          if($c<=$totgrade)
          {
			//dd($grade);
			$output .= ' <td style=" border: 1px solid black;">' . $grade['name_numeric'] . '</td>';
          }
		}
                $output .= '</tr>
            </thead>
            <tbody>
                <tr>                          
                <td rowspan="2"></td>             
                    <td rowspan="2" >在マレーシア日本国大使館附属<br>
                    クアラルンプール日本人会日本人学校</td>
                    <td colspan="4">学　　級</td>';
                    foreach ($getclasssec['data'] as $sec) {

                    $output .= '<td> ' . $sec['section'] . '</td>';
                }
                $output .= ' </tr>
                <tr>
                    <td colspan="4">整理番号</td>';
                    foreach ($getclasssec['data'] as $sec) {

                        $output .= '<td> ' . $sec['studentPlace'] . '</td>';
                    }
                    $output .= '</tr>
            </tbody>
        </table>';
        $language = "国語";
		$math = '算数';
		$life = '生活';
		$music = '音楽';
		$art = '図工';
		$sport = '体育';
		$science = "理科";
		$socity = "社会";
		$homeeconomics = "家庭科";
		$foreignlanguage = "外国語";
		$english = "英語";
		$tech_homeeconomics = "技術・家庭科";


		$primarypaper1 = "知識・技能"; //Knowledge & Skills
		$primarypaper2 = "思考・判断・表現"; //Thinking, Judgment, and Expression
		$primarypaper3 = "主体的に学習に取り組む態度"; //Attitude to proactive learning
		$primarypaper4 = "評定"; // Rate / Rating

		$specialsubject1 = "特別の教科 道徳"; // Special Subject: Morality                     
		$specialsubject2 = "外 国 語 活 動"; // Foreign Language Activities
		$specialsubject3 = "総合"; // Comprehensive study time notes
		$specialsubject4 = "特 別 活 動 等 の 記 録"; // Records of special activities, etc
		$sp_paper1 = "学習活動"; // Learning and Activities
		$sp_paper2 = "観点";  //Perspectives
		$sp_paper3 = "評価";   //Rate  
		$sp_paper4 = "学級活動";   //Classroom Activities  
		$sp_paper5 = "生徒会活動";   //Student Council Activities  
		$sp_paper6 = "学校行事";   //School Event  
		$sp_paper7 = "児童会活動";   //Children's Association Activities    
		$sp_paper8 = "クラブ活動";   //Club Activities  

		
			$getprimarysubjects = array($language, $socity, $math, $science, $music, $art, $sport, $homeeconomics, $english);
			$getprimarypapers = array($primarypaper1, $primarypaper2, $primarypaper3, $primarypaper4);
			$getspsubject1 = array($specialsubject1); // Special Subject: Morality ( 3rd Semester)  
			$getspsubject2 = array(); // Foreign Language Activities ( 3rd Semester)              
			$getspsubject3 = array($specialsubject3); // Comprehensive study time notes (3rd Semester )
			$getspsubject4 = array($specialsubject4); // Findings  ( 3rd Semester)  
			$specialsubject1papers = array("学習状況及び道徳性に係る成長の様子"); // Progress in learning and morality
			$specialsubject2papers = array();
			$specialsubject3papers = array($sp_paper1, $sp_paper2, $sp_paper3);
			$specialsubject4papers = array($sp_paper4, $sp_paper5, $sp_paper6);
            $colspan=7;
		
        
                        $output.='<table  width="100%" style="border:none;">
           
                                <tr>
                                <td style="width:50%">
                                <table class="table table-bordered">
                                <thead >
                                    <tr>
                                        <td colspan="'.$colspan.'" style="text-align:center; font-size: 14px; border: 2px solid black;">
                                        <p style="color:black; margin:0px 0px 0px 0px; letter-spacing:0; white-space:nowrap;height:40px;">各　教　科　の　学　習　の　記　録</p></td>
                                        </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td style="padding:0px !important">教科</td>
                                    <td style="width:12%;">観　　点</td>
                                    <td class="" style="width: 35%;border-right:hidden; border-left:hidden;"> </td>
                                    <td>学　　年</td>';
                                     $c=0;
                                foreach ($getgrade['data'] as $grade) {
                                $c++;
                                if($c<=$totgrade)
                                {
                                    //dd($grade);
                                    $output .= ' <td>' . $grade['name_numeric'] . '</td>';
                                }
                                }
                                   
                               $output .= ' </tr>';
                               $sb=0;
                                foreach ($getprimarysubjects as $subject) {
                                $sb++;
                                if($sb<=8)
                                {
                                    $n = count($getprimarypapers);
                                    $i = 0;
                                    foreach ($getprimarypapers as $papers) {
                                        $i++;
                        
                                        $output .= ' <tr>';
                                        if ($i == 1) {
                                            $output .= '<td rowspan="4" style="padding:0px">';
                                            $subject_chars = preg_split('//u', $subject, null, PREG_SPLIT_NO_EMPTY);
                                            foreach ($subject_chars as $char) {
                                                $output .= '<span style="display: inline-block; transform: rotate(0deg);">' . $char . '</span><br>';
                                            }
                                            $output .= '</td>';
                                        }
                                        $output .= '<td  style="text-align:left;" colspan="3">' . $papers . '</td>';
                        
                                        foreach ($getclasssec['data'] as $sec) {
                                            if ($sec['class_id'] == '') {
                                                $fmark = '';
                                            } else {
                                                $pdata = [
                                                    'branch_id' => session()->get('branch_id'),
                                                    'department_id' => $student['department_id'],
                                                    'class_id' =>  $sec['class_id'],
                                                    'section_id' =>  $sec['section_id'],
                                                    'academic_session_id' => $sec['academic_session_id'],
                                                    'student_id' => $student['id'],
                                                    'subject' => $subject,
                                                    'paper' => $papers,
                        
                                                ];
                                                $getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist1'), $pdata);
                        
                                                $mark = $getmarks['data'] ?? '';
                                                $fmark = '';
                        
                                                $fmark = (isset($mark['grade']) && $mark['grade'] != null) ? $mark['grade'] : '';
                                            }
                                            $output .= ' <td>' . $fmark . '</td>';
                                        }
                        
                        
                                        if ($i == $n) {
                                            $output .= '</tr>';
                                        }
                                    }
                                }
                            }
                        
                            $output .= '</tbody>        
                        </table>
                        </td>
                        <td style="width:50%"><table class="table table-bordered">
                                <thead >
                                    <tr>
                                        <td colspan="'.$colspan.'" style="text-align:center; font-size: 14px; border: 2px solid black;">
                                        <p style="color:black; margin:0px 0px 0px 0px; letter-spacing:0; white-space:nowrap;height:40px;">各　教　科　の　学　習　の　記　録</p></td>
                                        </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td style="padding:0px !important">教科</td>
                                    <td style="width:12%;">観　　点</td>
                                    <td class="" style="width: 35%;border-right:hidden; border-left:hidden;"> </td>
                                    <td>学　　年</td>';
                                     $c=0;
                                foreach ($getgrade['data'] as $grade) {
                                $c++;
                                if($c<=$totgrade)
                                {
                                    //dd($grade);
                                    $output .= ' <td>' . $grade['name_numeric'] . '</td>';
                                }
                                }
                                   
                               $output .= ' </tr>';
                               $sb=0;
                                foreach ($getprimarysubjects as $subject) {
                                $sb++;
                                if($sb>8)
                                {
                                    $n = count($getprimarypapers);
                                    $i = 0;
                                    foreach ($getprimarypapers as $papers) {
                                        $i++;
                        
                                        $output .= ' <tr>';
                                        if ($i == 1) {
                                            $output .= '<td rowspan="4" style="padding:0px">';
                                            $subject_chars = preg_split('//u', $subject, null, PREG_SPLIT_NO_EMPTY);
                                            foreach ($subject_chars as $char) {
                                                $output .= '<span style="display: inline-block; transform: rotate(0deg);">' . $char . '</span><br>';
                                            }
                                            $output .= '</td>';
                                        }
                                        $output .= '<td  style="text-align:left;" colspan="3">' . $papers . '</td>';
                        
                                        foreach ($getclasssec['data'] as $sec) {
                                            if ($sec['class_id'] == '') {
                                                $fmark = '';
                                            } else {
                                                $pdata = [
                                                    'branch_id' => session()->get('branch_id'),
                                                    'department_id' => $student['department_id'],
                                                    'class_id' =>  $sec['class_id'],
                                                    'section_id' =>  $sec['section_id'],
                                                    'academic_session_id' => $sec['academic_session_id'],
                                                    'student_id' => $student['id'],
                                                    'subject' => $subject,
                                                    'paper' => $papers,
                        
                                                ];
                                                $getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist1'), $pdata);
                        
                                                $mark = $getmarks['data'] ?? '';
                                                $fmark = '';
                        
                                                $fmark = (isset($mark['grade']) && $mark['grade'] != null) ? $mark['grade'] : '';
                                            }
                                            $output .= ' <td>' . $fmark . '</td>';
                                        }
                        
                        
                                        if ($i == $n) {
                                            $output .= '</tr>';
                                        }
                                    }
                                }
                            }
                        
                            $output .= '</tbody>        
                        </table>';


		foreach ($getspsubject1 as $subject) {

			$n = count($specialsubject1papers);
			$output .= '<table class="table table-bordered specialtable" style="border-top:none;">
			<thead class="colspanHead">
			<tr>
			
			<td colspan="' . ($n + 1) . '" style="text-align:center; border: 1px solid black;height:40px;">
			' . $subject . '
			</td>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td colspan="1">学年</td>';
			foreach ($specialsubject1papers as $papers) {
				$output .= '<td colspan="1">' . $papers . '</td>';
			}
			$output .= '</tr>';


			foreach ($getclasssec['data'] as $sec) {
				$output .= '<tr >
				<td style="height:40px;">' . $sec['class_numeric'] . '</td>';

				foreach ($specialsubject1papers as $papers) {
					if ($sec['class_id'] == '') {
						$output .= '<td  colspan="1"  ></td>';
					} else {
						$pdata = [
							'branch_id' => session()->get('branch_id'),
							'department_id' => $student['department_id'],
							'class_id' =>  $sec['class_id'],
							'section_id' =>  $sec['section_id'],
							'academic_session_id' => $sec['academic_session_id'],
							'student_id' => $student['id'],
							'subject' => $subject,
							'paper' => $papers,

						];
						$getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist1'), $pdata);

						$mark = $getmarks['data'];
						$fmark = '';
						if (isset($mark['score_type']) && $mark['score_type'] == 'Points') {
							$fmark = (isset($mark['grade_name']) && $mark['grade_name'] != null) ? $mark['grade_name'] : '';
						} elseif (isset($mark['score_type']) && $mark['score_type'] == 'Freetext') {
							$fmark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
						} elseif (isset($mark['score_type']) && $mark['score_type'] == 'Grade') {
							$fmark = (isset($mark['grade']) && $mark['grade'] != null) ? $mark['grade'] : '';
						} else {
							$fmark = (isset($mark['score']) && $mark['score'] != null) ? $mark['score'] : '';
						}


						$output .= '<td  colspan="1"  >' . $fmark . '</td>';
					}
				}
				$output .= '</tr>';
			}
			$output .= '
			</tbody>
			</table>';
		}
		
		foreach ($getspsubject3 as $subject) {

			$n = count($specialsubject3papers);
			$output .= '<table class="table table-bordered specialtable" style="border-top:none;">
			<thead class="colspanHead">
			<tr>
			
			<td colspan="' . ($n + 1) . '" style="text-align:center; border: 1px solid black;height:40px;">
			' . $subject . '
			</td>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td colspan="1">学年</td>';
			foreach ($specialsubject3papers as $papers) {
				$output .= '<td colspan="1">' . $papers . '</td>';
			}
			$output .= '</tr>';


			foreach ($getclasssec['data'] as $sec) {
				
					$output .= '<tr >
				    <td style="height:70px;">' . $sec['class_numeric'] . '</td>';

					foreach ($specialsubject3papers as $papers) {
						if ($sec['class_id'] == '') {
							$output .= '<td  colspan="1"  ></td>';
						} else {
							$pdata = [
								'branch_id' => session()->get('branch_id'),
								'department_id' => $student['department_id'],
								'class_id' =>  $sec['class_id'],
								'section_id' =>  $sec['section_id'],
								'academic_session_id' => $sec['academic_session_id'],
								'student_id' => $student['id'],
								'subject' => $subject,
								'paper' => $papers,

							];
							$getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist1'), $pdata);

							$mark = $getmarks['data'];
							$fmark = '';
							if (isset($mark['score_type']) && $mark['score_type'] == 'Points') {
								$fmark = (isset($mark['grade_name']) && $mark['grade_name'] != null) ? $mark['grade_name'] : '';
							} elseif (isset($mark['score_type']) && $mark['score_type'] == 'Freetext') {
								$fmark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
							} elseif (isset($mark['score_type']) && $mark['score_type'] == 'Grade') {
								$fmark = (isset($mark['grade']) && $mark['grade'] != null) ? $mark['grade'] : '';
							} else {
								$fmark = (isset($mark['score']) && $mark['score'] != null) ? $mark['score'] : '';
							}


							$output .= '<td  colspan="1"  >' . $fmark . '</td>';
						}
					}
					$output .= '</tr>';
				
			}
			$output .= '
			</tbody>
			</table>';
		}
		foreach ($getspsubject4 as $subject) {

			$n = count($getclasssec['data']);
			$output .= '<table class="table table-bordered specialtable" style="border-top:none;">
                <thead class="colspanHead">
                <tr>
                
                <td colspan="' . ($n + 2) . '" style="text-align:center; border: 1px solid black;">
                ' . $subject . '
                </td>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td colspan="1">内　容</td>
                <td colspan="1">観　点 \ 学　年</td>';
			foreach ($getclasssec['data'] as $sec) {
				$output .= '<td colspan="1">' . $sec['class_numeric'] . '</td>';
			}
			$output .= '</tr>';

			$p = 0;
			$np = count($specialsubject4papers);
			foreach ($specialsubject4papers as $papers) {
				$p++;

				$output .= '<tr >
				<td style="height:52px;">' . $papers . '</td>';
				if ($p == 1) {
					$output .= '
                    <td rowspan="' . $np . '"></td>';
				}

				foreach ($getclasssec['data'] as $sec) {
					if ($sec['class_id'] == '') {
						$output .= '<td  colspan="1"  ></td>';
					} else {
						$pdata = [
							'branch_id' => session()->get('branch_id'),
							'department_id' => $student['department_id'],
							'class_id' =>  $sec['class_id'],
							'section_id' =>  $sec['section_id'],
							'academic_session_id' => $sec['academic_session_id'],
							'student_id' => $student['id'],
							'subject' => $subject,
							'paper' => $papers

						];
						$getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist1'), $pdata);

						$mark = $getmarks['data'];
						$fmark = '';
						if (isset($mark['score_type']) && $mark['score_type'] == 'Points') {
							$fmark = (isset($mark['grade_name']) && $mark['grade_name'] != null) ? $mark['grade_name'] : '';
						} elseif (isset($mark['score_type']) && $mark['score_type'] == 'Freetext') {
							$fmark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
						} elseif (isset($mark['score_type']) && $mark['score_type'] == 'Grade') {
							$fmark = (isset($mark['grade']) && $mark['grade'] != null) ? $mark['grade'] : '';
						} else {
							$fmark = (isset($mark['score']) && $mark['score'] != null) ? $mark['score'] : '';
						}


						$output .= '<td  colspan="1"  >' . $fmark . '</td>';
					}
				}
				$output .= '</tr>';
			}
			$output .= '
			</tbody>
			</table>';
		}
        $subject1 = "行動の記録"; //Record of actions
		$subject2 = "総合"; //comprehensive
		$subject3 = "出 欠 の 記 録"; //Record of attendance
		$ra_paper1 = "基本的な生活習慣";    //		Basic lifestyle habits							
		$ra_paper2 = "健康・体力の向上";    //	Improvement of health and physical fitness								
		$ra_paper3 = "自主・自律";    //		Self-discipline							
		$ra_paper4 = "責任感";        //	Responsibility							
		$ra_paper5 = "創意工夫";    // Creativity
		$ra_paper6 = "思いやり・協力";    //		Compassion and Cooperation							
		$ra_paper7 = "生命尊重・自然愛護";    //	Respect for life and love for nature								
		$ra_paper8 = "勤労・奉仕";    //		Labor & Service							
		$ra_paper9 = "公正・公平";        //		Fairness						
		$ra_paper10 = "公共心・公徳心";    //		Public Virtue							
		$getpaperlist1 = array($ra_paper1, $ra_paper2, $ra_paper3, $ra_paper4, $ra_paper5);
		$getpaperlist2 = array($ra_paper6, $ra_paper7, $ra_paper8, $ra_paper9, $ra_paper10);
		$description = "説明";
		$remarks = "備考";
		$output .= '</td>
			</tr>
			
			</table>
			
        </div>
        <!-- Page 2 -->
        <div class="content">
        <table class="main" width="100%">
            <tr>
                <td class="content-wrap aligncenter" style="margin: 0;padding: 20px;
				align=" center">
					<table class="table table-bordered" style="margin-bottom: 30px;width: 30%;">
						<thead>
							<tr>
								<td>' . $student['first_name'] . ' ' . $student['last_name'] . '</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="height:30px;"></td>
							</tr>
						</tbody>
					</table>';
                    $totcolsp = ($student['department_id']==1)?'22':'16';
					
					$output.='<table class="table table-bordered">
						<thead class="colspanHead">
							<tr>
								<td colspan="'. $totcolsp.'" style="text-align:center; border: 1px solid black;font-size:22px;">
								<p style="color:black; margin:0px 0px 0px 0px; letter-spacing:0; white-space:nowrap;">行　　　　動　　　　の　　　　　記　　　録</p></td>
							</tr>
						</thead>
						<tbody>
                            
							<tr>
                            <td colspan="'.($totcolsp/2).'"> 
                            <table class="table table-bordered" style="border:none;">
                            <tr>
								<td colspan="1" style="text-align:center;">項　　目</td>
								<td colspan="1" class="diagonalCross" style="border-right:hidden; border-left:hidden;"></td>
								<td colspan="1" style="text-align:center;">学　　年</td>';
                                for($c=1;$c<=$totgrade;$c++)
                                {
								$output.='<td colspan="1">'.$c.'</td>';
                                }
								
								
							$output.='</tr>';
							
							
		foreach ($getpaperlist1 as $papers) {
			$output .= ' <tr>';

			$output .= '<td  style="text-align:left;" colspan="3">' . $papers . '</td>';

			foreach ($getclasssec['data'] as $sec) {

				if ($sec['class_id'] == '') {
					$output .= ' <td></td>';
				} else {
					$pdata = [
						'branch_id' => session()->get('branch_id'),
						'department_id' => $student['department_id'],
						'class_id' =>  $sec['class_id'],
						'section_id' =>  $sec['section_id'],
						'academic_session_id' => $sec['academic_session_id'],
						'student_id' => $student['id'],
						'subject' => $subject1,
						'paper' => $papers,

					];
					$getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist1'), $pdata);
					//dd($getmarks);
					$mark = $getmarks['data'];
					$fmark = '';

					$fmark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';


					$output .= ' <td>' . $fmark . '</td>';
				}
			}
			$output .= '</tr>';
            }
            $output .= '</table></td> 
            <td colspan="'.($totcolsp/2).'"> 
                            <table class="table table-bordered" style="border:none;">
                            <tr>
								<td colspan="1" style="text-align:center;">項　　目</td>
								<td colspan="1" class="diagonalCross" style="border-right:hidden; border-left:hidden;"></td>
								<td colspan="1" style="text-align:center;">学　　年</td>';
                                for($c=1;$c<=$totgrade;$c++)
                                {
								$output.='<td colspan="1">'.$c.'</td>';
                                }
								
								
							$output.='</tr>';
							
							
		foreach ($getpaperlist2 as $papers) {
			$output .= ' <tr>';

			$output .= '<td  style="text-align:left;" colspan="3">' . $papers . '</td>';

			foreach ($getclasssec['data'] as $sec) {

				if ($sec['class_id'] == '') {
					$output .= ' <td></td>';
				} else {
					$pdata = [
						'branch_id' => session()->get('branch_id'),
						'department_id' => $student['department_id'],
						'class_id' =>  $sec['class_id'],
						'section_id' =>  $sec['section_id'],
						'academic_session_id' => $sec['academic_session_id'],
						'student_id' => $student['id'],
						'subject' => $subject1,
						'paper' => $papers,

					];
					$getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist1'), $pdata);
					//dd($getmarks);
					$mark = $getmarks['data'];
					$fmark = '';

					$fmark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';


					$output .= ' <td>' . $fmark . '</td>';
				}
			}
			$output .= '</tr>';
        }
            $output .= '</table></td></tr>
            </table>
            ';
		
		
		$output .= '<table class="table table-bordered" style="border-top:none;">
			<thead class="colspanHead" style="border-top:none;">
			<tr>
			<td colspan="2" style="text-align:center; ">
            総　合　所　見　及　び　指　導　上　参　考　と　な　る　諸　事　項</td>
			</tr>
			</thead>
			<tbody>';

	
		$k = 0;
		foreach ($getclasssec['data'] as $sec) {
			$k++;
            $output .= '<tr>';
			if ($sec['class_id'] == '') {
				$fmark = '';
			} else {
				$pdata = [
					'branch_id' => session()->get('branch_id'),
					'department_id' => $student['department_id'],
					'class_id' =>  $sec['class_id'],
					'section_id' =>  $sec['section_id'],
					'academic_session_id' => $sec['academic_session_id'],
					'student_id' => $student['id'],
					'subject' => $subject2,
					'paper' => $description,


				];
				$getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist'), $pdata);
				//dd($getmarks);
				$mark = $getmarks['data'];
				$fmark = '';

				$fmark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
			}
			$output .= '<td  style="height: 200px;width: 0px; padding-top: 45px;">第<br>' . $k . '<br>学<br>年</td>';

			$output .= ' <td>' . $fmark . '</td>';
			
				
			
		



		$output .= '</tr>';
    }

		$output .= '</tbody>
			</table>
                    <table class="table table-bordered" style="border-top:none;">
                    <thead class="colspanHead" style="border-top:none;">
                        <tr>
                            <td colspan="22" style="text-align:center;">
                            <p style="color:black; margin:0px 0px 0px 0px; letter-spacing:0; white-space:nowrap;font-size:20px;">出　　欠　　の　　記　　録</p></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="1" style="width: 0px;">学年＼区分</td>
                            <td colspan="1" style="width: 0px;">授業数</td>
                            <td colspan="1" style="width: 0px;">出席停止<br>忌引き等の日数</td>
                            <td colspan="1" style="width: 0px;">出席しなけ<br>ればならない日数</td>
                            <td colspan="1" style="width: 0px;">欠席日数</td>
                            <td colspan="1" style="width: 0px;">出席日数</td>
                            <td colspan="16" style="width: 0px;">備　　　　　　考</td>
                            
                        </tr>';
                        $data1 = [
                            'branch_id' => session()->get('branch_id'),
                            'department_id' => $student['department_id'],
                            'pdf_report' => 10 // YOROKO FORM 2B
                
                        ];
               
                        foreach ($getclasssec['data'] as $sec) {
                            $totaldays = '0';
                            $suspension = '0';
                            $totalcomimg = '0';
                            $totpres = '0';
                            $totabs = '0';
                            if($sec['class_id'] == '') {
                                $remark = '';
                            } else {
                                $attdata = [
                                    'branch_id' => session()->get('branch_id'),
                                    'department_id' => $student['department_id'],
                                    'class_id' =>  $sec['class_id'],
                                    'section_id' =>  $sec['section_id'],
                                    'academic_session_id' => $sec['academic_session_id'],
                                    'student_id' => $student['id']
                
                                ];
                                $pdata = [
                                    'branch_id' => session()->get('branch_id'),
                                    'department_id' => $student['department_id'],
                                    'class_id' =>  $sec['class_id'],
                                    'section_id' =>  $sec['section_id'],
                                    'academic_session_id' => $sec['academic_session_id'],
                                    'student_id' => $student['id'],
                                    'subject' => $subject3,
                                    'paper' => $remarks,
                
                
                                ];
                                $getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist'), $pdata);
                                //dd($getmarks);
                                $mark = $getmarks['data'];
                
                
                                $remark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
                
                
                                $getattendance = Helper::PostMethod(config('constants.api.getsem_studentattendance'), $attdata);
                                //dd($getattendance);
                                foreach ($getattendance['data'] as $att) {
                
                                    $totaldays += $att['no_schooldays'];
                                    $suspension += $att['suspension'];
                                    $totalcomimg += $att['totalcoming'];
                                    $totpres += $att['totpres'];
                                    $totabs += $att['totabs'];
                                }
                            }
                            $output .= ' <tr>
                            <td colspan="1" style="width: 0px;">' . $sec['class_numeric'] . '</td>
                            <td colspan="1" style="width: 0px;">' . $totaldays . '</td>
                            <td colspan="1" style="width: 0px;">' . $suspension . '</td>
                            <td colspan="1" style="width: 0px;">' . $totalcomimg . '</td>
                            <td colspan="1" style="width: 0px;">' . $totabs . '</td>
                            <td colspan="1" style="width: 0px;">' . $totpres . '</td>
                            <td colspan="16" style="width: 0px;;">' . $remark . '</td>            
                            </tr>';
                        }
                        $output .= '</tbody>
                            </table>
                            
				</td>
			</tr>
		</table>
        </div>

    </body>
</html>';
      
		$pdf = \App::make('dompdf.wrapper');
		// set size
		$customPaper = array(0, 0, 792.00, 1224.00);
		$pdf->set_paper($customPaper);
		$pdf->loadHTML($output);
		// filename
		$now = now();
		$name = strtotime($now);
		$fileName = __('messages.download_form2a') . $name . ".pdf";
		return $pdf->download($fileName);
		// return $pdf->stream();
	}
}
