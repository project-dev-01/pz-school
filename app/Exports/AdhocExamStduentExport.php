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
use Illuminate\Support\Facades\Http;
use DB;

use App\Models\User;
// base controller add
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Helpers\Helper;

class AdhocExamStduentExport  implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $department_name;
    protected $class_name;
    protected $section_name;
    protected $exam_name;
    protected $subject_name;

    protected $branch_id;
    protected $department_id;
    protected $class_id;
    protected $section_id;
    protected $exam_id;
    protected $subject_id;
    protected $exam_date;
    protected $score_type;

    function __construct($department_name,$class_name,$section_name,$exam_name,$subject_name,$branch_id,$department_id,$class_id, $section_id, $exam_id,$subject_id, $exam_date,$score_type)
    {
        $this->department_name = $department_name;
        $this->class_name = $class_name;
        $this->section_name = $section_name;
        $this->exam_name = $exam_name;
        $this->subject_name = $subject_name;
        $this->score_type = $score_type;
        $this->branch_id = $branch_id;
        $this->department_id = $department_id;
        $this->class_id = $class_id;
        $this->section_id = $section_id;
        $this->exam_id = $exam_id;
        $this->subject_id = $subject_id;        
        $this->exam_date = $exam_date;
    }
    public function collection()
    {
        $data = [
            "academic_session_id" => session()->get('academic_session_id'),
            "branch_id" => $this->branch_id,
            "department_id" => $this->department_id,
            "class_id" => $this->class_id,
            "section_id" => $this->section_id,
            "exam_id" => $this->exam_id,
            "subject_id" => $this->subject_id
        ];
       
        $response = Helper::PostMethod(config('constants.api.adhocexam_student_list'), $data);
        //dd($data);
        $excel = $response['data'];
       
        //dd($excel);
        return collect($excel);
    }
    public function headings(): array
    {
        $rangeHeadings = [
            'sno',
            'Register No',
            'Student Name',            
            'Mark'
        ];
       
        if($this->score_type=='Points')
        {
            $exammark_type="Enter Grade Point Label Name";

        }
        else if($this->score_type=='Freetext')
        {
            $exammark_type="Like Teacher Comments";
        }
        else if($this->score_type=='Grade' || $this->score_type=='Mark')
        {
            $exammark_type="Ex:80";
        }
        else 
        {
            $exammark_type="";
            
        }
        
        return [
            [
                "Department Name :", $this->department_name ,
            ],
            [
                "Grade Name :", $this->class_name ,
            ],
            [
                "Class Name :", $this->section_name ,
            ],
            [
                "Exam Name :", $this->exam_name ,
            ],
            
            [
                "Subject Name :", $this->subject_name ,
            ], 
            [
                "Exam Date :", $this->exam_date ,
            ],           
            [
                "Mark Type :", $this->score_type , $exammark_type,
            ],
            
            $rangeHeadings,
            
        ];
    }
    public function registerEvents(): array
    {
        $result = [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:B1'; // Department headers
                $cellRange1 = 'A2:B2'; // Grade headers
                $cellRange2 = 'A3:B3'; // Class headers
                $cellRange3 = 'A4:B4'; // Exam headers
                $cellRange4 = 'A5:B5'; // Subject  headers
                $cellRange5 = 'A6:B6'; // Exam Date
                $cellRange6 = 'A7:B7'; // Mark type headers
                $cellRange7 = 'A8:F8'; // All headers
               
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12)->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange1)->getFont()->setSize(12)->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange2)->getFont()->setSize(12)->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange3)->getFont()->setSize(12)->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange4)->getFont()->setSize(12)->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange5)->getFont()->setSize(12)->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange6)->getFont()->setSize(12)->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange7)->getFont()->setSize(12)->setBold(true);
                
            },
        ];
        return $result;
    }
}
