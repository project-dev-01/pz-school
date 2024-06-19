<!-- resources/views/student_report_card.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Primary_grade1_2</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <meta content="Paxsuzen" name="author" />
    <style>
        @font-face {
            font-family: Times New Roman ipag;
            font-style: normal;
            font-weight: 300;
            src: url('{{ $fonturl }}');
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
                    <p style="margin-left:20px;font-size:20px;">{{ $stuclass }}年生</p>
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
                            <td style="vertical-align: middle;border-right:hidden;font-size:20px; height: 60px;width:7%;">{{ $section['data']['name'] }}</td>
                            <td style="text-align: right;font-size:20px; vertical-align: bottom; height: 60px;width:7%;"> 組</td>
                            <td style="vertical-align: middle;border-right:hidden;font-size:20px; height: 60px;width:7%;">{{ $attendance_no }}</td>
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
                            <td style="vertical-align: inherit;text-align:center; height: 60px;">{{ $stu['name'] }}</td>
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
                    <tbody>
                        @foreach ($getprimarysubjects as $subject)
                            @php
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

                                $getmarks = App\Helpers\Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
                            @endphp
                            @foreach ($getmarks['data'] as $index => $papers)
                                <tr>
                                    @if ($index == 0)
                                        <td rowspan="{{ count($getmarks['data']) }}" style="width:2%; height: 30px; writing-mode: vertical-rl; font-family: IPAG;">
                                            @foreach (preg_split('//u', $subject, -1, PREG_SPLIT_NO_EMPTY) as $char)
                                                <span style="display: inline-block; transform: rotate(0deg);">{{ $char }}</span><br>
                                            @endforeach
                                        </td>
                                    @endif
                                    <td style="width:15%; text-align:left; height: 37px;">{{ $papers['papers'] }}</td>
                                    @foreach ($papers['marks'] as $mark)
                                        <td style="width:2%;  height: 37px;font-size:14px;">{{ $mark['grade'] ?? '' }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
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
                    <tbody style="border: 1px solid black;">
                        @php
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

                            $attarray = ['', '1月', ' 2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'];
                            $getattendance = App\Helpers\Helper::PostMethod(config('constants.api.getsem_studentattendance'), $attdata);
                            $totals = [
                                'no_schooldays' => 0,
                                'suspension' => 0,
                                'totalcoming' => 0,
                                'totabs' => 0,
                                'totpres' => 0,
                                'totlate' => 0,
                                'totexc' => 0,
                            ];
                        @endphp
                        @foreach ($getattendance['data'] as $att)
                            @foreach ($totals as $key => $value)
                                @php $totals[$key] += $att[$key]; @endphp
                            @endforeach
                            <tr>
                                <td style="height: 32px;">{{ $attarray[intval($att['month'])] }}</td>
                                <td style="height: 32px;">{{ $att['no_schooldays'] }}</td>
                                <td style="height: 32px;">{{ $att['suspension'] }}</td>
                                <td style="height: 32px;">{{ $att['totalcoming'] }}</td>
                                <td style="height: 32px;">{{ $att['totabs'] }}</td>
                                <td style="height: 32px;">{{ $att['totpres'] }}</td>
                                <td style="height: 32px;">{{ $att['totlate'] }}</td>
                                <td style="height: 32px;">{{ $att['totexc'] }}</td>
                            </tr>
                        @endforeach
                        <tr style="border-top: 2px solid black;">
                            <td style="height: 34px;"> 合計</td>
                            @foreach ($totals as $total)
                                <td style="height: 34px;">{{ $total }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>

            @php
                $specialSubjects = [
                    $specialsubject1 => $getspecialpapers,
                    $specialsubject2 => $description,
                    $specialsubject3 => $description,
                    $specialsubject4 => $description,
                ];
            @endphp

            @foreach ($specialSubjects as $subject => $description)
                @php
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
                    $getmarks = App\Helpers\Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
                @endphp

                <div class="column2" style="width:1%;">
                </div>
                <div class="column2" style="width:44%;">
                    <table class="table table-bordered" style="border: 2px solid black;">
                        <thead class="colspanHead">
                            <tr>
                                <td colspan="2" style="text-align:center; border: 1px solid black; vertical-align: middle; height: 63px;border-right:hidden;">
                                    行動及び生活の記録
                                </td>
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
                            @foreach ($getmarks['data'] as $papers)
                                @php
                                    $mark = '';
                                    $nsem = count($papers['marks']);
                                    $s = 0;
                                    foreach ($papers['marks'] as $markItem) {
                                        $s++;
                                        if (is_array($markItem) && isset($markItem['grade_name']) && $markItem['grade_name'] != null) {
                                            $mark = $markItem['grade_name'];
                                        }
                                        if ($s == $nsem) {
                                            break;
                                        }
                                    }
                                    $fmark = ($mark == "Excellent") ? '○' : '';
                                @endphp
                                <tr style="height:60px;">
                                    <td colspan="4" style="text-align:left;vertical-align: top;width:100px;height:30px;">{{ $papers['papers'] }}</td>
                                    <td colspan="1">{{ $fmark }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @php
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
                        'papers' => $description,
                    ];
                    $getmarks = App\Helpers\Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
                    $mark1 = '';
                    foreach ($getmarks['data'] as $papers) {
                        $nsem = count($papers['marks']);
                        $s = 0;
                        foreach ($papers['marks'] as $markItem) {
                            $s++;
                            if (is_array($markItem) && isset($markItem['freetext']) && $markItem['freetext'] != null) {
                                $mark1 = $markItem['freetext'];
                            }
                            if ($s == $nsem) {
                                break;
                            }
                        }
                    }
                @endphp
                    <table class="table table-bordered" style="border: 2px solid black;margin-top:30px;">
                        <thead class="colspanHead">
                            <tr>
                                <td colspan="5">特別の教科　道徳　(3学期に記載)</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-top: 2px solid black;">
                                <td colspan="5" style="height:170px;text-align:left;vertical-align: top;word-wrap: break-word;">
                                    @foreach (explode("\n", $mark1) as $comment)
                                        {{ $comment }}<br>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @php
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
                        'papers' => $description,
                    ];
                    $getmarks = App\Helpers\Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
                    $mark2 = '';
                    foreach ($getmarks['data'] as $papers) {
                        $nsem = count($papers['marks']);
                        $s = 0;
                        foreach ($papers['marks'] as $markItem) {
                            $s++;
                            if (is_array($markItem) && isset($markItem['freetext']) && $markItem['freetext'] != null) {
                                $mark2 = $markItem['freetext'];
                            }
                            if ($s == $nsem) {
                                break;
                            }
                        }
                    }
                @endphp
                    <table class="table table-bordered" style="border: 2px solid black;margin-top:30px;">
                        <thead class="colspanHead">
                            <tr>
                                <td colspan="5">特 別 活 動 等 の 記 録　(毎学期記載)</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-top: 2px solid black;">
                                <td colspan="5" style="height:180px;text-align:left;vertical-align: top;word-wrap: break-word;">
                                    @foreach (explode("\n", $mark2) as $comment)
                                        {{ $comment }}<br>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @php
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
                        'papers' => $description,
                    ];
                    $getmarks = App\Helpers\Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
                    $mark3 = '';
                    foreach ($getmarks['data'] as $papers) {
                        $nsem = count($papers['marks']);
                        $s = 0;
                        foreach ($papers['marks'] as $markItem) {
                            $s++;
                            if (is_array($markItem) && isset($markItem['freetext']) && $markItem['freetext'] != null) {
                                $mark3 = $markItem['freetext'];
                            }
                            if ($s == $nsem) {
                                break;
                            }
                        }
                    }
                @endphp
                    <table class="table table-bordered" style="border: 2px solid black;margin-top:30px;width:100%;">
                        <thead class="colspanHead">
                            <tr>
                                <td colspan="5"> 所見　（3学期に記載）</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-top: 2px solid black;">
                                <td colspan="5" style="height:175px;text-align:left;vertical-align: top;word-wrap: break-word;">
                                    @foreach (explode("\n", $mark3) as $comment)
                                        {{ $comment }}<br>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div style="display: flex; flex-wrap: wrap;">
                        <div style="width: 100%; box-sizing: border-box;">
                            <p style="text-align: right;margin-top:px; marign-bottom:50px;font-size:14px;">※1，2学期の内容は、三者懇談でお伝えさせていただきます。</p>
                        </div>
                    </div>

                    <div style="width:100%;">
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
                                        {{ $getteacherdata['data']['principal'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1" style="text-align: left; height: 40px; width:5%;border: 2px solid black;">
                                        担<br>任
                                    </td>
                                    <td colspan="1" style="text-align: left; height: 40px; border: 2px solid black;">
                                        {{ $getteacherdata['data']['teacher'] }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
