<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;

use DateTime;
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
        $output = "";
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
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">S.no.</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">Grade</th>
                 <th class="align-top th-sm - 6 rem" style="border: 1px solid; padding:12px;" rowspan="2">Tot. Students</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">Absent</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">Present</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">Class Teacher Name</th>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px;">' . $val['grade'] . '</th>';
            }
            $output .= '<th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">PASS</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">G</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">GPA</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">%</th>
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
        $output = "";
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
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">S.no.</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">Grade</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">Class</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">Subject Name</th>
                 <th class="align-top th-sm - 6 rem" style="border: 1px solid; padding:12px;" rowspan="2">Tot. Students</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">Absent</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">Present</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">Subject Teacher Name</th>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px;">' . $val['grade'] . '</th>';
            }
            $output .= '<th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">PASS</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">G</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">GPA</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">%</th>
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
        // dd($tot_grade_calcu_byclass);
        $output = "";
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
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="3">S.no.</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="3">Student Name</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" colspan="' . $headercount . '">Subject Name</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="3">GPA</th>
             </tr><tr>';
            foreach ($headers as $val) {
                $output .=  '<th colspan="2" class="text-center" style="border: 1px solid; padding:12px;">' . $val['subject_name'] . '</th>';
            }
            $output .= '</tr><tr>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px;">Mark</th>
                    <th class="text-center" style="border: 1px solid; padding:12px;">Grade</th>';
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
        $output = "";
        if ($tot_grade_calcu_byclass['code'] == "200") {
            $headers = $tot_grade_calcu_byclass['data']['headers'];
            $allbysubject = $tot_grade_calcu_byclass['data']['allbysubject'];
            $output .= '<html>
                    <head>
                <style>
                    /** Define the margins of your page **/
                    @page {
                        margin: 100px 25px;
                    }
                    .page-break {
                        page-break-after: always;
                    }
                    header {
                        position: fixed;
                        top: -60px;
                        left: 0px;
                        right: 0px;
                        height: 50px;

                        /** Extra personal styles **/
                        background-color: #03a9f4;
                        color: white;
                        text-align: center;
                        line-height: 35px;
                    }

                    footer {
                        position: fixed; 
                        bottom: -60px; 
                        left: 0px; 
                        right: 0px;
                        height: 50px; 

                        /** Extra personal styles **/
                        background-color: #03a9f4;
                        color: white;
                        text-align: center;
                        line-height: 35px;
                    }
                </style>
            </head><body>';
            // $output .= '<!-- Define header and footer blocks before your content -->
            // <header>
            // Paxsuzen
            // </header>
            // <footer>2020 - ' . date("Y") . ' &copy; by <a href="https://paxsuzen.com">Paxsuzen</a>.</footer><main>';
            $output .= '<div class="table-responsive">
        <table width="100%" style="border-collapse: collapse; border: 0px;">
           <thead>
              <tr>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">S.no.</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">Subject Name</th>
                 <th class="align-top th-sm - 6 rem" style="border: 1px solid; padding:12px;" rowspan="2">Tot. Students</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">Absent</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;" rowspan="2">Present</th>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px;">' . $val['grade'] . '</th>';
            }
            $output .= '<th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">PASS</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">G</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">GPA</th>
                 <th class="align-middle" style="border: 1px solid; padding:12px;" rowspan="2">%</th>
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
        $output = "";
        if ($tot_grade_calcu_byclass['code'] == "200") {
            $student_details = $tot_grade_calcu_byclass['data']['student_details'];
            $headers = $tot_grade_calcu_byclass['data']['headers'];
            $allbyStudent = $tot_grade_calcu_byclass['data']['allbyStudent'];
            // student details
            $output .= '<div class="table-responsive">
                <table  width="100%" style="border-collapse: collapse; border: 0px;"><thead>';
            $output .= '<tr><th class="align-top" style="border: 1px solid; padding:12px;">Roll No</th>
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
                 <th class="align-top" style="border: 1px solid; padding:12px;">S.no.</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">Student Name</th>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px;">' . $val['subject_name'] . '</th>';
            }
            $output .= '<th class="text-center" style="border: 1px solid; padding:12px;">GPA</th>';
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
        $output = "";
        if ($getExamPaperData['code'] == "200") {
            $headers = $getExamPaperData['data']['all_paper'];
            $get_subject_paper_marks = $getExamPaperData['data']['get_subject_paper_marks'];
            $output .= '<div class="table-responsive">
        <table width="100%" style="border-collapse: collapse; border: 0px;">
           <thead>
              <tr>
                 <th class="align-top" style="border: 1px solid; padding:12px;">S.no.</th>
                 <th class="align-top" style="border: 1px solid; padding:12px;">Student Name</th>';
            foreach ($headers as $val) {
                $output .=  '<th class="text-center" style="border: 1px solid; padding:12px;">' . $val['paper_name'] . '</th>';
            }
            $output .= '<th class="text-center" style="border: 1px solid; padding:12px;">Grade</th>';
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
        $output = "";
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
}
