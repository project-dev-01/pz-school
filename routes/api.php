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
});
