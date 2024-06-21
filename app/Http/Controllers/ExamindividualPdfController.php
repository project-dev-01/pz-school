<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Helpers\CommonHelper;
use Illuminate\Support\Facades\File;
use ZipArchive;
use DateTime;
use DateInterval;
use DatePeriod;
use DateTimeZone;
use PDF;
use Dompdf\Exception;

use Illuminate\Support\Facades\Log;

class ExamindividualPdfController extends Controller
{
	protected CommonHelper $commonHelper;
	public function __construct(CommonHelper $commonHelper)
	{
		$this->commonHelper = $commonHelper;
	}
	public function downbyecreport(Request $request)
	{
		ini_set('max_execution_time', 600);
		ini_set('memory_limit', '1024M');
		$pdf_logo = config('constants.image_url') . '/common-asset/images/jskl_pdf_ec_logo.png';
		$data = [
			'branch_id' => session()->get('branch_id'),
			'exam_id' => $request->exam_id,
			'department_id' => $request->department_id,
			'class_id' => $request->class_id,
			'section_id' => $request->section_id,
			'semester_id' => $request->semester_id,
			'session_id' => $request->session_id,
			'academic_session_id' => $request->academic_year,
			'student_id' => $request->student_id,
			'pdf_report' => 1

		];
		//dd($data);
		$getstudents = Helper::PostMethod(config('constants.api.exam_individualstudentslist'), $data);
		// dd($getstudents);
		if (empty($getstudents['data'])) {
			return redirect()->route('admin.exam_results.byreport')->with('errors', "No Student Data Found");
		}
		$stu = $getstudents['data'];
		$sno = 0;

		$grade = Helper::PostMethod(config('constants.api.class_details'), $data);
		$section = Helper::PostMethod(config('constants.api.section_details'), $data);
		$sub_data = [
			'subject_name' => "英語コミュニケーション"
		];
		$subject_details = Helper::PostMethod(config('constants.api.get_subject_details'), $sub_data);
		$subjectID = $subject_details['data']['subject_id'] ?? '0';
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
		// Fetch EC-Class paper marks
		$ec_classname = $this->commonHelper->fetchPaperMarks($request, $stu, "EC-Class", $subjectID);
		$ec_classname = ['data']['freetext'] ?? '';
		// Fetch Level paper marks
		$levelname = $this->commonHelper->fetchPaperMarks($request, $stu, "Level", $subjectID);
		$levelname = ['data']['freetext'] ?? '';

		$term = Helper::PostMethod(config('constants.api.exam_details'), $termdata);
		$n1 = ($request->department_id == '1') ? 'P' : 'S';
		$n2 = $grade['data']['name_numeric'];
		$n3 = $section['data']['name'];
		$attendance_no = isset($stu['attendance_no']) ? $stu['attendance_no'] : "00";
		$number = $n1 . $n2 . $n3 . sprintf("%02d", $attendance_no);
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
				body
				{ 
					font-family: "ipag", "Times New Roman", !important;
				}
				tr,
				td {
				font-family: "Times New Roman";
				word-wrap: break-word;
				font-style: normal;
				font-size: 16px;
				letter-spacing: 0.0133em;
				}
				
				h6 {
				font-family: "Times New Roman";
				font-style: normal;
				font-size: 14px;
				letter-spacing: 0.0133em;
				}
				
				h1 {
				font-family: "Times New Roman";
				font-style: normal;
				line-height: 60px;
				letter-spacing: 0.0133em;
				}
				
				h4 {
				font-family: "Times New Roman";
				font-style: normal;
				font-size: 24px;
				letter-spacing: 0.0133em;
				}
				
				h5 {
				font-family: "Times New Roman";
				font-style: normal;
				font-size: 15px;
				letter-spacing: 0.0133em;
				}
				h3 { font-family: "Times New Roman";
				}
				</style>
				</head>
				
				<body>';

		$output .= '<div class="content" >
					<table class="main" width="100%" style="border-collapse: collapse;">
					<tr>
					<td class="content-wrap aligncenter" colspan="3" style="margin: 0; padding: 10px; text-align: center;">
					<img src="' . $pdf_logo . '" alt="logo" height="100px"
					style="margin-left: 15px;">
					
					</td>
					</tr> 
					<tr>
					<td class="content-wrap aligncenter" colspan="3" style="margin: 0; padding: 10px; text-align: center;">
					
					<h1 style="line-height: 0px;text-align: center;margin-top:5px;font-size:40px;">Japanese School of Kuala Lumpur</h1>
					
					</td>
					</tr> 
					<tr>
					<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; width:30%; text-align: center;">
					
					<h4 style="margin: 0;margin-top:-30;">' . ($acyear['data']['name'] ?? '') . ' </h4>
					</td>       
					<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; width:30%; text-align: left;">
					<h4 style="margin: 0;margin-top:-30;">English Communication</h4>
					</td>       
					<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; width:30%; text-align: left;">
					<h4 style="margin-top:-20px;">' . ($term['data']['term_name'] ?? '') . ' Report</h4>
					</td>
					</tr> 
					<tr>
					<td class="content-wrap aligncenter" style="margin: 0; padding-left: 20px; text-align: left;">                   
					<h5 style="margin: 0;margin-top:-30px;">Number</h5>
					<h4 style="margin: 0;">' . $number . '</h4>
					</td>       
					<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; text-align: left;">
					<h5 style="margin: 0;margin-top:-30px;">EC-Class</h5>
					<h4 style="margin: 0;">' . $ec_classname . '</h4>
					</td>       
					<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; text-align: left;">
					<h5 style="margin: 0;margin-top:-30px;">Level</h5>
					<h4 style="margin: 0;">' . $levelname . '</h4>
					</td>
					</tr> 
					<tr>
					<td class="content-wrap aligncenter" style="margin: 0; padding-left: 20px;padding-top:20px; padding-bottom:-10px; text-align: left;">
					
					<h3 style="margin: 0;">Student Name</h3>
					</td>       
					<td colspan="2" class="content-wrap aligncenter" style="margin: 0;padding-left: 10px;padding-top:20px; padding-bottom:-10px;text-align: left;">
					<h3 style="margin: 0;">' . strtoupper($stu['eng_name']) . '</h3>
					</td>
					</tr> 
					<tr>
					<td class="content-wrap aligncenter" colspan="3" style="margin: 0; padding-left: 20px;padding-right: 20px;padding-top:-10px; text-align: center;">
					<table style="border-collapse: collapse; width: 100%;">
					<tbody>';
		$teachername = '';
		$teachercmd = '';
		if ($request->department_id == 1) {
			// Subject Name => "English Communication"

			//Listening
			$l1 = "L-1 Understands and follows instructions in class activities";
			$l2 = "L-2 Understands simple transactions in conversations and activities";
			$l3 = "L-3 Understands and recognises main points in simple speech";
			//Reading
			$r1 = "R-1 Reads simple words and follows instructions on posters and worksheets";
			$r2 = "R-2 Reads simple sentences in the text book";
			//Speaking
			$s1 = "S-1 Tries to have a conversation form using simple phrases and sentences";
			$s2 = "S-2 Asks and answers simple questions on familiar topics";
			$s3 = "S-3 Uses clear and loud speech to communicate";
			$s4 = "S-4 Uses learned phrases and sentences to give ideas and opinions";
			//Writing
			$w1 = "W-1 Writes simple, short words";
			$w2 = "W-2 Fills in simple forms and worksheets with proper words and phrases";
			//Attitude
			$a1 = "A-1 Cooperates and pays attention in class";
			$a2 = "A-2 Participates actively in class activities, games, and discussions";
			$a3 = "A-3 Contributes positively in group work";
			$heading = array('Listening', 'Reading', 'Speaking', 'Writing', 'Attitude');
			$papers[0] = array($l1, $l2, $l3);
			$papers[1] = array($r1, $r2);
			$papers[2] = array($s1, $s2, $s3, $s4);
			$papers[3] = array($w1, $w2);
			$papers[4] = array($a1, $a2, $a3);

			$i = 0;
			foreach ($heading as $heads) {
				$output .= '
							<tr>
							<td colspan="2"
							style="text-align:center; border: 2px solid black;background-color:#40403a57;font-size:20px;">
							' . $heads . '</td>
							</tr>';

				$paperslist = $papers[$i];
				//dd($Getpaper);
				$i++;
				foreach ($paperslist as $papername) {
					$paper = $this->commonHelper->fetchPaperMarks($request, $stu, $papername, $subjectID);
					$mark = $this->commonHelper->getMark($paper);
					$output .= '<tr>
								<td style="border: 2px solid black; text-align: left;font-weight: normal;height:25px;font-size:16px;">' . $papername . '
								</td>
								<td style="border: 2px solid black; text-align: center;font-weight: normal;height:25px;font-size:16px;">' . $mark . '</td>
								</tr>';
				}
			}
			$output .= ' </tbody>';
		}
		if ($request->department_id == 2) {
			// Subject Name => EC or English Communication

			//Listening
			$l1 = "L-1 Understands and follows instructions in class activities";
			$l2 = "L-2 Understands transactions in conversations and activities";
			$l3 = "L-3 Understands and recognises main points in speech";
			//Reading
			$r1 = "R-1 Reads high frequency words";
			$r2 = "R-2 Reads sentences in the text book";
			//Speaking
			$s1 = "S-1 Tries to have a conversation form using phrases and sentences";
			$s2 = "S-2 Asks and answers questions on familiar topics";
			$s3 = "S-3 Uses clear and loud speech to communicate";
			$s4 = "S-4 Uses learned phrases and sentences to give ideas and opinions";
			$s5 = "S-5 Speaks with fluency, proper pronunciation and intonation";
			//Writing
			$w1 = "W-1 Writes simple, short words";
			$w2 = "W-2 Fills in simple forms and worksheets with proper words and phrases";
			$w3 = "W-3 Expresses opinions and ideas using learned words and sentences";
			//Attitude
			$a1 = "A-1 Cooperates and pays attention in class";
			$a2 = "A-2 Brings books and files, submit homework and classwork on time";
			$a3 = "A-3 Participates actively in class activities, games, and discussions";
			$a4 = "A-4 Contributes positively in group work";
			$heading = array('Listening', 'Reading', 'Speaking', 'Writing', 'Attitude');
			$papers[0] = array($l1, $l2, $l3);
			$papers[1] = array($r1, $r2);
			$papers[2] = array($s1, $s2, $s3, $s4, $s5);
			$papers[3] = array($w1, $w2, $w3);
			$papers[4] = array($a1, $a2, $a3, $a4);
			$i = 0;
			foreach ($heading as $heads) {
				$output .= '
							<tr>
							<td colspan="2"
							style="text-align:center; border: 2px solid black;background-color:#40403a57;font-size:20px;">
							' . $heads . '</td>
							</tr>';

				$paperslist = $papers[$i];
				//dd($Getpaper);
				$i++;
				foreach ($paperslist as $papername) {
					$paper = $this->commonHelper->fetchPaperMarks($request, $stu, $papername, $subjectID);
					$mark = $this->commonHelper->getMark($paper);

					$output .= '<tr>
								<td style="border: 2px solid black; text-align: left;font-weight: normal;height:25px;font-size:16px;">' . $papername . '
								</td>
								<td style="border: 2px solid black; text-align: center;font-weight: normal;height:25px;font-size:16px;">' . $mark . '</td>
								</tr>';
				}
			}
			$output .= ' </tbody>';
		}

		$output .= '</table>
					
					</td>
					</tr>
					<tr>
					<td class="content-wrap aligncenter" style="margin: 0; text-align: center;">
					
					
					</td>
					
					<td class="content-wrap aligncenter"  colspan="2" style="margin: 0; padding-right: 20px; text-align: center;">
					
					<div style="text-align: right;">
					<h6 style="margin: 0;font-weight: normal;font-size:16px;">Results: Improving, Satisfactory, Excellent</h6>
					</div>
					
					</td>
					</tr>';
		$paper = $this->commonHelper->fetchPaperMarks($request, $stu, 'Teacher`s Comments', $subjectID);


		//dd($getspsubject1);//dd($pdata);
		$teachercmd = $this->commonHelper->getMark($paper);

		$papername = "Teacher Name";
		$paper = $this->commonHelper->fetchPaperMarks($request, $stu, 'Teacher Name', $subjectID);
		$teachername = $paper['data']['freetext'] ?? '';
		$output .= '<tr>
					<td class="content-wrap aligncenter" colspan="3" style="margin: 0; padding-left: 20px;padding-right: 20px;padding-top:-10px; text-align: center;">
					
					<!-- Teacher`s Comments -->
					<table style="margin-top: 40px; border-collapse: collapse; width: 100%;">
					<tbody>
					<tr>
					<td colspan="2"
					style="text-align: center; border: 2px solid black; background-color: #40403a57; color: black;font-size:18px;">
					Teacher`s Comments</td>
					</tr>
					<tr>
					<td colspan="2"
					style="text-align: left; border: 2px solid black; height: 100px; color: black; padding: 10px;
					word-wrap: break-word;">
					';
		$comment = explode("\n", $teachercmd);
		foreach ($comment as $cmt) {
			$output .= $cmt . '<br>';
		}
		$output .= '</td>
					</tr>
					</tbody>
					</table>
					
					
					</td>
					</tr>
					<tr>
					<td class="content-wrap aligncenter"  style="margin: 0; padding: 10px; text-align: center;">
					</td>
					<td class="content-wrap aligncenter"  style="margin: 0; padding: 10px; text-align: center;font-size:16px;">
					<h5 style="margin: 0;">English Teacher`s Name</h5>
					</td>
					<td class="content-wrap aligncenter"  style="margin: 0; padding: 10px; text-align: center;">
					<h5 style="margin: 0;font-weight: normal;font-size:16px;">' . $teachername . '</h5>
					
					</td>
					</tr>
					</table>
					</div>
					<div style="page-break-after: always;"></div>';

		$output .= '</body></html>';

		if ($request->department_id == 1) {
			$customPaper = array(0, 0, 700.00, 920.00);
		} else if ($request->department_id == 2) {
			$customPaper = array(0, 0, 700.00, 1000.00);
		} else {
			$customPaper = array(0, 0, 700.00, 1000.00);
		}
		// filename
		$now = now();
		$name = strtotime($now);
		//$fileName = __('messages.english_communication') . $stu['eng_name'] . $name . ".pdf";
		$fileName = __('messages.english_communication') . "_" . $number . "_" . $stu['eng_name'] . "_" . $name . ".pdf";
		return $this->commonHelper->generatePdf($customPaper, $output, $fileName);
		//return $pdf->download($fileName);
		// return $pdf->stream();
	}

	public function downbyreportcard(Request $request)
	{
		ini_set('max_execution_time', 600);
		ini_set('memory_limit', '1024M');
		$data = [
			'branch_id' => session()->get('branch_id'),
			'exam_id' => $request->exam_id,
			'department_id' => $request->department_id,
			'class_id' => $request->class_id,
			'section_id' => $request->section_id,
			'semester_id' => $request->semester_id,
			'session_id' => $request->session_id,
			'academic_session_id' => $request->academic_year,
			'student_id' => $request->student_id,
			'pdf_report' => 0 // All Primary Subjects

		];


		$language = "国語";
		$math = '算数';
		$life = '生活';
		$music = '音楽';
		$art = '図画工作';
		$sport = '体育';
		$science = "理科";
		$socity = "社会";
		$homeeconomics = "家庭";
		$foreignlanguage = "外国語";
		$english = "英語";
		$tech_homeeconomics = "技術・家庭";
		$secondary_math = '数学';
		$secondary_sports = '保健体育';
		$secondary_arts = '美術';


		$primarypaper1 = "知識・技能"; //Knowledge & Skills
		$primarypaper2 = "思考・判断・表現"; //Thinking, Judgment, and Expression
		$primarypaper3 = "主体的に学習に取り組む態度"; //Attitude to proactive learning
		$primarypaper4 = "評定"; // Rate / Rating
		$personal_score = "個人得点"; //   individual score / Personal Points

		$specialsubject1 = "行動及び生活の記録"; //Records of actions and life
		$specialpaper1 = "気持ちのよい挨拶と返事をし、時間を守り、規則正しい生活をする。"; // Greet and reply pleasantly, be punctual, and be regular Make a living.
		$specialpaper2 = "体力の向上に努め、元気に生活をする。"; // Strive to improve own physical fitness and live a healthy life.						
		$specialpaper3 = "より高い目標を決め、根気強く努力する。";	// Set higher goals and work hard.					
		$specialpaper4 = "自分の役割と責任を自覚し、信頼される行動をする";	//Be aware of own roles and responsibilities and act in a way that is trustworthy.				
		$specialpaper5 = "進んで新しい考えや方法を見付け、工夫して生活をよりよくしようとする。";	// willing to find new ideas and methods, and try to improve own living by devising ways to do so					
		$specialpaper6 = "思いやりや感謝の心をもつとともに、相手の考えや立場を尊重し、力を合わせて生活する。";	//Have compassion and gratitude, and understand the thoughts and positions of others.   Respect and live together.				
		$specialpaper7 = "自然や自他の生命を大切にする。";	//Cherish nature, self and other life.					
		$specialpaper8 = "人や社会に役立つことを考え、進んで仕事や奉仕活動をする。";	//Think about being useful to people and society, and be willing to work and do service activities.  Do.					
		$specialpaper9 = "正義を大切にし、公正・公平にふるまう。";	// We value justice and act in a fair and equitable manner.				
		$specialpaper10 = "公共の物を大切にし、学校や社会のきまりを守って生活する。";	// Cherish public objects and live in compliance with the rules of school and society Do.			 		

		$specialsubject2 = "特別の教科 道徳"; // Special Subject: Morality
		$specialsubject3 = "特 別 活 動 等 の 記 録"; // Records of special activities, etc
		$specialsubject4 = "所見"; // Findings
		// $specialsubject5="総合的な学習の時間"; // Hours of integrated study         
		$specialsubject5 = "総合"; // Hours of integrated study         
		$specialsubject6 = "外 国 語 活 動"; // Foreign Language Activities
		$description = array("説明"); // Descriptions



		$getstudents = Helper::PostMethod(config('constants.api.exam_individualstudentslist'), $data);
		$stu = $getstudents['data'];
		if (empty($getstudents['data'])) {
			return redirect()->route('admin.exam_results.byreport')->with('errors', "No Student Data Found");
		}
		$getteacherdata = Helper::PostMethod(config('constants.api.classteacher_principal'), $data);

		$grade = Helper::PostMethod(config('constants.api.class_details'), $data);
		$section = Helper::PostMethod(config('constants.api.section_details'), $data);
		$stuclass = $grade['data']['name_numeric'];
		$n1 = ($request->department_id == '1') ? 'P' : 'S';
		$n2 = $grade['data']['name_numeric'];
		$n3 = $section['data']['name'];
		$attendance_no = isset($stu['attendance_no']) ? $stu['attendance_no'] : "00";
		$number = $n1 . $n2 . $n3 . sprintf("%02d", $attendance_no);

		$titleName = "";
		if ($stuclass == 1 || $stuclass == 2) {
			$titleName = "Primary_Grade1_2";
		}
		if ($stuclass == 3 || $stuclass == 4) {
			$titleName = "Primary_Grade3_4";
		}
		if ($stuclass == 5 || $stuclass == 6) {
			$titleName = "Primary_Grade5_6";
		}
		if ($request->department_id == 2) // Secondary 
		{
			$titleName = "Secondary";
		}

		$fonturl = storage_path('fonts/ipag.ttf');
		$storagePath = storage_path('app/public/pdfs');
		$output = '<!DOCTYPE html>
						<html lang="en">
						
						<head>
						<meta charset="utf-8" />
						<title>' . $titleName . '</title>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
						<meta name="viewport" content="width=device-width, initial-scale=1.0">
						<style>
						@font-face {
						font-family: Times New Roman ipag;
						font-style: normal;
						font-weight: 300;
						src: url("' . $fonturl . '");
						}
						
						body {
						font-family: "ipag", "Times New Roman", !important;
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
						word-wrap: break-word;
						font-size: 18px;
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
						</style>
						</head>
						
						<body>';

		// Ensure the storage directory exists
		if (!File::exists($storagePath)) {
			File::makeDirectory($storagePath, 0755, true);
		}
		$attendance_no = isset($stu['attendance_no']) ? $stu['attendance_no'] : "00";

		if ($request->department_id == 1) // Primary 
		{
			if ($stuclass == 1 || $stuclass == 2) {

				$sno = 1;
				// here i put subjects and paper details
				$getprimarysubjects = array($language, $math, $life, $music, $art, $sport);
				$getprimarypapers = array($primarypaper1, $primarypaper2, $primarypaper3);
				$getspecialpapers = array($specialpaper1, $specialpaper2, $specialpaper3, $specialpaper4, $specialpaper5, $specialpaper6, $specialpaper7, $specialpaper8, $specialpaper9, $specialpaper10);

				$output .= '<div class="content">
						<div class="row">
						<div class="column">
						<p style="margin: 0;font-size:20px;">クアラルンプール日本人学校　小学部</p>
						</div>
						</div>
						
						<div class="row">
						<div class="column1" style="width:10%;">
						<div style="margin-top:20px;">
						<p style="margin-left:20px;font-size:20px;">' . $stuclass .  '年生</p>
						</div>
						
						</div>
						<div class="column1" style="width:10%;">
						
						<div style="margin-top:20px;">
						<p style="margin-left:20px;font-size:20px;"> 1学期</p>
						</div>
						
						</div>
						<div class="column1" style="width:5%;">
						<div style="margin-top:20px;">
						<p style="margin-left:20px;font-size:20px;">通知表</p>
						</div>
						</div>
						<div class="column1" style="margin-left:37px;width:15%;">
						<table>
						<thead>
						</thead>
						<tbody>
						<tr>
						<td style="vertical-align: middle;border-right:hidden;font-size:20px; height: 60px;width:7%;"> ' . $section['data']['name'] . '</td>
													<td style="text-align: right;font-size:20px; vertical-align: bottom; height: 60px;width:7%;"> 組</td>
													<td style="vertical-align: middle;border-right:hidden;font-size:20px; height: 60px;width:7%;"> ' . $attendance_no . '</td>
													<td style="text-align: right;font-size:20px; vertical-align: bottom; height: 60px;width:7%;"> 番</td>
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
						<td style="vertical-align: top; text-align: left; border-right:hidden;height: 60px;">氏<br>名</td>
						<td style="vertical-align: inherit;text-align:center; height: 60px;">' . $stu['name'] . '</td>
						</tr>
						</tbody>
						</table>
						</div>
						</div>
						
						<div class="row" style="margin-top:-25px;line-height:50%;">
						<div class="column2" style="width:50%;">
						<table style="border-collapse: collapse; margin-bottom: 15px; border: 2px solid black;">
						<thead class="colspanHead">
						<tr>
						<td colspan="2" style="border: 2px solid black; border-right:hidden; height: 30px;">学 習 の 記 録</td>
						<td colspan="3" style="border: 2px solid black; height: 30px;">
						<ul style="list-style-type: none; padding: 0; margin: 0; text-align:left;">
						<li style="margin-left: 10px;font-size:14px;">(A　よくできる)</li>
						<li style="margin-left: 10px;font-size:14px;">(B　できる)</li>
						<li style="margin-left: 10px;font-size:14px;">(C　がんばろう)</li>
						</ul>
						</td>
						</tr>
						<tr style="border-bottom: 2px solid black;">
						<td style="width:2%; height: 30px;">教<br>科</td>
						<td style="width:15%; height: 30px;">観点別学習状況</td>
						<td style="width:2%; height: 30px;">1学期</td>
						<td style="width:2%; height: 30px;">2学期</td>
						<td style="width:2%; height: 30px;">3学期</td>
						</tr>
						</thead>
						<tbody>';
				$p = 0;
				foreach ($getprimarysubjects as $subject) {

					$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $getprimarypapers, $subject);
					//$result1[] = $getmarks;
					// dd(count($getmarks['data']));

					$i = 0;
					// $n=count($getmarks['data']); 
					$data = $getmarks['data'] ?? [];

					foreach ($getmarks['data'] as $papers) {
						$i++;
						$output .= ' <tr>';
						if ($i == 1) {
							$output .= '<td rowspan="3" style="width:2%; height: 30px; writing-mode: vertical-rl; font-family: IPAG;">';
							$subject_chars = preg_split('//u', $subject, null, PREG_SPLIT_NO_EMPTY);
							foreach ($subject_chars as $char) {
								$output .= '<span style="display: inline-block; transform: rotate(0deg);">' . $char . '</span><br>';
							}
							$output .= '</td>';
						}
						$output .= '<td style="width:15%; text-align:left; height: 37px;">' . $papers['papers'] . '</td>';

						foreach ($papers['marks'] as $mark) {

							$mark = (isset($mark['grade']) && $mark['grade'] != null) ? $mark['grade'] : '';

							$output .= '<td style="width:2%;  height: 37px;font-size:14px;">' . $mark . '</td>';
						}
						$output .= ' </tr>';
						//dd($subject);
					}
					$p++;
				}
				$output .= '</tbody>
						</table>
						
						<!-- Second table and additional content... -->
						<table class="table table-bordered table-responsive" style="border: 2px solid black;margin-top:40px;">
						<thead class="colspanHead">
						<tr>
						<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 55px;">出欠の<br>記録</th>
						<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 55px;">授業<br>日数</th>
						<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 55px;font-size:10px;">出席停止<br>忌引き等</th>
						<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 55px;font-size:10px;">出席しなければ<br>ならない日数</th>
						<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 55px;">欠席<br>日数</th>
						<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 55px;">出席<br>日数</th>
						<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 55px;">遅刻</th>
						<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 55px;">早退</th>
						</tr>
						</thead>
						<tbody style="border: 1px solid black;">';

				$attarray = array('', '1月', ' 2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月');
				$getattendance = $this->commonHelper->getSemStudentAttendance($request, $stu);
				//dd($getattendance);
				$at_tot1 = 0;
				$at_tot2 = 0;
				$at_tot3 = 0;
				$at_tot4 = 0;
				$at_tot5 = 0;
				$at_tot6 = 0;
				$at_tot7 = 0;
				foreach ($getattendance['data'] as $att) {
					if($att['no_schooldays']==0)
					{
						$output .= '<tr>
						<td style="height: 32px;">' . $attarray[intval($att['month'])] . '</td>
						<td style="height: 32px;"> </td>
						<td style="height: 32px;"> </td>
						<td style="height: 32px;"> </td>
						<td style="height: 32px;"> </td>
						<td style="height: 32px;"> </td>
						<td style="height: 32px;"> </td>
						<td style="height: 32px;"> </td>
						</tr>';
					}
					else
					{

					
						$at_tot1 += $att['no_schooldays'];
						$at_tot2 += $att['suspension'];
						$at_tot3 += $att['totalcoming'];
						$at_tot4 += $att['totabs'];
						$at_tot5 += $att['totpres'];
						$at_tot6 += $att['totlate'];
						$at_tot7 += $att['totexc'];
						$output .= '<tr>
							<td style="height: 32px;">' . $attarray[intval($att['month'])] . '</td>
							<td style="height: 32px;">' . $att['no_schooldays'] . '</td>
							<td style="height: 32px;">' . $att['suspension'] . '</td>
							<td style="height: 32px;">' . $att['totalcoming'] . '</td>
							<td style="height: 32px;">' . $att['totabs'] . '</td>
							<td style="height: 32px;">' . $att['totpres'] . '</td>
							<td style="height: 32px;">' . $att['totlate'] . '</td>
							<td style="height: 32px;">' . $att['totexc'] . '</td>
						</tr>';
					}
				}
				$output .= '<tr style="border-top: 2px solid black;">
						<td style="height: 34px;"> 合計</td>
						<td style="height: 34px;">' . $at_tot1 . '</td>
						<td style="height: 34px;">' . $at_tot2 . '</td>
						<td style="height: 34px;">' . $at_tot3 . '</td>
						<td style="height: 34px;">' . $at_tot4 . '</td>
						<td style="height: 34px;">' . $at_tot5 . '</td>
						<td style="height: 34px;">' . $at_tot6 . '</td>
						<td style="height: 34px;">' . $at_tot7 . '</td>
					</tr>';


				$output .= '</tbody>
						</table>
						</div>';
				$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $getspecialpapers, $specialsubject1);

				$output .= '<div class="column2" style="width:1%;">
						</div>
						<div class="column2" style="width:44%;">
						<table class="table table-bordered" style="border: 2px solid black;">
						<thead class="colspanHead">
						<tr>
						<td colspan="2" style="text-align:center; border: 1px solid black; vertical-align: middle; height: 63px;border-right:hidden;">
						行動及び生活の記録</td>
						<td colspan="3" style="border: 1px solid black; height: 63px;">
						<ul style="list-style-type: none; padding: 0; margin: 0;text-align:left;">
						<li style="margin-left: 60px;font-size:14px;">（3学期に記載）</li>
						<li style="margin-left: 60px;"></li>
						<li style="margin-left: 60px;font-size:14px;">（○すぐれている）</li>
						</ul>
						</td>
						</tr>
						</thead>
						
						<tbody>
						';

				foreach ($getmarks['data'] as $papers) {
					$nsem = count($papers['marks']);
					$s = 0;
					$mark = '';
					if (!empty($papers['marks'])) {
						foreach ($papers['marks'] as $markItem) {
							$s++;
							// Check if the mark item is an array and contains 'grade_name'
							if (is_array($markItem) && isset($markItem['grade_name']) && $markItem['grade_name'] != null) {
								$mark = $markItem['grade_name'];
							}
							// Ensure that only the last semester's grade is used
							if ($s == $nsem) {
								break;
							}
						}
					}
					$fmark = ($mark == "Excellent") ? '○' : '';

					$output .= '<tr style="height:60px;">
										<td colspan="4" style="text-align:left;vertical-align: top;width:92%;height:30px;">' . $papers['papers'] . '</td>
										<td colspan="1" style="width:8%;">' . $fmark . '</td>
									</tr>';
				}

				$output .= '</tbody>
						</table>';
				$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $description, $specialsubject2);
				$i = 0;
				$mark1 = '';
				foreach ($getmarks['data'] as $papers) {
					$nsem = count($papers['marks']);
					$s = 0;
					if (!empty($papers['marks'])) {
						foreach ($papers['marks'] as $markItem) {
							$s++;
							// Check if the mark item is an array and contains 'freetext'
							if (is_array($markItem) && isset($markItem['freetext']) && $markItem['freetext'] != null) {
								$mark1 = $markItem['freetext'];
							}
							// Ensure that only the last semester's grade is used
							if ($s == $nsem) {
								break;
							}
						}
					}
				}
				$output .= '<table class="table table-bordered" style="border: 2px solid black;margin-top:30px;">
						<thead class="colspanHead">
						<tr>
						<td colspan="5">特別の教科　道徳　(3学期に記載)</td>
						</tr>
						</thead>
						<tbody>
						<tr style="border-top: 2px solid black;">
						<td colspan="5" style="height:170px;text-align:left;vertical-align: top;word-wrap: break-word;">';
				$comment = explode("\n", $mark1);
				foreach ($comment as $cmt) {
					$output .= $cmt . '<br>';
				}
				$output .= '</td>
						</tr>
						</tbody>
						</table>';
				$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $description, $specialsubject3);
				$i = 0;
				$mark2 = '';
				// foreach ($getmarks['data'] as $papers) {
				// 	$nsem = count($papers['marks']);
				// 	$s = 0;
				// 	foreach ($papers['marks'] as $mark) {
				// 		$mark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';

				// 		$s++;
				// 		$mark2 .= $s . ' 学期 - ' . $mark . '<br>';
				// 	}
				// }
				foreach ($getmarks['data'] as $papers) {
					$nsem = count($papers['marks']);
					$s = 0;
					if (!empty($papers['marks'])) {
						foreach ($papers['marks'] as $markItem) {
							$s++;
							// Check if the mark item is an array and contains 'freetext'
							if (is_array($markItem) && isset($markItem['freetext']) && $markItem['freetext'] != null) {
								$mark2 = $markItem['freetext'];
								// $mark2 .= $s . ' 学期 - ' . $mark . '<br>';
							}
							// Ensure that only the last semester's grade is used
							if ($s == $nsem) {
								break;
							}
						}
					}
				}
				$output .= '<table class="table table-bordered" style="border: 2px solid black;margin-top:30px;">
						<thead class="colspanHead">
						<tr>
						<td colspan="5">特 別 活 動 等 の 記 録　(毎学期記載)</td>
						</tr>
						</thead>
						<tbody>
						<tr style="border-top: 2px solid black;">
						<td colspan="5" style="height:180px;text-align:left;vertical-align: top;word-wrap: break-word;">';
				$comment = explode("\n", $mark2);
				foreach ($comment as $cmt) {
					$output .= $cmt . '<br>';
				}
				$output .= '</td>
						</tr>
						</tbody>
						</table>';
				$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $description, $specialsubject4);
				// dd($getmarks);
				$i = 0;
				$mark3 = '';
				foreach ($getmarks['data'] as $papers) {
					$nsem = count($papers['marks']);
					$s = 0;
					if (!empty($papers['marks'])) {
						foreach ($papers['marks'] as $markItem) {
							$s++;
							// Check if the mark item is an array and contains 'freetext'
							if (is_array($markItem) && isset($markItem['freetext']) && $markItem['freetext'] != null) {
								$mark3 = $markItem['freetext'];
							}
							// Ensure that only the last semester's grade is used
							if ($s == $nsem) {
								break;
							}
						}
					}
				}
				$output .= '<table class="table table-bordered" style="border: 2px solid black;margin-top:30px;width:100%;">
						<thead class="colspanHead">
						<tr>
						<td colspan="5"> 所見　（3学期に記載）</td>
						</tr>
						</thead>
						<tbody>
						<tr style="border-top: 2px solid black;">
						<td colspan="5" style="height:200px;text-align:left;vertical-align: top;word-wrap: break-word;">';
				$comment = explode("\n", $mark3);
				foreach ($comment as $cmt) {
					$output .= $cmt . '<br>';
				}
				$output .= '</td>
						</tr>
						</tbody>
						</table>
						
						<div style="display: flex; flex-wrap: wrap;">
						<div style="width: 100%; box-sizing: border-box;">
						<p style="text-align: right;margin-top:px; marign-bottom:50px;font-size:14px;">※1，2学期の内容は、三者懇談でお伝えさせていただきます。</p>
						</div>
						</div>
						
					
							<div style="width:100%;margin-top:34px;">
                    <table style="margin-top: 12px; width: 100%;">
                        <thead>
                            <!-- Your content here -->
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="1" style="text-align: left; height: 40px; width:5%;border: 2px solid black;">
                                    校<br>長
                                </td>
                                <td colspan="1" style="text-align: left; height: 40px; border: 2px solid black;">
                                   ' . $getteacherdata['data']['principal'] . '
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1" style="text-align: left; height: 40px; width:5%;border: 2px solid black;">
                                   担<br>任
                                </td>
                                <td colspan="1" style="text-align: left; height: 40px; border: 2px solid black;">
                                    ' . $getteacherdata['data']['teacher'] . '
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
						</div>
						</div>
						</div>';
				$customPaper = array(0, 0, 792.00, 1224.00);
				$now = now();
				$name = strtotime($now);
				$fileName = __('messages.report_card') . "_" . $number . "_" . $stu['name'] . "_" . $name . ".pdf";
			}
			if ($stuclass == 3 || $stuclass == 4) {
				// here i put subjects and paper details
				$getprimarysubjects = array($language, $socity, $math, $science, $music, $art, $sport);
				$getprimarypapers = array($primarypaper1, $primarypaper2, $primarypaper3);
				$getspecialpapers = array($specialpaper1, $specialpaper2, $specialpaper3, $specialpaper4, $specialpaper5, $specialpaper6, $specialpaper7, $specialpaper8, $specialpaper9, $specialpaper10);

				$sno = 1;
				$output .= '<div class="content">
								<div class="row">
									<div class="column">
										<p style="margin: 0;font-size: 20px;">クアラルンプール日本人学校　小学部</p>
									</div>
								</div>
						
								<div class="row">
									<div class="column1" style="width:10%;">
										<div style="margin-top:20px;">
											<p style="margin-left:20px;font-size:20px;">' . $stuclass .  '年生</p>
										</div>
						
									</div>
									<div class="column1" style="width:10%;">
						
										<div style="margin-top:20px;">
											<p style="margin-left:20px;font-size:20px;"> 1学期</p>
										</div>
						
									</div>
									<div class="column1" style="width:5%;">
										<div style="margin-top:20px;">
											<p style="margin-left:20px;font-size:20px;">通知表</p>
										</div>
									</div>
									<div class="column1" style="margin-left:37px;width:15%;">
										<table>
											<thead>
											</thead>
											<tbody>
												<tr>
													<td style="vertical-align: middle;border-right:hidden;font-size:20px; height: 60px;width:7%;"> ' . $section['data']['name'] . '</td>
													<td style="text-align: right;font-size:20px; vertical-align: bottom; height: 60px;width:7%;"> 組</td>
													<td style="vertical-align: middle;border-right:hidden;font-size:20px; height: 60px;width:7%;"> ' . $attendance_no . '</td>
													<td style="text-align: right;font-size:20px; vertical-align: bottom; height: 60px;width:7%;"> 番</td>
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
													<td style="vertical-align: top; text-align: left; border-right:hidden;height: 60px;">氏<br>名</td>
													<td style="vertical-align: inherit;text-align:center; height: 60px;font-size:20px;">' . $stu['name'] . '</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
						
								<div class="row" style="margin-top:-25px;line-height:70%;">
									<div class="column2" style="width:50%;">
										<table style="border-collapse: collapse; margin-bottom: 15px; border: 2px solid black;">
											<thead class="colspanHead">
												<tr>
													<td colspan="2" style="border: 2px solid black; border-right:hidden;">学 習 の 記 録</td>
													<td colspan="3" style="border: 2px solid black;">
														<ul style="list-style-type: none; padding: 0; margin: 0; text-align:left;">
															<li style="margin-left: 10px;font-size:14px;">(A　よくできる)</li>
															<li style="margin-left: 10px;font-size:14px;">(B　できる)</li>
															<li style="margin-left: 10px;font-size:14px;">(C　がんばろう)</li>
														</ul>
													</td>
												</tr>
												<tr style="border-bottom: 2px solid black;">
													<td style="width:2%;font-size:16px;">教<br>科</td>
													<td style="width:15%;font-size:16px;">観点別学習状況</td>
													<td style="width:2%;font-size:16px;">1学期</td>
													<td style="width:2%;font-size:16px;">2学期</td>
													<td style="width:2%;font-size:16px;">3学期</td>
												</tr>
											</thead>
											<tbody>';
				$p = 0;
				foreach ($getprimarysubjects as $subject) {

					$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $getprimarypapers, $subject);
					$i = 0;

					foreach ($getmarks['data'] as $papers) {
						$i++;
						$output .= ' <tr>';
						if ($i == 1) {
							$output .= '<td rowspan="3" style="width:2%; height: 25px; writing-mode: vertical-rl; font-family: IPAG;">';
							$subject_chars = preg_split('//u', $subject, null, PREG_SPLIT_NO_EMPTY);
							foreach ($subject_chars as $char) {
								$output .= '<span style="display: inline-block; transform: rotate(0deg);">' . $char . '</span><br>';
							}
							$output .= '</td>';
						}
						$output .= '<td style="width:15%; text-align:left; height: 25px;">' . $papers['papers'] . '</td>';

						foreach ($papers['marks'] as $mark) {

							$mark = (isset($mark['grade']) && $mark['grade'] != null) ? $mark['grade'] : '';

							$output .= '<td style="width:2%;  height: 25px;font-size:14px;">' . $mark . '</td>';
						}
						$output .= ' </tr>';
						//dd($subject);
					}
					$p++;
				}
				$output .= '</tbody>
										</table>';
				$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $description, $specialsubject6);

				$i = 0;
				$flmark = '';
				foreach ($getmarks['data'] as $papers) {
					$nsem = count($papers['marks']);
					$s = 0;
					if (!empty($papers['marks'])) {
						foreach ($papers['marks'] as $mark) {
							$s++;
							// if ($s == $nsem) {

							// 	$flmark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
							// }

							// Check if the mark item is an array and contains 'freetext'
							if (is_array($mark) && isset($mark['freetext']) && $mark['freetext'] != null) {
								$flmark = $mark['freetext'];
							}
							// Ensure that only the last semester's grade is used
							if ($s == $nsem) {
								break;
							}
						}
					}
				}
				$output .= '<!-- Second table and additional content... -->
										<table class="table table-bordered" style="border: 2px solid black;margin-top:35px;">
											<thead class="colspanHead">
												<tr>
													<td colspan="5">外 国 語 活 動　(3学期に記載)</td>
												</tr>
											</thead>
											<tbody>
												<tr style="border-top: 2px solid black;">
													<td colspan="5" style="height:160px;text-align:left;vertical-align: top;word-wrap: break-word;">';
				$comment = explode("\n", $flmark);
				foreach ($comment as $cmt) {
					$output .= $cmt . '<br>';
				}
				$output .= '</td>
												</tr>
											</tbody>
										</table>
						
										<!-- Third table and additional content... -->
										<table class="table table-bordered table-responsive" style="border: 2px solid black;margin-top:45px;">
											<thead class="colspanHead">
												<tr>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;height: 40px;">出欠の記録</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;height: 40px;">授業<br>日数</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;font-size:10px;height: 40px;">出席停止<br>忌引き等</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;font-size:10px;height: 40px;">出席しなければ<br>ならない日<br>数</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;height: 40px;">欠席<br>日数</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;height: 40px;">出席<br>日数</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;height: 40px;">遅刻</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;height: 40px;">早退</th>
												</tr>
											</thead>
											<tbody style="border: 1px solid black;">';
				$attarray = array('', '1月', ' 2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月');
				$getattendance = $this->commonHelper->getSemStudentAttendance($request, $stu);
				//dd($getattendance);
				$at_tot1 = 0;
				$at_tot2 = 0;
				$at_tot3 = 0;
				$at_tot4 = 0;
				$at_tot5 = 0;
				$at_tot6 = 0;
				$at_tot7 = 0;
				foreach ($getattendance['data'] as $att) {
					if($att['no_schooldays']==0)
					{
						$output .= '<tr>
						<td style="height: 32px;">' . $attarray[intval($att['month'])] . '</td>
						<td style="height: 32px;"> </td>
						<td style="height: 32px;"> </td>
						<td style="height: 32px;"> </td>
						<td style="height: 32px;"> </td>
						<td style="height: 32px;"> </td>
						<td style="height: 32px;"> </td>
						<td style="height: 32px;"> </td>
						</tr>';
					}
					else
					{
					$at_tot1 += $att['no_schooldays'];
					$at_tot2 += $att['suspension'];
					$at_tot3 += $att['totalcoming'];
					$at_tot4 += $att['totabs'];
					$at_tot5 += $att['totpres'];
					$at_tot6 += $att['totlate'];
					$at_tot7 += $att['totexc'];
					$output .= '<tr>
							<td style="height: 30px;">' . $attarray[intval($att['month'])] . '</td>
							<td style="height: 30px;">' . $att['no_schooldays'] . '</td>
							<td style="height: 30px;">' . $att['suspension'] . '</td>
							<td style="height: 30px;">' . $att['totalcoming'] . '</td>
							<td style="height: 30px;">' . $att['totabs'] . '</td>
							<td style="height: 30px;">' . $att['totpres'] . '</td>
							<td style="height: 30px;">' . $att['totlate'] . '</td>
							<td style="height: 30px;">' . $att['totexc'] . '</td>
						</tr>';
					}
				}
				$output .= '<tr style="border-top: 2px solid black;">
											<td style="height: 35px;"> 合計</td>
											<td style="height: 35px;">' . $at_tot1 . '</td>
											<td style="height: 35px;">' . $at_tot2 . '</td>
											<td style="height: 35px;">' . $at_tot3 . '</td>
											<td style="height: 35px;">' . $at_tot4 . '</td>
											<td style="height: 35px;">' . $at_tot5 . '</td>
											<td style="height: 35px;">' . $at_tot6 . '</td>
											<td style="height: 35px;">' . $at_tot7 . '</td>
										</tr>';
				$output .= '</tbody>
										</table>
									</div>
									<div class="column2" style="width:1%;">
									</div>
									<div class="column2" style="width:44%;">
										<table class="table table-bordered" style="border: 2px solid black;">
											<thead class="colspanHead">
												<tr>
													<td colspan="2" style="text-align:center; border: 1px solid black; vertical-align: middle; height: 63px;border-right:hidden;">
														行動及び生活の記録</td>
													<td colspan="3" style="border: 1px solid black; height: 30px;">
														<ul style="list-style-type: none; padding: 0; margin: 0;text-align:left;">
															<li style="margin-left: 60px;font-size:14px;">（3学期に記載）</li>
															<li style="margin-left: 60px;"></li>
															<li style="margin-left: 60px;font-size:14px;">（○すぐれている）</li>
														</ul>
													</td>
												</tr>
											</thead>';
				$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $getspecialpapers, $specialsubject1);
				$output .= '<tbody>';

				foreach ($getmarks['data'] as $papers) {
					$nsem = count($papers['marks']);
					$s = 0;
					$mark = '';
					if (!empty($papers['marks'])) {
						foreach ($papers['marks'] as $markItem) {
							$s++;
							// Check if the mark item is an array and contains 'grade_name'
							if (is_array($markItem) && isset($markItem['grade_name']) && $markItem['grade_name'] != null) {
								$mark = $markItem['grade_name'];
							}
							// Ensure that only the last semester's grade is used
							if ($s == $nsem) {
								break;
							}
						}
					}
					$fmark = ($mark == "Excellent") ? '○' : '';
					$output .= '<tr style="height:60px;">
											<td colspan="4" style="text-align:left;width:92%;">' . $papers['papers'] . '</td>
										<td colspan="1" style="width:8%;">' . $fmark . '</td>
											</tr>';
				}
				$output .= '</tbody>
										</table>';
				$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $description, $specialsubject2);
				$i = 0;
				$mark1 = '';
				foreach ($getmarks['data'] as $papers) {
					$nsem = count($papers['marks']);
					$s = 0;
					if (!empty($papers['marks'])) {
						foreach ($papers['marks'] as $mark) {
							$s++;
							// Check if the mark item is an array and contains 'freetext'
							if (is_array($mark) && isset($mark['freetext']) && $mark['freetext'] != null) {
								$mark1 = $mark['freetext'];
							}
							// Ensure that only the last semester's grade is used
							if ($s == $nsem) {
								break;
							}
						}
					}
				}
				$output .= '<table class="table table-bordered" style="border: 2px solid black;margin-top:20px;">
											<thead class="colspanHead">
												<tr>
													<td colspan="5">特別の教科　道徳　(3学期に記載)</td>
												</tr>
											</thead>
											<tbody>
												<tr style="border-top: 2px solid black;">
													<td colspan="5" style="height:170px;text-align:left;vertical-align: top;word-wrap: break-word;">';
				$comment = explode("\n", $mark1);
				foreach ($comment as $cmt) {
					$output .= $cmt . '<br>';
				}
				$output .= '</td>
												</tr>
											</tbody>
										</table>';
				$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $description, $specialsubject5);
				$i = 0;
				$mark2 = '';
				foreach ($getmarks['data'] as $papers) {
					$nsem = count($papers['marks']);
					$s = 0;
					if (!empty($papers['marks'])) {
						foreach ($papers['marks'] as $mark) {
							$s++;
							// Check if the mark item is an array and contains 'freetext'
							if (is_array($mark) && isset($mark['freetext']) && $mark['freetext'] != null) {
								$mark2 = $mark['freetext'];
							}
							// Ensure that only the last semester's grade is used
							if ($s == $nsem) {
								break;
							}
						}
					}
				}
				$output .= '<table class="table table-bordered" style="border: 2px solid black;margin-top:20px;">
											<thead class="colspanHead">
												<tr>
													<td colspan="5">総合的な学習の時間　(2学期に記載)</td>
												</tr>

											</thead>
											<tbody>
												<tr style="border-top: 1px solid black;">
													<td colspan="5" style="height:170px;text-align:left;vertical-align: top;word-wrap: break-word;">';
				$comment = explode("\n", $mark2);
				foreach ($comment as $cmt) {
					$output .= $cmt . '<br>';
				}
				$output .= '</td>
												</tr>
											</tbody>
										</table>';
				$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $description, $specialsubject3);
				$i = 0;
				$mark4 = '';
				foreach ($getmarks['data'] as $papers) {
					$nsem = count($papers['marks']);
					$s = 0;
					if (!empty($papers['marks'])) {
						foreach ($papers['marks'] as $mark) {
							// Check if the mark item is an array and contains 'freetext'
							if (is_array($mark) && isset($mark['freetext']) && $mark['freetext'] != null) {
								$mark4 = $mark['freetext'];
								// $mark4 .= $s . ' 学期 - ' . $mark . '<br>';
							}
							// Ensure that only the last semester's grade is used
							if ($s == $nsem) {
								break;
							}
						}
					}
				}
				$output .= '<table class="table table-bordered" style="border: 2px solid black;margin-top:20px;">
											<thead class="colspanHead">
												<tr>
													<td colspan="5">特 別 活 動 等 の 記 録　(毎学期記載)</td>
												</tr>
											</thead>
											<tbody>
												<tr style="border-top: 2px solid black;">
													<td colspan="5" style="height:170px;text-align:left;vertical-align: top;word-wrap: break-word;">';
				$comment = explode("\n", $mark4);
				foreach ($comment as $cmt) {
					$output .= $cmt . '<br>';
				}
				$output .= '</td>
												</tr>
											</tbody>
										</table>';
				$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $description, $specialsubject4);

				$i = 0;
				$mark5 = '';
				foreach ($getmarks['data'] as $papers) {
					$nsem = count($papers['marks']);
					$s = 0;
					if (!empty($papers['marks'])) {
						foreach ($papers['marks'] as $mark) {
							$s++;
							// Check if the mark item is an array and contains 'freetext'
							if (is_array($mark) && isset($mark['freetext']) && $mark['freetext'] != null) {
								$mark5 = $mark['freetext'];
							}
							// Ensure that only the last semester's grade is used
							if ($s == $nsem) {
								break;
							}
						}
					}
				}
				$output .= '<table class="table table-bordered" style="border: 2px solid black;margin-top:20px;">
											<thead class="colspanHead">
												<tr>
													<td colspan="5"> 所見　（3学期に記載）</td>
												</tr>
											</thead>
											<tbody>
												<tr style="border-top: 2px solid black;">
													<td colspan="5" style="height:170px;text-align:left;vertical-align: top;word-wrap: break-word;">';
				$comment = explode("\n", $mark5);
				foreach ($comment as $cmt) {
					$output .= $cmt . '<br>';
				}
				$output .= '</td>
												</tr>
											</tbody>
										</table>
						
										<div style="display: flex; flex-wrap: wrap;">
											<div style="width: 100%; box-sizing: border-box;">
												<p style="text-align: right; margin-top:4px;marign-bottom:25px;font-size:14px;">※1，2学期の内容は、三者懇談でお伝えさせていただきます。</p>
											</div>
										</div>
						
				<div style="width:100%;margin-top:17px;">
                    <table style="margin-top: 12px; width: 100%;">
                        <thead>
                            <!-- Your content here -->
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="1" style="text-align: left; height: 40px; width:5%;border: 2px solid black;">
                                    校<br>長
                                </td>
                                <td colspan="1" style="text-align: left; height: 40px; border: 2px solid black;">
                                   ' . $getteacherdata['data']['principal'] . '
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1" style="text-align: left; height: 40px; width:5%;border: 2px solid black;">
                                    担<br>任
                                </td>
                                <td colspan="1" style="text-align: left; height: 40px; border: 2px solid black;">
                                    ' . $getteacherdata['data']['teacher'] . '
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
				// set size
				$customPaper = array(0, 0, 792.00, 1300.00);
				$now = now();
				$name = strtotime($now);
				$fileName = __('messages.report_card') . "_" . $number . "_" . $stu['name'] . "_" . $name . ".pdf";
			}
			if ($stuclass == 5 || $stuclass == 6) {
				$sno = 1;
				// here i put subjects and paper details
				$getprimarysubjects = array($language, $socity, $math, $science, $music, $art, $homeeconomics, $sport, $foreignlanguage);
				$getprimarypapers = array($primarypaper1, $primarypaper2, $primarypaper3);
				$getspecialpapers = array($specialpaper1, $specialpaper2, $specialpaper3, $specialpaper4, $specialpaper5, $specialpaper6, $specialpaper7, $specialpaper8, $specialpaper9, $specialpaper10);
				$output .= '<div class="content">
								<div class="row">
									<div class="column">
										<p style="margin: 0;font-size:20px;">クアラルンプール日本人学校　小学部</p>
									</div>
								</div>
						
								<div class="row">
									<div class="column1" style="width:10%;">
										<div style="margin-top:20px;">
											<p style="margin-left:20px;font-size:20px;">' . $stuclass .  '年生</p>
										</div>
						
									</div>
									<div class="column1" style="width:10%;">
						
										<div style="margin-top:20px;">
											<p style="margin-left:20px;font-size:20px;"> 1学期</p>
										</div>
						
									</div>
									<div class="column1" style="width:5%;">
										<div style="margin-top:20px;">
											<p style="margin-left:20px;font-size:20px;">通知表</p>
										</div>
									</div>
									<div class="column1" style="margin-left:37px;width:15%;">
										<table>
											<thead>
											</thead>
											<tbody>
												<tr>
													<td style="vertical-align: middle;border-right:hidden;font-size:20px; height: 60px;width:7%;"> ' . $section['data']['name'] . '</td>
													<td style="text-align: right;font-size:20px; vertical-align: bottom; height: 60px;width:7%;"> 組</td>
													<td style="vertical-align: middle;border-right:hidden;font-size:20px; height: 60px;width:7%;"> ' . $attendance_no . '</td>
													<td style="text-align: right;font-size:20px; vertical-align: bottom; height: 60px;width:7%;"> 番</td>
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
													<td style="margin: 0px;vertical-align: top;text-align: left; border-right:hidden;height: 60px;">氏<br>名</td>
													<td style="vertical-align: inherit;font-size:20px;text-align:center; height: 60px;">' . $stu['name'] . '</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
						
								<div class="row" style="margin-top:-25px;">
									<div class="column2" style="width:50%;">
										<table style="border-collapse: collapse; margin-bottom: 0px; border: 2px solid black;">
											<thead class="colspanHead">
												<tr>
													<td colspan="2" style="border: 2px solid black; border-right:hidden; height: 35px;font-size:16px;">学 習 の 記 録</td>
													<td colspan="3" style="border: 2px solid black; height: 35px;">
														<ul style="list-style-type: none; padding: 0; margin: 0; text-align:left;">
															<li style="margin-left: 10px;font-size:14px;">(A　よくできる)</li>
															<li style="margin-left: 10px;font-size:14px;">(B　できる)</li>
															<li style="margin-left: 10px;font-size:14px;">(C　がんばろう)</li>
														</ul>
													</td>
												</tr>
												<tr style="border-bottom: 2px solid black;">
													<td style="width:2%; height: 31px;font-size:16px;">教<br>科</td>
													<td style="width:15%; height: 31px;font-size:16px;">観点別学習状況</td>
													<td style="width:2%; height: 31px;font-size:16px;">1学期</td>
													<td style="width:2%; height: 31px;font-size:16px;">2学期</td>
													<td style="width:2%; height: 31px;font-size:16px;">3学期</td>
												</tr>
											</thead>
											<tbody>';
				$p = 0;
				foreach ($getprimarysubjects as $subject) {
					$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $getprimarypapers, $subject);


					$i = 0;

					foreach ($getmarks['data'] as $papers) {
						$i++;
						$output .= ' <tr>';
						if ($i == 1) {
							$output .= '<td rowspan="3" style="width:2%; height: 30px; writing-mode: vertical-rl; font-family: IPAG;">';
							$subject_chars = preg_split('//u', $subject, null, PREG_SPLIT_NO_EMPTY);
							foreach ($subject_chars as $char) {
								$output .= '<span style="display: inline-block; transform: rotate(0deg);">' . $char . '</span><br>';
							}
							$output .= '</td>';
						}
						$output .= '<td style="width:15%; text-align:left; height: 30px;">' . $papers['papers'] . '</td>';

						foreach ($papers['marks'] as $mark) {

							$mark = (isset($mark['grade']) && $mark['grade'] != null) ? $mark['grade'] : '';

							$output .= '<td style="width:2%;  height: 30px;font-size:14px;">' . $mark . '</td>';
						}
						$output .= ' </tr>';
						//dd($subject);
					}
					$p++;
				}
				$output .= '</tbody>
										</table>
						
										<!-- Second table and additional content... -->
										<table class="table table-bordered table-responsive" style="border: 2px solid black;margin-top:48px;height:25%;">
											<thead class="colspanHead">
												<tr>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;height:55px;">出欠の<br>記録</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;height:55px;">授業<br>日数</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;height:55px;">出席停止<br>忌引き等</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;height:55px;">出席しなけれ<br>ば<br>ならない日数</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;height:55px;">欠席<br>日数</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;height:55px;">出席<br>日数</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;height:55px;">遅刻</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;height:55px;">早退</th>
												</tr>
											</thead>
											<tbody style="border: 1px solid black;">';

				$attarray = array('', '1月', ' 2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月');
				$getattendance = $this->commonHelper->getSemStudentAttendance($request, $stu);
				//dd($getattendance);
				$at_tot1 = 0;
				$at_tot2 = 0;
				$at_tot3 = 0;
				$at_tot4 = 0;
				$at_tot5 = 0;
				$at_tot6 = 0;
				$at_tot7 = 0;
				foreach ($getattendance['data'] as $att) {
					if($att['no_schooldays']==0)
					{
						$output .= '<tr>
						<td style="height: 32px;">' . $attarray[intval($att['month'])] . '</td>
						<td style="height: 32px;"> </td>
						<td style="height: 32px;"> </td>
						<td style="height: 32px;"> </td>
						<td style="height: 32px;"> </td>
						<td style="height: 32px;"> </td>
						<td style="height: 32px;"> </td>
						<td style="height: 32px;"> </td>
						</tr>';
					}
					else
					{
					$at_tot1 += $att['no_schooldays'];
					$at_tot2 += $att['suspension'];
					$at_tot3 += $att['totalcoming'];
					$at_tot4 += $att['totabs'];
					$at_tot5 += $att['totpres'];
					$at_tot6 += $att['totlate'];
					$at_tot7 += $att['totexc'];
					$output .= '<tr>
							<td style="height: 28px;">' . $attarray[intval($att['month'])] . '</td>
							<td style="height: 28px;">' . $att['no_schooldays'] . '</td>
							<td style="height: 28px;">' . $att['suspension'] . '</td>
							<td style="height: 28px;">' . $att['totalcoming'] . '</td>
							<td style="height: 28px;">' . $att['totabs'] . '</td>
							<td style="height: 28px;">' . $att['totpres'] . '</td>
							<td style="height: 28px;">' . $att['totlate'] . '</td>
							<td style="height: 28px;">' . $att['totexc'] . '</td>
						</tr>';
					}
				}
				$output .= '<tr style="border-top: 2px solid black;">
											<td style="height: 35px;"> 合計</td>
											<td style="height: 35px;">' . $at_tot1 . '</td>
											<td style="height: 35px;">' . $at_tot2 . '</td>
											<td style="height: 35px;">' . $at_tot3 . '</td>
											<td style="height: 35px;">' . $at_tot4 . '</td>
											<td style="height: 35px;">' . $at_tot5 . '</td>
											<td style="height: 35px;">' . $at_tot6 . '</td>
											<td style="height: 35px;">' . $at_tot7 . '</td>
										</tr>';


				$output .= '</tbody>
										</table>
									</div>
						
									<div class="column2" style="width:1%;">
									</div>
									<div class="column2" style="width:44%;">';
				$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $getspecialpapers, $specialsubject1);

				$output .= '<table class="table table-bordered" style="height: 10px;border: 2px solid black;">
											<thead class="colspanHead">
												<tr>
													<td colspan="2" style="text-align:center; border: 1px solid black; vertical-align: middle; height: 55px;border-right:hidden;font-size:16px;">
														行動及び生活の記録</td>
													<td colspan="3" style="border: 1px solid black; height: 65px;">
														<ul style="list-style-type: none; padding: 0; margin: 0;text-align:left;">
															<li style="margin-left: 70px;font-size:14px;">（3学期に記載）</li>
															<li style="margin-left: 70px;"></li>
															<li style="margin-left: 70px;font-size:14px;">（○すぐれている）</li>
														</ul>
													</td>
												</tr>
											</thead>
						
											<tbody>';

				foreach ($getmarks['data'] as $papers) {
					$nsem = count($papers['marks']);
					$s = 0;
					$mark = '';
					if (!empty($papers['marks'])) {
						foreach ($papers['marks'] as $markItem) {
							$s++;
							// Check if the mark item is an array and contains 'grade_name'
							if (is_array($markItem) && isset($markItem['grade_name']) && $markItem['grade_name'] != null) {
								$mark = $markItem['grade_name'];
							}
							// Ensure that only the last semester's grade is used
							if ($s == $nsem) {
								break;
							}
						}
					}
					$fmark = ($mark == "Excellent") ? '○' : '';
					$output .= '<tr style="height:40px;">
											<td colspan="4" style="height:40px;text-align:left;width:92%;">' . $papers['papers'] . '</td>
										<td colspan="1" style="width:8%;">' . $fmark . '</td>
											</tr>';
				}

				$output .= '</tbody>
										</table>';
				$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $description, $specialsubject2);
				$i = 0;
				$mark1 = '';
				foreach ($getmarks['data'] as $papers) {
					$nsem = count($papers['marks']);
					$s = 0;
					if (!empty($papers['marks'])) {
						foreach ($papers['marks'] as $mark) {
							$s++;
							// Check if the mark item is an array and contains 'freetext'
							if (is_array($mark) && isset($mark['freetext']) && $mark['freetext'] != null) {
								$mark1 = $mark['freetext'];
							}
							// Ensure that only the last semester's grade is used
							if ($s == $nsem) {
								break;
							}
							// if ($s == $nsem) {

							// 	$mark1 = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
							// }
						}
					}
				}
				$output .= '<table class="table table-bordered" style="border: 2px solid black;margin-top:25px;">
											<thead class="colspanHead">
												<tr>
													<td colspan="5" style="font-size:16px;">特別の教科　道徳　(3学期に記載)</td>
												</tr>
											</thead>
											<tbody>
												<tr style="border-top: 2px solid black;">
													<td colspan="5" style="height:150px;text-align:left;vertical-align: top;word-wrap: break-word;">';
				$comment = explode("\n", $mark1);
				foreach ($comment as $cmt) {
					$output .= $cmt . '<br>';
				}
				$output .= '</td>
												</tr>
											</tbody>
										</table>';
				$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $description, $specialsubject5);
				$i = 0;

				$mark2 = '';
				foreach ($getmarks['data'] as $papers) {
					$nsem = count($papers['marks']);
					$s = 0;
					if (!empty($papers['marks'])) {
						foreach ($papers['marks'] as $mark) {
							$s++;
							// Check if the mark item is an array and contains 'freetext'
							if (is_array($mark) && isset($mark['freetext']) && $mark['freetext'] != null) {
								$mark2 = $mark['freetext'];
							}
							// Ensure that only the last semester's grade is used
							if ($s == $nsem) {
								break;
							}
						}
					}
				}
				$output .= '<table class="table table-bordered" style="border: 2px solid black;margin-top:25px;">
											<thead class="colspanHead">
												<tr>
													<td colspan="5" style="font-size:16px;">総合的な学習の時間　(2学期に記載)</td>
												</tr>
											</thead>
											<tbody>
												<tr style="border-top: 1px solid black;">
													<td colspan="5" style="height:150px;text-align:left;vertical-align: top;word-wrap: break-word;">';
				$comment = explode("\n", $mark2);
				foreach ($comment as $cmt) {
					$output .= $cmt . '<br>';
				}
				$output .= '</td>
												</tr>
											</tbody>
										</table>';
				$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $description, $specialsubject3);

				$i = 0;
				$mark3 = '';
				foreach ($getmarks['data'] as $papers) {
					$nsem = count($papers['marks']);
					$s = 0;
					if (!empty($papers['marks'])) {
						foreach ($papers['marks'] as $mark) {
							$s++;

							if (is_array($mark) && isset($mark['freetext']) && $mark['freetext'] != null) {
								$mark3 = $mark['freetext'];
								// $mark3 .= $s . ' 学期 - ' . $mark . '<br>';
							}
							// Ensure that only the last semester's grade is used
							if ($s == $nsem) {
								break;
							}
						}
					}
				}
				$output .= '<table class="table table-bordered" style="border: 2px solid black;margin-top:24px;">
											<thead class="colspanHead">
												<tr>
													<td colspan="5" style="font-size:16px;">特 別 活 動 等 の 記 録 （毎学期記載）</td>
												</tr>
											</thead>
											<tbody>
												<tr style="border-top: 2px solid black;">
													<td colspan="5" style="height:150px;text-align:left;vertical-align: top;word-wrap: break-word;">';
				$comment = explode("\n", $mark3);
				foreach ($comment as $cmt) {
					$output .= $cmt . '<br>';
				}
				$output .= '</td>
												</tr>
											</tbody>
										</table>';
				$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $description, $specialsubject4);
				$i = 0;
				$mark4 = '';
				foreach ($getmarks['data'] as $papers) {
					$nsem = count($papers['marks']);
					$s = 0;
					if (!empty($papers['marks'])) {
						foreach ($papers['marks'] as $mark) {
							$s++;
							if (is_array($mark) && isset($mark['freetext']) && $mark['freetext'] != null) {
								$mark4 = $mark['freetext'];
							}
							// Ensure that only the last semester's grade is used
							if ($s == $nsem) {
								break;
							}
						}
					}
				}
				$output .= '<table class="table table-bordered" style="border: 2px solid black;margin-top:24px;">
											<thead class="colspanHead">
												<tr>
													<td colspan="5" style="font-size:16px;">所見　(3学期に記載)</td>
												</tr>
											</thead>
											<tbody>
												<tr style="border-top: 2px solid black;">
													<td colspan="5" style="height:187px;text-align:left;vertical-align: top;word-wrap: break-word;">';
				$comment = explode("\n", $mark4);
				foreach ($comment as $cmt) {
					$output .= $cmt . '<br>';
				}
				$output .= '</td>
												</tr>
											</tbody>
										</table>
						
										<div style="display: flex; flex-wrap: wrap;">
											<div style="width: 100%; box-sizing: border-box;">
												<p style="text-align: right; margin-top:0px;marign-bottom:20px;font-size:14px;">※1，2学期の内容は、三者懇談でお伝えさせていただきます。</p>
											</div>
										</div>
						

				<div style="width:100%;margin-top:14px;">
                    <table style="margin-top: 12px; width: 100%;">
                        <thead>
                            <!-- Your content here -->
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="1" style="text-align: left; height: 40px; width:5%;border: 2px solid black;">
                                    校<br>長
                                </td>
                                <td colspan="1" style="text-align: left; height: 40px; border: 2px solid black;">
                                   ' . $getteacherdata['data']['principal'] . '
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1" style="text-align: left; height: 40px; width:5%;border: 2px solid black;">
                                    担<br>任
                                </td>
                                <td colspan="1" style="text-align: left; height: 40px; border: 2px solid black;">
                                    ' . $getteacherdata['data']['teacher'] . '
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
									</div>
								</div>
							</div>';
				// set size
				$customPaper = array(0, 0, 792.00, 1330.00);
				// filename
				$now = now();
				$name = strtotime($now);
				$fileName = __('messages.report_card') . "_" . $number . "_" . $stu['name'] . "_" . $name . ".pdf";
				// return $pdf->stream();
			}
		} elseif ($request->department_id == 2) // Secondary 
		{
			$sno = 1;
			// here i put subjects and paper details
			$secspecialsubject1 = '基本的な生活習慣';
			$secspecialsubject2 = '健康・体力の向上';
			$secspecialsubject3 = '自主・自律';
			$secspecialsubject4 = '責任感';
			$secspecialsubject5 = '創意工夫';
			$secspecialsubject6 = '思いやり・協力';
			$secspecialsubject7 = '生命尊重・自然愛護';

			$secspecialsubject8 = '勤労・奉仕';
			$secspecialsubject9 = '公正・公平';
			$secspecialsubject10 = '公共心・公徳心';
			// $getprimarysubjects = array($language,$math,$life,$music,$art,$sport);
			$getprimarysubjects = array($language, $socity, $secondary_math, $science, $music, $secondary_arts, $secondary_sports, $tech_homeeconomics, $english);
			$getprimarypapers = array($primarypaper1, $primarypaper2, $primarypaper3, $primarypaper4);
			$getspecialpapers = array($secspecialsubject1, $secspecialsubject2, $secspecialsubject3, $secspecialsubject4, $secspecialsubject5, $secspecialsubject6, $secspecialsubject7, $secspecialsubject8, $secspecialsubject9, $secspecialsubject10);
			$getspsubject1 = array($specialsubject1); // Records of actions and life- Excellent Report & only 3rd Semester                
			$getspsubject2 = array($specialsubject2); // Special Subject: Morality ( 3rd Semester)              
			$getspsubject3 = array($specialsubject3); // Records of special activities, etc (All Semester )
			$getspsubject4 = array($specialsubject4); // Findings  ( 3rd Semester) 
			$getspsubject5 = array(); // Hours of integrated study (2nd Semester)
			$getspsubject6 = array(); // Foreign Language Activities  ( 3rd Semester) 
			$output .= '<div class="content">
					<div class="row">
					<div class="column">
					<p style="margin: 0;font-size:20px;">クアラルンプール日本人学校　中学部</p>
					</div>
					</div>
					
					<div class="row">
					<div class="column1" style="width:10%;">
					<div style="margin-top:20px;">
					<p style="margin: 0;font-size:20px;">' . $stuclass .  '年生</p>
					</div>
					
					</div>
					<div class="column1" style="width:10%;">
					
					<div style="margin-top:20px;">
					<p style="margin: 0;font-size:20px;"> 1学期</p>
					</div>
					
					</div>
					<div class="column1" style="width:5%;">
					<div style="margin-top:20px;">
					<p style="margin: 0;font-size:20px;">通知表</p>
					</div>
					</div>
				
					<div class="column1" style="width:24%;">
					<table>
					<thead>
					</thead>
					<tbody>
					<tr>
					<td style="vertical-align: middle;border-right:hidden;font-size:20px; height: 60px;"> ' . $section['data']['name'] . '</td>
													<td style="text-align: right;font-size:20px; vertical-align: bottom; height: 60px;"> 組</td>
													<td style="vertical-align: middle;border-right:hidden;font-size:20px; height: 60px;"> ' . $attendance_no . '</td>
													<td style="text-align: right;font-size:20px; vertical-align: bottom; height: 60px;"> 番</td>
					</tr>
					
					</tbody>
					</table>
					</div>
					<div class="column1" style="width:1%;">
					</div>
					<div class="column1" style="width:39%;">
					<table>
					<thead>
					</thead>
					<tbody>
					<tr>
					<td style="vertical-align: top; text-align: left; border-right:hidden;height: 60px;">氏名</td>
					<td style="vertical-align: inherit;text-align:center; height: 60px;">' . $stu['name'] . '</td>
					</tr>
					</tbody>
					</table>
					</div>
					</div>
					
					<div class="row" style="margin-top:-25px;line-height:50%;">
					<div class="column2" style="width:55%;">
					<table style="border-collapse: collapse; margin-bottom: 5px; border: 2px solid black;">
					<thead class="colspanHead">
					<tr>
					<td colspan="2" style="border: 2px solid black; border-right:hidden;">学習の記録 <span style="margin-left: 30px;">観点評価</span></td>
					<td colspan="6" style="border: 2px solid black;">
					<ul style="list-style-type: none; padding: 0; margin: 0; text-align:left;">
					<li style="margin-left: 10px;font-size:14px;">（A目標を十分達成したもの）</li>
					<li style="margin-left: 10px;font-size:14px;">（Bおおむね達成したもの）</li>
					<li style="margin-left: 10px;font-size:14px;">（C達成が不十分なもの）</li>
					</ul>
					</td>
					</tr>
					<tr>
					<td rowspan="2">教<br>科</td>
					<td rowspan="2" style="width:15%;">観点別学習状況</td>
					<td colspan="2" style="width:2%;">1学期</td>
					<td colspan="2" style="width:2%;">2学期</td>
					<td colspan="2" style="width:2%;">学年末</td>
					</tr>
					<tr style="border-bottom: 2px solid black;">
					<td>観点</td>
					<td>評定</td>
					<td>観点</td>
					<td>評定</td>
					<td>観点</td>
					<td>評定</td>
					</tr>
					</thead>
					<tbody>';
			$p = 0;
			foreach ($getprimarysubjects as $subject) {

				$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $getprimarypapers, $subject);



				$i = 0;

				foreach ($getmarks['data'] as $papers) {
					$i++;
					if ($i <= 3) {
						$output .= ' <tr>';
						if ($i == 1) {
							$output .= '<td rowspan="3" style="width:2%; height: 30px; writing-mode: vertical-rl; font-family: IPAG;">';
							$subject_chars = preg_split('//u', $subject, null, PREG_SPLIT_NO_EMPTY);
							foreach ($subject_chars as $char) {
								$output .= '<span style="display: inline-block; transform: rotate(0deg);">' . $char . '</span><br>';
							}
							$output .= '</td>';
						}
						$output .= '<td style="width:15%; text-align:left; height: 30px;">' . $papers['papers'] . '</td>';
						$k = 0;
						if (!empty($papers['marks'])) {
							foreach ($papers['marks'] as $mark) {

								$mark = (isset($mark['grade']) && $mark['grade'] != null) ? $mark['grade'] : '';

								$output .= '<td style="width:2%;  height: 30px;font-size:14px;">' . $mark . '</td>';
								if ($i == 1) {

									if ($getmarks["data"][3]["marks"][$k] != null) {
										$output .= '<td style="width:2%;  height: 30px;" rowspan="3">' . $getmarks["data"][3]["marks"][$k]['score'] . '</td>';
									} else {
										$output .= '<td style="width:2%;  height: 30px;" rowspan="3"> </td>';
									}
									// $output .= '<td style="width:2%;  height: 30px;" rowspan="3">';
									// $output .= is_array($getmarks["data"][3]["marks"][$k]) ? implode(', ', $getmarks["data"][3]["marks"][$k]) : $getmarks["data"][3]["marks"][$k];
									// $output .= '</td>';

								}
								$k++;
							}
						}
						$output .= ' </tr>';
					}
					//dd($subject);
				}
				$p++;
			}
			$output .= '</tbody>
					</table>
					
					
					
					<!-- Second table and additional content... -->
					<table class="table table-bordered table-responsive" style="border: 2px solid black;height:25%;margin-top:25px;width:100%">
					<thead class="colspanHead">
					<tr>
					<th style="border: 1px solid black; font-weight:italic; text-align: center;height:30px;">出欠の<br>記録</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center;height:30px;">授業<br>日数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center;font-size:12px;height:30px; ">出席停<br>止<br>忌引き等</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center;font-size:12px;height:30px; ">出席しなけれ<br>ばならない日<br>数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center;height:30px;">欠席<br>日数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center;height:30px;">出席<br>日数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center;height:30px;">遅刻</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center;height:30px;">早退</th>
					</tr>
					</thead>
					<tbody style="border: 1px solid black;">';
			$attarray = array('', '1月', ' 2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月');
			$getattendance = $this->commonHelper->getSemStudentAttendance($request, $stu);
			//dd($getattendance);
			$at_tot1 = 0;
			$at_tot2 = 0;
			$at_tot3 = 0;
			$at_tot4 = 0;
			$at_tot5 = 0;
			$at_tot6 = 0;
			$at_tot7 = 0;
			foreach ($getattendance['data'] as $att) {
				if($att['no_schooldays']==0)
				{
					$output .= '<tr>
					<td style="height: 32px;">' . $attarray[intval($att['month'])] . '</td>
					<td style="height: 32px;"> </td>
					<td style="height: 32px;"> </td>
					<td style="height: 32px;"> </td>
					<td style="height: 32px;"> </td>
					<td style="height: 32px;"> </td>
					<td style="height: 32px;"> </td>
					<td style="height: 32px;"> </td>
					</tr>';
				}
				else
				{
				$at_tot1 += $att['no_schooldays'];
				$at_tot2 += $att['suspension'];
				$at_tot3 += $att['totalcoming'];
				$at_tot4 += $att['totabs'];
				$at_tot5 += $att['totpres'];
				$at_tot6 += $att['totlate'];
				$at_tot7 += $att['totexc'];
				$output .= '<tr>
						<td style="height: 27px;">' . $attarray[intval($att['month'])] . '</td>
						<td style="height: 27px;">' . $att['no_schooldays'] . '</td>
						<td style="height: 27px;">' . $att['suspension'] . '</td>
						<td style="height: 27px;">' . $att['totalcoming'] . '</td>
						<td style="height: 27px;">' . $att['totabs'] . '</td>
						<td style="height: 27px;">' . $att['totpres'] . '</td>
						<td style="height: 27px;">' . $att['totlate'] . '</td>
						<td style="height: 27px;">' . $att['totexc'] . '</td>
					</tr>';
				}
			}
			$output .= '<tr style="border-top: 2px solid black;">
					<td style="height: 40px;"> 合計</td>
					<td style="height: 40px;">' . $at_tot1 . '</td>
					<td style="height: 40px;">' . $at_tot2 . '</td>
					<td style="height: 40px;">' . $at_tot3 . '</td>
					<td style="height: 40px;">' . $at_tot4 . '</td>
					<td style="height: 40px;">' . $at_tot5 . '</td>
					<td style="height: 40px;">' . $at_tot6 . '</td>
					<td style="height: 40px;">' . $at_tot7 . '</td>
				</tr>';


			$output .= '</tbody>
					</table>
					
					</div>
					
					<div class="column2" style="width:1%;">
					</div>
					<div class="column2" style="width:39%;">';
			$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $getspecialpapers, $specialsubject1);
			$output .= '<table class="table table-bordered" style="border: 2px solid black;">
					<thead class="colspanHead">
					<tr>
					<td colspan="2" style="text-align:center; border: 1px solid black; vertical-align: middle; height: 63px;border-right:hidden;">
					行動及び生活の記録</td>
					<td colspan="3" style="border: 1px solid black; height: 63px;">
					<ul style="list-style-type: none; padding: 0; margin: 0;text-align:left;">
					<li style="margin-left: 60px;font-size:14px;">（3学期に記載）</li>
					<li style="margin-left: 60px;font-size:14px;"></li>
					<li style="margin-left: 60px;font-size:14px;">（○すぐれている）</li>
					</ul>
					</td>
					</tr>
					</thead>
					
					<tbody>';
			foreach ($getmarks['data'] as $papers) {
				$nsem = count($papers['marks']);
				$s = 0;
				$mark = '';
				if (!empty($papers['marks'])) {
					foreach ($papers['marks'] as $markItem) {
						$s++;
						// Check if the mark item is an array and contains 'grade_name'
						if (is_array($markItem) && isset($markItem['grade_name']) && $markItem['grade_name'] != null) {
							$mark = $markItem['grade_name'];
						}
						// Ensure that only the last semester's grade is used
						if ($s == $nsem) {
							break;
						}
					}
				}
				$fmark = ($mark == "Excellent") ? '○' : '';
				$output .= '<tr style="height:60px;">
					<td colspan="4" style="text-align:left;width:92%;">' . $papers['papers'] . '</td>
					<td colspan="1" style="width:8%;">' . $fmark . '
					</td>
					</tr>';
			}

			$output .= '</tbody>
					</table>';
			$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $description, $specialsubject2);
			$i = 0;
			$mark1 = '';
			foreach ($getmarks['data'] as $papers) {
				$nsem = count($papers['marks']);
				$s = 0;
				if (!empty($papers['marks'])) {
					foreach ($papers['marks'] as $mark) {
						$s++;
						// Check if the mark item is an array and contains 'freetext'
						if (is_array($mark) && isset($mark['freetext']) && $mark['freetext'] != null) {
							$mark1 = $mark['freetext'];
						}
						// Ensure that only the last semester's grade is used
						if ($s == $nsem) {
							break;
						}
					}
				}
			}
			$output .= '<table class="table table-bordered" style="border: 2px solid black;margin-top:20px;">
					<thead class="colspanHead">
					<tr>
					<td colspan="5">特別の教科　道徳　（2学期に記載）</td>
					</tr>
					</thead>
					<tbody>
					<tr style="border-top: 2px solid black;">
					<td colspan="5" style="height:210px;text-align:left;vertical-align: top;word-wrap: break-word;">';
			$comment = explode("\n", $mark1);
			foreach ($comment as $cmt) {
				$output .= $cmt . '<br>';
			}
			$output .= '</td>
					</tr>
					</tbody>
					</table>';
			$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $description, $specialsubject5);
			$i = 0;
			$mark2 = '';
			foreach ($getmarks['data'] as $papers) {
				$nsem = count($papers['marks']);
				$s = 0;
				if (!empty($papers['marks'])) {
					foreach ($papers['marks'] as $mark) {
						$s++;
						// Check if the mark item is an array and contains 'freetext'
						if (is_array($mark) && isset($mark['freetext']) && $mark['freetext'] != null) {
							$mark2 = $mark['freetext'];
						}
						// Ensure that only the last semester's grade is used
						if ($s == $nsem) {
							break;
						}
					}
				}
			}
			$output .= '<table class="table table-bordered" style="border: 2px solid black;margin-top:20px;">
					<thead class="colspanHead">
					<tr>
					<td colspan="5">総合的な学習の時間　（3学期に記載）</td>
					</tr>
					</thead>
					<tbody>
					<tr style="border-top: 1px solid black;">
					<td colspan="5" style="height:210px;text-align:left;vertical-align: top;word-wrap: break-word;">';
			$comment = explode("\n", $mark2);
			foreach ($comment as $cmt) {
				$output .= $cmt . '<br>';
			}
			$output .= '</td>
					</tr>
					</tbody>
					</table>';
			$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $description, $specialsubject3);
			$i = 0;
			$mark3 = '';
			foreach ($getmarks['data'] as $papers) {
				$nsem = count($papers['marks']);
				$s = 0;
				if (!empty($papers['marks'])) {
					foreach ($papers['marks'] as $mark) {
						$s++;
						// $mark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
						// $mark3 .= $s . ' 学期 - ' . $mark . '<br>';
						if (is_array($mark) && isset($mark['freetext']) && $mark['freetext'] != null) {
							$mark3 = $mark['freetext'];
							// $mark3 .= $s . ' 学期 - ' . $mark . '<br>';
						}
						// Ensure that only the last semester's grade is used
						if ($s == $nsem) {
							break;
						}
					}
				}
			}
			$output .= '<table class="table table-bordered" style="border: 2px solid black;margin-top:20px;">
					<thead class="colspanHead">
					<tr>
					<td colspan="5">特別活動等の記録　（毎学期記載）</td>
					</tr>
					</thead>
					<tbody>
					<tr style="border-top: 2px solid black;">
					<td colspan="5" style="height:210px;text-align:left;vertical-align: top;word-wrap: break-word;">';
			$comment = explode("\n", $mark3);
			foreach ($comment as $cmt) {
				$output .= $cmt . '<br>';
			}
			$output .= '</td>
					</tr>
					</tbody>
					</table>';
			$getmarks = $this->commonHelper->getSubjectPaperMarks($request, $stu, $description, $specialsubject4);
			$i = 0;
			$mark4 = '';
			foreach ($getmarks['data'] as $papers) {
				$nsem = count($papers['marks']);
				$s = 0;
				if (!empty($papers['marks'])) {
					foreach ($papers['marks'] as $mark) {
						$s++;
						if (is_array($mark) && isset($mark['freetext']) && $mark['freetext'] != null) {
							$mark4 = $mark['freetext'];
						}
						// Ensure that only the last semester's grade is used
						if ($s == $nsem) {
							break;
						}
						// if ($s == $nsem) {

						// 	$mark4 = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
						// }
					}
				}
			}
			$output .= '<table class="table table-bordered" style="border: 2px solid black;margin-top:20px;">
					<thead class="colspanHead">
					<tr>
					<td colspan="5">　所見　（3学期に記載）</td>
					</tr>
					</thead>
					<tbody>
					<tr style="border-top: 2px solid black;">
					<td colspan="5" style="height:210px;text-align:left;vertical-align: top;word-wrap: break-word;">';
			$comment = explode("\n", $mark4);
			foreach ($comment as $cmt) {
				$output .= $cmt . '<br>';
			}
			$output .= '</td>
					</tr>
					</tbody>
					</table>';

			$output .= '<div style="display: flex; flex-wrap: wrap;">
						<div style="width: 100%; box-sizing: border-box;">
							<p style="text-align: right; margin-top:px;marign-bottom:22px;font-size:12px;">※1,2学期の内容は、三者懇談でお伝えさせていただきます。                                </p>
						</div>
					</div>
					

                <div style="width:100%;margin-top:28px;">
                    <table style="margin-top: 12px; width: 100%;">
                        <thead>
                            <!-- Your content here -->
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="1" style="text-align: left; height: 40px; width:5%;border: 2px solid black;">
                                    校<br>長
                                </td>
                                <td colspan="1" style="text-align: left; height: 40px; border: 2px solid black;">
                                    ' . $getteacherdata['data']['principal'] . '
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1" style="text-align: left; height: 40px; width:5%;border: 2px solid black;">
                                    担<br>任
                                </td>
                                <td colspan="1" style="text-align: left; height: 40px; border: 2px solid black;">
                                    ' . $getteacherdata['data']['teacher'] . '
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
										
					</div>
					</div>
					</div>';
			// set size
			$customPaper = array(0, 0, 792.00, 1330.00);
			// filename
			$now = now();
			$name = strtotime($now);
			$fileName = __('messages.report_card') . "_" . $number . "_" . $stu['name'] . "_" . $name . ".pdf";
		}
		$output .= '</body></html>';
		return $this->commonHelper->generatePdf($customPaper, $output, $fileName);
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

			'student_id' => $request->student_id,
		];
		$language = "国語";
		$socity = "社会";
		$math = "数学";
		$science = "理科";
		$english = "英語";
		$music = "音楽";
		$art = "美術";
		$sport = "保健体育";
		$engineer = "家庭"; // Home Econ

		$getstudents = Helper::PostMethod(config('constants.api.exam_individualstudentslist'), $data);

		if (empty($getstudents['data'])) {
			return redirect()->route('admin.exam_results.byreport')->with('errors', "No Student Data Found");
		}
		$stu = $getstudents['data'];
		$getmainsubjects = array($language, $socity, $math, $science, $english);
		$getnonmainsubjects = array($music, $art, $sport, $engineer);
		$footer_text = session()->get('footer_text');
		$personal_score = "個人得点"; //   individual score
		$getteacherdata = Helper::PostMethod(config('constants.api.classteacher_principal'), $data);


		$sno = 1;

		$grade = Helper::PostMethod(config('constants.api.class_details'), $data);
		$section = Helper::PostMethod(config('constants.api.section_details'), $data);
		$n1 = ($request->department_id == '1') ? 'P' : 'S';
		$n2 = $grade['data']['name_numeric'];
		$n3 = $section['data']['name'];
		$attendance_no = isset($stu['attendance_no']) ? $stu['attendance_no'] : "00";
		$number = $n1 . $n2 . $n3 . sprintf("%02d", $attendance_no);
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
			$acy = $acyear['data']['name'];

		$craft = [];
		$m1=0;$m2=0;$m3=0;$m4=0;$m5=0;$m6=0;$m7=0;$m8=0;$m9=0;$m10=0;
		$nm1=0;$nm2=0;$nm3=0;$nm4=0;$nm5=0;$nm6=0;$nm7=0;$nm8=0;$nm9=0;$nm10=0;
		
		foreach ($getmainsubjects as $subject) {
			$studata = [
				'branch_id' => session()->get('branch_id'),				
				'exam_id' => $request->exam_id,
				'class_id' => $request->class_id,
				'section_id' => $request->section_id,
				'semester_id' => $request->semester_id,
				'session_id' => $request->session_id,
				'subject' => $subject,
				'paper' => $personal_score,
				'academic_session_id' => $request->academic_year
			];
			$getmarks = Helper::PostMethod(config('constants.api.stuexam_ppmarkchartlist'), $studata);
			
			$craft[$subject] = $getmarks['data'];
			$m1+=$getmarks['data']['91-100'];
			$m2+=$getmarks['data']['81-90'];
			$m3+=$getmarks['data']['70-80'];
			$m4+=$getmarks['data']['61-70'];
			$m5+=$getmarks['data']['51-60'];
			$m6+=$getmarks['data']['40-50'];
			$m7+=$getmarks['data']['31-40'];
			$m8+=$getmarks['data']['21-30'];
			$m9+=$getmarks['data']['11-20'];
			$m10+=$getmarks['data']['0-10'];			
			
			$nm1+=$getmarks['data']['91-100'];
			$nm2+=$getmarks['data']['81-90'];
			$nm3+=$getmarks['data']['70-80'];
			$nm4+=$getmarks['data']['61-70'];
			$nm5+=$getmarks['data']['51-60'];
			$nm6+=$getmarks['data']['40-50'];
			$nm7+=$getmarks['data']['31-40'];
			$nm8+=$getmarks['data']['21-30'];
			$nm9+=$getmarks['data']['11-20'];
			$nm10+=$getmarks['data']['0-10'];	

		}
		$marks_distribution5s = [
			'451-500' => ($m1/5),
			'401-450' =>  ($m2/5),
			'351-400' =>  ($m3/5),
			'301-350' =>  ($m4/5),
			'251-300' =>  ($m5/5),
			'201-250' =>  ($m6/5),
			'151-200' =>  ($m7/5),
			'101-150' =>  ($m8/5),
			'51-100' =>  ($m9/5),
			'0-50' =>  ($m10/5),
		];
		$craft['5教科合計'] = $marks_distribution5s;
		foreach ($getnonmainsubjects as $subject) {
			$studata = [
				'branch_id' => session()->get('branch_id'),				
				'exam_id' => $request->exam_id,
				'class_id' => $request->class_id,
				'section_id' => $request->section_id,
				'semester_id' => $request->semester_id,
				'session_id' => $request->session_id,
				'subject' => $subject,
				'paper' => $personal_score,
				'academic_session_id' => $request->academic_year
			];
			$getmarks = Helper::PostMethod(config('constants.api.stuexam_ppmarkchartlist'), $studata);
			//dd($getmarks);
			$craft[$subject] = $getmarks['data'];
			$nm1+=$getmarks['data']['91-100'];
			$nm2+=$getmarks['data']['81-90'];
			$nm3+=$getmarks['data']['70-80'];
			$nm4+=$getmarks['data']['61-70'];
			$nm5+=$getmarks['data']['51-60'];
			$nm6+=$getmarks['data']['40-50'];
			$nm7+=$getmarks['data']['31-40'];
			$nm8+=$getmarks['data']['21-30'];
			$nm9+=$getmarks['data']['11-20'];
			$nm10+=$getmarks['data']['0-10'];	
		}
		
		
		$marks_distribution9s = [
			'811-900' => ($nm1/9),
			'721-810' =>  ($nm2/9),
			'6311-720' =>  ($nm3/9),
			'541-630' =>  ($nm4/9),
			'451-540' =>  ($nm5/9),
			'361-450' =>  ($nm6/9),
			'271-360' =>  ($nm7/9),
			'181-270' =>  ($nm8/9),
			'91-180' =>  ($nm9/9),
			'0-90' =>  ($nm10/9),
		];
		
		$craft['9教科合計'] = $marks_distribution9s;
		$firstSubject = reset($craft);
			$labels = array_keys($firstSubject);
			
			$labels2 = array('451-500','401-450','351-400','301-350','251-300','201-250','151-200','101-150','51-100','0-50');
			//dd($labels2);
			
			$labels3 = array('811-900','721-810','6311-720','541-630','451-540','361-450','271-360','181-270','91-180','0-90');
			
			$ch=0;
			$chartpath=[];
			foreach ($craft as $subject => $distribution) {
				$ch++;
				// Extract data from the distribution array
				$data = array_values($distribution);
				$xTitle = $request->input('xTitle', 'Number of incidents');
				$yTitle = $request->input('yTitle', 'Names');
				

				try {
					if($ch==6)
					{
						$chartImagePath = $this->generateBarChartSingle($labels2, $data, $xTitle, $yTitle, $subject);
						array_push($chartpath,$chartImagePath);
					}
					elseif($ch==11)
					{
						$chartImagePath = $this->generateBarChartSingle($labels3, $data, $xTitle, $yTitle, $subject);
						array_push($chartpath,$chartImagePath);
					}
					else
					{
						$chartImagePath = $this->generateBarChartSingle($labels, $data, $xTitle, $yTitle, $subject);
						array_push($chartpath,$chartImagePath);
					}
					

				} catch (Exception $e) {
					// Handle the error appropriately
					}
			}

	$fonturl = storage_path('fonts/ipag.ttf');
	$output = "<!DOCTYPE html>";
	$output .= "
	<html>
	<head>
		";
		$output .= '
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		';
		$output .= '
		<style>';
			// $test .='* { font-family: DejaVu Sans, sans-serif; }';
			$output .= '@font-face {
			font-family: ipag;
			font-style: normal;
			font-weight: normal;
			src: url("' . $fonturl . '");
			}
			body 
			{
			font-family: "ipag", "Times New Roman", !important;
			}
			p {
			color: black;
			font-size: 15px;
			margin: 0pt;
			}
			.s1 {
			color: black;
			font-size: 15px;
			}
			.s2 {
			color: black;
			font-size: 15px;
			}
			.s3 {
			color: black;
			font-size: 15px;
			}
			.s4 {
			color: black;
			font-size: 15px;
			}
			.s5 {
			color: #0D0D0D;
			font-size: 15px;
			}
			.s6 {
			color: black;
			font-size: 15px;
			}
			.s7 {
			color: #0D0D0D;
			font-size: 15px;
			}
			table,
			tbody {
			vertical-align: top;
			overflow: visible;
			}
			.td {
			border-top-style: solid;
			border-top-width: 1pt;
			border-left-style: solid;
			border-left-width: 1pt;
			border-bottom-style: solid;
			border-bottom-width: 1pt;
			border-right-style: solid;
			border-right-width: 1pt
			}
		</style>
	</head>
	<body>
		<div class="content"
			style="box-sizing: border-box; max-width: 800px; display: block; margin: 0 auto; padding: 20px;border-radius: 7px; margin-top: 20px;">
			<div class="row">
				<p
				style="padding-top: 2pt;padding-left: 23pt;text-indent: 0pt;text-align: left;font-size:20px;margin-top:30px;font-weight: bold; ">
				' . $grade['data']['name_numeric'] . ' 学年 &nbsp;&nbsp;&nbsp;' . $request->semester_id . ' 学期
				&nbsp;&nbsp;&nbsp;' . $term['data']['name'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;個人結果表
				</p>
			</div>
			<p class="s1" style="padding-top: 1pt;padding-left: 180pt;text-indent: 0pt;text-align: left;">
				&nbsp;&nbsp;&nbsp;&nbsp;  '. $acy.' 年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ' . $section['data']['name'] . ' 組&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ' . $stu['attendance_no'] . ' 番&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</p>
			<table style="border-collapse:collapse;" cellspacing="0">
				<tr style="height:15pt">
				<td class="td" style="width:75pt;">
					<p style="text-indent: 0pt;text-align: left;"><br /></p>
				</td>
				<td class="td" style="width:35pt;">
					<p class="s3" style="padding-top: 1pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">国語</p>
				</td>
				<td class="td" style="width:35pt;">
					<p class="s3" style="padding-top: 1pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">社会</p>
				</td>
				<td class="td" style="width:35pt;">
					<p class="s3" style="padding-top: 1pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">数学</p>
				</td>
				<td class="td" style="width:35pt;">
					<p class="s3" style="padding-top: 1pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">理科</p>
				</td>
				<td class="td" style="width:35pt;">
					<p class="s3" style="padding-top: 1pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">英語</p>
				</td>
				<td class="td" style="width:35pt;">
					<p class="s3" style="padding-top: 1pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">音楽</p>
				</td>
				<td class="td" style="width:35pt;">
					<p class="s3" style="padding-top: 1pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">美術</p>
				</td>
				<td class="td" style="width:35pt;">
					<p class="s3" style="padding-top: 1pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">保体</p>
				</td>
				<td class="td" style="width:35pt;">
					<p class="s3" style="padding-top: 1pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">技家</p>
				</td>
				<td class="td" style="width:75pt;">
					<p class="s3" style="padding-top: 1pt;padding-left: 14pt;text-indent: 0pt;text-align: left;">5教科合計
					</p>
				</td>
				<td class="td" style="width:75pt;">
					<p class="s3" style="padding-top: 1pt;padding-left: 14pt;text-indent: 0pt;text-align: left;">9教科合計
					</p>
				</td>
				</tr>
				<tr style="height:25pt">
				<td class="td" style="width:67pt;">
					<p class="s3" style="padding-top: 6pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">個人得点
					</p>
				</td>';
			$i = 0;
			$totalmain = 0;
			$totalopt = 0;
			foreach ($getmainsubjects as $subject) {
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

				$mark = (isset($getmarks['data']['score']) && $getmarks['data']['score'] != null) ? $getmarks['data']['score'] : '';

				$output .= ' <td class="td" style="width:34pt;">
					<p style="text-indent: 0pt;text-align: left;">' . $mark . '</p>
				</td>';
				$mark = ($mark != '') ? $mark : 0;
				$totalmain += $mark;
			}
			foreach ($getnonmainsubjects as $subject) {
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


				$mark = (isset($getmarks['data']['score']) && $getmarks['data']['score'] != null) ? $getmarks['data']['score'] : '';


				$output .= ' <td class="td" style="width:34pt;">
					<p style="text-indent: 0pt;text-align: left;">' . $mark . '</p>
				</td>';
				$mark = ($mark != '') ? $mark : 0;
				$totalopt += $mark;
			}
			$totall = $totalmain + $totalopt;

				$output .= '<td class="td" style="width:67pt;">
					<p style="text-indent: 0pt;text-align: left;">' . $totalmain . '</p>
				</td>
				<td class="td" style="width:67pt;">
					<p style="text-indent: 0pt;text-align: left;">' . $totall . '</p>
				</td>
				</tr>
				<tr style="height:15pt">
				<td class="td" style="width:67pt;">
					<p class="s3" style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">学年平均
					</p>
				</td>';
			$ma = 0;
			$totalavgmain = 0;
			$totalavgopt = 0;
			foreach ($getmainsubjects as $subject) {
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

				$mark = (isset($getmarks['data']['avg']) && $getmarks['data']['avg'] != null) ? $getmarks['data']['avg'] : '';

				
				$output .= ' <td class="td" style="width:34pt;">
					<p style="text-indent: 0pt;text-align: left;">' . round($mark, 2) . '</p>
				</td>';
				$mark = ($mark != '') ? $mark : 0;
				$totalavgmain += $mark;
			}
			$op = 0;
			foreach ($getnonmainsubjects as $subject) {
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
				$mark = (isset($getmarks['data']['avg']) && $getmarks['data']['avg'] != null) ? $getmarks['data']['avg'] : '';
				$output .= ' <td class="td" style="width:34pt;">
				<p style="text-indent: 0pt;text-align: left;">' . round($mark, 2) . '</p>
			</td>';
				
				$mark = ($mark != '') ? $mark : 0;

				$totalavgopt += $mark;
			}


			$avgtotal1 = $totalavgmain / $ma;
			$avgtotal2 = ($totalavgmain + $totalavgopt) / ($ma + $op);
			$output .= '<td class="td" style="width:70pt;">
					<p style="text-indent: 0pt;text-align: left;">' . round($avgtotal1, 2) . '</p>
				</td>
				<td class="td" style="width:70pt;">
					<p style="text-indent: 0pt;text-align: left;">' . round($avgtotal2, 2) . '</p>
				</td>
				</tr>
			</table>
			<p style="padding-top: 6pt;text-indent: 0pt;text-align: left;"><br /></p>
			<p class="s4" style="padding-bottom: 1pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">学習の振り返り</p>
			<table style="border-collapse:collapse;" cellspacing="0">
				<tr style="height:140px">
				<td class="td" style="width:178pt;height:200px;">
					<p class="s3"
						style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: left;font-size:12px;">
						できたこと・よかったこと
					</p>
				</td>
				<td class="td" style="width:205pt;height:200px;">
					<p class="s3"
						style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: left;font-size:12px;">
						できなかったこと・反省，今後の学習に向けて
					</p>
				</td>
				<td class="td" style="width:178pt;height:200px;">
					<p class="s3"
						style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: left;font-size:12px;">
						保護者の方のコメント
					</p>
				</td>
				</tr>
			</table>
			<p style="padding-top: 1pt;text-indent: 0pt;text-align: left;"><br /></p>
			<div style="display: inline-block; vertical-align: top;">
				<!-- Table 1 -->
				<table style="border-collapse: collapse; border: 1px solid black; font-size: 12px; width: 178pt; height: 160pt; display: inline-table; margin-right: 1px; vertical-align: middle;margin-top:20px;">
				<tr>
					<td style="width: 183pt; height: 160pt; text-align: center; vertical-align: middle;">
						<p class="s3"
							style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: center;font-size:12px;">
							国語
							
						</p>
						<img src="' . $chartpath[0] . '" alt="craft" width="225px" height="150px">
					</td>
				</tr>
				</table>
				<!-- Table 2 -->
				<table style="border-collapse: collapse; border: 1px solid black; font-size: 12px; width: 178pt; height: 160pt; display: inline-table; margin-right: 1px; vertical-align: middle;margin-top:20px;">
				<tr>
					<td style="width: 183pt; height: 160pt; text-align: center; vertical-align: middle;">
						<p class="s3"
							style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: center;font-size:12px;">
							社会
							
						</p>
						<img src="' . $chartpath[1] . '" alt="craft" width="225px" height="150px">
					</td>
				</tr>
				</table>
				<!-- Table 3 -->
				<table style="border-collapse: collapse; border: 1px solid black; font-size: 12px; width: 178pt; height: 160pt; display: inline-table; vertical-align: middle;margin-top:20px;">
				<tr>
					<td style="width: 183pt; height: 160pt; text-align: center; vertical-align: middle;">
						<p class="s3"
							style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: center;font-size:12px;">
						数学
						</p>
						<img src="' . $chartpath[2] . '" alt="craft" width="225px" height="150px">
					</td>
				</tr>
				</table>
			</div>
			<div style="display: inline-block; vertical-align: top;">
				<!-- Table 1 -->
				<table style="border-collapse: collapse; border: 1px solid black; font-size: 12px; width: 178pt; height: 160pt; display: inline-table; margin-right: 1px; vertical-align: middle;margin-top:5px;">
				<tr>
					<td style="width: 183pt; height: 160pt; text-align: center; vertical-align: middle;">
						<p class="s3"
							style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: center;font-size:12px;">
						理科
						</p>
						<img src="' . $chartpath[3] . '" alt="craft" width="225px" height="150px">
					</td>
				</tr>
				</table>
				<!-- Table 2 -->
				<table style="border-collapse: collapse; border: 1px solid black; font-size: 12px; width: 178pt; height: 160pt; display: inline-table; margin-right: 1px; vertical-align: middle;margin-top:5px;">
				<tr>
					<td style="width: 183pt; height: 160pt; text-align: center; vertical-align: middle;">
						<p class="s3"
							style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: center;font-size:12px;">
							英語
						</p>
						<img src="' . $chartpath[4] . '" alt="craft" width="225px" height="150px">
					</td>
				</tr>
				</table>
				<!-- Table 3 -->
				<table style="border-collapse: collapse; border: 1px solid black; font-size: 12px; width: 178pt; height: 160pt; display: inline-table; vertical-align: middle;margin-top:5px;">
				<tr>
					<td style="width: 183pt; height: 160pt; text-align: center; vertical-align: middle;">
						<p class="s3"
							style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: center;font-size:12px;">
							5教科合計
						</p>
						<img src="' . $chartpath[5] . '" alt="craft" width="225px" height="150px">
					</td>
				</tr>
				</table>
			</div>
			<div style="display: inline-block; vertical-align: top;">
				<!-- Table 1 -->
				<table style="border-collapse: collapse; border: 1px solid black; font-size: 12px; width: 178pt; height: 160pt; display: inline-table; margin-right: 1px; vertical-align: middle;margin-top:5px;">
				<tr>
					<td style="width: 183pt; height: 160pt; text-align: center; vertical-align: middle;">
						<p class="s3"
							style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: center;font-size:12px;">
							音楽
						</p>
						<img src="' . $chartpath[6] . '" alt="craft" width="225px" height="150px">
					</td>
				</tr>
				</table>
				<!-- Table 2 -->
				<table style="border-collapse: collapse; border: 1px solid black; font-size: 12px; width: 178pt; height: 160pt; display: inline-table; margin-right: 1px; vertical-align: middle;margin-top:5px;">
				<tr>
					<td style="width: 183pt; height: 160pt; text-align: center; vertical-align: middle;">
						<p class="s3"
							style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: center;font-size:12px;">
							美術
						</p>
						<img src="' . $chartpath[7] . '" alt="craft" width="225px" height="150px">
					</td>
				</tr>
				</table>
				<!-- Table 3 -->
				<table style="border-collapse: collapse; border: 1px solid black; font-size: 12px; width: 178pt; height: 160pt; display: inline-table; vertical-align: middle;margin-top:5px;">
				<tr>
					<td style="width: 183pt; height: 160pt; text-align: center; vertical-align: middle;">
						<p class="s3"
							style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: center;font-size:12px;">
							保体
						</p>
						<img src="' . $chartpath[8] . '" alt="craft" width="225px" height="150px">
					</td>
				</tr>
				</table>
			</div>
			<div style="display: inline-block; vertical-align: top;">
				<!-- Table 1 -->
				<table style="border-collapse: collapse; border: 1px solid black; font-size: 12px; width: 178pt; height: 160pt; display: inline-table; margin-right: 1px; vertical-align: middle;margin-top:5px;">
				<tr>
					<td style="width: 183pt; height: 160pt; text-align: center; vertical-align: middle;">
						<p class="s3"
							style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: center;font-size:12px;">
							技家
						</p>
						<img src="' . $chartpath[9] . '" alt="craft" width="225px" height="150px">
					</td>
				</tr>
				</table>
				<!-- Table 2 -->
				<table style="border-collapse: collapse; border: 1px solid black; font-size: 12px; width: 178pt; height: 160pt; display: inline-table; margin-right: 160px; vertical-align: middle;margin-top:5px;">
				<tr>
					<td style="width: 183pt; height: 160pt; text-align: center; vertical-align: middle;">
						<p class="s3"
							style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: center;font-size:12px;">
							9教科合計
						</p>
						<img src="' . $chartpath[10] . '" alt="craft" width="225px" height="150px">
					</td>
				</tr>
				</table>
				<!-- Table 3 -->
				<table style="border-collapse: collapse; border: 1px solid black; font-size: 12px; width: 60pt; height: 60pt; display: inline-table; margin-right: 1px; vertical-align: middle;margin-top:140px;">
				<tr>
					<td >
						<p class="s3"
							style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: left;font-size:12px;margin-top:-20px;">
							できたこと
						</p>
					</td>
				</tr>
				<tr>
					<td style="width: 60pt; height: 60pt; text-align: center; vertical-align: middle;">
						<p class="s3"
							style="padding-top: 1pt;padding-left: 1pt;border-bottom: 1px solid black;text-indent: 0pt;text-align: center;font-size:12px;margin-top:-40px;">
							できたこと
						</p>
						' . $getteacherdata['data']['teacher'] . '
					</td>
				</tr>
				</table>
			</div>
			<p style="text-indent: 0pt;text-align: left;"><br /></p>
			<p style="padding-left: 441pt;text-indent: 0pt;line-height: 1pt;text-align: left;" />
		</div>
	</body>
	</html>
	';

		// filename
		$customPaper = array(0, 0, 792.00, 1330.00);
		$now = now();
		$name = strtotime($now);
		$fileName = __('messages.personal_test_res') . "_" . $number . "_" . $stu['name'] . "_" . $name . ".pdf";

		// Set the appropriate HTTP headers
		return $this->commonHelper->generatePdf($customPaper, $output, $fileName);
		//return $pdf->download($fileName);
		// return $pdf->stream();
		$directory = public_path('barchart');
		if(file_exists($directory)) {
			// Attempt to delete files in the directory
			File::deleteDirectory($directory);
		} 
	}
	public function generateBarChartSingle($labels, $data, $xTitle = 'Number of students', $yTitle = 'Mark range', $subject)
	{
		require_once public_path('jpgraph-4.4.2/src/jpgraph.php');
		require_once public_path('jpgraph-4.4.2/src/jpgraph_bar.php');

		// Define the directory and ensure it exists
		$directory = public_path('barchart');
		// if (!is_dir($directory)) {
		// 	if (!mkdir($directory, 0777, true)) {
		// 		throw new Exception("Failed to create directory: $directory");
		// 	}
		// }

		// // Ensure the directory is writable
		// if (!is_writable($directory)) {
		// 	throw new Exception("Directory $directory is not writable");
		// }

		// Create a unique file name using the subject and current timestamp
		$timestamp = time();
		$fileName = $subject . '_' . $timestamp . '.png';
		$filePath = $directory . '/' . $fileName;

		// Create the graph
		$graph = new \Graph(600, 400, 'auto');
		$graph->SetScale('textlin');
		$graph->Set90AndMargin(150, 30, 50, 50); // Rotate the graph to make horizontal bars

		// Setup margin and titles
		// $graph->title->Set('Distribution of Student Marks');
		// $graph->xaxis->title->Set($xTitle);
		// $graph->yaxis->title->Set($yTitle);

		// Setup X-axis labels with the mark ranges (since the graph is rotated)
		$graph->xaxis->SetTickLabels($labels);
		$graph->xaxis->SetLabelMargin(10);

		// Create the bar plot (horizontal)
		$bplot = new \BarPlot($data);

		// Add the bar plot to the graph
		$graph->Add($bplot);
		$bplot->SetFillColor('darkgray');
		// $bplot->value->SetValuePos();
		$bplot->value->SetFormat('%d');
		$bplot->value->SetColor("black");
		$bplot->value->SetAlign('left', 'center');
		$bplot->value->SetFont(FF_FONT1, FS_BOLD);
		$bplot->value->SetMargin(10);
		$bplot->value->Show();

		// $graph->title->Set($subject);
		// Display the graph
		$graph->Stroke($filePath);

		return $filePath;
	}
	
}
