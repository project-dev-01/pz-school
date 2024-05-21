<?php
	
	namespace App\Http\Controllers;
	use Illuminate\Http\Request;
	use App\Helpers\Helper;
	
	use DateTime;
	use DateInterval;
	use DatePeriod;
	use DateTimeZone;
	use PDF;
	
	class ExamPdfController1 extends Controller
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
			$output = '<!DOCTYPE html>
			<html lang="en">
            <head>
			<meta charset="UTF-8">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>EC_term-report_primary</title>
			<style>
			@font-face {
			font-family: ipag;
			font-style: normal;
			font-weight: normal;
			src: url("' . $fonturl . '");
			} 
			body{ font-family: ipag !important;}
			
			tr,
			td {
			font-family: "Open Sans";
			font-style: normal;
			font-size: 14px;
			letter-spacing: 0.0133em;
			}
			
			h6 {
			font-family: "Open Sans";
			font-style: normal;
			font-size: 14px;
			letter-spacing: 0.0133em;
			}
			
			h1 {
			font-family: "Open Sans";
			font-style: normal;
			line-height: 60px;
			letter-spacing: 0.0133em;
			}
			
			h4 {
			font-family: "Open Sans";
			font-style: normal;
			font-size: 24px;
			letter-spacing: 0.0133em;
			}
			
			h5 {
			font-family: "Open Sans";
			font-style: normal;
			font-size: 15px;
			letter-spacing: 0.0133em;
			}
			</style>
            </head>
            
            <body>';
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
				$output .= '<div class="content" style="box-sizing: border-box; max-width: 850px; display: block; margin: 0 auto; padding: 10px;border-radius: 7px; margin-top: 20px;background-color: #fff; border: 1px solid #dddddd; font-weight: bold;
                font-family: Open Sans;font-size: 15px;">
				<table class="main" width="100%" style="border-collapse: collapse;">
				<tr>
				<td class="content-wrap aligncenter" colspan="3" style="margin: 0; padding: 10px; text-align: center;">
				<img src="https://api.suzen.school/common-asset/images/logo_jskl.jpeg" alt="logo" height="60px"
				style="margin-left: 15px;">
				
				</td>
				</tr> 
				<tr>
				<td class="content-wrap aligncenter" colspan="3" style="margin: 0; padding: 10px; text-align: center;">
				
				<h1 style="line-height: 0px;text-align: center;">Japanese School of Kuala Lumpur</h1>
				
				</td>
				</tr> 
				<tr>
				<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; width:30%; text-align: center;">
				
				<h4 style="margin: 0;font-weight: bold;">'.$acy.' </h4>
				</td>       
				<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; width:30%; text-align: center;">
				<h4 style="margin: 0;font-weight: bold;">English Communication</h4>
				</td>       
				<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; width:30%; text-align: center;">
				<h4 style="margin: 0;font-weight: bold;">'.$term['data']['name'].' Report</h4>
				</td>
				</tr> 
				<tr>
				<td class="content-wrap aligncenter" style="margin: 0; padding-left: 20px; text-align: left;">                   <h5 style="margin: 0;">Number</h5>
				<h4 style="margin: 0;">'.$stu['attendance_no'].'</h4>
				</td>       
				<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; text-align: center;">
				<h5 style="margin: 0;">EC-Class</h5>
				<h4 style="margin: 0;">Balsam</h4>
				</td>       
				<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; text-align: center;">
				<h5 style="margin: 0;">Level</h5>
				<h4 style="margin: 0;">Advanced</h4>
				</td>
				</tr> 
				<tr>
				<td class="content-wrap aligncenter" style="margin: 0; padding-left: 20px;padding-top:10px; padding-bottom:-10px; text-align: left;">
				
				<h3 style="margin: 0;">Student Name</h3>
				</td>       
				<td class="content-wrap aligncenter" style="margin: 0;padding-top:10px; padding-bottom:-10px;text-align: center;">
				<h3 style="margin: 0;">'.strtoupper($stu['name']).'</h3>
				</td>       
				<td class="content-wrap aligncenter" style="margin: 0; padding-top:10px; padding-bottom:-10px;text-align: center;">
				</td>
				</tr> 
				<tr>
				<td class="content-wrap aligncenter" colspan="3" style="margin: 0; padding-left: 20px;padding-right: 20px;padding-top:-10px; text-align: center;">
				<table style="border-collapse: collapse; width: 100%;">
				<tbody>';
				if($request->department_id==1)
				{
					// Subject Name => EC or English Communication
					
					//Listening
					$l1="L-1 Understands and follows instructions in class activities";	
					$l2="L-2 Understands simple transactions in conversations and activities"; 
					$l3="L-3 Understands and recognises main points in simple speech";
					//Reading
					$r1="R-1 Reads simple words and follows instructions on posters and worksheets";	
					$r2="R-2 Reads simple sentences in the text book"; 	
					//Speaking
					$s1="S-1 Tries to have a conversation form using simple phrases and sentences"; 	
					$s2="S-2 Asks and answers simple questions on familiar topics"; 	
					$s3="S-3 Uses clear and loud speech to communicate";	
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
					$teachername='';$teachercmd='';
					$i=0;
					foreach($heading as $heads)
					{
						$output.='
						<tr>
						<td colspan="2"
						style="text-align:center; border: 2px solid black;background-color:#40403a57;font-weight: bold;font-size:18px;">
						'.$heads.'</td>
						</tr>';
						
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
							<td style="border: 2px solid black; text-align: left;font-weight: normal;">'.$papername.'
							</td>
							<td style="border: 2px solid black; text-align: center;font-weight: normal;">'.$mark.'</td>
							</tr>';
							
						}
						
					}
					$output.=' </tbody>';
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
					$teachername='';$teachercmd='';
					$i=0;
					foreach($heading as $heads)
					{
						$output.='
						<tr>
						<td colspan="2"
						style="text-align:center; border: 2px solid black;background-color:#40403a57;font-weight: bold;font-size:18px;">
						'.$heads.'</td>
						</tr>';
						
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
							<td style="border: 2px solid black; text-align: left;font-weight: normal;">'.$papername.'
							</td>
							<td style="border: 2px solid black; text-align: center;font-weight: normal;">'.$mark.'</td>
							</tr>';
							
						}
						
					}
					$output.=' </tbody>';
				}                 
				
				$output.='</table>
				
				</td>
				</tr>
				<tr>
				<td class="content-wrap aligncenter" style="margin: 0; text-align: center;">
				
				
				</td>
				
				<td class="content-wrap aligncenter"  colspan="2" style="margin: 0; padding-right: 20px; text-align: center;">
				
				<div style="text-align: right;">
				<h6 style="margin: 0;font-weight: normal;">Results: Improving, Satisfactory, Excellent</h6>
				</div>
				
				</td>
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
				$teachername='-';
				if(!empty($teachernameapi['data']))
				{
					$teachername=$teachernameapi['data']['first_name'].' '.$teachernameapi['data']['last_name'];
				}
				$output.='<tr>
				<td class="content-wrap aligncenter" colspan="3" style="margin: 0; padding-left: 20px;padding-right: 20px;padding-top:-10px; text-align: center;">
				
				<!-- Teacher`s Comments -->
				<table style="margin-top: 30px; border-collapse: collapse; width: 100%;">
				<tbody>
				<tr>
				<td colspan="2"
				style="text-align: center; border: 2px solid black; background-color: #40403a57; color: black;font-weight: bold;font-size:18px;">
				Teacher`s Comments</td>
				</tr>
				<tr>
				<td colspan="2"
				style="text-align: left; border: 2px solid black; height: 100px; color: black; padding: 10px;font-weight: normal;">
				'.$teachercmd.'
				</td>
				</tr>
				</tbody>
				</table>
				
				
				</td>
				</tr>
				<tr>
				<td class="content-wrap aligncenter"  style="margin: 0; padding: 10px; text-align: center;">
				</td>
				<td class="content-wrap aligncenter"  style="margin: 0; padding: 10px; text-align: center;">
				<h5 style="margin: 0;font-weight: bold;">English Teacher`s Name</h5>
				</td>
				<td class="content-wrap aligncenter"  style="margin: 0; padding: 10px; text-align: center;">
				<h5 style="margin: 0;font-weight: normal;">'.$teachername.'</h5>
				
				</td>
				</tr>
				</table>
                </div>
                <div style="page-break-after: always;"></div>';
			}
			
			$output .= '</body>
            
			</html>';
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
			if($request->department_id==1) // Primary 
			{
				if($stuclass==1 || $stuclass==2)
				{
					$output = '<!DOCTYPE html>
					<html lang="en">
					
					<head>
					<meta charset="utf-8" />
					<title>Primary_grade1_2</title>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					<meta name="description" content="Paxsuzen School is a premier educational institution that offers quality education to students of all ages. Our curriculum is designed to prepare future leaders for success in the global marketplace.">
					<meta name="keywords" content="Paxsuzen School, education, future leaders, curriculum">
					<meta content="Paxsuzen" name="author" />
					<style>
					@font-face {
					font-family: Open Sans ipag;
					font-style: normal;
					font-weight: 300;
					src: url("' . $fonturl . '");
					}
					
					body {
                    font-family: "ipag", "Open Sans", !important;
					}
					
					table {
                    border-collapse: collapse;
                    width: 100%;
                    line-height: 20px;
                    letter-spacing: 0.0133em;
					}
					
					td,
					th {
                    border: 1px solid black;
                    text-align: center;
                    line-height: 20px;
                    letter-spacing: 0.0133em;
					}
					
					.column1 {
                    float: left;
                    width: 30%;
                    padding: 10px;
                    height: 80px;
					}
					
					.row:after {
                    content: "";
                    display: table;
                    clear: both;
					}
					
					.container {
                    display: flex;
                    justify-content: center;
					}
					
					.column2 {
                    float: left;
                    width: 45%;
                    padding: 10px;
					}
					
					.content {
                    box-sizing: border-box;
                    max-width: 850px;
                    display: block;
                    margin: 0 auto;
                    padding: 20px;
                    border-radius: 7px;
                    margin-top: 20px;
                    background-color: #fff;
                    border: 1px solid #dddddd;
                    font-size: 15px;
                    "
					
					}
					</style>
					</head>
					
					<body>
					<div class="content">
					<div class="row">
                    <div class="column">
					<p>クアラルンプール日本人学校　小学</p>
					<p style="margin-left: 92px;margin-top:-13px;">部</p>
                    </div>
					</div>
					
					<div class="row">
                    <div class="column1" style="width:10%;">
					<div style="margin-top:20px;">
					<p style="margin: 0;">1 年生</p>
					</div>
					
                    </div>
                    <div class="column1" style="width:10%;">
					
					<div style="margin-top:20px;">
					<p style="margin: 0;">1 学期</p>
					</div>
					
                    </div>
                    <div class="column1" style="width:5%;">
					<div style="margin-top:20px;">
					<p style="margin: 0;">通知表</p>
					</div>
                    </div>
                    <div class="column1" style="width:18%;">
					<table>
					<thead>
					</thead>
					<tbody>
					<tr>
					<td style="text-align: right; vertical-align: bottom; height: 60px;color: #3A4265;">組</td>
					<td style="text-align: right; vertical-align: bottom; height: 60px;color: #3A4265;">番</td>
					</tr>
					</tbody>
					</table>
                    </div>
                    <div class="column1" style="width:1%;">
                    </div>
                    <div class="column1" style="width:44%;">
					<table>
					<thead>
					</thead>
					<tbody>
					<tr>
					<td style="vertical-align: top; text-align: left; border-right:hidden;height: 60px;color: #3A4265;">氏<br>名</td>
					<td style="vertical-align: inherit;text-align:center; height: 60px;">広瀬 すず</td>
					</tr>
					</tbody>
					</table>
                    </div>
					</div>
					
					<div class="row">
                    <div class="column2" style="width:50%;">
					<table style="border-collapse: collapse; margin-bottom: 15px; border: 2px solid black;">
					<thead class="colspanHead">
					<tr>
					<td colspan="2" style="border: 2px solid black; border-right:hidden; height: 30px;color: #3A4265;">学 習 の 記 録</td>
					<td colspan="3" style="border: 2px solid black; height: 30px;">
					<ul style="list-style-type: none; padding: 0; margin: 0; text-align:left;">
					<li style="margin-left: 10px;color: #3A4265;">(A　よくできる)</li>
					<li style="margin-left: 10px;color: #3A4265;">(B　できる)</li>
					<li style="margin-left: 10px;color: #3A4265;">(C　がんばろう)</li>
					</ul>
					</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:2%; height: 30px;color: #3A4265;">教科</td>
					<td style="width:15%; height: 30px;color: #3A4265;">観点別学習状況</td>
					<td style="width:2%; height: 30px;color: #3A4265;">1学期</td>
					<td style="width:2%; height: 30px;color: #3A4265;">2学期</td>
					<td style="width:2%; height: 30px;color: #3A4265;">3学期</td>
					</tr>
					</thead>
					<tbody>
					<!-- 1 -->
					<tr>
					<td rowspan="3" style="width:2%; height: 30px;color: #3A4265;">国<br>語</td>
					<td style="width:15%; text-align:left; height: 30px;color: #3A4265;">知識・技能</td>
					<td style="width:2%; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left; height: 30px;color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left; height: 30px;color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					</tr>
					<!-- 2 -->
					<tr>
					<td rowspan="3" style="width:2%; height: 30px;color: #3A4265;">算<br>数</td>
					<td style="width:15%; text-align:left; height: 30px;color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left; height: 30px;color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left; height: 30px;color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					</tr>
					<!-- 3 -->
					<tr>
					<td rowspan="3" style="width:2%; height: 30px;color: #3A4265;">生<br>活</td>
					<td style="width:15%; text-align:left; height: 30px;color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left; height: 30px;color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left; height: 30px;color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					</tr>
					<!-- 4 -->
					<tr>
					<td rowspan="3" style="width:2%; height: 40px;color: #3A4265;">音<br>楽</td>
					<td style="width:15%; text-align:left; height: 30px;color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left; height: 30px;color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left; height: 30px;color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					</tr>
					<!-- 5 -->
					<tr>
					<td rowspan="3" style="width:2%; height: 30px;color: #3A4265;">図<br>画<br>工<br>作</td>
					<td style="width:15%; text-align:left; height: 30px;color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left; height: 30px;color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left; height: 30px;color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					</tr>
					<!-- 6 -->
					<tr>
					<td rowspan="3" style="width:2%; height: 30px;color: #3A4265;">体<br>育</td>
					<td style="width:15%; text-align:left; height: 30px;color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left; height: 30px;color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left; height: 30px;color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					<td style="width:2%; font-weight: bold; height: 30px;">B</td>
					</tr>
					</tbody>
					</table>
					
					<!-- Second table and additional content... -->
					<table class="table table-bordered table-responsive" style="border: 2px solid black;margin-top:45px;">
					<thead class="colspanHead">
					<tr>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 52px;color: #3A4265;">出欠の<br>記録</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 52px;color: #3A4265;">授業<br>日数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 52px;color: #3A4265;">出席停<br>止<br>忌引き等</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 52px;color: #3A4265;">出席しなけれ<br>ばならない日<br>数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 52px;color: #3A4265;">欠席<br>日数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 52px;color: #3A4265;">出席<br>日数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 52px;color: #3A4265;">遅刻</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 52px;color: #3A4265;">早退</th>
					</tr>
					</thead>
					<tbody style="border: 1px solid black;">
					<tr>
					<td style="height: 30px;color: #3A4265;">4月</td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					</tr>
					<tr>
					<td style="height: 30px;color: #3A4265;">5月</td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					</tr>
					<tr>
					<td style="height: 30px;color: #3A4265;">6月</td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					</tr>
					<tr>
					<td style="height: 30px;color: #3A4265;">7月</td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					</tr>
					<tr>
					<td style="height: 30px;color: #3A4265;">8月</td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					</tr>
					<tr>
					<td style="height: 30px;color: #3A4265;">9月</td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					</tr>
					<tr>
					<td style="height: 30px;color: #3A4265;">10月</td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					</tr>
					<tr>
					<td style="height: 30px;color: #3A4265;">11月</td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					</tr>
					<tr>
					<td style="height: 30px;color: #3A4265;">12月</td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					</tr>
					<tr>
					<td style="height: 30px;color: #3A4265;">1月</td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					</tr>
					<tr>
					<td style="height: 30px;color: #3A4265;">2月</td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					</tr>
					<tr>
					<td style="height: 30px;color: #3A4265;">3月</td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					</tr>
					<tr style="border-top: 2px solid black;">
					<td style="height: 34px;color: #3A4265;">合計</td>
					<td style="height: 34px;"></td>
					<td style="height: 34px;"></td>
					<td style="height: 34px;"></td>
					<td style="height: 34px;"></td>
					<td style="height: 34px;"></td>
					<td style="height: 34px;"></td>
					<td style="height: 34px;"></td>
					</tr>
					</tbody>
					</table>
                    </div>
					
                    <div class="column2" style="width:1%;">
                    </div>
                    <div class="column2" style="width:44%;">
					<table class="table table-bordered" style="border: 2px solid black;">
					<thead class="colspanHead">
					<tr>
					<td colspan="2" style="text-align:center; border: 1px solid black; vertical-align: middle; height: 63px;border-right:hidden;color: #3A4265;">
					行動及び生活の記録</td>
					<td colspan="3" style="border: 1px solid black; height: 63px;">
					<ul style="list-style-type: none; padding: 0; margin: 0;text-align:left;">
					<li style="margin-left: 60px;color: #3A4265;">（3学期に記載）</li>
					<li style="margin-left: 60px;color: #3A4265;"></li>
					<li style="margin-left: 60px;color: #3A4265;">（○すぐれている）</li>
					</ul>
					</td>
					</tr>
					</thead>
					
					<tbody>
					<tr style="border-top: 2px solid black;">
					<td colspan="4" style="text-align:left;color: #3A4265;">気持ちのよい挨拶と返事をし、時間を守り、
					規則正しい 生活をする。</td>
					<td colspan="1"></td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">体力の向上に努め、元気に生活をする。</td>
					<td colspan="1">
					<input type="radio" id="age1" name="age" value="30">
					<label for="age1"></label><br>
					</td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">より高い目標を決め、根気強く努力する。</td>
					<td colspan="1"></td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">自分の役割と責任を自覚し、
					信頼される行動をする。</td>
					<td colspan="1"></td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">進んで新しい考えや方法を見付け、
					工夫して生活をよりよくしようとする。</td>
					<td colspan="1">
					<input type="radio" id="age1" name="age" value="30">
					<label for="age1"></label><br>
					</td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">思いやりや感謝の心をもつとともに、
					相手の考えや立場を尊重し、
					力を合わせて生活する。</td>
					<td colspan="1"></td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">自然や自他の生命を大切にする。</td>
					<td colspan="1"><input type="radio" id="age1" name="age" value="30">
					<label for="age1"></label><br>
					</td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">人や社会に役立つことを考え、
					進んで仕事や奉仕活動をする。</td>
					<td colspan="1">
					</td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">正義を大切にし、公正・公平にふるまう。</td>
					<td colspan="1"></td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">公共の物を大切にし、
					学校や社会のきまりを守って生活する。</td>
					<td colspan="1"><input type="radio" id="age1" name="age" value="30">
					<label for="age1"></label><br>
					</td>
					</tr>
					</tbody>
					</table>
					
					<table class="table table-bordered" style="border: 2px solid black;margin-top:30px;">
					<thead class="colspanHead">
					<tr>
					<td colspan="5" style="color: #3A4265;">特別の教科　道徳　(3学期に記載)</td>
					</tr>
					</thead>
					<tbody>
					<tr style="border-top: 2px solid black;">
					<td colspan="5" style="height:60px;text-align:center;color: #3A4265;">
					教材の主人公の思いや考え
					を自分の体験と重ねて、
					実感として捉えようと
					していました。特に、
					「なかよしだけど」の学習では、
					登場人物の行動から、
					相手も自分も気持ちよ
					く過ごすために大切なマナーに気付きました。
					</td>
					</tr>
					</tbody>
					</table>
					
					<table class="table table-bordered" style="border: 2px solid black;margin-top:30px;">
					<thead class="colspanHead">
					<tr>
					<td colspan="5" style="color: #3A4265;">特 別 活 動 等 の 記 録　(毎学期記載)</td>
					</tr>
					</thead>
					<tbody>
					<tr style="border-top: 2px solid black;">
					<td colspan="5" style="height:60px;text-align:left;color: #3A4265; ">
					1学期　なぞなぞ係<br>
					2学期　いろいろ工作係<br>
					3学期　なぞなぞ係<br>
					</td>
					</tr>
					</tbody>
					</table>
					
					<table class="table table-bordered" style="border: 2px solid black;margin-top:30px;">
					<thead class="colspanHead">
					<tr>
					<td colspan="5" style="color: #3A4265;"> 所見　（3学期に記載）</td>
					</tr>
					</thead>
					<tbody>
					<tr style="border-top: 2px solid black;">
					<td colspan="5" style="height:50px;text-align:center;color: #3A4265;">
					いつも穏やかで、相手の気持ちを考えて手伝うなど、
					思いやりに溢れた行動がたくさん見られました。
					体育科「サッカー」では、
					攻めや守りの動きを理解し、
					ゲームに取り組むことができました。
					味方や相手の動きをよく見ており、
					キーパーがパスを出しやすい場所に動いたり、
					ボールを持っている相手
					に積極的に近づいたりするなど、
					どのような動きがチームのためになるかを考え、
					判断して動く姿が多く見られました。
					３年生でも〇〇さんのよさを発揮し
					てさらに活躍することを願っています。
					</td>
					</tr>
					</tbody>
					</table>
					
					<div style="display: flex; flex-wrap: wrap;">
					<div style="width: 100%; box-sizing: border-box;">
					<p style="text-align: left; font-size: 14px; color: #363738b3;color: #3A4265;">※1，2学期の内容は、三者懇談でお伝えさせていただきます。</p>
					</div>
					</div>
					
					<div class="row" style="margin-top:25px;">
					<div style="width: 40%;float: left;">
					<table style="border-collapse: collapse; margin-top: 12px;  border: 2px solid black;">
					<thead style="text-align: center;">
					<!-- Your content here -->
					</thead>
					<tbody>
					<tr>
					<td style="text-align: left; height: 40px; border: 1px solid black;color: #3A4265;">
					校│<br>長│
					</td>
					</tr>
					</tbody>
					</table>
					</div>
					<div style="width: 10%;"></div>
					<div style="width: 40%; float: right;">
					<table style="border-collapse: collapse; margin-top: 12px; border: 2px solid black;">
					<thead style="text-align: center;">
					<!-- Your content here -->
					</thead>
					<tbody>
					<tr>
					<td style="text-align: left; height: 40px; border: 1px solid black;color: #3A4265;">
					担│<br>任│
					</td>
					</tr>
					</tbody>
					</table>
					</div>
					</div>
                    </div>
					</div>
					</div>
					</body>
					
					</html>';
				}
				if($stuclass==3 || $stuclass==4)
				{
					$output='<!DOCTYPE html>
					<html lang="en">
					
					<head>
					<meta charset="utf-8" />
					<title>Primary_grade1_2</title>
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
					
					body {
                    font-family: "ipag", "Open Sans", !important;
					}
					
					table {
                    border-collapse: collapse;
                    width: 100%;
                    line-height: 20px;
                    letter-spacing: 0.0133em;
					}
					
					td,
					th {
                    border: 1px solid black;
                    text-align: center;
                    line-height: 20px;
                    letter-spacing: 0.0133em;
					}
					
					.column1 {
                    float: left;
                    width: 30%;
                    padding: 10px;
                    height: 80px;
					}
					
					.row:after {
                    content: "";
                    display: table;
                    clear: both;
					}
					
					.container {
                    display: flex;
                    justify-content: center;
					}
					
					.column2 {
                    float: left;
                    width: 45%;
                    padding: 10px;
					}
					
					.content {
                    box-sizing: border-box;
                    display: block;
                    margin: 0 auto;
                    padding: 20px;
                    border-radius: 7px;
                    margin-top: 20px;
                    background-color: #fff;
                    border: 1px solid #dddddd;
                    font-size: 13px;
                    "
					
					}
					</style>
					</head>
					
					<body>
					<div class="content">
					<div class="row">
                    <div class="column">
					<p>クアラルンプール日本人学校　小学</p>
					<p style="margin-left: 92px;margin-top:-13px;">部</p>
                    </div>
					</div>
					
					<div class="row">
                    <div class="column1" style="width:10%;">
					<div style="margin-top:20px;">
					<p style="margin: 0;">3 年生</p>
					</div>
					
                    </div>
                    <div class="column1" style="width:10%;">
					
					<div style="margin-top:20px;">
					<p style="margin: 0;">1 学期</p>
					</div>
					
                    </div>
                    <div class="column1" style="width:5%;">
					<div style="margin-top:20px;">
					<p style="margin: 0;">通知表</p>
					</div>
                    </div>
                    <div class="column1" style="width:18%;">
					<table>
					<thead>
					</thead>
					<tbody>
					<tr>
					<td style="text-align: right; vertical-align: bottom; height: 60px;color: #3A4265;">組</td>
					<td style="text-align: right; vertical-align: bottom; height: 60px;color: #3A4265;">番</td>
					</tr>
					</tbody>
					</table>
                    </div>
                    <div class="column1" style="width:1%;">
                    </div>
                    <div class="column1" style="width:44%;">
					<table>
					<thead>
					</thead>
					<tbody>
					<tr>
					<td style="vertical-align: top; text-align: left; border-right:hidden;height: 60px;color: #3A4265;">氏<br>名</td>
					<td style="vertical-align: inherit;text-align:center; height: 60px;">石原　さとみ</td>
					</tr>
					</tbody>
					</table>
                    </div>
					</div>
					
					<div class="row">
                    <div class="column2" style="width:50%;">
					<table style="border-collapse: collapse; margin-bottom: 15px; border: 2px solid black;">
					<thead class="colspanHead">
					<tr>
					<td colspan="2" style="border: 2px solid black; border-right:hidden; color: #3A4265;">学 習 の 記 録</td>
					<td colspan="3" style="border: 2px solid black;">
					<ul style="list-style-type: none; padding: 0; margin: 0; text-align:left;">
					<li style="margin-left: 10px;color: #3A4265;">(A　よくできる)</li>
					<li style="margin-left: 10px;color: #3A4265;">(B　できる)</li>
					<li style="margin-left: 10px;color: #3A4265;">(C　がんばろう)</li>
					</ul>
					</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:2%; color: #3A4265;">教科</td>
					<td style="width:15%; color: #3A4265;">観点別学習状況</td>
					<td style="width:2%; color: #3A4265;">1学期</td>
					<td style="width:2%; color: #3A4265;">2学期</td>
					<td style="width:2%; color: #3A4265;">3学期</td>
					</tr>
					</thead>
					<tbody>
					<!-- Row 1 -->
					<tr>
					<td rowspan="3" style="width:2%; color: #3A4265;">国<br>語</td>
					<td style="width:15%; text-align:left; color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left; color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left; color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold;">c</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<!-- Row 2 -->
					<tr>
					<td rowspan="3" style="width:2%; color: #3A4265;">社<br>会</td>
					<td style="width:15%; text-align:left; color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left; color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left; color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">A</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<!-- Row 3 -->
					<tr>
					<td rowspan="3" style="width:2%; color: #3A4265;">算<br>数</td>
					<td style="width:15%; text-align:left; color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left; color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">A</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left; color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">A</td>
					</tr>
					<!-- Row 4 -->
					<tr>
					<td rowspan="3" style="width:2%; color: #3A4265;">理<br>科</td>
					<td style="width:15%; text-align:left; color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left; color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left; color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<!-- Row 5 -->
					<tr>
					<td rowspan="3" style="width:2%; color: #3A4265;">音<br>楽</td>
					<td style="width:15%; text-align:left; color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">A</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left; color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left; color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold;">A</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<!-- Row 6 -->
					<tr>
					<td rowspan="3" style="width:2%; color: #3A4265;">図<br>画<br>工<br>作</td>
					<td style="width:15%; text-align:left; color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left; color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left; color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">A</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<!-- Row 7 -->
					<tr>
					<td rowspan="3" style="width:2%; color: #3A4265;">体<br>育</td>
					<td style="width:15%; text-align:left; color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left; color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left; color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">A</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<!-- Include the rest of the rows similarly -->
					
					
					</tbody>
					</table>
					
					<!-- Second table and additional content... -->
					<table class="table table-bordered" style="border: 2px solid black;margin-top:35px;">
					<thead class="colspanHead">
					<tr>
					<td colspan="5" style="color: #3A4265;">外 国 語 活 動　(3学期に記載)</td>
					</tr>
					</thead>
					<tbody>
					<tr style="border-top: 2px solid black;">
					<td colspan="5" style="height:70px;text-align:left;color: #3A4265; ">
					UNIT7「This is for you.」の学習では、「star」
					など色々な形を英語で言えるようになりました。
					今回のECコラボでは、
					様々な形を組み合わせたクリスマスカードを作成し、
					友達に紹介することができました。
					</td>
					</tr>
					</tbody>
					</table>
					
					<!-- Third table and additional content... -->
					<table class="table table-bordered table-responsive" style="border: 2px solid black;margin-top:45px;">
					<thead class="colspanHead">
					<tr>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265;">出欠の<br>記録</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265;">授業<br>日数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265;">出席停<br>止<br>忌引き等</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265;">出席しなけれ<br>ばならない日<br>数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265;">欠席<br>日数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265;">出席<br>日数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265;">遅刻</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265;">早退</th>
					</tr>
					</thead>
					<tbody style="border: 1px solid black;">
					<tr>
					<td style="color: #3A4265;">4月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">5月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td color: #3A4265;">6月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">7月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">8月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">9月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">10月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">11月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">12月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">1月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">2月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">3月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr style="border-top: 2px solid black;">
					<td style="height: 34px;color: #3A4265;">合計</td>
					<td style="height: 34px;"></td>
					<td style="height: 34px;"></td>
					<td style="height: 34px;"></td>
					<td style="height: 34px;"></td>
					<td style="height: 34px;"></td>
					<td style="height: 34px;"></td>
					<td style="height: 34px;"></td>
					</tr>
					</tbody>
					</table>
                    </div>
					
                    <div class="column2" style="width:1%;">
                    </div>
                    <div class="column2" style="width:44%;">
					<table class="table table-bordered" style="border: 2px solid black;">
					<thead class="colspanHead">
					<tr>
					<td colspan="2" style="text-align:center; border: 1px solid black; vertical-align: middle; height: 63px;border-right:hidden;color: #3A4265;">
					行動及び生活の記録</td>
					<td colspan="3" style="border: 1px solid black; height: 30px;">
					<ul style="list-style-type: none; padding: 0; margin: 0;text-align:left;">
					<li style="margin-left: 60px;color: #3A4265;">（3学期に記載）</li>
					<li style="margin-left: 60px;color: #3A4265;"></li>
					<li style="margin-left: 60px;color: #3A4265;">（○すぐれている）</li>
					</ul>
					</td>
					</tr>
					</thead>
					
					<tbody>
					<tr style="border-top: 2px solid black;">
					<td colspan="4" style="text-align:left;color: #3A4265;">気持ちのよい挨拶と返事をし、時間を守り、
					規則正しい 生活をする。</td>
					<td colspan="1"></td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">体力の向上に努め、元気に生活をする。</td>
					<td colspan="1">
					<input type="radio" id="age1" name="age" value="30">
					<label for="age1"></label><br>
					</td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">より高い目標を決め、根気強く努力する。</td>
					<td colspan="1"></td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">自分の役割と責任を自覚し、
					信頼される行動をする。</td>
					<td colspan="1"></td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">進んで新しい考えや方法を見付け、
					工夫して生活をよりよくしようとする。</td>
					<td colspan="1">
					<input type="radio" id="age1" name="age" value="30">
					<label for="age1"></label><br>
					</td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">思いやりや感謝の心をもつとともに、
					相手の考えや立場を尊重し、
					力を合わせて生活する。</td>
					<td colspan="1"></td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">自然や自他の生命を大切にする。</td>
					<td colspan="1"><input type="radio" id="age1" name="age" value="30">
					<label for="age1"></label><br>
					</td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">人や社会に役立つことを考え、
					進んで仕事や奉仕活動をする。</td>
					<td colspan="1">
					</td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">正義を大切にし、公正・公平にふるまう。</td>
					<td colspan="1"></td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">公共の物を大切にし、
					学校や社会のきまりを守って生活する。</td>
					<td colspan="1"><input type="radio" id="age1" name="age" value="30">
					<label for="age1"></label><br>
					</td>
					</tr>
					</tbody>
					</table>
					
					<table class="table table-bordered" style="border: 2px solid black;margin-top:10px;">
					<thead class="colspanHead">
					<tr>
					<td colspan="5" style="color: #3A4265;">特別の教科　道徳　(3学期に記載)</td>
					</tr>
					</thead>
					<tbody>
					<tr style="border-top: 2px solid black;">
					<td colspan="5" style="text-align:justify;color: #3A4265;">
					教材の主人公の思いや考え
					を自分の体験と重ねて、
					実感として捉えようと
					していました。特に、
					「なかよしだけど」の学習では、
					登場人物の行動から、
					相手も自分も気持ちよ
					く過ごすために大切なマナーに気付きました。
					</td>
					</tr>
					</tbody>
					</table>
					<table class="table table-bordered" style="border: 2px solid black;margin-top:10px;">
					<thead class="colspanHead">
					<tr>
					<td colspan="5" style="color: #3A4265;">総合的な学習の時間　(2学期に記載)</td>
					</tr>
					<tr>
					<td colspan="5" style="color: #3A4265;border-top: 1px solid black;"> マレーシアの遊びを調べよう</td>
					</tr>
					</thead>
					<tbody>
					<tr style="border-top: 1px solid black;">
					<td colspan="5" style="text-align:justify;color: #3A4265;">
					ペスタスバンでは「パフ」の合奏で、
					木琴を担当しました。登校後、休み時間、
					放課後に時間を見つけて練習に励むなど、
					意欲的に取り組みました。
					より良いものに仕上げたいという
					強い思いが伝わってきました。
					</td>
					</tr>
					</tbody>
					</table>
					
					<table class="table table-bordered" style="border: 2px solid black;margin-top:10px;">
					<thead class="colspanHead">
					<tr>
					<td colspan="5" style="color: #3A4265;">特 別 活 動 等 の 記 録　(毎学期記載)</td>
					</tr>
					</thead>
					<tbody>
					<tr style="border-top: 2px solid black;">
					<td colspan="5" style="text-align:left;color: #3A4265; ">
					1学期　なぞなぞ係<br>
					2学期　いろいろ工作係<br>
					3学期　なぞなぞ係<br>
					</td>
					</tr>
					</tbody>
					</table>
					
					<table class="table table-bordered" style="border: 2px solid black;margin-top:10px;">
					<thead class="colspanHead">
					<tr>
					<td colspan="5" style="color: #3A4265;"> 所見　（3学期に記載）</td>
					</tr>
					</thead>
					<tbody>
					<tr style="border-top: 2px solid black;">
					<td colspan="5" style="text-align:justify;color: #3A4265;">
					いつも穏やかで、相手の気持ちを考えて手伝うなど、
					思いやりに溢れた行動がたくさん見られました。
					体育科「サッカー」では、攻めや守りの動きを理解し、
					ゲームに取り組むことができました。
					味方や相手の動きをよく見ており、
					キーパーがパスを出しやすい場所に動いたり、
					ボールを持っている相手に積極的に近づいたりするなど、
					どのような動きがチームのためになるかを考え、
					判断して動く姿が多く見られました。
					３年生でも〇〇さんのよさを発揮し
					てさらに活躍することを願っています。
					</td>
					</tr>
					</tbody>
					</table>
					
					<div style="display: flex; flex-wrap: wrap;">
					<div style="width: 100%; box-sizing: border-box;">
					<p style="text-align: left; font-size: 14px; color: #363738b3;color: #3A4265;">※1，2学期の内容は、三者懇談でお伝えさせていただきます。</p>
					</div>
					</div>
					
					<div class="row">
					<div style="width: 40%;float: left;">
					<table style="border-collapse: collapse; margin-top: 12px;  border: 2px solid black;">
					<thead style="text-align: center;">
					<!-- Your content here -->
					</thead>
					<tbody>
					<tr>
					<td style="text-align: left; height: 40px; border: 1px solid black;color: #3A4265;">
					校│<br>長│
					</td>
					</tr>
					</tbody>
					</table>
					</div>
					<div style="width: 10%;"></div>
					<div style="width: 40%; float: right;">
					<table style="border-collapse: collapse; margin-top: 12px; border: 2px solid black;">
					<thead style="text-align: center;">
					<!-- Your content here -->
					</thead>
					<tbody>
					<tr>
					<td style="text-align: left; height: 40px; border: 1px solid black;color: #3A4265;">
					担│<br>任│
					</td>
					</tr>
					</tbody>
					</table>
					</div>
					</div>
                    </div>
					</div>
					</div>
					</body>
					
					</html>';
				}
				if($stuclass==5 || $stuclass==6)
				{
					$output='<!DOCTYPE html>
					<html lang="en">
					
					<head>
					<meta charset="utf-8" />
					<title>Primary_grade_5_6</title>
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
					
                    body {
					font-family: "ipag", "Open Sans", !important;
                    }
					
                    table {
					border-collapse: collapse;
					width: 100%;
					line-height: 20px;
					letter-spacing: 0.0133em;
                    }
					
                    td,
                    th {
					border: 1px solid black;
					text-align: center;
					line-height: 20px;
					letter-spacing: 0.0133em;
                    }
					
                    .column1 {
					float: left;
					width: 30%;
					padding: 10px;
					height: 80px;
                    }
					
                    .row:after {
					content: "";
					display: table;
					clear: both;
                    }
					
                    .container {
					display: flex;
					justify-content: center;
                    }
					
                    .column2 {
					float: left;
					width: 45%;
					padding: 10px;
                    }
					
                    .content {
					box-sizing: border-box;
					display: block;
					margin: 0 auto;
					padding: 20px;
					border-radius: 7px;
					margin-top: 20px;
					background-color: #fff;
					border: 1px solid #dddddd;
					font-size: 15px;
					"
					
                    }
					</style>
					</head>
					
					<body>
					<div class="content">
                    <div class="row">
					<div class="column">
					<p>クアラルンプール日本人学校　小学部</p>
					</div>
                    </div>
					
                    <div class="row">
					<div class="column1" style="width:10%;">
					<div style="margin-top:20px;">
					<p style="margin: 0;">5 年生</p>
					</div>
					
					</div>
					<div class="column1" style="width:10%;">
					
					<div style="margin-top:20px;">
					<p style="margin: 0;">1 学期</p>
					</div>
					
					</div>
					<div class="column1" style="width:5%;">
					<div style="margin-top:20px;">
					<p style="margin: 0;">通知表</p>
					</div>
					</div>
					<div class="column1" style="width:18%;">
					<table>
					<thead>
					</thead>
					<tbody>
					<tr>
					<td style="text-align: right; vertical-align: bottom; height: 60px;color: #3A4265;">組</td>
					<td style="text-align: right; vertical-align: bottom; height: 60px;color: #3A4265;">番</td>
					</tr>
					</tbody>
					</table>
					</div>
					<div class="column1" style="width:1%;">
					</div>
					<div class="column1" style="width:44%;">
					<table>
					<thead>
					</thead>
					<tbody>
					<tr>
					<td style="vertical-align: top; text-align: left; border-right:hidden;height: 60px;color: #3A4265;">氏名</td>
					<td style="vertical-align: inherit;text-align:center; height: 60px;">新垣結衣</td>
					</tr>
					</tbody>
					</table>
					</div>
                    </div>
					
                    <div class="row">
					<div class="column2" style="width:50%;">
					<table style="border-collapse: collapse; margin-bottom: 15px; border: 2px solid black;">
					<thead class="colspanHead">
					<tr>
					<td colspan="2" style="border: 2px solid black; border-right:hidden; height: 30px;color: #3A4265;">学 習 の 記 録</td>
					<td colspan="3" style="border: 2px solid black; height: 30px;">
					<ul style="list-style-type: none; padding: 0; margin: 0; text-align:left;">
					<li style="margin-left: 10px;color: #3A4265;">(A　よくできる)</li>
					<li style="margin-left: 10px;color: #3A4265;">(B　できる)</li>
					<li style="margin-left: 10px;color: #3A4265;">(C　がんばろう)</li>
					</ul>
					</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:2%; height: 30px;color: #3A4265;">教<br>科</td>
					<td style="width:15%; height: 30px;color: #3A4265;">観点別学習状況</td>
					<td style="width:2%; height: 30px;color: #3A4265;">1学期</td>
					<td style="width:2%; height: 30px;color: #3A4265;">2学期</td>
					<td style="width:2%; height: 30px;color: #3A4265;">3学期</td>
					</tr>
					</thead>
					<tbody>
					<!-- 1 -->
					<tr>
					<td rowspan="3" style="width:2%; color: #3A4265;">国<br>語</td>
					<td style="width:15%; text-align:left; color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left;color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left;color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<!-- 2 -->
					<tr>
					<td rowspan="3" style="width:2%; color: #3A4265;">社<br>会</td>
					<td style="width:15%; text-align:left;color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left;color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left;color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">A</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<!-- 3 -->
					<tr>
					<td rowspan="3" style="width:2%; color: #3A4265;">算<br>数</td>
					<td style="width:15%; text-align:left;color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left;color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">A</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left;color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<!-- 4 -->
					<tr>
					<td rowspan="3" style="width:2%;color: #3A4265;">理<br>科</td>
					<td style="width:15%; text-align:left;color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left;color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left;color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<!-- 5 -->
					<tr>
					<td rowspan="3" style="width:2%;color: #3A4265;">音<br>楽</td>
					<td style="width:15%; text-align:left;color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">A</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left;color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left;color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold;">A</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<!-- 6 -->
					<tr>
					<td rowspan="3" style="width:2%;color: #3A4265;">図<br>画<br>工<br>作</td>
					<td style="width:15%; text-align:left;color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left;color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left;color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">A</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<!-- 7 -->
					<tr>
					<td rowspan="3" style="width:2%;color: #3A4265;">家<br>庭</td>
					<td style="width:15%; text-align:left;color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left;color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left;color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">A</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<!-- 8 -->
					<tr>
					<td rowspan="3" style="width:2%;color: #3A4265;">体<br>育</td>
					<td style="width:15%; text-align:left;color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left;color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left;color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">A</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<!-- 9 -->
					<tr>
					<td rowspan="3" style="width:2%;color: #3A4265;">外<br>国<br>語</td>
					<td style="width:15%; text-align:left; color: #3A4265;">知識・技能</td>
					<td style="width:2%; font-weight: bold; ">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr>
					<td style="width:15%; text-align:left;color: #3A4265;">思考・判断・表現</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td style="width:15%; text-align:left;color: #3A4265;">主体的に学習に取り組む態度</td>
					<td style="width:2%; font-weight: bold;">B</td>
					<td style="width:2%; font-weight: bold;">A</td>
					<td style="width:2%; font-weight: bold;">B</td>
					</tr>
					</tbody>
					</table>
					
					<!-- Second table and additional content... -->
					<table class="table table-bordered table-responsive" style="border: 2px solid black;margin-top:45px;">
					<thead class="colspanHead">
					<tr>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265;">出欠の<br>記録</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265;">授業<br>日数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265;">出席停<br>止<br>忌引き等</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265;">出席しなけれ<br>ばならない日<br>数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265;">欠席<br>日数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265;">出席<br>日数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265;">遅刻</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265;">早退</th>
					</tr>
					</thead>
					<tbody style="border: 1px solid black;">
					<tr>
					<td style="color: #3A4265;">4月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">5月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">6月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">7月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">8月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">9月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">10月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">11月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">12月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">1月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">2月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr>
					<td style="color: #3A4265;">3月</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					<tr style="border-top: 2px solid black;">
					<td style="height: 34px;color: #3A4265;">合計</td>
					<td style="height: 34px;"></td>
					<td style="height: 34px;"></td>
					<td style="height: 34px;"></td>
					<td style="height: 34px;"></td>
					<td style="height: 34px;"></td>
					<td style="height: 34px;"></td>
					<td style="height: 34px;"></td>
					</tr>
					</tbody>
					</table>
					</div>
					
					<div class="column2" style="width:1%;">
					</div>
					<div class="column2" style="width:44%;">
					<table class="table table-bordered" style="border: 2px solid black;">
					<thead class="colspanHead">
					<tr>
					<td colspan="2" style="text-align:center; border: 1px solid black; vertical-align: middle; height: 63px;border-right:hidden;color: #3A4265;">
					行動及び生活の記録</td>
					<td colspan="3" style="border: 1px solid black; height: 63px;">
					<ul style="list-style-type: none; padding: 0; margin: 0;text-align:left;">
					<li style="margin-left: 60px;color: #3A4265;">（3学期に記載）</li>
					<li style="margin-left: 60px;color: #3A4265;"></li>
					<li style="margin-left: 60px;color: #3A4265;">（○すぐれている）</li>
					</ul>
					</td>
					</tr>
					</thead>
					
					<tbody>
					<tr style="border-top: 2px solid black;">
					<td colspan="4" style="text-align:left;color: #3A4265;">気持ちのよい挨拶と返事をし、
					時間を守り、規則正しい生活をする。</td>
					<td colspan="1"></td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">体力の向上に努め、元気に生活をする。</td>
					<td colspan="1">
					<input type="radio" id="age1" name="age" value="30">
					<label for="age1"></label><br>
					</td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">より高い目標を決め、根気強く努力する。</td>
					<td colspan="1"></td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">自分の役割と責任を自覚し、
					信頼される行動をする。</td>
					<td colspan="1"></td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">進んで新しい考えや方法を見付け、
					工夫して生活をよりよくしようとする。</td>
					<td colspan="1">
					<input type="radio" id="age1" name="age" value="30">
					<label for="age1"></label><br>
					</td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">思いやりや感謝の心をもつとともに、
					相手の考えや立場を尊重し、
					力を合わせて生活する。</td>
					<td colspan="1"></td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">自然や自他の生命を大切にする。</td>
					<td colspan="1"><input type="radio" id="age1" name="age" value="30">
					<label for="age1"></label><br>
					</td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">人や社会に役立つことを考え、
					進んで仕事や奉仕活動をする。</td>
					<td colspan="1">
					</td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">自然や自他の生命を大切にする。</td>
					<td colspan="1"></td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;color: #3A4265;">公人や社会に役立つことを考え、
					進んで仕事や奉仕活動をする。</td>
					<td colspan="1"><input type="radio" id="age1" name="age" value="30">
					<label for="age1"></label><br>
					</td>
					</tr>
					
					</tbody>
					</table>
					
					<table class="table table-bordered" style="border: 2px solid black;margin-top:10px;">
					<thead class="colspanHead">
					<tr>
					<td colspan="5" style="color: #3A4265;">特別の教科　道徳　(3学期に記載)</td>
					</tr>
					</thead>
					<tbody>
					<tr style="border-top: 2px solid black;">
					<td colspan="5" style="height:60px;text-align:center;color: #3A4265;">
					教材の主人公の思いや考え
					を自分の体験と重ねて、
					実感として捉えようと
					していました。特に、
					「なかよしだけど」の学習では、
					登場人物の行動から、
					相手も自分も気持ちよ
					く過ごすために大切なマナーに気付きました。
					</td>
					</tr>
					</tbody>
					</table>
					
					<table class="table table-bordered" style="border: 2px solid black;margin-top:10px;">
					<thead class="colspanHead">
					<tr>
					<td colspan="5" style="color: #3A4265;">総合的な学習の時間　(2学期に記載)</td>
					</tr>
					<tr>
					<td colspan="5" style="color: #3A4265;border-top: 1px solid black;">マラヤ大学生との国際交流会を成功させよう</td>
					</tr>
					</thead>
					<tbody>
					<tr style="border-top: 1px solid black;">
					<td colspan="5" style="text-align:center;color: #3A4265;">
					交流会のグループ活動では、
					大学生から教わったマレーシアの遊びが、
					日本の遊びと似ていることに気付くなど、
					お互いの国の文化について理解を深めることができました。
					</td>
					</tr>
					</tbody>
					</table>
					
					<table class="table table-bordered" style="border: 2px solid black;margin-top:10px;">
					<thead class="colspanHead">
					<tr>
					<td colspan="5" style="color: #3A4265;">特 別 活 動 等 の 記 録 （毎学期記載）</td>
					</tr>
					</thead>
					<tbody>
					<tr style="border-top: 2px solid black;">
					<td colspan="5" style="height:60px;text-align:left;color: #3A4265; ">
					1学期　保健委員会(委員長)，サッカークラブ，お楽しみ係<br>
					2学期　保健委員会(委員長)，
					サッカークラブ(副クラブ長)，お楽しみ係<br>
					3学期　JSKL向上委員会(委員長)，
					サッカークラブ(副クラ 　　　　　ブ長)，黒板係<br>
					</td>
					</tr>
					</tbody>
					</table>
					
					<table class="table table-bordered" style="border: 2px solid black;margin-top:10px;">
					<thead class="colspanHead">
					<tr>
					<td colspan="5" style="color: #3A4265;">所見　(3学期に記載)</td>
					</tr>
					</thead>
					<tbody>
					<tr style="border-top: 2px solid black;">
					<td colspan="5" style="height:50px;text-align:center;color: #3A4265;">
					　的好奇心が高く、授業中の質問や良いつぶやきが、
					友達の理解の深まりにもつながりました。
					算数の「分数のわり算」では、
					自分なりの考えを持って、
					数量の関係を分かりやすくしようと、
					工夫した数直線を書き、友達に説明することができました。
					ラジャブルック会のメンバーとして、
					運動会の横断幕を作成した際には、
					休み時間等も使って友達と協力し、丁寧に仕上げました。
					</td>
					</tr>
					</tbody>
					</table>
					
					<div style="display: flex; flex-wrap: wrap;">
					<div style="width: 100%; box-sizing: border-box;">
					<p style="text-align: left; font-size: 14px; color: #363738b3;color: #3A4265;">※1，2学期の内容は、三者懇談でお伝えさせていただきます。</p>
					</div>
					</div>
					
					<div class="row" style="margin-top:5px;">
					<div style="width: 40%;float: left;">
					<table style="border-collapse: collapse; margin-top: 12px;  border: 2px solid black;">
					<thead style="text-align: center;">
					<!-- Your content here -->
					</thead>
					<tbody>
					<tr>
					<td style="text-align: left; height: 40px; border: 1px solid black;color: #3A4265;">
					校│<br>長│
					</td>
					</tr>
					</tbody>
					</table>
					</div>
					<div style="width: 10%;"></div>
					<div style="width: 40%; float: right;">
					<table style="border-collapse: collapse; margin-top: 12px; border: 2px solid black;">
					<thead style="text-align: center;">
					<!-- Your content here -->
					</thead>
					<tbody>
					<tr>
					<td style="text-align: left; height: 40px; border: 1px solid black;color: #3A4265;">
					担│<br>任│
					</td>
					</tr>
					</tbody>
					</table>
					</div>
					</div>
					</div>
                    </div>
					</div>
					</body>
					
					</html>';
				}
			}
            elseif($request->department_id==2) // Secondary 
            {
                $output='<!DOCTYPE html>
                <html lang="en">
                
                <head>
				<meta charset="utf-8" />
				<title>Secondary</title>
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
                
				body {
				font-family: "ipag", "Open Sans", !important;
				}
                
				table {
				border-collapse: collapse;
				width: 100%;
				line-height: 20px;
				letter-spacing: 0.0133em;
				}
                
				td,
				th {
				border: 1px solid black;
				text-align: center;
				line-height: 20px;
				letter-spacing: 0.0133em;
				}
                
				.column1 {
				float: left;
				width: 30%;
				padding: 10px;
				height: 80px;
				}
                
				.row:after {
				content: "";
				display: table;
				clear: both;
				}
                
				.container {
				display: flex;
				justify-content: center;
				}
                
				.column2 {
				float: left;
				width: 45%;
				padding: 10px;
				}
                
				.content {
				box-sizing: border-box;
				display: block;
				margin: 0 auto;
				padding: 20px;
				border-radius: 7px;
				margin-top: 20px;
				background-color: #fff;
				border: 1px solid #dddddd;
				font-size: 15px;
				"
                
				}
				</style>
                </head>
                
                <body>
				<div class="content">
				<div class="row">
				<div class="column">
				<p>クアラルンプール日本人学校　小学部</p>
				</div>
				</div>
                
				<div class="row">
				<div class="column1" style="width:10%;">
				<div style="margin-top:20px;">
				<p style="margin: 0;">3 年生</p>
				</div>
                
				</div>
				<div class="column1" style="width:10%;">
                
				<div style="margin-top:20px;">
				<p style="margin: 0;">2 学期</p>
				</div>
                
				</div>
				<div class="column1" style="width:5%;">
				<div style="margin-top:20px;">
				<p style="margin: 0;">通知表</p>
				</div>
				</div>
				<div class="column1" style="width:8%;">
				<table>
				<thead>
				</thead>
				<tbody>
				<tr>
				<td style="vertical-align: top; text-align: left; border-right:hidden;height: 60px;">1</td>
				<td style="vertical-align: bottom;text-align:right; height: 60px;color: #3A4265;">組</td>
				</tr>
				
				</tbody>
				</table>
				</div>
				<div class="column1" style="width:8%;">
				<table>
				<thead>
				</thead>
				<tbody>
				<tr>
				<td style="vertical-align: top; text-align: left; border-right:hidden;height: 60px;">2</td>
				<td style="vertical-align: bottom;text-align:right; height: 60px;color: #3A4265;">番</td>
				</tr>
				
				</tbody>
				</table>
				</div>
				<div class="column1" style="width:1%;">
				</div>
				<div class="column1" style="width:44%;">
				<table>
				<thead>
				</thead>
				<tbody>
				<tr>
				<td style="vertical-align: top; text-align: left; border-right:hidden;height: 60px;color: #3A4265;">氏名</td>
				<td style="vertical-align: inherit;text-align:center; height: 60px;">　石原　さとみ</td>
				</tr>
				</tbody>
				</table>
				</div>
				</div>
                
				<div class="row">
				<div class="column2" style="width:50%;">
				<table style="border-collapse: collapse; margin-bottom: 15px; border: 2px solid black;">
				<thead class="colspanHead">
                <tr>
				<td colspan="2" style="border: 2px solid black; border-right:hidden; height: 15px;">学習の記録 <span style="margin-left: 30px; color: #3A4265;">観点評価</span></td>
				<td colspan="6" style="border: 2px solid black; height: 15px;">
				<ul style="list-style-type: none; padding: 0; margin: 0; text-align:left;">
				<li style="color: #3A4265;">（A目標を十分達成したもの）</li>
				<li style="color: #3A4265;">（Bおおむね達成したもの）</li>
				<li style="color: #3A4265;">（C達成が不十分なもの）</li>
				</ul>
				</td>
                </tr>
                <tr>
				<td rowspan="2" style="color: #3A4265; height: 15px;">観<br>点</td>
				<td rowspan="2" style="width:15%;color: #3A4265; height: 15px;">観点別学習状況</td>
				<td colspan="2" style="width:2%;color: #3A4265; height: 15px;">1学期</td>
				<td colspan="2" style="width:2%;color: #3A4265; height: 15px;">2学期</td>
				<td colspan="2" style="width:2%;color: #3A4265; height: 15px;">学年末</td>
                </tr>
                <tr style="border-bottom: 2px solid black;">
				<td style="color: #3A4265; height: 15px;">観点</td>
				<td style="color: #3A4265; height: 15px;">評定</td>
				<td style="color: #3A4265; height: 15px;">観点</td>
				<td style="color: #3A4265; height: 15px;">評定</td>
				<td style="color: #3A4265; height: 15px;">観点</td>
				<td style="color: #3A4265; height: 15px;">評定</td>
                </tr>
				</thead>
				<tbody>
                <!-- 1 -->
                <tr>
				<td rowspan="3" style="width:2%;color: #3A4265; height: 15px;">国<br>語</td>
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">知識・技能</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">5</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">5</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">5</td>
                </tr>
                <tr>
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">思考・判断・表現</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
                </tr>
                <tr style="border-bottom: 2px solid black;">
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">主体的に学習に取り組む態度</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
                </tr>
                <!-- 2 -->
                <tr>
				<td rowspan="3" style="width:2%;color: #3A4265; height: 15px;">社<br>会</td>
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">知識・技能</td>
				<td style="width:2%;font-weight: 600; height: 15px;">C</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">2</td>
				<td style="width:2%;font-weight: 600; height: 15px;">B</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">3</td>
				<td style="width:2%;font-weight: 600; height: 15px;">B</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">3</td>
                </tr>
                <tr>
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">思考・判断・表現</td>
				<td style="width:2%;font-weight: 600; height: 15px;">C</td>
				<td style="width:2%;font-weight: 600; height: 15px;">B</td>
				<td style="width:2%;font-weight: 600; height: 15px;">B</td>
                </tr>
                <tr style="border-bottom: 2px solid black;">
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">主体的に学習に取り組む態度</td>
				<td style="width:2%;font-weight: 600; height: 15px;">B</td>
				<td style="width:2%;font-weight: 600; height: 15px;">B</td>
				<td style="width:2%;font-weight: 600; height: 15px;">B</td>
                </tr>
                <!-- 3 -->
                <tr>
				<td rowspan="3" style="width:2%;color: #3A4265; height: 15px;">数<br>学</td>
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">知識・技能</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">5</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">5</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">5</td>
                </tr>
                <tr>
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">思考・判断・表現</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
                </tr>
                <tr style="border-bottom: 2px solid black;">
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">主体的に学習に取り組む態度</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
                </tr>
                <!-- 4 -->
                <tr>
				<td rowspan="3" style="width:2%;color: #3A4265; height: 15px;">理<br>科</td>
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">知識・技能</td>
				<td style="width:2%;font-weight: 600; height: 15px;">B</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">4</td>
				<td style="width:2%;font-weight: 600; height: 15px;">B</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">4</td>
				<td style="width:2%;font-weight: 600; height: 15px;">B</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">4</td>
                </tr>
                <tr>
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">思考・判断・表現</td>
				<td style="width:2%;font-weight: 600; height: 15px;">B</td>
				<td style="width:2%;font-weight: 600; height: 15px;">B</td>
				<td style="width:2%;font-weight: 600; height: 15px;">B</td>
                </tr>
                <tr style="border-bottom: 2px solid black;">
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">主体的に学習に取り組む態度</td>
				<td style="width:2%;font-weight: 600; height: 15px;">B</td>
				<td style="width:2%;font-weight: 600; height: 15px;">B</td>
				<td style="width:2%;font-weight: 600; height: 15px;">B</td>
                </tr>
                <!-- 5 -->
                <tr>
				<td rowspan="3" style="width:2%;color: #3A4265; height: 15px;">音<br>楽</td>
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">知識・技能</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">5</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">5</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">5</td>
                </tr>
                <tr>
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">思考・判断・表現</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
                </tr>
                <tr style="border-bottom: 2px solid black;">
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">主体的に学習に取り組む態度</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
                </tr>
                <!-- 6 -->
                <tr>
				<td rowspan="3" style="width:2%;color: #3A4265; height: 15px;">美<br>術</td>
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">知識・技能</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">5</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">5</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">5</td>
                </tr>
                <tr>
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">思考・判断・表現</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
                </tr>
                <tr style="border-bottom: 2px solid black;">
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">主体的に学習に取り組む態度</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
                </tr>
                <!-- 7 -->
                <tr>
				<td rowspan="3" style="width:2%;color: #3A4265; height: 15px;">体<br>育</td>
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">知識・技能</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">5</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">5</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td rowspan="3" style="width:2%;font-weight: 600; height: 15px;">5</td>
                </tr>
                <tr>
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">思考・判断・表現</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
                </tr>
                <tr style="border-bottom: 2px solid black;">
				<td style="width:15%;text-align:left;color: #3A4265; height: 15px;">主体的に学習に取り組む態度</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
				<td style="width:2%;font-weight: 600; height: 15px;">A</td>
                </tr>
				</tbody>
				</table>
				
				
                
				<!-- Second table and additional content... -->
				<table class="table table-bordered table-responsive" style="border: 2px solid black;margin-top:10px;">
				<thead class="colspanHead">
				<tr>
				<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265; height: 32px;">出欠の<br>記録</th>
				<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265; height: 32px;">授業<br>日数</th>
				<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265; height: 32px;">出席停<br>止<br>忌引き等</th>
				<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265; height: 32px;">出席しなけれ<br>ばならない日<br>数</th>
				<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265; height: 32px;">欠席<br>日数</th>
				<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265; height: 32px;">出席<br>日数</th>
				<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265; height: 32px;">遅刻</th>
				<th style="border: 1px solid black; font-weight:italic; text-align: center; color: #3A4265; height: 32px;">早退</th>
				</tr>
				</thead>
				<tbody style="border: 1px solid black;">
				<tr>
				<td style="color: #3A4265; height: 32px;">4月</td>
				<td style="height: 32px;">19</td>
				<td style="height: 32px;">1</td>
				<td style="height: 32px;">18</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">18</td>
				<td style="height: 32px;">17</td>
				<td style="height: 32px;">0</td>
				</tr>
				<tr>
				<td style="color: #3A4265; height: 32px;">5月</td>
				<td style="height: 32px;">22</td>
				<td style="height: 32px;">12</td>
				<td style="height: 32px;">10</td>
				<td style="height: 32px;">5</td>
				<td style="height: 32px;">5</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">0</td>
				</tr>
				<tr>
				<td style="color: #3A4265; height: 32px;">6月</td>
				<td style="height: 32px;">22</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">22</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">22</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">0</td>
				</tr>
				<tr>
				<td style="color: #3A4265; height: 32px;">7月</td>
				<td style="height: 32px;">21</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">21</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">21</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">0</td>
				</tr>
				<tr>
				<td style="color: #3A4265; height: 32px;">8月</td>
				<td style="height: 32px;">3</td>
				<td style="height: 32px;">2</td>
				<td style="height: 32px;">1</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">1</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">2</td>
				</tr>
				<tr>
				<td style="color: #3A4265; height: 32px;">9月</td>
				<td style="height: 32px;">21</td>
				<td style="height: 32px;">2</td>
				<td style="height: 32px;">21</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">21</td>
				<td style="height: 32px;">2</td>
				<td style="height: 32px;">2</td>
				</tr>
				<tr>
				<td style="color: #3A4265; height: 32px;">10月</td>
				<td style="height: 32px;">19</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">19</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">19</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">0</td>
				</tr>
				<tr>
				<td style="color: #3A4265; height: 32px;">11月</td>
				<td style="height: 32px;">18</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">18</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">18</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">0</td>
				</tr>
				<tr>
				<td style="color: #3A4265; height: 32px;">12月</td>
				<td style="height: 32px;">18</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">18</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">18</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">0</td>
				</tr>
				<tr>
				<td style="color: #3A4265; height: 32px;">1月</td>
				<td style="height: 32px;">17</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">17</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">17</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">0</td>
				</tr>
				<tr>
				<td style="color: #3A4265; height: 32px;">2月</td>
				<td style="height: 32px;">16</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">16</td>
				<td style="height: 32px;">5</td>
				<td style="height: 32px;">11</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">11</td>
				</tr>
				<tr>
				<td style="color: #3A4265; height: 32px;">3月</td>
				<td style="height: 32px;">1</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">1</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">1</td>
				<td style="height: 32px;">0</td>
				<td style="height: 32px;">1</td>
				</tr>
				<tr style="border-top: 2px solid black;">
				<td style="height: 32px;">合計</td>
				<td style="height: 32px;">197</td>
				<td style="height: 32px;">17</td>
				<td style="height: 32px;">182</td>
				<td style="height: 32px;">10</td>
				<td style="height: 32px;">172</td>
				<td style="height: 32px;">19</td>
				<td style="height: 32px;">16</td>
				</tr>
				</tbody>
				</table>
				
				</div>
                
				<div class="column2" style="width:1%;">
				</div>
				<div class="column2" style="width:44%;">
				<table class="table table-bordered" style="border: 2px solid black;">
				<thead class="colspanHead">
				<tr>
				<td colspan="2" style="text-align:center; border: 1px solid black; vertical-align: middle; height: 63px;border-right:hidden;color: #3A4265;">
				行動及び生活の記録</td>
				<td colspan="3" style="border: 1px solid black; height: 63px;">
				<ul style="list-style-type: none; padding: 0; margin: 0;text-align:left;">
				<li style="margin-left: 60px;color: #3A4265;">（3学期に記載）</li>
				<li style="margin-left: 60px;color: #3A4265;"></li>
				<li style="margin-left: 60px;color: #3A4265;">（○すぐれている）</li>
				</ul>
				</td>
				</tr>
				</thead>
                
				<tbody>
				<tr style="border-top: 2px solid black;">
				<td colspan="4" style="text-align:left;color: #3A4265;">基本的な生活習慣</td>
				<td colspan="1"></td>
				</tr>
				<tr>
				<td colspan="4" style="text-align:left;color: #3A4265;">健康・体力の向上</td>
				<td colspan="1">
				<input type="radio" id="age1" name="age" value="30">
				<label for="age1"></label><br>
				</td>
				</tr>
				<tr>
				<td colspan="4" style="text-align:left;color: #3A4265;">自主・自律</td>
				<td colspan="1"></td>
				</tr>
				<tr>
				<td colspan="4" style="text-align:left;color: #3A4265;">責任感</td>
				<td colspan="1"></td>
				</tr>
				<tr>
				<td colspan="4" style="text-align:left;color: #3A4265;">創意工夫</td>
				<td colspan="1"></td>
				</tr>
				<tr>
				<td colspan="4" style="text-align:left;color: #3A4265;">思いやり・協力</td>
				<td colspan="1">
				<input type="radio" id="age1" name="age" value="30">
				<label for="age1"></label><br>
				</td>
				</tr>
				<tr>
				<td colspan="4" style="text-align:left;color: #3A4265;">生命尊重・自然愛護</td>
				<td colspan="1"></td>
				</tr>
				<tr>
				<td colspan="4" style="text-align:left;color: #3A4265;">勤労・奉仕</td>
				<td colspan="1"></td>
				</tr>
				<tr>
				<td colspan="4" style="text-align:left;color: #3A4265;">公正・公平</td>
				<td colspan="1"><input type="radio" id="age1" name="age" value="30">
				<label for="age1"></label><br>
				</td>
				</tr>
				<tr>
				<td colspan="4" style="text-align:left;color: #3A4265;">公共心・公徳心</td>
				<td colspan="1">
				</td>
				</tr>
				</tbody>
				</table>
                
				<table class="table table-bordered" style="border: 2px solid black;margin-top:15px;">
				<thead class="colspanHead">
				<tr>
				<td colspan="5" style="color: #3A4265;">特別の教科　道徳　（2学期に記載）</td>
				</tr>
				</thead>
				<tbody>
				<tr style="border-top: 2px solid black;">
				<td colspan="5" style="height:60px;text-align:center;color: #3A4265;">
				授業の中で「自分ならどうだろうか」と、
				自分のこととして考えることができました。
				特に「言葉おしみ」の学習では、
				作者が経験した言葉のやり取りを通して、
				挨拶や時と場に応じた適切な言葉の大切さに
				気付くことができました。
				</td>
				</tr>
				</tbody>
				</table>
				
				<table class="table table-bordered" style="border: 2px solid black;margin-top:15px;">
				<thead class="colspanHead">
				<tr>
				<td colspan="5" style="color: #3A4265;">総合的な学習の時間　（3学期に記載）</td>
				</tr>
				</thead>
				<tbody>
				<tr style="border-top: 1px solid black;">
				<td colspan="5" style="text-align:center;color: #3A4265;">
				修学旅行では、班長・
				実行委員として集会の運営を担当したり、
				充実した修学旅行になる
				よう事前準備に取り組んだりしました。
				また、リーダーとして、
				会の進行や仕事内容の確認を率先し行いました。
				最後まで責任をもっ
				て役割を果たす行動力が身に付きました。
				</td>
				</tr>
				</tbody>
				</table>
                
				<table class="table table-bordered" style="border: 2px solid black;margin-top:15px;">
				<thead class="colspanHead">
				<tr>
				<td colspan="5" style="color: #3A4265;">特別活動等の記録　（毎学期記載）</td>
				</tr>
				</thead>
				<tbody>
				<tr style="border-top: 2px solid black;">
				<td colspan="5" style="height:60px;text-align:left;color: #3A4265; ">
				前期　生活環境委員
				JSKL活動　バスケットボール
				</td>
				</tr>
				</tbody>
				</table>
                
				<table class="table table-bordered" style="border: 2px solid black;margin-top:15px;">
				<thead class="colspanHead">
				<tr>
				<td colspan="5" style="color: #3A4265;">　所見　（3学期に記載）</td>
				</tr>
				</thead>
				<tbody>
				<tr style="border-top: 2px solid black;">
				<td colspan="5" style="height:50px;text-align:center;color: #3A4265;">
				　御卒業おめでとうございます。学習に対する取り組みや，
				学校行事での意欲的な様子にいつも感心していました。
				多くの場面でクラスのために行動し貢献しました。
				中学校生活で学んだことを生かし、
				これから先の出会いや経験を大切に、
				さらに活躍することを楽しみにしています。
				</td>
				</tr>
				</tbody>
				</table>
                
				<div style="display: flex; flex-wrap: wrap;">
				<div style="width: 100%; box-sizing: border-box;">
				<p style="text-align: left; font-size: 14px; color: #363738b3;color: #3A4265;">※1,2学期の内容は、三者懇談でお伝えさせていただきます。                                </p>
				</div>
				</div>
                
				<div style="width:100%;margin-top:35px;">
				<table
				style="margin-top: 12px; width: 100%;border: 2px solid black;">
				<thead>
				<!-- Your content here -->
				</thead>
				<tbody>
				<tr>
				<td colspan="1" style="text-align: left; height: 40px; width:5%;">
				校<br>長
				</td>
				<td colspan="1" style="text-align: left; height: 40px; border-top: 2px solid black;">
				城間　勝	
				</td>
				</tr>
				<tr>
				<td colspan="1" style="text-align: left; height: 40px; width:5%;">
				担<br>任
				</td>
				<td colspan="1" style="text-align: left; height: 40px; border-top: 1px solid black;">
				林　義久	
				</td>
				</tr>
				</tbody>
				</table>
				</div>
				</div>
				</div>
				</div>
                </body>
                
                </html>';
				
			}
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
		
		
	}
