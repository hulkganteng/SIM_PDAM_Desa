<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login attempt.
     *
     * Authenticate user, check account status, regenerate session,
     * and redirect based on user role.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }

        $user = Auth::user();

        // Check if user account is active
        if ($user->status === 'nonaktif') {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Akun Anda telah dinonaktifkan.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        // Redirect based on role
        return match ($user->role) {
            'admin' => redirect('/dashboard'),
            'petugas' => redirect('/meter'),
            'kasir' => redirect('/tagihan'),
            'pelanggan' => redirect('/portal/tagihan'),
            default => redirect('/login'),
        };
    }

    /**
     * Handle logout.
     *
     * Invalidate session, regenerate CSRF token, and redirect to login.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
