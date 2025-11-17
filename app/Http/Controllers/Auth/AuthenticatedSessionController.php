<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\LoginNotificationEmail;
use App\Mail\LogoutNotificationEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Send login notification email
        $user = Auth::user();
        $loginTime = now()->format('F j, Y, g:i a');
        $ipAddress = $request->ip();
        $userAgent = $request->userAgent();

        try {
            Mail::to($user->email)->send(
                new LoginNotificationEmail($user, $loginTime, $ipAddress, $userAgent)
            );
        } catch (\Exception $e) {
            Log::error('Failed to send login notification email: ' . $e->getMessage());
        }

        return redirect()->intended(route('home', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $logoutTime = now()->format('F j, Y, g:i a');
        $ipAddress = $request->ip();
        $userAgent = $request->userAgent();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Send logout notification email
        try {
            Mail::to($user->email)->send(
                new LogoutNotificationEmail($user, $logoutTime, $ipAddress, $userAgent)
            );
        } catch (\Exception $e) {
            Log::error('Failed to send logout notification email: ' . $e->getMessage());
        }

        return redirect('/');
    }
}
