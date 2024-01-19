<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\Helper;

use DateTime;
use DateInterval;
use DatePeriod;
use DateTimeZone;
use PDF;

class ExamPdfController extends Controller
{
    public function downbyecreport(Request $request)
    {
        
        $data = [
            'branch_id' => session()->get('branch_id'),
            'exam_id' => $request->exam_id,
            'department_id' => $request->department_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => $request->academic_year,
            'pdf_report' => 1
            
        ];
        
        
        $getstudents = Helper::PostMethod(config('constants.api.exam_studentslist'), $data);
       
        $getsubjects = Helper::PostMethod(config('constants.api.get_subjectlist'), $data);
        
        $footer_text = session()->get('footer_text');

        $fonturl = storage_path('fonts/ipag.g');
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
        $bdata = [
			'id' => session()->get('branch_id'),
			];
			$getbranch = Helper::PostMethod(config('constants.api.branch_details'), $bdata);
        $term = Helper::PostMethod(config('constants.api.exam_details'), $termdata);
        $acyear = Helper::PostMethod(config('constants.api.academic_year_details'), $acdata);

        //dd($getbranch['data']);
        $acy=$acyear['data']['name'];
		foreach($getstudents['data'] as $stu)
        {
            $sno++; 
        $output .= '<table class="main" width="100%">
			<tr >
				<td colspan="3" class="content-wrap aligncenter" style="margin: 0;padding: 20px;"
				align="center">
					
					
					<h1 style="margin-left: 15px;">'.$getbranch['data']['school_name'].'</h1>
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
					<h3>'.strtoupper($stu['name']).'</h3>
				</td>
				
			</tr>
            <tr> 
				<td colspan="3" >
					<table class="table table-bordered">';
                    $teachername='';$teachercmd='';
            foreach($getsubjects['data'] as $subject)
            {
                $teachername=($subject['teacher_id']!=0)?$subject['teacher']:$teachername;
                $pdata = [
                    'branch_id' => session()->get('branch_id'),
                    'exam_id' => $request->exam_id,
                    'department_id' => $request->department_id,
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'semester_id' => $request->semester_id,
                    'session_id' => $request->session_id,
                    'academic_session_id' => $request->academic_year,
                    'student_id' => $stu['student_id'],
                    'subject_id' => $subject['subject_id'],
                    'pdf_report' => 1
                    
                ];
                $Getpaper = Helper::PostMethod(config('constants.api.exam_papermarks'), $pdata);
                //dd($pdata);
                $output.='
			
						<thead class="colspanHead">
							<tr>
								<td colspan="2"
								style="text-align:center; border: 1px solid black;background-color:#40403a57">
								'.$subject['name'].'</td>
							</tr>
						</thead>
						<tbody>';
                        
                        //dd($Getpaper);
                        foreach($Getpaper['data'] as $paper)
                        { 
                            $teachercmd.=($paper['memo']!='null')?$paper['memo'].', ':'';
                            
                            if($paper['score_type']=='Points')
                            {
                                $mark=$paper['grade_name'];
                            }
                            elseif($paper['score_type']=='Freetext')
                            {
                                $mark=$paper['freetext'];
                            }
                            elseif($paper['score_type']=='Grade')
                            {
                                $mark=$paper['grade'];
                            }
                            else
                            {
                                $mark=$paper['score'];
                            }
                            $output.='<tr>
								<td>'.$paper['paper_name'].'</td>
								<td>'.$mark.'</td>
							</tr>';
                        }
                            
                                                 
							
                            $output.='</tbody>
						
					';
                    }

			 $output.='</table>
             </td>
         </tr><tr>
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
                           
							$output.='<tr>
								<td colspan="24"
								style="text-align:left; border: 1px solid black;height:100px;color:black;">
									'.$teachercmd.'
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
					<h5> '.$teachername.'</h5>
					
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
    public function downbyreportcard(Request $request)
    {
       
        
        $data = [
            'branch_id' => session()->get('branch_id'),
            'exam_id' => $request->exam_id,
            'department_id' => $request->department_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => $request->academic_year,
            'pdf_report' => 0 // All Primary Subjects
            
        ];
        $spdata1 = [
            'branch_id' => session()->get('branch_id'),
            'exam_id' => $request->exam_id,
            'department_id' => $request->department_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => $request->academic_year,
            'pdf_report' => 2 // Excellent Report
            
        ];
        $spdata2 = [
            'branch_id' => session()->get('branch_id'),
            'exam_id' => $request->exam_id,
            'department_id' => $request->department_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => $request->academic_year,
            'pdf_report' => 3 // Free text - All Semeter
            
        ];
        $spdata3 = [
            'branch_id' => session()->get('branch_id'),
            'exam_id' => $request->exam_id,
            'department_id' => $request->department_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => $request->academic_year,
            'pdf_report' => 4 // Free text - Final Semeter
            
        ];
        
        
       
        //dd($data);
        
        $getstudents = Helper::PostMethod(config('constants.api.exam_studentslist'), $data); 
            
        $getprimarysubjects = Helper::PostMethod(config('constants.api.get_subjectlist'), $data);
       
        $getspsubject1 = Helper::PostMethod(config('constants.api.get_subjectlist'), $spdata1);
        
        $getspsubject2 = Helper::PostMethod(config('constants.api.get_subjectlist'), $spdata2);
        
        $getspsubject3 = Helper::PostMethod(config('constants.api.get_subjectlist'), $spdata3);
        
        $getacyeardates = Helper::PostMethod(config('constants.api.getacyeardates'), $data);
        
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
        $bdata = [
			'id' => session()->get('branch_id'),
			];
			$getbranch = Helper::PostMethod(config('constants.api.branch_details'), $bdata);
		foreach($getstudents['data'] as $stu)
        {
            $sno++;  
        $output .= '<table class="main" width="100%">
        <tr>
            <td colspan="5"> <h4>'.$getbranch['data']['school_name'].'</h4> </td> 
        </tr>
        <tr>
            <td >
                <h4>'.$grade['data']['short_name'].'</h4>
            </td>
            <td>
                <h4> '.__('messages.semester').'</h4>
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
                    <td colspan="'.count($getacyeardates['data']['semesters']).'" style="text-align:left; border: 1px solid black;">
                        ( A Well done )<br>
                        ( B Good )<br>
                    ( C Need improve )<br></td>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Subject</td>
                            <td style="text-align:left;">Learning Status by Perspective</td>';
                            $s=0;
                            foreach($getacyeardates['data']['semesters'] as $sem)
                            {
                               $s++;
                                $output.='<td > '.$s.' Semester</td>';
                            }
                            
                           
                            
                            $output.='</tr>
                        
                    </tbody>';
                        
                        foreach($getprimarysubjects['data'] as $subject)
                        {   
                            //dd($subject);
                            $pdata = [
                                'branch_id' => session()->get('branch_id'),
                                'exam_id' => $request->exam_id,
                                'department_id' => $request->department_id,
                                'class_id' => $request->class_id,
                                'section_id' => $request->section_id,
                                'semester_id' => $request->semester_id,
                                'session_id' => $request->session_id,
                                'academic_session_id' => $request->academic_year,
                                'student_id' => $stu['student_id'],
                                'subject_id' => $subject['subject_id'],
                                'pdf_report' => 0
                                
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.getsubjecpapertlist'), $pdata);
                          
                            $i=0;
                            $n=count($getmarks['data']); 
                            
                            foreach($getmarks['data'] as $papers)
                            {
                               
                                $i++;
                            if($i==1)
                            {
                        $output.=' <tbody style="border: 1px solid black;">';
                            }
                 
                            $output.=' <tr>';
                            if($i==1)
                            {
                                $output.='<td rowspan="'.$n.'" style="width: 0px;">'.$subject['name'].'</td>';
                            }
                            $output.='<td  style="text-align:left;">'.$papers['papers']['paper_name'].'</td>';
                            foreach($papers['marks'] as $mark)
                            {
                                if($papers['papers']['score_type']=='Points')
                                {
                                    $mark=(isset($mark['grade_name'])&& $mark['grade_name']!=null)?$mark['grade_name']:'';
                                }
                                elseif($papers['papers']['score_type']=='Freetext')
                                {
                                    $mark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                                }
                                elseif($papers['papers']['score_type']=='Grade')
                                {
                                    $mark=(isset($mark['grade'])&& $mark['grade']!=null)?$mark['grade']:'';
                                }
                                else
                                {
                                    $mark=(isset($mark['score'])&& $mark['score']!=null)?$mark['score']:'';
                                }   
                                $output.=' <td>'.$mark.'</td>';
                            }          
                            $output.=' </tr>';
                        if($i==$n)
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
                            $attdata = [
                                'branch_id' => session()->get('branch_id'),
                                'exam_id' => $request->exam_id,
                                'department_id' => $request->department_id,
                                'class_id' => $request->class_id,
                                'section_id' => $request->section_id,
                                'semester_id' => $request->semester_id,
                                'session_id' => $request->session_id,
                                'academic_session_id' => $request->academic_year,
                                'student_id' => $stu['student_id'],
                                
                            ];
                           
                                
                              
                                $getattendance = Helper::PostMethod(config('constants.api.getsem_studentattendance'), $attdata);
                                //dd($getattendance);
                              foreach($getattendance['data'] as $att)
                              {  
                                $output.='<tr>
                                <td>'.$att['month'].'</td>
                                <td>'.$att['no_schooldays'].'</td>
                                <td>'.$att['suspension'].'</td>
                                <td>'.$att['totalcoming'].'</td>
                                <td>'.$att['totabs'].'</td>
                                <td>'.$att['totpres'].'</td>
                                <td>'.$att['totlate'].'</td>
                                <td>'.$att['totexc'].'</td>
                            </tr>';
                            }
                            
                            
                            
                        $output.='</tbody>
                        
                        
                        
                    </table>
                    </td>
                    <td colspan="2">
                    <table class="table table-bordered">
                        ';
                        foreach($getspsubject1['data'] as $subject)
                        {   
                            //dd($subject);
                            $pdata = [
                                'branch_id' => session()->get('branch_id'),
                                'exam_id' => $request->exam_id,
                                'department_id' => $request->department_id,
                                'class_id' => $request->class_id,
                                'section_id' => $request->section_id,
                                'semester_id' => $request->semester_id,
                                'session_id' => $request->session_id,
                                'academic_session_id' => $request->academic_year,
                                'student_id' => $stu['student_id'],
                                'subject_id' => $subject['subject_id'],                                
                                'pdf_report' => 2
                                
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.getsubjecpapertlist'), $pdata);
                          
                            $i=0;
                            $n=count($getmarks['data']); 
                            
                            foreach($getmarks['data'] as $papers)
                            {
                               
                                $i++;
                                if($i==1)
                                {
                                    $output.='
                                    <thead class="colspanHead">
                                    <tr>
                                        <td colspan="4" style="text-align:center; border: 1px solid black;vertical-align: middle;">
                                        '.$subject['name'].'</td>
                                        <td colspan="1" style="text-align:center; border: 1px solid black;">
                                            (Listed in the Final semester)<br>
                                        ( O Excellent)</td>
                                    </tr>
                                </thead>
                                <tbody>';
                                }
                 
                                $output.=' <tr>';
                                $nsem=count($papers['marks']);
                                $s=0;
                                $mark='';
                               // dd($papers['marks']);
                                    foreach($papers['marks'] as $mark)
                                    {
                                        $s++;
                                    
                                        if($s==$nsem)
                                        {
                                            
                                            if($papers['papers']['score_type']=='Points')
                                            {
                                                $mark=(isset($mark['grade_name'])&& $mark['grade_name']!=null)?$mark['grade_name']:'';
                                            }
                                            elseif($papers['papers']['score_type']=='Freetext')
                                            {
                                                $mark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                                            }
                                            elseif($papers['papers']['score_type']=='Grade')
                                            {
                                                $mark=(isset($mark['grade'])&& $mark['grade']!=null)?$mark['grade']:'';
                                            }
                                            else
                                            {
                                                $mark=(isset($mark['score'])&& $mark['score']!=null)?$mark['score']:'';
                                            } 
                                           
                                        }
                                        
                                       
                            }  
                          //dd($mark);
                            $fmark=($mark=="Excellent")?'<b>O</b>':'';
                           
                            $output.=' <tr>
                                    <td colspan="4" style="text-align:left;">'.$papers['papers']['paper_name'].'</td>
                                    <td colspan="1">'.$fmark.'</td>
                                </tr>';
                       
                        }
                        $output.=' </tbody>';
                    } 
                       
                           
                    $output.=' </table>';
                    foreach($getspsubject2['data'] as $subject)
                        {   
                            //dd($subject);
                            $pdata = [
                                'branch_id' => session()->get('branch_id'),
                                'exam_id' => $request->exam_id,
                                'department_id' => $request->department_id,
                                'class_id' => $request->class_id,
                                'section_id' => $request->section_id,
                                'semester_id' => $request->semester_id,
                                'session_id' => $request->session_id,
                                'academic_session_id' => $request->academic_year,
                                'student_id' => $stu['student_id'],
                                'subject_id' => $subject['subject_id'],                                
                                'pdf_report' => 3
                                
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.getsubjecpapertlist'), $pdata);
                          
                            $i=0;
                            $n=count($getmarks['data']); 
                            
                            foreach($getmarks['data'] as $papers)
                            {
                               
                               
                            $output.='<table class="table table-bordered" style="margin-top:10px;">
                            <thead class="colspanHead">
                                <tr>
                                    <td colspan="5" style="text-align:center; border: 1px solid black;">
                                    '.$subject['name'].'</td>
                                    
                                </tr>
                            </thead>
                            <tbody><tr> <td colspan="5" style="height:70px;">';
                           
                            foreach($papers['marks'] as $mark)
                            {
                                if($papers['papers']['score_type']=='Points')
                                {
                                    $mark=(isset($mark['grade_name'])&& $mark['grade_name']!=null)?$mark['grade_name']:'';
                                }
                                elseif($papers['papers']['score_type']=='Freetext')
                                {
                                    $mark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                                }
                                elseif($papers['papers']['score_type']=='Grade')
                                {
                                    $mark=(isset($mark['grade'])&& $mark['grade']!=null)?$mark['grade']:'';
                                }
                                else
                                {
                                    $mark=(isset($mark['score'])&& $mark['score']!=null)?$mark['score']:'';
                                }   
                                $output.=''.$mark.'<br>';
                            }          
                            $output.=' </td></tr>';
                            $output.='</tbody>
                            </table>';
                             
                            
                        }
                       
                    } 
                    foreach($getspsubject3['data'] as $subject)
                    {   
                        //dd($subject);
                        $pdata = [
                            'branch_id' => session()->get('branch_id'),
                            'exam_id' => $request->exam_id,
                            'department_id' => $request->department_id,
                            'class_id' => $request->class_id,
                            'section_id' => $request->section_id,
                            'semester_id' => $request->semester_id,
                            'session_id' => $request->session_id,
                            'academic_session_id' => $request->academic_year,
                            'student_id' => $stu['student_id'],
                            'subject_id' => $subject['subject_id'],                                
                            'pdf_report' => 4
                            
                        ];
                        $getmarks = Helper::PostMethod(config('constants.api.getsubjecpapertlist'), $pdata);
                      
                        $i=0;
                        $n=count($getmarks['data']); 
                        
                        foreach($getmarks['data'] as $papers)
                        {
                           
                           
                        $output.='<table class="table table-bordered" style="margin-top:10px;">
                        <thead class="colspanHead">
                            <tr>
                                <td colspan="5" style="text-align:center; border: 1px solid black;">
                                '.$subject['name'].' (listed in Final Semester)</td>
                                
                            </tr>
                        </thead>
                        <tbody><tr>';
                        $nsem=count($papers['marks']);
                        $s=0;
                          foreach($papers['marks'] as $mark)
                          {
                              $s++;
                              if($s==$nsem)
                              {
                            if($papers['papers']['score_type']=='Points')
                            {
                                $mark=(isset($mark['grade_name'])&& $mark['grade_name']!=null)?$mark['grade_name']:'';
                            }
                            elseif($papers['papers']['score_type']=='Freetext')
                            {
                                $mark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                            }
                            elseif($papers['papers']['score_type']=='Grade')
                            {
                                $mark=(isset($mark['grade'])&& $mark['grade']!=null)?$mark['grade']:'';
                            }
                            else
                            {
                                $mark=(isset($mark['score'])&& $mark['score']!=null)?$mark['score']:'';
                            }   
                            $output.=' <td colspan="5" style="height:70px;">'.$mark.'</td>';
                        }     
                    }     
                        $output.=' </tr>';
                        $output.='</tbody></table>';
                         
                        
                    }
                   
                } 
                $output .= '<p style="text-align:left;font-size:9px;">*The contents of the first and second semester will be communicated in a three-parties meeting.</p>
                                
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
    public function downbypersoanalreport(Request $request)
    {
        
       
        $data = [
            'branch_id' => session()->get('branch_id'),
            'exam_id' => $request->exam_id,
            'department_id' => $request->department_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => $request->academic_year,
            
            
        ];
        $data1 = [
            'branch_id' => session()->get('branch_id'),
            'exam_id' => $request->exam_id,
            'department_id' => $request->department_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => $request->academic_year,
            'pdf_report' => 0, // All Primary Subjects
            'mandatory'=>'1' // Mandatory Subjects
            
        ];
        $data2 = [
            'branch_id' => session()->get('branch_id'),
            'exam_id' => $request->exam_id,
            'department_id' => $request->department_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => $request->academic_year,
            'pdf_report' => 0, // All Primary Subjects
            'mandatory'=>'0' // Non Mandatory Subjects
            
        ];
        
        $getstudents = Helper::PostMethod(config('constants.api.exam_studentslist'), $data);
        
        $getmainsubjects = Helper::PostMethod(config('constants.api.get_mainsubjectlist'), $data1);        
        $getnonmainsubjects = Helper::PostMethod(config('constants.api.get_mainsubjectlist'), $data2);
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
        $bdata = [
			'id' => session()->get('branch_id'),
			];
			$getbranch = Helper::PostMethod(config('constants.api.branch_details'), $bdata);
        //dd($acyear['data']['name']);
        $acy=$acyear['data']['name'];
		foreach($getstudents['data'] as $stu)
        {
            $sno++; 
        $output .= '<table class="main" width="100%">			
            <tr>
				<td colspan="5"> <h4>'.$getbranch['data']['school_name'].'</h4>
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
                        <td></td>';
                        $main=0;$opt=0;

                       foreach($getmainsubjects['data'] as $mainsubject)
                       {
                        $main++;
                       $output.=' <td>'.$mainsubject['name'].'</td>';
                       }
                       foreach($getnonmainsubjects['data'] as $optsubject)
                       {
                        $opt++;
                       $output.=' <td>'.$optsubject['name'].'</td>';
                       }
                        
                       $output.=' <td>Total of   '.$main.' subject</td>
                        <td>Total of   '.($main+$opt).' subject</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Personal point</td>';
                        $i=0; $totalmain=0;$totalopt=0;
                        foreach($getmainsubjects['data'] as $subject)
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
                            'subject_id' => $subject['subject_id'],
                            'pdf_report' => 5,
                            'academic_session_id' => $request->academic_year
                            
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.stuexam_marklist'), $studata);
                            //dd($getmainsubjects['data'],$studata,$getmarks);
                            $mark=(isset($getmarks['data']['score']) && $getmarks['data']['score']!=null)?$getmarks['data']['score']:'';
                           
                            $output.='<td colspan="1">'.$mark.'</td>';
                            $mark=($mark!='')?$mark:0;
                            $totalmain+=$mark;
                        }
                        foreach($getnonmainsubjects['data'] as $subject)
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
                            'subject_id' => $subject['subject_id'],
                            'pdf_report' => 5,
                            'academic_session_id' => $request->academic_year
                            
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.stuexam_marklist'), $studata);
                            
                           
                                $mark=(isset($getmarks['data']['score']) && $getmarks['data']['score']!=null)?$getmarks['data']['score']:'';
                           
                            
                            $output.='<td colspan="1">'.$mark.'</td>';
                            $mark=($mark!='')?$mark:0;
                            $totalopt+=$mark;
                        }
                        $totall=$totalmain+ $totalopt;
                            $output.='<td>'.$totalmain.'</td>
                                    <td>'.$totall.'</td>';
                        
                        $output.='</tr>
                    <tr>
                        <td>Grade Avarage</td>';
                        $ma=0; $totalavgmain=0;$totalavgopt=0;
                        foreach($getmainsubjects['data'] as $subject)
                       {
                            $ma++;
                            $studata = [
                            'branch_id' => session()->get('branch_id'),
                            'student_id' => $stu['student_id'],
                            'exam_id' => $request->exam_id,
                            'class_id' => $request->class_id,
                            'section_id' => $request->section_id,
                            'semester_id' => $request->semester_id,
                            'session_id' => $request->session_id,
                            'subject_id' => $subject['subject_id'],
                            'pdf_report' => 5,
                            'academic_session_id' => $request->academic_year
                            
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.stuexam_avgmarklist'), $studata);
                            $mark=(isset($getmarks['data']['avg']) && $getmarks['data']['avg']!=null)?$getmarks['data']['avg']:'';
                           
                            $output.='<td colspan="1">'.$mark.'</td>';
                            $mark=($mark!='')?$mark:0;
                           $totalavgmain+=$mark;

                        }
                        $op=0;
                        foreach($getnonmainsubjects['data'] as $subject)
                       {
                            $op++;
                            $studata = [
                            'branch_id' => session()->get('branch_id'),
                            'student_id' => $stu['student_id'],
                            'exam_id' => $request->exam_id,
                            'class_id' => $request->class_id,
                            'section_id' => $request->section_id,
                            'semester_id' => $request->semester_id,
                            'session_id' => $request->session_id,
                            'subject_id' => $subject['subject_id'],
                            'pdf_report' => 5,
                            'academic_session_id' => $request->academic_year
                            
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.stuexam_avgmarklist'), $studata);
                            $mark=(isset($getmarks['data']['avg']) && $getmarks['data']['avg']!=null)?$getmarks['data']['avg']:'';
                           
                            $output.='<td colspan="1">'.$mark.'</td>';
                            $mark=($mark!='')?$mark:0;
                           
                            $totalavgopt+=$mark;
                        }

                       
                        $avgtotal1=$totalavgmain/$ma;
                        $avgtotal2= ($totalavgmain+$totalavgopt)/($ma+$op);
                        $output.='  <td>'.round($avgtotal1, 2).'</td>
                        <td>'.round($avgtotal2, 2).'</td>
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
    public function downprimaryform1($id)
		{
			
			//dd($student_id);
			$footer_text = session()->get('footer_text');
			$sdata = [
            'id' => $id,
            
			];       
			$getstudent = Helper::PostMethod(config('constants.api.student_details'), $sdata);
			$student=$getstudent['data']['student'];
			$data = [
            'id' => $id,
            'department_id'=> $student['department_id'],
			]; 
			$prev = json_decode($getstudent['data']['student']['previous_details']);
			$school_name=$prev->school_name;
			$pdata = [
            'id' => $student['father_id'],
			];
			$getparent = Helper::PostMethod(config('constants.api.parent_details'), $pdata);
			$getclasssec = Helper::PostMethod(config('constants.api.studentclasssection'), $data);
			$parent=$getparent['data']['parent'];
			
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
			$output .='<main><h4 style=" text-align:center">'.__('messages.download_form1title').'</h4>
			<h4 class="float-left">'.__('messages.download_form1title2').'</h4>
			<table class="main" width="100%">
			<tr>
			<td class="content-wrap aligncenter" style="margin: 0;padding: 20px;align=center">
			
			
			<table class="table table-bordered">
			<thead>
			<tr>
			<td>'.$student['first_name'].' '.$student['last_name'].'</td>
			</tr>
			<tr>
			<td>'.$student['roll_no'].'</td>
			</tr>
			</thead>
			</table>
			</td>
			<td>
			<table class="table table-bordered" style="margin-bottom: 15px;">
			<thead>
			<tr>
			<th  colspan="2" style="text-align:center;width:50px;border: 1px solid black;">'.__('messages.division').'</th>
			<th colspan="1" class="diagonalCross2" style="width:50px;border: 1px solid black;border-right:hidden; border-left:hidden;"></th>
			<th  colspan="1" style="text-align:center;border: 1px solid black;">'.__('messages.grade').'</th>
			';
			$getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
			//dd('$getgrade');
			foreach($getgrade['data'] as $grade)
			{
				
				$output.=' <th style=" border: 1px solid black;">'.$grade['name'].'</th>';
			}
			
			$output.='</tr>
			
			</thead>
			<tbody>
			<tr>
			<td colspan="4">'.__('messages.class').'</td>';
			foreach($getclasssec['data'] as $sec)
			{
				
				$output.='<td> '.$sec['section'].'</td>';
			}
			$output.='</tr>
			<tr>
			<td colspan="4">'.__('messages.attendance_no').'</td>
			';
			foreach($getclasssec['data'] as $sec)
			{
				
				$output.='<td> '.$sec['studentPlace'].'</td>';
			}
			$output.='
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
			<th colspan="15" style="text-align:center; border: 1px solid black;">'.__('messages.records_academic').'</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td rowspan="2">'.__('messages.student').'</td>
			<td>'.__('messages.phonetic_name').'</td>
			<td colspan="3">'.$student['first_name'].' '.$student['last_name'].'<br>
			
			'.$student['birthday'].'<br></td>
			<td colspan="">'.__('messages.gender').'</td>
			<td colspan="">'.$student['gender'].'</td>
			<td colspan="3">'.__('messages.previous_school').'</td>
			<td colspan="5">'.$school_name.'</td>
			</tr>
			<tr>
			<td>'.__('messages.current_address').'</td>
			<td colspan="5">'.$student['current_address'].'</td>
			<td colspan="3">'.__('messages.admissions_transfers_etc').'</td>
			<td colspan="5"></td>
			</tr>
			<tr>
			<td rowspan="3">'.__('messages.parent').'</td>
			<td>'.__('messages.phonetic_name').'</td>
			<td colspan="5">'.$parent['first_name'].' '.$parent['last_name'].'</td>
			<td colspan="3">'.__('messages.dropout').'</td>
			<td colspan="5"></td>
			</tr>
			
			<tr style="height:70px">
			<td rowspan="2">'.__('messages.current_address').'</td>
			<td rowspan="2" colspan="5">'.$parent['address'].','.$parent['address_2'].','.$parent['city'].','.$parent['state'].','.$parent['post_code'].','.$parent['country'].'</td>
			<td colspan="3">'.__('messages.graduation').'</td>
			<td colspan="5"></td>
			</tr>
			<tr>
			<td colspan="3" style="height:70px">'.__('messages.next_school').'</td>
			<td colspan="5"></td>
			</tr>
			</tbody>
			</table>
			<table class="table table-bordered">
			<tr>
			<td colspan="4" style="width:90px">'.__('messages.school_name_and_location').'</td>';
			
			$bdata = [
			'id' => session()->get('branch_id'),
			];
			$getbranch = Helper::PostMethod(config('constants.api.branch_details'), $bdata);
			//dd($getbranch);
			$output.='<td colspan="7">
			'.$getbranch['data']['school_name'].'<br>
			'.$getbranch['data']['address'].'<br>
			Tel: '.$getbranch['data']['mobile_no'].' Mail : '.$getbranch['data']['email'].'<br>
			</td>
			</tr>
			</table>
			<table class="table table-bordered">
			<tr>
			<td class="diagonal" style="width:122px;border-bottom:hidden">
			<span class="lb">'.__('messages.fiscal_year').'</span>
			<span class="rt"></span>
			<div class="line"></div>
			</td>';
			foreach($getclasssec['data'] as $ac)
			{
				
				$output.=' <th style=" border: 1px solid black;">'.$ac['academic_year'].'</th>';
			}
			
			$output.='
			
			</tr>
			<tr>
			<td>'.__('messages.division_grade').'</td>';
			foreach($getgrade['data'] as $grade)
			{
				
				$output.=' <th style=" border: 1px solid black;">'.$grade['name'].'</th>';
			}
			
			$output.='
			</tr>
			<tr style="height:80px">
			<td>'.__('messages.principals_name_seal').'</td>';
			foreach($getclasssec['data'] as $princ)
			{
				$output.=' <th style=" border: 1px solid black;">'.$princ['principal'].'</th>';
			}
			
			$output.='
			
			</tr>
			<tr style="height:80px">
			<td>'.__('messages.class_teacher_name_stamp').'</td>';
			foreach($getclasssec['data'] as $teach)
			{
				$output.=' <th style=" border: 1px solid black;">'.$teach['teacher'].'</th>';
			}
			
			$output.='
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
			$fileName = __('messages.download_form1') .'-'. $name . ".pdf";
			return $pdf->download($fileName);
			// return $pdf->stream();        
			
		}
		
		public function downloadYorokuform2a($id)
		{
			$student_id=$id;
			$footer_text = session()->get('footer_text');
			$sdata = [
            'id' => $id,
			]; 
			$getstudent = Helper::PostMethod(config('constants.api.student_details'), $sdata);
			$student=$getstudent['data']['student'];
            //dd($student);
			$data = [
            'id' => $id,
            'department_id' => $student['department_id'],
			];       
			
			$getclasssec = Helper::PostMethod(config('constants.api.studentclasssection'), $data);
			
			
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
			$output .='<h4 class=" float-left">'.__('messages.download_form2Atitle').'</h4>
			<table class="main" width="100%">
            <tr>
			<td colspan="2" class="content-wrap aligncenter" style="margin: 0;padding: 20px;
			align=" center">
			
			
			<table class="table table-bordered" style="margin-bottom: 15px;">
			<thead>
			<tr>
			<th style=" border: 1px solid black;">'.__('messages.student_name').'</th>
			<th style=" border: 1px solid black;">'.__('messages.school_name').'</th>
			<th style=" border: 1px solid black;">'.__('messages.division_grade').'</th>';
			$getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
			//dd($getgrade);
			$totgrade=0;
			foreach($getgrade['data'] as $grade)
			{
				$totgrade++;
				//dd($grade);
				$output.=' <th style=" border: 1px solid black;">'.$grade['name'].'</th>';
			}
			
			$output.='
			</tr>
			
			</thead>
			<tbody>
			<tr>
			<td rowspan="6">'.$student['first_name'].' '.$student['last_name'].'</td>';
			$bdata = [
			'id' => session()->get('branch_id'),
			];
			$getbranch = Helper::PostMethod(config('constants.api.branch_details'), $bdata);
			//dd($getbranch);
			$output.='
			<td rowspan="6">'.$getbranch['data']['school_name'].'<br>
			'.$getbranch['data']['address'].'</td>
			<td style="height:60px;">'.__('messages.class').'</td>';
			foreach($getclasssec['data'] as $sec)
			{
				
				$output.='<td> '.$sec['section'].'</td>';
			}
			$output.='</tr>
			
			<tr>
			<td style="height:60px;">'.__('messages.attendance_no').'</td>';
			foreach($getclasssec['data'] as $sec)
			{
				
				$output.='<td> '.$sec['studentPlace'].'</td>';
			}
			$output.='
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			
			<tr>
			<td style="width:50%">
			
			
			
			<table class="table table-bordered">
			<thead class="colspanHead">
			<tr>
			<td colspan="'.($totgrade+4).'" style="text-align:center; border: 1px solid black;">
			'.__('messages.transcripts_of_each_subject').'</td>
			
			</tr>
			</thead>
			<tbody>
			<tr>
			<td colspan="1">'.__('messages.subject').'</td>
			<td colspan="1">'.__('messages.perspectives').'</td>
			<td colspan="1" class="diagonalCross2"></td>
			<td colspan="1">'.__('messages.grade').'</td>';
			foreach($getgrade['data'] as $grade)
			{
				//dd($grade);
				$output.=' <th style=" border: 1px solid black;">'.$grade['name'].'</th>';
			}
			
			$output.='
			</tr>';
            $data = [
                'branch_id' => session()->get('branch_id'),
                'department_id' => $student['department_id'],
                'pdf_report' => 0 // All Primary Subjects
                
            ];
            
            $getprimarysubjects = Helper::PostMethod(config('constants.api.get_overallsubjectlist'), $data);
          
			foreach($getprimarysubjects['data'] as $subject)
			{ 
                $sdata = [
                    'branch_id' => session()->get('branch_id'),
                    'department_id' => $student['department_id'],
                    'subject_id' => $subject['subject_id'],
                    'pdf_report' => 0 // All Primary Subjects
                    
                ];
                $getpaperlist = Helper::PostMethod(config('constants.api.get_overallpaperlist'), $sdata);
               
                $n=count($getpaperlist['data']); 
                $i=0;
                foreach($getpaperlist['data'] as $papers)
			    { 
                    $i++;
                            
                         
                    $output.=' <tr>';
                    if($i==1)
                    {
                        $output.='<td rowspan="'.$n.'" style="width: 0px;">'.$subject['name'].'</td>';
                    }
                    $output.='<td  style="text-align:left;" colspan="3">'.$papers['paper_name'].'</td>';

                    foreach($getclasssec['data'] as $sec)
                    {				
                        $pdata = [
                            'branch_id' => session()->get('branch_id'),
                            'department_id' => $student['department_id'],
                            'class_id' =>  $sec['class_id'],
                            'section_id' =>  $sec['section_id'],
                            'academic_session_id' => $sec['academic_session_id'],
                            'student_id' => $student['id'],
                            'subject_id' => $subject['subject_id'],
                            'paper_id' => $papers['id'],
                            'pdf_report' => 0
                            
                        ];
                        $getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist'), $pdata);
                      
                        $mark=$getmarks['data'];
                        $fmark='';
                        if($papers['score_type']=='Points')
                        {
                            $fmark=(isset($mark['grade_name'])&& $mark['grade_name']!=null)?$mark['grade_name']:'';
                        }
                        elseif($papers['score_type']=='Freetext')
                        {
                            $fmark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                        }
                        elseif($papers['score_type']=='Grade')
                        {
                            $fmark=(isset($mark['grade'])&& $mark['grade']!=null)?$mark['grade']:'';
                        }
                        else
                        {
                            $fmark=(isset($mark['score'])&& $mark['score']!=null)?$mark['score']:'';
                        }  
                        
                        $output.=' <td>'.$fmark.'</td>';
                    }
                              
                        
                if($i==$n)
                    {
                        $output.='</tr>';
                    }
                }
					
				
			} 
			
			
			$output.='</table>
			</td>
			<td style="width:50%">';
            
            $data = [
                'branch_id' => session()->get('branch_id'),
                'department_id' => $student['department_id'],
                'pdf_report' => 7 // Yoroko Form 2a Subjects
                
            ];
            
            $getspecialsubjects = Helper::PostMethod(config('constants.api.get_overallsubjectlist'), $data);
          
			foreach($getspecialsubjects['data'] as $subject)
			{ 
                $sdata = [
                    'branch_id' => session()->get('branch_id'),
                    'department_id' => $student['department_id'],
                    'subject_id' => $subject['subject_id'],
                    'pdf_report' => 7 // Yoroko Form 2a Subjects
                    
                ];
                $getsppaperlist = Helper::PostMethod(config('constants.api.get_overallpaperlist'), $sdata);
               
                $n=count($getsppaperlist['data']); 
                $output.='<table class="table table-bordered specialtable">
			<thead class="colspanHead">
			<tr>
			
			<td colspan="'.($n+1).'" style="text-align:center; border: 1px solid black;">
			'.$subject['name'].'
			</td>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td colspan="1">'.__('messages.grade').'</td>';
            foreach($getsppaperlist['data'] as $papers)
			    {
                    $output.='<td colspan="1">'.$papers['paper_name'].'</td>';
                }
                $output.='</tr>';
			
			
                foreach($getclasssec['data'] as $sec)
                {
				$output.='<tr >
				<td >'.$sec['class'].'</td>';
               
                foreach($getsppaperlist['data'] as $papers)
			    {
                    $pdata = [
                        'branch_id' => session()->get('branch_id'),
                        'department_id' => $student['department_id'],
                        'class_id' =>  $sec['class_id'],
                        'section_id' =>  $sec['section_id'],
                        'academic_session_id' => $sec['academic_session_id'],
                        'student_id' => $student['id'],
                        'subject_id' => $subject['subject_id'],
                        'paper_id' => $papers['id'],
                        'pdf_report' => 7
                        
                    ];
                    $getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist'), $pdata);
                  
                    $mark=$getmarks['data'];
                    $fmark='';
                    if($papers['score_type']=='Points')
                    {
                        $fmark=(isset($mark['grade_name'])&& $mark['grade_name']!=null)?$mark['grade_name']:'';
                    }
                    elseif($papers['score_type']=='Freetext')
                    {
                        $fmark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                       
                    }
                    elseif($papers['score_type']=='Grade')
                    {
                        $fmark=(isset($mark['grade'])&& $mark['grade']!=null)?$mark['grade']:'';
                    }
                    else
                    {
                        $fmark=(isset($mark['score'])&& $mark['score']!=null)?$mark['score']:'';
                    }  
                    
                    
                    $output.='<td  colspan="1"  >'.$fmark.'</td>';
                }
				$output.='</tr>';
				
			}
			$output.='
			</tbody>
			</table>';
        }

        $output.='</td>
			</tr>
			
			</table>
			';
			
			$output .= '</body></html>';
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
		
		public function downloadYorokuform2b($id)
		{
			$student_id=$id;
			$footer_text = session()->get('footer_text');
			$sdata = [
            'id' => $id,
			]; 
			$getstudent = Helper::PostMethod(config('constants.api.student_details'), $sdata);
			$student=$getstudent['data']['student'];
			$data = [
            'id' => $id,
            'department_id' => $student['department_id'],
			];       
			
			$getclasssec = Helper::PostMethod(config('constants.api.studentclasssection'), $data);
            //dd($getclasssec)
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
			$output .= '<body><table class="main" width="100%">
            <tr> 
			<td class="content-wrap aligncenter" style="margin: 0;padding: 20px;
			text-align:center">
			
			
			<table class="table table-bordered" style="margin-bottom: 15px;">
			<thead>
			<tr>
			<th style=" border: 1px solid black;">'.__('messages.student_name').'</th>
			</tr>
			
			</thead>
			<tbody>
			<tr>
			<td>'.$student['first_name'].' '.$student['last_name'].'</td>
			</tr>
			
			</tbody>
			</table>';
			$data2 = [
                'branch_id' => session()->get('branch_id'),
                'department_id' => $student['department_id'],
                'pdf_report' => 8 // YOROKO FORM 2B
                
            ];
            
            $getprimarysubjects = Helper::PostMethod(config('constants.api.get_overallsubjectlist'), $data2);
          //dd($getprimarysubjects);
			foreach($getprimarysubjects['data'] as $subject)
			{ 
                $sdata = [
                    'branch_id' => session()->get('branch_id'),
                    'department_id' => $student['department_id'],
                    'subject_id' => $subject['subject_id'],
                    'pdf_report' => 8 // YOROKO FORM 2B
                    
                ];
                $getpaperlist = Helper::PostMethod(config('constants.api.get_overallpaperlist'), $sdata);
                $getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
                $ng=count($getgrade['data']); 
                $n=count($getpaperlist['data']); 
                $i=0;
                $output.='<table class="table table-bordered">
			<thead class="colspanHead">
			<tr>
			<td colspan="'.($ng+3).'" style="text-align:center; border: 1px solid black;">
			'.$subject['name'].'</td>
			</tr>
            <tr>
			<td colspan="1" style="text-align:center;width:50px;">'.__('messages.item').'</td>
			<td colspan="1" class="diagonalCross2" style="width:50px;"></td>
			<td colspan="1" style="text-align:center;">'.__('messages.grade').'</td>';
			$getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
			
			foreach($getgrade['data'] as $grade)
			{
				$output.=' <td>'.$grade['name'].'</td>';
			}                                
			$output.='
			
			</tr>
			
			</thead>
			<tbody>';
                foreach($getpaperlist['data'] as $papers)
			    { 
                    
                            
                         
                    $output.=' <tr>';
                   
                    $output.='<td  style="text-align:left;" colspan="3">'.$papers['paper_name'].'</td>';

                    foreach($getclasssec['data'] as $sec)
                    {				
                        $pdata = [
                            'branch_id' => session()->get('branch_id'),
                            'department_id' => $student['department_id'],
                            'class_id' =>  $sec['class_id'],
                            'section_id' =>  $sec['section_id'],
                            'academic_session_id' => $sec['academic_session_id'],
                            'student_id' => $student['id'],
                            'subject_id' => $subject['subject_id'],
                            'paper_id' => $papers['id'],
                            'pdf_report' => 8
                            
                        ];
                        $getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist'), $pdata);
                      
                        $mark=$getmarks['data'];
                        $fmark='';
                        if($papers['score_type']=='Points')
                        {
                            $fmark=(isset($mark['grade_name'])&& $mark['grade_name']!=null)?$mark['grade_name']:'';
                        }
                        elseif($papers['score_type']=='Freetext')
                        {
                            $fmark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                        }
                        elseif($papers['score_type']=='Grade')
                        {
                            $fmark=(isset($mark['grade'])&& $mark['grade']!=null)?$mark['grade']:'';
                        }
                        else
                        {
                            $fmark=(isset($mark['score'])&& $mark['score']!=null)?$mark['score']:'';
                        }  
                        
                        $output.=' <td>'.$fmark.'</td>';
                    }
                              
                        
              
                        $output.='</tr>';
                   
                }
				$output.='</tbody>
			</table>';	
				
			} 
			
			$data1 = [
                'branch_id' => session()->get('branch_id'),
                'department_id' => $student['department_id'],
                'pdf_report' => 9 // YOROKO FORM 2B
                
            ];
            
            $getspecialsubjects = Helper::PostMethod(config('constants.api.get_overallsubjectlist'), $data1);
          
			foreach($getspecialsubjects['data'] as $subject)
			{ 
                $sdata = [
                    'branch_id' => session()->get('branch_id'),
                    'department_id' => $student['department_id'],
                    'subject_id' => $subject['subject_id'],
                    'pdf_report' => 9 // YOROKO FORM 2B
                    
                ];
                $getpaperlist = Helper::PostMethod(config('constants.api.get_overallpaperlist'), $sdata);
                $getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
                $ng=count($getgrade['data']); 
                $n=count($getpaperlist['data']); 
                $i=0;
                $output.='<table class="table table-bordered">
			<thead class="colspanHead">
			<tr>
			<td colspan="4" style="text-align:center; border: 1px solid black;">
			'.$subject['name'].'</td>
			</tr>
			</thead>
			<tbody>';
           
                foreach($getpaperlist['data'] as $papers)
			    { 
                    
                    $output.='<tr>';      
                    $k=0;
                    foreach($getclasssec['data'] as $sec)
                    {				
                        $k++;
                        $pdata = [
                            'branch_id' => session()->get('branch_id'),
                            'department_id' => $student['department_id'],
                            'class_id' =>  $sec['class_id'],
                            'section_id' =>  $sec['section_id'],
                            'academic_session_id' => $sec['academic_session_id'],
                            'student_id' => $student['id'],
                            'subject_id' => $subject['subject_id'],
                            'paper_id' => $papers['id'],
                            'pdf_report' => 9
                            
                        ];
                        $getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist'), $pdata);
                      
                        $mark=$getmarks['data'];
                        $fmark='';
                        if($papers['score_type']=='Points')
                        {
                            $fmark=(isset($mark['grade_name'])&& $mark['grade_name']!=null)?$mark['grade_name']:'';
                        }
                        elseif($papers['score_type']=='Freetext')
                        {
                            $fmark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                        }
                        elseif($papers['score_type']=='Grade')
                        {
                            $fmark=(isset($mark['grade'])&& $mark['grade']!=null)?$mark['grade']:'';
                        }
                        else
                        {
                            $fmark=(isset($mark['score'])&& $mark['score']!=null)?$mark['score']:'';
                        }  
                      
                         $output.='<td  style="height: 200px;width: 0px; padding-top: 45px;">Y<br>e<br>a<br>r<br>'.$k.'</td>';
                     
                        $output.=' <td>'.$fmark.'</td>';
                        if($k%2==0)
                        {
                            $output.='</tr><tr>';  
                        } 
                    }
                              
                        
              
                        $output.='</tr>';
                   
                }
				$output.='</tbody>
			</table>';	
				
			} 
			
			$output.='<table class="table table-bordered">
			<thead class="colspanHead">
			<tr>
			<td colspan="18" style="text-align:center; border: 1px solid black;">
			'.__('messages.Attendance_records').'</td>
			</tr>
			</thead>
			<tbody>
			<tr>
            <td colspan="1" style="width: 0px;font-size: 10px;">'.__('messages.grade_division').'</td>
			<td colspan="1" style="width: 0px;font-size: 10px;">'.__('messages.number_of_classes').'</td>
			<td colspan="1" style="width: 0px;font-size: 10px;">'.__('messages.number_of_days_of_suspension').'</td>
			<td colspan="1" style="width: 85px;font-size: 10px;">'.__('messages.number_of_days_have_to_attend').'</td>
			<td colspan="1" style="width: 0px;font-size: 10px;">'.__('messages.number_of_days_absent').'</td>
			<td colspan="1" style="width: 0px;font-size: 10px;">'.__('messages.number_of_days_of_attendance').'</td>
			
			<td colspan="12" style="width: 0px;font-size: 10px;">'.__('messages.remarks').'</td>
			
			</tr>';
            $data1 = [
                'branch_id' => session()->get('branch_id'),
                'department_id' => $student['department_id'],
                'pdf_report' => 10 // YOROKO FORM 2B
                
            ];
            $subject_id=0;$paper_id=0;
            $getspecialsubjects = Helper::PostMethod(config('constants.api.get_overallsubjectlist'), $data1);
           
            if(isset($getspecialsubjects['data']) && $getspecialsubjects['data']!=[])
            {
			$subject_id=$getspecialsubjects['data'][0]['subject_id'];
            }
            $sdata = [
                    'branch_id' => session()->get('branch_id'),
                    'department_id' => $student['department_id'],
                    'subject_id' => $subject_id,
                    'pdf_report' => 10 // YOROKO FORM 2B
                    
                ];
                $getpaperlist = Helper::PostMethod(config('constants.api.get_overallpaperlist'), $sdata);
                if(isset($getpaperlist['data'])  && $getpaperlist['data']!=[])
                {
                $paper_id=$getpaperlist['data'][0]['id'];
                }
            foreach($getclasssec['data'] as $sec)
            {
                $totaldays='0'; $suspension='0'; $totalcomimg='0'; $totpres='0';$totabs='0';
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
                    'subject_id' => $subject_id,
                    'paper_id' => $paper_id,
                    'pdf_report' => 10
                    
                ];
                $getmarks = Helper::PostMethod(config('constants.api.getpaperoverallmarklist'), $pdata);
              
                $mark=$getmarks['data'];
                $remark='';
                if($papers['score_type']=='Points')
                {
                    $remark=(isset($mark['grade_name'])&& $mark['grade_name']!=null)?$mark['grade_name']:'';
                }
                elseif($papers['score_type']=='Freetext')
                {
                    $remark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                }
                elseif($papers['score_type']=='Grade')
                {
                    $remark=(isset($mark['grade'])&& $mark['grade']!=null)?$mark['grade']:'';
                }
                else
                {
                    $remark=(isset($mark['score'])&& $mark['score']!=null)?$mark['score']:'';
                }  
                    $getattendance = Helper::PostMethod(config('constants.api.getsem_studentattendance'), $attdata);
                    //dd($getattendance);
                foreach($getattendance['data'] as $att)
                {  
                    
                    $totaldays+=$att['no_schooldays'];
                    $suspension+=$att['suspension'];
                    $totalcomimg+=$att['totalcoming']; 
                    $totpres+=$att['totpres'];
                    $totabs+=$att['totabs'];
                }                  
            $output.=' <tr>
            <td colspan="1" style="width: 0px;">'.$sec['class'].'</td>
            <td colspan="1" style="width: 0px;">'.$totaldays.'</td>
            <td colspan="1" style="width: 0px;">'.$suspension.'</td>
            <td colspan="1" style="width: 0px;">'.$totalcomimg.'</td>
            <td colspan="1" style="width: 0px;">'.$totabs.'</td>
            <td colspan="1" style="width: 0px;">'.$totpres.'</td>
            <td colspan="12" style="width: 0px;;">'. $remark.'</td>            
            </tr>';
            }
			
			$output.='</tbody>
			</table>
			
			</td>
			</tr>
			</table>';
			
			$output .= '</body></html>';
			$pdf = \App::make('dompdf.wrapper');
			// set size
			$customPaper = array(0, 0, 792.00, 1224.00);
			$pdf->set_paper($customPaper);
			$pdf->loadHTML($output);
			// filename
			$now = now();
			$name = strtotime($now);
			$fileName = __('messages.download_form2b') . $name . ".pdf";
			return $pdf->download($fileName);
			// return $pdf->stream();
			
			
		}
		public function downsecondaryform1($id)
		{
			$student_id=$id;
			$sdata = [
            'id' => $id,
			];
			
			$getstudent = Helper::PostMethod(config('constants.api.student_details'), $sdata);
			$student=$getstudent['data']['student'];
			$prev = json_decode($getstudent['data']['student']['previous_details']);
            $data = [
                'id' => $id,
                'department_id'=> $student['department_id'],
            ]; 
			$school_name=$prev->school_name;
			$pdata = [
            'id' => $student['father_id'],
			];
			$getparent = Helper::PostMethod(config('constants.api.parent_details'), $pdata);
			$parent=$getparent['data']['parent'];
			//dd($student);
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
			$output .= '<body><h4 style="text-align:center;">'.__('messages.download_secondary_form1_title').'</h4>
			<h4 class="float-left">'.__('messages.download_secondary_form1_title2').'</h4>
			<table class="main" width="100%">
            <tr>
			<td class="content-wrap aligncenter" style="margin: 0;padding: 20px;
			text-align:center">
			
			
			<table class="table table-bordered" style="margin-bottom: 15px;">
			<thead>
			<tr>
			<tr>
			<td class="cell-left">'.__('messages.category').'</td>
			<td class="diagonalCross2" style="border-right:hidden; border-left:hidden;"></td>
			<td class="cell-right">'.__('messages.grade').'</td>';
            $getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
            $getclasssec = Helper::PostMethod(config('constants.api.studentclasssection'), $data);
            //dd('$getgrade');
            foreach($getgrade['data'] as $grade)
            {
                
            $output.=' <th style=" border: 1px solid black;">'.$grade['name'].'</th>';
            }
            
            $output.='
			</tr>
			
			</thead>
			<tbody>
			<tr>
			<td colspan="3">Class</td>'; foreach($getclasssec['data'] as $sec)
            {
            
            $output.='<td> '.$sec['section'].'</td>';
            }
            $output.='
			</tr>
			<tr>
			<td colspan="3">Attendance No</td>'; foreach($getclasssec['data'] as $sec)
            {
            
            $output.='<td> '.$sec['studentPlace'].'</td>';
            }
            $output.='
			</tr>
			</tbody>
			</table>
			
			<table class="table table-bordered">
			<thead class="colspanHead">
			<tr>
			<th colspan="17" style="text-align:center; border: 1px solid black;">'.__('messages.records_of_academic_records').'</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td rowspan="4" colspan="1" style="width:10px">'.__('messages.student').'</td>
			<td colspan="2">'.__('messages.pronouncation').'</td>
			<td colspan="6"></td>
			<td style="width:10px">'.__('messages.gender').'</td>
			<td style="width:10px"> '.$student['gender'].'</td>
			<td colspan="2" style="border-bottom:hidden" >'.__('messages.admission_transfer').'</td>
			<td colspan="4" style="border-bottom:hidden">'.__('messages.admission_transfer_previous').'</td>
			</tr>
			<tr>
			<td colspan="2">'.__('messages.name').'</td>                                           
			<td colspan="8"> '.$student['first_name'].' '.$student['last_name'].'</td>
			<td colspan="2" ></td>
			<td colspan="4" > '.$school_name.' </td>
			</tr>
			<tr>
			<td colspan="2">'.__('messages.date_of_birth').'</td>                                           
			<td colspan="8"> '.$student['birthday'].'</td>
			<td colspan="2" style="border-bottom:hidden" >'.__('messages.transfer_student').'</td>
			<td colspan="4" style="border-bottom:hidden" ></td>
			</tr>
			<tr>
			<td colspan="2">'.__('messages.current_address').'</td>                                           
			<td colspan="8">'.$student['current_address'].'</td>
			<td colspan="2" ></td>
			<td colspan="4" ></td>
			</tr>
			
			
			<tr>
			<td rowspan="6" colspan="1" style="width:10px">'.__('messages.parent').'</td>
			<td colspan="2" rowspan="2" >'.__('messages.pronouncation').'</td>
			<td colspan="8" rowspan="2" ></td>
			<td colspan="2" >'.__('messages.the_day_left_school_to_transfer').'</td>
			<td colspan="4"></td>
			</tr>
			<tr>
			
			<td colspan="2">'.__('messages.date_of_withdrawal').'</td>
			<td colspan="4" ></td>
			
			</tr>
			<tr>
			<td colspan="2" rowspan="2" >'.__('messages.name').'</td>
			<td colspan="8" rowspan="2" >'.$parent['first_name'].' '.$parent['last_name'].'</td>
			<td colspan="2" >'.__('messages.next_transfer_school_name').'</td>
			<td colspan="4" ></td>
			</tr>
			
			<tr>
			
			
			<td colspan="2" >'.__('messages.year_of_transfer').'</td>
			<td colspan="4" ></td>
			
			</tr>
			<tr>
			
			<td colspan="2" style="border-bottom:hidden">'.__('messages.current_address').'</td>
			<td colspan="8" style="border-bottom:hidden"> '.$parent['address'].','.$parent['address_2'].','.$parent['city'].','.$parent['state'].','.$parent['post_code'].','.$parent['country'].'</td>
			<td colspan="2" >'.__('messages.location_as_above').'</td>
			<td colspan="4" ></td>
			
			</tr>
			<tr>
			<td colspan="2" ></td>
			<td colspan="8"></td>
			<td colspan="2" ></td>
			<td colspan="4" ></td>
			
			</tr>
			<tr>
			<td style="border-bottom:hidden">'.__('messages.experiences_before_admission').'
			</td>
			<td colspan="2" style="border-bottom:hidden;border-right:hidden;"></td>
			<td colspan="8" style="border-bottom:hidden;"></td>
			<td colspan="2" >'.__('messages.graduation').'</td>
			<td colspan="4"></td>
			
			</tr>
			<tr>
			<td></td>
			<td colspan="2" style="border-right:hidden;" ></td>
			<td colspan="8"></td>
			<td colspan="2" >'.__('messages.next_high_school_name').'</td>
			<td colspan="4"></td>
			
			</tr>
			</table>
			
			
			<table class="table table-bordered">
            <tr>
                <td colspan="4" style="width:90px">'.__('messages.school_name_and_location').'</td>';
                
                $bdata = [
                    'id' => session()->get('branch_id'),
                ];
                $getbranch = Helper::PostMethod(config('constants.api.branch_details'), $bdata);
                //dd($getbranch);
                $output.='<td colspan="7">
                    '.$getbranch['data']['school_name'].'<br>
                    '.$getbranch['data']['address'].'<br>
                    Tel: '.$getbranch['data']['mobile_no'].' Mail : '.$getbranch['data']['email'].'<br>
                </td>
            </tr>
        </table>
        <table class="table table-bordered">
            <tr>
                <td class="diagonal" style="width:122px;border-bottom:hidden">
                    <span class="lb">'.__('messages.fiscal_year').'</span>
                    <span class="rt"></span>
                    <div class="line"></div>
                </td>';
                foreach($getclasssec['data'] as $ac)
                    {
                        
                    $output.=' <th style=" border: 1px solid black;">'.$ac['academic_year'].'</th>';
                    }
                    
                    $output.='
            
            </tr>
            <tr>
                <td style="height:60px;">'.__('messages.division_grade').'</td>';
                foreach($getgrade['data'] as $grade)
                    {
                        
                    $output.=' <th style=" border: 1px solid black;">'.$grade['name'].'</th>';
                    }
                    
                    $output.='
            </tr>
            <tr style="height:80px">
                <td style="height:60px;">'.__('messages.principal_sign').'</td>';
                foreach($getclasssec['data'] as $princ)
                    {
                        $output.=' <th style=" border: 1px solid black;">'.$princ['principal'].'</th>';
                    }
                    
                    $output.='
                
            </tr>
            <tr style="height:80px">
                <td style="height:60px;">'.__('messages.grade_teacher_sign').'</td>';
                foreach($getclasssec['data'] as $teach)
                {
                    $output.=' <th style=" border: 1px solid black;">'.$teach['teacher'].'</th>';
                }
                
                $output.='
            </tr>
            
        </table>
			
			</tbody>
			</table>
			
			</td>
			</tr>
			</table>';
			
			$output .= '</body></html>';
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
		
	//ass
}
