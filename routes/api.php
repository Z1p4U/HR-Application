<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MonthlyAttendanceController;
use App\Http\Controllers\PhotoController;
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
        });

        Route::post('/check-in', [AttendanceController::class, "checkIn"]);
        Route::post('/check-out', [AttendanceController::class, "checkOut"]);
        Route::get('/attendance/index', [AttendanceController::class, "index"]);

        Route::get('/monthly/index', [MonthlyAttendanceController::class, "index"]);
    });

    Route::post('/login', [AuthController::class, 'login']);
});
