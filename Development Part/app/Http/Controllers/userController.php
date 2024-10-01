<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mail;

class userController extends Controller
{
    function loginPage()
    {
        return view('pages.auth.login-page');
    }

    function registerPage()
    {
        return view('pages.auth.registration-page');
    }

    function sendOtpPage()
    {
        return view('pages.auth.send-otp-page');
    }

    function verifyOtpPage()
    {
        return view('pages.auth.verify-otp-page');
    }

    function resetPasswordPage()
    {
        return view('pages.auth.reset-password-page');
    }

    function userRegistration(Request $request)
    {
        try {
            $request['password'] = Hash::make($request['password']);
            User::create($request->input());
            return response()->json([
                "status" => "success",
                "message" => "Registration successful"
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => $e
            ], 400);
        }

    }

    function userLogin(Request $request)
    {
        $count = User::where('email', '=', $request->input('email'))->select('id', 'password')->first();

        if ($count !== null && Hash::check($request->input('password'), $count->password)) {
            $token = JWTToken::createToken($request->input('email'), $count->id, 'login');

            return response()->json([
                "status" => "success",
                "message" => "Login successful",
                "token" => $token
            ], 200)->cookie('token', $token, 60 * 24 * 30); // expire in 30 days
        } else {
            return response()->json([
                "status" => "failed",
                "message" => $count
            ], 401);
        }
    }

    function userLogOut(Request $request)
    {
        return redirect('/login')
            ->cookie('token', '', -1); //Delete Cookie
    }

    function sendOTPCode(Request $request)
    {
        $email = $request->input('email');
        $count = User::where('email', '=', $email)->count();

        if ($count === 1) {
            try {
                // Generate 6 digit Otp
                $otp = rand(100000, 999999);

                // Send OTP via Email
                Mail::to($email)->send(new OTPMail($otp));

                // Update on Database
                User::where('email', '=', $email)->Update([
                    'otp' => $otp
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "6 digits verification code sent successfully"
                ], 200);

            } catch (Exception $e) {
                return response()->json([
                    "status" => "failed",
                    "message" => "Email sending failed"
                ], 500);
            }
        } else {
            return response()->json([
                "status" => "failed",
                "message" => "User is not registered in this system."
            ], 401);
        }
    }

    function verifyOTPCode(Request $request)
    {
        $email = $request->input('email');
        $otp = $request->input('otp');
        $count = User::where('email', '=', $email)
            ->where('otp', '=', $otp)
            ->first();

        if ($count) {
            // Generate JWT 
            $token = JWTToken::createToken($request->input('email'), $count->id, 'login');

            // Reset easting OTP from Database
            User::where('email', '=', $email)->update([
                'otp' => '0'
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Verification successful",
                "token" => $token
            ], 200)->cookie('token', $token, 60 * 24 * 30); // expire in 30 days
        } else {
            return response()->json([
                "status" => "failed",
                "message" => "unauthorized"
            ], 401);
        }
    }

    function resetPassword(Request $request)
    {
        try {
            $email = $request->header('email');
            $newPassword = $request->input('password');
            User::where('email', '=', $email)->update([
                'password' => Hash::make($newPassword)
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Password reset successfully."
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "something went wrong"
            ], 500);
        }
    }

    function updatePassword(Request $request) {
        try {
            $email = $request->header('email');
            $previousPassword = $request->input('previousPassword');
            $newPassword = $request->input('password');

            $count = User::where('email', '=', $email)->select('id', 'password')->first();
            if ($count !== null && Hash::check($previousPassword, $count->password)) {
                User::where('email', '=', $email)->update([
                    'password' => Hash::make($newPassword)
                ]);
    
                return response()->json([
                    "status" => "success",
                    "message" => "Password reset successfully."
                ], 200);
            } else {
                return response()->json([
                    "status" => "failed",
                    "message" => "Previous password doesn't match."
                ], 401);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "something went wrong"
            ], 500);
        }
    }

    function userUpdate(Request $request)
    {
        try {
            $email = $request->header('email');
            
            User::where('email', '=', $email)->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'mobile' => $request->input('mobile')
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Profile update successful'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Profile update failed'
            ], 400);
        }
    }
    function userProfile(Request $request)
    {
        $email = $request->header('email');
        $user = User::where('email', '=', $email)->first();
        return response()->json([
            'status' => 'success',
            'message' => '',
            "data" => $user
        ], 200);
    }

    function userLogoUpdate(Request $request) {
        $userId = $request->header('userId');
        $email = $request->header('email');

        $imgUrl = "";

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $currentTime = time();
            $fileExtension = $img->extension();
            $imgName = "{$userId}-{$currentTime}.{$fileExtension}";
            $imgUrl = "uploads/{$imgName}";

            // Upload File
            $img->move(public_path('uploads'), $imgName);
        }

        if ($imgUrl != "") {
            User::where('email', '=', $email)->update([
                'logo_url' => $imgUrl
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Logo updated successfully.'
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Logo update failed'
            ], 400);
        }
    }

    function userLogoDelete(Request $request) {
        $email = $request->header('email');
        $count = User::where('email', '=', $email)->select('logo_url')->first();

        if ($count->logo_url != "") {
            User::where('email', '=', $email)->update([
                'logo_url' => ""
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Logo deleted successfully.'
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Logo deletion failed.'
            ], 400);
        }
    }
}