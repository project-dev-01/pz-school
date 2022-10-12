<?php

namespace App\Exports;

use DateTime;
use DateInterval;
use DatePeriod;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
Use DB;
// base controller add
use App\Http\Controllers\Api\BaseController as BaseController;

class StudentAttendanceExport  extends BaseController implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    protected $branch;
    protected $class;
    protected $section;
    protected $subject;
    protected $date;

    function __construct($branch,$class,$section,$subject,$semester,$session,$date) {
        $this->branch = $branch;
        $this->class = $class;
        $this->section = $section;
        $this->subject = $subject;
        $this->semester = $semester;
        $this->session = $session;
        $this->date = $date;
    }
    public function collection()
    {
        $branch = $this->branch;
        $class = $this->class;
        $section = $this->section;
        $subject = $this->subject;
        $semester = $this->semester;
        $session = $this->session;
        $date = $this->date;
        $month_year = explode("-", $date);
        $m = $month_year[0];
        $y = $month_year[1];

        
        
        $start = $y.'-'.$m.'-01';
        $end = date('Y-m-t', strtotime($start));
        //
        $startDate = new DateTime($start);
        $endDate = new DateTime($end);
          
        $date='';
        $tot=[];
        while ($startDate <= $endDate) {
            
            $dat = $startDate->format('Y-m-d');
            array_push($tot,$dat);
            $date.= $dat.',';
            $startDate->modify('+1 day');
        }
        // dd($date);
        $trimdate = rtrim($date,",");
        $attend = \DB::raw($trimdate);
        $Connection = $this->createNewConnection($branch);

        $excel = $Connection->table('student_attendances as sa')
                ->select(
                    'sa.student_id',
                    \DB::raw("CONCAT(stud.first_name, ' ', stud.last_name) as name"),
                    $attend,
                    DB::raw('COUNT(CASE WHEN sa.status = "present" then 1 ELSE NULL END) as "presentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "absent" then 1 ELSE NULL END) as "absentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "late" then 1 ELSE NULL END) as "lateCount"'),

                )
                ->join('enrolls as en', 'sa.student_id', '=', 'en.student_id')
                ->join('students as stud', 'sa.student_id', '=', 'stud.id')
                ->where([
                    ['sa.class_id', '=', $class],
                    ['sa.section_id', '=', $section],
                    ['sa.subject_id', '=', $subject],
                    ['sa.semester_id', '=', $semester],
                    ['sa.session_id', '=', $session]
                ])
                ->whereMonth('sa.date', $m)
                ->whereYear('sa.date', $y)
                ->groupBy('sa.student_id')
                ->get();


        if(!empty($excel)) {

            foreach($excel as $key=>$li) {
                // dd($li);
                $student_id = $li->student_id;
                foreach($tot as $t) {
                    $in_date = $Connection->table('student_attendances as sa')
                                ->where('sa.student_id', $student_id)
                                ->where('sa.date',$t)
                                ->where('sa.semester_id', $semester)
                                ->where('sa.session_id', $session)
                                ->first();
                                if($in_date) {
                                    $li->$t = $in_date->status;
                                }else{
                                    $li->$t = 0;
                                }
                    
                    
                }
                $excel[$key] = $li;
            }
        }
        
                
            // dd($excel);            
        return $excel;
    }

    
    public function headings(): array
    {
        $date = $this->date;
        $month_year = explode("-", $date);
        $m = $month_year[0];
        $y = $month_year[1];

        $final = ['Student Id','Student Name'];

        
        
        $start = $y.'-'.$m.'-01';
        $end = date('Y-m-t', strtotime($start));
        //
        $startDate = new DateTime($start);
        $endDate = new DateTime($end);

        while ($startDate <= $endDate) {
            
            $dat = $startDate->format('Y-m-d');
            array_push($final,$dat);
            $startDate->modify('+1 day');
        }

        
        array_push($final,'Total Present'); 
        array_push($final,'Total Absent'); 
        array_push($final,'Total Late'); 

        return $final;
    }

    public function registerEvents(): array
    {
        
        
        $result = [
            AfterSheet::class => function(AfterSheet $event) {
                // dd($event);
                $date = $this->date;
                $month_date = explode("-", $date);
                $month = $month_date[0];
                $year = $month_date[1];

                
                $tot = date('t', strtotime($year.'-'.$month.'-01'));
                // dd($tot);
                $num = $event->sheet->getHighestRow();
                $cellRange = 'A1:AJ1'; // All headers
                $cellRange2 = 'A1:A'.($num+1);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12)->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange2)->getFont()->setSize(12)->setBold(true);
                // $alphabets = ['C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG'];
                // foreach($alphabets as $a){
                // $event->sheet->setCellValue($a.($num+1),'=COUNTIF('.$a.'2:'.$a.$num.',"P")');
                // $cellRange3 = 'A'.($num+1).':AH'.($num+1);
                // $event->sheet->getDelegate()->getStyle($cellRange3)->getFont()->setSize(12)->setBold(true);
                // }
                //  $event->sheet->setCellValue('B'.($num+1),'Total');
                // $event->sheet->setCellValue('AH'.($num+1),'=SUM(AH2:AH'.$num.')');
            },
            
        
        ];
        return $result;
    }
}
