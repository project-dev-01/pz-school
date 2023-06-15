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
use App\Http\Controllers\PdfController;
use App\Http\Controllers\LangController;
use Illuminate\Support\Facades\Artisan;
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
    return redirect(route('home'));
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    return "clear artisan cache";
});

Route::any('home', [AuthController::class, 'home'])->name('home');
Route::get('application/index', [AuthController::class, 'application'])->name('application');
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// language controller
// Route::get('lang/home', [LangController::class, 'index']);
Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');


Route::group(['prefix' => 'syscont', 'namespace' => 'Super Admin'], function () {

    // Route::get('login', 'AuthController@login');
    // Route::get('logout', 'AuthController@logout');
    Route::get('/login', [AuthController::class, 'showLoginFormSA'])->name('super_admin.login');
    Route::post('/authenticate', [AuthController::class, 'authenticateSA'])->name('super_admin.authenticate');
    Route::post('/logout', [AuthController::class, 'logoutSA'])->name('super_admin.logout');
    //school app form
    Route::get('/application-form', [CommonController::class, 'showApplicationForm'])->name('super_admin.schoolcrm.app.form');
    Route::post('/gretting', [CommonController::class, 'greettingSession'])->name('greetting.session');

    Route::group(['middleware' => ['isSuperAdmin']], function () {

        // dashboard routes
        Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('super_admin.dashboard');
        // student details
        Route::get('/student', [SuperAdminController::class, 'studentIndex'])->name('student.index');


        // branch routes
        Route::get('branch/index', [SuperAdminController::class, 'branchIndex'])->name('branch.index');
        Route::get('branch/create', [SuperAdminController::class, 'branchCreate'])->name('branch.create');
        Route::post('branch/add', [SuperAdminController::class, 'addBranch'])->name('branch.add');
        Route::get('branch/list', [SuperAdminController::class, 'getBranchList'])->name('branch.list');
        Route::get('branch/edit/{id}', [SuperAdminController::class, 'getEditDetails'])->name('branch.edit');
        Route::post('branch/update', [SuperAdminController::class, 'updateBranchDetails'])->name('branch.update');
        Route::post('branch/delete', [SuperAdminController::class, 'deleteBranch'])->name('branch.delete');


        // Settings
        Route::get('settings', [SuperAdminController::class, 'settings'])->name('super_admin.settings');
        Route::post('change-password', [SuperAdminController::class, 'changePassword'])->name('settings.changePassword');
        Route::post('update-profile-info', [SuperAdminController::class, 'updateProfileInfo'])->name('settings.updateProfileInfo');
        // Route::post('update-setting-session', [CommonController::class, 'updateSettingSession'])->name('settings.updateSettingSession');

        // userlist routes
        Route::get('users/user', [SuperAdminController::class, 'users'])->name('users.user');
        Route::get('users/add', [SuperAdminController::class, 'addUsers'])->name('users.add');
        Route::post('users/add_user', [SuperAdminController::class, 'addRoleUser'])->name('users.add_role_user');
        Route::get('users/edit/{id}', [SuperAdminController::class, 'editUser'])->name('users.edit');
        Route::get('users/user_list', [SuperAdminController::class, 'getUserList'])->name('users.user_list');
        Route::post('users/delete', [SuperAdminController::class, 'deleteUser'])->name('users.delete');
        // Forum routes
        //Route::get('forum/index', [SuperAdminController::class, 'forumIndex'])->name('super_admin.forum.index');
        Route::post('forum/index', [SuperAdminController::class, 'forumIndex'])->name('super_admin.forum.index');
        Route::get('forum/rolls-chooseforum', [SuperAdminController::class, 'superadminrollchoose'])->name('super_admin.forum.rolls-chooseforum');
        Route::get('forum/page-single-topic', [SuperAdminController::class, 'forumPageSingleTopic'])->name('super_admin.forum.page-single-topic');
        Route::get('forum/page-create-topic', [SuperAdminController::class, 'forumPageCreateTopic'])->name('super_admin.forum.page-create-topic');
        Route::get('forum/page-edit-topic/{id}', [SuperAdminController::class, 'forumPageEditTopic'])->name('super_admin.forum.page-edit-topic');
        Route::get('forum/page-single-user', [SuperAdminController::class, 'forumPageSingleUser'])->name('super_admin.forum.page-single-user');
        Route::get('forum/page-single-threads', [SuperAdminController::class, 'forumPageSingleThreads'])->name('super_admin.forum.page-single-threads');
        Route::get('forum/page-single-replies', [SuperAdminController::class, 'forumPageSingleReplies'])->name('super_admin.forum.page-single-replies');
        Route::get('forum/page-single-followers', [SuperAdminController::class, 'forumPageSingleFollowers'])->name('super_admin.forum.page-single-followers');
        Route::get('forum/page-single-categories', [SuperAdminController::class, 'forumPageSingleCategories'])->name('super_admin.forum.page-single-categories');
        Route::get('forum/page-categories', [SuperAdminController::class, 'forumPageCategories'])->name('super_admin.forum.page-categories');
        Route::get('forum/page-categories-single', [SuperAdminController::class, 'forumPageCategoriesSingle'])->name('super_admin.forum.page-categories-single');
        Route::get('forum/page-tabs', [SuperAdminController::class, 'forumPageTabs'])->name('super_admin.forum.page-tabs');
        Route::get('forum/page-tabs-guidelines', [SuperAdminController::class, 'forumPageTabGuidelines'])->name('super_admin.forum.page-tabs-guidelines');

        Route::post('form/page-create-topic', [SuperAdminController::class, 'createpost'])->name('super_admin.forum.create-topic');
        Route::post('form/page-update-topic', [SuperAdminController::class, 'updatepost'])->name('super_admin.forum.update-topic');
        Route::get('forum/page-single-topic-val/{id}/{user_id}', [SuperAdminController::class, 'forumPageSingleTopicwithvalue'])->name('super_admin.forum.page-single-topic-val');
        Route::get('forum/page-categories-single-val/{categId}/{user_id}/{category_names}', [SuperAdminController::class, 'forumPageCategoriesSingle'])->name('super_admin.forum.page-categories-single-val');
        Route::get('forum/selecteddb', [SuperAdminController::class, 'dbvsgetbranchid'])->name('super_admin.forum.selecteddbname');
        Route::post('form/postimage', [SuperAdminController::class, 'imagestore'])->name('super_admin.forum.image.store');
        // faq
        Route::get('faq/index', [SuperAdminController::class, 'faqIndex'])->name('super_admin.faq.index');

        // exam Result Group 
        Route::get('exam_results/byclass', [SuperAdminController::class, 'byclasss'])->name('super_admin.exam_results.byclass');
        Route::get('exam_results/bysubject', [SuperAdminController::class, 'bysubject'])->name('super_admin.exam_results.bysubject');
        Route::get('exam_results/overall', [SuperAdminController::class, 'overall'])->name('super_admin.exam_results.overall');
        Route::get('exam_results/bystudent', [SuperAdminController::class, 'bystudent'])->name('super_admin.exam_results.bystudent');
        Route::get('exam/result', [SuperAdminController::class, 'examResult'])->name('super_admin.exam.result');
    });
});

// Route::get('/auth/login', [AuthController::class, 'showLoginForm'])->name('auth.login');

// Route::get('login', 'AuthController@login');
// Route::get('logout', 'AuthController@logout');
Route::get('/employee/punchcard/{session}', [AuthController::class, 'employeePunchCardLogin'])->name('employee.punchcard.login');
Route::post('/employee/punchcards/', [AuthController::class, 'employeePunchCard'])->name('employee.punchcard');
Route::post('/punchcarddetails', [AuthController::class, 'punchCardDetails'])->name('employee.punchcarddetails');
Route::get('/loading', [AuthController::class, 'showLoadingForm'])->name('admin.loading');
Route::post('/logout/punchcard', [AuthController::class, 'logoutPunchcard'])->name('admin.logout.punchcard');

Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot_password');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset_password');
Route::get('/password/reset/{token}', [AuthController::class, 'passwordRest'])->name('password_reset');
Route::post('/reset-password-validation', [AuthController::class, 'resetPasswordValidation'])->name('reset_password_validation');

//school app form
Route::get('/application-form', [CommonController::class, 'showApplicationForm'])->name('schoolcrm.app.form');
Route::post('/application-form/add', [CommonController::class, 'addApplicationForm'])->name('application.add');
Route::get('/DBMigrationCall', [CommonController::class, 'DBMigrationCall']);
// notifications
Route::get('unread_notifications', [CommonController::class, 'unreadNotifications'])->name('unread_notifications');
// all logout
Route::get('all_logout', [AuthController::class, 'allLogout'])->name('all_logout');
// update settings session
Route::post('update-setting-session', [CommonController::class, 'updateSettingSession'])->name('settings.updateSettingSession');
// password expired
Route::get('/password/expired/reset/{token}', [AuthController::class, 'passwordExpireReset'])->name('password.expired.reset');
Route::get('password/expired', [AuthController::class, 'passwordExpired'])->name('password.expired');
Route::post('password/post_expired', [AuthController::class, 'resetExpirePassword'])->name('password.post_expired');

// 2 fa check
Route::post('2fa/checkotp', [AuthController::class, 'twoFACheckOtp'])->name('2fa.post');
Route::get('/2fa/checktwofa', [AuthController::class, 'twoFACheckView'])->name('2fa.view');
Route::get('/2fa/checktwofaregister', [AuthController::class, 'twoFACheckRegister'])->name('2fa.register');
Route::post('2fa/register', [AuthController::class, 'twoFACheckOTPRegister'])->name('complete.registration');

// admin routes start
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::any('/authenticate', [AuthController::class, 'authenticate'])->name('admin.authenticate');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/failed_logout', [AuthController::class, 'failed_logout'])->name('admin.failed_logout');
    
    Route::group(['middleware' => 'isAdmin'], function () {
        Route::post('/staff_attendance/excel', [AdminController::class, 'staffAttendanceExcel'])->name('admin.staff_attendance.excel');
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        // student details
        Route::get('student', [AdminController::class, 'studentIndex'])->name('admin.student.index');
        Route::get('student/list', [AdminController::class, 'studentList'])->name('admin.student.list');
        Route::get('student/student-details/{id}', [AdminController::class, 'getStudentDetails'])->name('admin.student.details');
        Route::post('student/update', [AdminController::class, 'updateStudent'])->name('admin.student.update');
        Route::post('student/delete', [AdminController::class, 'deleteStudent'])->name('admin.student.delete');

        // section routes
        Route::get('section/index', [AdminController::class, 'section'])->name('admin.section');
        Route::get('section/list', [AdminController::class, 'getSectionList'])->name('admin.section.list');

        // Class routes
        Route::get('classes', [AdminController::class, 'classes'])->name('admin.classes');
        Route::get('classes/list', [AdminController::class, 'getClassList'])->name('admin.classes.list');


        // sections allocations routes
        Route::get('allocate_section/index', [AdminController::class, 'showSectionAllocation'])->name('admin.section_allocation');
        Route::get('allocate_section/list', [AdminController::class, 'getSectionAllocationList'])->name('admin.section_allocation.list');

        // assign_teacher routes
        Route::get('assign_teacher/index', [AdminController::class, 'showTeacherAllocation'])->name('admin.assign_teacher');
        Route::get('assign_teacher/list', [AdminController::class, 'getTeacherAllocationList'])->name('admin.assign_teacher.list');
        // subjects
        Route::get('subjects/index', [AdminController::class, 'showSubjectsIndex'])->name('admin.subjects');
        Route::get('subjects/list', [AdminController::class, 'getSubjectsList'])->name('admin.subjects.list');
        // assign class subject
        Route::get('class_assign/index', [AdminController::class, 'showClassAssignSubIndex'])->name('admin.class_assign_subject');
        Route::get('class_assign/list', [AdminController::class, 'ClassAssignSubList'])->name('admin.class_assign_subject.list');
        // teacher assign subject
        Route::get('teacher_assign/index', [AdminController::class, 'showClassAssignSubTeacherIndex'])->name('admin.teacher_assign_subject');
        Route::get('teacher_assign/list', [AdminController::class, 'ClassAssignSubTeacherList'])->name('admin.teacher_assign_subject.list');

        // Event Type routes
        Route::get('all_event_type/index', [AdminController::class, 'eventType'])->name('admin.event_type');
        Route::get('all_event_type/list', [AdminController::class, 'getEventTypeList'])->name('admin.event_type.list');
        Route::post('all_event_type/add', [AdminController::class, 'addEventType'])->name('admin.event_type.add');
        Route::post('all_event_type/event_type-details', [AdminController::class, 'getEventTypeDetails'])->name('admin.event_type.details');
        Route::post('all_event_type/update', [AdminController::class, 'updateEventType'])->name('admin.event_type.update');
        Route::post('all_event_type/delete', [AdminController::class, 'deleteEventType'])->name('admin.event_type.delete');


        // Event routes
        Route::get('event/index', [AdminController::class, 'event'])->name('admin.event');
        Route::get('event/create', [AdminController::class, 'createEvent'])->name('admin.event.create');
        Route::get('event/edit/{id}', [AdminController::class, 'editEvent'])->name('admin.event.edit');
        Route::get('event/list', [AdminController::class, 'getEventList'])->name('admin.event.list');
        Route::post('event/add', [AdminController::class, 'addEvent'])->name('admin.event.add');
        Route::post('event/event-details', [AdminController::class, 'getEventDetails'])->name('admin.event.details');
        Route::post('event/update', [AdminController::class, 'updateEvent'])->name('admin.event.update');
        Route::post('event/delete', [AdminController::class, 'deleteEvent'])->name('admin.event.delete');
        Route::post('event/event-publish', [AdminController::class, 'publishEvent'])->name('admin.event.publish');

        // Group routes
        Route::get('group/index', [AdminController::class, 'group'])->name('admin.group');
        Route::get('group/create', [AdminController::class, 'createGroup'])->name('admin.group.create');
        Route::get('group/edit/{id}', [AdminController::class, 'editGroup'])->name('admin.group.edit');
        Route::get('group/list', [AdminController::class, 'getGroupList'])->name('admin.group.list');
        Route::post('group/add', [AdminController::class, 'addGroup'])->name('admin.group.add');
        Route::post('group/group-details', [AdminController::class, 'getGroupDetails'])->name('admin.group.details');
        Route::post('group/update', [AdminController::class, 'updateGroup'])->name('admin.group.update');
        Route::post('group/delete', [AdminController::class, 'deleteGroup'])->name('admin.group.delete');

        // Hostel Group routes
        Route::get('hostel_group/index', [AdminController::class, 'hostelGroup'])->name('admin.hostel_group');
        Route::get('hostel_group/create', [AdminController::class, 'createHostelGroup'])->name('admin.hostel_group.create');
        Route::get('hostel_group/edit/{id}', [AdminController::class, 'editHostelGroup'])->name('admin.hostel_group.edit');
        Route::get('hostel_group/list', [AdminController::class, 'getHostelGroupList'])->name('admin.hostel_group.list');
        Route::post('hostel_group/add', [AdminController::class, 'addHostelGroup'])->name('admin.hostel_group.add');
        Route::post('hostel_group/hostel_group-details', [AdminController::class, 'getHostelGroupDetails'])->name('admin.hostel_group.details');
        Route::post('even/update', [AdminController::class, 'updateHostelGroup'])->name('admin.hostel_group.update');
        Route::post('hostel_group/delete', [AdminController::class, 'deleteHostelGroup'])->name('admin.hostel_group.delete');

        // Qualifications
        Route::get('qualification/index', [AdminController::class, 'qualification_view'])->name('admin.qualification');
        Route::post('qualification/add', [AdminController::class, 'qualification_add'])->name('admin.qualification.add');
        Route::get('qualification/list', [AdminController::class, 'getqualification_list'])->name('admin.qualification.list');
        Route::post('qualification/department-details', [AdminController::class, 'getQualificationsDetails'])->name('admin.qualification.details');
        Route::post('qualification/update', [AdminController::class, 'qualification_update'])->name('admin.qualification.update');
        Route::post('qualification/delete', [AdminController::class, 'qualification_delete'])->name('admin.qualification.delete');
        // Staff category
        Route::get('staffcategory/index', [AdminController::class, 'staffcategories_view'])->name('admin.staffcategory');
        Route::post('staffcategory/add', [AdminController::class, 'staffcategories_add'])->name('admin.staffcategory.add');
        Route::get('staffcategory/list', [AdminController::class, 'staffcategories_list'])->name('admin.staffcategory.list');
        Route::post('staffcategory/staffcategory-details', [AdminController::class, 'getstaffcategoriesDetails'])->name('admin.staffcategory.details');
        Route::post('staffcategory/update', [AdminController::class, 'staffcategories_edit'])->name('admin.staffcategory.update');
        Route::post('staffcategory/delete', [AdminController::class, 'staffcategories_delete'])->name('admin.staffcategory.delete');

        // department routes
        Route::get('department/index', [AdminController::class, 'Department'])->name('admin.department');
        Route::post('department/add', [AdminController::class, 'addDepartment'])->name('admin.department.add');
        Route::get('department/list', [AdminController::class, 'getDepartmentList'])->name('admin.department.list');
        Route::post('department/department-details', [AdminController::class, 'getDepartmentDetails'])->name('admin.department.details');
        Route::post('department/update', [AdminController::class, 'updateDepartment'])->name('admin.department.update');
        Route::post('department/delete', [AdminController::class, 'deleteDepartment'])->name('admin.department.delete');

        // designation routes
        Route::get('designation/index', [AdminController::class, 'Designation'])->name('admin.designation');
        Route::post('designation/add', [AdminController::class, 'addDesignation'])->name('admin.designation.add');
        Route::get('designation/list', [AdminController::class, 'getDesignationList'])->name('admin.designation.list');
        Route::post('designation/designation-details', [AdminController::class, 'getDesignationDetails'])->name('admin.designation.details');
        Route::post('designation/update', [AdminController::class, 'updateDesignation'])->name('admin.designation.update');
        Route::post('designation/delete', [AdminController::class, 'deleteDesignation'])->name('admin.designation.delete');

        // staff position routes
        Route::get('staff_position/index', [AdminController::class, 'staffPosition'])->name('admin.staff_position');
        Route::post('staff_position/add', [AdminController::class, 'addStaffPosition'])->name('admin.staff_position.add');
        Route::get('staff_position/list', [AdminController::class, 'getStaffPositionList'])->name('admin.staff_position.list');
        Route::post('staff_position/staff_position-details', [AdminController::class, 'getStaffPositionDetails'])->name('admin.staff_position.details');
        Route::post('staff_position/update', [AdminController::class, 'updateStaffPosition'])->name('admin.staff_position.update');
        Route::post('staff_position/delete', [AdminController::class, 'deleteStaffPosition'])->name('admin.staff_position.delete');

        // Stream Type routes
        Route::get('stream_type/index', [AdminController::class, 'streamType'])->name('admin.stream_type');
        Route::post('stream_type/add', [AdminController::class, 'addStreamType'])->name('admin.stream_type.add');
        Route::get('stream_type/list', [AdminController::class, 'getStreamTypeList'])->name('admin.stream_type.list');
        Route::post('stream_type/stream_type-details', [AdminController::class, 'getStreamTypeDetails'])->name('admin.stream_type.details');
        Route::post('stream_type/update', [AdminController::class, 'updateStreamType'])->name('admin.stream_type.update');
        Route::post('stream_type/delete', [AdminController::class, 'deleteStreamType'])->name('admin.stream_type.delete');

        // Religion routes
        Route::get('religion/index', [AdminController::class, 'religion'])->name('admin.religion');
        Route::post('religion/add', [AdminController::class, 'addReligion'])->name('admin.religion.add');
        Route::get('religion/list', [AdminController::class, 'getReligionList'])->name('admin.religion.list');
        Route::post('religion/religion-details', [AdminController::class, 'getReligionDetails'])->name('admin.religion.details');
        Route::post('religion/update', [AdminController::class, 'updateReligion'])->name('admin.religion.update');
        Route::post('religion/delete', [AdminController::class, 'deleteReligion'])->name('admin.religion.delete');

        // Race routes
        Route::get('race/index', [AdminController::class, 'race'])->name('admin.race');
        Route::post('race/add', [AdminController::class, 'addRace'])->name('admin.race.add');
        Route::get('race/list', [AdminController::class, 'getRaceList'])->name('admin.race.list');
        Route::post('race/race-details', [AdminController::class, 'getRaceDetails'])->name('admin.race.details');
        Route::post('race/update', [AdminController::class, 'updateRace'])->name('admin.race.update');
        Route::post('race/delete', [AdminController::class, 'deleteRace'])->name('admin.race.delete');

        // Time Table

        Route::post('timetable/add', [AdminController::class, 'addTimetable'])->name('admin.timetable.add');
        Route::get('timetable/create', [AdminController::class, 'createTimetable'])->name('admin.timetable.create');
        Route::get('timetable/index', [AdminController::class, 'timetable'])->name('admin.timetable');
        Route::post('timetable/timetable-details', [AdminController::class, 'getTimetable'])->name('admin.timetable.details');
        Route::post('timetable/edit', [AdminController::class, 'editTimetable'])->name('admin.timetable.edit');
        Route::post('timetable/update', [AdminController::class, 'updateTimetable'])->name('admin.timetable.update');
        Route::post('timetable/subject', [AdminController::class, 'getSubject'])->name('admin.timetable.subject');
        // copy timetable
        Route::get('timetable/copy', [AdminController::class, 'timetableCopy'])->name('admin.timetable.copy');
        Route::post('timetable/edit/copy', [AdminController::class, 'editTimetableCopy'])->name('admin.timetable.edit.copy');
        Route::post('timetable/save/copy', [AdminController::class, 'timetableCopySave'])->name('admin.timetable.copy.save');

        // promotion
        Route::get('promotion/index', [AdminController::class, 'Promotion'])->name('admin.promotion.index');
        Route::post('promotion/add', [AdminController::class, 'PromotionAdd'])->name('admin.promotion.add');

        // Time Table Bulk
        Route::post('timetable/bulk/add', [AdminController::class, 'addBulkTimetable'])->name('admin.timetable.bulk.add');
        Route::get('timetable/bulk/create', [AdminController::class, 'createBulkTimetable'])->name('admin.timetable.bulk.create');
        Route::post('timetable/bulk/subject', [AdminController::class, 'getBulkSubject'])->name('admin.timetable.bulk.subject');

        // Subject By Class Route
        Route::post('subject-by-class', [AdminController::class, 'subjectByClass'])->name('admin.subject_by_class');

        // Section By Class Route
        Route::post('section-by-class', [AdminController::class, 'sectionByClass'])->name('admin.section_by_class');
        Route::get('exam-by-classSection', [AdminController::class, 'examByClassSec'])->name('admin.exam_by_classSection');
        // Employee routes

        Route::get('employee/employeelist', [AdminController::class, 'listEmployee'])->name('admin.listemployee');
        Route::get('employee/index', [AdminController::class, 'showEmployee'])->name('admin.employee');
        Route::post('employee/add', [AdminController::class, 'addEmployee'])->name('admin.employee.add');
        Route::get('employee/list', [AdminController::class, 'getEmpList'])->name('admin.employee.list');
        Route::get('employee/edit/{id}', [AdminController::class, 'editEmployee'])->name('admin.employee.edit');
        Route::post('employee/update', [AdminController::class, 'updatEemployee'])->name('admin.employee.update');
        Route::post('employee/delete', [AdminController::class, 'deleteEmployee'])->name('admin.employee.delete');

        // Settings
        Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');
        Route::post('change-password', [AdminController::class, 'changeNewPassword'])->name('admin.settings.changeNewPassword');
        Route::post('update-profile-info', [AdminController::class, 'updateProfileInfo'])->name('admin.settings.updateProfileInfo');
        Route::get('settings/logo', [AdminController::class, 'settingsLogo'])->name('admin.settings.logo');
        Route::post('settings-update-logo', [CommonController::class, 'updateSettingSessionLogo'])->name('settings.update.logo');

        // static page routes start

        // Admission routes
        Route::get('admission/index', [AdminController::class, 'admission'])->name('admin.admission');
        Route::get('admission/import', [AdminController::class, 'import'])->name('admission.import');
        Route::post('admission/add', [AdminController::class, 'addAdmission'])->name('admin.admission.add');

        // Parent routes
        Route::get('parent/index', [AdminController::class, 'parent'])->name('admin.parent');
        Route::get('parent/create', [AdminController::class, 'createParent'])->name('admin.parent.create');
        Route::post('parent/add', [AdminController::class, 'addParent'])->name('admin.parent.add');
        Route::get('parent/list', [AdminController::class, 'getParentList'])->name('admin.parent.list');
        Route::get('parent/parent-details/{id}', [AdminController::class, 'getParentDetails'])->name('admin.parent.details');
        Route::post('parent/update', [AdminController::class, 'updateParent'])->name('admin.parent.update');
        Route::post('parent/delete', [AdminController::class, 'deleteParent'])->name('admin.parent.delete');

        // Homework routes
        Route::get('homework/index', [AdminController::class, 'homework'])->name('admin.homework');
        Route::post('homework/add', [AdminController::class, 'addHomework'])->name('admin.homework.add');
        Route::post('homework/homework-details', [AdminController::class, 'getHomework'])->name('admin.homework.details');
        Route::get('evaluation_report', [AdminController::class, 'evaluationReport'])->name('admin.evaluation_report');
        Route::post('homework/evaluation', [AdminController::class, 'evaluation'])->name('admin.homework.evaluation');
        Route::get('homework/edit', [AdminController::class, 'homeworkEdit'])->name('admin.homework_edit');

        Route::post('homework/view', [AdminController::class, 'viewHomework'])->name('admin.homework.view');

        // exam Term route
        Route::get('exam_term/index', [AdminController::class, 'examTerm'])->name('admin.exam_term');
        Route::post('exam_term/add', [AdminController::class, 'addExamTerm'])->name('admin.exam_term.add');
        Route::get('exam_term/list', [AdminController::class, 'getExamTermList'])->name('admin.exam_term.list');
        Route::post('exam_term/exam_term-details', [AdminController::class, 'getExamTermDetails'])->name('admin.exam_term.details');
        Route::post('exam_term/update', [AdminController::class, 'updateExamTerm'])->name('admin.exam_term.update');
        Route::post('exam_term/delete', [AdminController::class, 'deleteExamTerm'])->name('admin.exam_term.delete');

        // exam hall route
        Route::get('exam_hall/index', [AdminController::class, 'examHall'])->name('admin.exam_hall');
        Route::post('exam_hall/add', [AdminController::class, 'addExamHall'])->name('admin.exam_hall.add');
        Route::get('exam_hall/list', [AdminController::class, 'getExamHallList'])->name('admin.exam_hall.list');
        Route::post('exam_hall/exam_hall-details', [AdminController::class, 'getExamHallDetails'])->name('admin.exam_hall.details');
        Route::post('exam_hall/update', [AdminController::class, 'updateExamHall'])->name('admin.exam_hall.update');
        Route::post('exam_hall/delete', [AdminController::class, 'deleteExamHall'])->name('admin.exam_hall.delete');

        // exam route
        Route::get('exam/index', [AdminController::class, 'exam'])->name('admin.exam');
        Route::post('exam/add', [AdminController::class, 'addExam'])->name('admin.exam.add');
        Route::get('exam/list', [AdminController::class, 'getExamList'])->name('admin.exam.list');
        Route::post('exam/exam-details', [AdminController::class, 'getExamDetails'])->name('admin.exam.details');
        Route::post('exam/update', [AdminController::class, 'updateExam'])->name('admin.exam.update');
        Route::post('exam/delete', [AdminController::class, 'deleteExam'])->name('admin.exam.delete');
        // exam papers route
        Route::get('exam_paper/index', [AdminController::class, 'examPaper'])->name('admin.exam_paper');
        Route::get('exam_paper/list', [AdminController::class, 'getExamPaperList'])->name('admin.exam_paper.list');
        // exam papers route
        Route::get('grade_category/index', [AdminController::class, 'gradeCategory'])->name('admin.grade_category');
        Route::get('grade_category/list', [AdminController::class, 'getGradeCategoryList'])->name('admin.grade_category.list');
        // exam routes
        Route::get('exam/mark_distribution', [AdminController::class, 'examMarkDistribution'])->name('admin.exam.mark_distribution');
        // Route::get('exam/exam', [AdminController::class, 'exam'])->name('admin.exam.exam');


        // exam timetable
        Route::post('timetable/exam', [AdminController::class, 'timetableExam'])->name('admin.exam_timetable');
        Route::post('timetable/getexam', [AdminController::class, 'getExamTimetable'])->name('admin.exam_timetable.get');
        Route::post('timetable/viewexam', [AdminController::class, 'viewExamTimetable'])->name('admin.exam_timetable.view');
        Route::post('timetable/addexam', [AdminController::class, 'addExamTimetable'])->name('admin.exam_timetable.add');
        Route::post('timetable/deleteexam', [AdminController::class, 'deleteExamTimetable'])->name('admin.exam_timetable.delete');

        Route::get('timetable/viewexam', [AdminController::class, 'timeTableViewExam'])->name('admin.timetable.viewexam');
        Route::get('timetable/set_examwise', [AdminController::class, 'timeTableSetExamWise'])->name('admin.timetable.set_examwise');
        // exam marks
        Route::get('exam/mark_entry', [AdminController::class, 'markEntry'])->name('admin.exam.mark_entry');
        // grade range
        Route::get('exam/grade', [AdminController::class, 'grade'])->name('admin.exam.grade');

        // grade routes
        Route::get('grade/index', [AdminController::class, 'grade'])->name('admin.grade');
        Route::post('grade/add', [AdminController::class, 'addGrade'])->name('admin.grade.add');
        Route::get('grade/list', [AdminController::class, 'getGradeList'])->name('admin.grade.list');
        Route::post('grade/grade-details', [AdminController::class, 'getGradeDetails'])->name('admin.grade.details');
        Route::post('grade/update', [AdminController::class, 'updateGrade'])->name('admin.grade.update');
        Route::post('grade/delete', [AdminController::class, 'deleteGrade'])->name('admin.grade.delete');
        // Hostel routes
        Route::get('hostel/index', [AdminController::class, 'hostel'])->name('admin.hostel');
        Route::get('hostel/list', [AdminController::class, 'getHostelList'])->name('admin.hostel.list');
        Route::post('hostel/add', [AdminController::class, 'addHostel'])->name('admin.hostel.add');
        Route::post('hostel/hostel-details', [AdminController::class, 'getHostelDetails'])->name('admin.hostel.details');
        Route::post('hostel/update', [AdminController::class, 'updateHostel'])->name('admin.hostel.update');
        Route::post('hostel/delete', [AdminController::class, 'deleteHostel'])->name('admin.hostel.delete');

        // Hostel Room routes
        Route::get('hostel_room/index', [AdminController::class, 'hostelRoom'])->name('admin.hostel_room');
        Route::get('hostel_room/list', [AdminController::class, 'getHostelRoomList'])->name('admin.hostel_room.list');
        Route::post('hostel_room/add', [AdminController::class, 'addHostelRoom'])->name('admin.hostel_room.add');
        Route::post('hostel_room/hostel_room-details', [AdminController::class, 'getHostelRoomDetails'])->name('admin.hostel_room.details');
        Route::post('hostel_room/update', [AdminController::class, 'updateHostelRoom'])->name('admin.hostel_room.update');
        Route::post('hostel_room/delete', [AdminController::class, 'deleteHostelRoom'])->name('admin.hostel_room.delete');

        // Hostel Category routes
        Route::get('hostel_category/index', [AdminController::class, 'hostelCategory'])->name('admin.hostel_category');
        Route::get('hostel_category/list', [AdminController::class, 'getHostelCategoryList'])->name('admin.hostel_category.list');
        Route::post('hostel_category/add', [AdminController::class, 'addHostelCategory'])->name('admin.hostel_category.add');
        Route::post('hostel_category/hostel_category-details', [AdminController::class, 'getHostelCategoryDetails'])->name('admin.hostel_category.details');
        Route::post('hostel_category/update', [AdminController::class, 'updateHostelCategory'])->name('admin.hostel_category.update');
        Route::post('hostel_category/delete', [AdminController::class, 'deleteHostelCategory'])->name('admin.hostel_category.delete');

        // Hostel Block routes
        Route::get('hostel_block/index', [AdminController::class, 'hostelBlock'])->name('admin.hostel_block');
        Route::get('hostel_block/list', [AdminController::class, 'getHostelBlockList'])->name('admin.hostel_block.list');
        Route::post('hostel_block/add', [AdminController::class, 'addHostelBlock'])->name('admin.hostel_block.add');
        Route::post('hostel_block/hostel_block-details', [AdminController::class, 'getHostelBlockDetails'])->name('admin.hostel_block.details');
        Route::post('hostel_block/update', [AdminController::class, 'updateHostelBlock'])->name('admin.hostel_block.update');
        Route::post('hostel_block/delete', [AdminController::class, 'deleteHostelBlock'])->name('admin.hostel_block.delete');

        // Hostel Floor routes
        Route::get('hostel_floor/index', [AdminController::class, 'hostelFloor'])->name('admin.hostel_floor');
        Route::get('hostel_floor/list', [AdminController::class, 'getHostelFloorList'])->name('admin.hostel_floor.list');
        Route::post('hostel_floor/add', [AdminController::class, 'addHostelFloor'])->name('admin.hostel_floor.add');
        Route::post('hostel_floor/hostel_floor-details', [AdminController::class, 'getHostelFloorDetails'])->name('admin.hostel_floor.details');
        Route::post('hostel_floor/update', [AdminController::class, 'updateHostelFloor'])->name('admin.hostel_floor.update');
        Route::post('hostel_floor/delete', [AdminController::class, 'deleteHostelFloor'])->name('admin.hostel_floor.delete');


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
        Route::get('forum/page-edit-topic/{id}', [AdminController::class, 'forumPageEditTopic'])->name('admin.forum.page-edit-topic');
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
        Route::get('attendance/student_report', [AdminController::class, 'studentAttendanceReport'])->name('admin.attendance.student_report');
        Route::post('attendance/student_excel', [AdminController::class, 'studentAttendanceExcel'])->name('admin.attendance.student_excel');
        Route::get('attendance/student_entry', [AdminController::class, 'studentEntry'])->name('admin.attendance.student_entry');
        Route::get('attendance/employee_entry', [AdminController::class, 'employeeEntry'])->name('admin.attendance.employee_entry');
        Route::get('attendance/exam_entry', [AdminController::class, 'examEntry'])->name('admin.attendance.exam_entry');
        Route::post('attendance/employee_list', [AdminController::class, 'getEmployeeAttendanceList'])->name('admin.attendance.employee_list');
        Route::post('attendance/employee_add', [AdminController::class, 'addEmployeeAttendance'])->name('admin.attendance.employee_add');
        Route::get('attendance/employee/report', [AdminController::class, 'reportEmployeeAttendance'])->name('admin.attendance.employee_report');
        // admin student_leave list
        Route::get('student-leave/list', [AdminController::class, 'studentLeaveShow'])->name('admin.student_leave.list');
        // Route::post('all-student-leave/list', [AdminController::class, 'getStudentLeaveList'])->name('admin.all_tudent_leave.list');

        //class room Routes
        Route::get('classroom/classroom-management', [AdminController::class, 'classroomManagement'])->name('admin.classroom.management');
        Route::post('classroomAdd', [AdminController::class, 'classroomPost'])->name('admin.classroom.add');
        Route::post('getShortTest', [AdminController::class, 'getShortTest'])->name('admin.classroom.get_short_test');
        Route::post('add_short_test', [AdminController::class, 'addShortTest'])->name('admin.classroom.add_short_test');
        Route::post('add_daily_report', [AdminController::class, 'addDailyReport'])->name('admin.classroom.add_daily_report');
        Route::post('add_daily_report_remarks', [AdminController::class, 'addDailyReportRemarks'])->name('admin.classroom.add_daily_report_remarks');
        //faq route

        // faq        
        Route::get('faq/index', [AdminController::class, 'faqIndex'])->name('admin.faq.index');
        // 2fa
        Route::get('twofa/index', [AdminController::class, 'twoFA'])->name('admin.twofa');
        //Task routes
        Route::get('task/index', [AdminController::class, 'taskIndex'])->name('admin.task');
        Route::get('task/create', [AdminController::class, 'createTask'])->name('admin.task.create');
        Route::post('task/add', [AdminController::class, 'addToDoList'])->name('admin.task.add');
        Route::post('task/update', [AdminController::class, 'updateToDoList'])->name('admin.task.update');
        Route::get('task/get', [AdminController::class, 'getToDoList'])->name('admin.task.get');
        Route::get('task/edit/{id}', [AdminController::class, 'editToDoList'])->name('admin.task.edit');

        // static page routes end
        // Settings
        // Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');

        Route::post('form/page-create-topic', [AdminController::class, 'createpost'])->name('admin.forum.create-topic');
        Route::post('form/page-update-topic', [AdminController::class, 'updatepost'])->name('admin.forum.update-topic');
        Route::get('forum/page-single-topic-val/{id}/{user_id}', [AdminController::class, 'forumPageSingleTopicwithvalue'])->name('admin.forum.page-single-topic-val');
        Route::get('forum/page-categories-single-val/{categId}/{user_id}/{category_names}', [AdminController::class, 'forumPageCategoriesSingle'])->name('admin.forum.page-categories-single-val');
        Route::post('form/postimage', [AdminController::class, 'imagestore'])->name('admin.forum.image.store');
        //  Route::post('form/postimage', [CommonController::class, 'imagestore'])->name('forum.image.store');

        // vehicle By route 
        Route::post('vehicle-by-route', [AdminController::class, 'vehicleByRoute'])->name('admin.vehicle_by_route');

        // room By hostel Route
        Route::post('room-by-hostel', [AdminController::class, 'roomByHostel'])->name('admin.room_by_hostel');

        // exam Result Group 
        Route::get('exam_results/byclass', [AdminController::class, 'byclasss'])->name('admin.exam_results.byclass');
        Route::get('exam_results/bysubject', [AdminController::class, 'bysubject'])->name('admin.exam_results.bysubject');
        Route::get('exam_results/overall', [AdminController::class, 'overall'])->name('admin.exam_results.overall');
        Route::get('exam_results/bystudent', [AdminController::class, 'bystudent'])->name('admin.exam_results.bystudent');
        Route::get('exam/result', [AdminController::class, 'examResult'])->name('admin.exam.result');
        // exam result end
        // download pdf
        Route::post('exam_results/downbyclass', [PdfController::class, 'downbyclass'])->name('admin.exam_results.downbyclass');
        Route::post('exam_results/downbysubject', [PdfController::class, 'downbysubject'])->name('admin.exam_results.downbysubject');
        Route::post('exam_results/downbystudent', [PdfController::class, 'downbystudent'])->name('admin.exam_results.downbystudent');
        Route::post('exam_results/downbyoverall', [PdfController::class, 'downbyoverall'])->name('admin.exam_results.downbyoverall');
        Route::post('exam_results/downbystudentroll', [PdfController::class, 'downbystudentroll'])->name('admin.exam_results.downbystudentroll');
        Route::post('exam_results/downbypaperwise', [PdfController::class, 'downbypaperwise'])->name('admin.exam_results.downbypaperwise');
        Route::post('exam_results/downbytest_paper', [PdfController::class, 'downbytest_paper'])->name('admin.exam_results.downbytest_paper');
        Route::post('timetable/pdf', [PdfController::class, 'timetable_pdf'])->name('admin.timetable.pdf');
        Route::post('attendance/student_pdf', [PdfController::class, 'attendance_student_pdf'])->name('admin.attendance.student_pdf');
        Route::post('attendance/employee_pdf', [PdfController::class, 'attendance_employee_pdf'])->name('admin.attendance.employee_pdf');
        // Test Result Route
        Route::get('test_result', [AdminController::class, 'testResult'])->name('admin.test_result');
        Route::get('exam_results/paper_wise_result', [AdminController::class, 'paperWiseResult'])->name('admin.paper_wise_result');

        Route::post('subjectmarksAdd', [AdminController::class, 'subjectmarks'])->name('admin.subjectmarks.add');
        Route::post('subjectdivisionAdd', [AdminController::class, 'subjectdivisionAdd'])->name('admin.subjectdivision.add');

        // Leave Type routes
        Route::get('leave_type/index', [AdminController::class, 'leaveType'])->name('admin.leave_type');
        Route::get('leave_type/list', [AdminController::class, 'getLeaveTypeList'])->name('admin.leave_type.list');
        Route::post('leave_type/add', [AdminController::class, 'addLeaveType'])->name('admin.leave_type.add');
        Route::post('leave_type/leave_type-details', [AdminController::class, 'getLeaveTypeDetails'])->name('admin.leave_type.details');
        Route::post('leave_type/update', [AdminController::class, 'updateLeaveType'])->name('admin.leave_type.update');
        Route::post('leave_type/delete', [AdminController::class, 'deleteLeaveType'])->name('admin.leave_type.delete');

        // Staff Leave Assign routes
        Route::get('staff_leave_assign/index', [AdminController::class, 'staffLeaveAssign'])->name('admin.staff_leave_assign');
        Route::get('staff_leave_assign/list', [AdminController::class, 'getStaffLeaveAssignList'])->name('admin.staff_leave_assign.list');
        Route::post('staff_leave_assign/add', [AdminController::class, 'addStaffLeaveAssign'])->name('admin.staff_leave_assign.add');
        Route::get('staff_leave_assign/edit/{id}', [AdminController::class, 'staffLeaveAssignEdit'])->name('admin.staff_leave_assign.edit');
        Route::post('staff_leave_assign/staff_leave_assign-details', [AdminController::class, 'getStaffLeaveAssignDetails'])->name('admin.staff_leave_assign.details');
        Route::post('staff_leave_assign/update', [AdminController::class, 'updateStaffLeaveAssign'])->name('admin.staff_leave_assign.update');
        Route::post('staff_leave_assign/delete', [AdminController::class, 'deleteStaffLeaveAssign'])->name('admin.staff_leave_assign.delete');

        // Transport Route routes
        Route::get('transport_route/index', [AdminController::class, 'transportRoute'])->name('admin.transport_route');
        Route::get('transport_route/list', [AdminController::class, 'getTransportRouteList'])->name('admin.transport_route.list');
        Route::post('transport_route/add', [AdminController::class, 'addTransportRoute'])->name('admin.transport_route.add');
        Route::post('transport_route/transport_route-details', [AdminController::class, 'getTransportRouteDetails'])->name('admin.transport_route.details');
        Route::post('transport_route/update', [AdminController::class, 'updateTransportRoute'])->name('admin.transport_route.update');
        Route::post('transport_route/delete', [AdminController::class, 'deleteTransportRoute'])->name('admin.transport_route.delete');

        // TransportVehicle Route 

        Route::get('transport_vehicle/index', [AdminController::class, 'transportVehicle'])->name('admin.transport_vehicle');
        Route::get('transport_vehicle/list', [AdminController::class, 'getTransportVehicleList'])->name('admin.transport_vehicle.list');
        Route::post('transport_vehicle/add', [AdminController::class, 'addTransportVehicle'])->name('admin.transport_vehicle.add');
        Route::post('transport_vehicle/transport_vehicle-details', [AdminController::class, 'getTransportVehicleDetails'])->name('admin.transport_vehicle.details');
        Route::post('transport_vehicle/update', [AdminController::class, 'updateTransportVehicle'])->name('admin.transport_vehicle.update');
        Route::post('transport_vehicle/delete', [AdminController::class, 'deleteTransportVehicle'])->name('admin.transport_vehicle.delete');

        // Transport Stoppage Route 
        Route::get('transport_stoppage/index', [AdminController::class, 'transportStoppage'])->name('admin.transport_stoppage');
        Route::get('transport_stoppage/list', [AdminController::class, 'getTransportStoppageList'])->name('admin.transport_stoppage.list');
        Route::post('transport_stoppage/add', [AdminController::class, 'addTransportStoppage'])->name('admin.transport_stoppage.add');
        Route::post('transport_stoppage/transport_stoppage-details', [AdminController::class, 'getTransportStoppageDetails'])->name('admin.transport_stoppage.details');
        Route::post('transport_stoppage/update', [AdminController::class, 'updateTransportStoppage'])->name('admin.transport_stoppage.update');
        Route::post('transport_stoppage/delete', [AdminController::class, 'deleteTransportStoppage'])->name('admin.transport_stoppage.delete');

        // Transport Assign Route 
        Route::get('transport_assign/index', [AdminController::class, 'transportAssign'])->name('admin.transport_assign');
        Route::get('transport_assign/list', [AdminController::class, 'getTransportAssignList'])->name('admin.transport_assign.list');
        Route::post('transport_assign/add', [AdminController::class, 'addTransportAssign'])->name('admin.transport_assign.add');
        Route::post('transport_assign/transport_assign-details', [AdminController::class, 'getTransportAssignDetails'])->name('admin.transport_assign.details');
        Route::post('transport_assign/update', [AdminController::class, 'updateTransportAssign'])->name('admin.transport_assign.update');
        Route::post('transport_assign/delete', [AdminController::class, 'deleteTransportAssign'])->name('admin.transport_assign.delete');
        // LEAVE MANAGEMENT ROUTES start
        // Leave Apply
        Route::get('leave_management/applyleave', [AdminController::class, 'applyleave'])->name('admin.leave_management.applyleave');
        // Leave approval
        Route::post('leave_management/applyleave_save', [AdminController::class, 'staffApplyLeave'])->name('admin.leave_management.add');
        // Route::get('leave_management/approvalleave', [AdminController::class, 'approvalleave'])->name('admin.leave_management.approvalleave');
        // Leave allLeaves
        Route::get('leave_management/allleaves', [AdminController::class, 'allleaves'])->name('admin.leave_management.allleaves');
        Route::get('leave_management/all_leave_list', [AdminController::class, 'getAllLeaveList'])->name('admin.leave_management.list');
        Route::get('leave_management/applyleave_list', [AdminController::class, 'getStaffLeaveList'])->name('admin.leave_management.apply_list');
        Route::get('leave_management/assign_leave_approval', [AdminController::class, 'assignLeaveApprover'])->name('admin.leave_management.assign_leave_approver');
        Route::get('leave_management/relief_assignment', [AdminController::class, 'reliefAssignment'])->name('admin.leave_management.relief_assignment');
        // Route::get('leave_management/get_all_staff_details', [AdminController::class, 'getAllStaffDetails'])->name('admin.leave_management.get_all_staff_details');
        Route::post('leave_management/reupload_file', [AdminController::class, 'reUploadLeaveFile'])->name('admin.reupload_file.add');
        //
        Route::get('get_all_leave_relief_assignment', [AdminController::class, 'getAllLeaveReliefAssignment'])->name('admin.relief_assignment.list');

        // Education routes
        Route::get('education/index', [AdminController::class, 'education'])->name('admin.education');
        Route::post('education/add', [AdminController::class, 'addEducation'])->name('admin.education.add');
        Route::get('education/list', [AdminController::class, 'getEducationList'])->name('admin.education.list');
        Route::post('education/education-details', [AdminController::class, 'getEducationDetails'])->name('admin.education.details');
        Route::post('education/update', [AdminController::class, 'updateEducation'])->name('admin.education.update');
        Route::post('education/delete', [AdminController::class, 'deleteEducation'])->name('admin.education.delete');

        // Absent Reason routes
        Route::get('absent_reason/index', [AdminController::class, 'absentReason'])->name('admin.absent_reason');
        Route::post('absent_reason/add', [AdminController::class, 'addAbsentReason'])->name('admin.absent_reason.add');
        Route::get('absent_reason/list', [AdminController::class, 'getAbsentReasonList'])->name('admin.absent_reason.list');
        Route::post('absent_reason/absent-reason-details', [AdminController::class, 'getAbsentReasonDetails'])->name('admin.absent_reason.details');
        Route::post('absent_reason/update', [AdminController::class, 'updateAbsentReason'])->name('admin.absent_reason.update');
        Route::post('absent_reason/delete', [AdminController::class, 'deleteAbsentReason'])->name('admin.absent_reason.delete');

        // Late Reason routes
        Route::get('late_reason/index', [AdminController::class, 'lateReason'])->name('admin.late_reason');
        Route::post('late_reason/add', [AdminController::class, 'addLateReason'])->name('admin.late_reason.add');
        Route::get('late_reason/list', [AdminController::class, 'getLateReasonList'])->name('admin.late_reason.list');
        Route::post('late_reason/late-reason-details', [AdminController::class, 'getLateReasonDetails'])->name('admin.late_reason.details');
        Route::post('late_reason/update', [AdminController::class, 'updateLateReason'])->name('admin.late_reason.update');
        Route::post('late_reason/delete', [AdminController::class, 'deleteLateReason'])->name('admin.late_reason.delete');

        // Excused Reason routes
        Route::get('excused_reason/index', [AdminController::class, 'excusedReason'])->name('admin.excused_reason');
        Route::post('excused_reason/add', [AdminController::class, 'addExcusedReason'])->name('admin.excused_reason.add');
        Route::get('excused_reason/list', [AdminController::class, 'getExcusedReasonList'])->name('admin.excused_reason.list');
        Route::post('excused_reason/excused-reason-details', [AdminController::class, 'getExcusedReasonDetails'])->name('admin.excused_reason.details');
        Route::post('excused_reason/update', [AdminController::class, 'updateExcusedReason'])->name('admin.excused_reason.update');
        Route::post('excused_reason/delete', [AdminController::class, 'deleteExcusedReason'])->name('admin.excused_reason.delete');


        // Semester routes
        Route::get('semester/index', [AdminController::class, 'semester'])->name('admin.semester');
        Route::post('semester/add', [AdminController::class, 'addSemester'])->name('admin.semester.add');
        Route::get('semester/list', [AdminController::class, 'getSemesterList'])->name('admin.semester.list');
        Route::post('semester/semester-details', [AdminController::class, 'getSemesterDetails'])->name('admin.semester.details');
        Route::post('semester/update', [AdminController::class, 'updateSemester'])->name('admin.semester.update');
        Route::post('semester/delete', [AdminController::class, 'deleteSemester'])->name('admin.semester.delete');
        // Acdemic year routes
        Route::get('academic_year', [AdminController::class, 'academicYear'])->name('admin.academic_year');
        Route::get('academic_year/list', [AdminController::class, 'getAcademicYearList'])->name('admin.academic_year.list');

        // Global Setting routes
        Route::get('global_setting/index', [AdminController::class, 'globalSetting'])->name('admin.global_setting');
        Route::get('global_setting/list', [AdminController::class, 'getGlobalSettingList'])->name('admin.global_setting.list');
        Route::post('global_setting/add', [AdminController::class, 'addGlobalSetting'])->name('admin.global_setting.add');
        Route::post('global_setting/global_setting-details', [AdminController::class, 'getGlobalSettingDetails'])->name('admin.global_setting.details');
        Route::post('global_setting/update', [AdminController::class, 'updateGlobalSetting'])->name('admin.global_setting.update');
        Route::post('global_setting/delete', [AdminController::class, 'deleteGlobalSetting'])->name('admin.global_setting.delete');
        // copy acdemic and exam master one page to another page
        Route::get('acdemic/copy/assign_teacher', [AdminController::class, 'acdemicCopyAssignTeacher'])->name('admin.acdemic.copy.assign_teacher');
        Route::get('acdemic/copy/grade_assign', [AdminController::class, 'acdemicCopyGradeAssign'])->name('admin.acdemic.copy.grade_assign');
        Route::get('acdemic/copy/subject_teacher_assign', [AdminController::class, 'acdemicCopySubjectTeacherAssign'])->name('admin.acdemic.copy.subject_teacher_assign');
        Route::get('exam_master/copy/exam_setup', [AdminController::class, 'examMasterCopyExamSetup'])->name('admin.exam_master.copy.exam_setup');
        Route::get('exam_master/copy/exam_paper', [AdminController::class, 'examMasterCopyExamPaper'])->name('admin.exam_master.copy.exam_paper');
        Route::post('timetable/pdf', [PdfController::class, 'timetable_pdf'])->name('admin.timetable.pdf');

        // Soap routes
        Route::get('soap/index', [AdminController::class, 'soap'])->name('admin.soap');
        Route::get('soap/list', [AdminController::class, 'getSoapList'])->name('admin.soap.list');
        Route::post('soap/add', [AdminController::class, 'addSoap'])->name('admin.soap.add');
        // Route::get('soap/edit/{id}', [AdminController::class, 'editSoap'])->name('admin.soap.edit');
        // Route::post('soap/delete', [AdminController::class, 'deleteSoap'])->name('admin.soap.delete');

        // soap_category routes
        Route::get('soap_category/index', [AdminController::class, 'soapCategory'])->name('admin.soap_category');
        Route::post('soap_category/add', [AdminController::class, 'addSoapCategory'])->name('admin.soap_category.add');
        Route::get('soap_category/list', [AdminController::class, 'getSoapCategoryList'])->name('admin.soap_category.list');
        Route::post('soap_category/soap_category-details', [AdminController::class, 'getSoapCategoryDetails'])->name('admin.soap_category.details');
        Route::post('soap_category/update', [AdminController::class, 'updateSoapCategory'])->name('admin.soap_category.update');
        Route::post('soap_category/delete', [AdminController::class, 'deleteSoapCategory'])->name('admin.soap_category.delete');

        // soap_sub_category routes
        Route::get('soap_sub_category/index', [AdminController::class, 'soapSubCategory'])->name('admin.soap_sub_category');
        Route::post('soap_sub_category/add', [AdminController::class, 'addSoapSubCategory'])->name('admin.soap_sub_category.add');
        Route::get('soap_sub_category/list', [AdminController::class, 'getSoapSubCategoryList'])->name('admin.soap_sub_category.list');
        Route::post('soap_sub_category/soap_sub_category-details', [AdminController::class, 'getSoapSubCategoryDetails'])->name('admin.soap_sub_category.details');
        Route::post('soap_sub_category/update', [AdminController::class, 'updateSoapSubCategory'])->name('admin.soap_sub_category.update');
        Route::post('soap_sub_category/delete', [AdminController::class, 'deleteSoapSubCategory'])->name('admin.soap_sub_category.delete');

        // soap_notes routes
        Route::get('soap_notes/index', [AdminController::class, 'soapNotes'])->name('admin.soap_notes');
        Route::post('soap_notes/add', [AdminController::class, 'addSoapNotes'])->name('admin.soap_notes.add');
        Route::get('soap_notes/list', [AdminController::class, 'getSoapNotesList'])->name('admin.soap_notes.list');
        Route::post('soap_notes/soap_notes-details', [AdminController::class, 'getSoapNotesDetails'])->name('admin.soap_notes.details');
        Route::post('soap_notes/update', [AdminController::class, 'updateSoapNotes'])->name('admin.soap_notes.update');
        Route::post('soap_notes/delete', [AdminController::class, 'deleteSoapNotes'])->name('admin.soap_notes.delete');


        // soap_subject routes
        Route::get('soap_subject/create', [AdminController::class, 'createSoapSubject'])->name('admin.soap_subject.create');
        Route::post('soap_subject/add', [AdminController::class, 'addSoapSubject'])->name('admin.soap_subject.add');
        Route::get('soap_subject/list', [AdminController::class, 'getSoapSubjectList'])->name('admin.soap_subject.list');
        Route::get('soap_subject/edit/{id}', [AdminController::class, 'editSoapSubject'])->name('admin.soap_subject.edit');
        Route::post('soap_subject/update', [AdminController::class, 'updateSoapSubject'])->name('admin.soap_subject.update');
        Route::post('soap_subject/delete', [AdminController::class, 'deleteSoapSubject'])->name('admin.soap_subject.delete');

        Route::get('soap_log/index', [AdminController::class, 'soapLog'])->name('admin.soap_log');
        Route::get('soap_log/list', [AdminController::class, 'getSoapLogList'])->name('admin.soap_log.list');
        // Route::get('student/list', [AdminController::class, 'studentList'])->name('admin.student.list');
        Route::post('soap_student_id', [CommonController::class, 'soapStudentID'])->name('admin.settings.soap_student_id');
        // scedule download
        Route::post('scedule/exam_schedule_download_excel', [CommonController::class, 'examScheduleDownloadExcel'])->name('admin.exam_schedule_download_excel');

        // PaymentMode routes
        Route::get('payment_mode/index', [AdminController::class, 'paymentMode'])->name('admin.payment_mode');
        Route::get('payment_mode/list', [AdminController::class, 'getPaymentModeList'])->name('admin.payment_mode.list');
        Route::post('payment_mode/add', [AdminController::class, 'addPaymentMode'])->name('admin.payment_mode.add');
        Route::post('payment_mode/payment_mode-details', [AdminController::class, 'getPaymentModeDetails'])->name('admin.payment_mode.details');
        Route::post('payment_mode/update', [AdminController::class, 'updatePaymentMode'])->name('admin.payment_mode.update');
        Route::post('payment_mode/delete', [AdminController::class, 'deletePaymentMode'])->name('admin.payment_mode.delete');

        // PaymentStatus routes
        Route::get('payment_status/index', [AdminController::class, 'paymentStatus'])->name('admin.payment_status');
        Route::get('payment_status/list', [AdminController::class, 'getPaymentStatusList'])->name('admin.payment_status.list');
        Route::post('payment_status/add', [AdminController::class, 'addPaymentStatus'])->name('admin.payment_status.add');
        Route::post('payment_status/payment_status-details', [AdminController::class, 'getPaymentStatusDetails'])->name('admin.payment_status.details');
        Route::post('payment_status/update', [AdminController::class, 'updatePaymentStatus'])->name('admin.payment_status.update');
        Route::post('payment_status/delete', [AdminController::class, 'deletePaymentStatus'])->name('admin.payment_status.delete');

        // FeesType routes
        Route::get('fees_type/index', [AdminController::class, 'feesType'])->name('admin.fees_type');
        Route::get('fees_type/list', [AdminController::class, 'getFeesTypeList'])->name('admin.fees_type.list');
        Route::post('fees_type/add', [AdminController::class, 'addFeesType'])->name('admin.fees_type.add');
        Route::post('fees_type/fees_type-details', [AdminController::class, 'getFeesTypeDetails'])->name('admin.fees_type.details');
        Route::post('fees_type/update', [AdminController::class, 'updateFeesType'])->name('admin.fees_type.update');
        Route::post('fees_type/delete', [AdminController::class, 'deleteFeesType'])->name('admin.fees_type.delete');

        // Fees routes
        Route::get('fees/index', [AdminController::class, 'fees'])->name('admin.fees');
        Route::get('fees/edit/{id}', [AdminController::class, 'editFees'])->name('admin.fees.edit');
        Route::post('fees/update', [AdminController::class, 'updateFees'])->name('admin.fees.update');

        // FeesGroup routes
        Route::get('fees_group/index', [AdminController::class, 'feesGroup'])->name('admin.fees_group');
        Route::get('fees_group/create', [AdminController::class, 'createFeesGroup'])->name('admin.fees_group.create');
        Route::get('fees_group/list', [AdminController::class, 'getFeesGroupList'])->name('admin.fees_group.list');
        Route::post('fees_group/add', [AdminController::class, 'addFeesGroup'])->name('admin.fees_group.add');
        Route::get('fees_group/edit/{id}', [AdminController::class, 'editFeesGroup'])->name('admin.fees_group.edit');
        Route::post('fees_group/update', [AdminController::class, 'updateFeesGroup'])->name('admin.fees_group.update');
        Route::post('fees_group/delete', [AdminController::class, 'deleteFeesGroup'])->name('admin.fees_group.delete');

        // fees allocation
        Route::get('fees/fees_allocation', [AdminController::class, 'feesAllocation'])->name('admin.fees_allocation');
        Route::post('fees/add_fees_allocation', [AdminController::class, 'addFeesAllocation'])->name('admin.fees.add_fees_allocation');
        Route::post('fees/fees_delete', [AdminController::class, 'feesDelete'])->name('admin.fees.fees_delete');


        // employee master import routes
        Route::get('employee/import', [AdminController::class, 'employeeImport'])->name('admin.employee.import');
        Route::post('employee/import/add', [AdminController::class, 'employeeImportAdd'])->name('admin.employee.import.add');
        // parent master import routes
        Route::get('parent/import', [AdminController::class, 'parentImport'])->name('admin.parent.import');
        Route::post('parent/import/add', [AdminController::class, 'parentImportAdd'])->name('admin.parent.import.add');
        // student master import routes
        Route::get('student/import', [AdminController::class, 'studentImport'])->name('admin.student.import');
        Route::post('student/import/add', [AdminController::class, 'studentImportAdd'])->name('admin.student.import.add');
    });
});
// admin routes end

// TEACHER CONTROLLER START
Route::group(['prefix' => 'staff'], function () {

    Route::get('/login', [AuthController::class, 'staffLoginForm'])->name('staff.login');
    Route::any('/authenticate', [AuthController::class, 'authenticateStaff'])->name('staff.authenticate');
    Route::post('/logout', [AuthController::class, 'logoutStaff'])->name('staff.logout');

    Route::group(['middleware' => ['isStaff']], function () {
        Route::get('/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');

        // Forum routes
        Route::get('forum/index', [StaffController::class, 'forumIndex'])->name('staff.forum.index');
        Route::get('forum/page-single-topic', [StaffController::class, 'forumPageSingleTopic'])->name('staff.forum.page-single-topic');
        Route::get('forum/page-create-topic', [StaffController::class, 'forumPageCreateTopic'])->name('staff.forum.page-create-topic');
        Route::get('forum/page-edit-topic/{id}', [StaffController::class, 'forumPageEditTopic'])->name('staff.forum.page-edit-topic');
        Route::get('forum/page-single-user', [StaffController::class, 'forumPageSingleUser'])->name('staff.forum.page-single-user');
        Route::get('forum/page-single-threads', [StaffController::class, 'forumPageSingleThreads'])->name('staff.forum.page-single-threads');
        Route::get('forum/page-single-replies', [StaffController::class, 'forumPageSingleReplies'])->name('staff.forum.page-single-replies');
        Route::get('forum/page-single-followers', [StaffController::class, 'forumPageSingleFollowers'])->name('staff.forum.page-single-followers');
        Route::get('forum/page-single-categories', [StaffController::class, 'forumPageSingleCategories'])->name('staff.forum.page-single-categories');
        Route::get('forum/page-categories', [StaffController::class, 'forumPageCategories'])->name('staff.forum.page-categories');
        Route::get('forum/page-categories-single', [StaffController::class, 'forumPageCategoriesSingle'])->name('staff.forum.page-categories-single');
        Route::get('forum/page-tabs', [StaffController::class, 'forumPageTabs'])->name('staff.forum.page-tabs');
        Route::get('forum/page-tabs-guidelines', [StaffController::class, 'forumPageTabGuidelines'])->name('staff.forum.page-tabs-guidelines');

        Route::post('form/page-create-topic', [StaffController::class, 'createpost'])->name('staff.forum.create-topic');
        Route::post('form/page-update-topic', [StaffController::class, 'updatepost'])->name('staff.forum.update-topic');
        Route::get('forum/page-single-topic-val/{id}/{user_id}', [StaffController::class, 'forumPageSingleTopicwithvalue'])->name('staff.forum.page-single-topic-val');
        Route::get('forum/page-categories-single-val/{categId}/{user_id}/{category_names}', [StaffController::class, 'forumPageCategoriesSingle'])->name('staff.forum.page-categories-single-val');
        Route::post('form/postimage', [StaffController::class, 'imagestore'])->name('staff.forum.image.store');
        // Settings
        Route::get('settings', [StaffController::class, 'settings'])->name('staff.settings');
        Route::post('change-password', [StaffController::class, 'changeNewPassword'])->name('staff.settings.changeNewPassword');
        Route::post('update-profile-info', [StaffController::class, 'updateProfileInfo'])->name('staff.settings.updateProfileInfo');
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
        Route::post('classes/class-details', [StaffController::class, 'getClassDetails'])->name('staff.classes.details');


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

        // Qualifications
        Route::get('qualification/index', [StaffController::class, 'qualification_view'])->name('staff.qualification');
        Route::post('qualification/add', [StaffController::class, 'qualification_add'])->name('staff.qualification.add');
        Route::get('qualification/list', [StaffController::class, 'getqualification_list'])->name('staff.qualification.list');
        Route::post('qualification/department-details', [StaffController::class, 'getQualificationsDetails'])->name('staff.qualification.details');
        Route::post('qualification/update', [StaffController::class, 'qualification_update'])->name('staff.qualification.update');
        Route::post('qualification/delete', [StaffController::class, 'qualification_delete'])->name('staff.qualification.delete');
        // Staff category
        Route::get('staffcategory/index', [StaffController::class, 'staffcategories_view'])->name('staff.staffcategory');
        Route::post('staffcategory/add', [StaffController::class, 'staffcategories_add'])->name('staff.staffcategory.add');
        Route::get('staffcategory/list', [StaffController::class, 'staffcategories_list'])->name('staff.staffcategory.list');
        Route::post('staffcategory/staffcategory-details', [StaffController::class, 'getstaffcategoriesDetails'])->name('staff.staffcategory.details');
        Route::post('staffcategory/update', [StaffController::class, 'staffcategories_edit'])->name('staff.staffcategory.update');
        Route::post('staffcategory/delete', [StaffController::class, 'staffcategories_delete'])->name('staff.staffcategory.delete');

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
        Route::get('attendance/exam_entry', [StaffController::class, 'examEntry'])->name('staff.attendance.exam_entry');

        //Task routes
        Route::get('task/index', [StaffController::class, 'taskIndex'])->name('staff.task');


        //Timetable
        Route::get('timetable/index', [StaffController::class, 'timetable'])->name('staff.timetable');
        Route::post('timetable/timetable-details', [StaffController::class, 'getTimetable'])->name('staff.timetable.details');


        // Section By Class Route
        Route::post('section-by-class', [StaffController::class, 'sectionByClass'])->name('staff.section_by_class');

        // Attendance routes
        Route::get('attendance/employee_entry', [StaffController::class, 'employeeEntry'])->name('staff.attendance.employee_entry');
        Route::post('attendance/employee_list', [StaffController::class, 'getEmployeeAttendanceList'])->name('staff.attendance.employee_list');
        Route::post('attendance/employee_add', [StaffController::class, 'addEmployeeAttendance'])->name('staff.attendance.employee_add');
        Route::get('attendance/employee/report', [StaffController::class, 'reportEmployeeAttendance'])->name('staff.attendance.employee_report');
        Route::post('attendance/excel', [StaffController::class, 'staffAttendanceExcel'])->name('staff.attendance.excel');


        // Leave Apply
        Route::get('leave_management/applyleave', [StaffController::class, 'applyleave'])->name('staff.leave_management.applyleave');
        Route::post('leave_management/applyleave_save', [StaffController::class, 'staffApplyLeave'])->name('staff.leave_management.add');
        Route::get('leave_management/applyleave_list', [StaffController::class, 'getStaffLeaveList'])->name('staff.leave_management.list');
        // all leaves
        Route::get('leave_management/allleaves', [StaffController::class, 'allleaves'])->name('staff.leave_management.allleaves');
        Route::get('leave_management/leave_approval_history_by_staff', [StaffController::class, 'getAllLeaveList'])->name('staff.leave_management.leave_approval_history_by_staff');
        Route::post('leave_management/reupload_file', [StaffController::class, 'reUploadLeaveFile'])->name('staff.reupload_file.add');


        // class room management    
        Route::get('classroom/classroom-management', [StaffController::class, 'classroomManagement'])->name('staff.classroom.management');
        Route::post('classroomAdd', [StaffController::class, 'classroomPost'])->name('staff.classroom.add');
        Route::post('getShortTest', [StaffController::class, 'getShortTest'])->name('staff.classroom.get_short_test');
        Route::post('add_short_test', [StaffController::class, 'addShortTest'])->name('staff.classroom.add_short_test');
        Route::post('add_daily_report', [StaffController::class, 'addDailyReport'])->name('staff.classroom.add_daily_report');
        Route::post('add_daily_report_remarks', [StaffController::class, 'addDailyReportRemarks'])->name('staff.classroom.add_daily_report_remarks');
        Route::post('studentleave/update', [StaffController::class, 'getstudentleave_update'])->name('staff.studentleave.update');
        // download pdf
        Route::post('timetable/pdf', [PdfController::class, 'timetable_pdf'])->name('staff.timetable.pdf');
        Route::post('attendance/employee_pdf', [PdfController::class, 'attendance_employee_pdf'])->name('staff.attendance.employee_pdf');
    });
});
// TEACHER CONTROLLER START
Route::group(['prefix' => 'teacher'], function () {

    Route::get('/login', [AuthController::class, 'teacherLoginForm'])->name('teacher.login');
    Route::any('/authenticate', [AuthController::class, 'authenticateTeacher'])->name('teacher.authenticate');
    Route::post('/logout', [AuthController::class, 'logoutTeacher'])->name('teacher.logout');
    Route::group(['middleware' => 'isTeacher'], function () {
        Route::get('/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');
        // Test Result Rotes
        Route::get('test_result', [TeacherController::class, 'testResult'])->name('teacher.test_result');
        Route::get('exam_results/paper_wise_result', [TeacherController::class, 'paperWiseResult'])->name('teacher.paper_wise_result');

        // student details
        Route::get('/student', [TeacherController::class, 'studentIndex'])->name('teacher.student.index');

        // Parent routes
        Route::get('parent/index', [TeacherController::class, 'parent'])->name('teacher.parent');

        // Admission routes
        Route::get('admission/index', [TeacherController::class, 'admission'])->name('teacher.admission');
        // Attendance routes
        Route::get('attendance/employee_entry', [TeacherController::class, 'employeeEntry'])->name('teacher.attendance.employee_entry');
        Route::post('attendance/employee_list', [TeacherController::class, 'getEmployeeAttendanceList'])->name('teacher.attendance.employee_list');
        Route::post('attendance/employee_add', [TeacherController::class, 'addEmployeeAttendance'])->name('teacher.attendance.employee_add');
        Route::get('attendance/employee/report', [TeacherController::class, 'reportEmployeeAttendance'])->name('teacher.attendance.employee_report');
        Route::get('attendance/student_entry', [TeacherController::class, 'studentEntry'])->name('teacher.attendance.student_entry');
        Route::get('attendance/exam_entry', [TeacherController::class, 'examEntry'])->name('teacher.attendance.exam_entry');
        Route::get('attendance/list', [TeacherController::class, 'attendanceList'])->name('teacher.attendance.list');
        Route::post('attendance/excel', [TeacherController::class, 'staffAttendanceExcel'])->name('teacher.attendance.excel');
        Route::post('student_attendance/excel', [TeacherController::class, 'studentAttendanceExcel'])->name('teacher.student_attendance.excel');
        // Homework routes
        Route::get('homework/index', [TeacherController::class, 'homework'])->name('teacher.homework');
        Route::post('homework/add', [TeacherController::class, 'addHomework'])->name('teacher.homework.add');
        Route::post('homework/homework-details', [TeacherController::class, 'getHomework'])->name('teacher.homework.details');
        Route::get('evaluation_report', [TeacherController::class, 'evaluationReport'])->name('teacher.evaluation_report');
        Route::post('homework/evaluation', [TeacherController::class, 'evaluation'])->name('teacher.homework.evaluation');
        Route::get('homework/edit', [TeacherController::class, 'homeworkEdit'])->name('teacher.homework_edit');
        Route::post('homework/view', [TeacherController::class, 'viewHomework'])->name('teacher.homework.view');
        // Leave Apply
        Route::get('leave_management/applyleave', [TeacherController::class, 'applyleave'])->name('teacher.leave_management.applyleave');
        Route::post('leave_management/applyleave_save', [TeacherController::class, 'staffApplyLeave'])->name('teacher.leave_management.add');
        Route::get('leave_management/applyleave_list', [TeacherController::class, 'getStaffLeaveList'])->name('teacher.leave_management.list');
        // all leaves
        Route::get('leave_management/allleaves', [TeacherController::class, 'allleaves'])->name('teacher.leave_management.allleaves');
        Route::get('leave_management/leave_approval_history_by_staff', [TeacherController::class, 'getAllLeaveList'])->name('teacher.leave_management.leave_approval_history_by_staff');
        Route::post('leave_management/reupload_file', [TeacherController::class, 'reUploadLeaveFile'])->name('teacher.reupload_file.add');
        // admin student_leave list
        Route::get('student-leave/list', [TeacherController::class, 'studentLeaveShow'])->name('teacher.student_leave.list');

        // Forum routes
        Route::get('forum/index', [TeacherController::class, 'forumIndex'])->name('teacher.forum.index');
        Route::get('forum/page-single-topic', [TeacherController::class, 'forumPageSingleTopic'])->name('teacher.forum.page-single-topic');
        Route::get('forum/page-create-topic', [TeacherController::class, 'forumPageCreateTopic'])->name('teacher.forum.page-create-topic');
        Route::get('forum/page-edit-topic/{id}', [TeacherController::class, 'forumPageEditTopic'])->name('teacher.forum.page-edit-topic');
        Route::get('forum/page-single-user', [TeacherController::class, 'forumPageSingleUser'])->name('teacher.forum.page-single-user');
        Route::get('forum/page-single-threads', [TeacherController::class, 'forumPageSingleThreads'])->name('teacher.forum.page-single-threads');
        Route::get('forum/page-single-replies', [TeacherController::class, 'forumPageSingleReplies'])->name('teacher.forum.page-single-replies');
        Route::get('forum/page-single-followers', [TeacherController::class, 'forumPageSingleFollowers'])->name('teacher.forum.page-single-followers');
        Route::get('forum/page-single-categories', [TeacherController::class, 'forumPageSingleCategories'])->name('teacher.forum.page-single-categories');
        Route::get('forum/page-categories', [TeacherController::class, 'forumPageCategories'])->name('teacher.forum.page-categories');
        Route::get('forum/page-categories-single', [TeacherController::class, 'forumPageCategoriesSingle'])->name('teacher.forum.page-categories-single');
        Route::get('forum/page-tabs', [TeacherController::class, 'forumPageTabs'])->name('teacher.forum.page-tabs');
        Route::get('forum/page-tabs-guidelines', [TeacherController::class, 'forumPageTabGuidelines'])->name('teacher.forum.page-tabs-guidelines');

        Route::post('form/page-create-topic', [TeacherController::class, 'createpost'])->name('teacher.forum.create-topic');
        Route::post('form/page-update-topic', [TeacherController::class, 'updatepost'])->name('teacher.forum.update-topic');
        Route::get('forum/page-single-topic-val/{id}/{user_id}', [TeacherController::class, 'forumPageSingleTopicwithvalue'])->name('teacher.forum.page-single-topic-val');
        Route::get('forum/page-categories-single-val/{categId}/{user_id}/{category_names}', [TeacherController::class, 'forumPageCategoriesSingle'])->name('teacher.forum.page-categories-single-val');
        Route::post('form/postimage', [TeacherController::class, 'imagestore'])->name('teacher.forum.image.store');

        // Settings
        Route::get('settings', [TeacherController::class, 'settings'])->name('teacher.settings');
        Route::post('change-password', [TeacherController::class, 'changeNewPassword'])->name('teacher.settings.changeNewPassword');
        Route::post('update-profile-info', [TeacherController::class, 'updateProfileInfo'])->name('teacher.settings.updateProfileInfo');
        // faq        
        Route::get('faq/index', [TeacherController::class, 'faqIndex'])->name('teacher.faq.Index');
        // class room management    
        Route::get('classroom/classroom-management', [TeacherController::class, 'classroomManagement'])->name('teacher.classroom.management');
        // chat app    
        Route::get('chat', [TeacherController::class, 'chatShow'])->name('teacher.chat');
        //Route::post('storetchat', [TeacherController::class, 'storetchat'])->name('teacher.storetchat');
        
        Route::post('chat/chat_save', [TeacherController::class, 'savechat'])->name('teacher.chat.add');
        Route::post('chat/parentlist', [TeacherController::class, 'parentlist'])->name('teacher.chat.parentlist');
        
        Route::post('chat/teacherlist', [TeacherController::class, 'teacherlist'])->name('teacher.chat.teacherlist');
        
        Route::post('chat/chat_remove', [TeacherController::class, 'deletechat'])->name('teacher.chat.del');
       
        Route::post('chat/showlist', [TeacherController::class, 'chatshowlist'])->name('teacher.chat.showlist');
       // Route::post('chat/groupshowlist', [TeacherController::class, 'chatgroupshowlist'])->name('teacher.chat.groupshowlist');
        //Task routes
        Route::get('task/index', [TeacherController::class, 'taskIndex'])->name('teacher.task');
        Route::post('subjectmarksAdd', [TeacherController::class, 'subjectmarks'])->name('teacher.subjectmarks.add');
        Route::post('subjectdivisionAdd', [TeacherController::class, 'subjectdivisionAdd'])->name('teacher.subjectdivision.add');

        // exam Result Group 
        Route::get('exam_results/byclass', [TeacherController::class, 'byclasss'])->name('teacher.exam_results.byclass');

        Route::get('exam_results/bysubject', [TeacherController::class, 'bysubject'])->name('teacher.exam_results.bysubject');

        Route::get('exam_results/bystudent', [TeacherController::class, 'bystudent'])->name('teacher.exam_results.bystudent');
        Route::get('exam_results/overall', [TeacherController::class, 'overall'])->name('teacher.exam_results.overall');
        Route::get('exam/result', [TeacherController::class, 'examResult'])->name('teacher.exam.result');
        // Route::post('section-by-class', [AdminController::class, 'sectionByClass'])->name('teacher.section_by_class');


        Route::get('analyticrep', [TeacherController::class, 'analytic'])->name('teacher.analyticrep.analyticreport');
        Route::post('classroomAdd', [TeacherController::class, 'classroomPost'])->name('teacher.classroom.add');
        Route::post('getShortTest', [TeacherController::class, 'getShortTest'])->name('teacher.classroom.get_short_test');
        Route::post('add_short_test', [TeacherController::class, 'addShortTest'])->name('teacher.classroom.add_short_test');
        Route::post('add_daily_report', [TeacherController::class, 'addDailyReport'])->name('teacher.classroom.add_daily_report');
        Route::post('add_daily_report_remarks', [TeacherController::class, 'addDailyReportRemarks'])->name('teacher.classroom.add_daily_report_remarks');
        Route::post('studentleave/update', [TeacherController::class, 'getstudentleave_update'])->name('teacher.studentleave.update');
        // Subject By Class Route
        Route::post('subject-by-class', [TeacherController::class, 'subjectByClass'])->name('teacher.subject_by_class');

        // Section By Class Route
        Route::post('section-by-class', [TeacherController::class, 'sectionByClass'])->name('teacher.section_by_class');

        // Student List
        Route::get('student/list', [TeacherController::class, 'studentList'])->name('teacher.student.list');
        Route::get('student/student-details/{id}', [TeacherController::class, 'getStudentDetails'])->name('teacher.student.details');

        //Timetable
        Route::get('timetable/index', [TeacherController::class, 'timetable'])->name('teacher.timetable');
        Route::post('timetable/timetable-details', [TeacherController::class, 'getTimetable'])->name('teacher.timetable.details');
        // download pdf
        Route::post('exam_results/downbyclass', [PdfController::class, 'downbyclass'])->name('teacher.exam_results.downbyclass');
        Route::post('exam_results/downbysubject', [PdfController::class, 'downbysubject'])->name('teacher.exam_results.downbysubject');
        Route::post('exam_results/downbystudent', [PdfController::class, 'downbystudent'])->name('teacher.exam_results.downbystudent');
        Route::post('exam_results/downbypaperwise', [PdfController::class, 'downbypaperwise'])->name('teacher.exam_results.downbypaperwise');
        Route::post('timetable/pdf', [PdfController::class, 'timetable_pdf'])->name('teacher.timetable.pdf');
        Route::post('attendance/student_pdf', [PdfController::class, 'attendance_student_pdf'])->name('teacher.attendance.student_pdf');
        Route::post('attendance/employee_pdf', [PdfController::class, 'attendance_employee_pdf'])->name('teacher.attendance.employee_pdf');
    });
});
// TEACHER CONTROLLER END

// PARENT CONTROLLER START
Route::group(['prefix' => 'parent'], function () {

    Route::get('/login', [AuthController::class, 'parentLoginForm'])->name('parent.login');
    Route::any('/authenticate', [AuthController::class, 'authenticateParent'])->name('parent.authenticate');
    Route::post('/logout', [AuthController::class, 'logoutParent'])->name('parent.logout');
    Route::group(['middleware' => ['isParent']], function () {
        Route::get('/dashboard', [ParentController::class, 'index'])->name('parent.dashboard');

        // Settings
        Route::get('settings', [ParentController::class, 'settings'])->name('parent.settings');
        Route::post('change-password', [ParentController::class, 'changeNewPassword'])->name('parent.settings.changeNewPassword');
        Route::post('update-profile-info', [ParentController::class, 'updateProfileInfo'])->name('parent.settings.updateProfileInfo');
        // faq        
        Route::get('faq/index', [ParentController::class, 'faqIndex'])->name('parent.faq.Index');

        //schedule routes  
        Route::get('exam/schedule', [ParentController::class, 'examSchedule'])->name('parent.exam.schedule');

        //Report Card routes  
        Route::get('report_card', [ParentController::class, 'reportCard'])->name('parent.report_card');

        //Event routes
        Route::get('events', [ParentController::class, 'events'])->name('parent.events');
        Route::get('event/list', [ParentController::class, 'getEventList'])->name('parent.event.list');
        Route::post('event/event-details', [ParentController::class, 'getEventDetails'])->name('parent.event.details');
        //Library routes
        Route::get('library/books', [ParentController::class, 'bookList'])->name('parent.library.books');
        Route::get('library/book_issued', [ParentController::class, 'bookIssued'])->name('parent.library.book_issued');


        //Time Table routes
        Route::get('timetable/index', [ParentController::class, 'timeTable'])->name('parent.timetable.index');
        Route::post('timetable/viewexam', [ParentController::class, 'viewExamTimetable'])->name('parent.exam_timetable.view');

        // Forum routes
        Route::get('forum/index', [ParentController::class, 'forumIndex'])->name('parent.forum.index');
        Route::get('forum/page-single-topic', [ParentController::class, 'forumPageSingleTopic'])->name('parent.forum.page-single-topic');
        Route::get('forum/page-create-topic', [ParentController::class, 'forumPageCreateTopic'])->name('parent.forum.page-create-topic');
        Route::get('forum/page-edit-topic/{id}', [ParentController::class, 'forumPageEditTopic'])->name('parent.forum.page-edit-topic');
        Route::get('forum/page-single-user', [ParentController::class, 'forumPageSingleUser'])->name('parent.forum.page-single-user');
        Route::get('forum/page-single-threads', [ParentController::class, 'forumPageSingleThreads'])->name('parent.forum.page-single-threads');
        Route::get('forum/page-single-replies', [ParentController::class, 'forumPageSingleReplies'])->name('parent.forum.page-single-replies');
        Route::get('forum/page-single-followers', [ParentController::class, 'forumPageSingleFollowers'])->name('parent.forum.page-single-followers');
        Route::get('forum/page-single-categories', [ParentController::class, 'forumPageSingleCategories'])->name('parent.forum.page-single-categories');
        Route::get('forum/page-categories', [ParentController::class, 'forumPageCategories'])->name('parent.forum.page-categories');
        Route::get('forum/page-categories-single', [ParentController::class, 'forumPageCategoriesSingle'])->name('parent.forum.page-categories-single');
        Route::get('forum/page-tabs', [ParentController::class, 'forumPageTabs'])->name('parent.forum.page-tabs');
        Route::get('forum/page-tabs-guidelines', [ParentController::class, 'forumPageTabGuidelines'])->name('parent.forum.page-tabs-guidelines');

        Route::post('form/page-create-topic', [ParentController::class, 'createpost'])->name('parent.forum.create-topic');
        Route::post('form/page-update-topic', [ParentController::class, 'updatepost'])->name('parent.forum.update-topic');
        Route::get('forum/page-single-topic-val/{id}/{user_id}', [ParentController::class, 'forumPageSingleTopicwithvalue'])->name('parent.forum.page-single-topic-val');
        Route::get('forum/page-categories-single-val/{categId}/{user_id}/{category_names}', [ParentController::class, 'forumPageCategoriesSingle'])->name('parent.forum.page-categories-single-val');
        Route::post('form/postimage', [ParentController::class, 'imagestore'])->name('parent.forum.image.store');


        //attendance routes
        Route::get('attendance/index', [ParentController::class, 'attendance'])->name('parent.attendance');
        // Homework routes
        Route::get('homework/homeworklist', [ParentController::class, 'homeworklist'])->name('parent.homework');
        Route::post('homework/filter', [ParentController::class, 'filterHomework'])->name('parent.homework.filter');
        // Children routes
        Route::get('children', [ParentController::class, 'children'])->name('parent.children');
        // chat app    
        Route::get('chat', [ParentController::class, 'chatShow'])->name('parent.chat');
        Route::post('chat/chat_save', [ParentController::class, 'savechat'])->name('parent.chat.add');
        
        
        Route::post('chat/teacherlist', [ParentController::class, 'teacherlist'])->name('parent.chat.teacherlist');
        Route::post('chat/chat_remove', [ParentController::class, 'deletechat'])->name('parent.chat.del');
        Route::post('chat/showlist', [ParentController::class, 'chatshowlist'])->name('parent.chat.showlist');

        Route::get('/analyticrep', [ParentController::class, 'analytic'])->name('parent.analyticrep.analyticreport');
        // student leave 
        Route::post('std_leave_apply/add', [ParentController::class, 'student_applyleave'])->name('parent.studentleave.add');
        Route::get('qualification/list', [ParentController::class, 'getstudentleave_list'])->name('parent.student_leave.list');
        Route::post('std_leave_apply/reupload_file', [ParentController::class, 'reUploadLeaveFile'])->name('parent.reupload_file.add');
        // update child session
        Route::post('navbar-update-child_id', [CommonController::class, 'updateStudentID'])->name('navbar.update.child_id');
        Route::get('/student_leaves', [ParentController::class, 'studentLeaves'])->name('parent.student_leaves');
        //student report
        Route::post('attendance/student_pdf', [PdfController::class, 'attendance_student_pdf_parent'])->name('parent.attendance.student_pdf');
        Route::post('attendance/student_excel', [ParentController::class, 'studentAttendanceExcel'])->name('parent.attendance.student_excel');
    });
});

// PARENT CONTROLLER END
Route::group(['prefix' => 'student'], function () {

    Route::get('/login', [AuthController::class, 'studentLoginForm'])->name('student.login');
    Route::any('/authenticate', [AuthController::class, 'authenticateStudent'])->name('student.authenticate');
    Route::post('/logout', [AuthController::class, 'logoutStudent'])->name('student.logout');
    Route::group(['middleware' => ['isStudent']], function () {
        Route::get('/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
        Route::post('add_daily_report_remarks', [StudentController::class, 'addDailyReportRemarks'])->name('student.classroom.add_daily_report_remarks');
        // Homework routes
        Route::get('homework/homeworklist', [StudentController::class, 'homeworklist'])->name('student.homework');
        Route::post('homework/submit', [StudentController::class, 'submitHomework'])->name('student.homework.submit');
        Route::post('homework/filter', [StudentController::class, 'filterHomework'])->name('student.homework.filter');
        // Settings
        Route::get('settings', [StudentController::class, 'settings'])->name('student.settings');
        // faq        
        Route::get('faq/index', [StudentController::class, 'faqIndex'])->name('student.faq.Index');
        // Exam
        Route::get('exam/schedule', [StudentController::class, 'examSchedule'])->name('student.exam.schedule');
        Route::post('timetable/viewexam', [StudentController::class, 'viewExamTimetable'])->name('student.exam_timetable.view');
        // timetable
        Route::get('timetable', [StudentController::class, 'timetable'])->name('student.timetable');
        Route::post('timetable/timetable-details', [StudentController::class, 'getTimetable'])->name('student.timetable.details');

        // Report card
        Route::get('report_card', [StudentController::class, 'reportCard'])->name('student.report_card');
        // Event
        Route::get('events', [StudentController::class, 'events'])->name('student.events');
        Route::get('event/list', [StudentController::class, 'getEventList'])->name('student.event.list');
        Route::post('event/event-details', [StudentController::class, 'getEventDetails'])->name('student.event.details');
        // Library 
        Route::get('library/books', [StudentController::class, 'bookList'])->name('student.library.books');
        Route::get('library/book_issued', [StudentController::class, 'bookIssued'])->name('student.library.book_issued');
        // Forum routes
        Route::get('forum/index', [StudentController::class, 'forumIndex'])->name('student.forum.index');
        Route::get('forum/page-single-topic', [StudentController::class, 'forumPageSingleTopic'])->name('student.forum.page-single-topic');
        Route::get('forum/page-create-topic', [StudentController::class, 'forumPageCreateTopic'])->name('student.forum.page-create-topic');
        Route::get('forum/page-edit-topic/{id}', [StudentController::class, 'forumPageEditTopic'])->name('student.forum.page-edit-topic');
        Route::get('forum/page-single-user', [StudentController::class, 'forumPageSingleUser'])->name('student.forum.page-single-user');
        Route::get('forum/page-single-threads', [StudentController::class, 'forumPageSingleThreads'])->name('student.forum.page-single-threads');
        Route::get('forum/page-single-replies', [StudentController::class, 'forumPageSingleReplies'])->name('student.forum.page-single-replies');
        Route::get('forum/page-single-followers', [StudentController::class, 'forumPageSingleFollowers'])->name('student.forum.page-single-followers');
        Route::get('forum/page-single-categories', [StudentController::class, 'forumPageSingleCategories'])->name('student.forum.page-single-categories');
        Route::get('forum/page-categories', [StudentController::class, 'forumPageCategories'])->name('student.forum.page-categories');
        Route::get('forum/page-categories-single', [StudentController::class, 'forumPageCategoriesSingle'])->name('student.forum.page-categories-single');
        Route::get('forum/page-tabs', [StudentController::class, 'forumPageTabs'])->name('student.forum.page-tabs');
        Route::get('forum/page-tabs-guidelines', [StudentController::class, 'forumPageTabGuidelines'])->name('student.forum.page-tabs-guidelines');


        Route::post('form/page-create-topic', [StudentController::class, 'createpost'])->name('student.forum.create-topic');
        Route::post('form/page-update-topic', [StudentController::class, 'updatepost'])->name('student.forum.update-topic');
        Route::get('forum/page-single-topic-val/{id}/{user_id}', [StudentController::class, 'forumPageSingleTopicwithvalue'])->name('student.forum.page-single-topic-val');
        Route::get('forum/page-categories-single-val/{categId}/{user_id}/{category_names}', [StudentController::class, 'forumPageCategoriesSingle'])->name('student.forum.page-categories-single-val');
        Route::post('form/postimage', [StudentController::class, 'imagestore'])->name('student.forum.image.store');

        Route::get('/analyticrep', [StudentController::class, 'analytic'])->name('student.analyticrep.analyticreport');
    });
});
