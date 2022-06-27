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
Route::post('reset_password', [AuthController::class, 'resetPassword']);
Route::post('reset_password_validation', [AuthController::class, 'resetPasswordValidation']);
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
    Route::post('allocate_section/add', [ApiController::class, 'addSectionAllocation']);
    Route::get('allocate_section/list', [ApiController::class, 'getSectionAllocationList']);
    Route::post('allocate_section/section_allocation-details', [ApiController::class, 'getSectionAllocationDetails']);
    Route::post('allocate_section/update', [ApiController::class, 'updateSectionAllocation']);
    Route::post('allocate_section/delete', [ApiController::class, 'deleteSectionAllocation']);

    // TeacherAllocations routes
    Route::post('assign_teacher/add', [ApiController::class, 'addTeacherAllocation']);
    Route::get('assign_teacher/list', [ApiController::class, 'getTeacherAllocationList']);
    Route::post('assign_teacher/assign_teacher-details', [ApiController::class, 'getTeacherAllocationDetails']);
    Route::post('assign_teacher/update', [ApiController::class, 'updateTeacherAllocation']);
    Route::post('assign_teacher/delete', [ApiController::class, 'deleteTeacherAllocation']);
    Route::post('branch-by-assign-teacher', [ApiController::class, 'branchIdByTeacherAllocation']);
    // Add Subjects
    Route::post('subjects/add', [ApiController::class, 'addSubjects']);
    Route::get('subjects/list', [ApiController::class, 'getSubjectsList']);
    Route::post('subjects/subjects-details', [ApiController::class, 'getSubjectsDetails']);
    Route::post('subjects/update', [ApiController::class, 'updateSubjects']);
    Route::post('subjects/delete', [ApiController::class, 'deleteSubjects']);

    // class assign
    Route::post('class_assign/add', [ApiController::class, 'addClassAssign']);
    Route::get('class_assign/list', [ApiController::class, 'getClassAssignList']);
    Route::post('class_assign/class_assign-details', [ApiController::class, 'getClassAssignDetails']);
    Route::post('class_assign/update', [ApiController::class, 'updateClassAssign']);
    Route::post('class_assign/delete', [ApiController::class, 'deleteClassAssign']);

    // Teacher subject assign
    Route::post('teacher_assign/add', [ApiController::class, 'addTeacherSubject']);
    Route::get('teacher_assign/list', [ApiController::class, 'getTeacherListSubject']);
    Route::post('teacher_assign/teacher_assign-details', [ApiController::class, 'getTeacherDetailsSubject']);
    Route::post('teacher_assign/update', [ApiController::class, 'updateTeacherSubject']);
    Route::post('teacher_assign/delete', [ApiController::class, 'deleteTeacherSubject']);
    // get_assign_class_subjects
    Route::post('get_assign_class_subjects', [ApiController::class, 'getAssignClassSubjects']);



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
    Route::get('tot_grade_calcu_byStudent', [ApiController::class, 'totgradeCalcuByStudent']);
    Route::get('tot_grade_calcu_byStdsubjectdiv', [ApiController::class, 'totgradecalcubyStudent_subjectdiv']);
    Route::get('tot_grade_calcu_overall', [ApiController::class, 'tot_grade_calcu_overall']);
    Route::get('tot_grade_master', [ApiController::class, 'totgrademaster']);
    Route::post('all_exams_list', [ApiController::class, 'allexamslist']);
    Route::get('all_std_list', [ApiController::class, 'allstdlist']);
    Route::get('all_bysubject_list', [ApiController::class, 'allbysubjectlist']);
    Route::post('get_grade_bysubject', [ApiController::class, 'getGradebysubject']);
    Route::post('getbyresult', [ApiController::class, 'getbyresult_student']);
    // Event Type routes
    Route::post('event_type/add', [ApiController::class, 'addEventType']);
    Route::get('event_type/list', [ApiController::class, 'getEventTypeList']);
    Route::post('event_type/event_type-details', [ApiController::class, 'getEventTypeDetails']);
    Route::post('event_type/update', [ApiController::class, 'updateEventType']);
    Route::post('event_type/delete', [ApiController::class, 'deleteEventType']);

    // Event routes
    Route::post('event/add', [ApiController::class, 'addEvent']);
    Route::get('event/list', [ApiController::class, 'getEventList']);
    Route::post('event/event-details', [ApiController::class, 'getEventDetails']);
    Route::post('event/update', [ApiController::class, 'updateEventDetails']);
    Route::post('event/delete', [ApiController::class, 'deleteEvent']);
    Route::post('event/publish', [ApiController::class, 'publishEvent']);
    Route::post('branch-by-event', [ApiController::class, 'branchIdByEvent']);
    // qualifications
    Route::post('qualification/add', [ApiController::class, 'add_qualifications']);
    Route::get('qualification/list', [ApiController::class, 'getQualificationsList']);
    Route::post('qualifications/qualifications-details', [ApiController::class, 'getQualifications']);
    Route::post('qualification/update', [ApiController::class, 'updateQualifications']);
    Route::post('qualification/delete', [ApiController::class, 'deleteQualifications']);
    // staff category
    Route::post('staffcategory/add', [ApiController::class, 'add_staffcategory']);
    Route::get('staffcategory/list', [ApiController::class, 'getstaffcategory']);
    Route::post('staffcategory/staffcategory-details', [ApiController::class, 'getstaffcategory_details']);
    Route::post('staffcategory/update', [ApiController::class, 'updatestaffcategory']);
    Route::post('staffcategory/delete', [ApiController::class, 'deletestaffcategory']);
    // department routes
    Route::post('department/add', [ApiController::class, 'addDepartment']);
    Route::get('department/list', [ApiController::class, 'getDepartmentList']);
    Route::post('department/department-details', [ApiController::class, 'getDepartmentDetails']);
    Route::post('department/update', [ApiController::class, 'updateDepartment']);
    Route::post('department/delete', [ApiController::class, 'deleteDepartment']);

    // designations routes
    Route::post('designation/add', [ApiController::class, 'addDesignation']);
    Route::get('designation/list', [ApiController::class, 'getDesignationList']);
    Route::post('designation/designation-details', [ApiController::class, 'getDesignationDetails']);
    Route::post('designation/update', [ApiController::class, 'updateDesignation']);
    Route::post('designation/delete', [ApiController::class, 'deleteDesignation']);

    // staff position routes
    Route::post('staff_position/add', [ApiController::class, 'addStaffPosition']);
    Route::get('staff_position/list', [ApiController::class, 'getStaffPositionList']);
    Route::post('staff_position/staff_position-details', [ApiController::class, 'getStaffPositionDetails']);
    Route::post('staff_position/update', [ApiController::class, 'updateStaffPosition']);
    Route::post('staff_position/delete', [ApiController::class, 'deleteStaffPosition']);

    // Stream Type routes
    Route::post('stream_type/add', [ApiController::class, 'addStreamType']);
    Route::get('stream_type/list', [ApiController::class, 'getStreamTypeList']);
    Route::post('stream_type/stream_type-details', [ApiController::class, 'getStreamTypeDetails']);
    Route::post('stream_type/update', [ApiController::class, 'updateStreamType']);
    Route::post('stream_type/delete', [ApiController::class, 'deleteStreamType']);

    // Religion routes
    Route::post('religion/add', [ApiController::class, 'addReligion']);
    Route::get('religion/list', [ApiController::class, 'getReligionList']);
    Route::post('religion/religion-details', [ApiController::class, 'getReligionDetails']);
    Route::post('religion/update', [ApiController::class, 'updateReligion']);
    Route::post('religion/delete', [ApiController::class, 'deleteReligion']);

    // race routes
    Route::post('race/add', [ApiController::class, 'addRace']);
    Route::get('race/list', [ApiController::class, 'getRaceList']);
    Route::post('race/race-details', [ApiController::class, 'getRaceDetails']);
    Route::post('race/update', [ApiController::class, 'updateRace']);
    Route::post('race/delete', [ApiController::class, 'deleteRace']);

    // Exam Term routes 
    Route::post('exam_term/add', [ApiController::class, 'addExamTerm']);
    Route::get('exam_term/list', [ApiController::class, 'getExamTermList']);
    Route::post('exam_term/exam_term-details', [ApiController::class, 'getExamTermDetails']);
    Route::post('exam_term/update', [ApiController::class, 'updateExamTerm']);
    Route::post('exam_term/delete', [ApiController::class, 'deleteExamTerm']);

    // Exam Hall routes 
    Route::post('exam_hall/add', [ApiController::class, 'addExamHall']);
    Route::get('exam_hall/list', [ApiController::class, 'getExamHallList']);
    Route::post('exam_hall/exam_hall-details', [ApiController::class, 'getExamHallDetails']);
    Route::post('exam_hall/update', [ApiController::class, 'updateExamHall']);
    Route::post('exam_hall/delete', [ApiController::class, 'deleteExamHall']);

    // Exam routes 
    Route::post('exam/add', [ApiController::class, 'addExam']);
    Route::get('exam/list', [ApiController::class, 'getExamList']);
    Route::post('exam/exam-details', [ApiController::class, 'getExamDetails']);
    Route::post('exam/update', [ApiController::class, 'updateExam']);
    Route::post('exam/delete', [ApiController::class, 'deleteExam']);

    // Exam Timetable routes 
    Route::post('exam_timetable/add', [ApiController::class, 'addExamTimetable']);
    Route::post('exam_timetable/list', [ApiController::class, 'listExamTimetable']);
    Route::post('exam_timetable/get', [ApiController::class, 'getExamTimetable']);

    
    Route::get('relation/list', [ApiController::class, 'getRelationList']);
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
    
    // Timetable Bulk
    Route::post('timetable-subject-bulk', [ApiController::class, 'timetableSubjectBulk']);
    Route::post('timetable/add/bulk', [ApiController::class, 'addBulkTimetable']);

    // Grade routes
    Route::post('grade/add', [ApiController::class, 'addGrade']);
    Route::get('grade/list', [ApiController::class, 'getGradeList']);
    Route::post('grade/grade-details', [ApiController::class, 'getGradeDetails']);
    Route::post('grade/update', [ApiController::class, 'updateGrade']);
    Route::post('grade/delete', [ApiController::class, 'deleteGrade']);

    // employee routes
    Route::post('employee/department', [ApiController::class, 'getEmpDepartment']);
    Route::post('employee/designation', [ApiController::class, 'getEmpDesignation']);
    Route::post('employee/add', [ApiController::class, 'addEmployee']);
    Route::get('employee/list', [ApiController::class, 'getEmployeeList']);
    Route::post('employee/employee-details', [ApiController::class, 'getEmployeeDetails']);
    Route::post('employee/update', [ApiController::class, 'updateEmployee']);
    Route::post('employee/delete', [ApiController::class, 'deleteEmployee']);
    // get_qualifications
    Route::get('employee/get_qualifications', [ApiController::class, 'getQualificationsLst']);
    // staff_categories
    Route::get('employee/staff_categories', [ApiController::class, 'staffCategories']);
    // staff_positions
    Route::get('employee/staff_positions', [ApiController::class, 'staffPositions']);
    // stream_types
    Route::get('employee/stream_types', [ApiController::class, 'streamTypes']);
    // stream_types
    Route::get('employee/religion', [ApiController::class, 'getReligion']);
    // stream_types
    Route::get('employee/races', [ApiController::class, 'getRaces']);
    // settings
    Route::post('change-profile-picture', [ApiController::class, 'updatePicture']);
    Route::post('settings/logo', [ApiController::class, 'changeLogo']);
    Route::post('change-password', [ApiController::class, 'changePassword']);
    Route::post('update-profile-info', [ApiController::class, 'updateProfileInfo']);
    // create database_migrate

    Route::post('database_migrate', [CommonController::class, 'databaseMigrate']);
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
    Route::post('forum/createpost', [ApiController::class, 'forumcreatepost']);
    Route::post('forum-likecout', [ApiController::class, 'likescountadded']);
    Route::post('forum-discout', [ApiController::class, 'dislikescountadded']);
    Route::post('forum-heartcout', [ApiController::class, 'heartcountadded']);
    Route::post('forum-viewcout', [ApiController::class, 'viewcountadded']);
    Route::post('forum-viewcout-insert', [ApiController::class, 'viewcountinsert']);
    Route::post('forum-replies-insert', [ApiController::class, 'repliesinsert']);
    Route::post('forum-replikecout', [ApiController::class, 'replikescountadded']);
    Route::post('forum-repdislikecout', [ApiController::class, 'repdislikescountadded']);
    Route::post('forum-repfavorits', [ApiController::class, 'repfavcountadded']);
    Route::post('forum/threads/status/update', [ApiController::class, 'threadstatusupdate']);
    Route::get('forum/usernames/autocomplete', [ApiController::class, 'usernameautocomplete']);
    Route::get('forum/getuserid', [ApiController::class, 'getuserid']);

    // Test Result    
    Route::get('get_testresult_exams', [ApiController::class, 'examslist']);
    Route::get('get_testresult_marks_subject_vs', [ApiController::class, 'subject_vs_marks']);
    Route::post('get_marks_vs_grade', [ApiController::class, 'marks_vs_grade']);
    Route::post('add_student_marks', [ApiController::class, 'addStudentMarks']);
    Route::post('get_subject_division', [ApiController::class, 'getsubjectdivision']);
    Route::post('get_subject_average', [ApiController::class, 'getSubjectAverage']);
    Route::post('add_subject_division', [ApiController::class, 'addsubjectdivision']);
    Route::post('get_student_subject_mark', [ApiController::class, 'getStudentSubjectMark']);
    Route::post('get_student_grade', [ApiController::class, 'getStudentGrade']);
    Route::post('get_subject_division_mark', [ApiController::class, 'getSubDivisionMark']);
    Route::post('get_subject_mark_status', [ApiController::class, 'getSubjectMarkStatus']);
    // classroom management
    Route::post('teacher_class', [ApiController::class, 'getTeachersClassName']);
    Route::post('teacher_section', [ApiController::class, 'getTeachersSectionName']);
    Route::post('teacher_subject', [ApiController::class, 'getTeachersSubjectName']);


    Route::post('timetable/student', [ApiController::class, 'studentTimetable']);
    Route::post('timetable/parent', [ApiController::class, 'parentTimetable']);
    // report card 

    Route::get('get_by_reportcard', [ApiController::class, 'getreportcard']);
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
    Route::post('get_student_attendance', [ApiController::class, 'getStudentAttendence']);
    Route::post('add_student_attendance', [ApiController::class, 'addStudentAttendence']);
    Route::post('get_short_test', [ApiController::class, 'getShortTest']);
    Route::post('add_short_test', [ApiController::class, 'addShortTest']);
    Route::post('add_daily_report', [ApiController::class, 'addDailyReport']);
    Route::post('get_daily_report_remarks', [ApiController::class, 'getDailyReportRemarks']);
    Route::post('add_daily_report_remarks', [ApiController::class, 'addDailyReportRemarks']);
    Route::post('get_classroom_widget_data', [ApiController::class, 'getClassroomWidget']);
    Route::post('add_daily_report_by_student', [ApiController::class, 'addDailyReportByStudent']);

    // get studenet attenedance list
    Route::post('get_attendance_list', [ApiController::class, 'getAttendanceList']);
    Route::post('get_child_subjects', [ApiController::class, 'getChildSubjects']);
    Route::post('get_attendance_list_teacher', [ApiController::class, 'getAttendanceListTeacher']);
    Route::post('get_reasons_by_student', [ApiController::class, 'getReasonsByStudent']);
    // get calendor data by teacher
    Route::get('get_timetable_calendor', [ApiController::class, 'getTimetableCalendor']);
    Route::get('get_event_calendor', [ApiController::class, 'getEventCalendor']);
    Route::get('get_timetable_calendor_student', [ApiController::class, 'getTimetableCalendorStud']);
    Route::get('get_event_calendor_student', [ApiController::class, 'getEventCalendorStud']);
    Route::get('get_event_calendor_admin', [ApiController::class, 'getEventCalendorAdmin']);

    // add timetable schedule
    Route::post('add_calendor_timetable', [ApiController::class, 'addCalendorTimetable']);

    // Hostel routes
    Route::post('hostel/add', [ApiController::class, 'addHostel']);
    Route::get('hostel/list', [ApiController::class, 'getHostelList']);
    Route::post('hostel/hostel-details', [ApiController::class, 'getHostelDetails']);
    Route::post('hostel/update', [ApiController::class, 'updateHostel']);
    Route::post('hostel/delete', [ApiController::class, 'deleteHostel']);


    // Hostel Category routes
    Route::post('hostel_category/add', [ApiController::class, 'addHostelCategory']);
    Route::get('hostel_category/list', [ApiController::class, 'getHostelCategoryList']);
    Route::post('hostel_category/hostel_category-details', [ApiController::class, 'getHostelCategoryDetails']);
    Route::post('hostel_category/update', [ApiController::class, 'updateHostelCategory']);
    Route::post('hostel_category/delete', [ApiController::class, 'deleteHostelCategory']);

    // Hostel Room routes
    Route::post('hostel_room/add', [ApiController::class, 'addHostelRoom']);
    Route::get('hostel_room/list', [ApiController::class, 'getHostelRoomList']);
    Route::post('hostel_room/hostel_room-details', [ApiController::class, 'getHostelRoomDetails']);
    Route::post('hostel_room/update', [ApiController::class, 'updateHostelRoom']);
    Route::post('hostel_room/delete', [ApiController::class, 'deleteHostelRoom']);
    Route::post('vehicle-by-route', [ApiController::class, 'vehicleByRoute']);
    Route::post('room-by-hostel', [ApiController::class, 'roomByHostel']);

    // Admission routes
    Route::post('admission/add', [ApiController::class, 'addAdmission']);

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
    Route::post('admission/add', [ApiController::class, 'addAdmission']);
    Route::post('student/list', [ApiController::class, 'getStudentList']);
    Route::post('student/update', [ApiController::class, 'updateStudent']);
    Route::post('student/student-details', [ApiController::class, 'getStudentDetails']);
    Route::post('student/delete', [ApiController::class, 'deleteStudent']);

    // parent routes
    Route::post('parent/add', [ApiController::class, 'addParent']);
    Route::get('parent/list', [ApiController::class, 'getParentList']);
    Route::post('parent/parent-details', [ApiController::class, 'getParentDetails']);
    Route::get('parent/name', [ApiController::class, 'getParentName']);
    Route::post('parent/update', [ApiController::class, 'updateParent']);
    Route::post('parent/delete', [ApiController::class, 'deleteParent']);
    // get all teacher list
    Route::get('get_all_teacher_list', [ApiController::class, 'getAllTeacherList']);
    Route::get('get_homework_list_dashboard', [ApiController::class, 'getHomeworkListDashboard']);
    Route::post('get_test_score_dashboard', [ApiController::class, 'getTestScoreDashboard']);
    // student leave apply
    Route::get('get_students_parentdashboard', [ApiController::class, 'get_studentsparentdashboard']);
    Route::post('std_leave_apply', [ApiController::class, 'student_leaveapply']);
    Route::get('get_student_leaves', [ApiController::class, 'get_studentleaves']);
    Route::get('get_leave_reasons', [ApiController::class, 'get_leavereasons']);
    Route::post('studentleave_list', [ApiController::class, 'get_particular_studentleave_list']);
    Route::post('std_leave_apply/reupload_file', [ApiController::class, 'reuploadFileStudent']);

    Route::post('teacher_leave_approve', [ApiController::class, 'teacher_leaveapprove']);
    Route::post('get_all_student_leaves', [ApiController::class, 'getAllStudentLeaves']);

    Route::get('get_birthday_calendor_teacher', [ApiController::class, 'getBirthdayCalendorTeacher']);
    Route::get('get_birthday_calendor_admin', [ApiController::class, 'getBirthdayCalendorAdmin']);

    // Leave Type routes
    Route::post('leave_type/add', [ApiController::class, 'addLeaveType']);
    Route::get('leave_type/list', [ApiController::class, 'getLeaveTypeList']);
    Route::post('leave_type/leave_type-details', [ApiController::class, 'getLeaveTypeDetails']);
    Route::post('leave_type/update', [ApiController::class, 'updateLeaveType']);
    Route::post('leave_type/delete', [ApiController::class, 'deleteLeaveType']);

    // Transport Route routes
    Route::post('transport_route/add', [ApiController::class, 'addTransportRoute']);
    Route::get('transport_route/list', [ApiController::class, 'getTransportRouteList']);
    Route::post('transport_route/transport_route-details', [ApiController::class, 'getTransportRouteDetails']);
    Route::post('transport_route/update', [ApiController::class, 'updateTransportRoute']);
    Route::post('transport_route/delete', [ApiController::class, 'deleteTransportRoute']);

    // Transport Stoppage routes
    Route::post('transport_stoppage/add', [ApiController::class, 'addTransportStoppage']);
    Route::get('transport_stoppage/list', [ApiController::class, 'getTransportStoppageList']);
    Route::post('transport_stoppage/transport_stoppage-details', [ApiController::class, 'getTransportStoppageDetails']);
    Route::post('transport_stoppage/update', [ApiController::class, 'updateTransportStoppage']);
    Route::post('transport_stoppage/delete', [ApiController::class, 'deleteTransportStoppage']);
    // staff leave apply
    Route::get('employee-leave/get_leave_types', [ApiController::class, 'getLeaveTypes']);
    Route::post('employee-leave/apply', [ApiController::class, 'staffLeaveApply']);
    Route::post('employee-leave/leave_history', [ApiController::class, 'staffLeaveHistory']);
    Route::get('get_all_staff_details', [ApiController::class, 'getAllStaffDetails']);
    Route::post('employee-leave/approved', [ApiController::class, 'staffLeaveApproved']);
    Route::post('employee-leave/assign_leave_approval', [ApiController::class, 'assignLeaveApproval']);
    Route::post('employee-leave/leave_approval_history_by_staff', [ApiController::class, 'leaveApprovalHistoryByStaff']);
    Route::post('employee-leave/leave_details', [ApiController::class, 'staffLeaveDetails']);
    Route::post('employee-leave/leave_taken_history', [ApiController::class, 'staffLeaveTakenHist']);
    
    //attendance Routes
    Route::get('attendance/employee_list', [ApiController::class, 'getEmployeeAttendanceList']);
    Route::post('attendance/employee_add', [ApiController::class, 'addEmployeeAttendance']);
    Route::post('attendance/employee_report', [ApiController::class, 'getEmployeeAttendanceReport']);
    // add-task-calendor
    Route::post('calendor/add-task-calendor', [ApiController::class, 'calendorAddTask']);
    Route::get('calendor/list-task-calendor', [ApiController::class, 'calendorListTask']);
    
    // Education routes
    Route::post('education/add', [ApiController::class, 'addEducation']);
    Route::get('education/list', [ApiController::class, 'getEducationList']);
    Route::post('education/education-details', [ApiController::class, 'getEducationDetails']);
    Route::post('education/update', [ApiController::class, 'updateEducation']);
    Route::post('education/delete', [ApiController::class, 'deleteEducation']);

    
    Route::post('employee_by_department', [ApiController::class, 'getEmployeeByDepartment']);
    // analytics routes
    Route::post('get_student_list/by_class_section', [ApiController::class, 'getStudListByClassSec']);
    Route::post('get_attendance_late_graph', [ApiController::class, 'getAttendanceReportGraph']);
    Route::post('get_homework_graph_by_student', [ApiController::class, 'viewHomeworkGraphByStudent']);
    Route::post('get_attitude_graph_by_student', [ApiController::class, 'getAttitudeGraphByStudent']);
    Route::post('get_short_test_by_student', [ApiController::class, 'getShortTestByStudent']);
    Route::post('get_subject_average_by_student', [ApiController::class, 'getSubjectAverageByStudent']);
    Route::post('get_exam_marks_by_student', [ApiController::class, 'getExamMarksByStudent']);
    Route::post('get_student_by_all_subjects', [ApiController::class, 'getStudentByAllSubjects']);
    Route::post('get_class_section_by_student', [ApiController::class, 'getClassSectionByStudent']);
    
});
