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
}
