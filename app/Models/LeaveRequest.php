<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $fillable = ["leave_type", "user_id", "user_name", "reason", "date", "annual_leave_left", "casual_leave_left", "probation_leave_left", "unpaid_leave_left", "requested_days", "status", "half_day"];

    protected $casts = [
        'date' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function canBeApprovedOrDenied()
    {
        return $this->status === 'pending'; // You can adjust this condition as needed
    }
}
