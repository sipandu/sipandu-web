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
    public function handle($request, Closure $next, $level)
    {
        // $id = $request->user()->id;
        // $admin = Pegawai::where('id_admin',$id)->first();
        // dd($request->user()->pegawai->jabatan);

        if($request->user()->pegawai->jabatan == $level){
            return $next($request);
        }
        return redirect()->route('Admin Home');
    }
}
