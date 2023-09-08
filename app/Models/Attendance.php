<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ["user_id", "attendance_year", "attendance_month", "attendance_day", "attendance_date", "checked_in_time", "checked_out_time", "attendance_count", "late_checkin"];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
