<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Http;
use DB;
use DateTime;
use App\Models\User;
// base controller add
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Helpers\Helper;

class ExamScheduleDownload extends BaseController implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $exam_name;
    protected $class_section_name;
    protected $class_id;
    protected $section_id;
    protected $exam_id;
    protected $semester_id;
    protected $session_id;

    function __construct($exam_name,$class_section_name,$class_id, $section_id, $exam_id, $semester_id, $session_id)
    {
        $this->exam_name = $exam_name;
        $this->class_section_name = $class_section_name;
        $this->class_id = $class_id;
        $this->section_id = $section_id;
        $this->exam_id = $exam_id;
        $this->semester_id = $semester_id;
        $this->session_id = $session_id;
    }
    public function collection()
    {
        $data = [
            "academic_session_id" => session()->get('academic_session_id'),
            "exam_id" => $this->exam_id,
            "class_id" => $this->class_id,
            "section_id" => $this->section_id,
            "semester_id" => $this->semester_id,
            "session_id" => $this->session_id
        ];
        $response = Helper::PostMethod(config('constants.api.exam_timetable_list_download'), $data);
        $excel = $response['data']['exam'];
        // $details = $response['data']['details'];
        // $this->exam_name = $details['exam_name'];
        // $this->grade_name = $details['class_name'] . '(' . $details['section_name'] . ')';
        return collect($excel);
    }
    public function headings(): array
    {
        $rangeHeadings = [
            'Subject',
            'Paper Name',
            'Date',
            'Starting Time',
            'Ending Time',
            'Location',
            'Distributor'
        ];
        return [
            [
                "Exam :" . $this->exam_name . ',  Grade :' . $this->class_section_name,
            ],
            $rangeHeadings,
        ];
    }
    public function registerEvents(): array
    {
        $result = [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:B1'; // All headers
                $cellRange1 = 'A2:G2'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12)->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange1)->getFont()->setSize(12)->setBold(true);
            },
        ];
        return $result;
    }
}
