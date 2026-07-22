<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Semester;
use App\Models\Classes;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
{
    $semesterAktif = \App\Models\Semester::where('is_active', 1)->first();

    $classes = \App\Models\Classes::where('semester_id', $semesterAktif->id)->get();

    return view('auth.register', compact('classes'));
}

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'class_id' => ['required', 'exists:classes,id'], // 🔥 validasi kelas
        ]);

        // 🔥 ambil semester aktif
        $semesterAktif = Semester::where('is_active', 1)->first();

        // ❗ kalau tidak ada semester aktif
        if (!$semesterAktif) {
            return back()->withErrors([
                'semester' => 'Belum ada semester aktif, hubungi guru!'
            ])->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'role' => 'siswa', // otomatis siswa
            'class_id' => $request->class_id,
            'semester_id' => $semesterAktif->id // 🔥 FIX DI SINI
        ]);

        event(new Registered($user));

       Auth::login($user);

// tambahan 
session(['just_registered' => true]);

return redirect()->route('dashboard-siswa');

        return redirect(RouteServiceProvider::HOME);
    }
}