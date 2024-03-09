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
    protected $academic_year;

    function __construct($branch, $staff_id, $student_name, $department_id, $class_id, $section_id, $session,$academic_year)
    {
        $this->staff_id = $staff_id;
        $this->branch = $branch;
        $this->student_name = $student_name;
        $this->department_id = $department_id;
        $this->class_id = $class_id;
        $this->section_id = $section_id;
        $this->session = $session;
        $this->academic_year = $academic_year;
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
            "session" => $this->session,
            "academic_year" => $this->academic_year,
            
        ];
        $response = Helper::PostMethod(config('constants.api.download_student_list_information'), $data);
        $excel = $response['data'];

        $this->studentList = collect($excel);
        $this->getSingleColumn = isset($this->studentList[0]) ? $this->studentList[0] : [];
        $this->columns = [
            'Attendance No',
            'Student Name',
            'Student No',
            'Student Email',
            'Student Gender',
            'Student DOB',
            'Student Passport',
            'Student NRIC',
            'Student Admission Date',
            'Student Nationality',
            'Student Address1',
            'Student Address2',
            'Student Mobile No',
            'Parent Name',
            'Parent Gender',
            'Parent Email',
            'Parent DOB',
            'Parent Occupation',
            'Parent Passport',
            'Parent NRIC',
            'Parent Mobile No',
            'Parent Nationality',
            'School Address',
            'School Mobile No',
            'School Email',
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
            $this->columns = [
                'Attendance No'=> $item['attendance_no'] ?? null,
                'Student Name'=> $item['name'] ?? null,
                'Student No'=> $item['register_no'] ?? null,
                'Student Email'=> $item['email'] ?? null,
                'Student Gender'=> $item['gender'] ?? null,
                'Student DOB'=> $item['birthday'] ?? null,
                'Student Passport'=> $item['passport'] ?? null,
                'Student NRIC'=> $item['nric'] ?? null,
                'Student Admission Date'=> $item['admission_date'] ?? null,
                'Student Nationality'=> $item['nationality'] ?? null,
                'Student Address1'=> $item['current_address'] ?? null,
                'Student Address2'=> $item['permanent_address'] ?? null,
                'Student Mobile No'=> $item['mobile_no'] ?? null,
                'Parent Name'=> $item['parent_name'] ?? null,
                'Parent Gender'=> $item['parent_gender'] ?? null,
                'Parent Email'=> $item['parent_email'] ?? null,
                'Parent DOB'=> $item['parent_dob'] ?? null,
                'Parent Occupation'=> $item['parent_occupation'] ?? null,
                'Parent Passport'=> $item['parent_passport'] ?? null,
                'Parent NRIC'=> $item['parent_nric'] ?? null,
                'Parent Mobile No'=> $item['parent_mobile_no'] ?? null,
                'Parent Nationality'=> $item['parent_nationality'] ?? null,
                'School Address'=> $item['school_address'] ?? null,
                'School Mobile No'=> $item['school_mobile_no'] ?? null,
                'School Email'=> $item['school_email'] ?? null
            ];
            return $this->columns;
            // dd($this->columns);
            // Check if 'all_marks' key exists in $item
            // if (isset($item['all_marks']) && is_array($item['all_marks'])) {
            //     collect($item['all_marks'])->each(function ($mark) {
            //         // dd($mark);
            //         $header = ($mark['academic_session_name'] ?? null) . '-' . ($mark['subject_name'] ?? null) . '-' . ($mark['paper_name'] ?? null);
            //         $score = ($mark['score'] ?? null);
            //         $this->keyValArray[$header] = $score;
            //     });
            // } else {
            //     $this->keyValArray['AY-SUB-PAPER'] = null;
            // }
            // return $this->keyValArray;
        });
        // dd($exportData);
        return $exportData;
    }
    public function headings(): array
    {
        // Use the defined custom headers
        return array_values($this->columns);
    }
}
