<?php

namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// base controller add
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\BaseController as BaseController;
// encrypt and decrypt
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\User;
use DateTime;

class ApiControllerOne extends BaseController
{
    // add Grade Category
    public function addGradeCategory(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($Connection->table('grade_category')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // insert data
                $query = $Connection->table('grade_category')->insert([
                    'name' => $request->name,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Grade Category has been successfully saved');
                }
            }
        }
    }
    // get GradeCategoryList
    public function getGradeCategoryList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data
            $GradeCategory = $Connection->table('grade_category')->get();
            return $this->successResponse($GradeCategory, 'Grade Category record fetch successfully');
        }
    }
    // get Grade Category Details row details
    public function getGradeCategoryDetails(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'branch_id' => 'required',
            'token' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $id = $request->id;
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data
            $deptDetails = $Connection->table('grade_category')->where('id', $id)->first();
            return $this->successResponse($deptDetails, 'Grade Category row fetch successfully');
        }
    }
    // updateGrade Category
    public function updateGradeCategory(Request $request)
    {
        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($Connection->table('grade_category')->where([['name', '=', $request->name], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $Connection->table('grade_category')->where('id', $id)->update([
                    'name' => $request->name,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Grade Category Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete Gade Category
    public function deleteGadeCategory(Request $request)
    {

        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data
            $query = $Connection->table('grade_category')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Grade Category have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // by class by all subjects
    public function classByAllSubjects(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'class_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data
            $classByAllSubjects = $Connection->table('subject_assigns as sa')
                ->select(
                    'sa.subject_id',
                    'sb.name as subject_name',
                    DB::raw('CONCAT(stf.first_name, " ", stf.last_name) as teacher_name'),
                )
                ->leftJoin('staffs as stf', 'sa.teacher_id', '=', 'stf.id')
                ->join('subjects as sb', 'sa.subject_id', '=', 'sb.id')
                ->where([
                    ['sa.type', '=', '0'],
                    ['sb.exam_exclude', '=', '0'],
                    ['sa.class_id', '=', $request->class_id]
                ])
                ->groupBy('sa.subject_id')
                ->get();
            return $this->successResponse($classByAllSubjects, 'class by all subjects record fetch successfully');
        }
    }
    // import Csv Parents
    public function importCsvParents(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'file' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);

            $file = $request->file('file');
            // File Details 
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
            header('Content-type: text/plain; charset=utf-8');
            // Valid File Extensions
            $valid_extension = array("csv");
            // 2MB in Bytes
            $maxFileSize = 2097152;
            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {
                // Check file size
                if ($fileSize <= $maxFileSize) {
                    // File upload location
                    $location = 'uploads';
                    // Upload file
                    $file->move($location, $filename);
                    // Import CSV to Database
                    // $filepath = public_path($location."/".$filename);
                    $filepath = $location . "/" . $filename;
                    // $file = fopen($filename, "r");
                    // if ($handle) {
                    //     // Use $handle
                    // } else {
                    //     die("Unable to open file");
                    // }
                    // Reading file
                    $file = fopen($filepath, "r");
                    $importData_arr = array();
                    $i = 0;
                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);
                        // Skip first row (Remove below comment if you want to skip the first row)
                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    // exit();
                    fclose($file);
                    // dummyemail
                    $dummyInc = 1;
                    // Insert to MySQL database
                    foreach ($importData_arr as $importData) {

                        $dummyInc++;
                        // dd($importData[5]);
                        $name = $importData[7] . " " . "";
                        // insert data
                        $passport = "";
                        $nric = isset($importData[5]) ? Crypt::encryptString($importData[5]) : "";
                        $mobile_no = isset($importData[14]) ? Crypt::encryptString($importData[14]) : "";
                        $address = isset($importData[4]) ? Crypt::encryptString($importData[4]) : "";
                        $address_2 = "";
                        $email = isset($importData[8]) ? $dummyInc . $importData[8] : null;
                        $dob = date("Y-m-d", strtotime($importData[6]));

                        if (isset($email)) {

                            $data = [
                                'first_name' => isset($importData[7]) ? $importData[7] : "",
                                'last_name' => "",
                                'gender' => $importData[10],
                                'date_of_birth' => $dob,
                                'passport' => $passport,
                                'race' => $importData[11],
                                'religion' => $importData[12],
                                'nric' => $nric,
                                'blood_group' => "",
                                'occupation' => $importData[13],
                                'income' => $importData[15],
                                'education' => "",
                                'country' => $importData[0],
                                'post_code' => $importData[3],
                                'city' => $importData[2],
                                'state' => $importData[1],
                                'mobile_no' => $mobile_no,
                                'address' => $address,
                                'address_2' => $address_2,
                                'email' => $email,
                                'photo' => "",
                                'facebook_url' => "",
                                'linkedin_url' => "",
                                'twitter_url' => "",
                                'status' => "0",
                                'ref_father_id' => isset($importData[16]) ? $importData[16] : null,
                                'ref_mother_id' => isset($importData[17]) ? $importData[17] : null,
                                'ref_guardian_id' => isset($importData[18]) ? $importData[18] : null,
                                'created_at' => date("Y-m-d H:i:s")
                            ];
                            // dd($data);
                            $parentId = $Connection->table('parent')->insertGetId($data);
                            if (!$parentId) {
                                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong add Parent']);
                            } else {
                                // add User
                                $query = new User();
                                $query->name = $name;
                                $query->user_id = $parentId;
                                $query->role_id = "5";
                                $query->branch_id = $request->branch_id;
                                $query->email = $email;
                                $query->status = "0";
                                $query->password = bcrypt($importData[9]);
                                $query->save();
                            }
                        }
                    }
                    return $this->successResponse([], 'Import Successful');
                } else {
                    return $this->send422Error('Validation error.', ['error' => 'File too large. File must be less than 2MB.']);
                }
            } else {
                return $this->send422Error('Validation error.', ['error' => 'Invalid File Extension']);
            }
        }
    }
    // import Csv Parents
    public function importCsvStudents(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'file' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);

            $file = $request->file('file');
            // File Details 
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
            header('Content-type: text/plain; charset=utf-8');
            // Valid File Extensions
            $valid_extension = array("csv");
            // 2MB in Bytes
            $maxFileSize = 2097152;
            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {
                // Check file size
                if ($fileSize <= $maxFileSize) {
                    // File upload location
                    $location = 'uploads';
                    // Upload file
                    $file->move($location, $filename);
                    // Import CSV to Database
                    // $filepath = public_path($location."/".$filename);
                    $filepath = $location . "/" . $filename;
                    // $file = fopen($filename, "r");
                    // if ($handle) {
                    //     // Use $handle
                    // } else {
                    //     die("Unable to open file");
                    // }
                    // Reading file
                    $file = fopen($filepath, "r");
                    $importData_arr = array();
                    $i = 0;
                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);
                        // Skip first row (Remove below comment if you want to skip the first row)
                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    // exit();
                    fclose($file);
                    // dummyemail
                    $dummyInc = 1;
                    // Insert to MySQL database
                    foreach ($importData_arr as $importData) {
                        $dummyInc++;
                        // dd($importData);
                        $name = $importData[4] . " ";
                        // insert data
                        $passport = "";
                        $nric = isset($importData[5]) ? Crypt::encryptString($importData[5]) : "";
                        $mobile_no = isset($importData[21]) ? Crypt::encryptString($importData[21]) : "";
                        $address = isset($importData[19]) ? Crypt::encryptString($importData[19]) : "";
                        $address_2 = "";
                        $email = isset($importData[2]) ? $importData[2] : null;
                        $dob = date("Y-m-d", strtotime($importData[6]));
                        $admission_date = date("Y-m-d", strtotime($importData[7]));
                        // dd($dob);
                        $ref_father_id = $Connection->table('parent')
                            ->select('id')
                            ->where('ref_father_id', $importData[22])
                            ->where('ref_father_id', '!=', '')
                            ->orderBy('created_at', 'desc')->first();
                        $ref_mother_id = $Connection->table('parent')
                            ->select('id')
                            ->where('ref_mother_id', $importData[23])
                            ->where('ref_mother_id', '!=', '')
                            ->orderBy('created_at', 'desc')->first();
                        $ref_guardian_id = $Connection->table('parent')
                            ->select('id')
                            ->where('ref_guardian_id', $importData[24])
                            ->where('ref_guardian_id', '!=', '')
                            ->orderBy('created_at', 'desc')->first();

                        // dd($ref_guardian_id);

                        if (isset($email)) {
                            $data = [
                                'father_id' => isset($ref_father_id->id) ? $ref_father_id->id : null,
                                'mother_id' => isset($ref_mother_id->id) ? $ref_mother_id->id : null,
                                'guardian_id' => isset($ref_guardian_id->id) ? $ref_guardian_id->id : null,
                                'passport' => $passport,
                                'nric' => $nric,
                                'relation' => $importData[14],
                                'register_no' => $importData[0],
                                'roll_no' => $importData[1],
                                'admission_date' => $admission_date,
                                'category_id' => $importData[10],
                                'first_name' => isset($importData[4]) ? $importData[4] : "",
                                'last_name' => "",
                                'gender' => $importData[12],
                                'birthday' => $dob,
                                'religion' => $importData[14],
                                'race' => $importData[13],
                                'country' => $importData[15],
                                'post_code' => $importData[18],
                                'mobile_no' => $mobile_no,
                                'city' => $importData[17],
                                'state' => $importData[16],
                                'current_address' => $address_2,
                                'permanent_address' => $address,
                                'email' => $importData[2],
                                'status' => "0",
                                'created_at' => date("Y-m-d H:i:s")
                            ];
                            // dd($data);

                            $studentId = $Connection->table('students')->insertGetId($data);
                            if (!$studentId) {
                                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong add Parent']);
                            } else {
                                // add endrools table
                                $classDetails = [
                                    'student_id' => $studentId,
                                    'class_id' => $importData[8],
                                    'section_id' => $importData[9],
                                    'roll' => $importData[1],
                                    'session_id' => isset($importData[11]) ? $importData[11] : 0,
                                    'semester_id' => 0,
                                ];
                                $Connection->table('enrolls')->insert($classDetails);
                                // add User
                                $query = new User();
                                $query->name = $name;
                                $query->user_id = $studentId;
                                $query->role_id = "6";
                                $query->branch_id = $request->branch_id;
                                $query->email = $email;
                                $query->status = "0";
                                $query->password = bcrypt($importData[3]);
                                $query->save();
                            }
                        }
                    }
                    return $this->successResponse([], 'Import Successful');
                } else {
                    return $this->send422Error('Validation error.', ['error' => 'File too large. File must be less than 2MB.']);
                }
            } else {
                return $this->send422Error('Validation error.', ['error' => 'Invalid File Extension']);
            }
        }
    }
    // get all paper types
    public function getPaperTypeList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data
            $GradeCategory = $Connection->table('paper_type')->get();
            return $this->successResponse($GradeCategory, 'Paper type record fetch successfully');
        }
    }
    // import csv timetable
    // import Csv Parents
    public function importCsvTimetable(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'file' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $branchID = $request->branch_id;
            $Connection = $this->createNewConnection($request->branch_id);

            $file = $request->file('file');
            // File Details 
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
            header('Content-type: text/plain; charset=utf-8');
            // Valid File Extensions
            $valid_extension = array("csv");
            // 2MB in Bytes
            $maxFileSize = 2097152;
            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {
                // Check file size
                if ($fileSize <= $maxFileSize) {
                    // File upload location
                    $location = 'uploads';
                    // Upload file
                    $file->move($location, $filename);
                    // Import CSV to Database
                    // $filepath = public_path($location."/".$filename);
                    $filepath = $location . "/" . $filename;
                    // $file = fopen($filename, "r");
                    // Reading file
                    $file = fopen($filepath, "r");
                    $importData_arr = array();
                    $i = 0;
                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);
                        // Skip first row (Remove below comment if you want to skip the first row)
                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    // exit();
                    fclose($file);
                    // dummyemail
                    $dummyInc = 1;
                    // Insert to MySQL database
                    foreach ($importData_arr as $importData) {
                        $dummyInc++;
                        // dd($importData);
                        // echo "<pre>";
                        // print_r($importData);
                        $class_id = 0;
                        $section_id = 0;
                        $session_id = 0;
                        $semester_id = 0;
                        $break = 0;
                        $subject_id = 0;
                        $teacher_id = NULL;

                        $class_id = $importData[0];
                        $section_id = $importData[1];
                        $semester_id = $importData[3];
                        $session_id = $importData[4];
                        $day = strtolower($importData[2]);
                        // echo "------";
                        // print_r($class_id);
                        // print_r($section_id);
                        // print_r($semester_id);
                        // print_r($session_id);
                        // print_r($day);
                        // echo "------";

                        // calendor data populate
                        $getObjRow = $Connection->table('semester as s')
                            ->select('start_date', 'end_date')
                            ->where('id', $semester_id)
                            ->first();
                        // print_r($getObjRow);
                        if (isset($importData[0])) {
                            $class_id = $importData[0];
                        }
                        if (isset($importData[1])) {
                            $section_id = $importData[1];
                        }
                        if (isset($importData[4])) {
                            $session_id = $importData[4];
                        }
                        if (isset($importData[3])) {
                            $semester_id = $importData[3];
                        }
                        if (isset($importData[6])) {
                            $teacher_id =  $importData[6];
                        }
                        if (isset($importData[5])) {
                            if ($importData[5] == "" || trim($importData[5]) == "Rehat") {
                                $break = 1;
                            } else {
                                $subject_id =  $importData[5];
                            }
                        }
                        $breakType = ($break == 1 ? "Break" : null);
                        $time_start = date("H:i:s", strtotime($importData[7]));
                        $time_end = date("H:i:s", strtotime($importData[8]));

                        $data = [
                            'class_id' => $class_id,
                            'section_id' => $section_id,
                            'break' => $break,
                            'break_type' => $breakType,
                            'subject_id' => $subject_id,
                            'teacher_id' => $teacher_id,
                            'class_room' => $importData[9],
                            'time_start' => $time_start,
                            'time_end' => $time_end,
                            'semester_id' => $semester_id,
                            'session_id' => $session_id,
                            'day' => $day,
                            'created_at' => date("Y-m-d H:i:s")
                        ];
                        $insertOrUpdateID = 0;
                        $insertOrUpdateID = $Connection->table('timetable_class')->insertGetId($data);

                        $bulkID = NuLL;
                        // return $break;
                        $this->addCalendorTimetable($branchID, $data, $getObjRow, $insertOrUpdateID, $bulkID);
                    }
                    // exit;
                    return $this->successResponse([], 'Import TimeTable Successful');
                } else {
                    return $this->send422Error('Validation error.', ['error' => 'File too large. File must be less than 2MB.']);
                }
            } else {
                return $this->send422Error('Validation error.', ['error' => 'Invalid File Extension']);
            }
        }
    }

    function addCalendorTimetable($branchID, $row, $getObjRow, $insertOrUpdateID, $bulkID)
    {
        if ($getObjRow) {
            $start = $getObjRow->start_date;
            $end = $getObjRow->end_date;
            //
            $startDate = new DateTime($start);
            $endDate = new DateTime($end);
            // sunday=0,monday=1,tuesday=2,wednesday=3,thursday=4
            //friday =5,saturday=6
            if (isset($row['day'])) {
                if ($row['day'] == "monday") {
                    $day = 1;
                }
                if ($row['day'] == "tuesday") {
                    $day = 2;
                }
                if ($row['day'] == "wednesday") {
                    $day = 3;
                }
                if ($row['day'] == "thursday") {
                    $day = 4;
                }
                if ($row['day'] == "friday") {
                    $day = 5;
                }
                if ($row['day'] == "saturday") {
                    $day = 6;
                }
                if (isset($day)) {
                    $this->addTimetableCalendor($branchID, $startDate, $endDate, $day, $row, $insertOrUpdateID, $bulkID);
                }
            }
        }
    }
    // addTimetableCalendor
    function addTimetableCalendor($branchID, $startDate, $endDate, $day, $row, $insertOrUpdateID, $bulkID)
    {
        // create new connection
        $Connection = $this->createNewConnection($branchID);
        // delete existing calendor data
        $calendors = $Connection->table('calendors')->where([
            ['time_table_id', '=', $insertOrUpdateID]
        ])->count();

        if ($calendors > 0) {
            $Connection->table('calendors')->where('time_table_id', $insertOrUpdateID)->delete();
        }

        if (isset($row['subject_id']) && isset($row['teacher_id'])) {
            while ($startDate <= $endDate) {
                if ($startDate->format('w') == $day) {
                    $start = $startDate->format('Y-m-d') . " " . $row['time_start'];
                    $end = $startDate->format('Y-m-d') . " " . $row['time_end'];
                    $arrayInsert = [
                        "title" => "timetable",
                        "class_id" => $row['class_id'],
                        "section_id" => $row['section_id'],
                        "sem_id" => $row['semester_id'],
                        "session_id" => $row['session_id'],
                        "subject_id" => $row['subject_id'],
                        // "teacher_id" => $row['teacher'],
                        "teacher_id" => $row['teacher_id'],
                        "start" => $start,
                        "end" => $end,
                        "time_table_id" => $insertOrUpdateID,
                        'created_at' => date("Y-m-d H:i:s")
                    ];

                    // return $arrayInsert;

                    $Connection->table('calendors')->insert($arrayInsert);
                }
                $startDate->modify('+1 day');
            }
        }
    }

    // exam Schedule List
    public function examScheduleList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'student_id' => 'required'
        ]);

        // dd($request);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);
            // get data
            $getStudentDetails = $con->table('enrolls as en')
                ->select(
                    'en.student_id',
                    'en.class_id',
                    'en.section_id',
                    'en.semester_id',
                    'en.session_id'
                )
                ->where([
                    ['en.student_id', '=', $request->student_id]
                ])
                ->first();
            $details = $con->table('timetable_exam')->select('exam.name', 'timetable_exam.exam_id')
                ->leftJoin('exam', 'timetable_exam.exam_id', '=', 'exam.id')
                ->where([
                    ['class_id', $getStudentDetails->class_id],
                    ['section_id', $getStudentDetails->section_id],
                    ['semester_id', $getStudentDetails->semester_id],
                    ['session_id', $getStudentDetails->session_id]
                ])
                ->groupBy('timetable_exam.exam_id')
                ->orderBy('timetable_exam.exam_date', 'desc')
                ->get();
            return $this->successResponse($details, 'Exam Timetable record fetch successfully');
        }
    }
    // get Exam Timetable 
    public function getExamTimetableList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'exam_id' => 'required',
            'student_id' => 'required'
        ]);

        // return $request;
        // dd($request);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);
            // get data

            $getStudentDetails = $con->table('enrolls as en')
                ->select(
                    'en.student_id',
                    'en.class_id',
                    'en.section_id',
                    'en.semester_id',
                    'en.session_id'
                )
                ->where([
                    ['en.student_id', '=', $request->student_id]
                ])
                ->first();
            // dd($getStudentDetails);
            $exam_id = $request->exam_id;
            $class_id = $getStudentDetails->class_id;
            $section_id = $getStudentDetails->section_id;
            $session_id = $getStudentDetails->session_id;
            $semester_id = $getStudentDetails->semester_id;
            // dd($session_id);
            $details['exam'] = $con->table('subject_assigns as sa')
                ->select(
                    'sbj.name as subject_name',
                    'eh.hall_no',
                    'cl.name as class_name',
                    'sec.name as section_name',
                    'ex.name as exam_name',
                    'ep.paper_name as paper_name',
                    'ep.id as paper_id',
                    'sa.class_id as class_id',
                    'sa.section_id as section_id',
                    'sa.subject_id as subject_id',
                    'ttex.exam_id',
                    'ttex.semester_id',
                    'ttex.session_id',
                    'ttex.paper_id as timetable_paper_id',
                    'ttex.time_start',
                    'ttex.time_end',
                    'ttex.exam_date',
                    'ttex.hall_id',
                    'ttex.distributor_type',
                    'ttex.distributor',
                    'ttex.distributor_id',
                    'ttex.id'
                )
                ->join('subjects as sbj', 'sa.subject_id', '=', 'sbj.id')
                ->join('classes as cl', 'sa.class_id', '=', 'cl.id')
                ->join('sections as sec', 'sa.section_id', '=', 'sec.id')
                ->join('exam_papers as ep', function ($join) {
                    $join->on('sa.class_id', '=', 'ep.class_id')
                        ->on('sa.subject_id', '=', 'ep.subject_id');
                })
                ->where([
                    ['sa.class_id', $class_id],
                    ['sa.section_id', $section_id],
                    ['sa.type', '=', '0'],
                    ['sbj.exam_exclude', '=', '0']
                ])
                ->leftJoin('timetable_exam as ttex', function ($join) use ($exam_id, $semester_id, $session_id) {
                    $join->on('sa.class_id', '=', 'ttex.class_id')
                        ->on('sa.section_id', '=', 'ttex.section_id')
                        ->on('sa.subject_id', '=', 'ttex.subject_id')
                        ->on('ttex.semester_id', '=', DB::raw("'$semester_id'"))
                        ->on('ttex.session_id', '=', DB::raw("'$session_id'"))
                        ->on('ttex.paper_id', '=', 'ep.id')
                        ->where('ttex.exam_id', $exam_id);
                })
                ->leftJoin('exam as ex', 'ttex.exam_id', '=', 'ex.id')
                ->leftJoin('exam_hall as eh', 'ttex.hall_id', '=', 'eh.id')
                ->orderBy('sbj.id', 'asc')
                ->orderBy('ttex.exam_date', 'desc')
                ->orderBy('sbj.name', 'asc')
                ->get();
            $exam_name = $con->table('exam')->where('id', $exam_id)->first();
            $details['details']['exam_name'] = $exam_name->name;
            return $this->successResponse($details, 'Exam Timetable record fetch successfully');
        }
    }
    // by class get subjects
    public function getSubjectByClass(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'class_id' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            $class_id = $request->class_id;
            $teacher_id = $request->teacher_id;
            $success = $createConnection->table('subject_assigns as sa')
                ->select(
                    'sb.id as subject_id',
                    'sb.name as subject_name'
                )
                ->join('subjects as sb', 'sa.subject_id', '=', 'sb.id')
                ->where('sa.type', '=', '0')
                ->where('sa.teacher_id', '!=', '0')
                ->when($class_id != "All", function ($q)  use ($class_id) {
                    $q->where('sa.class_id', $class_id);
                })
                ->when($teacher_id, function ($q)  use ($teacher_id) {
                    $q->where('sa.teacher_id', $teacher_id);
                })
                ->groupBy('sa.subject_id')
                ->get();
            return $this->successResponse($success, 'subjects record fetch successfully');
        }
    }
    public function examByClassSubject(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
            'today' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data       
            $today = date('Y-m-d', strtotime($request->today));
            $class_id = $request->class_id;
            // dd($today);
            $getExamsName = $Connection->table('timetable_exam as texm')
                ->select(
                    'texm.exam_id as id',
                    'ex.name as name',
                    'texm.exam_date'
                )
                ->leftJoin('exam as ex', 'texm.exam_id', '=', 'ex.id')
                ->where('texm.exam_date', '<', $today)
                ->when($class_id != "All", function ($q)  use ($class_id) {
                    $q->where('texm.class_id', $class_id);
                })
                ->where('texm.subject_id', '=', $request->subject_id)
                ->groupBy('texm.exam_id')
                ->get();
            return $this->successResponse($getExamsName, 'Exams  list of Name record fetch successfully');
        }
    }

    // by class single
    public function totgradeCalcuByClass(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
            'exam_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data             
            $allbysubject = array();
            // get subject total weightage
            $getExamMarks = $Connection->table('exam_papers as expp')
                ->select(
                    DB::raw('SUM(expp.subject_weightage) as total_subject_weightage'),
                    'expp.grade_category'
                )
                ->where([
                    ['expp.class_id', '=', $request->class_id],
                    ['expp.subject_id', '=', $request->subject_id]
                ])
                ->get();
            // dd($getExamMarks);
            $total_subject_weightage = isset($getExamMarks[0]->total_subject_weightage) ? (int)$getExamMarks[0]->total_subject_weightage : 0;
            $grade_category = isset($getExamMarks[0]->grade_category) ? $getExamMarks[0]->grade_category : 0;
            // dd($total_subject_weightage);
            $total_sujects_teacher = $Connection->table('subject_assigns as sa')
                ->select(
                    'sa.class_id',
                    'sa.section_id',
                    'sbj.id as subject_id',
                    'sbj.name as subject_name',
                    'sf.id as staff_id',
                    DB::raw('CONCAT(sf.first_name, " ", sf.last_name) as teacher_name'),
                )
                ->join('staffs as sf', 'sa.teacher_id', '=', 'sf.id')
                ->join('subjects as sbj', 'sa.subject_id', '=', 'sbj.id')
                ->where([
                    ['sa.class_id', $request->class_id],
                    ['sa.subject_id', $request->subject_id],
                    ['sa.type', '=', '0'],
                    ['sbj.exam_exclude', '=', '0']
                ])
                ->get();
            // get all grade details header
            $allGradeDetails = $Connection->table('grade_marks')
                ->select('grade')
                ->where([
                    ['grade_category', '=', $grade_category]
                ])
                ->get();
            //array_push($teachers_list, $getteachername)

            // dd($total_sujects_teacher);
            if (!empty($total_sujects_teacher)) {
                foreach ($total_sujects_teacher as $key => $val) {
                    $newobject = new \stdClass();
                    $section_id = $val->section_id;
                    $subject_id = $val->subject_id;
                    $staff_id = $val->staff_id;
                    $subject_name = $val->subject_name;
                    $teacher_name = $val->teacher_name;

                    $newobject->teacher_name = $teacher_name;
                    $newobject->subject_name = $subject_name;
                    // class name and section name by total students
                    $getstudentcount = $Connection->table('enrolls as en')
                        ->select(
                            'cl.name',
                            'en.semester_id',
                            'en.session_id',
                            'sc.name as section_name',
                            DB::raw('COUNT(en.student_id) as "totalStudentCount"')
                        )
                        ->join('classes as cl', 'en.class_id', '=', 'cl.id')
                        ->join('sections as sc', 'en.section_id', '=', 'sc.id')
                        ->where('class_id', '=', $request->class_id)
                        ->where('section_id', '=', $section_id)
                        ->get();
                    $semester_id = isset($getstudentcount[0]->semester_id) ? $getstudentcount[0]->semester_id : 0;
                    $session_id = isset($getstudentcount[0]->session_id) ? $getstudentcount[0]->session_id : 0;
                    $totalNoOfStudents = isset($getstudentcount[0]->totalStudentCount) ? $getstudentcount[0]->totalStudentCount : 0;
                    $newobject->totalstudentcount = $totalNoOfStudents;
                    $newobject->name = $getstudentcount[0]->name;
                    $newobject->section_name = $getstudentcount[0]->section_name;

                    $getStudMarks = $Connection->table('student_marks as sm')
                        ->select(
                            // DB::raw("group_concat(sm.status) as absent_absent"),
                            DB::raw("group_concat(sm.status) as absent_absent"),
                            DB::raw("group_concat(sm.pass_fail) as pass_fail"),
                            DB::raw("group_concat(sm.score) as score"),
                            'expp.subject_weightage',
                            // 'sm.exam_id',
                            // 'te.exam_date',
                            'sb.name as subject_name',
                            // DB::raw('SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) AS absent'),
                            // DB::raw('SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) AS present'),
                            // DB::raw('SUM(CASE WHEN pass_fail = "Pass" THEN 1 ELSE 0 END) AS pass'),
                            // DB::raw('SUM(CASE WHEN pass_fail = "Fail" THEN 1 ELSE 0 END) AS fail'),
                            'sm.paper_id',
                            'sm.grade_category',
                            // DB::raw('round(AVG(sm.score), 2) as average'
                            DB::raw("group_concat(expp.subject_weightage) as subject_weightage")
                        )
                        ->join('subjects as sb', 'sm.subject_id', '=', 'sb.id')
                        ->join('timetable_exam as te', function ($join) {
                            $join->on('te.class_id', '=', 'sm.class_id')
                                ->on('te.section_id', '=', 'sm.section_id')
                                ->on('te.subject_id', '=', 'sm.subject_id')
                                ->on('te.semester_id', '=', 'sm.semester_id')
                                ->on('te.session_id', '=', 'sm.session_id')
                                ->on('te.paper_id', '=', 'sm.paper_id');
                        })
                        ->join('exam_papers as expp', 'sm.paper_id', '=', 'expp.id')
                        ->where([
                            ['sm.class_id', '=', $request->class_id],
                            ['sm.section_id', '=', $section_id],
                            ['sm.subject_id', '=', $request->subject_id],
                            ['sm.exam_id', '=', $request->exam_id],
                            ['sm.semester_id', '=', "2"],
                            // ['sm.semester_id', '=', $request->semester_id],
                            // ['sm.status', '=', 'present'],
                            ['sm.session_id', '=', $session_id]
                        ])
                        ->groupBy('sm.paper_id')
                        ->get();

                    $noOfPresentAbsent = $Connection->table('student_marks as sm')
                        ->select(
                            // DB::raw("group_concat(sm.status) as absent_absent"),
                            // DB::raw("group_concat(sm.pass_fail) as pass_fail"),
                            // 'sb.name as subject_name',
                            DB::raw('SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) AS absent'),
                            DB::raw('SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) AS present'),
                            DB::raw('SUM(CASE WHEN pass_fail = "Pass" THEN 1 ELSE 0 END) AS pass'),
                            DB::raw('SUM(CASE WHEN pass_fail = "Fail" THEN 1 ELSE 0 END) AS fail'),
                            DB::raw('SUM(CASE WHEN pass_fail = "Absent" THEN 1 ELSE 0 END) AS exam_absent'),

                        )
                        ->join('subjects as sb', 'sm.subject_id', '=', 'sb.id')
                        ->join('timetable_exam as te', function ($join) {
                            $join->on('te.class_id', '=', 'sm.class_id')
                                ->on('te.section_id', '=', 'sm.section_id')
                                ->on('te.subject_id', '=', 'sm.subject_id')
                                ->on('te.semester_id', '=', 'sm.semester_id')
                                ->on('te.session_id', '=', 'sm.session_id')
                                ->on('te.paper_id', '=', 'sm.paper_id');
                        })
                        ->join('exam_papers as expp', 'sm.paper_id', '=', 'expp.id')
                        ->where([
                            ['sm.class_id', '=', $request->class_id],
                            ['sm.section_id', '=', $section_id],
                            ['sm.subject_id', '=', $request->subject_id],
                            ['sm.exam_id', '=', $request->exam_id],
                            ['sm.semester_id', '=', "2"],
                            ['sm.session_id', '=', $session_id]
                        ])
                        // ->groupBy('sm.paper_id')
                        ->groupBy('sm.subject_id')
                        ->groupBy('sm.student_id')
                        ->get();
                    // get present absent count
                    $presentCnt = 0;
                    $absentCnt = 0;
                    $passCnt = 0;
                    $failCnt = 0;
                    if (!empty($noOfPresentAbsent)) {
                        foreach ($noOfPresentAbsent as $key => $preab) {
                            $present = (int) $preab->present;
                            $absent = (int) $preab->absent;
                            $pass = (int) $preab->pass;
                            $fail = (int) $preab->fail;
                            $fail = (int) $preab->fail;
                            $exam_absent = (int) $preab->exam_absent;

                            // count present and absent students
                            if ($present != 0 && $absent == 0) {
                                $presentCnt++;
                            } else if ($present == 0 && $absent != 0) {
                                $absentCnt++;
                            } else if ($present == 0 && $absent == 0) {
                                $absentCnt;
                            } else if ($present != 0 && $absent != 0) {
                                $absentCnt++;
                            } else {
                                $presentCnt;
                                $absentCnt;
                            }
                            // count pass and fail students
                            if ($pass != 0 && $fail == 0 && $exam_absent == 0) {
                                $passCnt++;
                            } else if ($pass == 0 && $fail != 0 && $exam_absent == 0) {
                                $failCnt++;
                            } else if ($pass == 0 && $fail == 0 && $exam_absent != 0) {
                                $failCnt++;
                            } else if ($pass != 0 && $fail != 0 && $exam_absent == 0) {
                                $failCnt++;
                            } else if ($pass != 0 && $fail != 0 && $exam_absent != 0) {
                                $failCnt++;
                            } else if ($pass == 0 && $fail != 0 && $exam_absent != 0) {
                                $failCnt++;
                            } else if ($pass != 0 && $fail == 0 && $exam_absent != 0) {
                                $failCnt++;
                            } else {
                                $passCnt;
                                $failCnt;
                            }
                        }
                    }
                    // echo $presentCnt;
                    // echo "-----";
                    // echo $absentCnt;
                    // echo "-----";
                    // echo $passCnt;
                    // echo "-----";
                    // echo $failCnt;

                    // dd($noOfPresentAbsent);
                    $total_marks = [];
                    // dd($getStudMarks);
                    // here you get calculation based on student marks and subject weightage
                    if (!empty($getStudMarks)) {
                        foreach ($getStudMarks as $key => $value) {
                            $object = new \stdClass();
                            $total_sub_weightage = explode(',', $value->subject_weightage);
                            $total_score = explode(',', $value->score);
                            $marks = [];
                            // foreach for total no of students
                            for ($i = 0; $i < $totalNoOfStudents; $i++) {
                                $sub_weightage = isset($total_sub_weightage[$i]) ? (int) $total_sub_weightage[$i] : 0;
                                $score = isset($total_sub_weightage[$i]) ? (int) $total_score[$i] : 0;

                                $weightage = ($sub_weightage / $total_subject_weightage);
                                // dd($weightage);
                                $marks[$i] = ($weightage * $score);
                            }
                            // echo "<pre>";
                            // print_r($marks);
                            // print_r($marks);
                            $object->marks = $marks;
                            $object->paper_id = $value->paper_id;
                            $object->grade_category = $value->grade_category;
                            array_push($total_marks, $object);
                        }
                        // echo "<pre>";
                        // print_r($marks);
                        // exit;
                    }
                    // here calculated values to sum by index
                    $sumArray = array();
                    if (!empty($total_marks)) {
                        foreach ($total_marks as $row) {
                            foreach ($row->marks as $index => $value) {
                                $sumArray[$index] = (isset($sumArray[$index]) ? $sumArray[$index] + $value : $value);
                            }
                        }
                    }

                    $gradeDetails = [];
                    $geadeDetailsPush = [];
                    $passDetailsPush = [];
                    if (!empty($sumArray)) {
                        foreach ($sumArray as $rows) {
                            $mark = (int) $rows;
                            $grade = $Connection->table('grade_marks')
                                ->select('grade', 'status')
                                ->where([
                                    ['min_mark', '<=', $mark],
                                    ['max_mark', '>=', $mark],
                                    ['grade_category', '=', $grade_category]
                                ])
                                ->first();
                            array_push($gradeDetails, $grade);
                        }
                        // here get grade count details
                        $gradecnt = array_count_values(array_column($gradeDetails, 'grade'));
                        $passcnt = array_count_values(array_column($gradeDetails, 'status'));
                        array_push($geadeDetailsPush, $gradecnt);
                        array_push($passDetailsPush, $passcnt);
                    } else {
                        $gradecnt = new \stdClass();
                        $passcnt = new \stdClass();
                    }
                    $pass_percentage = ($passCnt / $totalNoOfStudents) * 100;
                    $newobject->pass_percentage = number_format($pass_percentage, 2);
                    $fail_percentage = ($failCnt / $totalNoOfStudents) * 100;
                    $newobject->fail_percentage = number_format($fail_percentage, 2);
                    // get count details
                    $newobject->present_count = $presentCnt;
                    $newobject->absent_count = $absentCnt;
                    $newobject->pass_count = $passCnt;
                    $newobject->fail_count = $failCnt;
                    $newobject->gradecnt = $gradecnt;
                    $newobject->passcnt = $passcnt;
                    array_push($allbysubject, $newobject);
                }
            }
            $data = [
                'headers' => $allGradeDetails,
                'allbysubject' => $allbysubject
            ];
            return $this->successResponse($data, 'byclass all Post record fetch successfully');
        }
    }
    // by class get subjects
    public function getClassBySection(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'class_id' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            $class_id = $request->class_id;
            $teacher_id = $request->teacher_id;
            $success = $createConnection->table('subject_assigns as sa')
                ->select(
                    'sc.id as section_id',
                    'sc.name as section_name'
                )
                ->join('sections as sc', 'sa.section_id', '=', 'sc.id')
                ->where('sa.type', '=', '0')
                ->where('sa.teacher_id', '!=', '0')
                ->when($class_id != "All", function ($q)  use ($class_id) {
                    $q->where('sa.class_id', $class_id);
                })
                ->when($teacher_id, function ($q)  use ($teacher_id) {
                    $q->where('sa.teacher_id', $teacher_id);
                })
                ->groupBy('sa.section_id')
                ->get();
            return $this->successResponse($success, 'sections record fetch successfully');
        }
    }
    public function examByClassSec(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'today' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data       
            $today = date('Y-m-d', strtotime($request->today));
            $class_id = $request->class_id;
            $section_id = $request->section_id;
            // dd($today);
            $getExamsName = $Connection->table('timetable_exam as texm')
                ->select(
                    'texm.exam_id as id',
                    'ex.name as name',
                    'texm.exam_date'
                )
                ->leftJoin('exam as ex', 'texm.exam_id', '=', 'ex.id')
                ->where('texm.exam_date', '<', $today)
                ->when($class_id != "All", function ($q)  use ($class_id) {
                    $q->where('texm.class_id', $class_id);
                })
                ->where('texm.section_id', '=', $section_id)
                ->groupBy('texm.exam_id')
                ->get();
            return $this->successResponse($getExamsName, 'Exams  list of Name record fetch successfully');
        }
    }
    // by subject  single 
    // public function totgradeCalcuBySubject(Request $request)
    // {
    //     $validator = \Validator::make($request->all(), [
    //         'branch_id' => 'required',
    //         'token' => 'required',
    //         'class_id' => 'required',
    //         'section_id' => 'required',
    //         'exam_id' => 'required'
    //     ]);

    //     if (!$validator->passes()) {
    //         return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
    //     } else {
    //         // create new connection
    //         $Connection = $this->createNewConnection($request->branch_id);
    //         // get data             

    //         $grade_list_master = array();
    //         $allbysubject = array();
    //         $total_classes_section = $Connection->table('section_allocations')
    //             ->select('class_id', 'section_id')
    //             ->get();
    //         $total_sujects_teacher = $Connection->table('subject_assigns')
    //             ->select(
    //                 'subjects.id as subject_id',
    //                 'subjects.name as subject_name',
    //                 'staffs.id as staff_id',
    //                 DB::raw('CONCAT(staffs.first_name, " ", staffs.last_name) as teacher_name')
    //             )
    //             ->leftJoin('staffs', 'subject_assigns.teacher_id', '=', 'staffs.id')
    //             ->leftJoin('subjects', 'subject_assigns.subject_id', '=', 'subjects.id')
    //             ->where('class_id', '=', $request->class_id)
    //             ->where('section_id', '=', $request->section_id)
    //             ->get();
    //         //array_push($teachers_list, $getteachername);

    //         // common grade list 
    //         $getmastergrade = $Connection->table('grade_marks')
    //             ->select(
    //                 'id',
    //                 'grade',
    //                 'grade_point'
    //             )
    //             ->get();
    //         $grade_count_list_master = count($getmastergrade);


    //         // dd($total_sujects_teacher);
    //         foreach ($total_sujects_teacher as $key => $val) {
    //             $object = new \stdClass();
    //             $subject_id = $val->subject_id;
    //             $staff_id = $val->staff_id;
    //             $subject_name = $val->subject_name;
    //             $teacher_name = $val->teacher_name;

    //             $object->teacher_name = $teacher_name;
    //             $object->subject_name = $subject_name;
    //             $object->grad_count_master = $grade_count_list_master;
    //             // class name and section name
    //             $getstudentcount = $Connection->table('enrolls')
    //                 ->select(
    //                     'classes.name',
    //                     'sections.name as section_name',
    //                     DB::raw('COUNT(student_id) as "totalStudentCount"')
    //                 )
    //                 ->leftJoin('classes', 'enrolls.class_id', '=', 'classes.id')
    //                 ->leftJoin('sections', 'enrolls.section_id', '=', 'sections.id')
    //                 ->where('class_id', '=', $request->class_id)
    //                 ->where('section_id', '=', $request->section_id)
    //                 ->get();
    //             $object->totalstudentcount = $getstudentcount;
    //             // subject division table check subject id is there 
    //             $subject_division_tbl = $Connection->table('student_subjectdivision')
    //                 ->select('subject_division', 'credit_point', 'semester_id')
    //                 ->where('class_id', '=', $request->class_id)
    //                 ->where('section_id', '=', $request->section_id)
    //                 ->where('subject_id', '=', $subject_id)
    //                 ->get();
    //             $subject_division_matched = count($subject_division_tbl);
    //             // Not matched subject division table go 2 if 
    //             if ($subject_division_matched == 0) {
    //                 $getexamattendance = $Connection->table('student_marks')
    //                     ->select(
    //                         DB::raw('SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) AS absent'),
    //                         DB::raw('SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) AS present'),
    //                         DB::raw('SUM(CASE WHEN pass_fail = "pass" THEN 1 ELSE 0 END) AS pass'),
    //                         DB::raw('SUM(CASE WHEN pass_fail = "fail" THEN 1 ELSE 0 END) AS fail')
    //                     )
    //                     ->where('class_id', '=', $request->class_id)
    //                     ->where('section_id', '=', $request->section_id)
    //                     ->where('exam_id', '=', $request->exam_id)
    //                     ->where('subject_id', '=', $subject_id)
    //                     ->get();
    //                 $object->attendance_list = $getexamattendance;

    //                 $count = count($getexamattendance);
    //                 $getgradecount = $Connection->table('student_marks')
    //                     ->select(
    //                         'grade as gname',
    //                         DB::raw('COUNT(*) as "gradecount"')
    //                     )
    //                     ->where('class_id', '=', $request->class_id)
    //                     ->where('section_id', '=', $request->section_id)
    //                     ->where('exam_id', '=', $request->exam_id)
    //                     ->where('subject_id', '=', $subject_id)
    //                     ->groupBy('grade')
    //                     ->get();
    //                 $object->grade_count_list = $getgradecount;

    //                 array_push($allbysubject, $object);
    //             } else if ($subject_division_matched > 0) {

    //                 $getexamattendance = $Connection->table('student_subjectdivision_inst')
    //                     ->select(
    //                         DB::raw('SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) AS absent'),
    //                         DB::raw('SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) AS present'),
    //                         DB::raw('SUM(CASE WHEN pass_fail = "pass" THEN 1 ELSE 0 END) AS pass'),
    //                         DB::raw('SUM(CASE WHEN pass_fail = "fail" THEN 1 ELSE 0 END) AS fail')
    //                     )
    //                     ->where('class_id', '=', $request->class_id)
    //                     ->where('section_id', '=', $request->section_id)
    //                     ->where('exam_id', '=', $request->exam_id)
    //                     ->where('subject_id', '=', $subject_id)
    //                     ->get();
    //                 $object->attendance_list = $getexamattendance;

    //                 $count = count($getexamattendance);
    //                 $getgradecount = $Connection->table('student_subjectdivision_inst')
    //                     ->select(
    //                         'grade as gname',
    //                         DB::raw('COUNT(*) as "gradecount"')
    //                     )
    //                     ->where('class_id', '=', $request->class_id)
    //                     ->where('section_id', '=', $request->section_id)
    //                     ->where('exam_id', '=', $request->exam_id)
    //                     ->where('subject_id', '=', $subject_id)
    //                     ->groupBy('grade')
    //                     ->get();
    //                 $object->grade_count_list = $getgradecount;
    //                 array_push($allbysubject, $object);
    //             }
    //         }

    //         return $this->successResponse($allbysubject, 'bysubject all Post record fetch successfully');
    //     }
    // }
    // by subject  single 
    public function totgradeCalcuBySubject(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'exam_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data             

            $grade_list_master = array();
            $newobject = new \stdClass();
            $section_id = $request->section_id;
            $class_id = $request->class_id;
            // get grade category
            $getGradeCategory = $Connection->table('exam_papers as expp')
                ->select(
                    'expp.grade_category'
                )
                ->where([
                    ['expp.class_id', '=', $request->class_id]
                ])
                ->groupBy('expp.grade_category')
                ->get();
            $grade_category = isset($getGradeCategory[0]->grade_category) ? $getGradeCategory[0]->grade_category : 0;
            // get all grade details header
            $allGradeDetails = $Connection->table('grade_marks')
                ->select('grade')
                ->where([
                    ['grade_category', '=', $grade_category]
                ])
                ->get();
            // get exam paper weightage with subject assign
            $getExamMarks = $Connection->table('exam_papers as expp')
                ->select(
                    DB::raw('SUM(expp.subject_weightage) as total_subject_weightage'),
                    'expp.grade_category',
                    'sa.class_id',
                    'sa.section_id',
                    'sbj.id as subject_id',
                    'sbj.name as subject_name',
                    'cl.name as class_name',
                    'sec.name as section_name',
                    'sa.teacher_id',
                    DB::raw("CONCAT(sf.first_name, ' ', sf.last_name) as staff_name")
                )
                ->join('subject_assigns as sa', function ($join) use ($section_id) {
                    $join->on('sa.class_id', '=', 'expp.class_id')
                        ->on('sa.subject_id', '=', 'expp.subject_id')
                        ->on('sa.section_id', '=', DB::raw("'$section_id'"));
                })
                ->join('subjects as sbj', 'expp.subject_id', '=', 'sbj.id')
                ->join('classes as cl', 'sa.class_id', '=', 'cl.id')
                ->join('sections as sec', 'sa.section_id', '=', 'sec.id')
                ->leftJoin('staffs as sf', 'sa.teacher_id', '=', 'sf.id')
                ->where([
                    ['expp.class_id', $request->class_id],
                    ['sa.section_id', $section_id],
                    ['sa.type', '=', '0'],
                    ['sbj.exam_exclude', '=', '0']
                ])
                ->groupBy('expp.subject_id')
                ->get();
            // dd($getExamMarks);
            if (!empty($getExamMarks)) {
                foreach ($getExamMarks as $marks) {

                    $total_subject_weightage = isset($marks->total_subject_weightage) ? (int)$marks->total_subject_weightage : 0;
                    // echo $class_id;
                    // echo $section_id;
                    // echo $subjectID;
                    // echo $total_subject_weightage;
                    $newobject = new \stdClass();
                    $subject_id = $marks->subject_id;
                    $class_name = $marks->class_name;
                    $section_name = $marks->section_name;
                    $subject_name = $marks->subject_name;
                    $teacher_name = $marks->staff_name;

                    $newobject->class_name = $class_name;
                    $newobject->section_name = $section_name;
                    $newobject->subject_name = $subject_name;
                    $newobject->teacher_name = $teacher_name;
                    // class name and section name by total students
                    $getstudentcount = $Connection->table('enrolls as en')
                        ->select(
                            'cl.name',
                            'en.semester_id',
                            'en.session_id',
                            'sc.name as section_name',
                            DB::raw('COUNT(en.student_id) as "totalStudentCount"')
                        )
                        ->join('classes as cl', 'en.class_id', '=', 'cl.id')
                        ->join('sections as sc', 'en.section_id', '=', 'sc.id')
                        ->where('class_id', '=', $class_id)
                        ->where('section_id', '=', $section_id)
                        ->get();
                    // dd($getstudentcount);
                    $semester_id = isset($getstudentcount[0]->semester_id) ? $getstudentcount[0]->semester_id : 0;
                    $session_id = isset($getstudentcount[0]->session_id) ? $getstudentcount[0]->session_id : 0;
                    $totalNoOfStudents = isset($getstudentcount[0]->totalStudentCount) ? $getstudentcount[0]->totalStudentCount : 0;

                    $newobject->totalstudentcount = $totalNoOfStudents;

                    $getStudMarks = $Connection->table('student_marks as sm')
                        ->select(
                            // DB::raw("group_concat(sm.status) as absent_absent"),
                            DB::raw("group_concat(sm.status) as absent_absent"),
                            DB::raw("group_concat(sm.pass_fail) as pass_fail"),
                            DB::raw("group_concat(sm.score) as score"),
                            'expp.subject_weightage',
                            // 'sm.exam_id',
                            // 'te.exam_date',
                            'sb.name as subject_name',
                            // DB::raw('SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) AS absent'),
                            // DB::raw('SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) AS present'),
                            // DB::raw('SUM(CASE WHEN pass_fail = "Pass" THEN 1 ELSE 0 END) AS pass'),
                            // DB::raw('SUM(CASE WHEN pass_fail = "Fail" THEN 1 ELSE 0 END) AS fail'),
                            'sm.paper_id',
                            'sm.grade_category',
                            // DB::raw('round(AVG(sm.score), 2) as average'
                            DB::raw("group_concat(expp.subject_weightage) as subject_weightage")
                        )
                        ->join('subjects as sb', 'sm.subject_id', '=', 'sb.id')
                        ->join('timetable_exam as te', function ($join) {
                            $join->on('te.class_id', '=', 'sm.class_id')
                                ->on('te.section_id', '=', 'sm.section_id')
                                ->on('te.subject_id', '=', 'sm.subject_id')
                                ->on('te.semester_id', '=', 'sm.semester_id')
                                ->on('te.session_id', '=', 'sm.session_id')
                                ->on('te.paper_id', '=', 'sm.paper_id');
                        })
                        ->join('exam_papers as expp', 'sm.paper_id', '=', 'expp.id')
                        ->where([
                            ['sm.class_id', '=', $class_id],
                            ['sm.section_id', '=', $section_id],
                            ['sm.subject_id', '=', $subject_id],
                            ['sm.exam_id', '=', $request->exam_id],
                            ['sm.semester_id', '=', "2"],
                            // ['sm.semester_id', '=', $request->semester_id],
                            // ['sm.status', '=', 'present'],
                            ['sm.session_id', '=', $session_id]
                        ])
                        ->groupBy('sm.paper_id')
                        ->get();
                    // dd($getStudMarks);
                    $noOfPresentAbsent = $Connection->table('student_marks as sm')
                        ->select(
                            // DB::raw("group_concat(sm.status) as absent_absent"),
                            // DB::raw("group_concat(sm.pass_fail) as pass_fail"),
                            // 'sb.name as subject_name',
                            DB::raw('SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) AS absent'),
                            DB::raw('SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) AS present'),
                            DB::raw('SUM(CASE WHEN pass_fail = "Pass" THEN 1 ELSE 0 END) AS pass'),
                            DB::raw('SUM(CASE WHEN pass_fail = "Fail" THEN 1 ELSE 0 END) AS fail'),
                            DB::raw('SUM(CASE WHEN pass_fail = "Absent" THEN 1 ELSE 0 END) AS exam_absent'),

                        )
                        ->join('subjects as sb', 'sm.subject_id', '=', 'sb.id')
                        ->join('timetable_exam as te', function ($join) {
                            $join->on('te.class_id', '=', 'sm.class_id')
                                ->on('te.section_id', '=', 'sm.section_id')
                                ->on('te.subject_id', '=', 'sm.subject_id')
                                ->on('te.semester_id', '=', 'sm.semester_id')
                                ->on('te.session_id', '=', 'sm.session_id')
                                ->on('te.paper_id', '=', 'sm.paper_id');
                        })
                        ->join('exam_papers as expp', 'sm.paper_id', '=', 'expp.id')
                        ->where([
                            ['sm.class_id', '=', $class_id],
                            ['sm.section_id', '=', $section_id],
                            ['sm.subject_id', '=', $subject_id],
                            ['sm.exam_id', '=', $request->exam_id],
                            ['sm.semester_id', '=', "2"],
                            ['sm.session_id', '=', $session_id]
                        ])
                        // ->groupBy('sm.paper_id')
                        ->groupBy('sm.subject_id')
                        ->groupBy('sm.student_id')
                        ->get();
                    // dd($noOfPresentAbsent);
                    // get present absent count
                    $presentCnt = 0;
                    $absentCnt = 0;
                    $passCnt = 0;
                    $failCnt = 0;
                    if (!empty($noOfPresentAbsent)) {
                        foreach ($noOfPresentAbsent as $key => $preab) {
                            $present = (int) $preab->present;
                            $absent = (int) $preab->absent;
                            $pass = (int) $preab->pass;
                            $fail = (int) $preab->fail;
                            $fail = (int) $preab->fail;
                            $exam_absent = (int) $preab->exam_absent;

                            // count present and absent students
                            if ($present != 0 && $absent == 0) {
                                $presentCnt++;
                            } else if ($present == 0 && $absent != 0) {
                                $absentCnt++;
                            } else if ($present == 0 && $absent == 0) {
                                $absentCnt;
                            } else if ($present != 0 && $absent != 0) {
                                $absentCnt++;
                            } else {
                                $presentCnt;
                                $absentCnt;
                            }
                            // count pass and fail students
                            if ($pass != 0 && $fail == 0 && $exam_absent == 0) {
                                $passCnt++;
                            } else if ($pass == 0 && $fail != 0 && $exam_absent == 0) {
                                $failCnt++;
                            } else if ($pass == 0 && $fail == 0 && $exam_absent != 0) {
                                $failCnt++;
                            } else if ($pass != 0 && $fail != 0 && $exam_absent == 0) {
                                $failCnt++;
                            } else if ($pass != 0 && $fail != 0 && $exam_absent != 0) {
                                $failCnt++;
                            } else if ($pass == 0 && $fail != 0 && $exam_absent != 0) {
                                $failCnt++;
                            } else if ($pass != 0 && $fail == 0 && $exam_absent != 0) {
                                $failCnt++;
                            } else {
                                $passCnt;
                                $failCnt;
                            }
                        }
                    }
                    // echo $presentCnt;
                    // echo "-----";
                    // echo $absentCnt;
                    // echo "-----";
                    // echo $passCnt;
                    // echo "-----";
                    // echo $failCnt;

                    // dd($noOfPresentAbsent);
                    $total_marks = [];
                    // dd($getStudMarks);
                    // here you get calculation based on student marks and subject weightage
                    if (!empty($getStudMarks)) {
                        foreach ($getStudMarks as $key => $value) {
                            $object = new \stdClass();
                            $total_sub_weightage = explode(',', $value->subject_weightage);
                            $total_score = explode(',', $value->score);
                            $marks = [];
                            // foreach for total no of students
                            for ($i = 0; $i < $totalNoOfStudents; $i++) {
                                $sub_weightage = isset($total_sub_weightage[$i]) ? (int) $total_sub_weightage[$i] : 0;
                                $score = isset($total_sub_weightage[$i]) ? (int) $total_score[$i] : 0;

                                $weightage = ($sub_weightage / $total_subject_weightage);
                                // dd($weightage);
                                $marks[$i] = ($weightage * $score);
                            }
                            // echo "<pre>";
                            // print_r($marks);
                            // print_r($marks);
                            $object->marks = $marks;
                            $object->paper_id = $value->paper_id;
                            $object->grade_category = $value->grade_category;
                            array_push($total_marks, $object);
                        }
                        // echo "<pre>";
                        // print_r($marks);
                        // exit;
                    }
                    // dd($total_marks);
                    // here calculated values to sum by index
                    $sumArray = array();
                    if (!empty($total_marks)) {
                        foreach ($total_marks as $row) {
                            foreach ($row->marks as $index => $value) {
                                $sumArray[$index] = (isset($sumArray[$index]) ? $sumArray[$index] + $value : $value);
                            }
                        }
                    }

                    $gradeDetails = [];
                    $geadeDetailsPush = [];
                    $passDetailsPush = [];
                    if (!empty($sumArray)) {
                        foreach ($sumArray as $rows) {
                            $mark = (int) $rows;
                            $grade = $Connection->table('grade_marks')
                                ->select('grade', 'status')
                                ->where([
                                    ['min_mark', '<=', $mark],
                                    ['max_mark', '>=', $mark],
                                    ['grade_category', '=', $grade_category]
                                ])
                                ->first();
                            array_push($gradeDetails, $grade);
                        }
                        // here get grade count details
                        $gradecnt = array_count_values(array_column($gradeDetails, 'grade'));
                        $passcnt = array_count_values(array_column($gradeDetails, 'status'));
                        array_push($geadeDetailsPush, $gradecnt);
                        array_push($passDetailsPush, $passcnt);
                    } else {
                        $gradecnt = new \stdClass();
                        $passcnt = new \stdClass();
                    }
                    // dd($passcnt);
                    $pass_percentage = ($passCnt / $totalNoOfStudents) * 100;
                    $newobject->pass_percentage = number_format($pass_percentage, 2);
                    $fail_percentage = ($failCnt / $totalNoOfStudents) * 100;
                    $newobject->fail_percentage = number_format($fail_percentage, 2);
                    // get count details
                    $newobject->present_count = $presentCnt;
                    $newobject->absent_count = $absentCnt;
                    $newobject->pass_count = $passCnt;
                    $newobject->fail_count = $failCnt;
                    $newobject->gradecnt = $gradecnt;
                    $newobject->passcnt = $passcnt;
                    array_push($grade_list_master, $newobject);
                }
            }
            $data = [
                'headers' => $allGradeDetails,
                'grade_list_master' => $grade_list_master
            ];
            return $this->successResponse($data, 'bysubject all Post record fetch successfully');
        }
    }
}
