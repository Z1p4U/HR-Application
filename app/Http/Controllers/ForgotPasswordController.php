<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\ResetPasswordCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        // Delete all old code that user send before.
        ResetPasswordCode::where('email', $request->email)->delete();

        // Generate random code
        $data['code'] = mt_rand(100000, 999999);

        // Create a new code
        $codeData = ResetPasswordCode::create($data);

        // Send email to user
        Mail::to($request->email)->send(new ResetPasswordMail($codeData->code));

        return response(['message' => trans('passwords.sent')], 200);
    }
}
