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
        // dd($today);
        $time = now()->toTimeString();

        $existingAttendance = $user->attendances()
            ->whereDate('attendance_date', $today)
            ->whereNotNull('checked_in_time')
            ->first();

        if (!$existingAttendance) {

            $preferredCheckinTime = now()->copy()->setTime(9, 20, 0);
            // dd($preferredCheckinTime);
            $lateMark = now() > $preferredCheckinTime;

            $attendance = new Attendance();
            $attendance->attendance_year = $now->year;
            $attendance->attendance_month = $now->format('F');
            $attendance->attendance_day = $now->day;
            $attendance->attendance_date = $today;
            $attendance->checked_in_time = $time;
            $attendance->attendance_count = 1;
            $attendance->late_checkin = $lateMark;

            $user->attendances()->save($attendance);

            $monthlySummary = MonthlyAttendance::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    "annual_leave_left" => $user->annual_leave,
                    "casual_leave_left" => $user->casual_leave,
                    "probation_leave_left" => $user->probation_leave,
                    "unpaid_leave_left" => $user->unpaid_leave,
                    'attendance_month' => $attendance->attendance_month,
                    'attendance_year' => $attendance->attendance_year,
                ],
                [
                    'attendance_count' => \DB::raw('attendance_count + 1'),
                ],
            );
            if ($lateMark) {
                $monthlySummary->increment('late_checkin_count');
            }
            $monthlySummary->save();

            return response()->json(["message" => "Checked in successfully", "status" => 200], 200);
        } else {
            return response()->json(["message" => "You already Checked In today.", "status" => 500], 500);
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
            return response()->json(["message" => "You already Checked Out today.", "status" => 500], 500);
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
            return response()->json(["message" => "You haven't checked in yet!", "status" => 500], 500);
        }
    }
}
