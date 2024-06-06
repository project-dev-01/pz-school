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
			.table td,
			.table th {
            padding: 2px;
			}
			
			.table {
            width: 100%;
            margin-bottom: 1px;
            color: black;
            text-align: center; border-collapse: collapse;
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
        $output .= '<table  style="width:100%">
			<tr >
				<td colspan="3"  style="margin: 0;padding: 20px;"
				align="center">
					
					
					<p style="font-size:30px;margin-left: 15px;"><img src="https://api.suzen.school/common-asset/images/logo_jskl.jpeg"><br>'.$getbranch['data']['school_name'].'</p>
				</td>
			</tr>
			<tr>
				
				<td>
					<p>'.$acy.'</p>
				</td>
				<td>
					<p>English Communication</hp4>
				</td>
				<td>
					<p>'.$term['data']['name'].'</p>
				</td>
			</tr>
			<tr>  <td>
				<p>Number</p>
				<p>'.$stu['roll'].'</p>
			</td>
			
			<td>
				<p>EC-Class</p>
				<p>Balsam</p>
				
			</td>
			<td>
				<p>Level</p>
				<p>Advanced</p>
				
			</td>
			</tr>
			<tr>  
				<td>
					<p>Student Name</p>
				</td>
				<td colspan="2" >
					<p>'.strtoupper($stu['name']).'</p>
				</td>
				
			</tr>
            <tr> 
				<td colspan="3" >';
                if($request->department_id==1)
                {
                // Subject Name => EC or English Communication

                //Listening
                $l1="L-1 Understands and follows instructions in class activities";	
                $l2="L-2 Understands simple transactions in conversations and activities"; 
                $l3="L-3 Understands and recognises main points in simple speech.";
                //Reading
                $r1="R-1 Reads simple words and follows instructions on posters and worksheets";	
                $r2="R-2 Reads simple sentences in the text book"; 	
                //Speaking
                $s1="S-1 Tries to have a conversation form using simple phrases and sentences"; 	
                $s2="S-2 Asks and answers simple questions on familiar topics"; 	
                $s3=" S-3 Uses clear and loud speech to communicate";	
                $s4="S-4 Uses learned phrases and sentences to give ideas and opinions"; 	
                //Writing
                $w1="W-1 Writes simple, short words";	
                $w2="W-2 Fills in simple forms and worksheets with proper words and phrases"; 	
                //Attitude
                $a1="A-1 Cooperates and pays attention in class"; 	
                $a2="A-2 Participates actively in class activities, games, and discussions"; 	
                $a3="A-3 Contributes positively in group work";
                $heading=array('Listening','Reading','Speaking','Writing','Attitude');
                $papers[0]=array($l1,$l2,$l3);
                $papers[1]=array($r1,$r2);
                $papers[2]=array($s1,$s2,$s3);
                $papers[3]=array($w1,$w2);
                $papers[4]=array($a1,$a2,$a3);
                                $output.='<table class="table table-bordered">';
                    $teachername='';$teachercmd='';
                    $i=0;
                    foreach($heading as $heads)
                    {
                        $output.='
			
						<thead class="colspanHead">
							<tr>
								<td colspan="2"
								style="text-align:center; border: 1px solid black;background-color:#40403a57">
								'.$heads.'</td>
							</tr>
						</thead>
						<tbody>';
                        $paperslist=$papers[$i];
                        //dd($Getpaper);
                        $i++;
                        foreach($paperslist as $papername)
                        { 
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
                                
                                'paper_name' => $papername
                                
                            ];
                           
                            $paper = Helper::PostMethod(config('constants.api.getec_marks'), $pdata);
                            //dd($getspsubject1);//dd($pdata);
                            $mark="";
                            if(!empty($paper['data']))
                            {                         
                         
                                if($paper['data']['score_type']=='Points')
                                {
                                    $mark=$paper['data']['grade_name'];
                                }
                                elseif($paper['data']['score_type']=='Freetext')
                                {
                                    $mark=$paper['data']['freetext'];
                                }
                                elseif($paper['data']['score_type']=='Grade')
                                {
                                    $mark=$paper['data']['grade'];
                                }
                                else
                                {
                                    $mark=$paper['data']['score'];
                                }
                            }
                           
                            $output.='<tr>
								<td>'.$papername.'</td>
								<td>'.$mark.'</td>
							</tr>';
                        }
                        $output.='</tbody>
						
					';
                    }

                $output.='</table>';
                }
                if($request->department_id==2)
                {
                // Subject Name => EC or English Communication

                //Listening
                $l1="L-1 Understands and follows instructions in class activities"; 	
                $l2="L-2 Understands transactions in conversations and activities"; 	
                $l3="L-3 Understands and recognises main points in speech";  	
                //Reading
                $r1="R-1 Reads high frequency words"; 	
                $r2="R-2 Reads sentences in the text book"; 	
                //Speaking
                $s1="S-1 Tries to have a conversation form using phrases and sentences";  	
                $s2="S-2 Asks and answers questions on familiar topics";  	
                $s3="S-3 Uses clear and loud speech to communicate";  	
                $s4="S-4 Uses learned phrases and sentences to give ideas and opinions";  	
                $s5="S-5 Speaks with fluency, proper pronunciation and intonation";  	
                //Writing
                $w1="W-1 Writes simple, short words";  	
                $w2="W-2 Fills in simple forms and worksheets with proper words and phrases";  	
                $w3="W-3 Expresses opinions and ideas using learned words and sentences";  	
                //Attitude
                $a1="A-1 Cooperates and pays attention in class"; 	
                $a2="A-2 Brings books and files, submit homework and classwork on time"; 	
                $a3="A-3 Participates actively in class activities, games, and discussions";  	
                $a4="A-4 Contributes positively in group work"; 	
                $heading=array('Listening','Reading','Speaking','Writing','Attitude');
                $papers[0]=array($l1,$l2,$l3);
                $papers[1]=array($r1,$r2);
                $papers[2]=array($s1,$s2,$s3,$s4,$s5);
                $papers[3]=array($w1,$w2,$w3);
                $papers[4]=array($a1,$a2,$a3,$a4);
                    $output.='<table class="table table-bordered">';
                    $teachername='';$teachercmd='';
                    $i=0;
                    foreach($heading as $heads)
                    {
                        $output.='
			
						<thead class="colspanHead">
							<tr>
								<td colspan="2"
								style="text-align:center; border: 1px solid black;background-color:#40403a57">
								'.$heads.'</td>
							</tr>
						</thead>
						<tbody>';
                        $paperslist=$papers[$i];
                        //dd($Getpaper);
                        $i++;
                        foreach($paperslist as $papername)
                        { 
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
                                
                                'paper_name' => $papername
                                
                            ];
                           
                            $paper = Helper::PostMethod(config('constants.api.getec_marks'), $pdata);
                            //dd($getspsubject1);//dd($pdata);
                            $mark="";
                            if(!empty($paper['data']))
                            {                         
                         
                                if($paper['data']['score_type']=='Points')
                                {
                                    $mark=$paper['data']['grade_name'];
                                }
                                elseif($paper['data']['score_type']=='Freetext')
                                {
                                    $mark=$paper['data']['freetext'];
                                }
                                elseif($paper['data']['score_type']=='Grade')
                                {
                                    $mark=$paper['data']['grade'];
                                }
                                else
                                {
                                    $mark=$paper['data']['score'];
                                }
                            }
                           
                            $output.='<tr>
								<td>'.$papername.'</td>
								<td>'.$mark.'</td>
							</tr>';
                        }
                        $output.='</tbody>
						
					';
                    }

                $output.='</table>';
                }
                $output.=' </td>
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
                            $papername="Teachers Comments";                               
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
                                'paper_name' => $papername
                                
                            ];
                            $paper = Helper::PostMethod(config('constants.api.getec_marks'), $pdata);
                            //dd($getspsubject1);//dd($pdata);
                            $teachercmd="";
                            if(!empty($paper['data']))
                            {                         
                         
                                if($paper['data']['score_type']=='Points')
                                {
                                    $teachercmd=$paper['data']['grade_name'];
                                }
                                elseif($paper['data']['score_type']=='Freetext')
                                {
                                    $teachercmd=$paper['data']['freetext'];
                                }
                                elseif($paper['data']['score_type']=='Grade')
                                {
                                    $teachercmd=$paper['data']['grade'];
                                }
                                else
                                {
                                    $teachercmd=$paper['data']['score'];
                                }
                            }
                            $teachernameapi = Helper::PostMethod(config('constants.api.getec_teacher'), $pdata);
                            $teachername='';
                            if(!empty($teachernameapi['data']))
                            {
                                $teachername=$teachernameapi['data']['first_name'].' '.$teachernameapi['data']['last_name'];
                            }
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
					<p> English Teachers Name</p>
					</td>
					
					
					<td>
					<p> '.$teachername.'</p>
					
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

        $language="国語";
        $math='算数';
        $life='生活';
        $music='音楽';
        $art='図工';
        $sport='体育';
        $science="理科";
        $socity="社会";
        $homeeconomics="家庭科";
        $foreignlanguage="外国語";
        $english="英語";
        $tech_homeeconomics="技術・家庭科";


        $primarypaper1="知識・技能"; //Knowledge & Skills
        $primarypaper2="思考・判断・表現"; //Thinking, Judgment, and Expression
        $primarypaper3="主体的に学習に取り組む態度"; //Attitude to proactive learning
        $primarypaper4 ="評定"; // Rate / Rating
        $personal_score="個人得点"; //   individual score / Personal Points

        $specialsubject1="行動及び生活の記録"; //Records of actions and life
        $specialpaper1="気持ちのよい挨拶と返事をし、時間を守り、規則正しい生活を する。";// Greet and reply pleasantly, be punctual, and be regular Make a living.
        $specialpaper2="体力の向上に努め、元気に生活をする。"; // Strive to improve own physical fitness and live a healthy life.						
        $specialpaper3="より高い目標を決め、根気強く努力する。";	// Set higher goals and work hard.					
        $specialpaper4="自分の役割と責任を自覚し、信頼される行動をする";	//Be aware of own roles and responsibilities and act in a way that is trustworthy.				
        $specialpaper5="進んで新しい考えや方法を見付け、工夫して生活をよりよくしよう とする。";	// willing to find new ideas and methods, and try to improve own living by devising ways to do so					
        $specialpaper6="思いやりや感謝の心をもつとともに、相手の考えや立場を尊重し、力を合わせて生活する。"	;	//Have compassion and gratitude, and understand the thoughts and positions of others.   Respect and live together.				
        $specialpaper7="自然や自他の生命を大切にする。";	//Cherish nature, self and other life.					
        $specialpaper8="人や社会に役立つことを考え、進んで仕事や奉仕活動をする。";	//Think about being useful to people and society, and be willing to work and do service activities.  Do.					
        $specialpaper9="正義を大切にし、公正・公平にふるまう。";	// We value justice and act in a fair and equitable manner.				
        $specialpaper10="公共の物を大切にし、学校や社会のきまりを守って生活する。";	// Cherish public objects and live in compliance with the rules of school and society Do.			 		
        
        $specialsubject2="特別の教科 道徳"; // Special Subject: Morality
        $specialsubject3="特 別 活 動 等 の 記 録"; // Records of special activities, etc
        $specialsubject4="所見"; // Findings
        $specialsubject5="総合的な学習の時間"; // Hours of integrated study         
        $specialsubject6="外 国 語 活 動"; // Foreign Language Activities
        $description=array("説明"); // Descriptions
        
        
        $getstudents = Helper::PostMethod(config('constants.api.exam_studentslist'), $data); 
            
        $getacyeardates = Helper::PostMethod(config('constants.api.getacyeardates'), $data);
        $getteacherdata = Helper::PostMethod(config('constants.api.classteacher_principal'), $data);
        
        $grade = Helper::PostMethod(config('constants.api.class_details'), $data);
        $section = Helper::PostMethod(config('constants.api.section_details'), $data);
        $stuclass=$grade['data']['name_numeric'];
        if($request->department_id==1) // Primary 
        {
            if($stuclass==1 || $stuclass==2)
            {
                $getprimarysubjects = array($language,$math,$life,$music,$art,$sport);
                $getprimarypapers = array($primarypaper1,$primarypaper2,$primarypaper3);
                $getspecialpapers = array($specialpaper1,$specialpaper2,$specialpaper3,$specialpaper4,$specialpaper5,$specialpaper6,$specialpaper7,$specialpaper8,$specialpaper9,$specialpaper10);
                $getspsubject1 = array($specialsubject1); // Records of actions and life- Excellent Report & only 3rd Semester                
                $getspsubject2 = array($specialsubject2); // Special Subject: Morality ( 3rd Semester)              
                $getspsubject3 = array($specialsubject3); // Records of special activities, etc (All Semester )
                $getspsubject4 = array($specialsubject4); // Findings  ( 3rd Semester) 
                $getspsubject5 = array(); // Hours of integrated study (2nd Semester)
                $getspsubject6 = array(); // Foreign Language Activities  ( 3rd Semester) 
            }
            if($stuclass==3 || $stuclass==4)
            {
                $getprimarysubjects = array($language,$math,$life,$music,$art,$sport);
                $getprimarypapers = array($primarypaper1,$primarypaper2,$primarypaper3);
                $getspecialpapers = array($specialpaper1,$specialpaper2,$specialpaper3,$specialpaper4,$specialpaper5,$specialpaper6,$specialpaper7,$specialpaper8,$specialpaper9,$specialpaper10);
                $getspsubject1 = array($specialsubject1); // Records of actions and life- Excellent Report & only 3rd Semester                
                $getspsubject2 = array($specialsubject2); // Special Subject: Morality ( 3rd Semester)              
                $getspsubject3 = array($specialsubject3); // Records of special activities, etc (All Semester )
                $getspsubject4 = array($specialsubject4); // Findings  ( 3rd Semester) 
                $getspsubject5 = array($specialsubject5); // Hours of integrated study (2nd Semester)
                $getspsubject6 = array($specialsubject6); // Foreign Language Activities  ( 3rd Semester) 

            }
            if($stuclass==5 || $stuclass==6)
            {
                $getprimarysubjects = array($language,$math,$life,$music,$art,$sport);
                $getprimarypapers = array($primarypaper1,$primarypaper2,$primarypaper3);
                $getspecialpapers = array($specialpaper1,$specialpaper2,$specialpaper3,$specialpaper4,$specialpaper5,$specialpaper6,$specialpaper7,$specialpaper8,$specialpaper9,$specialpaper10);
                $getspsubject1 = array($specialsubject1); // Records of actions and life- Excellent Report & only 3rd Semester                
                $getspsubject2 = array($specialsubject2); // Special Subject: Morality ( 3rd Semester)              
                $getspsubject3 = array($specialsubject3); // Records of special activities, etc (All Semester )
                $getspsubject4 = array($specialsubject4); // Findings  ( 3rd Semester) 
                $getspsubject5 = array($specialsubject5); // Hours of integrated study (2nd Semester)
                $getspsubject6 = array(); // Foreign Language Activities  ( 3rd Semester) 
            }

        }
        elseif($request->department_id==2) // Secondary 
        {
            $getprimarysubjects = array($language,$math,$life,$music,$art,$sport);
                $getprimarypapers = array($primarypaper1,$primarypaper2,$primarypaper3,$primarypaper4);
                $getspecialpapers = array($specialpaper1,$specialpaper2,$specialpaper3,$specialpaper4,$specialpaper5,$specialpaper6,$specialpaper7,$specialpaper8,$specialpaper9,$specialpaper10);
                $getspsubject1 = array($specialsubject1); // Records of actions and life- Excellent Report & only 3rd Semester                
                $getspsubject2 = array($specialsubject2); // Special Subject: Morality ( 3rd Semester)              
                $getspsubject3 = array($specialsubject3); // Records of special activities, etc (All Semester )
                $getspsubject4 = array($specialsubject4); // Findings  ( 3rd Semester) 
                $getspsubject5 = array(); // Hours of integrated study (2nd Semester)
                $getspsubject6 = array(); // Foreign Language Activities  ( 3rd Semester) 
        }
        

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
       
      
        .table td,
        .table th {
        padding: 2px;
       
        margin-bottom: 1px;
        color: black;
        text-align: center; border-collapse: collapse;
        }
        
        .table-bordered td,
        .table-bordered th {
        text-align: center;
        font-size:11px;
        border-collapse: collapse;
       
        }
        
        
        table td {
        overflow: hidden;
        border: 1px solid #000;
        text-align: center;
        border-collapse: collapse;
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
        $output .= '<table class="table" width="100%">
        <tr>
            <td colspan="10"> <p>クアラルンプール日本人学校　小学部</p> </td> 
        </tr>
        <tr>
            <td >
                <p>'.$grade['data']['name'].'</p>
            </td>
            <td>
                <p> 学期</p>
            </td>
            <td>
                <p>通知表</p>
            </td>
            <td style=" border: 1px solid black;">組 : '.$section['data']['name'].'</td>
            <td style=" border: 1px solid black;">番 : '.$sno.'</td>
       
            <td colspan="2" style=" border: 1px solid black;vertical-align: top;border-right-style: hidden;">氏名</td>
            <td colspan="3"style=" border: 1px solid black;vertical-align: inherit;">'.$stu['name'].'</td>
        </tr>
        <tr style="height:60px;">
        <td colspan="5">
        <table class="table table-bordered table-responsive" style="width:100%">
            <thead class="colspanHead">
                <tr>
                    <td  colspan="2"style="text-align:center; border: 1px solid black;border-right-style: hidden;vertical-align: middle;">
                    学 習 の 記 録</td>
                    <td colspan="'.count($getacyeardates['data']['semesters']).'" style="text-align:left; border: 1px solid black;">
                            （A　よくできる）<br>
                    　　　（Ｂ　できる）<br>
                    　　　（Ｃ　がんばろう）<br></td>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>教科</td>
                            <td style="text-align:left;">観点別学習状況</td>';
                            $s=0;
                            foreach($getacyeardates['data']['semesters'] as $sem)
                            {
                               $s++;
                                $output.='<td > '.$s.' 学期</td>';
                            }
                            
                           
                            
                            $output.='</tr>
                        
                    </tbody>';
                        $p=0;

                        foreach($getprimarysubjects as $subject)
                        {   
                           $p++; //dd($subject);
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
                                'subject' => $subject,
                                'papers' => $getprimarypapers,
                                'pdf_report' => 0                                
                            ];
                           
                            $getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
                            //dd($getmarks);
                            if($p!=1)
                            {
                               //dd($getmarks);
                            }
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
                                $output.='<td rowspan="'.$n.'" style="width: 0px;">'.$subject.'</td>';
                            }
                            $output.='<td  style="text-align:left;">'.$papers['papers'].'</td>';
                            foreach($papers['marks'] as $mark)
                            {
                                
                                $mark=(isset($mark['grade'])&& $mark['grade']!=null)?$mark['grade']:'';
                                
                                $output.=' <td>'.$mark.'</td>';
                            }          
                            $output.=' </tr>';
                        if($i==$n)
                            {
                                $output.='</tbody>';
                            }
                        }
                    }                  
                    $output.=' </table>';
                    foreach($getspsubject6 as $subject)
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
                            'subject' => $subject,
                            'papers' => $description
                            
                        ];
                        $getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
                        //dd($getmarks);
                        $i=0;
                        $n=count($getmarks['data']); 
                        
                        foreach($getmarks['data'] as $papers)
                        {
                           
                           
                        $output.='<table class="table table-bordered" style="margin-top:10px;">
                        <thead class="colspanHead">
                            <tr>
                                <td colspan="5" style="text-align:center; border: 1px solid black;">
                                '.$subject.' （3学期に記載）</td>
                                
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
                            
                                $mark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                            
                                $output.=' <td colspan="5" style="height:70px;">'.$mark.'</td>';
                            }     
                        }     
                        $output.=' </tr>';
                        $output.='</tbody></table>';
                        
                        
                    }
                    
                } 

                $output.='<table class="table table-bordered table-responsive" style="margin-top:30px">
                        <thead class="colspanHead" >
                            <tr>
                                <td style="border-bottom: 1px solid black;">出欠の記録</td>
                                <td style="border-bottom: 1px solid black;">授業 日数</td>
                                <td style="border-bottom: 1px solid black;">出席停止 忌引き等</td>
                                <td style="border-bottom: 1px solid black;">出席しなければならない日数</td>
                                <td style="border-bottom: 1px solid black;">欠席日数</td>
                                <td style="border-bottom: 1px solid black;">出席日数</td>
                                <td style="border-bottom: 1px solid black;">遅刻</td>
                                <td style="border-bottom: 1px solid black;">早退</td>
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
                           
                            $attarray=array('','1月',' 2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月');
                            $getattendance = Helper::PostMethod(config('constants.api.getsem_studentattendance'), $attdata);
                                //dd($getattendance);
                            $at_tot1=0; $at_tot2=0; $at_tot3=0; $at_tot4=0; $at_tot5=0; $at_tot6=0;$at_tot7=0;
                            foreach($getattendance['data'] as $att)
                            {  
                                $at_tot1+=$att['no_schooldays'];
                                $at_tot2+=$att['suspension'];
                                $at_tot3+=$att['totalcoming'];
                                $at_tot4+=$att['totabs'];
                                $at_tot5+=$att['totpres'];
                                $at_tot6+=$att['totlate'];
                                $at_tot7+=$att['totexc'];
                                $output.='<tr>
                                <td>'.$attarray[intval($att['month'])].'</td>
                                <td>'.$att['no_schooldays'].'</td>
                                <td>'.$att['suspension'].'</td>
                                <td>'.$att['totalcoming'].'</td>
                                <td>'.$att['totabs'].'</td>
                                <td>'.$att['totpres'].'</td>
                                <td>'.$att['totlate'].'</td>
                                <td>'.$att['totexc'].'</td>
                            </tr>';
                            }
                            $output.='<tr>
                            <td> 合計</td>
                            <td>'.$at_tot1.'</td>
                            <td>'.$at_tot2.'</td>
                            <td>'.$at_tot3.'</td>
                            <td>'.$at_tot4.'</td>
                            <td>'.$at_tot5.'</td>
                            <td>'.$at_tot6.'</td>
                            <td>'.$at_tot7.'</td>
                        </tr>';
                           
                            
                        $output.='</tbody>
                        
                        
                        
                    </table>
                    </td>
                    <td colspan="5">
                    <table class="table table-bordered" style="width:100%;">
                        ';
                        foreach($getspsubject1 as $subject)
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
                                'subject' => $subject,   
                                'papers' => $getspecialpapers
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
                            //dd($getmarks);
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
                                        '.$subject.'</td>
                                        <td colspan="1" style="text-align:center; border: 1px solid black;">
                                        （3学期に記載）<br>

                                        （○すぐれている）</td>
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
                                            
                                            
                                            $mark=(isset($mark['grade_name'])&& $mark['grade_name']!=null)?$mark['grade_name']:'';
                                            
                                        }
                                        
                            
                            }  
                          //dd($mark);
                            $fmark=($mark=="Excellent")?'<b>O</b>':'';
                            
                            $output.=' <tr>
                                    <td colspan="4" style="text-align:left;">'.$papers['papers'].'</td>
                                    <td colspan="1">'.$fmark.'</td>
                                </tr>';
                        
                        }
                        $output.=' </tbody>';
                    } 
                    
                    $output.=' </table>';
                    foreach($getspsubject2 as $subject)
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
                            'subject' => $subject,
                            'papers' => $description
                            
                        ];
                        $getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
                        //dd($getmarks);
                        $i=0;
                        $n=count($getmarks['data']); 
                        
                        foreach($getmarks['data'] as $papers)
                        {
                           
                           
                        $output.='<table class="table table-bordered" style="margin-top:10px;width:100%">
                        <thead class="colspanHead">
                            <tr>
                                <td colspan="5" style="text-align:center; border: 1px solid black;">
                                '.$subject.' （3学期に記載）</td>
                                
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
                           
                                $mark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                            
                                $output.=' <td colspan="5" style="height:70px;">'.$mark.'</td>';
                            }     
                        }     
                        $output.=' </tr>';
                        $output.='</tbody></table>';
                         
                        
                    }
                   
                } 
                    foreach($getspsubject3 as $subject)
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
                                'subject' => $subject,
                                'papers' => $description
                                
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
                            //dd($getmarks);
                            $i=0;
                            $n=count($getmarks['data']); 
                            
                            foreach($getmarks['data'] as $papers)
                            {
                               
                               
                            $output.='<table class="table table-bordered" style="margin-top:10px;width:100%;">
                            <thead class="colspanHead">
                                <tr>
                                    <td colspan="5" style="text-align:center; border: 1px solid black;">
                                    '.$subject.' (毎学期記載)</td>
                                    
                                </tr>
                            </thead>
                            <tbody><tr> <td colspan="5" style="height:70px;">';
                           
                            foreach($papers['marks'] as $mark)
                            {
                                $mark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                              
                                $output.=''.$mark.'<br>';
                            }          
                            $output.=' </td></tr>';
                            $output.='</tbody>
                            </table>';
                             
                            
                        }
                       
                    } 
                    foreach($getspsubject5 as $subject)
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
                            'subject' => $subject,
                            'papers' => $description
                            
                        ];
                        $getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
                        //dd($getmarks);
                        $i=0;
                        $n=count($getmarks['data']); 
                        
                        foreach($getmarks['data'] as $papers)
                        {
                           
                           
                        $output.='<table class="table table-bordered" style="margin-top:10px;width:100%;">
                        <thead class="colspanHead">
                            <tr>
                                <td colspan="5" style="text-align:center; border: 1px solid black;">
                                '.$subject.' （(2学期に記載)</td>
                                
                            </tr>
                        </thead>
                        <tbody><tr>';
                        $nsem=count($papers['marks']);
                        $s=0;
                        foreach($papers['marks'] as $mark)
                        {
                            $s++;
                            if($s==2)
                            {
                           
                                $mark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                            
                                $output.=' <td colspan="5" style="height:70px;">'.$mark.'</td>';
                            }     
                        }     
                        $output.=' </tr>';
                        $output.='</tbody></table>';
                         
                        
                    }
                   
                } 
                    foreach($getspsubject4 as $subject)
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
                            'subject' => $subject,
                            'papers' => $description
                            
                        ];
                        $getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
                        //dd($getmarks);
                        $i=0;
                        $n=count($getmarks['data']); 
                        
                        foreach($getmarks['data'] as $papers)
                        {
                           
                           
                        $output.='<table class="table table-bordered" style="margin-top:10px;width:100%;">
                        <thead class="colspanHead">
                            <tr>
                                <td colspan="5" style="text-align:center; border: 1px solid black;">
                                '.$subject.' （3学期に記載）</td>
                                
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
                           
                                $mark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                            
                                $output.=' <td colspan="5" style="height:70px;">'.$mark.'</td>';
                            }     
                        }     
                        $output.=' </tr>';
                        $output.='</tbody></table>';
                         
                        
                    }
                   
                } 
                $output .= '<p style="text-align:left;font-size:9px;">※1，2学期の内容は、三者懇談でお伝えさせていただきます。</p>
                                
                            <table class="table table-bordered" style="margin-top:12px;width:100%;">
                                <thead class="colspanHead">
                                    
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2" style="text-align:left;height:40px;">校長<br><br><br><br>'.$getteacherdata['data']['principal'].'</td>
                                        
                                    
                                        <td colspan="3" style="text-align:left;height:40px;">クラスの先生<br><br><br><br>'.$getteacherdata['data']['teacher'].'</td>
                                        
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
        $language="国語";
        $socity="社会";
        $math="数学";
        $science="理科";
        $english="英語";
        $music="音楽";
        $art="美術";
        $sport="保体";
        $engineer="技家";
        
        $getstudents = Helper::PostMethod(config('constants.api.exam_studentslist'), $data);
        
        $getmainsubjects =array($language,$socity,$math,$science,$english);        
        $getnonmainsubjects =array($music,$art,$sport,$engineer);  
        $footer_text = session()->get('footer_text');
        $personal_score="個人得点"; //   individual score

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
        .table td,
        .table th {
        padding: 2px;
        }
        
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
            $output .= '<table class="table" width="100%">			
            <tr>
				<td colspan="5"> <p>クアラルンプール日本人学校　小学部</p> 
				<p> 個人結果表 </p></td> 
			</tr>
            <tr>
                <td >
					<p>'.$grade['data']['name'].' </p>
				</td>
				<td>
					<p>'.$request->semester_id.' 学期</p>
				</td>
				<td>
					<p><p>'.$term['data']['name'].'</p> </p>
				</td>
				<td style=" border: 1px solid black;">クラス : '.$section['data']['name'].'</td>
				<td style=" border: 1px solid black;">番 : '.$sno.'</td>
			</tr>
           
			<tr style="height:60px;">
				<td colspan="2" style=" border: 1px solid black;">ロール番号 : '.$stu['roll'].'</td>
				<td colspan="3"style=" border: 1px solid black;vertical-align: inherit;">名前 :'.$stu['name'].'</td>
			</tr>
			<tr> 
				<td colspan="5" >
                <table class="table" width="100%">
                <thead>                
                    <tr>
                        <td></td>';
                        $main=0;$opt=0;

                       foreach($getmainsubjects as $mainsubject)
                       {
                        $main++;
                       $output.=' <td>'.$mainsubject.'</td>';
                       }
                       foreach($getnonmainsubjects as $optsubject)
                       {
                        $opt++;
                       $output.=' <td>'.$optsubject.'</td>';
                       }
                        
                       $output.=' <td>5教科合計</td>
                        <td>9教科合計</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>個人得点</td>';
                        $i=0; $totalmain=0;$totalopt=0;
                        foreach($getmainsubjects as $subject)
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
                            'subject' => $subject,
                            'paper' => $personal_score,
                            'academic_session_id' => $request->academic_year
                            
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.stuexam_ppmarklist'), $studata);
                           
                            $mark=(isset($getmarks['data']['score']) && $getmarks['data']['score']!=null)?$getmarks['data']['score']:'';
                            
                            $output.='<td colspan="1">'.$mark.'</td>';
                            $mark=($mark!='')?$mark:0;
                            $totalmain+=$mark;
                        }
                        foreach($getnonmainsubjects as $subject)
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
                            'subject' => $subject,
                            'paper' => $personal_score,
                            'academic_session_id' => $request->academic_year
                            
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.stuexam_ppmarklist'), $studata);
                            
                            
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
                        <td>学年平均</td>';
                        $ma=0; $totalavgmain=0;$totalavgopt=0;
                        foreach($getmainsubjects as $subject)
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
                            'subject' => $subject,
                            'paper' => $personal_score,
                            'academic_session_id' => $request->academic_year
                            
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.stuexam_ppavgmarklist'), $studata);
                            
                            $mark=(isset($getmarks['data']['avg']) && $getmarks['data']['avg']!=null)?$getmarks['data']['avg']:'';
                            
                            $output.='<td colspan="1">'.$mark.'</td>';
                            $mark=($mark!='')?$mark:0;
                            $totalavgmain+=$mark;

                        }
                        $op=0;
                        foreach($getnonmainsubjects as $subject)
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
                            'subject' => $subject,
                            'paper' => $personal_score,
                            'academic_session_id' => $request->academic_year
                            
                            ];
                            $getmarks = Helper::PostMethod(config('constants.api.stuexam_ppavgmarklist'), $studata);
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
            <p>学習の振り返り</p>
            <table class="table" width="100%">
                <thead>
                    <tr style="height:60px;">
                        <td>できたこと・よかったこと </td>
                        <td>できなかったこと・反省，今後の学習に向けて</td>
                        <td>保護者の方のコメント</td>
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
			$output .='<main><p style=" text-align:center">小　学　校　児　童　指　導　要　録</p>
			<p class="float-left">様式１（学籍に関する記録）</p>
			<table class="table" width="100%">
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
			<td  colspan="2" style="text-align:center;width:50px;border: 1px solid black;">区分</td>
			<td colspan="1" class="diagonalCross2" style="width:50px;border: 1px solid black;border-right:hidden; border-left:hidden;"></td>
			<td  colspan="1" style="text-align:center;border: 1px solid black;">学年</td>
			';
			$getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
			//dd('$getgrade');
			foreach($getgrade['data'] as $grade)
			{
				
				$output.=' <td style=" border: 1px solid black;">'.$grade['name_numeric'].'</td>';
			}
			
			$output.='</tr>
			
			</thead>
			<tbody>
			<tr>
			<td colspan="4">学●   ●級</td>';
			foreach($getclasssec['data'] as $sec)
			{
				
				$output.='<td> '.$sec['section'].'</td>';
			}
			$output.='</tr>
			<tr>
			<td colspan="4">整 理 番 号</td>
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
			<td colspan="15" style="text-align:center; border: 1px solid black;">学　　　　籍　　　　の　　　　記　　　　録</td>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td rowspan="2">児童</td>
			<td>ふりがな  氏名</td>
			<td colspan="3">'.$student['first_name'].' '.$student['last_name'].'<br>
			
			'.$student['birthday'].'<br></td>
			<td colspan="">性 別</td>
			<td colspan="">'.$student['gender'].'</td>
			<td colspan="3">入学前の経歴</td>
			<td colspan="5">'.$school_name.'</td>
			</tr>
			<tr>
			<td>現住所</td>
			<td colspan="5">'.$student['current_address'].'</td>
			<td colspan="3">入学・編入学等</td>
			<td colspan="5"></td>
			</tr>
			<tr>
			<td rowspan="3">保護者</td>
			<td>ふりがな 氏名</td>
			<td colspan="5">'.$parent['first_name'].' '.$parent['last_name'].'</td>
			<td colspan="3">退　学　等</td>
			<td colspan="5"></td>
			</tr>
			
			<tr style="height:70px">
			<td rowspan="2">現住所</td>
			<td rowspan="2" colspan="5">'.$parent['address'].','.$parent['address_2'].','.$parent['city'].','.$parent['state'].','.$parent['post_code'].','.$parent['country'].'</td>
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
			$output.='<td colspan="7">在マレーシア日本国大使館附属・クアラルンプール日本人会日本人学校<br>
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
			foreach($getclasssec['data'] as $ac)
			{
				
				$output.=' <td style=" border: 1px solid black;">'.$ac['academic_year'].'</td>';
			}
			
			$output.='
			
			</tr>
			<tr>
			<td>学年</td>';
			foreach($getgrade['data'] as $grade)
			{
				
				$output.=' <td style=" border: 1px solid black;">'.$grade['name_numeric'].'</td>';
			}
			
			$output.='
			</tr>
			<tr style="height:80px">
			<td>校長氏名印</td>';
			foreach($getclasssec['data'] as $princ)
			{
				$output.=' <td style=" border: 1px solid black;">'.$princ['principal'].'</td>';
			}
			
			$output.='
			
			</tr>
			<tr style="height:80px">
			<td>学級担任者
            氏名印</td>';
			foreach($getclasssec['data'] as $teach)
			{
				$output.=' <td style=" border: 1px solid black;">'.$teach['teacher'].'</td>';
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
			
            $getclasssec= Helper::PostMethod(config('constants.api.studentclasssection'), $data);
			
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
			$output .='<p class=" float-left">様式２（指導に関する記録）</p>
			
			
			
			<table class="table table-bordered" style="margin-bottom: 15px;">
			<thead>
			<tr>
			<td style=" border: 1px solid black;">生 徒 氏 名</td>
			<td style=" border: 1px solid black;">学 校 名</td>
			<td style=" border: 1px solid black;">区分 \ 学年</td>';
			$getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
			//dd($getgrade);
			$totgrade=0;
			foreach($getgrade['data'] as $grade)
			{
				$totgrade++;
				//dd($grade);
				$output.=' <td style=" border: 1px solid black;">'.$grade['name_numeric'].'</td>';
			}
			
			$output.='
			</tr>
			
			</thead>
			<tbody>
			<tr>
			<td rowspan="2">'.$student['first_name'].' '.$student['last_name'].'</td>';
			$bdata = [
			'id' => session()->get('branch_id'),
			];
			//$getbranch = Helper::PostMethod(config('constants.api.branch_details'), $bdata);
			//dd($getbranch);
			$output.='
			<td rowspan="2">在マレーシア日本国大使館附属<br>
            クアラルンプール日本人会日本人学校</td>
			<td style="height:60px;">学 級</td>';
			foreach($getclasssec['data'] as $sec)
			{
				
				$output.='<td> '.$sec['section'].'</td>';
			}
			$output.='</tr>
			
			<tr>
			<td style="height:60px;">整理番号</td>';
			foreach($getclasssec['data'] as $sec)
			{
				
				$output.='<td> '.$sec['studentPlace'].'</td>';
			}
			$output.='
			</tr>
			</tbody>
			</table>
			<table class="table" width="100%">
           
			<tr>
			<td style="width:50%">
			
			
			
			<table class="table table-bordered">
			<thead class="colspanHead">
			<tr>
			<td colspan="'.($totgrade+4).'" style="text-align:center; border: 1px solid black;">
			各　教　科　の　学　習　の　記　録</td>
			
			</tr>
			</thead>
			<tbody>
			<tr>
			<td colspan="1">教科</td>
			<td colspan="1">観 点 </td>
			<td colspan="1" class="diagonalCross2"></td>
			<td colspan="1">学 年</td>';
			foreach($getgrade['data'] as $grade)
			{
				//dd($grade);
				$output.=' <td style=" border: 1px solid black;">'.$grade['name_numeric'].'</td>';
			}
			
			$output.='
			</tr>';
            $data = [
                'branch_id' => session()->get('branch_id'),
                'department_id' => $student['department_id'],
                'pdf_report' => 0 // All Primary Subjects
                
            ];
            
            $language="国語";
            $math='算数';
            $life='生活';
            $music='音楽';
            $art='図工';
            $sport='体育';
            $science="理科";
            $socity="社会";
            $homeeconomics="家庭科";
            $foreignlanguage="外国語";
            $english="英語";
            $tech_homeeconomics="技術・家庭科";
    
    
            $primarypaper1="知識・技能"; //Knowledge & Skills
            $primarypaper2="思考・判断・表現"; //Thinking, Judgment, and Expression
            $primarypaper3="主体的に学習に取り組む態度"; //Attitude to proactive learning
            $primarypaper4 ="評定"; // Rate / Rating
           
            $specialsubject1="特別の教科 道徳"; // Special Subject: Morality                     
            $specialsubject2="外 国 語 活 動"; // Foreign Language Activities
            $specialsubject3="総合"; // Comprehensive study time notes
            $specialsubject4="特 別 活 動 等 の 記 録"; // Records of special activities, etc
            $sp_paper1="学習活動"; // Learning and Activities
            $sp_paper2="観点";  //Perspectives
            $sp_paper3="評価";   //Rate  
            $sp_paper4="学級活動";   //Classroom Activities  
            $sp_paper5="生徒会活動";   //Student Council Activities  
            $sp_paper6="学校行事";   //School Event  
            $sp_paper7="児童会活動";   //Children's Association Activities    
            $sp_paper8="クラブ活動";   //Club Activities
            $sp_paper9="学習状況及び道徳性に係る成長の様子"; //Progress in learning and morality
                    
            if($student['department_id']==1) // Primary 
            {
                
                    $getprimarysubjects = array($language,$socity,$math,$science,$life,$music,$art,$homeeconomics,$sport,$foreignlanguage);
                    $getprimarypapers = array($primarypaper1,$primarypaper2,$primarypaper3,$primarypaper4);
                    $getspsubject1 = array($specialsubject1); // Special Subject: Morality ( 3rd Semester)  
                    $getspsubject2 = array($specialsubject2); // Foreign Language Activities ( 3rd Semester)              
                    $getspsubject3 = array($specialsubject3); // Comprehensive study time notes (3rd Semester )
                    $getspsubject4 = array($specialsubject4); // Findings  ( 3rd Semester)  
                    $specialsubject1papers=array(""); // Progress in learning and morality
                    $specialsubject2papers=array($primarypaper1,$primarypaper2,$primarypaper3); 
                    $specialsubject3papers=array($sp_paper1,$sp_paper2,$sp_paper3); 
                    $specialsubject4papers=array($sp_paper4,$sp_paper7,$sp_paper8,$sp_paper6);                   

            }
            elseif($student['department_id']==2) // Secondary 
            {
                $getprimarysubjects = array($language,$socity,$math,$science,$music,$art,$sport,$homeeconomics,$english);
                $getprimarypapers = array($primarypaper1,$primarypaper2,$primarypaper3,$primarypaper4);
                $getspsubject1 = array($specialsubject1); // Special Subject: Morality ( 3rd Semester)  
                $getspsubject2 = array(); // Foreign Language Activities ( 3rd Semester)              
                $getspsubject3 = array($specialsubject3); // Comprehensive study time notes (3rd Semester )
                $getspsubject4 = array($specialsubject4); // Findings  ( 3rd Semester)  
                $specialsubject1papers=array($sp_paper9); // Progress in learning and morality
                $specialsubject2papers=array(); 
                $specialsubject3papers=array($sp_paper1,$sp_paper2,$sp_paper3); 
                $specialsubject4papers=array($sp_paper4,$sp_paper5,$sp_paper6);
            }
			foreach($getprimarysubjects as $subject)
			{ 
                
                $n=count($getprimarypapers); 
                $i=0;
                foreach($getprimarypapers as $papers)
			    { 
                    $i++;                         
                    
                    $output.=' <tr>';
                    if($i==1)
                    {
                        $output.='<td rowspan="'.$n.'" style="width: 0px;">'.$subject.'</td>';
                    }
                    $output.='<td  style="text-align:left;" colspan="3">'.$papers.'</td>';

                    foreach($getclasssec['data'] as $sec)
                    {				
                        if($sec['class_id']=='')
                        {
                            $fmark='';
                        }
                        else
                        {   $pdata = [
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
                        
                        $mark=$getmarks['data'];
                        $fmark='';
                        
                            $fmark=(isset($mark['grade'])&& $mark['grade']!=null)?$mark['grade']:'';
                          
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
            
            
			foreach($getspsubject1 as $subject)
			{ 
               
                $n=count($specialsubject1papers); 
                $output.='<table class="table table-bordered specialtable">
			<thead class="colspanHead">
			<tr>
			
			<td colspan="'.($n+1).'" style="text-align:center; border: 1px solid black;">
			'.$subject.'
			</td>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td colspan="1">'.__('messages.grade').'</td>';
            foreach($specialsubject1papers as $papers)
			    {
                    $output.='<td colspan="1">'.$papers.'</td>';
                }
                $output.='</tr>';
			
			
                foreach($getclasssec['data'] as $sec)
                {
				$output.='<tr >
				<td style="height:40px;">'.$sec['class_numeric'].'</td>';
              
                    foreach($specialsubject1papers as $papers)
                    {
                        if($sec['class_id']=='')
                        {
                            $output.='<td  colspan="1"  ></td>';
                        }
                        else{
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
                    
                        $mark=$getmarks['data'];
                        $fmark='';
                        if(isset($mark['score_type']) && $mark['score_type']=='Points')
                        {
                            $fmark=(isset($mark['grade_name'])&& $mark['grade_name']!=null)?$mark['grade_name']:'';
                        }
                        elseif(isset($mark['score_type']) && $mark['score_type']=='Freetext')
                        {
                            $fmark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                        
                        }
                        elseif(isset($mark['score_type']) && $mark['score_type']=='Grade')
                        {
                            $fmark=(isset($mark['grade'])&& $mark['grade']!=null)?$mark['grade']:'';
                        }
                        else
                        {
                            $fmark=(isset($mark['score'])&& $mark['score']!=null)?$mark['score']:'';
                        }  
                        
                        
                        $output.='<td  colspan="1"  >'.$fmark.'</td>';
                    }
                 }
				$output.='</tr>';
				
			}
			$output.='
			</tbody>
			</table>';
        }
        if($student['department_id']==1)
        {
        foreach($getspsubject2 as $subject)
			{ 
               
                $n=count($specialsubject2papers); 
                $output.='<table class="table table-bordered specialtable">
			<thead class="colspanHead">
			<tr>
			
			<td colspan="'.($n+1).'" style="text-align:center; border: 1px solid black;">
			'.$subject.'
			</td>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td colspan="1">'.__('messages.grade').'</td>';
            foreach($specialsubject2papers as $papers)
			    {
                    $output.='<td colspan="1">'.$papers.'</td>';
                }
                $output.='</tr>';
			
			
                foreach($getclasssec['data'] as $sec)
                {
                if($sec['class_numeric']==3 || $sec['class_numeric']==4 )
                {
				$output.='<tr >
				<td style="height:40px;">'.$sec['class_numeric'].'</td>';
              
                    foreach($specialsubject2papers as $papers)
                    {
                        if($sec['class_id']=='')
                        {
                         $output.='<td  colspan="1"  ></td>';
                        }
                        else{
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
                    
                        $mark=$getmarks['data'];
                        $fmark='';
                        if(isset($mark['score_type']) && $mark['score_type']=='Points')
                        {
                            $fmark=(isset($mark['grade_name'])&& $mark['grade_name']!=null)?$mark['grade_name']:'';
                        }
                        elseif(isset($mark['score_type']) && $mark['score_type']=='Freetext')
                        {
                            $fmark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                        
                        }
                        elseif(isset($mark['score_type']) && $mark['score_type']=='Grade')
                        {
                            $fmark=(isset($mark['grade'])&& $mark['grade']!=null)?$mark['grade']:'';
                        }
                        else
                        {
                            $fmark=(isset($mark['score'])&& $mark['score']!=null)?$mark['score']:'';
                        }  
                        
                        
                        $output.='<td  colspan="1"  >'.$fmark.'</td>';
                    }
                 }
				$output.='</tr>';
				
			}
        }
			$output.='
			</tbody>
			</table>';
        }
    }
        foreach($getspsubject3 as $subject)
			{ 
               
                $n=count($specialsubject3papers); 
                $output.='<table class="table table-bordered specialtable">
			<thead class="colspanHead">
			<tr>
			
			<td colspan="'.($n+1).'" style="text-align:center; border: 1px solid black;">
			'.$subject.'
			</td>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td colspan="1">'.__('messages.grade').'</td>';
            foreach($specialsubject3papers as $papers)
			    {
                    $output.='<td colspan="1">'.$papers.'</td>';
                }
                $output.='</tr>';
			
			
                foreach($getclasssec['data'] as $sec)
                {
                    if($student['department_id']==1 && ($sec['class_numeric']==3 || $sec['class_numeric']==4 || $sec['class_numeric']==5 || $sec['class_numeric']==6) )
                    {
				$output.='<tr >
				<td style="height:40px;">'.$sec['class_numeric'].'</td>';
              
                    foreach($specialsubject3papers as $papers)
                    {
                        if($sec['class_id']=='')
                        {
                         $output.='<td  colspan="1"  ></td>';
                        }
                        else{
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
                    
                        $mark=$getmarks['data'];
                        $fmark='';
                        if(isset($mark['score_type']) && $mark['score_type']=='Points')
                        {
                            $fmark=(isset($mark['grade_name'])&& $mark['grade_name']!=null)?$mark['grade_name']:'';
                        }
                        elseif(isset($mark['score_type']) && $mark['score_type']=='Freetext')
                        {
                            $fmark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                        
                        }
                        elseif(isset($mark['score_type']) && $mark['score_type']=='Grade')
                        {
                            $fmark=(isset($mark['grade'])&& $mark['grade']!=null)?$mark['grade']:'';
                        }
                        else
                        {
                            $fmark=(isset($mark['score'])&& $mark['score']!=null)?$mark['score']:'';
                        }  
                        
                        
                        $output.='<td  colspan="1"  >'.$fmark.'</td>';
                    }
                 }
				$output.='</tr>';
                    }
                    elseif($student['department_id']==2)
                    {
                        $output.='<tr >
				    <td style="height:70px;">'.$sec['class_numeric'].'</td>';
              
                    foreach($specialsubject3papers as $papers)
                    {
                        if($sec['class_id']=='')
                        {
                         $output.='<td  colspan="1"  ></td>';
                        }
                        else{
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
                    
                        $mark=$getmarks['data'];
                        $fmark='';
                        if(isset($mark['score_type']) && $mark['score_type']=='Points')
                        {
                            $fmark=(isset($mark['grade_name'])&& $mark['grade_name']!=null)?$mark['grade_name']:'';
                        }
                        elseif(isset($mark['score_type']) && $mark['score_type']=='Freetext')
                        {
                            $fmark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                        
                        }
                        elseif(isset($mark['score_type']) && $mark['score_type']=='Grade')
                        {
                            $fmark=(isset($mark['grade'])&& $mark['grade']!=null)?$mark['grade']:'';
                        }
                        else
                        {
                            $fmark=(isset($mark['score'])&& $mark['score']!=null)?$mark['score']:'';
                        }  
                        
                        
                        $output.='<td  colspan="1"  >'.$fmark.'</td>';
                    }
                 }
				$output.='</tr>';
                    }
			}
			$output.='
			</tbody>
			</table>';
        }
        foreach($getspsubject4 as $subject)
			{ 
                
                $n=count($getclasssec['data']); 
                $output.='<table class="table table-bordered specialtable">
                <thead class="colspanHead">
                <tr>
                
                <td colspan="'.($n+2).'" style="text-align:center; border: 1px solid black;">
                '.$subject.'
                </td>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td colspan="1">内　容</td>
                <td colspan="1">観　点 \ 学　年</td>';
                foreach($getclasssec['data'] as $sec)
                {
                    $output.='<td colspan="1">'.$sec['class_numeric'].'</td>';
                }
                $output.='</tr>';
			
                $p=0;
                $np=count($specialsubject4papers); 
                foreach($specialsubject4papers as $papers)
                {
                    $p++;

				$output.='<tr >
				<td style="height:60px;">'.$papers.'</td>';
                if($p==1)
                {
                    $output.='
                    <td rowspan="'.$np.'"></td>'; 
                }
               
                foreach($getclasssec['data'] as $sec)
                {
                        if($sec['class_id']=='')
                        {
                            $output.='<td  colspan="1"  ></td>';
                        }
                        else{
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
                    
                        $mark=$getmarks['data'];
                        $fmark='';
                        if(isset($mark['score_type']) && $mark['score_type']=='Points')
                        {
                            $fmark=(isset($mark['grade_name'])&& $mark['grade_name']!=null)?$mark['grade_name']:'';
                        }
                        elseif(isset($mark['score_type']) && $mark['score_type']=='Freetext')
                        {
                            $fmark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                        
                        }
                        elseif(isset($mark['score_type']) && $mark['score_type']=='Grade')
                        {
                            $fmark=(isset($mark['grade'])&& $mark['grade']!=null)?$mark['grade']:'';
                        }
                        else
                        {
                            $fmark=(isset($mark['score'])&& $mark['score']!=null)?$mark['score']:'';
                        }  
                        
                        
                        $output.='<td  colspan="1"  >'.$fmark.'</td>';
                    }
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
			$output .= '<body><table class="table" width="100%">
            <tr> 
			<td class="content-wrap aligncenter" style="margin: 0;padding: 20px;
			text-align:center">
			
			
			<table class="table table-bordered" style="margin-bottom: 15px;width:300px;">
			<thead>
			<tr>
			<td style=" border: 1px solid black;">児　童　氏　名</td>
			</tr>
			
			</thead>
			<tbody>
			<tr>
			<td>'.$student['first_name'].' '.$student['last_name'].'</td>
			</tr>
			
			</tbody>
			</table>';
		
            
            
            $getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
            $ng=count($getgrade['data']); 
            $i=0;
            $output.='<table class="table table-bordered">
			<thead class="colspanHead">
			<tr>
			<td colspan="12" style="text-align:center; border: 1px solid black;">
			行　　　　動　　　　の　　　　　記　　　録</td>
			</tr>
            </thead>
            <tr>
            <td colspan="6">
            <table class="table table-bordered">
            <tr>
			<td colspan="1" style="text-align:center;width:50px;">項 目 </td>
			<td colspan="1" class="diagonalCross2" style="width:50px;"></td>
			<td colspan="1" style="text-align:center;">学 年</td>';
			$getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
			
			foreach($getgrade['data'] as $grade)
			{
				$output.=' <td>'.$grade['name_numeric'].'</td>';
			}                                
			$output.='
			
			</tr>';
            $subject1="行動の記録"; //Record of actions
            $subject2="総合"; //comprehensive
            $subject3="出 欠 の 記 録"; //Record of attendance
            $ra_paper1="基本的な生活習慣";	//		Basic lifestyle habits							
            $ra_paper2="健康・体力の向上";	//	Improvement of health and physical fitness								
            $ra_paper3="自主・自律";	//		Self-discipline							
            $ra_paper4="責任感";		//	Responsibility							
            $ra_paper5="創意工夫";	// Creativity
            $ra_paper6="思いやり・協力";	//		Compassion and Cooperation							
            $ra_paper7="生命尊重・自然愛護";	//	Respect for life and love for nature								
            $ra_paper8="勤労・奉仕";	//		Labor & Service							
            $ra_paper9="公正・公平";		//		Fairness						
            $ra_paper10="公共心・公徳心";	//		Public Virtue							
            $getpaperlist1=array($ra_paper1,$ra_paper2,$ra_paper3,$ra_paper4,$ra_paper5);                                  
            $getpaperlist2=array($ra_paper6,$ra_paper7,$ra_paper8,$ra_paper9,$ra_paper10); 
            $description="説明"; 
            $remarks="備考"; 
			foreach($getpaperlist1 as $papers)
			    { 
                    $output.=' <tr>';
                    
                    $output.='<td  style="text-align:left;" colspan="3">'.$papers.'</td>';

                    foreach($getclasssec['data'] as $sec)
                    {				
                        
                        if($sec['class_id']=='')
                        {
                            $output.=' <td></td>';
                        }
                        else
                        {
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
                        $mark=$getmarks['data'];
                        $fmark='';
                        
                            $fmark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                        
                        
                        $output.=' <td>'.$fmark.'</td>';
                        }
                    }
                    $output.='</tr>';
                    
                }
                $output.='
                </table>
            </td>
            <td colspan="6">
            <table class="table table-bordered">
            <tr>
			<td colspan="1" style="text-align:center;width:50px;">項 目 </td>
			<td colspan="1" class="diagonalCross2" style="width:50px;"></td>
			<td colspan="1" style="text-align:center;">学 年</td>';
			$getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
			
			foreach($getgrade['data'] as $grade)
			{
				$output.=' <td>'.$grade['name_numeric'].'</td>';
			}                                
			$output.='
			
			</tr>';
			foreach($getpaperlist2 as $papers)
			    { 
                   
                    $output.=' <tr>';
                   
                    $output.='<td  style="text-align:left;" colspan="3">'.$papers.'</td>';

                    foreach($getclasssec['data'] as $sec)
                    {				
                        if($sec['class_id']=='')
                        {
                            $output.=' <td></td>'; 
                        }
                        else
                        {
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
                      
                        $mark=$getmarks['data'];
                        $fmark='';
                        
                        $fmark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                        
                        
                        $output.=' <td>'.$fmark.'</td>';
                        }
                    }
                              
                        
              
                        $output.='</tr>';
                   
                }
                $output.='
                </table>
                </td>
                
			</table>';	
				
            if($student['department_id']==2)
            {
                $cols=2;
            }
            else
            {$cols=4;

            }
                $output.='<table class="table table-bordered">
			<thead class="colspanHead">
			<tr>
			<td colspan="'.$cols.'" style="text-align:center; border: 1px solid black;">
            総　合　所　見　及　び　指　導　上　参　考　と　な　る　諸　事　項</td>
			</tr>
			</thead>
			<tbody>';
           
                 $output.='<tr>';      
                    $k=0;
                    foreach($getclasssec['data'] as $sec)
                    {				
                        $k++;
                        if($sec['class_id']=='')
                        {
                            $fmark='';
                        }
                        else
                        {
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
                        $mark=$getmarks['data'];
                        $fmark='';
                       
                            $fmark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                        
                    }
                         $output.='<td  style="height: 200px;width: 0px; padding-top: 45px;">第<br>'.$k.'<br>学<br>年</td>';
                     
                        $output.=' <td>'.$fmark.'</td>';
                        if($student['department_id']==2)
                        {
                            $output.='</tr><tr>'; 
                        }
                        elseif($k%2==0)
                        {
                            $output.='</tr><tr>';  
                        } 
                    }
                              
                        
              
                        $output.='</tr>';
                   
               
				$output.='</tbody>
			</table>';	
				
		
			
			$output.='<table class="table table-bordered">
			<thead class="colspanHead">
			<tr>
			<td colspan="18" style="text-align:center; border: 1px solid black;">
			出　　欠　　の　　記　　録</td>
			</tr>
			</thead>
			<tbody>
			<tr>
            <td colspan="1" style="width: 0px;font-size: 10px;">学年＼区分</td>
			<td colspan="1" style="width: 0px;font-size: 10px;">授業数</td>
			<td colspan="1" style="width: 0px;font-size: 10px;">出席停止・忌引き等の日数</td>
			<td colspan="1" style="width: 85px;font-size: 10px;">出席しなければならない日数</td>
			<td colspan="1" style="width: 0px;font-size: 10px;">欠席日数</td>
			<td colspan="1" style="width: 0px;font-size: 10px;">出席日数</td>
			
			<td colspan="12" style="width: 0px;font-size: 10px;">備　　　　　　考</td>
			
			</tr>';
            $data1 = [
                'branch_id' => session()->get('branch_id'),
                'department_id' => $student['department_id'],
                'pdf_report' => 10 // YOROKO FORM 2B
                
            ];
            
            foreach($getclasssec['data'] as $sec)
            {
                $totaldays='0'; $suspension='0'; $totalcomimg='0'; $totpres='0';$totabs='0';
                if($sec['class_id']=='')
                {
                    $remark='';
                }
                else
                {
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
                $mark=$getmarks['data'];
               
               
                    $remark=(isset($mark['freetext'])&& $mark['freetext']!=null)?$mark['freetext']:'';
                
             
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
            }                 
            $output.=' <tr>
            <td colspan="1" style="width: 0px;">'.$sec['class_numeric'].'</td>
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
			$output .= '<body><p style="text-align:center;">中 学 校 生 徒 指 導 要 録</p>
			<p class="float-left">様式１（学籍に関する記録)</p>
			
			
			
			<table class="table table-bordered" style="margin-bottom: 15px;width:400px;">
			<thead>
			<tr>
			<tr>
			<td class="cell-left">区分 </td>
			<td class="diagonalCross2" style="border-right:hidden; border-left:hidden;"></td>
			<td class="cell-right">学年</td>';
            $getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
            $getclasssec = Helper::PostMethod(config('constants.api.studentclasssection'), $data);
            //dd('$getgrade');
            foreach($getgrade['data'] as $grade)
            {
                
            $output.=' <td style=" border: 1px solid black;">'.$grade['name_numeric'].'</td>';
            }
            
            $output.='
			</tr>
			
			</thead>
			<tbody>
			<tr>
			<td colspan="3">学 級</td>'; foreach($getclasssec['data'] as $sec)
            {
            
            $output.='<td> '.$sec['section'].'</td>';
            }
            $output.='
			</tr>
			<tr>
			<td colspan="3">整理番号</td>'; foreach($getclasssec['data'] as $sec)
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
			<td colspan="17" style="text-align:center; border: 1px solid black;">学 籍 の 記 録</td>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td rowspan="4" colspan="1" style="width:10px">氏 名/td>
			<td colspan="2">ふりがな</td>
			<td colspan="6"></td>
			<td style="width:10px">性別</td>
			<td style="width:10px"> '.$student['gender'].'</td>
			<td colspan="2" style="border-bottom:hidden" >入学・編入学等</td>
			<td colspan="4" style="border-bottom:hidden">入学 編入学 <br> 編入前
            在学校名</td>
			</tr>
			<tr>
			<td colspan="2">氏 名</td>                                           
			<td colspan="8"> '.$student['first_name'].' '.$student['last_name'].'</td>
			<td colspan="2" ></td>
			<td colspan="4" > '.$school_name.' </td>
			</tr>
			<tr>
			<td colspan="2">生年月日</td>                                           
			<td colspan="8"> '.$student['birthday'].'</td>
			<td colspan="2" style="border-bottom:hidden" ></td>
			<td colspan="4" style="border-bottom:hidden" ></td>
			</tr>
			<tr>
			<td colspan="2">現住所</td>                                           
			<td colspan="8">'.$student['current_address'].'</td>
			
            <td colspan="2">転 入 学</td>
			<td colspan="4" >年 月 日 第 学年転入学  </td>
			</tr>
			
			
			<tr>
			<td rowspan="6" colspan="1" style="width:10px">保護者</td>
			<td colspan="2" rowspan="2" >ふりがな</td>
			<td colspan="8" rowspan="2" ></td>
            <td rowspan="6" >転学・
            退学
            等 </td>
			<td colspan="1" >転学するため学校
            を去った年月日 </td>
			<td colspan="4"></td>
			</tr>
			<tr>
			
			<td colspan="1">退学等年月日
            （除籍日)</td>
			<td colspan="4" ></td>
			
			</tr>
			<tr>
			<td colspan="2" rowspan="2" >氏 名</td>
			<td colspan="8" rowspan="2" >'.$parent['first_name'].' '.$parent['last_name'].'</td>
			<td colspan="1" >転学先学校名</td>
			<td colspan="4" ></td>
			</tr>
			
			<tr>
			
			
			<td colspan="1" >転入学年</td>
			<td colspan="4" ></td>
			
			</tr>
			<tr>
			
			<td colspan="2" style="border-bottom:hidden">現住所</td>
			<td colspan="8" style="border-bottom:hidden"> '.$parent['address'].','.$parent['address_2'].','.$parent['city'].','.$parent['state'].','.$parent['post_code'].','.$parent['country'].'</td>
			<td colspan="1" >同上所在地</td>
			<td colspan="4" ></td>
			
			</tr>
			<tr>
			<td colspan="2" ></td>
			<td colspan="8"></td>
			<td colspan="1" >事 由</td>
			<td colspan="4" ></td>
			
			</tr>
			<tr>
			<td style="border-bottom:hidden">入学前の経歴
			</td>
			<td colspan="2" style="border-bottom:hidden;border-right:hidden;"></td>
			<td colspan="8" style="border-bottom:hidden;"></td>
			<td colspan="2" >卒 業</td>
			<td colspan="4"></td>
			
			</tr>
			<tr>
			<td></td>
			<td colspan="2" style="border-right:hidden;" ></td>
			<td colspan="8"></td>
			<td colspan="2" >進 学 先
            就 職 先 等 </td>
			<td colspan="4"></td>
			
			</tr>
			</table>
			
			
			<table class="table table-bordered">
            <tr>
                <td colspan="4" style="width:90px">学 校 名
                及 び
                所 在 地
                （分校名・所在地
                等</td>';
                
                $bdata = [
                    'id' => session()->get('branch_id'),
                ];
                $getbranch = Helper::PostMethod(config('constants.api.branch_details'), $bdata);
                //dd($getbranch);
                $output.='<td colspan="7">
                在マレーシア日本国大使館附属・クアラルンプール日本人会日本人学校<br>
                Saujana Resort Seksyen U2,40150 Shah Alam,Selangor Darul Ehsan, Malaysia
                </td>
            </tr>
        </table>
        <table class="table table-bordered">
            <tr>
                <td class="diagonal" style="width:122px;border-bottom:hidden">
                    <span class="lb">年 度 </span>
                    <span class="rt"></span>
                    <div class="line"></div>
                </td>';
                foreach($getclasssec['data'] as $ac)
                    {
                        
                    $output.=' <td style=" border: 1px solid black;">'.$ac['academic_year'].'</td>';
                    }
                    
                    $output.='
            
            </tr>
            <tr>
                <td style="height:60px;">区分 学年 </td>';
                foreach($getgrade['data'] as $grade)
                    {
                        
                    $output.=' <td style=" border: 1px solid black;">'.$grade['name_numeric'].'</td>';
                    }
                    
                    $output.='
            </tr>
            <tr style="height:80px">
                <td style="height:60px;">校長氏名印</td>';
                foreach($getclasssec['data'] as $princ)
                    {
                        $output.=' <td style=" border: 1px solid black;">'.$princ['principal'].'</td>';
                    }
                    
                    $output.='
                
            </tr>
            <tr style="height:80px">
                <td style="height:60px;">学級担任者
                氏 名 印</td>';
                foreach($getclasssec['data'] as $teach)
                {
                    $output.=' <td style=" border: 1px solid black;">'.$teach['teacher'].'</td>';
                }
                
                $output.='
            </tr>
            
        </table>
			
			</tbody>
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
			$fileName = __('messages.download_form1') . $name . ".pdf";
			return $pdf->download($fileName);
			// return $pdf->stream();
			
			
		}
	public function personalinterviewdownload(Request $request)
    {
        //dd($request->id);
        $data = [
            'branch_id' => session()->get('branch_id'),
            'id' => $request->id
        ];
        $datas = [
            'department_id' => $request->department_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'academic_year' => $request->academic_year
        ];
        $reports = Helper::PostMethod(config('constants.api.singlestudent_report'), $data);
        $report= $reports['data'];
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
        }
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
            height:60px;
			}';
        $output .= '</style>';
        $output .= "</head>";
        $output .= "<body>
        <header> " .  __('messages.personal_interview_report') . "</header>
        <footer>" . $footer_text . "</footer>";
            $output .= '<div class="table-responsive">
            <table >
            <tr><td align="center">'.  __("messages.personal_interview") .'</td><td style="text-decoration: underline;text-align:center;">'.$report['home_teacher'].'</td></tr>
            <tr><td colspan="2" style="padding:25px;">'.  __("messages.personalinterview_title1") .'
           <br> '.  __("messages.personalinterview_title2") .'
            </td></tr>
        </table>		
        <table class="table table-bordered">
            <tr>
                <td style="width:20%">'.  __("messages.personalinterview_kinder") .'</td>
                <td colspan="2" style="width:40%">'.$report['name'].'</td>
                <td style="width:20%">'.  __("messages.personalinterview_date") .'</td>
                <td style="width:20%">'.date('d M Y',strtotime($report['interview_date'])).'</td>
            </tr>
            <tr>
                <td colspan="2" style="width:25%;height:200px;">'.  __("messages.personalinterview_situation") .'</td>
                <td colspan="3" style="width:75%">'.$report['question_situation'].'</td>
            </tr>
            <tr>
                <td colspan="2" style="width:25%;height:200px;">'.$report['semester_name'].'<br>'.  __("messages.personalinterview_improved") .'
                </td>
                <td colspan="3" style="width:75%">'.$report['question_improved'].'</td>
            </tr> 
            <tr>
                <td colspan="2" style="width:25%;height:200px;">'.  __("messages.personalinterview_tried") .'
                </td>
                <td colspan="3" style="width:75%">'.$report['question_tried'].'</td>
            </tr>
            <tr>
                <td colspan="2" style="width:25%;height:200px;">'.  __("messages.personalinterview_future") .'
                </td>
                <td colspan="3" style="width:75%">'.$report['question_future'].'</td>
            </tr>
            <tr>
                <td colspan="2" style="width:25%;height:200px;">'.  __("messages.personalinterview_parent") .'</td>
                <td colspan="3" style="width:75%">'.$report['question_parent'].'</td>
            </tr>
            <tr>
                <td colspan="2" style="width:25%;height:200px;">'.  __("messages.personalinterview_feedback") .'
                </td>
                <td colspan="3" style="width:75%">'.$report['question_feedback'].'</td>
            </tr>
        </table>
        </div>';
        //         $output .= '</main>
        //  </body>
        // </html>';
        $pdf = \App::make('dompdf.wrapper');
        // set size
        $customPaper = array(0, 0, 792.00, 1224.00);
        $pdf->set_paper($customPaper);
        $pdf->loadHTML($output);
        // filename
        $now = now();
        $name = strtotime($now);
        $fileName = __('messages.personal_interview') . $name . ".pdf";
        return $pdf->download($fileName);
        // return $pdf->stream();
        
    }   
    public function personalinterviewdownloadall(Request $request)
    {
       
        $data = [
            'department_id' => $request->department_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'academic_year' => $request->academic_year
        ];
        $reports = Helper::PostMethod(config('constants.api.classstudent_report'), $data);

       //dd($reports);
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
        }
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
            height:60px;
			}';
        $output .= '</style>';
        $output .= "</head>";
        $output .= "<body>
        <header> " .  __('messages.personal_interview_report') . "</header>
        <footer>" . $footer_text . "</footer>";
        foreach($reports['data'] as $report)
        {
            $output .= '<div class="table-responsive">
            <table >
            <tr><td align="center">'.  __("messages.personal_interview") .'</td><td style="text-decoration: underline;text-align:center;">'.$report['home_teacher'].'</td></tr>
            <tr><td colspan="2" style="padding:25px;">'.  __("messages.personalinterview_title1") .'
           <br> '.  __("messages.personalinterview_title2") .'
            </td></tr>
        </table>		
        <table class="table table-bordered">
            <tr>
                <td style="width:20%">'.  __("messages.personalinterview_kinder") .'</td>
                <td colspan="2" style="width:40%">'.$report['name'].'</td>
                <td style="width:20%">'.  __("messages.personalinterview_date") .'</td>
                <td style="width:20%">'.date('d M Y',strtotime($report['interview_date'])).'</td>
            </tr>
            <tr>
                <td colspan="2" style="width:25%;height:200px;">'.  __("messages.personalinterview_situation") .'</td>
                <td colspan="3" style="width:75%">'.$report['question_situation'].'</td>
            </tr>
            <tr>
                <td colspan="2" style="width:25%;height:200px;">'.$report['semester_name'].'<br>'.  __("messages.personalinterview_improved") .'
                </td>
                <td colspan="3" style="width:75%">'.$report['question_improved'].'</td>
            </tr> 
            <tr>
                <td colspan="2" style="width:25%;height:200px;">'.  __("messages.personalinterview_tried") .'
                </td>
                <td colspan="3" style="width:75%">'.$report['question_tried'].'</td>
            </tr>
            <tr>
                <td colspan="2" style="width:25%;height:200px;">'.  __("messages.personalinterview_future") .'
                </td>
                <td colspan="3" style="width:75%">'.$report['question_future'].'</td>
            </tr>
            <tr>
                <td colspan="2" style="width:25%;height:200px;">'.  __("messages.personalinterview_parent") .'</td>
                <td colspan="3" style="width:75%">'.$report['question_parent'].'</td>
            </tr>
            <tr>
                <td colspan="2" style="width:25%;height:200px;">'.  __("messages.personalinterview_feedback") .'
                </td>
                <td colspan="3" style="width:75%">'.$report['question_feedback'].'</td>
            </tr>
        </table>
        </div>
        <div style="page-break-after: always;"></div>';
        }   
        //         $output .= '</div></main>
        //  </body>
        // </html>';
        $pdf = \App::make('dompdf.wrapper');
        // set size
        $customPaper = array(0, 0, 792.00, 1224.00);
        $pdf->set_paper($customPaper);
        $pdf->loadHTML($output);
        // filename
        $now = now();
        $name = strtotime($now);
        $fileName = __('messages.personal_interview') . $name . ".pdf";
        return $pdf->download($fileName);
        // return $pdf->stream();
        
    }  
	
}
