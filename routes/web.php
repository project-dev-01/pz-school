<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CommonController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });
// Route::get('/login', function () {
//     return view('auth.login');
// });
Route::get('/', function () {
    return redirect(route('super_admin.login'));
});
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'syscont', 'namespace' => 'Super Admin'], function () {

    // Route::get('login', 'AuthController@login');
    // Route::get('logout', 'AuthController@logout');
    Route::get('/login', [AuthController::class, 'showLoginFormSA'])->name('super_admin.login');
    Route::post('/authenticate', [AuthController::class, 'authenticateSA'])->name('super_admin.authenticate');
    Route::post('/logout', [AuthController::class, 'logoutSA'])->name('super_admin.logout');

    Route::group(['middleware' => ['isSuperAdmin']], function () {

        // dashboard routes
        Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('super_admin.dashboard');
        // student details
        Route::get('/student', [SuperAdminController::class, 'studentIndex'])->name('student.index');
        
        // section routes
        Route::get('section/index', [SuperAdminController::class, 'section'])->name('super_admin.section');
        Route::post('section/add', [SuperAdminController::class, 'addSection'])->name('section.add');
        Route::get('section/list', [SuperAdminController::class, 'getSectionList'])->name('super_admin.section.list');
        Route::post('section/section-details', [SuperAdminController::class, 'getSectionDetails'])->name('section.details');
        Route::post('section/update', [SuperAdminController::class, 'updateSectionDetails'])->name('section.update');
        Route::post('section/delete', [SuperAdminController::class, 'deleteSection'])->name('section.delete');

        // branch routes
        Route::get('branch/index', [SuperAdminController::class, 'branchIndex'])->name('branch.index');
        Route::get('branch/create', [SuperAdminController::class, 'branchCreate'])->name('branch.create');
        Route::post('branch/add', [SuperAdminController::class, 'addBranch'])->name('branch.add');
        Route::get('branch/list', [SuperAdminController::class, 'getBranchList'])->name('branch.list');
        Route::get('branch/edit/{id}', [SuperAdminController::class, 'getEditDetails'])->name('branch.edit');
        Route::post('branch/update', [SuperAdminController::class, 'updateBranchDetails'])->name('branch.update');
        Route::post('branch/delete', [SuperAdminController::class, 'deleteBranch'])->name('branch.delete');

        // Class routes
        Route::get('class/index', [SuperAdminController::class, 'class'])->name('super_admin.class');
        Route::post('class/add', [SuperAdminController::class, 'addClass'])->name('class.add');
        Route::get('class/list', [SuperAdminController::class, 'getClassList'])->name('class.list');
        Route::post('class/class-details', [SuperAdminController::class, 'getClassDetails'])->name('class.details');
        Route::post('class/update', [SuperAdminController::class, 'updateClassDetails'])->name('class.update');
        Route::post('class/delete', [SuperAdminController::class, 'deleteClass'])->name('class.delete');

        // sections allocations routes
        Route::get('allocate_section/index', [SuperAdminController::class, 'showSectionAllocation'])->name('super_admin.section_allocation');
        Route::post('allocate_section/add', [SuperAdminController::class, 'addSectionAllocation'])->name('section_allocation.add');
        Route::get('allocate_section/list', [SuperAdminController::class, 'getSectionAllocationList'])->name('super_admin.section_allocation.list');
        Route::post('allocate_section/section_allocation-details', [SuperAdminController::class, 'getSectionAllocationDetails'])->name('section_allocation.details');
        Route::post('allocate_section/update', [SuperAdminController::class, 'updateSectionAllocation'])->name('section_allocation.update');
        Route::post('allocate_section/delete', [SuperAdminController::class, 'deleteSectionAllocation'])->name('section_allocation.delete');

        // assign_teacher routes
        Route::get('assign_teacher/index', [SuperAdminController::class, 'showTeacherAllocation'])->name('super_admin.assign_teacher');
        Route::post('assign_teacher/get_allocation_section', [SuperAdminController::class, 'getAllocationSection'])->name('assign_teacher.get_allocation_section');
        Route::post('assign_teacher/add', [SuperAdminController::class, 'addTeacherAllocation'])->name('assign_teacher.add');
        Route::get('assign_teacher/list', [SuperAdminController::class, 'getTeacherAllocationList'])->name('super_admin.assign_teacher.list');
        Route::post('assign_teacher/details', [SuperAdminController::class, 'getTeacherAllocationDetails'])->name('assign_teacher.details');
        Route::post('assign_teacher/update', [SuperAdminController::class, 'updateTeacherAllocation'])->name('assign_teacher.update');
        Route::post('assign_teacher/delete', [SuperAdminController::class, 'deleteTeacherAllocation'])->name('assign_teacher.delete');

        // Event Type routes
        Route::get('event_type/index', [SuperAdminController::class, 'eventType'])->name('super_admin.event_type');
        Route::get('event_type/list', [SuperAdminController::class, 'getEventTypeList'])->name('super_admin.event_type.list');
        Route::post('event_type/add', [SuperAdminController::class, 'addEventType'])->name('event_type.add');
        Route::post('event_type/event_type-details', [SuperAdminController::class, 'getEventTypeDetails'])->name('event_type.details');
        Route::post('event_type/update', [SuperAdminController::class, 'updateEventTypeDetails'])->name('event_type.update');
        Route::post('event_type/delete', [SuperAdminController::class, 'deleteEventType'])->name('event_type.delete');


        // Event routes
        Route::get('event/index', [SuperAdminController::class, 'event'])->name('super_admin.event');
        Route::get('event/list', [SuperAdminController::class, 'getEventList'])->name('super_admin.event.list');
        Route::post('event/add', [SuperAdminController::class, 'addEvent'])->name('event.add');
        Route::post('event/event-details', [SuperAdminController::class, 'getEventDetails'])->name('event.details');
        Route::post('event/delete', [SuperAdminController::class, 'deleteEvent'])->name('event.delete');
        Route::post('event/event-publish', [SuperAdminController::class, 'publishEvent'])->name('event.publish');

        // department routes
        Route::get('department/index', [SuperAdminController::class, 'Department'])->name('super_admin.department');
        Route::post('department/add', [SuperAdminController::class, 'addDepartment'])->name('department.add');
        Route::get('department/list', [SuperAdminController::class, 'getDepartmentList'])->name('department.list');
        Route::post('department/department-details', [SuperAdminController::class, 'getDepartmentDetails'])->name('department.details');
        Route::post('department/update', [SuperAdminController::class, 'updateDepartment'])->name('department.update');
        Route::post('department/delete', [SuperAdminController::class, 'deleteDepartment'])->name('department.delete');

        // designation routes
        Route::get('designation/index', [SuperAdminController::class, 'Designation'])->name('super_admin.designation');
        Route::post('designation/add', [SuperAdminController::class, 'addDesignation'])->name('designation.add');
        Route::get('designation/list', [SuperAdminController::class, 'getDesignationList'])->name('designation.list');
        Route::post('designation/designation-details', [SuperAdminController::class, 'getDesignationDetails'])->name('designation.details');
        Route::post('designation/update', [SuperAdminController::class, 'updateDesignation'])->name('designation.update');
        Route::post('designation/delete', [SuperAdminController::class, 'deleteDesignation'])->name('designation.delete');


        // Employee routes
    
        Route::get('employee/employeelist', [SuperAdminController::class, 'listEmployee'])->name('super_admin.listemployee');
        Route::get('employee/index', [SuperAdminController::class, 'showEmployee'])->name('super_admin.employee');
        Route::post('employee/add', [SuperAdminController::class, 'addEmployee'])->name('employee.add');
        Route::get('employee/list', [SuperAdminController::class, 'getEmployeeList'])->name('employee.list');

        // Settings
        Route::get('settings', [SuperAdminController::class, 'settings'])->name('super_admin.settings');
        Route::post('change-password', [SuperAdminController::class, 'changePassword'])->name('settings.changePassword');
        Route::post('update-profile-info', [SuperAdminController::class, 'updateProfileInfo'])->name('settings.updateProfileInfo');
        Route::post('update-setting-session', [CommonController::class, 'updateSettingSession'])->name('settings.updateSettingSession');

        // static page routes start

        // Admission routes
        Route::get('admission/index', [SuperAdminController::class, 'admission'])->name('super_admin.admission');
        Route::get('admission/import', [SuperAdminController::class, 'import'])->name('admin.admission.import');

        // Parent routes
        Route::get('parent/index', [SuperAdminController::class, 'parent'])->name('super_admin.parent');

        // Homework routes
        Route::get('homework/index', [SuperAdminController::class, 'homework'])->name('super_admin.homework');

        // exam routes
        Route::get('exam/term', [SuperAdminController::class, 'examIndex'])->name('exam.term');
        Route::get('exam/hall', [SuperAdminController::class, 'examHall'])->name('exam.hall');
        Route::get('exam/mark_distribution', [SuperAdminController::class, 'examMarkDistribution'])->name('exam.mark_distribution');
        Route::get('exam/exam', [SuperAdminController::class, 'exam'])->name('exam.exam');

        //Task routes
        Route::get('task/index', [SuperAdminController::class, 'taskIndex'])->name('super_admin.task');

        // Hostel routes
        Route::get('hostel/index', [SuperAdminController::class, 'hostel'])->name('super_admin.hostel');
        Route::get('hostel/category', [SuperAdminController::class, 'getCategory'])->name('hostel.category');
        Route::get('hostel/room', [SuperAdminController::class, 'getRoom'])->name('hostel.room');

       // Transport routes
       Route::get('transport/route', [SuperAdminController::class, 'getRoute'])->name('transport.route');
       Route::get('transport/vehicle', [SuperAdminController::class, 'getVehicle'])->name('transport.vehicle');
       Route::get('transport/stoppage', [SuperAdminController::class, 'getstoppage'])->name('transport.stoppage');
       Route::get('transport/assignvehicle', [SuperAdminController::class, 'assignVehicle'])->name('transport.assignvehicle');

       // Library routes
       Route::get('library/book', [SuperAdminController::class, 'book'])->name('library.book');
       Route::get('library/book/category', [SuperAdminController::class, 'bookCategory'])->name('library.bookcategory');
       Route::get('library/issued_book', [SuperAdminController::class, 'issuedBook'])->name('library.issuedbook');
       Route::get('library/issue_return', [SuperAdminController::class, 'issueReturn'])->name('library.issuereturn');

       Route::get('classes/add_class', [SuperAdminController::class, 'addClasses'])->name('super_admin.add_classes');

        // userlist routes
        Route::get('users/user', [SuperAdminController::class, 'users'])->name('users.user');
        Route::get('users/add', [SuperAdminController::class, 'addUsers'])->name('users.add');
        Route::post('users/add_user', [SuperAdminController::class, 'addRoleUser'])->name('users.add_role_user');
        Route::get('users/edit/{id}', [SuperAdminController::class, 'editUser'])->name('users.edit');
        Route::get('users/user_list', [SuperAdminController::class, 'getUserList'])->name('users.user_list');
        Route::post('users/delete', [SuperAdminController::class, 'deleteUser'])->name('users.delete');
        // Forum routes
        Route::get('forum/index', [SuperAdminController::class, 'forumIndex'])->name('super_admin.forum.index');
        Route::get('forum/page-single-topic', [SuperAdminController::class, 'forumPageSingleTopic'])->name('super_admin.forum.page-single-topic');
        Route::get('forum/page-create-topic', [SuperAdminController::class, 'forumPageCreateTopic'])->name('super_admin.forum.page-create-topic');
        Route::get('forum/page-single-user', [SuperAdminController::class, 'forumPageSingleUser'])->name('super_admin.forum.page-single-user');
        Route::get('forum/page-single-threads', [SuperAdminController::class, 'forumPageSingleThreads'])->name('super_admin.forum.page-single-threads');
        Route::get('forum/page-single-replies', [SuperAdminController::class, 'forumPageSingleReplies'])->name('super_admin.forum.page-single-replies');
        Route::get('forum/page-single-followers', [SuperAdminController::class, 'forumPageSingleFollowers'])->name('super_admin.forum.page-single-followers');
        Route::get('forum/page-single-categories', [SuperAdminController::class, 'forumPageSingleCategories'])->name('super_admin.forum.page-single-categories');
        Route::get('forum/page-categories', [SuperAdminController::class, 'forumPageCategories'])->name('super_admin.forum.page-categories');
        Route::get('forum/page-categories-single', [SuperAdminController::class, 'forumPageCategoriesSingle'])->name('super_admin.forum.page-categories-single');
        Route::get('forum/page-tabs', [SuperAdminController::class, 'forumPageTabs'])->name('super_admin.forum.page-tabs');
        Route::get('forum/page-tabs-guidelines', [SuperAdminController::class, 'forumPageTabGuidelines'])->name('super_admin.forum.page-tabs-guidelines');
        // Attendance routes
        Route::get('attendance/student_entry', [SuperAdminController::class, 'studentEntry'])->name('attendance.student_entry');
        Route::get('attendance/employee_entry', [SuperAdminController::class, 'employeeEntry'])->name('attendance.employee_entry');
        Route::get('attendance/exam_entry', [SuperAdminController::class, 'examEntry'])->name('attendance.exam_entry');
        
        // LEAVE MANAGEMENT ROUTES start
        // Leave Apply
        Route::get('leave_management/applyleave', [SuperAdminController::class, 'applyleave'])->name('super_admin.leave_management.applyleave');
        // Leave approval
        Route::get('leave_management/approvalleave', [SuperAdminController::class, 'approvalleave'])->name('super_admin.leave_management.approvalleave');
        // Leave allLeaves
        Route::get('leave_management/allleaves', [SuperAdminController::class, 'allleaves'])->name('super_admin.leave_management.allleaves');

        // timetable
        Route::get('timetable/lesson', [SuperAdminController::class, 'addLesson'])->name('super_admin.timetable.lesson');
        Route::get('timetable/index', [SuperAdminController::class, 'timeTable'])->name('super_admin.timetable.index');
        // faq
        Route::get('faq/index', [SuperAdminController::class, 'faqIndex'])->name('super_admin.faq.index');
        // exam result
        Route::get('exam/result', [SuperAdminController::class, 'examResult'])->name('super_admin.exam.result');
        // exam timetable
        Route::get('timetable/viewexam', [SuperAdminController::class, 'timeTableViewExam'])->name('super_admin.timetable.viewexam');
        Route::get('timetable/set_examwise', [SuperAdminController::class, 'timeTableSetExamWise'])->name('super_admin.timetable.set_examwise');
        // exam marks
        Route::get('exam/mark_entry', [SuperAdminController::class, 'markEntry'])->name('super_admin.exam.mark_entry');
        // static page routes end
    });
});

Route::group(['prefix' => 'schoolcrm'], function () {

    // Route::get('login', 'AuthController@login');
    // Route::get('logout', 'AuthController@logout');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('admin.authenticate');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // admin routes start
    Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin']], function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        // student details
        Route::get('/student', [AdminController::class, 'studentIndex'])->name('admin.student.index');

        // section routes
        Route::get('section/index', [AdminController::class, 'section'])->name('admin.section');
        Route::post('section/add', [AdminController::class, 'addSection'])->name('section.add');
        Route::get('section/list', [AdminController::class, 'getSectionList'])->name('section.list');
        Route::post('section/section-details', [AdminController::class, 'getSectionDetails'])->name('section.details');
        Route::post('section/update', [AdminController::class, 'updateSectionDetails'])->name('section.update');
        Route::post('section/delete', [AdminController::class, 'deleteSection'])->name('section.delete');

        // Class routes
        // Route::get('class/index', [AdminController::class, 'classes'])->name('admin.class');
        // Route::post('class/add', [AdminController::class, 'addClass'])->name('class.add');
        // Route::get('class/list', [AdminController::class, 'getClassList'])->name('class.list');
        // Route::post('class/class-details', [AdminController::class, 'getClassDetails'])->name('class.details');
        // Route::post('class/update', [AdminController::class, 'updateClassDetails'])->name('class.update');
        // Route::post('class/delete', [AdminController::class, 'deleteClass'])->name('class.delete');

        Route::get('classes', [AdminController::class, 'classes'])->name('admin.classes');
        Route::get('classes/add_class', [AdminController::class, 'addClasses'])->name('admin.add_classes');
        Route::get('classes/list', [AdminController::class, 'getClassList'])->name('classes.list');
        Route::post('classes/add', [AdminController::class, 'addClass'])->name('classes.add');
        Route::get('classes/edit/{id}', [AdminController::class, 'editClass'])->name('classes.edit');
        Route::post('classes/update', [AdminController::class, 'updateClass'])->name('classes.update');
        Route::post('classes/delete', [AdminController::class, 'deleteClass'])->name('classes.delete');
        Route::post('classes/class-details',[AdminController::class, 'getClassDetails'])->name('classes.details');


        // sections allocations routes
        Route::get('allocate_section/index', [AdminController::class, 'showSectionAllocation'])->name('admin.section_allocation');
        Route::post('allocate_section/add', [AdminController::class, 'addSectionAllocation'])->name('section_allocation.add');
        Route::get('allocate_section/list', [AdminController::class, 'getSectionAllocationList'])->name('section_allocation.list');
        Route::post('allocate_section/section_allocation-details', [AdminController::class, 'getSectionAllocationDetails'])->name('section_allocation.details');
        Route::post('allocate_section/update', [AdminController::class, 'updateSectionAllocation'])->name('section_allocation.update');
        Route::post('allocate_section/delete', [AdminController::class, 'deleteSectionAllocation'])->name('section_allocation.delete');

        // assign_teacher routes
        Route::get('assign_teacher/index', [AdminController::class, 'showTeacherAllocation'])->name('admin.assign_teacher');
        Route::post('assign_teacher/get_allocation_section', [AdminController::class, 'getAllocationSection'])->name('assign_teacher.get_allocation_section');
        Route::post('assign_teacher/add', [AdminController::class, 'addTeacherAllocation'])->name('assign_teacher.add');
        Route::get('assign_teacher/list', [AdminController::class, 'getTeacherAllocationList'])->name('assign_teacher.list');
        Route::post('assign_teacher/details', [AdminController::class, 'getTeacherAllocationDetails'])->name('assign_teacher.details');
        Route::post('assign_teacher/update', [AdminController::class, 'updateTeacherAllocation'])->name('assign_teacher.update');
        Route::post('assign_teacher/delete', [AdminController::class, 'deleteTeacherAllocation'])->name('assign_teacher.delete');

        // Event Type routes
        Route::get('event_type/index', [AdminController::class, 'eventType'])->name('admin.event_type');
        Route::get('event_type/list', [AdminController::class, 'getEventTypeList'])->name('event_type.list');
        Route::post('event_type/add', [AdminController::class, 'addEventType'])->name('event_type.add');
        Route::post('event_type/event_type-details', [AdminController::class, 'getEventTypeDetails'])->name('event_type.details');
        Route::post('event_type/update', [AdminController::class, 'updateEventTypeDetails'])->name('event_type.update');
        Route::post('event_type/delete', [AdminController::class, 'deleteEventType'])->name('event_type.delete');


        // Event routes
        Route::get('event/index', [AdminController::class, 'event'])->name('admin.event');
        Route::get('event/list', [AdminController::class, 'getEventList'])->name('event.list');
        Route::post('event/add', [AdminController::class, 'addEvent'])->name('event.add');
        Route::post('event/event-details', [AdminController::class, 'getEventDetails'])->name('event.details');
        Route::post('event/delete', [AdminController::class, 'deleteEvent'])->name('event.delete');
        Route::post('event/event-publish', [AdminController::class, 'publishEvent'])->name('event.publish');

        // department routes
        Route::get('department/index', [AdminController::class, 'Department'])->name('admin.department');
        Route::post('department/add', [AdminController::class, 'addDepartment'])->name('department.add');
        Route::get('department/list', [AdminController::class, 'getDepartmentList']);
        Route::post('department/department-details', [AdminController::class, 'getDepartmentDetails'])->name('department.details');
        Route::post('department/update', [AdminController::class, 'updateDepartment'])->name('department.update');
        Route::post('department/delete', [AdminController::class, 'deleteDepartment'])->name('department.delete');

        // designation routes
        Route::get('designation/index', [AdminController::class, 'Designation'])->name('admin.designation');
        Route::post('designation/add', [AdminController::class, 'addDesignation'])->name('designation.add');
        Route::get('designation/list', [AdminController::class, 'getDesignationList']);
        Route::post('designation/designation-details', [AdminController::class, 'getDesignationDetails'])->name('designation.details');
        Route::post('designation/update', [AdminController::class, 'updateDesignation'])->name('designation.update');
        Route::post('designation/delete', [AdminController::class, 'deleteDesignation'])->name('designation.delete');


        // Employee routes
    
        Route::get('employee/employeelist', [AdminController::class, 'listEmployee'])->name('admin.listemployee');
        Route::get('employee/index', [AdminController::class, 'showEmployee'])->name('admin.employee');
        Route::post('employee/add', [AdminController::class, 'addEmployee'])->name('employee.add');
        Route::get('employee/list', [AdminController::class, 'getEmployeeList']);

        // Settings
        Route::get('settings', [SuperAdminController::class, 'settings'])->name('admin.settings');
        Route::post('change-password', [SuperAdminController::class, 'changePassword'])->name('settings.changePassword');
        Route::post('update-profile-info', [SuperAdminController::class, 'updateProfileInfo'])->name('settings.updateProfileInfo');
        Route::post('update-setting-session', [CommonController::class, 'updateSettingSession'])->name('settings.updateSettingSession');

        // static page routes start

        // Admission routes
        Route::get('admission/index', [AdminController::class, 'admission'])->name('admin.admission');
        Route::get('admission/import', [AdminController::class, 'import'])->name('admission.import');

        // Parent routes
        Route::get('parent/index', [AdminController::class, 'parent'])->name('admin.parent');

        // Homework routes
        Route::get('homework/index', [AdminController::class, 'homework'])->name('admin.homework');

        // exam routes
        Route::get('exam/term', [AdminController::class, 'examIndex'])->name('admin.exam.term');
        Route::get('exam/hall', [AdminController::class, 'examHall'])->name('admin.exam.hall');
        Route::get('exam/mark_distribution', [AdminController::class, 'examMarkDistribution'])->name('admin.exam.mark_distribution');
        Route::get('exam/exam', [AdminController::class, 'exam'])->name('admin.exam.exam');

        // Hostel routes
        Route::get('hostel/index', [AdminController::class, 'hostel'])->name('admin.hostel');
        Route::get('hostel/category', [AdminController::class, 'getCategory'])->name('admin.hostel.category');
        Route::get('hostel/room', [AdminController::class, 'getRoom'])->name('admin.hostel.room');

       // Transport routes
       Route::get('transport/route', [AdminController::class, 'getRoute'])->name('admin.transport.route');
       Route::get('transport/vehicle', [AdminController::class, 'getVehicle'])->name('admin.transport.vehicle');
       Route::get('transport/stoppage', [AdminController::class, 'getstoppage'])->name('admin.transport.stoppage');
       Route::get('transport/assignvehicle', [AdminController::class, 'assignVehicle'])->name('admin.transport.assignvehicle');

       // Library routes
       Route::get('library/book', [AdminController::class, 'book'])->name('admin.library.book');
       Route::get('library/book/category', [AdminController::class, 'bookCategory'])->name('admin.library.bookcategory');
       Route::get('library/issued_book', [AdminController::class, 'issuedBook'])->name('admin.library.issuedbook');
       Route::get('library/issue_return', [AdminController::class, 'issueReturn'])->name('admin.library.issuereturn');

       Route::get('classes/add_class', [AdminController::class, 'addClasses'])->name('admin.add_classes');

        // Forum routes
        Route::get('forum/index', [AdminController::class, 'forumIndex'])->name('admin.forum.index');
        Route::get('forum/page-single-topic', [AdminController::class, 'forumPageSingleTopic'])->name('admin.forum.page-single-topic');
        Route::get('forum/page-create-topic', [AdminController::class, 'forumPageCreateTopic'])->name('admin.forum.page-create-topic');
        Route::get('forum/page-single-user', [AdminController::class, 'forumPageSingleUser'])->name('admin.forum.page-single-user');
        Route::get('forum/page-single-threads', [AdminController::class, 'forumPageSingleThreads'])->name('admin.forum.page-single-threads');
        Route::get('forum/page-single-replies', [AdminController::class, 'forumPageSingleReplies'])->name('admin.forum.page-single-replies');
        Route::get('forum/page-single-followers', [AdminController::class, 'forumPageSingleFollowers'])->name('admin.forum.page-single-followers');
        Route::get('forum/page-single-categories', [AdminController::class, 'forumPageSingleCategories'])->name('admin.forum.page-single-categories');
        Route::get('forum/page-categories', [AdminController::class, 'forumPageCategories'])->name('admin.forum.page-categories');
        Route::get('forum/page-categories-single', [AdminController::class, 'forumPageCategoriesSingle'])->name('admin.forum.page-categories-single');
        Route::get('forum/page-tabs', [AdminController::class, 'forumPageTabs'])->name('admin.forum.page-tabs');
        Route::get('forum/page-tabs-guidelines', [AdminController::class, 'forumPageTabGuidelines'])->name('admin.forum.page-tabs-guidelines');

        // Attendance routes
        Route::get('attendance/student_entry', [AdminController::class, 'studentEntry'])->name('admin.attendance.student_entry');
        Route::get('attendance/employee_entry', [AdminController::class, 'employeeEntry'])->name('admin.attendance.employee_entry');
        Route::get('attendance/exam_entry', [AdminController::class, 'examEntry'])->name('admin.attendance.exam_entry');

        //class room Routes
        Route::get('classroom/classroom-management', [AdminController::class, 'classroomManagement'])->name('admin.classroom.management');
        //faq route
        
        // faq        
        Route::get('faq/index', [AdminController::class, 'faqIndex'])->name('admin.faq.index'); 

        // static page routes end
        // Settings
        // Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');
    });
    // admin routes end

    Route::group(['prefix' => 'staff', 'middleware' => ['isStaff']], function () {
        Route::get('/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');
        // Leave Apply
        Route::get('leave_management/applyleave', [StaffController::class, 'applyleave'])->name('staff.leave_management.applyleave');
        
         // Forum routes
         Route::get('forum/index', [StaffController::class, 'forumIndex'])->name('staff.forum.index');
         Route::get('forum/page-single-topic', [StaffController::class, 'forumPageSingleTopic'])->name('staff.forum.page-single-topic');
         Route::get('forum/page-create-topic', [StaffController::class, 'forumPageCreateTopic'])->name('staff.forum.page-create-topic');
         Route::get('forum/page-single-user', [StaffController::class, 'forumPageSingleUser'])->name('staff.forum.page-single-user');
         Route::get('forum/page-single-threads', [StaffController::class, 'forumPageSingleThreads'])->name('staff.forum.page-single-threads');
         Route::get('forum/page-single-replies', [StaffController::class, 'forumPageSingleReplies'])->name('staff.forum.page-single-replies');
         Route::get('forum/page-single-followers', [StaffController::class, 'forumPageSingleFollowers'])->name('staff.forum.page-single-followers');
         Route::get('forum/page-single-categories', [StaffController::class, 'forumPageSingleCategories'])->name('staff.forum.page-single-categories');
         Route::get('forum/page-categories', [StaffController::class, 'forumPageCategories'])->name('staff.forum.page-categories');
         Route::get('forum/page-categories-single', [StaffController::class, 'forumPageCategoriesSingle'])->name('staff.forum.page-categories-single');
         Route::get('forum/page-tabs', [StaffController::class, 'forumPageTabs'])->name('staff.forum.page-tabs');
         Route::get('forum/page-tabs-guidelines', [StaffController::class, 'forumPageTabGuidelines'])->name('staff.forum.page-tabs-guidelines'); 
         
        // Settings
        Route::get('settings', [StaffController::class, 'settings'])->name('staff.settings');
         // faq        
         Route::get('faq/index', [StaffController::class, 'faqIndex'])->name('staff.faq.Index');
         // student details
        Route::get('/student', [StaffController::class, 'studentIndex'])->name('staff.student.index');

        // section routes
        Route::get('section/index', [StaffController::class, 'section'])->name('staff.section');
        Route::post('section/add', [StaffController::class, 'addSection'])->name('staff.section.add');
        Route::get('section/list', [StaffController::class, 'getSectionList'])->name('staff.section.list');
        Route::post('section/section-details', [StaffController::class, 'getSectionDetails'])->name('staff.section.details');
        Route::post('section/update', [StaffController::class, 'updateSectionDetails'])->name('staff.section.update');
        Route::post('section/delete', [StaffController::class, 'deleteSection'])->name('staff.section.delete');

        Route::get('classes', [StaffController::class, 'classes'])->name('staff.classes');
        Route::get('classes/add_class', [StaffController::class, 'addClasses'])->name('staff.add_classes');
        Route::get('classes/list', [StaffController::class, 'getClassList'])->name('staff.classes.list');
        Route::post('classes/add', [StaffController::class, 'addClass'])->name('staff.classes.add');
        Route::get('classes/edit/{id}', [StaffController::class, 'editClass'])->name('staff.classes.edit');
        Route::post('classes/update', [StaffController::class, 'updateClass'])->name('staff.classes.update');
        Route::post('classes/delete', [StaffController::class, 'deleteClass'])->name('staff.classes.delete');
        Route::post('classes/class-details',[StaffController::class, 'getClassDetails'])->name('staff.classes.details');


        // sections allocations routes
        Route::get('allocate_section/index', [StaffController::class, 'showSectionAllocation'])->name('staff.section_allocation');
        Route::post('allocate_section/add', [StaffController::class, 'addSectionAllocation'])->name('staff.section_allocation.add');
        Route::get('allocate_section/list', [StaffController::class, 'getSectionAllocationList'])->name('staff.section_allocation.list');
        Route::post('allocate_section/section_allocation-details', [StaffController::class, 'getSectionAllocationDetails'])->name('staff.section_allocation.details');
        Route::post('allocate_section/update', [StaffController::class, 'updateSectionAllocation'])->name('staff.section_allocation.update');
        Route::post('allocate_section/delete', [StaffController::class, 'deleteSectionAllocation'])->name('staff.section_allocation.delete');

        // assign_teacher routes
        Route::get('assign_teacher/index', [StaffController::class, 'showTeacherAllocation'])->name('staff.assign_teacher');
        Route::post('assign_teacher/get_allocation_section', [StaffController::class, 'getAllocationSection'])->name('staff.assign_teacher.get_allocation_section');
        Route::post('assign_teacher/add', [StaffController::class, 'addTeacherAllocation'])->name('staff.assign_teacher.add');
        Route::get('assign_teacher/list', [StaffController::class, 'getTeacherAllocationList'])->name('staff.assign_teacher.list');
        Route::post('assign_teacher/details', [StaffController::class, 'getTeacherAllocationDetails'])->name('staff.assign_teacher.details');
        Route::post('assign_teacher/update', [StaffController::class, 'updateTeacherAllocation'])->name('staff.assign_teacher.update');
        Route::post('assign_teacher/delete', [StaffController::class, 'deleteTeacherAllocation'])->name('staff.assign_teacher.delete');

        // Event Type routes
        Route::get('event_type/index', [StaffController::class, 'eventType'])->name('staff.event_type');
        Route::get('event_type/list', [StaffController::class, 'getEventTypeList'])->name('staff.event_type.list');
        Route::post('event_type/add', [StaffController::class, 'addEventType'])->name('staff.event_type.add');
        Route::post('event_type/event_type-details', [StaffController::class, 'getEventTypeDetails'])->name('staff.event_type.details');
        Route::post('event_type/update', [StaffController::class, 'updateEventTypeDetails'])->name('staff.event_type.update');
        Route::post('event_type/delete', [StaffController::class, 'deleteEventType'])->name('staff.event_type.delete');


        // Event routes
        Route::get('event/index', [StaffController::class, 'event'])->name('staff.event');
        Route::get('event/list', [StaffController::class, 'getEventList'])->name('staff.event.list');
        Route::post('event/add', [StaffController::class, 'addEvent'])->name('staff.event.add');
        Route::post('event/event-details', [StaffController::class, 'getEventDetails'])->name('staff.event.details');
        Route::post('event/delete', [StaffController::class, 'deleteEvent'])->name('staff.event.delete');
        Route::post('event/event-publish', [StaffController::class, 'publishEvent'])->name('staff.event.publish');

        // department routes
        Route::get('department/index', [StaffController::class, 'Department'])->name('staff.department');
        Route::post('department/add', [StaffController::class, 'addDepartment'])->name('staff.department.add');
        Route::get('department/list', [StaffController::class, 'getDepartmentList']);
        Route::post('department/department-details', [StaffController::class, 'getDepartmentDetails'])->name('staff.department.details');
        Route::post('department/update', [StaffController::class, 'updateDepartment'])->name('staff.department.update');
        Route::post('department/delete', [StaffController::class, 'deleteDepartment'])->name('staff.department.delete');

        // designation routes
        Route::get('designation/index', [StaffController::class, 'Designation'])->name('staff.designation');
        Route::post('designation/add', [StaffController::class, 'addDesignation'])->name('staff.designation.add');
        Route::get('designation/list', [StaffController::class, 'getDesignationList']);
        Route::post('designation/designation-details', [StaffController::class, 'getDesignationDetails'])->name('staff.designation.details');
        Route::post('designation/update', [StaffController::class, 'updateDesignation'])->name('staff.designation.update');
        Route::post('designation/delete', [StaffController::class, 'deleteDesignation'])->name('staff.designation.delete');


        // Employee routes
    
        Route::get('employee/employeelist', [StaffController::class, 'listEmployee'])->name('staff.listemployee');
        Route::get('employee/index', [StaffController::class, 'showEmployee'])->name('staff.employee');
        Route::post('employee/add', [StaffController::class, 'addEmployee'])->name('staff.employee.add');
        Route::get('employee/list', [StaffController::class, 'getEmployeeList']);

        // static page routes start

        // Admission routes
        Route::get('admission/index', [StaffController::class, 'admission'])->name('staff.admission');
        Route::get('admission/import', [StaffController::class, 'import'])->name('staff.admission.import');

        // Parent routes
        Route::get('parent/index', [StaffController::class, 'parent'])->name('staff.parent');

        // Homework routes
        Route::get('homework/index', [StaffController::class, 'homework'])->name('staff.homework');

        // exam routes
        Route::get('exam/term', [StaffController::class, 'examIndex'])->name('staff.exam.term');
        Route::get('exam/hall', [StaffController::class, 'examHall'])->name('staff.exam.hall');
        Route::get('exam/mark_distribution', [StaffController::class, 'examMarkDistribution'])->name('staff.exam.mark_distribution');
        Route::get('exam/exam', [StaffController::class, 'exam'])->name('staff.exam.exam');

        // Hostel routes
        Route::get('hostel/index', [StaffController::class, 'hostel'])->name('staff.hostel');
        Route::get('hostel/category', [StaffController::class, 'getCategory'])->name('staff.hostel.category');
        Route::get('hostel/room', [StaffController::class, 'getRoom'])->name('staff.hostel.room');

       // Transport routes
       Route::get('transport/route', [StaffController::class, 'getRoute'])->name('staff.transport.route');
       Route::get('transport/vehicle', [StaffController::class, 'getVehicle'])->name('staff.transport.vehicle');
       Route::get('transport/stoppage', [StaffController::class, 'getstoppage'])->name('staff.transport.stoppage');
       Route::get('transport/assignvehicle', [StaffController::class, 'assignVehicle'])->name('staff.transport.assignvehicle');

       // Library routes
       Route::get('library/book', [StaffController::class, 'book'])->name('staff.library.book');
       Route::get('library/book/category', [StaffController::class, 'bookCategory'])->name('staff.library.bookcategory');
       Route::get('library/issued_book', [StaffController::class, 'issuedBook'])->name('staff.library.issuedbook');
       Route::get('library/issue_return', [StaffController::class, 'issueReturn'])->name('staff.library.issuereturn');

       Route::get('classes/add_class', [StaffController::class, 'addClasses'])->name('staff.add_classes');


        // Attendance routes
        Route::get('attendance/student_entry', [StaffController::class, 'studentEntry'])->name('staff.attendance.student_entry');
        Route::get('attendance/employee_entry', [StaffController::class, 'employeeEntry'])->name('staff.attendance.employee_entry');
        Route::get('attendance/exam_entry', [StaffController::class, 'examEntry'])->name('staff.attendance.exam_entry');

    });
// TEACHER CONTROLLER START
    Route::group(['prefix' => 'teacher', 'middleware' => ['isTeacher']], function () {
        Route::get('/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');
        // Test Result Rotes
        Route::get('test_result', [TeacherController::class, 'testResult'])->name('teacher.test_result');
        // student details
        Route::get('/student', [TeacherController::class, 'studentIndex'])->name('teacher.student.index');

        // Parent routes
        Route::get('parent/index', [TeacherController::class, 'parent'])->name('teacher.parent');

        // Admission routes
        Route::get('admission/index', [TeacherController::class, 'admission'])->name('teacher.admission');
        // Attendance routes
        Route::get('attendance/student_entry', [TeacherController::class, 'studentEntry'])->name('teacher.attendance.student_entry');
        Route::get('attendance/exam_entry', [TeacherController::class, 'examEntry'])->name('teacher.attendance.exam_entry');
        // Homework routes
        Route::get('homework/index', [TeacherController::class, 'homework'])->name('teacher.homework');
         // Leave Apply
         Route::get('leave_management/applyleave', [SuperAdminController::class, 'applyleave'])->name('teacher.leave_management.applyleave');       
        // Forum routes
        Route::get('forum/index', [TeacherController::class, 'forumIndex'])->name('teacher.forum.index');
        Route::get('forum/page-single-topic', [TeacherController::class, 'forumPageSingleTopic'])->name('teacher.forum.page-single-topic');
        Route::get('forum/page-create-topic', [TeacherController::class, 'forumPageCreateTopic'])->name('teacher.forum.page-create-topic');
        Route::get('forum/page-single-user', [TeacherController::class, 'forumPageSingleUser'])->name('teacher.forum.page-single-user');
        Route::get('forum/page-single-threads', [TeacherController::class, 'forumPageSingleThreads'])->name('teacher.forum.page-single-threads');
        Route::get('forum/page-single-replies', [TeacherController::class, 'forumPageSingleReplies'])->name('teacher.forum.page-single-replies');
        Route::get('forum/page-single-followers', [TeacherController::class, 'forumPageSingleFollowers'])->name('teacher.forum.page-single-followers');
        Route::get('forum/page-single-categories', [TeacherController::class, 'forumPageSingleCategories'])->name('teacher.forum.page-single-categories');
        Route::get('forum/page-categories', [TeacherController::class, 'forumPageCategories'])->name('teacher.forum.page-categories');
        Route::get('forum/page-categories-single', [TeacherController::class, 'forumPageCategoriesSingle'])->name('teacher.forum.page-categories-single');
        Route::get('forum/page-tabs', [TeacherController::class, 'forumPageTabs'])->name('teacher.forum.page-tabs');
        Route::get('forum/page-tabs-guidelines', [TeacherController::class, 'forumPageTabGuidelines'])->name('teacher.forum.page-tabs-guidelines');


        // Settings
        Route::get('settings', [TeacherController::class, 'settings'])->name('teacher.settings');
        
         // faq        
         Route::get('faq/index', [TeacherController::class, 'faqIndex'])->name('teacher.faq.Index');      
         // class room management    
         Route::get('classroom/classroom-management', [TeacherController::class, 'classroomManagement'])->name('teacher.classroom.management');
    });
     
    // TEACHER CONTROLLER END

    // PARENT CONTROLLER START
    Route::group(['prefix' => 'parent', 'middleware' => ['isParent']], function () {
        Route::get('/dashboard', [ParentController::class, 'index'])->name('parent.dashboard');
    
        // Settings
        Route::get('settings', [SuperAdminController::class, 'settings'])->name('parent.settings');
         // faq        
         Route::get('faq/index', [ParentController::class, 'faqIndex'])->name('parent.faq.Index');    
         
        //schedule routes  
         Route::get('exam/schedule', [ParentController::class, 'examSchedule'])->name('parent.exam.schedule');   
         
        //Report Card routes  
         Route::get('report_card', [ParentController::class, 'reportCard'])->name('parent.report_card');   
         
        //Event routes
         Route::get('events', [ParentController::class, 'events'])->name('parent.events');    
         //Library routes
         Route::get('library/books', [ParentController::class, 'bookList'])->name('parent.library.books');    
         Route::get('library/book_issued', [ParentController::class, 'bookIssued'])->name('parent.library.book_issued');          
         
        //Task routes
        Route::get('task/index', [ParentController::class, 'taskIndex'])->name('parent.task');
        //Time Table routes
        Route::get('timetable/index', [ParentController::class, 'timeTable'])->name('parent.timetable.index');

        // Forum routes
        Route::get('forum/index', [ParentController::class, 'forumIndex'])->name('parent.forum.index');
        Route::get('forum/page-single-topic', [ParentController::class, 'forumPageSingleTopic'])->name('parent.forum.page-single-topic');
        Route::get('forum/page-create-topic', [ParentController::class, 'forumPageCreateTopic'])->name('parent.forum.page-create-topic');
        Route::get('forum/page-single-user', [ParentController::class, 'forumPageSingleUser'])->name('parent.forum.page-single-user');
        Route::get('forum/page-single-threads', [ParentController::class, 'forumPageSingleThreads'])->name('parent.forum.page-single-threads');
        Route::get('forum/page-single-replies', [ParentController::class, 'forumPageSingleReplies'])->name('parent.forum.page-single-replies');
        Route::get('forum/page-single-followers', [ParentController::class, 'forumPageSingleFollowers'])->name('parent.forum.page-single-followers');
        Route::get('forum/page-single-categories', [ParentController::class, 'forumPageSingleCategories'])->name('parent.forum.page-single-categories');
        Route::get('forum/page-categories', [ParentController::class, 'forumPageCategories'])->name('parent.forum.page-categories');
        Route::get('forum/page-categories-single', [ParentController::class, 'forumPageCategoriesSingle'])->name('parent.forum.page-categories-single');
        Route::get('forum/page-tabs', [ParentController::class, 'forumPageTabs'])->name('parent.forum.page-tabs');
        Route::get('forum/page-tabs-guidelines', [ParentController::class, 'forumPageTabGuidelines'])->name('parent.forum.page-tabs-guidelines');

        //attendance routes
        Route::get('attendance/index', [ParentController::class, 'attendance'])->name('parent.attendance');
        // Homework routes
        Route::get('homework/homeworklist', [ParentController::class, 'homeworklist'])->name('parent.homework');
         // Children routes
         Route::get('children', [ParentController::class, 'children'])->name('parent.children');
    });


    
    // faq
    Route::get('faq/index', [ParentController::class, 'faqIndex'])->name('teacher.faq.index');
        
    // PARENT CONTROLLER END
    Route::group(['prefix' => 'student', 'middleware' => ['isStudent']], function () {
        Route::get('/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
        // Homework routes
        Route::get('homework/homeworklist', [StudentController::class, 'homeworklist'])->name('student.homework');
        
        // Settings
        Route::get('settings', [SuperAdminController::class, 'settings'])->name('student.settings');
        // faq        
        Route::get('faq/index', [StudentController::class, 'faqIndex'])->name('student.faq.Index'); 
        // Exam
        Route::get('exam/schedule', [StudentController::class, 'examSchedule'])->name('student.exam.schedule');     
        // Report card
        Route::get('report_card', [StudentController::class, 'reportCard'])->name('student.report_card');   
        // Event
        Route::get('events', [StudentController::class, 'events'])->name('student.events');    
        // Library 
        Route::get('library/books', [StudentController::class, 'bookList'])->name('student.library.books');    
        Route::get('library/book_issued', [StudentController::class, 'bookIssued'])->name('student.library.book_issued');          
        // Forum routes
        Route::get('forum/index', [StudentController::class, 'forumIndex'])->name('student.forum.index');
        Route::get('forum/page-single-topic', [StudentController::class, 'forumPageSingleTopic'])->name('student.forum.page-single-topic');
        Route::get('forum/page-create-topic', [StudentController::class, 'forumPageCreateTopic'])->name('student.forum.page-create-topic');
        Route::get('forum/page-single-user', [StudentController::class, 'forumPageSingleUser'])->name('student.forum.page-single-user');
        Route::get('forum/page-single-threads', [StudentController::class, 'forumPageSingleThreads'])->name('student.forum.page-single-threads');
        Route::get('forum/page-single-replies', [StudentController::class, 'forumPageSingleReplies'])->name('student.forum.page-single-replies');
        Route::get('forum/page-single-followers', [StudentController::class, 'forumPageSingleFollowers'])->name('student.forum.page-single-followers');
        Route::get('forum/page-single-categories', [StudentController::class, 'forumPageSingleCategories'])->name('student.forum.page-single-categories');
        Route::get('forum/page-categories', [StudentController::class, 'forumPageCategories'])->name('student.forum.page-categories');
        Route::get('forum/page-categories-single', [StudentController::class, 'forumPageCategoriesSingle'])->name('student.forum.page-categories-single');
        Route::get('forum/page-tabs', [StudentController::class, 'forumPageTabs'])->name('student.forum.page-tabs');
        Route::get('forum/page-tabs-guidelines', [StudentController::class, 'forumPageTabGuidelines'])->name('student.forum.page-tabs-guidelines');

    });
    
    
});
