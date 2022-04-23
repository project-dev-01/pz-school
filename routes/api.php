<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommonController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'authenticate']);
Route::get('get-countries', [CommonController::class, 'countryList']);
Route::post('get-states', [CommonController::class, 'getStateByIdList']);
Route::post('get-cities', [CommonController::class, 'getCityByIdList']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('get_user', [AuthController::class, 'get_user']);

    // section routes
    Route::post('section/add', [ApiController::class, 'addSection']);
    Route::get('section/list', [ApiController::class, 'getSectionList']);
    Route::post('section/section-details', [ApiController::class, 'getSectionDetails']);
    Route::post('section/update', [ApiController::class, 'updateSectionDetails']);
    Route::post('section/delete', [ApiController::class, 'deleteSection']);

    // branch routes
    Route::post('branch/add', [ApiController::class, 'addBranch']);
    Route::get('branch/list', [ApiController::class, 'getBranchList']);
    Route::post('branch/branch-details', [ApiController::class, 'getBranchDetails']);
    Route::post('branch/update', [ApiController::class, 'updateBranchDetails']);
    Route::post('branch/delete', [ApiController::class, 'deleteBranch']);

    // Class routes
    Route::post('classes/add', [ApiController::class, 'addClass']);
    Route::get('classes/list', [ApiController::class, 'getClassList']);
    Route::post('classes/class-details', [ApiController::class, 'getClassDetails']);
    Route::post('classes/update', [ApiController::class, 'updateClassDetails']);
    Route::post('classes/delete', [ApiController::class, 'deleteClass']);

    Route::post('teacher/class_list', [ApiController::class, 'teacherClassList']);
    
    // sections allocations routes
    Route::post('allocate_section/add',[ApiController::class,'addSectionAllocation']);
    Route::get('allocate_section/list', [ApiController::class, 'getSectionAllocationList']);
    Route::post('allocate_section/section_allocation-details',[ApiController::class, 'getSectionAllocationDetails']);
    Route::post('allocate_section/update',[ApiController::class, 'updateSectionAllocation']);
    Route::post('allocate_section/delete', [ApiController::class, 'deleteSectionAllocation']);

    // TeacherAllocations routes
    Route::post('assign_teacher/add',[ApiController::class,'addTeacherAllocation']);
    Route::get('assign_teacher/list', [ApiController::class, 'getTeacherAllocationList']);
    Route::post('assign_teacher/assign_teacher-details', [ApiController::class, 'getTeacherAllocationDetails']);
    Route::post('assign_teacher/update', [ApiController::class, 'updateTeacherAllocation']);
    Route::post('assign_teacher/delete', [ApiController::class, 'deleteTeacherAllocation']);
    Route::post('branch-by-assign-teacher', [ApiController::class, 'branchIdByTeacherAllocation']);
    // Add Subjects
    Route::post('subjects/add',[ApiController::class,'addSubjects']);
    Route::get('subjects/list', [ApiController::class, 'getSubjectsList']);
    Route::post('subjects/subjects-details',[ApiController::class, 'getSubjectsDetails']);
    Route::post('subjects/update',[ApiController::class, 'updateSubjects']);
    Route::post('subjects/delete', [ApiController::class, 'deleteSubjects']);

    // class assign
    Route::post('class_assign/add',[ApiController::class,'addClassAssign']);
    Route::get('class_assign/list', [ApiController::class, 'getClassAssignList']);
    Route::post('class_assign/class_assign-details',[ApiController::class, 'getClassAssignDetails']);
    Route::post('class_assign/update',[ApiController::class, 'updateClassAssign']);
    Route::post('class_assign/delete',[ApiController::class, 'deleteClassAssign']);

    // Teacher subject assign
    Route::post('teacher_assign/add',[ApiController::class,'addTeacherSubject']);
    Route::get('teacher_assign/list', [ApiController::class, 'getTeacherListSubject']);
    Route::post('teacher_assign/teacher_assign-details',[ApiController::class, 'getTeacherDetailsSubject']);
    Route::post('teacher_assign/update',[ApiController::class, 'updateTeacherSubject']);
    Route::post('teacher_assign/delete',[ApiController::class, 'deleteTeacherSubject']);
    

    // branch id by class
    Route::post('branch-by-class', [ApiController::class, 'branchIdByClass']);
    Route::post('branch-by-section', [ApiController::class, 'branchIdBySection']);
    Route::post('section-by-class', [ApiController::class, 'sectionByClass']);
    Route::post('subject-by-class', [ApiController::class, 'subjectByClass']);
    Route::post('timetable-subject', [ApiController::class, 'timetableSubject']);
    Route::get('exam-by-classSection', [ApiController::class, 'examByClassSec']);
    Route::get('exam-by-classSubject', [ApiController::class, 'examByClassSubject']);
    Route::get('tot_grade_calcu_byclass', [ApiController::class, 'totgradeCalcuByClass']);
    Route::get('tot_grade_calcu_bySubject', [ApiController::class, 'totgradeCalcuBySubject']);
    Route::get('tot_grade_master', [ApiController::class, 'totgrademaster']);
    Route::post('all_exams_list', [ApiController::class, 'allexamslist']);
    Route::get('all_std_list', [ApiController::class, 'allstdlist']);
    Route::get('all_bysubject_list', [ApiController::class, 'allbysubjectlist']);
    Route::post('get_grade_bysubject', [ApiController::class, 'getGradebysubject']);
    // Event Type routes
    Route::post('event_type/add', [ApiController::class, 'addEventType']);
    Route::get('event_type/list', [ApiController::class, 'getEventTypeList']);
    Route::post('event_type/event_type-details', [ApiController::class, 'getEventTypeDetails']);
    Route::post('event_type/update', [ApiController::class, 'updateEventTypeDetails']);
    Route::post('event_type/delete', [ApiController::class, 'deleteEventType']);

    // Event routes
    Route::post('event/add', [ApiController::class, 'addEvent']);
    Route::get('event/list', [ApiController::class, 'getEventList']);
    Route::post('event/event-details', [ApiController::class, 'getEventDetails']);
    Route::post('event/update', [ApiController::class, 'updateEventDetails']);
    Route::post('event/delete', [ApiController::class, 'deleteEvent']);
    Route::post('event/publish', [ApiController::class, 'publishEvent']);
    Route::post('branch-by-event', [ApiController::class, 'branchIdByEvent']);

    // department routes
    Route::post('department/add',[ApiController::class,'addDepartment']);
    Route::get('department/list', [ApiController::class, 'getDepartmentList']);
    Route::post('department/department-details', [ApiController::class, 'getDepartmentDetails']);
    Route::post('department/update', [ApiController::class, 'updateDepartment']);
    Route::post('department/delete', [ApiController::class, 'deleteDepartment']);

    // designations routes
    Route::post('designation/add',[ApiController::class,'addDesignation']);
    Route::get('designation/list', [ApiController::class, 'getDesignationList']);
    Route::post('designation/designation-details', [ApiController::class, 'getDesignationDetails']);
    Route::post('designation/update', [ApiController::class, 'updateDesignation']);
    Route::post('designation/delete', [ApiController::class, 'deleteDesignation']);

    // Exam Term routes 
    Route::post('exam_term/add',[ApiController::class,'addExamTerm']);
    Route::get('exam_term/list', [ApiController::class, 'getExamTermList']);
    Route::post('exam_term/exam_term-details', [ApiController::class, 'getExamTermDetails']);
    Route::post('exam_term/update', [ApiController::class, 'updateExamTerm']);
    Route::post('exam_term/delete', [ApiController::class, 'deleteExamTerm']);

    // Exam Hall routes 
    Route::post('exam_hall/add',[ApiController::class,'addExamHall']);
    Route::get('exam_hall/list', [ApiController::class, 'getExamHallList']);
    Route::post('exam_hall/exam_hall-details', [ApiController::class, 'getExamHallDetails']);
    Route::post('exam_hall/update', [ApiController::class, 'updateExamHall']);
    Route::post('exam_hall/delete', [ApiController::class, 'deleteExamHall']);

    // Exam routes 
    Route::post('exam/add',[ApiController::class,'addExam']);
    Route::get('exam/list', [ApiController::class, 'getExamList']);
    Route::post('exam/exam-details', [ApiController::class, 'getExamDetails']);
    Route::post('exam/update', [ApiController::class, 'updateExam']);
    Route::post('exam/delete', [ApiController::class, 'deleteExam']);

    // Exam Timetable routes 
    Route::post('exam_timetable/add',[ApiController::class,'addExamTimetable']);
    Route::post('exam_timetable/list', [ApiController::class, 'listExamTimetable']);
    Route::post('exam_timetable/get', [ApiController::class, 'getExamTimetable']);

    // get roles
    Route::post('roles/list', [ApiController::class, 'getRoles']);

    //get Semester
    Route::get('semester/list', [ApiController::class, 'getSemesterList']);

    //get Session
    Route::get('session/list', [ApiController::class, 'getSessionList']);
    
     // Timetable
     Route::post('timetable/add', [ApiController::class, 'addTimetable']);
     Route::post('timetable/list', [ApiController::class, 'getTimetableList']);
     Route::post('timetable/edit', [ApiController::class, 'editTimetable']);
     Route::post('timetable/update', [ApiController::class, 'updateTimetable']);
     
    // Grade routes
    Route::post('grade/add',[ApiController::class,'addGrade']);
    Route::get('grade/list', [ApiController::class, 'getGradeList']);
    Route::post('grade/grade-details', [ApiController::class, 'getGradeDetails']);
    Route::post('grade/update', [ApiController::class, 'updateGrade']);
    Route::post('grade/delete', [ApiController::class, 'deleteGrade']);

    // employee routes
    Route::post('employee/department', [ApiController::class, 'getEmpDepartment']);
    Route::post('employee/designation', [ApiController::class, 'getEmpDesignation']);
    Route::post('employee/add',[ApiController::class,'addEmployee']);
    Route::get('employee/list', [ApiController::class, 'getEmployeeList']);
    Route::post('employee/employee-details', [ApiController::class, 'getEmployeeDetails']);
    Route::post('employee/update', [ApiController::class, 'updateEmployee']);
    Route::post('employee/delete', [ApiController::class, 'deleteEmployee']);
    // settings
    Route::post('change-profile-picture',[ApiController::class,'updatePicture']);
    Route::post('change-password',[ApiController::class,'changePassword']);
    Route::post('update-profile-info',[ApiController::class,'updateProfileInfo']);
    // create database_migrate
    
    Route::post('database_migrate',[CommonController::class,'databaseMigrate']);
    // forum     
    Route::get('get-category', [CommonController::class, 'categoryList']);
    Route::get('get-dbnames', [CommonController::class, 'dbnameslist']);
    Route::post('get-branchid', [ApiController::class, 'schoolvsbranchid']);
    Route::get('forum/list', [ApiController::class, 'postList']);
    Route::get('forum/threadslist', [ApiController::class, 'ThreadspostList']);
    Route::get('forum/userthreadslist', [ApiController::class, 'userThreadspostList']);
    Route::get('forum/listcategory', [ApiController::class, 'postListCategory']);
    Route::get('forum/adminlistcategoryvs', [ApiController::class, 'adminpostListCategory']);
    Route::get('forum/singlepost', [ApiController::class, 'singlePost']);
    Route::get('forum/singlecateg', [ApiController::class, 'singleCategoryPosts']);
    Route::get('forum/usersinglecateg', [ApiController::class, 'user_singleCategoryPosts']);
    Route::get('forum/postlistusercreated', [ApiController::class, 'postListUserCreatedOnly']);
    Route::get('forum/listcategoryusercrd', [ApiController::class, 'categorypostListUserCreatedOnly']);
    Route::get('forum/singlepost/replies', [ApiController::class, 'singlePostReplies']);
    Route::get('forum/post/allreplies', [ApiController::class, 'PostAllReplies']);
    Route::post('forum/createpost',[ApiController::class,'forumcreatepost']);
    Route::post('forum-likecout',[ApiController::class,'likescountadded']);
    Route::post('forum-discout',[ApiController::class,'dislikescountadded']);
    Route::post('forum-heartcout',[ApiController::class,'heartcountadded']);
    Route::post('forum-viewcout',[ApiController::class,'viewcountadded']);
    Route::post('forum-viewcout-insert',[ApiController::class,'viewcountinsert']);
    Route::post('forum-replies-insert',[ApiController::class,'repliesinsert']);   
    Route::post('forum-replikecout',[ApiController::class,'replikescountadded']);  
    Route::post('forum-repdislikecout',[ApiController::class,'repdislikescountadded']);  
    Route::post('forum-repfavorits',[ApiController::class,'repfavcountadded']);
    Route::post('forum/threads/status/update',[ApiController::class,'threadstatusupdate']);
    Route::get('forum/usernames/autocomplete',[ApiController::class,'usernameautocomplete']);
    Route::get('forum/getuserid',[ApiController::class,'getuserid']);
    
    // Test Result    
    Route::get('get_testresult_exams',[ApiController::class,'examslist']);
    Route::get('get_testresult_marks_subject_vs',[ApiController::class,'subject_vs_marks']);
    Route::post('get_marks_vs_grade',[ApiController::class,'marks_vs_grade']);
    Route::post('add_student_marks',[ApiController::class,'addStudentMarks']);
    Route::post('get_subject_division',[ApiController::class,'getsubjectdivision']);
    Route::post('get_subject_average',[ApiController::class,'getSubjectAverage']);
    Route::post('add_subject_division',[ApiController::class,'addsubjectdivision']);
    Route::post('get_student_subject_mark',[ApiController::class,'getStudentSubjectMark']);
    Route::post('get_student_grade',[ApiController::class,'getStudentGrade']);
    Route::post('get_subject_division_mark',[ApiController::class,'getSubDivisionMark']);
    Route::post('get_subject_mark_status',[ApiController::class,'getSubjectMarkStatus']);
    // classroom management
    Route::post('teacher_class',[ApiController::class,'getTeachersClassName']);
    Route::post('teacher_section',[ApiController::class,'getTeachersSectionName']);
    Route::post('teacher_subject',[ApiController::class,'getTeachersSubjectName']);

    
    Route::post('timetable/student', [ApiController::class, 'studentTimetable']);
    Route::post('timetable/parent', [ApiController::class, 'parentTimetable']);
     
    // Homework routes
    Route::post('homework/add', [ApiController::class, 'addHomework']);
    Route::post('homework/list', [ApiController::class, 'getHomeworkList']);
    Route::post('homework/view', [ApiController::class, 'viewHomework']);
    Route::post('homework/homework-details', [ApiController::class, 'getHomeworkDetails']);

    Route::post('homework/evaluate', [ApiController::class, 'evaluateHomework']);
    Route::post('homework/submit', [ApiController::class, 'submitHomework']);
    Route::post('homework/student', [ApiController::class, 'studentHomework']);
    Route::post('homework/student/filter', [ApiController::class, 'studentHomeworkFilter']);

    //  getStudentAttendence
    Route::post('get_student_attendance',[ApiController::class,'getStudentAttendence']);
    Route::post('add_student_attendance',[ApiController::class,'addStudentAttendence']);
    Route::post('get_short_test',[ApiController::class,'getShortTest']);
    Route::post('add_short_test',[ApiController::class,'addShortTest']);
    Route::post('add_daily_report',[ApiController::class,'addDailyReport']);
    Route::post('get_daily_report_remarks',[ApiController::class,'getDailyReportRemarks']);
    Route::post('add_daily_report_remarks',[ApiController::class,'addDailyReportRemarks']);
    Route::post('get_classroom_widget_data',[ApiController::class,'getClassroomWidget']);
    Route::post('add_daily_report_by_student',[ApiController::class,'addDailyReportByStudent']);
    
    // get studenet attenedance list
    Route::post('get_attendance_list',[ApiController::class,'getAttendanceList']);
    Route::post('get_child_subjects',[ApiController::class,'getChildSubjects']);
    Route::post('get_attendance_list_teacher',[ApiController::class,'getAttendanceListTeacher']);
    Route::post('get_reasons_by_student',[ApiController::class,'getReasonsByStudent']);
    // get calendor data by teacher
    Route::get('get_timetable_calendor',[ApiController::class,'getTimetableCalendor']);
    Route::get('get_timetable_calendor_student',[ApiController::class,'getTimetableCalendorStud']);
    
    // add timetable schedule
    Route::post('add_calendor_timetable',[ApiController::class,'addCalendorTimetable']);

    
    Route::get('transport/list', [ApiController::class, 'getTransportList']);
    
    Route::get('hostel/list', [ApiController::class, 'getHostelList']);

    
    Route::post('vehicle-by-route', [ApiController::class, 'vehicleByRoute']);
    Route::post('room-by-hostel', [ApiController::class, 'roomByHostel']);

    // Admission routes
    Route::post('admission/add',[ApiController::class,'addAdmission']);

    // Techer list by class and section routes
    Route::post('teacher/list', [ApiController::class, 'getTeacherList']);
    // add to do list
    Route::post('add_to_do_list', [ApiController::class, 'addToDoList']);
    Route::get('get_to_do_list', [ApiController::class, 'getToDoList']);
    Route::post('get_to_do_row', [ApiController::class, 'getToDoListRow']);
    Route::post('delete_to_do_list', [ApiController::class, 'deleteToDoList']);
    Route::get('get_to_do_list_dashboard', [ApiController::class, 'getToDoListDashboard']);
    Route::post('read_update_todo', [ApiController::class, 'readUpdateTodo']);
    Route::post('get_assign_class', [ApiController::class, 'getAssignClass']);
    Route::post('to_do_comments', [ApiController::class, 'toDoComments']);
    Route::get('get_to_do_teacher', [ApiController::class, 'getToDoTeacher']);

    // Student routes
    Route::post('admission/add',[ApiController::class,'addAdmission']);
    Route::post('student/list', [ApiController::class, 'getStudentList']);
    Route::post('student/update',[ApiController::class,'updateStudent']);
    Route::post('student/student-details', [ApiController::class, 'getStudentDetails']);
    Route::post('student/delete', [ApiController::class, 'deleteStudent']);

    // parent routes
    Route::post('parent/add',[ApiController::class,'addParent']);
    Route::get('parent/list', [ApiController::class, 'getParentList']);
    Route::post('parent/parent-details', [ApiController::class, 'getParentDetails']);
    Route::post('parent/update', [ApiController::class, 'updateParent']);
    Route::post('parent/delete', [ApiController::class, 'deleteParent']);
});
