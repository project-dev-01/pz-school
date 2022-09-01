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
                            if($importData[5] == "" || trim($importData[5]) == "Rehat"){
                                $break = 1;
                            }else{
                                $subject_id =  $importData[5];
                            }
                        }
                        $time_start = date("H:i:s", strtotime($importData[7]));
                        $time_end = date("H:i:s", strtotime($importData[8]));
                        
                        $data = [
                            'class_id' => $class_id,
                            'section_id' => $section_id,
                            'break' => $break,
                            'break_type' => "Break",
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
}
