<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use DataTables;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Excel;
use DateTime;
use DateTimeZone;
use App\Exports\StaffAttendanceExport;
use App\Exports\StudentAttendanceExport;
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
            $output .= '<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 100px 25px;
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
    </head><body>
    <!-- Define header and footer blocks before your content -->
    <header>
    Paxsuzen
    </header>
    <footer>2020 - ' . date("Y") . ' &copy; by <a href="https://paxsuzen.com">Paxsuzen</a>.</footer><main>';
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

            $output .= '</tbody>
        </table>
     </div>';
            $output .= '</main>
     </body>
 </html>';
            $pdf = \App::make('dompdf.wrapper');
            // set size
            $customPaper = array(0, 0, 1000.00, 567.00);
            $pdf->set_paper($customPaper);
            $pdf->loadHTML($output);
            // filename
            $now = now();
            $name = strtotime($now);
            $fileName = "byClass" . $name . ".pdf";
            return $pdf->download($fileName);
            // return $pdf->stream();
        }
    }
}
