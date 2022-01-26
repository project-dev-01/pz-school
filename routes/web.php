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
        Route::get('forum/index', [SuperAdminController::class, 'forumIndex'])->name('forum.index');
        Route::get('forum/page-single-topic', [SuperAdminController::class, 'forumPageSingleTopic'])->name('forum.page-single-topic');
        Route::get('forum/page-create-topic', [SuperAdminController::class, 'forumPageCreateTopic'])->name('forum.page-create-topic');
        Route::get('forum/page-single-user', [SuperAdminController::class, 'forumPageSingleUser'])->name('forum.page-single-user');
        Route::get('forum/page-single-threads', [SuperAdminController::class, 'forumPageSingleThreads'])->name('forum.page-single-threads');
        Route::get('forum/page-single-replies', [SuperAdminController::class, 'forumPageSingleReplies'])->name('forum.page-single-replies');
        Route::get('forum/page-single-followers', [SuperAdminController::class, 'forumPageSingleFollowers'])->name('forum.page-single-followers');
        Route::get('forum/page-single-categories', [SuperAdminController::class, 'forumPageSingleCategories'])->name('forum.page-single-categories');
        Route::get('forum/page-categories', [SuperAdminController::class, 'forumPageCategories'])->name('forum.page-categories');
        Route::get('forum/page-categories-single', [SuperAdminController::class, 'forumPageCategoriesSingle'])->name('forum.page-categories-single');
        Route::get('forum/page-tabs', [SuperAdminController::class, 'forumPageTabs'])->name('forum.page-tabs');
        Route::get('forum/page-tabs-guidelines', [SuperAdminController::class, 'forumPageTabGuidelines'])->name('forum.page-tabs-guidelines');
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
        Route::get('forum/page-create-topic', [AdminController::class, 'forumPageCreateTopic'])->name('forum.page-create-topic');
        Route::get('forum/page-single-user', [AdminController::class, 'forumPageSingleUser'])->name('forum.page-single-user');
        Route::get('forum/page-single-threads', [AdminController::class, 'forumPageSingleThreads'])->name('forum.page-single-threads');
        Route::get('forum/page-single-replies', [AdminController::class, 'forumPageSingleReplies'])->name('forum.page-single-replies');
        Route::get('forum/page-single-followers', [AdminController::class, 'forumPageSingleFollowers'])->name('forum.page-single-followers');
        Route::get('forum/page-single-categories', [AdminController::class, 'forumPageSingleCategories'])->name('forum.page-single-categories');
        Route::get('forum/page-categories', [AdminController::class, 'forumPageCategories'])->name('forum.page-categories');
        Route::get('forum/page-categories-single', [AdminController::class, 'forumPageCategoriesSingle'])->name('forum.page-categories-single');
        Route::get('forum/page-tabs', [AdminController::class, 'forumPageTabs'])->name('forum.page-tabs');
        Route::get('forum/page-tabs-guidelines', [AdminController::class, 'forumPageTabGuidelines'])->name('forum.page-tabs-guidelines');

        // Attendance routes
        Route::get('attendance/student_entry', [AdminController::class, 'studentEntry'])->name('admin.attendance.student_entry');
        Route::get('attendance/employee_entry', [AdminController::class, 'employeeEntry'])->name('admin.attendance.employee_entry');
        Route::get('attendance/exam_entry', [AdminController::class, 'examEntry'])->name('admin.attendance.exam_entry');


        // static page routes end
        // Settings
        // Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');
    });
    // admin routes end

    Route::group(['prefix' => 'staff', 'middleware' => ['isStaff']], function () {
        Route::get('/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');
        // Leave Apply
        Route::get('leave_management/applyleave', [SuperAdminController::class, 'applyleave'])->name('staff.leave_management.applyleave');
        
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
    });
     
    // TEACHER CONTROLLER END

    // PARENT CONTROLLER START
    Route::group(['prefix' => 'parent', 'middleware' => ['isParent']], function () {
        Route::get('/dashboard', [ParentController::class, 'index'])->name('parent.dashboard');
    
        // Settings
        Route::get('settings', [SuperAdminController::class, 'settings'])->name('parent.settings');
         // faq        
         Route::get('faq/index', [ParentController::class, 'faqIndex'])->name('parent.faq.Index');      
        
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
    });
    
    
});
