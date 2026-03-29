<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */

   public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();

    $user = $request->user();

    //  SISWA
    if ($user->role === 'siswa') {

        // cek semester
        if (!$user->semester || $user->semester->is_active == 0) {
            return redirect()->route('siswa.semester');
        }

        return redirect()->route('dashboard-siswa');
    }

    //  GURU
    if ($user->role === 'guru') {
        return redirect()->route('guru.dashboard');
    }

    return redirect('/');
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    protected function authenticated(Request $request, $user)
{
    if ($user->role == 'siswa') {

        if (!$user->semester || $user->semester->is_active == 0) {
            return redirect()->route('semester.nonaktif');
        }

        return redirect()->route('dashboard.siswa');
    }

    if ($user->role == 'guru') {
        return redirect()->route('dashboard.guru');
    }
}
}
