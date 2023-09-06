<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\MonthlyAttendance;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{

    public function index()
    {
        $attendance = Attendance::with(['user'])
            ->searchQuery()
            ->sortingQuery()
            ->paginationQuery();

        return $this->success("Attendance List", $attendance);
    }

    public function checkIn()
    {
        $user = Auth::user();

        // Check if the user has already incremented attendance today
        $now = Carbon::now();
        $today = now()->toDateString();
        $time = now()->toTimeString();

        $existingAttendance = $user->attendances()
            ->whereDate('attendance_date', $today)
            ->whereNotNull('checked_in_time')
            ->first();

        if (!$existingAttendance) {
            $attendance = new Attendance();
            $attendance->attendance_year = $now->year;
            $attendance->attendance_month = $now->format('F');
            $attendance->attendance_day = $now->day;
            $attendance->attendance_date = $today;
            $attendance->checked_in_time = $time;
            $attendance->attendance_count = 1;

            $user->attendances()->save($attendance);


            $monthlySummary = MonthlyAttendance::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'attendance_month' => $attendance->attendance_month,
                    'attendance_year' => $attendance->attendance_year,
                ],
                ['attendance_count' => \DB::raw('attendance_count + 1')]
            );
            return response()->json(["message" => "Checked in successfully", "status" => 200], 200);
        } else {
            return response()->json(["error" => "You already Checked In today.", "status" => 404], 404);
        }
    }

    public function checkOut()
    {
        $user = Auth::user();

        $now = Carbon::now();
        $today = now()->toDateString();
        $time = now()->toTimeString();

        $existingAttendance = $user->attendances()
            ->whereDate('attendance_date', $today)
            ->whereNotNull('checked_out_time')
            ->first();

        if ($existingAttendance) {
            return response()->json(["error" => "You already Checked Out today.", "status" => 404], 404);
        }

        $attendance = $user->attendances()
            ->whereDate('attendance_date', $today)
            ->whereNotNull('checked_in_time')
            ->whereNull('checked_out_time')
            ->first();

        if ($attendance) {
            $attendance->checked_out_time = $time;
            $attendance->update(['checked_out_time' => $time]);

            return response()->json(["message" => "Checked out successfully", "status" => 200], 200);
        } else {
            return response()->json(["error" => "You haven't checked in yet!", "status" => 404], 404);
        }
    }
}
