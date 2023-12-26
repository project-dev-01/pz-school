<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\Helper;

use DateTime;
use DateInterval;
use DatePeriod;
use DateTimeZone;
use PDF;

class PdfController extends Controller
{
    public function downbyclass(Request $request)
    {
        $data = [
            'exam_id' => $request->exam_id,
            'class_id' => $request->class_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'subject_id' => $request->subject_id,
            'academic_year' => $request->academic_year
        ];
        $tot_grade_calcu_byclass = Helper::PostMethod(config('constants.api.tot_grade_calcu_byclass'), $data);

        $footer_text = session()->get('footer_text');
        // dd($get_attendance_list_teacher);

        // $response = "";
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
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color:  #111;
            text-align: center;
            line-height: 35px;
            }

        footer {
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color: #111;
            text-align: center;
            line-height: 35px;
        }';
        $output .= '</style>';
        $output .= "</head>";
        $output .= "<body><header> " .  __('messages.by_class') . "</header>
        <footer>" . $footer_text . "</footer>";
        if ($tot_grade_calcu_byclass['code'] == "200") {
            $headers = $tot_grade_calcu_byclass['data']['headers'];
            $allbysubject = $tot_grade_calcu_byclass['data']['allbysubject'];
            // $output .= '<html>
            //         <head>
            //     <style>
            //         /** Define the margins of your page **/
            //         @page {
            //             margin: 100px 25px;
            //         }

            //         header {
            //             position: fixed;
            //             top: -60px;
            //             left: 0px;
            //             right: 0px;
            //             height: 50px;

            //             /** Extra personal styles **/
            //             background-color: #03a9f4;
            //             color: white;
            //             text-align: center;
            //             line-height: 35px;
            //         }

            //         footer {
            //             position: fixed; 
            //             bottom: -60px; 
            //             left: 0px; 
            //             right: 0px;
            //             height: 50px; 

            //             /** Extra personal styles **/
            //             background-color: #03a9f4;
            //             color: white;
            //             text-align: center;
            //             line-height: 35px;
            //         }
            //     </style>
            // </head><body>
            // <!-- Define header and footer blocks before your content -->
            // <header>
            // Paxsuzen
            // </header>
            // <footer>2020 - ' . date("Y") . ' &copy; by <a href="https://paxsuzen.com">Paxsuzen</a>.</footer><main>';
            $output .= '<div class="table-responsive">
        <table width="100%" style="border-collapse: collapse; border: 0px;">
           <thead>
              <tr>
                 <th class="align-top" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">' .  __('messages.s.no') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">' .  __('messages.grade') . '</th>
                 <th class="align-top th-sm - 6 rem" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">' .  __('messages.total_student') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">' .  __('messages.absent') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">' .  __('messages.present') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">' .  __('messages.class_teacher_name') . '</th>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px; font-weight:italic;">' . $val['grade'] . '</th>';
            }
            $output .= '<th class="align-middle" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">' .  __('messages.pass') . '</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">' .  __('messages.g') . '</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">' .  __('messages.gpa') . '</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">' .  __('messages.%') . '</th>
              </tr>
              <tr>';
            foreach ($headers as $val) {
                $output .=  '<td class="text-center" style="border: 1px solid; padding:12px; font-weight:italic;">%</td>';
            }
            $output .= '</tr>
           </thead>
           <tbody>';
            foreach ($allbysubject as $key => $res) {
                $key++;
                $output .= '<tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;" rowspan="2">' . $key . '</td>
                 <td class="text-left" style="border: 1px solid; padding:12px;" rowspan="2"><label for="clsname">' . $res['name'] . "(" . $res['section_name'] . ")" . '</label></td>
                 <td class="text-center" style="border: 1px solid; padding:12px;" rowspan="2"><label for="stdcount">' . $res['totalstudentcount'] . '</label></td>
                 <td class="text-left" style="border: 1px solid; padding:12px;"><label for="clsname">' . $res['absent_count'] . '</label></td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"><label for="stdcount">' . $res['present_count'] . '</label></td>
                 <td class="text-left" style="border: 1px solid; padding:12px;" rowspan="2"><label for="clsname">' . $res['teacher_name'] . '</label></td>';
                foreach ($headers as $resp) {
                    $obj = $res['gradecnt'];
                    if (array_key_exists($resp['grade'], $obj)) {
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">' . $obj[$resp['grade']] . '</td>';
                    } else {
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">0</td>';
                    }
                }
                $output .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['pass_count'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['fail_count'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;" rowspan="2">' . $res['gpa'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;" rowspan="2">' . $res['pass_percentage'] . '</td>
              </tr>';

                $absentPer = ($res['absent_count'] / $res['totalstudentcount']) * 100;
                $absentPer = number_format($absentPer, 2);
                $presentPer = ($res['present_count'] / $res['totalstudentcount']) * 100;
                $presentPer = number_format($presentPer, 2);

                $output .= '<tr>
                 <td class="text-left" style="border: 1px solid; padding:12px;"><label for="clsname">' . $absentPer . '</label></td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"><label for="stdcount">' . $presentPer . '</label></td>';
                foreach ($headers as $resp) {
                    $obj = $res['gradecnt'];
                    if (array_key_exists($resp['grade'], $obj)) {
                        $gradepercentage = ($obj[$resp['grade']] / $res['totalstudentcount']) * 100;
                        $gradepercentage = number_format($gradepercentage, 2);
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">' . $gradepercentage . '</td>';
                    } else {
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">0</td>';
                    }
                }
                $output .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['pass_percentage'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['fail_percentage'] . '</td>
              </tr>';
            }

            $output .= '</tbody></table></div>';
            //         $output .= '</main>
            //  </body>
            // </html>';
            $pdf = \App::make('dompdf.wrapper');
            // set size
            $customPaper = array(0, 0, 1000.00, 567.00);
            $pdf->set_paper($customPaper);
            $pdf->loadHTML($output);
            // filename
            $now = now();
            $name = strtotime($now);
            $fileName = __('messages.by_class') . $name . ".pdf";
            return $pdf->download($fileName);
            // return $pdf->stream();
        }
    }
   
    public function downby12reportcard(Request $request)
    {
        $paper=array('Listening','Reading','Speaking','Writing','Attitude');
        $data = [
            'branch_id' => session()->get('branch_id'),
            'exam_id' => $request->exam_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_year' => $request->academic_year
            
        ];
         // Exam Subjects
         $language=__('messages.language');
         $language1=__('messages.language1');
         $society=__('messages.society');
         $math=__('messages.math');
         $music=__('messages.music');
         $life=__('messages.life');
         $art=__('messages.art');
         $sports=__('messages.sports');
         $science=__('messages.science');
         $home_economic=__('messages.home_economic');
         // Exam Subjects Papers
        $paper1=__('messages.paper1');
        $paper2=__('messages.paper2');        
        $paper3=__('messages.paper3');
        $paper_list=[$paper1,$paper2,$paper3];        
        $subjectlist=[$language1,$math,$music,$life,$art,$sports];
        
        // Exam Special Subjects
        $special_subjects1=__('messages.special_subjects1');
        $special_subjects2=__('messages.special_subjects2');
        $special_subjects3=__('messages.special_subjects3');
        $special_subjects4=__('messages.special_subjects4');
        
        $special_paper1=__('messages.special_paper1');
        $special_paper2=__('messages.special_paper2');        
        $special_paper3=__('messages.special_paper3');
        $special_paper4=__('messages.special_paper4');
        $special_paper5=__('messages.special_paper5');        
        $special_paper6=__('messages.special_paper6');
        $special_paper7=__('messages.special_paper7');
        $special_paper8=__('messages.special_paper8');        
        $special_paper9=__('messages.special_paper9');
        $special_paper10=__('messages.special_paper10');
        $special_paper11=__('messages.special_paper11');        
        $special_paper12=__('messages.special_paper12');        
        $special_paper13=__('messages.special_paper13');
        $special_paper_list=[$special_paper1,$special_paper2,$special_paper3,$special_paper4,$special_paper5,$special_paper6,$special_paper7,$special_paper8,$special_paper9,$special_paper10];
        
        
        // Get Months
        $month1=__('messages.january');
        $month2=__('messages.february');        
        $month3=__('messages.march');
        $month4=__('messages.april');
        $month5=__('messages.may');        
        $month6=__('messages.june');
        $month7=__('messages.july');
        $month8=__('messages.august');        
        $month9=__('messages.september');
        $month10=__('messages.october');
        $month11=__('messages.november');        
        $month12=__('messages.december');
        $month_list=['',$month1,$month2,$month3,$month4,$month5,$month6,$month7,$month8,$month9,$month10,$month11,$month12];

        //dd($data);
        
        $getstudents = Helper::PostMethod(config('constants.api.exam_studentslist'), $data);
        $grade = Helper::PostMethod(config('constants.api.class_details'), $data);
        $section = Helper::PostMethod(config('constants.api.section_details'), $data);
        //dd($section);
        $footer_text = session()->get('footer_text');

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
        }';
        $output .= '</style>';
        $output .= "</head>";
        $output .= '<body>';
        $sno=0;
		foreach($getstudents['data'] as $stu)
        {
            $sno++;  
        $output .= '<table class="main" width="100%">
        <tr>
            <td colspan="5"> <h4>'.__('messages.pdfschool_name').'</h4> </td> 
        </tr>
        <tr>
            <td >
                <h4>'.$grade['data']['short_name'].'</h4>
            </td>
            <td>
                <h4>'.$request->semester_id.' '.__('messages.semester').'</h4>
            </td>
            <td>
                <h4>Notification</h4>
            </td>
            <td style=" border: 1px solid black;">Class : '.$section['data']['name'].'</td>
            <td style=" border: 1px solid black;">No : '.$sno.'</td>
        </tr>
        
        <tr style="height:60px;">
            <th colspan="2" style=" border: 1px solid black;vertical-align: top;border-right-style: hidden;">Name</th>
            <th colspan="3"style=" border: 1px solid black;vertical-align: inherit;">'.$stu['name'].'</th>
        </tr>
        <tr style="height:60px;">
        <td colspan="3">
        <table class="table table-bordered table-responsive">
            <thead class="colspanHead">
                <tr>
                    <td  colspan="2"style="text-align:center; border: 1px solid black;border-right-style: hidden;vertical-align: middle;">
                    Transcript of the study</td>
                    <td colspan="3" style="text-align:left; border: 1px solid black;">
                        ( A Well done )<br>
                        ( B Good )<br>
                    ( C Need improve )<br></td>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Subject</td>
                            <td style="text-align:left;">Learning Status by Perspective</td>
                            <td >1 Semester</td>
                            <td>2 Semester</td>
                            <td>3 Semester</td>
                            
                        </tr>
                        
                    </tbody>';
                        
                        foreach($subjectlist as $sub)
                        { $i=0;
                            foreach($paper_list as $papers)
                            {
                                $i++;
                                $studata = [
                                'branch_id' => session()->get('branch_id'),
                                'student_id' => $stu['student_id'],
                                'exam_id' => $request->exam_id,
                                'class_id' => $request->class_id,
                                'section_id' => $request->section_id,
                                'semester_id' => $request->semester_id,
                                'session_id' => $request->session_id,
                                'subject' => $sub,
                                'paper' => $papers,
                                'academic_session_id' => $request->academic_year
                                
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.stuexam_marklist'), $studata);
                            
                            $mark1=(isset($getmarks['data']['Semester1']['grade']) && $getmarks['data']['Semester1']['grade']!=null)?$getmarks['data']['Semester1']['grade']:'';
                            $mark2=(isset($getmarks['data']['Semester2']['grade']) && $getmarks['data']['Semester2']['grade']!=null)?$getmarks['data']['Semester2']['grade']:'';
                            $mark3=(isset($getmarks['data']['Semester3']['grade']) && $getmarks['data']['Semester3']['grade']!=null)?$getmarks['data']['Semester3']['grade']:'';
                            
                            if($i==1)
                            {
                        $output.=' <tbody style="border: 1px solid black;">';
                            }
                 
                            $output.=' <tr>';
                            if($i==1)
                            {
                                $output.='<td rowspan="3" style="width: 0px;">'.$sub.'</td>';
                            }
                            $output.='<td  style="text-align:left;">'.$papers.'</td>
                            <td>'.$mark1.'</td>
                            <td>'.$mark2.'</td>
                            <td>'.$mark3.'</td>                            
                        </tr>';
                        if($i==3)
                            {
                                $output.='</tbody>';
                            }
                        }
                    }                  
                    $output.=' </table>
                    <table class="table table-bordered table-responsive" style="margin-top:30px">
                        <thead class="colspanHead" >
                            <tr>
                                <th style="border-bottom: 1px solid black;">出欠の記録</th>
                                <th style="border-bottom: 1px solid black;">Number of school days</th>
                                <th style="border-bottom: 1px solid black;">Suspension of attendance Bereavement, etc.</th>
                                <th style="border-bottom: 1px solid black;">Number of days you have to attend</th>
                                <th style="border-bottom: 1px solid black;">Number of days absent</th>
                                <th style="border-bottom: 1px solid black;">Number of days of attendance</th>
                                <th style="border-bottom: 1px solid black;">Late</th>
                                <th style="border-bottom: 1px solid black;">Early</th>
                            </tr>
                        </thead>
                        <tbody style="border: 1px solid black;">';
                            $data = [
                                'branch_id' => session()->get('branch_id'),
                                'exam_id' => $request->exam_id,
                                'class_id' => $request->class_id,
                                'section_id' => $request->section_id,
                                'semester_id' => $request->semester_id,
                                'session_id' => $request->session_id,
                                'academic_year' => $request->academic_year
                                
                            ];
                            $acdata = [
                                'branch_id' => session()->get('branch_id'),                               
                                'id' => $request->academic_year
                                
                            ];
                            
                            $acyear = Helper::PostMethod(config('constants.api.academic_year_details'), $acdata);
                            //dd($acyear['data']['name']);
                            $acy=explode('-',$acyear['data']['name']);
                            $fromyear= $acy[0]; $toyear= $acy[1];
                            // dd($fromyear);
                            for($m=4;$m<=12;$m++)
                            {
                                $attdata= [
                                    'branch_id' => session()->get('branch_id'),                               
                                    'student_id' => $stu['student_id'],
                                    'atdate' => str_pad($m, 2, "0", STR_PAD_LEFT).'-'.$fromyear
                                    
                                ];
                                $montotaldays=cal_days_in_month(CAL_GREGORIAN,$m,$fromyear);
                                $suspension=0;
                                
                                $holidays = Helper::GetMethod(config('constants.api.getmonthlyholidays'));
                                $fmdata=$fromyear.'-'.$m.'-01';
                                $todata=$fromyear.'-'.$m.'-'.$montotaldays;
                                $start=strtotime( $fmdata);
                                $end=strtotime($todata);
                                $iter = 24*60*60; // whole day in seconds
                                $count = 0; // keep a count of Sats & Suns
                        
                                for($i = $start; $i <= $end; $i=$i+$iter)
                                {
                                    if(Date('D',$i) == 'Sat' || Date('D',$i) == 'Sun')
                                    {
                                        $count++;
                                    }
                                }
                                
                                $totalweekends= $count;
                                
                                $totaldays=$montotaldays-$holidays['data']-$totalweekends;
                                $getattendance = Helper::PostMethod(config('constants.api.studentmonthly_attendance'), $attdata);
                               
                                $totalcomimg= $totaldays-$suspension;
                                $totpres=$getattendance['data'][0]['presentCount'];
                                $totabs=$getattendance['data'][0]['absentCount'];
                                $totlate=$getattendance['data'][0]['lateCount'];
                                $totexc=$getattendance['data'][0]['excusedCount'];
                                $output.='<tr>
                                <td>'.$month_list[$m].'</td>
                                <td>'.$totaldays.'</td>
                                <td>'.$suspension.'</td>
                                <td>'.$totalcomimg.'</td>
                                <td>'.$totpres.'</td>
                                <td>'.$totabs.'</td>
                                <td>'.$totlate.'</td>
                                <td>'.$totexc.'</td>
                            </tr>';
                            }
                            for($m=1;$m<=3;$m++)
                            {
                                $attdata= [
                                    'branch_id' => session()->get('branch_id'),                               
                                    'student_id' => $stu['student_id'],
                                    'atdate' => str_pad($m, 2, "0", STR_PAD_LEFT).'-'.$toyear
                                    
                                ];
                                $montotaldays=cal_days_in_month(CAL_GREGORIAN,$m,$toyear);
                                $suspension=0;
                                
                                $holidays = Helper::GetMethod(config('constants.api.getmonthlyholidays'));
                                $fmdata=$toyear.'-'.$m.'-01';
                                $todata=$toyear.'-'.$m.'-'.$montotaldays;
                                $start=strtotime( $fmdata);
                                $end=strtotime($todata);
                                $iter = 24*60*60; // whole day in seconds
                                $count = 0; // keep a count of Sats & Suns
                        
                                for($i = $start; $i <= $end; $i=$i+$iter)
                                {
                                    if(Date('D',$i) == 'Sat' || Date('D',$i) == 'Sun')
                                    {
                                        $count++;
                                    }
                                }
                                
                                $totalweekends= $count;
                                
                                $totaldays=$montotaldays-$holidays['data']-$totalweekends;
                                $getattendance = Helper::PostMethod(config('constants.api.studentmonthly_attendance'), $attdata);
                                
                                $totalcomimg= $totaldays-$suspension;
                                $totpres=$getattendance['data'][0]['presentCount'];
                                $totabs=$getattendance['data'][0]['absentCount'];
                                $totlate=$getattendance['data'][0]['lateCount'];
                                $totexc=$getattendance['data'][0]['excusedCount'];
                                $output.='<tr>
                                <td>'.$month_list[$m].'</td>
                                <td>'.$totaldays.'</td>
                                <td>'.$suspension.'</td>
                                <td>'.$totalcomimg.'</td>
                                <td>'.$totpres.'</td>
                                <td>'.$totabs.'</td>
                                <td>'.$totlate.'</td>
                                <td>'.$totexc.'</td>
                            </tr>';
                            }
                            
                            
                            
                        $output.='</tbody>
                        
                        
                        
                    </table>
                    </td>
                    <td colspan="2">
                    <table class="table table-bordered">
                        <thead class="colspanHead">
                            <tr>
                                <td colspan="4" style="text-align:center; border: 1px solid black;vertical-align: middle;">
                                '.$special_subjects1.'</td>
                                <td colspan="1" style="text-align:center; border: 1px solid black;">
                                    (Listed in the third semester)<br>
                                ( O Excellent)</td>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($special_paper_list as $papers)
                        {
                            $i++;
                            $studata = [
                            'branch_id' => session()->get('branch_id'),
                            'student_id' => $stu['student_id'],
                            'exam_id' => $request->exam_id,
                            'class_id' => $request->class_id,
                            'section_id' => $request->section_id,
                            'semester_id' => $request->semester_id,
                            'session_id' => $request->session_id,
                            'subject' => $special_subjects1,
                            'paper' => $papers,
                            'academic_session_id' => $request->academic_year
                            
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.stuexam_marklist'), $studata);
                           // dd($getmarks);
                            $mark3=(isset($getmarks['data']['Semester3']['grade_name']) && $getmarks['data']['Semester3']['grade_name']=="Excellent")?'<input type="radio">':'';
                            
                            $output.=' <tr>
                                    <td colspan="4" style="text-align:left;">'.$papers.'</td>
                                    <td colspan="1">'.$mark3.'</td>
                                </tr>';
                        }
                            $output.=' </tbody>
                    </table>
                    <table class="table table-bordered" style="margin-top:10px;">
                        <thead class="colspanHead">
                            <tr>
                                <td colspan="5" style="text-align:center; border: 1px solid black;">
                                '.$special_subjects2.': Morality (listed in the third semester)</td>
                                
                            </tr>
                        </thead>
                        <tbody>';
                        $studata = [
                            'branch_id' => session()->get('branch_id'),
                            'student_id' => $stu['student_id'],
                            'exam_id' => $request->exam_id,
                            'class_id' => $request->class_id,
                            'section_id' => $request->section_id,
                            'semester_id' => $request->semester_id,
                            'session_id' => $request->session_id,
                            'subject' => $special_subjects2,
                            'paper' => $special_paper11,
                            'academic_session_id' => $request->academic_year
                            
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.stuexam_spmarklist'), $studata);
                            // $mark1=(isset($getmarks['data']['Semester1']['freetext']) && $getmarks['data']['Semester1']['freetext']!=null)?$getmarks['data']['Semester1']['freetext']:'';
                            //$mark2=(isset($getmarks['data']['Semester2']['freetext']) && $getmarks['data']['Semester2']['freetext']!=null)?$getmarks['data']['Semester2']['freetext']:'';
                            $mark3=(isset($getmarks['data']['Semester3']['freetext']) && $getmarks['data']['Semester3']['freetext']!=null)?$getmarks['data']['Semester3']['freetext']:'';
                            
                            $output.='<tr>
                                <td colspan="5" style="height:60px;">'.$mark3.'</td>
                                
                            </tr>
                        </tbody>
                    </table>
                    
                    <table class="table table-bordered" style="margin-top:10px;">
                        <thead class="colspanHead">
                            <tr>
                                <td colspan="5" style="text-align:center; border: 1px solid black;">
                                '.$special_subjects3.'. (listed for each semester)							</td>
                                
                            </tr>
                        </thead>
                        <tbody>';
                        $studata = [
                            'branch_id' => session()->get('branch_id'),
                            'student_id' => $stu['student_id'],
                            'exam_id' => $request->exam_id,
                            'class_id' => $request->class_id,
                            'section_id' => $request->section_id,
                            'semester_id' => $request->semester_id,
                            'session_id' => $request->session_id,
                            'subject' => $special_subjects3,
                            'paper' => $special_paper12,
                            'academic_session_id' => $request->academic_year
                            
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.stuexam_spmarklist'), $studata);
                            $mark1=(isset($getmarks['data']['Semester1']['freetext']) && $getmarks['data']['Semester1']['freetext']!=null)?$getmarks['data']['Semester1']['freetext']:'';
                            $mark2=(isset($getmarks['data']['Semester2']['freetext']) && $getmarks['data']['Semester2']['freetext']!=null)?$getmarks['data']['Semester2']['freetext']:'';
                            $mark3=(isset($getmarks['data']['Semester3']['freetext']) && $getmarks['data']['Semester3']['freetext']!=null)?$getmarks['data']['Semester3']['freetext']:'';
                            
                            $output.='
                            <tr>
                                <td colspan="5" style="height:60px;text-align:left;">
                                    '.$mark1.'<br>
                                    
                                    '.$mark2.'<br>
                                    
                                    '.$mark3.'<br>
                                
                            </tr>
                            
                        </tbody>
                    </table>
                    
                    <table class="table table-bordered" style="margin-top:10px;">
                        <thead class="colspanHead">
                            <tr>
                                <td colspan="5" style="text-align:center; border: 1px solid black;">
                                '.$special_subjects4.' (described in the third semester)														</td>
                                
                            </tr>
                        </thead>
                        <tbody>';
                        $studata = [
                            'branch_id' => session()->get('branch_id'),
                            'student_id' => $stu['student_id'],
                            'exam_id' => $request->exam_id,
                            'class_id' => $request->class_id,
                            'section_id' => $request->section_id,
                            'semester_id' => $request->semester_id,
                            'session_id' => $request->session_id,
                            'subject' => $special_subjects4,
                            'paper' => $special_paper13,
                            'academic_session_id' => $request->academic_year
                            
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.stuexam_spmarklist'), $studata);
                           // $mark1=(isset($getmarks['data']['Semester1']['freetext']) && $getmarks['data']['Semester1']['freetext']!=null)?$getmarks['data']['Semester1']['freetext']:'';
                            //$mark2=(isset($getmarks['data']['Semester2']['freetext']) && $getmarks['data']['Semester2']['freetext']!=null)?$getmarks['data']['Semester2']['freetext']:'';
                            $mark3=(isset($getmarks['data']['Semester3']['freetext']) && $getmarks['data']['Semester3']['freetext']!=null)?$getmarks['data']['Semester3']['freetext']:'';
                            //dd($getmarks);
                            $output.='
                            <tr>
                                <td colspan="5" style="height:60px;">'.$mark3.'</td>
                                
                            </tr>
                            
                        </tbody>
                    </table>
                    
                    
                    
                                    <p style="text-align:left;font-size:9px;">*The contents of the first and second semester will be communicated in a three-parties meeting.</p>
                                
                            <table class="table table-bordered"style="margin-top:12px;">
                                <thead class="colspanHead">
                                    
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2" style="text-align:left;height:40px;">Principal<br><br><br><br></td>
                                        
                                    
                                        <td colspan="3" style="text-align:left;height:40px;">Class Teacher<br><br><br><br></td>
                                        
                                    </tr>
                                    
                                    
                                </tbody>
                            </table>
                    </td>
                    
        
    </tr>
</table>
        <div style="page-break-after: always;"></div>';
        }
        
        $output .= '</body>
            </html';
            //             $output .= '</main>
            //      </body>
            //  </html>';
            $pdf = \App::make('dompdf.wrapper');
            // set size
            $customPaper = array(0, 0, 792.00, 1224.00);
            $pdf->set_paper($customPaper);
            $pdf->loadHTML($output);
            // filename
            $now = now();
            $name = strtotime($now);
            $fileName = __('messages.report_card') . $name . ".pdf";
            return $pdf->download($fileName);
            // return $pdf->stream();
        
    }
    public function downby34reportcard(Request $request)
    {
        $paper=array('Listening','Reading','Speaking','Writing','Attitude');
        $data = [
            'branch_id' => session()->get('branch_id'),
            'exam_id' => $request->exam_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_year' => $request->academic_year
            
        ];
        
        //dd($data);
        $paper1=__('messages.paper1');
        $paper2=__('messages.paper2');        
        $paper3=__('messages.paper3');
        $paper_list=[$paper1,$paper2,$paper3];
        
        $language=__('messages.language');
        $language1=__('messages.language1');
        $society=__('messages.society');
        $math=__('messages.math');
        $music=__('messages.music');
        $life=__('messages.life');
        $art=__('messages.art');
        $sports=__('messages.sports');
        $science=__('messages.science');
        $home_economic=__('messages.home_economic');
        
        $subjectlist=[$language1,$society,$math, $science,$music,$art,$sports];
         // Exam Special Subjects
         $special_subjects1=__('messages.special_subjects1');
         $special_subjects2=__('messages.special_subjects2');
         $special_subjects3=__('messages.special_subjects3');
         $special_subjects4=__('messages.special_subjects4');
         
         $special_paper1=__('messages.special_paper1');
         $special_paper2=__('messages.special_paper2');        
         $special_paper3=__('messages.special_paper3');
         $special_paper4=__('messages.special_paper4');
         $special_paper5=__('messages.special_paper5');        
         $special_paper6=__('messages.special_paper6');
         $special_paper7=__('messages.special_paper7');
         $special_paper8=__('messages.special_paper8');        
         $special_paper9=__('messages.special_paper9');
         $special_paper10=__('messages.special_paper10');
         $special_paper11=__('messages.special_paper11');        
         $special_paper12=__('messages.special_paper12');        
         $special_paper13=__('messages.special_paper13');
         $special_paper_list=[$special_paper1,$special_paper2,$special_paper3,$special_paper4,$special_paper5,$special_paper6,$special_paper7,$special_paper8,$special_paper9,$special_paper10];
         
        // Get Months
        $month1=__('messages.january');
        $month2=__('messages.february');        
        $month3=__('messages.march');
        $month4=__('messages.april');
        $month5=__('messages.may');        
        $month6=__('messages.june');
        $month7=__('messages.july');
        $month8=__('messages.august');        
        $month9=__('messages.september');
        $month10=__('messages.october');
        $month11=__('messages.november');        
        $month12=__('messages.december');
        $month_list=['',$month1,$month2,$month3,$month4,$month5,$month6,$month7,$month8,$month9,$month10,$month11,$month12];

        //dd($data);
        
        $getstudents = Helper::PostMethod(config('constants.api.exam_studentslist'), $data);
        $grade = Helper::PostMethod(config('constants.api.class_details'), $data);
        $section = Helper::PostMethod(config('constants.api.section_details'), $data);
        
        $footer_text = session()->get('footer_text');

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
        }';
        $output .= '</style>';
        $output .= "</head>";
        $output .= '<body>';
        
        $sno=0;
		foreach($getstudents['data'] as $stu)
        {
            $sno++;
            $output .= '<table class="main" width="100%">
			<tr>
            <td colspan="5"> <h4>'.__('messages.pdfschool_name').'</h4> </td> 
        </tr>
        <tr>
            <td >
                <h4>'.$grade['data']['short_name'].'</h4>
            </td>
            <td>
                <h4>'.$request->semester_id.' '.__('messages.semester').'</h4>
            </td>
            <td>
                <h4>Notification</h4>
            </td>
            <td style=" border: 1px solid black;">Class : '.$section['data']['name'].'</td>
            <td style=" border: 1px solid black;">No : '.$sno.'</td>
        </tr>
        
        <tr style="height:60px;">
            <th colspan="2" style=" border: 1px solid black;vertical-align: top;border-right-style: hidden;">Name</th>
            <th colspan="3"style=" border: 1px solid black;vertical-align: inherit;">'.$stu['name'].'</th>
        </tr>
			<tr style="height:60px;">
				<td colspan="3">
					<table class="table table-bordered table-responsive">
						<thead class="colspanHead">
							<tr>
								<td  colspan="2"style="text-align:center; border: 1px solid black;border-right-style: hidden;vertical-align: middle;">
								Transcript of the study</td>
								<td colspan="3" style="text-align:left; border: 1px solid black;">
									( A Well done )<br>
									( B Good )<br>
									( C Need improve )<br>
								</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td >Subject</td>
								<td style="text-align:left;">Learning Status by Perspective</td>
								<td >1 Semester</td>
								<td >2 Semester</td>
								<td >3 Semester</td>
								
							</tr>
							
						</tbody>';
						
                        foreach($subjectlist as $sub)
                        { $i=0;
                            foreach($paper_list as $papers)
                            {
                                $i++;
                                $studata = [
                                'branch_id' => session()->get('branch_id'),
                                'student_id' => $stu['student_id'],
                                'exam_id' => $request->exam_id,
                                'class_id' => $request->class_id,
                                'section_id' => $request->section_id,
                                'semester_id' => $request->semester_id,
                                'session_id' => $request->session_id,
                                'subject' => $sub,
                                'paper' => $papers,
                                'academic_session_id' => $request->academic_year
                                
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.stuexam_marklist'), $studata);
                            
                            $mark1=(isset($getmarks['data']['Semester1']['grade']) && $getmarks['data']['Semester1']['grade']!=null)?$getmarks['data']['Semester1']['grade']:'';
                            $mark2=(isset($getmarks['data']['Semester2']['grade']) && $getmarks['data']['Semester2']['grade']!=null)?$getmarks['data']['Semester2']['grade']:'';
                            $mark3=(isset($getmarks['data']['Semester3']['grade']) && $getmarks['data']['Semester3']['grade']!=null)?$getmarks['data']['Semester3']['grade']:'';
                            
                            if($i==1)
                            {
                        $output.=' <tbody style="border: 1px solid black;">';
                            }
                 
                            $output.=' <tr>';
                            if($i==1)
                            {
                                $output.='<td rowspan="3" style="width: 0px;">'.$sub.'</td>';
                            }
                            $output.='<td  style="text-align:left;">'.$papers.'</td>
                            <td>'.$mark1.'</td>
                            <td>'.$mark2.'</td>
                            <td>'.$mark3.'</td>                            
                        </tr>';
                        if($i==3)
                            {
                                $output.='</tbody>';
                            }
                        }
                    }         
                    $output.='</table>
						
						<table class="table table-bordered" style="margin-top:25px;">
							<thead class="colspanHead">
								<tr>
									<td colspan="5" style="text-align:center; border: 1px solid black;">
									Foreign Language Activities (listed in the third semester)</td>
									
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="5" style="height:60px;text-align:left;">xxxxx</td>
									
								</tr>
								
							</tbody>
						</table>
						
						
						<table class="table table-bordered table-responsive" style="margin-top:30px">
							<thead class="colspanHead">
								<tr>
									<th style="border-bottom: 1px solid black;">出欠の記録</th>
									<th style="border-bottom: 1px solid black;">Number of school days</th>
									<th style="border-bottom: 1px solid black;">Suspension of attendance Bereavement, etc.</th>
									<th style="border-bottom: 1px solid black;">Number of days you have to attend</th>
									<th style="border-bottom: 1px solid black;">Number of days absent</th>
									<th style="border-bottom: 1px solid black;">Number of days of attendance</th>
									<th style="border-bottom: 1px solid black;">Late</th>
									<th style="border-bottom: 1px solid black;">Early</th>
								</tr>
							</thead>
							<tbody style="border: 1px solid black;">';
                            $data = [
                                'branch_id' => session()->get('branch_id'),
                                'exam_id' => $request->exam_id,
                                'class_id' => $request->class_id,
                                'section_id' => $request->section_id,
                                'semester_id' => $request->semester_id,
                                'session_id' => $request->session_id,
                                'academic_year' => $request->academic_year
                                
                            ];
                            $acdata = [
                                'branch_id' => session()->get('branch_id'),                               
                                'id' => $request->academic_year
                                
                            ];
                            
                            $acyear = Helper::PostMethod(config('constants.api.academic_year_details'), $acdata);
                            //dd($acyear['data']['name']);
                            $acy=explode('-',$acyear['data']['name']);
                            $fromyear= $acy[0]; $toyear= $acy[1];
                            // dd($fromyear);
                            for($m=4;$m<=12;$m++)
                            {
                                $attdata= [
                                    'branch_id' => session()->get('branch_id'),                               
                                    'student_id' => $stu['student_id'],
                                    'atdate' => str_pad($m, 2, "0", STR_PAD_LEFT).'-'.$fromyear
                                    
                                ];
                                $montotaldays=cal_days_in_month(CAL_GREGORIAN,$m,$fromyear);
                                $suspension=0;
                                
                                $holidays = Helper::GetMethod(config('constants.api.getmonthlyholidays'));
                                $fmdata=$fromyear.'-'.$m.'-01';
                                $todata=$fromyear.'-'.$m.'-'.$montotaldays;
                                $start=strtotime( $fmdata);
                                $end=strtotime($todata);
                                $iter = 24*60*60; // whole day in seconds
                                $count = 0; // keep a count of Sats & Suns
                        
                                for($i = $start; $i <= $end; $i=$i+$iter)
                                {
                                    if(Date('D',$i) == 'Sat' || Date('D',$i) == 'Sun')
                                    {
                                        $count++;
                                    }
                                }
                                
                                $totalweekends= $count;
                                
                                $totaldays=$montotaldays-$holidays['data']-$totalweekends;
                                $getattendance = Helper::PostMethod(config('constants.api.studentmonthly_attendance'), $attdata);
                               
                                $totalcomimg= $totaldays-$suspension;
                                $totpres=$getattendance['data'][0]['presentCount'];
                                $totabs=$getattendance['data'][0]['absentCount'];
                                $totlate=$getattendance['data'][0]['lateCount'];
                                $totexc=$getattendance['data'][0]['excusedCount'];
                                $output.='<tr>
                                <td>'.$month_list[$m].'</td>
                                <td>'.$totaldays.'</td>
                                <td>'.$suspension.'</td>
                                <td>'.$totalcomimg.'</td>
                                <td>'.$totpres.'</td>
                                <td>'.$totabs.'</td>
                                <td>'.$totlate.'</td>
                                <td>'.$totexc.'</td>
                            </tr>';
                            }
                            for($m=1;$m<=3;$m++)
                            {
                                $attdata= [
                                    'branch_id' => session()->get('branch_id'),                               
                                    'student_id' => $stu['student_id'],
                                    'atdate' => str_pad($m, 2, "0", STR_PAD_LEFT).'-'.$toyear
                                    
                                ];
                                $montotaldays=cal_days_in_month(CAL_GREGORIAN,$m,$toyear);
                                $suspension=0;
                                
                                $holidays = Helper::GetMethod(config('constants.api.getmonthlyholidays'));
                                $fmdata=$toyear.'-'.$m.'-01';
                                $todata=$toyear.'-'.$m.'-'.$montotaldays;
                                $start=strtotime( $fmdata);
                                $end=strtotime($todata);
                                $iter = 24*60*60; // whole day in seconds
                                $count = 0; // keep a count of Sats & Suns
                        
                                for($i = $start; $i <= $end; $i=$i+$iter)
                                {
                                    if(Date('D',$i) == 'Sat' || Date('D',$i) == 'Sun')
                                    {
                                        $count++;
                                    }
                                }
                                
                                $totalweekends= $count;
                                
                                $totaldays=$montotaldays-$holidays['data']-$totalweekends;
                                $getattendance = Helper::PostMethod(config('constants.api.studentmonthly_attendance'), $attdata);
                                
                                $totalcomimg= $totaldays-$suspension;
                                $totpres=$getattendance['data'][0]['presentCount'];
                                $totabs=$getattendance['data'][0]['absentCount'];
                                $totlate=$getattendance['data'][0]['lateCount'];
                                $totexc=$getattendance['data'][0]['excusedCount'];
                                $output.='<tr>
                                <td>'.$month_list[$m].'</td>
                                <td>'.$totaldays.'</td>
                                <td>'.$suspension.'</td>
                                <td>'.$totalcomimg.'</td>
                                <td>'.$totpres.'</td>
                                <td>'.$totabs.'</td>
                                <td>'.$totlate.'</td>
                                <td>'.$totexc.'</td>
                            </tr>';
                            }
                            
                            
                            
                        $output.='								
							</tbody>
							
							
							
						</table>
					</td>
					<td colspan="2">
                    <table class="table table-bordered">
                    <thead class="colspanHead">
                        <tr>
                            <td colspan="4" style="text-align:center; border: 1px solid black;vertical-align: middle;">
                            '.$special_subjects1.'</td>
                            <td colspan="1" style="text-align:center; border: 1px solid black;">
                                (Listed in the third semester)<br>
                            ( O Excellent)</td>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($special_paper_list as $papers)
                    {
                        $i++;
                        $studata = [
                        'branch_id' => session()->get('branch_id'),
                        'student_id' => $stu['student_id'],
                        'exam_id' => $request->exam_id,
                        'class_id' => $request->class_id,
                        'section_id' => $request->section_id,
                        'semester_id' => $request->semester_id,
                        'session_id' => $request->session_id,
                        'subject' => $special_subjects1,
                        'paper' => $papers,
                        'academic_session_id' => $request->academic_year
                        
                        ];
                        $getmarks = Helper::PostMethod(config('constants.api.stuexam_marklist'), $studata);
                        //dd($getmarks);
                        $mark3=(isset($getmarks['data']['Semester3']['grade_name']) && $getmarks['data']['Semester3']['grade_name']=="Excellent")?'<input type="radio">':'';
                        
                        $output.=' <tr>
                                <td colspan="4" style="text-align:left;">'.$papers.'</td>
                                <td colspan="1">'.$mark3.'</td>
                            </tr>';
                    }
                        $output.=' </tbody>
                </table>
                <table class="table table-bordered" style="margin-top:10px;">
                    <thead class="colspanHead">
                        <tr>
                            <td colspan="5" style="text-align:center; border: 1px solid black;">
                            '.$special_subjects2.': Morality (listed in the third semester)</td>
                            
                        </tr>
                    </thead>
                    <tbody>';
                    $studata = [
                        'branch_id' => session()->get('branch_id'),
                        'student_id' => $stu['student_id'],
                        'exam_id' => $request->exam_id,
                        'class_id' => $request->class_id,
                        'section_id' => $request->section_id,
                        'semester_id' => $request->semester_id,
                        'session_id' => $request->session_id,
                        'subject' => $special_subjects2,
                        'paper' => $special_paper11,
                        'academic_session_id' => $request->academic_year
                        
                        ];
                        $getmarks = Helper::PostMethod(config('constants.api.stuexam_spmarklist'), $studata);
                        // $mark1=(isset($getmarks['data']['Semester1']['freetext']) && $getmarks['data']['Semester1']['freetext']!=null)?$getmarks['data']['Semester1']['freetext']:'';
                        //$mark2=(isset($getmarks['data']['Semester2']['freetext']) && $getmarks['data']['Semester2']['freetext']!=null)?$getmarks['data']['Semester2']['freetext']:'';
                        $mark3=(isset($getmarks['data']['Semester3']['freetext']) && $getmarks['data']['Semester3']['freetext']!=null)?$getmarks['data']['Semester3']['freetext']:'';
                        
                        $output.='<tr>
                            <td colspan="5" style="height:60px;">'.$mark3.'</td>
                            
                        </tr>
                    </tbody>
                </table>
                
                <table class="table table-bordered" style="margin-top:10px;">
                    <thead class="colspanHead">
                        <tr>
                            <td colspan="5" style="text-align:center; border: 1px solid black;">
                            '.$special_subjects3.'. (listed for each semester)							</td>
                            
                        </tr>
                    </thead>
                    <tbody>';
                    $studata = [
                        'branch_id' => session()->get('branch_id'),
                        'student_id' => $stu['student_id'],
                        'exam_id' => $request->exam_id,
                        'class_id' => $request->class_id,
                        'section_id' => $request->section_id,
                        'semester_id' => $request->semester_id,
                        'session_id' => $request->session_id,
                        'subject' => $special_subjects3,
                        'paper' => $special_paper12,
                        'academic_session_id' => $request->academic_year
                        
                        ];
                        $getmarks = Helper::PostMethod(config('constants.api.stuexam_spmarklist'), $studata);
                        $mark1=(isset($getmarks['data']['Semester1']['freetext']) && $getmarks['data']['Semester1']['freetext']!=null)?$getmarks['data']['Semester1']['freetext']:'';
                        $mark2=(isset($getmarks['data']['Semester2']['freetext']) && $getmarks['data']['Semester2']['freetext']!=null)?$getmarks['data']['Semester2']['freetext']:'';
                        $mark3=(isset($getmarks['data']['Semester3']['freetext']) && $getmarks['data']['Semester3']['freetext']!=null)?$getmarks['data']['Semester3']['freetext']:'';
                        
                        $output.='
                        <tr>
                            <td colspan="5" style="height:60px;text-align:left;">
                                '.$mark1.'<br>
                                
                                '.$mark2.'<br>
                                
                                '.$mark3.'<br>
                            
                        </tr>
                        
                    </tbody>
                </table>
                
                <table class="table table-bordered" style="margin-top:10px;">
                    <thead class="colspanHead">
                        <tr>
                            <td colspan="5" style="text-align:center; border: 1px solid black;">
                            '.$special_subjects4.' (described in the third semester)														</td>
                            
                        </tr>
                    </thead>
                    <tbody>';
                    $studata = [
                        'branch_id' => session()->get('branch_id'),
                        'student_id' => $stu['student_id'],
                        'exam_id' => $request->exam_id,
                        'class_id' => $request->class_id,
                        'section_id' => $request->section_id,
                        'semester_id' => $request->semester_id,
                        'session_id' => $request->session_id,
                        'subject' => $special_subjects4,
                        'paper' => $special_paper13,
                        'academic_session_id' => $request->academic_year
                        
                        ];
                        $getmarks = Helper::PostMethod(config('constants.api.stuexam_spmarklist'), $studata);
                       // $mark1=(isset($getmarks['data']['Semester1']['freetext']) && $getmarks['data']['Semester1']['freetext']!=null)?$getmarks['data']['Semester1']['freetext']:'';
                        //$mark2=(isset($getmarks['data']['Semester2']['freetext']) && $getmarks['data']['Semester2']['freetext']!=null)?$getmarks['data']['Semester2']['freetext']:'';
                        $mark3=(isset($getmarks['data']['Semester3']['freetext']) && $getmarks['data']['Semester3']['freetext']!=null)?$getmarks['data']['Semester3']['freetext']:'';
                        //dd($getmarks);
                        $output.='
                        <tr>
                            <td colspan="5" style="height:60px;">'.$mark3.'</td>
                            
                        </tr>
                        
                    </tbody>
                </table>
						
						
						<p style="text-align:left;font-size:9px;">*The contents of the first and second semester will be communicated in a three-parties meeting.</p>
						
						<table class="table table-bordered"style="margin-top:10px;">
							<thead class="colspanHead">
								
							</thead>
							<tbody>
								<tr>
									<td colspan="2" style="text-align:left;height:40px;">Principal</td>
									
									
									<td colspan="3" style="text-align:left;height:40px;">Class Teacher</td>
									
								</tr>
								
							</tbody>
						</table>
					</td>
					
				</tr>
			</table>
            <div style="page-break-after: always;"></div>';
        }
        
        $output .= '</body>
            </html';
            //             $output .= '</main>
            //      </body>
            //  </html>';
            $pdf = \App::make('dompdf.wrapper');
            // set size
            $customPaper = array(0, 0, 792.00, 1224.00);
            $pdf->set_paper($customPaper);
            $pdf->loadHTML($output);
            // filename
            $now = now();
            $name = strtotime($now);
            $fileName = __('messages.report_card') . $name . ".pdf";
            return $pdf->download($fileName);
            // return $pdf->stream();
        
    }
    public function downby56reportcard(Request $request)
    {
        $paper=array('Listening','Reading','Speaking','Writing','Attitude');
        $data = [
            'branch_id' => session()->get('branch_id'),
            'exam_id' => $request->exam_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_year' => $request->academic_year
            
        ];
        
        //dd($data);
        $paper1=__('messages.paper1');
        $paper2=__('messages.paper2');        
        $paper3=__('messages.paper3');
        $paper_list=[$paper1,$paper2,$paper3];
        
        $language=__('messages.language');
        $language1=__('messages.language1');
        $society=__('messages.society');
        $math=__('messages.math');
        $music=__('messages.music');
        $life=__('messages.life');
        $art=__('messages.art');
        $sports=__('messages.sports');
        $science=__('messages.science');
        $home_economic=__('messages.home_economic');
        
        $subjectlist=[$language1,$society,$math, $science,$music,$art, $home_economic,$sports];
         // Exam Special Subjects
         $special_subjects1=__('messages.special_subjects1');
         $special_subjects2=__('messages.special_subjects2');
         $special_subjects3=__('messages.special_subjects3');
         $special_subjects4=__('messages.special_subjects4');
         
         $special_paper1=__('messages.special_paper1');
         $special_paper2=__('messages.special_paper2');        
         $special_paper3=__('messages.special_paper3');
         $special_paper4=__('messages.special_paper4');
         $special_paper5=__('messages.special_paper5');        
         $special_paper6=__('messages.special_paper6');
         $special_paper7=__('messages.special_paper7');
         $special_paper8=__('messages.special_paper8');        
         $special_paper9=__('messages.special_paper9');
         $special_paper10=__('messages.special_paper10');
         $special_paper11=__('messages.special_paper11');        
         $special_paper12=__('messages.special_paper12');        
         $special_paper13=__('messages.special_paper13');
         $special_paper_list=[$special_paper1,$special_paper2,$special_paper3,$special_paper4,$special_paper5,$special_paper6,$special_paper7,$special_paper8,$special_paper9,$special_paper10];
         
        // Get Months
        $month1=__('messages.january');
        $month2=__('messages.february');        
        $month3=__('messages.march');
        $month4=__('messages.april');
        $month5=__('messages.may');        
        $month6=__('messages.june');
        $month7=__('messages.july');
        $month8=__('messages.august');        
        $month9=__('messages.september');
        $month10=__('messages.october');
        $month11=__('messages.november');        
        $month12=__('messages.december');
        $month_list=['',$month1,$month2,$month3,$month4,$month5,$month6,$month7,$month8,$month9,$month10,$month11,$month12];

        //dd($data);
        
        $getstudents = Helper::PostMethod(config('constants.api.exam_studentslist'), $data);
        $grade = Helper::PostMethod(config('constants.api.class_details'), $data);
        $section = Helper::PostMethod(config('constants.api.section_details'), $data);
        
        $footer_text = session()->get('footer_text');

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
        }';
        $output .= '</style>';
        $output .= "</head>";
        $output .= '<body>';
        
        $sno=0;
		foreach($getstudents['data'] as $stu)
        {
            $sno++;
		    $output .= '<table class="main" width="100%">
			<tr>
            <td colspan="5"> <h4>'.__('messages.pdfschool_name').'</h4> </td> 
        </tr>
        <tr>
            <td >
                <h4>'.$grade['data']['short_name'].'</h4>
            </td>
            <td>
                <h4>'.$request->semester_id.' '.__('messages.semester').'</h4>
            </td>
            <td>
                <h4>Notification</h4>
            </td>
            <td style=" border: 1px solid black;">Class : '.$section['data']['name'].'</td>
            <td style=" border: 1px solid black;">No : '.$sno.'</td>
        </tr>
        
        <tr style="height:60px;">
            <th colspan="2" style=" border: 1px solid black;vertical-align: top;border-right-style: hidden;">Name</th>
            <th colspan="3"style=" border: 1px solid black;vertical-align: inherit;">'.$stu['name'].'</th>
        </tr>
			<tr style="height:60px;">
				<td colspan="3">
					<table class="table table-bordered table-responsive">
						<thead class="colspanHead">
							<tr>
								<td colspan="2" style="text-align:center; border: 1px solid black;border-right-style: hidden;vertical-align: middle;">
								Transcript of the study</td>
								<td colspan="3" style="text-align:left; border: 1px solid black;">
									( A Well done )<br>
									( B Good )<br>
								( C Need improve )<br></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="1" >Subject</td>
								<td colspan="1" style="text-align:left;">Learning Status by Perspective</td>
								<td colspan="1"  >1 Semester</td>
								<td colspan="1"  >2 Semester</td>
								<td colspan="1"  >3 Semester</td>
								
							</tr>
							
						</tbody>';
						
                        foreach($subjectlist as $sub)
                        { $i=0;
                            foreach($paper_list as $papers)
                            {
                                $i++;
                                $studata = [
                                'branch_id' => session()->get('branch_id'),
                                'student_id' => $stu['student_id'],
                                'exam_id' => $request->exam_id,
                                'class_id' => $request->class_id,
                                'section_id' => $request->section_id,
                                'semester_id' => $request->semester_id,
                                'session_id' => $request->session_id,
                                'subject' => $sub,
                                'paper' => $papers,
                                'academic_session_id' => $request->academic_year
                                
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.stuexam_marklist'), $studata);
                            
                            $mark1=(isset($getmarks['data']['Semester1']['grade']) && $getmarks['data']['Semester1']['grade']!=null)?$getmarks['data']['Semester1']['grade']:'';
                            $mark2=(isset($getmarks['data']['Semester2']['grade']) && $getmarks['data']['Semester2']['grade']!=null)?$getmarks['data']['Semester2']['grade']:'';
                            $mark3=(isset($getmarks['data']['Semester3']['grade']) && $getmarks['data']['Semester3']['grade']!=null)?$getmarks['data']['Semester3']['grade']:'';
                            
                            if($i==1)
                            {
                        $output.=' <tbody style="border: 1px solid black;">';
                            }
                 
                            $output.=' <tr>';
                            if($i==1)
                            {
                                $output.='<td rowspan="3" style="width: 0px;">'.$sub.'</td>';
                            }
                            $output.='<td  style="text-align:left;">'.$papers.'</td>
                            <td>'.$mark1.'</td>
                            <td>'.$mark2.'</td>
                            <td>'.$mark3.'</td>                            
                        </tr>';
                        if($i==3)
                            {
                                $output.='</tbody>';
                            }
                        }
                    }         
                    $output.='</table>
					
					
					<table class="table table-bordered table-responsive" style="margin-top:30px">
						<thead class="colspanHead">
							<tr>
								<th style="border-bottom: 1px solid black;vertical-align: middle;">出欠の記録</th>
								<th style="border-bottom: 1px solid black;vertical-align: middle;">Number of school days</th>
								<th style="border-bottom: 1px solid black;vertical-align: middle;">Suspension of attendance Bereavement, etc.</th>
								<th style="border-bottom: 1px solid black;vertical-align: middle;">Number of days you have to attend</th>
								<th style="border-bottom: 1px solid black;vertical-align: middle;">Number of days absent</th>
								<th style="border-bottom: 1px solid black;vertical-align: middle;">Number of days of attendance</th>
								<th style="border-bottom: 1px solid black;vertical-align: middle;">Late</th>
								<th style="border-bottom: 1px solid black;vertical-align: middle;">Early</th>
							</tr>
						</thead>
						<tbody style="border: 1px solid black;">';
                        $data = [
                            'branch_id' => session()->get('branch_id'),
                            'exam_id' => $request->exam_id,
                            'class_id' => $request->class_id,
                            'section_id' => $request->section_id,
                            'semester_id' => $request->semester_id,
                            'session_id' => $request->session_id,
                            'academic_year' => $request->academic_year
                            
                        ];
                        $acdata = [
                            'branch_id' => session()->get('branch_id'),                               
                            'id' => $request->academic_year
                            
                        ];
                        
                        $acyear = Helper::PostMethod(config('constants.api.academic_year_details'), $acdata);
                        //dd($acyear['data']['name']);
                        $acy=explode('-',$acyear['data']['name']);
                        $fromyear= $acy[0]; $toyear= $acy[1];
                        // dd($fromyear);
                        for($m=4;$m<=12;$m++)
                        {
                            $attdata= [
                                'branch_id' => session()->get('branch_id'),                               
                                'student_id' => $stu['student_id'],
                                'atdate' => str_pad($m, 2, "0", STR_PAD_LEFT).'-'.$fromyear
                                
                            ];
                            $montotaldays=cal_days_in_month(CAL_GREGORIAN,$m,$fromyear);
                            $suspension=0;
                            
                            $holidays = Helper::GetMethod(config('constants.api.getmonthlyholidays'));
                            $fmdata=$fromyear.'-'.$m.'-01';
                            $todata=$fromyear.'-'.$m.'-'.$montotaldays;
                            $start=strtotime( $fmdata);
                            $end=strtotime($todata);
                            $iter = 24*60*60; // whole day in seconds
                            $count = 0; // keep a count of Sats & Suns
                    
                            for($i = $start; $i <= $end; $i=$i+$iter)
                            {
                                if(Date('D',$i) == 'Sat' || Date('D',$i) == 'Sun')
                                {
                                    $count++;
                                }
                            }
                            
                            $totalweekends= $count;
                            
                            $totaldays=$montotaldays-$holidays['data']-$totalweekends;
                            $getattendance = Helper::PostMethod(config('constants.api.studentmonthly_attendance'), $attdata);
                           
                            $totalcomimg= $totaldays-$suspension;
                            $totpres=$getattendance['data'][0]['presentCount'];
                            $totabs=$getattendance['data'][0]['absentCount'];
                            $totlate=$getattendance['data'][0]['lateCount'];
                            $totexc=$getattendance['data'][0]['excusedCount'];
                            $output.='<tr>
                            <td>'.$month_list[$m].'</td>
                            <td>'.$totaldays.'</td>
                            <td>'.$suspension.'</td>
                            <td>'.$totalcomimg.'</td>
                            <td>'.$totpres.'</td>
                            <td>'.$totabs.'</td>
                            <td>'.$totlate.'</td>
                            <td>'.$totexc.'</td>
                        </tr>';
                        }
                        for($m=1;$m<=3;$m++)
                        {
                            $attdata= [
                                'branch_id' => session()->get('branch_id'),                               
                                'student_id' => $stu['student_id'],
                                'atdate' => str_pad($m, 2, "0", STR_PAD_LEFT).'-'.$toyear
                                
                            ];
                            $montotaldays=cal_days_in_month(CAL_GREGORIAN,$m,$toyear);
                            $suspension=0;
                            
                            $holidays = Helper::GetMethod(config('constants.api.getmonthlyholidays'));
                            $fmdata=$toyear.'-'.$m.'-01';
                            $todata=$toyear.'-'.$m.'-'.$montotaldays;
                            $start=strtotime( $fmdata);
                            $end=strtotime($todata);
                            $iter = 24*60*60; // whole day in seconds
                            $count = 0; // keep a count of Sats & Suns
                    
                            for($i = $start; $i <= $end; $i=$i+$iter)
                            {
                                if(Date('D',$i) == 'Sat' || Date('D',$i) == 'Sun')
                                {
                                    $count++;
                                }
                            }
                            
                            $totalweekends= $count;
                            
                            $totaldays=$montotaldays-$holidays['data']-$totalweekends;
                            $getattendance = Helper::PostMethod(config('constants.api.studentmonthly_attendance'), $attdata);
                            
                            $totalcomimg= $totaldays-$suspension;
                            $totpres=$getattendance['data'][0]['presentCount'];
                            $totabs=$getattendance['data'][0]['absentCount'];
                            $totlate=$getattendance['data'][0]['lateCount'];
                            $totexc=$getattendance['data'][0]['excusedCount'];
                            $output.='<tr>
                            <td>'.$month_list[$m].'</td>
                            <td>'.$totaldays.'</td>
                            <td>'.$suspension.'</td>
                            <td>'.$totalcomimg.'</td>
                            <td>'.$totpres.'</td>
                            <td>'.$totabs.'</td>
                            <td>'.$totlate.'</td>
                            <td>'.$totexc.'</td>
                        </tr>';
                        }
                        
                        
                        
                    $output.='</tbody>
					</table>
				</td>
				<td colspan="2">
                <table class="table table-bordered">
                <thead class="colspanHead">
                    <tr>
                        <td colspan="4" style="text-align:center; border: 1px solid black;vertical-align: middle;">
                        '.$special_subjects1.'</td>
                        <td colspan="1" style="text-align:center; border: 1px solid black;">
                            (Listed in the third semester)<br>
                        ( O Excellent)</td>
                    </tr>
                </thead>
                <tbody>';
                foreach($special_paper_list as $papers)
                {
                    $i++;
                    $studata = [
                    'branch_id' => session()->get('branch_id'),
                    'student_id' => $stu['student_id'],
                    'exam_id' => $request->exam_id,
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'semester_id' => $request->semester_id,
                    'session_id' => $request->session_id,
                    'subject' => $special_subjects1,
                    'paper' => $papers,
                    'academic_session_id' => $request->academic_year
                    
                    ];
                    $getmarks = Helper::PostMethod(config('constants.api.stuexam_marklist'), $studata);
                    //dd($getmarks);
                    $mark3=(isset($getmarks['data']['Semester3']['grade_name']) && $getmarks['data']['Semester3']['grade_name']=="Excellent")?'<input type="radio">':'';
                    
                    $output.=' <tr>
                            <td colspan="4" style="text-align:left;">'.$papers.'</td>
                            <td colspan="1">'.$mark3.'</td>
                        </tr>';
                }
                    $output.=' </tbody>
            </table>
            <table class="table table-bordered" style="margin-top:10px;">
                <thead class="colspanHead">
                    <tr>
                        <td colspan="5" style="text-align:center; border: 1px solid black;">
                        '.$special_subjects2.': Morality (listed in the third semester)</td>
                        
                    </tr>
                </thead>
                <tbody>';
                $studata = [
                    'branch_id' => session()->get('branch_id'),
                    'student_id' => $stu['student_id'],
                    'exam_id' => $request->exam_id,
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'semester_id' => $request->semester_id,
                    'session_id' => $request->session_id,
                    'subject' => $special_subjects2,
                    'paper' => $special_paper11,
                    'academic_session_id' => $request->academic_year
                    
                    ];
                    $getmarks = Helper::PostMethod(config('constants.api.stuexam_spmarklist'), $studata);
                    // $mark1=(isset($getmarks['data']['Semester1']['freetext']) && $getmarks['data']['Semester1']['freetext']!=null)?$getmarks['data']['Semester1']['freetext']:'';
                    //$mark2=(isset($getmarks['data']['Semester2']['freetext']) && $getmarks['data']['Semester2']['freetext']!=null)?$getmarks['data']['Semester2']['freetext']:'';
                    $mark3=(isset($getmarks['data']['Semester3']['freetext']) && $getmarks['data']['Semester3']['freetext']!=null)?$getmarks['data']['Semester3']['freetext']:'';
                    
                    $output.='<tr>
                        <td colspan="5" style="height:60px;">'.$mark3.'</td>
                        
                    </tr>
                </tbody>
            </table>
            
            <table class="table table-bordered" style="margin-top:10px;">
                <thead class="colspanHead">
                    <tr>
                        <td colspan="5" style="text-align:center; border: 1px solid black;">
                        '.$special_subjects3.'. (listed for each semester)							</td>
                        
                    </tr>
                </thead>
                <tbody>';
                $studata = [
                    'branch_id' => session()->get('branch_id'),
                    'student_id' => $stu['student_id'],
                    'exam_id' => $request->exam_id,
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'semester_id' => $request->semester_id,
                    'session_id' => $request->session_id,
                    'subject' => $special_subjects3,
                    'paper' => $special_paper12,
                    'academic_session_id' => $request->academic_year
                    
                    ];
                    $getmarks = Helper::PostMethod(config('constants.api.stuexam_spmarklist'), $studata);
                    $mark1=(isset($getmarks['data']['Semester1']['freetext']) && $getmarks['data']['Semester1']['freetext']!=null)?$getmarks['data']['Semester1']['freetext']:'';
                    $mark2=(isset($getmarks['data']['Semester2']['freetext']) && $getmarks['data']['Semester2']['freetext']!=null)?$getmarks['data']['Semester2']['freetext']:'';
                    $mark3=(isset($getmarks['data']['Semester3']['freetext']) && $getmarks['data']['Semester3']['freetext']!=null)?$getmarks['data']['Semester3']['freetext']:'';
                    
                    $output.='
                    <tr>
                        <td colspan="5" style="height:60px;text-align:left;">
                            '.$mark1.'<br>
                            
                            '.$mark2.'<br>
                            
                            '.$mark3.'<br>
                        
                    </tr>
                    
                </tbody>
            </table>
            
            <table class="table table-bordered" style="margin-top:10px;">
                <thead class="colspanHead">
                    <tr>
                        <td colspan="5" style="text-align:center; border: 1px solid black;">
                        '.$special_subjects4.' (described in the third semester)														</td>
                        
                    </tr>
                </thead>
                <tbody>';
                $studata = [
                    'branch_id' => session()->get('branch_id'),
                    'student_id' => $stu['student_id'],
                    'exam_id' => $request->exam_id,
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'semester_id' => $request->semester_id,
                    'session_id' => $request->session_id,
                    'subject' => $special_subjects4,
                    'paper' => $special_paper13,
                    'academic_session_id' => $request->academic_year
                    
                    ];
                    $getmarks = Helper::PostMethod(config('constants.api.stuexam_spmarklist'), $studata);
                   // $mark1=(isset($getmarks['data']['Semester1']['freetext']) && $getmarks['data']['Semester1']['freetext']!=null)?$getmarks['data']['Semester1']['freetext']:'';
                    //$mark2=(isset($getmarks['data']['Semester2']['freetext']) && $getmarks['data']['Semester2']['freetext']!=null)?$getmarks['data']['Semester2']['freetext']:'';
                    $mark3=(isset($getmarks['data']['Semester3']['freetext']) && $getmarks['data']['Semester3']['freetext']!=null)?$getmarks['data']['Semester3']['freetext']:'';
                    //dd($getmarks);
                    $output.='
                    <tr>
                        <td colspan="5" style="height:60px;">'.$mark3.'</td>
                        
                    </tr>
                    
                </tbody>
            </table>
					
					<p style="text-align:left;font-size:9px;">*The contents of the first and second semester will be communicated in a three-parties meeting.</p>
					
					<table class="table table-bordered"style="margin-top:10px;">
						<thead class="colspanHead">
							
						</thead>
						<tbody>
							<tr>
								<td colspan="1" style="text-align:left;height:40px;">Principal <br><br></td>
								
								
								<td colspan="1" style="text-align:left;height:40px;">Class Teacher<br><br></td>
								
							</tr>
							
							
						</tbody>
					</table>
				</td>
			</tr>
		</table>
        <div style="page-break-after: always;"></div>';
        }
        
        $output .= '</body>
            </html';
            //             $output .= '</main>
            //      </body>
            //  </html>';
            $pdf = \App::make('dompdf.wrapper');
            // set size
            $customPaper = array(0, 0, 792.00, 1224.00);
            $pdf->set_paper($customPaper);
            $pdf->loadHTML($output);
            // filename
            $now = now();
            $name = strtotime($now);
            $fileName = __('messages.report_card') . $name . ".pdf";
            return $pdf->download($fileName);
            // return $pdf->stream();
        
    }
    public function downbysecreportcard(Request $request)
    {
        $paper=array('Listening','Reading','Speaking','Writing','Attitude');
        $data = [
            'branch_id' => session()->get('branch_id'),
            'exam_id' => $request->exam_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_year' => $request->academic_year
            
        ];
        
        //dd($data);
        $paper1=__('messages.paper1');
        $paper2=__('messages.paper2');        
        $paper3=__('messages.paper3');
        $paper4=__('messages.paper4');
        $paper_list=[$paper1,$paper2,$paper3,$paper4];
        
        $language=__('messages.language');
        $language1=__('messages.language1');
        $society=__('messages.society');
        $math=__('messages.math');
        $music=__('messages.music');
        $life=__('messages.life');
        $art=__('messages.art');
        $sports=__('messages.sports');
        $science=__('messages.science');
        $home_economic=__('messages.home_economic');
        $tech_home_economic=__('messages.tech_home_economic');
        $english=__('messages.english');
        
        
        $subjectlist=[$language1,$society,$math, $science,$music,$art, $sports,$tech_home_economic,$english];
         // Exam Special Subjects
         $special_subjects1=__('messages.special_subjects1');
         $special_subjects2=__('messages.special_subjects2');
         $special_subjects3=__('messages.special_subjects3');
         $special_subjects4=__('messages.special_subjects4');
         
         $special_paper1=__('messages.special_paper1');
         $special_paper2=__('messages.special_paper2');        
         $special_paper3=__('messages.special_paper3');
         $special_paper4=__('messages.special_paper4');
         $special_paper5=__('messages.special_paper5');        
         $special_paper6=__('messages.special_paper6');
         $special_paper7=__('messages.special_paper7');
         $special_paper8=__('messages.special_paper8');        
         $special_paper9=__('messages.special_paper9');
         $special_paper10=__('messages.special_paper10');
         $special_paper11=__('messages.special_paper11');        
         $special_paper12=__('messages.special_paper12');        
         $special_paper13=__('messages.special_paper13');
         $special_paper_list=[$special_paper1,$special_paper2,$special_paper3,$special_paper4,$special_paper5,$special_paper6,$special_paper7,$special_paper8,$special_paper9,$special_paper10];
         
         // Get Months
        $month1=__('messages.january');
        $month2=__('messages.february');        
        $month3=__('messages.march');
        $month4=__('messages.april');
        $month5=__('messages.may');        
        $month6=__('messages.june');
        $month7=__('messages.july');
        $month8=__('messages.august');        
        $month9=__('messages.september');
        $month10=__('messages.october');
        $month11=__('messages.november');        
        $month12=__('messages.december');
        $month_list=['',$month1,$month2,$month3,$month4,$month5,$month6,$month7,$month8,$month9,$month10,$month11,$month12];

        //dd($data);
        
        $getstudents = Helper::PostMethod(config('constants.api.exam_studentslist'), $data);
        $grade = Helper::PostMethod(config('constants.api.class_details'), $data);
        $section = Helper::PostMethod(config('constants.api.section_details'), $data);
        
        $footer_text = session()->get('footer_text');

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
        }';
        $output .= '</style>';
        $output .= "</head>";
        $output .= '<body>';
        
        $sno=0;
		foreach($getstudents['data'] as $stu)
        {
            $sno++;
            $output .= '<table class="main" width="100%">
            <tr>
            <td colspan="5"> <h4>'.__('messages.pdfschool_name').'</h4> </td> 
        </tr>
        <tr>
            <td >
                <h4>'.$grade['data']['short_name'].'</h4>
            </td>
            <td>
                <h4>'.$request->semester_id.' '.__('messages.semester').'</h4>
            </td>
            <td>
                <h4>Notification</h4>
            </td>
            <td style=" border: 1px solid black;">Class : '.$section['data']['name'].'</td>
            <td style=" border: 1px solid black;">No : '.$sno.'</td>
        </tr>
        
        <tr style="height:60px;">
            <th colspan="2" style=" border: 1px solid black;vertical-align: top;border-right-style: hidden;">Name</th>
            <th colspan="3"style=" border: 1px solid black;vertical-align: inherit;">'.$stu['name'].'</th>
        </tr>
            <tr style="height:60px;">
                <td colspan="3">
                    <table class="table table-bordered table-responsive">
                        <thead class="colspanHead">
                            <tr>
                                <td  style="text-align:center; border: 1px solid black;">
                                Transcript of the study</td>
                                <td colspan="1" style="text-align:center; border: 1px solid black;width:200px;">
                                Evaluation Perspective</td>
                                <td colspan="3" style="text-align:left; border: 1px solid black;">
                                    ( A Sufficient achievement of the target )<br>
                                    ( B Generally achieved )<br>
                                ( C Insufficient achievement )<br></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="1" >Subject</td>
                                <td colspan="1" style="text-align:left;">Learning Status by Perspective</td>
                                <td colspan="1"  >1 Semester</td>
                                <td colspan="1"  >2 Semester</td>
                                <td colspan="1"  >3 Semester</td>
                                
                            </tr>
                        
                         </tbody>';
                                
                                foreach($subjectlist as $sub)
                                { $i=0;
                                    foreach($paper_list as $papers)
                                    {
                                        $i++;
                                        $studata = [
                                        'branch_id' => session()->get('branch_id'),
                                        'student_id' => $stu['student_id'],
                                        'exam_id' => $request->exam_id,
                                        'class_id' => $request->class_id,
                                        'section_id' => $request->section_id,
                                        'semester_id' => $request->semester_id,
                                        'session_id' => $request->session_id,
                                        'subject' => $sub,
                                        'paper' => $papers,
                                        'academic_session_id' => $request->academic_year
                                        
                                    ];
                                    $getmarks = Helper::PostMethod(config('constants.api.stuexam_marklist'), $studata);
                                    
                                    $mark1=(isset($getmarks['data']['Semester1']['grade']) && $getmarks['data']['Semester1']['grade']!=null)?$getmarks['data']['Semester1']['grade']:'';
                                    $mark2=(isset($getmarks['data']['Semester2']['grade']) && $getmarks['data']['Semester2']['grade']!=null)?$getmarks['data']['Semester2']['grade']:'';
                                    $mark3=(isset($getmarks['data']['Semester3']['grade']) && $getmarks['data']['Semester3']['grade']!=null)?$getmarks['data']['Semester3']['grade']:'';
                                    
                                    if($i==1)
                                    {
                                $output.=' <tbody style="border: 1px solid black;">';
                                    }
                        
                                    $output.=' <tr>';
                                    if($i==1)
                                    {
                                        $output.='<td rowspan="4" style="width: 0px;">'.$sub.'</td>';
                                    }
                                    $output.='<td  style="text-align:left;">'.$papers.'</td>
                                    <td>'.$mark1.'</td>
                                    <td>'.$mark2.'</td>
                                    <td>'.$mark3.'</td>                            
                                </tr>';
                                if($i==4)
                                    {
                                        $output.='</tbody>';
                                    }
                                }
                            }         
                            $output.='</table>
                    
                                    <h6>*Grades at the end of the school year include all grades from the 1st ~ 3rd semesters.</h6>
                                
                    
                    <table class="table table-bordered table-responsive">
                        <thead class="colspanHead" >
                            <tr>
                                <th style="border-bottom: 1px solid black;">Attendance records</th>
                                <th style="border-bottom: 1px solid black;">Number of school days</th>
                                <th style="border-bottom: 1px solid black;">Suspension of attendance</th>
                                <th style="border-bottom: 1px solid black;">Number of days you have to attend</th>
                                <th style="border-bottom: 1px solid black;">Number of days absent</th>
                                <th style="border-bottom: 1px solid black;">Number of days of attendance</th>
                                <th style="border-bottom: 1px solid black;">Late</th>
                                <th style="border-bottom: 1px solid black;">Early</th>
                            </tr>
                        </thead>
                        <tbody style="border: 1px solid black;">';
                        $data = [
                            'branch_id' => session()->get('branch_id'),
                            'exam_id' => $request->exam_id,
                            'class_id' => $request->class_id,
                            'section_id' => $request->section_id,
                            'semester_id' => $request->semester_id,
                            'session_id' => $request->session_id,
                            'academic_year' => $request->academic_year
                            
                        ];
                        $acdata = [
                            'branch_id' => session()->get('branch_id'),                               
                            'id' => $request->academic_year
                            
                        ];
                        
                        $acyear = Helper::PostMethod(config('constants.api.academic_year_details'), $acdata);
                        //dd($acyear['data']['name']);
                        $acy=explode('-',$acyear['data']['name']);
                        $fromyear= $acy[0]; $toyear= $acy[1];
                        // dd($fromyear);
                        for($m=4;$m<=12;$m++)
                        {
                            $attdata= [
                                'branch_id' => session()->get('branch_id'),                               
                                'student_id' => $stu['student_id'],
                                'atdate' => str_pad($m, 2, "0", STR_PAD_LEFT).'-'.$fromyear
                                
                            ];
                            $montotaldays=cal_days_in_month(CAL_GREGORIAN,$m,$fromyear);
                            $suspension=0;
                            
                            $holidays = Helper::GetMethod(config('constants.api.getmonthlyholidays'));
                            $fmdata=$fromyear.'-'.$m.'-01';
                            $todata=$fromyear.'-'.$m.'-'.$montotaldays;
                            $start=strtotime( $fmdata);
                            $end=strtotime($todata);
                            $iter = 24*60*60; // whole day in seconds
                            $count = 0; // keep a count of Sats & Suns
                    
                            for($i = $start; $i <= $end; $i=$i+$iter)
                            {
                                if(Date('D',$i) == 'Sat' || Date('D',$i) == 'Sun')
                                {
                                    $count++;
                                }
                            }
                            
                            $totalweekends= $count;
                            
                            $totaldays=$montotaldays-$holidays['data']-$totalweekends;
                            $getattendance = Helper::PostMethod(config('constants.api.studentmonthly_attendance'), $attdata);
                           
                            $totalcomimg= $totaldays-$suspension;
                            $totpres=$getattendance['data'][0]['presentCount'];
                            $totabs=$getattendance['data'][0]['absentCount'];
                            $totlate=$getattendance['data'][0]['lateCount'];
                            $totexc=$getattendance['data'][0]['excusedCount'];
                            $output.='<tr>
                            <td>'.$month_list[$m].'</td>
                            <td>'.$totaldays.'</td>
                            <td>'.$suspension.'</td>
                            <td>'.$totalcomimg.'</td>
                            <td>'.$totpres.'</td>
                            <td>'.$totabs.'</td>
                            <td>'.$totlate.'</td>
                            <td>'.$totexc.'</td>
                        </tr>';
                        }
                        for($m=1;$m<=3;$m++)
                        {
                            $attdata= [
                                'branch_id' => session()->get('branch_id'),                               
                                'student_id' => $stu['student_id'],
                                'atdate' => str_pad($m, 2, "0", STR_PAD_LEFT).'-'.$toyear
                                
                            ];
                            $montotaldays=cal_days_in_month(CAL_GREGORIAN,$m,$toyear);
                            $suspension=0;
                            
                            $holidays = Helper::GetMethod(config('constants.api.getmonthlyholidays'));
                            $fmdata=$toyear.'-'.$m.'-01';
                            $todata=$toyear.'-'.$m.'-'.$montotaldays;
                            $start=strtotime( $fmdata);
                            $end=strtotime($todata);
                            $iter = 24*60*60; // whole day in seconds
                            $count = 0; // keep a count of Sats & Suns
                    
                            for($i = $start; $i <= $end; $i=$i+$iter)
                            {
                                if(Date('D',$i) == 'Sat' || Date('D',$i) == 'Sun')
                                {
                                    $count++;
                                }
                            }
                            
                            $totalweekends= $count;
                            
                            $totaldays=$montotaldays-$holidays['data']-$totalweekends;
                            $getattendance = Helper::PostMethod(config('constants.api.studentmonthly_attendance'), $attdata);
                            
                            $totalcomimg= $totaldays-$suspension;
                            $totpres=$getattendance['data'][0]['presentCount'];
                            $totabs=$getattendance['data'][0]['absentCount'];
                            $totlate=$getattendance['data'][0]['lateCount'];
                            $totexc=$getattendance['data'][0]['excusedCount'];
                            $output.='<tr>
                            <td>'.$month_list[$m].'</td>
                            <td>'.$totaldays.'</td>
                            <td>'.$suspension.'</td>
                            <td>'.$totalcomimg.'</td>
                            <td>'.$totpres.'</td>
                            <td>'.$totabs.'</td>
                            <td>'.$totlate.'</td>
                            <td>'.$totexc.'</td>
                        </tr>';
                        }                     
                        
                        
                    $output.='</tbody>
                        
                        
                        
                    </table>
                </td>
                <td colspan="2">
                <table class="table table-bordered">
                <thead class="colspanHead">
                    <tr>
                        <td colspan="4" style="text-align:center; border: 1px solid black;vertical-align: middle;">
                        '.$special_subjects1.'</td>
                        <td colspan="1" style="text-align:center; border: 1px solid black;">
                            (Listed in the third semester)<br>
                        ( O Excellent)</td>
                    </tr>
                </thead>
                <tbody>';
                foreach($special_paper_list as $papers)
                {
                    $i++;
                    $studata = [
                    'branch_id' => session()->get('branch_id'),
                    'student_id' => $stu['student_id'],
                    'exam_id' => $request->exam_id,
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'semester_id' => $request->semester_id,
                    'session_id' => $request->session_id,
                    'subject' => $special_subjects1,
                    'paper' => $papers,
                    'academic_session_id' => $request->academic_year
                    
                    ];
                    $getmarks = Helper::PostMethod(config('constants.api.stuexam_marklist'), $studata);
                    //dd($getmarks);
                    $mark3=(isset($getmarks['data']['Semester3']['grade_name']) && $getmarks['data']['Semester3']['grade_name']=="Excellent")?'<input type="radio">':'';
                    
                    $output.=' <tr>
                            <td colspan="4" style="text-align:left;">'.$papers.'</td>
                            <td colspan="1">'.$mark3.'</td>
                        </tr>';
                }
                    $output.=' </tbody>
            </table>
            <table class="table table-bordered" style="margin-top:10px;">
                <thead class="colspanHead">
                    <tr>
                        <td colspan="5" style="text-align:center; border: 1px solid black;">
                        '.$special_subjects2.' : Morality (listed in the third semester)</td>
                        
                    </tr>
                </thead>
                <tbody>';
                $studata = [
                    'branch_id' => session()->get('branch_id'),
                    'student_id' => $stu['student_id'],
                    'exam_id' => $request->exam_id,
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'semester_id' => $request->semester_id,
                    'session_id' => $request->session_id,
                    'subject' => $special_subjects2,
                    'paper' => $special_paper11,
                    'academic_session_id' => $request->academic_year
                    
                    ];
                    $getmarks = Helper::PostMethod(config('constants.api.stuexam_spmarklist'), $studata);
                    // $mark1=(isset($getmarks['data']['Semester1']['freetext']) && $getmarks['data']['Semester1']['freetext']!=null)?$getmarks['data']['Semester1']['freetext']:'';
                    //$mark2=(isset($getmarks['data']['Semester2']['freetext']) && $getmarks['data']['Semester2']['freetext']!=null)?$getmarks['data']['Semester2']['freetext']:'';
                    $mark3=(isset($getmarks['data']['Semester3']['freetext']) && $getmarks['data']['Semester3']['freetext']!=null)?$getmarks['data']['Semester3']['freetext']:'';
                    
                    $output.='<tr>
                        <td colspan="5" style="height:60px;">'.$mark3.'</td>
                        
                    </tr>
                </tbody>
            </table>
            
            <table class="table table-bordered" style="margin-top:10px;">
                <thead class="colspanHead">
                    <tr>
                        <td colspan="5" style="text-align:center; border: 1px solid black;">
                        '.$special_subjects3.' (listed for each semester)							</td>
                        
                    </tr>
                </thead>
                <tbody>';
                $studata = [
                    'branch_id' => session()->get('branch_id'),
                    'student_id' => $stu['student_id'],
                    'exam_id' => $request->exam_id,
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'semester_id' => $request->semester_id,
                    'session_id' => $request->session_id,
                    'subject' => $special_subjects3,
                    'paper' => $special_paper12,
                    'academic_session_id' => $request->academic_year
                    
                    ];
                    $getmarks = Helper::PostMethod(config('constants.api.stuexam_spmarklist'), $studata);
                    $mark1=(isset($getmarks['data']['Semester1']['freetext']) && $getmarks['data']['Semester1']['freetext']!=null)?$getmarks['data']['Semester1']['freetext']:'';
                    $mark2=(isset($getmarks['data']['Semester2']['freetext']) && $getmarks['data']['Semester2']['freetext']!=null)?$getmarks['data']['Semester2']['freetext']:'';
                    $mark3=(isset($getmarks['data']['Semester3']['freetext']) && $getmarks['data']['Semester3']['freetext']!=null)?$getmarks['data']['Semester3']['freetext']:'';
                    
                    $output.='
                    <tr>
                        <td colspan="5" style="height:60px;text-align:left;">
                            '.$mark1.'<br>
                            
                            '.$mark2.'<br>
                            
                            '.$mark3.'<br>
                        
                    </tr>
                    
                </tbody>
            </table>
            
            <table class="table table-bordered" style="margin-top:10px;">
                <thead class="colspanHead">
                    <tr>
                        <td colspan="5" style="text-align:center; border: 1px solid black;">
                        '.$special_subjects4.' (described in the third semester)														</td>
                        
                    </tr>
                </thead>
                <tbody>';
                $studata = [
                    'branch_id' => session()->get('branch_id'),
                    'student_id' => $stu['student_id'],
                    'exam_id' => $request->exam_id,
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'semester_id' => $request->semester_id,
                    'session_id' => $request->session_id,
                    'subject' => $special_subjects4,
                    'paper' => $special_paper13,
                    'academic_session_id' => $request->academic_year
                    
                    ];
                    $getmarks = Helper::PostMethod(config('constants.api.stuexam_spmarklist'), $studata);
                   // $mark1=(isset($getmarks['data']['Semester1']['freetext']) && $getmarks['data']['Semester1']['freetext']!=null)?$getmarks['data']['Semester1']['freetext']:'';
                    //$mark2=(isset($getmarks['data']['Semester2']['freetext']) && $getmarks['data']['Semester2']['freetext']!=null)?$getmarks['data']['Semester2']['freetext']:'';
                    $mark3=(isset($getmarks['data']['Semester3']['freetext']) && $getmarks['data']['Semester3']['freetext']!=null)?$getmarks['data']['Semester3']['freetext']:'';
                    //dd($getmarks);
                    $output.='
                    <tr>
                        <td colspan="5" style="height:60px;">'.$mark3.'</td>
                        
                    </tr>
                    
                </tbody>
            </table>
                    
                                    <h6 style="text-align:end;">*The contents of the first and second semester will be communicated in a three-parties meeting.</h6>
                                
                    
                    <table class="table table-bordered"style="margin-top:12px;">
                        <thead class="colspanHead">
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2" style="text-align:left;width:0px;">Principal<br><br><br><br></td>
                                
                                <td colspan="3" style="text-align:left;">Class Teacher<br><br><br><br></td>
                                
                            </tr>
                            
                        </tbody>
                    </table>
                </td>
            </tr>
            </table>
        <div style="page-break-after: always;"></div>';
        }
        
        $output .= '</body>
            </html';
            //             $output .= '</main>
            //      </body>
            //  </html>';
            $pdf = \App::make('dompdf.wrapper');
            // set size
            $customPaper = array(0, 0, 792.00, 1224.00);
            $pdf->set_paper($customPaper);
            $pdf->loadHTML($output);
            // filename
            $now = now();
            $name = strtotime($now);
            $fileName = __('messages.report_card') . $name . ".pdf";
            return $pdf->download($fileName);
            // return $pdf->stream();
        
    }
    public function downbyecreport(Request $request)
    {
        $paper=array('Listening','Reading','Speaking','Writing','Attitude');
        $data = [
            'branch_id' => session()->get('branch_id'),
            'exam_id' => $request->exam_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_year' => $request->academic_year
            
        ];
        
        
        $getstudents = Helper::PostMethod(config('constants.api.exam_studentslist'), $data);
        
        $footer_text = session()->get('footer_text');

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
        <style>
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
            text-align: left;
			}
			
			
			table td {
            overflow: hidden;
           
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
            background: linear-gradient(to top right, #fff calc(50% - 1px), black, #fff calc(50% + 1px))
			}
			
			table {
            width: 100%;
			}
			
			
			.line {
            position: absolute;
            height: 40px; // adjust height td
            top: 40px;
            bottom: 0;
            margin: auto;
            left: -5px;
            width: 100%;
            border-top: 1px solid #000;
            // adjust height td
            -webkit-transform: rotate(14deg);
            -ms-transform: rotate(14deg);
            transform: rotate(14deg);
			}
			
			.diagonal {
            width: 150px;
            height: 40px;
			}
			
			.diagonal span.lb {
            position: absolute;
            bottom: 2px;
            left: 2px;
			}
			
			.diagonal span.rt {
            position: absolute;
            top: 2px;
            right: 2px;
			}
			table,tr,td
			{
			border:none;
			}
		</style>';
        $output .= '</style>';
        $output .= "</head>";
        $output .= '<body>';
        $sno=0;
        
        $grade = Helper::PostMethod(config('constants.api.class_details'), $data);
        $section = Helper::PostMethod(config('constants.api.section_details'), $data);

        $acdata = [
            'branch_id' => session()->get('branch_id'),                               
            'id' => $request->academic_year            
        ];
        $termdata = [
            'branch_id' => session()->get('branch_id'),                               
            'id' => $request->exam_id
            
        ];
        $term = Helper::PostMethod(config('constants.api.exam_details'), $termdata);
        $acyear = Helper::PostMethod(config('constants.api.academic_year_details'), $acdata);

        //dd($acyear['data']['name']);
        $acy=$acyear['data']['name'];
		foreach($getstudents['data'] as $stu)
        {
            $sno++; 
        $output .= '<table class="main" width="100%">
			<tr >
				<td colspan="3" class="content-wrap aligncenter" style="margin: 0;padding: 20px;"
				align="center">
					
					
					<h1 style="margin-left: 15px;">'.__('messages.pdfschool_name').'</h1>
				</td>
			</tr>
			<tr>
				
				<td>
					<h4>'.$acy.'</h4>
				</td>
				<td>
					<h4>English Communication</h4>
				</td>
				<td>
					<h4>'.$term['data']['name'].'</h4>
				</td>
			</tr>
			<tr>  <td>
				<h5>Number</h5>
				<h4>'.$stu['roll'].'</h4>
			</td>
			
			<td>
				<h5>EC-Class</h5>
				<h4>Balsam</h4>
				
			</td>
			<td>
				<h5>Level</h5>
				<h4>Advanced</h4>
				
			</td>
			</tr>
			<tr>  
				<td>
					<h3>Student Name</h3>
				</td>
				<td colspan="2" >
					<h3>'.$stu['name'].'</h3>
				</td>
				
			</tr>
			<tr> 
				<td colspan="3" >
					<table class="table table-bordered">
						<thead class="colspanHead">
							<tr>
								<td colspan="2"
								style="text-align:center; border: 1px solid black;background-color:#40403a57">
								Listening</td>
							</tr>
						</thead>
						<tbody>';
                        $pdata = [
                            'branch_id' => session()->get('branch_id'),
                            'exam_id' => $request->exam_id,
                            'class_id' => $request->class_id,
                            'section_id' => $request->section_id,
                            'semester_id' => $request->semester_id,
                            'session_id' => $request->session_id,
                            'academic_session_id' => $request->academic_year,
                            'student_id' => $stu['student_id'],
                            'paper' => 'Listening'
                            
                        ];
                        $Getpaper = Helper::PostMethod(config('constants.api.exam_papermarks'), $pdata);
                        //dd($Getpaper);
                        foreach($Getpaper['data'] as $listing)
                        { 
                            $output.='<tr>
								<td>'.$listing['notes'].'</td>
								<td>'.$listing['grade'].'</td>
							</tr>';
                        }
                            
                        $output.='<tr>
								<td colspan="2"
								style="text-align:center; border: 1px solid black;background-color:#40403a57">
								Reading</td>
							</tr>';
                            $pdata = [
                                'branch_id' => session()->get('branch_id'),
                                'exam_id' => $request->exam_id,
                                'class_id' => $request->class_id,
                                'section_id' => $request->section_id,
                                'semester_id' => $request->semester_id,
                                'session_id' => $request->session_id,
                                'academic_session_id' => $request->academic_year,
                                'student_id' => $stu['student_id'],
                                'paper' => 'Reading'
                                
                            ];
                            $Getpaper = Helper::PostMethod(config('constants.api.exam_papermarks'), $pdata);
                            //dd($Getpaper);
                            foreach($Getpaper['data'] as $Reading)
                            { 
                                $output.='<tr>
                                    <td>'.$Reading['notes'].'</td>
                                    <td>'.$Reading['grade'].'</td>
                                </tr>';
                            }                             
                        $output.='<tr>
								<td colspan="2"
								style="text-align:center; border: 1px solid black;background-color:#40403a57">
								Speaking</td>
							</tr>';
                            $pdata = [
                                'branch_id' => session()->get('branch_id'),
                                'exam_id' => $request->exam_id,
                                'class_id' => $request->class_id,
                                'section_id' => $request->section_id,
                                'semester_id' => $request->semester_id,
                                'session_id' => $request->session_id,
                                'academic_session_id' => $request->academic_year,
                                'student_id' => $stu['student_id'],
                                'paper' => 'Speaking'
                                
                            ];
                            $Getpaper = Helper::PostMethod(config('constants.api.exam_papermarks'), $pdata);
                            //dd($Getpaper);
                            foreach($Getpaper['data'] as $Speaking)
                            { 
                                $output.='<tr>
                                    <td>'.$Speaking['notes'].'</td>
                                    <td>'.$Speaking['grade'].'</td>
                                </tr>';
                            }
                            
							$output.='<tr>
								<td colspan="2"
								style="text-align:center; border: 1px solid black;background-color:#40403a57">
								Writing</td>
							</tr>';
                            $pdata = [
                                'branch_id' => session()->get('branch_id'),
                                'exam_id' => $request->exam_id,
                                'class_id' => $request->class_id,
                                'section_id' => $request->section_id,
                                'semester_id' => $request->semester_id,
                                'session_id' => $request->session_id,
                                'academic_session_id' => $request->academic_year,
                                'student_id' => $stu['student_id'],
                                'paper' => 'Writing'
                                
                            ];
                            $Getpaper = Helper::PostMethod(config('constants.api.exam_papermarks'), $pdata);
                            //dd($Getpaper);
                            foreach($Getpaper['data'] as $Writing)
                            { 
                                $output.='<tr>
                                    <td>'.$Writing['notes'].'</td>
                                    <td>'.$Writing['grade'].'</td>
                                </tr>';
                            }
                            
                            $output.='<tr>
								<td colspan="2"
								style="text-align:center; border: 1px solid black;background-color:#40403a57">
								Attitude</td>
							</tr>';
                            $pdata = [
                                'branch_id' => session()->get('branch_id'),
                                'exam_id' => $request->exam_id,
                                'class_id' => $request->class_id,
                                'section_id' => $request->section_id,
                                'semester_id' => $request->semester_id,
                                'session_id' => $request->session_id,
                                'academic_session_id' => $request->academic_year,
                                'student_id' => $stu['student_id'],
                                'paper' => 'Attitude'
                                
                            ];
                            $Getpaper = Helper::PostMethod(config('constants.api.exam_papermarks'), $pdata);
                            //dd($Getpaper);
                            foreach($Getpaper['data'] as $Attitude)
                            { 
                                $output.='<tr>
                                    <td>'.$Attitude['notes'].'</td>
                                    <td>'.$Attitude['grade'].'</td>
                                </tr>';
                            }                             
							
                            $output.='</tbody>
						
					</table>
				</td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2" >
					
					<h6> Results: Improving , Satisfactory , Excellent</h6>
				</td>
			</tr>
			<tr>
				<td colspan="3" >
					<table style="margin-top:30px">
						<tbody>
							<tr>
								<td colspan="24"
								style="text-align:center; border: 1px solid black;background-color:#40403a57;color:black;">
								Teachers Comments</td>
							</tr>';
                                    
                            $english_communication=__('messages.english_communication');        
                            $teachers_comment=__('messages.teachers_comment');
                            $studata = [
                                'branch_id' => session()->get('branch_id'),
                                'student_id' => $stu['student_id'],
                                'exam_id' => $request->exam_id,
                                'class_id' => $request->class_id,
                                'section_id' => $request->section_id,
                                'semester_id' => $request->semester_id,
                                'session_id' => $request->session_id,
                                'subject' => $english_communication,
                                'paper' => $teachers_comment,
                                'academic_session_id' => $request->academic_year
                                
                                ];
                                $getmarks = Helper::PostMethod(config('constants.api.stuexam_spmarklist'), $studata);
                                $mark1=(isset($getmarks['data']['Semester1']['freetext']) && $getmarks['data']['Semester1']['freetext']!=null)?$getmarks['data']['Semester1']['freetext']:'';
                                $mark2=(isset($getmarks['data']['Semester2']['freetext']) && $getmarks['data']['Semester2']['freetext']!=null)?$getmarks['data']['Semester2']['freetext']:'';
                                $mark3=(isset($getmarks['data']['Semester3']['freetext']) && $getmarks['data']['Semester3']['freetext']!=null)?$getmarks['data']['Semester3']['freetext']:'';
                                $sem=$request->semester_id;
                                $mark_list=['',$mark1,$mark2,$mark3];
							$output.='<tr>
								<td colspan="24"
								style="text-align:left; border: 1px solid black;height:100px;color:black;">
									'.$mark_list[$sem].'
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
					<td colspan="2">
					<h5> English Teachers Name</h5>
					</td>
					
					
					<td>
					<h5> </h5>
					
				</td>
			</tr>
			
		</table>
        <div style="page-break-after: always;"></div>';
        }
       
        $output .= '</body>
    </html';
            //             $output .= '</main>
            //      </body>
            //  </html>';
            $pdf = \App::make('dompdf.wrapper');
            // set size
            $customPaper = array(0, 0, 792.00, 1224.00);
            $pdf->set_paper($customPaper);
            $pdf->loadHTML($output);
            // filename
            $now = now();
            $name = strtotime($now);
            $fileName = __('messages.english_communication') . $name . ".pdf";
            return $pdf->download($fileName);
            // return $pdf->stream();
        
    }
    public function downbypersoanalreport(Request $request)
    {
        $paper=array('Listening','Reading','Speaking','Writing','Attitude');
        $data = [
            'branch_id' => session()->get('branch_id'),
            'exam_id' => $request->exam_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_year' => $request->academic_year
            
        ];
        $language=__('messages.language');
        $language1=__('messages.language1');
        $society=__('messages.society');
        $math=__('messages.math');
        $music=__('messages.music');
        $life=__('messages.life');
        $art=__('messages.art');
        $sports=__('messages.sports');
        $science=__('messages.science');
        $home_economic=__('messages.home_economic');
        $tech_home_economic=__('messages.tech_home_economic');
        $english=__('messages.english');
        $paper5=__('messages.paper5');
        
        
        $subjectlist=[$language1,$society,$math, $science,$english,$music,$art, $sports,$home_economic];
        
        $getstudents = Helper::PostMethod(config('constants.api.exam_studentslist'), $data);
        
        $footer_text = session()->get('footer_text');

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
        }';
        $output .= '</style>';
        $output .= "</head>";
        $output .= '<body>';
        $sno=0;
        
        $grade = Helper::PostMethod(config('constants.api.class_details'), $data);
        $section = Helper::PostMethod(config('constants.api.section_details'), $data);

        $acdata = [
            'branch_id' => session()->get('branch_id'),                               
            'id' => $request->academic_year            
        ];
        $termdata = [
            'branch_id' => session()->get('branch_id'),                               
            'id' => $request->exam_id
            
        ];
        $term = Helper::PostMethod(config('constants.api.exam_details'), $termdata);
        $acyear = Helper::PostMethod(config('constants.api.academic_year_details'), $acdata);

        //dd($acyear['data']['name']);
        $acy=$acyear['data']['name'];
		foreach($getstudents['data'] as $stu)
        {
            $sno++; 
        $output .= '<table class="main" width="100%">			
            <tr>
				<td colspan="5"> <h4>'.__('messages.pdfschool_name').'</h4>
				<h4>'.__('messages.individual_result').'  </h4></td> 
			</tr>
            <tr>
                <td >
					<h4>'.$grade['data']['short_name'].' </h4>
				</td>
				<td>
					<h4>'.$request->semester_id.' '.__('messages.semester').'</h4>
				</td>
				<td>
					<h4><h4>'.$term['data']['name'].'</h4> </h4>
				</td>
				<td style=" border: 1px solid black;">Class : '.$section['data']['name'].'</td>
				<td style=" border: 1px solid black;">No</td>
			</tr>
           
			<tr style="height:60px;">
				<th colspan="2" style=" border: 1px solid black;">Roll No : '.$stu['roll'].'</th>
				<th colspan="3"style=" border: 1px solid black;vertical-align: inherit;">Name :'.$stu['name'].'</th>
			</tr>
			<tr> 
				<td colspan="5" >
                <table class="main" width="100%">
                <thead>                
                    <tr>
                        <td></td>
                        <td>'.$language.'</td>
                        <td>'.$society.'</td>
                        <td>'.$math.'</td>
                        <td>'.$science.'</td>
                        <td>'.$english.'</td>
                        <td>'.$music.'</td>
                        <td>'.$art.'</td>
                        <td>'.$sports.'</td>
                        <td>'.$home_economic.'</td>
                        <td>'.__('messages.total5').'</td>
                        <td>'.__('messages.total9').'</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Personal point</td>';
                        $i=0; $total5=0;$total9=0;
                        foreach($subjectlist as $subjects)
                        {
                            $i++;
                            $studata = [
                            'branch_id' => session()->get('branch_id'),
                            'student_id' => $stu['student_id'],
                            'exam_id' => $request->exam_id,
                            'class_id' => $request->class_id,
                            'section_id' => $request->section_id,
                            'semester_id' => $request->semester_id,
                            'session_id' => $request->session_id,
                            'subject' => $subjects,
                            'paper' => $paper5,
                            'academic_session_id' => $request->academic_year
                            
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.stuexam_marklist'), $studata);
                            if($request->semester_id==1)
                            {
                                $mark=(isset($getmarks['data']['Semester1']['score']) && $getmarks['data']['Semester1']['score']!=null)?$getmarks['data']['Semester1']['score']:'';
                            }
                            else if($request->semester_id==2)
                            {
                                $mark=(isset($getmarks['data']['Semester2']['score']) && $getmarks['data']['Semester2']['score']!=null)?$getmarks['data']['Semester2']['score']:'';
                            }
                            else
                            {
                                $mark=(isset($getmarks['data']['Semester3']['score']) && $getmarks['data']['Semester3']['score']!=null)?$getmarks['data']['Semester3']['score']:'';
                            }
                            $output.='<td colspan="1">'.$mark.'</td>';
                            $mark=($mark!='')?$mark:0;
                            if($i<=5)
                            {
                                $total5+=$mark;
                            }
                            $total9+=$mark;
                        }
                            $output.='<td>'.$total5.'</td>
                                    <td>'.$total9.'</td>';
                        
                        $output.='</tr>
                    <tr>
                        <td>Grade Avarage</td>';
                        $i=0; $totalavg5=0;$totalavg9=0;
                        foreach($subjectlist as $subjects)
                        {
                            $i++;
                            $studata = [
                            'branch_id' => session()->get('branch_id'),
                            'student_id' => $stu['student_id'],
                            'exam_id' => $request->exam_id,
                            'class_id' => $request->class_id,
                            'section_id' => $request->section_id,
                            'semester_id' => $request->semester_id,
                            'session_id' => $request->session_id,
                            'subject' => $subjects,
                            'paper' => $paper5,
                            'academic_session_id' => $request->academic_year
                            
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.stuexam_avgmarklist'), $studata);
                            if($request->semester_id==1)
                            {
                                $mark=(isset($getmarks['data']['Semester1']['avg']) && $getmarks['data']['Semester1']['avg']!=null)?$getmarks['data']['Semester1']['avg']:'';
                            }
                            else if($request->semester_id==2)
                            {
                                $mark=(isset($getmarks['data']['Semester2']['avg']) && $getmarks['data']['Semester2']['avg']!=null)?$getmarks['data']['Semester2']['avg']:'';
                            }
                            else
                            {
                                $mark=(isset($getmarks['data']['Semester3']['avg']) && $getmarks['data']['Semester3']['avg']!=null)?$getmarks['data']['Semester3']['avg']:'';
                            }
                            $output.='<td colspan="1">'.$mark.'</td>';
                            $mark=($mark!='')?$mark:0;
                            if($i<=5)
                            {
                                $totalavg5+=$mark;
                            }
                            $totalavg9+=$mark;
                            $avgtotal5= $totalavg5/5;
                            $avgtotal9= $totalavg9/9;

                        }
                        $output.='  <td>'.round($avgtotal5, 2).'</td>
                        <td>'.round($avgtotal9, 2).'</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table class="main" width="100%">
                <thead>
                    <tr style="height:60px;">
                        <td>Achievements /Good things</td>
                        <td>Things that unable to achieve</td>
                        <td> Parent comment</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height:200px;"></td>
                        <td style="height:200px;"></td>
                        <td style="height:200px;"></td>
                    </tr>
                </tbody>
            </table>
				</td>
			</tr>
			
			
		</table>
        <div style="page-break-after: always;"></div>';
        }
       
        $output .= '</body>
    </html';
            //             $output .= '</main>
            //      </body>
            //  </html>';
            $pdf = \App::make('dompdf.wrapper');
            // set size
            $customPaper = array(0, 0, 792.00, 1224.00);
            $pdf->set_paper($customPaper);
            $pdf->loadHTML($output);
            // filename
            $now = now();
            $name = strtotime($now);
            $fileName = __('messages.personal_test_res') . $name . ".pdf";
            return $pdf->download($fileName);
            // return $pdf->stream();
        
    }
    public function downbysubject(Request $request)
    {
        $data = [
            'exam_id' => $request->exam_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_year' => $request->academic_year
        ];
        $tot_grade_calcu_byclass = Helper::PostMethod(config('constants.api.tot_grade_calcu_bySubject'), $data);
        // dd($tot_grade_calcu_byclass);
        $footer_text = session()->get('footer_text');

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
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color:  #111;
            text-align: center;
            line-height: 35px;
            }

        footer {
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color: #111;
            text-align: center;
            line-height: 35px;
        }';
        $output .= '</style>';
        $output .= "</head>";
        $output .= "<body><header> " .  __('messages.by_subject') . "</header>
        <footer>" . $footer_text . "</footer>";
        if ($tot_grade_calcu_byclass['code'] == "200") {
            $headers = $tot_grade_calcu_byclass['data']['headers'];
            $grade_list_master = $tot_grade_calcu_byclass['data']['grade_list_master'];
            // $output .= '<html>
            //         <head>
            //     <style>
            //         /** Define the margins of your page **/
            //         @page {
            //             margin: 100px 25px;
            //         }

            //         header {
            //             position: fixed;
            //             top: -60px;
            //             left: 0px;
            //             right: 0px;
            //             height: 50px;

            //             /** Extra personal styles **/
            //             background-color: #03a9f4;
            //             color: white;
            //             text-align: center;
            //             line-height: 35px;
            //         }

            //         footer {
            //             position: fixed; 
            //             bottom: -60px; 
            //             left: 0px; 
            //             right: 0px;
            //             height: 50px; 

            //             /** Extra personal styles **/
            //             background-color: #03a9f4;
            //             color: white;
            //             text-align: center;
            //             line-height: 35px;
            //         }
            //     </style>
            // </head><body>
            // <!-- Define header and footer blocks before your content -->
            // <header>
            // Paxsuzen
            // </header>
            // <footer>2020 - ' . date("Y") . ' &copy; by <a href="https://paxsuzen.com">Paxsuzen</a>.</footer><main>';
            $output .= '<div class="table-responsive">
        <table width="100%" style="border-collapse: collapse; border: 0px;">
           <thead>
              <tr>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.s.no') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.grade') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.class') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.subject_name') . '</th>
                 <th class="align-top th-sm - 6 rem" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.total_student') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.absent') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.present') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.subject_teacher_name') . '</th>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px;">' . $val['grade'] . '</th>';
            }
            $output .= '<th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.pass') . '</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.g') . '</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.gpa') . '</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.%') . '</th>
              </tr>
              <tr>';
            foreach ($headers as $val) {
                $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">%</td>';
            }
            $output .= '</tr>
           </thead>
           <tbody>';
            foreach ($grade_list_master as $key => $res) {
                $key++;
                $output .= '<tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;" rowspan="2">' . $key . '</td>
                 <td class="text-left" style="border: 1px solid; padding:12px;" rowspan="2"><label for="clsname">' . $res['class_name'] . '</label></td>
                 <td class="text-center" style="border: 1px solid; padding:12px;" rowspan="2"><label for="stdcount">' . $res['section_name'] . '</label></td>
                 <td class="text-left" style="border: 1px solid; padding:12px;" rowspan="2"><label for="clsname">' . $res['subject_name'] . '</label></td>
                 <td class="text-center" style="border: 1px solid; padding:12px;" rowspan="2"><label for="stdcount">' . $res['totalstudentcount'] . '</label></td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"><label for="stdcount">' . $res['absent_count'] . '</label></td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"><label for="stdcount">' . $res['present_count'] . '</label></td>
                 <td class="text-left" style="border: 1px solid; padding:12px;" rowspan="2"><label for="clsname">' . $res['teacher_name'] . '</label></td>';
                foreach ($headers as $resp) {
                    $obj = $res['gradecnt'];
                    if (array_key_exists($resp['grade'], $obj)) {
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">' . $obj[$resp['grade']] . '</td>';
                    } else {
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">0</td>';
                    }
                }
                $output .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['pass_count'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['fail_count'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;" rowspan="2">' . $res['gpa'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;" rowspan="2">' . $res['pass_percentage'] . '</td>
              </tr>';

                $absentPer = ($res['absent_count'] / $res['totalstudentcount']) * 100;
                $absentPer = number_format($absentPer, 2);
                $presentPer = ($res['present_count'] / $res['totalstudentcount']) * 100;
                $presentPer = number_format($presentPer, 2);
                $output .= '<tr>
                 <td class="text-left" style="border: 1px solid; padding:12px;"><label for="clsname">' . $absentPer . '</label></td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"><label for="stdcount">' . $presentPer . '</label></td>';
                foreach ($headers as $resp) {
                    $obj = $res['gradecnt'];
                    if (array_key_exists($resp['grade'], $obj)) {
                        $gradepercentage = ($obj[$resp['grade']] / $res['totalstudentcount']) * 100;
                        $gradepercentage = number_format($gradepercentage, 2);
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">' . $gradepercentage . '</td>';
                    } else {
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">0</td>';
                    }
                }
                $output .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['pass_percentage'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['fail_percentage'] . '</td>
              </tr>';
            }
            $output .= '</tbody></table></div>';
            //             $output .= '</main>
            //      </body>
            //  </html>';
            $pdf = \App::make('dompdf.wrapper');
            // set size
            $customPaper = array(0, 0, 1100.00, 567.00);
            $pdf->set_paper($customPaper);
            $pdf->loadHTML($output);
            // filename
            $now = now();
            $name = strtotime($now);
            $fileName = __('messages.by_subject') . $name . ".pdf";
            return $pdf->download($fileName);
            // return $pdf->stream();
        }
    }
    public function downbystudent(Request $request)
    {
        $data = [
            'exam_id' => $request->exam_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_year' => $request->academic_year
        ];
        $tot_grade_calcu_byclass = Helper::PostMethod(config('constants.api.tot_grade_calcu_byStudent'), $data);
        $footer_text = session()->get('footer_text');

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
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color:  #111;
            text-align: center;
            line-height: 35px;
            }

        footer {
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color: #111;
            text-align: center;
            line-height: 35px;
        }';
        $output .= '</style>';
        $output .= "</head>";
        $output .= "<body><header> " .  __('messages.by_student') . "</header>
        <footer>" . $footer_text . "</footer>";
        // $output = "";
        // dd($tot_grade_calcu_byclass);
        if ($tot_grade_calcu_byclass['code'] == "200") {
            $headers = $tot_grade_calcu_byclass['data']['headers'];
            $allbyStudent = $tot_grade_calcu_byclass['data']['allbyStudent'];
            $headercount = count($headers);
            $headercount = $headercount * 2;
            // dd($headercount);
            $output .= '<div class="table-responsive">
        <table width="100%" style="border-collapse: collapse; border: 0px;">
           <thead>
              <tr>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="3">' .  __('messages.s.no') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="3">' .  __('messages.student_name') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" colspan="' . $headercount . '">' .  __('messages.subject_name') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="3">' .  __('messages.gpa') . '</th>
             </tr><tr>';
            foreach ($headers as $val) {
                $output .=  '<th colspan="2" class="text-center" style="border: 1px solid; padding:12px;">' . $val['subject_name'] . '</th>';
            }
            $output .= '</tr><tr>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px;">' .  __('messages.mark') . '</th>
                    <th class="text-center" style="border: 1px solid; padding:12px;">' .  __('messages.grade') . '</th>';
            }
            $output .= '</tr>
           </thead>
           <tbody>';
            foreach ($allbyStudent as $key => $res) {
                $key++;
                $output .= '<tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $key . '</td>
                 <td class="text-left" style="border: 1px solid; padding:12px;">' . $res['student_name'] . '</td>';
                foreach ($headers as $resp) {
                    // header subject id
                    $subject_id = $resp['subject_id'];
                    //subject array
                    $marksArr = $res['student_class'];
                    // echo "<pre>";
                    // print_r($subject_id);
                    // print_r($marksArr);
                    $retVal = $this->search($marksArr, 'subject_id', $subject_id);
                    // if (array_search($subject_id, $marksArr)) {
                    if (isset($retVal)) {
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">' . $retVal[0]['marks'] . '</td>';
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">' . $retVal[0]['grade'] . '</td>';
                    } else {
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">-</td>';
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">-</td>';
                    }
                    // exit;
                }
                $output .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['gpa'] . '</td>
                </tr>';
            }
            $output .= '</tbody></table></div>';
            $pdf = \App::make('dompdf.wrapper');
            // set size
            $customPaper = array(0, 0, 1600.00, 567.00);
            $pdf->set_paper($customPaper);
            $pdf->loadHTML($output);
            // filename
            $now = now();
            $name = strtotime($now);
            $fileName =  __('messages.by_student') . $name . ".pdf";
            return $pdf->download($fileName);
            // return $pdf->stream();
        }
    }
    public function downbystaffleave(Request $request)
    {
        $data = [
            'department_id' => $request->department_id,
            'staff_id' => $request->staff_id,
            'academic_session_id' => $request->academic_session_id
        ];
        $leave_taken_history_by_staff = Helper::PostMethod(config('constants.api.leave_taken_history_by_staff'), $data);
        $footer_text = session()->get('footer_text');

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
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color:  #111;
            text-align: center;
            line-height: 35px;
            }

        footer {
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color: #111;
            text-align: center;
            line-height: 35px;
        }';
        $output .= '</style>';
        $output .= "</head>";
        $output .= "<body><header> " .  __('messages.leave_history_by_staff') . "</header>
        <footer>" . $footer_text . "</footer>";
        // $output = "";
        // dd($tot_grade_calcu_byclass);
        if ($leave_taken_history_by_staff['code'] == "200") {
            $headers = $leave_taken_history_by_staff['data']['headers'];
            $staff_leave_history = $leave_taken_history_by_staff['data']['staff_leave_history'];
            $headercount = count($headers);
            $headercount = $headercount * 3;
            // dd($headercount);
            $output .= '<div class="table-responsive">
        <table width="100%" style="border-collapse: collapse; border: 0px;">
           <thead>
              <tr>
              <th style="border: 1px solid; padding:12px;border-bottom-style: hidden"></th>
              <th style="border: 1px solid; padding:12px;border-bottom-style: hidden"></th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" colspan="' . $headercount . '">Leave Type</th>
             </tr><tr>';
            $output .=  '<th class="text-center" style="border-bottom-style: hidden;border-left: 1px solid; padding:12px;">Dep Name</th>';
            $output .=  '<th class="text-center" style="border-bottom-style: hidden;border-left: 1px solid; padding:12px;">Employee Name</th>';
            foreach ($headers as $val) {
                $output .=  '<th colspan="3" class="text-center" style="border: 1px solid; padding:12px;">' . $val['name'] . '</th>';
            }
            $output .= '</tr><tr>';
            $output .= '<th style="border: 1px solid; padding:12px;"></th>';
            $output .= '<th style="border: 1px solid; padding:12px;"></th>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px;">Entitlement</th>
                    <th class="text-center" style="border: 1px solid; padding:12px;">Taken</th>
                    <th class="text-center" style="border: 1px solid; padding:12px;">Balance</th>';
            }
            $output .= '</tr>
           </thead>
           <tbody>';
            foreach ($staff_leave_history as $key => $res) {
                $key++;
                $output .= '<tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['department_name'] . '</td>
                 <td class="text-left" style="border: 1px solid; padding:12px;">' . $res['name'] . '</td>';
                foreach ($headers as $resp) {
                    // header subject id
                    $id = $resp['id'];
                    //subject array
                    $marksArr = $res['leave_history'];
                    // echo "<pre>";
                    // print_r($subject_id);
                    // print_r($marksArr);
                    $retVal = $this->search($marksArr, 'leave_type', $id);
                    // if (array_search($subject_id, $marksArr)) {
                    if (isset($retVal)) {
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">' . $retVal[0]['overall_days_by_hours'] . '</td>';
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">' . $retVal[0]['used_leave_days_by_hours'] . '</td>';
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">' . $retVal[0]['balance_days_by_hours'] . '</td>';
                    } else {
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">-</td>';
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">-</td>';
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">-</td>';
                    }
                    // exit;
                }
                $output .= '</tr>';
            }
            $output .= '</tbody></table><br></div>';
        }
        // dd($output);
        $pdf = \App::make('dompdf.wrapper');
        // set size
        // $customPaper = array(0, 0, 1600.00, 567.00);
        $customPaper = array(0, 0, 2880.00, 1620.00);
        $pdf->set_paper($customPaper);
        $pdf->loadHTML($output);
        // filename
        $now = now();
        $name = strtotime($now);
        $fileName =  __('messages.leave_history_by_staff') . $name . ".pdf";
        return $pdf->download($fileName);
    }
    // return match key
    public function search($array, $key, $value)
    {
        $results = array();
        if (is_array($array)) {
            if (isset($array[$key]) && $array[$key] == $value) {
                $results[] = $array;
            }
            foreach ($array as $subarray) {
                $results = array_merge($results, $this->search($subarray, $key, $value));
            }
        }
        return $results;
    }
    public function downbyoverall(Request $request)
    {
        $data = [
            'exam_id' => $request->exam_id,
            'class_id' => $request->class_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_year' => $request->academic_year
        ];
        $tot_grade_calcu_byclass = Helper::PostMethod(config('constants.api.tot_grade_calcu_overall'), $data);
        $footer_text = session()->get('footer_text');

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
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color:  #111;
            text-align: center;
            line-height: 35px;
            }

        footer {
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color: #111;
            text-align: center;
            line-height: 35px;
        }';
        $output .= '</style>';
        $output .= "</head>";
        $output .= "<body><header> " .  __('messages.overall') . "</header>
        <footer>" . $footer_text . "</footer>";
        if ($tot_grade_calcu_byclass['code'] == "200") {
            $headers = $tot_grade_calcu_byclass['data']['headers'];
            $allbysubject = $tot_grade_calcu_byclass['data']['allbysubject'];
            // $output .= '<!-- Define header and footer blocks before your content -->
            // <header>
            // Paxsuzen
            // </header>
            // <footer>2020 - ' . date("Y") . ' &copy; by <a href="https://paxsuzen.com">Paxsuzen</a>.</footer><main>';
            $output .= '<div class="table-responsive">
        <table width="100%" style="border-collapse: collapse; border: 0px;">
           <thead>
              <tr>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.s.no') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.subject_name') . '</th>
                 <th class="align-top th-sm - 6 rem" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.total_student') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.absent') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.present') . '</th>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px;">' . $val['grade'] . '</th>';
            }
            $output .= '<th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.pass') . '</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.g') . '</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.gpa') . '</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">' .  __('messages.%') . '</th>
              </tr>
              <tr>';
            foreach ($headers as $val) {
                $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">%</td>';
            }
            $output .= '</tr>
           </thead>
           <tbody>';
            foreach ($allbysubject as $key => $res) {
                $key++;
                $output .= '<tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;" rowspan="2">' . $key . '</td>
                 <td class="text-left" style="border: 1px solid; padding:12px;" rowspan="2">' . $res['subject_name'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;" rowspan="2"><label for="stdcount">' . $res['addAllStudCnt'] . '</label></td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"><label for="stdcount">' . $res['absentCnt'] . '</label></td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"><label for="stdcount">' . $res['presentCnt'] . '</label></td>';
                foreach ($headers as $resp) {
                    $obj = $res['gradecnt'];
                    if (array_key_exists($resp['grade'], $obj)) {
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">' . $obj[$resp['grade']] . '</td>';
                    } else {
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">0</td>';
                    }
                }
                $output .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['passCnt'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['failCnt'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;" rowspan="2">' . $res['gpa'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;" rowspan="2">' . $res['pass_percentage'] . '</td>
              </tr>';

                $absentPer = ($res['absentCnt'] / $res['addAllStudCnt']) * 100;
                $absentPer = number_format($absentPer, 2);
                $presentPer = ($res['presentCnt'] / $res['addAllStudCnt']) * 100;
                $presentPer = number_format($presentPer, 2);
                // print_r($absentPer);
                // exit;
                $output .= '<tr>
                 <td class="text-left" style="border: 1px solid; padding:12px;"><label for="clsname">' . $absentPer . '</label></td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"><label for="stdcount">' . $presentPer . '</label></td>';
                foreach ($headers as $resp) {
                    $obj = $res['gradecnt'];
                    if (array_key_exists($resp['grade'], $obj)) {
                        $gradepercentage = ($obj[$resp['grade']] / $res['addAllStudCnt']) * 100;
                        $gradepercentage = number_format($gradepercentage, 2);
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">' . $gradepercentage . '</td>';
                    } else {
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">0</td>';
                    }
                }
                $output .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['pass_percentage'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['fail_percentage'] . '</td>
              </tr>';
            }
            $output .= '</tbody></table></div>';
            $output .= '</main></body></html>';
            $pdf = \App::make('dompdf.wrapper');
            // set size
            $customPaper = array(0, 0, 1200.00, 567.00);
            $pdf->set_paper($customPaper);
            $pdf->loadHTML($output);
            // filename
            $now = now();
            $name = strtotime($now);
            $fileName = __('messages.overall') . $name . ".pdf";
            return $pdf->download($fileName);
            // return $pdf->stream();
        }
    }
    public function downbystudentroll(Request $request)
    {
        $data = [
            'exam_id' => $request->exam_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'registerno' => $request->registerno,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_year' => $request->academic_year
        ];
        $tot_grade_calcu_byclass = Helper::PostMethod(config('constants.api.student_result'), $data);
        // dd($tot_grade_calcu_byclass);
        $footer_text = session()->get('footer_text');

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
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color:  #111;
            text-align: center;
            line-height: 35px;
            }

        footer {
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color: #111;
            text-align: center;
            line-height: 35px;
        }';
        $output .= '</style>';
        $output .= "</head>";
        $output .= "<body><header> " .  __('messages.individual_result') . "</header>
        <footer>" . $footer_text . "</footer>";
        if ($tot_grade_calcu_byclass['code'] == "200") {
            $student_details = $tot_grade_calcu_byclass['data']['student_details'];
            $headers = $tot_grade_calcu_byclass['data']['headers'];
            $allbyStudent = $tot_grade_calcu_byclass['data']['allbyStudent'];
            // student details
            $output .= '<div class="table-responsive">
                <table  width="100%" style="border-collapse: collapse; border: 0px;"><thead>';
            $output .= '<tr><th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.roll_no') . '</th>
            <td class="text-center" style="border: 1px solid; padding:12px;">' . $student_details['register_no'] . '</td></tr>';
            $output .= '<tr><th class="align-top" style="border: 1px solid; padding:12px;">Name</th>
            <td class="text-center" style="border: 1px solid; padding:12px;">' . $student_details['student_name'] . '</td></tr>';
            $output .= '<tr><th class="align-top" style="border: 1px solid; padding:12px;">DOB</th>
            <td class="text-center" style="border: 1px solid; padding:12px;">' . $student_details['birthday'] . '</td></tr>';
            $output .= '<tr><th class="align-top" style="border: 1px solid; padding:12px;">Grade</th>
            <td class="text-center" style="border: 1px solid; padding:12px;">' . $student_details['class_name'] . '</td></tr>';
            $output .= '<tr><th class="align-top" style="border: 1px solid; padding:12px;">Class</th>
            <td class="text-center" style="border: 1px solid; padding:12px;">' . $student_details['section_name'] . '</td></tr>';
            $output .= '</thead></table></div>';
            $output .= '<div class="table-responsive">
        <table width="100%" style="border-collapse: collapse; border: 0px;">
           <thead>
              <tr>
                 <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.s.no') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.student_name') . '</th>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px;">' . $val['subject_name'] . '</th>';
            }
            $output .= '<th class="text-center" style="border: 1px solid; padding:12px;">' .  __('messages.gpa') . '</th>';
            $output .= '</tr></thead><tbody>';
            foreach ($allbyStudent as $key => $res) {
                $key++;
                $output .= '<tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;" rowspan="2">' . $key . '</td>
                 <td class="text-left" style="border: 1px solid; padding:12px;" rowspan="2">' . $res['student_name'] . '</td>';
                foreach ($headers as $resp) {
                    // header subject id
                    $subject_id = $resp['subject_id'];
                    //subject array
                    $marksArr = $res['student_class'];
                    $retVal = $this->search($marksArr, 'subject_id', $subject_id);
                    if (isset($retVal)) {
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">' . $retVal[0]['grade'] . '</td>';
                    } else {
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">-</td>';
                    }
                    // exit;
                }
                $output .= '<td class="text-center" style="border: 1px solid; padding:12px;" rowspan="2">' . $res['gpa'] . '</td>
                </tr>';
                $output .= '<tr>';
                foreach ($headers as $resp) {
                    // header subject id
                    $subject_id = $resp['subject_id'];
                    //subject array
                    $marksArr = $res['student_class'];
                    $retVal = $this->search($marksArr, 'subject_id', $subject_id);
                    if (isset($retVal)) {
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">' . $retVal[0]['marks'] . '</td>';
                    } else {
                        $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">-</td>';
                    }
                }
                $output .= '</tr>';
            }
            $output .= '</tbody></table></div>';
            $pdf = \App::make('dompdf.wrapper');
            // set size
            $customPaper = array(0, 0, 1600.00, 567.00);
            $pdf->set_paper($customPaper);
            $pdf->loadHTML($output);
            // filename
            $now = now();
            $name = strtotime($now);
            $fileName = __('messages.individual_result') . $name . ".pdf";
            return $pdf->download($fileName);
            // return $pdf->stream();
        }
    }
    public function downbypaperwise(Request $request)
    {
        $data = [
            'exam_id' => $request->exam_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'subject_id' => $request->subject_id,
            'academic_session_id' => $request->academic_year
        ];
        $getExamPaperData = Helper::PostMethod(config('constants.api.get_exam_paper_res'), $data);
        $footer_text = session()->get('footer_text');

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
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color:  #111;
            text-align: center;
            line-height: 35px;
            }

        footer {
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color: #111;
            text-align: center;
            line-height: 35px;
        }';
        $output .= '</style>';
        $output .= "</head>";
        $output .= "<body><header> " .  __('messages.exam_paper_result') . "</header>
        <footer>" . $footer_text . "</footer>";
        if ($getExamPaperData['code'] == "200") {
            $headers = $getExamPaperData['data']['all_paper'];
            $get_subject_paper_marks = $getExamPaperData['data']['get_subject_paper_marks'];
            $output .= '<div class="table-responsive">
        <table width="100%" style="border-collapse: collapse; border: 0px;">
           <thead>
              <tr>
                 <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.s.no') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.student_name') . '</th>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px;">' . $val['paper_name'] . '</th>';
            }
            $output .= '<th class="text-center" style="border: 1px solid; padding:12px;">' .  __('messages.grade') . '</th>';
            $output .= '</tr></thead><tbody>';
            foreach ($get_subject_paper_marks as $key => $res) {
                $key++;
                $output .= '<tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $key . '</td>
                 <td class="text-left" style="border: 1px solid; padding:12px;">' . $res['name'] . '</td>';
                $paperRow = $res['papers'];
                foreach ($paperRow as $pap) {
                    $output .=  '<td class="text-center" style="border: 1px solid; padding:12px;">' . number_format($pap, 2) . '</td>';
                }
                $output .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['grade'] . '</td>
                </tr>';
            }
            $output .= '</tbody></table></div>';
            $pdf = \App::make('dompdf.wrapper');
            // set size
            $pdf->setPaper('a4', 'landscape')->setWarnings(false);
            $pdf->loadHTML($output);
            // filename
            $now = now();
            $name = strtotime($now);
            $fileName =  __('messages.exam_paper_result')  . $name . ".pdf";
            return $pdf->download($fileName);
            // return $pdf->stream();
        }
    }
    public function downbytest_paper(Request $request)
    {
        $data = [
            'exam_id' => $request->exam_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'subject_id' => $request->subject_id,
            'paper_id' => $request->paper_id,
            'academic_session_id' => $request->academic_session_id
        ];
        $getExamPaperData = Helper::PostMethod(config('constants.api.get_testresult_marks_subject_vs'), $data);
        $footer_text = session()->get('footer_text');

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
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color:  #111;
            text-align: center;
            line-height: 35px;
            }

        footer {
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color: #111;
            text-align: center;
            line-height: 35px;
        }';
        $output .= '</style>';
        $output .= "</head>";
        $output .= "<body><header> " .  __('messages.test') . "</header>
        <footer>" . $footer_text . "</footer>";
        if ($getExamPaperData['code'] == "200") {
            $get_subject_marks = $getExamPaperData['data']['get_subject_marks'];
            $output .= '<div class="table-responsive">
        <table width="100%" style="border-collapse: collapse; border: 0px;">
           <thead>
              <tr>
                 <th class="align-top" style="border: 1px solid; padding:12px;">S.no.</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">Student Name</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">Score</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">Grade</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">Pass/Fail</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">Ranking</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">Status</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">Memo</th>
                 ';
            $output .= '</tr></thead><tbody>';
            foreach ($get_subject_marks as $key => $res) {
                $key++;
                $output .= '<tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $key . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['name'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['score'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['grade'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['pass_fail'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['ranking'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['status'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . ($res['memo'] != "null" ? $res['memo'] : "") . '</td>';
                $output .= '</tr>';
            }
            $output .= '</tbody></table></div>';
            $pdf = \App::make('dompdf.wrapper');
            // set size
            $pdf->setPaper('a4', 'landscape')->setWarnings(false);
            // $paper_size = array(0, 0, 360, 360);
            // $pdf->set_paper($paper_size);
            $pdf->loadHTML($output);
            // filename
            $now = now();
            $name = strtotime($now);
            $fileName = "martkbypaper" . $name . ".pdf";
            return $pdf->download($fileName);
            // return $pdf->stream();
        }
    }
    public function timetable_pdf(Request $request)
    {
        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $footer_text = session()->get('footer_text');
        $timetable = Helper::PostMethod(config('constants.api.timetable_list'), $data);
        $days = array(
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday',
        );
        // $fonturl = asset('public/fonts/japanese/ipag.ttf');
        // $fonturl = asset('public/fonts/japanese/ipag.ttf');
        $fonturl = storage_path('fonts/ipag.ttf');
        // dd($fonturl);
        // $response = "";
        $response = "<!DOCTYPE html>";
        $response .= "<html><head>";
        // $response .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
        //     $response .='<style>';
        //     // $response .='* { font-family: Firefly Sung, DejaVu Sans, sans-serif; }';
        //     $response .='@font-face {
        //         font-family: ipag;
        //         font-style: normal;
        //         font-weight: normal;
        //         src: url("'.$fonturl.'");
        //    }
        //    body{ font-family: ipag !important;}';
        //     // $response .="@font-face {
        //     //     font-family: 'Firefly Sung';
        //     //     font-style: normal;
        //     //     font-weight: 400;
        //     //     src: url(http://eclecticgeek.com/dompdf/fonts/cjk/fireflysung.ttf) format('truetype');
        //     //   }
        //     //   * {
        //     //     font-family: Firefly Sung, DejaVu Sans, sans-serif;
        //     //   }";
        //     $response .='</style>';
        //     // $test .='* { font-family: DejaVu Sans, sans-serif; }';
        //     $test .='@font-face {
        //         font-family: ipag;
        //         font-style: normal;
        //         font-weight: normal;
        //         src: url("'.$fonturl.'");
        //    }
        $response .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
        $response .= '<style>';
        // $test .='* { font-family: DejaVu Sans, sans-serif; }';
        $response .= '@font-face {
            font-family: ipag;
            font-style: normal;
            font-weight: normal;
            src: url("' . $fonturl . '");
        }
        body{ font-family: ipag !important;}
        header {
        position: fixed;
        top: -60px;
        left: 0px;
        right: 0px;
        height: 50px;
        font-size: 20px !important;

        /** Extra personal styles **/
        background-color: #fff;
        color:  #111;
        text-align: center;
        line-height: 35px;
        }

    footer {
        position: fixed; 
        bottom: -60px; 
        left: 0px; 
        right: 0px;
        height: 50px; 
        font-size: 20px !important;

        /** Extra personal styles **/
        background-color: #fff;
        color: #111;
        text-align: center;
        line-height: 35px;
    }';
        $response .= '</style>';
        $response .= "</head>";
        $response .= "<body><header> " .  __('messages.schedule_list') . "</header>
        <footer>" . $footer_text . "</footer>";
        if ($timetable['code'] == "200") {
            $max = $timetable['data']['max'];

            // $response = "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>";
            $response .= '<table >';
            $response .= '<tr><td class="center" style="border: 1px solid; padding:12px;">' . __('messages.day') . '/' . __('messages.period') . '</td>';
            for ($i = 1; $i <= $max; $i++) {
                $response .= '<td class="centre" style="border: 1px solid; padding:12px;">' . $i . '</td>';
            }
            $response .= '</tr>';
            foreach ($days as $day) {

                if (!isset($timetable['data']['week'][$day]) && ($day == "saturday" || $day == "sunday")) {
                } else {

                    $response .= '<tr><td class="center" style="border: 1px solid; padding:12px;">' . __('messages.' . $day) . '</td>';
                    $row = 0;
                    foreach ($timetable['data']['timetable'] as $table) {
                        if ($table['day'] == $day) {
                            $start_time = date('H:i', strtotime($table['time_start']));
                            $end_time = date('H:i', strtotime($table['time_end']));
                            $response .= '<td style="border: 1px solid; padding:12px;">';
                            if ($table['break'] == "1") {
                                $response .= (isset($table['break_type']) ? $table['break_type'] : "") . '<br>';
                                $response .= '<b>(' . $start_time . ' - ' . $end_time . ' )</b><br>';
                                if (isset($table['hall_no'])) {
                                    $response .= $table['hall_no'] . '<br>';
                                }
                            } else {
                                if ($table['subject_name']) {
                                    $subject = $table['subject_name'];
                                } else {
                                    $subject = (isset($table['break_type']) ? $table['break_type'] : "");
                                }
                                $response .= $subject . '<br>';
                                $response .= '<b>(' . $start_time . ' - ' . $end_time . ' )</b><br>';
                                if ($table['teacher_name']) {
                                    $response .=   $table['teacher_name'] . '<br>';
                                }
                                if (isset($table['hall_no'])) {
                                    $response .= $table['hall_no'] . '<br>';
                                }
                            }
                            $response .= '</td>';
                            $row++;
                        }
                    }
                    while ($row < $max) {
                        $response .= '<td class="center" style="border: 1px solid; padding:12px;">N/A</td>';
                        $row++;
                    }
                    $response .= '</tr>';
                }
            }
            $response .= '</table>';

            // $response;
        }
        $response .= "</body></html>";

        //     $test = '<!DOCTYPE html>';
        //     $test .='<html>';
        //     $test .='<head>';
        //     $test .='<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
        //     $test .='<style>';
        //     // $test .='* { font-family: DejaVu Sans, sans-serif; }';
        //     $test .='@font-face {
        //         font-family: ipag;
        //         font-style: normal;
        //         font-weight: normal;
        //         src: url("'.$fonturl.'");
        //    }
        //    body{ font-family: ipag !important;}';
        //     $test .='</style>';
        //     $test .='</head>';
        //     $test .='<body>';
        //     $test .='<p> 朝読書（朝学習）朝読書（朝学習）朝読書（朝学習）</p>';
        //     $test .='</body>';
        //     $test .='</html>';


        // dd($test);


        $pdf = \App::make('dompdf.wrapper');
        // $pdf = \App::make('dompdf.wrapper','UTF-8');
        // $pdf = mb_convert_encoding(\App::make('dompdf.wrapper', $response), 'HTML-ENTITIES', 'UTF-8');

        // set size
        $customPaper = array(0, 0, 2880.00, 1620.00);
        $pdf->set_paper($customPaper);
        // $pdf->set_option('isFontSubsettingEnabled', true);
        // $pdf->autoScriptToLang = true;

        // $paper_size = array(0, 0, 360, 360);
        // $pdf->set_paper($paper_size);

        $pdf->loadHTML($response);
        // filename
        $now = now();
        $name = strtotime($now);
        $fileName = __('messages.timetable') . $name . ".pdf";
        return $pdf->download($fileName);
        // return $pdf->stream($fileName);

    }
    public function attendance_student_pdf(Request $request)
    {
        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'subject_id' => $request->subject_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'year_month' => $request->year_month,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $footer_text = session()->get('footer_text');
        $get_attendance_list_teacher = Helper::PostMethod(config('constants.api.get_attendance_list_teacher'), $data);
        // dd($get_attendance_list_teacher);

        // $response = "";
        $fonturl = storage_path('fonts/ipag.ttf');
        $response = "<!DOCTYPE html>";
        $response .= "<html><head>";
        $response .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
        $response .= '<style>';
        // $test .='* { font-family: DejaVu Sans, sans-serif; }';
        $response .= '@font-face {
            font-family: ipag;
            font-style: normal;
            font-weight: normal;
            src: url("' . $fonturl . '");
        } 
        body{ font-family: ipag !important;}
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color:  #111;
            text-align: center;
            line-height: 35px;
            }

        footer {
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color: #111;
            text-align: center;
            line-height: 35px;
        }';
        $response .= '</style>';
        $response .= "</head>";
        $response .= "<body><header> " .  __('messages.attendance_report') . "</header>
        <footer>" . $footer_text . "</footer>";
        if ($get_attendance_list_teacher['code'] == "200") {
            $student_details = $get_attendance_list_teacher['data']['student_details'];
            $year_month = "01-" . $request->year_month;
            // First day of the month.
            $startDate = date('Y-m-01', strtotime($year_month));
            // Last day of the month.
            $endDate = date('Y-m-t', strtotime($year_month));
            $begin = new DateTime($startDate);
            $end = new DateTime($endDate);

            $end = $end->modify('+1 day');

            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($begin, $interval, $end);

            $response .= '<div class="table-responsive">
        <table width="100%" style="border-collapse: collapse; border: 0px;">
           <thead>
              <tr>
                 <th class="align-top" style="border: 1px solid; padding:12px;">Student Id</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">Name</th>';
            foreach ($daterange as $date) {
                $response .= '<th class="align-top" style="border: 1px solid; padding:12px;">' . $date->format("Y-m-d") . '</th>>';
            }
            $response .= '<th class="align-top" style="border: 1px solid; padding:12px;">Total Present</th>>
            <th class="align-top" style="border: 1px solid; padding:12px;">Total Absent</th>>
            <th class="align-top" style="border: 1px solid; padding:12px;">Total Late</th>>';

            $response .= '</tr></thead><tbody>';
            foreach ($student_details as $key => $res) {
                $attendance_details = $res['attendance_details'];
                $response .= '<tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['student_id'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['first_name'] . '' . $res['last_name'] . '</td>';
                foreach ($daterange as $dat) {
                    $checkMatch = 0;
                    foreach ($attendance_details as $att) {
                        $loopDate = $dat->format("Y-m-d");
                        $attDate = $att['date'];
                        if ($loopDate == $attDate) {
                            // dd($attDate);
                            $status = "";
                            if ($att['status'] == "present") {
                                $status = "P";
                            }
                            if ($att['status'] == "absent") {
                                $status = "A";
                            }
                            if ($att['status'] == "late") {
                                $status = "L";
                            }
                            $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $status . '</td>';
                            $checkMatch = 1;
                        }
                    }
                    if ($checkMatch == 0) {
                        $response .= '<td class="text-center" style="border: 1px solid; padding:12px;"></td>';
                        $checkMatch = 1;
                    }
                }
                $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['presentCount'] . '</td>';
                $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['absentCount'] . '</td>';
                $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['lateCount'] . '</td>';
                $response .= '</tr>';
            }
            $response .= '</tbody></table></div>';
        }

        $response .= "</body></html>";

        // dd($response);
        $pdf = \App::make('dompdf.wrapper');
        // set size
        $customPaper = array(0, 0, 1920.00, 810.00);
        $pdf->set_paper($customPaper);
        // $paper_size = array(0, 0, 360, 360);
        // $pdf->set_paper($paper_size);
        $pdf->loadHTML($response);
        // filename
        $now = now();
        $name = strtotime($now);
        $fileName =  __('messages.attendance_report') . $name . ".pdf";
        return $pdf->download($fileName);
    }
    public function attendance_student_pdf_day_test(Request $request)
    {
        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'subject_id' => $request->subject_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'year_month' => $request->year_month,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $footer_text = session()->get('footer_text');
        $get_attendance_list_teacher = Helper::PostMethod(config('constants.api.get_attendance_list_teacher'), $data);
        // dd($get_attendance_list_teacher);

        // $response = "";
        $fonturl = storage_path('fonts/ipag.ttf');
        $response = "<!DOCTYPE html>";
        $response .= "<html><head>";
        $response .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
        $response .= '<style>';
        // $test .='* { font-family: DejaVu Sans, sans-serif; }';
        $response .= '@font-face {
            font-family: ipag;
            font-style: normal;
            font-weight: normal;
            src: url("' . $fonturl . '");
        } 
        body{ font-family: ipag !important;}
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color:  #111;
            text-align: center;
            line-height: 35px;
            }

        footer {
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color: #111;
            text-align: center;
            line-height: 35px;
        }';
        $response .= '</style>';
        $response .= "</head>";
        $response .= "<body><header> " .  __('messages.attendance_report') . "</header>
        <footer>" . $footer_text . "</footer>";

        $response .= '<div class="table-responsive">
            <table class="">
            <tr>
                <th class="align-center">Total Students: <br>28</th>
                <th class="align-center">Present Students:  <br>24</th>
                <th class="align-center">Absent Students: <br> 4</th>
            </tr>
        </table>
        <table width="100%" style="border-collapse: collapse; border: 0px;">
           <thead>
              <tr>
              <th class="align-top" style="border: 1px solid; padding:12px;">#</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">Name</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">Name (English)</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">Grade</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">Class</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">Status</th>
            <th class="align-top" style="border: 1px solid; padding:12px;">Remarks</th>';

        $response .= '</tr></thead><tbody>';
        $response .= '
                <tr>
                    <td class="text-center" style="border: 1px solid; padding:12px;">1</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> 佐藤 直美</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> Naomi Sato</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> 1年</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> 1組</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> Present</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;">Good</td>
                </tr>
                <tr>
                    <td class="text-center" style="border: 1px solid; padding:12px;">2</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> 生田 宏枝</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> Hiroe Ikuta</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> 1年</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> 1組</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> Absent</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> Sick Leave </td>
                </tr>
                <tr>
                    <td class="text-center" style="border: 1px solid; padding:12px;">3</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> 平良 孝浩</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> Takahiro Taira</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> 1年</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> 1組</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> Present</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> Execellent </td>
                </tr>
                <tr>
                    <td class="text-center" style="border: 1px solid; padding:12px;">4</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> 水田 崇</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> Takashi Mizuta</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> 1年</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> 1組</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> Present</td>
                    <td class="text-center" style="border: 1px solid; padding:12px;"> </td>
                </tr>';
        
        $response .= '</tbody></table></div>';
        $response .= "</body></html>";

        // dd($response);
        $pdf = \App::make('dompdf.wrapper');
        // set size
        $customPaper = array(0, 0, 1920.00, 810.00);
        $pdf->set_paper($customPaper);
        // $paper_size = array(0, 0, 360, 360);
        // $pdf->set_paper($paper_size);
        $pdf->loadHTML($response);
        // filename
        $now = now();
        $name = strtotime($now);
        $fileName =  __('messages.attendance_report') . $name . ".pdf";
        return $pdf->download($fileName);
    }
    public function attendance_student_pdf_term_test(Request $request)
    {
        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'subject_id' => $request->subject_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'year_month' => $request->year_month,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $footer_text = session()->get('footer_text');
        $get_attendance_list_teacher = Helper::PostMethod(config('constants.api.get_attendance_list_teacher'), $data);
        // dd($get_attendance_list_teacher);

        // $response = "";
        $fonturl = storage_path('fonts/ipag.ttf');
        $response = "<!DOCTYPE html>";
        $response .= "<html><head>";
        $response .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
        $response .= '<style>';
        // $test .='* { font-family: DejaVu Sans, sans-serif; }';
        $response .= '@font-face {
            font-family: ipag;
            font-style: normal;
            font-weight: normal;
            src: url("' . $fonturl . '");
        } 
        body{ font-family: ipag !important;}
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color:  #111;
            text-align: center;
            line-height: 35px;
            }

        footer {
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color: #111;
            text-align: center;
            line-height: 35px;
        }';
        $response .= '</style>';
        $response .= "</head>";
        $response .= "<body><header> Attendance Report - Term</header>
        <footer>" . $footer_text . "</footer>";

        $response .= '<div class="table-responsive">
            
            <table class="">
            <tr>
                <th style="text-align:center">Total Students : <br>28</th>
                <th style="text-align:center">Total School Days : <br>24</th>
                <th style="text-align:center">Total Holidays : <br>4</th>
            </tr>
        </table><table width="100%" style="border-collapse: collapse; border: 0px;">
        <thead>
           <tr>
           <th class="align-top" style="border: 1px solid; padding:12px;">#</th>
              <th class="align-top" style="border: 1px solid; padding:12px;">Name</th>
              <th class="align-top" style="border: 1px solid; padding:12px;">Name (English)</th>
              <th class="align-top" style="border: 1px solid; padding:12px;">Grade</th>
              <th class="align-top" style="border: 1px solid; padding:12px;">Class</th>
              <th class="align-top" style="border: 1px solid; padding:12px;">Term</th>
              <th class="align-top" style="border: 1px solid; padding:12px;">No of Present</th>
         <th class="align-top" style="border: 1px solid; padding:12px;">No of Absent</th>
         <th class="align-top" style="border: 1px solid; padding:12px;">No of Late</th>
         <th class="align-top" style="border: 1px solid; padding:12px;">Remarks</th>';

     $response .= '</tr></thead><tbody>';
     $response .= '
             <tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;">1</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 佐藤 直美</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> Naomi Sato</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1年</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1組</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> First Term</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 18</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 2</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">Good</td>
             </tr>
             <tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;">2</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 生田 宏枝</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> Hiroe Ikuta</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1年</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1組</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> First Term</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 16</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 4</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> Sick Leave </td>
             </tr>
             <tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;">3</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 平良 孝浩</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> Takahiro Taira</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1年</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1組</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> First Term</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 20</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 0</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 2</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> Execellent </td>
             </tr>
             <tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;">4</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 水田 崇</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> Takashi Mizuta</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1年</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1組</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> Second Term</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 17</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 3</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 4</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> </td>
             </tr>';
        $response .= '</tbody></table></div>';
        $response .= "</body></html>";

        // dd($response);
        $pdf = \App::make('dompdf.wrapper');
        // set size
        $customPaper = array(0, 0, 1920.00, 810.00);
        $pdf->set_paper($customPaper);
        // $paper_size = array(0, 0, 360, 360);
        // $pdf->set_paper($paper_size);
        $pdf->loadHTML($response);
        // filename
        $now = now();
        $name = strtotime($now);
        $fileName =  __('messages.attendance_report') . $name . ".pdf";
        return $pdf->download($fileName);
    }
    public function attendance_student_pdf_year_test(Request $request)
    {
        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'subject_id' => $request->subject_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'year_month' => $request->year_month,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $footer_text = session()->get('footer_text');
        $get_attendance_list_teacher = Helper::PostMethod(config('constants.api.get_attendance_list_teacher'), $data);
        // dd($get_attendance_list_teacher);

        // $response = "";
        $fonturl = storage_path('fonts/ipag.ttf');
        $response = "<!DOCTYPE html>";
        $response .= "<html><head>";
        $response .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
        $response .= '<style>';
        // $test .='* { font-family: DejaVu Sans, sans-serif; }';
        $response .= '@font-face {
            font-family: ipag;
            font-style: normal;
            font-weight: normal;
            src: url("' . $fonturl . '");
        } 
        body{ font-family: ipag !important;}
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color:  #111;
            text-align: center;
            line-height: 35px;
            }

        footer {
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color: #111;
            text-align: center;
            line-height: 35px;
        }';
        $response .= '</style>';
        $response .= "</head>";
        $response .= "<body><header> Attendance Report - Year</header>
        <footer>" . $footer_text . "</footer>";

        $response .= '<div class="table-responsive">
            
            <table class="">
            <tr>
                <th style="text-align:center">Total Students : <br>28</th>
                <th style="text-align:center">Total School Days : <br>24</th>
                <th style="text-align:center">Total Holidays : <br>4</th>
            </tr>
        </table><table width="100%" style="border-collapse: collapse; border: 0px;">
        <thead>
           <tr>
           <th class="align-top" style="border: 1px solid; padding:12px;">#</th>
              <th class="align-top" style="border: 1px solid; padding:12px;">Name</th>
              <th class="align-top" style="border: 1px solid; padding:12px;">Name (English)</th>
              <th class="align-top" style="border: 1px solid; padding:12px;">Grade</th>
              <th class="align-top" style="border: 1px solid; padding:12px;">Class</th>
              <th class="align-top" style="border: 1px solid; padding:12px;">No of Present</th>
         <th class="align-top" style="border: 1px solid; padding:12px;">No of Absent</th>
         <th class="align-top" style="border: 1px solid; padding:12px;">No of Late</th>
         <th class="align-top" style="border: 1px solid; padding:12px;">Remarks</th>';

     $response .= '</tr></thead><tbody>';
     $response .= '
             <tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;">1</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 佐藤 直美</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> Naomi Sato</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1年</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1組</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 18</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 2</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">Good</td>
             </tr>
             <tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;">2</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 生田 宏枝</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> Hiroe Ikuta</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1年</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1組</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 16</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 4</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> Sick Leave </td>
             </tr>
             <tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;">3</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 平良 孝浩</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> Takahiro Taira</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1年</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1組</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 20</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 0</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 2</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> Execellent </td>
             </tr>
             <tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;">4</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 水田 崇</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> Takashi Mizuta</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1年</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 1組</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 17</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 3</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> 4</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;"> </td>
             </tr>';
        $response .= '</tbody></table></div>';
        $response .= "</body></html>";

        // dd($response);
        $pdf = \App::make('dompdf.wrapper');
        // set size
        $customPaper = array(0, 0, 1920.00, 810.00);
        $pdf->set_paper($customPaper);
        // $paper_size = array(0, 0, 360, 360);
        // $pdf->set_paper($paper_size);
        $pdf->loadHTML($response);
        // filename
        $now = now();
        $name = strtotime($now);
        $fileName =  __('messages.attendance_report_year') . $name . ".pdf";
        return $pdf->download($fileName);
    }
    public function attendance_employee_pdf(Request $request)
    {
        $data = [
            'employee' => $request->employee,
            'session' => $request->session,
            'department' => $request->department,
            'date' => $request->date,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $footer_text = session()->get('footer_text');
        $employee_attendance = Helper::PostMethod(config('constants.api.employee_attendance_report'), $data);
        // dd($get_attendance_list_teacher);

        // $response = "";
        $fonturl = storage_path('fonts/ipag.ttf');
        $response = "<!DOCTYPE html>";
        $response .= "<html><head>";
        $response .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
        $response .= '<style>';
        // $test .='* { font-family: DejaVu Sans, sans-serif; }';
        $response .= '@font-face {
            font-family: ipag;
            font-style: normal;
            font-weight: normal;
            src: url("' . $fonturl . '");
        } 
        body{ font-family: ipag !important;}
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color:  #111;
            text-align: center;
            line-height: 35px;
            }

        footer {
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color: #111;
            text-align: center;
            line-height: 35px;
        }';
        $response .= '</style>';
        $response .= "</head>";
        $response .= "<body><header> " .  __('messages.employee_attendance_report') . "</header>
        <footer>" . $footer_text . "</footer>";
        // dd($employee_attendance);
        if ($employee_attendance['code'] == "200") {
            $staff_details = $employee_attendance['data']['staff_details'];
            $year_month = "01-" . $request->date;
            // First day of the month.
            $startDate = date('Y-m-01', strtotime($year_month));
            // Last day of the month.
            $endDate = date('Y-m-t', strtotime($year_month));
            $begin = new DateTime($startDate);
            $end = new DateTime($endDate);

            $end = $end->modify('+1 day');

            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($begin, $interval, $end);
            $response .= '<div class="table-responsive">
        <table width="100%" style="border-collapse: collapse; border: 0px;">
           <thead>
              <tr>
                 <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.session') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.employee_name') . '</th>';
            foreach ($daterange as $date) {
                $response .= '<th class="align-top" style="border: 1px solid; padding:12px;">' . $date->format("Y-m-d") . '</th>>';
            }
            $response .= '<th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.total_present') . '</th>>
            <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.total_absent') . '</th>>
            <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.total_late') . '</th>>';
            foreach ($staff_details as $key => $res) {
                $attendance_details = $res['attendance_details'];
                $response .= '<tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . __('messages.' . strtolower($res['session_name'])) . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['first_name'] . '' . $res['last_name'] . '</td>';
                foreach ($daterange as $dat) {
                    $checkMatch = 0;
                    foreach ($attendance_details as $att) {
                        $loopDate = $dat->format("Y-m-d");
                        $attDate = $att['date'];
                        if ($loopDate == $attDate) {
                            // dd($attDate);
                            $status = "";
                            if ($att['status'] == "present") {
                                $status = "P";
                            }
                            if ($att['status'] == "absent") {
                                $status = "A";
                            }
                            if ($att['status'] == "late") {
                                $status = "L";
                            }
                            $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $status . '</td>';
                            $checkMatch = 1;
                        }
                    }
                    if ($checkMatch == 0) {
                        $response .= '<td class="text-center" style="border: 1px solid; padding:12px;"></td>';
                        $checkMatch = 1;
                    }
                }
                $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['presentCount'] . '</td>';
                $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['absentCount'] . '</td>';
                $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['lateCount'] . '</td>';
                $response .= '</tr>';
            }
            $response .= '</tbody></table></div>';
        }

        $response .= "</body></html>";
        // dd($response);
        $pdf = \App::make('dompdf.wrapper');
        // set size
        $customPaper = array(0, 0, 1920.00, 810.00);
        $pdf->set_paper($customPaper);
        // $paper_size = array(0, 0, 360, 360);
        // $pdf->set_paper($paper_size);
        $pdf->loadHTML($response);
        // filename
        $now = now();
        $name = strtotime($now);
        $fileName = __('messages.employee_attendance_report') . $name . ".pdf";
        return $pdf->download($fileName);
    }

    public function attendance_student_pdf_parent(Request $request)
    {
        $data = [
            'subject_id' => $request->subject_id,
            'student_id' => $request->student_id,
            'year_month' => $request->year_month,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        // dd($data);
        $get_attendance_list_teacher = Helper::PostMethod(config('constants.api.get_attendance_list_teacher'), $data);
        $footer_text = session()->get('footer_text');

        $fonturl = storage_path('fonts/ipag.ttf');
        $response = "<!DOCTYPE html>";
        $response .= "<html><head>";
        $response .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
        $response .= '<style>';
        // $test .='* { font-family: DejaVu Sans, sans-serif; }';
        $response .= '@font-face {
            font-family: ipag;
            font-style: normal;
            font-weight: normal;
            src: url("' . $fonturl . '");
        } 
        body{ font-family: ipag !important;}
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color:  #111;
            text-align: center;
            line-height: 35px;
            }

        footer {
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color: #111;
            text-align: center;
            line-height: 35px;
        }';
        $response .= '</style>';
        $response .= "</head>";
        $response .= "<body><header> " .  __('messages.attendance_report') . "</header>
        <footer>" . $footer_text . "</footer>";
        if ($get_attendance_list_teacher['code'] == "200") {
            $student_details = $get_attendance_list_teacher['data']['student_details'];
            $year_month = "01-" . $request->year_month;
            // First day of the month.
            $startDate = date('Y-m-01', strtotime($year_month));
            // Last day of the month.
            $endDate = date('Y-m-t', strtotime($year_month));
            $begin = new DateTime($startDate);
            $end = new DateTime($endDate);

            $end = $end->modify('+1 day');

            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($begin, $interval, $end);
            $response .= '<div class="table-responsive">
        <table width="100%" style="border-collapse: collapse; border: 0px;">
           <thead>
              <tr>
                 <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.name') . '</th>';
            foreach ($daterange as $date) {
                $response .= '<th class="align-top" style="border: 1px solid; padding:12px;">' . $date->format("Y-m-d") . '</th>>';
            }
            $response .= '<th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.total_present') . '</th>
            <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.total_absent') . '</th>
            <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.total_late') . '</th>>';

            $response .= '</tr></thead><tbody>';
            foreach ($student_details as $key => $res) {
                $attendance_details = $res['attendance_details'];
                $response .= '<tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['first_name'] . '' . $res['last_name'] . '</td>';
                foreach ($daterange as $dat) {
                    $checkMatch = 0;
                    foreach ($attendance_details as $att) {
                        $loopDate = $dat->format("Y-m-d");
                        $attDate = $att['date'];
                        if ($loopDate == $attDate) {
                            // dd($attDate);
                            $status = "";
                            if ($att['status'] == "present") {
                                $status = "P";
                            }
                            if ($att['status'] == "absent") {
                                $status = "A";
                            }
                            if ($att['status'] == "late") {
                                $status = "L";
                            }
                            $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $status . '</td>';
                            $checkMatch = 1;
                        }
                    }
                    if ($checkMatch == 0) {
                        $response .= '<td class="text-center" style="border: 1px solid; padding:12px;"></td>';
                        $checkMatch = 1;
                    }
                }
                $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['presentCount'] . '</td>';
                $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['absentCount'] . '</td>';
                $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['lateCount'] . '</td>';
                $response .= '</tr>';
            }
            $response .= '</tbody></table></div>';
        }
        $response .= "</body></html>";
        // dd($response);
        $pdf = \App::make('dompdf.wrapper');
        // set size
        $customPaper = array(0, 0, 1920.00, 810.00);
        $pdf->set_paper($customPaper);
        // $paper_size = array(0, 0, 360, 360);
        // $pdf->set_paper($paper_size);
        $pdf->loadHTML($response);
        // filename
        $now = now();
        $name = strtotime($now);
        $fileName = __('messages.student_attendance') . $name . ".pdf";
        return $pdf->download($fileName);
    }

    public function feesExpensePdf(Request $request)
    {
        $data = [
            'section_id' => $request->section_id,
            'department_id' => $request->department_id,
            'class_id' => $request->class_id,
            'academic_session_id' => $request->academic_session_id
        ];
        $footer_text = session()->get('footer_text');
        $fees_expense = Helper::PostMethod(config('constants.api.fees_expense_export'), $data);
        // dd($get_attendance_list_teacher);

        // dd($expense);
        // $response = "";
        $fonturl = storage_path('fonts/ipag.ttf');
        $response = "<!DOCTYPE html>";
        $response .= "<html><head>";
        $response .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
        $response .= '<style>';
        // $test .='* { font-family: DejaVu Sans, sans-serif; }';
        $response .= '@font-face {
            font-family: ipag;
            font-style: normal;
            font-weight: normal;
            src: url("' . $fonturl . '");
        } 
        body{ font-family: ipag !important;}
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color:  #111;
            text-align: center;
            line-height: 35px;
            }

        footer {
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #fff;
            color: #111;
            text-align: center;
            line-height: 35px;
        }';
        $response .= '</style>';
        $response .= "</head>";
        $response .= "<body><header> " .  __('messages.fees_expense_report') . "</header>
        <footer>" . $footer_text . "</footer>";
        // dd($employee_attendance);
        if ($fees_expense['code'] == "200") {
            $expense = $fees_expense['data']['expense'];
            $response .= '<div class="table-responsive">
        <table width="100%" style="border-collapse: collapse; border: 0px;">
           <thead>
              <tr>
                 <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.student_name') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.roll_no') . '</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.semester_1') . '</th>
            <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.semester_2') . '</th>>
            <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.semester_3') . '</th>>';
            foreach ($expense as $key => $res) {
                $response .= '<tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['name'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['roll_no'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['semester_1'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['semester_2'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['semester_3'] . '</td>';
                $response .= '</tr>';
            }
            $response .= '</tbody></table></div>';
        }

        $response .= "</body></html>";
        // dd($response);
        $pdf = \App::make('dompdf.wrapper');
        // set size
        $customPaper = array(0, 0, 1920.00, 810.00);
        $pdf->set_paper($customPaper);
        // $paper_size = array(0, 0, 360, 360);
        // $pdf->set_paper($paper_size);
        $pdf->loadHTML($response);
        // filename
        $now = now();
        $name = strtotime($now);
        $fileName = __('messages.fees_expense_report') . $name . ".pdf";
        return $pdf->download($fileName);
    }
}
