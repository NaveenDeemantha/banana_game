<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verification;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Inertia\Inertia;
use Carbon\Carbon;

class VerificationController extends Controller
{
    /**
     * Show the OTP verification form.
     */
    public function show()
    {
        return Inertia::render('Auth/VerifyEmail');
    }

    /**
     * Verify the OTP.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $user = $request->user();

        // Find the verification record
        $verification = Verification::where('user_id', $user->id)
            ->where('otp', $request->otp)
            ->where('is_verified', false)
            ->first();

        if (!$verification) {
            return back()->withErrors(['otp' => 'Invalid OTP code.']);
        }

        // Check if OTP is expired
        if ($verification->isExpired()) {
            return back()->withErrors(['otp' => 'OTP has expired. Please request a new one.']);
        }

        // Mark verification as used
        $verification->update(['is_verified' => true]);

        // Mark email as verified
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        return redirect('/home')->with('success', 'Email verified successfully!');
    }

    /**
     * Resend OTP.
     */
    public function resend(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect('/home');
        }

        // Send new verification notification (which will create a new OTP)
        $user->sendEmailVerificationNotification();

        return back()->with('success', 'A new OTP has been sent to your email address.');
    }
}
