<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Anak;
use App\Ibu;
use App\Lansia;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard){
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('admin.home');
                }
                break;

            default:
                if (Auth::guard($guard)->check()) {
                    $idUser = Auth::user()->id;
                    $anak = Anak::where('id_user',$idUser)->first();
                    $ibu = Ibu::where('id_user',$idUser)->first();
                    $lansia = Lansia::where('id_user',$idUser)->first();

                    if($anak != null){
                        return redirect()->route('anak.home');
                    }elseif($ibu != null){
                         return redirect()->route('ibu.home');
                    }elseif($lansia != null){
                        return redirect()->route('lansia.home');
                    }
                }
                break;
        }

        return $next($request);
    }
}
