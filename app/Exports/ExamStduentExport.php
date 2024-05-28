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

class ExamStduentExport  implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $department_name;
    protected $class_name;
    protected $section_name;
    protected $exam_name;
    protected $subject_name;
    protected $semester_name;
    protected $teachername;
    protected $totalstudent;

    protected $branch_id;
    protected $department_id;
    protected $class_id;
    protected $section_id;
    protected $exam_id;
    protected $subject_id;
    protected $paper_id;
    protected $semester_id;
    protected $session_id;

    function __construct($department_name,$class_name,$section_name,$exam_name,$subject_name,$semester_name,$teachername,$totalstudent,$branch_id,$department_id,$class_id, $section_id, $exam_id,$subject_id, $paper_id, $semester_id, $session_id)
    {
        $this->department_name = $department_name;
        $this->class_name = $class_name;
        $this->section_name = $section_name;
        $this->exam_name = $exam_name;
        $this->subject_name = $subject_name;
        $this->semester_name = $semester_name;
        $this->teachername = $teachername;
        $this->totalstudent = $totalstudent;
        
        $this->branch_id = $branch_id;
        $this->department_id = $department_id;
        $this->class_id = $class_id;
        $this->section_id = $section_id;
        $this->exam_id = $exam_id;
        $this->subject_id = $subject_id;
        $this->paper_id = $paper_id;
        $this->semester_id = $semester_id;
        $this->session_id = $session_id;
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
            "subject_id" => $this->subject_id,
            "paper_id" => $this->paper_id,
            "semester_id" => $this->semester_id,
            "session_id" => $this->session_id
        ];
        //dd($data);
        $response = Helper::PostMethod(config('constants.api.exam_student_list'), $data);
       
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
            'Paper Name',
            'Score Type',               
            'Mark',
            'Attandance (P/A)',
            'Memo'
        ];
       
        $remarks="Score Type : 'Points' then Results: Improving, Satisfactory, Excellent";
        
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
                "Semester :", $this->semester_name ,
            ],
            [
                "Subject Name :", $this->subject_name ,
            ],
            [
                "Total  Student :", $this->totalstudent ,
            ],
            [
                "Teacher Name :", $this->teachername ,'', $remarks,
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
                $cellRange4 = 'A5:B5'; // Semester headers
                $cellRange5 = 'A6:B6'; // Subject  headers
                $cellRange6 = 'A7:B7'; // Total Sudent  headers
                $cellRange7 = 'A8:B8'; // Teacher name headers
                $cellRange8 = 'A9:H9'; // Mark type headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12)->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange1)->getFont()->setSize(12)->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange2)->getFont()->setSize(12)->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange3)->getFont()->setSize(12)->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange4)->getFont()->setSize(12)->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange5)->getFont()->setSize(12)->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange6)->getFont()->setSize(12)->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange7)->getFont()->setSize(12)->setBold(true); 
                $event->sheet->getDelegate()->getStyle($cellRange8)->getFont()->setSize(12)->setBold(true);
            },
        ];
        return $result;
    }
}
