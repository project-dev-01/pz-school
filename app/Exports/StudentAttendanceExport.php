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

class StudentAttendanceExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    protected $branch;
    protected $class;
    protected $section;
    protected $subject;
    protected $date;
    protected $pattern;

    function __construct($branch,$class,$section,$subject,$pattern,$date) {
        $this->branch = $branch;
        $this->class = $class;
        $this->section = $section;
        $this->subject = $subject;
        $this->pattern = $pattern;
        $this->date = $date;
    }
    public function collection()
    {
        
        $data = [
            "academic_session_id" => session()->get('academic_session_id'),
            "branch_id" => $this->branch,
            "class_id" => $this->class,
            "section_id" => $this->section,
            "subject_id" => $this->subject,
            "pattern" => $this->pattern,
            "date" => $this->date,
        ];
        // dd(config('constants.api.staff_attendance_export'));   
        $response = Helper::PostMethod(config('constants.api.student_attendance_export'), $data);
        // dd($response);
        $excel = $response['data']['attendance'];
        
        return collect($excel);
    }

    
    public function headings(): array
    {
        if($this->pattern == "Day"){
            $final = ['#',__('messages.name'),__('messages.name_english'),__('messages.grade'),__('messages.class'),__('messages.status'),__('messages.remarks')];
    
        }else if($this->pattern == "Month"){
            $date = $this->date;
            $month_year = explode("-", $date);
            $m = $month_year[0];
            $y = $month_year[1];
    
            $final = ['#',__('messages.name')];
    
            
            
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
        }else if($this->pattern == "Term"){
            $final = ['#',__('messages.name'),__('messages.name_english'),__('messages.grade'),__('messages.class'),__('messages.semester'),__('messages.no_of_present'),__('messages.no_of_absent'),__('messages.no_of_late'),__('messages.remarks')];
    
        }else if($this->pattern == "Year"){
            $final = ['#',__('messages.name'),__('messages.name_english'),__('messages.grade'),__('messages.class'),__('messages.no_of_present'),__('messages.no_of_absent'),__('messages.no_of_late'),__('messages.remarks')];
    
        }
        

        return $final;
    }

    public function registerEvents(): array
    {
        
        
        $result = [
            AfterSheet::class => function(AfterSheet $event) {
                // dd($event);
                if($this->pattern == "Month"){

                    $date = $this->date;
                    $month_date = explode("-", $date);
                    $month = $month_date[0];
                    $year = $month_date[1];
    
                    
                    $tot = date('t', strtotime($year.'-'.$month.'-01'));
                }
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
