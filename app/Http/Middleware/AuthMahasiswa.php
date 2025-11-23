<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMahasiswa
{
    public function handle(Request $request, Closure $next)
    {
        if (! session()->has('mahasiswa_id')) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
