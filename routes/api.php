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
    

    // branch id by class
    Route::post('branch-by-class', [ApiController::class, 'branchIdByClass']);
    Route::post('branch-by-section', [ApiController::class, 'branchIdBySection']);
    Route::post('section-by-class', [ApiController::class, 'SectionByClass']);

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

    // get roles
    Route::post('roles/list', [ApiController::class, 'getRoles']);

    // employee routes
    Route::post('employee/department', [ApiController::class, 'getEmpDepartment']);
    Route::post('employee/designation', [ApiController::class, 'getEmpDesignation']);
    Route::post('employee/add',[ApiController::class,'addEmployee']);
    Route::get('employee/list', [ApiController::class, 'getEmployeeList']);
    // settings
    Route::post('change-profile-picture',[ApiController::class,'updatePicture']);
    Route::post('change-password',[ApiController::class,'changePassword']);
    Route::post('update-profile-info',[ApiController::class,'updateProfileInfo']);
    // create database_migrate
    
    Route::post('database_migrate',[CommonController::class,'databaseMigrate']);
    
});
