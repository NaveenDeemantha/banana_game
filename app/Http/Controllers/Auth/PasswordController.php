<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordChangedEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = $request->user();
        
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Send password changed notification email
        try {
            Mail::to($user->email)->send(
                new PasswordChangedEmail(
                    $user,
                    now()->format('F j, Y, g:i a'),
                    $request->ip(),
                    $request->userAgent()
                )
            );
        } catch (\Exception $e) {
            Log::error('Failed to send password changed email: ' . $e->getMessage());
        }

        return back();
    }
}
