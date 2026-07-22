<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSemesterAktif
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle($request, Closure $next)
{
    if (auth()->check() && auth()->user()->role == 'siswa') {

       
        if (session('just_registered')) {
            session()->forget('just_registered');
            return $next($request);
        }

        $semester = auth()->user()->semester;

        if (!$semester || $semester->is_active == 0) {
            return redirect()->route('siswa.semester');
        }
    }

    return $next($request);
}
}
