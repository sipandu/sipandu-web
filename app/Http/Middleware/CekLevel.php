<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use App\Pegawai;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $level1, $level2, $level3, $level4, $level5)
    {
        if (Auth::guard('admin')->user()->role == 'super admin') {
            if ($level1 == 'super admin') {
                return $next($request);
            } elseif ($level2 == 'super admin') {
                return $next($request);
            } elseif ($level3 == 'super admin') {
                return $next($request);
            } elseif ($level4 == 'super admin') {
                return $next($request);
            } elseif ($level5 == 'super admin') {
                return $next($request);
            } else {
                return redirect()->back();
            }
        } elseif (Auth::guard('admin')->user()->role == 'tenaga kesehatan') {
            if ($level1 == 'tenaga kesehatan') {
                return $next($request);
            } elseif ($level2 == 'tenaga kesehatan') {
                return $next($request);
            } elseif ($level3 == 'tenaga kesehatan') {
                return $next($request);
            } elseif ($level4 == 'tenaga kesehatan') {
                return $next($request);
            } elseif ($level5 == 'tenaga kesehatan') {
                return $next($request);
            } else {
                return redirect()->back();
            }
        } else if (Auth::guard('admin')->user()->role == 'pegawai') {
            if ($level1 == 'head admin' || $level1 == 'admin' || $level1 == 'kader') {
                return $next($request);
            } elseif ($level2 == 'head admin' || $level2 == 'admin' || $level2 == 'kader') {
                return $next($request);
            } elseif ($level3 == 'head admin' || $level3 == 'admin' || $level3 == 'kader') {
                return $next($request);
            } elseif ($level4 == 'head admin' || $level4 == 'admin' || $level4 == 'kader') {
                return $next($request);
            } elseif ($level5 == 'head admin' || $level5 == 'admin' || $level5 == 'kader') {
                return $next($request);
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
}
