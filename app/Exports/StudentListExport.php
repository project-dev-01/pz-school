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
            'Student No',
            'Student Department',
            'Student Grade',
            'Student Section',
            'Attendance No',
            'Student Last',
            'Student First',
            'Student Name Roma',
            'Student Name Furigana',
            'Student Name Common',
            'Student Email',
            'Student Gender',
            'Student DOB',
            'Student Passport',
            'Student NRIC',
            'Student Visa Type',
            'Student Admission Date',
            'Student Nationality',
            'Student Dual Nationality',
            'Student Address (Unit No)',
            'Student Address (Condominium)',
            'Student Address 1 (Street)',
            'Student Address (District)',
            'Student City',
            'Student State',
            'Student Country',
            'Student Postal code',
            'Student Mobile No',
            'Student Previous School',
            'Student Previous Country',
            'Student Previous State',
            'Student Previous City',
            'Student Previous Postal Code',
            'Student Previous Enrollment Status',
            'Parent Name',
            'Parent Name Furigana',
            'Parent Name Roma',
            'Parent Email',
            'Parent Occupation',
            'Parent Mobile No',
            'Parent Nationality',
            'Company Name Japan',
            'Company Name Local',
            'Company Phone Number',
            'Employment Status',
            'Remarks',
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
                'Student No'=> $item['register_no'] ?? null,
                'Student Department'=> $item['department_name'] ?? null,
                'Student Grade'=> $item['class_name'] ?? null,
                'Student Section'=> $item['section_name'] ?? null,
                'Attendance No'=> $item['attendance_no'] ?? null,
                'Student Last'=> $item['last_name'] ?? null,
                'Student First'=> $item['first_name'] ?? null,
                'Student Name Roma'=> $item['eng_name'] ?? null,
                'Student Name Furigana'=> $item['fur_name'] ?? null,
                'Student Name Common'=> $item['common_name'] ?? null,
                'Student Email'=> $item['email'] ?? null,
                'Student Gender'=> $item['gender'] ?? null,
                'Student DOB'=> $item['birthday'] ?? null,
                'Student Passport'=> $item['passport'] ?? null,
                'Student NRIC'=> $item['nric'] ?? null,
                'Student Visa Type'=> $item['visa_type'] ?? null,
                'Student Admission Date'=> $item['admission_date'] ?? null,
                'Student Nationality'=> $item['nationality'] ?? null,
                'Student Dual Nationality' => $item['dual_nationality'] ?? null,
                'Student Address (Unit No)'=> $item['address_unit_no'] ?? null,
                'Student Address (Condominium)'=> $item['address_condominium'] ?? null,
                'Student Address 1 (Street)'=> $item['address_street'] ?? null,
                'Student Address (District)'=> $item['address_district'] ?? null,
                'Student City'=> $item['city'] ?? null,
                'Student State'=> $item['state'] ?? null,
                'Student Country'=> $item['country'] ?? null,
                'Student Postal code'=> $item['post_code'] ?? null,
                'Student Mobile No'=> $item['mobile_no'] ?? null,
                'Student Previous School'=> $item['previous_school']['school_name'] ?? null,
                'Student Previous Country'=> $item['school_country'] ?? null,
                'Student Previous State'=> $item['school_state'] ?? null,
                'Student Previous City'=> $item['school_city'] ?? null,
                'Student Previous Postal Code'=> $item['school_postal_code'] ?? null,
                'Student Previous Enrollment Status'=> $item['school_enrollment_status'] ?? null,
                'Parent Name'=> $item['parent_name'] ?? null,
                'Parent Name Furigana'=> $item['parent_fur_name'] ?? null,
                'Parent Name Roma'=> $item['parent_eng_name'] ?? null,
                'Parent Email'=> $item['parent_email'] ?? null,
                'Parent Occupation'=> $item['parent_occupation'] ?? null,
                'Parent Mobile No'=> $item['parent_mobile_no'] ?? null,
                'Parent Nationality'=> $item['parent_nationality'] ?? null,
                'Company Name Japan' => $item['company_name_japan'] ?? null,
                'Company Name Local'=> $item['company_name_local'] ?? null,
                'Company Phone Number'=> $item['company_phone_number'] ?? null,
                'Employment Status'=> $item['employment_status'] ?? null,
                'Remarks'=> $item['remarks'] ?? null,
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
