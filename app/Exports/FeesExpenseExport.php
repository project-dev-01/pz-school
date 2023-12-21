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
use App\Helpers\Helper;

class FeesExpenseExport  implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    protected $branch;
    protected $department_id;
    protected $class_id;
    protected $section_id;
    protected $academic_session_id;

    function __construct($branch,$department_id,$class_id,$section_id,$academic_session_id) {
        $this->branch = $branch;
        $this->department_id = $department_id;
        $this->class_id = $class_id;
        $this->section_id = $section_id;
        $this->academic_session_id = $academic_session_id;
    }
    public function collection()
    {
        
        $data = [
            "academic_session_id" => $this->academic_session_id,
            "branch_id" => $this->branch,
            "department_id" => $this->department_id,
            "class_id" => $this->class_id,
            "section_id" => $this->section_id,
            "academic_session_id" => $this->academic_session_id
        ];
        // dd(config('constants.api.staff_attendance_export'));   
        $response = Helper::PostMethod(config('constants.api.fees_expense_export'), $data);
        $excel = $response['data']['expense'];
        return collect($excel);
    }

    
    public function headings(): array
    {
        $final = ['Name','Roll Number','Semester 1','Semester 2','Semester 3'];

        return $final;
    }

    public function registerEvents(): array
    {
        
        
        $result = [
            AfterSheet::class => function(AfterSheet $event) {
                // // dd($event);
                // $date = $this->date;
                // $month_date = explode("-", $date);
                // $month = $month_date[0];
                // $year = $month_date[1];

                
                // $tot = date('t', strtotime($year.'-'.$month.'-01'));
                // // dd($tot);
                // $num = $event->sheet->getHighestRow();
                // $cellRange = 'A1:AK1'; // All headers
                // $cellRange2 = 'A1:A'.($num+1);
                // $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12)->setBold(true);
                // $event->sheet->getDelegate()->getStyle($cellRange2)->getFont()->setSize(12)->setBold(true);

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
