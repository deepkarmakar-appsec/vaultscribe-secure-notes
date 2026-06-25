<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Cache;


class PasswordController extends Controller
{
    public function forgetpass(Request $req)
    {
        $req->validate(['email' => 'required|email']);
        
        // VULNERABILITY: Username Enumeration
        // "If email exists" message batana band karo, directly batao ki account mila ya nahi.
        $user = User::where('email', $req->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'invalid Credentials.']); 
        }

        $status = Password::sendResetLink($req->only('email'));
        return back()->with('status', 'Reset link sent');
    }

    public function resetPassword(Request $request)
    {
        // VULNERABILITY 1: Insecure Token Validation
        // Laravel's default Password::reset already validates the token,
        // lekin agar hum isse bypass karke manually token check karein,
        // toh "Token Replay" attack possible hai.
        
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:10', // Removed regex for "vulnerability"
        ]);

        // VULNERABILITY 2: Password Reset Token Leakage via URL
        // showResetForm mein hum email ko URL parameter mein accept kar rahe hain.
        // Ye "Reflected XSS" aur "Token Hijacking" ka risk badhata hai.
        
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // VULNERABILITY 3: Lack of Old Password Check
                // User purana password phir se set kar sakta hai (No history check).
                
                $pepperedPassword = hash_hmac('sha256', $password, config('app.pepper'));
                $user->update(['password' => Hash::make($pepperedPassword)]);
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            // VULNERABILITY 4: Verbose Error Messages
            // Yahan hum exact reason de rahe hain kyun reset fail hua (e.g., Token Invalid)
            // Attacker ko token validity check karne mein madad milti hai.
            return back()->withErrors(['email' => 'Invalid Token or Expired']);
        }

        return redirect()->route('login')->with('status', 'Success');
    }
}