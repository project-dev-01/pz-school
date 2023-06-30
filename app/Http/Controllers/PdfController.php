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
        
        $footer_text=session()->get('footer_text');
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
        $output .= "<body><header> ".  __('messages.by_class') ."</header>
        <footer>".$footer_text."</footer>";
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
                 <th class="align-top" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">'.  __('messages.s.no') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">'.  __('messages.grade') .'</th>
                 <th class="align-top th-sm - 6 rem" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">'.  __('messages.total_student') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">'.  __('messages.absent') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">'.  __('messages.present') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">'.  __('messages.class_teacher_name') .'</th>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px; font-weight:italic;">' . $val['grade'] . '</th>';
            }
            $output .= '<th class="align-middle" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">'.  __('messages.pass') .'</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">'.  __('messages.g') .'</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">'.  __('messages.gpa') .'</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px; font-weight:italic;" rowspan="2">'.  __('messages.%') .'</th>
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
            $fileName = "byclass" . $name . ".pdf";
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
        $footer_text=session()->get('footer_text');
        
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
        $output .= "<body><header> ".  __('messages.by_subject') ."</header>
        <footer>".$footer_text."</footer>";
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
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.s.no') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.grade') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.class') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.subject_name') .'</th>
                 <th class="align-top th-sm - 6 rem" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.total_student') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.absent') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.present') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.subject_teacher_name') .'</th>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px;">' . $val['grade'] . '</th>';
            }
            $output .= '<th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.pass') .'</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.g') .'</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.gpa') .'</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.%') .'</th>
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
            $fileName = "bysubject" . $name . ".pdf";
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
        $footer_text=session()->get('footer_text');
        
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
        $output .= "<body><header> ".  __('messages.by_student') ."</header>
        <footer>".$footer_text."</footer>";
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
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="3">'.  __('messages.s.no') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="3">'.  __('messages.student_name') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" colspan="' . $headercount . '">'.  __('messages.subject_name') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="3">'.  __('messages.gpa') .'</th>
             </tr><tr>';
            foreach ($headers as $val) {
                $output .=  '<th colspan="2" class="text-center" style="border: 1px solid; padding:12px;">' . $val['subject_name'] . '</th>';
            }
            $output .= '</tr><tr>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px;">'.  __('messages.mark') .'</th>
                    <th class="text-center" style="border: 1px solid; padding:12px;">'.  __('messages.grade') .'</th>';
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
            $fileName = "bystudent" . $name . ".pdf";
            return $pdf->download($fileName);
            // return $pdf->stream();
        }
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
        $footer_text=session()->get('footer_text');
        
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
        $output .= "<body><header> ".  __('messages.overall') ."</header>
        <footer>".$footer_text."</footer>";
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
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.s.no') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.subject_name') .'</th>
                 <th class="align-top th-sm - 6 rem" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.total_student') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.absent') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.present') .'</th>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px;">' . $val['grade'] . '</th>';
            }
            $output .= '<th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.pass') .'</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.g') .'</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.gpa') .'</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">'.  __('messages.%') .'</th>
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
            $fileName = "byoverall" . $name . ".pdf";
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
        $footer_text=session()->get('footer_text');
        
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
        $output .= "<body><header> ".  __('messages.individual_result') ."</header>
        <footer>".$footer_text."</footer>";
        if ($tot_grade_calcu_byclass['code'] == "200") {
            $student_details = $tot_grade_calcu_byclass['data']['student_details'];
            $headers = $tot_grade_calcu_byclass['data']['headers'];
            $allbyStudent = $tot_grade_calcu_byclass['data']['allbyStudent'];
            // student details
            $output .= '<div class="table-responsive">
                <table  width="100%" style="border-collapse: collapse; border: 0px;"><thead>';
            $output .= '<tr><th class="align-top" style="border: 1px solid; padding:12px;">'.  __('messages.roll_no') .'</th>
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
                 <th class="align-top" style="border: 1px solid; padding:12px;">'.  __('messages.s.no') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">'.  __('messages.student_name') .'</th>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px;">' . $val['subject_name'] . '</th>';
            }
            $output .= '<th class="text-center" style="border: 1px solid; padding:12px;">'.  __('messages.gpa') .'</th>';
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
            $fileName = "byindividualstudent" . $name . ".pdf";
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
        $footer_text=session()->get('footer_text');
        
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
        $output .= "<body><header> ".  __('messages.exam_paper_result') ."</header>
        <footer>".$footer_text."</footer>";
        if ($getExamPaperData['code'] == "200") {
            $headers = $getExamPaperData['data']['all_paper'];
            $get_subject_paper_marks = $getExamPaperData['data']['get_subject_paper_marks'];
            $output .= '<div class="table-responsive">
        <table width="100%" style="border-collapse: collapse; border: 0px;">
           <thead>
              <tr>
                 <th class="align-top" style="border: 1px solid; padding:12px;">'.  __('messages.s.no') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">'.  __('messages.student_name') .'</th>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px;">' . $val['paper_name'] . '</th>';
            }
            $output .= '<th class="text-center" style="border: 1px solid; padding:12px;">'.  __('messages.grade') .'</th>';
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
            $fileName = "bypapers" . $name . ".pdf";
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
        $footer_text=session()->get('footer_text');
        
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
        $output .= "<body><header> ".  __('messages.test') ."</header>
        <footer>".$footer_text."</footer>";
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
        $footer_text=session()->get('footer_text');
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
// $fonturl = asset('public/public/fonts/japanese/ipag.ttf');
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
        $response .= "<body><header> ".  __('messages.schedule_list') ."</header>
        <footer>".$footer_text."</footer>";
        if ($timetable['code'] == "200") {
            $max = $timetable['data']['max'];

            // $response = "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>";
            $response .= '<table >';
            $response .= '<tr><td class="center" style="border: 1px solid; padding:12px;">'. __('messages.day') . '/' . __('messages.period') .'</td>';
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
                            $response .= '<td style="border: 1px solid; padding:12px;">' ;
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
                                $response .= $subject .'<br>';
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
        $fileName = "timetable" . $name . ".pdf";
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
        $footer_text=session()->get('footer_text');
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
        $response .= "<body><header> ".  __('messages.attendance_report') ."</header>
        <footer>".$footer_text."</footer>";
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
        $fileName = "student_attendance" . $name . ".pdf";
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
        $footer_text=session()->get('footer_text');
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
        $response .= "<body><header> ".  __('messages.employee_attendance_report') ."</header>
        <footer>".$footer_text."</footer>";
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
                 <th class="align-top" style="border: 1px solid; padding:12px;">'.  __('messages.employee_id') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">'.  __('messages.session') .'</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">'.  __('messages.employee_name') .'</th>';
            foreach ($daterange as $date) {
                $response .= '<th class="align-top" style="border: 1px solid; padding:12px;">' . $date->format("Y-m-d") . '</th>>';
            }
            $response .= '<th class="align-top" style="border: 1px solid; padding:12px;">'.  __('messages.total_present') .'</th>>
            <th class="align-top" style="border: 1px solid; padding:12px;">'.  __('messages.total_absent') .'</th>>
            <th class="align-top" style="border: 1px solid; padding:12px;">'.  __('messages.total_late') .'</th>>';
            foreach ($staff_details as $key => $res) {
                $attendance_details = $res['attendance_details'];
                $response .= '<tr>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['staff_id'] . '</td>
                 <td class="text-center" style="border: 1px solid; padding:12px;">' . $res['session_name'] . '</td>
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
        $fileName = "staff_attendance" . $name . ".pdf";
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
        $get_attendance_list_teacher = Helper::PostMethod(config('constants.api.get_attendance_list_teacher'), $data);$footer_text=session()->get('footer_text');
        
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
        $response .= "<body><header> ".  __('messages.attendance_report') ."</header>
        <footer>".$footer_text."</footer>";
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
                 <th class="align-top" style="border: 1px solid; padding:12px;">'.  __('messages.name') .'</th>';
            foreach ($daterange as $date) {
                $response .= '<th class="align-top" style="border: 1px solid; padding:12px;">' . $date->format("Y-m-d") . '</th>>';
            }
            $response .= '<th class="align-top" style="border: 1px solid; padding:12px;">'.  __('messages.total_present') .'</th>
            <th class="align-top" style="border: 1px solid; padding:12px;">'.  __('messages.total_absent') .'</th>
            <th class="align-top" style="border: 1px solid; padding:12px;">'.  __('messages.total_late') .'</th>>';

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
}
