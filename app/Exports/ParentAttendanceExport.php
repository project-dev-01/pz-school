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
use App\Helpers\Helper;
Use DB;
// base controller add
use App\Http\Controllers\Api\BaseController as BaseController;

class ParentAttendanceExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    protected $branch;
    protected $student;
    protected $subject;
    protected $date;

    function __construct($branch,$student,$subject,$date) {
        $this->branch = $branch;
        $this->student = $student;
        $this->subject = $subject;
        $this->date = $date;
    }
    public function collection()
    {
        
        $data = [
            "academic_session_id" => session()->get('academic_session_id'),
            "branch_id" => $this->branch,
            "student_id" => $this->student,
            "subject_id" => $this->subject,
            "pattern" => "Month",
            "date" => $this->date,
        ];
        // dd(config('constants.api.staff_attendance_export'));  
        $response = Helper::PostMethod(config('constants.api.student_attendance_export'), $data);
        $excel = $response['data']['attendance'];
        
        return collect($excel);
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
