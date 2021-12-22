<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
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
    return redirect(route('login'));
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'super_admin', 'middleware' => ['isSuperAdmin']], function () {
    // dashboard routes
    Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('super_admin.dashboard');

    // section routes
    Route::get('section/index', [SuperAdminController::class, 'section'])->name('super_admin.section');
    Route::post('section/add', [SuperAdminController::class, 'addSection'])->name('section.add');
    Route::get('section/list', [SuperAdminController::class, 'getSectionList'])->name('section.list');
    Route::post('section/section-details', [SuperAdminController::class, 'getSectionDetails'])->name('section.details');
    Route::post('section/update', [SuperAdminController::class, 'updateSectionDetails'])->name('section.update');
    Route::post('section/delete', [SuperAdminController::class, 'deleteSection'])->name('section.delete');

    // branch routes
    Route::get('branch/index', [SuperAdminController::class, 'branchIndex'])->name('branch.index');
    Route::post('branch/add',[SuperAdminController::class,'addBranch'])->name('branch.add');
    Route::get('branch/list', [SuperAdminController::class, 'getBranchList'])->name('branch.list');
    Route::get('branch/edit/{id}', [SuperAdminController::class, 'getEditDetails'])->name('branch.edit');
    Route::post('branch/update', [SuperAdminController::class, 'updateBranchDetails'])->name('branch.update');
    Route::post('branch/delete', [SuperAdminController::class, 'deleteBranch'])->name('branch.delete');
    
    // Class routes
    Route::get('class/index', [SuperAdminController::class, 'class'])->name('super_admin.class');
    Route::post('class/add',[SuperAdminController::class,'addClass'])->name('class.add');
    Route::get('class/list', [SuperAdminController::class, 'getClassList'])->name('class.list');
    Route::post('class/class-details', [SuperAdminController::class, 'getClassDetails'])->name('class.details');
    Route::post('class/update', [SuperAdminController::class, 'updateClassDetails'])->name('class.update');
    Route::post('class/delete', [SuperAdminController::class, 'deleteClass'])->name('class.delete');

    // sections allocations routes
    Route::get('allocate_section/index', [SuperAdminController::class, 'showSectionAllocation'])->name('super_admin.section_allocation');
    Route::post('allocate_section/add',[SuperAdminController::class,'addSectionAllocation'])->name('section_allocation.add');
    Route::get('allocate_section/list', [SuperAdminController::class, 'getSectionAllocationList'])->name('section_allocation.list');
    Route::post('allocate_section/section_allocation-details',[SuperAdminController::class, 'getSectionAllocationDetails'])->name('section_allocation.details');
    Route::post('allocate_section/update',[SuperAdminController::class, 'updateSectionAllocation'])->name('section_allocation.update');
    Route::post('allocate_section/delete', [SuperAdminController::class, 'deleteSectionAllocation'])->name('section_allocation.delete');
  
    // assign_teacher routes
   Route::get('assign_teacher/index', [SuperAdminController::class, 'showTeacherAllocation'])->name('super_admin.assign_teacher');
   Route::post('assign_teacher/get_allocation_section', [SuperAdminController::class, 'getAllocationSection'])->name('assign_teacher.get_allocation_section');
   Route::post('assign_teacher/add', [SuperAdminController::class, 'addTeacherAllocation'])->name('assign_teacher.add');
   Route::get('assign_teacher/list', [SuperAdminController::class, 'getTeacherAllocationList'])->name('assign_teacher.list');
   Route::post('assign_teacher/details', [SuperAdminController::class, 'getTeacherAllocationDetails'])->name('assign_teacher.details');
   Route::post('assign_teacher/update', [SuperAdminController::class, 'updateTeacherAllocation'])->name('assign_teacher.update');
   Route::post('assign_teacher/delete', [SuperAdminController::class, 'deleteTeacherAllocation'])->name('assign_teacher.delete');

   // Event Type routes
   Route::get('event_type/index', [SuperAdminController::class, 'eventType'])->name('super_admin.event_type');
   Route::get('event_type/list', [SuperAdminController::class, 'getEventTypeList'])->name('event_type.list');
   Route::post('event_type/add', [SuperAdminController::class, 'addEventType'])->name('event_type.add');
   Route::post('event_type/event_type-details',[SuperAdminController::class, 'getEventTypeDetails'])->name('event_type.details');
   Route::post('event_type/update',[SuperAdminController::class, 'updateEventTypeDetails'])->name('event_type.update');
   Route::post('event_type/delete', [SuperAdminController::class, 'deleteEventType'])->name('event_type.delete');

    
   // Event routes
   Route::get('event/index', [SuperAdminController::class, 'event'])->name('super_admin.event');
   Route::get('event/list', [SuperAdminController::class, 'getEventList'])->name('event.list');
   Route::post('event/add', [SuperAdminController::class, 'addEvent'])->name('event.add');
   Route::post('event/event-details',[SuperAdminController::class, 'getEventDetails'])->name('event.details');
   Route::post('event/delete', [SuperAdminController::class, 'deleteEvent'])->name('event.delete');
   Route::post('event/event-publish',[SuperAdminController::class, 'publishEvent'])->name('event.publish');

    // department routes
    Route::get('department/index', [SuperAdminController::class, 'Department'])->name('super_admin.department');
    Route::post('department/add',[SuperAdminController::class,'addDepartment'])->name('department.add');
    Route::get('department/list', [SuperAdminController::class, 'getDepartmentList'])->name('department.list');
    Route::post('department/department-details',[SuperAdminController::class, 'getDepartmentDetails'])->name('department.details');
    Route::post('department/update',[SuperAdminController::class, 'updateDepartment'])->name('department.update');
    Route::post('department/delete', [SuperAdminController::class, 'deleteDepartment'])->name('department.delete');

    // designation routes
    Route::get('designation/index', [SuperAdminController::class, 'Designation'])->name('super_admin.designation');
    Route::post('designation/add',[SuperAdminController::class,'addDesignation'])->name('designation.add');
    Route::get('designation/list', [SuperAdminController::class, 'getDesignationList'])->name('designation.list');
    Route::post('designation/designation-details',[SuperAdminController::class, 'getDesignationDetails'])->name('designation.details');
    Route::post('designation/update',[SuperAdminController::class, 'updateDesignation'])->name('designation.update');
    Route::post('designation/delete', [SuperAdminController::class, 'deleteDesignation'])->name('designation.delete');

    
    // Employee routes
    Route::get('employee/index', [SuperAdminController::class, 'showEmployee'])->name('super_admin.employee');
    Route::get('employee/add', [SuperAdminController::class, 'addEmployee'])->name('employee.add');

    // Settings
    Route::get('settings', [SuperAdminController::class, 'settings'])->name('super_admin.settings');
    Route::post('change-password',[SuperAdminController::class,'changePassword'])->name('changePassword');
    Route::post('update-profile-info',[SuperAdminController::class,'updateProfileInfo'])->name('updateProfileInfo');
    Route::post('change-profile-picture',[SuperAdminController::class,'updatePicture'])->name('pictureUpdate');


});

Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin']], function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Settings
    Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');

});

Route::group(['prefix' => 'staff', 'middleware' => ['isStaff']], function () {
    Route::get('/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');

    // Settings
    Route::get('settings', [StaffController::class, 'settings'])->name('staff.settings');

});

Route::group(['prefix' => 'teacher', 'middleware' => ['isTeacher']], function () {
    Route::get('/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');

    // Settings
    Route::get('settings', [TeacherController::class, 'settings'])->name('teacher.settings');

});

Route::group(['prefix' => 'parent', 'middleware' => ['isParent']], function () {
    Route::get('/dashboard', [ParentController::class, 'index'])->name('parent.dashboard');

    // Settings
    Route::get('settings', [SuperAdminController::class, 'settings'])->name('parent.settings');

});

Route::group(['prefix' => 'student', 'middleware' => ['isStudent']], function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('student.dashboard');

    // Settings
    Route::get('settings', [SuperAdminController::class, 'settings'])->name('student.settings');

});


