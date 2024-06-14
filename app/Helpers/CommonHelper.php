<?php

namespace App\Helpers;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Log;
use Dompdf\Exception;
use PDF;

class CommonHelper
{
	function fetchPaperMarks($request, $stu, $papername, $subjectID)
	{
		$pdata = [
			'branch_id' => session()->get('branch_id'),
			'exam_id' => $request->exam_id,
			'department_id' => $request->department_id,
			'class_id' => $request->class_id,
			'section_id' => $request->section_id,
			'semester_id' => $request->semester_id,
			'session_id' => $request->session_id,
			'subject_id' => $subjectID,
			'academic_session_id' => $request->academic_year,
			'student_id' => $stu['student_id'],
			'paper_name' => $papername
		];

		$paper = Helper::PostMethod(config('constants.api.getec_marks'), $pdata);

		return $paper;
	}
	function getSubjectPaperMarks($request, $stu, $papername, $subject)
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
			'subject' => $subject,
			'papers' => $papername
		];
		$papermarks = Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);

		return $papermarks;
	}
	function getSemStudentAttendance($request, $stu)
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
		];

		$getsem_studentattendance = Helper::PostMethod(config('constants.api.getsem_studentattendance'), $pdata);

		return $getsem_studentattendance;
	}

	public function getMark($paperData)
	{
		$mark = "";

		if (!empty($paperData['data'])) {
			switch ($paperData['data']['score_type']) {
				case 'Points':
					$mark = $paperData['data']['grade_name'];
					break;
				case 'Freetext':
					$mark = $paperData['data']['freetext'];
					break;
				case 'Grade':
					$mark = $paperData['data']['grade'];
					break;
				default:
					$mark = $paperData['data']['score'];
					break;
			}
		}

		return $mark;
	}
	function generatePdf($customPaper, $output, $fileName)
	{
		$pdf = \App::make('dompdf.wrapper');

		try {
			// Set paper size
			$pdf->setPaper($customPaper);
			// Log::info("Custom paper size set", ['customPaper' => $customPaper]);

			// Load HTML content
			$pdf->loadHTML($output);
			// Log::info("HTML content loaded into PDF");

			// Generate PDF
			$pdfContent = $pdf->output();
			// Log::info("PDF generated successfully");

			// Set headers for PDF response
			$headers = [
				'Content-Type' => 'application/pdf',
				'Content-Length' => strlen($pdfContent),
				'Content-Disposition' => 'attachment; filename="' . rawurlencode($fileName) . '"',
			];
			// Log::info("PDF generated successfully");

			// Return response with headers
			return response($pdfContent, 200, $headers);
		} catch (Exception $e) {
			// Log the exception details
			Log::error("Error generating PDF", [
				'message' => $e->getMessage(),
				'trace' => $e->getTraceAsString()
			]);

			// Optionally, return an error response
			return response()->json([
				'error' => 'An error occurred while generating the PDF.',
				'message' => $e->getMessage()
			], 500);
		}
	}
}
