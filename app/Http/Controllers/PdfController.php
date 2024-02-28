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
            'pattern' => $request->pattern,
            'year_month' => $request->year_month,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $footer_text = session()->get('footer_text');
        if($request->type=="Day"){
            $get_attendance_list_teacher = Helper::PostMethod(config('constants.api.get_attendance_list_teacher'), $data);
        
        }else if($request->type=="Subject"){
            $get_attendance_list_teacher = Helper::PostMethod(config('constants.api.get_attendance_list_teacher_by_subject'), $data);
        
        }// dd($get_attendance_list_teacher);

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
            $i = 1;
            if ($request->pattern == "Day") {

                $response .= '<div class="table-responsive">
            <table width="100%" style="border-collapse: collapse; border: 0px;">
               <thead>
                  <tr>
                     <th class="align-top" style="border: 1px solid; padding:12px;">#</th>
                     <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.name') . '</th>
                     <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.name_english') . '</th>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.grade') . '</th>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.class') . '</th>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.status') . '</th>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.remarks') . '</th>';

                $response .= '</tr></thead><tbody>';
                foreach ($student_details as $key => $res) {
                    $i++;
                    $status = "";
                    if ($res['status'] == "absent") {
                        $status = "Absent";
                    } else if ($res['status'] == "present") {
                        $status = "Present";
                    }
                    $response .= '<tr>
                     <td class="text-center" style="border: 1px solid; padding:12px;">' . $i . '</td>
                     <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['first_name'] . '' . $res['last_name'] . '</td>';

                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['name_english'] . '</td>';
                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['class_name'] . '</td>';
                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['section_name'] . '</td>';
                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $status . '</td>';
                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['remarks'] . '</td>';
                    $response .= '</tr>';
                }
                $response .= '</tbody></table></div>';
            } else if ($request->pattern == "Month") {
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
                     <th class="align-top" style="border: 1px solid; padding:12px;">#</th>
                     <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.name') . '</th>';
                foreach ($daterange as $date) {
                    $response .= '<th class="align-top" style="border: 1px solid; padding:12px;">' . $date->format("Y-m-d") . '</th>>';
                }
                $response .= '<th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.total_present') . '</th>>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.total_absent') . '</th>>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.total_late') . '</th>>';

                $response .= '</tr></thead><tbody>';
                foreach ($student_details as $key => $res) {
                    $i++;
                    $attendance_details = $res['attendance_details'];
                    $response .= '<tr>
                     <td class="text-center" style="border: 1px solid; padding:12px;">' . $i . '</td>
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
            } else if ($request->pattern == "Term") {

                $response .= '<div class="table-responsive">
            <table width="100%" style="border-collapse: collapse; border: 0px;">
               <thead>
                  <tr>
                     <th class="align-top" style="border: 1px solid; padding:12px;">#</th>
                     <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.name') . '</th>
                     <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.name_english') . '</th>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.grade') . '</th>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.class') . '</th>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.semester') . '</th>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.no_of_present') . '</th>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.no_of_absent') . '</th>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.no_of_late') . '</th>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.remarks') . '</th>';

                $response .= '</tr></thead><tbody>';
                foreach ($student_details as $key => $res) {
                    $i++;
                    $response .= '<tr>
                     <td class="text-center" style="border: 1px solid; padding:12px;">' . $i . '</td>
                     <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['first_name'] . '' . $res['last_name'] . '</td>';

                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['name_english'] . '</td>';
                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['class_name'] . '</td>';
                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['section_name'] . '</td>';
                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['semester_name'] . '</td>';
                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['presentCount'] . '</td>';
                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['absentCount'] . '</td>';
                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['lateCount'] . '</td>';
                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['remarks'] . '</td>';
                    $response .= '</tr>';
                }
                $response .= '</tbody></table></div>';
            } else if ($request->pattern == "Year") {

                $response .= '<div class="table-responsive">
            <table width="100%" style="border-collapse: collapse; border: 0px;">
               <thead>
                  <tr>
                     <th class="align-top" style="border: 1px solid; padding:12px;">#</th>
                     <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.name') . '</th>
                     <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.name_english') . '</th>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.grade') . '</th>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.class') . '</th>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.no_of_present') . '</th>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.no_of_absent') . '</th>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.no_of_late') . '</th>
                <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.remarks') . '</th>';

                $response .= '</tr></thead><tbody>';
                foreach ($student_details as $key => $res) {
                    $i++;
                    $response .= '<tr>
                     <td class="text-center" style="border: 1px solid; padding:12px;">' . $i . '</td>
                     <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['first_name'] . '' . $res['last_name'] . '</td>';

                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['name_english'] . '</td>';
                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['class_name'] . '</td>';
                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['section_name'] . '</td>';
                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['presentCount'] . '</td>';
                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['absentCount'] . '</td>';
                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['lateCount'] . '</td>';
                    $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['remarks'] . '</td>';
                    $response .= '</tr>';
                }
                $response .= '</tbody></table></div>';
            }
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

    // public function attendance_student_pdf_parent(Request $request)
    // {
    //     $data = [
    //         'subject_id' => $request->subject_id,
    //         'student_id' => $request->student_id,
    //         'year_month' => $request->year_month,
    //         'academic_session_id' => session()->get('academic_session_id')
    //     ];
    //     $get_attendance_list_teacher = Helper::PostMethod(config('constants.api.get_attendance_list'), $data);
    //     // dd($get_attendance_list_teacher);
    //     $footer_text = session()->get('footer_text');

    //     $fonturl = storage_path('fonts/ipag.ttf');
    //     $response = "<!DOCTYPE html>";
    //     $response .= "<html><head>";
    //     $response .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
    //     $response .= '<style>';
    //     // $test .='* { font-family: DejaVu Sans, sans-serif; }';
    //     $response .= '@font-face {
    //         font-family: ipag;
    //         font-style: normal;
    //         font-weight: normal;
    //         src: url("' . $fonturl . '");
    //     } 
    //     body{ font-family: ipag !important;}
    //     header {
    //         position: fixed;
    //         top: -60px;
    //         left: 0px;
    //         right: 0px;
    //         height: 50px;
    //         font-size: 20px !important;

    //         /** Extra personal styles **/
    //         background-color: #fff;
    //         color:  #111;
    //         text-align: center;
    //         line-height: 35px;
    //         }

    //     footer {
    //         position: fixed; 
    //         bottom: -60px; 
    //         left: 0px; 
    //         right: 0px;
    //         height: 50px; 
    //         font-size: 20px !important;

    //         /** Extra personal styles **/
    //         background-color: #fff;
    //         color: #111;
    //         text-align: center;
    //         line-height: 35px;
    //     }';
    //     $response .= '</style>';
    //     $response .= "</head>";
    //     $response .= "<body><header> " .  __('messages.attendance_report') . "</header>
    //     <footer>" . $footer_text . "</footer>";
    //     if ($get_attendance_list_teacher['code'] == "200") {
    //         $student_details = $get_attendance_list_teacher['data']['get_attendance_list'];
    //         $year_month = "01-" . $request->year_month;
    //         // First day of the month.
    //         $startDate = date('Y-m-01', strtotime($year_month));
    //         // Last day of the month.
    //         $endDate = date('Y-m-t', strtotime($year_month));
    //         $begin = new DateTime($startDate);
    //         $end = new DateTime($endDate);

    //         $end = $end->modify('+1 day');

    //         $interval = new DateInterval('P1D');
    //         $daterange = new DatePeriod($begin, $interval, $end);
    //         $response .= '<div class="table-responsive">
    //     <table width="100%" style="border-collapse: collapse; border: 0px;">
    //        <thead>
    //           <tr>
    //              <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.name') . '</th>';
    //         foreach ($daterange as $date) {
    //             $response .= '<th class="align-top" style="border: 1px solid; padding:12px;">' . $date->format("Y-m-d") . '</th>>';
    //         }
    //         $response .= '<th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.total_present') . '</th>
    //         <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.total_absent') . '</th>
    //         <th class="align-top" style="border: 1px solid; padding:12px;">' .  __('messages.total_late') . '</th>>';

    //         $response .= '</tr></thead><tbody>';
    //         foreach ($student_details as $key => $res) {
    //             $attendance_details = $res['attendance_details'];
    //             $response .= '<tr>
    //              <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['first_name'] . '' . $res['last_name'] . '</td>';
    //             foreach ($daterange as $dat) {
    //                 $checkMatch = 0;
    //                 foreach ($attendance_details as $att) {
    //                     $loopDate = $dat->format("Y-m-d");
    //                     $attDate = $att['date'];
    //                     if ($loopDate == $attDate) {
    //                         // dd($attDate);
    //                         $status = "";
    //                         if ($att['status'] == "present") {
    //                             $status = "P";
    //                         }
    //                         if ($att['status'] == "absent") {
    //                             $status = "A";
    //                         }
    //                         if ($att['status'] == "late") {
    //                             $status = "L";
    //                         }
    //                         $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $status . '</td>';
    //                         $checkMatch = 1;
    //                     }
    //                 }
    //                 if ($checkMatch == 0) {
    //                     $response .= '<td class="text-center" style="border: 1px solid; padding:12px;"></td>';
    //                     $checkMatch = 1;
    //                 }
    //             }
    //             $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['presentCount'] . '</td>';
    //             $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['absentCount'] . '</td>';
    //             $response .= '<td class="text-center" style="border: 1px solid; padding:12px;">' . $res['lateCount'] . '</td>';
    //             $response .= '</tr>';
    //         }
    //         $response .= '</tbody></table></div>';
    //     }
    //     $response .= "</body></html>";
    //     // dd($response);
    //     $pdf = \App::make('dompdf.wrapper');
    //     // set size
    //     $customPaper = array(0, 0, 1920.00, 810.00);
    //     $pdf->set_paper($customPaper);
    //     // $paper_size = array(0, 0, 360, 360);
    //     // $pdf->set_paper($paper_size);
    //     $pdf->loadHTML($response);
    //     // filename
    //     $now = now();
    //     $name = strtotime($now);
    //     $fileName = __('messages.student_attendance') . $name . ".pdf";
    //     return $pdf->download($fileName);
    // }

    
    public function attendance_student_pdf_parent(Request $request)
    {
        $data = [
            'subject_id' => $request->subject_id,
            'student_id' => $request->student_id,
            'year_month' => $request->year_month,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        // dd($data);
        $footer_text = session()->get('footer_text');
        $get_attendance_list_teacher = Helper::PostMethod(config('constants.api.get_attendance_list'), $data);
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
            $student_details = $get_attendance_list_teacher['data']['get_attendance_list'];
            $i = 0;
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
                        <th class="align-top" style="border: 1px solid; padding:12px;">#</th>
                        <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.name') . '</th>';
                    foreach ($daterange as $date) {
                        $response .= '<th class="align-top" style="border: 1px solid; padding:12px;">' . $date->format("Y-m-d") . '</th>>';
                    }
                    $response .= '<th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.total_present') . '</th>>
                    <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.total_absent') . '</th>>
                    <th class="align-top" style="border: 1px solid; padding:12px;">' . __('messages.total_late') . '</th>>';

            $response .= '</tr></thead><tbody>';
            foreach ($student_details as $key => $res) {
                $i++;
                $attendance_details = $res['attendance_details'];
                $response .= '<tr>
                    <td class="text-center" style="border: 1px solid; padding:12px;">' . $i . '</td>
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
    //
    public function downloadPDF(Request $request)
    {
        $data = [
            'date' => $request->date
        ];
        $footer_text = session()->get('footer_text');

        $health_log_books_leave_summary = Helper::PostMethod(config('constants.api.health_logbook_leave_summary'), $data);

        $headers[]  = $health_log_books_leave_summary['data']['headers'];
        $reasonCount[] = $health_log_books_leave_summary['data']['reason_count'];

        $health_log_books = Helper::PostMethod(config('constants.api.health_logbook_export'), $data);
        //dd($health_log_books);
        foreach ($health_log_books['data']['partab'] as $data) {
            $temp =  $data['temp'];
            $weather =  $data['weather'];
            $humidity =  $data['humidity'];
            $event_notes_a =  $data['event_notes_a'];
            $event_notes_b =  $data['event_notes_b'];
            $date =  $data['date'];
            $dates =  strtotime($date);
            $day = getDate($dates);
        }
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
        }';
        $response .= '</style>';
        $response .= "</head>";
        $response .= "<body>";
        $response .= ' <div class="content" style="box-sizing: border-box; max-width: 800px; display: block; margin: 0 auto; padding: 20px;border-radius: 7px; margin-top: 20px;background-color: #fff;">
            <table class="main" width="100%">
                <tr>
                    <td class="content-wrap aligncenter" style="margin: 0;padding: 20px;
                        align="center">
    
                        
                            <div class="row">
                                <div class="col-md-12">';

        $response .= '<table class="table table-bordered" style="margin-bottom: 15px;">
                                        <thead>
                                            
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="2" rowspan="4" style="text-align:center;border: 1px solid black;">' . $date . '
                                                <br>' . $day['weekday'] . '</td>
                                                <td colspan="2"  style="text-align:center;border: 1px solid black;width: 50px;height: 20px;"></td>
                                                <td rowspan="4" style="border: 1px solid black;width: 20px;"></td>
                                                <td colspan="4" rowspan="4" style=" border: 1px solid black;width: 50px;"></td>
                                                <td rowspan="4" style=" border: 1px solid black;width: 20px;"></td>
                                                <td colspan="4" rowspan="4" style=" border: 1px solid black;width: 50px;"></td>
                                                <td rowspan="4" style="border: 1px solid black;width: 20px;"></td>
                                                <td colspan="4" rowspan="4" style=" border: 1px solid black;width: 50px;"></td>
                                                <td rowspan="4" style="border: 1px solid black;width: 20px;"></td>
                                                <td colspan="' . (count($headers[0]) + 4) . '"  rowspan="4" style=" border: 1px solid black;width: 50px;"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" rowspan="1" style="text-align:center;border: 1px solid black;width: 50px;height: 20px;">' . $weather . '</td>
                                            </tr>
                                            <tr>
                                                <td rowspan="1" colspan="1" style="text-align:center;border: 1px solid black;width: 50px;height: 20px;"></td>
                                            </tr>
                                            <tr>
                                                <td  style="text-align:center;border: 1px solid black;width: 50px;height: 20px;">' . $temp . '</td>
                                                <td style="text-align:center;border: 1px solid black;width: 50px;height: 20px;">' . $humidity . '</td>
                                            </tr>
                                        </tbody>
                                        
                                        <tbody style="border: 1px solid black;">
                                            <tr>
                                                <td colspan="4" rowspan="' . (count($reasonCount[0]) + 2) . '"  style="text-align:left;border: 1px solid black;height: 20px;">' . $event_notes_a . '</td>
                                                <td colspan="' . (count($headers[0]) + 6) . '"   style="text-align:center;border: 1px solid black;height: 20px;">' .  __('messages.absense_checking') . '</td>
                                            </tr>
                                            <tr>
                                                <td  colspan="2" style="text-align:center;border: 1px solid black;height: 15px;">' .  __('messages.category') . '</td>
                                                <td colspan="2" class="diagonalCross2" style="width:0px;border: 1px solid black;border-right:hidden; border-left:hidden;"></td>
                                                <td  colspan="2" style="text-align:center;border: 1px solid black;">' .  __('messages.grade') . '</td>';
        // Display class names
        foreach ($headers as $classes) {
            // Check if 'name' key exists in the current class array
            foreach ($classes as $class) {
                $response .= '<td style=" border: 1px solid black;">' . $class['name'] . '</td>';
            }
        }
        $response .= ' </tr>';
        $staticColumnDisplayed = false;
        // Display rows based on actual data
        foreach ($reasonCount[0] as $index => $reasonData) {
            $response .= '<tr>';
            if (!$staticColumnDisplayed) {
                $response .= '<td colspan="3" rowspan="' . (count($reasonCount[0])) . '" style="text-align:center;border: 1px solid black;height: 15px;">' .  __('messages.absense') . '</td>'; // Static column
                $staticColumnDisplayed = true; // Set the flag to true after displaying the static column
            }
            $response .= '<td colspan="3" style="text-align:center;border: 1px solid black;height: 15px;">' . $reasonData['reason_name'] . '</td>';

            foreach ($headers as $classes) {
                foreach ($classes as $class) {
                    $classId = array_key_exists('id', $class) ? $class['id'] : null;

                    // Find the corresponding 'reasons_count' for the current class and reason_name
                    $matchingGradeCnt = collect($reasonData['gradecnt'])->firstWhere('class_id', $classId);

                    if ($matchingGradeCnt) {
                        $response .= '<td style="border: 1px solid black;">' . $matchingGradeCnt['reasons_count'] . '</td>';
                    } else {
                        $response .= '<td style="border: 1px solid black;">0</td>';
                    }
                }
            }

            $response .= '</tr>';
        }
        $response .= ' </tbody>
                                        
                                        <tbody style="border: 1px solid black;">
                                            <tr>
                                                <td style="text-align:center;border: 1px solid black;height: 200px;width: 50px;"></td>
                                                <td  style="text-align:left;border: 1px solid black;height: 20px;border-right:hidden;">' . $event_notes_b . '</td>
                                            </tr>
                                        </tbody>
                                        
                                        <tbody style="border: 1px solid black;">
                                            <tr>
                                                <td rowspan="21" style="height: 700px;"></td>
                                                <td style="height: 30px;">' .  __('messages.grade') . '</td>
                                                <td>' .  __('messages.class') . '</td>
                                                <td colspan="3">' .  __('messages.name') . '</td>
                                                <td colspan="3">' .  __('messages.gender') . '</td>
                                                <td colspan="2">' .  __('messages.time') . '</td>
                                                <td colspan="2">' .  __('messages.tab') . '</td>
                                                <td colspan="4">' .  __('messages.details') . '</td>
                                                <td colspan="7">' .  __('messages.notes') . '</td>
                                            </tr>';
        if ($health_log_books['code'] == "200") {
            $log = $health_log_books['data']['partc'];
            foreach ($log as  $res) {
                $response .= '<tr>
                                                <td style="height: 30px;">' . $res['class_name'] . '</td>
                                                <td>' . $res['section_name'] . '</td>
                                                <td colspan="3">' . $res['name'] . '</td>
                                                <td colspan="3">' . $res['gender'] . '</td>
                                                <td colspan="2">' . $res['time'] . '</td>
                                                <td colspan="2">' . $res['tab'] . '</td>
                                                <td colspan="4">' . $res['tab_details'] . '</td>
                                                <td colspan="7">' . $res['event_notes_c'] . '</td>
                                            </tr>';
            }
        }
        $response .= ' <tr>
                                                <td></td>
                                                <td></td>
                                                <td colspan="3"></td>
                                                <td colspan="3"></td>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td colspan="4"></td>
                                                <td colspan="7"></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                 <td colspan="3"></td>
                                                <td colspan="3"></td>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td colspan="4"></td>
                                                <td colspan="7"></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                 <td colspan="3"></td>
                                                <td colspan="3"></td>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td colspan="4"></td>
                                                <td colspan="7"></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                 <td colspan="3"></td>
                                                <td colspan="3"></td>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td colspan="4"></td>
                                                <td colspan="7"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
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
                                        </tbody>
                                        
                                    </table>
                                </div>
                                
    
    
    
                            </div>
    
    
                            
                              </tr>
            </table>';
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
        $fileName = __('messages.health_logbooks') . $name . ".pdf";
        return $pdf->download($fileName);
    }

    public function childHealthPdf(Request $request,$id)
    {

        // $student_id = [];
        $student_id = null;
        if($id){

            $student_id = explode(',', $id);
        }
        $data = [
            'student_id' => $student_id,
            "academic_session_id" => session()->get('academic_session_id')
        ];
        // dd($data);
        // $footer_text = session()->get('footer_text');
        $child_health = Helper::PostMethod(config('constants.api.child_health_export'), $data);
        // dd($child_health);
        $department = $child_health['data']['department'];
        $grade = $child_health['data']['grade'];
        $student = $child_health['data']['student'];

        // dd($child_health);
        // dd($expense);
        // $response = "";
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
        
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 13px;
        }

        td,
        th {
            border: 1px solid black;
            text-align: left;
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
        ';
        $output .= '</style>';
        $output .= "</head>";
        $output .= "<body>";
        foreach($student as $stukey =>$stud){
    $child_health = $stud['child_health'];
    $profile = $stud['details'];

    $empty_row = '';
    $empty_table = '';
        $output .= '<div class="content" style="box-sizing: border-box; max-width: 850px; display: block; margin: 0 auto; padding: 20px;border-radius: 7px; margin-top: 20px;background-color: #fff; border: 1px solid #dddddd;">';
            $output .= '
            <div class="row">
                <div class="column">
                    <p style="text-align:left;margin-left: 12px; ">Form </p>
                    <p style="margin-left: 12px;margin-top: 2px;">Child Health Examination Form </p>
                </div>
                <div class="column" style="width: 45%;">
                    <table style="margin-bottom: 15px;">
                        <thead>
                        
                            <tr>
                                <td colspan="4" style="text-align:center;border-right:hidden; border-left:hidden;border-top:hidden"></td>';
                                $dep_count = 0;
                                foreach($department as $dep){
                                    $dep_count += $dep['count'];
                                    $output .= '<td colspan="'.$dep['count'].'" style="border-right:hidden;border-top:hidden">'.$dep['name'].'</td>';
                                }
                                
                            $output .= '</tr>
                            <tr>
                                <td colspan="2" style="text-align:center;">Class </td>
                                <td colspan="1" class="diagonalCross2" style="widtd:0px;border-right:hidden; border-left:hidden;"></td>
                                <td colspan="1" style="text-align:center;">Grade</td>';
                                foreach($grade as $gr){
                                    $output .= '<td>'.$gr['name_numeric'].'</td>';
                                }

                            $output .= '</tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="4">Class</td>';
                            
        $empty = $dep_count - count($stud['grade']);
        
        if(count($child_health)==0){
            for($i=0;$i<$dep_count; $i++){
                $empty_row  .= '<td></td>';
                $empty_table  .= '<td colspan="6"></td>';
            }
        }
                            foreach($child_health as $key=>$ch){
                                if($key=="class"){
                                    foreach($grade as $gr){
                                        $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                            $output .= '<td>'.$row.'</td>';
                                    }
                                }
                            }

                            $output .= $empty_row;
                            // for($i=0;$i<$empty; $i++){
                            //     $output .= '<td></td>';
                            // }
                        $output .= '</tr>
                            <tr>
                                <td colspan="4">Grade </td>';
                                foreach($child_health as $key=>$ch){
                                    if($key=="section"){
                                        foreach($grade as $gr){
                                            $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                                $output .= '<td>'.$row.'</td>';
                                        }
                                    }
                                }
    
                                $output .= $empty_row;
                                // for($i=0;$i<$empty; $i++){
                                //     $output .= '<td></td>';
                                // }
                            $output .= '</tr>
                        </tbody>
                    </table>
                </div>
            </div>
    
    
            <table class="">
                <thead class="colspanHead">
                    <tr>
                        
                    <td colspan="10" style="text-align:center;vertical-align: middle;">'.$profile['name'].'</td>
                    <td colspan="1" style="text-align:left;width:5%;">'.$profile['gender'].'
                    </td>
                    <td colspan="10" style="text-align:center;vertical-align: middle;">
                    </td>
                    <td colspan="10" style="text-align:center;vertical-align: middle;">
                    </td>
                    <td colspan="1" style="text-align:center;vertical-align: middle;border-right:hidden;">
                    </td>
                    <td colspan="1" style="text-align:center;vertical-align: middle;border-right:hidden;">
                    </td>
                    <td colspan="31" style="text-align:center;vertical-align: middle;">
                </thead>
                <tbody>
                <tr>
                    <td colspan="10">School Name</td>
                    <td colspan="20"></td>
                    <td colspan="5"></td>
                    <td colspan="29"></td>
                </tr>
                </tbody>
    
                <tbody style="border: 1px solid black;">
                    <tr>
                        <td colspan="10" style="text-align:center;">Age</td>
                        <td colspan="6">6</td>
                        <td colspan="6">7</td>
                        <td colspan="6">8</td>
                        <td colspan="6">9</td>
                        <td colspan="6">10</td>
                        <td colspan="6">11</td>
                        <td colspan="6">12</td>
                        <td colspan="6">13</td>
                        <td colspan="6">14</td>
                    </tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Fiscal Year</td>
                        <td colspan="6"></td>
                        <td colspan="6"></td>
                        <td colspan="6"></td>
                        <td colspan="6"></td>
                        <td colspan="6"></td>
                        <td colspan="6"></td>
                        <td colspan="6"></td>
                        <td colspan="6"></td>
                        <td colspan="6"></td>
                    </tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Height</td>';
                        
                        foreach($child_health as $key=>$ch){
                            if($key=="height"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Weight</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="weight"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Nutritional Status</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="nutritional_status"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Spine/Chest/Limb</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="spine_chest_limb"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td rowspan="2" style="width: 0px;">Eyesight</td>
                        <td colspan="9" style="text-align:center;">Right</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="eye_sight_right"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="9" style="text-align:center;">Left</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="eye_sight_left"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Eye Diseases and abnormalities</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="eye_diseases_abnormalities"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td rowspan="2" style="width: 0px;">Hearing</td>
                        <td colspan="9" style="text-align:center;">Right</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="hearing_right"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="9" style="text-align:center;">Left</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="hearing_left"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Otorhinolaryngopathy</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="otorhinolaryngopathy"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Skin Diseases</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="skin_diseases"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td rowspan="2" style="width: 0px;">Tuberculosis</td>
                        <td colspan="9" style="text-align:center;">Diseases and abnormalities</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="heart_clinical_medical_examination"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6"></td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="9" style="text-align:center;">Instruction Category</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="heart_diseases_abnormalities"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6"></td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td rowspan="2" style="width: 0px;">Heart</td>
                        <td colspan="9" style="text-align:center;">Clinical Medical Examination</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="heart_clinical_medical_examination"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="9" style="text-align:center;">Diseases and abnormalities</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="heart_diseases_abnormalities"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
    
                    <tr>
                        <td rowspan="2" style="width: 0px;">Urine</td>
                        <td colspan="9" style="text-align:center;">Protein</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="urine_protein"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="9" style="text-align:center;">Glucose</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="urine_glucose"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Glucose</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="urine"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Other Diseases and abnormalities</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="other_diseases_abnormalities"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td rowspan="2" style="width: 0px;">School Doctors</td>
                        <td colspan="9" style="text-align:center;">Findings</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="spine_chest_limb"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6"></td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="9" style="text-align:center;">Date</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="school_doctors_date"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Follow Up Treatments</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="follow_up_treatments"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="">Remark</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="remarks"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                </tbody>
            </table>
            </div> 
    
            <br><br>';
        }
        $output .= "</body></html>";
        // dd($output);
        $pdf = \App::make('dompdf.wrapper');
        // set size
        $customPaper = array(0, 0, 1920.00, 810.00);
        $pdf->set_paper($customPaper);
        // $paper_size = array(0, 0, 360, 360);
        // $pdf->set_paper($paper_size);
        $pdf->loadHTML($output);
        // filename
        $now = now();
        $name = strtotime($now);
        $fileName = __('messages.child_health_report') . $name . ".pdf";
        return $pdf->download($fileName);
    }

    
    public function childHealthStudentPdf(Request $request)
    {

        // $student_id = [];
        $student_id = null;
        if($request->student_id){

            $student_id = explode(',', $request->student_id);
        }
        $data = [
            'student_id' => $student_id,
            "class_id" => $request->class_id,
            'department_id' => $request->department_id,
            "section_id" => $request->section_id,
            "student_name" => $request->student_name,
            "session_id" => $request->session_id,
            "academic_session_id" => session()->get('academic_session_id')
        ];
        // dd($data);
        // $footer_text = session()->get('footer_text');
        $child_health = Helper::PostMethod(config('constants.api.child_health_export'), $data);
        // dd($child_health);
        $department = $child_health['data']['department'];
        $grade = $child_health['data']['grade'];
        $student = $child_health['data']['student'];

        // dd($child_health);
        // dd($expense);
        // $response = "";
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
        
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 13px;
        }

        td,
        th {
            border: 1px solid black;
            text-align: left;
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
        ';
        $output .= '</style>';
        $output .= "</head>";
        $output .= "<body>";
        foreach($student as $stukey =>$stud){
    $child_health = $stud['child_health'];

    $profile = $stud['details'];
    $empty_row = '';
    $empty_table = '';
        $output .= '<div class="content" style="box-sizing: border-box; max-width: 850px; display: block; margin: 0 auto; padding: 20px;border-radius: 7px; margin-top: 20px;background-color: #fff; border: 1px solid #dddddd;">';
            $output .= '
            <div class="row">
                <div class="column">
                    <p style="text-align:left;margin-left: 12px; ">Form </p>
                    <p style="margin-left: 12px;margin-top: 2px;">Child Health Examination Form </p>
                </div>
                <div class="column" style="width: 45%;">
                    <table style="margin-bottom: 15px;">
                        <thead>
                        
                            <tr>
                                <td colspan="4" style="text-align:center;border-right:hidden; border-left:hidden;border-top:hidden"></td>';
                                $dep_count = 0;
                                foreach($department as $dep){
                                    $dep_count += $dep['count'];
                                    $output .= '<td colspan="'.$dep['count'].'" style="border-right:hidden;border-top:hidden">'.$dep['name'].'</td>';
                                }
                                
                            $output .= '</tr>
                            <tr>
                                <td colspan="2" style="text-align:center;">Class </td>
                                <td colspan="1" class="diagonalCross2" style="widtd:0px;border-right:hidden; border-left:hidden;"></td>
                                <td colspan="1" style="text-align:center;">Grade</td>';
                                foreach($grade as $gr){
                                    $output .= '<td>'.$gr['name_numeric'].'</td>';
                                }

                            $output .= '</tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="4">Class</td>';
                            
        $empty = $dep_count - count($stud['grade']);
        
        if(count($child_health)==0){
            for($i=0;$i<$dep_count; $i++){
                $empty_row  .= '<td></td>';
                $empty_table  .= '<td colspan="6"></td>';
            }
        }
                            foreach($child_health as $key=>$ch){
                                if($key=="class"){
                                    foreach($grade as $gr){
                                        $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                            $output .= '<td>'.$row.'</td>';
                                    }
                                }
                            }

                            $output .= $empty_row;
                            // for($i=0;$i<$empty; $i++){
                            //     $output .= '<td></td>';
                            // }
                        $output .= '</tr>
                            <tr>
                                <td colspan="4">Grade </td>';
                                foreach($child_health as $key=>$ch){
                                    if($key=="section"){
                                        foreach($grade as $gr){
                                            $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                                $output .= '<td>'.$row.'</td>';
                                        }
                                    }
                                }
    
                                $output .= $empty_row;
                                // for($i=0;$i<$empty; $i++){
                                //     $output .= '<td></td>';
                                // }
                            $output .= '</tr>
                        </tbody>
                    </table>
                </div>
            </div>
    
    
            <table class="">
                <thead class="colspanHead">
                    <tr>
                        
                    <td colspan="10" style="text-align:center;vertical-align: middle;">'.$profile['name'].'</td>
                    <td colspan="1" style="text-align:left;width:5%;">'.$profile['gender'].'</td>
                    <td colspan="10" style="text-align:center;vertical-align: middle;">
                    </td>
                    <td colspan="10" style="text-align:center;vertical-align: middle;">
                    </td>
                    <td colspan="1" style="text-align:center;vertical-align: middle;border-right:hidden;">
                    </td>
                    <td colspan="1" style="text-align:center;vertical-align: middle;border-right:hidden;">
                    </td>
                    <td colspan="31" style="text-align:center;vertical-align: middle;">
                </thead>
                <tbody>
                <tr>
                    <td colspan="10">School Name</td>
                    <td colspan="20"></td>
                    <td colspan="5"></td>
                    <td colspan="29"></td>
                </tr>
                </tbody>
    
                <tbody style="border: 1px solid black;">
                    <tr>
                        <td colspan="10" style="text-align:center;">Age</td>
                        <td colspan="6">6</td>
                        <td colspan="6">7</td>
                        <td colspan="6">8</td>
                        <td colspan="6">9</td>
                        <td colspan="6">10</td>
                        <td colspan="6">11</td>
                        <td colspan="6">12</td>
                        <td colspan="6">13</td>
                        <td colspan="6">14</td>
                    </tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Fiscal Year</td>
                        <td colspan="6"></td>
                        <td colspan="6"></td>
                        <td colspan="6"></td>
                        <td colspan="6"></td>
                        <td colspan="6"></td>
                        <td colspan="6"></td>
                        <td colspan="6"></td>
                        <td colspan="6"></td>
                        <td colspan="6"></td>
                    </tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Height</td>';
                        
                        foreach($child_health as $key=>$ch){
                            if($key=="height"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Weight</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="weight"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Nutritional Status</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="nutritional_status"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Spine/Chest/Limb</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="spine_chest_limb"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td rowspan="2" style="width: 0px;">Eyesight</td>
                        <td colspan="9" style="text-align:center;">Right</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="eye_sight_right"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="9" style="text-align:center;">Left</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="eye_sight_left"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Eye Diseases and abnormalities</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="eye_diseases_abnormalities"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td rowspan="2" style="width: 0px;">Hearing</td>
                        <td colspan="9" style="text-align:center;">Right</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="hearing_right"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="9" style="text-align:center;">Left</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="hearing_left"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Otorhinolaryngopathy</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="otorhinolaryngopathy"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Skin Diseases</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="skin_diseases"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td rowspan="2" style="width: 0px;">Tuberculosis</td>
                        <td colspan="9" style="text-align:center;">Diseases and abnormalities</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="heart_clinical_medical_examination"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6"></td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="9" style="text-align:center;">Instruction Category</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="heart_diseases_abnormalities"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6"></td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td rowspan="2" style="width: 0px;">Heart</td>
                        <td colspan="9" style="text-align:center;">Clinical Medical Examination</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="heart_clinical_medical_examination"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="9" style="text-align:center;">Diseases and abnormalities</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="heart_diseases_abnormalities"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
    
                    <tr>
                        <td rowspan="2" style="width: 0px;">Urine</td>
                        <td colspan="9" style="text-align:center;">Protein</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="urine_protein"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="9" style="text-align:center;">Glucose</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="urine_glucose"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Glucose</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="urine"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Other Diseases and abnormalities</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="other_diseases_abnormalities"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td rowspan="2" style="width: 0px;">School Doctors</td>
                        <td colspan="9" style="text-align:center;">Findings</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="spine_chest_limb"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6"></td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="9" style="text-align:center;">Date</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="school_doctors_date"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="text-align:center;">Follow Up Treatments</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="follow_up_treatments"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                    <tr>
                        <td colspan="10" style="">Remark</td>';
                        foreach($child_health as $key=>$ch){
                            if($key=="remarks"){
                                foreach($grade as $gr){
                                    $row = isset($ch[$gr['name']]) ? $ch[$gr['name']] : "";
                                        $output .= '<td colspan="6">'.$row.'</td>';
                                }
                            }
                        }

                        $output .= $empty_table;
                    $output .= '</tr>
                </tbody>
            </table>
            </div> 
    
            <br><br>';
        }
        $output .= "</body></html>";
        // dd($output);
        $pdf = \App::make('dompdf.wrapper');
        // set size
        $customPaper = array(0, 0, 1920.00, 810.00);
        $pdf->set_paper($customPaper);
        // $paper_size = array(0, 0, 360, 360);
        // $pdf->set_paper($paper_size);
        $pdf->loadHTML($output);
        // filename
        $now = now();
        $name = strtotime($now);
        $fileName = __('messages.child_health_report') . $name . ".pdf";
        return $pdf->download($fileName);
    }
}
