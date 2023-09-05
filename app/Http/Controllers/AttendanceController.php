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

        $existingAttendance = $user->attendances()->whereDate('attendance_date', $today)->first();

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
            return response()->json(["message" => "Checked in successfully"]);
        } else {
            return response()->json(["error" => "You already Checked In today."]);
        }
    }

    public function checkOut()
    {
        $user = Auth::user();

        $now = Carbon::now();
        $today = now()->toDateString();
        $time = now()->toTimeString();

        $existingAttendance = $user->attendances()->whereDate('attendance_date', $today)->first();

        // if ($existingAttendance) {
        //     return response()->json(["error" => "You already Checked Out today."]);
        // }

        $attendance = $user->attendances()->whereDate('attendance_date', $today)->latest()->first();


        if ($attendance) {
            $attendance->checked_out_time = $time;
            $attendance->update(['checked_out_time' => $time]);

            return response()->json(["message" => "Checked out successfully"]);
        } else {
            return response()->json(["message" => "You haven't checked in yet!"]);
        }
    }
}
