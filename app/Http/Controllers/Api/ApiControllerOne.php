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
// notifications
use App\Notifications\ReliefAssignment;
use Illuminate\Support\Facades\Notification;

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
                    fclose($file);
                    // Insert to MySQL database
                    foreach ($importData_arr as $importData) {
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
    // import Csv add exam schedule
    public function addExamTimetable(Request $request)
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
                    // Insert to MySQL database
                    foreach ($importData_arr as $importData) {
                        // get internal staff name
                        $distributor = (isset($importData[12]) ? $importData[12] : null);
                        if (isset($importData[12])) {
                            if ($importData[11] == "1") {
                                $data = $Connection->table('staffs as s')->select(
                                    's.id',
                                    DB::raw('CONCAT(s.first_name, " ", s.last_name) as name')
                                )
                                    ->where('id', $importData[12])
                                    ->first();
                                $distributor = isset($data->name) ? $data->name : '';
                            }
                        }
                        $exam_date = date("Y-m-d", strtotime($importData[7]));
                        $time_start = date("H:i:s", strtotime($importData[8]));
                        $time_end = date("H:i:s", strtotime($importData[9]));
                        $data = [
                            'exam_id' => $importData[2],
                            'class_id' => $importData[0],
                            'section_id' => $importData[1],
                            'semester_id' => '2',
                            'session_id' => '1',
                            'subject_id' => $importData[3],
                            'paper_id' => $importData[4],
                            'time_start' => $time_start,
                            'time_end' => $time_end,
                            'hall_id' => $importData[10],
                            "distributor_type" => $importData[11],
                            "distributor" => $distributor,
                            "distributor_id" => $importData[12],
                            'exam_date' => $exam_date,
                            'created_at' => date("Y-m-d H:i:s")
                        ];
                        $Connection->table('timetable_exam')->insert($data);
                    }
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
                    'en.session_id',
                    'en.academic_session_id'
                )
                ->where([
                    ['en.student_id', '=', $request->student_id],
                    ['en.active_status', '=', '0']
                ])
                ->first();
            // return $getStudentDetails;
            // dd($getStudentDetails);
            $details = $con->table('timetable_exam')->select('exam.name', 'timetable_exam.exam_id')
                ->leftJoin('exam', 'timetable_exam.exam_id', '=', 'exam.id')
                ->where([
                    ['class_id', $getStudentDetails->class_id],
                    ['section_id', $getStudentDetails->section_id],
                    ['semester_id', $getStudentDetails->semester_id],
                    ['session_id', $getStudentDetails->session_id],
                    ['timetable_exam.academic_session_id', $getStudentDetails->academic_session_id]
                ])
                // ->groupBy('timetable_exam.exam_id')
                // ->orderBy('timetable_exam.exam_date', 'desc')
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
                    'en.session_id',
                    'en.academic_session_id'
                )
                ->where([
                    ['en.student_id', '=', $request->student_id],
                    ['en.active_status', '=', '0']
                ])
                ->first();
            // dd($getStudentDetails);
            $exam_id = $request->exam_id;
            $class_id = $getStudentDetails->class_id;
            $section_id = $getStudentDetails->section_id;
            $session_id = $getStudentDetails->session_id;
            $semester_id = $getStudentDetails->semester_id;
            $academic_session_id = $getStudentDetails->academic_session_id;
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
                ->leftJoin('timetable_exam as ttex', function ($join) use ($exam_id, $semester_id, $session_id, $academic_session_id) {
                    $join->on('sa.class_id', '=', 'ttex.class_id')
                        ->on('sa.section_id', '=', 'ttex.section_id')
                        ->on('sa.subject_id', '=', 'ttex.subject_id')
                        ->on('ttex.semester_id', '=', DB::raw("'$semester_id'"))
                        ->on('ttex.session_id', '=', DB::raw("'$session_id'"))
                        ->on('ttex.academic_session_id', '=', DB::raw("'$academic_session_id'"))
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
            'academic_session_id' => 'required',
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
                ->where('sb.exam_exclude', '=', '0')
                ->where('sa.academic_session_id', '=', $request->academic_session_id)
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
            'academic_session_id' => 'required',
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
            $getExamsName = $Connection->table('timetable_exam as texm')
                ->select(
                    'texm.exam_id as id',
                    'ex.name as name',
                    'texm.exam_date'
                )
                ->leftJoin('exam as ex', 'texm.exam_id', '=', 'ex.id')
                ->where('texm.exam_date', '<', $today)
                ->where('texm.academic_session_id', '=', $request->academic_session_id)
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
            'academic_year' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
            'exam_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $allbysubject = array();
            $academic_session_id = $request->academic_year;
            $semester_id = isset($request->semester_id) ? $request->semester_id : 0;
            $session_id = isset($request->session_id) ? $request->session_id : 0;
            // get subject total weightage
            $getExamMarks = $Connection->table('exam_papers as expp')
                ->select(
                    DB::raw('SUM(expp.subject_weightage) as total_subject_weightage'),
                    'expp.grade_category'
                )
                ->where([
                    ['expp.class_id', '=', $request->class_id],
                    ['expp.subject_id', '=', $request->subject_id],
                    ['expp.academic_session_id', '=', $academic_session_id]
                ])
                ->get();
            $total_subject_weightage = isset($getExamMarks[0]->total_subject_weightage) ? (int)$getExamMarks[0]->total_subject_weightage : 0;
            $grade_category = isset($getExamMarks[0]->grade_category) ? $getExamMarks[0]->grade_category : 0;
            //here get total sections
            $getTotalSections = $Connection->table('subject_assigns as sa')
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
                    ['sa.academic_session_id', '=', $academic_session_id],
                    ['sa.type', '=', '0'],
                    ['sbj.exam_exclude', '=', '0']
                ])
                ->get();
            // print_r($getTotalSections);

            // get all grade details header
            $allGradeDetails = $Connection->table('grade_marks')
                ->select('grade')
                ->where([
                    ['grade_category', '=', $grade_category]
                ])
                ->get();

            if (!empty($getTotalSections)) {
                foreach ($getTotalSections as $key => $val) {
                    $newobject = new \stdClass();
                    $section_id = $val->section_id;
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
                        ->where([
                            ['en.class_id', $request->class_id],
                            ['en.section_id', $section_id],
                            ['en.academic_session_id', '=', $academic_session_id],
                            ['en.semester_id', '=', $semester_id],
                            ['en.session_id', '=', $session_id]
                        ])
                        ->get();
                    // dd($getstudentcount);
                    $semester_id = isset($getstudentcount[0]->semester_id) ? $getstudentcount[0]->semester_id : 0;
                    $session_id = isset($getstudentcount[0]->session_id) ? $getstudentcount[0]->session_id : 0;
                    $totalNoOfStudents = isset($getstudentcount[0]->totalStudentCount) ? $getstudentcount[0]->totalStudentCount : 0;
                    $newobject->totalstudentcount = $totalNoOfStudents;
                    $newobject->name = $getstudentcount[0]->name;
                    $newobject->section_name = $getstudentcount[0]->section_name;

                    $getStudMarks = $Connection->table('student_marks as sm')
                        ->select(
                            DB::raw("group_concat(sm.score ORDER BY sm.student_id ASC) as score"),
                            DB::raw("group_concat(sm.student_id ORDER BY sm.student_id ASC) as student_ids"),
                            'sb.name as subject_name',
                            'sm.paper_id',
                            'sm.grade_category',
                            DB::raw("group_concat(expp.subject_weightage ORDER BY sm.student_id ASC) as subject_weightage")
                        )
                        ->join('subjects as sb', 'sm.subject_id', '=', 'sb.id')
                        ->join('timetable_exam as te', function ($join) {
                            $join->on('te.class_id', '=', 'sm.class_id')
                                ->on('te.section_id', '=', 'sm.section_id')
                                ->on('te.subject_id', '=', 'sm.subject_id')
                                ->on('te.semester_id', '=', 'sm.semester_id')
                                ->on('te.session_id', '=', 'sm.session_id')
                                ->on('te.paper_id', '=', 'sm.paper_id')
                                ->on('te.academic_session_id', '=', 'sm.academic_session_id');
                        })
                        ->join('exam_papers as expp', 'sm.paper_id', '=', 'expp.id')
                        ->where([
                            ['sm.class_id', '=', $request->class_id],
                            ['sm.section_id', '=', $section_id],
                            ['sm.subject_id', '=', $request->subject_id],
                            ['sm.exam_id', '=', $request->exam_id],
                            ['sm.semester_id', '=', $semester_id],
                            ['sm.session_id', '=', $session_id],
                            ['sm.academic_session_id', '=', $academic_session_id]
                        ])
                        ->groupBy('sm.paper_id')
                        ->get();
                    // dd($request->academic_session_id);
                    // here we get present absent pass fail count
                    $noOfPresentAbsent = $Connection->table('student_marks as sm')
                        ->select(
                            DB::raw('SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) AS absent'),
                            DB::raw('SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) AS present'),
                            DB::raw('SUM(CASE WHEN pass_fail = "Pass" THEN 1 ELSE 0 END) AS pass'),
                            DB::raw('SUM(CASE WHEN pass_fail = "Fail" THEN 1 ELSE 0 END) AS fail'),
                            DB::raw('SUM(CASE WHEN pass_fail = "Absent" THEN 1 ELSE 0 END) AS exam_absent')
                        )
                        ->join('subjects as sb', 'sm.subject_id', '=', 'sb.id')
                        ->join('timetable_exam as te', function ($join) {
                            $join->on('te.class_id', '=', 'sm.class_id')
                                ->on('te.section_id', '=', 'sm.section_id')
                                ->on('te.subject_id', '=', 'sm.subject_id')
                                ->on('te.semester_id', '=', 'sm.semester_id')
                                ->on('te.session_id', '=', 'sm.session_id')
                                ->on('te.paper_id', '=', 'sm.paper_id')
                                ->on('te.academic_session_id', '=', 'sm.academic_session_id');
                        })
                        ->join('exam_papers as expp', 'sm.paper_id', '=', 'expp.id')
                        ->where([
                            ['sm.class_id', '=', $request->class_id],
                            ['sm.section_id', '=', $section_id],
                            ['sm.subject_id', '=', $request->subject_id],
                            ['sm.exam_id', '=', $request->exam_id],
                            ['sm.semester_id', '=', $semester_id],
                            ['sm.session_id', '=', $session_id],
                            ['sm.academic_session_id', '=', $academic_session_id]
                        ])
                        ->groupBy('sm.subject_id')
                        ->groupBy('sm.student_id')
                        ->get();
                    // here we calculate present absent pass fail count
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
                    $total_marks = [];
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
                                $marks[$i] = ($weightage * $score);
                            }
                            $object->marks = $marks;
                            $object->paper_id = $value->paper_id;
                            $object->grade_category = $value->grade_category;
                            array_push($total_marks, $object);
                        }
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
                    } else {
                        $gradecnt = new \stdClass();
                        $passcnt = new \stdClass();
                    }
                    // dd($passCnt);
                    if ($totalNoOfStudents > 0) {
                        $pass_percentage = ($passCnt / $totalNoOfStudents) * 100;
                        $newobject->pass_percentage = number_format($pass_percentage, 2);
                        $fail_percentage = ($failCnt / $totalNoOfStudents) * 100;
                        $newobject->fail_percentage = number_format($fail_percentage, 2);
                    } else {
                        $newobject->pass_percentage = 0;
                        $newobject->fail_percentage = 0;
                    }

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
            'academic_session_id' => 'required',
            'today' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $today = date('Y-m-d', strtotime($request->today));
            $class_id = $request->class_id;
            $section_id = $request->section_id;
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
                ->where('texm.academic_session_id', '=', $request->academic_session_id)
                ->groupBy('texm.exam_id')
                ->get();
            return $this->successResponse($getExamsName, 'Exams  list of Name record fetch successfully');
        }
    }
    // by subject  single 
    public function totgradeCalcuBySubject(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'academic_year' => 'required',
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
            $academic_session_id = $request->academic_year;
            $sem_id = isset($request->semester_id) ? $request->semester_id : 0;
            $ses_id = isset($request->session_id) ? $request->session_id : 0;
            // get grade category
            $getGradeCategory = $Connection->table('exam_papers as expp')
                ->select(
                    'expp.grade_category'
                )
                ->where([
                    ['expp.class_id', '=', $request->class_id],
                    ['expp.academic_session_id', '=', $academic_session_id]
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
                    'sbj.id as subject_id',
                    'sbj.name as subject_name',
                    'cl.name as class_name',
                    'sec.name as section_name',
                    'sa.teacher_id',
                    DB::raw("CONCAT(sf.first_name, ' ', sf.last_name) as staff_name")
                )
                ->join('subject_assigns as sa', function ($join) use ($section_id, $academic_session_id) {
                    $join->on('sa.class_id', '=', 'expp.class_id')
                        ->on('sa.subject_id', '=', 'expp.subject_id')
                        ->on('sa.section_id', '=', DB::raw("'$section_id'"))
                        ->on('sa.academic_session_id', '=', DB::raw("'$academic_session_id'"));
                })
                ->join('subjects as sbj', 'expp.subject_id', '=', 'sbj.id')
                ->join('classes as cl', 'sa.class_id', '=', 'cl.id')
                ->join('sections as sec', 'sa.section_id', '=', 'sec.id')
                ->leftJoin('staffs as sf', 'sa.teacher_id', '=', 'sf.id')
                ->where([
                    ['expp.class_id', $request->class_id],
                    ['sa.section_id', $section_id],
                    ['expp.academic_session_id', '=', $academic_session_id],
                    ['sa.type', '=', '0'],
                    ['sbj.exam_exclude', '=', '0']
                ])
                ->groupBy('expp.subject_id')
                ->get();
            // dd($getExamMarks);
            if (!empty($getExamMarks)) {
                foreach ($getExamMarks as $marks) {
                    $total_subject_weightage = isset($marks->total_subject_weightage) ? (int)$marks->total_subject_weightage : 0;
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
                        ->where([
                            ['en.class_id', $class_id],
                            ['en.section_id', $section_id],
                            ['en.academic_session_id', '=', $academic_session_id],
                            ['en.semester_id', '=', $sem_id],
                            ['en.session_id', '=', $ses_id]
                        ])
                        ->get();
                    // dd($getstudentcount);
                    $semester_id = isset($getstudentcount[0]->semester_id) ? $getstudentcount[0]->semester_id : 0;
                    $session_id = isset($getstudentcount[0]->session_id) ? $getstudentcount[0]->session_id : 0;
                    $totalNoOfStudents = isset($getstudentcount[0]->totalStudentCount) ? $getstudentcount[0]->totalStudentCount : 0;

                    $newobject->totalstudentcount = $totalNoOfStudents;

                    $getStudMarks = $Connection->table('student_marks as sm')
                        ->select(
                            DB::raw("group_concat(sm.score ORDER BY sm.student_id ASC) as score"),
                            DB::raw("group_concat(sm.student_id ORDER BY sm.student_id ASC) as student_ids"),
                            'sb.name as subject_name',
                            'sm.paper_id',
                            'sm.grade_category',
                            DB::raw("group_concat(expp.subject_weightage ORDER BY sm.student_id ASC) as subject_weightage")
                        )
                        ->join('subjects as sb', 'sm.subject_id', '=', 'sb.id')
                        ->join('timetable_exam as te', function ($join) {
                            $join->on('te.class_id', '=', 'sm.class_id')
                                ->on('te.section_id', '=', 'sm.section_id')
                                ->on('te.subject_id', '=', 'sm.subject_id')
                                ->on('te.semester_id', '=', 'sm.semester_id')
                                ->on('te.session_id', '=', 'sm.session_id')
                                ->on('te.paper_id', '=', 'sm.paper_id')
                                ->on('te.academic_session_id', '=', 'sm.academic_session_id');
                        })
                        ->join('exam_papers as expp', 'sm.paper_id', '=', 'expp.id')
                        ->where([
                            ['sm.class_id', '=', $class_id],
                            ['sm.section_id', '=', $section_id],
                            ['sm.subject_id', '=', $subject_id],
                            ['sm.exam_id', '=', $request->exam_id],
                            ['sm.semester_id', '=', $semester_id],
                            ['sm.session_id', '=', $session_id],
                            ['sm.academic_session_id', '=', $academic_session_id]
                        ])
                        ->groupBy('sm.paper_id')
                        ->get();
                    $noOfPresentAbsent = $Connection->table('student_marks as sm')
                        ->select(
                            DB::raw('SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) AS absent'),
                            DB::raw('SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) AS present'),
                            DB::raw('SUM(CASE WHEN pass_fail = "Pass" THEN 1 ELSE 0 END) AS pass'),
                            DB::raw('SUM(CASE WHEN pass_fail = "Fail" THEN 1 ELSE 0 END) AS fail'),
                            DB::raw('SUM(CASE WHEN pass_fail = "Absent" THEN 1 ELSE 0 END) AS exam_absent')
                        )
                        ->join('subjects as sb', 'sm.subject_id', '=', 'sb.id')
                        ->join('timetable_exam as te', function ($join) {
                            $join->on('te.class_id', '=', 'sm.class_id')
                                ->on('te.section_id', '=', 'sm.section_id')
                                ->on('te.subject_id', '=', 'sm.subject_id')
                                ->on('te.semester_id', '=', 'sm.semester_id')
                                ->on('te.session_id', '=', 'sm.session_id')
                                ->on('te.paper_id', '=', 'sm.paper_id')
                                ->on('te.academic_session_id', '=', 'sm.academic_session_id');
                        })
                        ->join('exam_papers as expp', 'sm.paper_id', '=', 'expp.id')
                        ->where([
                            ['sm.class_id', '=', $class_id],
                            ['sm.section_id', '=', $section_id],
                            ['sm.subject_id', '=', $subject_id],
                            ['sm.exam_id', '=', $request->exam_id],
                            ['sm.semester_id', '=', $semester_id],
                            ['sm.session_id', '=', $session_id],
                            ['sm.academic_session_id', '=', $academic_session_id]
                        ])
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
                    $total_marks = [];
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
                                $marks[$i] = ($weightage * $score);
                            }
                            $object->marks = $marks;
                            $object->paper_id = $value->paper_id;
                            $object->grade_category = $value->grade_category;
                            array_push($total_marks, $object);
                        }
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
                    } else {
                        $gradecnt = new \stdClass();
                        $passcnt = new \stdClass();
                    }
                    if ($totalNoOfStudents > 0) {
                        $pass_percentage = ($passCnt / $totalNoOfStudents) * 100;
                        $newobject->pass_percentage = number_format($pass_percentage, 2);
                        $fail_percentage = ($failCnt / $totalNoOfStudents) * 100;
                        $newobject->fail_percentage = number_format($fail_percentage, 2);
                    } else {
                        $newobject->pass_percentage = 0;
                        $newobject->fail_percentage = 0;
                    }
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
    //by student exam results
    public function totgradeCalcuByStudent(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'exam_id' => 'required',
            'academic_year' => 'required'

        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $allbyStudent = array();
            $class_id = $request->class_id;
            $section_id = $request->section_id;
            $exam_id = $request->exam_id;
            $academic_session_id = $request->academic_year;
            $sem_id = isset($request->semester_id) ? $request->semester_id : 0;
            $ses_id = isset($request->session_id) ? $request->session_id : 0;
            // class name and section name by total students
            $getstudentdetails = $Connection->table('enrolls as en')
                ->select(
                    'en.student_id',
                    'en.semester_id',
                    'en.session_id',
                    DB::raw("CONCAT(stud.first_name, ' ', stud.last_name) as student_name")
                )
                ->join('classes as cl', 'en.class_id', '=', 'cl.id')
                ->join('sections as sc', 'en.section_id', '=', 'sc.id')
                ->join('students as stud', 'en.student_id', '=', 'stud.id')
                ->where([
                    ['en.class_id', $class_id],
                    ['en.section_id', $section_id],
                    ['en.academic_session_id', '=', $academic_session_id],
                    ['en.semester_id', '=', $sem_id],
                    ['en.session_id', '=', $ses_id]
                ])
                ->get();
            $get_all_subjects = $Connection->table('subject_assigns as sa')
                ->select(
                    'sa.class_id',
                    'sa.section_id',
                    'sbj.id as subject_id',
                    'sbj.name as subject_name'
                )
                ->join('subjects as sbj', 'sa.subject_id', '=', 'sbj.id')
                ->where([
                    ['sa.class_id', $class_id],
                    ['sa.section_id', $section_id],
                    ['sa.type', '=', '0'],
                    ['sa.academic_session_id', '=', $academic_session_id],
                    ['sbj.exam_exclude', '=', '0']
                ])
                ->groupBy('sa.subject_id')
                ->get();
            if (!empty($getstudentdetails)) {
                foreach ($getstudentdetails as $val) {
                    $student_obj = new \stdClass();

                    $student_id = $val->student_id;
                    $semester_id = $val->semester_id;
                    $session_id = $val->session_id;
                    $student_name = $val->student_name;

                    // add obj
                    $student_obj->student_id = $student_id;
                    $student_obj->student_name = $student_name;
                    $studentArr = [];
                    if (!empty($get_all_subjects)) {
                        foreach ($get_all_subjects as $value) {
                            $sbj_obj = new \stdClass();
                            // get subject total weightage
                            $getExamPaperWeightage = $Connection->table('exam_papers as expp')
                                ->select(
                                    DB::raw('SUM(expp.subject_weightage) as total_subject_weightage'),
                                    'expp.grade_category'
                                )
                                ->where([
                                    ['expp.class_id', '=', $value->class_id],
                                    ['expp.subject_id', '=', $value->subject_id],
                                    ['expp.academic_session_id', '=', $academic_session_id]
                                ])
                                ->get();
                            $total_subject_weightage = isset($getExamPaperWeightage[0]->total_subject_weightage) ? (int)$getExamPaperWeightage[0]->total_subject_weightage : 0;

                            $getStudMarksDetails = $Connection->table('student_marks as sm')
                                ->select(
                                    'expp.subject_weightage',
                                    'sb.name as subject_name',
                                    'sb.id as subject_id',
                                    'sm.score',
                                    'sm.paper_id',
                                    'sm.grade_category'
                                )
                                ->join('subjects as sb', 'sm.subject_id', '=', 'sb.id')
                                ->join('timetable_exam as te', function ($join) {
                                    $join->on('te.class_id', '=', 'sm.class_id')
                                        ->on('te.section_id', '=', 'sm.section_id')
                                        ->on('te.subject_id', '=', 'sm.subject_id')
                                        ->on('te.semester_id', '=', 'sm.semester_id')
                                        ->on('te.session_id', '=', 'sm.session_id')
                                        ->on('te.paper_id', '=', 'sm.paper_id')
                                        ->on('te.academic_session_id', '=', 'sm.academic_session_id');
                                })
                                ->join('exam_papers as expp', 'sm.paper_id', '=', 'expp.id')
                                ->where([
                                    ['sm.class_id', '=', $class_id],
                                    ['sm.section_id', '=', $section_id],
                                    ['sm.subject_id', '=', $value->subject_id],
                                    ['sm.exam_id', '=', $exam_id],
                                    ['sm.semester_id', '=', $semester_id],
                                    ['sm.session_id', '=', $session_id],
                                    ['sm.student_id', '=', $student_id],
                                    ['sm.academic_session_id', '=', $academic_session_id]
                                ])
                                ->groupBy('sm.paper_id')
                                ->get();

                            $sbj_obj->subject_id = $value->subject_id;
                            $marks = 0;
                            $grade_category = 0;
                            // here you get calculation based on student marks and subject weightage
                            if (!empty($getStudMarksDetails)) {
                                // grade calculations
                                foreach ($getStudMarksDetails as $Studmarks) {
                                    $sub_weightage = (int) $Studmarks->subject_weightage;
                                    $score = (int) $Studmarks->score;
                                    $grade_category = $Studmarks->grade_category;
                                    $weightage = ($sub_weightage / $total_subject_weightage);
                                    $marks += ($weightage * $score);
                                }
                                $mark = (int) $marks;
                                // get range grade
                                $grade = $Connection->table('grade_marks')
                                    ->select('grade')
                                    ->where([
                                        ['min_mark', '<=', $mark],
                                        ['max_mark', '>=', $mark],
                                        ['grade_category', '=', $grade_category]
                                    ])
                                    ->first();
                                $sbj_obj->marks = $marks != 0 ? number_format($marks) : $marks;
                                $sbj_obj->grade = isset($grade->grade) ? $grade->grade : '-';
                            } else {
                                $sbj_obj->marks = "Nill";
                                $sbj_obj->grade = "Nill";
                            }
                            array_push($studentArr, $sbj_obj);
                        }
                    }
                    $student_obj->student_class = $studentArr;
                    array_push($allbyStudent, $student_obj);
                }
            }
            $data = [
                'headers' => isset($get_all_subjects) ? $get_all_subjects : [],
                'allbyStudent' => $allbyStudent
            ];
            return $this->successResponse($data, 'bystudent all Post record fetch successfully');
        }
    }
    // Individual Result 
    public function getbyresult_student(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'exam_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'academic_year' => 'required',
            'registerno' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data
            $allbyStudent = array();
            $class_id = $request->class_id;
            $section_id = $request->section_id;
            $exam_id = $request->exam_id;
            $registerno = $request->registerno;
            $academic_session_id = $request->academic_year;
            $sem_id = isset($request->semester_id) ? $request->semester_id : 0;
            $ses_id = isset($request->session_id) ? $request->session_id : 0;
            $studentDetails = $Connection->table('students as stud')->Select(
                'stud.id',
                'en.class_id',
                'en.section_id',
                'en.semester_id',
                'en.session_id',
                'cl.name as class_name',
                'sc.name as section_name',
                DB::raw("CONCAT(stud.first_name, ' ', stud.last_name) as student_name"),
                'stud.birthday',
                'stud.register_no'
            )
                ->join('enrolls as en', 'en.student_id', '=', 'stud.id')
                ->join('classes as cl', 'en.class_id', '=', 'cl.id')
                ->join('sections as sc', 'en.section_id', '=', 'sc.id')
                ->where([
                    ['stud.register_no', $registerno],
                    ['en.academic_session_id', $academic_session_id],
                    ['en.semester_id', '=', $sem_id],
                    ['en.session_id', '=', $ses_id]
                ])
                ->first();
            if (isset($studentDetails->id)) {
                $student_id = $studentDetails->id;
                // class name and section name by total students
                $getstudentdetails = $Connection->table('enrolls as en')
                    ->select(
                        'en.student_id',
                        'en.semester_id',
                        'en.session_id',
                        DB::raw("CONCAT(stud.first_name, ' ', stud.last_name) as student_name")
                    )
                    ->join('classes as cl', 'en.class_id', '=', 'cl.id')
                    ->join('sections as sc', 'en.section_id', '=', 'sc.id')
                    ->join('students as stud', 'en.student_id', '=', 'stud.id')
                    ->where([
                        ['en.class_id', $class_id],
                        ['en.section_id', $section_id],
                        ['en.semester_id', '=', $sem_id],
                        ['en.session_id', '=', $ses_id],
                        ['en.academic_session_id', '=', $academic_session_id],
                        ['en.student_id', $student_id]
                    ])
                    ->get();
                $get_all_subjects = $Connection->table('subject_assigns as sa')
                    ->select(
                        'sa.class_id',
                        'sa.section_id',
                        'sbj.id as subject_id',
                        'sbj.name as subject_name'
                    )
                    ->join('subjects as sbj', 'sa.subject_id', '=', 'sbj.id')
                    ->where([
                        ['sa.class_id', $class_id],
                        ['sa.section_id', $section_id],
                        ['sa.academic_session_id', $academic_session_id],
                        ['sa.type', '=', '0'],
                        ['sbj.exam_exclude', '=', '0']
                    ])
                    ->groupBy('sa.subject_id')
                    ->get();
                if (!empty($getstudentdetails)) {
                    foreach ($getstudentdetails as $val) {
                        $student_obj = new \stdClass();

                        $student_id = $val->student_id;
                        $semester_id = $val->semester_id;
                        $session_id = $val->session_id;
                        $student_name = $val->student_name;

                        // add obj
                        $student_obj->student_id = $student_id;
                        $student_obj->student_name = $student_name;
                        $studentArr = [];
                        if (!empty($get_all_subjects)) {
                            foreach ($get_all_subjects as $value) {
                                $sbj_obj = new \stdClass();
                                // get subject total weightage
                                $getExamPaperWeightage = $Connection->table('exam_papers as expp')
                                    ->select(
                                        DB::raw('SUM(expp.subject_weightage) as total_subject_weightage'),
                                        'expp.grade_category'
                                    )
                                    ->where([
                                        ['expp.class_id', '=', $value->class_id],
                                        ['expp.subject_id', '=', $value->subject_id],
                                        ['expp.academic_session_id', '=', $academic_session_id]
                                    ])
                                    ->get();
                                $total_subject_weightage = isset($getExamPaperWeightage[0]->total_subject_weightage) ? (int)$getExamPaperWeightage[0]->total_subject_weightage : 0;

                                $getStudMarksDetails = $Connection->table('student_marks as sm')
                                    ->select(
                                        'expp.subject_weightage',
                                        'sb.name as subject_name',
                                        'sb.id as subject_id',
                                        'sm.score',
                                        'sm.paper_id',
                                        'sm.grade_category'
                                    )
                                    ->join('subjects as sb', 'sm.subject_id', '=', 'sb.id')
                                    ->join('timetable_exam as te', function ($join) {
                                        $join->on('te.class_id', '=', 'sm.class_id')
                                            ->on('te.section_id', '=', 'sm.section_id')
                                            ->on('te.subject_id', '=', 'sm.subject_id')
                                            ->on('te.semester_id', '=', 'sm.semester_id')
                                            ->on('te.session_id', '=', 'sm.session_id')
                                            ->on('te.paper_id', '=', 'sm.paper_id')
                                            ->on('te.academic_session_id', '=', 'sm.academic_session_id');
                                    })
                                    ->join('exam_papers as expp', 'sm.paper_id', '=', 'expp.id')
                                    ->where([
                                        ['sm.class_id', '=', $class_id],
                                        ['sm.section_id', '=', $section_id],
                                        ['sm.subject_id', '=', $value->subject_id],
                                        ['sm.exam_id', '=', $exam_id],
                                        ['sm.semester_id', '=', $semester_id],
                                        ['sm.session_id', '=', $session_id],
                                        ['sm.academic_session_id', '=', $academic_session_id],
                                        ['sm.student_id', '=', $student_id]
                                    ])
                                    ->groupBy('sm.paper_id')
                                    ->get();

                                $sbj_obj->subject_id = $value->subject_id;
                                $marks = 0;
                                $grade_category = 0;
                                // here you get calculation based on student marks and subject weightage
                                if (!empty($getStudMarksDetails)) {
                                    // grade calculations
                                    foreach ($getStudMarksDetails as $Studmarks) {
                                        $sub_weightage = (int) $Studmarks->subject_weightage;
                                        $score = (int) $Studmarks->score;
                                        $grade_category = $Studmarks->grade_category;
                                        $weightage = ($sub_weightage / $total_subject_weightage);
                                        $marks += ($weightage * $score);
                                    }
                                    $mark = (int) $marks;
                                    // get range grade
                                    $grade = $Connection->table('grade_marks')
                                        ->select('grade')
                                        ->where([
                                            ['min_mark', '<=', $mark],
                                            ['max_mark', '>=', $mark],
                                            ['grade_category', '=', $grade_category]
                                        ])
                                        ->first();
                                    $sbj_obj->marks = $marks != 0 ? number_format($marks) : $marks;
                                    $sbj_obj->grade = isset($grade->grade) ? $grade->grade : '-';
                                } else {
                                    $sbj_obj->marks = "Nill";
                                    $sbj_obj->grade = "Nill";
                                }
                                array_push($studentArr, $sbj_obj);
                            }
                        }
                        $student_obj->student_class = $studentArr;
                        array_push($allbyStudent, $student_obj);
                    }
                }
            }
            $data = [
                'student_details' => isset($studentDetails) ? $studentDetails : null,
                'headers' => isset($get_all_subjects) ? $get_all_subjects : [],
                'allbyStudent' => $allbyStudent
            ];
            return $this->successResponse($data, 'bystudent all Post record fetch successfully');
        }
    }
    // over all
    public function tot_grade_calcu_overall(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
            'exam_id' => 'required',
            'academic_year' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data     
            $allbysubject = array();
            $exam_id = $request->exam_id;
            $academic_session_id = $request->academic_year;
            $sem_id = isset($request->semester_id) ? $request->semester_id : 0;
            $ses_id = isset($request->session_id) ? $request->session_id : 0;
            // get grade category
            $getGradeCategory = $Connection->table('exam_papers as expp')
                ->select(
                    'expp.grade_category'
                )
                ->where([
                    ['expp.class_id', '=', $request->class_id],
                    ['expp.academic_session_id', '=', $academic_session_id]
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

            $total_sujects_teacher = $Connection->table('subject_assigns as sa')
                ->select(
                    DB::raw("group_concat(sa.section_id) as all_section_id"),
                    'sbj.id as subject_id',
                    'sbj.name as subject_name'
                )
                ->join('subjects as sbj', 'sa.subject_id', '=', 'sbj.id')
                ->where([
                    ['sa.class_id', $request->class_id],
                    ['sa.academic_session_id', $academic_session_id],
                    ['sa.type', '=', '0'],
                    ['sbj.exam_exclude', '=', '0']
                ])
                ->groupBy('sa.subject_id')
                ->get();
            if (!empty($total_sujects_teacher)) {
                foreach ($total_sujects_teacher as $val) {
                    $object = new \stdClass();
                    $all_section_id = explode(',', $val->all_section_id);
                    $class_id = $request->class_id;
                    $subject_id = $val->subject_id;
                    $subject_name = $val->subject_name;

                    $object->class_id = $class_id;
                    $object->subject_id = $subject_id;
                    $object->subject_name = $subject_name;
                    // all section list
                    $studentArr = [];
                    $addAllStudCnt = 0;
                    $presentCnt = 0;
                    $absentCnt = 0;
                    $passCnt = 0;
                    $failCnt = 0;
                    foreach ($all_section_id as $key => $section) {
                        // get subject total weightage
                        $getExamPaperWeightage = $Connection->table('exam_papers as expp')
                            ->select(
                                DB::raw('SUM(expp.subject_weightage) as total_subject_weightage'),
                                'expp.grade_category'
                            )
                            ->where([
                                ['expp.class_id', '=', $class_id],
                                ['expp.subject_id', '=', $subject_id],
                                ['expp.academic_session_id', $academic_session_id]
                            ])
                            ->get();
                        $total_subject_weightage = isset($getExamPaperWeightage[0]->total_subject_weightage) ? (int)$getExamPaperWeightage[0]->total_subject_weightage : 0;

                        $studentDetails = $Connection->table('enrolls as en')
                            ->select(
                                'en.student_id',
                                'en.semester_id',
                                'en.session_id'
                            )
                            ->join('classes as cl', 'en.class_id', '=', 'cl.id')
                            ->join('sections as sc', 'en.section_id', '=', 'sc.id')
                            ->join('students as stud', 'en.student_id', '=', 'stud.id')
                            ->where([
                                ['en.class_id', $class_id],
                                ['en.section_id', $section],
                                ['en.academic_session_id', '=', $academic_session_id],
                                ['en.semester_id', '=', $sem_id],
                                ['en.session_id', '=', $ses_id]
                            ])
                            ->get();
                        $semester_id = isset($studentDetails[0]->semester_id) ? $studentDetails[0]->semester_id : 0;
                        $session_id = isset($studentDetails[0]->session_id) ? $studentDetails[0]->session_id : 0;
                        $totalStudent = count($studentDetails);
                        $addAllStudCnt += $totalStudent;

                        $noOfPresentAbsent = $Connection->table('student_marks as sm')
                            ->select(
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
                                    ->on('te.paper_id', '=', 'sm.paper_id')
                                    ->on('te.academic_session_id', '=', 'sm.academic_session_id');
                            })
                            ->join('exam_papers as expp', 'sm.paper_id', '=', 'expp.id')
                            ->where([
                                ['sm.class_id', '=', $class_id],
                                ['sm.section_id', '=', $section],
                                ['sm.subject_id', '=', $subject_id],
                                ['sm.exam_id', '=', $exam_id],
                                ['sm.semester_id', '=', $semester_id],
                                ['sm.session_id', '=', $session_id],
                                ['sm.academic_session_id', '=', $academic_session_id]
                            ])
                            ->groupBy('sm.subject_id')
                            ->groupBy('sm.student_id')
                            ->get();
                        // get present absent count
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
                        if (!empty($studentDetails)) {
                            foreach ($studentDetails as $student) {
                                $sbj_obj = new \stdClass();

                                $student_id = $student->student_id;
                                $getStudMarksDetails = $Connection->table('student_marks as sm')
                                    ->select(
                                        'expp.subject_weightage',
                                        'sb.name as subject_name',
                                        'sb.id as subject_id',
                                        'sm.score',
                                        'sm.paper_id',
                                        'sm.grade_category'
                                    )
                                    ->join('subjects as sb', 'sm.subject_id', '=', 'sb.id')
                                    ->join('timetable_exam as te', function ($join) {
                                        $join->on('te.class_id', '=', 'sm.class_id')
                                            ->on('te.section_id', '=', 'sm.section_id')
                                            ->on('te.subject_id', '=', 'sm.subject_id')
                                            ->on('te.semester_id', '=', 'sm.semester_id')
                                            ->on('te.session_id', '=', 'sm.session_id')
                                            ->on('te.paper_id', '=', 'sm.paper_id')
                                            ->on('te.academic_session_id', '=', 'sm.academic_session_id');
                                    })
                                    ->join('exam_papers as expp', 'sm.paper_id', '=', 'expp.id')
                                    ->where([
                                        ['sm.class_id', '=', $class_id],
                                        ['sm.section_id', '=', $section],
                                        ['sm.subject_id', '=', $subject_id],
                                        ['sm.exam_id', '=', $exam_id],
                                        ['sm.semester_id', '=', $semester_id],
                                        ['sm.session_id', '=', $session_id],
                                        ['sm.student_id', '=', $student_id],
                                        ['sm.academic_session_id', '=', $academic_session_id]
                                    ])
                                    ->groupBy('sm.paper_id')
                                    ->get();
                                $marks = 0;
                                $marks = 0;
                                // // here you get calculation based on student marks and subject weightage
                                if (!empty($getStudMarksDetails)) {
                                    // grade calculations
                                    foreach ($getStudMarksDetails as $Studmarks) {
                                        $sub_weightage = (int) $Studmarks->subject_weightage;
                                        $score = (int) $Studmarks->score;
                                        $grade_category = $Studmarks->grade_category;
                                        // foreach for total no of students
                                        $weightage = ($sub_weightage / $total_subject_weightage);
                                        // dd($weightage);
                                        $marks += ($weightage * $score);
                                        // print_r($marks);
                                        // print_r($marks);

                                    }
                                    $mark = (int) $marks;
                                    // echo $mark;
                                    // get range grade
                                    $grade = $Connection->table('grade_marks')
                                        ->select('grade')
                                        ->where([
                                            ['min_mark', '<=', $mark],
                                            ['max_mark', '>=', $mark],
                                            ['grade_category', '=', $grade_category]
                                        ])
                                        ->first();
                                    $sbj_obj->marks = $marks != 0 ? number_format($marks) : $marks;
                                    $sbj_obj->grade = isset($grade->grade) ? $grade->grade : '-';
                                } else {
                                    $sbj_obj->marks = "Nill";
                                    $sbj_obj->grade = "Nill";
                                }

                                array_push($studentArr, $sbj_obj);
                            }
                        }
                    }
                    $gradecnt = array_count_values(array_column($studentArr, 'grade'));
                    $object->gradecnt = $gradecnt;
                    $object->presentCnt = $presentCnt;
                    $object->absentCnt = $absentCnt;
                    $object->passCnt = $passCnt;
                    $object->failCnt = $failCnt;
                    $object->addAllStudCnt = $addAllStudCnt;
                    if ($addAllStudCnt > 0) {
                        $pass_percentage = ($passCnt / $addAllStudCnt) * 100;
                        $object->pass_percentage = number_format($pass_percentage, 2);
                    } else {
                        $object->pass_percentage = 0;
                    }
                    array_push($allbysubject, $object);
                }
            }
            $data = [
                'headers' => isset($allGradeDetails) ? $allGradeDetails : [],
                'allbysubject' => $allbysubject
            ];
            return $this->successResponse($data, 'bysubject all Post record fetch successfully');
        }
    }
    // Report card 
    // public function getreportcard(Request $request)
    // {
    //     $validator = \Validator::make($request->all(), [
    //         'branch_id' => 'required',
    //         'token' => 'required',
    //         'exam_id' => 'required',
    //         'selected_year' => 'required',
    //         'student_id' => 'required'
    //     ]);
    //     if (!$validator->passes()) {
    //         return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
    //     } else {
    //         // create new connection
    //         $Connection = $this->createNewConnection($request->branch_id);
    //         // get all teachers
    //         $allsubjectreport = array();
    //         $object = new \stdClass();
    //         // $subjectreport_studentmarks = $Connection->table('student_marks')
    //         //     ->select(
    //         //         'subjects.id as subject_id',
    //         //         'subjects.name as subject_name',
    //         //         'student_marks.score',
    //         //         'student_marks.grade',
    //         //         'student_marks.ranking',
    //         //         'student_marks.pass_fail',
    //         //         'timetable_exam.exam_date',
    //         //         'exam_papers.paper_name'
    //         //     )
    //         //     ->Join('subjects', 'student_marks.subject_id', '=', 'subjects.id')
    //         //     ->Join('exam_papers', 'student_marks.paper_id', '=', 'exam_papers.id')
    //         //     ->join('timetable_exam', function ($join) {
    //         //         $join->on('student_marks.exam_id', '=', 'timetable_exam.exam_id')
    //         //             ->on('student_marks.class_id', '=', 'timetable_exam.class_id')
    //         //             ->on('student_marks.section_id', '=', 'timetable_exam.section_id')
    //         //             ->on('student_marks.subject_id', '=', 'timetable_exam.subject_id')
    //         //             ->on('student_marks.semester_id', '=', 'timetable_exam.semester_id')
    //         //             ->on('student_marks.session_id', '=', 'timetable_exam.session_id')
    //         //             ->on('student_marks.paper_id', '=', 'timetable_exam.paper_id');
    //         //     })
    //         //     ->where([
    //         //         ['student_marks.exam_id', '=', $request->exam_id],
    //         //         ['student_marks.student_id', '=', $request->student_id]
    //         //     ])
    //         //     ->whereYear('timetable_exam.exam_date', $request->selected_year)
    //         //     ->get();
    //         // $getExamMarks = $Connection->table('exam_papers as expp')
    //         //     ->select(
    //         //         DB::raw('SUM(expp.subject_weightage) as total_subject_weightage'),
    //         //         'expp.grade_category',
    //         //         'sbj.id as subject_id',
    //         //         'sbj.name as subject_name',
    //         //         'cl.name as class_name',
    //         //         'sec.name as section_name',
    //         //         'sa.teacher_id',
    //         //         DB::raw("CONCAT(sf.first_name, ' ', sf.last_name) as staff_name")
    //         //     )
    //         //     ->join('subject_assigns as sa', function ($join) use ($section_id) {
    //         //         $join->on('sa.class_id', '=', 'expp.class_id')
    //         //             ->on('sa.subject_id', '=', 'expp.subject_id')
    //         //             ->on('sa.section_id', '=', DB::raw("'$section_id'"));
    //         //     })
    //         //     ->join('subjects as sbj', 'expp.subject_id', '=', 'sbj.id')
    //         //     ->join('classes as cl', 'sa.class_id', '=', 'cl.id')
    //         //     ->join('sections as sec', 'sa.section_id', '=', 'sec.id')
    //         //     ->leftJoin('staffs as sf', 'sa.teacher_id', '=', 'sf.id')
    //         //     ->where([
    //         //         ['expp.class_id', $request->class_id],
    //         //         ['sa.section_id', $section_id],
    //         //         ['sa.type', '=', '0'],
    //         //         ['sbj.exam_exclude', '=', '0']
    //         //     ])
    //         //     ->groupBy('expp.subject_id')
    //         //     ->get();
    //         $getTotalExamMarksSub = $Connection->table('student_marks as sm')
    //             ->select(
    //                 'sb.id as subject_id',
    //                 'sb.name as subject_name'
    //             )
    //             ->join('subjects as sb', 'sm.subject_id', '=', 'sb.id')
    //             ->join('timetable_exam as te', function ($join) {
    //                 $join->on('te.class_id', '=', 'sm.class_id')
    //                     ->on('te.section_id', '=', 'sm.section_id')
    //                     ->on('te.subject_id', '=', 'sm.subject_id')
    //                     ->on('te.semester_id', '=', 'sm.semester_id')
    //                     ->on('te.session_id', '=', 'sm.session_id')
    //                     ->on('te.paper_id', '=', 'sm.paper_id');
    //             })
    //             ->join('exam_papers as expp', 'sm.paper_id', '=', 'expp.id')
    //             ->where([
    //                 ['sm.exam_id', '=', $request->exam_id],
    //                 ['sm.student_id', '=', $request->student_id]
    //             ])
    //             ->whereYear('te.exam_date', $request->selected_year)
    //             ->groupBy('sm.subject_id')
    //             ->get();
    //         dd($getTotalExamMarksSub);
    //         $getStudMarks = $Connection->table('student_marks as sm')
    //             ->select(
    //                 'sm.score',
    //                 'sm.pass_fail',
    //                 'sb.id as subject_id',
    //                 'sb.name as subject_name',
    //                 'sm.paper_id',
    //                 'sm.grade_category',
    //                 'expp.subject_weightage',
    //                 'sm.ranking',
    //                 'te.exam_date',
    //                 'expp.paper_name'
    //             )
    //             ->join('subjects as sb', 'sm.subject_id', '=', 'sb.id')
    //             ->join('timetable_exam as te', function ($join) {
    //                 $join->on('te.class_id', '=', 'sm.class_id')
    //                     ->on('te.section_id', '=', 'sm.section_id')
    //                     ->on('te.subject_id', '=', 'sm.subject_id')
    //                     ->on('te.semester_id', '=', 'sm.semester_id')
    //                     ->on('te.session_id', '=', 'sm.session_id')
    //                     ->on('te.paper_id', '=', 'sm.paper_id');
    //             })
    //             ->join('exam_papers as expp', 'sm.paper_id', '=', 'expp.id')
    //             ->where([
    //                 ['sm.exam_id', '=', $request->exam_id],
    //                 ['sm.student_id', '=', $request->student_id]
    //             ])
    //             ->whereYear('te.exam_date', $request->selected_year)
    //             ->groupBy('sm.subject_id')
    //             ->groupBy('sm.paper_id')
    //             // ->groupBy('sm.student_id')
    //             ->get();
    //         dd($getStudMarks);
    //         $total_marks = [];
    //         // here you get calculation based on student marks and subject weightage
    //         if (!empty($getStudMarks)) {
    //             foreach ($getStudMarks as $key => $value) {
    //                 $object = new \stdClass();
    //                 $total_sub_weightage = explode(',', $value->subject_weightage);
    //                 $total_score = explode(',', $value->score);
    //                 $marks = [];
    //                 // foreach for total no of students
    //                 for ($i = 0; $i < $totalNoOfStudents; $i++) {
    //                     $sub_weightage = isset($total_sub_weightage[$i]) ? (int) $total_sub_weightage[$i] : 0;
    //                     $score = isset($total_sub_weightage[$i]) ? (int) $total_score[$i] : 0;
    //                     $weightage = ($sub_weightage / $total_subject_weightage);
    //                     $marks[$i] = ($weightage * $score);
    //                 }
    //                 $object->marks = $marks;
    //                 $object->paper_id = $value->paper_id;
    //                 $object->grade_category = $value->grade_category;
    //                 array_push($total_marks, $object);
    //             }
    //         }

    //         dd($getStudMarks);
    //         $object->subjectreport = $getStudMarks;
    //         array_push($allsubjectreport, $object);
    //         //dd($allsubjectreport);
    //         return $this->successResponse($allsubjectreport, 'get report for student fetch successfully');
    //     }
    // }
    public function getreportcard(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'exam_id' => 'required',
            'student_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $allbyStudent = array();
            $exam_id = $request->exam_id;
            $student_id = $request->student_id;
            // class name and section name by total students
            $getstudentdetails = $Connection->table('enrolls as en')
                ->select(
                    'en.student_id',
                    'en.class_id',
                    'en.section_id',
                    'en.student_id',
                    'en.semester_id',
                    'en.session_id',
                    'en.academic_session_id',
                    DB::raw("CONCAT(stud.first_name, ' ', stud.last_name) as student_name")
                )
                ->join('classes as cl', 'en.class_id', '=', 'cl.id')
                ->join('sections as sc', 'en.section_id', '=', 'sc.id')
                ->join('students as stud', 'en.student_id', '=', 'stud.id')
                ->where('en.student_id', '=', $student_id)
                ->where('en.active_status', '=', '0')
                ->first();
            $class_id = isset($getstudentdetails->class_id) ? $getstudentdetails->class_id : 0;
            $section_id = isset($getstudentdetails->section_id) ? $getstudentdetails->section_id : 0;
            $semester_id = isset($getstudentdetails->semester_id) ? $getstudentdetails->semester_id : 0;
            $session_id = isset($getstudentdetails->session_id) ? $getstudentdetails->session_id : 0;
            $academic_session_id = isset($getstudentdetails->academic_session_id) ? $getstudentdetails->academic_session_id : 0;
            $student_name = isset($getstudentdetails->student_name) ? $getstudentdetails->student_name : '-';
            $get_all_subjects = $Connection->table('subject_assigns as sa')
                ->select(
                    'sa.class_id',
                    'sa.section_id',
                    'sbj.id as subject_id',
                    'sbj.name as subject_name'
                )
                ->join('subjects as sbj', 'sa.subject_id', '=', 'sbj.id')
                ->where([
                    ['sa.class_id', $class_id],
                    ['sa.section_id', $section_id],
                    ['sa.academic_session_id', $academic_session_id],
                    ['sa.type', '=', '0'],
                    ['sbj.exam_exclude', '=', '0']
                ])
                ->groupBy('sa.subject_id')
                ->get();
            $student_obj = new \stdClass();
            // add obj
            $student_obj->student_id = $student_id;
            $student_obj->student_name = $student_name;
            $studentArr = [];
            if (!empty($get_all_subjects)) {
                foreach ($get_all_subjects as $value) {
                    $sbj_obj = new \stdClass();
                    // get subject total weightage
                    $getExamPaperWeightage = $Connection->table('exam_papers as expp')
                        ->select(
                            DB::raw('SUM(expp.subject_weightage) as total_subject_weightage'),
                            'expp.grade_category'
                        )
                        ->where([
                            ['expp.class_id', '=', $value->class_id],
                            ['expp.subject_id', '=', $value->subject_id]
                        ])
                        ->get();
                    $total_subject_weightage = isset($getExamPaperWeightage[0]->total_subject_weightage) ? (int)$getExamPaperWeightage[0]->total_subject_weightage : 0;

                    $getStudMarksDetails = $Connection->table('student_marks as sm')
                        ->select(
                            'expp.subject_weightage',
                            'sb.name as subject_name',
                            'sb.id as subject_id',
                            'sm.score',
                            'sm.paper_id',
                            'sm.grade_category'
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
                            ['sm.subject_id', '=', $value->subject_id],
                            ['sm.exam_id', '=', $exam_id],
                            ['sm.semester_id', '=', $semester_id],
                            ['sm.session_id', '=', $session_id],
                            ['sm.student_id', '=', $student_id]
                        ])
                        ->groupBy('sm.paper_id')
                        ->get();

                    $sbj_obj->subject_id = $value->subject_id;
                    $marks = 0;
                    $grade_category = 0;
                    // here you get calculation based on student marks and subject weightage
                    if (!empty($getStudMarksDetails)) {
                        // grade calculations
                        foreach ($getStudMarksDetails as $Studmarks) {
                            $sub_weightage = (int) $Studmarks->subject_weightage;
                            $score = (int) $Studmarks->score;
                            $grade_category = $Studmarks->grade_category;
                            $weightage = ($sub_weightage / $total_subject_weightage);
                            $marks += ($weightage * $score);
                        }
                        $mark = (int) $marks;
                        // get range grade
                        $grade = $Connection->table('grade_marks')
                            ->select('grade')
                            ->where([
                                ['min_mark', '<=', $mark],
                                ['max_mark', '>=', $mark],
                                ['grade_category', '=', $grade_category]
                            ])
                            ->first();
                        $sbj_obj->marks = $marks != 0 ? number_format($marks) : $marks;
                        $sbj_obj->grade = isset($grade->grade) ? $grade->grade : '-';
                    } else {
                        $sbj_obj->marks = "Nill";
                        $sbj_obj->grade = "Nill";
                    }
                    array_push($studentArr, $sbj_obj);
                }
            }
            $student_obj->student_class = $studentArr;
            array_push($allbyStudent, $student_obj);

            $data = [
                'headers' => isset($get_all_subjects) ? $get_all_subjects : [],
                'allbyStudent' => $allbyStudent
            ];
            return $this->successResponse($data, 'bystudent all Post record fetch successfully');
        }
    }
    // academic Year Add
    public function academicYearAdd(Request $request)
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
            if ($Connection->table('academic_year')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Year Already Exist', ['error' => 'Year Already Exist']);
            } else {
                // insert data
                $query = $Connection->table('academic_year')->insert([
                    'name' => $request->name,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Academic year has been successfully saved');
                }
            }
        }
    }
    // academic Year List
    public function academicYearList(Request $request)
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
            $Department = $Connection->table('academic_year')->get();
            return $this->successResponse($Department, 'Academic year record fetch successfully');
        }
    }
    // academic Year Details
    public function academicYearDetails(Request $request)
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
            $deptDetails = $Connection->table('academic_year')->where('id', $id)->first();
            return $this->successResponse($deptDetails, 'Academic year row fetch successfully');
        }
    }
    // update academic Year Details
    public function updateAcademicYear(Request $request)
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
            if ($Connection->table('academic_year')->where([['name', '=', $request->name], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Academic Year Exist', ['error' => 'Academic Year Exist']);
            } else {
                // update data
                $query = $Connection->table('academic_year')->where('id', $id)->update([
                    'name' => $request->name,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Academic year have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete academic Year
    public function deleteAcademicYear(Request $request)
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
            $staffConn = $this->createNewConnection($request->branch_id);
            // get data
            $query = $staffConn->table('academic_year')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Academic year have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // get student list by entrolls
    public function getStudListByClassSecSemSess(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'session_id' => 'required',
            'semester_id' => 'required',
            'academic_session_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $Connection = $this->createNewConnection($request->branch_id);
            $getSubjectMarks = $Connection->table('enrolls as en')
                ->select(
                    'en.student_id',
                    'en.class_id',
                    'en.section_id',
                    DB::raw("CONCAT(st.first_name, ' ', st.last_name) as name"),
                    'st.id as id',
                    'st.register_no',
                    'st.roll_no',
                    'st.photo'
                )
                ->join('students as st', 'st.id', '=', 'en.student_id')
                ->where([
                    ['en.class_id', '=', $request->class_id],
                    ['en.section_id', '=', $request->section_id],
                    ['en.semester_id', '=', $request->semester_id],
                    ['en.session_id', '=', $request->session_id],
                    ['en.academic_session_id', '=', $request->academic_session_id]
                ])
                ->orderBy('st.first_name', 'asc')
                ->get();
            return $this->successResponse($getSubjectMarks, 'Students record fetch successfully');
        }
    }
    //add attendance
    function addPromotion(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'promote_year' => 'required',
            'promote_class_id' => 'required',
            'promote_section_id' => 'required',
            'promote_semester_id' => 'required',
            'promote_session_id' => 'required',
            'promotion' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);

            $promotion = $request->promotion;
            if (!empty($promotion)) {
                foreach ($promotion as $key => $value) {
                    // dd($value['attendance_id']);
                    // dd($value);
                    $student_id = (isset($value['student_id']) ? $value['student_id'] : 0);
                    $register_no = (isset($value['register_no']) ? $value['register_no'] : 0);
                    $roll_no = (isset($value['roll_no']) ? $value['roll_no'] : 0);
                    // here update studentID as promote
                    $Connection->table('enrolls')
                        ->where('student_id', '=', $student_id)
                        ->update(['active_status' => 1]);
                    $dataPromote = array(
                        'student_id' => $student_id,
                        'academic_session_id' => $request->promote_year,
                        'class_id' => $request->promote_class_id,
                        'section_id' => $request->promote_section_id,
                        'semester_id' => $request->promote_semester_id,
                        'session_id' => $request->promote_session_id,
                        'active_status' => 0,
                        'roll' => $roll_no
                    );
                    $row = $Connection->table('enrolls')
                        ->select(
                            'id',
                            'class_id',
                            'section_id',
                            'roll',
                            'session_id',
                            'semester_id'
                        )->where([
                            ['student_id', '=', $student_id],
                            ['class_id', '=', $request->promote_class_id],
                            ['section_id', '=', $request->promote_section_id],
                            ['semester_id', '=', $request->promote_semester_id],
                            ['session_id', '=', $request->promote_session_id]
                        ])->first();
                    // if (isset($value['promotion_status'])) {
                    if (isset($row->id)) {
                        $dataPromote['updated_at'] = date("Y-m-d H:i:s");
                        $Connection->table('enrolls')->where('id', $row->id)->update($dataPromote);
                    } else {
                        $dataPromote['created_at'] = date("Y-m-d H:i:s");
                        $Connection->table('enrolls')->insert($dataPromote);
                    }
                    // } else {
                    //     $dePromote = array(
                    //         'student_id' => $student_id,
                    //         'class_id' => $row->class_id,
                    //         'section_id' => $row->section_id,
                    //         'semester_id' => $row->semester_id,
                    //         'session_id' => $row->session_id,
                    //         'roll' => $row->roll
                    //     );
                    //     if (isset($row->id)) {
                    //         $dePromote['updated_at'] = date("Y-m-d H:i:s");
                    //         $Connection->table('enrolls')->where('id', $row->id)->update($dePromote);
                    //     } else {
                    //         $dePromote['created_at'] = date("Y-m-d H:i:s");
                    //         $Connection->table('enrolls')->insert($dePromote);
                    //     }
                    // }
                }
            }
            return $this->successResponse([], 'Promotion successfuly.');
        }
    }
    // relief assignment
    public function getAllLeaveReliefAssignment(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'academic_session_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            $leaveDetails = $conn->table('staff_leaves as lev')
                ->select(
                    'lev.id',
                    'lev.staff_id',
                    DB::raw('CONCAT(stf.first_name, " ", stf.last_name) as name'),
                    DB::raw('DATE_FORMAT(lev.from_leave, "%d-%m-%Y") as from_leave'),
                    DB::raw('DATE_FORMAT(lev.to_leave, "%d-%m-%Y") as to_leave'),
                    DB::raw('DATE_FORMAT(lev.created_at, "%d-%m-%Y") as created_at'),
                    DB::raw('DATEDIFF(lev.to_leave,lev.from_leave) as date_diff'),
                    'lt.name as leave_type_name',
                    'rs.name as reason_name',
                    'lev.reason_id',
                    'lev.document',
                    'lev.status',
                    'lev.remarks',
                    'lev.assiner_remarks'

                )
                ->join('leave_types as lt', 'lev.leave_type', '=', 'lt.id')
                ->join('staffs as stf', 'lev.staff_id', '=', 'stf.id')
                ->leftJoin('reasons as rs', 'lev.reason_id', '=', 'rs.id')
                ->where([
                    ['lev.academic_session_id', '=', $request->academic_session_id],
                    // ['lev.status', '=', 'Approve']
                ])
                ->orderBy('lev.from_leave', 'desc')
                ->get();
            return $this->successResponse($leaveDetails, 'Staff leave details fetch successfully');
        }
    }
    public function getSubjectsByStaffIdWithDate(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'academic_session_id' => 'required',
            'staff_id' => 'required',
            'from_date' => 'required',
            'to_date' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            $from_leave = date('Y-m-d', strtotime($request['from_date']));
            $to_leave = date('Y-m-d', strtotime($request['to_date']));
            $leave_teacher = $conn->table('calendors as cl')
                ->select(
                    'cl.id',
                    'cl.start',
                    'cl.end',
                    'cl.relief_assignment_id',
                    'cl.time_table_id',
                    DB::raw('date(cl.end) as end_date'),
                    'c.name as class_name',
                    'sc.name as section_name',
                    'sbj.name as subject_name',
                    'acal.teacher_id as assigned_teacher_id',
                    DB::raw("CONCAT(stf.first_name, ' ', stf.last_name) as teacher_name")
                )
                ->join('classes as c', 'cl.class_id', '=', 'c.id')
                ->join('sections as sc', 'cl.section_id', '=', 'sc.id')
                ->join('subjects as sbj', 'cl.subject_id', '=', 'sbj.id')
                ->join('staffs as stf', 'cl.teacher_id', '=', 'stf.id')
                ->leftJoin('calendors as acal', 'cl.id', '=', 'acal.relief_assignment_id')
                ->where([
                    // ['sa.academic_session_id', '=', $request->academic_session_id],
                    ['cl.teacher_id', '=', $request->staff_id]
                ])
                ->whereBetween(DB::raw('date(cl.end)'), [$from_leave, $to_leave])
                // ->where([
                //     [DB::raw('date(cl.end)'), '>=', DB::raw('date(ev.start_date)')],
                //     [DB::raw('date(cl.end)'), '<=', DB::raw('date(ev.end_date)')],
                //     ['ev.holiday', '=', '0']
                // ])
                ->orderBy('cl.start', 'asc')
                ->get()
                ->groupBy('end_date');
            // dd($leave_teacher);
            $output = [];
            // dd($leave_teacher);

            if (!empty($leave_teacher)) {
                foreach ($leave_teacher as $key => $value) {
                    // print_r($key);
                    // $object = new \stdClass();
                    // echo "------";
                    // print_r($value);
                    $subjectArr = [];
                    foreach ($value as $val) {
                        // $reqData->start = $val->start;
                        // $reqData->end = $val->end;
                        // $reqData->academic_session_id = $request->academic_session_id;
                        $request->request->add(['start' => $val->start]); //add request
                        $request->request->add(['end' => $val->end]); //add request
                        $teacherList = $this->getStaffListByTimeslot($request);
                        $val->teacherList = $teacherList;
                        array_push($subjectArr, $val);
                    }
                    $output[$key] = $subjectArr;
                    // $object->$key = $subjectArr;
                    // array_push($output, $object);
                }
            }
            // dd($output);
            // get teacher details
            // $output['teacher'] = $conn->table('subject_assigns as sa')->select(
            //     's.id',
            //     DB::raw('CONCAT(s.first_name, " ", s.last_name) as name')
            // )
            //     ->join('staffs as s', 'sa.teacher_id', '=', 's.id')
            //     // ->where('sa.class_id', $request->class_id)
            //     // ->where('sa.section_id', $request->section_id)
            //     ->where('sa.academic_session_id', $request->academic_session_id)
            //     // type zero mean main
            //     ->where('sa.type', '=', '0')
            //     ->groupBy('sa.teacher_id')
            //     ->get();
            return $this->successResponse($output, 'Staff calendor details fetch successfully');
        }
    }
    public function reliefAssignmentOtherTeacher(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'calendar_id' => 'required',
            'relief_assignment_teacher_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            $getData = $conn->table('calendors as cl')
                ->select(
                    'cl.id',
                    'cl.class_id',
                    'cl.section_id',
                    'cl.subject_id',
                    'cl.sem_id',
                    'cl.session_id',
                    'cl.start',
                    'cl.end',
                    'cl.time_table_id'
                )
                ->where([
                    ['cl.id', '=', $request->calendar_id]
                ])
                ->first();
            // dd($getData->start);
            // dd($getData->end);
            $start_date = date('Y-m-d H:i:s', strtotime($getData->start));
            // $start_date = date('Y-m-d H:i:s', strtotime('2022-09-02 09:00:00'));

            $end_date = date('Y-m-d H:i:s', strtotime($getData->end) - 1);
            // $end_date = date('Y-m-d H:i:s', strtotime('2022-09-02 09:00:00'));
            // dd($start_date);
            $checkStart = $conn->table('calendors as cl')
                ->select(
                    'cl.teacher_id'
                )
                ->where('cl.start', '<=', $start_date)
                ->where('cl.end', '>=', $start_date)
                ->where('cl.teacher_id', '=', $request->relief_assignment_teacher_id)
                ->where('cl.teacher_id', '!=', '')
                ->whereNotNull('cl.relief_assignment_id')
                ->get()->count();
            $checkEnd = $conn->table('calendors as cl')
                ->select(
                    'cl.teacher_id'
                )
                ->where('cl.start', '<=', $end_date)
                ->where('cl.end', '>=', $end_date)
                ->where('cl.teacher_id', '=', $request->relief_assignment_teacher_id)
                ->where('cl.teacher_id', '!=', '')
                ->whereNotNull('cl.relief_assignment_id')
                ->get()->count();
            if (($checkStart > 0) || ($checkEnd > 0)) {
                return $this->send422Error('There are already staff assigned to this time slot', ['error' => 'There are already staff assigned to this time slot']);
            } else {
                // check exist name
                $alreadyAssign = $conn->table('calendors')
                    ->select('id', 'start', 'end')
                    ->where([
                        ['class_id', '=', $getData->class_id],
                        ['section_id', '=', $getData->section_id],
                        ['subject_id', '=', $getData->subject_id],
                        ['sem_id', '=', $getData->sem_id],
                        ['session_id', '=', $getData->session_id],
                        ['start', '=', $getData->start],
                        ['time_table_id', '=', $getData->time_table_id],
                        ['end', '=', $getData->end],
                    ])
                    ->whereNotNull('relief_assignment_id')
                    ->first();
                if (isset($alreadyAssign->id)) {
                    $updata =  [
                        "teacher_id" => $request->relief_assignment_teacher_id,
                        'updated_at' => date("Y-m-d H:i:s")
                    ];
                    $query = $conn->table('calendors')->where('id', $alreadyAssign->id)->update($updata);
                    // send leave notifications
                    $user = User::where('user_id', $request->relief_assignment_teacher_id)->where([
                        ['branch_id', '=', $request->branch_id]
                    ])->where(function ($q) {
                        $q->where('role_id', 2)
                            ->orWhere('role_id', 3)
                            ->orWhere('role_id', 4);
                    })->get();
                    $details = [
                        'branch_id' => $request->branch_id,
                        'staff_id' => $request->relief_assignment_teacher_id,
                        'calendar_id' => $alreadyAssign->id
                    ];
                    // notifications sent
                    Notification::send($user, new ReliefAssignment($details));
                } else {
                    $data =  [
                        "title" => "timetable",
                        "class_id" => $getData->class_id,
                        "section_id" => $getData->section_id,
                        "subject_id" => $getData->subject_id,
                        "sem_id" => $getData->sem_id,
                        "session_id" => $getData->session_id,
                        "start" => $getData->start,
                        "end" => $getData->end,
                        "time_table_id" => $getData->time_table_id,
                        "teacher_id" => $request->relief_assignment_teacher_id,
                        "relief_assignment_id" => $request->calendar_id,
                        'created_at' => date("Y-m-d H:i:s")
                    ];
                    $query = $conn->table('calendors')->insertGetId($data);
                    // send leave notifications
                    $user = User::where('user_id', $request->relief_assignment_teacher_id)->where([
                        ['branch_id', '=', $request->branch_id]
                    ])->where(function ($q) {
                        $q->where('role_id', 2)
                            ->orWhere('role_id', 3)
                            ->orWhere('role_id', 4);
                    })->get();
                    $details = [
                        'branch_id' => $request->branch_id,
                        'staff_id' => $request->relief_assignment_teacher_id,
                        'calendar_id' => $query
                    ];
                    // notifications sent
                    Notification::send($user, new ReliefAssignment($details));
                }
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Relief Assignment Staff has been successfully saved');
                }
            }
        }
    }
    // public function getStaffListByTimeslot(Request $request)
    public function getStaffListByTimeslot(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'academic_session_id' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            $start = date('Y-m-d H:i:s', strtotime($request['start']));
            $end = date('Y-m-d H:i:s', strtotime($request['end']));

            $leave_start = date('Y-m-d', strtotime($request['start']));
            $leave_end = date('Y-m-d', strtotime($request['end']));
            // here we get who taken leaves
            $startLeave = $conn->table('staff_leaves as lev')
                ->select(
                    'lev.staff_id as teacher_id'
                )
                ->where('lev.from_leave', '<=', $leave_start)
                ->where('lev.to_leave', '>=', $leave_start)
                ->where('lev.status', '>=', 'Approve')
                ->groupBy('lev.staff_id')
                ->get()->toArray();
            $endLeave = $conn->table('staff_leaves as lev')
                ->select(
                    'lev.staff_id as teacher_id'
                )
                ->where('lev.from_leave', '<=', $leave_end)
                ->where('lev.to_leave', '>=', $leave_end)
                ->where('lev.status', '>=', 'Approve')
                ->groupBy('lev.staff_id')
                ->get()->toArray();
            $startArray = $conn->table('calendors as cl')
                ->select(
                    'cl.teacher_id'
                )
                ->where('cl.start', '<=', $start)
                ->where('cl.end', '>=', $start)
                ->where('cl.teacher_id', '!=', '')
                ->whereNull('cl.relief_assignment_id')
                ->groupBy('cl.teacher_id')
                ->get()->toArray();
            $endArray = $conn->table('calendors as cl')
                ->select(
                    'cl.teacher_id'
                )
                ->where('cl.start', '<=', $end)
                ->where('cl.end', '>=', $end)
                ->where('cl.teacher_id', '!=', '')
                ->whereNull('cl.relief_assignment_id')
                ->groupBy('cl.teacher_id')
                ->get()->toArray();

            $result = array_merge($startLeave, $endLeave, $startArray, $endArray);
            // get all teacherid by unique
            $result_unique = array_unique($result, SORT_REGULAR);
            // here we get all that time period available teacher
            $idTeachers = array_column($result_unique, 'teacher_id');
            // here we get who is free that time period of teacher
            $all_available_staff = $conn->table('subject_assigns as sa')
                ->select(
                    'stf.id',
                    // DB::raw('CONCAT(stf.first_name, " ", stf.last_name, "(",sdept.name, ")") as teacher_name'),
                    DB::raw('CONCAT(stf.first_name, " ", stf.last_name) as teacher_name'),
                    'sdept.name as department_name'
                )
                ->join('staffs as stf', 'sa.teacher_id', '=', 'stf.id')
                ->leftJoin('staff_departments as sdept', 'stf.department_id', '=', 'sdept.id')
                ->where([
                    ['sa.type', '=', '0'],
                    ['sa.academic_session_id', '=', $request->academic_session_id],
                ])
                ->whereNotIn('sa.teacher_id', $idTeachers)
                ->groupBy('sa.teacher_id')
                ->get();
            return $all_available_staff;
            // return $this->successResponse($all_available_staff, 'Available teacher list');
        }
    }
    public function getCalendarDetailsTimetable(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'calendar_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            $calendors = $conn->table('calendors as cl')
                ->select(
                    'cl.start',
                    'cl.end',
                    'c.name as class_name',
                    'sc.name as section_name',
                    'sbj.name as subject_name'
                    // DB::raw("CONCAT(stf.first_name, ' ', stf.last_name) as teacher_name")
                )
                ->join('classes as c', 'cl.class_id', '=', 'c.id')
                ->join('sections as sc', 'cl.section_id', '=', 'sc.id')
                ->join('subjects as sbj', 'cl.subject_id', '=', 'sbj.id')
                // ->join('staffs as stf', 'cl.teacher_id', '=', 'stf.id')
                ->where('cl.id', '=', $request->calendar_id)
                ->first();
            return $this->successResponse($calendors, 'Available teacher list');
        }
    }
    // soap category add
    public function soapCategoryAdd(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'name' => 'required',
            'soap_type_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($createConnection->table('soap_category')->where([['name', '=', $request->name], ['soap_type_id', '=',  $request->soap_type_id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // insert data
                $query = $createConnection->table('soap_category')->insert([
                    'name' => $request->name,
                    'soap_type_id' => $request->soap_type_id,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Soap Category has been successfully saved');
                }
            }
        }
    }
    // soap category list
    public function soapCategoryList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            $soapCategory = $conn->table('soap_category')
                ->select(
                    'id',
                    'name',
                    'soap_type_id'
                )
                ->get();
            return $this->successResponse($soapCategory, 'Soap category list');
        }
    }
    // soap category row
    public function soapCategoryRow(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'branch_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // get row data
            $sectionDetails = $createConnection->table('soap_category')->where('id', $request->id)->first();
            return $this->successResponse($sectionDetails, 'Soap category row fetch successfully');
        }
    }
    // update soap category
    public function updateSoapCategory(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'soap_type_id' => 'required',
            'id' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $id = $request->id;
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($Connection->table('soap_category')->where([['name', '=', $request->name], ['soap_type_id', '=', $request->soap_type_id], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $Connection->table('soap_category')->where('id', $id)->update([
                    'name' => $request->name,
                    'soap_type_id' => $request->soap_type_id,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Soap Category Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete soap category
    public function deleteSoapCategory(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            $query = $createConnection->table('soap_category')->where('id', $request->id)->delete();
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Soap category have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // soap sub category
    public function soapSubCategory(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'soap_category_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            $soapCategory = $conn->table('soap_sub_category')
                ->select(
                    'id',
                    'name'
                )
                ->where('soap_category_id', $request->soap_category_id)
                ->get();
            return $this->successResponse($soapCategory, 'Soap sub category list');
        }
    }
    // soap filter by notes
    public function soapFilterByNotes(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'soap_sub_category_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            $name = $request->name;
            $soapCategory = $conn->table('soap_notes')
                ->select(
                    'id',
                    'notes'
                )
                ->where('soap_sub_category_id', $request->soap_sub_category_id)
                ->when($name, function ($query, $name) {
                    return $query->where('notes', 'like', '%' . $name . '%');
                })
                ->get();
            return $this->successResponse($soapCategory, 'Soap notes list');
        }
    }
    // soap add
    public function soapAdd(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'soap_notes_id' => 'required',
            'notes' => 'required',
            'soap_category_id' => 'required',
            'soap_sub_category_id' => 'required',
            'referred_by' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            $name = $request->name;
            $data = [
                'soap_notes_id' => $request->soap_notes_id,
                'notes' => $request->notes,
                'soap_category_id' => $request->soap_category_id,
                'soap_sub_category_id' => $request->soap_sub_category_id,
                'referred_by' => $request->referred_by,
                'date' => date('Y-m-d'),
                'created_at' => date("Y-m-d H:i:s")
            ];
            // insert data
            $query = $conn->table('soap')->insert($data);
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Added successfully');
            }
        }
    }
    // soap list
    public function getSoapList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $soapDetails = $conn->table('soap as sp')
                ->select(
                    'sp.id',
                    'sn.notes as soap_notes',
                    'sp.referred_by',
                    'sp.notes',
                    'sp.date'
                )
                ->join('soap_notes as sn', 'sp.soap_notes_id', '=', 'sn.id')
                ->get();
            return $this->successResponse($soapDetails, 'Soap record fetch successfully');
        }
    }
    // get soap row details
    public function getSoapDetails(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $id = $request->id;
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $leaveTypeDetails = $conn->table('soap')->where('id', $id)->first();
            return $this->successResponse($leaveTypeDetails, 'Soap row fetch successfully');
        }
    }
    // update soap
    public function updateSoap(Request $request)
    {
        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'id' => 'required',
            'notes' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);

            // update data
            $updateData = [
                'notes' => $request->notes,
                'updated_at' => date("Y-m-d H:i:s")
            ];
            $query = $conn->table('soap')->where('id', $id)->update($updateData);
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Soap have Been updated');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // delete soap
    public function deleteSoap(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $query = $conn->table('soap')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Soap have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // copy teacher allocations
    public function acdemicCopyAssignTeacher(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'academic_session_id' => 'required',
            'copy_academic_session_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // get acdemic data
            $getAcademicData = $createConnection->table('teacher_allocations')
                ->where(
                    [
                        ['academic_session_id', $request->academic_session_id]
                    ]
                )
                ->get();
            if (count($getAcademicData) > 0) {
                foreach ($getAcademicData as $value) {
                    $old = $createConnection->table('teacher_allocations')
                        ->where(
                            [
                                ['class_id', $value->class_id],
                                ['section_id', $value->section_id],
                                ['teacher_id', $value->teacher_id],
                                ['type', $value->type],
                                ['academic_session_id', $request->copy_academic_session_id]
                            ]
                        )
                        ->first();
                    if (isset($old->id)) {
                        $arrayData = [
                            'updated_at' => date("Y-m-d H:i:s")
                        ];
                        $query = $createConnection->table('teacher_allocations')->where('id', $old->id)->update($arrayData);
                    } else {
                        $arrayData = [
                            'class_id' => $value->class_id,
                            'section_id' => $value->section_id,
                            'teacher_id' => $value->teacher_id,
                            'type' => $value->type,
                            'academic_session_id' => $request->copy_academic_session_id,
                            'created_at' => date("Y-m-d H:i:s")
                        ];
                        $query = $createConnection->table('teacher_allocations')->insert($arrayData);
                    }
                }
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Teacher Allocation has been successfully saved');
                }
            } else {
                return $this->send500Error('No data available', ['error' => 'No data available']);
            }
        }
    }
    // copy class assign 
    public function copyClassAssign(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'academic_session_id' => 'required',
            'copy_academic_session_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // get acdemic data
            $getAcademicData = $createConnection->table('subject_assigns as sa')
                ->where([
                    ['sa.type', '=', '0'],
                    ['sa.academic_session_id', $request->academic_session_id]
                ])
                ->get();
            if (count($getAcademicData) > 0) {
                foreach ($getAcademicData as $value) {
                    $old = $createConnection->table('subject_assigns')
                        ->where(
                            [
                                ['class_id', $value->class_id],
                                ['section_id', $value->section_id],
                                ['subject_id', $value->subject_id],
                                ['type', $value->type],
                                ['academic_session_id', $request->copy_academic_session_id]
                            ]
                        )
                        ->first();
                    if (isset($old->id)) {
                        $arrayData = [
                            'updated_at' => date("Y-m-d H:i:s")
                        ];
                        $query = $createConnection->table('subject_assigns')->where('id', $old->id)->update($arrayData);
                    } else {
                        $arrayData = [
                            'class_id' => $value->class_id,
                            'section_id' => $value->section_id,
                            'subject_id' => $value->subject_id,
                            'teacher_id' => $value->teacher_id,
                            'type' => $value->type,
                            'academic_session_id' => $request->copy_academic_session_id,
                            'created_at' => date("Y-m-d H:i:s")
                        ];
                        $query = $createConnection->table('subject_assigns')->insert($arrayData);
                    }
                }
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Class assign has been successfully saved');
                }
            } else {
                return $this->send500Error('No data available', ['error' => 'No data available']);
            }
        }
    }
    // copy subject teacher assign 
    public function copySubjectTeacherAssign(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'academic_session_id' => 'required',
            'copy_academic_session_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // get acdemic data
            $getAcademicData = $createConnection->table('subject_assigns as sa')
                ->where([
                    ['sa.teacher_id', '!=', '0'],
                    ['sa.academic_session_id', $request->academic_session_id]
                ])
                ->get();
            if (count($getAcademicData) > 0) {
                foreach ($getAcademicData as $value) {
                    $old = $createConnection->table('subject_assigns')
                        ->where(
                            [
                                ['class_id', $value->class_id],
                                ['section_id', $value->section_id],
                                ['subject_id', $value->subject_id],
                                ['teacher_id', $value->teacher_id],
                                ['type', $value->type],
                                ['academic_session_id', $request->copy_academic_session_id]
                            ]
                        )
                        ->first();
                    if (isset($old->id)) {
                        $arrayData = [
                            'updated_at' => date("Y-m-d H:i:s")
                        ];
                        $query = $createConnection->table('subject_assigns')->where('id', $old->id)->update($arrayData);
                    } else {
                        $arrayData = [
                            'class_id' => $value->class_id,
                            'section_id' => $value->section_id,
                            'subject_id' => $value->subject_id,
                            'teacher_id' => $value->teacher_id,
                            'type' => $value->type,
                            'academic_session_id' => $request->copy_academic_session_id,
                            'created_at' => date("Y-m-d H:i:s")
                        ];
                        $query = $createConnection->table('subject_assigns')->insert($arrayData);
                    }
                }
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Teacher assign has been successfully saved');
                }
            } else {
                return $this->send500Error('No data available', ['error' => 'No data available']);
            }
        }
    }
    // exam master exam setup copy
    public function copyExamSetup(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'academic_session_id' => 'required',
            'copy_academic_session_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // get acdemic data
            $getAcademicData = $createConnection->table('exam')
                ->where([
                    ['academic_session_id', $request->academic_session_id]
                ])
                ->get();
            if (count($getAcademicData) > 0) {
                foreach ($getAcademicData as $value) {
                    $old = $createConnection->table('exam')
                        ->where(
                            [
                                ['name', $value->name],
                                ['term_id', $value->term_id],
                                ['academic_session_id', $request->copy_academic_session_id]
                            ]
                        )
                        ->first();
                    if (isset($old->id)) {
                        $arrayData = [
                            'updated_at' => date("Y-m-d H:i:s")
                        ];
                        $query = $createConnection->table('exam')->where('id', $old->id)->update($arrayData);
                    } else {
                        $arrayData = [
                            'name' => $value->name,
                            'term_id' => $value->term_id,
                            'remarks' => $value->remarks,
                            'academic_session_id' => $request->copy_academic_session_id,
                            'created_at' => date("Y-m-d H:i:s")
                        ];
                        $query = $createConnection->table('exam')->insert($arrayData);
                    }
                }
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Exam has been successfully saved');
                }
            } else {
                return $this->send500Error('No data available', ['error' => 'No data available']);
            }
        }
    }
    // exam master exam paper copy
    public function copyExamPaper(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'academic_session_id' => 'required',
            'copy_academic_session_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // get acdemic data
            $getAcademicData = $createConnection->table('exam_papers')
                ->where([
                    ['academic_session_id', $request->academic_session_id]
                ])
                ->get();
            if (count($getAcademicData) > 0) {
                foreach ($getAcademicData as $value) {
                    $old = $createConnection->table('exam_papers')
                        ->where(
                            [
                                ['class_id', $value->class_id],
                                ['subject_id', $value->subject_id],
                                ['paper_name', $value->paper_name],
                                ['paper_type', $value->paper_type],
                                ['grade_category', $value->grade_category],
                                ['subject_weightage', $value->subject_weightage],
                                ['notes', $value->notes],
                                ['academic_session_id', $request->copy_academic_session_id]
                            ]
                        )
                        ->first();
                    if (isset($old->id)) {
                        $arrayData = [
                            'updated_at' => date("Y-m-d H:i:s")
                        ];
                        $query = $createConnection->table('exam_papers')->where('id', $old->id)->update($arrayData);
                    } else {
                        $arrayData = [
                            'class_id' => $value->class_id,
                            'subject_id' => $value->subject_id,
                            'paper_name' => $value->paper_name,
                            'paper_type' => $value->paper_type,
                            'grade_category' => $value->grade_category,
                            'subject_weightage' => $value->subject_weightage,
                            'notes' => $value->notes,
                            'academic_session_id' => $request->copy_academic_session_id,
                            'created_at' => date("Y-m-d H:i:s")
                        ];
                        $query = $createConnection->table('exam_papers')->insert($arrayData);
                    }
                }
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Exam paper has been successfully saved');
                }
            } else {
                return $this->send500Error('No data available', ['error' => 'No data available']);
            }
        }
    }
}
