<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\File;
use ZipArchive;
use DateTime;
use DateInterval;
use DatePeriod;
use DateTimeZone;
use PDF;

use App\Jobs\studentreportcardpdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ExamPdfController2 extends Controller
{

	public function downbyecreport(Request $request)
{
    // Set PHP execution and memory limits to handle large PDF generation tasks
    ini_set('max_execution_time', 600);
    ini_set('memory_limit', '1024M');

    // Select the logo based on the department ID
    $pdf_logo = $request->department_id == 1 
        ? config('constants.image_url') . '/common-asset/images/primary_logo.png'
        : config('constants.image_url') . '/common-asset/images/secondary_logo.png';

    // Prepare the data array for API requests
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

    // Get the list of students from the API
    $getstudents = Helper::PostMethod(config('constants.api.exam_studentslist'), $data);
    if (empty($getstudents['data'])) {
        return redirect()->route('admin.exam_results.byreport')->with('errors', "No Student Data Found");
    }

    // Fetch additional details needed for the report
    $footer_text = session()->get('footer_text');
    $grade = Helper::PostMethod(config('constants.api.class_details'), $data);
    $section = Helper::PostMethod(config('constants.api.section_details'), $data);
    $gradename = $grade['data']['name'];
    $classname = $section['data']['name'];
    $acdata = ['branch_id' => session()->get('branch_id'), 'id' => $request->academic_year];
    $termdata = ['branch_id' => session()->get('branch_id'), 'id' => $request->exam_id];
    $bdata = ['id' => session()->get('branch_id')];
    $getbranch = Helper::PostMethod(config('constants.api.branch_details'), $bdata);
    $term = Helper::PostMethod(config('constants.api.exam_details'), $termdata);
    $acyear = Helper::PostMethod(config('constants.api.academic_year_details'), $acdata);
    $acy = $acyear['data']['name'];
    $term_name = $term['data']['term_name'] ?? '';
    $storagePath = storage_path('app/public/pdfs');

    // Ensure the storage directory exists
    if (!File::exists($storagePath)) {
        File::makeDirectory($storagePath, 0755, true);
    }
	
		$teachername = '';
		$teachercmd = '';

    $pdfFiles = [];
    $sno = 0;
	$pdata = [
		'branch_id' => session()->get('branch_id'),
		'exam_id' => $request->exam_id,
		'department_id' => $request->department_id,
		'class_id' => $request->class_id,
		'section_id' => $request->section_id,
		'semester_id' => $request->semester_id,
		'session_id' => $request->session_id,
		'academic_session_id' => $request->academic_year	

	];
    foreach ($getstudents['data'] as $stu) {
        $sno++;
        $n1 = $request->department_id == '1' ? 'P' : 'S';
        $n2 = $grade['data']['name_numeric'];
        $n3 = $section['data']['name'];
        $attendance_no = $stu['attendance_no'] ?? "00";
        $number = $n1 . $n2 . $n3 . sprintf("%02d", $attendance_no);
        $fonturl = storage_path('fonts/ipag.ttf');
        $papername1 = "EC-Class";

        
		$pdata['student_id'] =  $stu['student_id'];
		$pdata['paper_name'] =  $papername1;

        $paper = Helper::PostMethod(config('constants.api.getec_marks'), $pdata);
        $ec_classname = $paper['data']['freetext'] ?? '';
        $papername2 = "Level";

        // Prepare data for the second paper
        $pdata['paper_name'] = $papername2;
        $paper = Helper::PostMethod(config('constants.api.getec_marks'), $pdata);
        $levelname = $paper['data']['freetext'] ?? '';
		$papername3 = "Teacher`s Comments";			
		$pdata['paper_name'] = $papername3;
			$paper = Helper::PostMethod(config('constants.api.getec_marks'), $pdata);
			//dd($getspsubject1);//dd($pdata);
			$teachercmd = "";
			if (!empty($paper['data'])) {

				if ($paper['data']['score_type'] == 'Points') {
					$teachercmd = $paper['data']['grade_name'];
				} elseif ($paper['data']['score_type'] == 'Freetext') {
					$teachercmd = $paper['data']['freetext'];
				} elseif ($paper['data']['score_type'] == 'Grade') {
					$teachercmd = $paper['data']['grade'];
				} else {
					$teachercmd = $paper['data']['score'];
				}
			}
			$papername4 = "Teacher Name";
			
			$pdata['paper_name'] = $papername4;
			$paper = Helper::PostMethod(config('constants.api.getec_marks'), $pdata);

			$teachername = $paper['data']['freetext'] ?? '';
        // Generate the HTML content for the PDF
        $output = $this->generateECPDFContent($pdf_logo, $fonturl, $acy, $term_name, $number, $ec_classname, $levelname, $stu, $teachercmd, $teachername, $request);

        // Create the PDF from the HTML content
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($output);
        $pdfFilename = $storagePath . '/' . $stu['student_id'] . '.pdf';
        $pdf->save($pdfFilename);

        $pdfFiles[] = $pdfFilename;
    }

    // Combine PDFs into a single file if necessary, or handle them as needed

    return response()->download($pdfFiles[0]); // Adjust this to handle multiple files appropriately
}

// Helper function to generate the HTML content for the PDF
private function generateECPDFContent($pdf_logo, $fonturl, $acy, $term_name, $number, $ec_classname, $levelname, $stu, $teachercmd, $teachername, $request)
{
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
		
		$papers[0] = array($l1, $l2, $l3);
		$papers[1] = array($r1, $r2);
		$papers[2] = array($s1, $s2, $s3, $s4);
		$papers[3] = array($w1, $w2);
		$papers[4] = array($a1, $a2, $a3);
	}
	if ($request->department_id == 2) 
	{
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
		
		$papers[0] = array($l1, $l2, $l3);
		$papers[1] = array($r1, $r2);
		$papers[2] = array($s1, $s2, $s3, $s4, $s5);
		$papers[3] = array($w1, $w2, $w3);
		$papers[4] = array($a1, $a2, $a3, $a4);
	}
	// Generate the HTML content based on the provided parameters
	$heading = array('Listening', 'Reading', 'Speaking', 'Writing', 'Attitude');
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
    body { 
        font-family: "ipag", "Times New Roman", !important;
    }
    tr, td {
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
    h3 { 
        font-family: "Times New Roman";
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
					
					<h1 style="line-height: 0px;text-align: center;">Japanese School of Kuala Lumpur</h1>
					
					</td>
					</tr> 
					<tr>
					<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; width:30%; text-align: center;">
					
					<h4 style="margin: 0;">' . $acy . ' </h4>
					</td>       
					<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; width:30%; text-align: left;">
					<h4 style="margin: 0;">English Communication</h4>
					</td>       
					<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; width:30%; text-align: left;font-weight: bold;">
					<h4>' . $term_name . ' Report</h4>
					</td>
					</tr> 
					<tr>
					<td class="content-wrap aligncenter" style="margin: 0; padding-left: 20px; text-align: left;">                   <h5 style="margin: 0;">Number</h5>
					<h4 style="margin: 0;">' . $number . '</h4>
					</td>       
					<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; text-align: left;">
					<h5 style="margin: 0;">EC-Class</h5>
					<h4 style="margin: 0;">' . $ec_classname . '</h4>
					</td>       
					<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; text-align: left;">
					<h5 style="margin: 0;">Level</h5>
					<h4 style="margin: 0;">' . $levelname . '</h4>
					</td>
					</tr> 
					<tr>
					<td class="content-wrap aligncenter" style="margin: 0; padding-left: 20px;padding-top:10px; padding-bottom:-10px; text-align: left;">
					
					<h3 style="margin: 0;">Student Name</h3>
					</td>       
					<td colspan="2" class="content-wrap aligncenter" style="margin: 0;padding-top:10px; padding-bottom:-10px;text-align: center;">
					<h3 style="margin: 0;">' . strtoupper($stu['eng_name']) . '</h3>
					</td>
					</tr> 
					<tr>
					<td class="content-wrap aligncenter" colspan="3" style="margin: 0; padding-left: 20px;padding-right: 20px;padding-top:-10px; text-align: center;">
					<table style="border-collapse: collapse; width: 100%;">
					<tbody>';
			
				$i = 0;
				foreach ($heading as $heads) {
					$output .= '
							<tr>
							<td colspan="2"
							style="text-align:center; border: 2px solid black;background-color:#40403a57;font-size:18px;">
							' . $heads . '</td>
							</tr>';

					$paperslist = $papers[$i];
					//dd($Getpaper);
					$i++;
					foreach ($paperslist as $papername) {
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
						$mark = "";
						if (!empty($paper['data'])) {

							if ($paper['data']['score_type'] == 'Points') {
								$mark = $paper['data']['grade_name'];
							} elseif ($paper['data']['score_type'] == 'Freetext') {
								$mark = $paper['data']['freetext'];
							} elseif ($paper['data']['score_type'] == 'Grade') {
								$mark = $paper['data']['grade'];
							} else {
								$mark = $paper['data']['score'];
							}
						}

						$output .= '<tr>
								<td style="border: 2px solid black; text-align: left;font-weight: normal;height:15px;">' . $papername . '
								</td>
								<td style="border: 2px solid black; text-align: center;font-weight: normal;height:15px;">' . $mark . '</td>
								</tr>';
					}
				}
				$output .= ' </tbody>';
			

			$output .= '</table>
					
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
			
			// dd($pdata);

			
			$output .= '<tr>
					<td class="content-wrap aligncenter" colspan="3" style="margin: 0; padding-left: 20px;padding-right: 20px;padding-top:-10px; text-align: center;">
					
					<!-- Teacher`s Comments -->
					<table style="margin-top: 30px; border-collapse: collapse; width: 100%;">
					<tbody>
					<tr>
					<td colspan="2"
					style="text-align: center; border: 2px solid black; background-color: #40403a57; color: black;font-size:18px;">
					Teacher`s Comments</td>
					</tr>
					<tr>
					<td colspan="2"
					style="text-align: left; border: 2px solid black; height: 100px; color: black; padding: 10px;">
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
					<td class="content-wrap aligncenter"  style="margin: 0; padding: 10px; text-align: center;">
					<h5 style="margin: 0;">English Teacher`s Name</h5>
					</td>
					<td class="content-wrap aligncenter"  style="margin: 0; padding: 10px; text-align: center;">
					<h5 style="margin: 0;font-weight: normal;">' . $teachername . '</h5>
					
					</td>
					</tr>
					</table>
					</div>';

    $output .= '</body></html>';

    return $output;
}
	public function downbyecreport1(Request $request)
	{
		ini_set('max_execution_time', 600);
    	ini_set('memory_limit', '1024M');
		if ($request->department_id == 1) {
			$pdf_logo = config('constants.image_url') . '/common-asset/images/primary_logo.png';
		}
		if ($request->department_id == 2) {
			$pdf_logo = config('constants.image_url') . '/common-asset/images/secondary_logo.png';
		}
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
		if (empty($getstudents['data'])) {
			return redirect()->route('admin.exam_results.byreport')->with('errors', "No Student Data Found");
		}
		$footer_text = session()->get('footer_text');
		$sno = 0;

		$grade = Helper::PostMethod(config('constants.api.class_details'), $data);
		$section = Helper::PostMethod(config('constants.api.section_details'), $data);
		$gradename = $grade['data']['name'];
		$classname = $section['data']['name'];
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
		$acy = $acyear['data']['name'];
		$term_name = isset($term['data']['term_name']) ? $term['data']['term_name'] : '';
		$storagePath = storage_path('app/public/pdfs');

		// Ensure the storage directory exists
		if (!File::exists($storagePath)) {
			File::makeDirectory($storagePath, 0755, true);
		}
		$pdfFiles = [];
		foreach ($getstudents['data'] as $stu) {
			$sno++;
			$n1 = ($request->department_id == '1') ? 'P' : 'S';
			$n2 = $grade['data']['name_numeric'];
			$n3 = $section['data']['name'];
			$attendance_no = isset($stu['attendance_no']) ? $stu['attendance_no'] : "00";
			$number = $n1 . $n2 . $n3 . sprintf("%02d", $attendance_no);
			$fonturl = storage_path('fonts/ipag.ttf');
			$papername1 = "EC-Class";
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
				'paper_name' => $papername1

			]; // dd($pdata);
			$paper = Helper::PostMethod(config('constants.api.getec_marks'), $pdata);
			$ec_classname = $paper['data']['freetext'] ?? '';
			$papername2 = "Level";
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
				'paper_name' => $papername2

			]; // dd($pdata);
			$paper = Helper::PostMethod(config('constants.api.getec_marks'), $pdata);
			$levelname = $paper['data']['freetext']  ?? '';
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
					font-family: "ipag", "Open Sans", !important;
				}
				tr,
				td {
				font-family: "Open Sans";
				font-style: normal;
				font-size: 14px;
				letter-spacing: 0.0133em;				
				word-wrap: break-word;
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
				h3 { font-family:  "Open Sans";
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
					
					<h1 style="line-height: 0px;text-align: center;">Japanese School of Kuala Lumpur</h1>
					
					</td>
					</tr> 
					<tr>
					<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; width:30%; text-align: center;">
					
					<h4 style="margin: 0;">' . $acy . ' </h4>
					</td>       
					<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; width:30%; text-align: left;">
					<h4 style="margin: 0;">English Communication</h4>
					</td>       
					<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; width:30%; text-align: left;font-weight: bold;">
					<h4>' . $term_name . ' Report</h4>
					</td>
					</tr> 
					<tr>
					<td class="content-wrap aligncenter" style="margin: 0; padding-left: 20px; text-align: left;">                   <h5 style="margin: 0;">Number</h5>
					<h4 style="margin: 0;">' . $number . '</h4>
					</td>       
					<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; text-align: left;">
					<h5 style="margin: 0;">EC-Class</h5>
					<h4 style="margin: 0;">' . $ec_classname . '</h4>
					</td>       
					<td class="content-wrap aligncenter" style="margin: 0; padding: 10px; text-align: left;">
					<h5 style="margin: 0;">Level</h5>
					<h4 style="margin: 0;">' . $levelname . '</h4>
					</td>
					</tr> 
					<tr>
					<td class="content-wrap aligncenter" style="margin: 0; padding-left: 20px;padding-top:10px; padding-bottom:-10px; text-align: left;">
					
					<h3 style="margin: 0;">Student Name</h3>
					</td>       
					<td colspan="2" class="content-wrap aligncenter" style="margin: 0;padding-top:10px; padding-bottom:-10px;text-align: center;">
					<h3 style="margin: 0;">' . strtoupper($stu['eng_name']) . '</h3>
					</td>
					</tr> 
					<tr>
					<td class="content-wrap aligncenter" colspan="3" style="margin: 0; padding-left: 20px;padding-right: 20px;padding-top:-10px; text-align: center;">
					<table style="border-collapse: collapse; width: 100%;">
					<tbody>';
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
				$teachername = '';
				$teachercmd = '';
				$i = 0;
				foreach ($heading as $heads) {
					$output .= '
							<tr>
							<td colspan="2"
							style="text-align:center; border: 2px solid black;background-color:#40403a57;font-size:18px;">
							' . $heads . '</td>
							</tr>';

					$paperslist = $papers[$i];
					//dd($Getpaper);
					$i++;
					foreach ($paperslist as $papername) {
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
						$mark = "";
						if (!empty($paper['data'])) {

							if ($paper['data']['score_type'] == 'Points') {
								$mark = $paper['data']['grade_name'];
							} elseif ($paper['data']['score_type'] == 'Freetext') {
								$mark = $paper['data']['freetext'];
							} elseif ($paper['data']['score_type'] == 'Grade') {
								$mark = $paper['data']['grade'];
							} else {
								$mark = $paper['data']['score'];
							}
						}

						$output .= '<tr>
								<td style="border: 2px solid black; text-align: left;font-weight: normal;height:15px;">' . $papername . '
								</td>
								<td style="border: 2px solid black; text-align: center;font-weight: normal;height:15px;">' . $mark . '</td>
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
				$teachername = '';
				$teachercmd = '';
				$i = 0;
				foreach ($heading as $heads) {
					$output .= '
							<tr>
							<td colspan="2"
							style="text-align:center; border: 2px solid black;background-color:#40403a57;font-size:18px;">
							' . $heads . '</td>
							</tr>';

					$paperslist = $papers[$i];
					//dd($Getpaper);
					$i++;
					foreach ($paperslist as $papername) {
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
						$mark = "";
						if (!empty($paper['data'])) {

							if ($paper['data']['score_type'] == 'Points') {
								$mark = $paper['data']['grade_name'];
							} elseif ($paper['data']['score_type'] == 'Freetext') {
								$mark = $paper['data']['freetext'];
							} elseif ($paper['data']['score_type'] == 'Grade') {
								$mark = $paper['data']['grade'];
							} else {
								$mark = $paper['data']['score'];
							}
						}

						$output .= '<tr>
								<td style="border: 2px solid black; text-align: left;font-weight: normal;height:15px;">' . $papername . '
								</td>
								<td style="border: 2px solid black; text-align: center;font-weight: normal;height:15px;">' . $mark . '</td>
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
					<h6 style="margin: 0;font-weight: normal;">Results: Improving, Satisfactory, Excellent</h6>
					</div>
					
					</td>
					</tr>';
			$papername = "Teacher`s Comments";
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
			$teachercmd = "";
			if (!empty($paper['data'])) {

				if ($paper['data']['score_type'] == 'Points') {
					$teachercmd = $paper['data']['grade_name'];
				} elseif ($paper['data']['score_type'] == 'Freetext') {
					$teachercmd = $paper['data']['freetext'];
				} elseif ($paper['data']['score_type'] == 'Grade') {
					$teachercmd = $paper['data']['grade'];
				} else {
					$teachercmd = $paper['data']['score'];
				}
			}
			$papername = "Teacher Name";
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
			// dd($pdata);

			$paper = Helper::PostMethod(config('constants.api.getec_marks'), $pdata);
			$teachername = $paper['data']['freetext'] ?? '';
			$output .= '<tr>
					<td class="content-wrap aligncenter" colspan="3" style="margin: 0; padding-left: 20px;padding-right: 20px;padding-top:-10px; text-align: center;">
					
					<!-- Teacher`s Comments -->
					<table style="margin-top: 30px; border-collapse: collapse; width: 100%;">
					<tbody>
					<tr>
					<td colspan="2"
					style="text-align: center; border: 2px solid black; background-color: #40403a57; color: black;font-size:18px;">
					Teacher`s Comments</td>
					</tr>
					<tr>
					<td colspan="2"
					style="text-align: left; border: 2px solid black; height: 100px; color: black; padding: 10px;">
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
					<td class="content-wrap aligncenter"  style="margin: 0; padding: 10px; text-align: center;">
					<h5 style="margin: 0;">English Teacher`s Name</h5>
					</td>
					<td class="content-wrap aligncenter"  style="margin: 0; padding: 10px; text-align: center;">
					<h5 style="margin: 0;font-weight: normal;">' . $teachername . '</h5>
					
					</td>
					</tr>
					</table>
					</div>
					<div style="page-break-after: always;"></div>';

			$output .= '</body></html>';
			$pdf = \App::make('dompdf.wrapper');

			// Set custom paper size
			// $customPaper = [0, 0, 792.00, 1224.00];
			if ($request->department_id == 1) {
				$customPaper = array(0, 0, 700.00, 950.00);
			} else if ($request->department_id == 2) {
				$customPaper = array(0, 0, 700.00, 1000.00);
			} else {
				$customPaper = array(0, 0, 700.00, 1000.00);
			}
			// $customPaper = array(0, 0, 800.00, 1000.00);
			$pdf->set_paper($customPaper);
			$pdf->loadHTML($output);
			// return $pdf->stream();
			// Filename setup
			$fileName = __('messages.english_communication') . "-" . $stu['eng_name'] . ".pdf";
			$pdfFilePath = $storagePath . '/' . $fileName;

			// Save the PDF to the specified folder
			$pdf->save($pdfFilePath);

			// Add the PDF file path to the array
			$pdfFiles[] = $pdfFilePath;
		}
		// Create a ZIP file
		$now = now();
		$department = ($request->department_id == 1) ? 'Primary' : 'Secondary';
		$timestamp = strtotime($now);
		$zipFileName = __('messages.english_communication') . "-" . $department . "-" . $gradename . "-" . $classname . "-" . $timestamp . ".zip";
		$zipFilePath = $storagePath . '/' . $zipFileName;

		$zip = new ZipArchive();
		if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
			foreach ($pdfFiles as $pdfFile) {
				$zip->addFile($pdfFile, basename($pdfFile));
			}
			$zip->close();
		}

		// Download the ZIP file
		if (File::exists($zipFilePath)) {
			// Read the ZIP file content
			$zipContent = File::get($zipFilePath);

			// Set the appropriate HTTP headers
			$headers = [
				'Content-Type' => 'application/zip',
				'Content-Disposition' => 'attachment; filename=' . rawurlencode($zipFileName),
				'Content-Length' => strlen($zipContent),
			];

			// Return the response with headers and delete the file after sending
			$response = response($zipContent)->withHeaders($headers);

			// Delete the file after sending the response
			File::delete($zipFilePath);

			// Return the response
			return $response;
			//return response()->download($zipFilePath)->deleteFileAfterSend(true);
		}
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
			'pdf_report' => 0 // All Primary Subjects

		];

		$language = "国語";
		$math = '算数';
		$life = '生活';
		$music = '音楽';
		// $art='図工';
		$art = '図画工作';
		$sport = '体育';
		$science = "理科";
		$socity = "社会";
		$homeeconomics = "家庭";
		$foreignlanguage = "外国語";
		$english = "英語";
		// $tech_homeeconomics="技術・家庭科";
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


		$getstudents = Helper::PostMethod(config('constants.api.exam_studentslist'), $data);
		if (empty($getstudents['data'])) {
			return redirect()->route('admin.exam_results.byreport')->with('errors', "No Student Data Found");
		}
		$getacyeardates = Helper::PostMethod(config('constants.api.getacyeardates'), $data);
		$getteacherdata = Helper::PostMethod(config('constants.api.classteacher_principal'), $data);

		$grade = Helper::PostMethod(config('constants.api.class_details'), $data);
		$section = Helper::PostMethod(config('constants.api.section_details'), $data);
		$stuclass = $grade['data']['name_numeric'];
		$gradename = $grade['data']['name'];
		$classname = $section['data']['name'];
		if ($request->department_id == 1) // Primary 
		{
			if ($stuclass == 1 || $stuclass == 2) {
				$getprimarysubjects = array($language, $math, $life, $music, $art, $sport);
				$getprimarypapers = array($primarypaper1, $primarypaper2, $primarypaper3);
				$getspecialpapers = array($specialpaper1, $specialpaper2, $specialpaper3, $specialpaper4, $specialpaper5, $specialpaper6, $specialpaper7, $specialpaper8, $specialpaper9, $specialpaper10);
			}
			if ($stuclass == 3 || $stuclass == 4) {
				// $getprimarysubjects = array($language,$math,$life,$music,$art,$sport);
				$getprimarysubjects = array($language, $socity, $math, $science, $music, $art, $sport);
				$getprimarypapers = array($primarypaper1, $primarypaper2, $primarypaper3);
				$getspecialpapers = array($specialpaper1, $specialpaper2, $specialpaper3, $specialpaper4, $specialpaper5, $specialpaper6, $specialpaper7, $specialpaper8, $specialpaper9, $specialpaper10);
			}
			if ($stuclass == 5 || $stuclass == 6) {

				// $getprimarysubjects = array($language,$math,$life,$music,$art,$sport);
				$getprimarysubjects = array($language, $socity, $math, $science, $music, $art, $homeeconomics, $sport, $foreignlanguage);
				$getprimarypapers = array($primarypaper1, $primarypaper2, $primarypaper3);
				$getspecialpapers = array($specialpaper1, $specialpaper2, $specialpaper3, $specialpaper4, $specialpaper5, $specialpaper6, $specialpaper7, $specialpaper8, $specialpaper9, $specialpaper10);
			}
		} elseif ($request->department_id == 2) // Secondary 
		{
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
		}

		$footer_text = session()->get('footer_text');

		$fonturl = storage_path('fonts/ipag.ttf');
		$storagePath = storage_path('app/public/pdfs');

		// Ensure the storage directory exists
		if (!File::exists($storagePath)) {
			File::makeDirectory($storagePath, 0755, true);
		}

		$pdfFiles = [];
		if ($request->department_id == 1) // Primary 
		{
			if ($stuclass == 1 || $stuclass == 2) {

				$sno = 0;
				$bdata = [
					'id' => session()->get('branch_id'),
				];
				$getbranch = Helper::PostMethod(config('constants.api.branch_details'), $bdata);
				foreach ($getstudents['data'] as $stu) {
					$sno++;
					$attendance_no = isset($stu['attendance_no']) ? $stu['attendance_no'] : "00";
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
						word-wrap: break-word;
						font-size: 16px;
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
						
						<body>
						<div class="content">
						<div class="row">
						<div class="column">
						<p style="margin: 0;font-size:20px;">クアラルンプール日本人学校　小学部</p>
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
						<div class="column1" style="width:18%;">
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
						<div class="column1" style="width:2%;">
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
						
						<div class="row">
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
					$result1 = [];
					$sub1 = array('国<br>語', '算<br>数', '生<br>活', '音<br>楽', '図<br>画<br>工<br>作', '体<br>育');
					foreach ($getprimarysubjects as $subject) {

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
						//$result1[] = $getmarks;
						// dd(count($getmarks['data']));

						$i = 0;
						// $n=count($getmarks['data']); 
						$data = $getmarks['data'] ?? [];
						$n = count($data);

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

								$output .= '<td style="width:2%;  height: 30px;">' . $mark . '</td>';
							}
							$output .= ' </tr>';
							//dd($subject);
						}
						$p++;
					}
					$output .= '</tbody>
						</table>
						
						<!-- Second table and additional content... -->
						<table class="table table-bordered table-responsive" style="border: 2px solid black;margin-top:45px;">
						<thead class="colspanHead">
						<tr>
						<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 52px;">出欠の記録</th>
						<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 52px;">授業<br>日数</th>
						<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 52px;font-size:10px;">出席停止<br>忌引き等</th>
						<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 52px;font-size:10px;">出席しなければ<br>ならない日<br>数</th>
						<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 52px;">欠席<br>日数</th>
						<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 52px;">出席<br>日数</th>
						<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 52px;">遅刻</th>
						<th style="border: 1px solid black; font-weight:italic; text-align: center; height: 52px;">早退</th>
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

					$attarray = array('', '1月', ' 2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月');
					$getattendance = Helper::PostMethod(config('constants.api.getsem_studentattendance'), $attdata);
					//dd($getattendance);
					$at_tot1 = 0;
					$at_tot2 = 0;
					$at_tot3 = 0;
					$at_tot4 = 0;
					$at_tot5 = 0;
					$at_tot6 = 0;
					$at_tot7 = 0;
					foreach ($getattendance['data'] as $att) {
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
						'subject' => $specialsubject1,
						'papers' => $getspecialpapers
					];
					$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);

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
										<td colspan="4" style="text-align:left;vertical-align: top;width:100px;">' . $papers['papers'] . '</td>
										<td colspan="1">' . $fmark . '</td>
									</tr>';
					}

					$output .= '</tbody>
						</table>';
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
						'subject' => $specialsubject2,
						'papers' => $description

					];
					// echo "subject   :".$specialsubject2;
					// \print_r($description);
					// echo "<br>";
					$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
					// dd($getmarks);
					$i = 0;
					$n = count($getmarks['data']);
					$mark1 = '';
					// foreach ($getmarks['data'] as $papers) {
					// 	$nsem = count($papers['marks']);
					// 	$s = 0;
					// 	foreach ($papers['marks'] as $mark) {
					// 		$s++;
					// 		if ($s == $nsem) {

					// 			$mark1 = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
					// 		}
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
						'subject' => $specialsubject3,
						'papers' => $description

					];
					$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
					// dd($getmarks);
					$i = 0;
					$n = count($getmarks['data']);
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
						<td colspan="5" style="height:170px;text-align:left;vertical-align: top;word-wrap: break-word;">';
					$comment = explode("\n", $mark2);
					foreach ($comment as $cmt) {
						$output .= $cmt . '<br>';
					}
					$output .= '</td>
						</tr>
						</tbody>
						</table>';
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
						'subject' => $specialsubject4,
						'papers' => $description

					];
					$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
					// dd($getmarks);
					$i = 0;
					$n = count($getmarks['data']);
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
								// dd($mark3);
								// if ($s == $nsem) {

								// 	$mark3 = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
								// }
							}
						}
					}
					//$mark3='教材の主人公の思いや考えを自分の体験と重ねて、実感として捉えようとしていました。特に、「なかよしだけど」の学習では、登場人物の行動から、相手も自分も気持ちよく過ごすために大切なマナーに気付きました。';

					$output .= '<table class="table table-bordered" style="border: 2px solid black;margin-top:30px;width:100%;">
						<thead class="colspanHead">
						<tr>
						<td colspan="5"> 所見　（3学期に記載）</td>
						</tr>
						</thead>
						<tbody>
						<tr style="border-top: 2px solid black;">
						<td colspan="5" style="height:170px;text-align:left;vertical-align: top;word-wrap: break-word;">';
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
						<p style="text-align: right; margin-top:0px;marign-bottom:20px;font-size:14px;">※1，2学期の内容は、三者懇談でお伝えさせていただきます。</p>
						</div>
						</div>
						
						<div class="row" style="margin-top:22px;">
						<div style="width: 50%;float: left;">
						<table style="border-collapse: collapse; margin-top: 22px;  border: 2px solid black;">
						<thead style="text-align: center;">
						<!-- Your content here -->
						</thead>
						<tbody>
						<tr>
						<td style="text-align: left; height: 45px; border: 1px solid black;">
						校│<br>長│' . $getteacherdata['data']['principal'] . '
						</td>
						</tr>
						</tbody>
						</table>
						</div>
						<div style="width: 1%;"></div>
						<div style="width: 48%; float: right;">
						<table style="border-collapse: collapse; margin-top: 22px; border: 2px solid black;">
						<thead style="text-align: center;">
						<!-- Your content here -->
						</thead>
						<tbody>
						<tr>
						<td style="text-align: left; height: 45px; border: 1px solid black;">
						担│<br>任│ ' . $getteacherdata['data']['teacher'] . '
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

					$pdf = \App::make('dompdf.wrapper');

					// Set custom paper size
					$customPaper = [0, 0, 792.00, 1224.00];
					$pdf->set_paper($customPaper);
					$pdf->loadHTML($output);
					// return $pdf->stream();
					// Filename setup
					$fileName = __('messages.report_card') . "-" . $stu['name'] . ".pdf";
					$pdfFilePath = $storagePath . '/' . $fileName;

					// Save the PDF to the specified folder
					$pdf->save($pdfFilePath);

					// Add the PDF file path to the array
					$pdfFiles[] = $pdfFilePath;
				}
			}
			if ($stuclass == 3 || $stuclass == 4) {
				$sno = 0;
				$bdata = [
					'id' => session()->get('branch_id'),
				];
				$getbranch = Helper::PostMethod(config('constants.api.branch_details'), $bdata);
				foreach ($getstudents['data'] as $stu) {
					$sno++;
					$attendance_no = isset($stu['attendance_no']) ? $stu['attendance_no'] : "00";
					$output = '<!DOCTYPE html>
						<html lang="en">
						
						<head>
							<meta charset="utf-8" />
							<title>Primary_grade3_4</title>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
							<meta name="description" content="Paxsuzen School is a premier educational institution that offers quality education to students of all ages. Our curriculum is designed to prepare future leaders for success in the global marketplace.">
							<meta name="keywords" content="Paxsuzen School, education, future leaders, curriculum">
							<meta content="Paxsuzen" name="author" />
							<style>
								';
					$output .= '@font-face {
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
									word-wrap: break-word;
									font-size: 16px;
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
						
						<body>
							<div class="content">
								<div class="row">
									<div class="column">
										<p style="font-size: 20px;">クアラルンプール日本人学校　小学部</p>
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
									<div class="column1" style="width:19%;">
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
						
								<div class="row">
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
					$result1 = [];
					$sub1 = array('国<br>語', '社<br>会', '算<br>数', '理<br>科', '音<br>楽', '図<br>画<br>工<br>作', '体<br>育');
					foreach ($getprimarysubjects as $subject) {

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
						//$result1[] = $getmarks;

						// dd($getmarks);
						$i = 0;
						$n = count($getmarks['data']);

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

								$output .= '<td style="width:2%;  height: 25px;">' . $mark . '</td>';
							}
							$output .= ' </tr>';
							//dd($subject);
						}
						$p++;
					}
					$output .= '</tbody>
										</table>';
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
						'subject' => $specialsubject6,
						'papers' => $description

					];
					$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
					$i = 0;
					$n = count($getmarks['data']);
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
													<td colspan="5" style="height:140px;text-align:left;vertical-align: top;word-wrap: break-word;">';
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
													<th style="border: 1px solid black; font-weight:italic; text-align: center;">出欠の記録</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;">授業<br>日数</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;font-size:10px;">出席停止<br>忌引き等</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;font-size:10px;">出席しなければ<br>ならない日<br>数</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;">欠席<br>日数</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;">出席<br>日数</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;">遅刻</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;">早退</th>
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

					$attarray = array('', '1月', ' 2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月');
					$getattendance = Helper::PostMethod(config('constants.api.getsem_studentattendance'), $attdata);
					//dd($getattendance);
					$at_tot1 = 0;
					$at_tot2 = 0;
					$at_tot3 = 0;
					$at_tot4 = 0;
					$at_tot5 = 0;
					$at_tot6 = 0;
					$at_tot7 = 0;
					foreach ($getattendance['data'] as $att) {
						$at_tot1 += $att['no_schooldays'];
						$at_tot2 += $att['suspension'];
						$at_tot3 += $att['totalcoming'];
						$at_tot4 += $att['totabs'];
						$at_tot5 += $att['totpres'];
						$at_tot6 += $att['totlate'];
						$at_tot7 += $att['totexc'];
						$output .= '<tr>
												<td style="height: 22px;">' . $attarray[intval($att['month'])] . '</td>
												<td style="height: 22px;">' . $att['no_schooldays'] . '</td>
												<td style="height: 22px;">' . $att['suspension'] . '</td>
												<td style="height: 22px;">' . $att['totalcoming'] . '</td>
												<td style="height: 22px;">' . $att['totabs'] . '</td>
												<td style="height: 22px;">' . $att['totpres'] . '</td>
												<td style="height: 22px;">' . $att['totlate'] . '</td>
												<td style="height: 22px;">' . $att['totexc'] . '</td>
											</tr>';
					}
					$output .= '<tr style="border-top: 2px solid black;">
											<td style="height: 25px;"> 合計</td>
											<td style="height: 25px;">' . $at_tot1 . '</td>
											<td style="height: 25px;">' . $at_tot2 . '</td>
											<td style="height: 25px;">' . $at_tot3 . '</td>
											<td style="height: 25px;">' . $at_tot4 . '</td>
											<td style="height: 25px;">' . $at_tot5 . '</td>
											<td style="height: 25px;">' . $at_tot6 . '</td>
											<td style="height: 25px;">' . $at_tot7 . '</td>
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
						'subject' => $specialsubject1,
						'papers' => $getspecialpapers
					];
					$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
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
											<td colspan="4" style="text-align:left;width:100px;">' . $papers['papers'] . '</td>
											<td colspan="1">' . $fmark . '
											</td>
											</tr>';
					}
					$output .= '</tbody>
										</table>';
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
						'subject' => $specialsubject2,
						'papers' => $description

					];
					$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
					$i = 0;
					$n = count($getmarks['data']);
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
					$output .= '<table class="table table-bordered" style="border: 2px solid black;margin-top:20px;">
											<thead class="colspanHead">
												<tr>
													<td colspan="5">特別の教科　道徳　(3学期に記載)</td>
												</tr>
											</thead>
											<tbody>
												<tr style="border-top: 2px solid black;">
													<td colspan="5" style="height:146px;text-align:left;vertical-align: top;word-wrap: break-word;">';
					$comment = explode("\n", $mark1);
					foreach ($comment as $cmt) {
						$output .= $cmt . '<br>';
					}
					$output .= '</td>
												</tr>
											</tbody>
										</table>';
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
						'subject' => $specialsubject5,
						'papers' => $description

					];
					$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
					$i = 0;
					$n = count($getmarks['data']);
					$mark2 = '';
					foreach ($getmarks['data'] as $papers) {
						$nsem = count($papers['marks']);
						$s = 0;
						if (!empty($papers['marks'])) {
							foreach ($papers['marks'] as $mark) {
								$s++;
								// if ($s == 2) {

								// 	$mark2 = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
								// }

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
													<td colspan="5" style="height:146px;text-align:left;vertical-align: top;word-wrap: break-word;">';
					$comment = explode("\n", $mark2);
					foreach ($comment as $cmt) {
						$output .= $cmt . '<br>';
					}
					$output .= '</td>
												</tr>
											</tbody>
										</table>';
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
						'subject' => $specialsubject3,
						'papers' => $description

					];
					$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
					$i = 0;
					$n = count($getmarks['data']);
					$mark4 = '';
					foreach ($getmarks['data'] as $papers) {
						$nsem = count($papers['marks']);
						$s = 0;
						if (!empty($papers['marks'])) {
							foreach ($papers['marks'] as $mark) {

								// $mark = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
								// $s++;
								// $mark4 .= $s . ' 学期 - ' . $mark . '<br>';
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
													<td colspan="5" style="height:146px;text-align:left;vertical-align: top;word-wrap: break-word;">';
					$comment = explode("\n", $mark4);
					foreach ($comment as $cmt) {
						$output .= $cmt . '<br>';
					}
					$output .= '</td>
												</tr>
											</tbody>
										</table>';
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
						'subject' => $specialsubject4,
						'papers' => $description

					];
					$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
					$i = 0;
					$n = count($getmarks['data']);
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
								// if ($s == $nsem) {

								// 	$mark5 = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
								// }
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
													<td colspan="5" style="height:146px;text-align:left;vertical-align: top;word-wrap: break-word;">';
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
												<p style="text-align: right; margin-top:0px;marign-bottom:25px;font-size:14px;">※1，2学期の内容は、三者懇談でお伝えさせていただきます。</p>
											</div>
										</div>
						
										<div class="row" style="margin-top:17px;">
											<div style="width: 50%;float: left;">
												<table style="border-collapse: collapse; margin-top: 20px;  border: 2px solid black;">
													<thead style="text-align: center;">
														<!-- Your content here -->
													</thead>
													<tbody>
														<tr>
															<td style="text-align: left; height: 45px; border: 1px solid black;">
																校│<br>長│' . $getteacherdata['data']['principal'] . '
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div style="width: 1%;"></div>
											<div style="width: 48%; float: right;">
												<table style="border-collapse: collapse; margin-top: 20px; border: 2px solid black;">
													<thead style="text-align: center;">
														<!-- Your content here -->
													</thead>
													<tbody>
														<tr>
															<td style="text-align: left; height: 45px; border: 1px solid black;">
																担│<br>任│' . $getteacherdata['data']['teacher'] . '
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
					$pdf = \App::make('dompdf.wrapper');

					// Set custom paper size
					$customPaper = array(0, 0, 792.00, 1300.00);
					$pdf->set_paper($customPaper);
					$pdf->loadHTML($output);
					// return $pdf->stream();
					// Filename setup
					$fileName = __('messages.report_card') . "-" . $stu['name'] . ".pdf";
					$pdfFilePath = $storagePath . '/' . $fileName;

					// Save the PDF to the specified folder
					$pdf->save($pdfFilePath);

					// Add the PDF file path to the array
					$pdfFiles[] = $pdfFilePath;
				}
			}
			if ($stuclass == 5 || $stuclass == 6) {
				$sno = 0;
				$bdata = [
					'id' => session()->get('branch_id'),
				];
				$getbranch = Helper::PostMethod(config('constants.api.branch_details'), $bdata);
				foreach ($getstudents['data'] as $stu) {
					$sno++;
					$attendance_no = isset($stu['attendance_no']) ? $stu['attendance_no'] : "00";
					$output = '<!DOCTYPE html>
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
					$output .= '@font-face {
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
									font-size: 16px;
									line-height: 20px;
									letter-spacing: 0.0133em;
									word-wrap: break-word;
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
						
						<body>
							<div class="content">
								<div class="row">
									<div class="column">
										<p style="margin: 0;font-size:20px;">クアラルンプール日本人学校　小学部</p>
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
									<div class="column1" style="width:19%;">
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
						
								<div class="row">
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
					$result1 = [];
					$sub1 = array('国<br>語', '社<br>会', '算<br>数', '理<br>科', '音<br>楽', '図<br>画<br>工<br>作', '家<br>庭', '体<br>育', '外<br>国<br>語');
					foreach ($getprimarysubjects as $subject) {

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
						//$result1[] = $getmarks;


						$i = 0;
						$n = count($getmarks['data']);

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

								$output .= '<td style="width:2%;  height: 30px;">' . $mark . '</td>';
							}
							$output .= ' </tr>';
							//dd($subject);
						}
						$p++;
					}
					$output .= '</tbody>
										</table>
						
										<!-- Second table and additional content... -->
										<table class="table table-bordered table-responsive" style="border: 2px solid black;margin-top:45px;height:25%;">
											<thead class="colspanHead">
												<tr>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;">出欠の<br>記録</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;">授業<br>日数</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;">出席停止<br>忌引き等</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;">出席しなけれ<br>ば<br>ならない日数</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;">欠席<br>日数</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;">出席<br>日数</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;">遅刻</th>
													<th style="border: 1px solid black; font-weight:italic; text-align: center;">早退</th>
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

					$attarray = array('', '1月', ' 2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月');
					$getattendance = Helper::PostMethod(config('constants.api.getsem_studentattendance'), $attdata);
					//dd($getattendance);
					$at_tot1 = 0;
					$at_tot2 = 0;
					$at_tot3 = 0;
					$at_tot4 = 0;
					$at_tot5 = 0;
					$at_tot6 = 0;
					$at_tot7 = 0;
					foreach ($getattendance['data'] as $att) {
						$at_tot1 += $att['no_schooldays'];
						$at_tot2 += $att['suspension'];
						$at_tot3 += $att['totalcoming'];
						$at_tot4 += $att['totabs'];
						$at_tot5 += $att['totpres'];
						$at_tot6 += $att['totlate'];
						$at_tot7 += $att['totexc'];
						$output .= '<tr>
												<td style="height: 25px;">' . $attarray[intval($att['month'])] . '</td>
												<td style="height: 25px;">' . $att['no_schooldays'] . '</td>
												<td style="height: 25px;">' . $att['suspension'] . '</td>
												<td style="height: 25px;">' . $att['totalcoming'] . '</td>
												<td style="height: 25px;">' . $att['totabs'] . '</td>
												<td style="height: 25px;">' . $att['totpres'] . '</td>
												<td style="height: 25px;">' . $att['totlate'] . '</td>
												<td style="height: 25px;">' . $att['totexc'] . '</td>
											</tr>';
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
						'subject' => $specialsubject1,
						'papers' => $getspecialpapers
					];
					$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
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
											<td colspan="4" style="height:40px;text-align:left;width:100px;">' . $papers['papers'] . '</td>
											<td colspan="1">' . $fmark . '
											</td>
											</tr>';
					}

					$output .= '</tbody>
										</table>';
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
						'subject' => $specialsubject2,
						'papers' => $description

					];
					$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
					$i = 0;
					$n = count($getmarks['data']);
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
						'subject' => $specialsubject5,
						'papers' => $description

					];

					$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
					$i = 0;

					$n = count($getmarks['data']);
					$mark2 = '';
					foreach ($getmarks['data'] as $papers) {
						$nsem = count($papers['marks']);
						$s = 0;
						if (!empty($papers['marks'])) {
							foreach ($papers['marks'] as $mark) {
								$s++;
								// if ($s == 2) {

								// 	$mark2 = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
								// }

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
						'subject' => $specialsubject3,
						'papers' => $description

					];
					$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
					$i = 0;
					$n = count($getmarks['data']);
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
						'subject' => $specialsubject4,
						'papers' => $description

					];
					$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
					$i = 0;
					$n = count($getmarks['data']);
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
						
										<div class="row" style="margin-top:15px;">
											<div style="width: 50%;float: left;">
												<table style="border-collapse: collapse; margin-top: 22px;  border: 2px solid black;">
													<thead style="text-align: center;">
														<!-- Your content here -->
													</thead>
													<tbody>
														<tr>
															<td style="text-align: left; height: 45px; border: 1px solid black;">
																校│<br>長│' . $getteacherdata['data']['principal'] . '
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div style="width: 1%;"></div>
											<div style="width: 48%; float: right;">
												<table style="border-collapse: collapse; margin-top: 22px; border: 2px solid black;">
													<thead style="text-align: center;">
														<!-- Your content here -->
													</thead>
													<tbody>
														<tr>
															<td style="text-align: left; height: 45px; border: 1px solid black;">
																担│<br>任│ ' . $getteacherdata['data']['teacher'] . '
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
					$pdf = \App::make('dompdf.wrapper');

					// Set custom paper size
					$customPaper = [0, 0, 792.00, 1330.00];
					$pdf->set_paper($customPaper);
					$pdf->loadHTML($output);
					// return $pdf->stream();
					// Filename setup
					$fileName = __('messages.report_card') . "-" . $stu['name'] . ".pdf";
					$pdfFilePath = $storagePath . '/' . $fileName;

					// Save the PDF to the specified folder
					$pdf->save($pdfFilePath);

					// Add the PDF file path to the array
					$pdfFiles[] = $pdfFilePath;
				}
			}
		} elseif ($request->department_id == 2) // Secondary 
		{
			$sno = 0;

			$bdata = [
				'id' => session()->get('branch_id'),
			];
			$getbranch = Helper::PostMethod(config('constants.api.branch_details'), $bdata);


			foreach ($getstudents['data'] as $stu) {
				$sno++;
				$attendance_no = isset($stu['attendance_no']) ? $stu['attendance_no'] : "00";
				$output = '<!DOCTYPE html>
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
				$output .= '@font-face {
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
					line-height: 18px;
					letter-spacing: 0.0133em;
					word-wrap: break-word;
					font-size:16px;
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
					
					<body>
					<div class="content">
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
					
					<div class="row">
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
				$result1 = [];
				$sub1 = array('国<br>語', '社<br>会', '数<br>学', '理<br>科', '音<br>楽', '美<br>術', '保<br健<br>体<br>育', '体<br>育');
				foreach ($getprimarysubjects as $subject) {

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
					//$result1[] = $getmarks;


					$i = 0;
					$n = count($getmarks['data']);

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

									$output .= '<td style="width:2%;  height: 30px;">' . $mark . '</td>';
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
					<table class="table table-bordered table-responsive" style="border: 2px solid black;height:25%;margin-top:23px;width:100%">
					<thead class="colspanHead">
					<tr>
					<th style="border: 1px solid black; font-weight:italic; text-align: center;">出欠の<br>記録</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center;">授業<br>日数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center;font-size:12px; ">出席停<br>止<br>忌引き等</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center;font-size:12px; ">出席しなけれ<br>ばならない日<br>数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center;">欠席<br>日数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center;">出席<br>日数</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center;">遅刻</th>
					<th style="border: 1px solid black; font-weight:italic; text-align: center;">早退</th>
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

				$attarray = array('', '1月', ' 2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月');
				$getattendance = Helper::PostMethod(config('constants.api.getsem_studentattendance'), $attdata);
				//dd($getattendance);
				$at_tot1 = 0;
				$at_tot2 = 0;
				$at_tot3 = 0;
				$at_tot4 = 0;
				$at_tot5 = 0;
				$at_tot6 = 0;
				$at_tot7 = 0;
				foreach ($getattendance['data'] as $att) {
					$at_tot1 += $att['no_schooldays'];
					$at_tot2 += $att['suspension'];
					$at_tot3 += $att['totalcoming'];
					$at_tot4 += $att['totabs'];
					$at_tot5 += $att['totpres'];
					$at_tot6 += $att['totlate'];
					$at_tot7 += $att['totexc'];
					$output .= '<tr>
						<td>' . $attarray[intval($att['month'])] . '</td>
						<td>' . $att['no_schooldays'] . '</td>
						<td>' . $att['suspension'] . '</td>
						<td>' . $att['totalcoming'] . '</td>
						<td>' . $att['totabs'] . '</td>
						<td>' . $att['totpres'] . '</td>
						<td>' . $att['totlate'] . '</td>
						<td>' . $att['totexc'] . '</td>
					</tr>';
				}
				$output .= '<tr style="border-top: 2px solid black;">
					<td> 合計</td>
					<td>' . $at_tot1 . '</td>
					<td>' . $at_tot2 . '</td>
					<td>' . $at_tot3 . '</td>
					<td>' . $at_tot4 . '</td>
					<td>' . $at_tot5 . '</td>
					<td>' . $at_tot6 . '</td>
					<td>' . $at_tot7 . '</td>
				</tr>';


				$output .= '</tbody>
					</table>
					
					</div>
					
					<div class="column2" style="width:1%;">
					</div>
					<div class="column2" style="width:39%;">';
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
					'subject' => $specialsubject1,
					'papers' => $getspecialpapers
				];
				$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
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
					<td colspan="4" style="text-align:left;width:100px;">' . $papers['papers'] . '</td>
					<td colspan="1">' . $fmark . '
					</td>
					</tr>';
				}

				$output .= '</tbody>
					</table>';
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
					'subject' => $specialsubject2,
					'papers' => $description

				];
				$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
				$i = 0;
				$n = count($getmarks['data']);
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
							// if ($s == 2) {

							// 	$mark1 = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
							// }
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
					<td colspan="5" style="height:180px;text-align:left;vertical-align: top;word-wrap: break-word;">';
				$comment = explode("\n", $mark1);
				foreach ($comment as $cmt) {
					$output .= $cmt . '<br>';
				}
				$output .= '</td>
					</tr>
					</tbody>
					</table>';
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
					'subject' => $specialsubject5,
					'papers' => $description

				];
				$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
				$i = 0;
				$n = count($getmarks['data']);
				$mark2 = '';
				foreach ($getmarks['data'] as $papers) {
					$nsem = count($papers['marks']);
					$s = 0;
					if (!empty($papers['marks'])) {
						foreach ($papers['marks'] as $mark) {
							$s++;
							// if ($s == $nsem) {

							// 	$mark2 = (isset($mark['freetext']) && $mark['freetext'] != null) ? $mark['freetext'] : '';
							// }
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
					<td colspan="5" style="height:180px;text-align:left;vertical-align: top;word-wrap: break-word;">';
				$comment = explode("\n", $mark2);
				foreach ($comment as $cmt) {
					$output .= $cmt . '<br>';
				}
				$output .= '</td>
					</tr>
					</tbody>
					</table>';
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
					'subject' => $specialsubject3,
					'papers' => $description

				];
				$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
				$i = 0;
				$n = count($getmarks['data']);
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
					<td colspan="5" style="height:180px;text-align:left;vertical-align: top;word-wrap: break-word;">';
				$comment = explode("\n", $mark3);
				foreach ($comment as $cmt) {
					$output .= $cmt . '<br>';
				}
				$output .= '</td>
					</tr>
					</tbody>
					</table>';
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
					'subject' => $specialsubject4,
					'papers' => $description

				];
				$getmarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
				$i = 0;
				$n = count($getmarks['data']);
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
					<td colspan="5" style="height:180px;text-align:left;vertical-align: top;word-wrap: break-word;">';
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
					<p style="text-align: right; margin-top:0px;marign-bottom:20px;font-size:12px;">※1,2学期の内容は、三者懇談でお伝えさせていただきます。                                </p>
				</div>
			</div>
			
			
			<div class="row" style="margin-top:82px;">
									<div style="width: 50%;float: left;">
										<table style="border-collapse: collapse; margin-top: 22px;  border: 2px solid black;">
											<thead style="text-align: center;">
												<!-- Your content here -->
											</thead>
											<tbody>
												<tr>
													<td style="text-align: left; height: 45px; border: 1px solid black;">
														校│<br>長│' . $getteacherdata['data']['principal'] . '
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div style="width: 1%;"></div>
									<div style="width: 48%; float: right;">
										<table style="border-collapse: collapse; margin-top: 22px; border: 2px solid black;">
											<thead style="text-align: center;">
												<!-- Your content here -->
											</thead>
											<tbody>
												<tr>
													<td style="text-align: left; height: 45px; border: 1px solid black;">
														担│<br>任│ ' . $getteacherdata['data']['teacher'] . '
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
				$pdf = \App::make('dompdf.wrapper');

				// Set custom paper size
				$customPaper = [0, 0, 792.00, 1300.00];
				$pdf->set_paper($customPaper);
				$pdf->loadHTML($output);

				// Filename setup
				$fileName = __('messages.report_card') . "-" . $stu['name'] . ".pdf";
				$pdfFilePath = $storagePath . '/' . $fileName;

				// Save the PDF to the specified folder
				$pdf->save($pdfFilePath);

				// Add the PDF file path to the array
				$pdfFiles[] = $pdfFilePath;
			}
		}
		// Create a ZIP file
		$now = now();
		$timestamp = strtotime($now);
		$depdata = [
			'id' => $request->department_id,
		];
		$departmentinfo = Helper::PostMethod(config('constants.api.department_details'), $depdata);

		$zipFileName = __('messages.report_card') . "-" . $departmentinfo['data']['name'] . "-" . $gradename . "-" . $classname . "-" . $timestamp . ".zip";
		$zipFilePath = $storagePath . '/' . $zipFileName;

		$zip = new ZipArchive();
		if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
			foreach ($pdfFiles as $pdfFile) {
				$zip->addFile($pdfFile, basename($pdfFile));
			}
			$zip->close();
		}
		if (File::exists($zipFilePath)) {
			// Read the ZIP file content
			$zipContent = File::get($zipFilePath);

			// Set the appropriate HTTP headers
			$headers = [
				'Content-Type' => 'application/zip',
				'Content-Disposition' => 'attachment; filename=' . rawurlencode($zipFileName),
				'Content-Length' => strlen($zipContent),
			];

			// Return the response with headers and delete the file after sending
			$response = response($zipContent)->withHeaders($headers);

			// Delete the file after sending the response
			File::delete($zipFilePath);

			// Return the response
			return $response;
			//return response()->download($zipFilePath)->deleteFileAfterSend(true);
		}
		// Download the ZIP file


	}
	public function downbypersoanalreport(Request $request)
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
		];
		$language = "国語";
		$socity = "社会";
		$math = "数学";
		$science = "理科";
		$english = "英語";
		$music = "音楽";
		$art = "美術";
		$sport = "保体";
		$engineer = "技家";

		$getstudents = Helper::PostMethod(config('constants.api.exam_studentslist'), $data);
		if (empty($getstudents['data'])) {
			return redirect()->route('admin.exam_results.byreport')->with('errors', "No Student Data Found");
		}
		$getmainsubjects = array($language, $socity, $math, $science, $english);
		$getnonmainsubjects = array($music, $art, $sport, $engineer);
		$footer_text = session()->get('footer_text');
		$personal_score = "個人得点"; //   individual score

		$fonturl = storage_path('fonts/ipag.ttf');
		$sno = 0;
		$storagePath = storage_path('app/public/pdfs');

		// Ensure the storage directory exists
		if (!File::exists($storagePath)) {
			File::makeDirectory($storagePath, 0755, true);
		}

		$pdfFiles = [];
		foreach ($getstudents['data'] as $stu) {
			$sno++;
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
					word-wrap: break-word;
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
				.table th, .table td {
					border: none; /* Removes borders from table headers and cells */
					padding: 8px; /* Adds padding for better readability */
					text-align: left; /* Aligns text to the left */
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
			$sno = 0;

			$grade = Helper::PostMethod(config('constants.api.class_details'), $data);
			$section = Helper::PostMethod(config('constants.api.section_details'), $data);
			$gradename = $grade['data']['name'];
			$classname = $section['data']['name'];
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

			$output .= '<table class="table" width="100%" border=0>			
					
					<tr>
						<td >
							<p>' . $grade['data']['name'] . ' </p>
						</td>
						<td>
							<p>' . $request->semester_id . ' 学期</p>
						</td>
						<td>
							<p><p>' . $term['data']['name'] . '</p> </p>
						</td>
						<td>クラス : ' . $section['data']['name'] . '</td>
						<td>番 : ' . $sno . '</td>
					</tr>
				
					<tr style="height:60px;">
						<td colspan="2">ロール番号 : ' . $stu['attendance_no'] . '</td>
						<td colspan="3">名前 :' . $stu['name'] . '</td>
					</tr>
					<tr> 
						<td colspan="5" >
						<table  width="100%" border=1>
						<thead>                
							<tr>
								<td style=" border: 1px solid #959595;"></td>';
			$main = 0;
			$opt = 0;

			foreach ($getmainsubjects as $mainsubject) {
				$main++;
				$output .= ' <td style=" border: 1px solid #959595;">' . $mainsubject . '</td>';
			}
			foreach ($getnonmainsubjects as $optsubject) {
				$opt++;
				$output .= ' <td style=" border: 1px solid #959595;">' . $optsubject . '</td>';
			}

			$output .= ' <td style=" border: 1px solid #959595;">5教科合計</td>
								<td style=" border: 1px solid #959595;">9教科合計</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style=" border: 1px solid #959595;">個人得点</td>';
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

				$output .= '<td colspan="1" style=" border: 1px solid #959595;">' . $mark . '</td>';
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


				$output .= '<td colspan="1" style=" border: 1px solid #959595;">' . $mark . '</td>';
				$mark = ($mark != '') ? $mark : 0;
				$totalopt += $mark;
			}
			$totall = $totalmain + $totalopt;
			$output .= '<td style=" border: 1px solid #959595;">' . $totalmain . '</td>
										<td style=" border: 1px solid #959595;">' . $totall . '</td>';

			$output .= '</tr>
							<tr>
								<td style=" border: 1px solid #959595;">学年平均</td>';
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

				$output .= '<td colspan="1" style=" border: 1px solid #959595;">' . $mark . '</td>';
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

				$output .= '<td colspan="1" style=" border: 1px solid #959595;">' . $mark . '</td>';
				$mark = ($mark != '') ? $mark : 0;

				$totalavgopt += $mark;
			}


			$avgtotal1 = $totalavgmain / $ma;
			$avgtotal2 = ($totalavgmain + $totalavgopt) / ($ma + $op);
			$output .= '  <td style=" border: 1px solid #959595;">' . round($avgtotal1, 2) . '</td>
								<td style=" border: 1px solid #959595;">' . round($avgtotal2, 2) . '</td>
							</tr>
						</tbody>
					</table>
					<br>
					<p style="text-align:left">学習の振り返り</p>
					<table  width="100%">
						<thead>
							<tr style="height:60px;">
								<td style=" border: 1px solid #959595;">できたこと・よかったこと </td>
								<td style=" border: 1px solid #959595;">できなかったこと・反省，今後の学習に向けて</td>
								<td style=" border: 1px solid #959595;">保護者の方のコメント</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style=" border: 1px solid #959595;height:200px;"></td>
								<td style=" border: 1px solid #959595;height:200px;"></td>
								<td style=" border: 1px solid #959595;height:200px;"></td>
							</tr>
						</tbody>
					</table>
						</td>
					</tr>
					
					
				</table>
				
				</body>
				</html';
			$pdf = \App::make('dompdf.wrapper');

			// Set custom paper size
			$customPaper = [0, 0, 792.00, 1224.00];
			$pdf->set_paper($customPaper);
			$pdf->loadHTML($output);

			// Filename setup
			$fileName = __('messages.personal_test_res') . "-" . $stu['name'] . ".pdf";
			$pdfFilePath = $storagePath . '/' . $fileName;

			// Save the PDF to the specified folder
			$pdf->save($pdfFilePath);

			// Add the PDF file path to the array
			$pdfFiles[] = $pdfFilePath;
		}
		// Create a ZIP file
		$now = now();
		$timestamp = strtotime($now);
		$depdata = [
			'id' => $request->department_id,
		];
		$departmentinfo = Helper::PostMethod(config('constants.api.department_details'), $depdata);

		$zipFileName = __('messages.personal_test_res') . "-" . $departmentinfo['data']['name'] . "-" . $gradename . "-" . $classname . "-" . $timestamp . ".zip";

		$zipFilePath = $storagePath . '/' . $zipFileName;

		$zip = new ZipArchive();
		if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
			foreach ($pdfFiles as $pdfFile) {
				$zip->addFile($pdfFile, basename($pdfFile));
			}
			$zip->close();
		}

		// Download the ZIP file
		if (File::exists($zipFilePath)) {
			return response()->download($zipFilePath)->deleteFileAfterSend(true);
		}
	}
	public function downprimaryform1($id)
	{
		ini_set('max_execution_time', 600);
    	ini_set('memory_limit', '1024M');
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
		$output .= '<meta name="description"
        content="Paxsuzen School is a premier educational institution that offers quality education to students of all ages.
         Our curriculum is designed to prepare future leaders for success in the global marketplace.">';
		$output .= '<meta name="keywords" content="Paxsuzen School, education, future leaders, curriculum">';
		$output .= '<meta content="Paxsuzen" name="author" />';
		$output .= '<style>';
		// $test .='* { font-family: DejaVu Sans, sans-serif; }';
		$output .= '@font-face {
                   font-family: Open Sans ipag;
                   font-style: normal;
                   font-weight: 300;
                   src: url("' . $fonturl . '");
                   }
                   body {
                    font-family: "ipag", "Open Sans", !important;
                    }  
                    .table {
                        width: 100%;
                        color: black;
                        text-align: center;
                        border-collapse: collapse;
                        /* Ensures borders are collapsed */
                        border: 3px solid black;
                    }
                    .table {
                        width: 100%;
                        margin-bottom: 1px;
                        color: black;
                        text-align: center;
                        border-collapse: collapse;
                        /* Ensures borders are collapsed */
                        border: 2px solid black;
                    }
       
                    .table th,
                    .table td {
                        text-align: center;
                        padding: 10px;
                        /* Add padding for better spacing */
                        border: 1px solid black;
                    }
           
                    .table td {
                        color: #3A4265;
                    }
           
                    .diagonalCross {
                        position: relative;
                        padding: 10px;
                        border: none;
                        text-align: center;
                    }
           
                    .diagonalCross::after {
                        content: "";
                        position: absolute;
                        width: 2px;
                        /* Thickness of the lines */
                        height: 3.8%;
                        background-color: black;
                        /* Color of the lines */
                        top: 0;
                        left: 0%;
                        transform-origin: center;
                    }
           
                    .diagonalCross::after {
                        transform: rotate(-45deg);
                    }
           
                    .diagonalCross1 {
                        position: relative;
                        padding: 10px;
                        border: none;
                        text-align: center;
                    }
           
                    .diagonalCross1::after {
                        content: "";
                        position: absolute;
                        width: 2px;
                        /* Thickness of the lines */
                        height: 4%;
                        background-color: black;
                        /* Color of the lines */
                        top: 0%;
                        left: -62%;
                        right: 50%;
                        transform-origin: center;
                    }
           
                    .diagonalCross1::after {
                        transform: rotate(-45deg);
                    }
           
                   
        </style>';
		$output .= "</head>";
		$output .= "<body>";
		$output .= ' <div class="content">
        <p style=" text-align:center;font-size:20px;">小　学　校　児　童　指　導　要　録</p>
        <p class="float-left;">様式１（学籍に関する記録）</p>
        <table class="main" width="100%">
        <tr>
        <table class="table table-bordered" style="width: 50%;">
        <thead>
        <tr>
            <td>番号入力</td>
        </tr>
        <tr>
           <td>' . $student['attendance_no'] . '</td>
        </tr>
         </thead>
        </table>
        <td>
        <table class="table table-bordered" style="margin-bottom: 15px;">
            <thead>
                <tr>
                    <td colspan="2" style="text-align:center;">区分</td>
                    <td colspan="1" class="diagonalCross"
                        style="width:50px;border-right:hidden; border-left:hidden;"></td>
                    <td colspan="1" style="text-align:center;">学年</td>';
		$getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
		//dd('$getgrade');
		$i = 1;
		foreach ($getgrade['data'] as $grade) {
			if ($i <= 6) {
				$output .= ' <td>' . $grade['name_numeric'] . '</td>';
			}
			$i++;
		}
		$output .= '</tr>
            </thead>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4">学 級</td>';
		$i = 1;

		foreach ($getclasssec['data'] as $sec) {
			if ($i <= 6) {
				$output .= '<td> ' . $sec['section'] . '</td>';
			}
			$i++;
		}
		$output .= '</tr>
                <tr>
                    <td colspan="4">整 理 番 号</td>';
		$i = 1;
		foreach ($getclasssec['data'] as $sec) {
			if ($i <= 6) {
				$output .= '<td> ' . $sec['studentPlace'] . '</td>';
			}
			$i++;
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
                    <td colspan="13" style="text-align:center; border: 1px solid black;font-size:20px;">
                        <p
                            style="color:black; margin:0px 0px 0px 0px; letter-spacing:0; white-space:nowrap;">
                            学　　　　籍　　　　の　　　　記　　　　録</p>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="2">児<br>童</td>
                    <td>ふりがな<br>氏　　名</td>
                    <td colspan="3">' . $student['first_name'] . ' ' . $student['last_name'] . '<br>
                        東京　花子<br>
                        3/28/2008<br>
                        生<br></td>
                    <td style="padding:0px !important; width:13px;">性 <br> 別</td>
                    <td style="padding:0px !important; width:13px;">女</td>
                    <td colspan="3">入学前の経歴 </td>
                    <td colspan="3">岡山市立岡山中央小学校</td>
                </tr>
                <tr>
                    <td>現住所(current Address)</td>
                    <td colspan="5">' . $student['current_address'] . '</td>
                    <td colspan="3">入学・編入学等 </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td rowspan="3">保 <br>護 <br>者</td>
                    <td>ふりがな
                        <br> 氏名 (Furgaina name)
                    </td>
                    <td colspan="5">' . $student['first_name'] . ' ' . $student['last_name'] . '</td>
                    <td colspan="3">退　学　等 (Resignation)</td>
                    <td colspan="3"></td>
                </tr>
 
                <tr style="height:70px">
                    <td rowspan="2">現住所(Current Address)</td>
                    <td rowspan="2" colspan="5">' . $student['current_address'] . '</td>
                    <td colspan="3">卒業</td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="3" style="height:70px">進学先 </td>
                    <td colspan="3"></td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tr>
                <td colspan="4" style="width:90px">学校名<br>
                    及び<br>
                    所在地</td>
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
                <td rowspan="2" style="width:50px;">区分</td>
                <td class="diagonalCross1" style="width:50px;border-left:hidden">
                    年度
                </td>
                <td style="width:30%;">平成○年度(Heisei year)</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="width:50px;border-left:hidden">学年</td>';
		$getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
		//dd('$getgrade');
		$i = 0;
		foreach ($getgrade['data'] as $grade) {
			$i++;
			if ($i <= 3) {
				$output .= ' <td>' . $grade['name_numeric'] . '</td>';
			}
		}

		$output .= '</tr>
            <tr style="height:80px">
                <td colspan="2">校長氏名印 </td>';
		$i = 0;
		foreach ($getclasssec['data'] as $princ) {
			$i++;
			if ($i <= 3) {
				$output .= ' <td >' . $princ['principal'] . '</td>';
			}
		}

		$output .= '</tr>
            <tr style="height:80px">
                <td colspan="2">学級担任者
                    氏名印 </td>';
		$i = 0;

		foreach ($getclasssec['data'] as $teach) {
			$i++;
			if ($i <= 3) {
				$output .= ' <td>' . $teach['teacher'] . '</td>';
			}
		}

		$output .= '</tr>
            <tr>
                <td rowspan="2" style="width:50px;">区分</td>
                <td class="diagonalCross1" style="width:50px;border-left:hidden">
                    年度
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="width:50px;border-left:hidden">学年 </td>';
		$getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
		$getclasssec = Helper::PostMethod(config('constants.api.studentclasssection'), $data);
		//dd('$getgrade');
		$i = 0;
		foreach ($getgrade['data'] as $grade) {
			$i++;
			if ($i > 3 && $i <= 6) {
				$output .= ' <td >' . $grade['name_numeric'] . '</td>';
			}
		}

		$output .= '
                </tr>
            <tr style="height:80px">
                <td colspan="2">校長氏名印 </td>';
		$i = 0;
		foreach ($getclasssec['data'] as $princ) {
			$i++;
			if ($i > 3 && $i <= 6) {
				$output .= ' <td >' . $princ['principal'] . '</td>';
			}
		}

		$output .= '</tr>
            <tr style="height:80px">
                <td colspan="2">学級担任者
                    氏名印 </td>';
		$i = 0;
		foreach ($getclasssec['data'] as $teach) {
			$i++;
			if ($i > 3 && $i <= 6) {
				$output .= ' <td >' . $teach['teacher'] . '</td>';
			}
		}

		$output .= '
                </tr>
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
		$fileName = __('messages.download_form1') . "-" . $name . ".pdf";
		return $pdf->download($fileName);
		// return $pdf->stream();        

	}
	public function downsecondaryform1($id)
	{
		ini_set('max_execution_time', 600);
    	ini_set('memory_limit', '1024M');
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

		$fonturl = storage_path('fonts/ipag.ttf');
		$output = "<!DOCTYPE html>";
		$output .= "<html lang='en'><head>";
		$output .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		$output .= '<meta name="description" content="Paxsuzen School is a premier educational institution that offers quality education to students of all ages. Our curriculum is designed to prepare future leaders for success in the global marketplace.">
            ';
		$output .= '<meta name="keywords" content="Paxsuzen School, education, future leaders, curriculum">
            ';
		$output .= '<meta content="Paxsuzen" name="author" />';
		$output .= '<style>';
		// $test .='* { font-family: DejaVu Sans, sans-serif; }';
		$output .= '@font-face {
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
            </style>';
		$output .= "</head>";
		$output .= '<body><div class="content">
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
                                <td>学年</td>';
		$getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
		$getclasssec = Helper::PostMethod(config('constants.api.studentclasssection'), $data);
		$i = 1;
		foreach ($getgrade['data'] as $grade) {
			if ($i <= 3) {
				$output .= ' <td style=" border: 1px solid black;">' . $grade['name_numeric'] . '</td>';
			}
			$i++;
		}

		$output .= '
            </tr>
           
            </thead>
            <tbody>
            <tr>
            <td colspan="3">学 級</td>';
		foreach ($getclasssec['data'] as $sec) {

			$output .= '<td> ' . $sec['section'] . '</td>';
		}
		$output .= '
            </tr>
            <tr>
            <td colspan="3">整理番号</td>';
		foreach ($getclasssec['data'] as $sec) {

			$output .= '<td> ' . $sec['studentPlace'] . '</td>';
		}
		$output .= '
            </tr>
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
                    <td rowspan="2" style="padding:0px !important"></td>
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
            <td rowspan="2" colspan="8">' . $parent['address'] . ',' . $parent['address_2'] . ',' . $parent['city'] . ',' . $parent['state'] . ',' . $parent['post_code'] . ',' . $parent['country'] . '</td>
            <td  colspan="2" style="border-top:hidden"></td>
            <td style="border-top:hidden;"></td>
           </tr>
           <tr>
              <td rowspan="7" style="padding:0px !important">転学 <br>• <br> 退学等</td>
              <td style="padding:0px !important">転学するため学校 <br>を去った年月日</td>
              <td ></td>
           </tr>    
           <tr>
            <td rowspan="5" style="padding:0px !important">保 <br>護<br>者</td>
            <td >ふりがな</td>
            <td colspan="8" ></td>    
            <td rowspan="2" >退学等年月日<br>（除籍日)</td>
            <td rowspan="2"></td>                    
          </tr>
          <tr>
            <td rowspan="2">氏 名</td>
            <td colspan="8" rowspan="2">' . $parent['first_name'] . ' ' . $parent['last_name'] . '</td>
          </tr>
            <tr>
                <td>転学先学校名</td>
                <td ></td>
            </tr>
            <tr>
               <td rowspan="2" >現住所</td>
               <td colspan="8" rowspan="2">' . $parent['address'] . ',' . $parent['address_2'] . ',' . $parent['city'] . ',' . $parent['state'] . ',' . $parent['post_code'] . ',' . $parent['country'] . '</td>
               <td>同上所在地</td>
               <td ></td>
            </tr>
            <tr>
                 <td>転入学年</td>
                  <td ></td>
            </tr>
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
                <td colspan="3" style="width:104px;">年 度</td>
                <td>令和4年度</td>
                <td>令和5年度</td>
                <td>令和6年度</td>
            </tr>
            <tr>
            <td class="cell-left">区分</td>
            <td class="diagonalCross" style="border-right:hidden; border-left:hidden;"></td>
            <td class="cell-right">学年</td>';
		$getgrade = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
		$getclasssec = Helper::PostMethod(config('constants.api.studentclasssection'), $data);
		$i = 1;
		foreach ($getgrade['data'] as $grade) {
			if ($i <= 3) {
				$output .= ' <td style=" border: 1px solid black;">' . $grade['name_numeric'] . '</td>';
			}
			$i++;
		}

		$output .= '</tr>';
		'<tr style="height:80px">
            <td colspan="3">校長氏名印</td>';
		foreach ($getclasssec['data'] as $princ) {
			$output .= ' <td style=" border: 1px solid black;">' . $princ['principal'] . '</td>';
		}

		$output .= '</tr>';
		'<tr style="height:80px">
            <td colspan="3">学級担任者氏 名 印</td>
            <td></td>
            <td></td>
            <td></td>
			</tr>
			</table>
			</td>
			</tr>
			</table>
			</div>';
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
}