<?php

namespace App\Http\Middleware;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Anak;
use App\Ibu;
use App\Lansia;

class AksesUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $status)
    {
        $anak = Anak::where('id_user', Auth::user()->id)->first();
        $ibu = Ibu::where('id_user', Auth::user()->id)->first();
        $lansia = Lansia::where('id_user', Auth::user()->id)->first();

        if(Auth::check() && isset($anak)){
            if(request()->segment(1) != null){
                if(Auth::user()->role == $status){
                    return $next($request);
                }
                return redirect(route('anak.home'));
            }
        }elseif(Auth::check() && isset($ibu)){
            if(request()->segment(1) != null){
                if(Auth::user()->role == $status){
                    return $next($request);
                }
                return redirect(route('ibu.home'));
            }
        }elseif(Auth::check() && isset($lansia)){
            if(request()->segment(1) != null){
                if(Auth::user()->role == $status){
                    return $next($request);
                }
                return redirect(route('lansia.home'));
                }
        }else{
            abort(403);
        }

    }
}
