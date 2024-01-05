<?php

namespace App\Exports;

use DateTime;
use DateInterval;
use DatePeriod;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Support\Collection;

use DB;
// base controller add
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Helpers\Helper;

class StudentListExport  implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $columns;
    protected $getSingleColumn;
    protected $keyValArray;
    protected $branch;
    protected $staff_id;
    protected $student_name;
    protected $department_id;
    protected $class_id;
    protected $section_id;
    protected $session;
    protected $studentList;

    function __construct($branch, $staff_id, $student_name, $department_id, $class_id, $section_id, $session)
    {
        $this->staff_id = $staff_id;
        $this->branch = $branch;
        $this->student_name = $student_name;
        $this->department_id = $department_id;
        $this->class_id = $class_id;
        $this->section_id = $section_id;
        $this->session = $session;
        $this->columns = [];
        $this->keyValArray = [];
        $data = [
            // "academic_session_id" => session()->get('academic_session_id'),
            "branch_id" => $this->branch,
            "staff_id" => $this->staff_id,
            "student_name" => $this->student_name,
            "department_id" => $this->department_id,
            "class_id" => $this->class_id,
            "section_id" => $this->section_id,
            "session" => $this->session
        ];
        $response = Helper::PostMethod(config('constants.api.download_student_list_information'), $data);
        $excel = $response['data'];
        $this->studentList = collect($excel);
        $this->getSingleColumn = isset($this->studentList[0]) ? $this->studentList[0] : [];
        $this->columns = [
            'Attendance No',
            'Student Name',
            'Student Email',
            'Student Gender',
            'DOB',
            'Parent Name',
            'Parent Gender',
            'Parent Email',
            'Nationality',
            'Grade Name',
            'Class Name',
            'No of Days Attendance',
            'Present Count',
            'Absent Count',
            'Late Count',
            'Excused Count'
        ];
        // here we add dynamic papernames
        if (isset($this->getSingleColumn['all_marks']) && is_array($this->getSingleColumn['all_marks'])) {
            foreach ($this->getSingleColumn['all_marks'] as $mark) {
                $header = ($mark['academic_session_name'] ?? null) . '-' . ($mark['subject_name'] ?? null) . '-' . ($mark['paper_name'] ?? null);
                if (!in_array($header, $this->columns)) {
                    $this->columns[] = $header;
                }
            }
        }
    }
    public function collection()
    {
        $exportData = $this->studentList->map(function ($item) {
            $this->keyValArray = [
                'Attendance No' => $item['attendance_no'] ?? null,
                'Student Name' => $item['name'] ?? null,
                'Student Email' => $item['email'] ?? null,
                'Student Gender' => $item['gender'] ?? null,
                'DOB' => $item['birthday'] ?? null,
                'Parent Name' => $item['parent_name'] ?? null,
                'Parent Gender' => $item['parent_gender'] ?? null,
                'Parent Email' => $item['parent_email'] ?? null,
                'Nationality' => $item['nationality'] ?? null,
                'Grade Name' => $item['class_name'] ?? null,
                'Class Name' => $item['section_name'] ?? null,
                'No of Days Attendance' => $item['no_of_days_attendance'] ?? null,
                'Present Count' => $item['presentCount'] ?? null,
                'Absent Count' => $item['absentCount'] ?? null,
                'Late Count' => $item['lateCount'] ?? null,
                'Excused Count' => $item['excusedCount'] ?? null,
            ];
            // Check if 'all_marks' key exists in $item
            if (isset($item['all_marks']) && is_array($item['all_marks'])) {
                collect($item['all_marks'])->each(function ($mark) {
                    // dd($mark);
                    $header = ($mark['academic_session_name'] ?? null) . '-' . ($mark['subject_name'] ?? null) . '-' . ($mark['paper_name'] ?? null);
                    $score = ($mark['score'] ?? null);
                    $this->keyValArray[$header] = $score;
                });
            } else {
                $this->keyValArray['AY-SUB-PAPER'] = null;
            }
            return $this->keyValArray;
        });
        return $exportData;
    }
    public function headings(): array
    {
        // Use the defined custom headers
        return array_values($this->columns);
    }
}
