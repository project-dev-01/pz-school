<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Secondary</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Paxsuzen School is a premier educational institution that offers quality education to students of all ages. Our curriculum is designed to prepare future leaders for success in the global marketplace.">
    <meta name="keywords" content="Paxsuzen School, education, future leaders, curriculum">
    <meta content="Paxsuzen" name="author" />
    <style>
        @font-face {
            font-family: Times New Roman ipag;
            font-style: normal;
            font-weight: 300;
            src: url("{{ $fonturl }}");
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
            line-height: 18px;
            letter-spacing: 0.0133em;
            word-wrap: break-word;
            font-size:18px;
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
                    <p style="margin: 0;font-size:20px;">{{ $stuclass }}年生</p>
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
                    <thead></thead>
                    <tbody>
                        <tr>
                            <td style="vertical-align: middle;border-right:hidden;font-size:20px; height: 60px;">{{ $section['data']['name'] }}</td>
                            <td style="text-align: right;font-size:20px; vertical-align: bottom; height: 60px;"> 組</td>
                            <td style="vertical-align: middle;border-right:hidden;font-size:20px; height: 60px;">{{ $attendance_no }}</td>
                            <td style="text-align: right;font-size:20px; vertical-align: bottom; height: 60px;"> 番</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="column1" style="width:1%;"></div>
            <div class="column1" style="width:39%;">
                <table>
                    <thead></thead>
                    <tbody>
                        <tr>
                            <td style="vertical-align: top; text-align: left; border-right:hidden;height: 60px;">氏名</td>
                            <td style="vertical-align: inherit;text-align:center; height: 60px;">{{ $stu['name'] }}</td>
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
                            @foreach ($getmarks['data'] as $papers)
                                @if ($loop->iteration <= 3)
                                    <tr>
                                        @if ($loop->first)
                                            <td rowspan="3" style="width:2%; height: 30px; writing-mode: vertical-rl; font-family: IPAG;">
                                                @foreach (preg_split('//u', $subject, null, PREG_SPLIT_NO_EMPTY) as $char)
                                                    <span style="display: inline-block; transform: rotate(0deg);">{{ $char }}</span><br>
                                                @endforeach
                                            </td>
                                        @endif
                                        <td style="width:15%; text-align:left; height: 30px;">{{ $papers['papers'] }}</td>
                                        @php $k = 0; @endphp
                                        @if (!empty($papers['marks']))
                                            @foreach ($papers['marks'] as $mark)
                                                @php
                                                    $mark = isset($mark['grade']) && $mark['grade'] != null ? $mark['grade'] : '';
                                                @endphp
                                                <td style="width:2%; height: 30px;font-size:14px;">{{ $mark }}</td>
                                                @if ($loop->parent->first && $loop->first)
                                                    <td style="width:2%; height: 30px;" rowspan="3">
                                                        @if ($getmarks['data'][3]['marks'][$k] != null)
                                                            {{ $getmarks['data'][3]['marks'][$k]['score'] }}
                                                        @endif
                                                    </td>
                                                @endif
                                                @php $k++; @endphp
                                            @endforeach
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                <table class="table table-bordered table-responsive" style="border: 2px solid black;height:25%;margin-top:25px;width:100%">
                    <thead class="colspanHead">
                        <tr>
                            <th style="border: 1px solid black; font-weight:italic; text-align: center;height:30px;">出欠の<br>記録</th>
                            <th style="border: 1px solid black; font-weight:italic; text-align: center;height:30px;">授業<br>日数</th>
                            <th style="border: 1px solid black; font-weight:italic; text-align: center;font-size:12px;height:30px;">出席停<br>止<br>忌引き等</th>
                            <th style="border: 1px solid black; font-weight:italic; text-align: center;font-size:12px;height:30px;">出席しなけれ<br>ばならない日<br>数</th>
                            <th style="border: 1px solid black; font-weight:italic; text-align: center;height:30px;">欠席<br>日数</th>
                            <th style="border: 1px solid black; font-weight:italic; text-align: center;height:30px;">出席<br>日数</th>
                            <th style="border: 1px solid black; font-weight:italic; text-align: center;height:30px;">遅刻</th>
                            <th style="border: 1px solid black; font-weight:italic; text-align: center;height:30px;">早退</th>
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
                                'student_id' => $stu['student_id']
                            ];
                            $attarray = ['', '1月', ' 2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'];
                            $getattendance = App\Helpers\Helper::PostMethod(config('constants.api.getsem_studentattendance'), $attdata);
                            $at_tot1 = 0;
                            $at_tot2 = 0;
                            $at_tot3 = 0;
                            $at_tot4 = 0;
                            $at_tot5 = 0;
                            $at_tot6 = 0;
                            $at_tot7 = 0;
                        @endphp
                        @foreach ($getattendance['data'] as $att)
                            @php
                                $at_tot1 += $att['no_schooldays'];
                                $at_tot2 += $att['suspension'];
                                $at_tot3 += $att['totalcoming'];
                                $at_tot4 += $att['totabs'];
                                $at_tot5 += $att['totpres'];
                                $at_tot6 += $att['totlate'];
                                $at_tot7 += $att['totexc'];
                            @endphp
                            <tr>
                                <td style="height: 27px;">{{ $attarray[intval($att['month'])] }}</td>
                                <td style="height: 27px;">{{ $att['no_schooldays'] }}</td>
                                <td style="height: 27px;">{{ $att['suspension'] }}</td>
                                <td style="height: 27px;">{{ $att['totalcoming'] }}</td>
                                <td style="height: 27px;">{{ $att['totabs'] }}</td>
                                <td style="height: 27px;">{{ $att['totpres'] }}</td>
                                <td style="height: 27px;">{{ $att['totlate'] }}</td>
                                <td style="height: 27px;">{{ $att['totexc'] }}</td>
                            </tr>
                        @endforeach
                        <tr style="border-top: 2px solid black;">
                            <td style="height: 40px;"> 合計</td>
                            <td style="height: 40px;">{{ $at_tot1 }}</td>
                            <td style="height: 40px;">{{ $at_tot2 }}</td>
                            <td style="height: 40px;">{{ $at_tot3 }}</td>
                            <td style="height: 40px;">{{ $at_tot4 }}</td>
                            <td style="height: 40px;">{{ $at_tot5 }}</td>
                            <td style="height: 40px;">{{ $at_tot6 }}</td>
                            <td style="height: 40px;">{{ $at_tot7 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="column2" style="width:1%;"></div>
            <div class="column2" style="width:39%;">
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
                        'subject' => $specialsubject1,
                        'papers' => $getspecialpapers
                    ];
                    $getmarks = App\Helpers\Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
                @endphp
                <table class="table table-bordered" style="border: 2px solid black;">
                    <thead class="colspanHead">
                        <tr>
                            <td colspan="2" style="text-align:center; border: 1px solid black; vertical-align: middle; height: 63px;border-right:hidden;">
                                行動及び生活の記録
                            </td>
                            <td colspan="3" style="border: 1px solid black; height: 63px;">
                                <ul style="list-style-type: none; padding: 0; margin: 0;text-align:left;">
                                    <li style="margin-left: 60px;font-size:14px;">（3学期に記載）</li>
                                    <li style="margin-left: 60px;font-size:14px;"></li>
                                    <li style="margin-left: 60px;font-size:14px;">（○すぐれている）</li>
                                </ul>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getmarks['data'] as $papers)
                            @php
                                $nsem = count($papers['marks']);
                                $s = 0;
                                $mark = '';
                                if (!empty($papers['marks'])) {
                                    foreach ($papers['marks'] as $markItem) {
                                        $s++;
                                        if (is_array($markItem) && isset($markItem['grade_name']) && $markItem['grade_name'] != null) {
                                            $mark = $markItem['grade_name'];
                                        }
                                        if ($s == $nsem) {
                                            break;
                                        }
                                    }
                                }
                                $fmark = ($mark == "Excellent") ? '○' : '';
                            @endphp
                            <tr style="height:60px;">
                                <td colspan="4" style="text-align:left;width:100px;">{{ $papers['papers'] }}</td>
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
                        'papers' => $description
                    ];
                    $getmarks = App\Helpers\Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
                    $i = 0;
                    $n = count($getmarks['data']);
                    $mark1 = '';
                    foreach ($getmarks['data'] as $papers) {
                        $nsem = count($papers['marks']);
                        $s = 0;
                        if (!empty($papers['marks'])) {
                            foreach ($papers['marks'] as $mark) {
                                $s++;
                                if (is_array($mark) && isset($mark['freetext']) && $mark['freetext'] != null) {
                                    $mark1 = $mark['freetext'];
                                }
                                if ($s == $nsem) {
                                    break;
                                }
                            }
                        }
                    }
                @endphp
                <table class="table table-bordered" style="border: 2px solid black;margin-top:20px;">
                    <thead class="colspanHead">
                        <tr>
                            <td colspan="5">特別の教科　道徳　（2学期に記載）</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-top: 2px solid black;">
                            <td colspan="5" style="height:210px;text-align:left;vertical-align: top;word-wrap: break-word;">
                                @foreach (explode("\n", $mark1) as $cmt)
                                    {{ $cmt }}<br>
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
                        'subject' => $specialsubject5,
                        'papers' => $description
                    ];
                    $getmarks = App\Helpers\Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
                    $i = 0;
                    $n = count($getmarks['data']);
                    $mark2 = '';
                    foreach ($getmarks['data'] as $papers) {
                        $nsem = count($papers['marks']);
                        $s = 0;
                        if (!empty($papers['marks'])) {
                            foreach ($papers['marks'] as $mark) {
                                $s++;
                                if (is_array($mark) && isset($mark['freetext']) && $mark['freetext'] != null) {
                                    $mark2 = $mark['freetext'];
                                }
                                if ($s == $nsem) {
                                    break;
                                }
                            }
                        }
                    }
                @endphp
                <table class="table table-bordered" style="border: 2px solid black;margin-top:20px;">
                    <thead class="colspanHead">
                        <tr>
                            <td colspan="5">総合的な学習の時間　（3学期に記載）</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-top: 1px solid black;">
                            <td colspan="5" style="height:210px;text-align:left;vertical-align: top;word-wrap: break-word;">
                                @foreach (explode("\n", $mark2) as $cmt)
                                    {{ $cmt }}<br>
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
                        'papers' => $description
                    ];
                    $getmarks = App\Helpers\Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
                    $i = 0;
                    $n = count($getmarks['data']);
                    $mark3 = '';
                    foreach ($getmarks['data'] as $papers) {
                        $nsem = count($papers['marks']);
                        $s = 0;
                        if (!empty($papers['marks'])) {
                            foreach ($papers['marks'] as $mark) {
                                $s++;
                                if (is_array($mark) && isset($mark['freetext']) && $mark['freetext'] != null) {
                                    $mark3 = $mark['freetext'];
                                }
                                if ($s == $nsem) {
                                    break;
                                }
                            }
                        }
                    }
                @endphp
                <table class="table table-bordered" style="border: 2px solid black;margin-top:20px;">
                    <thead class="colspanHead">
                        <tr>
                            <td colspan="5">特別活動等の記録　（毎学期記載）</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-top: 2px solid black;">
                            <td colspan="5" style="height:210px;text-align:left;vertical-align: top;word-wrap: break-word;">
                                @foreach (explode("\n", $mark3) as $cmt)
                                    {{ $cmt }}<br>
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
                        'papers' => $description
                    ];
                    $getmarks = App\Helpers\Helper::PostMethod(config('constants.api.getsubjectpapermarks'), $pdata);
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
                                if ($s == $nsem) {
                                    break;
                                }
                            }
                        }
                    }
                @endphp
                <table class="table table-bordered" style="border: 2px solid black;margin-top:20px;">
                    <thead class="colspanHead">
                        <tr>
                            <td colspan="5">　所見　（3学期に記載）</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-top: 2px solid black;">
                            <td colspan="5" style="height:210px;text-align:left;vertical-align: top;word-wrap: break-word;">
                                @foreach (explode("\n", $mark4) as $cmt)
                                    {{ $cmt }}<br>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div style="display: flex; flex-wrap: wrap;">
                    <div style="width: 100%; box-sizing: border-box;">
                        <p style="text-align: right; margin-top:px;marign-bottom:22px;font-size:12px;">※1,2学期の内容は、三者懇談でお伝えさせていただきます。</p>
                    </div>
                </div>
                <div style="width:100%;margin-top:38px;">
                    <table style="margin-top: 12px; width: 100%;">
                        <thead></thead>
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
        </div>
    </div>
</body>
</html>
