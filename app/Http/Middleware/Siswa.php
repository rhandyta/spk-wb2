<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Siswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'siswa':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('vote.index');
                } elseif (Auth::guard($guard)->check()) {
                    return redirect()->route('admin.dashboard');
                }
                break;
        }

        return $next($request);
    }
}
