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
            if(Auth::guard('admin')->user()->superAdmin->jabatan == $level1){
                return $next($request);
            }elseif(Auth::guard('admin')->user()->superAdmin->jabatan == $level2){
                return $next($request);
            }elseif(Auth::guard('admin')->user()->superAdmin->jabatan == $level3){
                return $next($request);
            }elseif(Auth::guard('admin')->user()->superAdmin->jabatan == $level4){
                return $next($request);
            }elseif(Auth::guard('admin')->user()->superAdmin->jabatan == $level5){
                return $next($request);
            }else{
                return redirect()->back();
            }
        } else if (Auth::guard('admin')->user()->role == 'tenaga kesehatan') {
            if(Auth::guard('admin')->user()->nakes->jabatan == $level1){
                return $next($request);
            }elseif(Auth::guard('admin')->user()->nakes->jabatan == $level2){
                return $next($request);
            }elseif(Auth::guard('admin')->user()->nakes->jabatan == $level3){
                return $next($request);
            }elseif(Auth::guard('admin')->user()->nakes->jabatan == $level4){
                return $next($request);
            }elseif(Auth::guard('admin')->user()->nakes->jabatan == $level5){
                return $next($request);
            }else{
                return redirect()->back();
            }
        } else if (Auth::guard('admin')->user()->role == 'pegawai') {
            if(Auth::guard('admin')->user()->pegawai->jabatan == $level1){
                return $next($request);
            }elseif(Auth::guard('admin')->user()->pegawai->jabatan == $level2){
                return $next($request);
            }elseif(Auth::guard('admin')->user()->pegawai->jabatan == $level3){
                return $next($request);
            }elseif(Auth::guard('admin')->user()->pegawai->jabatan == $level4){
                return $next($request);
            }elseif(Auth::guard('admin')->user()->pegawai->jabatan == $level5){
                return $next($request);
            }else{
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
}
