<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTP;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OTPcontroller extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $otp = rand(100000, 999999);

        // Store in session with expiry
        session([
            'otp' => $otp,
            'otp_email' => $request->email,
            'register_name' => $request->name,
            'register_email' => $request->email,
            'register_password' => bcrypt($request->password),
            'otp_expires_at' => Carbon::now()->addMinutes(5)
        ]);

        // Send Mail
        Mail::raw("Your OTP is: $otp", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Your OTP Code');
        });

        return redirect()->route('verify.otpview', ['email' => $request->email]);
    }

    public function verifyOtpView(Request $request)
    {
        $email = $request->email;
        return view('verifyotp', compact('email'));
    }



    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|array|size:6',
            'otp.*' => 'required|digits:1',
        ]);

        $otp = implode('', $request->otp);

        if (
            session('otp') == $otp &&
            session('otp_expires_at') > now()
        ) {
            // ✅ Clear OTP
            session()->forget(['otp', 'otp_expires_at']);

            // ✅ Save User
            $user = User::where('email', session('register_email'))->first();
            if (!$user) {
                $user = new User();
                $user->name = session('register_name');
                $user->email = session('register_email');
                $user->password = session('register_password'); // already bcrypt
                $user->save();
            }

            // ✅ Clear register session after saving
            session()->forget(['register_name', 'register_email', 'register_password']);

            Auth::login($user);
            return redirect()->route('dashboard')->with('success', 'OTP verified successfully!');
        }

        return back()->with('error', 'Invalid or expired OTP');
    }


    public function resendOtp(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $otp = rand(100000, 999999);
        Mail::to($email)->send(new OTP($otp));
        $user->otp = $otp;
        $user->save();
        return response()->json(['message' => 'OTP resent successfully']);
    }
}
