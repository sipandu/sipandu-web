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
    public function handle($request, Closure $next, $level1, $level2, $level3, $level4)
    {

        if($request->user()->pegawai->jabatan == $level1){
            return $next($request);
        }elseif($request->user()->pegawai->jabatan == $level2){
            return $next($request);
        }elseif($request->user()->pegawai->jabatan == $level3){
            return $next($request);
        }elseif($request->user()->pegawai->jabatan == $level4){
            return $next($request);
        }else{
            return redirect()->route('Admin Home');
        }

        return redirect()->route('Admin Home');
    }
}
