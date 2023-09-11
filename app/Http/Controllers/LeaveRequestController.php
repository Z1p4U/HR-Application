<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{

    public function listLeaveRequests()
    {
        if (Auth::user()->role !== "admin") {
            return response()->json([
                "message" => "You Are Not Allowed"
            ], 404);
        }

        // Retrieve the list of leave requests
        $leaveRequests = LeaveRequest::searchQuery()
            ->sortingQuery()
            ->paginationQuery();

        // return response()->json(['data' => $leaveRequests, "message" => "Leave Request"], 200);
        return $this->success("Leave Request List", $leaveRequests);
    }

    public function yourLeaveRequestedRecord()
    {
        $user = LeaveRequest::where("user_id", Auth::id())
            ->searchQuery()
            ->sortingQuery()
            ->paginationQuery();


        return response()->json([
            "message" => "Your Requested Record",
            "data" => $user
        ], 200);
    }

    public function leaveRequestsDetail($id)
    {
        if (Auth::user()->role !== "admin") {
            return response()->json([
                "message" => "You Are Not Allowed"
            ], 404);
        }

        // Retrieve the list of leave requests
        $leaveRequests = LeaveRequest::find($id);

        if ($leaveRequests === null) {
            return response()->json([
                "message" => "Leave Request Not Found"
            ], 404);
        }


        // return response()->json(['data' => $leaveRequests, "message" => "Leave Request"], 200);
        return $this->success("Leave Request Detail", $leaveRequests);
    }

    public function requestLeave(Request $request)
    {
        $request->validate([
            'leave_type' => 'required|in:annual_leave,casual_leave,probation_leave,unpaid_leave', // Validate the type
            'half_day' => "required|boolean",
            // 'requested_days' => 'sometimes|numeric|min:0.5',
            'reason' => "required",
            'date' => "required|array",
            'date.*' => "string"
        ]);

        $user = Auth::user();
        // Check if the user has a positive leave balance for the requested leave type
        $leaveType = $request->leave_type;

        $requested_days = $request->half_day ? 0.5 : $request->input('requested_days', 0);

        if ($user->$leaveType < $requested_days) {
            return response()->json(['error' => 'Insufficient leave!'], 422);
        }

        // Create a new leave request record in the database
        $leaveRequest = LeaveRequest::create([
            'user_id' => Auth::id(),
            "user_name" => $user->name,
            'leave_type' => $request->leave_type,
            "reason" => $request->reason,
            "date" => $request->date,
            'half_day' => $request->half_day,
            'requested_days' => $requested_days,
            "annual_leave_left" => $user->annual_leave,
            "casual_leave_left" => $user->casual_leave,
            "probation_leave_left" => $user->probation_leave,
            "unpaid_leave_left" => $user->unpaid_leave,
            'status' => 'pending', // Initially pending until approved
        ]);


        return response()->json([
            "message" => "Leave Requested Successfully!",
            "data" => $leaveRequest

        ], 200);
    }

    public function approveLeave($id)
    {
        if (Auth::user()->role !== "admin") {
            return response()->json([
                "message" => "You Are Not Allowed"
            ], 404);
        }

        $leaveRequest = LeaveRequest::find($id);

        if (is_null($leaveRequest)) {
            return response()->json([
                "message" => "Leave Request Not Found"
            ], 404);
        }

        if (!$leaveRequest->canBeApprovedOrDenied()) {
            return response()->json(['error' => 'Leave request has already been approved or denied.'], 422);
        }

        // Update the leave request status to 'approved'
        $leaveRequest->status = 'approved';
        $leaveRequest->save();

        // Deduct the requested days from the user's leave balance

        if ($leaveRequest->half_day) {
            $user = $leaveRequest->user;
            $leaveType = $leaveRequest->leave_type;
            $user->$leaveType -= 0.5; // Deduct 0.5 days
            $user->save();
        } else {
            $user = $leaveRequest->user;
            $leaveType = $leaveRequest->leave_type;
            $user->$leaveType -= $leaveRequest->requested_days;
            $user->save();
        }

        return response()->json([
            "message" => "Leave Approved Successfully!"
        ], 200);
    }

    public function denyLeave(Request $request, $id)
    {
        if (Auth::user()->role !== "admin") {
            return response()->json([
                "message" => "You Are Not Allowed"
            ], 404);
        }

        $leaveRequest = LeaveRequest::find($id);

        if (is_null($leaveRequest)) {
            return response()->json([
                "message" => "Leave Request Not Found"
            ], 404);
        }

        if (!$leaveRequest->canBeApprovedOrDenied()) {
            return response()->json(['error' => 'Leave request has already been approved or denied.'], 422);
        }

        $leaveRequest->status = 'denied';
        $leaveRequest->save();

        return response()->json([
            "message" => "Leave Denied Successfully!"
        ], 200);
    }
}
