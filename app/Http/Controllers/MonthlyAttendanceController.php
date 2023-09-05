<?php

namespace App\Http\Controllers;

use App\Models\MonthlyAttendance;
use Illuminate\Http\Request;

class MonthlyAttendanceController extends Controller
{
    public function index()
    {
        $monthlyAttendance = MonthlyAttendance::searchQuery()
            ->sortingQuery()
            ->paginationQuery();

        return $this->success("Monthly Attendance List", $monthlyAttendance);
    }
}
