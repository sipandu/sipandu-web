<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Anak;
use App\Ibu;
use App\Lansia;
use Closure;

class UserCheck
{
    public function handle($request, Closure $next, $level)
    {
        switch($level){
            case 'anak':
                $data = 'anak.data-diri.form';
                if(Auth::user()->is_verified == 1){
                    if (Auth::user()->anak->NIK == null) {
                        return redirect()->route($data);
                    }
                    return $next($request);
                }
                Auth::guard('web')->logout();
                return redirect()->route('landing.verif');
                break;

            case 'ibu':
                $data = 'ibu.data-diri.form';
                if(Auth::user()->is_verified == 1){
                    if (Auth::user()->ibu->NIK == null) {
                        return redirect()->route($data);
                    }
                    return $next($request);
                }
                Auth::guard('web')->logout();
                return redirect()->route('landing.verif');
                break;

            case 'lansia':
                $data = 'lansia.data-diri.form';
                if(Auth::user()->is_verified == 1){
                    if (Auth::user()->lansia->NIK == null) {
                        return redirect()->route($data);
                    }
                    return $next($request);
                }
                Auth::guard('web')->logout();
                return redirect()->route('landing.verif');
                break;
        }
    }
}
