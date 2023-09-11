<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\MonthlyAttendanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix("v1")->group(function () {

    Route::middleware('jwt')->group(function () {

        Route::controller(AuthController::class)->group(function () {
            Route::post('create-user', "register");
            Route::get('user-lists', 'showUserLists');
            Route::get('your-profile', 'yourProfile');
            Route::get('user-profile/{id}', 'checkUserProfile');
            Route::put('edit/{id}', "edit");
            Route::post("logout", 'logout');
            Route::post("logout-all", 'logoutFromAllDevices');
            Route::put("update-password", 'updatePassword');
            Route::delete('delete-user/{id}', "deleteUser");
        });

        Route::controller(AttendanceController::class)->group(function () {
            Route::post('check-in', "checkIn");
            Route::post('check-out', "checkOut");
            Route::get('attendance/index', 'index');
        });

        Route::get('/monthly/index', [MonthlyAttendanceController::class, "index"]);

        Route::controller(LeaveRequestController::class)->prefix("leave")->group(function () {
            Route::post('request', "requestLeave");
            Route::get('request/your-list', "yourLeaveRequestedRecord");
            Route::get('request/list', "listLeaveRequests");
            Route::get('request/detail/{id}', "leaveRequestsDetail");
            Route::put('approve/{id}', "approveLeave");
            Route::put('denies/{id}', "denyLeave");
        });
    });

    Route::post('/login', [AuthController::class, 'login']);
});
