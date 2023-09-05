<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login']]);
    // }

    /**
     * APIs for user login
     *
     * @bodyParam username required.
     * @bodyParam password required.
     */


    public function login(LoginRequest $request)
    {
        $payload = collect($request->validated());

        try {
            $token = auth()->attempt($payload->toArray());

            if ($token) {
                return $this->createNewToken($token);
            } else {
                return $this->unauthorized();
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * APIs for user login out
     */
    public function logout()
    {
        auth()->logout();

        return $this->success('User successfully signed out', null);
    }

    /**
     * APIs for refresh token
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Change Password
     *
     * @bodyParam password.
     */
    // public function changePassword(ChangePasswordRequest $request, $id)
    // {
    //     $payload = collect($request->validated());
    //     $payload['password'] = bcrypt($payload['password']);
    //     $authId = auth()->user()->id;

    //     if ($authId !== $id) {
    //         return $this->unauthenticated('you do not have permission to change password');
    //     }

    //     DB::beginTransaction();

    //     try {
    //         $user = User::findOrFail($id);
    //         $user->update($payload->toArray());
    //         DB::commit();

    //         return $this->success('Password Successfully Changed', $user);
    //     } catch (Exception $e) {
    //         DB::rollback();

    //         return $e;
    //     }
    // }

    protected function createNewToken($token)
    {
        return $this->success('User successfully signed in', [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user(),
        ]);
    }


    public function showUserLists()
    {
        if (Auth::user()->role !== "admin") {
            return response()->json([
                "message" => "You Are Not Allowed"
            ], 404);
        }

        $users = User::all();
        return response()->json([
            "message" => "User Lists",
            "users" => $users
        ], 200);
    }

    public function checkUserProfile($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return response()->json([
                "error" => "User not found"
            ], 404);
        }

        if (Auth::user()->role !== "admin") {
            return response()->json([
                "message" => "You Are Not Allowed"
            ], 404);
        }

        return response()->json([
            "message" => "User",
            "users" => $user
        ], 200);
    }

    public function yourProfile()
    {
        $profile = User::where("id", Auth::id())->latest("id")->get();

        return response()->json([
            "message" => "Your Profile",
            "user-profile" => $profile
        ], 200);
    }

    public function register(UserStoreRequest $request)
    {
        $payload = collect($request->validated());

        if (Auth::user()->role !== "admin") {
            return response()->json([
                "message" => "You Are Not Allowed"
            ], 404);
        }

        $user = User::create($payload->toArray());


        return response()->json([
            "message" => "user register successfully",
            "data" => $user
        ], 200);
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            "name" => "required|min:3|max:20",
            "role" => "required",
            "position" => "required",
            "jd" => "required",
            "phone" => "required",
        ]);

        $user = User::find($id);
        if (is_null($user)) {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }

        if (Auth::user()->role !== "admin") {
            return response()->json([
                "message" => "You Are Not Allowed"
            ], 404);
        }

        if ($request->has('name')) {
            $user->name = $request->name;
            $user->role = $request->role;
            $user->position = $request->position;
            $user->jd = $request->jd;
            $user->phone = $request->phone;
        }

        $user->update();

        return response()->json([
            "message" => "Info Updated successfully",
            "data" => $user
        ], 200);
    }

    public function logoutFromAllDevices(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            "message" => "Logout All Successfully",
        ], 200);
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', "current_password"],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Gate::authorize("admin-only");

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            "message" => "Password Updated",
        ], 200);
    }
}
