<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyAttendance extends Model
{
    use HasFactory;
    protected $fillable = ["user_id", "user_name", "annual_leave_left", "casual_leave_left", "probation_leave_left", "unpaid_leave_left", "attendance_month", "attendance_year", "attendance_count", "late_checkin_count"];
}
