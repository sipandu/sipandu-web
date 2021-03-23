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
                break;

            case 'ibu':
                $data = 'ibu.data-diri.form';
                break;

            default:
                $getNIK = 'lansia.data-diri.form';
                break;
        }

        if(Auth::user()->is_verified == 1){
            if(Auth::user()->username_tele == null){
                return redirect()->route($data);
            }
            return $next($request);
        }else{
            Auth::guard('web')->logout();
            return redirect()->route('landing.verif');
        }

        // return $next($request);
    }
}
